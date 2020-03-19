<?php 
/* Template Name: Book Group Page */

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
							<h1 class="title"><?php the_title(); ?></h1>
						</header>
										
						<div class="post-content">
							<?php the_content(); 
							// This call the main content of the page, the stuff in the main text box while composing.
							// This will wrap everything in paragraph tags
							?>
							
							<hr class="line">
							
							<h3 class="text-center">Upcoming in <?php the_title(); ?></h3>
							
							<?php $args = array(
								'post_type'			=> 'post',
								'category_name'		=> get_post_field( 'post_name' ),
								'order'				=> 'ASC',
								'meta_key'			=> 'event_date',
								'meta_value'		=> date( 'Ymd' ),
								'meta_compare'		=> '>=',
								'orderby'			=> 'meta_value',
							);
								
							$the_query = new WP_Query( $args );
								 
							if ( $the_query->have_posts() ) {
								echo '<div class="upcoming-' . get_post_field( 'post_name' ) .'">';
								while ( $the_query->have_posts() ) {
									$the_query->the_post(); ?>
										<article>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<?php the_post_thumbnail('medium'); ?>
												<small><?php the_title(); ?></small>
												<span><?php echo the_field('event_date'); ?></span>
											</a>
										</article>
									<?php }
								echo '</div>';
							} else { ?>
								<p class="text-center">Nothing scheduled at the moment, check back soon!</p> 
							<?php }
							/* Restore original Post Data */
							wp_reset_postdata(); ?>
							
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
	</div><!-- #primary -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>