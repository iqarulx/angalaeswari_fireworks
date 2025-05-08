<?php 
	$page_title = "Day Book";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
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
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                                                <label>Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="table-responsive">
                                            <table class="table table-bordered nowrap cursor text-center smallfnt">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Cash</td>
                                                        <td>5000.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bank</td>
                                                        <td>5000.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TMB</td>
                                                        <td>5000.00</td>
                                                    </tr>
                                                </tbody>
                                            </table> 
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
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap cursor text-center smallfnt">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Bill Number</th>
                                                <th>Name</th>
                                                <th>Credit</th>
                                                <th>Debit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>01-03-2025</td>
                                                <td>2025SOER</td>
                                                <td>Fathima</td>
                                                <td>5000.00</td>
                                                <td>5000.00</td>
                                            </tr>
                                            <tr class="fw-bold">
                                                <td colspan="4" class="text-end">Total</td>
                                                <td>5000.00</td>
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
        $("#daybook").addClass("active");
        table_listing_records_filter();
    });
</script>