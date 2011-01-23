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
				border-collapse: collapse;
			}

			table thead th {
				background-color: #4b4d4d;
				color: white;
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
				text-align: center;
				font-weight: normal;
			}

			table td {
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
			}

			table tr td {
				padding-left: 4px;
			}

			tr:hover td {
				background-color: #f2f1f1;
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
					<li><?php echo anchor("admin/user/create", "Create User"); ?></li>
				</ul>
			</div>
			<div id="main-content">
				<span style="color: red"><?php echo $this->session->flashdata("message"); ?></span>
				<h3>Admin Page</h3>
				<p>This page will allow you to create/edit users that will have access to the application.</p>
				<h4>Active Users</h4>
				<table>
					<colgroup>
						<col width="10%" />
						<col width="12%" />
						<col width="12%" />
						<col width="20%" />
						<col width="10%"/>
						<col width="17%" />
						<col width="8%" />
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
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->first_name); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->last_name); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->username); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->email); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->group); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, unix_to_human($user->last_login)); ?></td>
						<td><?php echo anchor("admin/user/deactivate/" . $user->id, "deactivate"); ?></td>
					</tr>
				<?php endforeach; ?>
				</table>

				<h4>Deactivated Users</h4>
				<table>
					<colgroup>
						<col width="10%" />
						<col width="12%" />
						<col width="12%" />
						<col width="20%" />
						<col width="10%" />
						<col width="17%" />
						<col width="8%" />
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
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->email); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, $user->group); ?></td>
						<td><?php echo anchor("admin/user/edit/" . $user->id, unix_to_human($user->last_login)); ?></td>
						<td><?php echo anchor("admin/user/activate/" . $user->id, "activate"); ?></td>
					</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
