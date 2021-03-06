<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>js/jquery-1.4.4.min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#tickets_table").tablesorter();
			});
		</script>

		<style type="text/css">
			table {
				width: 75%;
			}

			.center_value {
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
					<?php echo anchor("projects/$project_id/$project_name", "Project") ?> > <?php echo anchor("projects/$project_id/$project_name", $humanized_project_name); ?> > Trac
				</span>
				<ul>
					<li><?php echo anchor("projects/$project_id/$project_name/kb", "KB"); ?></li>
					<li><?php echo anchor("projects/$project_id/$project_name/trac/new_ticket", "Create Ticket"); ?></li>
				</ul>
			</div>
			<div id="main-content">
				<h3><?php echo $humanized_project_name; ?> - Trac Page</h3>
				<p>Below you will find the non-closed tickets for <?php echo $humanized_project_name; ?>.</p>
				<h4><?php echo $humanized_project_name . " has " . count($tickets) . " ticket(s)"; ?></h4>
				<div>
					<table id="tickets_table">
						<colgroup>
							<col width="10%" />
							<col width="50%" />
							<col width="25%" />
							<col width="15%" />
						</colgroup>
						<thead>
							<th>ticket #</th>
							<th>title</th>
							<th>date created</th>
							<th>status</th>
						</thead>
						<?php foreach($tickets as $ticket): ?>
							<tr>
								<td class="center_value"><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->ticket_id); ?></td>
								<td><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->title); ?></td>
								<td><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, date("M d Y - h:i a",strtotime($ticket->date_created))); ?></td>
								<td><?php echo anchor("/projects/" . $project_id . "/" . url_title($project_name, "underscore", TRUE) . "/trac/" . $ticket->ticket_id, $ticket->status); ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
