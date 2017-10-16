
<footer>
	<nav>

		<?php
		if ( has_nav_menu( 'footer-menu' ) ) {
		// Using wp_nav_menu() to display menu
		wp_nav_menu( array(
			'menu' => 'footer-menu', // Select the menu to show by Name
			'container' => false, // Remove the navigation container div
			'theme_location' => 'footer-menu'
			)
		);
		}
		?>
	</nav>
	<p>Copyright &copy; 2017 &mdash; DealWire.co</p>
</footer>
<script src="<?php bloginfo('stylesheet_directory') ?>/vendors/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory') ?>/resources/js/script.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRqPv86iUa_FOseGUremm9ZpgBE1mLAW4&callback=initMap">
</script>
<?php wp_footer(); ?>
</body>
</html>

