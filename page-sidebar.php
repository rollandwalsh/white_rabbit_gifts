<?php
/**
 * The template for displaying any single page.
 *
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	<div id="primary">
		<section id="content" role="main" class="site-content">

			<?php if ( have_posts() ) : 
			// Do we have any posts/pages in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a page to show, start a loop that will display it
				?>

					<article class="post">
						<header class="post-title">
							<h1 class="title"><?php the_title(); // Display the title of the post ?></h1>
						</header>
						
						<div class="post-content">
							<?php the_content(); 
							// This call the main content of the page, the stuff in the main text box while composing.
							// This will wrap everything in p tags
							?>
							
							<?php wp_link_pages(); // This will display pagination links, if applicable to the page ?>
						</div><!-- the-content -->
						
					</article>

				<?php endwhile; // OK, let's stop the page loop once we've displayed it ?>

			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<header class="post-title">
						<h1 class="title 404">Page Not Found</h1>
					</header>
					
					<div class="post-content">
						<p class="text-center"><code>This page is not working right now.</code></p>
					</div>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a page or not having a page to show) ?>

		</section><!-- #content .site-content -->
		<div id="sidebar" role="sidebar" class="span4">
			<?php get_sidebar(); // This will display whatever we have written in the sidebar.php file, according to admin widget settings ?>
		</div><!-- #sidebar -->
	</div><!-- #primary -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>