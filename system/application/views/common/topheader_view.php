<h2><?php echo $this->config->item("app_name"); ?></h2>
<span id="meta-info">
	<?php if($this->ion_auth->logged_in()): ?>
		<?php echo "Logged in as '" . anchor("user", $this->ion_auth->get_user()->first_name) . "'"; ?>
		<a href="<?php echo site_url() ?>logout">(Logout)</a> |
	<?php else:  ?>
		<a href="<?php echo site_url() ?>login">Login</a> |
	<?php endif; ?>
	<?php if($this->ion_auth->is_admin()): ?>
		<a href="<?php echo site_url(); ?>admin">Admin</a> |
	<?php endif; ?>
	<a href="<?php echo site_url() ?>help">Help</a> |
	<a href="<?php echo site_url() ?>about">About</a>
</span>
