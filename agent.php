<?php 
	$page_title = "Agent";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['agent_module'];
            include("permission_check.php");
        }
    }

    $agent_list = array(); $agent_count = 0;
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');
    if(!empty($agent_list)){
        $agent_count = count($agent_list);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
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
                                                        <input type="text" class="form-control" name="search_text" style="height:34px;" placeholder="Search By Name / Mbl No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();" >
                                                        <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                    </div>
                                                </div>
                                                <?php if($agent_count > 0) { ?>
                                                <button class="btn btn-success py-2mx-2" style="font-size:12px; width:140px;" type="button" onclick="Javascript:ExcelDownload();"> <i class="fa fa-cloud-download"></i> Excel Download </button>
                                                <button class="btn btn-primary py-2 mx-2" style="font-size:12px; width:75px;" type="button" onclick="Javascript:PrintAgent('');"> <i class="fa fa-print"></i> Print </button>
                                                <?php
                                            } ?> 
                                                <div class="col-lg-2 col-md-2 col-3"> 
                                                    <div class="ps-2"><?php
                                                        $add_access_error = "";
                                                        if(!empty($login_staff_id)) {
                                                            $permission_action = $add_action;
                                                            include('permission_action.php');
                                                        }
                                                        if(empty($add_access_error)) { ?>
                                                            <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button> <?php 
                                                        } ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xl-8">
                                                    <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                    <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                    <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
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
            </div>
        </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#agent").addClass("active");
        table_listing_records_filter();
    });

    function ExcelDownload() {
        var search_text = ""; var url = ""; 
        search_text = jQuery('input[name="search_text"]').val();
        url = "agent_download.php?search_text="+search_text;
        window.open(url,'_blank');
    }
    
    function PrintAgent(from) {
        var search_text = ""; var url = ""; 
        search_text = jQuery('input[name="search_text"]').val();
        url = "reports/rpt_agent_a4.php?search_text="+search_text+"&from="+from;
        window.open(url,'_blank');
    }
</script>