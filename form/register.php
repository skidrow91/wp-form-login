<form method="post">
	<p>
		<label for="user_login"><?php _e( 'Username' ); ?><br />
		<input type="text" name="user_login" class="input" value="<?= $_SESSION['user_login'] ?? '' ?>" size="20" autocapitalize="off" /></label>
        <?php if (is_wp_error($this->_validation) && $this->_validation->get_error_message('user_login')): ?>
        <br><span><?= $this->_validation->get_error_message('user_login') ?></span>
        <?php endif;?>
	</p>
	<p>
		<label for="user_email"><?php _e( 'Email' ); ?><br />
		<input type="email" name="user_email" class="input" value="<?= $_SESSION['user_email'] ?? '' ?>" size="20" /></label>
        <?php if (is_wp_error($this->_validation) && $this->_validation->get_error_message('user_email')): ?>
        <br><span><?= $this->_validation->get_error_message('user_email') ?></span>
        <?php endif;?>
	</p>
    <p>
		<label for="user_pwd"><?php _e( 'Password' ); ?><br />
		<input type="password" name="user_pwd" class="input" value=""/></label>
        <?php if (is_wp_error($this->_validation) && $this->_validation->get_error_message('user_pwd')): ?>
        <br><span><?= $this->_validation->get_error_message('user_pwd') ?></span>
        <?php endif;?>
	</p>
    <p>
		<label for="user_pwd_confirmation"><?php _e( 'Password Confirmation' ); ?><br />
		<input type="password" name="user_pwd_confirmation" class="input" value=""/></label>
        <?php if (is_wp_error($this->_validation) && $this->_validation->get_error_message('user_pwd_confirmation')): ?>
        <br><span><?= $this->_validation->get_error_message('user_pwd_confirmation') ?></span>
        <?php endif;?>
	</p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Register' ); ?>" />
		<input type="hidden" name="redirect_to" value="<?= site_url() ?>" />
	</p>
</form>