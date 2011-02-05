<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $this->config->item("app_name"); ?>- Projects</title>
		<?php $this->load->view("common/style_sheets_view"); ?>

		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#projects_table").tablesorter();
			});
		</script>

		<style type="text/css">
			table {
				width: 70%;
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
						<?php if($this->ion_auth->is_admin()): ?>
							<li><a href="projects/create">Create Project</a></li>
						<?php endif; ?>
					</ul>
			</div>
			<div id="main-content">
				<h3><?php echo $this->config->item("app_name"); ?> Projects</h3>
				<p>Below you will find the list of projects that I am currently working on.  
				   Each project has an associated knowledgebase to help keep trac of any documentation
				   that relates to the project.  In addition, each project has a trac page where you
				   will be able to keep track of any issues and enhancements for the project at hand.
				</p>
				<table id="projects_table">
					<colgroup>
						<col width="50%" />
						<col width="12%"/>
						<col width="7%" />
						<col width="7%" />
						<col width="26%" />
					</colgroup>
					<thead>
						<th>name</th>
						<th style="text-align: center;">language</th>
						<th style="text-align: center;">kb</th>
						<th style="text-align: center;">trac</th>
						<th>created</th>
					</thead>
					<?php foreach($projects as $project): ?>
						<tr>
							<td><?php echo anchor("projects/" . $project->project_id ."/" . url_title($project->name, "underscore", TRUE), $project->name, "title=\"" . strip_tags($project->description) . "\""); ?></td>
							<td style="text-align: center;"><?php echo $project->language_name; ?></td>
							<td style="text-align: center;"><?php echo anchor("projects/" . $project->project_id ."/" . url_title($project->name, "underscore", TRUE) . "/kb", "kb"); ?></td>
							<td style="text-align: center;"><?php echo anchor("projects/" . $project->project_id ."/" . url_title($project->name, "underscore", TRUE) . "/trac", "trac"); ?></td>
							<td><?php echo  date("M d Y - h:i a", strtotime($project->date_created)); ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
