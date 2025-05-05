<?php 
	$page_title = "Pending Order Report";

    require_once "include_user_check.php";
    
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

    $current_date = date('Y-m-d');
    $from_date = "";
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    } else {
        $from_date = date('Y-m-d', strtotime('-30 days'));
    }

    $to_date = "";
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    } else {
        $to_date = date('Y-m-d');
    }

    $product_id = "";
    if(isset($_POST['filter_product_id'])) {
        $product_id = $_POST['filter_product_id'];
    }

    $unit_type = "";
    if(isset($_POST['filter_unit_type'])) {
        $unit_type = $_POST['filter_unit_type'];
    } else {
        $unit_type = "1";
    }

    $customer_id = "";
    if(isset($_POST['filter_customer_id'])) {
        $customer_id = $_POST['filter_customer_id'];
    }

    $agent_id = "";
    if(isset($_POST['filter_agent_id'])) {
        $agent_id = $_POST['filter_agent_id'];
    }

    $case_contains = "";
    if(isset($_POST['filter_contains'])) {
        $case_contains = $_POST['filter_contains'];
    }

    $product_subunit_id = ""; $subunit_hide = 1;
    if(!empty($product_id)) {
        $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        if(empty($product_subunit_id) || $product_subunit_id == $GLOBALS['null_value']) {
            $subunit_hide = 0;
        }
    }

    $total_records_list = array();$contains_list = array();
    $product_list = array();
    $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', ''); 

    $total_records_list = $obj->getPendingOrderReport($from_date, $to_date, $unit_type, $product_id, $customer_id, $agent_id,$case_contains);
    
    if(!empty($product_id)){
        if($subunit_hide == '1') {
            $contains_list = $obj->getStockContainsList($product_id);
        }
    }

    $customer_list = array();
    if(!empty($agent_id)) {
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], 'agent_id', $agent_id, '');
    } else {
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', '');
    }
    $agent_list = array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');
?>