<?php
require_once('../config.php');
require_once('includes/header.php');
?>

<div id="main-content">
	<?php
	if ( isset($_GET['action']) ) {
		switch ($_GET['action']) {
			case 'manage' :
			?>
			<div class="box">
				<div class="box-title">Manage Mimetypes</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="massMIMETable" />
						<table>
							<thead>
								<tr>
									<th><input class="check-all" type="checkbox" /></th>
									<th>MIME Type ID</th>
									<th>MIME Type Title</th>
									<th>MIME Type Picture</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="form-mass-actions">
											<select name="massAction">
												<option value="delete">Delete</option>
											</select>
											<input id="ditatompel_form_buttonSubmit" class="button" type="submit" value="Submit" />
										</div>
										
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
							
							<tbody>
								<?php
								$query = mysql_query("SELECT mimetype_id, mimetype_title, mimetype_picture FROM " . $dbtable['mimetypes'] . " ORDER BY mimetype_id DESC");
								while ( $result = mysql_fetch_array($query) ) {
								?>
								<tr>
									<td><input type="checkbox" name="f_ID[]" value="<?php echo $result['mimetype_id']; ?>" /></td>
									<td><?php echo $result['mimetype_id']; ?></td>
									<td><?php echo $result['mimetype_title']; ?></td>
									<td><?php echo $result['mimetype_picture']; ?></td>
									<td><a href="mimetypes.php?action=edit&amp;id=<?php echo $result['mimetype_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
								</tr>
								<?php
								}
								?>
							</tbody>
							
						</table>
					</form>
				</div>
			</div>
			<?php
			break;
			case 'add' :
			?>
			<div class="box">
				<div class="box-title">Add MIME Type Icon</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="addMIME" />
						<fieldset>
							<p>
								<label for="f_title">MIME Type Name</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" />
							</p>
							<p>
								<label for="f_content">MIME Type File</label>
								<input class="text-input large-input" type="text" id="f_content" name="f_content" />
							</p>
							
							<p>
								<input id="ditatompel_form_buttonSubmit" class="button" type="submit" value="Submit" />
							</p>
						</fieldset>
						<div class="clear"></div>
					</form>
				</div>
			</div>
			<?php
			break;
			case 'edit' :
				$query = mysql_query("SELECT mimetype_id, mimetype_title, mimetype_picture FROM " .  $dbtable['mimetypes'] . " WHERE mimetype_id = '" . cleanSQL($_GET['id']) . "'");
				$result = mysql_fetch_array($query);
			?>
			<div class="box">
				<div class="box-title">Edit MIME Type</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="editMIME" />
						<input type="hidden" name="f_ID" value="<?php echo $result['mimetype_id']; ?>" />
						<fieldset>
							<p>
								<label for="f_title">MIME Type Name</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" value="<?php echo $result['mimetype_title']; ?>" />
							</p>
							<p>
								<label for="f_content">MIME Type File</label>
								<input class="text-input large-input" type="text" id="f_content" name="f_content" value="<?php echo $result['mimetype_picture']; ?>" />
							</p>
							
							<p>
								<input id="ditatompel_form_buttonSubmit" class="button" type="submit" value="Submit" />
							</p>
						</fieldset>
						<div class="clear"></div>
					</form>
				</div>
			</div>
			<?php
			break;
		}
	}
	?>
	
	<div class="clear"></div>
	
</div>


<?php require_once('includes/sidebar.php'); ?>

</body>
</html>