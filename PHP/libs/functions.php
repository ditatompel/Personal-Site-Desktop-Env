<?php
/**
 * libs/functions.php
 * berisi fungsi2 yang dibutuhkan.
 */

/**
 * Fungsi cek sesi admin
 * nama format nama cookie = md5(sername + nama situs)
 */
function isAdmin() {
	global $username, $password;
	if ( isset($_COOKIE[md5($username . SITENAME)]) && $_COOKIE[md5($username . SITENAME)] == $password )
		return TRUE;
	return FALSE;
}

/**
 * fungsi filter karakter sql injection
 */
function cleanSQL($string) {
	// karakter berbahaya dalam array
	// tambahkan apa yang menturut anda perlu ditambahkan
	$dangers = array("-", "*", "'", "\"", " ", "=", "+", "(", ")", "@","%", "\\");
	foreach ($dangers as $danger)
		$string = str_replace($danger, "", $string);
	return $string;
}

/**
 * Fungsi convert karakter HTML
 * htmlspecialchars : http://php.net/manual/en/function.htmlspecialchars.php
 */
function netral($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br />",$text);
	$text = str_replace("'","&#39;",$text);
	return $text;
}

/**
 * Fungsi decode HTML karakter > Form Fields
 * htmlspecialchars_decode : http://php.net/manual/en/function.htmlspecialchars-decode.php
 */
function resNetral($text) {
	$text = htmlspecialchars_decode($text, ENT_QUOTES);
	$text = str_replace("<br />","\n",$text);
	$text = str_replace("&#39;","'",$text);
	return $text;
}


function textArea($text) {
	$text = str_replace("\\","[backslash]",$text);
	$text = str_replace("'","&#39;",$text);
	return $text;
}
function textAreaReturn($text) {
	$text = str_replace("[backslash]","\\",$text);
	$text = str_replace("&#39;","'",$text);
	return $text;
}

/**
 * Fungsi convert ke tanggal indonesia
 * Tanggal Bulan Tahun Jam
 * http://php.net/manual/en/function.substr.php
 */
function tanggalIndo($tgl){
	$tanggal = substr($tgl, 8, 2);
	$bulan = getBulan(substr($tgl, 5, 2));
	$tahun = substr($tgl, 0, 4);
	$jam = substr($tgl, 11, 8);
	return $tanggal . " " . $bulan . " " . $tahun . " " . $jam;
}

/**
 * Fungsi mengubah angka bulan ke nama bulan
 */
function getBulan($bln) {
	switch ($bln) {
		case 1: return "Jan"; break;
		case 2: return "Feb"; break;
		case 3: return "Mar"; break;
		case 4: return "Apr"; break;
		case 5: return "May"; break;
		case 6: return "Jun"; break;
		case 7: return "Jul"; break;
		case 8: return "Agu"; break;
		case 9: return "Sep"; break;
		case 10: return "Okt"; break;
		case 11: return "Nov"; break;
		case 12: return "Des"; break;
	}
}

/**
 * Fungsi untuk mendapatkan nama file dimana
 * script dieksekusi.
 */
function getCurrentFilename() {
	$paths = explode('/', $_SERVER["SCRIPT_NAME"]);
	return $paths[count($paths) - 1];
}

/**
 * Fungsi untuk mendapatkan posisi halaman ( css class )
 * berdasarkan nama file, dan query string
 */
function navPosition($currentFile, $file, $queryString=NULL) {
	if ( $queryString != NULL ) {
		if ( $currentFile == $file && isset($_GET['action']) && !empty($_GET['action']) ) {
			$cssClass = $_GET['action'] == $queryString ? ' class="current"' : '';
		}
		else {
			$cssClass = $currentFile == $file ? ' class="current"' : '';
		}
	}
	else {
		$cssClass = $currentFile == $file ? ' current' : '';
	}
	return $cssClass;
}

/**
 * Fungsi memunculkan link sebagai downloadable link / tidak
 * http://php.net/manual/en/function.strrpos.php
 */
function windowLink($url, $title) {
	$returnUrl = ' href=\"#\" onclick=\"dita(\'' . $title . '\',\'' . $url . '\')\"';
	$downloadableFile = array("zip", "rar", "tgz", "tar", "gz", "bz", "bz2", "xz", "lzma", "7z", "jar", "cbz", "ar", "pdf");
	$extLength = strrpos($url, ".");
	if (!$extLength)
		$extLength = 0;
	$urlLength = strlen($url) - $extLength;
	$ext = substr($url, $extLength+1, $urlLength);
	if ( in_array($ext, $downloadableFile) ) {
		$returnUrl = ' href=\"' . $url . '\"';
	}
	return $returnUrl;
}

