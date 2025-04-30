<?php 
	$page_title = "Material Transfer";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php 
        include "link_style_script.php"; 
        $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        
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
                                                            <option value="">Select Magazine</option>
                                                            <?php if(!empty($magazine_list)) {
                                                                foreach($magazine_list as $list) { ?>
                                                                    <option value="<?php if(!empty($list['magazine_id'])) { echo $list['magazine_id']; } ?>"> <?php if(!empty($list['magazine_name'])) { echo $obj->encode_decode('decrypt', $list['magazine_name']); } ?></option>
                                                                    <?php } 
                                                                } ?>
                                                        </select>
                                                        <label>Select Magazine</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <select class="select2 select2-danger" name="godown" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();" style="width: 100%;">
                                                            <option value="">Select Godown</option>
                                                            <?php if(!empty($godown_list)) {
                                                                foreach($godown_list as $list) { ?>
                                                                    <option value="<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>"> <?php if(!empty($list['godown_name'])) { echo $obj->encode_decode('decrypt', $list['godown_name']); } ?></option>
                                                                <?php } 
                                                            } ?>
                                                        </select>
                                                        <label>Select Godown</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-4">
                                                <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
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