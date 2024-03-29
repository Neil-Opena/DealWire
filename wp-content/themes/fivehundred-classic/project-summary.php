<?php
global $post;
$id = $post->ID;
$summary = the_project_summary($id);
do_action('fh_project_summary_before');
?>
<div class="ign-project-summary <?php echo (!empty($summary->successful) ? 'success' : ''); ?> <?php echo 'post-'.$id; ?>">
	<a href="<?php echo the_permalink(); ?>">
	<div class="ign-summary-container">
		<div class="ign-summary-image" style="background-image: url(<?php echo $summary->image_url; ?>)"></div>
		<div class="title">
        	<h3><?php echo $summary->name; ?></h3>
             <div class="project-tag">
				<?php
                    $terms = wp_get_post_terms( $post->ID, 'project_category');
                    if(!empty($terms)) {
                    $site_url = home_url();
                    $cat_name = "";
                     foreach($terms as $term){
                        if($term->count > 0){
                            $cat_name .= $term->name;
                            break;
                        }
                     }
                    if($term->count > 0){ echo $cat_name; }
                    }
                 ?>
            </div>
        </div>
		<span class="ign-summary-desc"><?php echo $summary->short_description; ?></span>
		<div class="ign-progress-wrapper">
			<div class="ign-progress-raised"><?php echo $summary->total; ?> <?php _e('RAISED', 'fivehundred'); ?></div>
			<div class="ign-progress-percentage"><?php echo $summary->percentage.'%'; ?></div>
			<div class="ign-progress-bar" style="width: <?php echo $summary->percentage.'%'; ?>"></div>
		</div>
		<?php if (isset($summary->show_dates) && $summary->show_dates == true) { ?>
		<div class="ign-summary-days">
			<i class="icon-time"></i> <strong><?php echo $summary->days_left; ?></strong>
			<?php echo ($summary->days_left < 0 ? '<span> '.__('Days Closed', 'fivehundred').'</span>' : '<span> '.__('Days Left', 'fivehundred').'</span>');?>
		</div>
		<?php } ?>
		<div class="ign-summary-learnmore"><?php _e('Learn More', 'fivehundred'); ?></div>
	</div>
	</a> 
</div>