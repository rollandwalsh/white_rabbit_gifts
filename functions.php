<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define( 'WRG_2020_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/*  Set the maximum allowed width for any content in the theme
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 900;

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Add post thumbnail/featured image support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'post-thumbnails' );

/*-----------------------------------------------------------------------------------*/
/* Add post template based on category
/*-----------------------------------------------------------------------------------*/

define('SINGLE_PATH', TEMPLATEPATH . '/single');

add_filter('single_template', 'custom_single_template');
 
function custom_single_template($single) {
	global $wp_query, $post;
 
	foreach((array)get_the_category() as $cat) :
		if(file_exists(SINGLE_PATH . '/single-category-' . $cat->slug . '.php'))
			return SINGLE_PATH . '/single-category-' . $cat->slug . '.php';
		elseif(file_exists(SINGLE_PATH . '/single-category-' . $cat->term_id . '.php'))
			return SINGLE_PATH . '/single-category-' . $cat->term_id . '.php';
		endforeach;
}

/*-----------------------------------------------------------------------------------*/
/* Register WooCommerce Support
/*-----------------------------------------------------------------------------------*/

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/*
* Removes brackets for count after categories name
*/

function filter_woocommerce_subcategory_count_html( $mark_class_count_category_count_mark, $category ) {
	$mark_class_count_category_count_mark = ' <mark class="count">' . $category->count . '</mark>';
	return $mark_class_count_category_count_mark;
}; 

/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'naked' ), // Register the Primary menu
		// Copy and paste the line above right here if you want to make another menu, 
		// just change the 'primary' to another name
	)
);

/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function wrg_2020_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar, 
		// just change the values of id and name to another word/name
	));
} 
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'wrg_2020_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function wrg_2020_scripts()  { 

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
	
	// add fitvid
	wp_enqueue_script( 'rw-2020-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), WRG_2020_VERSION, true );
	
	// add theme scripts
	wp_enqueue_script( 'rw-2020', get_template_directory_uri() . '/js/theme.min.js', array(), WRG_2020_VERSION, true );
  
}
add_action( 'wp_enqueue_scripts', 'wrg_2020_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header

// include custom jQuery
function include_custom_jquery() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'include_custom_jquery');
