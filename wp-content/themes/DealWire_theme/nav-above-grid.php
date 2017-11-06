<?php // no content here ?>
<?php
if (isset($_GET['project_filter'])) {
	$filter = $_GET['project_filter'];
}
else {
	$filter = 'date';
}
if (isset($_GET['order'])) {
	$order = $_GET['order'];
}
else {
	$order = 'DESC';
}
?>
<div class="ignitiondeck grid-header">

	<ul class="filter-menu" data-order="<?php echo $order; ?>">

		<li class="filter_choice">
			<a href="?project_filter=date<?php echo ($order == 'ASC' ? '&amp;order=DESC' : '&amp;order=ASC'); ?>" class="<?php echo (isset($filter) && $filter == 'date' ? 'active' : ''); ?>">
				<?php echo ( $order == 'DESC' ? __('Sort By: Date', 'fivehundred') : __('Sort By: Date', 'fivehundred') ); ?>
				<i class="icon-reveal-menu"></i>
			</a>
		</li>
		
		<li class="filter_choice"><a href="?project_filter=ign_fund_raised<?php echo ($order == 'ASC' ? '&amp;order=DESC' : '&amp;order=ASC'); ?>" class="<?php echo (isset($filter) && $filter == 'ign_fund_raised' ? 'active' : ''); ?>"><?php _e('Amount Raised', 'fivehundred'); ?></a></li>
		
		<li class="filter_choice"><a href="?project_filter=ign_days_left<?php echo ($order == 'ASC' ? '&amp;order=DESC' : '&amp;order=ASC'); ?>" class="<?php echo (isset($filter) && $filter == 'ign_days_left' ? 'active' : ''); ?>"><?php _e('Days Left', 'fivehundred'); ?></a></li>
		
		<li class="filter_choice"><a href="?project_filter=ign_fund_goal<?php echo ($order == 'ASC' ? '&amp;order=DESC' : '&amp;order=ASC'); ?>" class="<?php echo (isset($filter) && $filter == 'ign_fund_goal' ? 'active' : ''); ?>"><?php _e('Goal Amount', 'fivehundred'); ?></a></li>
		
	</ul>
	<div class="swap" data-order="<?php echo $order; ?>">
		<a href="<?php echo ($order == 'ASC' ? '?project_filter='.$filter.'&amp;order=DESC' : '?project_filter='.$filter.'&amp;order=ASC'); ?>">
			<i class="icon-arrow-up"></i>
		</a>
		<i class="icon-arrow-down"></i>
	</div>
</div>

<ul class="cat-sort">
	<?php 
		$args = array('type' => 'ignition_project', 'hide_empty' => 1, 'taxonomy' => 'project_category');
		$cats = get_categories($args);
		
		if (!empty($cats)) { ?>
			<a href="?id_category="><?php _e('All Categories', 'fivehundred'); ?></a>
					<?php
						foreach ($cats as $cat) {
							echo '<a href="?id_category='.$cat->slug.'">'.$cat->name.'</a>';
						}
					?>
	<?php } ?>
</ul>
