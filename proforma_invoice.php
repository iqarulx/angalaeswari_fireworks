<?php 
	$page_title = "Proforma Invoice";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['proforma_invoice_module'];
            include("permission_check.php");
        }
    }
    
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');

    $cancelled_bill = ""; $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['proforma_invoice_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);

    $customer_list = array();
    $customer_list = $obj->getCustomerList();

    $agent_list = array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'],'','','');

    $transport_list = array();
    $transport_list = $obj->getTableRecords($GLOBALS['transport_table'],'','','');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script src="include/js/creation_modules.js"></script>
    <script src="include/js/proforma_invoice.js"></script>
    <script src="include/js/common.js"></script>
    <style>
        .tooltip-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
            /* font-weight: bold; */
        }

        .tooltip-text {
            position: fixed;
            bottom: auto;
            left: auto;
            top: 0;
            right: 0;

            visibility: hidden;
            max-width: 300px;
            max-height: 200px;
            overflow-y: auto;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 6px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s;
            white-space: normal;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .tooltip-container:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translate(-50%, -100%);
        }
    </style>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form name="table_listing_form" method="post">
                        <div class="card">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box" id="table_records_cover">
                                <div class="card-header align-items-center">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-2 col-md-3 col-6">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" name="from_date" class="form-control shadow-none" placeholder="" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" required="">
                                                    <label>From Date</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" class="form-control shadow-none" name="to_date" placeholder="" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" required="">
                                                    <label>To Date</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger" name="agent_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:table_listing_records_filter();getAgentCustomerList(this.value);">
                                                        <option value="">Select</option>
                                                        <?php if (!empty($agent_list)) {
                                                            foreach ($agent_list as $data) { ?>
                                                                <option value="<?php if (!empty($data['agent_id'])) {
                                                                    echo $data['agent_id'];
                                                                } ?>" <?php if(!empty($agent_id) && $agent_id == $data['agent_id']) { echo "selected"; } ?>>
                                                                    <?php if (!empty($data['name_mobile_city'])) {
                                                                        echo html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
                                                                    } ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <label>Agent</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                                           <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger" name="customer_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:table_listing_records_filter();">
                                                        <option value="">Select</option>
                                                        <?php if (!empty($customer_list)) {
                                                            foreach ($customer_list as $customer) { ?>
                                                                <option value="<?php if (!empty($customer['customer_id'])) {
                                                                    echo $customer['customer_id'];
                                                                } ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { echo "selected"; } ?>>
                                                                    <?php if (!empty($customer['name_mobile_city'])) {
                                                                        echo html_entity_decode($obj->encode_decode('decrypt', $customer['name_mobile_city']));
                                                                    } ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <label>Customer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                                           <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger" name="transport_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:table_listing_records_filter();">
                                                        <option value="">Select</option>
                                                        <?php if (!empty($transport_list)) {
                                                            foreach ($transport_list as $data) { ?>
                                                                <option value="<?php if (!empty($data['transport_id'])) {
                                                                    echo $data['transport_id'];
                                                                } ?>" <?php if(!empty($transport_id) && $transport_id == $data['transport_id']) { echo "selected"; } ?>>
                                                                    <?php if (!empty($data['transport_name'])) {
                                                                        echo html_entity_decode($obj->encode_decode('decrypt', $data['transport_name']));
                                                                    } ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <label>Transport</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                                            <div class="input-group">
                                                <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search By No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div>
                                        <?php
                                            $add_access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $add_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($add_access_error)) { 
                                        ?>
                                            <div class="col-lg-12 col-md-2 col-6 text-end">
                                                <?php if(!empty($cancelled_count)) { ?>
                                                    <button class="btn btn-dark m-1" id='show_button' style="font-size:11px;" type="button" onclick="Javascript:assign_bill_value();">Show Inactive Bill</button>
                                                <?php } ?>
                                                <button class="btn btn-primary" style="font-size:11px;" type="button" onClick="openPdf();"> <i class="fa fa-print"></i> Print </button>
                                                <button class="btn btn-danger m-1 " style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                            </div>
                                        <?php } ?>
                                        <form name="table_listing_form" method="post">
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                                <input type="hidden" name='show_bill' value="0" id='show_bill'>
                                            </div>	
                                        </form>
                                    </div>
                                </div>
                                <div id="table_listing_records"></div>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>  
        </div>
    </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#proformainvoice").addClass("active");
        table_listing_records_filter();
    });

    function openPdf() {
        var from_date = "";
        var to_date = "";
        var agent_id = "";
        var customer_id = "";
        var transport_id = "";
        var search_text = "";
        var show_bill = "";

        if(jQuery('input[name="from_date"]').length > 0) {
            from_date = jQuery('input[name="from_date"]').val();
        }
        if(jQuery('input[name="to_date"]').length > 0) {
            to_date = jQuery('input[name="to_date"]').val();
        }
        if(jQuery('select[name="agent_id"]').length > 0) {
            agent_id = jQuery('select[name="agent_id"]').val();
        }
        if(jQuery('select[name="customer_id"]').length > 0) {
            customer_id = jQuery('select[name="customer_id"]').val();
        }
        if(jQuery('select[name="transport_id"]').length > 0) {
            transport_id = jQuery('select[name="transport_id"]').val();
        }
        if(jQuery('input[name="search_text"]').length > 0) {
            search_text = jQuery('input[name="search_text"]').val();
        }
        if(jQuery('input[name="show_bill"]').length > 0) {
            show_bill = jQuery('input[name="show_bill"]').val();
        }

        var url = "reports/rpt_proforma_invoice_listing.php?from_date=" + encodeURIComponent(from_date) + "&to_date=" + encodeURIComponent(to_date) + "&agent_id=" + encodeURIComponent(agent_id) + "&customer_id=" + encodeURIComponent(customer_id) + "&transport_id=" + encodeURIComponent(transport_id) + "&search_text=" + encodeURIComponent(search_text) + "&show_bill=" + encodeURIComponent(show_bill);

        window.open(url);
    }
</script>