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
				height: 100px;
				border-collapse: collapse;
			}

			table#change_ticket_info td.ticket_property_label {
				text-align: right;
			}

			/*td.ticket_property_label {
				text-align: right;
				border: 1px red dashed;
			}*/

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

			#changelog, #attachments, textarea {
				width: 85%;
				margin: auto;
				/*border: 1px solid #9a9b9a;*/
				border: 1px solid #d7d7d7;
			}

			fieldset {
				width: 50%;
				margin-left: 8%;
				border: 1px solid #9a9b9a;
			}

			div.comment_heading {
				/*margin-top: 10px;*/
				margin-left: auto;
				margin-right: auto;
				/*width: 97%;*/
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

			#change_ticket.heading_title.collapsed {
				background: url("images/collapsed.png") no-repeat 0px 50%;
				padding-left: 16px;
			}

			#change_ticket.heading_title.expanded {
				background: url("images/expanded.png") no-repeat 0px 50%;
				padding-left: 16px;
			}
			.comment_text {
				/*border: 1px dashed red;*/
				/*margin-top: -10px;*/
				margin-bottom: 2%;
				margin-left: 10px;
				/*margin-right: 20px;*/
				/*border-bottom: 1px solid #d7d7d7;*/
			}

			.comment_text > p {
				/*border: 1px red dashed;*/
				margin-top: 10px;
			}

			#add_note_text {
				/*border: 1px red dashed;*/
				margin-left: 8%;
				width: 65%;
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
					<li><a href="#">Create Note</a></li>
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

				<h4 class="heading_title">Attachments</h4>
				<div id="attachments">
					<p>
						<ul>
							<li>Ticket ITem one</li>
							<li>Ticket item 3</li>
						</ul>
					</p>
				</div>

				<h4 class="heading_title">Comments</h4>
				<div id="changelog">
				<?php if(!$ticket_notes): ?>
					<h5 style="color: red;">This ticket has not notes</h5>
					<?php else: ?>
						<?php foreach($ticket_notes as $note): ?>
						<div class="comment">
							<div class="comment_heading">
								<?php echo $note->note_type . ' by ' . $note->created_by; ?>
								<div class="comment_misc"><?php echo date("M d Y @ h:i a", strtotime($note->date_created)); ?></div>
							</div>
							<div class="comment_text"><?php echo $note->description; ?></div> 
						</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<h4 id="change_ticket" class="heading_title collapsed">Change Ticket</h4>
				<form action="projects/<?php echo $ticket->project_id . '/' . $project_name ?>/trac/<?php echo $ticket->ticket_id; ?>/new_note" method="post">
				<div id="change_ticket_div">
					<fieldset>
						<legend>Change Properties</legend>
						<table id="change_ticket_info">
							<tr>
								<td class="ticket_property_label">Type:</td>
								<td>
									<?php echo form_dropdown('type_id', $ticket_types, $ticket->type_id); ?>
								</td>
							</tr>
							<tr>
								<td class="ticket_property_label">Priority:</td>
								<td>
									<?php echo form_dropdown('priority_id', $ticket_priorities, $ticket->priority_id); ?>
								</td>
							</tr>
							<tr>
								<td class="ticket_property_label">Status:</td>
								<td>
									<?php echo form_dropdown('status_id', $ticket_statuses, $ticket->status_id); ?>
								</td>
							</tr>
							<tr>
								<td class="ticket_property_label">Tile:</td>
								<td><input type="text" size="60" value="<?php echo $ticket->title; ?>" /></td>
							</tr>
							<tr>
								<td class="ticket_note_label">Note:</td>
								<td><textarea cols="80" rows="30" name="note_description" id="note_description"> </textarea></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="submit" value="Change Ticket" />
								</td>
							</tr> 
						</table>
					</fieldset>
				</div>
				<h4 id="add_note" class="heading_title">Add a Note</h4>
				<div id="add_note_text">
					<textarea cols="30" rows="13" name="text_description" id="text_description"> </textarea>
					<input type="submit" name="submit" value="Add Note" />
				</div>
				<input type="hidden" name="ticket_id" value="<?php echo $ticket->ticket_id; ?>" />
				</form>
			</div>
		<br />
		</div>
		<div id="footer"><?php $this->load->view("common/footer_view"); ?></div>
    </body>
</html>
