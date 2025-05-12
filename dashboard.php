<?php 
	$page_title = "Dashboard";
    $dashboard_file_name = "Dashboard";
	include("include_user_check.php");
?>
<?php include "header.php"; ?>

<?php
$access_dashboard = 0;
if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_role_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'role_id');
            if(!empty($login_role_id) && $login_role_id != $GLOBALS['null_value']) {
                $login_role_name = $obj->getTableColumnValue($GLOBALS['role_table'], 'role_id', $login_role_id, 'role_name');
                if(!empty($login_role_name) && $login_role_name != $GLOBALS['null_value']) {
                    $login_role_name = $obj->encode_decode('decrypt', $login_role_name);
                }
            }
            $access_dashboard = $obj->CheckRoleAccessPage($login_role_id, $GLOBALS['dashboard_module']);
        } else {
            $access_dashboard = 1;
        }
    }
}

if(!empty($access_dashboard)) {
    include("dashboard_pending_order_report.php");
    include("dashboard_pending_balance_report.php");
}

include "footer.php"; 
?>