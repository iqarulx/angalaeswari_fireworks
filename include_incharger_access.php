<?php 

    $login_user_factory_id = "";
    $login_user_godown_id = "";
    $login_user_magazine_id = "";

    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_factory_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_factory_id'])) {
                $login_user_factory_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_factory_id'];
            }
            if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_godown_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_godown_id'])) {
                $login_user_godown_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_godown_id'];
            }
            if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_magazine_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_magazine_id'])) {
                $login_user_magazine_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_magazine_id'];
            }
        }
    }