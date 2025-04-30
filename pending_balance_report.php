<?php 
	$page_title = "Pending Balance Report";
	include("include.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $loginner_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $loginner_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

    $filter_party_id =""; 
    $bill_company_id =$GLOBALS['bill_company_id'];

    $to_date = date('Y-m-d');  $current_date = date('Y-m-d');

    $from_date = date('Y-m-d', strtotime('-30 days', strtotime($to_date)));
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }

    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }

    if(isset($_POST['filter_party_id'])) {
        $filter_party_id = $_POST['filter_party_id'];
    }

    $filter_agent_party = "";
    if(isset($_POST['filter_agent_party'])){
        $filter_agent_party = $_POST['filter_agent_party'];
    }

    $view_type = "";
    if(isset($_POST['view_type'])){
        $view_type = $_POST['view_type'];
    }

    $filter_agent_customer ="";
    if(isset($_POST['filter_agent_customer']))
    {
        $filter_agent_customer = $_POST['filter_agent_customer'];
    }

    $party_list =array();
    // $select_query = "";
    // $select_query = "SELECT * FROM ".$GLOBALS['party_table']." WHERE (agent_id = '' OR agent_id = 'NULL') AND deleted = '0' ";
    // $party_list = $obj->getQueryRecords("", $select_query);
    
    $agent_list = array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '','');
 
    $total_party_list = array();
    if(!empty($view_type)) {
      
        if($view_type == '1') {
          
            $total_party_list = $agent_list;
        }
        else if($view_type == '2') {
            $total_party_list = $party_list;
        }
    }
    else {
        if(!empty($agent_list)) {
            foreach($agent_list as $data) {
                if(!empty($data)) {
                    $total_party_list[] = $data;
                }
            }
        }
        if(!empty($party_list)) {
            foreach($party_list as $data) {
                if(!empty($data)) {
                    $total_party_list[] = $data;
                }
            }
        }
    }

    $sales_list =array(); $total_records_list =array();
    $type ="";
    if($view_type == '1')
    {
        $type ="Agent";
    }
    elseif($view_type == '2')
    {
        $type = "Supplier";
    }
    elseif($view_type == '3')
    {
        $type ="Contractor";
    }
    elseif($view_type == '4')
    {
        $type ="Customer";
    }
    if(!empty($view_type))
    {
        $party_list = $obj->getPartyList($view_type);
    }
    
    $agent_customer_list =array();
    if($view_type == '1')
    {
        if(!empty($filter_party_id))
        {
            $agent_customer_list = $obj->getSelectedAgentCustomerList($filter_party_id);
        }
    }
    // print_r($agent_customer_list);
    echo $filter_party_id;
    if(!empty($filter_party_id))
    {
        // $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $filter_party_id, 'party_name');
        // echo $party_name."hello";
        // if(!empty($party_name)){
        //     // $total_records_list = $obj->balance_report($bill_company_id,$filter_party_id,$from_date,$to_date);
        //     $total_records_list= $obj->balance_report($type,$filter_party_id,$GLOBALS['bill_company_id'],'',$from_date,$to_date);
        //     $view_type = 2;
        // }else{
        //     if(!empty($filter_agent_party)){
             
                $total_records_list= $obj->balance_report($type,$filter_party_id,$GLOBALS['bill_company_id'],$filter_agent_customer,$from_date,$to_date);
        //     }
        //     else{
        //         $total_records_list= $obj->balance_report($type,$filter_party_id,$GLOBALS['bill_company_id'],'',$from_date,$to_date);
        //     }
        // }
    }
    else {
        if(!empty($view_type))
        {
            $sales_list = ""; 
            $sales_list= $obj->balance_report($type,'',$GLOBALS['bill_company_id'],'',$from_date,$to_date);
        }
        else
        {   
            $sales_list = ""; 
            $sales_list= $obj->balance_report('','',$GLOBALS['bill_company_id'],'',$from_date,$to_date);

        }
    }
    // print_r($sales_list);
    // $agent_party_list = array();
    // if(!empty($filter_party_id)){
    //     $agent_party_list = $obj->getTableRecords($GLOBALS['party_table'],'agent_id',$filter_party_id,'');
    // }

    $excel_name = "";
    $excel_name = "Pending Balance Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
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
                        <form name="pending_balance_report_form" method="POST">
                            <div class="border card-box" id="table_records_cover">
                                <div class="card-header align-items-center">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-2 col-md-3 col-12">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="view_type" data-dropdown-css-class="select2-danger" onchange="Javascript:getPartyName(this.value);getReport();" style="width: 100%;">
                                                        <option value="">Select Party Type</option>
                                                        <option value="1" <?php if($view_type == "1") { ?> selected <?php }  ?>>Agent</option>
                                                        <option value="2" <?php if($view_type == "2") { ?> selected <?php }  ?>>Supplier</option>
                                                        <option value="3" <?php if($view_type == "3") { ?> selected <?php }  ?>>Contractor</option>
                                                        <option value="4" <?php if($view_type == "4") { ?> selected <?php }  ?>>Customer</option>
                                                    </select>
                                                    <label>Select Party Type</label>
                                                </div>
                                            </div>        
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 px-lg-1">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="filter_party_id"  data-dropdown-css-class="select2-danger" onchange="Javascript:getReport();" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($party_list)) {
                                                            foreach($party_list as $data) {
                                                                
                                                                if(!empty($data['party_id']) && $data['party_id'] !=$GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>" <?php if(!empty($filter_party_id)){ if($filter_party_id == $data['party_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['party_name'])) {
                                                                                $data['party_name'] = $obj->encode_decode('decrypt', $data['party_name']);
                                                                                echo $data['party_name'];
                                                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                                    $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                                                    echo " - ".$data['city'];
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    
                                                    </select>
                                                    <label>Select Party</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php 
                                            if($view_type == '1')
                                            {
                                                ?>
                                                <div class="col-lg-2 col-md-3 col-6 px-lg-1">
                                                    <div class="form-group mb-2">
                                                        <div class="form-label-group in-border mb-0">
                                                            <select class="select2 select2-danger" name="filter_agent_customer"  data-dropdown-css-class="select2-danger" onchange="Javascript:getReport();" style="width: 100%;">
                                                            <option value="">Select</option>
                                                            <?php
                                                                if(!empty($agent_customer_list)) {
                                                                    foreach($agent_customer_list as $data) {
                                                                        
                                                                        if(!empty($data['party_id']) && $data['party_id'] !=$GLOBALS['null_value']) {
                                                                            ?>
                                                                            <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>" <?php if(!empty($filter_agent_customer)){ if($filter_agent_customer == $data['party_id']){ echo "selected"; } } ?>>
                                                                                <?php
                                                                                    if(!empty($data['party_name'])) {
                                                                                        $data['party_name'] = $obj->encode_decode('decrypt', $data['party_name']);
                                                                                        echo $data['party_name'];
                                                                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                                            $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                                                            echo " - ".$data['city'];
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                            </select>
                                                            <label>Select Agent Customer</label>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        <!-- <div class="col-lg-2 col-md-4 col-6 px-lg-1">
                                            <div class="input-group">
                                                <input type="text" class="form-control" style="height:34px;" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-3 col-md-4 col-12 px-lg-1 text-end">
                                            <button class="btn btn-primary m-1" style="font-size:11px;" type="button" onclick="window.open('reports/rpt_pending_payment.php?filter_party_id=<?php echo $filter_party_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&view_type=<?php echo $view_type; ?>&filter_agent_party=<?php echo $filter_agent_party; ?>&is_download=','_blank')"> <i class="fa fa-print"></i> Print </button>
                                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" onclick="window.open('reports/rpt_pending_payment.php?filter_party_id=<?php echo $filter_party_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&view_type=<?php echo $view_type; ?>&filter_agent_party=<?php echo $filter_agent_party; ?>&is_download=D','_blank')"> <i class="fa fa-file-pdf-o"></i> Pdf </button>
                                            <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onClick="ExportToExcel()"> <i class="fa fa-download"></i> Export </button> 
                                            <!-- <button class="btn btn-secondary float-right " style="font-size:11px;" type="button" onClick="ExportToExcel()"><i class="fa fa-download"></i>&ensp; Export </button>  -->
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
                                <div class="col-lg-11">
                                        <div class="table-responsive table-bordered">
                                            <table cellpadding="0" cellspacing="0" class="table display report_table no_$obj->numberFormat" style="width: 100%; border:solid 1px black;" id="tbl_pending_balance_list">

                                                
                                                <?php if(!empty($filter_party_id)) { ?>
                                                    <thead class="smallfnt">
                                                        <tr>
                                                            <th colspan="7" style="border-top: 1px solid #000!important; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 3px; font-size: 13px;">
                                                                Pending Payment Overall - <?php echo date('d-m-Y'); ?> <br>
                                                                <?php
                                                                    $party_name = "";
                                                                    if(!empty($filter_party_id)) {
                                                                        $party_name="";
                                                                        if($view_type == '1')
                                                                        {
                                                                            $party_name = $obj->getTableColumnValue($GLOBALS['agent_table'],'agent_id',$filter_party_id,'agent_name');
                                                                        }         
                                                                        elseif($view_type == '2')
                                                                        {
                                                                            $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$filter_party_id,'supplier_name');
                                                                        }
                                                                        elseif($view_type == '3')
                                                                        {
                                                                            $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'],'contractor_id',$filter_party_id,'contractor_name');
                                                                        }
                                                                        elseif($view_type == '4')
                                                                        {
                                                                            $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'],'customer_id',$filter_party_id,'customer_name');
                                                                        }
                                                                        if(!empty($party_name))
                                                                        {
                                                                            echo $obj->encode_decode("decrypt",$party_name);
                                                                        }
                                                                    }
                                                                ?>
                                                            </th>
                                                        </tr>
                                                        <tr >
                                                            <th style="border-top: 1px solid #000!important; border-left: 1px solid #000!important; border-bottom: 1px solid #000!important; border-right: 1px solid #000!important; text-align: center; padding: 3px; font-size: 13px;">S.No</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Date</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Bill No</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Type</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Credit</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Debit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $credit_amount = 0; $debit_amount = 0; $total =0; 
                                                                $opening_balance_list = array();
                                                                $opening_balance_list = $obj->getOpeningBalance($filter_party_id,$from_date,$to_date,$GLOBALS['bill_company_id'],$filter_agent_customer,$view_type);
                                                                $opening_debit = 0; $opening_credit = 0;
                                                                if(!empty($opening_balance_list)) {
                                                                    foreach($opening_balance_list as $data) {
                                                                        if(!empty($data['debit'])) {
                                                                            $opening_debit += $data['debit'];
                                                                        }

                                                                        if(!empty($data['credit'])) {
                                                                            $opening_credit += $data['credit'];
                                                                        }
                                                                        if(!empty($data['opening_balance']))
                                                                        {
                                                                            // echo $data['opening_balance_type'];
                                                                            if($data['opening_balance_type'] == 'Credit')
                                                                            {
                                                                                $opening_credit += $data['opening_balance'];
                                                                            }
                                                                            if($data['opening_balance_type'] == 'Debit')
                                                                            {
                                                                                $opening_debit += $data['opening_balance'];
                                                                            }
                                                                        }
                                                                        
                                                                    }
                                                                }
                                                                
                                                                ?>
                                                                <tr>
                                                                    <th colspan="4" style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                        Opening Balance
                                                                    </th>
                                                                    <th style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                        <?php
                                                                    
                                                                            if($opening_credit > $opening_debit) {
                                                                                $credit_amount = $opening_credit - $opening_debit;
                                                                                echo $obj->numberFormat($credit_amount, 2);
                                                                            } 
                                                                        ?>
                                                                    </th>
                                                                    <th style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                        <?php
                                                                            if($opening_debit > $opening_credit){
                                                                                $debit_amount = $opening_debit - $opening_credit;
                                                                                echo $obj->numberFormat($debit_amount, 2);
                                                                            } 
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                            <?php
                                                        // print_r($total_records_list);
                                                        if(!empty($total_records_list)) { ?>
                                                            <tbody>
                                                                <?php
                                                                    
                                                                    $sno=0;
                                                                
                                                                    foreach($total_records_list as $key => $data) {
                                                                    
                                                                    if(!empty($data['bill_list'])){
                                                                        foreach($data['bill_list'] as $key => $list) {
                                                                            
                                                                            $credit =0; $debit =0; $total_credit =0; $total_debit =0;
                                                                            if(!empty($list['credit']))
                                                                            {
                                                                                $credit =$list['credit'];
                                                                            }
                                                                            if(!empty($list['debit']))
                                                                            {
                                                                                $debit = $list['debit'];
                                                                            }
                                                                        
                                                                        $sno++;
                                                                        ?>
                                                                        <tr>
                                                                            <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $sno; ?></td>
                                                                            <td style="border:1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                                <?php 
                                                                                    echo date('d-m-Y',strtotime($list['bill_date']));
                                                                                    
                                                                                ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;cursor: pointer; x" class="text-center px-2 py-2" onClick="Javascript:getBillPDF('<?php if(!empty($list['bill_id'])) { echo $list['bill_id']; } ?>');">
                                                                                <?php
                                                                                if(!empty($list['bill_number'])) {
                                                                                    echo $bill_number =  $list['bill_number'];
                                                                                
                                                                                    // if (!preg_match('/^[A-Fa-f0-9]{32,}$/', $bill_number) && !base64_decode($bill_number, true)) {
                                                                                    //     echo htmlspecialchars($bill_number);
                                                                                    // } 
                                                                                }
                                                                                    
                                                                                ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                                <?php
                                                                                    if(!empty($list['bill_type'])) {
                                                                                        echo $list['bill_type'];
                                                                                                
                                                                                    }else{
                                                                                        echo " - ";

                                                                                    }
                                                                                    
                                                                                ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                                <?php if(!empty($credit)) { 
                                                                                    echo $obj->numberFormat($credit, 2); $credit_amount += $credit; ?>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                                <?php 
                                                                                if(!empty($debit)){ 
                                                                                    echo $obj->numberFormat($debit, 2); $debit_amount += $debit; ?>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    
                                                                        <?php
                                                                        }
                                                                    } 
                                                                    }
                                                                ?>
                                                            </tbody>
                                                            <?php 
                                                                $display_status =""; $id ="";

                                                                
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
                                                            ?>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="4" style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;">Total</th>
                                                                    <th class="sales_total" style="border: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;"><?php if(!empty($credit_amount)){ echo $obj->numberFormat($credit_amount,2); } ?></th>
                                                                    <th class="receipt_total" style="border: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;"><?php if(!empty($debit_amount)){ echo $obj->numberFormat($debit_amount,2); } ?></th>
                                                                </tr>
                                                                <tr style="color:red;">
                                                                    <th class="text-center px-2 py-2" colspan="4" style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Total</th>
                                                                    <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" class="text-right px-2 py-credit_amount2"><?php if($credit_amount > $debit_amount) { echo $obj->numberFormat(($credit_amount- $debit_amount),2)." Cr"; } ?>
                                                                    <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" class="text-right px-2 py-2"> <?php if($debit_amount > $credit_amount){ 
                                                                        $total_pending_amount = $debit_amount - $credit_amount; echo $obj->numberFormat($total_pending_amount,2)." Dr"; } ?></td>
                                                                    
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td colspan="6" style="border: 1px solid #000; text-align: center; padding: 2px 5px;">
                                                                    No Records Found
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                <?php }
                                                else{?>
                                                
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4" style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Pending Payment Report - <?php echo date('d-m-Y'); ?> </th>
                                                        </tr>
                                                        <tr>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 43px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">S.No</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Party Name</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Debit</th>
                                                            <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Credit</th>
                                                        </tr>
                                                    </thead>
                                                    <?php if(!empty($sales_list)) {
                                                    
                                                        ?>
                                                    <tbody>
                                                        <?php
                                                            $grand_pending = 0; $credit = 0; $debit = 0; $estimate_debit = 0; $credit_total_amount =0; $debit_total_amount =0; $grand_credit_total = 0; $grand_debit_total =0; $sno = 1;
                                                            foreach($sales_list as $key => $data) 
                                                            {      
                                                                $index = $key + 1; $credit_total = 0; $debit_total=0;
                                                                    ?>
                                                                    <tr>
                                                                        <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 43px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $index; ?></td>
                                                                        <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; padding: 2px 10px; font-size: 13px; cursor: pointer; vertical-align: middle; height: 30px;" onClick="Javascript:showpartyList('<?php echo $data['party_id']; ?>','<?php echo $data['party_type'];?>');">
                                                                        <?php
                                                                            if(!empty($data['party_name'])) {
                                                                                echo $obj->encode_decode('decrypt',$data['party_name']); 
                                                                                if(!empty($data['party_mobile_number'])) {
                                                                                    echo " - (".$obj->encode_decode('decrypt',$data['party_mobile_number']).")"; 
                                                                                }
                                                                            }
                                                                        ?>
                                                                        </td>
                                                                        <?php 
                                                                            
                                                                            if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Credit') ) {
                                                                                $credit_total = $credit_total + $data['opening_balance'];
                                                                                $credit = $credit + $credit_total;
                                                                            } 
                                                                            if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Debit') ) {
                                                                                $debit_total = $debit_total + $data['opening_balance'];
                                                                                $debit = $debit + $debit_total;
                                                                            }
                                                                            
                                                                            if(!empty($data['credit'])) {
                                                                            
                                                                                $credit_total = $credit_total + $data['credit'];
                                                                                $credit = $credit + $credit_total;
                                                                            }

                                                                            if(!empty($data['debit'])) {
                                                                            
                                                                                $debit_total = $debit_total + $data['debit'];
                                                                                $debit = $debit + $debit_total;
                                                                            }

                                                                            if($credit_total > $debit_total)
                                                                            {
                                                                                $total_amount = $debit_total - $credit_total;
                                                                            }   
                                                                            else{
                                                                                $total_amount = $credit_total - $debit_total;
                                                                            }

                                                                        ?>

                                                                        <td class="column1" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                            <?php 
                                                                            if($debit_total >= $credit_total){ $total_amount = $debit_total - $credit_total;echo $obj->numberFormat(($total_amount),2); $debit_total_amount = $debit_total_amount + $total_amount; }?>
                                                                        </td>
                                                                        <td class="column1" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                            <?php if($credit_total > $debit_total) { $total_amount = $credit_total  -$debit_total; echo $obj->numberFormat(($total_amount),2); $credit_total_amount = $credit_total_amount + $total_amount; }?>
                                                                        </td>
                                                                    </tr>
                                                                <?php $sno++; 
                                                                // }

                                                                ?>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                            <th colspan="2" style="border: 1px solid #000; padding: 2px 10px; font-size: 13px; text-align: right; vertical-align: middle; height: 30px;"></th>
                                                            <th class="column1_total" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <?php 
                                                                if(!empty($debit_total_amount)) {
                                                                        echo $obj->numberFormat(($debit_total_amount),2);
                                                                    } 
                                                                ?>
                                                            </th>
                                                            <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <?php
                                                                if(!empty($credit_total_amount)) {
                                                                        echo $obj->numberFormat($credit_total_amount,2);
                                                                } 
                                                                ?>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2" style="border: 1px solid #000; padding: 2px 10px; font-size: 13px; text-align: right; vertical-align: middle; height: 30px;">Total</th>
                                                            <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <?php 
                                                                if(!empty($credit_total_amount || ($debit_total_amount))) {
                                                                    if($debit_total_amount > $credit_total_amount)  {
                                                                        echo $obj->numberFormat(($debit_total_amount-$credit_total_amount),2);
                                                                    }
                                                                } 
                                                                ?>
                                                            </th>
                                                            <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <?php 
                                                                    if(!empty($credit_total_amount || ($debit_total_amount))) {
                                                                        if($credit_total_amount > $debit_total_amount)  {
                                                                            echo $obj->numberFormat(($credit_total_amount-$debit_total_amount),2);
                                                                        }
                                                                    } 
                                                                ?>
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td colspan="4" style="border: 1px solid #000; padding: 2px 5px; text-align: center;">
                                                                No Records Found
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            <?php } ?>
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
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script>
    $(document).ready(function(){
        $("#pending_balance_report").addClass("active");
        // table_listing_records_filter();
    });
</script>

<script>
    function getReport(){
        if(jQuery('form[name="pending_balance_report_form"]').length > 0){
            jQuery('form[name="pending_balance_report_form"]').submit();
        } 
    }
    function showpartyList(party_id,view_type) {
        if(jQuery('select[name="filter_party_id"]').length > 0) {
            jQuery('select[name="filter_party_id"]').val(party_id);
        }
        var type ="";
        if(view_type =='agent')
        {
            type = '1';
        }
        else if(view_type =='supplier')
        {
            type = '2';
        }
        else if(view_type == 'contractor')
        {
            type = "3";
        }
        else if(view_type ==' customer')
        {
            type = '4';
        }

        if(jQuery('select[name="view_type"]').length > 0) {
            jQuery('select[name="view_type"]').val(type);
        }
        getReport();
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_pending_balance_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("pending_balance_report.php","_self");
    }
</script>