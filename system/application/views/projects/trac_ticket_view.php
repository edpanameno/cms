<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<base href="<?php echo site_url(); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<?php $this->load->view("common/style_sheets_view"); ?>

		<style type="text/css">
			#ticket_title {
				margin-left: 50px;
			}

			table.ticket_info {
				width: 90%;
				margin-left: auto;
				margin-right: auto;
				border: 1px #ccc solid;
				border-collapse: collapse;
			}

			#ticket_item {
				width: 30%;
			}

			#ticket_item_value {
				width: 70%;
			}

			td > p {
				/*border: 1px red dashed;*/
				margin-top: 2.5px;
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
					Common > Page > Breadcrumb
				</span>
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="#">Create Note</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3 id="ticket_title"><?php echo "(#" . $ticket->ticket_id . ") " . $ticket->title; ?></h3> <br />
				<table border="1" class="ticket_info">
					<colgroup>
						<col id="ticket_item" />
						<col id="ticket_item_value" />
					</colgroup>
					<tr>
						<td>Type</td>
						<td><?php echo $ticket->type; ?></td>
					</tr>
					<tr>
						<td>Priority</td>
						<td><?php echo $ticket->priority; ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><?php echo $ticket->status; ?></td>
					</tr>
					<tr>
						<td>Date Created</td>
						<td><?php echo date("M d Y - h:i a", strtotime($ticket->date_created)); ?></td>
					</tr>
					<tr>
						<td>Last Updated</td>
						<td><?php echo date("M d Y - h:i a", strtotime($ticket->last_updated)); ?></td>
					</tr>
					<tr>
						<td>Created By</td>
						<td><?php echo $ticket->created_by; ?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $ticket->description; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
