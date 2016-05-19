<?php

class radiotech_User
{


    public function init()
    {

    }


    private function upgradeUser($user_id)
    {
        $wp_user_object = new WP_User($user_id);
        $wp_user_object->set_role('contributor');

    }
}
