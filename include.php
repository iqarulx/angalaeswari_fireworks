<?php
    session_start();

    include("include/label.php");
    include("include/functions.php");
    include("include/validation.php"); 
    
    $obj = new billing();
    $valid = new validation();

    $project_title = "";
    $project_title = $obj->getProjectTitle();

    $view_action = $obj->encode_decode('encrypt', 'View'); $add_action = $obj->encode_decode('encrypt', 'Add');
    $edit_action = $obj->encode_decode('encrypt', 'Edit'); $delete_action = $obj->encode_decode('encrypt', 'Delete');

    // Staff Login
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type'] && $GLOBALS['user_type'] != $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
        }
    }
    $list = array(); $login_factory_id = ""; $login_godown_id = ""; $login_magazine_id = "";
    if(!empty($login_staff_id)) {
        $list = $obj->getTableRecords($GLOBALS['user_table'], 'user_id', $login_staff_id, '');
        if(!empty($list)) {
            foreach($list as $data) {
                if(!empty($data['factory_id'])) {
                    $login_factory_id = $data['factory_id'];
                }
                if(!empty($data['godown_id'])) {
                    $login_godown_id = $data['godown_id'];
                }
                if(!empty($data['magazine_id'])) {
                    $login_magazine_id = $data['magazine_id'];
                }
            }
        }
    }
    if(!empty($login_factory_id) && ($login_factory_id != $GLOBALS['null_value'])) {
        $login_godown_id = $obj->getTableColumnValue($GLOBALS['godown_table'], 'factory_id', $login_factory_id, 'godown_id');
        $login_magazine_id = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'factory_id', $login_factory_id, 'magazine_id');
    }
?>