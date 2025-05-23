<?php 
	$page_title = "Agent Customer Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
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
                                    <div class="col-lg-2 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                                                <label>From Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                                                <label>To Date</label>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-lg-2 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Bill Number</option>    
                                                    <option>Bill Number 1</option>
                                                    <option>Bill Number 2</option>
                                                </select>
                                                <label>Select Bill Number</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Agent</option>    
                                                    <option>Agent 1</option>    
                                                    <option>Agent 2</option>
                                                </select>
                                                <label>Select Agent</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Customer</option>    
                                                    <option>Customer 1</option>    
                                                    <option>Customer 2</option>
                                                </select>
                                                <label>Select Customer</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Magazine</option>    
                                                    <option>Magazine 1</option>    
                                                    <option>Magazine 2</option>
                                                </select>
                                                <label>Select Magazine</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6 py-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Product</option>    
                                                    <option>Product 1</option>    
                                                    <option>Product 2</option>
                                                    <option>Product 3</option>
                                                </select>
                                                <label>Select Product</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6 py-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" style="height:34px;" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                            <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 px-lg-1 text-end">
                                        <button class="btn btn-primary m-1" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-print"></i> Print </button>
                                        <button class="btn btn-success m-1" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-file-pdf-o"></i> Pdf </button>
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
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
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
    $(document).ready(function(){
        $("#agentcustomerreport").addClass("active");
        table_listing_records_filter();
    });
</script>