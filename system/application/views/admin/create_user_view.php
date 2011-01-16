<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>myCMS - Create New User</title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<style type="text/css">
			fieldset {
				border: 1px ridge #ccc ;
				width: 30%;
			}
			td.text_label {
				text-align: right;
			}

			input[type=text], input[type=password] {
				width: 200px;
			}

			select  {
				width: 60%;
				font: inherit;
			}
		</style>
    </head>
    <body>
		<div id="container">
		<div id="top-header"><?php $this->load->view("common/topheader_view"); ?></div>
			<div id="common-nav">
				<?php $this->load->view("common/topnav_view"); ?>
			</div>
			<div id="page-nav-bar">
				<span id="page_breadcrum">
					Admin > Create User
				</span>
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="#">Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3>Enter New User Information below</h3>
				<span id="error-msg" style="color: red">
					<?php echo validation_errors(); ?>
					<?php echo $this->session->flashdata('message'); ?>
				</span>
				<?php echo form_open('admin/user/create'); ?>
				<br />
				<fieldset>
					<legend>New User Information</legend>
					<table>
					<colgroup>
						<col width="30%" />
						<col width="70%" />
					</colgroup>
					<tr>
						<td class="text_label">User Type:</td>
						<td>
							<select name="group_id">
								<?php foreach($groups as $group): ?>
									<option value="<?php echo $group->id; ?>"><?php echo $group->description; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text_label">First Name:</td>
						<td><input type="text" name="firstname" id="firstname" size="20" /></td>
					</tr>
					<tr>
						<td class="text_label">Last Name:</td>
						<td><input type="text" name="lastname" id="lastname" size="20" /></td>
					</tr>
					<tr>
						<td class="text_label">Email:</td>
						<td><input type="text" name="email" id="email" size="20" value="<?php echo set_value('email'); ?>" /></td>
					</tr>
					<tr>
						<td class="text_label">Username:</td>
						<td><input type="text" name="username" id="username" size="20" value="<?php echo set_value('username'); ?>" /></td>
					</tr>
					<tr>
						<td class="text_label">Password:</td>
						<td><input type="password" name="password" id="password" size="20" value="<?php echo set_value('password'); ?>" /></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" id="create" value="Create User" class="btn"/>
						</td>
					</tr>
				</table>
				</fieldset>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
