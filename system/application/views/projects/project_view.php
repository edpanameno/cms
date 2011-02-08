<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
    </head>
    <body>
		<div id="container">
		<div id="top-header"><?php $this->load->view("common/topheader_view"); ?></div>
			<div id="common-nav">
				<?php $this->load->view("common/topnav_view"); ?>
			</div>
			<div id="page-nav-bar">
				<span id="page_breadcrum">
					<?php echo anchor("projects/$project->project_id/$project_name", "Project") ?> > <?php echo $humanized_project_name; ?>
				</span>
				<ul>
					<li><?php echo anchor("projects/$project->project_id/$project_name/kb", "KB") ?></li>
					<li><?php echo anchor("projects/$project->project_id/$project_name/trac/new_ticket", "Create Ticket"); ?></li>
					<li><?php echo anchor("projects/$project->project_id/$project_name/trac", "Trac") ?></li>
				</ul>
			</div>
			<div id="main-content">
				<h3><?php echo $humanized_project_name; ?> - Home Page</h3>
				<p><?php echo $project->description ?></p>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
