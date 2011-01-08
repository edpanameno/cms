<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<base href="<?php echo site_url(); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<script language="javascript" type="text/javascript" src="js/editor/tiny_mce.js"></script>
		<script language="javascript" type="text/javascript" src="js/basic_editor.js"> </script>
		<style type="text/css">
			select {
				font: inherit;
				width: 15%;
			}

			#ticket_title {
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
					Project > <?php echo $project_name; ?> > Trac > New Ticket
				</span>
				<ul>
					<li><a href="#">Create Project</a></li>
					<li><a href="#">Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3>Creating new Ticket for <?php echo $project_name; ?></h3>
				<br />
				<div id="content_input">
					<form action="projects/<?php echo $project_id . '/' . $unhumanized_project_name ?>/trac/new_ticket" method="post">
						<p>
							<label for="type_id">Type</label>
							<?php echo form_dropdown('type_id', $ticket_types); ?>
						</p>
						<p>
							<label for="priority_id">Priority</label>
							<?php echo form_dropdown('priority_id', $ticket_priorities); ?>
						</p>
						<p>
							<label for="status_id">Status</label>
							<?php echo form_dropdown('status_id', $ticket_statuses); ?>
						</p>
						<p>
							<label for="ticket_title">Title*</label>
							<?php echo form_error('ticket_title'); ?>
							<input type="text" id="ticket_title" name="ticket_title" value="<?php echo set_value('ticket_title') ?>" />
						</p>
						<p>
							<label for="text_description">Description*</label>
							<?php echo form_error('text_description'); ?>
							<textarea cols="60" rows="15" name="text_description" id="text_description"> <?php echo set_value('text_description'); ?> </textarea>
						</p>
						<span id="button_grid">
							<input type="submit" value="Create Ticket" />
							<input type="reset" value="Clear" />
						</span>
						<input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
					 </form>
				</div>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