/**
 * Fungsi mengembalikan checkbox form dari nilai ENUM di database
 */
function getActiveCheckbox($yes) {
	return $yes == "Y" ? "checked" : '';
}

/**
 * fungsi untuk membuat form option berdasarkan ID kategori
 */
function generateCategoryOption($id=NULL) {
	global $dbtable;
	$options = '<option value="0">Uncategories</option>';
	if ( $id != NULL) {
		$query = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories'] . " WHERE category_id = '" . cleanSQL($id) . "'");
		if ( mysql_num_rows($query) == 1 ) {
			$result = mysql_fetch_array($query);
			$options .= '<option value="' . $result['category_id'] . '" selected="selected">' . $result['category_title'] . '</option>';
			$query2 = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories'] . " WHERE category_id != '" . $result['category_id'] . "'");
			while ( $result2 = mysql_fetch_array($query2) ) {
				$options .= '<option value="' . $result2['category_id'] . '">' . $result2['category_title'] . '</option>';
			}
		}
		else {
			$query2 = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories'] . " ORDER BY category_id ASC");
			while ( $result2 = mysql_fetch_array($query2) ) {
				$options .= '<option value="' . $result2['category_id'] . '">' . $result2['category_title'] . '</option>';
			}
		}
	}
	else {
		$query = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories']);
		while ( $result = mysql_fetch_array($query) ) {
			$options .= '<option value="' . $result['category_id'] . '">' . $result['category_title'] . '</option>';
		}
	}
	return $options;
}

/**
 * fungsi untuk mendapatkan informasi kategori dari database
 */
function categoryInfo($id) {
	global $dbtable;
	$query = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories'] . " WHERE category_id = '" . cleanSQL($id) . "' LIMIT 1");
	if ( mysql_num_rows($query) != 1 ) {
		return array(
			'id'	=> 0,
			'title'	=> 'Uncategories'
		);
	}
	$result = mysql_fetch_array($query);
	return array(
		'id'	=> $result['category_id'],
		'title'	=> $result['category_title']
	);
}

/**
 * fungsi untuk membuat form option berdasarkan ID Mime Type
 */
function generateMimetypeOption($id=NULL) {
	global $dbtable;
	$options = '<option value="0">Default ( .txt )</option>';
	if ( $id != NULL) {
		$query = mysql_query("SELECT mimetype_id, mimetype_title FROM " . $dbtable['mimetypes'] . " WHERE mimetype_id = '" . cleanSQL($id) . "'");
		if ( mysql_num_rows($query) == 1 ) {
			$result = mysql_fetch_array($query);
			$options .= '<option value="' . $result['mimetype_id'] . '" selected="selected">' . $result['mimetype_title'] . '</option>';
			$query2 = mysql_query("SELECT mimetype_id, mimetype_title FROM " . $dbtable['mimetypes'] . " WHERE mimetype_id != '" . $result['mimetype_id'] . "'");
			while ( $result2 = mysql_fetch_array($query2) ) {
				$options .= '<option value="' . $result2['mimetype_id'] . '">' . $result2['mimetype_title'] . '</option>';
			}
		}
		else {
			$query2 = mysql_query("SELECT mimetype_id, mimetype_title FROM " . $dbtable['mimetypes'] . " ORDER BY mimetype_id ASC");
			while ( $result2 = mysql_fetch_array($query2) ) {
				$options .= '<option value="' . $result2['mimetype_id'] . '">' . $result2['mimetype_title'] . '</option>';
			}
		}
	}
	else {
		$query = mysql_query("SELECT mimetype_id, mimetype_title FROM " . $dbtable['mimetypes']);
		while ( $result = mysql_fetch_array($query) ) {
			$options .= '<option value="' . $result['mimetype_id'] . '">' . $result['mimetype_title'] . '</option>';
		}
	}
	return $options;
}

/**
 * fungsi untuk mendapatkan informasi Mime Type dari database
 */
function mimeTypeInfo($id) {
	global $dbtable;
	$query = mysql_query("SELECT mimetype_id, mimetype_title, mimetype_picture FROM " . $dbtable['mimetypes'] . " WHERE mimetype_id = '" . cleanSQL($id) . "' LIMIT 1");
	if ( mysql_num_rows($query) != 1 ) {
		return array(
			'id'	=> 0,
			'title'	=> 'Default ( .txt )',
			'link'	=> 'txt.png'
		);
	}
	$result = mysql_fetch_array($query);
	return array(
		'id'	=> $result['mimetype_id'],
		'title'	=> $result['mimetype_title'],
		'link'	=> $result['mimetype_picture']
	);
}
?>
