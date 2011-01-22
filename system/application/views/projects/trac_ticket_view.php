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

			/** top spacing for ticket description **/
			td > p  {
				/*border: 1px red dashed;*/
				margin-top: 10px;
			}

			td#ticket_description {
				padding-left: 8px;
				padding-right: 10px;
			}

			table#note_log {
				table-layout: fixed;
			}

			table#note_log th {
				background-color: #4b4d4d;
				color: white;
			}

			table#note_log, #attachments, textarea {
				width: 85%;
				margin: auto;
				/*border: 1px solid #9a9b9a;*/
				border: 1px solid #ccc ;
			}

			.odd {
				background-color: #f7f6f6;
				/*background-color: #f0efef;*/
				/*background-color: #f0f4f5;*/
			}

			.even {
				background-color: white;
			}

			tr td.note_date {
				font-size: 9pt;
				text-align: right;
				border-bottom: thin solid #ccc;
			}

			table#note_log {
				border-collapse: collapse;
			}

			.author_column {
				font-size: 9pt;
				vertical-align: top;
				border-right: thin solid #ccc;
				border-bottom: thin solid #ccc;
			}

			#change_ticket.note_heading_title.collapsed {
				background: url("images/collapsed.png") no-repeat 0px 50%;
				padding-left: 16px;
			}

			#change_ticket.note_heading_title.expanded, #add_note {
				background: url("images/expanded.png") no-repeat 0px 50%;
				padding-left: 16px;
			}

			fieldset {
				width: 75%;
				border: 1px solid #d7d7d7;
			}

			#change_ticket_div, #add_note_text {
				margin-left: 10%;
				width: 70%;
			}

			/** spacing between change ticket and add note **/
			.note_heading_title {
				margin-bottom: 5px;
			}

			select {
				font: inherit;
				width: 150px;
			}

			div.note_description {
				margin-top: -10px;
			}

			/** formatting for the ticket changes text **/
			div.note_description div.change_message ul {
				padding-left: 2%;
				font-weight: bold;
				font-size: 9pt;
				list-style-type: square;
			}

			div.note_description > p {
				margin-top: 9px;
			}

			thead th {
				font-weight: normal;
				border-right: 1px solid #9a9b9a;
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
				<h3 class="heading_title"><?php echo $ticket->title .  " (#" . $ticket->ticket_id . ")"; ?></h3> <br />
				<table border="1" class="ticket_info">
					<colgroup>
						<col width="25%" />
						<col width="75%" />
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
						<td>Resolution </td>
						<td><?php echo $ticket->resolution_name; ?></td>
					</tr>
					<tr>
						<td>Date Created</td>
						<td><?php echo  date("M d Y - h:i a", strtotime($ticket->date_created)) . ' - (' . nice_timespan($ticket->date_created) . ')' //date("M d Y - h:i a", strtotime($ticket->date_created)); ?></td>
					</tr>
					<tr>
						<td>Date Resolved</td>
						<td>
								<?php
									if(isset($ticket->date_resolved)) {
										echo date("M d Y - h:i a", strtotime($ticket->date_resolved)) . ' - (' . nice_timespan($ticket->date_resolved) . ')'; 
									}
									else {
										echo "n/a";
									}
								?>
						</td>
					</tr>
					<tr>
						<td>Last Updated</td>
						<td><?php echo date("M d Y - h:i a", strtotime($ticket->last_updated)) . ' - (' . nice_timespan($ticket->last_updated) . ')'; ?></td>
					</tr>
					<tr>
						<td>Created By</td>
						<td><?php echo $ticket->created_by; ?></td>
					</tr>
					<tr>
						<td>Assigned To</td>
						<td><?php echo $ticket->assigned_to; ?></td>
					</tr>
					<tr>
						<td id="ticket_description" colspan="2"><?php echo $ticket->description; ?></td>
					</tr>
				</table>

				<h4 class="heading_title">Ticket Notes</h4>
				<?php if(!$ticket_notes): ?>
					<h5 style="margin-left: 80px; color: red;">This ticket has no notes</h5>
				<?php else: ?>
					<table id ="note_log">
					<colgroup>
						<col width="15%" />
						<col width="85%" />
					</colgroup>
					<thead>
						<tr>
							<th>Author</th>
							<th>Note</th>
						</tr>
					</thead>
				<?php foreach($ticket_notes as $note): ?>
				<?php static $count = 1; ?>
					<tr class="<?php if(($count % 2) == 0){ echo 'even';} else {echo 'odd';}  ?>">
						<td class="author_column" >
							<span><b><?php echo $note->created_by; ?></b></span><br />
							<span style="font-style: italic"><?php echo $note->note_type; ?></span><br />
							<i><?php echo nice_timespan($note->date_created); ?></i><br />
							<i>#<?php echo "<a name=\"note_$note->note_id\" title=\"note_$note->note_id\">" .  $count++ . "</a>"; ?></i>
						</td>
						<td style="vertical-align: top; border-bottom: thin solid #ccc;">
							<table width="100%" cellpadding="5" cellspacing="0">
								<tr>
									<td class="note_date">
										<?php echo (date("M d Y @ h:i a", strtotime($note->date_created))); ?>
									</td>
								</tr>
								<tr><td><div class="note_description"><?php echo $note->description; ?></div></td></tr>
							</table>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php endif; ?>

				<h4 class="heading_title">Attachments</h4>
				<div id="attachments">
					<p>
						<ul>
							<!-- this is where we'll display attachments for tickets -->
						</ul>
					</p>
				</div>

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
									<td class="ticket_property_label">Resolution:</td>
									<td><?php echo form_dropdown('new_resolution_id', $ticket_resolutions, $ticket->resolution_id); ?></td>
								</tr>
								<tr>
									<td class="ticket_property_label">Assigned To:</td>
									<td><?php echo form_dropdown('new_assigned_to_id', $users, $ticket->assigned_to_id); ?></td>
								</tr>
								<tr>
									<td class="ticket_property_label">Tile:</td>
									<td><input type="text" name="new_ticket_title" id="new_ticket_title"  size="60" value="<?php echo $ticket->title ?>" /></td>
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
