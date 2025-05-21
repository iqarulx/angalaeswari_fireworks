<?php 
	$page_title = "Voucher";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['voucher_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); $current_date = date("Y-m-d");

    $customer_list = array();
	$customer_list = $obj->getSupplierAgentContractorList();
    
    $cancelled_bill = array(); $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['voucher_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php 
        include "link_style_script.php"; ?>
        <script type="text/javascript" src="include/js/payment.js"></script>
        
    </head>	
<body>
<?php include "header.php"; ?>
    <!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box" id="table_records_cover">
                                <div class="card-header align-items-center">
                                    <form name="table_listing_form" method="post">
                                        <div class="row justify-content-end p-2">
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                    <input type="date" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange="Javascript:table_listing_records_filter();checkDateCheck();" placeholder="">
                                                    <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                    <input type="date" name="to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:table_listing_records_filter();checkDateCheck();" placeholder="" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                    <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-12">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border mb-0">
                                                        <select id="party_type" name="party_type" data-dropdown-css-class="select2 select2-danger" style="width: 100%;"  onchange="Javascript:getVoucherFilterPartyList(this.value);Javascript:table_listing_records_filter();">
                                                            <option value="">Select</option>
                                                            <option value="1">Supplier</option>
                                                            <option value="2">Agent</option>
                                                            <!-- <option value="3">Contractor</option> -->
                                                        </select>
                                                        <label>Party Type</label>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12 party_display">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <select name="filter_party_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();">
                                                            <option value="">Select</option>
                                                            <?php
                                                            if(!empty($customer_list)) {
                                                                foreach($customer_list as $data) { ?>
                                                                    <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>"> <?php
                                                                        if(!empty($data['name_mobile_city'])) {
                                                                            $data['name_mobile_city'] = html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
                                                                            echo $data['name_mobile_city'];
                                                                        } ?>
                                                                    </option> <?php
                                                                }
                                                            } ?>
                                                        </select>
                                                        <label>Party</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6 mb-3">
                                                <div class="input-group">
                                                <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search By Bill No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2" onclick="Javascript:table_listing_records_filter();"><i class="bi bi-search"></i></span>
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
                                            <div class="col-lg-2 col-md-3 col-4">
                                                <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name='show_bill' value="0" id='show_bill'>
                                        <?php if($cancelled_count > 0) { ?>
                                            <div class="row mx-0 justify-content-end p-2">
                                                <div class="col-sm-4 col-lg-2 text-end">
                                                    <button class="btn btn-dark poppins" id='show_button' style="font-size:11px;" type="button" onclick="Javascript:assign_bill_value();">Show Inactive Bill</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                    <div id="table_listing_records"></div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>  
            </div>
        </div>
    </div>         
    <!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#voucher").addClass("active");
        table_listing_records_filter();
    });
</script>