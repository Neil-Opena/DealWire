<?php
// This gets us the data we need for the featured section
	$options = get_option('fivehundred_featured');
	if ($options) {
		$featured_proj = $options['project_id'];
		$featured_post = $options['post_id'];
		$summary = the_project_summary($featured_post);
		//$pledges_count = get_backer_total($featured_post);
		//$tthumb = plugins_url('ignitiondeck/products/timthumb.php', 'ignitiondeck');
	}
	do_action('fh_hDeck_before');
?>
<div class="featured-wrap">
	<a href="<?php echo get_permalink($featured_post); ?>">
		<div class="featured-image" style="background-image: url(<?php echo $summary->image_url; ?>)">&nbsp;</div>
	</a>
	<div class="featured-info">
		<div class="featured-border">
			<header class="hDeck-head">
				<div class="featured-item">
						<strong><?php _e('Goal',  'fivehundred'); ?>: </strong><span><?php echo $summary->goal; ?></span>
				</div>
			</header>
			<h3><?php echo $summary->name; ?></h3>
			<p><?php echo $summary->short_description ;?></p>
			<div class="featured-inner">
				<div class="featured-item project-ct-dollar">
					<?php _e('Raised',  'fivehundred'); ?> 
					<?php echo $summary->total; ?>
				</div>

				<div class="featured-item project-ct-percent">
					<?php echo $summary->percentage; ?>%
				</div>
				
				<div class="featured-item">
					<div class="ign-progress-wrapper" style="clear: both;">
						<!-- end progress-percentage -->
						<div style="width: <?php echo $summary->percentage; ?>%" class="ign-progress-bar">
						
						</div>
						<!-- end progress bar -->
					</div>
				</div>

				<div class="featured-item project-ct-period">
					<i class="icon-icon-time"></i> <?php echo $summary->days_left; ?> <?php _e('Days Left',  'fivehundred'); ?>
				</div>

				<div class="featured-item project-ct-support">
					<i class="icon-torsos-all"></i> <?php echo $summary->pledgers; ?> <?php _e('Supporters',  'fivehundred'); ?>
				</div>
			</div>
			<a class="featured-button" href="<?php echo get_permalink($featured_post); ?>">
				<span><?php _e('Learn More', 'fivehundred'); ?></span><i class="icon-arrow-right"></i>
			</a>

			<div class="featured-button-share">
				<i class="icon-export"></i>
				<div id="share-popup">
			  	<?php get_template_part('project', 'social'); ?>
				</div>
			</div>
		</div>
	</div>
</div>