<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

			</main><!-- / end page container, begun in the header -->
			
			<?php echo do_shortcode( '[instagram-feed]' ); ?>
			
			<footer class="site-footer">
				<p>&copy; <?php echo date("Y"); ?> <a href="<?php echo esc_url( home_url( '/' ) ); // Link to the home page ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); // Title it with the blog name ?>" rel="home">White Rabbit Gifts</a></p>
				<h6>WRG</h6>
				<img src="<?php echo get_template_directory_uri(); ?>/img/flourish-bottom-right.png" alt="Flourish">
			</footer><!-- #colophon .site-footer -->
			
			<?php wp_footer(); 
			// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
			// Removing this fxn call will disable all kinds of plugins. 
			// Move it if you like, but keep it around.
			?>
			
			<script>
				var title = $('.site-title a').text().split(' ');
				$('.site-title a').empty();
				$.each(title, function(i, v) {
					$('.site-title a').append($('<span>').text(v));
				});	
						
				$('.sub-nav li a').on('click', function(e) {
					e.preventDefault();
					var id = $(this).attr('href');
				    $([document.documentElement, document.body]).animate({
						scrollTop: $(id).offset().top - 16
					}, 1000);
				})
				
				$('.mobile-toggle').on('click', function() {
					$('.menu-main-container').slideToggle();
				})
			</script>
		</section><!-- / end site container, begun in the header -->
	</body>
</html>
