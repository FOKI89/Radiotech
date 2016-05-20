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

class radiotech_Main
{

    const CPT_EMISSION = 'emission';
    const CPT_BADGE = 'badge';

    public function init()
    {
        $this->create_CPTs();
        $this->create_taxonomies();
    }

    private function create_CPTs()
    {
        // Register Custom Post Type Emission
        $labels = array(
            'name' => _x(pll__('Emissions'), 'Post Type General Name', 'radiotech'),
            'singular_name' => _x(pll__('Emission'), 'Post Type Singular Name', 'radiotech'),
            'menu_name' => __(pll__('Emissions'), 'radiotech'),
            'name_admin_bar' => __(pll__('Emissions'), 'radiotech'),
            'archives' => __(pll__('Archives d\'émission'), 'radiotech'),
            'parent_item_colon' => __(pll__('Parent de l\'émission'), 'radiotech'),
            'all_items' => __(pll__('Toutes les émissions'), 'radiotech'),
            'add_new_item' => __(pll__('Ajouter une nouvelle émission'), 'radiotech'),
            'add_new' => __(pll__('Ajouter une nouvelle émission'), 'radiotech'),
            'new_item' => __(pll__('Nouvelle émission'), 'radiotech'),
            'edit_item' => __(pll__('Editer l\'émission'), 'radiotech'),
            'update_item' => __(pll__('Mettre à jour l\'émission'), 'radiotech'),
            'view_item' => __(pll__('Voir l\'émission'), 'radiotech'),
            'search_items' => __(pll__('Rechercher une émission'), 'radiotech'),
            'not_found' => __(pll__('Non trouvée'), 'radiotech'),
            'not_found_in_trash' => __(pll__('Non trouvée dans la corbeille'), 'radiotech'),
            'featured_image' => __(pll__('Image d\'illustration'), 'radiotech'),
            'set_featured_image' => __(pll__('Ajouter une image d\'illustration'), 'radiotech'),
            'remove_featured_image' => __(pll__('Retirer l\'image d\'illustration'), 'radiotech'),
            'use_featured_image' => __(pll__('Utiliser comme image d\'illustration'), 'radiotech'),
            'insert_into_item' => __(pll__('Insérer dans les émissions'), 'radiotech'),
            'uploaded_to_this_item' => __(pll__('Uploader pour cet émission'), 'radiotech'),
            'items_list' => __(pll__('Liste des émissions'), 'radiotech'),
            'items_list_navigation' => __(pll__('Liste de la navigation d\'émissions'), 'radiotech'),
            'filter_items_list' => __(pll__('Filtre de la liste d\'émissions'), 'radiotech'),
        );;
        $args = array(
            'label' => __(pll__('Emission'), 'radiotech'),
            'description' => __(pll__('Une émission publiée par un contributeur'), 'radiotech'),
            'labels' => $labels,
            'supports' => array('excerpt', 'author', 'comments', 'editor',),
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
            'singular_name' => _x(pll__('Badge'), 'Post Type Singular Name', 'radiotech'),
            'menu_name' => __(pll__('Badges'), 'radiotech'),
            'name_admin_bar' => __(pll__('Badges'), 'radiotech'),
            'archives' => __(pll__('Archives de badge'), 'radiotech'),
            'parent_item_colon' => __(pll__('Parent de badge'), 'radiotech'),
            'all_items' => __(pll__('Toutes les badges'), 'radiotech'),
            'add_new_item' => __(pll__('Ajouter un nouveau badge'), 'radiotech'),
            'add_new' => __(pll__('Ajouter un nouveau badge'), 'radiotech'),
            'new_item' => __(pll__('Nouveau badge'), 'radiotech'),
            'edit_item' => __(pll__('Editer le badge'), 'radiotech'),
            'update_item' => __(pll__('Mettre à jour le badge'), 'radiotech'),
            'view_item' => __(pll__('Voir le badge'), 'radiotech'),
            'search_items' => __(pll__('Rechercher un badge'), 'radiotech'),
            'not_found' => __(pll__('Non trouvée'), 'radiotech'),
            'not_found_in_trash' => __(pll__('Non trouvée dans la corbeille'), 'radiotech'),
            'featured_image' => __(pll__('Image d\'illustration'), 'radiotech'),
            'set_featured_image' => __(pll__('Ajouter une image d\'illustration'), 'radiotech'),
            'remove_featured_image' => __(pll__('Retirer l\'image d\'illustration'), 'radiotech'),
            'use_featured_image' => __(pll__('Utiliser comme image d\'illustration'), 'radiotech'),
            'insert_into_item' => __(pll__('Insérer dans les badges'), 'radiotech'),
            'uploaded_to_this_item' => __(pll__('Uploader pour cet émission'), 'radiotech'),
            'items_list' => __(pll__('Liste des badges'), 'radiotech'),
            'items_list_navigation' => __(pll__('Liste de la navigation des badges'), 'radiotech'),
            'filter_items_list' => __(pll__('Filtre de la liste de badges'), 'radiotech'),
        );
        $args = array(
            'label' => __(pll__('Emission'), 'radiotech'),
            'description' => __(pll__('Un badge publiée par un contributeur'), 'radiotech'),
            'labels' => $labels,
            'supports' => array('excerpt', 'author', 'comments', 'editor',),
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

    }

    private function create_taxonomies()
    {

    }


}

// Déclaration Class radiotech_Main
$radiotech = new radiotech_Main();
add_action('init', array($radiotech, 'init'), 0);
