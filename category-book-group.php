<?php
/* Category Name: Book Group */

get_header(); // This fxn gets the header.php file and renders it ?>
	<div id="primary">
		<section id="content" role="main" class="site-content">

			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>

					<article class="post">
						<header class="post-title">
							<h1 class="title"><?php the_title(); // Display the title of the post ?></h1>
						</header>
						
						<aside class="post-thumbnail">
							<?php the_post_thumbnail('large'); //Get the thumbnail to this post. ?>
						</aside>
						
						<div class="post-content">
							<div class="post-meta">
								<?php the_time('m.d.Y'); // Display the time it was published ?>
								<?php // the_author(); Uncomment this and it will display the post author ?>
							
							</div><!--/post-meta -->
							<?php the_content(); 
							// This call the main content of the post, the stuff in the main text box while composing.
							// This will wrap everything in p tags
							?>
							
							<?php wp_link_pages(); // This will display pagination links, if applicable to the post ?>
						
							<hr class="line">
						</div><!-- the-content -->
						
						<div class="meta clearfix">
							<div class="category"><?php echo get_the_category_list(); // Display the categories this post belongs to, as links ?></div>
							<div class="tags"><?php echo get_the_tag_list( '| &nbsp;', '&nbsp;' ); // Display the tags this post has, as links separated by spaces and pipes ?></div>
						</div><!-- Meta -->
						
					</article>

				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
				
				<?php
					// If comments are open or we have at least one comment, load up the default comment template provided by Wordpress
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>


			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<header class="post-title">
						<h1 class="title 404">Page Not Found</h1>
					</header>
					
					<div class="post-content">
						<p class="text-center"><code>This page is not working right now.</code></p>
					</div>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>

		</section><!-- #content .site-content -->
	</div><!-- #primary -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>
