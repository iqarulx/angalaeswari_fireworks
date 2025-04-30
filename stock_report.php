<?php 
	$page_title = "Stock Report";
	include("include_user_check_and_files.php");
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
                                <div class="row justify-content-end p-2">   
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Product</option>    
                                                    <option>Product 1</option>
                                                    <option>Product 2</option>
                                                </select>
                                                <label>Select Product</label>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Brand</option>    
                                                    <option>Brand 1</option>
                                                    <option>Brand 2</option>
                                                </select>
                                                <label>Select Brand</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Case Contains</option>    
                                                    <option>Piece</option>
                                                    <option>PKT</option>
                                                </select>
                                                <label>Select Case Contains</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Godown</option>    
                                                    <option>Godown 1</option>
                                                    <option>Godown 2</option>
                                                </select>
                                                <label>Select Godown</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-6 text-end">
                                        <button class="btn btn-success m-1" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-print"></i> Print </button>
                                        <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-download"></i> Export </button>  
                                    </div> 
                                    <form name="table_listing_form" method="post">
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap cursor text-center smallfnt">
                                        <thead class="bg-light">
                                            <tr>
                                                <th colspan="4" class="text-center fw-bold">Product Overall Stock - 25-03-2025</th>
                                            </tr>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product Name</th>
                                                <th>Case Contains</th>
                                                <th>Current Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>Ground Chakkar Big</td>
                                                <td>36 </td>
                                                <td>6 Case </td>
                                            </tr>
                                            <tr class="fw-bold">
                                                <td colspan="3" class="text-end">Total</td>
                                                <td>5000.00</td>
                                            </tr>
                                        </tbody>
                                    </table> 
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
    });
</script>
<script>
    $(document).ready(function(){
        $("#stockreport").addClass("active");
        table_listing_records_filter();
    });
</script>