<form action="<?= esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
	<p>
		<label for="user_login"><?php _e( 'Username or Email Address' ); ?><br />
		<input type="text" name="log" class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" autocapitalize="off" /></label>
	</p>
	<p>
		<label for="user_pass"><?php _e( 'Password' ); ?><br />
		<input type="password" name="pwd" class="input" value="" size="20" /></label>
	</p>
	<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" <?php checked( $rememberme ); ?> /> <?php esc_html_e( 'Remember Me' ); ?></label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Log In' ); ?>" />
		<input type="hidden" name="redirect_to" value="<?= site_url() ?>" />
	</p>
</form>