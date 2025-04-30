<?php 
	$page_title = "Sales Report";
	include("include_user_check.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; 
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');
    $total_records_list = $obj->getTableRecords($GLOBALS['estimate_table'], '', '', '');
    $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', '');
    $excel_name = "";
    $excel_name = "Sales Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
    if(isset($_POST['page_number'])) {
        $page_number = $_POST['page_number'];
        $page_limit = $_POST['page_limit'];
        $page_title = $_POST['page_title']; 
        $from_date = ""; $to_date = ""; $customer_id = ""; $bill = "";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
        }
        $total_records_list = array();
        $total_records_list = $obj->getSalesReportList($from_date, $to_date, $customer_id);
    }
    ?>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <form name="sales_form" method="post">
                        <div class="col-12">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box" id="table_records_cover">
                                <div class="card-header align-items-center">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" class="form-control shadow-none" placeholder="" required="" name="from_date" onchange="Javascript:getOverallReport();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                    <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:getOverallReport();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="customer_id" onchange="Javascript:getOverallReport();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option value="">Select customer</option>    
                                                            <?php if(!empty($customer_list)) {
                                                                foreach($customer_list as $customer) { ?>
                                                                    <option value="<?php echo $customer['customer_id']; ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { echo 'selected'; } ?> ><?php echo $obj->encode_decode('decrypt', $customer['customer_name']); ?></option>
                                                            <?php } 
                                                            } ?>
                                                    </select>
                                                    <label>Select customer</label>
                                                </div>
                                            </div> 
                                        </div> 
                                        <!-- <div class="col-lg-3 col-md-2 col-12">
                                            <div class="form-group mb-1">
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                                        <label for="FormSelectDefault" class="form-label text-muted smallfnt">Show Cancelled Bill Also</label>
                                                        <input class="form-check-input code-switcher" type="checkbox" id="FormSelectDefault">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-3 col-6 text-end">
                                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_sales_a4.php?filter_party_id=<?php echo $customer_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>')"> <i class="fa fa-print"></i> Print </button>
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
                                        <table class="table table-bordered nowrap cursor text-center smallfnt" id="tbl_sales_list">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Estimate Number</th>
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
                                                                <?php if(!empty($list['estimate_number'])) {
                                                                    echo $list['estimate_number'];
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['estimate_date'])) {
                                                                    echo $list['estimate_date'];
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['customer_name_mobile_city'])) {
                                                                    echo $obj->encode_decode('decrypt', $list['customer_name_mobile_city']);
                                                                } ?>
                                                            </td>
                                                            <td class="text-end">
                                                                <?php if(!empty($list['bill_total'])) {
                                                                    $total_amount += (float) $list['bill_total'];
                                                                    echo number_format($list['bill_total'],2);
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
        $("#salesreport").addClass("active");
        // getOverallReport();
    });
    function getOverallReport(){
        if(jQuery('form[name="sales_form"]').length > 0){
            jQuery('form[name="sales_form"]').submit();
        }
    }
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_sales_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("sales_report.php","_self");
    }
</script>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script type="text/javascript" src="include/js/bootstrap-datepicker.min.js"></script>