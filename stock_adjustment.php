<?php 
	$page_title = "Stock Adjustment";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');

    // $factory_list = array();
    // if(!empty($login_factory_id)) {
    //     $factory_list = $obj->getTableRecords($GLOBALS['factory_table'], 'factory_id', $login_factory_id, '');
    // }
    // else {
    //     $factory_list = $obj->getTableRecords($GLOBALS['factory_table'], '', '', '');
    // }

    $godown_list = array();
    // if(!empty($login_godown_id)) {
    //     $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
    // }
    // else {
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
    // }

    $magazine_list = array();
    // if(!empty($login_magazine_id)) {
    //     $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_magazine_id, '');
    // }
    // else {
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
    // }
    $cancelled_bill = ""; $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['stock_adjustment_table'], 'cancelled', 1);
    $cancelled_count = count($cancelled_bill);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
</head>	
<body>
<?php include "header.php"; ?>
<script type="text/javascript" src="include/js/creation_modules.js"></script>
<script type="text/javascript" src="include/js/stock_adjustment.js"></script>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box" id="table_records_cover">
                                <form name="table_listing_form" method="post">
                                    <div class="card-header align-items-center">
                                        <div class="row justify-content-end p-2">
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" class="form-control shadow-none" name="from_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" class="form-control shadow-none"  name="to_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <div class="input-group">
                                                    <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search By Bill No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();" >
                                                    <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                           
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <?php
                                                    $add_access_error = "";
                                                    if(!empty($login_staff_id)) {
                                                        $permission_action = $add_action;
                                                        include('permission_action.php');
                                                    }
                                                    if(empty($add_access_error)) {
                                                ?>
                                                     <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                                <?php } ?>
                                            </div>
                                            <?php if(!empty($cancelled_count)) { ?>
                                                    <div class="row justify-content-end inactive_btn_row p-2">
                                                        <div class="col-lg-4 col-6">
                                                            <button class="btn btn-dark float-end" id='show_button' style="font-size:11px;" type="button" onclick="Javascript:assign_bill_value();">Show Inactive Bill</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-sm-6 col-xl-8">
                                                    <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                    <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                    <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                                    <input type="hidden" name='show_bill' value="0" id='show_bill'>
                                                </div>	
                                        </div>
                                    </div>
                                    <div id="table_listing_records"></div>
                                </form>
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
        $("#stockadjustment").addClass("active");
        table_listing_records_filter();
    });
</script>