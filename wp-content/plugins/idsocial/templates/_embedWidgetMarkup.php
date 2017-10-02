<?php
if ($project_id > 0) {
	$widget_url = home_url('/').'?ig_embed_widget=1&amp;product_no='.$project_id;
}
?>
<?php if (isset($widget_url)) { ?>
<div id="campaign-widget-modal" class="mfp-hide">
	
	<h2 class="modal-title"><?php _e( 'Embed this campaign on your site...', 'idsocial' ); ?></h2>

	<div class="campaign-widget-preview-widget">
		<iframe src="<?php echo $widget_url; ?>" width="214" height="366" frameborder="0" scrolling="no" /></iframe>
	</div>

	<div class="campaign-widget-preview-use">
		<p><?php _e( 'Help raise awareness by sharing this widget. Simply paste the following HTML code most places on the web.', 'idsocial' ); ?></p>

		<p style="margin:0 0 5px;"><strong><?php _e( 'Embed Code', 'idsocial' ); ?></strong></p>

		<pre>&lt;iframe src="<?php echo $widget_url; ?>" width="214" height="366" frameborder="0" scrolling="no" /&gt;&lt;/iframe&gt;</pre>
	</div>
	
	<div class="cl"></div>
	
</div>
<?php } ?>