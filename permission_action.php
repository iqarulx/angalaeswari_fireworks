<?php
    if(!empty($loginner_id) && !empty($permission_module) && !empty($permission_action)) {
        $access_page_permission = 0;
        $access_page_permission = $obj->CheckStaffAccessPage($loginner_id, $permission_module);
        if(!empty($access_page_permission) && $access_page_permission == 1) {
            $user_list = array();
            $user_list = $obj->getTableRecords($GLOBALS['user_table'], 'user_id', $loginner_id, '');
            if(!empty($user_list)) {
                foreach($user_list as $user) {
                    if(!empty($user['access_pages'])) {
                        $access_pages = explode(",", $user['access_pages']);
                    }
                    if(!empty($user['access_page_actions'])) {
                        $access_page_actions = explode(",", $user['access_page_actions']);
                    }
                }
            }
            $module_action = array(); $permission_module_encrypted = $obj->encode_decode('encrypt', $permission_module);
            if(!empty($access_pages)) {
                for($i = 0; $i < count($access_pages); $i++) {
                    if(!empty($access_pages[$i]) && $permission_module_encrypted == $access_pages[$i]) {
                        if(!empty($access_page_actions[$i])) {
                            $module_action = explode("$$$", $access_page_actions[$i]);
                        }
                    }
                }
            }
            
            if(!empty($module_action)) {
                if(!in_array($permission_action, $module_action)) {
                    if($permission_action == $view_action) {
                        $view_access_error = "You don't get permission to view ".strtolower($permission_module);
                    }
                    else if($permission_action == $add_action) {
                        $add_access_error = "You don't get permission to add ".strtolower($permission_module);
                    }
                    else if($permission_action == $edit_action) {
                        $edit_access_error = "You don't get permission to edit ".strtolower($permission_module);
                    }
                    else if($permission_action == $delete_action) {
                        $delete_access_error = "You don't get permission to delete ".strtolower($permission_module);
                    }
                }
            }
        }
    }
?>