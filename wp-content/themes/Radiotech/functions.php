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

// Supprime l'admin bar
add_filter('show_admin_bar', '__return_false');


/**
 * Init et config du thème
 */
require_once get_template_directory() . '/inc/setup.php';

/**
 * Fonctions utilitaires diverses
 */
require_once get_template_directory() . '/inc/utils.php';



// Chargement sélectif du js nécessaire au progressive dowload
wp_enqueue_script( 'stream', get_template_directory_uri().'/js/stream.js', array('jquery'), '1.0', true );

add_action( 'wp_enqueue_scripts', 'add_js_scripts' );
function add_js_scripts() {
	// pass Ajax Url to scream.js
	$data_array = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'site_url' => get_site_url()
	);
	//wp_localize_script('stream', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	wp_localize_script('stream', 'data_array', $data_array );
	wp_localize_script('upload', 'ajaxurl', admin_url( 'admin-ajax.php' ));
}

add_action('wp_ajax_upload', 'upload');
add_action('wp_ajax_nopriv_upload', 'upload');
function upload() {
	require_once ABSPATH . '/wp-content/plugins/radiotech/radiotech.php';
	try {
		$response = radiotech_Main::upload(get_current_user_id(), $_FILES['file']['tmp_name']);
	} catch (Exception $ex) {
		http_response_code(500);
		$response = false;
	}
	die(json_encode($response));
}

//pll_register_string('radiotech','Coucou, le monde');
