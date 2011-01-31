<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#tickets_table").tablesorter();
			});
		</script>
		<style type="text/css">
			table {
				width: 75%;
				margin-left: 20px;
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
						<?php if($this->ion_auth->is_admin()): ?>
							<li><a href="<?php echo site_url(); ?>projects/create">Create Project</a></li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div id="main-content">
				<h3>Welcome to <?php echo $this->config->item("app_name"); ?>!</h3>
				<p>This web site will allow you to keep track of your programming projects.  The features
				included to accomplish this are having a tracking system to track issues and feature requests
				of the programming projects you are working on.  In addition, each project will also have
				its own wiki page to help you to record any information about your project.</p>

					
				<?php if(!$my_tickets): ?>
					<h5>No tickets currently assigned to you.</h5>
				<?php else: ?>
					<h4><?php echo  $this->ion_auth->get_user()->first_name;  ?>'s Assigned Tickets (<?php echo count($my_tickets); ?>)</h4>
					<table id="tickets_table">
					<colgroup>
						<col width="10%" />
						<col width="55%" />
						<col width="20%" />
						<col width="15%" />
					</colgroup>
					<thead>
						<th>ticket #</th>
						<th>title</th>
						<th>project</th>
						<th>status</th>
					</thead>
					<?php foreach($my_tickets as $ticket): ?>
						<tr>
							<td style="text-align: center;" ><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->ticket_id); ?></td>
							<td><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->title); ?></td>
							<td><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->project_name); ?></td>
							<td><?php echo anchor("projects/" . $ticket->project_id ."/" . url_title($ticket->project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->status); ?></td>
						</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</table>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
