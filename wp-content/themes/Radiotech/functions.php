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
require_once ABSPATH . '/wp-content/plugins/audiostream/audiostream.php';
	
	$stream = new AudioStream($_POST["param"]);
	$stream->start();
	exit;
}
