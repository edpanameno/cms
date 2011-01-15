<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<base href="<?php echo site_url(); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>

		<style type="text/css">
			table {
				table-layout: fixed;
				border: 1px solid #9a9b9a;
				width: 100%;
				margin-left: auto;
				margin-right: auto;
				border-collapse: collapse;
			}

			tbody tr td {
				vertical-align: top;
			}

			td.project-desc p {
				margin-top: 5px;
			}

			tr:hover td {
				background-color: #f2f1f1;
			}

			table thead th {
				background-color: #4b4d4d;
				color: white;
				border-bottom: 1px solid #9a9b9a;
				border-right: 1px solid white;

				text-align: center;
				font-weight: bold;
			}

			table td {
				width: 50px;
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
			}

			#ticket_number {
				width: 7%
			}

			#ticket_title {
				width: 45%;
			}

			#ticket_created_by {
				width: 7%;
			}

			#ticket_assigned_to{
				width: 7%;
			}

			#ticket_date_created {
				width: 15%;
			}

			#ticket_type {
				width: 10%;
			}

			#ticket_status {
				width: 20%;
			}

			td.ticket_id_column, td.created_by_column,
			td.assigned_to_column, td.ticket_status_column,
			td.ticket_type_column,td.date_created_column {
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
				<span id="page_breadcrum">
					 Project > <?php echo $project_name; ?> > Trac 
				</span>
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="<?php echo site_url() . "projects/" .  $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/wiki" ?>">Wiki</a></li>
					<li><a href="<?php echo site_url() . "projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/new_ticket" ?>">Create Ticket</a></li>
					<li><a href="<?php echo site_url() . "projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE); ?>">Project Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3><?php echo $project_name ?> - Trac Page</h3>
				<br />
				<div>
					<table>
						<colgroup>
							<col id="ticket_number" />
							<col id="ticket_title" />
							<col id="ticket_created_by" />
							<col id="ticket_assigned_to" />
							<col id="ticket_date_created" />
							<col id="ticket_type" />
							<col id="ticket_stauts" />
						</colgroup>
						<thead>
							<th>Ticket #</th>
							<th>Title</th>
							<th>Creator</th>
							<th>Assigned</th>
							<th>Date Created</th>
							<th>Type</th>
							<th>Status</th>
						</thead>
						<?php foreach($tickets as $ticket): ?>
						<tr>
							<td class="ticket_id_column"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->ticket_id); ?></td>
							<td><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->title); ?></td>
							<td class="created_by_column"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->created_by); ?></td>
							<td class="assigned_to_column"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->assigned_to); ?></td>
							<td class="date_created_column"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, date("M d Y - h:i a",strtotime($ticket->date_created))); ?></td>
							<td class="ticket_type_column"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->ticket_type); ?></td>
							<td class="ticket_status_column"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->status); ?></td>
						</tr>
					<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
