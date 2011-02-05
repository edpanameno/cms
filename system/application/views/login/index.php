<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<base href="<?php echo site_url(); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $this->config->item("app_name") . " - Login"; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>

		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("input:first").focus();
			});
		</script>

		<style type="text/css">
			fieldset {
				width: 300px;
				margin: auto;
				border: 1px solid #9a9b9a;
				padding: 10px;
			}

			fieldset label {
				display: block;
				float: left;
				width: 60px;
				padding: 0;
				margin: 8px 0 0;
				text-align: left;
			}

			input {
				width: 190px;
				margin: 5px 0 0 20px;
			}

			input[type=submit] {
				float: left;
				margin-left: 0px;
				width: 80px;
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
			</div>
			<div id="main-content">
				<h3>Login to <?php echo $this->config->item("app_name"); ?></h3>
				<span style="color: red;"><?php echo $this->session->flashdata('message'); ?></span>
				<p>Enter your username and password in the fields provided below to log in into <?php echo $this->config->item("app_name"); ?>.</p>
				<?php echo form_open('login')?>
					<fieldset>
						<legend>Login Information</legend>
						<label for="'username">Username</label>
						<input type="text" id="username" name="username" /> <br />
						<label for="password">Password</label>
						<input type="password" id="password" name="password" /> <br />
						<input type="submit" value="Login" />
					</fieldset>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
