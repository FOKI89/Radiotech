<?php
/*
Plugin Name: CF7
Description: Manipuler l'affichage et les données d'un formulaire Contact Form 7
Version: 0.0.1
*/
$cf7PluginDir = plugin_dir_path(__FILE__);


add_action("wpcf7_before_send_mail", "action_wpcf7_before_send_mail");
function action_wpcf7_before_send_mail($cf7) {
  $submission = WPCF7_Submission::get_instance();
  $datas = $submission->get_posted_data();
    if(!empty($user_id = get_current_user_id())){
      if(isset($datas["checkbox-newsletter"][0]) && !empty($datas["checkbox-newsletter"][0])){
        add_user_meta( $user_id, 'newsletter', 1);
      }
    }
}


