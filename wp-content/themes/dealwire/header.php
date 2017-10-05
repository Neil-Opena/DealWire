<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_template_part('head'); ?>

<body <?php body_class(); ?> id="fivehundred">
	<!-- find this div and remove it -->
	<div id="wrapper" class="hfeed">
		<header role="banner" class="site-header">
			<?php get_template_part('headerwrapper', 'above'); ?>
			<!-- <div class="headerwrapper">
				<input class="nav-check" type="checkbox" name="nav-check">
				<label class="nav-check-label" for="nav-check"></label>
				<?php get_template_part('nav', 'above-mobile'); ?>
				<?php get_template_part('branding'); ?>
				<?php get_template_part('nav', 'above'); ?>
			</div> -->
			<?php get_template_part('headerwrapper', 'below'); ?>
		</header>
	<?php if (isset($post) && $post->post_type == 'post' && is_home()) { ?>
		<div id="containerwrapper" class="<?php echo (isset($post) ? $post->post_type : ''); ?> containerwrapper-home">
	<?php } else { ?>
	<div id="containerwrapper" class="<?php echo (isset($post) ? $post->post_type : ''); ?> containerwrapper">
	<?php } ?>