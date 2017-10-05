<?php get_header(); ?>
<div id="container">
<h1>hi</h1>
	<div class="breakout-out page-title">
		<div class="breakout-in"><h2><?php the_title(); ?></h2></div>
	</div>


	<article id="content">
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
			<?php
			if ( has_post_thumbnail() ) {
			the_post_thumbnail();
			}
			?>
			<?php the_content(); ?>
			<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'fivehundred' ) . '&after=</div>') ?>
			</div>
		</div>
		<?php comments_template( '', true ); ?>
	</article>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>