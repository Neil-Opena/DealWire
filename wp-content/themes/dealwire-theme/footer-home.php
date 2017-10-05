<?php 
	$settings = get_option('fivehundred_theme_settings');
	if (isset($settings)) {
		$about_us = html_entity_decode($settings['about']);
	}
?>
</div>
</div>
<div class="constrainedwrapper">
		<div class="constrained">
			<div id="about-us" class="entry-content">
				<div id="about"><?php echo $about_us; ?></div>
			</div>
			<div id="home-widget">
				<?php get_sidebar('home'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div> <!-- closing wrapper -->
<footer>
	<ul class="footer_widgets">
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
	</div>
	<div id="copyright">
		<?php if (fivehundred_show_credits()) { ?>
		<span class="themelink"><?php _e('Theme 500 is a', 'fivehundred'); ?> <a target="_blank" href="http://ignitiondeck.com" title="crowdfunding theme for wordpress" alt="Wordpress crowdfunding theme">
		<?php _e('Crowdfunding Theme for WordPress', 'fivehundred'); ?></a></span>
		<?php } ?>
	</div>
	<div class="clear"></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>