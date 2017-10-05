<?php global $post; ?>
<?php get_header(); ?>
<div id="container">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="content">

			<h2 class="entry-title"><?php echo apply_filters('project_archive_title', __('All Projects', 'fivehundred')); ?></h2>

			<hr class="entry-title-hr" />

			<?php get_template_part( 'nav', 'above-grid' ); ?>
			
			<div id="project-grid">
				<?php 
				if (is_archive('ignition_product')) {
					get_template_part('loop', 'project');
				}
				else {
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$query = new WP_Query(array('paged' => $paged, 'posts_per_page' =>9));
					// Start the loop
					if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
						get_template_part('entry');
						endwhile;
						endif; 
					wp_reset_postdata();
				}
				?>
			</div>
			<div style="clear: both;"></div>
			<?php get_template_part( 'nav', 'below' ); ?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php get_footer();