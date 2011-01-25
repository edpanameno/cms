<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>myCMS - Projects</title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<style type="text/css">
			table {
				table-layout: fixed;
				border: 1px solid #9a9b9a;
				width: 70%;
				border-collapse: collapse;
			}

			tbody tr td {
				vertical-align: top;
			}

			td.project-desc p {
				margin-top: 5px;
			}

			tr:hover td {
				background-color: #f7f6f6;
			}

			table thead th {
				background-color: #4b4d4d;
				color: white;
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
				font-weight: normal;
				text-align: center;
			}

			table td {
				border-right: 1px solid #9a9b9a;
				border-bottom: 1px solid #9a9b9a;
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
				<h3>My Projects</h3>
				<p>Below you will find the list of projects that I am currently working on.  Each project has an associated
				wiki page as well as a trac page (where you will be able to keep track of any issues and enhancements for the
				project at hand).
				</p>
				<table>
					<colgroup>
						<col width="50%" />
						<col width="10%"/>
						<col width="7%" />
						<col width="7%" />
						<col width="26%" />
					</colgroup>
					<thead>
						<th>Name</th>
						<th>Language</th>
						<th>Wiki</th>
						<th>Trac</th>
						<th>Created</th>
					</thead>
					<?php foreach($projects as $project): ?>
						<tr>
							<td><?php echo anchor("projects/" . $project->project_id ."/" . url_title($project->name, "underscore", TRUE), $project->name, "title=\"" . strip_tags($project->description) . "\""); ?></td>
							<td style="text-align: center;"><?php echo $project->language_name; ?></td>
							<td style="text-align: center;"><?php echo anchor("projects/" . $project->project_id ."/" . url_title($project->name, "underscore", TRUE) . "/wiki", "wiki"); ?></td>
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
