<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<base href="<?php echo site_url(); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>
		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("input:first").focus();
			});
		</script>
		<style type="text/css">

			#top_div_container {
				width: 75%;
				margin: auto;
				overflow: auto;
			}

			#top_articles_div, #recent_articles_div {
				border: 1px solid #ccc;
				width: 49%;
				min-height: 200px;
			}

			#recent_articles_div {
				float: left;
			}

			#top_articles_div {
				float: right;
			}

			#search_fields {
				margin-left: 25%;
				margin-bottom: 10px;
			}

			.articles_heading {
				background-color: #4b4d4d;
				color: white;
				text-align: center;
				border-bottom: 1px solid black;
			}

			#recent_articles_div ol , #top_articles_div ol {
				margin-top: 5px;
				padding-left: 30px;
			}

			div#content_input input[type="text"], select {
				width: 195px;
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
					<?php echo anchor("projects/$project_id/$project_name", "Project") ?> > <?php echo anchor("projects/$project_id/$project_name", $humanized_project_name); ?> > KB
				</span>
				<ul>
					<li><?php echo anchor("projects/$project_id/$project_name/trac", "Trac"); ?></li>
					<li><?php echo anchor("projects/$project_id/$project_name/trac/new_ticket", "Create Ticket") ?></li>
					<li><?php echo anchor("projects/$project_id/$project_name/kb/new_article", "Create Article") ?></li>
				</ul>
			</div>
			<div id="main-content">
				<h3><?php echo $humanized_project_name; ?> - kb</h3>
				<p>Welcome to the KB for the <b><?php echo $humanized_project_name; ?></b>. This page will allow
				you to view and create articles that will allow others to know more about this project.  The type of
				information you can create for a kb are things like installation documentation, general
				design principles and any other documentation that is deemed important.
				</p>
				<div id="top_div_container">
					<div id="content_input">
					<div id="search_fields">
						<p>
							<label style="vertical-align: bottom;" for="search_text">Search</label>
							<input type="text" name="search_text" id="seach_text" />
						</p>
						<p>
							<label for="category">Categories</label>
							<select>
								<option>JD</option>
								<option>Howard</option>
								<option>Teddy</option>
								<option>Gary</option>
								<option>Benjy</option>
							</select>
						</p>
						<p>
							<input type="submit" value="Search" />
						</p>
						<input type="hidden" value="project_id" />
					</div>
					</div>
					<div id="recent_articles_div">
						<div class="articles_heading" title="Last 10 Recent Articles">Recent Articles</div>
						<ol>
							<li>Hey now</li>
							<li>How are you</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
						</ol>
					</div>
					<div id="top_articles_div">
						<div class="articles_heading" title="Most Viewed Articles">Top Articles</div>
						<ol>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hope all is going well</li>
							<li>Hey now</li>
							<li>How are you</li>
							<li>Hope all is going well</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
