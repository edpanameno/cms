<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<style type="text/css">
			fieldset {
				width: 30%;
				border: 1px ridge #ccc ;
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
					Admin > Edit User > <?php echo $user->username; ?>
				</span>
				<ul>
				</ul>
			</div>
			<div id="main-content">

				<h3>Editing User: <?php echo $user->username; ?> </h3> <br />
				<fieldset>
					<legend>Change Password</legend>
					<?php echo form_open('admin/user/reset_password'); ?>
					<table>
						<tr>
							<td>New Password:</td>
							<td><input type="password" name="new_password" id="new_password" size="20" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Reset" />
							</td>
						</tr>
					</table>
					<input type="hidden" id="user_id" name="user_id" value="<?php echo $user->id; ?>" />
					<?php echo form_close(); ?>
				</fieldset>
				<br />
				<fieldset>
					<legend>Change User Group</legend>
					<?php echo form_open('admin/user/reset_group'); ?>
					<table>
						<colgroup>
							<col width="40%" />
							<col width="60%" />
						</colgroup>
						<tr>
							<td>Current:</td>
							<td><b><?php echo $this->ion_auth->get_user($user->id)->group_description; ?></b></td>
						</tr>
						<tr>
							<td class="text_label">New Group</td>
							<td>
								<select name="group_id">
									<?php foreach($groups as $group): ?>
										<option value="<?php echo $group->id; ?>"><?php echo $group->description; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Change Group" />
							</td>
						</tr>
					</table>
					<input type="hidden" id="user_id" name="user_id" value="<?php echo $user->id; ?>" />
					<?php echo form_close(); ?>
				</fieldset>

			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
