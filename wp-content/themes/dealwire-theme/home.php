<?php
/*
Template Name: Blog Page
*/
?>
<?php get_header(); ?>
<h1>hi</h1>
<div id="container" class="blog">
	<div class="breakout-out blog-title">
		<div class="breakout-in"><h2><?php the_title(); ?></h2></div>
	</div>
	<div id="content">
		<?php get_template_part( 'loop', 'blog' ); ?>
		<?php get_template_part( 'nav', 'below' ); ?>
	</div>
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>