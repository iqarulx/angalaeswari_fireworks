<?php 
	$page_title = "Daybook Ledger Report";
	include("include.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d'); $to_date = date("Y-m-d");
    if(isset($_POST['from_date']))
    {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date']))
    {
        $to_date = $_POST['to_date'];
    }
    
    $party_id="";
    if(isset($_POST['party_id']))
    {
        $party_id = $_POST['party_id'];
    }
    $payment_mode_id="";
    if(isset($_POST['payment_mode_id']))
    {
        $payment_mode_id = $_POST['payment_mode_id'];
    }
   
    $total_records_list = array();
    $total_records_list = $obj->getDayBookReportList($from_date,$to_date,$party_id,$payment_mode_id);
    
    $party_list = array();
    // $party_list = $obj->getPartyList('Both');

    $payment_mode_list = array();
    $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '', '', '');
  
    $current_date = date('Y-m-d');

    $excel_name = "";
    $excel_name = "Daybook Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";

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
                        <form name="daybook_report_form" method="POST">
                            <div class="border card-box" id="table_records_cover">
                                <div class="card-header align-items-center">
                                    <div class="row p-2">   
                                        <div class="col-lg-2 col-md-3 col-6 py-2">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" id="from_date" name="from_date" class="form-control shadow-none" placeholder="" onchange="Javascript:getReport();checkDateCheck();" value="<?php if(!empty($from_date)){ echo $from_date; }?>" max="<?php if(!empty($current_date)){ echo $current_date; }?>" required>
                                                    <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 py-2">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" id="to_date" name="to_date"  class="form-control shadow-none" placeholder="" onchange="Javascript:getReport();checkDateCheck();"  value="<?php if(!empty($to_date)){ echo $to_date; }?>" max="<?php if(!empty($current_date)){ echo $current_date; }?>" required>
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 py-2">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="payment_mode_id"  data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($payment_mode_list)) {
                                                                foreach($payment_mode_list as $data) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>" <?php if(!empty($payment_mode_id)){ if($payment_mode_id == $data['payment_mode_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['payment_mode_name'])) {
                                                                                $data['payment_mode_name'] = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                                echo $data['payment_mode_name'];
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Payment Mode</label>
                                                </div>
                                            </div>        
                                        </div>
                                        <div class="col-lg-3 col-md-5 col-5 py-2">
                                            <button class="btn btn-secondary float-right " style="font-size:11px;" type="button" onClick="ExportToExcel()"><i class="fa fa-download"></i>&ensp; Export </button>
                                            <button  onclick="window.open('reports/rpt_daybook.php?from_date=<?php echo $from_date ?>&to_date=<?php echo $to_date; ?>&party_id=<?php if(!empty($party_id)){ echo $party_id; }?>&payment_mode_id=<?php if(!empty($payment_mode_id)){ echo $payment_mode_id; }?>','_blank')"  class="btn btn-secondary float-right mr-2" style="font-size:11px;" type="button"> <i class="bi bi-file-pdf-fill"></i> &ensp; PDF </button>
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
                                        <table class="table table-bordered nowrap cursor text-center smallfnt" id="tbl_daybook_list">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th colspan="8" class="text-center py-2 px-2">
                                                        Daybook - <?php echo "( ".date('d-m-Y', strtotime($from_date)). "&nbsp;  to &nbsp; ".date('d-m-Y', strtotime($to_date))." )"; ?> <br>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date <br> Bill Number</th>
                                                    <th>Bill Type</th>
                                                    <th>Name</th>
                                                    <th>Payment Type</th>
                                                    <th>Account</th>
                                                    <th>Credit</th>
                                                    <th>Debit</th>
                                                </tr>
                                            </thead>
                                            <?php 
                                            $individual_record = array();
                                            if(!empty($total_records_list)) { 
                                                ?>
                                                <tbody>
                                                    <?php
                                                    $credit_amount = 0; $debit_amount = 0; $total =0; 
                                                    foreach($total_records_list as $val => $data) {
                                                        $index = $val + 1;
                                                        ?>
                                                        <tr style="cursor:pointer" onclick="open_daybook_report('<?php echo htmlspecialchars($data['bill_id']); ?>','<?php echo htmlspecialchars( $data['type']); ?>')">
                                                        <td class="text-center py-2 px-2"><?php echo $index; ?></td>
                                                            <td  class="text-center px-2 py-2">
                                                                <?php
                                                                if(!empty($data['bill_number'])) {
                                                                    echo $data['bill_number'];
                                                                }
                                                                ?>
                                                                <br> <?php
                                                                echo date('d-m-Y', strtoTime($data['bill_date']));
                                                                ?>
                                                            </td>
                                                            <td  class="text-center px-2 py-2">
                                                                <?php
                                                                if(!empty($data['type'])) {
                                                                    echo $data['type'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <td  class="text-center py-2 px-2">
                                                                <?php
                                                                    if(!empty($data['party_name']) && $data['party_name'] != 'NULL')
                                                                    {
                                                                        echo html_entity_decode($obj->encode_decode("decrypt",$data['party_name']));
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td  class="text-center px-2 py-2" >
                                                                <div class="w-100">
                                                                    <?php 
                                                                    $mode_of_payment = ""; $account_name ="";
                                                                    if(!empty($data['payment_type'])) {
                                                                        $payment_type = explode(",",$data['payment_type']);
                                                                        for($i=0; $i < count($payment_type); $i++) {
                                                                            echo $obj->encode_decode("decrypt", $payment_type[$i]);
                                                                            if($i < (count($payment_type))-1) {
                                                                                echo "<br>";
                                                                            }
                                                                        }                
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?>
                                                                </div>                        
                                                            </td>
                                                            <td  class="text-center px-2 py-2" >
                                                                <div class="w-100">
                                                                    <?php 
                                                                    $mode_of_payment = ""; $account_name ="";
                                                                        if(!empty($data['bank_id'])) {
                                                                            $bank_id = explode(",",$data['bank_id']);
                                                                            for($i=0; $i < count($bank_id); $i++) {
                                                                                $name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                                                                                echo $obj->encode_decode("decrypt", $name);
                                                                                if($i < (count($bank_id)) -1) {
                                                                                    echo "<br>";
                                                                                }
                                                                            }                            
                                                                        }else{
                                                                            echo "-";
                                                                        }
                                                                    ?>
                                                                </div>                          
                                                            </td>
                                                            <td  class="text-right px-2 py-2">
                                                                <?php
                                                                if(($data['type'] == "Receipt" || $data['type'] == 'Purchase Entry')) {
                                                                    if(!empty($data['amount'])) {
                                                                        
                                                                        $credit = explode(",",$data['amount']);
                                                                        for($i=0; $i < count($credit); $i++) {
        
                                                                            echo  $obj->numberFormat($credit[$i],2);
                                                                            $credit_amount += $credit[$i];
                                                                    
                                                                            if($i < (count($credit))-1) {
                                                                                echo "<div style='border-bottom: 1px solid grey;'>";
                                                                                echo "</div>";
                                                                            }
                                                                        }  
                                                                    }
                                                                }else if ($data['type'] == "Purchase Entry") {
                                                                    if(!empty($data['amount'])) {
                                                                        echo $obj->numberFormat($data['amount'],2);
                                                                        $credit_amount += $data['amount'];
                                                                    }
                                                                }else{
                                                                    echo "-";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-right px-2 py-2">
                                                                <?php               
                                                                if(($data['type'] == "Voucher") || ($data['type'] == "Expense") || ($data['type'] == 'Estimate')) {
                                                                    if(!empty($data['amount'])) {
                                                                        $debit = explode(",",$data['amount']);
                                                                        for($i=0; $i < count($debit); $i++) {
        
                                                                            echo  $obj->numberFormat($debit[$i],2);
                                                                            $debit_amount += $debit[$i];
                                                                    
                                                                            if($i < (count($debit))-1) {
                                                                                echo "<div style='border-bottom: 1px solid grey;'>";
                                                                                echo "</div>";
        
                                                                            }
                                                                            
                                                                        }  
                                                                    
                                                                    }
                                                                }else if ($data['type'] == 'Estimate') {
                                                                    if(!empty($data['amount'])) {
                                                                        $amount = explode(",",$data['amount']);
                                                                        echo $obj->numberFormat(array_sum($amount), 2);
                                                                        $debit_amount += array_sum($amount);
                                                                    }
                                                                }else{
                                                                    echo "-";
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                       <?php 
                                                    } ?>  
                                                </tbody>
                                                <?php 
                                                    $display_status =""; $id ="";
                                                    if(!empty($party_id)) {
                                                        $id = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'id');
                                                        if(!empty($id)) { 
                                                            if($credit_amount > $debit_amount )
                                                            {
                                                                $display_status ="Total";
                                                            }
                                                            else {
                                                                $display_status ="Total";
                                                            }
                                                        }
                                                        else{
                                                            if($credit_amount < $debit_amount )
                                                            {
                                                                $display_status ="Total";
                                                            }
                                                            else{
                                                                $display_status ="Total";
                                                            }
                                                        }
                                                    }
                                                
                                                ?>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="6" class="text-right py-2 px-2">Total</th>
                                                        <th class="sales_total text-right" ><?php if(!empty($credit_amount)){ echo $obj->numberFormat($credit_amount,2); } ?></th>
                                                        <th class="receipt_total text-right" ><?php if(!empty($debit_amount)){ echo $obj->numberFormat($debit_amount,2); } ?></th>
                                                    </tr>
                                                    <tr style="color:red;">
                                                        <th class="text-center px-2 py-2" colspan="6" >Balance</th>
                                                        <td class="text-right py-2 px-2"><?php if($credit_amount > $debit_amount) { echo $obj->numberFormat(($credit_amount- $debit_amount),2)." Cr"; } ?>
                                                        <td  class="text-right px-2 py-2"> <?php if($debit_amount > $credit_amount){ 
                                                            $total_pending_amount = $debit_amount - $credit_amount; echo $obj->numberFormat($total_pending_amount,2)." Dr"; } ?></td>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                                <?php 
                                            } else { ?>
                                                <tr>
                                                    <td colspan="8" style="border: 1px solid #000; text-align: center; padding: 2px 5px;">
                                                        No Records Found
                                                    </td>
                                                </tr>
                                            <?php } ?> 
                                        </table> 
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
        $("#daybookreport").addClass("active");
        table_listing_records_filter();
    });
</script>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script>
    $(document).ready(function(){
        $("#daybook").addClass("active");
        table_listing_records_filter();
    });
    function getReport(){
        if(jQuery('form[name="daybook_report_form"]').length > 0){
            jQuery('form[name="daybook_report_form"]').submit();
        } 
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_daybook_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("daybook_ledger_report.php","_self");
    }
</script>