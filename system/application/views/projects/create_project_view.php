<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $this->config->item("app_name"); ?> - projects - Create Project</title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<base href="<?php echo site_url(); ?>" />
		<script language="javascript" type="text/javascript" src="js/editor/tiny_mce.js"></script>
		<script language="javascript" type="text/javascript" src="js/basic_editor.js"> </script>
		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("select").focus();
			});
		</script>
		<style type="text/css">
			select {
				font: inherit;
				width: 120px;
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
					<li><a href="">Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3>Create New Project</h3>
				<p>Enter the new project information in the fields below.&nbsp; Fields marked with an asterisk (*) are required.</p>
				<div id="content_input">
					<form action="projects/create" method="post">
						<p>
							<label for="language_id">Language*</label>
							<?php echo form_dropdown('language_id', $languages) ?>
						</p>
						<p>
							<label for="project_name">Name* </label>
							<input type="text" name="project_name" id="project_name" value="<?php echo set_value('project_name'); ?>" /><?php echo form_error('project_name'); ?>
						</p>
						<p>
							<label for="text_description">Description*</label>
							<?php echo form_error('text_description'); ?>
							<textarea cols="61" rows="15" name="text_description" id="text_description"><?php echo set_value('text_description'); ?></textarea>
						</p>
						<span id="button_grid">
							<input type="submit" value="Create Project" />
							<input type="reset" value="Clear" />
						</span>
					</form>
				</div>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
