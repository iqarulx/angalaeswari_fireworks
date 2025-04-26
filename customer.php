<?php 
	$page_title = "Customer";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $loginner_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $loginner_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['customer_module'];
            include("permission_check.php");
        }
    }
    $agent_list = array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');

    $customer_list = array(); $customer_count = 0;
    $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', '');
    if(!empty($customer_list)){
        $customer_count = count($customer_list);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/creation_modules.js"></script>
    <script type="text/javascript" src="include/js/countries.js"></script>
    <script type="text/javascript" src="include/js/district.js"></script>
    <script type="text/javascript" src="include/js/cities.js"></script>
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
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <div class="input-group">
                                                    <input type="text"  name = "search_text" class="form-control" style="height:34px;" placeholder="Search By Customer Name / Mobile Number" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();" >
                                                    <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <select class="select2 select2-danger form-control" name="filter_agent_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:table_listing_records_filter();">
                                                            <option value="">Select</option> <?php
                                                            if(!empty($agent_list)) {
                                                                foreach ($agent_list as $data) {
                                                                    if(!empty($data['agent_id']) && $data['agent_id'] != $GLOBALS['null_value']) { ?>
                                                                        <option value="<?php echo $data['agent_id']; ?>" <?php if(!empty($agent_id) && $agent_id == $data['agent_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['agent_name']) && $data['agent_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['agent_name']) . " - " .$obj->encode_decode("decrypt", $data['mobile_number']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                }
                                                            } ?>
                                                        </select>
                                                        <label for="filter_agent_id"> Select Agent</label>
                                                    </div>  
                                                </div>  
                                            </div>  
                                            <?php if($customer_count > 0) { ?>
                                                <button class="btn btn-success py-2mx-2" style="font-size:12px; width:140px;" type="button" onclick="Javascript:ExcelDownload();"> <i class="fa fa-cloud-download"></i> Excel Download </button>
                                                <button class="btn btn-primary py-2 mx-2" style="font-size:12px; width:75px;" type="button" onclick="Javascript:PrintCustomer('');"> <i class="fa fa-print"></i> Print </button>
                                                <?php
                                            } ?> 
                                            <div class="col-lg-2 col-md-4 col-6 ps-2"> <?php
                                                $access_error = "";
                                                if(!empty($loginner_id)) {
                                                    $permission_action = $add_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($access_error)) { ?>
                                                    <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button> <?php 
                                                } ?>
                                            </div>
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                            </div>	
                                        </div>	
                                    </form>
                                </div>
                                <div id="table_listing_records"></div>
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
        $("#customer").addClass("active");
        table_listing_records_filter();
    });
</script>
<script type="text/javascript">
    function ExcelDownload() {
        var search_text = ""; var url = ""; var filter_agent_id = "";
        filter_agent_id = jQuery('select[name="filter_agent_id"]').val();
        search_text = jQuery('input[name="search_text"]').val();
        url = "customer_download.php?search_text="+search_text+"&filter_agent_id="+filter_agent_id;
        window.open(url,'_blank');
    }
    
    function PrintCustomer(from) {
        var search_text = ""; var url = ""; var filter_agent_id = "";
        filter_agent_id = jQuery('select[name="filter_agent_id"]').val();
        search_text = jQuery('input[name="search_text"]').val();
        url = "reports/rpt_customer_a4.php?search_text="+search_text+"&from="+from+"&filter_agent_id="+filter_agent_id;
        window.open(url,'_blank');
    }
</script>