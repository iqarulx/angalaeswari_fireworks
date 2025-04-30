<?php 
	$page_title = "Pending Order Report";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['report_module'];
            include("permission_check.php");
        }
    }

    $current_date = date('Y-m-d');

    $from_date = "";
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    } else {
        $from_date = date('Y-m-d', strtotime('-30 days'));
    }

    $to_date = "";
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    } else {
        $to_date = date('Y-m-d');
    }

    $product_id = "";
    if(isset($_POST['filter_product_id'])) {
        $product_id = $_POST['filter_product_id'];
    }

    $unit_type = "";
    if(isset($_POST['filter_unit_type'])) {
        $unit_type = $_POST['filter_unit_type'];
    } else {
        $unit_type = "1";
    }

    $customer_id = "";
    if(isset($_POST['filter_customer_id'])) {
        $customer_id = $_POST['filter_customer_id'];
    }

    $agent_id = "";
    if(isset($_POST['filter_agent_id'])) {
        $agent_id = $_POST['filter_agent_id'];
    }

    $total_records_list = array();
    $total_records_list = $obj->getPendingOrderReport($from_date, $to_date, $unit_type, $product_id, $customer_id, $agent_id);

    $product_list = array();
    $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
    $customer_list = array();
    if(!empty($agent_id)) {
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], 'agent_id', $agent_id, '');
    } else {
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', '');
    }
    $agent_list = array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
    <script src="include/js/common.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row mx-0">
                    <div class="col-12">
                        <form name="current_stock_report_form" method="post">
                            <div class="card">
                                <div class="row justify-content-end mx-0 mt-3 px-2">
                                    <div class="col-auto d-flex">
                                        <button class="btn btn-danger me-2" style="font-size:11px;" type="button" onclick="OpenPdf();">
                                            <i class="fa fa-download"></i> Pdf
                                        </button>
                                        <button class="btn btn-success" style="font-size:11px;" type="button" onclick="ExportToExcel();">
                                            <i class="fa fa-download"></i> Excel
                                        </button>
                                    </div>
                                </div>
                                <div class="row px-2 mx-0 mt-3">
                                    <div class="col-lg-2 col-md-3 col-6">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date" name="from_date" class="form-control shadow-none" placeholder="" onchange="Javascript:checkDateCheck();getReport();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" required="">
                                                <label>From Date</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-6">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date" class="form-control shadow-none" name="to_date" placeholder="" onchange="Javascript:checkDateCheck();getReport();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" required="">
                                                <label>To Date</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-1">
                                            <div class="form-label-group in-border pb-2">
                                                <select name="filter_product_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($product_list)) {
                                                            foreach($product_list as $data) {
                                                                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['product_id']; ?>" <?php if(!empty($product_id) && $product_id == $data['product_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['product_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Product</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-1">
                                            <div class="form-label-group in-border pb-2">
                                                <select name="filter_unit_type" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                    <option value="1" <?php if(!empty($unit_type) && $unit_type == "1") { ?>selected<?php } ?>>Unit</option>
                                                    <option value="2" <?php if(!empty($unit_type) && $unit_type == "2") { ?>selected<?php } ?>>Subunit</option>
                                                </select>
                                                <label>Unit/Subunit</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 mb-2">
                                        <div class="input-group">
                                            <select class="select2 select2-danger" name="filter_agent_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getReport();">
                                                <option value="">Select Agent</option>
                                                <?php if (!empty($agent_list)) {
                                                    foreach ($agent_list as $customer) { ?>
                                                        <option value="<?php if (!empty($customer['agent_id'])) {
                                                            echo $customer['agent_id'];
                                                        } ?>" <?php if(!empty($agent_id) && $agent_id == $customer['agent_id']) { echo "selected"; } ?>>
                                                            <?php if (!empty($customer['name_mobile_city'])) {
                                                                echo $obj->encode_decode('decrypt', $customer['name_mobile_city']);
                                                            } ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 mb-2">
                                        <div class="input-group">
                                            <select class="select2 select2-danger" name="filter_customer_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getReport();">
                                                <option value="">Select Customer</option>
                                                <?php if (!empty($customer_list)) {
                                                    foreach ($customer_list as $customer) { ?>
                                                        <option value="<?php if (!empty($customer['customer_id'])) {
                                                            echo $customer['customer_id'];
                                                        } ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { echo "selected"; } ?>>
                                                            <?php if (!empty($customer['name_mobile_city'])) {
                                                                echo $obj->encode_decode('decrypt', $customer['name_mobile_city']);
                                                            } ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row px-2 pb-4 justify-content-center">    
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered nowrap text-center smallfnt" id="tbl_por">
                                                    <?php if(empty($product_id)) { ?>
                                                        <thead class="bg-primary" style="font-size:13px!important;font-weight:bold!important;">
                                                            <tr style="vertical-align:middle!important;">
                                                                <th>#</th>
                                                                <th>Product</th>
                                                                <th>Ordered Stock</th>
                                                                <th>Ready Stock</th>
                                                                <th>Need Stock</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if(!empty($total_records_list)) { 
                                                                    $total_pending_order_unit = 0;
                                                                    $total_current_stock_unit = 0;
                                                                    $total_need_order_unit = 0;

                                                                    for($i = 0; $i < count($total_records_list); $i++) {
                                                            ?>
                                                                        <tr>
                                                                            <th><?php echo $i + 1; ?></th>      
                                                                            <th onclick="Javascript:ShowConversionProduct('<?php if(!empty($total_records_list[$i]['product_id']) && $total_records_list[$i]['product_id'] != $GLOBALS['null_value']) { echo $total_records_list[$i]['product_id']; } ?>');" style="cursor:pointer!important;">
                                                                                <?php
                                                                                    if(!empty($total_records_list[$i]['product_id']) && $total_records_list[$i]['product_id'] != $GLOBALS['null_value']) {
                                                                                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $total_records_list[$i]['product_id'], 'product_name');
                                                                                        if(!empty($product_name)) {
                                                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    echo $total_records_list[$i]['pending_order_unit'];
                                                                                    $total_pending_order_unit += $total_records_list[$i]['pending_order_unit'];
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    echo $total_records_list[$i]['current_stock_unit'];
                                                                                    $total_current_stock_unit += $total_records_list[$i]['current_stock_unit'];
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    echo $total_records_list[$i]['need_order_unit'];
                                                                                    $total_need_order_unit += $total_records_list[$i]['need_order_unit'];
                                                                                ?>
                                                                            </th>
                                                                        </tr>
                                                            <?php 
                                                                    } 
                                                                    ?>
                                                                    <tr>
                                                                        <th colspan="2" class="text-end">Total</th>
                                                                        <th><?php echo $total_pending_order_unit; ?></th>
                                                                        <th><?php echo $total_current_stock_unit; ?></th>
                                                                        <th><?php echo $total_need_order_unit; ?></th>
                                                                    </tr>
                                                                    <?php
                                                                }  
                                                                else {
                                                            ?>
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">Sorry! No records found</td>
                                                                    </tr>
                                                            <?php 
                                                                } 
                                                            ?>
                                                        </tbody>
                                                    <?php } else { ?>
                                                        <thead class="bg-success" style="font-size:13px!important;font-weight:bold!important;">
                                                            <tr style="vertical-align:middle!important;">
                                                                <th colspan="7">
                                                                    <?php 
                                                                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');

                                                                        if(!empty($product_name)) {
                                                                            $product_name = $obj->encode_decode('decrypt', $product_name) ;
                                                                        }

                                                                        if(!empty($from_date) && !empty($to_date) && !empty($product_name)) {
                                                                            ?>
                                                                            <span class="ms-auto" style="font-size:13px;"><?php echo $product_name; ?> (Ordered Stock : <?php echo date('d-m-Y', strtotime($from_date)) . " To " . date('d-m-Y', strtotime($to_date)); ?>)</span>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <tr style="vertical-align:middle!important;">
                                                                <th>#</th>
                                                                <th>Bill Number<br>Bill Type</th>
                                                                <th>Agent</th>
                                                                <th>Customer</th>
                                                                <th>Product</th>
                                                                <th>Inward <?php if(!empty($unit_type)) { echo "Unit"; } else { echo "Sub Unit"; } ?></th>
                                                                <th>Outward <?php if(!empty($unit_type)) { echo "Unit"; } else { echo "Sub Unit"; } ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if(!empty($total_records_list)) { 
                                                                    $total_inward = 0;
                                                                    $total_outward = 0;

                                                                    for($i = 0; $i < count($total_records_list); $i++) {
                                                            ?>
                                                                        <tr>
                                                                            <th><?php echo $i + 1; ?></th>      
                                                                            <th>
                                                                                <?php
                                                                                    if(!empty($total_records_list[$i]['bill_number']) && $total_records_list[$i]['bill_number'] != $GLOBALS['null_value']) {
                                                                                        echo $total_records_list[$i]['bill_number'];
                                                                                    }
                                                                                ?>
                                                                                <br>
                                                                                <span class="text-success">
                                                                                    <?php
                                                                                        if(!empty($total_records_list[$i]['bill_type']) && $total_records_list[$i]['bill_type'] != $GLOBALS['null_value']) {
                                                                                            echo $total_records_list[$i]['bill_type'];
                                                                                        }
                                                                                    ?>
                                                                                </span>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    if(!empty($total_records_list[$i]['agent_id']) && $total_records_list[$i]['agent_id'] != $GLOBALS['null_value']) {
                                                                                        $name_mobile_city = "";
                                                                                        $name_mobile_city = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $total_records_list[$i]['agent_id'], 'name_mobile_city');
                                                                                        $name_mobile_city = explode('-', $obj->encode_decode('decrypt', $name_mobile_city));
                                                                                        if(!empty($name_mobile_city[0])) {
                                                                                            echo $name_mobile_city[0];
                                                                                        }
                                                                                        if(!empty($name_mobile_city[1])) {
                                                                                            echo "<br>" . $name_mobile_city[1];
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    if(!empty($total_records_list[$i]['party_id']) && $total_records_list[$i]['party_id'] != $GLOBALS['null_value']) {
                                                                                        $name_mobile_city = "";
                                                                                        $name_mobile_city = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $total_records_list[$i]['party_id'], 'name_mobile_city');

                                                                                        if(!empty($name_mobile_city)) {
                                                                                            $name_mobile_city = explode('-', $obj->encode_decode('decrypt', $name_mobile_city));
                                                                                            if(!empty($name_mobile_city[0])) {
                                                                                                echo $name_mobile_city[0];
                                                                                            }
                                                                                            if(!empty($name_mobile_city[1])) {
                                                                                                echo "<br>" . $name_mobile_city[1];
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    if(!empty($total_records_list[$i]['product_id']) && $total_records_list[$i]['product_id'] != $GLOBALS['null_value']) {
                                                                                        $product_name = "";
                                                                                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $total_records_list[$i]['product_id'], 'product_name');

                                                                                        if(!empty($product_name)) {
                                                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    if(!empty($unit_type) && $unit_type == "1") {
                                                                                        if(!empty($total_records_list[$i]['inward_unit']) && $total_records_list[$i]['inward_unit'] != $GLOBALS['null_value']) {
                                                                                            echo $total_records_list[$i]['inward_unit'];
                                                                                            $total_inward += $total_records_list[$i]['inward_unit'];
                                                                                        }
                                                                                    } else {
                                                                                        if(!empty($total_records_list[$i]['inward_sub_unit']) && $total_records_list[$i]['inward_sub_unit'] != $GLOBALS['null_value']) {
                                                                                            echo $total_records_list[$i]['inward_sub_unit'];
                                                                                            $total_inward += $total_records_list[$i]['inward_sub_unit'];
                                                                                        }           
                                                                                    }
                                                                                ?>
                                                                            </th>
                                                                            <th>
                                                                                <?php
                                                                                    if(!empty($unit_type) && $unit_type == "1") {
                                                                                        if(!empty($total_records_list[$i]['outward_unit']) && $total_records_list[$i]['outward_unit'] != $GLOBALS['null_value']) {
                                                                                            echo $total_records_list[$i]['outward_unit'];
                                                                                            $total_outward += $total_records_list[$i]['outward_unit'];
                                                                                        }
                                                                                    } else {
                                                                                        if(!empty($total_records_list[$i]['outward_sub_unit']) && $total_records_list[$i]['outward_sub_unit'] != $GLOBALS['null_value']) {
                                                                                            echo $total_records_list[$i]['outward_sub_unit'];
                                                                                            $total_outward += $total_records_list[$i]['outward_sub_unit'];
                                                                                        }           
                                                                                    }
                                                                                ?>
                                                                            </th>
                                                                        </tr>
                                                            <?php 
                                                                    } 
                                                                    ?>
                                                                    <tr>
                                                                        <th colspan="5" class="text-end">Total</th>
                                                                        <th><?php echo $total_inward; ?></th>
                                                                        <th><?php echo $total_outward; ?></th>
                                                                    </tr>
                                                                    <?php
                                                                }  
                                                                else {
                                                            ?>
                                                                    <tr>
                                                                        <td colspan="<?php if(!empty($product_id)) { echo 7; } else { echo 5; } ?>" class="text-center">Sorry! No records found</td>
                                                                    </tr>
                                                            <?php 
                                                                } 
                                                            ?>
                                                        </tbody>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </form> 
                    </div>
                </div>  
            </div>
        </div>
    </div>
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#pendingorderreport").addClass("active");
        table_listing_records_filter();
    });
</script>
<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="current_stock_report_form"]').length > 0) {
            jQuery('form[name="current_stock_report_form"]').submit();
        }
    }
    function ShowConversionProduct(product_id) {
        if(jQuery('select[name="filter_product_id"]').length > 0) {
            jQuery('select[name="filter_product_id"]').val(product_id);
        }
        getReport();
    }

    function OpenPdf() {
        var from_date = "";
        var to_date = "";
        var product_id = "";
        var unit_type = "";
        var agent_id = "";
        var customer_id = "";

        if(jQuery('input[name="from_date"]').length > 0) {
            from_date =  jQuery('input[name="from_date"]').val();
        }
        if(jQuery('input[name="to_date"]').length > 0) {
            to_date =  jQuery('input[name="to_date"]').val();
        }
        if(jQuery('select[name="filter_product_id"]').length > 0) {
            product_id =  jQuery('select[name="filter_product_id"]').val();
        }
        if(jQuery('select[name="filter_unit_type"]').length > 0) {
            unit_type =  jQuery('select[name="filter_unit_type"]').val();
        }
        if(jQuery('select[name="filter_agent_id"]').length > 0) {
            agent_id =  jQuery('select[name="filter_agent_id"]').val();
        }
        if(jQuery('select[name="filter_customer_id"]').length > 0) {
            customer_id =  jQuery('select[name="filter_customer_id"]').val();
        }

        window.open('reports/rpt_pending_order_report.php?from_date=' + from_date + '&to_date=' + to_date + '&filter_product_id=' + product_id + '&filter_unit_type=' + unit_type + '&filter_agent_id=' + agent_id + '&filter_customer_id=' + customer_id, '_blank');
    }

</script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_por');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('pending_order_report.' + (type || 'xlsx')));
        window.open("pending_order_report.php","_self");
    }
</script>