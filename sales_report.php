<?php 
	$page_title = "Sales Report";
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

    $from_date = ""; $to_date = ""; $current_date = "";
    // $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); 
    $current_date = date('Y-m-d');
    $total_records_list = $obj->getTableRecords($GLOBALS['estimate_table'], '', '', '');
    $excel_name = ""; $transport_id =""; $agent_id = "";
   
    $cancel_bill_btn = "";
    // if(isset($_POST['page_number'])) {
    //     $page_number = $_POST['page_number'];
    //     $page_limit = $_POST['page_limit'];
    //     $page_title = $_POST['page_title']; 
    $customer_id = ""; $bill = "";
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['customer_id'])) {
        $customer_id = $_POST['customer_id'];
    }
    if(isset($_POST['filter_agent_id'])) {
        $agent_id = $_POST['filter_agent_id'];
    }
    if(isset($_POST['transport_id'])) {
        $transport_id = $_POST['transport_id'];
    }
    $cancel_bill_btn = "";
    if(isset($_POST['cancel_bill_btn'])){
        $cancel_bill_btn = $_REQUEST['cancel_bill_btn'];
    }
        
    $total_records_list = array();
    $total_records_list = $obj->getSalesReportList($from_date, $to_date, $customer_id, $agent_id, $transport_id,$cancel_bill_btn);
    // }

    $agent_list =array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');

    if(!empty($agent_id)){
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], 'agent_id', $agent_id, '');
    } else{
       $customer_list = $obj->getCustomerList();
    }

    $transport_list =array();
    $transport_list = $obj->getTableRecords($GLOBALS['transport_table'], '', '', '');

    if(!empty($from_date) && !empty($to_date)){
        $excel_name = "Sales Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
    }else{
        $excel_name = "Sales Report";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
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
                                    <div class="row p-2">   
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
                                        <div class="col-lg-2 col-md-3 col-6 px-lg-1">
                                            <div class="form-group">
                                                <div class="form-label-group in-border" >
                                                    <select name="filter_agent_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getOverallReport();getAgentCustomer(this.value);">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($agent_list)) {
                                                                foreach($agent_list as $data) {
                                                                    if(!empty($data['agent_id']) && $data['agent_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['agent_id']; ?>" <?php if(!empty($agent_id) && $data['agent_id'] == $agent_id) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                                                    echo html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Agent</label>
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
                                                                    <option value="<?php echo $customer['customer_id']; ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { echo 'selected'; } ?> ><?php echo html_entity_decode($obj->encode_decode('decrypt', $customer['customer_name'])); ?></option>
                                                            <?php } 
                                                            } ?>
                                                    </select>
                                                    <label>Select customer</label>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="transport_id" onchange="Javascript:getOverallReport();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option value="">Select transport</option>    
                                                            <?php if(!empty($transport_list)) {
                                                                foreach($transport_list as $transport) { ?>
                                                                    <option value="<?php echo $transport['transport_id']; ?>" <?php if(!empty($transport_id) && $transport_id == $transport['transport_id']) { echo 'selected'; } ?> ><?php echo html_entity_decode($obj->encode_decode('decrypt', $transport['transport_name'])); ?></option>
                                                            <?php } 
                                                            } ?>
                                                    </select>
                                                    <label>Select Transport</label>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="col-lg-3 col-md-2 col-12">
                                            <div class="form-group mb-1">
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                                        <label for="FormSelectDefault" class="form-label text-muted smallfnt">Show Cancelled Bill</label>
                                                        <input class="form-check-input" type="checkbox" name="cancel_bill_btn" <?php if($cancel_bill_btn == "1"){ ?> checked <?php } ?> id="FormSelectDefault"  value="0"  onChange='Javascript:show_cancelled_bill(this.checked);'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div> 
                                    <div class="row justify-content-end p-2">   

                                        <div class="col-lg-12 col-6 text-end">
                                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_sales_a4.php?filter_party_id=<?php if(!empty($customer_id)){ echo $customer_id; } ?>&from_date=<?php if(!empty($from_date)){ echo $from_date; } ?>&to_date=<?php if(!empty($to_date)){ echo $to_date; } ?>&agent_id=<?php if(!empty($agent_id)){ echo $agent_id; } ?>&transport_id=<?php if(!empty($transport_id)){ echo $transport_id; } ?>&cancel_bill_btn=<?php echo $cancel_bill_btn; ?>')"> <i class="fa fa-print"></i> Print </button>
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
                                            <?php $grand_amount =0;
                                                if(!empty($total_records_list)) {
                                                    foreach($total_records_list as $key => $list) { 
                                                        $total_amount = 0;
                                                        $total_amount =$list['bill_total'];
                                                        $index = $key + 1; ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $index; ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['estimate_number'])) {
                                                                    echo $list['estimate_number'];
                                                                } 
                                                                
                                                                if (!empty($list['deleted'])) {
                                                                    ?>
                                                                    <br><span style="color: red;">Cancelled</span>
                                                                    <?php
                                                                }?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['estimate_date'])) {
                                                                    echo date('d-m-Y', strtotime($list['estimate_date']));
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($list['customer_name_mobile_city'])) {
                                                                    echo html_entity_decode($obj->encode_decode('decrypt', $list['customer_name_mobile_city']));
                                                                } ?>
                                                            </td>
                                                            <td class="text-end">
                                                                <?php if(!empty($total_amount)) {
                                                                    echo number_format($total_amount,2);
                                                                } 
                                                                
                                                                    if($list['deleted'] == '0'){ 
                                                                        $grand_amount+=$total_amount; 
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                            <tr>
                                                            <th class="text-right" colspan="4" style="text-align: right;" >Total</th>
                                                            <th class="mr-5" style="text-align: right;margin: 30px 40px;"><?php echo $obj->numberFormat($grand_amount,2); ?></th>
                                                            </tr>
                                           <?php      } else {
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
        $("#salesreport").addClass("active");
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

    function show_cancelled_bill(chk_value) {
        if(chk_value == true) {
            $("input[name='cancel_bill_btn']").val("1");
        } else {
            $("input[name='cancel_bill_btn']").val("0");
        }
        getOverallReport();
    }
</script>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script type="text/javascript" src="include/js/bootstrap-datepicker.min.js"></script>