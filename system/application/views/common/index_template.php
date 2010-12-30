<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>[[enter title of page here]]</title>
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
					Common > Page > Breadcrumb
				</span>
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="#">First Item</a></li>
					<li><a href="#">Second Item</a></li>
					<li><a href="#">Create Project</a></li>
					<li><a href="#">Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3><span style="color: red">[[page title]]</span></h3>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
