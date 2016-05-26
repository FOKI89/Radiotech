<?php
/*
Plugin Name: Radiotech
Plugin URI: http://www.radiotech.fr/
Description: Regroupe les adaptations BO et les fonctionnalités spécifique développées pour le site Radiotech. Indispensable à son bon fonctionnement!
Author: Magnetic
Author URI: http://www.magnetic.coop
Version: 0.0.1
*/
$radiotechPluginDir = plugin_dir_path(__FILE__);
require_once __DIR__ . '/RadiotechUploader.php';

class radiotech_Main
{
    const FTP_HOST = '192.168.4.92';
    const FTP_USER = 'anonymous';
    const FTP_PASWWORD = '';

    const CPT_EMISSION = 'emission';
    const CPT_BADGE = 'badge';
    const CPT_PUB = 'publicite';

    /**
     * @var RadiotechUploader
     */
    private static $uploader;

    public function init()
    {
        $this->create_CPTs();
        $this->create_taxonomies();
        static::$uploader = new RadiotechUploader(self::FTP_HOST, self::FTP_USER, self::FTP_PASWWORD);
        $this->add_option_page();

    }

    private function create_CPTs()
    {
        // Register Custom Post Type Emission
        $labels = array(
            'name' => _x('Emissions', 'Post Type General Name', 'radiotech'),
            'singular_name' => _x('Emission', 'Post Type Singular Name', 'radiotech'),
            'menu_name' => __('Emissions', 'radiotech'),
            'name_admin_bar' => __('Emissions', 'radiotech'),
            'archives' => __('Archives d\'émission', 'radiotech'),
            'parent_item_colon' => __('Parent de l\'émission', 'radiotech'),
            'all_items' => __('Toutes les émissions', 'radiotech'),
            'add_new_item' => __('Ajouter une nouvelle émission', 'radiotech'),
            'add_new' => __('Ajouter une nouvelle émission', 'radiotech'),
            'new_item' => __('Nouvelle émission', 'radiotech'),
            'edit_item' => __('Editer l\'émission', 'radiotech'),
            'update_item' => __('Mettre à jour l\'émission', 'radiotech'),
            'view_item' => __('Voir l\'émission', 'radiotech'),
            'search_items' => __('Rechercher une émission', 'radiotech'),
            'not_found' => __('Non trouvée', 'radiotech'),
            'not_found_in_trash' => __('Non trouvée dans la corbeille', 'radiotech'),
            'featured_image' => __('Image d\'illustration', 'radiotech'),
            'set_featured_image' => __('Ajouter une image d\'illustration', 'radiotech'),
            'remove_featured_image' => __('Retirer l\'image d\'illustration', 'radiotech'),
            'use_featured_image' => __('Utiliser comme image d\'illustration', 'radiotech'),
            'insert_into_item' => __('Insérer dans les émissions', 'radiotech'),
            'uploaded_to_this_item' => __('Uploader pour cet émission', 'radiotech'),
            'items_list' => __('Liste des émissions', 'radiotech'),
            'items_list_navigation' => __('Liste de la navigation d\'émissions', 'radiotech'),
            'filter_items_list' => __('Filtre de la liste d\'émissions', 'radiotech'),
        );;
        $args = array(
            'label' => __('Emission', 'radiotech'),
            'description' => __('Une émission publiée par un contributeur', 'radiotech'),
            'labels' => $labels,
            'supports' => array('editor', 'title', 'thumbnail',),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-album',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
        );

        register_post_type(self::CPT_EMISSION, $args);

        // Register Custom Post Type Badges
        $labels = array(
            'name' => _x('Badges', 'Post Type General Name', 'radiotech'),
            'singular_name' => _x('Badge', 'Post Type Singular Name', 'radiotech'),
            'menu_name' => __('Badges', 'radiotech'),
            'name_admin_bar' => __('Badges', 'radiotech'),
            'archives' => __('Archives de badge', 'radiotech'),
            'parent_item_colon' => __('Parent de badge', 'radiotech'),
            'all_items' => __('Toutes les badges', 'radiotech'),
            'add_new_item' => __('Ajouter un nouveau badge', 'radiotech'),
            'add_new' => __('Ajouter un nouveau badge', 'radiotech'),
            'new_item' => __('Nouveau badge', 'radiotech'),
            'edit_item' => __('Editer le badge', 'radiotech'),
            'update_item' => __('Mettre à jour le badge', 'radiotech'),
            'view_item' => __('Voir le badge', 'radiotech'),
            'search_items' => __('Rechercher un badge', 'radiotech'),
            'not_found' => __('Non trouvée', 'radiotech'),
            'not_found_in_trash' => __('Non trouvée dans la corbeille', 'radiotech'),
            'featured_image' => __('Image d\'illustration', 'radiotech'),
            'set_featured_image' => __('Ajouter une image d\'illustration', 'radiotech'),
            'remove_featured_image' => __('Retirer l\'image d\'illustration', 'radiotech'),
            'use_featured_image' => __('Utiliser comme image d\'illustration', 'radiotech'),
            'insert_into_item' => __('Insérer dans les badges', 'radiotech'),
            'uploaded_to_this_item' => __('Uploader pour cet émission', 'radiotech'),
            'items_list' => __('Liste des badges', 'radiotech'),
            'items_list_navigation' => __('Liste de la navigation des badges', 'radiotech'),
            'filter_items_list' => __('Filtre de la liste de badges', 'radiotech'),
        );
        $args = array(
            'label' => __('Emission', 'radiotech'),
            'description' => __('Un badge publiée par un contributeur', 'radiotech'),
            'labels' => $labels,
            'supports' => array('author', 'editor', 'title', 'thumbnail'),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-awards',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type(self::CPT_BADGE, $args);

        // Register Custom Post Type Publicités
        $labels = array(
            'name' => _x('Publicités', 'Post Type General Name', 'radiotech'),
            'singular_name' => _x('Publicité', 'Post Type Singular Name', 'radiotech'),
            'menu_name' => __('Publicités', 'radiotech'),
            'name_admin_bar' => __('Publicités', 'radiotech'),
            'archives' => __('Archives de publicité', 'radiotech'),
            'parent_item_colon' => __('Parent de publicité', 'radiotech'),
            'all_items' => __('Toutes les publicités', 'radiotech'),
            'add_new_item' => __('Ajouter une nouvelle publicité', 'radiotech'),
            'add_new' => __('Ajouter une nouvelle publicité', 'radiotech'),
            'new_item' => __('Nouvelle publicité', 'radiotech'),
            'edit_item' => __('Editer la publicité', 'radiotech'),
            'update_item' => __('Mettre à jour la publicité', 'radiotech'),
            'view_item' => __('Voir la publicité', 'radiotech'),
            'search_items' => __('Rechercher une publicité', 'radiotech'),
            'not_found' => __('Non trouvée', 'radiotech'),
            'not_found_in_trash' => __('Non trouvée dans la corbeille', 'radiotech'),
            'featured_image' => __('Image d\'illustration', 'radiotech'),
            'set_featured_image' => __('Ajouter une image d\'illustration', 'radiotech'),
            'remove_featured_image' => __('Retirer l\'image d\'illustration', 'radiotech'),
            'use_featured_image' => __('Utiliser comme image d\'illustration', 'radiotech'),
            'insert_into_item' => __('Insérer dans les publicités', 'radiotech'),
            'uploaded_to_this_item' => __('Uploader pour ce publicité', 'radiotech'),
            'items_list' => __('Liste des publicités', 'radiotech'),
            'items_list_navigation' => __('Liste de la navigation des publicités', 'radiotech'),
            'filter_items_list' => __('Filtre de la liste des publicités', 'radiotech'),
        );
        $args = array(
            'label' => __('Publicité', 'radiotech'),
            'description' => __('Une publicité', 'radiotech'),
            'labels' => $labels,
            'supports' => array('title', 'thumbnail'),
            'taxonomies' => array(''),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-star-empty',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type(self::CPT_PUB, $args);

    }

    private function create_taxonomies()
    {

    }

    private function add_option_page()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'title' => 'Gestion des publicités',
                'parent' => 'themes.php',
                'capability' => 'manage_options'
            ));
        }
    }

    public function upgradeUser($user_id)
    {
        // Permet d'upgrader les droits des utilisateurs qui s'inscrivent pour avoir accès aux emissions.
        $wp_user_object = new WP_User($user_id);
        $wp_user_object->set_role('contributor');
    }
    
    public static function upload($user_id, $file)
    {
        return static::$uploader->upload($user_id, $file);
    }

    public function initialisation_metaboxes()
    {
        //on utilise la fonction add_metabox() pour initialiser une metabox
        add_meta_box('box_upload_emission', 'Uploader une emission', array($this, 'box_upload_emission'), self::CPT_EMISSION, 'normal', 'high', null);
    }

    public function box_upload_emission()
    {
        //$val = get_post_meta($post->ID,'_emission_path',true);
        echo '<label for="upload_emission">Uploader une Emission : </label>';
        echo '<input id="upload_emission" type="file" name="upload_emission" accept="audio/*"/>';
    }

    public function save_emission($post_ID){
        // si la metabox est définie, on sauvegarde sa valeur
       if(isset($_POST['upload_emission'])){
            update_post_meta($post_ID,'_emission_path', esc_html($_POST['upload_emission']));
       }
    }

}
// Déclaration Class radiotech_Main
$radiotech = new radiotech_Main();
add_action('init', array($radiotech, 'init'), 0);
add_action('um_after_user_is_approved', array($radiotech, 'upgradeUser'), 10);
add_action('add_meta_boxes', array($radiotech, 'initialisation_metaboxes'), 10);
add_action('save_post',array($radiotech, 'save_emission'), 10);
