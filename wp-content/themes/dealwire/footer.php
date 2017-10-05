</div>
</div>
<footer>
	<!-- <ul class="footer_widgets">
		<?php if (dynamic_sidebar('footer-widget-area')) : ?><?php endif; ?>
	</ul>
	<div class="footerright">
		<nav id="menu-footer">

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
	</div> -->
	<nav>
		<!-- <?php
			wp_nav_menu(array(
				'menu' => 'primary',

			));
		 ?> -->
		 <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Deals</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Forums</a></li>
                    <li><a href="#">Account</a></li>
                </ul>
	</nav>
</footer>
<script src="<?php bloginfo('template_directory') ?>/vendors/js/jquery-3.2.1.min.js"></script>
<script src="<?php bloginfo('template_directory') ?>/vendors/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory') ?>/resources/js/script.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRqPv86iUa_FOseGUremm9ZpgBE1mLAW4&callback=initMap">
</script>
<?php wp_footer(); ?>
</body>
</html>