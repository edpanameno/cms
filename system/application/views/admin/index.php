<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<style type="text/css">
			table {
				table-layout: fixed;
				border: 1px solid #9a9b9a;
				width: 90%;
				/*margin-left: auto;
				margin-right: auto;*/
				border-collapse: collapse;
			}

			tr:hover td {
				background-color: #f2f1f1;
			}

			table thead th {
				background-color: #4b4d4d;
				color: white;
				border-bottom: 1px solid #9a9b9a;
				text-align: center;
				/*font-weight: bold;*/
			}

			.first_name {
				width: 16%;
			}

			.last_name {
				width: 15%;
			}

			.username {
				width: 13%;
			}

			.email {
				width: 25%;
			}

			.group {
				width: 10%;
			}

			.last_login {
				width: 20%;
			}

			.deactivate_user {
				width: 15%;
				text-align: center;
			}

			.activate_user {
				width: 10%;
				text-align: center;
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
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="<?php echo site_url() . "admin/config" ?>">Configs</a></li>
					<li><a href="<?php echo site_url() . "admin/users" ?>">Users</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3>Admin Page</h3> <br />
				<?php echo anchor("admin/user/create", "Create User"); ?>
				<p>This page will allow you to create/edit users that will have access to the application.</p>
				<span style="color: red"><?php echo $this->session->flashdata("message"); ?></span>

				<h4>Active Users</h4>
				<table border="1">
					<colgroup>
						<col class="first_name" />
						<col class="last_name" />
						<col class="username" />
						<col class="email" />
						<col class="group" />
						<col class="last_login" />
						<col class="deactivate_user" />
					</colgroup>
					<thead>
						<th>First Name</th>
						<th>Last name</th>
						<th>username</th>
						<th>email</th>
						<th>group</th>
						<th>last login</th>
						<th>deactivate</th>
					</thead>
				<?php foreach($active_users as $user): ?>
					<tr>
						<td class="first_name"><?php echo anchor("admin/user/edit/" . $user->id, $user->first_name); ?></td>
						<td class="last_name"><?php echo anchor("admin/user/edit/" . $user->id, $user->last_name); ?></td>
						<td class="username"><?php echo anchor("admin/user/edit/" . $user->id, $user->username); ?></td>
						<td class="email"><?php echo $user->email; ?></td>
						<td class="group"><?php echo $user->group; ?></td>
						<td class="last_login"><?php echo unix_to_human($user->last_login); ?></td>
						<td class="de-activate"><?php echo anchor("admin/user/deactivate/" . $user->id, "deactivate"); ?></td>
					</tr>
				<?php endforeach; ?>
				</table>

				<h4>Deactivated Users</h4>
				<table border="1">
					<colgroup>
						<col class="first_name" />
						<col class="last_name" />
						<col class="username" />
						<col class="email" />
						<col class="group" />
						<col class="last_login" />
						<col class="activate_user" />
					</colgroup>
					<thead>
						<th>First Name</th>
						<th>Last name</th>
						<th>username</th>
						<th>email</th>
						<th>group</th>
						<th>last login</th>
						<th>activate</th>
					</thead>
				<?php foreach($non_active_users as $user): ?>
					<tr>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->first_name); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->last_name); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->username); ?></td>
						<td><?php echo $user->email; ?></td>
						<td><?php echo $user->group; ?></td>
						<td><?php echo unix_to_human($user->last_login); ?></td>
						<td><?php echo anchor("admin/user/activate/" . $user->id, "activate"); ?></td>
					</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
