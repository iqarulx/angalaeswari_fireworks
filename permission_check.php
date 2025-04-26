<?php
    if(!empty($loginner_id) && !empty($permission_module)) {
        $access_page_permission = 0;					
        $access_page_permission = $obj->CheckStaffAccessPage($loginner_id, $permission_module);
        if(empty($access_page_permission)) {
            header("Location:dashboard.php");
            exit;
        }
        else if($GLOBALS['user_type'] == $GLOBALS['magazine_user_type']) {
            if($permission_module == $GLOBALS['factory_module'] || $permission_module == $GLOBALS['godown_module'] || $permission_module == $GLOBALS['inward_entry_module'] || $permission_module == $GLOBALS['consumption_entry_module'] || $permission_module == $GLOBALS['semifinished_entry_module']) {
                header("Location:dashboard.php");
                exit;
            }
        }
        else if($GLOBALS['user_type'] == $GLOBALS['godown_user_type']) {
            if($permission_module == $GLOBALS['factory_module'] || $permission_module == $GLOBALS['magazine_module'] || $permission_module == $GLOBALS['daily_production_module'] || $permission_module == $GLOBALS['performa_invoice_module'] || $permission_module == $GLOBALS['estimate_module'] || $permission_module == $GLOBALS['sales_invoice_module']) {
                header("Location:dashboard.php");
                exit;
            }
        }
    }
?>