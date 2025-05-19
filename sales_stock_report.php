<?php 
	$page_title = "Sales Stock Report";
	include("include_user_check.php");
    include("include_incharger_access.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
    $product_id = ""; $group_id = ""; $magazine_id = ""; $unit_type = ""; $stock_type = ""; $case_contains = "";
    
    if(!empty($login_user_factory_id)) {
        $magazine_list = array();
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'factory_id', $login_user_factory_id, '');

        if(!empty($magazine_list)) {
            foreach($magazine_list as $magazine) {
                $magazine_id = $magazine['magazine_id'];
                break;
            }
        }
    } else if(!empty($login_user_magazine_id)) {
        $magazine_id = $login_user_magazine_id;
    }

    if(isset($_POST['filter_group_id'])) {
        $group_id = $_POST['filter_group_id'];
    }
    if(isset($_POST['filter_magazine_id'])) {
        $magazine_id = $_POST['filter_magazine_id'];
    }
    if(isset($_POST['filter_product_id'])) {
        $product_id = $_POST['filter_product_id'];
    }
    $finished_group_id = "";
    if(isset($_POST['filter_finished_group_id'])) {
        $finished_group_id = $_POST['filter_finished_group_id'];
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

    $finished_group_list = array();
    $finished_group_list = $obj->getTableRecords($GLOBALS['finished_group_table'], '', '', '');

    $product_list = array();
    if(!empty($finished_group_id)) {
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'finished_group_id', $finished_group_id, '');
    } else {
        $product_list = $obj->getProducts('2');
    }

    if(empty($login_user_factory_id) && empty($login_user_magazine_id) && empty($login_user_magazine_id)) {
        $magazine_list = array();
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
    } else {
        if(!empty($login_user_factory_id)) {
            $magazine_list = array();
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'factory_id', $login_user_factory_id, '');
        }
    }

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
    } else if(!empty($product_id)) {
        if($subunit_hide == '1') {
            $contains_list = $obj->getStockContainsList($product_id);
        }
        $total_records_list = $obj->getStockReportListSales($group_id, '', $magazine_id, $product_id, $stock_type, $case_contains, '');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?></title>
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
                    <form name="sales_stock_report_form" method="post">
                        <div class="card">
                            <div class="row justify-content-end mx-0 mt-3 px-2">
                               
                                <div class="col-lg-3 col-md-3 col-4">
                                    <button class="btn btn-primary" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_sales_stock_report_a4.php?filter_finished_group_id=<?php echo $finished_group_id; ?>&filter_magazine_id=<?php echo $magazine_id; ?>&filter_product_id=<?php echo $product_id; ?>&filter_contains=<?php echo $case_contains; ?>&unit_type=<?php echo $unit_type; ?>&stock_type=<?php echo $stock_type; ?>')"> <i class="fa fa-print"></i> Print </button>
                                    <button class="btn btn-success" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                    <?php if(!empty($product_id)) { ?>
                                        <button class="btn btn-danger" style="font-size:11px;" type="button" onclick="window.open('sales_stock_report.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> Back </button>
                                <?php } ?>
                                </div>
                               
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
                                            <select name="filter_finished_group_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                <option value="">Select</option>
                                                <?php
                                                    if(!empty($finished_group_list)) {
                                                        foreach($finished_group_list as $data) {
                                                            if(!empty($data['finished_group_id']) && $data['finished_group_id'] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <option value="<?php echo $data['finished_group_id']; ?>" <?php if(!empty($finished_group_id) && $finished_group_id == $data['finished_group_id']) { ?>selected<?php } ?>>
                                                                    <?php
                                                                        if(!empty($data['finished_group_name']) && $data['finished_group_name'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['finished_group_name']);
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label>Finished Group</label>
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
                                            <label>Unit / Subunit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row px-2 pb-4 justify-content-center">    
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <?php if(empty($product_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_sales_stock_report">
                                                <thead class="bg-primary" style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr style="vertical-align:middle!important;">
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Contains</th>
                                                        <th>Current Stock</th>
                                                        <th>Stock Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_current_unit = 0; $total_current_subunit = 0; $total_amount = 0; $unit_name_array = array(); $sub_unit_name_array = array();
                                                    if(!empty($total_records_list)) { 
                                                        foreach($total_records_list as $key => $data) {
                                                            $unit_name = ""; $subunit_name = ""; $subunit_need = 0;
                                                            $rate = 0; $per = 0; $rate_per_unit = 0;
                                                            $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'unit_name');
                                                            $subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_name');
                                                            $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_need');
                                                            $rate = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'sales_rate');
                                                            $per = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'per');
                                                            $rate_per_unit = $rate / $per;
                                                            $case_contains_list = array();
                                                            if(!empty($subunit_need) && $subunit_need == 1) {
                                                                $case_contains_list = $obj->getCaseContainsListSales($data['product_id']);
                                                            }
                                                            $str_product_id = "";
                                                            if(!empty($case_contains_list)) {
                                                                foreach($case_contains_list as $row) {
                                                                    if(!empty($row['case_contains']) && $row['case_contains'] != $GLOBALS['null_value']) {
                                                                        $outward_subunit = 0; $total_rate = 0;
                                                                        $unit_rate = 0;
                                                                        $current_stock_subunit = 0;
                                                                       
                                                                        $outward_subunit = $obj->getSubunitQtySales('', '', $magazine_id, $data['product_id'], $row['case_contains']);
                                                                     
                                                                        $current_stock_subunit = $outward_subunit;
                                                                        $total_rate = $current_stock_subunit * $rate_per_unit;
                                                                        if($unit_type == "Subunit") {
                                                                            $total_current_subunit += $current_stock_subunit;
                                                                        }
                                                                        $current_stock_quotient = 0; $current_stock_remainder = 0;
                                                                        $current_stock = 0;
                                                                        $current_stock_quotient = floor($current_stock_subunit / $row['case_contains']);
                                                                        $current_stock_remainder = round(fmod($current_stock_subunit, $row['case_contains']));
                                                                        if(!empty($current_stock_quotient)) {
                                                                            if($unit_type == "Unit") {
                                                                                $total_current_unit += $current_stock_quotient;
                                                                            }
                                                                            $current_stock = $current_stock_quotient." ".($obj->encode_decode('decrypt', $unit_name));
                                                                            $unit_name_array[] = $obj->encode_decode('decrypt', $unit_name);
                                                                        }
                                                                        if(!empty($current_stock_remainder)) {
                                                                            if($unit_type == "Unit") {
                                                                                $total_current_subunit += $current_stock_remainder;
                                                                            }
                                                                            if(!empty($current_stock)) {
                                                                                $current_stock = $current_stock." ".$current_stock_remainder." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                $sub_unit_name_array[] = $obj->encode_decode('decrypt', $subunit_name);
                                                                            } else {
                                                                                $current_stock = $current_stock_remainder." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                $sub_unit_name_array[] = $obj->encode_decode('decrypt', $subunit_name);
                                                                            }
                                                                        }
                                                                       
                                                                        if(!empty($current_stock) || !empty($current_stock_subunit) || !empty($obj->getProductStockTransactionExistSales($data['product_id']))) {
                                                                        ?>
                                                                            <tr>
                                                                                <?php if($str_product_id != $data['product_id']) { ?>
                                                                                    <th <?php if(!empty($case_contains_list)) { ?>rowspan="<?php echo count($case_contains_list); ?>"<?php } ?>><?php echo $key+1; ?></th>
                                                                                    <th <?php if(!empty($case_contains_list)) { ?>rowspan="<?php echo count($case_contains_list); ?>"<?php } ?> onclick="Javascript:ShowStockProduct('<?php if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) { echo $data['product_id']; } ?>');" style="cursor:pointer!important;">
                                                                                        <?php
                                                                                            $product_name = "";
                                                                                            $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                                                                                            
                                                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                                                        ?>
                                                                                    </th>
                                                                                <?php } ?>
                                                                                <th>
                                                                                    <?php echo $row['case_contains']; ?>
                                                                                </th>
                                                                                <th>
                                                                                    <?php
                                                                                        if($unit_type == "Subunit") {
                                                                                            echo $current_stock_subunit." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                            $sub_unit_name_array[] = $obj->encode_decode('decrypt', $subunit_name);
                                                                                        } else {
                                                                                            echo $current_stock;
                                                                                        }
                                                                                    ?>
                                                                                </th>
                                                                                <th>
                                                                                    <?php
                                                                                        if($total_rate > 0) {
                                                                                            echo "Rs." . number_format($total_rate);
                                                                                            $total_amount += $total_rate;
                                                                                        } else {
                                                                                            echo '0';
                                                                                        }
                                                                                    ?>
                                                                                </th>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    $str_product_id = $data['product_id'];
                                                                }
                                                            } else {
                                                                $outward_unit = 0; $total_rate = 0;
                                                                $current_stock_unit = 0;
                                                                $outward_unit = $obj->getOutwardQtySales('', '', $magazine_id, $data['product_id'], '');
                                                                $current_stock_unit = $outward_unit;
                                                                if(!empty($current_stock_unit)) {
                                                                    $total_current_unit += $current_stock_unit;
                                                                }

                                                                if(!empty($current_stock_unit) || !empty($obj->getProductStockTransactionExistSales($data['product_id']))) {
                                                                ?>
                                                                    <tr>
                                                                        <th><?php echo $key+1; ?></th>
                                                                        <th onclick="Javascript:ShowStockProduct('<?php if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) { echo $data['product_id']; } ?>');" style="cursor:pointer!important;">
                                                                            <?php
                                                                                $product_name = "";
                                                                                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                                                                                
                                                                                echo $obj->encode_decode('decrypt', $product_name);
                                                                            ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php 
                                                                                if($current_stock_unit > 0) {
                                                                                    $total_rate = $current_stock_unit * $rate_per_unit;
                                                                                    echo $current_stock_unit." ".($obj->encode_decode('decrypt', $unit_name));
                                                                                    $unit_name_array[] = $obj->encode_decode('decrypt', $unit_name);
                                                                                } else {
                                                                                    echo '0';
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php
                                                                                if($total_rate > 0) {
                                                                                    echo "Rs." . number_format($total_rate, 0);
                                                                                    $total_amount += $total_rate;
                                                                                } else {
                                                                                    echo '0';
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                        } 
                                                        ?>
                                                        <tr>
                                                            <th colspan="3" class="text-end">Total</th>
                                                            <th>
                                                                <?php
                                                                    if(!empty($total_current_unit)) {
                                                                        echo $total_current_unit;
                                                                        if(!empty($unit_name_array)) {
                                                                            $unique_unit_names = array_unique($unit_name_array);
                                                                            if(count($unique_unit_names) == 1) {
                                                                                echo ' ' . $unique_unit_names[0];
                                                                            }
                                                                        }
                                                                    }
                                                                    if(!empty($total_current_unit) && !empty($total_current_subunit)) {
                                                                        echo " + ";
                                                                    }
                                                                    if(!empty($total_current_subunit)) {
                                                                        echo $total_current_subunit;
                                                                        if(!empty($sub_unit_name_array)) {
                                                                            $unique_sub_unit_names = array_unique($sub_unit_name_array);
                                                                            if(count($unique_sub_unit_names) == 1) {
                                                                                echo ' ' . $unique_sub_unit_names[0];
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </th>
                                                            <th>
                                                                <?php
                                                                    if(!empty($total_amount)) {
                                                                        echo "Rs." . number_format($total_amount, 0);
                                                                    }
                                                                ?>
                                                            </th>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">Sorry! No records found</td>
                                                        </tr>
                                                        <?php 
                                                    } 
                                                ?>
                                                </tbody>
                                            </table>
                                            <?php } else if(!empty($product_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_sales_stock_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr style="vertical-align:middle!important;">
                                                        <th colspan="11" style="font-size:18px;">
                                                            <?php
                                                                $inward_unit = 0; $outward_unit = 0; $current_stock = "";
                                                                $inward_array = array(); $outward_array = array();
                                                                $inward_unit_stock = 0; $inward_subunit_stock = 0;
                                                                $outward_unit_stock = 0; $outward_subunit_stock = 0;
                                                                $current_unit_stock = 0; $current_subunit_stock = 0;
                                                                $subunit_need = 0; $unit_name = ""; $subunit_name = "";
                                                                $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');
                                                                $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_name');
                                                                if($subunit_need == '1') {
                                                                    $subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_name');
                                                                }

                                                                if($unit_type == "Unit") {
                                                                    if($subunit_need == '1') {
                                                                        $current_stock_array = $obj->getCurrentStockCasewise('', $magazine_id, $product_id, $case_contains, 2);
                                                                        $current_unit_stock = $current_stock_array[0];
                                                                        $current_subunit_stock = $current_stock_array[1];
                                                                        if(!empty($current_unit_stock)) {
                                                                            $current_stock = $current_unit_stock." ".($obj->encode_decode('decrypt', $unit_name));
                                                                        }
                                                                        if(!empty($current_subunit_stock)) {
                                                                            if(!empty($current_stock)) {
                                                                                $current_stock = $current_stock." ".$current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                            } else {
                                                                                $current_stock = $current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $outward_unit = $obj->getOutwardQtySales('', '', $magazine_id, $product_id, $case_contains);
                                                                        $current_stock = $outward_unit;
                                                                        $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $unit_name));
                                                                    }
                                                                } else if($unit_type == "Subunit") {
                                                                    $outward_unit = $obj->getSubunitQtySales('', '', $magazine_id, $product_id, $case_contains);
                                                                    $current_stock = $inward_unit - $outward_unit;
                                                                    $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                }
                                                                if(!empty($product_id)) {
                                                                    $product_name = "";
                                                                    $product_name = $obj->GetTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                                                                    echo 'Product - '.$obj->encode_decode('decrypt', $product_name);
                                                                }
                                                            ?>
                                                            <?php if(empty($stock_type)) { ?>
                                                            <span class="ms-auto" style="font-size:13px;">(Current Stock : <?php echo $current_stock; ?>)</span>
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
                                                        <th>Inward Unit</th>
                                                        <th>Outward Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_inward_unit = 0; $total_inward_subunit = 0; $total_outward_unit = 0; $total_outward_subunit = 0;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                                if(!empty($data['inward_unit']) || !empty($data['inward_subunit']) || !empty($data['outward_unit']) || !empty($data['outward_subunit'])) {
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
                                                                            if(!empty($unit_type)) {
                                                                                if($unit_type == "Subunit") {
                                                                                    if(!empty($data['inward_subunit'])) { 
                                                                                        echo $data['inward_subunit']." ".($obj->encode_decode('decrypt', $subunit_name)); 
                                                                                        $total_inward_subunit += $data['inward_subunit'];
                                                                                    }
                                                                                } else {
                                                                                    if(!empty($data['inward_unit'])) { 
                                                                                        $multiplied_value = 0; $quotient = 0; $remainder = 0;
                                                                                        if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                                                                            $multiplied_value = $data['inward_unit'] * $data['case_contains'];
                                                                                            $quotient = floor($multiplied_value / $data['case_contains']); 
                                                                                            $remainder = round(fmod($multiplied_value, $data['case_contains']));
                                                                                        } else {
                                                                                            $quotient = $data['inward_unit'];
                                                                                        }
                                                                                        if(!empty($quotient)) {
                                                                                            $total_inward_unit += $quotient;
                                                                                            echo $quotient." ".($obj->encode_decode('decrypt', $unit_name));
                                                                                        }
                                                                                        if(!empty($quotient) && !empty($remainder)) {
                                                                                            echo " ";
                                                                                        }
                                                                                        if(!empty($remainder)) {
                                                                                            $total_inward_subunit += $remainder;
                                                                                            echo $remainder." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }  
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($unit_type)) {
                                                                                if($unit_type == "Subunit") {
                                                                                    if(!empty($data['outward_subunit'])) { 
                                                                                        echo $data['outward_subunit']." ".($obj->encode_decode('decrypt', $subunit_name)); 
                                                                                        $total_outward_subunit += $data['outward_subunit'];
                                                                                    }
                                                                                } else {
                                                                                    if(!empty($data['outward_unit'])) { 
                                                                                        $multiplied_value = 0; $quotient = 0; $remainder = 0;
                                                                                        if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                                                                            $multiplied_value = $data['outward_unit'] * $data['case_contains'];
                                                                                            $quotient = floor($multiplied_value / $data['case_contains']); 
                                                                                            $remainder = round(fmod($multiplied_value, $data['case_contains']));
                                                                                        } else {
                                                                                            $quotient = $data['outward_unit'];
                                                                                        }
                                                                                        if(!empty($quotient)) {
                                                                                            $total_outward_unit += $quotient;
                                                                                            echo $quotient." ".($obj->encode_decode('decrypt', $unit_name));
                                                                                        }
                                                                                        if(!empty($quotient) && !empty($remainder)) {
                                                                                            echo " ";
                                                                                        }
                                                                                        if(!empty($remainder)) {
                                                                                            $total_outward_subunit += $remainder;
                                                                                            echo $remainder." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }  
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                    <?php 
                                                            } 
                                                        }
                                                    ?>
                                                        <tr>
                                                            <th colspan="<?php if($subunit_hide == '1') { ?>7<?php } else { ?>6<?php } ?>" class="text-end">Total &ensp;</th>
                                                            <th>
                                                                <?php
                                                                    if(!empty($total_inward_unit)) {
                                                                        echo $total_inward_unit;
                                                                        if(!empty($unit_name)) {
                                                                            echo " " . $obj->encode_decode('decrypt', $unit_name);
                                                                        }
                                                                    }
                                                                    if(!empty($total_inward_unit) && !empty($total_inward_subunit)) {
                                                                        echo " + ";
                                                                    }
                                                                    if(!empty($total_inward_subunit)) {
                                                                        echo $total_inward_subunit;
                                                                        if(!empty($subunit_name)) {
                                                                            echo " " . $obj->encode_decode('decrypt', $subunit_name);
                                                                        }
                                                                    }
                                                                ?>
                                                            </th>
                                                            <th>
                                                                <?php
                                                                    if(!empty($total_outward_unit)) {
                                                                        echo $total_outward_unit;
                                                                        if(!empty($unit_name)) {
                                                                            echo " " . $obj->encode_decode('decrypt', $unit_name);
                                                                        }
                                                                    }
                                                                    if(!empty($total_outward_unit) && !empty($total_outward_subunit)) {
                                                                        echo " + ";
                                                                    }
                                                                    if(!empty($total_outward_subunit)) {
                                                                        $total_outward_subunit;
                                                                        if(!empty($subunit_name)) {
                                                                            echo " " . $obj->encode_decode('decrypt', $subunit_name);
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                                                            </th>
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
</div>
<!--Right Content End-->
<?php include "footer.php"; ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#salesstockreport").addClass("active");
        table_listing_records_filter();
    });
    function getReport() {
        if(jQuery('form[name="sales_stock_report_form"]').length > 0) {
            jQuery('form[name="sales_stock_report_form"]').submit();
        }
    }
    function ShowStockProduct(product_id) {
        if(jQuery('select[name="filter_product_id"]').length > 0) {
            jQuery('select[name="filter_product_id"]').val(product_id);
        }
        getReport();
    }
    
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_sales_stock_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('sales_stock_report.' + (type || 'xlsx')));
        window.open("sales_stock_report.php","_self");
    }
</script>