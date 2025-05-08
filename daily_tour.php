<?php 
	$page_title = "Daily Tour";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
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
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-items-center">
                                <div class="row p-2">   
                                    <div class="col-lg-2 col-md-2 col-12 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <input type="date" class="form-control shadow-none" placeholder="" required="">
                                                <label>Date</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <form name="table_listing_form" method="post">
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                </div>
                                <div class="row p-2">
                                    <div class="col-lg-3 col-md-4 col-12 pb-3">
                                        <div class="bg-primary p-2 rounded-2 text-white">
                                            <div class="h3">Purchase</div>
                                            <div>Total Bill: </div>
                                            <div>Total Amount : </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 pb-3">
                                        <div class="bg-secondary p-2 rounded-2 text-white">
                                            <div class="h3">Estimate</div>
                                            <div>Total Bill: </div>
                                            <div>Total Amount : </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 pb-3">
                                        <div class="bg-warning p-2 rounded-2">
                                            <div class="h3">Voucher</div>
                                            <div>Total Bill: </div>
                                            <div>Total Amount : </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 pb-3">
                                        <div class="bg-danger p-2 rounded-2 text-white">
                                            <div class="h3">Receipt</div>
                                            <div>Total Bill: </div>
                                            <div>Total Amount : </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 pb-3">
                                        <div class="bg-success p-2 rounded-2 text-white">
                                            <div class="h3">Retail Sales</div>
                                            <div>Total Bill: </div>
                                            <div>Total Amount : </div>
                                        </div>
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
    jQuery(document).ready(function(){
        jQuery('.add_update_form_content').find('select').select2();
        $("#dailytour").addClass("active");
        table_listing_records_filter();
    });
</script>