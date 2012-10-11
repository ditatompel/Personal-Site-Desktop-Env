<?php
require_once('../config.php');
require_once('includes/header.php');
?>

<div id="main-content">
	<!-- Article list -->
	<div class="box">
		<div class="box-title">Article List</div>
		<div class="box-content">
			<div id="ditatompel_form_result"></div>
			<form id="ditatompel_form">
				<table>
					<thead>
						<tr>
							<th>Article Title</th>
							<th>Article Link</th>
							<th>Date Created</th>
							<th>last Modified</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$qArticle = mysql_query("SELECT article_id, article_title, article_created_on, article_last_update FROM " . $dbtable['articles'] . " ORDER BY article_id DESC");
						while ( $rArticle = mysql_fetch_array($qArticle) ) {
						?>
						<tr>
							<td><?php echo $rArticle['article_title']; ?></td>
							<td><?php echo SITEURL . 'articles.php?id=' . $rArticle['article_id']; ?></td>
							<td><?php echo tanggalIndo($rArticle['article_created_on']); ?></td>
							<td><?php echo tanggalIndo($rArticle['article_last_update']); ?></td>
							<td><a href="articles.php?action=edit&amp;id=<?php echo $rArticle['article_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
						</tr>
						<?php
						}
						?>
					</tbody>
					
				</table>
			</form>
		</div>
	</div>
	<!-- end article list -->
	
	<!-- file list -->
	<div class="box closed-box">
		<div class="box-title">File List</div>
		<div class="box-content">
			<div id="ditatompel_form_result"></div>
			<form id="ditatompel_form">
				<table>
					<thead>
						<tr>
							<th>File ID</th>
							<th>File Title</th>
							<th>File URL</th>
							<th>File Category</th>
							<th>File MIME Type</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$qFile = mysql_query("SELECT file_id, file_title, file_url, category_id, mimetype_id FROM " .  $dbtable['files'] . " ORDER BY file_id DESC");
						while ( $rFile = mysql_fetch_array($qFile) ) {
						$mimeType = mimeTypeInfo($rFile['mimetype_id']);
						$category = categoryInfo($rFile['category_id']);
						?>
						<tr>
							<td><?php echo $rFile['file_id']; ?></td>
							<td><?php echo $rFile['file_title']; ?></td>
							<td><?php echo $rFile['file_url']; ?></td>
							<td><?php echo $category['title']; ?></td>
							<td><?php echo $mimeType['title']; ?></td>
							<td><a href="files.php?action=edit&amp;id=<?php echo $rFile['file_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
						</tr>
						<?php
						}
						?>
					</tbody>
					
				</table>
			</form>
		</div>
	</div>
	<!-- end file list -->
	
	<!-- Category list -->
	<div class="box column-left">
		<div class="box-title">Category List</div>
		<div class="box-content">
			<div id="ditatompel_form_result"></div>
			<form id="ditatompel_form">
				<input type="hidden" name="formType" value="massCategoryTable" />
				<table>
					<thead>
						<tr>
							<th>Category Title</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$qCategory = mysql_query("SELECT category_id, category_title, category_show FROM " . $dbtable['categories'] . " ORDER BY category_id DESC");
						while ( $rCategory = mysql_fetch_array($qCategory) ) {
							$visible = $rCategory['category_show'] == 'Y' ? 'Active' : 'Inactive';
						?>
						<tr>
							<td><?php echo $rCategory['category_title']; ?></td>
							<td><?php echo $visible; ?></td>
							<td><a href="categories.php?action=edit&amp;id=<?php echo $rCategory['category_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
						</tr>
						<?php
						}
						?>
					</tbody>
					
				</table>
			</form>
		</div>
	</div>
	<!-- end category list -->
	
	<!-- Mimetype list -->
	<div class="box column-right">
		<div class="box-title">Mimetype List</div>
		<div class="box-content">
			<div id="ditatompel_form_result"></div>
			<form id="ditatompel_form">
				<table>
					<thead>
						<tr>
							<th>MIME Type Title</th>
							<th>MIME Type Picture</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$qMime = mysql_query("SELECT mimetype_id, mimetype_title, mimetype_picture FROM " . $dbtable['mimetypes'] . " ORDER BY mimetype_id DESC");
						while ( $rMime = mysql_fetch_array($qMime) ) {
						?>
						<tr>
							<td><?php echo $rMime['mimetype_title']; ?></td>
							<td><?php echo $rMime['mimetype_picture']; ?></td>
							<td><a href="mimetypes.php?action=edit&amp;id=<?php echo $rMime['mimetype_id']; ?>"><img src="images/edit-16.png" alt="Edit" /></a></td>
						</tr>
						<?php
						}
						?>
					</tbody>
					
				</table>
			</form>
		</div>
	</div>
	<!-- end mimetype list -->
	
	<div class="clear"></div>
	
</div>


<?php require_once('includes/sidebar.php'); ?>

</body>
</html>