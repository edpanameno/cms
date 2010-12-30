<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
    </head>
    <body>
		<div id="container">
			<div id="top-header"><?php $this->load->view("common/topheader_view"); ?></div>
			<div id="common-nav">
				<?php $this->load->view("common/topnav_view"); ?>
			</div>
			<div id="page-nav-bar">
				<ul>
					<?php if($this->ion_auth->logged_in()): ?>
						<li><a href="#">Search</a></li>
						<?php if($this->ion_auth->is_admin()): ?>
							<li><a href="<?php echo site_url(); ?>projects/create">Create Project</a></li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div id="main-content">
				<h3>Welcome to myCMS!</h3>
				<p>This web site will allow you to keep track of your programming projects.  The features
				included to accomplish this are having a tracking system to track issues and feature requests
				of the programming projects you are working on.  In addition, each project will also have
				its own wiki page to help you to record any information about your project.</p>

				<?php if(!$this->ion_auth->logged_in()): ?>
					<p>You will need to <?php echo anchor("login", "login"); ?> in order to work inside of this application.</p>
					<p>If you have any questions, please click on the <a href="help">help</a> link in the
					upper right hand corner to get assistance with your question(s).</p>
				<?php else: ?>
					<!-- add dynamic content here for users that have logged in -->
				<?php endif; ?>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
