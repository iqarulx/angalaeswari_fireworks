<?php 
	$page_title = "Purchase Tax Report";
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

	$company_state = ""; $supplier_state = ""; $gst_option = "";$supplier_name="";
	function combineAndSumUp ($myArray) {
		$finalArray = Array ();
		foreach ($myArray as $nkey => $nvalue) {
			$has = false;
			$fk = false;
			foreach ($finalArray as $fkey => $fvalue) {
				if ( ($fvalue['tax_value'] == $nvalue['tax_value']) && ($fvalue['hsn_value'] == $nvalue['hsn_value']) && ($fvalue['purchase_entry_number'] == $nvalue['purchase_entry_number'])) {
					$has = true;
					$fk = $fkey;
					break;
				}
			}
			if ( $has === false ) {
				$finalArray[] = $nvalue;
			} else {
				$finalArray[$fk]['total_amount'] += $nvalue['total_amount'];
				$finalArray[$fk]['quantity_value'] += $nvalue['quantity_value'];
				$finalArray[$fk]['purchase_entry_number'] = $nvalue['purchase_entry_number'];
			}

		}

		return $finalArray;

	}
    $supplier_list = array();
    $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'],'', '','');

    $to_date = "";
    $from_date = "";
    $filter_supplier_id=""; $filter_godown_id="";

    if(isset($_POST['filter_supplier_id'])) {
        $filter_supplier_id = $_POST['filter_supplier_id'];
    }
    
    // $from_date = date('d-m-Y', strtotime('-30 days')); $to_date = date("d-m-Y"); 
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    } 


    // echo "from_date".$from_date;
    $total_records_list =array();
    $total_records_list = $obj->getPurchaseTaxReport($filter_supplier_id,$from_date,$to_date);

    if(!empty($filter_supplier_id)){
        $supplier_name =$obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$filter_supplier_id,'supplier_name');
        $supplier_name = $obj->encode_decode('decrypt',$supplier_name);
    }
    $excel_download_name ="";
    $excel_download_name = "Purchase Tax Report -".$supplier_name ." (".$from_date ." to ".$to_date .")";
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
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
                        <div class="card">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box bg-white" id="table_records_cover">
                                <form name="purchase_tax_report_form" method="POST">
                                    <div class="row justify-content-end px-2 my-3">
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="text" id="from_date" name="from_date" class="form-control shadow-none date_field" onchange="Javascript:table_listing_records_filter();getOverallReport();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" >
                                                    <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="text" id="to_date" name="to_date" class="form-control shadow-none date_field"  onchange="Javascript:table_listing_records_filter();getOverallReport();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" required="">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-4 col-12">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border mb-0">
                                                        <select class="select2 select2-danger" name="filter_supplier_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onChange="Javascript:table_listing_records_filter();getOverallReport();">
                                                            <option value="0">Select</option>
                                                            <?php
                                                            if(!empty($supplier_list)) {
                                                                foreach($supplier_list as $data) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>"<?php if(!empty($filter_supplier_id)){ if($filter_supplier_id == $data['supplier_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['name_mobile_city'])) {
                                                                                $data['name_mobile_city'] = $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                                                echo $data['name_mobile_city'];   
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                        <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <label>Supplier Name</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-4">
                                                <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onClick="ExportToExcel()"> <i class="fa fa-download"></i> Export </button>
                                            </div> 
                                    </div>
                                </form>
                                <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; width: 100%;">
                                    <table id='tbl_purchase_tax_list' class="table display report_table" style="width: 1000px;" >

                                        <thead>
                                            <tr style="border-top: 1px solid #000!important;">
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">S.No</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Bill.No & Date</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Supplier Name & Identification</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="10">Tax Details</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3"> Charges Value </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Taxable Value</th>

                                                
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="3"> Tax Value </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Total Tax Value</th>
                                                
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Total Amount</th>
                                            </tr>

                                            <tr>
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 0% </th> 

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 5% </th> 

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 12% </th> 

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 18% </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 28% </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="2"> CGST </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="2"> SGST </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="2"> IGST </th>

                                            </tr>

                                            <tr style="border-top:0;">

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"> Quantity</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                    <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php $index = "";

                                            if(!empty($total_records_list)) {
                                                $net_amount = 0; $net_tax = 0; $cgst_net_tax = 0; $igst_net_tax = 0; $net_product_tax = 0; $grand_charges = 0; $grand_charges_amount = 0;$sub_total_amnt = 0;$grand_loading_charge_amount =0;$grand_loading_charges =0; $total_amount = 0; $other_charges_id = array(); $other_charges_total = 0; $other_charges_values = array(); $charges_type = array();
                                                $charges_total = 0; $loading_charges_total = 0; $dis_pro_amt = 0; $total_product_amount = 0;
                                                $sub_total_amt = 0; $charges_amt = 0; $dis_value = 0; $taxable_value = 0; $total_tax_value_tbl = 0; $bill_value = 0; $cgst_value_tbl = 0; $sgst_value_tbl = 0; $igst_value_tbl = 0;
                                                $total_cgst_value = 0; $total_igst_value = 0; $total_sgst_value = 0;  $total_charges_amt = 0; $total_taxable_value = 0; $tax_value_tbl = 0; $bill_total_value = 0; $total_other_charges = 0; $total_discount_amt =0;
                                                $grand_charges_amt =0;

                                                foreach($total_records_list as $key => $data) {

                                                    $gst_number = ""; $tax_value = array(); $row_amount = array();  $quantity_values = array();
                                                    $product_hsn_code = array(); 
                                                    $rate_values =array(); $hsn_sac = ""; $supplier_state = ""; $tax_option =''; $purchase_date = ""; 
                                                    $purchase_entry_number = ""; $supplier_name = ""; $discount_option = ""; $product_discount = array(); 
                                                    $charges_values = array(); $charges_value = 0; $greater_tax = 0; $identification = "";  
                                                    $individual_tax = array();$charges=0; $discount_value =0;$loading_charges =0;
                                                    $discounts = array(); $sub_total_savings = 0;
                                                    $index = $key + 1;
                                                    $discount_values = ''; $bill_number = "";
                                                    $discount_value = ""; $purchase_entry_number = ""; $net_total = 0; $product_ids = ""; $tax_value1 = ""; $grand_discount = 0; $sub_total = 0; $total_discount = 0; $company_state = ""; 
                                                    if(!empty($data['supplier_state'])) {
                                                        $supplier_state = $data['supplier_state'];
                                                    }

                                                    if(!empty($data['company_state'])) {
                                                        $company_state = $data['company_state'];
                                                    }

                                                    if(!empty($data['discount_option'])) {
                                                        $discount_option = $data['discount_option'];
                                                    }

                                                    if(!empty($data['quantity'])) {
                                                        $quantity_values = explode(",", $data['quantity']);
                                                    }
                                                    if(!empty($data['product_discounts'])) {
                                                        $product_discount = explode(",", $data['product_discounts']);
                                                    }

                                                    if(!empty($data['product_id'])) {
                                                        $product_ids = explode(",", $data['product_id']);
                                                    }

                                                    if(!empty($data['tax_type'])){
                                                        $tax_type = $data['tax_type'];
                                                    }

                                                    if(!empty($data['gst_option'])){
                                                        $gst_option = $data['gst_option'];
                                                    }

                                                    if($tax_type == "1"){
                                                        if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                                                            $tax_value = explode(",", $data['product_tax']);
                                                        }
                                                    }
                                                    else {
                                                        if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value']) {
                                                            $tax_value1=$data['overall_tax'];
                                                        }
                                                    }

                                                    if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                                                        $row_amount = explode(",", $data['product_amount']);
                                                    }

                                                    if(!empty($data['total_tax_value']) && $data['total_tax_value'] != $GLOBALS['null_value']) {
                                                        $tax_value_tbl = $data['total_tax_value'];
                                                    }

                                                    if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                                                        $bill_value = $data['total_amount'];
                                                    }

                                                  
                                                    if(!empty($data['final_rate']) && $data['final_rate'] != $GLOBALS['null_value']) {

                                                        $rate_values = explode(",", $data['final_rate']);

                                                    }
                                                    if(!empty($data['tax_option'])) {
                                                        $tax_option = $data['tax_option'];
                                                    }

                                                    if(!empty($data['purchase_entry_number'])) {
                                                        $purchase_entry_number = $data['purchase_entry_number'];
                                                    }

                                                    if(!empty($data['discount_value']) && $data['discount_value'] != $GLOBALS['null_value']) {
                                                        $disc_value = $data['discount_value'];
                                                    }
                                                    
                                                    if(!empty($data['delivery_charges']) && $data['delivery_charges'] != $GLOBALS['null_value']) {
                                                        $charges =  $data['delivery_charges'];
                                                    }

                                                    if(!empty($data['charges_type']) && $data['charges_type'] != $GLOBALS['null_value']) {
                                                        $charges_type = explode(",", $data['charges_type']);
                                                    }

                                                    if(!empty($data['other_charges_value']) && $data['other_charges_value'] != $GLOBALS['null_value']) {
                                                        $other_charges_values = explode(",", $data['other_charges_value']);
                                                    }
                                                    
                                                    if(!empty($data['other_charges_total']) && $data['other_charges_total'] != $GLOBALS['null_value']) {
                                                        $other_charges_total = explode(",", $data['other_charges_total']);
                                                        $total_other_charges = array_sum($other_charges_total); 
                                                    }

                                                    if(!empty($data['other_charges_id']) && $data['other_charges_id'] != $GLOBALS['null_value']) {
                                                        $other_charges_id = explode(",", $data['other_charges_id']);
                                                    }

                                                    if(!empty($data['sub_total']) && $data['sub_total'] != $GLOBALS['null_value']) {
                                                        $total_product_amount =  $data['sub_total'];
                                                    }

                                                    if(!empty($data['cgst_value']) && $data['cgst_value'] != $GLOBALS['null_value']) {
                                                        $cgst_value_tbl =  $data['cgst_value'];
                                                        $total_cgst_value += $cgst_value_tbl; 
                                                    }

                                                    if(!empty($data['sgst_value']) && $data['sgst_value'] != $GLOBALS['null_value']) {
                                                        $sgst_value_tbl =  $data['sgst_value'];
                                                        $total_sgst_value += $sgst_value_tbl;
                                                    }

                                                    if(!empty($data['igst_value']) && $data['igst_value'] != $GLOBALS['null_value']) {
                                                        $igst_value_tbl =  $data['igst_value'];
                                                        $total_igst_value += $igst_value_tbl;
                                                    }


                                                    for($p = 0; $p < count($product_ids); $p++) { 
                                                        $row_amount[$p] = trim($row_amount[$p]);
                                                        if(!empty($row_amount[$p])){
                                                            $amount = $row_amount[$p];
                                                            $sub_total += $amount;
                                                            $sub_total_savings += $amount;
                                                        }
                                                    }

                                                
                                                    $overall_discount = 0;  
                                                    for($j=0;$j < count($product_ids);$j++){
                                                        if(!empty($tax_value1)){
                                                            $tax_value[$j] = $tax_value1;
                                                        }

                                                        if(!empty($tax_value[$j])){
                                                            $product_amount = 0;  $overall_discount = 0;
                                                            $amount = $row_amount[$j];
                                                            $product_amount = $row_amount[$j];

                                                            if(!empty($amount)) {
                                                                $amount = number_format($amount, 2);
                                                                $amount = str_replace(",", "", $amount);
                                                                $sub_total_amt +=$amount;
                                                            }

                                                            if(!empty($product_ids[$j])){
                                                                $product_hsn_code = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$j],'hsn_code');
                                                            }

                                                            $individual_tax[] = array('hsn_value' => $product_hsn_code,'tax_value' => $tax_value[$j], 'total_amount' => $amount,'quantity_value' => $quantity_values[$j],'purchase_entry_number' => $purchase_entry_number);
                                                        }
                                                    }

                                                    array_multisort(array_column($individual_tax, "purchase_entry_number"), SORT_ASC,array_column($individual_tax, "hsn_value"), SORT_ASC,array_column($individual_tax, "tax_value"), SORT_ASC, $individual_tax);

                                                    $is_per =0;
                                                    $sub_total_amnt = $sub_total_amt;
                                                
                                                    if(!empty($other_charges_id)){
                                                        for($p=0;$p<count($other_charges_id);$p++){
                                                            if(!empty($charges_type[$p]) && $charges_type[$p] !=$GLOBALS['null_value']){
                                                                if($charges_type[$p] =='plus'){
                                                                   $taxable_value += $other_charges_total[$p];
                                                                   $total_charges_amt += $other_charges_total[$p];
                                                                }else if($charges_type[$p] =='minus'){
                                                                    $taxable_value += $other_charges_total[$p];
                                                                    $total_discount_amt += $other_charges_total[$p];
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if(!empty($total_discount_amt)){
                                                        $total_product_amount = $total_product_amount - $total_discount_amt + $total_charges_amt;
                                                        $taxable_value = $total_product_amount;
                                                    }else {
                                                        $taxable_value = $total_product_amount + $total_charges_amt;
                                                    }

                                                    if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                                    <tr>
                                                        <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $index; ?></td>
                                                        <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                            <?php 
                                                                if(!empty($data['purchase_entry_date'])) { 
                                                                    $purchase_entry_date = date("d-m-Y", strtotime($data['purchase_entry_date']));
                                                                } 

                                                                if(!empty($data['purchase_entry_number'])) {
                                                                    $purchase_entry_number = $data['purchase_entry_number'];
                                                                }

                                                                echo $purchase_entry_number.' <br> '.$purchase_entry_date;
                                                            ?>
                                                        </td>
                                                        <td class="px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                            <div class="w-100">
                                                                <?php
                                                                    $supplier_id = "";
                                                                    if(!empty($data['supplier_id'])) {
                                                                        $supplier_name = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$data['supplier_id'],'supplier_name');

                                                                        echo $obj->encode_decode('decrypt',$supplier_name);

                                                                        $supplier_city = "";

                                                                        $supplier_city = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$data['supplier_id'],'city');

                                                                        $identification = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $data['supplier_id'], 'identification');
                                                                        if(!empty($identification) && $identification != $GLOBALS['null_value']) {
                                                                        }
                                                                        else{
                                                                            $identification = "";
                                                                        }
                                                                         if(!empty($identification)){

                                                                            echo ' - '.$obj->encode_decode('decrypt',$identification);

                                                                        }

                                                                    }

                                                                ?>
                                                            </div>

                                                        </td>


                                                        <?php
                                                           $tax_amount = 0; $tax_amount1 = 0; $strtax_value = ""; $k=0; $strtax_amount = 0; $product_hsn_sac =array(); $final_array = array(); $total_tax_value = 0; $tax_total =0; $tax_plus_value1 = 0; $grand_amount = 0; $hsn_sac = array();

                                                            $final_array = combineAndSumUp($individual_tax);

                                                            $zero_per = 0; $five_per = 0; $twelve_per = 0; $eighteen_per = 0; $twenty_eight_per = 0; $zero_hsn_quantity = ""; $five_hsn_quantity = ""; $twelve_hsn_quantity = ""; $eighteen_hsn_quantity = ""; $twenty_eight_hsn_quantity = ""; $product_tax = 0; $five_percentage = 100; $twelve_percentage = 100; $eighteen_percentage = 100; $twenty_eight_percentage = 100; $hsn_sac = array();

                                                            foreach($final_array as $tax_data) {
                                                                $per_available=strpos($tax_data['tax_value'],'%');
                                                                $discounted_product_amount = 0;
                                                                $tax_per = 0;
                                                                if(!empty($per_available)){
                                                                    $tax_per=str_replace("%"," ",$tax_data['tax_value']);
                                                                }else{
                                                                    $tax_per=$tax_data['tax_value'];
                                                                }

                                                                $tax_per = str_replace(" ","",$tax_per);
                                                                $dis_value = 0;
                                                                $discounted_product_amount = $tax_data['total_amount'];
                                                                
                                                                if($tax_per == "0")
                                                                { 
                                                                    if(!empty($tax_data['total_amount'])) {
                                                                        if(!empty($zero_hsn_quantity)){
                                                                            $zero_hsn_quantity.='<br>';
                                                                        }

                                                                        $zero_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value'] - $total_discount_amt;

                                                                        $zero_per+= $discounted_product_amount - $total_discount_amt;

                                                                        $grand_amount += ($discounted_product_amount); 

                                                                    } 

                                                                }

                                                                if($tax_per == "5")

                                                                { 

                                                                    if(!empty($tax_data['total_amount'])) {

                                                                        if(!empty($five_hsn_quantity)){

                                                                            $five_hsn_quantity.='<br>';

                                                                        }

                                                                        $five_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value']; 

                                                                        $five_per+= $discounted_product_amount - $total_discount_amt;

                                                                        $product_tax+=(($discounted_product_amount*5)/$five_percentage);

                                                                        $grand_amount += ($discounted_product_amount); 
                                                                    } 
                                                                    
                                                                }

                                                                if($tax_per == "12"){ 
                                                                    if(!empty($tax_data['total_amount'])) {
                                                                        if(!empty($twelve_hsn_quantity)){
                                                                            $twelve_hsn_quantity.='<br>';
                                                                        }

                                                                        $twelve_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value']; 

                                                                        $twelve_per+= $discounted_product_amount - $total_discount_amt;

                                                                        $product_tax+=(($discounted_product_amount*12)/$twelve_percentage);

                                                                        $grand_amount += ($discounted_product_amount); 
                                                                    } 

                                                                }

                                                                

                                                                if($tax_per == "18")
                                                                { 
                                                                    if(!empty($tax_data['total_amount'])) {  
                                                                        if(!empty($eighteen_hsn_quantity)){

                                                                            $eighteen_hsn_quantity.='<br>';

                                                                        }

                                                                        $eighteen_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value'];

                                                                        $eighteen_per+= $discounted_product_amount - $total_discount_amt;
                                                                        $product_tax+=(($discounted_product_amount*18)/$eighteen_percentage);

                                                                        $grand_amount += ($discounted_product_amount); 
                                                                    } 

                                                                }

                                                                if($tax_per == "28")
                                                                { 

                                                                    if(!empty($tax_data['total_amount'])) {  

                                                                        if(!empty($twenty_eight_hsn_quantity)){

                                                                            $twenty_eight_hsn_quantity.='<br>';

                                                                        }

                                                                        $twenty_eight_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value'];

                                                                        $twenty_eight_per+= $discounted_product_amount - $total_discount_amt;

                                                                        $product_tax+=(($discounted_product_amount*28)/$twenty_eight_percentage);

                                                                        $grand_amount += ($discounted_product_amount); 

                                                                    } 

                                                                }

                                                            }

                                                            $percentage = 100;

                                                            if($zero_per!="0"){
                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$zero_hsn_quantity.'</td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$zero_per.'</td>';

                                                            }else{

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                            }

                                                            if($five_per!="0"){

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$five_hsn_quantity.'</td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$five_per.'</td>';
                                                            }

                                                            else{

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                            }
                                                            if($twelve_per!="0"){

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twelve_hsn_quantity.'</td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twelve_per.'</td>';
                                                            }

                                                            else{

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                            }

                                                            if($eighteen_per!="0"){

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$eighteen_hsn_quantity.'</td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$eighteen_per.'</td>';

                                                            }

                                                            else{

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                            }

                                                            if($twenty_eight_per!="0"){

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twenty_eight_hsn_quantity.'</td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twenty_eight_per.'</td>';

                                                            }

                                                            else{

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                            } 

                                                            if(!empty($product_tax) && !empty($charges_values)){
                                                                $product_tax += $charges_tax;
                                                            } ?>

                                                            <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($total_charges_amt,2); 
                                                            $grand_charges_amt +=$total_charges_amt?></td> 

                                                            <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($taxable_value,2);
                                                            $total_taxable_value += $taxable_value; ?></td>

                                                            <?php
                                                            
                                                            if($company_state==$supplier_state)

                                                            { ?>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($cgst_value_tbl,2); ?></td>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($sgst_value_tbl,2); ?></td>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>

                                                            <?php $total_tax_value += $product_tax; $cgst_net_tax += $total_tax_value; }

                                                            else { ?>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($igst_value_tbl,2); ?></td>

                                                            <?php $total_tax_value += $product_tax; $igst_net_tax += $total_tax_value; } 

                                                            ?>

                                                            <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($tax_value_tbl,2);
                                                            $total_tax_value_tbl += $tax_value_tbl;  ?></td>

                                                            <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <?php round($grand_amount+$total_tax_value-$overall_discount+$charges_total+$loading_charges_total).'.00'; ?>
                                                                <?php echo round($bill_value).'.00'; 
                                                                $bill_total_value += $bill_value;  ?>
                                                            </td>
                                                    </tr>

                                                    <?php

                                                    $net_amount += round($grand_amount+$total_tax_value-$overall_discount+$charges_total+$loading_charges_total);

                                                    $net_product_tax+=$product_tax; } ?>

                                                <tr>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" colspan="13">Total</td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($grand_charges_amt,2); ?></td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_taxable_value,2); ?></td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_cgst_value,2); ?></td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_sgst_value,2); ?></td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_igst_value,2); ?></td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_tax_value_tbl,2); ?></td>

                                                    <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo round($bill_total_value).'.00'; ?></td>

                                                </tr>

                                            <?php }

                                            else { ?>

                                                    <tr>
                                                        <td class="text-center" style="width: 100%;" colspan="100%">Sorry! No records found</td>
                                                    </tr>


                                            <?php } ?>

                                            <?php if($index == 1){ ?>

                                                <tr style="height:40px;"></tr>

                                            <?php } ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>  
            </div>
        </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>

<script type="text/javascript" src="include/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        if(jQuery('.date_field').length > 0) {
            jQuery('.date_field').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                startDate: "<?php if(!empty($prev_date)) { echo $prev_date; } ?>",
                endDate: "today"
            });
        }
        $("#purchasetax_report").addClass("active");
        table_listing_records_filter();
    });
    
    function getOverallReport(){
        if(jQuery('form[name="purchase_tax_report_form"]').length > 0){
                jQuery('form[name="purchase_tax_report_form"]').submit();
        }
        
    }

    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_purchase_tax_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('purchase_tax_report.' + (type || 'xlsx')));
        window.open("purchase_tax_report.php","_self");
    }
</script>
