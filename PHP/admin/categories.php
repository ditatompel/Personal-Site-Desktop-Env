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
				<div class="box-title">Manage Categories</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="massCategoryTable" />
						<table>
							<thead>
								<tr>
									<th><input class="check-all" type="checkbox" /></th>
									<th>Category ID</th>
									<th>Category Title</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="form-mass-actions">
											<select name="massAction">
												<option value="visible">Show</option>
												<option value="invicible">Do Not Show</option>
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
								$query = mysql_query("SELECT category_id, category_title, category_show FROM " . $dbtable['categories'] . " ORDER BY category_id DESC");
								while ( $result = mysql_fetch_array($query) ) {
									$visible = $result['category_show'] == 'Y' ? 'Active' : 'Inactive';
								?>
								<tr>
									<td><input type="checkbox" name="f_ID[]" value="<?php echo $result['category_id']; ?>" /></td>
									<td><?php echo $result['category_id']; ?></td>
									<td><?php echo $result['category_title']; ?></td>
									<td><?php echo $visible; ?></td>
									<td><a href="categories.php?action=edit&amp;id=<?php echo $result['category_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
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
				<div class="box-title">Add Category</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="addCategory" />
						<fieldset class="column-left">
							<p>
								<label for="f_title">Category Title</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" />
							</p>
						</fieldset>
						<fieldset class="column-right">
							<p>
								<label for="f_active">Show to Visitors</label>
								<input type="checkbox" name="f_active" id="f_active" checked/> Yes
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
				$query = mysql_query("SELECT category_id, category_title, category_show FROM " .  $dbtable['categories'] . " WHERE category_id = '" . cleanSQL($_GET['id']) . "'");
				$result = mysql_fetch_array($query);
				$visible = getActiveCheckbox($result['category_show']);
			?>
			<div class="box">
				<div class="box-title">Edit Category</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="editCategory" />
						<input type="hidden" name="f_ID" value="<?php echo $result['category_id']; ?>" />
						<fieldset class="column-left">
							<p>
								<label for="f_title">Article Title</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" value="<?php echo $result['category_title']; ?>" />
							</p>
						</fieldset>
						<fieldset class="column-right">
							<p>
								<label for="f_active">Show to Visitors</label>
								<input type="checkbox" name="f_active" id="f_active" <?php echo $visible; ?>/> Yes
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