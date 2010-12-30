<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>myCMS - User</title>
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
					<li><a href="#">Search</a></li>
					<li><a href="#">Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3>User Information</h3>
				<p>Below you will find <b><?php echo $this->ion_auth->get_user()->username; ?>'s</b> information.</p>
				<span style="color: red"><?php echo $this->session->flashdata('message'); ?></span>
				<fieldset>
					<legend>Account Information</legend>
					<?php echo form_open('user/change_info'); ?>
					<table border="1">
						<tr>
							<td>First Name</td>
							<td><input type="text" name="first_name" id="first_name" size="20" value="<?php echo $this->ion_auth->get_user()->first_name; ?>" /></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="last_name" id="last_name" size="20" value="<?php echo $this->ion_auth->get_user()->last_name; ?>"/></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="email" id="email" size="20" value="<?php echo $this->ion_auth->get_user()->email; ?>" /></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td><input type="text" name="phone" id="phone" size="20" value="<?php echo $this->ion_auth->get_user()->phone; ?>" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Update" />
							</td>
						</tr>
					</table>
					<?php echo form_close(); ?>
				</fieldset>

				<fieldset>
					<legend>Change Password</legend>
					<?php echo form_open('user/change_password'); ?>
					<table border="1">
						<tr>
							<td>Current Password</td>
							<td><input type="password" name="old_password" id="new_password" size="20" /></td>
						</tr>
						<tr>
							<td>New Password</td>
							<td><input type="password" name="new_password" id="new_password" size="20" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Reset Password" />
							</td>
						</tr>
					</table>
					<?php echo form_close(); ?>
				</fieldset>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
