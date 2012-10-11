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
				<div class="box-title">Manage Files</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="massFileTable" />
						<table>
							<thead>
								<tr>
									<th><input class="check-all" type="checkbox" /></th>
									<th>File ID</th>
									<th>File Title</th>
									<th>File URL</th>
									<th>File Category</th>
									<th>File MIME Type</th>
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
								$query = mysql_query("SELECT file_id, file_title, file_url, category_id, mimetype_id FROM " .  $dbtable['files'] . " ORDER BY file_id DESC");
								while ( $result = mysql_fetch_array($query) ) {
								$mimeType = mimeTypeInfo($result['mimetype_id']);
								$category = categoryInfo($result['category_id']);
								?>
								<tr>
									<td><input type="checkbox" name="f_ID[]" value="<?php echo $result['file_id']; ?>" /></td>
									<td><?php echo $result['file_id']; ?></td>
									<td><?php echo $result['file_title']; ?></td>
									<td><?php echo $result['file_url']; ?></td>
									<td><?php echo $category['title']; ?></td>
									<td><?php echo $mimeType['title']; ?></td>
									<td><a href="files.php?action=edit&amp;id=<?php echo $result['file_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
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
				<div class="box-title">Add File</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="addFile" />
						<fieldset class="column-left">
							<p>
								<label for="f_title">File Title</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" />
							</p>
							<p>
								<label for="f_content">File URL</label>
								<input class="text-input large-input" type="text" id="f_content" name="f_content" />
							</p>
						</fieldset>
						<fieldset class="column-right">
							<p>
								<label>Category</label>              
								<select name="f_category" class="medium-input">
									<?php echo generateCategoryOption(); ?>
								</select> 
							</p>
							
							<p>
								<label>MIME Type</label>              
								<select name="f_mime" class="medium-input">
									<?php echo generateMimetypeOption(); ?>
								</select> 
							</p>
							
						</fieldset>
						<div class="clear"></div>
						<p>
							<input id="ditatompel_form_buttonSubmit" class="button" type="submit" value="Submit" />
						</p>
					</form>
				</div>
			</div>
			<?php
			break;
			case 'edit' :
				$query = mysql_query("SELECT file_id, file_title, file_url, category_id, mimetype_id FROM " .  $dbtable['files'] . " WHERE file_id = '" . cleanSQL($_GET['id']) . "'");
				$result = mysql_fetch_array($query);
			?>
			<div class="box">
				<div class="box-title">Edit File</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="editFile" />
						<input type="hidden" name="f_ID" value="<?php echo $result['file_id']; ?>" />
						<fieldset class="column-left">
							<p>
								<label for="f_title">File Title</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" value="<?php echo $result['file_title']; ?>" />
							</p>
							<p>
								<label for="f_content">File URL</label>
								<input class="text-input large-input" type="text" id="f_content" name="f_content" value="<?php echo $result['file_url']; ?>" />
							</p>
						</fieldset>
						<fieldset class="column-right">
							<p>
								<label>Category</label>              
								<select name="f_category" class="medium-input">
									<?php echo generateCategoryOption($result['category_id']); ?>
								</select> 
							</p>
							
							<p>
								<label>MIME Type</label>              
								<select name="f_mime" class="medium-input">
									<?php echo generateMimetypeOption($result['mimetype_id']); ?>
								</select> 
							</p>
							
						</fieldset>
						<div class="clear"></div>
						<p>
							<input id="ditatompel_form_buttonSubmit" class="button" type="submit" value="Submit" />
						</p>
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