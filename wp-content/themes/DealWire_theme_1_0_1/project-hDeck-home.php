<?php
$options = get_option('fivehundred_theme_settings');
if (!empty($options['home'])) {
	$project_id = $options['home'];
	if (class_exists('Deck')) {
		$new_hdeck = new Deck($project_id);
		if (method_exists($new_hdeck, 'hDeck')) {
			$hDeck = $new_hdeck->hDeck();
		}
		else {
			$hDeck = the_project_hDeck($id);
		}
		$id = getPostbyProductID($project_id);
		//$hDeck = the_project_hDeck($id);
		$permalinks = get_option('permalink_structure');
		$summary = the_project_summary($id);
		do_action('fh_hDeck_before');
		$video = the_project_video($id);
	}
}
?>
<?php if (isset($hDeck)) { ?>
	<div class="breakout-out single-ignition_product">
		<div class="breakout-in">
			<div class="featured-wrap">
				<div class="featured-image video <?php echo (!empty($video) ? 'hasvideo' : ''); ?>" style="background-image: url(<?php echo $summary->image_url; ?>)"><?php echo $video; ?> </div>
				<div class="featured-info">
					
					<div class="featured-border">

						<header class="hDeck-head">
							<div class="featured-item">
								<?php _e('Goal',  'fivehundred'); ?>: <span><?php echo $hDeck->goal; ?></span>
							</div>
						</header>
						<div class="project-end">
							<?php _e('BY', 'fivehundred'); ?> <?php echo date('n', strtotime($hDeck->month)); ?>.<?php _e($hDeck->day, 'fivehundred'); ?>.<?php _e($hDeck->year, 'fivehundred'); ?>
						</div>
						<div class="featured-inner">
							<div class="featured-item project-ct-dollar">
								<?php _e('Raised',  'fivehundred'); ?> 
								<?php echo $hDeck->total; ?>
							</div>
							
							<div class="featured-item">
								<div class="ign-progress-wrapper" style="clear: both;">
									<!-- end progress-percentage -->
									<div style="width: <?php echo $hDeck->percentage; ?>%" class="ign-progress-bar">
									
									</div>
									<!-- end progress bar -->
								</div>
							</div>

							<div class="featured-item project-ct-period">
								<i class="icon-icon-time"></i> <?php echo $hDeck->days_left; ?> <?php _e('Days Left', 'fivehundred'); ?>
							</div>

							<div class="featured-item project-ct-support">
								<i class="icon-torsos-all"></i> <?php echo $hDeck->pledges; ?> <?php _e('Supporters',  'fivehundred'); ?>
							</div>
						</div>
						<div class="ign-supportnow">
						<?php if ($hDeck->end_type == 'closed' && $hDeck->days_left <= 0) { ?>
							
							<a class="featured-button" href="#"><span><?php _e('Project Closed', 'fivehundred'); ?></span></a>
							
						<?php } else {?>

							<?php if (empty($permalinks) || $permalinks == '') { ?>
								<a class="featured-button" href="<?php the_permalink(); ?>&purchaseform=500&amp;prodid=<?php echo (isset($project_id) ? $project_id : ''); ?>"><span><?php _e('Support Now', 'fivehundred'); ?></span><i class="icon-arrow-right"></i></a>
							<?php }
							else { ?>
							 	<a class="featured-button" href="<?php the_permalink(); ?>?purchaseform=500&amp;prodid=<?php echo $project_id; ?>"><span><?php _e('Support Now', 'fivehundred'); ?></span><i class="icon-arrow-right"></i></a>
							<?php } ?>

						<?php }?>
									
						</a>
						</div>

						<div class="featured-button-share">
							<i class="icon-export"></i>
							<div id="share-popup">
						  	<?php get_template_part('project', 'social'); ?>
							</div>
						</div>

					</div>

				</div>
			
			</div>
		</div>
	</div>

	<div class="clear"></div>
<?php }
else { ?>
<div id="ign-hDeck-wrapper">
	<div id="ign-hdeck-wrapperbg">
		<div id="ign-hDeck-header">
			<div id="ign-hDeck-left">
			</div>
			<div id="ign-hDeck-right">
				<div class="internal-wrap">
					<div class="internal">
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php } ?>