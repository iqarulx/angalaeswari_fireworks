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

    // $from_date = date('Y-m-d'); $to_date = date("Y-m-d");
    $from_date = ""; $to_date = "";
    
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    
    $party_id="";
    if(isset($_POST['party_id'])) {
        $party_id = $_POST['party_id'];
    }

    $payment_mode_id = "";
    if(isset($_POST['payment_mode_id'])) {
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
    if(!empty($from_date) && !empty($to_date)){
        $excel_name = "Daybook Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
    }else{
        $excel_name = "Daybook Report"; 
    }

    $selected_payment_mode_name = '';
    foreach ($payment_mode_list as $mode) {
        if ($mode['payment_mode_id'] == $payment_mode_id) {
            $selected_payment_mode_name = $obj->encode_decode('decrypt', $mode['payment_mode_name']);
            break;
        }
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
                                                        Daybook Ledger 
                                                        <?php 
                                                        if(!empty($from_date)) { 
                                                            echo " - ( ".date('d-m-Y', strtotime($from_date)). " to "; 
                                                        } 
                                                        if(!empty($to_date)) { 
                                                            echo date('d-m-Y', strtotime($to_date))." )"; 
                                                        } 
                                                        ?> 
                                                        <br>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date <br> Bill Number</th>
                                                    <th>Bill Type</th>
                                                    <th>Name</th>
                                                    <th>Payment Type & Account</th>
                                                    <th>Credit</th>
                                                    <th>Debit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $credit_amount = 0; 
                                                $debit_amount = 0;

                                                if (!empty($total_records_list)) {
                                                    $i = 1;
                                                    foreach ($total_records_list as $data) {
                                                        $types = !empty($data['payment_type']) ? explode(",", $data['payment_type']) : [];
                                                        $banks = !empty($data['bank_id']) ? explode(",", $data['bank_id']) : [];
                                                        $amounts = !empty($data['payment_amount']) ? explode(",", $data['payment_amount']) : [];

                                                        $has_match = true;
                                                        if (!empty($payment_mode_id) && !empty($types)) {
                                                            $has_match = false;
                                                            foreach ($types as $index => $pt_enc) {
                                                                $pt = $obj->encode_decode("decrypt", $pt_enc);
                                                                if ($pt == $selected_payment_mode_name) {
                                                                    $has_match = true;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        if (!$has_match) continue;

                                                        ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td>
                                                                <?= date('d-m-Y', strtotime($data['bill_date'])); ?><br>
                                                                <?= $data['bill_number']; ?>
                                                                <?php if (in_array($data['type'], ['Receipt', 'Voucher', 'Expense'])) { ?>
                                                                    <br>
                                                                    <span style="font-size:9px;cursor:pointer;" onclick="open_daybook_report('<?= $data['bill_id']; ?>','<?= $data['type']; ?>')">
                                                                        <i class="bi bi-eye-fill text-dark fs-15"></i>
                                                                    </span>
                                                                <?php } ?>
                                                            </td>
                                                            <td><?= $data['type']; ?></td>
                                                            <td>
                                                                <?php
                                                                if (!empty($data['party_name']) && $data['party_name'] != 'NULL') {
                                                                    if ($data['type'] != "Expense") {
                                                                        echo html_entity_decode($obj->encode_decode("decrypt", $data['party_name']));
                                                                       
                                                                    } else {
                                                                        $expense_party_name = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $data['party_id'], 'expense_party_name');
                                                                        echo !empty($expense_party_name) ? html_entity_decode($obj->encode_decode("decrypt", $expense_party_name)) : "-";
                                                                        
                                                                    }
                                                                         
                                                                } else {
                                                                    if(!empty($data['category_id'])){
                                                                        $expense_category_name ="";
                                                                        $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $data['category_id'], 'expense_category_name');
                                                                        echo $obj->encode_decode('decrypt',$expense_category_name);
                                                                    }
                                                                        
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php
                                                                $credit_lines = [];
                                                                $debit_lines = [];

                                                                if ($data['type'] === 'Purchase Entry' || $data['type'] === 'Estimate') {
                                                                    echo "-";
                                                                } else {
                                                                    if (in_array($data['type'], ['Receipt', 'Voucher', 'Expense'])) {
                                                                        foreach ($types as $index => $pt_enc) {
                                                                            $pt = $obj->encode_decode("decrypt", $pt_enc);
                                                                            $bank_name = isset($banks[$index]) ? $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $banks[$index], 'bank_name') : '';
                                                                            $bank = !empty($bank_name) ? $obj->encode_decode("decrypt", $bank_name) : '';
                                                                            $amount = isset($amounts[$index]) ? floatval($amounts[$index]) : 0;

                                                                            if (empty($payment_mode_id) || $pt == $selected_payment_mode_name) {
                                                                                $display = $pt . (!empty($bank) ? " (" . $bank . ")" : "") . " - ₹" . $obj->numberFormat($amount, 2);

                                                                                if (in_array($data['type'], ['Receipt'])) {
                                                                                    $credit_lines[] = $display;
                                                                                    $credit_amount += $amount;
                                                                                } elseif (in_array($data['type'], ['Voucher', 'Expense'])) {
                                                                                    $debit_lines[] = $display;
                                                                                    $debit_amount += $amount;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                if ($data['type'] === 'Purchase Entry') {
                                                                    if (empty($amounts)) {
                                                                        $amt = floatval($data['amount']);
                                                                        if ($amt > 0) {
                                                                            $credit_amount += $amt;
                                                                        }
                                                                    }
                                                                } elseif ($data['type'] === 'Estimate') {
                                                                    $amt = floatval($data['amount']);
                                                                    if ($amt > 0) {
                                                                        $debit_amount += $amt;
                                                                    }
                                                                }

                                                                if ($data['type'] !== 'Purchase Entry' && $data['type'] !== 'Estimate') {
                                                                    echo !empty($credit_lines) || !empty($debit_lines)
                                                                        ? implode("<br>", array_merge($credit_lines, $debit_lines))
                                                                        : "-";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php
                                                                $credit_total = 0;
                                                                foreach ($credit_lines as $line) {
                                                                    preg_match('/₹([\d.,]+)/', $line, $matches);
                                                                    $credit_total += isset($matches[1]) ? floatval(str_replace(',', '', $matches[1])) : 0;
                                                                }
                                                               
                                                                if ($data['type'] === 'Purchase Entry' && empty($amounts)) {
                                                                    $credit_total += floatval($data['amount']);
                                                                }
                                                                echo $credit_total > 0 ? $obj->numberFormat($credit_total, 2) : "-";
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php
                                                                $debit_total = 0;
                                                                foreach ($debit_lines as $line) {
                                                                    preg_match('/₹([\d.,]+)/', $line, $matches);
                                                                    $debit_total += isset($matches[1]) ? floatval(str_replace(',', '', $matches[1])) : 0;
                                                                }
                                                                
                                                                if ($data['type'] === 'Estimate') {
                                                                    $debit_total += floatval($data['amount']);
                                                                }
                                                                echo $debit_total > 0 ? $obj->numberFormat($debit_total, 2) : "-";
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <tr><td colspan="8" class="text-center">No Records Found</td></tr>
                                                <?php } ?>
                                            </tbody>

                                            <?php if (!empty($total_records_list)) { ?>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5" class="text-right py-2 px-2">Total</th>
                                                    <th class="text-right"><?= $obj->numberFormat($credit_amount, 2); ?></th>
                                                    <th class="text-right"><?= $obj->numberFormat($debit_amount, 2); ?></th>
                                                </tr>
                                                <tr style="color:red;">
                                                    <th colspan="5" class="text-center px-2 py-2">Balance</th>
                                                    <td class="text-right py-2 px-2">
                                                        <?= ($credit_amount > $debit_amount) ? $obj->numberFormat($credit_amount - $debit_amount, 2) . " Cr" : "-"; ?>
                                                    </td>
                                                    <td class="text-right px-2 py-2">
                                                        <?= ($debit_amount > $credit_amount) ? $obj->numberFormat($debit_amount - $credit_amount, 2) . " Dr" : "-"; ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
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
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script>
    $(document).ready(function(){
        $("#daybookledgerreport").addClass("active");
        table_listing_records_filter();
    });
    
    function getReport(){
        if(jQuery('form[name="daybook_report_form"]').length > 0){
            jQuery('form[name="daybook_report_form"]').submit();
        } 
    }

    function open_daybook_report(bill_id,type) {
        var url = "";
        if(type =='Voucher') {
            url = "reports/rpt_voucher_a5.php?view_voucher_id=" + bill_id;
        } else if(type =='Receipt') {
            url = "reports/rpt_receipt_a5.php?view_receipt_id=" + bill_id;
        }else if(type =='Expense') {
            url = "reports/rpt_expense_entry_a5.php?view_expense_id=" + bill_id;  
        } 

        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url,
            success: function (check_login_session) {
                if (check_login_session == 1) {
                    jQuery('#PaymentModal .modal-header h1').html(type +"  Preview");

                    jQuery('.payment_modal_button').trigger("click");
                    var iframe = '<iframe src="' + url + '" width="100%" height="500px" style="border:none;"></iframe>';
                    jQuery('#PaymentModal .modal-body').html(iframe);
                } else {
                    window.location.reload();
                }
            }
        });

    }
    
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_daybook_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("daybook_ledger_report.php","_self");
    }
</script>