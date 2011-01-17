<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<style type="text/css">
			table {
				margin-left: 20px;
				table-layout: fixed;
				border: 1px solid #9a9b9a;
				width: 65%;
				border-collapse: collapse;
			}

			table thead th {
				background-color: #4b4d4d;
				color: white;
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
				text-align: center;
			}

			table td {
				width: 50px;
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
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
					<?php if($this->ion_auth->logged_in()): ?>
						<li><a href="#">Search</a></li>
						<?php if($this->ion_auth->is_admin()): ?>
							<li><a href="<?php echo site_url(); ?>projects/create">Create Project</a></li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div id="main-content">
				<?php if(!$this->ion_auth->logged_in()): ?>
				<h3>Welcome to <?php echo $this->config->item("app_name"); ?></h3>
				<p>This web site will allow you to keep track of your programming projects.  The features
				included to accomplish this are having a tracking system to track issues and feature requests
				of the programming projects you are working on.  In addition, each project will also have
				its own wiki page to help you to record any information about your project.</p>

				<p>You will need to <?php echo anchor("login", "login"); ?> in order to work inside of this application.
				If you have any questions, please click on the <a href="help">help</a> link in the
				upper right hand corner to get assistance with your question(s).
				</p>

				<?php else: ?>
				<h3><?php echo $this->ion_auth->get_user()->first_name . ', Welcome to ' . $this->config->item("app_name"); ?>!</h3>
				<p>This web site will allow you to keep track of your programming projects.  The features
				included to accomplish this are having a tracking system to track issues and feature requests
				of the programming projects you are working on.  In addition, each project will also have
				its own wiki page to help you to record any information about your project.</p>
				<h4><?php echo  $this->ion_auth->get_user()->first_name;  ?>'s Assigned Tickets</h4>
					<table>
						<colgroup>
							<col width="12%" />
							<col width="80%" />
							<col width="17%" />
						</colgroup>
						<thead>
							<th>Ticket #</th>
							<th>Title</th>
							<th>Status</th>
						</thead>
						<?php foreach($my_tickets as $ticket): ?>
							<tr>
								<td><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->ticket_id); ?></td>
								<td><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->title); ?></td>
								<td><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->status); ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php endif; ?>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
