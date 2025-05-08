<?php 
	$page_title = "Product";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['product_module'];
            include("permission_check.php");
        }
    }

    $product_list = array(); $product_count = 0;

    $group_list = $obj->getTableRecords($GLOBALS['group_table'], '', '', '');

    $finished_group_list = array();
    $finished_group_list = $obj->getTableRecords($GLOBALS['finished_group_table'], '', '', '');

    $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
    if(!empty($product_list)){
        $product_count = count($product_list);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
    <script type="text/javascript" src="include/js/creation_modules.js"></script>
    <script type="text/javascript" src="include/js/product_upload.js"></script>
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

                                    <div class="row  p-2">
                                        <div class="col-lg-2 py-1">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger Product_Fix_field" name="filter_group" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="table_listing_records_filter();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if($group_list) {
                                                                foreach($group_list as $group) { ?>
                                                                    <option value="<?php if(!empty($group['group_id'])){ echo $group['group_id']; } ?>" <?php if(!empty($group_id) && $group_id == $group['group_id']) { ?>selected<?php } ?>>
                                                                        <?php if(!empty($group['group_name'])) { echo $obj->encode_decode('decrypt', $group['group_name']); } ?>
                                                                    </option>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Group</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 py-1">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger Product_Fix_field" name="filter_finished_group" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="table_listing_records_filter();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if($finished_group_list) {
                                                                foreach($finished_group_list as $finished_group) { ?>
                                                                    <option value="<?php if(!empty($finished_group['finished_group_id'])){ echo $finished_group['finished_group_id']; } ?>" <?php if(!empty($finished_group_id) && $finished_group_id == $finished_group['finished_group_id']) { ?>selected<?php } ?>>
                                                                        <?php if(!empty($finished_group['finished_group_name'])) { echo $obj->encode_decode('decrypt', $finished_group['finished_group_name']); } ?>
                                                                    </option>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Finished Group</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 py-1">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search_text" style="height:34px;" placeholder="Search By Name" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();" >
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="tooltip-container">
                                                <button class="btn btn-primary m-1" style="font-size:11px;" type="button">
                                                    <i class="bi bi-info-circle"></i>&nbsp; Upload Info
                                                </button>
                                                <div class="tooltip-text">
                                                    &#9733; To give <b>1</b> for <b>Raw Material</b><br>
                                                    &#9733; To give <b>2</b> for <b>Semi Finished</b><br>
                                                    &#9733; To give <b>3</b> for <b>Finished</b><br>
                                                    &#9733; To give <b>1</b> for <b>Per Unit</b><br>
                                                    &#9733; To give <b>2</b> for <b>Per SubUnit</b>
                                                </div>
                                            </div>
                                             <?php if(count($product_list) > 0) { ?>
                                             <button class="btn btn-success m-1" style="font-size:11px;" type="button" id="download_products" onClick="window.open('product_download.php','_self');"> <i class="fa fa-download"></i> Download </button>
                                        <?php } ?>
                                        <button class="btn btn-primary m-1" style="font-size:11px;" type="button" id="product_upload_excel" onClick="Javascript:ProductUploadCheck();"> <i class="fa fa-upload"></i> Upload </button>
                                        <button class="btn btn-warning m-1" style="font-size:11px;" type="button" id="download_template" onClick="window.open('product_template.php','_self');"> <i class="fa fa-file"></i> Template </button>
                                        <input type="file" name="product_excel_upload" id="product_excel_upload" style="display: none;" accept=".xls,.xlsx" onChange="Javascript:getExcelData(this);">	 
                                        <?php
                                            $add_access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $add_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($add_access_error)) {
                                            ?>
                                            <button class="btn btn-danger m-1 " style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button> 

                                        <?php } ?>                                            
                                        </div>
                                        <div class="row add_update_excel_form_content_excel px-0 mx-auto"></div>
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                            <input type="hidden" name="upload_type" value="">
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#product").addClass("active");
        table_listing_records_filter();
    });

    function ExcelDownload() {
        var search_text = ""; var url = ""; 
        search_text = jQuery('input[name="search_text"]').val();
        url = "product_download.php?search_text="+search_text;
        window.open(url,'_blank');
    }
</script>