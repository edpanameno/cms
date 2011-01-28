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
					Project > <?php echo $project_name; ?> > KB
				</span>
				<ul>
					<li><a href="#">Create Article</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3><?php echo $project_name; ?> - Knowledgebase</h3>
				<p>Welcome to the knowledgebase for the <u><?php echo $project_name; ?></u>!  This page will allow
				you to create articles that will allow others to know more about this project.  The type of
				information you can create for a kb are things like installation documentation, general
				design principles and any other documentation that you deem important enough.
				</p>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
