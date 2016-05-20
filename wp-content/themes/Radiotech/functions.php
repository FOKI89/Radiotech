<?php
/**
 * Radiotech functions and definitions
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Radiotech
 */
/**
 * Sert essentiellement pour forcer les refresh CSS sur les navigateurs quand on livre une nouvelle version
 * TODO : créer une tache gulp pour autoincrement lors du build
 * @var string
 */
define("BUILD_VERSION","00000000001");

/**
 * Init et config du thème
 */
require_once get_template_directory() . '/inc/setup.php';

/**
 * Fonctions utilitaires diverses
 */
require_once get_template_directory() . '/inc/utils.php';

add_action( 'wp_enqueue_scripts', 'add_js_scripts' );
function add_js_scripts() {
	wp_enqueue_script( 'stream', get_template_directory_uri().'/js/stream.js', array('jquery'), '1.0', true );
	// pass Ajax Url to scream.js
	wp_localize_script('stream', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}

add_action( 'wp_ajax_read_stream', 'read_stream' );
add_action( 'wp_ajax_nopriv_read_stream', 'read_stream' );
function read_stream() {
	$param = $_POST['param'];
	$local_file = __DIR__."/".$param;
	$server_file = $param;
	/*
	$ftp_server = "192.168.4.85";
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	$login = ftp_login($ftp_conn, "anonymous", "");


/*	// initiate download
	$d = ftp_nb_get($ftp_conn, $local_file, $server_file, FTP_ASCII);

	while ($d == FTP_MOREDATA)
	  {
	  // do whatever you want
	  // continue downloading
	  $d = ftp_nb_continue($ftp_conn);
	  }

	if ($d != FTP_FINISHED)
	  {
	  echo "Error downloading $server_file";
	  exit(1);
	  }

	// close connection
	ftp_close($ftp_conn);*/
/*
	$fp = @fopen($server_file, 'rb');

	if (!$fp)
	{
	header ("HTTP/1.1 505 Internal server error");
	return;
	}
	$size   = filesize($file); // File size
	$length = $size;           // Content length
	$start  = 0;               // Start byte
	$end    = $size - 1;       // End byte
	header('Content-type: audio/mpeg');
	//header("Accept-Ranges: 0-$length");
	header("Accept-Ranges: bytes");

	if (isset($_SERVER['HTTP_RANGE'])) { 
	    $c_start = $start;
	    $c_end   = $end;
	    list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
	    if (strpos($range, ',') !== false) {
	        header('HTTP/1.1 416 Requested Range Not Satisfiable');
	        header("Content-Range: bytes $start-$end/$size");
	        exit;
	    }
	    if ($range == '-') {
	        $c_start = $size - substr($range, 1);
	    }else{
	        $range  = explode('-', $range);
	        $c_start = $range[0];
	        $c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
	    }
	    $c_end = ($c_end > $end) ? $end : $c_end;
	    if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
	        header('HTTP/1.1 416 Requested Range Not Satisfiable');
	        header("Content-Range: bytes $start-$end/$size");
	        exit;
	    }
	    $start  = $c_start;
	    $end    = $c_end;
	    $length = $end - $start + 1;
	    fseek($fp, $start);
	    header('HTTP/1.1 206 Partial Content');
	}
	header("Content-Range: bytes $start-$end/$size");
	header("Content-Length: ".$length);
	$buffer = 1024 * 8;
	while(!feof($fp) && ($p = ftell($fp)) <= $end) {
	    if ($p + $buffer > $end) {
	        $buffer = $end - $p + 1;
	    }
	    set_time_limit(0);
	    echo fread($fp, $buffer);
	    flush();
	}
	fclose($fp);
	exit();
}
*/
$videostream = new VideoStream($server_file);
$videostream->start();
}