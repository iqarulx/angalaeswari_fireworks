<?php 
	$page_title = "Current Stock Report";
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
    $product_id = ""; $group_id = ""; $magazine_id = ""; $unit_type = ""; $stock_type = ""; $case_contains = "";
    if(isset($_POST['filter_group_id'])) {
        $group_id = $_POST['filter_group_id'];
    }
    if(isset($_POST['filter_magazine_id'])) {
        $magazine_id = $_POST['filter_magazine_id'];
    }
    if(isset($_POST['filter_product_id'])) {
        $product_id = $_POST['filter_product_id'];
    }
    if(isset($_POST['unit_type'])) {
        $unit_type = $_POST['unit_type'];
    }
    if(isset($_POST['stock_type'])) {
        $stock_type = $_POST['stock_type'];
    }
    if(isset($_POST['filter_contains'])) {
        $case_contains = $_POST['filter_contains'];
    }
    if(empty($unit_type)) {
        $unit_type = "Unit";
    }

    $group_list = array();
    $group_list = $obj->getGroupList('2');

    $product_list = array();
    if(!empty($group_id)) {
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $group_id, '');
    }
    else {
        $product_list = $obj->getProducts('2');
    }

    $magazine_list = array();
    $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');

    $product_subunit_id = ""; $subunit_hide = 1;
    if(!empty($product_id)) {
        $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        if(empty($product_subunit_id) || $product_subunit_id == $GLOBALS['null_value']) {
            $subunit_hide = 0;
        }
    }

    $total_records_list = array(); $contains_list = array();
    if(empty($product_id)) {
        $total_records_list = $product_list;
    }
    else if(!empty($product_id)) {
        if($subunit_hide == '1') {
            $contains_list = $obj->getStockContainsList($product_id);
        }
        $total_records_list = $obj->getStockReportList($group_id, '', $magazine_id, $product_id, $stock_type, $case_contains, '');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
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
                                <div class="col-lg-2 col-md-3 col-4">
                                    <button class="btn btn-success float-end" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                </div>
                                <?php if(!empty($product_id)) { ?>
                                    <div class="col-lg-1 col-md-3 col-4">
                                        <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('current_stock_report.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> Back </button>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row px-2 mx-0 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="filter_magazine_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                <option value="">Select</option>
                                                <?php
                                                    if(!empty($magazine_list)) {
                                                        foreach($magazine_list as $data) {
                                                            if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <option value="<?php echo $data['magazine_id']; ?>" <?php if(!empty($magazine_id) && $magazine_id == $data['magazine_id']) { ?>selected<?php } ?>>
                                                                    <?php
                                                                        if(!empty($data['name_location']) && $data['name_location'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['name_location']);
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label>Magazine</label>
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
                                <?php if(!empty($product_id)) { ?>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="stock_type" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                <option value="">Select</option>
                                                <option value="Opening Stock" <?php if($stock_type == "Opening Stock") { ?>selected<?php } ?>>Opening Stock</option>
                                                <option value="Daily Production" <?php if($stock_type == "Daily Production") { ?>selected<?php } ?>>Daily Production</option>
                                                <option value="Stock Adjustment" <?php if($stock_type == "Stock Adjustment") { ?>selected<?php } ?>>Stock Adjustment</option>
                                                <option value="Material Transfer" <?php if($stock_type == "Material Transfer") { ?>selected<?php } ?>>Material Transfer</option>
                                                <option value="Delivery Slip" <?php if($stock_type == "Delivery Slip") { ?>selected<?php } ?>>Delivery Slip</option>
                                            </select>
                                            <label>Stock Type</label>
                                        </div>
                                    </div>
                                </div>
                                <?php if($subunit_hide == '1') { ?>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-1">
                                            <div class="form-label-group in-border pb-2">
                                                <select name="filter_contains" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($contains_list)) {
                                                            foreach($contains_list as $data) {
                                                                if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['case_contains']; ?>" <?php if(!empty($case_contains) && $case_contains == $data['case_contains']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            echo $data['case_contains'];
                                                                        ?>
                                                                    </option>
                                                                    <?php 
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Contains</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php } ?>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="unit_type" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                <option value="Unit" <?php if(!empty($unit_type) && $unit_type == "Unit") { ?>selected<?php } ?>>Unit</option>
                                                <?php if($subunit_hide == '1') { ?>
                                                <option value="Subunit" <?php if(!empty($unit_type) && $unit_type == "Subunit") { ?>selected<?php } ?>>Subunit</option>
                                                <?php } ?>
                                            </select>
                                            <label>Unit/Subunit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row px-2 pb-4 justify-content-center">    
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <?php if(empty($product_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_current_stock_report">
                                                <thead class="bg-primary" style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr style="vertical-align:middle!important;">
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Current Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock = 0; $sno = 1;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                                $inward_unit = 0; $outward_unit = 0;
                                                                if($unit_type == "Unit") {
                                                                    $inward_unit = $obj->getInwardQty('', '', $magazine_id, $data['product_id'], '');
                                                                    $outward_unit = $obj->getOutwardQty('', '', $magazine_id, $data['product_id'], '');
                                                                }
                                                                else if($unit_type == "Subunit") {
                                                                    $inward_unit = $obj->getInwardSubunitQty('', '', $magazine_id, $data['product_id'], '');
                                                                    $outward_unit = $obj->getOutwardSubunitQty('', '', $magazine_id, $data['product_id'], '');
                                                                }
                                                                $current_stock_unit = 0; $current_stock_subunit = 0;
                                                                $current_stock_unit = $inward_unit - $outward_unit;
                                                                $current_stock_unit = number_format($current_stock_unit, 2);
                                                                $current_stock_unit = str_replace(",", "", $current_stock_unit);

                                                    ?>
                                                                <tr>
                                                                    <th><?php echo $sno++; ?></th>
                                                                    
                                                                
                                                                    <th onclick="Javascript:ShowStockProduct('<?php if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) { echo $data['product_id']; } ?>');" style="cursor:pointer!important;">
                                                                        <?php
                                                                            if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['product_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            echo $current_stock_unit;
                                                                            $total_stock += $current_stock_unit;
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                    <?php 
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <th colspan="2" class="text-end">Total</th>
                                                                <th><?php echo $total_stock; ?></th>
                                                            </tr>
                                                            <?php
                                                        }  
                                                        else {
                                                    ?>
                                                            <tr>
                                                                <td colspan="3" class="text-center">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php } else if(!empty($product_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_current_stock_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr style="vertical-align:middle!important;">
                                                        <th colspan="11" style="font-size:18px;">
                                                            <?php
                                                                $inward_unit = 0; $outward_unit = 0;
                                                                if($unit_type == "Unit") {
                                                                    $inward_unit = $obj->getInwardQty('', '', $magazine_id, $product_id, $case_contains);
                                                                    $outward_unit = $obj->getOutwardQty('', '', $magazine_id, $product_id, $case_contains);
                                                                }
                                                                else if($unit_type == "Subunit") {
                                                                    $inward_unit = $obj->getInwardSubunitQty('', '', $magazine_id, $product_id, $case_contains);
                                                                    $outward_unit = $obj->getOutwardSubunitQty('', '', $magazine_id, $product_id, $case_contains);
                                                                }
                                                                $current_stock_unit = 0;
                                                                $current_stock_unit = $inward_unit - $outward_unit;
                                                                $current_stock_unit = number_format($current_stock_unit, 2);
                                                                $current_stock_unit = str_replace(",", "", $current_stock_unit);
                                                                $current_stock = 0; $unit_name = ""; $stock_unit_name = "";
                                                                $current_stock = $current_stock_unit;
                                                                if($unit_type == "Unit") {
                                                                    $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_name');
                                                                    if($unit_name != $GLOBALS['null_value']) {
                                                                        $stock_unit_name = $obj->encode_decode('decrypt', $unit_name);
                                                                    }
                                                                }
                                                                else if($unit_type == "Subunit") {
                                                                    $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_name');
                                                                    if($unit_name != $GLOBALS['null_value']) {
                                                                        $stock_unit_name = $obj->encode_decode('decrypt', $unit_name);
                                                                    }
                                                                }
                                                                if(!empty($product_id)) {
                                                                    $product_name = "";
                                                                    $product_name = $obj->GetTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                                                                    echo 'Product - '.$obj->encode_decode('decrypt', $product_name);
                                                                }
                                                            ?>
                                                            <?php if(empty($stock_type)) { ?>
                                                            <span class="ms-auto" style="font-size:13px;">(Current Stock : <?php echo $current_stock." ".$stock_unit_name; ?>)</span>
                                                            <?php } ?>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-success" style="vertical-align:middle!important;">
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Remarks</th>
                                                        <th>Party</th>
                                                        <th>Magazine</th>
                                                        <?php if($subunit_hide == '1') { ?>
                                                            <th>Contains</th>
                                                        <?php } ?>
                                                        <th>Inward Unit (in <?php echo $stock_unit_name; ?>)</th>
                                                        <th>Outward Unit (in <?php echo $stock_unit_name; ?>)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_inward = 0; $total_outward = 0;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                    ?>
                                                                <tr>
                                                                    <th><?php echo $key+1; ?></th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['stock_date'])) {
                                                                                echo date('d-m-Y', strtotime($data['stock_date']));
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['stock_type'])) {
                                                                                echo $data['stock_type'];
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['remarks']);
                                                                            }
                                                                            else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                                                $party_name = "";
                                                                                $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $data['party_id'], 'name_mobile_city');
                                                                                if(empty($party_name) || $party_name == $GLOBALS['null_value']) {
                                                                                    $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $data['party_id'], 'name_mobile_city');
                                                                                    if(empty($party_name) || $party_name == $GLOBALS['null_value']) {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $data['party_id'], 'name_mobile_city');
                                                                                    }
                                                                                }
                                                                                if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $party_name);
                                                                                }
                                                                                else {
                                                                                    echo '-';
                                                                                }
                                                                            }
                                                                            else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                                                                                $magazine_name = "";
                                                                                $magazine_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $data['magazine_id'], 'magazine_name');
                                                                                echo $obj->encode_decode('decrypt', $magazine_name);
                                                                            }
                                                                            else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <?php if($subunit_hide == '1') { ?>
                                                                        <th>
                                                                            <?php
                                                                                if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                                                                    echo $data['case_contains'];
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                    <?php } ?>
                                                                    <th>
                                                                        <?php
                                                                            if($unit_type == "Unit") {
                                                                                if($data['inward_unit'] != $GLOBALS['null_value']) {
                                                                                    $total_inward += $data['inward_unit'];
                                                                                    echo $data['inward_unit'];
                                                                                }
                                                                            }
                                                                            else if($unit_type == "Subunit") {
                                                                                if($data['inward_subunit'] != $GLOBALS['null_value']) {
                                                                                    $total_inward += $data['inward_subunit'];
                                                                                    echo $data['inward_subunit'];
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if($unit_type == "Unit") {
                                                                                if($data['outward_unit'] != $GLOBALS['null_value']) {
                                                                                    $total_outward += $data['outward_unit'];
                                                                                    echo $data['outward_unit'];
                                                                                }
                                                                            }
                                                                            else if($unit_type == "Subunit") {
                                                                                if($data['outward_subunit'] != $GLOBALS['null_value']) {
                                                                                    $total_outward += $data['outward_subunit'];
                                                                                    echo $data['outward_subunit'];
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                    <?php 
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <th colspan="<?php if($subunit_hide == '1') { ?>7<?php } else { ?>6<?php } ?>" class="text-end">Total &ensp;</th>
                                                                <th><?php echo $total_inward; ?></th>
                                                                <th><?php echo $total_outward; ?></th>
                                                            </tr>
                                                            <?php
                                                        } 
                                                        else {
                                                    ?>
                                                            <tr>
                                                                <td colspan="<?php if($subunit_hide == '1') { ?>9<?php } else { ?>8<?php } ?>" class="text-center">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php } ?>
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
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#current_stock_report").addClass("active");
        table_listing_records_filter();
    });
</script>
<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="current_stock_report_form"]').length > 0) {
            jQuery('form[name="current_stock_report_form"]').submit();
        }
    }
    function ShowStockProduct(product_id) {
        if(jQuery('select[name="filter_product_id"]').length > 0) {
            jQuery('select[name="filter_product_id"]').val(product_id);
        }
        getReport();
    }
</script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_current_stock_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('current_stock_report.' + (type || 'xlsx')));
        window.open("current_stock_report.php","_self");
    }
</script>