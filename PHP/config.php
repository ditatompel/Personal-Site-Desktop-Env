<?php
// Mendefinisikan direktori kerja aplikasi yang kita buat.
if( !defined('ROOT_DIR') ) 
	define('ROOT_DIR', dirname(__FILE__) . "/");

if ( function_exists('date_default_timezone_set') )
	date_default_timezone_set('Asia/Jakarta'); // Indonesia

// production / development
ini_set('display_errors', TRUE);

define('SITENAME', 'Devilzc0de Interactive Class');
define('SITEURL', 'http://devilzc0de.edu/');

/**
 * konfigurasi dan koneksi ke database MySQL
 */
define('DB_HOST', 'localhost'); 				// database server
define('DB_NAME', 'dicoffline_programming'); 	// Nama database
define('DB_USER', 'user');						// database username
define('DB_PASS', 'pass');						// database password

/**
 * Login
 * Username dan password yang digunakan untuk login
 * ke halaman admin
 */
$username = 'devilzc0de';
$password = '51ed580d61e658e75f7dac5a2d1cda76'; // Jayalah Indonesiaku

/**
 * Tabel database yang akan digunakan pada aplikasi
 * yang kita gunakan. ( Array )
 */
$dbtable = array(
	"articles" => "dic_articles",
	"categories" => "dic_categories",
	"files" => "dic_files",
	"mimetypes" => "dic_mimetypes"
);

// format tanggal yang akan kita simpan ke dalam database
$dateFormat = date("Y-m-d H:i:s");

/**
 * Melakukan koneksi ke database
 */
$connectDB = mysql_connect(DB_HOST , DB_USER , DB_PASS);
if(!$connectDB)
	exit("* Unable to connect database!");
mysql_select_db(DB_NAME) OR die ("<br />* Unable to select database!");

// ambil semua fungsi yang telah kita buat
require_once('libs/functions.php');
?>