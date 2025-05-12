<?php 
	$page_title = "Material Transfer";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['material_transfer_module'];
            include("permission_check.php");
        }
    }

    $cancelled_bill = ""; $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['material_transfer_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php 
        include "link_style_script.php"; 
        $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');
    
        if(!empty($login_godown_id)) {
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
        }else{
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
        }
        if(!empty($login_magazine_id)) {
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_magazine_id, '');
        }else{
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        }
        ?>
    </head>	
<body>
<?php include "header.php"; ?>
    <!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <form name="table_listing_form" method="post">

                        <div class="col-12">
                            <div class="card">
                                <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                                <div class="border card-box" id="table_records_cover">
                                    <div class="card-header align-items-center">
                                        <div class="row justify-content-end p-2">
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                    <input type="date" class="form-control shadow-none" placeholder="" required="" name="from_date" onchange="Javascript:table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <select class="select2 select2-danger" name="magazine" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();" style="width: 100%;">
                                                            <option value="">Select</option>
                                                            <?php if(!empty($magazine_list)) {
                                                                foreach($magazine_list as $list) { ?>
                                                                    <option value="<?php if(!empty($list['magazine_id'])) { echo $list['magazine_id']; } ?>"> <?php if(!empty($list['magazine_name'])) { echo $obj->encode_decode('decrypt', $list['magazine_name']); } ?></option>
                                                                    <?php } 
                                                                } ?>
                                                        </select>
                                                        <label>From Magazine</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <select class="select2 select2-danger" name="godown" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();" style="width: 100%;">
                                                            <option value="">Select</option>
                                                            <?php if(!empty($godown_list)) {
                                                                foreach($godown_list as $list) { ?>
                                                                    <option value="<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>"> <?php if(!empty($list['godown_name'])) { echo $obj->encode_decode('decrypt', $list['godown_name']); } ?></option>
                                                                <?php } 
                                                            } ?>
                                                        </select>
                                                        <label>From Godown</label>
                                                    </div>
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
                                </div>
                            </div>   
                        </div>
                    </form>

                </div>  
            </div>
        </div>          
    <!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#materialtransfer").addClass("active");
        table_listing_records_filter();
    });
</script>