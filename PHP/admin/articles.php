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
				<div class="box-title">Manage Articles</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="massArticleTable" />
						<table>
							<thead>
								<tr>
									<th><input class="check-all" type="checkbox" /></th>
									<th>Article Title</th>
									<th>Article Link</th>
									<th>Date Created</th>
									<th>last Modified</th>
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
								$query = mysql_query("SELECT article_id, article_title, article_created_on, article_last_update FROM " . $dbtable['articles'] . " ORDER BY article_id DESC");
								while ( $result = mysql_fetch_array($query) ) {
								?>
								<tr>
									<td><input type="checkbox" name="f_ID[]" value="<?php echo $result['article_id']; ?>" /></td>
									<td><?php echo $result['article_title']; ?></td>
									<td><?php echo SITEURL . 'articles.php?id=' . $result['article_id']; ?></td>
									<td><?php echo tanggalIndo($result['article_created_on']); ?></td>
									<td><?php echo tanggalIndo($result['article_last_update']); ?></td>
									<td><a href="articles.php?action=edit&amp;id=<?php echo $result['article_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
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
				<div class="box-title">Edit Article</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="addArticle" />
						<fieldset>
							<p>
								<label for="f_title">Article Title</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" />
							</p>
							<p>
								<label>Article Content</label>
								<div class="shortcuthtml">
									<ul class="panel">
										<li><a onclick="insertTag('<strong>', '</strong>', 'textarea')">Bold</a></li>
										<li><a onclick="insertTag('<em>', '</em>', 'textarea')">Italic</a></li>
										<li class="separator"></li>
										<li><a onclick="insertTag('<h1>', '</h1>', 'textarea')">h1</a></li>
										<li><a onclick="insertTag('<h2>', '</h2>', 'textarea')">h2</a></li>
										<li><a onclick="insertTag('<h3>', '</h3>', 'textarea')">h3</a></li>
										<li><a onclick="insertTag('<h4>', '</h4>', 'textarea')">h4</a></li>
										<li><a onclick="insertTag('<h5>', '</h5>', 'textarea')">h5</a></li>
										<li><a onclick="insertTag('<h6>', '</h6>', 'textarea')">h6</a></li>
										<li class="separator"></li>
										<li><a onclick="insertTag('<p>', '</p>', 'textarea')">Paragraph</a></li>
										<li><a onclick="insertTag('<pre>', '</pre>', 'textarea')">Preformatted</a></li>
										<li class="separator"></li>
										<li><a onclick="insertTag('', '', 'textarea', 'link')">Link</a></li>
										<li><a onclick="insertTag('', '', 'textarea', 'image')">Image</a></li>
									</ul>
								</div>
								<textarea class="text-input textarea" id="textarea" name="f_content" cols="79" rows="15"></textarea>
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
				$query = mysql_query("SELECT article_id, article_title, article_content, article_created_on, article_last_update FROM " .  $dbtable['articles'] . " WHERE article_id = '" . cleanSQL($_GET['id']) . "'");
				$result = mysql_fetch_array($query);
			?>
			<div class="box">
				<div class="box-title">Edit Article</div>
				<div class="box-content">
					<div id="ditatompel_form_result"></div>
					<form id="ditatompel_form">
						<input type="hidden" name="formType" value="editArticle" />
						<input type="hidden" name="f_ID" value="<?php echo $result['article_id']; ?>" />
						<fieldset>
							<p>
								<label for="f_title">Article Title</label>
								<input class="text-input large-input" type="text" id="f_title" name="f_title" value="<?php echo $result['article_title']; ?>" />
							</p>
							<p>
								<label>Article Content</label>
								<div class="shortcuthtml">
									<ul class="panel">
										<li><a onclick="insertTag('<strong>', '<strong>', 'textarea')">Bold</a></li>
										<li><a onclick="insertTag('<em>', '</em>', 'textarea')">Italic</a></li>
										<li class="separator"></li>
										<li><a onclick="insertTag('<h1>', '</h1>', 'textarea')">h1</a></li>
										<li><a onclick="insertTag('<h2>', '</h2>', 'textarea')">h2</a></li>
										<li><a onclick="insertTag('<h3>', '</h3>', 'textarea')">h3</a></li>
										<li><a onclick="insertTag('<h4>', '</h4>', 'textarea')">h4</a></li>
										<li><a onclick="insertTag('<h5>', '</h5>', 'textarea')">h5</a></li>
										<li><a onclick="insertTag('<h6>', '</h6>', 'textarea')">h6</a></li>
										<li class="separator"></li>
										<li><a onclick="insertTag('<p>', '</p>', 'textarea')">Paragraph</a></li>
										<li><a onclick="insertTag('<pre>', '</pre>', 'textarea')">Preformatted</a></li>
										<li class="separator"></li>
										<li><a onclick="insertTag('', '', 'textarea', 'link')">Link</a></li>
										<li><a onclick="insertTag('', '', 'textarea', 'image')">Image</a></li>
									</ul>
								</div>
								<textarea class="text-input textarea" id="textarea" name="f_content" cols="79" rows="15"><?php echo textAreaReturn($result['article_content']); ?></textarea>
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