<div class="center idsocial-wp-fb-login <?php echo $css_class; ?>"><div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="false" onlogin="idsocial_fblogin_callback" scope="email, user_friends, public_profile"></div>
	<div class="idsocial-fblogin-hidden">
		<input type="hidden" name="idsocial-redirect-to" id="idsocial-redirect-to" value="<?php echo (function_exists('md_get_durl') ? md_get_durl() : home_url()); ?>" />
		<input type="hidden" name="idsocial-is-admin-login" id="idsocial-is-admin-login" value="no" />
	</div>
</div>