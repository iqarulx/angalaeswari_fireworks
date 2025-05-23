<?php 
	$page_title = "Purchase Entry";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['purchase_entry_module'];
            include("permission_check.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
</head>	
<body>
<?php include "header.php"; 
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');
    $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '', '');

    
    $cancelled_bill = ""; $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['purchase_entry_table'], 'cancelled', 1);
    $cancelled_count = count($cancelled_bill);

?>
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
                                                        <input type="date" class="form-control shadow-none" placeholder="" required="" name="from_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">

                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                    <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group mb-2">
                                                    <div class="form-label-group in-border mb-0">
                                                        <select class="select2 select2-danger" name="supplier_id" onchange="Javascript:table_listing_records_filter();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                            <option value="">Select Supplier</option>    
                                                                <?php if(!empty($supplier_list)) {
                                                                    foreach($supplier_list as $supplier) { ?>
                                                                        <option value="<?php echo $supplier['supplier_id']; ?>" ><?php echo $obj->encode_decode('decrypt', $supplier['supplier_name']); ?></option>
                                                                <?php } 
                                                                } ?>
                                                        </select>
                                                        <label>Select Supplier</label>
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <select class="select2 select2-danger" name="product_group" data-dropdown-css-class="select2-danger" style="width: 100%!important;"  onchange="Javascript:table_listing_records_filter();" >
                                                            <option value="">Select</option>
                                                            <option value="4d5449774e4449774d6a55784d44557a4d444a664d444d3d" >Raw Material</option>
                                                            <option value="4d5449774e4449774d6a55784d4455794e4464664d44493d" >Semi Finished</option>
                                                            <option value="4d5449774e4449774d6a55784d4455794d7a4e664d44453d" >Finished</option>
                                                        </select>
                                                        <label>Product Group <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="input-group">
                                                <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search Bill No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
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
                                                    <div class="col-lg-2 col-md-2 col-4">
                                                        <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                                    </div>
                                                <?php } ?>

                                            <?php if(!empty($cancelled_count)) { ?>
                                                    <div class="row justify-content-end p-2">

                                                        <div class="col-lg-3 col-6 text-end">
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
        $("#purchaseentry").addClass("active");
        table_listing_records_filter();
    });
</script>