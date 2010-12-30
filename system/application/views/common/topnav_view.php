<ul>
	<li><a <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'login') {echo 'id="current_tab"';} ?> href="<?php echo site_url(); ?>">Home</a></li>
	<?php if($this->ion_auth->logged_in()): ?>
		<li><a <?php if($this->uri->segment(1) == 'projects') {echo 'id="current_tab"';}?> href="<?php echo site_url(); ?>projects">Projects</a></li>
		<?php endif; ?>
	<?php if($this->ion_auth->is_admin()): ?>
		<li><a <?php if($this->uri->segment(1) == 'admin') {echo 'id="current_tab"';} ?> <?php ?>href="<?php echo site_url(); ?>admin">Admin</a></li>
	<?php endif; ?>
</ul>