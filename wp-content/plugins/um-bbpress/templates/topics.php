<?php $loop = $ultimatemember->query->make('post_status=closed,publish&post_type=topic&posts_per_page=10&offset=0&author=' . um_user('ID') ); ?>

<?php if ( $loop->have_posts()) { ?>
			
	<?php
	$theme_file = get_stylesheet_directory() . '/ultimate-member/templates/bbpress/topics-single.php';
	if ( file_exists( $theme_file ) ) {
		require $theme_file;
	} else {
		require um_bbpress_path . 'templates/topics-single.php';
	}
	?>
	
	<div class="um-ajax-items">
	
		<!--Ajax output-->
		
		<?php if ( $loop->found_posts >= 10 ) { ?>
		
		<div class="um-load-items">
			<a href="#" class="um-ajax-paginate um-button" data-hook="um_bbpress_load_topics" data-args="topic,10,10,<?php echo um_user('ID'); ?>"><?php _e('load more topics','um-bbpress'); ?></a>
		</div>
		
		<?php } ?>
		
	</div>
		
<?php } else { ?>

	<div class="um-profile-note"><span><?php echo ( um_profile_id() == get_current_user_id() ) ? __('You have not created any topics.','um-bbpress') : __('This user has not created any topics.','um-bbpress'); ?></span></div>

<?php } ?>