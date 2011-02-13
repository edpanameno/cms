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
		<script language="javascript" type="text/javascript" src="js/basic_editor.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				//$("#change_ticket_div").hide();
				$("fieldset ol").hide();
				$("fieldset legend").click(function() {
					$("fieldset ol").slideToggle();
					var $button = $("#submit_note");
					if ($button.attr("value") == "Add Note") {
						$button.attr("value", "Change Ticket");
					}
					else {
						$button.attr("value", "Add Note");
					}
					return false;
				});

				$("#note_focus").click(function() {
					tinymce.execCommand('mceFocus', false, 'text_description')
				});
			});
		</script>

		<style type="text/css">
			#change_ticket_div, .heading_text, #add_note_text {
				margin-left: 35px;
			}

			table.ticket_info, table#note_log {
				width: 90%;
				margin: auto;
				border: 1px solid #9a9b9a;
			}

			/** don't want the hover effect on these tables **/
			table.ticket_info tr:hover td,
			table#note_log tr:hover td,
			#change_ticket_table tr:hover td,
			#table_change_ticket tr:hover td {
				background-color: transparent;
			}

			.odd {
				background-color: #fafafa;
			}

			tr td.note_date {
				font-size: 9pt;
				text-align: right;
				border-bottom: thin solid #ccc;
				border-right: none;
				width: 100%;
			}

			.author_column {
				font-size: 8.5pt;
				vertical-align: top;
				border-right: thin solid #ccc;
				border-bottom: thin solid #ccc;
				padding-top: 5px;
				padding-left: 5px;
			}

			/** spacing between change ticket and add note **/
			.note.heading_text {
				margin-bottom: 5px;
			}

			select {
				font: inherit;
				width: 150px;
			}

			/** formatting for the ticket changes text **/
			div.note_text div.change_message ul {
				padding-left: 2%;
				font-weight: bold;
				font-size: 9.0pt;
				color: #222222;
				list-style-type: square;
			}

			table.ticket_info tr td {
				padding-left: 6px;
				padding-right: 6px;
			}

			table.ticket_info tr td > p {
				margin-top: 9px;
			}

			.note_text {
				margin: 0px 5px;
			}

			/** change ticket **/
			form {
				margin-left: 30px;
			}

			fieldset {
				min-width: 500px;
				width: 56%;
				margin: 0 0 0 0;
				padding: 0 0 5px 0;
				/*border: 1px groove #ccc;*/
				border: 1px dotted #ccc;
				background-color: #F7F6F6;
			}

			legend {
				font-weight: bold;
				font-size: 9pt;
				color: #222;
				margin-left: 10px;
				margin-bottom: 0px;
				padding-bottom: 0px;
			}

			fieldset ol {
				margin: 10px 0 0 0;
				padding-left: 5px;
				list-style: none;
			}

			feildset li {
				float: left;
				width: 100%;
				padding-bottom: 1em;
			}

			label {
				text-align: right;
				vertical-align: middle;
				float: left;
				width: 80px;
				padding-left: 0;
				margin-right: 10px;
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
					<?php if($ticket): ?>
						<?php echo anchor("projects/$ticket->project_id/$project_name", "Project") ?> > <?php echo anchor("projects/$ticket->project_id/$project_name", $humanized_project_name); ?> > <?php echo anchor("projects/$ticket->project_id/$project_name/trac", "Trac"); ?> > #<?php echo $ticket->ticket_id; ?>
					<?php endif; ?>
				</span>
				<ul>
					<li><?php echo anchor("/projects/$ticket->project_id/$project_name/kb/", "KB"); ?></li>
					<li><?php echo anchor("projects/$ticket->project_id/$project_name/trac/new_ticket", "Create Ticket"); ?></li>
					<li><?php echo anchor("/projects/$ticket->project_id/$project_name/trac/$ticket->ticket_id#add_note", "Add Note", array("id" => "note_focus")); ?></li>
				</ul>
			</div>
			<div id="main-content">
				<?php if($ticket): ?>
				<h3 class="heading_text"><?php echo $ticket->title . " (#" . $ticket->ticket_id . ")"; ?></h3> <br />
				<table class="ticket_info">
					<colgroup>
						<col width="25%" />
						<col width="75%" />
					</colgroup>
					<tr>
						<td>Created By</td>
						<td><?php echo $ticket->created_by; ?></td>
					</tr>
					<tr>
						<td>Date Created</td>
						<td><?php echo  date("M d Y - h:i a", strtotime($ticket->date_created)) . ' (' . nice_timespan($ticket->date_created) . ')'; ?></td>
					</tr>
					<tr>
						<td>Assigned To</td>
						<td><?php echo $ticket->assigned_to; ?></td>
					</tr>
					<tr>
						<td>Type</td>
						<td><?php echo $ticket->type; ?></td>
					<tr/>
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
						<td>Date Last Changed</td>
						<td><?php echo date("M d Y - h:i a", strtotime($ticket->last_updated)) . ' (' . nice_timespan($ticket->last_updated) . ')'; ?></td>
					</tr>
					<tr>
						<td>Latest Note Date</td>
						<td>
								<?php
									if(isset($ticket->latest_note_date)) {
										echo date("M d Y - h:i a", strtotime($ticket->latest_note_date)) . ' (' . nice_timespan($ticket->latest_note_date) . ')';
									}
									else {
										echo "n/a";
									}
								?>
						</td>
					</tr>
					<tr>
						<td>Date Resolved</td>
						<td>
								<?php
									if(isset($ticket->date_resolved)) {
										echo date("M d Y - h:i a", strtotime($ticket->date_resolved)) . ' (' . nice_timespan($ticket->date_resolved) . ')'; 
									}
									else {
										echo "n/a";
									}
								?>
						</td>
					</tr>
					<tr>
						<td>Resolved By</td>
						<td>
							<?php
								if(isset($ticket->resolved_by)) {
									echo $ticket->resolved_by; 
								}
								else {
									// This is a bit of a hack, as I am already
									// doing this on the ticket_model, but it's not
									// working
									echo 'n/a';
								}
							?>
						</td>
					</tr>
					<tr style="height: 100px;">
						<td style="vertical-align: top;" colspan="2"><?php echo $ticket->description; ?></td>
					</tr>
				</table>

				<h4 class="heading_text">Ticket Notes</h4>
				<?php if(!$ticket_notes): ?>
					<h4 style="margin-top: 5px; margin-left: 40px; color: grey;">This ticket has no notes</h4>
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
					 <tr style="height: 130px;" class="<?php if(($count % 2) == 0){ echo 'even';} else {echo 'odd';}  ?>">
						<td class="author_column">
							<span><b><?php echo $note->created_by; ?></b></span><br />
							<span style="font-style: italic"><?php echo $note->note_type; ?></span><br />
							<i><?php echo nice_timespan($note->date_created); ?></i><br />
						</td>
						<td style="vertical-align: top;">
							<table width="100%" style="border-style: none">
								<tr style="border-right: none;">
									<td class="note_date">
										<?php echo (date("M d Y - h:i a", strtotime($note->date_created))) . "<a name=\"note$note->note_id\"> | #" . $count++ . " </a>"; ?>
									</td>
								</tr>
								<tr>
									<td style="border-style: none;">
										<div style="margin-top: -5px;" class="note_text"><?php echo $note->description; ?></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				<?php endforeach; ?>
					</table>
				<?php endif; ?>
				<br />
				<form action="projects/<?php echo $ticket->project_id . '/' . $project_name ?>/trac/<?php echo $ticket->ticket_id; ?>/new_note" method="post">
					<div id="change_ticket_div">
					<fieldset>
						<legend id="change_ticket_legend">Change Ticket</legend>
						<ol>
							<li>
								<label for="new_type_id">Type</label>
								<?php echo form_dropdown('new_type_id', $ticket_types, $ticket->type_id); ?>
							</li>
							<li>
								<label for="new_type_id">Type</label>
								<?php echo form_dropdown('new_priority_id', $ticket_priorities, $ticket->priority_id); ?>
							</li>
							<li>
								<label for="new_status_id">Status</label>
								<?php echo form_dropdown('new_status_id', $ticket_statuses, $ticket->status_id); ?>
							</li>
							<li>
								<label for="new_resolution_id">Resolution</label>
								<?php echo form_dropdown('new_resolution_id', $ticket_resolutions, $ticket->resolution_id); ?>
							</li>
							<li>
								<label for="new_assigned_to_id">Assigned To</label>
								<?php echo form_dropdown('new_assigned_to_id', $users, $ticket->assigned_to_id); ?>
							</li>
							<li>
								<label for="new_ticket_title">Title</label>
								<input type="text" name="new_ticket_title" id="new_ticket_title"  size="60" value="<?php echo $ticket->title ?>" />
							</li>
						</ol>
					</fieldset>
					</div>
					<br />
					<a name="add_note"></a>
					<div id="add_note_text">
						<textarea cols="73" rows="10" name="text_description" id="text_description"> </textarea>
						<input id="submit_note" type="submit" name="submit" value="Add Note" />
						<input type="hidden" name="ticket_id" value="<?php echo $ticket->ticket_id; ?>" />
					</div>
				</form>
			<?php else: ?>
				<h4 style="color: red; text-align: center;">Invalid Ticket</h4>
			<?php endif; ?>
			</div>
		<br />
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
