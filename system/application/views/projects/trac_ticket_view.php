<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<base href="<?php echo site_url(); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
		<script language="javascript" type="text/javascript" src="js/editor/tiny_mce.js"></script>
		<script language="javascript" type="text/javascript" src="js/basic_editor.js"> </script>
		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$("#change_ticket_div").hide();
				$("#change_ticket").click(function() {
					var $this = $(this);
					var $change_ticket_div = $("#change_ticket_div");

					if($this.hasClass("collapsed")) {
						$this.removeClass("collapsed");
						$this.addClass("expanded");
						$change_ticket_div.slideToggle("fast");
					}
					else {
						$this.removeClass("expanded");
						$this.addClass("collapsed");
						$change_ticket_div.slideToggle("fast");
					}

					var $button = $("#submit_note");
					if ($button.attr("value") == "Add Note") {
						$button.attr("value", "Change Ticket");
					}
					else {
						$button.attr("value", "Add Note");
					}

					return false;
				});
			});
		</script>

		<?php $this->load->view("common/style_sheets_view"); ?>
		<style type="text/css">
			.heading_title {
				margin-left: 67px;
			}

			table.ticket_info {
				width: 85%;
				margin-left: auto;
				margin-right: auto;
				border: 1px #ccc solid;
				border-collapse: collapse;
			}

			table#change_ticket_info, table#add_note_table {
				border-collapse: collapse;
			}

			table#change_ticket_info td.ticket_property_label {
				text-align: right;
			}

			table#change_ticket_info td.ticket_note_label, table#add_note_table td.ticket_note_label {
				vertical-align: top;
				text-align: right ;
			}

			#ticket_item {
				width: 30%;
			}

			#ticket_item_value {
				width: 70%;
			}

			td > p  {
				/*border: 1px red dashed;*/
				margin-top: 3.5px;
			}

			#note_log, #attachments, textarea {
				width: 85%;
				margin: auto;
				/*border: 1px solid #9a9b9a;*/
				border: 1px solid #d7d7d7;
			}


			div.comment_heading {
				margin-left: auto;
				margin-right: auto;
				border-top: 1px solid #d7d7d7;
				border-bottom: 1px solid #d7d7d7;
				background-color: #f2f1f1;
				font-size: 10pt;
				font-weight: normal;
				color: #535353;
			}

			.comment_misc {
				float: right;
			}

			#change_ticket.note_heading_title.collapsed {
				background: url("images/collapsed.png") no-repeat 0px 50%;
				padding-left: 16px;
			}

			#change_ticket.note_heading_title.expanded, #add_note {
				background: url("images/expanded.png") no-repeat 0px 50%;
				padding-left: 16px;
			}
			.comment_text {
				margin-bottom: 2%;
				margin-left: 10px;
				margin-right: 10px;
			}

			.comment_text > p {
				margin-top: 5px;
			}

			fieldset {
				width: 55%;
				/*margin-left: 10%;*/
				border: 1px solid #9a9b9a;
			}

			#change_ticket_div, #add_note_text {
				margin-left: 10%;
				width: 70%;
			}

			.note_heading_title {
				margin-bottom: 5px;
			}

			select {
				font: inherit;
				width: 150px;
			}

			#ticket_property_label_column {
				width: 20%;
			}

			#ticket_property_label_value {
				width: 80%;
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
					Projects > <?php echo $humanized_project_name; ?> > Trac > <?php echo $ticket->ticket_id; ?>
				</span>
				<ul>
					<li><a href="#">Search</a></li>
					<li><a href="#add_note">Add Note</a></li>
				</ul>
			</div>
			<div id="main-content">
				<h3 class="heading_title"><?php echo $ticket->title .  " (" . $ticket->ticket_id . ")"; ?></h3> <br />
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
						<td><?php echo  date("M d Y - h:i a", strtotime($ticket->last_updated)) . ' - (' . nice_timespan($ticket->date_created) . ')' //date("M d Y - h:i a", strtotime($ticket->date_created)); ?></td>
					</tr>
					<tr>
						<td>Last Updated</td>
						<td><?php echo date("M d Y - h:i a", strtotime($ticket->last_updated)) . ' - (' . nice_timespan($ticket->date_created) . ')'; ?></td>
					</tr>
					<tr>
						<td>Created By</td>
						<td><?php echo $ticket->created_by; ?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $ticket->description; ?></td>
					</tr>
				</table>

				<h4 class="heading_title">Attachments</h4>
				<div id="attachments">
					<p>
						<ul>
							<li>Ticket ITem one</li>
							<li>Ticket item 3</li>
						</ul>
					</p>
				</div>

				<h4 class="heading_title">Ticket Notes</h4>
				<div id="note_log">
				<?php if(!$ticket_notes): ?>
					<h5 style="color: red;">This ticket has no notes</h5>
					<?php else: ?>
						<?php foreach($ticket_notes as $note): ?>
						<div class="comment">
							<div class="comment_heading">
								<?php echo $note->note_type . ' Created by ' . $note->created_by . ' (' .  nice_timespan($note->date_created) . ')'; ?>
								<div class="comment_misc"><?php echo date("M d Y @ h:i a", strtotime($note->date_created)); ?></div>
							</div>
							<div class="comment_text"><?php echo $note->description; ?></div> 
						</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<br />
				<form action="projects/<?php echo $ticket->project_id . '/' . $project_name ?>/trac/<?php echo $ticket->ticket_id; ?>/new_note" method="post">
					<h5 id="change_ticket" class="heading_title note_heading_title collapsed">Change Ticket</h5>
					<div id="change_ticket_div">
						<fieldset>
							<table id="change_ticket_info">
								<tr>
									<td class="ticket_property_label">Type:</td>
									<td><?php echo form_dropdown('new_type_id', $ticket_types, $ticket->type_id); ?></td>
								</tr>
								<tr>
									<td class="ticket_property_label">Priority:</td>
									<td><?php echo form_dropdown('new_priority_id', $ticket_priorities, $ticket->priority_id); ?></td>
								</tr>
								<tr>
									<td class="ticket_property_label">Status:</td>
									<td><?php echo form_dropdown('new_status_id', $ticket_statuses, $ticket->status_id); ?></td>
								</tr>
								<tr>
									<td class="ticket_property_label">Tile:</td>
									<td><input id="new_ticket_title" type="text" size="80" value="<?php echo $ticket->title; ?>" /></td>
								</tr>
							</table>
						</fieldset>
					</div>
					<h5 id="add_note" class="heading_title note_heading_title" name="add_note">Add a Note</h5>
					<div id="add_note_text">
						<textarea cols="30" rows="10" name="text_description" id="text_description"> </textarea>
						<input id="submit_note" type="submit" name="submit" value="Add Note" />
						<input type="hidden" name="ticket_id" value="<?php echo $ticket->ticket_id; ?>" />
					</div>
				</form>
			</div>
		<br />
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
