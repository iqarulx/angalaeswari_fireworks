<?php 
	$page_title = "Godown Report";
	include("include_user_check.php");
    include("include_incharger_access.php");

	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
    $product_id = ""; $group_id = ""; $godown_id = ""; $unit_type = ""; $stock_type = ""; $case_contains = "";
    
    if(!empty($login_user_factory_id)) {
        $godown_list = array();
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'factory_id', $login_user_factory_id, '');

        if(!empty($godown_list)) {
            foreach($godown_list as $godown) {
                $godown_id = $godown['godown_id'];
                break;
            }
        }
    } else if(!empty($login_user_godown_id)) {
        $godown_id = $login_user_godown_id;
    }

    if(isset($_POST['filter_group_id'])) {
        $group_id = $_POST['filter_group_id'];
    }
    if(isset($_POST['filter_godown_id'])) {
        $godown_id = $_POST['filter_godown_id'];
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
    $group_list = $obj->getGroupList('1');

    $product_list = array();
    if(!empty($group_id)) {
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $group_id, '');
    } else {
        $product_list = $obj->getProducts('1');
    }

    if(empty($login_user_factory_id) && empty($login_user_godown_id) && empty($login_user_magazine_id)) {
        $godown_list = array();
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
    } else {
        if(!empty($login_user_factory_id)) {
            $godown_list = array();
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'factory_id', $login_user_factory_id, '');
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
        $total_records_list = $obj->getStockReportList($group_id, $godown_id, '', $product_id, $stock_type, $case_contains, '', '');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
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
                    <form name="godown_report_form" method="post">
                        <div class="card">
                            <div class="row justify-content-end mx-0 mt-3 px-2">
                           
                                <div class="col-lg-3 col-md-3 col-4">
                                
                                    <button class="btn btn-primary" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_godown_report.php?filter_group_id=<?php echo $group_id; ?>&filter_godown_id=<?php echo $godown_id; ?>&filter_product_id=<?php echo $product_id; ?>&filter_contains=<?php echo $case_contains; ?>&unit_type=<?php echo $unit_type; ?>&stock_type=<?php echo $stock_type; ?>')"> <i class="fa fa-print"></i> Print </button>
                                    <button class="btn btn-success " style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                    <?php if(!empty($product_id)) { ?>
                                        <button class="btn btn-danger " style="font-size:11px;" type="button" onclick="window.open('godown_report.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> Back </button>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="row px-2 mx-0 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="filter_godown_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                <option value="">Select</option>
                                                <?php
                                                    if(!empty($godown_list)) {
                                                        foreach($godown_list as $data) {
                                                            if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <option value="<?php echo $data['godown_id']; ?>" <?php if(!empty($godown_id) && $godown_id == $data['godown_id']) { ?>selected<?php } ?>>
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
                                            <label>Godown</label>
                                        </div>
                                    </div>
                                </div>
                                <?php if(empty($product_id)) { ?>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="filter_group_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                <option value="">Select</option>
                                                <?php
                                                    if(!empty($group_list)) {
                                                        foreach($group_list as $data) {
                                                            if(!empty($data['group_id']) && $data['group_id'] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <option value="<?php echo $data['group_id']; ?>" <?php if(!empty($group_id) && $group_id == $data['group_id']) { ?>selected<?php } ?>>
                                                                    <?php
                                                                        if(!empty($data['group_name']) && $data['group_name'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['group_name']);
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label>Group</label>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
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
                                                <option value="Purchase Entry" <?php if($stock_type == "Purchase Entry") { ?>selected<?php } ?>>Purchase Entry</option>
                                                <option value="Consumption Entry" <?php if($stock_type == "Consumption Entry") { ?>selected<?php } ?>>Consumption Entry</option>
                                                <option value="Stock Adjustment" <?php if($stock_type == "Stock Adjustment") { ?>selected<?php } ?>>Stock Adjustment</option>
                                                <option value="Material Transfer" <?php if($stock_type == "Material Transfer") { ?>selected<?php } ?>>Material Transfer</option>
                                                <option value="Semifinished Inward" <?php if($stock_type == "Semifinished Inward") { ?>selected<?php } ?>>Semifinished Inward</option>
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
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_godown_report">
                                                <thead class="bg-primary" style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr style="vertical-align:middle!important;">
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Current Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock = 0; $sno = 1; $total_unit_stock = 0; $total_subunit_stock = 0; $unit_name_array = []; $sub_unit_name_array = [];
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                                $inward_unit = 0; $outward_unit = 0; $current_stock = "";
                                                                $inward_array = array(); $outward_array = array();
                                                                $inward_unit_stock = 0; $inward_subunit_stock = 0;
                                                                $outward_unit_stock = 0; $outward_subunit_stock = 0;
                                                                $current_unit_stock = 0; $current_subunit_stock = 0;
                                                                $subunit_need = 0; $unit_name = ""; $subunit_name = "";
                                                                $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_need');
                                                                $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'unit_name');
                                                                if($subunit_need == '1') {
                                                                    $subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_name');
                                                                }

                                                                if($unit_type == "Unit") {
                                                                    if($subunit_need == '1') {
                                                                        $current_stock_array = $obj->getCurrentStockCasewise($godown_id, '', $data['product_id'], '', 1);
                                                                        $current_unit_stock = $current_stock_array[0];
                                                                        $current_subunit_stock = $current_stock_array[1];
                                                                        if(!empty($current_unit_stock)) {
                                                                            $current_stock = $current_unit_stock." ".($obj->encode_decode('decrypt', $unit_name));
                                                                            $total_unit_stock += $current_unit_stock;
                                                                            $unit_name_array[] = $unit_name;
                                                                        }
                                                                        if(!empty($current_subunit_stock)) {
                                                                            if(!empty($current_stock)) {
                                                                                $current_stock = $current_stock." ".$current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                $sub_unit_name_array[] = $subunit_name;
                                                                            } else {
                                                                                $current_stock = $current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                                $sub_unit_name_array[] = $subunit_name;
                                                                            }
                                                                            $total_subunit_stock += $current_subunit_stock;
                                                                        }
                                                                    } else {
                                                                        $inward_unit = $obj->getInwardQty('', $godown_id, '', $data['product_id'], '');
                                                                        $outward_unit = $obj->getOutwardQty('', $godown_id, '', $data['product_id'], '');
                                                                        $current_stock = $inward_unit - $outward_unit;
                                                                        $total_unit_stock += $current_stock;
                                                                        $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $unit_name));
                                                                        $unit_name_array[] = $unit_name;
                                                                    }
                                                                } else if($unit_type == "Subunit") {
                                                                    $inward_unit = $obj->getInwardSubunitQty('', $godown_id, '', $data['product_id'], '');
                                                                    $outward_unit = $obj->getOutwardSubunitQty('', $godown_id, '', $data['product_id'], '');
                                                                    $current_stock = $inward_unit - $outward_unit;
                                                                    $total_subunit_stock += $current_stock;
                                                                    $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                    $sub_unit_name_array[] = $subunit_name;
                                                                }
                                                                if(preg_match('/^[0]+$/', $current_stock) || !empty($obj->getProductStockTransactionExist($data['product_id']))) {
                                              
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
                                                                            echo $current_stock;
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                    <?php 
                                                                } 
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th colspan="2" class="text-end">Total</th>
                                                                <th>
                                                                    <?php
                                                                        if(!empty($total_unit_stock)) {
                                                                            echo $total_unit_stock;

                                                                            if(!empty($unit_name_array)) {
                                                                                $unique_unit_names = array_unique($unit_name_array);
                                                                                if(count($unique_unit_names) == 1) {
                                                                                    echo " " . $obj->encode_decode('decrypt', $unique_unit_names[0]);
                                                                                }
                                                                            }
                                                                        }
                                                                        if(!empty($total_unit_stock) && !empty($total_subunit_stock)) {
                                                                            echo " + ";
                                                                        }
                                                                        if(!empty($total_subunit_stock)) {
                                                                            echo $total_subunit_stock;

                                                                            if(!empty($sub_unit_name_array)) {
                                                                                $unique_sub_unit_names = array_unique($sub_unit_name_array);
                                                                                if(count($unique_sub_unit_names) == 1) {
                                                                                    echo " " . $obj->encode_decode('decrypt', $unique_sub_unit_names[0]);
                                                                                }
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
                                                                <td colspan="3" class="text-center">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php } else if(!empty($product_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_godown_report">
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
                                                                        $current_stock_array = $obj->getCurrentStockCasewise($godown_id, '', $product_id, $case_contains, 1);
                                                                        $current_unit_stock = $current_stock_array[0];
                                                                        $current_subunit_stock = $current_stock_array[1];
                                                                        if(!empty($current_unit_stock)) {
                                                                            $current_stock = $current_unit_stock." ".($obj->encode_decode('decrypt', $unit_name));
                                                                        }
                                                                        if(!empty($current_subunit_stock)) {
                                                                            if(!empty($current_stock)) {
                                                                                $current_stock = $current_stock." ".$current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                            }
                                                                            else {
                                                                                $current_stock = $current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                                                            }
                                                                        }
                                                                    }
                                                                    else {
                                                                        $inward_unit = $obj->getInwardQty('', $godown_id, '', $product_id, $case_contains);
                                                                        $outward_unit = $obj->getOutwardQty('', $godown_id, '', $product_id, $case_contains);
                                                                        $current_stock = $inward_unit - $outward_unit;
                                                                        $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $unit_name));
                                                                    }
                                                                }
                                                                else if($unit_type == "Subunit") {
                                                                    $inward_unit = $obj->getInwardSubunitQty('', $godown_id, '', $product_id, $case_contains);
                                                                    $outward_unit = $obj->getOutwardSubunitQty('', $godown_id, '', $product_id, $case_contains);
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
                                                        <th>Godown</th>
                                                        <?php if($subunit_hide == '1') { ?>
                                                            <th>Contains</th>
                                                        <?php } ?>
                                                        <th>Inward Unit</th>
                                                        <th>Outward Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_inward_unit = 0; $total_inward_subunit = 0; $total_outward_unit = 0;
                                                        $total_outward_subunit = 0;
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
                                                                            if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                                                                                $godown_name = "";
                                                                                $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $data['godown_id'], 'godown_name');
                                                                                echo $obj->encode_decode('decrypt', $godown_name);
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
                                                                                        }
                                                                                        else {
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
                                                                                }
                                                                                else {
                                                                                    if(!empty($data['outward_unit'])) { 
                                                                                        $multiplied_value = 0; $quotient = 0; $remainder = 0;
                                                                                        if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                                                                            $multiplied_value = $data['outward_unit'] * $data['case_contains'];
                                                                                            $quotient = floor($multiplied_value / $data['case_contains']); 
                                                                                            $remainder = round(fmod($multiplied_value, $data['case_contains']));
                                                                                        }
                                                                                        else {
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
                                                            } }
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
                                                                            echo $total_outward_subunit;
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
<!--Right Content End-->
<?php include "footer.php"; ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#godown_report").addClass("active");
        table_listing_records_filter();
    });
    function getReport() {
        if(jQuery('form[name="godown_report_form"]').length > 0) {
            jQuery('form[name="godown_report_form"]').submit();
        }
    }
    function ShowStockProduct(product_id) {
        if(jQuery('select[name="filter_product_id"]').length > 0) {
            jQuery('select[name="filter_product_id"]').val(product_id);
        }
        getReport();
    }
    
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_godown_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('godown_report.' + (type || 'xlsx')));
        window.open("godown_report.php","_self");
    }
</script>