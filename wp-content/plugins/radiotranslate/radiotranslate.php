<?php
/*
Plugin Name: RadioTranslate
Description: Regroupe les traductions du site
Version: 0.0.1
*/
$radiotranslatePluginDir = plugin_dir_path(__FILE__);	

add_action('plugins_loaded', 'action_register_string');
function action_register_string() {
	if (function_exists('pll_register_string')) { 
		/* Emission */
		pll_register_string('radiotech','Emission');
		pll_register_string('radiotech','Emissions');
		pll_register_string('radiotech','Archives d\'émission');
		pll_register_string('radiotech','Parent de l\'émission');
		pll_register_string('radiotech','Toutes les émissions');
		pll_register_string('radiotech','Ajouter une nouvelle émission');
		pll_register_string('radiotech','Nouvelle émission');
		pll_register_string('radiotech','Editer l\'émission');
		pll_register_string('radiotech','Mettre à jour l\'émission');
		pll_register_string('radiotech','Voir l\'émission');
		pll_register_string('radiotech','Rechercher une émission');
		pll_register_string('radiotech','Non trouvée');
		pll_register_string('radiotech','Non trouvée dans la corbeille');
		pll_register_string('radiotech','Image d\'illustration');
		pll_register_string('radiotech','Ajouter une image d\'illustration');
		pll_register_string('radiotech','Retirer l\'image d\'illustration');
		pll_register_string('radiotech','Utiliser comme image d\'illustration');
		pll_register_string('radiotech','Insérer dans les émissions');
		pll_register_string('radiotech','Uploader pour cette émission');
		pll_register_string('radiotech','Liste des émissions');
		pll_register_string('radiotech','Liste de la navigation d\'émissions');
		pll_register_string('radiotech','Filtre de la liste d\'émissions');
		pll_register_string('radiotech','Une émission publiée par un contributeur');
		/* Badge */
		pll_register_string('radiotech','Badge');
		pll_register_string('radiotech','Badges');
		pll_register_string('radiotech','Archives de badge');
		pll_register_string('radiotech','Parent de badge');
		pll_register_string('radiotech','Tous les badges');
		pll_register_string('radiotech','Ajouter un nouveau badge');
		pll_register_string('radiotech','Nouveau badge');
		pll_register_string('radiotech','Editer le badge');
		pll_register_string('radiotech','Mettre à jour le badge');
		pll_register_string('radiotech','Voir le badge');
		pll_register_string('radiotech','Rechercher un badge');
		pll_register_string('radiotech','Non trouvé');
		pll_register_string('radiotech','Non trouvé dans la corbeille');
		pll_register_string('radiotech','Image d\'illustration');
		pll_register_string('radiotech','Ajouter une image d\'illustration');
		pll_register_string('radiotech','Retirer l\'image d\'illustration');
		pll_register_string('radiotech','Utiliser comme image d\'illustration');
		pll_register_string('radiotech','Insérer dans les badges');
		pll_register_string('radiotech','Uploader pour cette émission');
		pll_register_string('radiotech','Liste des badges');
		pll_register_string('radiotech','Liste de la navigation des badges');
		pll_register_string('radiotech','Filtre de la liste des badges');
		pll_register_string('radiotech','Un badge publié par un contributeur');
	}
}

?>