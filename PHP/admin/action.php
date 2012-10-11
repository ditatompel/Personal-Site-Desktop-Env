<?php
require_once('../config.php');

if ( isset($_POST['formType']) ) {
	switch($_POST['formType']) {
		case 'addArticle' :
			if ( empty($_POST['f_title']) || empty($_POST['f_content']) )
				exit('<div class="notification error"><span>All filed are required!</span></div>');
			
			$query = mysql_query("INSERT INTO " . $dbtable['articles'] . " (
				article_title,
				article_content,
				article_created_on,
				article_last_update
			) VALUES (
				'" . netral($_POST['f_title']) . "',
				'" . textArea($_POST['f_content']) . "',
				'" . $dateFormat . "',
				'" . $dateFormat . "'
			)");
			
			exit('<div class="notification success"><span>Succes adding new article</span></div><script type="text/javascript">document.location="articles.php?action=manage";</script>');
		break;
		case 'editArticle' :
			if ( empty($_POST['f_ID']) || empty($_POST['f_title']) || empty($_POST['f_content']) )
				exit('<div class="notification error"><span>All filed are required!</span></div>');
			
			$query = mysql_query("UPDATE " . $dbtable['articles'] . " SET
				article_title = '" . netral($_POST['f_title']) . "',
				article_content = '" . textArea($_POST['f_content']) . "',
				article_last_update = '" . $dateFormat . "'
			WHERE article_id = '" . cleanSQL($_POST['f_ID']) . "'");
			
			exit('<div class="notification success"><span>Succes updating article!</span></div>');
		break;
		
		case 'massArticleTable' :
			if ( isset($_POST['massAction']) ) {
				if ( empty($_POST['f_ID']) )
					exit('<div class="notification attention"><span>No checkbox selected, unable to execute this action!</span></div>');
				switch($_POST['massAction']) {
					case "delete" :
						foreach( $_POST['f_ID'] as $id )
							$query = mysql_query("DELETE FROM " . $dbtable['articles'] . " WHERE article_id = '" . cleanSQL($id) . "'");
						exit('<script type="text/javascript">window.location.reload();</script>');
					break;
				} // end switch($_POST['massAction'])
			}
		break;
		
		/**
		 * Category actions
		 * Insert, update, delete category action here!
		 */
		case 'addCategory' :
			if ( empty($_POST['f_title']) )
				exit('<div class="notification error"><span>Category title is required!</span></div>');
			$isActive = !isset($_POST['f_active']) ? 'N' : 'Y';
			$query = mysql_query("INSERT INTO " . $dbtable['categories'] . " (
				category_title,
				category_show
			) VALUES (
				'" . netral($_POST['f_title']) . "',
				'" . $isActive . "'
			)");
			
			exit('<div class="notification success"><span>Succes adding new category</span></div><script type="text/javascript">document.location="categories.php?action=manage";</script>');
		break;
		case 'editCategory' :
			if ( empty($_POST['f_ID']) || empty($_POST['f_title']) )
				exit('<div class="notification error"><span>Category title is required!</span></div>');
			$isActive = !isset($_POST['f_active']) ? 'N' : 'Y';
			$query = mysql_query("UPDATE " . $dbtable['categories'] . " SET
				category_title = '" . netral($_POST['f_title']) . "',
				category_show = '" . $isActive . "'
			WHERE category_id = '" . cleanSQL($_POST['f_ID']) . "'");
			
			exit('<div class="notification success"><span>Succes updating category!</span></div>');
		break;
		case 'massCategoryTable' :
			if ( isset($_POST['massAction']) ) {
				if ( empty($_POST['f_ID']) )
					exit('<div class="notification attention"><span>No checkbox selected, unable to execute this action!</span></div>');
				switch($_POST['massAction']) {
					case "delete" :
						foreach( $_POST['f_ID'] as $id ) {
							$update = mysql_query("UPDATE " . $dbtable['files'] . " SET category_id = '0' WHERE category_id = '" . cleanSQL($id) . "'");
							$query = mysql_query("DELETE FROM " . $dbtable['categories'] . " WHERE category_id = '" . cleanSQL($id) . "'");
						}
						exit('<script type="text/javascript">window.location.reload();</script>');
					break;
					case "visible" :
						foreach( $_POST['f_ID'] as $id ) {
							$query = mysql_query("UPDATE " . $dbtable['categories'] . " SET category_show = 'Y' WHERE category_id = '" . cleanSQL($id) . "'");
						}
						exit('<script type="text/javascript">window.location.reload();</script>');
					break;
					case "invicible" :
						foreach( $_POST['f_ID'] as $id ) {
							$query = mysql_query("UPDATE " . $dbtable['categories'] . " SET category_show = 'N' WHERE category_id = '" . cleanSQL($id) . "'");
						}
						exit('<script type="text/javascript">window.location.reload();</script>');
					break;
				} // end switch($_POST['massAction'])
			}
		break;
		
		/**
		 * MIME Types actions
		 * Insert, update, delete MIME type action here!
		 */
		case 'addMIME' :
			if ( empty($_POST['f_title']) || empty($_POST['f_content']) )
				exit('<div class="notification error"><span>All fields are required!</span></div>');
			$query = mysql_query("INSERT INTO " . $dbtable['mimetypes'] . " (
				mimetype_title,
				mimetype_picture
			) VALUES (
				'" . netral($_POST['f_title']) . "',
				'" . netral($_POST['f_content']) . "'
			)");
			
			exit('<div class="notification success"><span>Succes adding new MIME type icon!</span></div><script type="text/javascript">document.location="mimetypes.php?action=manage";</script>');
		break;
		case 'editMIME' :
			if ( empty($_POST['f_title']) || empty($_POST['f_content']) )
				exit('<div class="notification error"><span>All fields are required!</span></div>');
			$query = mysql_query("UPDATE " . $dbtable['mimetypes'] . " SET
				mimetype_title = '" . netral($_POST['f_title']) . "',
				mimetype_picture = '" . netral($_POST['f_content']) . "'
			WHERE mimetype_id = '" . cleanSQL($_POST['f_ID']) . "'");
			
			exit('<div class="notification success"><span>Succes updating MIME type icon!</span></div>');
		break;
		case 'massMIMETable' :
			if ( isset($_POST['massAction']) ) {
				if ( empty($_POST['f_ID']) )
					exit('<div class="notification attention"><span>No checkbox selected, unable to execute this action!</span></div>');
				switch($_POST['massAction']) {
					case "delete" :
						foreach( $_POST['f_ID'] as $id ) {
							$update = mysql_query("UPDATE " . $dbtable['files'] . " SET mimetype_id = '0' WHERE mimetype_id = '" . cleanSQL($id) . "'");
							$query = mysql_query("DELETE FROM " . $dbtable['mimetypes'] . " WHERE mimetype_id = '" . cleanSQL($id) . "'");
						}
						exit('<script type="text/javascript">window.location.reload();</script>');
					break;
				} // end switch($_POST['massAction'])
			}
		break;
		
		
		/**
		 * File actions
		 * Insert, update, delete files action here!
		 */
		case 'addFile' :
			if ( empty($_POST['f_title']) || empty($_POST['f_content']) )
				exit('<div class="notification error"><span>File title and File URL is required!</span></div>');
			$query = mysql_query("INSERT INTO " . $dbtable['files'] . " (
				file_title,
				file_url,
				category_id,
				mimetype_id
			) VALUES (
				'" . netral($_POST['f_title']) . "',
				'" . netral($_POST['f_content']) . "',
				'" . cleanSQL($_POST['f_category']) . "',
				'" . cleanSQL($_POST['f_mime']) . "'
				
			)");
			
			exit('<div class="notification success"><span>Succes adding file!</span></div><script type="text/javascript">document.location="files.php?action=manage";</script>');
		break;
		case 'editFile' :
			if ( empty($_POST['f_title']) || empty($_POST['f_content']) )
				exit('<div class="notification error"><span>File title and File URL is required!</span></div>');
			$query = mysql_query("UPDATE " . $dbtable['files'] . " SET
				file_title = '" . netral($_POST['f_title']) . "',
				file_url = '" . netral($_POST['f_content']) . "',
				category_id = '" . cleanSQL($_POST['f_category']) . "',
				mimetype_id = '" . cleanSQL($_POST['f_mime']) . "'
			WHERE file_id = '" . cleanSQL($_POST['f_ID']) . "'");
			
			exit('<div class="notification success"><span>Succes updating File!</span></div>');
		break;
		case 'massFileTable' :
			if ( isset($_POST['massAction']) ) {
				if ( empty($_POST['f_ID']) )
					exit('<div class="notification attention"><span>No checkbox selected, unable to execute this action!</span></div>');
				switch($_POST['massAction']) {
					case "delete" :
						foreach( $_POST['f_ID'] as $id )
							$query = mysql_query("DELETE FROM " . $dbtable['files'] . " WHERE file_id = '" . cleanSQL($id) . "'");
						exit('<script type="text/javascript">window.location.reload();</script>');
					break;
				} // end switch($_POST['massAction'])
			}
		break;
	}
}
?>