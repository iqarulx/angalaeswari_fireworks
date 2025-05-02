<?php 
	$page_title = "Purchase Report";
	include("include_user_check.php");
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
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
</head>	
<body>
<?php include "header.php"; 
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');  $supplier_id = ""; $bill = "";
    $total_records_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], '', '', '');
    $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '', '');
    $excel_name = "";
    $excel_name = "Purchase Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
    if(isset($_POST['page_number'])) {
        $page_number = $_POST['page_number'];
        $page_limit = $_POST['page_limit'];
        $page_title = $_POST['page_title']; 
        $from_date = ""; $to_date = ""; $supplier_id = ""; $bill = "";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['supplier_id'])) {
            $supplier_id = $_POST['supplier_id'];
        }
        if(isset($_POST['bill'])) {
            $bill = $_POST['bill'];
        }
        $total_records_list = array();
        $total_records_list = $obj->getPurchaseReportList($from_date, $to_date, $supplier_id);
        if(!empty($bill)) {
            $bill = strtolower($bill);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos($val['purchase_entry_number'], $bill) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }
    } ?>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <form name="purchase_report_form" method="post">
                        <div class="col-12">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box" id="table_records_cover">
                                <div class="card-header align-items-center">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="input-group">
                                                <input type="text" name="bill" class="form-control" style="height:34px;" placeholder="Search By Bill No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="getOverallReport();" value = "<?php if(!empty($bill)) { echo $bill; } ?>">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="supplier_id" onchange="Javascript:getOverallReport();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option value="">Select Supplier</option>    
                                                            <?php if(!empty($supplier_list)) {
                                                                foreach($supplier_list as $supplier) { ?>
                                                                    <option value="<?php echo $supplier['supplier_id']; ?>" <?php if(!empty($supplier_id) && $supplier_id == $supplier['supplier_id']) { echo 'selected'; } ?> ><?php echo $obj->encode_decode('decrypt', $supplier['supplier_name']); ?></option>
                                                            <?php } 
                                                            } ?>
                                                    </select>
                                                    <label>Select Supplier</label>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                    <input type="date" class="form-control shadow-none" placeholder="" required="" name="from_date" onchange="Javascript:getOverallReport();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-12">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:getOverallReport();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                        <div class="col-lg-3 col-6 text-end">
                                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_purchase_report_a4.php?filter_party_id=<?php if(!empty($supplier_id)) { echo $supplier_id; } ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&bill=<?php if(!empty($bill)) { echo $bill; }?>')"> <i class="fa fa-print"></i> Print </button>
                                            <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Export </button>  
                                        </div> 
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                            </div>	
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap cursor text-center smallfnt" id="tbl_purchase_list">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Purchase Bill Number</th>
                                                    <th>Date</th>
                                                    <th>Party Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total_amount = 0;
                                                if(!empty($total_records_list)) {
                                                    foreach($total_records_list as $key => $list) { 
                                                        $index = $key + 1; ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $index; ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['purchase_entry_number'])) {
                                                                    echo $list['purchase_entry_number'];
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['purchase_entry_date'])) {
                                                                    echo $list['purchase_entry_date'];
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['supplier_name_mobile_city'])) {
                                                                    echo $obj->encode_decode('decrypt', $list['supplier_name_mobile_city']);
                                                                } ?>
                                                            </td>
                                                            <td class="text-end">
                                                                <?php if(!empty($list['total_amount'])) {
                                                                    $total_amount += (float) $list['total_amount'];
                                                                    echo number_format($list['total_amount'], 2);
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">Sorry! No records found</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                            <?php if(!empty($total_records_list) && count($total_records_list) > 0) { ?>
                                                <tr>
                                                    <td colspan="4" class="text-end">Total</td>
                                                    <td ><?php echo number_format($total_amount, 2); ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tfoot>
                                        </table> 
                                    </div>
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
    jQuery(document).ready(function(){
        jQuery('.add_update_form_content').find('select').select2();
    });
</script>
<script>
    $(document).ready(function(){
        $("#purchasereport").addClass("active");
    });
    function getOverallReport(){
        if(jQuery('form[name="purchase_report_form"]').length > 0){
            jQuery('form[name="purchase_report_form"]').submit();
        }
    }
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_purchase_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("purchase_report.php","_self");
    }
</script>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script type="text/javascript" src="include/js/bootstrap-datepicker.min.js"></script>