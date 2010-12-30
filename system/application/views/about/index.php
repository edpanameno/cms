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
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="#">Home</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3>About myCMS</h3>
				<p><b>myCMS</b> is a simple project tracking system that allow you to keep track of the progress in
				what ever programming project you are currently working on.  To accomplish this, myCMS allows users to
				create an unlimited number of projects.  Each project will get it's own tracking system (trac) to
				keep track of issues/enhancements that must be made to each project. In addition, a simple wiki will
				also be provided to allow the user to document the project to his/her desire!</p>
				<p>The site is written in PHP using the <a target="_blank" href="http://www.codeigniter.com">Codeigniter</a> framework.
				The following open source tools were also used to build this application:</p>
				<ol>
					<li><a target="_blank" href="http://benedmunds.com/ion_auth/">Ion Auth</a> for Basic Authentication</li>
					<li><a target="_blank" href="http://tinymce.moxiecode.com/">tinymce</a> for the WYSIWYG editor</li>
					<!-- <li><a target="_blank" href="http://jquery.com/">jquery</a></li>
					<li><a target="_blank" href="http://www.zend.com/en/">Zend Lucene Search Library</a></li> -->
				</ol>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
