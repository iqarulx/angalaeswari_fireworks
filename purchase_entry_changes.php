<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['purchase_entry_module'];
        }
    }

	if(isset($_REQUEST['show_purchase_entry_id'])) { 
        $bill_date = ""; $bill_number = ""; $supplier_id = ""; $Vehicle_name = ""; $godown_id = ""; $gst_option = 0; $product_id = "";
        $tax_type = 0; $tax_option = 0; $overall_tax = "";
        $current_date = date('Y-m-d');
        $show_purchase_entry_id = $_REQUEST['show_purchase_entry_id'];
        $show_purchase_entry_id = trim($show_purchase_entry_id);

        $purchase_entry_date = date('Y-m-d'); $current_date = date('Y-m-d');$purchase_entry_number = "";$gst_option = 0; $tax_type = 0; $tax_option = 0; $overall_tax = "";$purchase_godown_ids = "";
        $godown_ids = array();$brand_ids = array();$product_id = array(); $product_names = array();$cases = array();$piece_per_cases = array();$rate_per_piece = array();$rate_per_cases = array(); $product_amount = array();$discount = ""; $discount_value = "";$extra_charges = ""; $extra_charges_value = "";$hsn_codes=array(); $round_off = "";$total_amount = "";
        $purchase_entry_list = array();$godown_type ="";$purchase_godown_ids =""; $purchase_godown_names = "";$stockupdate = 0;$received_slip_id =""; $selected_rate =""; $selected_per =""; $per_type =array(); $unit_ids =array(); $unit_names=array(); $other_charges_id = array(); $charges_type = array(); $other_charges_value = array();  $product_tax =array(); $product_group = ""; $location_type = ""; $location_id = array(); $first_location_id = "";
        $cancelled = 0; $content = array();
        $purchase_entry_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $show_purchase_entry_id, '');
        if(!empty($purchase_entry_list)) {
            foreach($purchase_entry_list as $data) {
                if(!empty($data['purchase_entry_date'])) {
                    $purchase_entry_date = date('Y-m-d', strtotime($data['purchase_entry_date']));
                }
                if(!empty($data['purchase_entry_number']) && $data['purchase_entry_number'] != $GLOBALS['null_value']) {
                    $purchase_entry_number = $data['purchase_entry_number'];
                }
                
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_id = $data['godown_id'];
                }
                if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                    $godown_name = $data['godown_name'];
                }
            
                if(!empty($data['supplier_id']) && $data['supplier_id'] != $GLOBALS['null_value']) {
                    $supplier_id = $data['supplier_id'];
                }
                if(!empty($data['product_group']) && $data['product_group'] != $GLOBALS['null_value']) {
                    $product_group = $data['product_group'];
                }
                if(!empty($data['location_type']) && $data['location_type'] != $GLOBALS['null_value']) {
                    $location_type = $data['location_type'];
                }
                if(!empty($data['vehicle']) && $data['vehicle'] != $GLOBALS['null_value']) {
                    $Vehicle_name = $data['vehicle'];
                }
                if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                    $gst_option = $data['gst_option'];
                }
                if(!empty($data['tax_type']) && $data['tax_type'] != $GLOBALS['null_value']) {
                    $tax_type = $data['tax_type'];
                }
                if(!empty($data['tax_option']) && $data['tax_option'] != $GLOBALS['null_value']) {
                    $tax_option = $data['tax_option'];
                }
                if(!empty($data['company_state']) && $data['company_state'] != $GLOBALS['null_value']) {
                    $company_state = $data['company_state'];
                }
                if(!empty($data['supplier_state']) && $data['supplier_state'] != $GLOBALS['null_value']) {
                    $supplier_state = $data['supplier_state'];
                }
                if(!empty($data['stockupdate']) && $data['stockupdate'] != $GLOBALS['null_value']) {
                    $stockupdate = $data['stockupdate'];
                }
                if(!empty($data['location_id']) && $data['location_id'] != $GLOBALS['null_value']) {
                    $location_id = $data['location_id'];
                    $location_id = explode(",", $location_id);
                    $location_id = array_reverse($location_id);
                    $first_location_id = $location_id[0];
                }
                if(!empty($data['location_name']) && $data['location_name'] != $GLOBALS['null_value']) {
                    $location_name = $data['location_name'];
                    $location_name = explode(",", $location_name);
                    $location_name = array_reverse($location_name);
                }
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_id = $data['product_id'];
                    $product_id = explode(",", $product_id);
                    $product_id = array_reverse($product_id);
                    $product_count = count($product_id);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_name = $data['product_name'];
                    $product_name = explode(",", $product_name);
                    $product_name = array_reverse($product_name);
                }
                if(!empty($data['cases']) && $data['cases'] != $GLOBALS['null_value']) {
                    $cases = $data['cases'];
                    $cases = explode(",", $cases);
                    $cases = array_reverse($cases);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_id = $data['unit_id'];
                    $unit_id = explode(",", $unit_id);
                    $unit_id = array_reverse($unit_id);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_name = $data['unit_name'];
                    $unit_name = explode(",", $unit_name);
                    $unit_name = array_reverse($unit_name);
                }
               
                if(!empty($data['per_type']) && $data['per_type'] != $GLOBALS['null_value']) {
                    $per_type = $data['per_type'];
                    $per_type = explode(",", $per_type);
                    $per_type = array_reverse($per_type);
                }
                if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                    $product_amount = $data['product_amount'];
                    $product_amount = explode(",", $product_amount);
                    $product_amount = array_reverse($product_amount);
                }
                if(!empty($data['discount']) && $data['discount'] != $GLOBALS['null_value']) {
                    $discount = $data['discount'];
                }
                if(!empty($data['discount_value']) && $data['discount_value'] != $GLOBALS['null_value']) {
                    $discount_value = $data['discount_value'];
                }
                if(!empty($data['extra_charges']) && $data['extra_charges'] != $GLOBALS['null_value']) {
                    $extra_charges = $data['extra_charges'];
                }
                if(!empty($data['extra_charges_value']) && $data['extra_charges_value'] != $GLOBALS['null_value']) {
                    $extra_charges_value = $data['extra_charges_value'];
                }
                if(!empty($data['round_off']) && $data['round_off'] != $GLOBALS['null_value']) {
                    $round_off = $data['round_off'];
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_amount = $data['total_amount'];
                }
                if(!empty($data['received_slip_id']) && $data['received_slip_id'] != $GLOBALS['null_value']) {
                    $received_slip_id = $data['received_slip_id'];
                }
                if(!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                    $unit_type = $data['unit_type'];
                    $unit_type = explode(",", $unit_type);
                    $unit_type = array_reverse($unit_type);
                }
                if(!empty($data['content'])) {
                    $content = $data['content'];
                    $content = explode(",", $content);
                    $content = array_reverse($content);
                }
                if(!empty($data['total_qty']) && $data['total_qty'] != $GLOBALS['null_value']) {
                    $total_qty = $data['total_qty'];
                    $total_qty = explode(",", $total_qty);
                    $total_qty = array_reverse($total_qty);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                    $quantity = array_reverse($quantity);
                }
                if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                    $rate = $data['rate'];
                    $rate = explode(",", $rate);
                    $rate = array_reverse($rate);
                }
                if(!empty($data['per']) && $data['per'] != $GLOBALS['null_value']) {
                    $per = $data['per'];
                    $per = explode(",", $per);
                    $per = array_reverse($per);
                }
                if(!empty($data['final_rate']) && $data['final_rate'] != $GLOBALS['null_value']) {
                    $final_rate = $data['final_rate'];
                    $final_rate = explode(",", $final_rate);
                    $final_rate = array_reverse($final_rate);
                }
                if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                    $product_amount = $data['product_amount'];
                    $product_amount = explode(",", $product_amount);
                    $product_amount = array_reverse($product_amount);
                }
                if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                    $product_tax = $data['product_tax'];
                    $product_tax = explode(",", $product_tax);
                    $product_tax = array_reverse($product_tax);
                }
                if(!empty($data['other_charges_id']) && $data['other_charges_id'] != $GLOBALS['null_value']) {
                    $other_charges_id = $data['other_charges_id'];
                    $other_charges_id = explode(",", $other_charges_id);
                    $charges_count = count($other_charges_id);
                }
                if(!empty($data['charges_type']) && $data['charges_type'] != $GLOBALS['null_value']) {
                    $charges_type = $data['charges_type'];
                    $charges_type = explode(",", $charges_type);
                }
                if(!empty($data['other_charges_value']) && $data['other_charges_value'] != $GLOBALS['null_value']) {
                    $other_charges_value = $data['other_charges_value'];
                    $other_charges_value = explode(",", $other_charges_value);
                }
                if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value'])
                {
                    $overall_tax =$data['overall_tax'];
                }
                if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                    $cancelled = $data['cancelled'];
                }
            }
        }

        $supplier_list = array();
        $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '', '');

        $supplier_count = 0;
        $supplier_count = count($supplier_list);

        $group_list = array();
        $group_list = $obj->getTableRecords($GLOBALS['group_table'], '', '', '');

        $godown_list = array(); $magazine_list = array();
        if(!empty($show_purchase_entry_id)){
            if($location_type == "1" && ($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d")){
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $location_id[0], '');
            }
            else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d" && $location_type == "1"){

                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $location_id[0], '');
            } else if($location_type == "2" && ($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d")){
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '','', '');

            } else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d" && $location_type == "2"){
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
            }
        }
        else{
            if(!empty($login_godown_id)) {
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
            }else{
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
            }
            if(!empty($login_magazine_id)) {
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_magazine_id, '');
            }else{
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
            }
        }

                
        $godown_count = 0;
        $godown_count = count($godown_list);
        
        $magazine_count = 0;
        $magazine_count = count($magazine_list);

        $product_list = array();
        if(!empty($edit_id)){
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
        }
         
        $count_of_product = 0;
        $count_of_product = count($product_list);
        
        $charges_list = array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');
        $company_state = "";$country = "India"; $state = "";
		$company_state = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'state');
        if(!empty($company_state)) {
			$company_state = $obj->encode_decode('decrypt', $company_state);
		}
        
        ?>
        <form class="poppins pd-20" name="purchase_entry_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_purchase_entry_id)) { ?>
                            <div class="h5">Edit Purchase Entry</div>
                        <?php } else { ?>
                            <div class="h5">Add Purchase Entry</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('purchase_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_purchase_entry_id)) { echo $show_purchase_entry_id; } ?>">
                <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } else { echo "Tamil Nadu"; } ?>">   

                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="bill_date" class="form-control shadow-none" value="<?php if(!empty($purchase_entry_date)) { echo $purchase_entry_date; } else { echo date("d-M-Y"); } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Bill Date <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="purchase_entry_number" name="purchase_entry_number" class="form-control shadow-none" value="<?php if(!empty($purchase_entry_number)) { echo $purchase_entry_number; } ?>" onkeydown="Javascript:KeyboardControls(this,'',25,1);" <?php if(!empty($show_purchase_entry_id)) {?>readonly<?php } ?>>
                            <label>Bill No<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="supplier_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="SupplierState(this.value);">
                                
                                <option value="">Select Supplier</option>    
                                <?php 
                                if(!empty($supplier_list)) {
                                    foreach($supplier_list as $supplier) { ?>
                                        <option value="<?php echo $supplier['supplier_id']; ?>" <?php if(!empty($supplier_id) && $supplier_id == $supplier['supplier_id'] ||  ($supplier_count == '1')) { echo "selected"; } ?>><?php echo html_entity_decode($obj->encode_decode('decrypt', $supplier['supplier_name'])); ?></option>
                                <?php } 
                                } ?>
                            </select>
                            <label>Supplier <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="Vehicle_name" name="Vehicle_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($Vehicle_name)) { echo $Vehicle_name; } ?>">
                            <label>Vehicle Details</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 py-2 div_product_group">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="product_group" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:show_godown_magazine(this.value);Javascript:show_product(this.value)" <?php if(!empty($show_purchase_entry_id)){ ?> disabled <?php } ?>>
                                <option value="">Select</option>
                                <?php
                                    if(!empty($group_list)) {
                                        foreach($group_list as $group) { 
                                            ?>
                                            <option value="<?php echo $group['group_id']; ?>" <?php if(!empty($product_group) && $product_group == $group['group_id']) { echo "selected"; } ?>>
                                                <?php 
                                                    if(!empty($group['group_name'])) {
                                                        echo $obj->encode_decode('decrypt', $group['group_name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                                <?php /* <option value="1" <?php if(!empty($product_group) && $product_group =='1'){ ?>selected <?php } ?>>UnFinished</option>
                                <option value="2"  <?php if(!empty($product_group) && $product_group =='2'){ ?>selected <?php } ?>>Finished</option> */ ?>
                            </select>
                            <label>Product Group <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                <div class="col-lg-2 col-md-3 col-12 div_location_type">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="location_type" data-dropdown-css-class="select2-danger" style="width: 100%!important;" <?php if(!empty($show_purchase_entry_id)) {?>disabled <?php } ?>>
                                <option value="">Select</option>
                                <option value="1" <?php if(!empty($location_type) && $location_type =='1'){ ?>selected <?php } ?>>Single</option>
                                <option value="2"  <?php if(!empty($location_type) && $location_type =='2'){ ?>selected <?php } ?>>Multiple</option>
                            </select>
                            <label>Type <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                
                <div class="col-lg-3 col-md-2 col-12">
                    <div class="form-group mb-1">
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="gst_option" class="form-label text-muted smallfnt">GST/Non GST</label>
                                <input id="gst_option" class="form-check-input code-switcher" name="gst_option" onchange="Javascript:GST(this,this.value);" value="<?php if($gst_option == '1'){ echo $gst_option; } ?>" <?php if($gst_option == '1'){ ?>checked<?php } ?> type="checkbox">
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-2 col-md-3 col-6 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="tax_type" style="width: 100%;" onchange="Javascript:GST(this,this.value);">
                            <option value="">Select Tax Type</option>
                            <option value="1" <?php if($tax_type == '1'){ ?>selected<?php } ?>>Product</option>
                            <option value="2" <?php if($tax_type == '2'){ ?>selected<?php } ?>>Overall</option>
                        </select>
                        <label>Select Tax Type <span class="text-danger">*</span></label>
                    </div>
                </div> 
            </div> 
            <div class="col-lg-2 col-md-3 col-12 <?php if($gst_option !='1'){?>d-none<?php } ?> tax_cover1" id="tax_option_div">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" name="tax_option" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:getRateByTaxOption();" onchange="Javascript:GST(this,this.value);">
                            <!-- <option value="">Select</option> -->
                            <option value="1" <?php if($tax_option == '1'){ ?>selected<?php } ?>>Exclusive Tax</option>
                            <option value="2" <?php if($tax_option == '2'){ ?>selected<?php } ?>>Inclusive Tax</option>
                        </select>
                        <label>Tax Option <span class="text-danger">*</span></label>
                    </div>
                </div>  
            </div>
            <div class="col-lg-2 col-md-3 col-6 <?php if($tax_type !='2'){ ?>d-none <?php } ?> tax_cover2">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="overall_tax" style="width: 100%;" onchange="Javascript:GST(this,this.value);">
                            <option value="">Select Tax</option>
                            <option value="0%" <?php if($overall_tax == '0%'){ ?>selected<?php } ?>>0%</option>
                            <option value="5%" <?php if($overall_tax == '5%'){ ?>selected<?php } ?>>5%</option>
                            <option value="12%" <?php if($overall_tax == '12%'){ ?>selected<?php } ?>>12%</option>
                            <option value="18%" <?php if($overall_tax == '18%'){ ?>selected<?php } ?>>18%</option>
                            <option value="28%" <?php if($overall_tax == '28%'){ ?>selected<?php } ?>>28%</option>
                        </select>
                        <label>Select Tax</label>
                    </div>
                </div> 
            </div>
            </div>
            <div class="row justify-content-center pt-3">
                <div class="col-lg-2 col-md-4 col-12 py-2 d-none div_selected_godown">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_godown_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Godown</option>
                                <?php if(!empty($godown_list)) {
                                    foreach($godown_list as $godown) { ?>
                                        <option value="<?php echo $godown['godown_id']; ?>" <?php if(!empty($first_location_id) && ($location_type == '1') == $godown['godown_id']  || (!empty($godown_count) && $godown_count == 1)) { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $godown['godown_name']); ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label>Godown <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-4 col-12 py-2 d-none div_selected_magazine">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_magazine_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Magazine</option>
                                <?php if(!empty($magazine_list)) {
                                    foreach($magazine_list as $magazine) { ?>
                                        <option value="<?php echo $magazine['magazine_id']; ?>" <?php if(!empty($magazine_id) && $magazine_id == $magazine['magazine_id'] || (!empty($magazine_count) && $magazine_count == 1)) { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $magazine['magazine_name']); ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label>Magazine <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>

                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="product" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="GetProdetails();CalcPurchaseProductAmount();">
                                <option value="">Select Product</option>
                                <?php if(!empty($product_list)) {
                                    foreach($product_list as $product) { ?>
                                        <option value="<?php echo $product['product_id']; ?>" <?php if(!empty($count_of_product) && $count_of_product == 1){ ?> Selected<?php } ?> ><?php echo $obj->encode_decode('decrypt', $product['product_name']); ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label>Select Product</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="quantity" onfocus="Javascript:KeyboardControls(this,'number',7,'');" onkeyup="CalcPurchaseProductAmount();" class="form-control shadow-none">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_unit_type" onchange="CalcPurchaseProductAmount();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="1">Unit</option>
                                <option value="2">Sub Unit</option>
                            </select>
                            <label>Type</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2" id="contents_div">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="content" onkeyup="CalcPurchaseProductAmount();" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                            <label>Content</label>
                        </div>
                    </div>  
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="rate" onkeyup="CalcPurchaseProductAmount();" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                            <label>Rate</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text"  name="per" onkeyup="CalcPurchaseProductAmount();" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                                <label>Per</label>
                                <div class="input-group-append" style="width:50%!important;">
                                    <select name="purchase_per_type" onchange="CalcPurchaseProductAmount();" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="1">Unit</option>
                                        <option value="2">Sub Unit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="amount" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',7,'');" readonly>
                            <label>Amount</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-12 py-2 text-center">
                    <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:AddPurchaseProducts();">
                        Add
                    </button>
                </div> 
            </div>
            <div class="row"> 
            <div class="col-lg-12">
                <div class="table-responsive">
                    <input type="hidden" name="product_count" value="<?php if (!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
                    <table class="table nowrap cursor text-center table-bordered smallfnt w-100 purchase_entry_table">
                        <thead class="bg-dark">
                            <tr>
                                <th style="width:40px;">#</th>
                                <th style="width:180px;">Location</th>
                                <th style="width:180px;">Product</th>
                                <th style="width:70px;">QTY</th>
                                <th style="width:100px;">Unit</th>
                                <th style="width:70px;">Content</th>
                                <th style="width:90px;">Rate</th>
                                <th style="width:120px;">Per</th>
                                <th class="tax_element d-none" style="width: 100px;">Tax</th>
                                <th style="width:90px;">Amount</th>
                                <th style="width:70px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                if(!empty($product_id)) {
                                    for($i=0; $i < count($product_id); $i++) {    
                                        $unit_display = "";
                                        $unit_display = $obj->encode_decode('decrypt', $unit_name[$i]);
                                        ?>
                                        <tr class="purchase_product_row" id="purchase_product_row<?php echo $i; ?>">
                                            <td class="sno text-center px-2 py-2"><?php echo $i+1; ?></td>
                                            <td class="text-center px-2 py-2">
                                                <?php
                                                if ($location_name[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $location_name[$i]);
                                                }
                                                ?>
                                                <input type="hidden" name="location_id[]" id="location_id_<?php echo $i;?>" value="<?php echo $location_id[$i]; ?>">
                                            </td>
                                            <td class="text-center px-2 py-2">
                                                <?php
                                                if ($product_name[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $product_name[$i]);
                                                }
                                                ?>
                                                <input type="hidden" name="product_id[]" id="product_id_<?php echo $i;?>" value="<?php echo $product_id[$i]; ?>">
                                            </td>

                                            <td class="text-center px-2 py-2">
                                                <input type="text" name="entry_quantity[]" id="entry_quantity_<?php echo $i;?>" class="form-control shadow-none" value="<?php echo $quantity[$i]; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $i;?>');">
                                            </td>

                                            <td class="text-center px-2 py-2">
                                                <?php
                                                    echo $obj->encode_decode('decrypt', $unit_name[$i]);
                                                ?>
                                                <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $i;?>" value="<?php echo $unit_id[$i]; ?>">
                                                <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $i;?>" value="<?php echo $unit_name[$i]; ?>">
                                                <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $i;?>" value="<?php echo $unit_type[$i]; ?>">
                                            </td>

                                            <td class="text-center px-2 py-2">
                                                <input type="hidden" name="entry_content[]" id="entry_content_<?php echo $i;?>" class="form-control shadow-none" value="<?php if(!empty($content[$i])){ echo $content[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $i;?>');">
                                                <?php if(!empty($content[$i])){ echo $content[$i]; } ?>
                                            </td>

                                            <td class="text-center px-2 py-2">
                                                <input type="text" name="entry_rate[]" id="entry_rate_<?php echo $i;?>" class="form-control shadow-none" value="<?php echo $rate[$i]; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $i;?>');">
                                            </td>          

                                            <td class="text-center px-2 py-2">
                                                <div class="input-group d-none">
                                                    <input type="text"  name="entry_per[]" id="entry_per_<?php echo $i;?>" onkeyup="calcToalPurchaseProductAmount('<?php echo $i;?>');" value="<?php echo $per[$i]; ?>" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                                                    <div class="input-group-append" style="width:50%!important;">
                                                        <select name="entry_per_type[]" id="entry_per_type_<?php echo $i;?>" onchange="calcToalPurchaseProductAmount('<?php echo $i;?>');" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;"  <?php if(!empty($show_purchase_entry_id)) {  echo "readonly"; }?>>
                                                            <option value="1" <?php if($per_type[$i] == '1') { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $unit_name[$i]); ?></option>
                                                            <option value="2" <?php if($per_type[$i] == '2') { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $unit_name[$i]); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php echo $per[$i].' '.$unit_display; ?>
                                            </td>

                                            <td class="tax_element d-none tax_cover">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border mb-0">
                                                        <select class="select2 select2-danger" name="product_tax[]" id="product_tax_<?php echo $i;?>" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="calcToalPurchaseProductAmount('<?php echo $i;?>');">
                                                            <option value="">Select Tax</option>
                                                            <option value="0%" <?php if(!empty($product_tax[$i]) && $product_tax[$i] == "0%") { echo "selected"; } ?>>0%</option>
                                                            <option value="5%" <?php if(!empty($product_tax[$i]) && $product_tax[$i] == "5%") { echo "selected"; } ?>>5%</option>
                                                            <option value="12%" <?php if(!empty($product_tax[$i]) && $product_tax[$i] == "12%") { echo "selected"; } ?>>12%</option>
                                                            <option value="18%" <?php if(!empty($product_tax[$i]) && $product_tax[$i] == "18%") { echo "selected"; } ?>>18%</option>
                                                            <option value="28%" <?php if(!empty($product_tax[$i]) && $product_tax[$i] == "28%") { echo "selected"; } ?>>28%</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="tax_amt[]" id="tax_amt_<?php echo $i;?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $i;?>');">
                                                    
                                                </div> 
                                            </td>

                                            <td class="text-center px-2 py-2 entry_amount_td" id="entry_amount_td_<?php echo $i;?>">
                                            </td>
                                            
                                            <td class="text-center px-2 py-2">
                                                <input type="hidden" name="entry_amount[]" id="entry_amount_<?php echo $i;?>" class="form-control shadow-none" value="<?php echo $amount; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $i;?>');">

                                                <?php  
                                               $negative_stock_allowed = "";
                                               $negative_stock_allowed = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'negative_stock');  
                                               $product_unit_id = ""; $product_subunit_id = "";
                                               $product_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'unit_id');
                                               $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'subunit_id');
                                                if(empty($content[$i]) || $content[$i] == $GLOBALS['null_value']){
                                                        $content[$i] = "";
                                                }
                                                $inward_quantity = 0; $outward_quantity = 0;
                                                $show_button = 0;
                                                    $inward_quantity = 0; $outward_quantity = 0;
                                                    if(!empty($location_id[$i])) {
                                                        if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                                                            if($unit_id[$i] == $product_unit_id){
                                                                $inward_quantity = $obj->getInwardQty($show_purchase_entry_id, $location_id[$i], '', $product_id[$i], $content[$i]);
                                                                $outward_quantity = $obj->getOutwardQty('',$location_id[$i],'', $product_id[$i], $content[$i]);
                                                            }else if($unit_id[$i] == $product_subunit_id){
                                                                $inward_quantity = $obj->getInwardSubunitQty($show_purchase_entry_id, $location_id[$i], '', $product_id[$i], $content[$i]);
                                                                $outward_quantity = $obj->getOutwardSubunitQty('',$location_id[$i],'', $product_id[$i], $content[$i]);
                                                            }
                                                        }else{
                                                            if($unit_id[$i] == $product_unit_id){
                                                                $inward_quantity = $obj->getInwardQty($show_purchase_entry_id, '',$location_id[$i], $product_id[$i], $content[$i]);
                                                                $outward_quantity = $obj->getOutwardQty('', '',$location_id[$i], $product_id[$i], $content[$i]);
                                                            }else if($unit_id[$i] == $product_subunit_id){
                                                                $inward_quantity = $obj->getInwardSubunitQty($show_purchase_entry_id, '',$location_id[$i], $product_id[$i], $content[$i]);
                                                                $outward_quantity = $obj->getOutwardSubunitQty('', '',$location_id[$i], $product_id[$i], $content[$i]);
                                                            }
                                                        }
                                                    }
                                                            
                                                    if($negative_stock_allowed == 0){
                                                        if($inward_quantity >= $outward_quantity){
                                                            $show_button = 1;
                                                        }
                                                       
                                                    }else if($negative_stock_allowed == 1){
                                                        $show_button = 1;
                                                    }
                                                        
                                                    if($show_button == '1') {  ?>
                                                        <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $i; ?>', 'purchase_product_row');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <?php 
                                                    }else{ ?>
                                                        <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>
                                                        <?php 
                                                    } ?>
                                            </td>
                                        </tr>
                                        <script>
                                             $(document).ready(function() {
                                                 calcToalPurchaseProductAmount(<?php echo $i; ?>);

                                             });
                                        </script>

                                    <?php }
                                }
                            ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>8<?php }else{ ?>7<?php }?>" class="text-end sub_tot"> 
                                    <input type="hidden" name="sub_total" class="form-control shadow-none" value="<?php if(!empty($sub_total)) { echo $sub_total; }?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');">

                                    Total : 
                                </td>
                                <td colspan="2" class="text-end sub_total" ></td>
                            </tr>
                            <input type="hidden" name="charges_count" value="<?php if(!empty($charges_count)) { echo $charges_count-1; } else { echo '0'; } ?>">
                                <?php 
                                $count = 1;
                                if(!empty($other_charges_id) && !empty($show_purchase_entry_id)) {
                                    for($i=0; $i < count($other_charges_id); $i++) {
                                        ?>
                                            <tr class="smallfnt1 charges_row" id="charges_row_<?php if(!empty($count)) { echo $count; } else { echo '0'; } ?>">
                                                <td class="charges_head" colspan="3"></td>
                                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>4<?php }else{ ?>3<?php }?>">
                                                    <div class="form-group">
                                                        <div class="form-label-group in-border mb-0">
                                                            <select name="other_charges_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:GetChargesType(this);">
                                                                <option value="">Select Charges</option>
                                                                <?php 
                                                                    if(!empty($charges_list)) {
                                                                        foreach($charges_list as $data) {
                                                                            if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                                                ?>
                                                                                <option value="<?php echo $data['charges_id']; ?>" <?php if(!empty($other_charges_id[$i]) && $other_charges_id[$i] == $data['charges_id']) { ?>selected<?php } ?>>
                                                                                    <?php
                                                                                        if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                                            echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                                                            if($data['action'] == 'minus') {
                                                                                                echo " (-)";
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
                                                            <label>Select Charges</label>
                                                        </div>
                                                        <input type="hidden" name="charges_type[]" value="<?php if(!empty($charges_type[$i])) { echo $charges_type[$i]; } ?>">
                                                    </div> 
                                                </td>
                                                <td colspan="1"> 
                                                    <div class="d-flex">
                                                        <input type="text" class="form-control me-2" style="width: 85px;" name="charges_value[]" value="<?php if(!empty($other_charges_value[$i])) { echo $other_charges_value[$i]; } ?>" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                                                        <?php if($i == '0') { ?>
                                                            <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:AddChargesRow(this,3);"><i class="bi bi-plus fw-bold text-white"></i></button>
                                                        <?php } else { ?>
                                                            <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:DeleteChargesRow(this,'<?php echo $count; ?>');"><i class="bi bi-trash fw-bold text-white"></i></button>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="text-end"><span class="charges_total"></span></div>
                                                </td>
                                            </tr>
                                            <tr class="charges_row charges_total_tr" id="charges_row_total_<?php if(!empty($count)) { echo $count; } else { echo '0'; } ?>">
                                                <td colspan="10" class="text-end charges_sub">Total :</td>
                                                <td colspan="2" class="text-end charges_sub_total"></td>
                                            </tr>
                                        <?php
                                        $charges_count --;
                                        $count++;

                                    }
                                } else { ?>
                                    <tr class="smallfnt1 charges_row" id="charges_row_1">  
                                        <td class="charges_head" colspan="3"></td>
                                        <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>4<?php }else{ ?>3<?php }?>">
                                            <div class="form-group">
                                                <div class="form-label-group in-border mb-0">
                                                    <select name="other_charges_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:GetChargesType(this);">
                                                        <option value="">Select Charges</option>
                                                        <?php 
                                                            if(!empty($charges_list)) {
                                                                foreach($charges_list as $data) {
                                                                    if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['charges_id']; ?>">
                                                                            <?php
                                                                                if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                                                    if($data['action'] == 'minus') {
                                                                                        echo " (-)";
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
                                                    <label>Select Charges</label>
                                                </div>
                                                <input type="hidden" name="charges_type[]" value="">
                                            </div> 
                                        </td>
                                        <td colspan="1"> 
                                            <div class="d-flex">
                                                <input type="text" class="form-control me-2" style="width: 85px;" id="" name="charges_value[]" value="" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                                                <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:AddChargesRow(this,3);"><i class="bi bi-plus fw-bold text-white"></i></button>
                                            </div>
                                        </td>
                                        <td colspan="2" class="text-end">
                                            <div class="charges_total"></div>
                                        </td>
                                    </tr>
                                    <tr class="charges_row charges_total_tr" id="charges_row_total_1">
                                        <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end charges_sub">Total :</td>
                                        <td colspan="2" class="text-end charges_sub_total"></td>
                                    </tr>
                            <?php } ?>
                            <tr class="d-none">
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end cgst">CGST :</td>
                                <td colspan="2" class="text-end cgst_value"></td>
                            </tr>
                            <tr class="d-none">
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end sgst">SGST :</td>
                                <td colspan="2" class="text-end sgst_value"></td>
                            </tr>
                            <tr class="d-none">
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end igst">IGST :</td>
                                <td colspan="2" class="text-end igst_value"></td>
                            </tr>
                            <tr class="d-none">
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end total_tax">Total Tax :</td>
                                <td colspan="2" class="text-end total_tax_value"></td>
                            </tr>
                            <tr>
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end round">Round OFF :</td>
                                <td colspan="2" class="text-end round_off"></td>
                            </tr>
                            <tr>
                                <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>6<?php }else{ ?>7<?php }?>" class="text-end grand_total">Total :</td>
                                <td colspan="2" class="text-end "><i class="bi bi-currency-rupee text-danger me-2"></i><span class="overall_total">00.00</span></td>
                            </tr>
                        </tfoot>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-12 pt-3 text-center">
                   <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event,'purchase_entry_form', 'purchase_entry_changes.php', 'purchase_entry.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/purchase_entry.js"></script>
            <script type="text/javascript" src="include/js/creation_modules.js"></script>
            <script>
                $(document).ready(function() {
                  <?php if(!empty($show_purchase_entry_id)) { ?>
                    show_product("<?php echo $product_group; ?>")
                    show_godown_magazine("<?php echo $product_group; ?>")
                    calcPurchaseEntrySubTotal();
                    CheckCharges();
                    getRateByTaxOption();
                    <?php } 
                    ?>
                });
            </script>
        </form>
		<?php
    } 
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; 
        $from_date = ""; $to_date = ""; $search_text = ""; $product_group = 0;
        $show_bill = 0;$show_draft_bill = 0;
        $supplier_id = "";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(isset($_POST['supplier_id'])) {
            $supplier_id = $_POST['supplier_id'];
        }

        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }
        
        if(isset($_POST['product_group'])) {
            $product_group = $_POST['product_group'];
        }
        $total_records_list = array();
        $total_records_list = $obj->getPurchaseList($from_date, $to_date, $search_text,$show_bill,$product_group);
        
        if(!empty($supplier_id)) {
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos($val['supplier_id'], $supplier_id) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['purchase_entry_number']), $search_text) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        $total_pages = 0;	
		$total_pages = count($total_records_list);

        $page_start = 0; $page_end = 0;
		if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
			if($total_pages > $page_limit) {
				if($page_number) {
					$page_start = ($page_number - 1) * $page_limit;
					$page_end = $page_start + $page_limit;
				}
			}
			else {
				$page_start = 0;
				$page_end = $page_limit;
			}
		}

		$show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
		
		$prefix = 0;
		if(!empty($page_number) && !empty($page_limit)) {
			$prefix = ($page_number * $page_limit) - $page_limit;
		}
        ?>
        <?php if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php include("pagination.php"); ?> 
            </div> 
        <?php } ?>
        <?php
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { 
        ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Bill No / Bill Date</th>
                    <th>Supplier Name</th>
                    <th>Vehicle</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(!empty($show_records_list)) {
                    foreach($show_records_list as $key => $list) {
                        $index = $key + 1;
                        if(!empty($prefix)) { $index = $index + $prefix; }   
                        ?>
                        <tr>
                            <td>
                                <?php echo $index; ?>
                            </td>
                            <td> 
                                <?php
                                    if(!empty($list['purchase_entry_number']) && $list['purchase_entry_number'] != $GLOBALS['null_value']) {
                                        echo $list['purchase_entry_number'];
                                    }
                                ?>
                                <br>
                                <?php
                                    if(!empty($list['purchase_entry_date'])) {
                                        echo date('d-m-Y', strtotime($list['purchase_entry_date']));
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['supplier_name_mobile_city']) && $list['supplier_name_mobile_city'] != $GLOBALS['null_value']) {
                                        echo ($obj->encode_decode('decrypt', $list['supplier_name_mobile_city']));
                                    }
                                    else {
                                        echo '-';
                                    } ?>
                                    <div class="w-100 py-2">
                                    <?php
                                        if(!empty($list['creator_name'])) {
                                            $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                            echo " Creator : ". $list['creator_name'];
                                        }
                                    ?>                                        
                                </div>
                                <?php
                                if(!empty($list['cancelled'])) {
                                    ?>
                                            <span style="color: red;">Cancelled</span>
                                    <?php	
                                }	 ?>
                            </td>
                            <td>
                                <?php if(!empty($list['vehicle'])) {
                                        echo $list['vehicle'];
                                    }
                                    else {
                                        echo '-';
                                    } ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['total_amount'])) {
                                        echo number_format($list['total_amount'],2);
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>

                            <td>
                                <?php 
                                    $edit_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $edit_action;
                                        include('permission_action.php');
                                    }
                                    $delete_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }
                                ?>
                                <div class="dropdown">
                                    <button class="btn btn-dark show-button" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li><a class="dropdown-item" target="_blank" href="reports/rpt_purchase_entry_a4.php?view_purchase_entry_id=<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>"><i class="fa fa-print"></i> &ensp;Print</a></li>
                                        <?php
                                        if(empty($edit_access_error) && empty($list['cancelled'])) {
                                        ?> 
                                        <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>');"> <i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                        <?php } ?>
                                        <?php 
                                            if(empty($delete_access_error) && empty($list['cancelled'])) {
                                        ?>     
                                        <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>');"> <i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                        <?php } ?>
                                    </ul>
                                </div> 
                            </td>
                        </tr>
                        
                        <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-center">Sorry! No records found</td>
                    </tr>
                <?php 
                    } 
                ?>
            </tbody>
        </table>              
    <?php }
}

    if(isset($_REQUEST['edit_id'])) 
    {

        function combineAndSumUp ($myArray) {
            $finalArray = Array ();
            foreach ($myArray as $nkey => $nvalue) {
                $has = false;
                $fk = false;
                foreach ($finalArray as $fkey => $fvalue) {
                    if(($fvalue['location_id'] == $nvalue['location_id']) && ($fvalue['product_id'] == $nvalue['product_id']) && ($fvalue['subunit_contains'] == $nvalue['subunit_contains'])) {
                        $has = true;
                        $fk = $fkey;
                        break;
                    }
                }
    
                if($has === false) {
                    $finalArray[] = $nvalue;
                } else {
                    $finalArray[$fk]['product_id'] = $nvalue['product_id'];
                    $finalArray[$fk]['location_id'] = $nvalue['location_id'];
                    $finalArray[$fk]['subunit_contains'] = $nvalue['subunit_contains'];
                    $finalArray[$fk]['quantity'] += $nvalue['quantity'];
                }
            }
            return $finalArray;
            // print_r($final_array);
        }

        $bill_date = ""; $bill_date_error = ""; $purchase_entry_number = ""; $purchase_entry_number_error = "";$supplier_id = ""; $supplier_id_error = ""; $godown_id = array(); $godown_id_error = "";  $gst_option = ""; $gst_option_error = ""; $tax_type = ""; $tax_type_error = "";$tax_option = ""; $tax_option_error = ""; $product_ids = array(); $quantity = array(); $types = array();$contents = array();$total_qty = array();$rates = array(); $per = array(); $per_type =array(); $final_rate =array(); $product_amount =array();  $product_error = ""; $product_names = array();  $cgst_value = 0; $sgst_value = 0; $igst_value = 0; $round_off = ""; $sub_total = 0; $total_amount = 0; $total_tax_value = 0; $overall_tax ="";$unit_id = "";$unit_ids = array(); $unit_id_error =""; $selected_per =""; $selected_per_type =""; $selected_per_error =""; $selected_per_type_error =""; $gst_option =""; $product_tax =array();
        $company_state = ""; $party_state = ""; $stock_unique_ids = array();
        $per_rate =array();$other_charges_id = array(); $other_charges_names = array(); $location_ids = ""; $location_names = array();
        $other_charges_values = array(); $charges_type = array(); $other_charges_total = array(); 
        $valid_purchase = ""; $form_name = "purchase_entry_form"; $edit_id = ""; $product_group = ""; $product_group_error = ""; $location_type = ""; $location_type_error = "";
        $Vehicle_name = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['Vehicle_name'])) {
            $Vehicle_name = $_POST['Vehicle_name'];
            $Vehicle_name = trim($Vehicle_name);
        }
        // if(strlen($Vehicle_name) > 15){

        // }
        $Vehicle_name_error = $valid->valid_address($Vehicle_name, 'Vehicle_name', '');
        if(!empty($Vehicle_name_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'Vehicle_name', $Vehicle_name_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'Vehicle_name', $Vehicle_name_error, 'text');
            }
        }

        $bill_date = $_POST['bill_date'];
        $bill_date = trim($bill_date);
        $bill_date_error = $valid->valid_date($bill_date, 'Entry Date', '1');
        if(!empty($bill_date_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'bill_date', $bill_date_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'bill_date', $bill_date_error, 'text');
            }
        }

        $purchase_entry_number = $_POST['purchase_entry_number'];
        $purchase_entry_number = trim($purchase_entry_number);
        $purchase_entry_number_error = $valid->valid_address($purchase_entry_number, 'Bill Number', '1');
        if(empty($purchase_entry_number_error) && strlen($purchase_entry_number) > 25) {
            $purchase_entry_number_error = "Only 25 characters allowed";
        }
        if(!empty($purchase_entry_number_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'purchase_entry_number', $purchase_entry_number_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'purchase_entry_number', $purchase_entry_number_error, 'text');
            }
        }
    
        $supplier_id = $_POST['supplier_id'];
        $supplier_id = trim($supplier_id);
        $supplier_id_error = $valid->common_validation($supplier_id, 'supplier', 'select');
        if(empty($supplier_id_error)) {
            $supplier_unique_id = "";
            $supplier_unique_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'id');
            if(!preg_match("/^\d+$/", $supplier_unique_id)) {
                $supplier_id_error = "Invalid supplier";
            }
        }
        if(!empty($supplier_id_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'supplier_id', $supplier_id_error, 'select');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'supplier_id', $supplier_id_error, 'select');
            }
        }

        $product_group = $_POST['product_group'];
        $product_group = trim($product_group);
        $product_group_error = $valid->common_validation($product_group, 'Product Group', 'select');
        
        if(!empty($product_group_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'product_group', $product_group_error, 'select');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'product_group', $product_group_error, 'select');
            }
        }

        $location_type = $_POST['location_type'];
        $location_type = trim($location_type);
        $location_type_error = $valid->common_validation($location_type, 'Location Type', 'select');
        if(!empty($location_type_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'location_type', $location_type_error, 'select');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'location_type', $location_type_error, 'select');
            }
        }

        if(isset($_POST['gst_option']))
        {
            $gst_option = $_POST['gst_option'];
            $gst_option = trim($gst_option);
            $gst_option_error = $valid->common_validation($gst_option, 'GST option', 'select');
            if(empty($gst_option_error)) {
                if($gst_option != '1' && $gst_option != '2') {
                    $gst_option_error = "Invalid GST option";
                }
            }
        }
        
        if(!empty($gst_option_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
        }

        if($gst_option == '1') {
            $tax_type = $_POST['tax_type'];
            $tax_type = trim($tax_type);
            $tax_type_error = $valid->common_validation($tax_type, 'Tax Type', 'select');
            if(empty($tax_type_error)) {
                if($tax_type != '1' && $tax_type != '2') {
                    $tax_type_error = "Invalid Tax Type";
                }
            }
            if(!empty($tax_type_error)) {
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
            }

            $tax_option = $_POST['tax_option'];
            $tax_option = trim($tax_option);
            $tax_option_error = $valid->common_validation($tax_option, 'Tax Option', 'select');
            if(empty($tax_option_error)) {
                if($tax_option != '1' && $tax_option != '2') {
                    $tax_option_error = "Invalid Tax Option";
                }
            }
            if(!empty($tax_option_error)) {
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
            }

            if($tax_type == '2') {
                if(isset($_POST['overall_tax'])) {
                    $overall_tax = $_POST['overall_tax'];
                    $overall_tax = trim($overall_tax);
                }
            }
        }else{
            $overall_tax = $GLOBALS['null_value']; 
        }

        // if(empty($edit_id)){
        //     if(isset($_POST['godown_id']))
        //     {
        //         $godown_id = $_POST['godown_id'];
        //         $godown_id = trim($godown_id);
        //     }
          
        //     $godown_id_error = $valid->common_validation($godown_id, 'godown', 'select');

        //     if(!empty($godown_id_error)) {
        //         if(!empty($valid_purchase)) {
        //             $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'godown_id', $godown_id_error, 'select');
        //         }
        //         else {
        //             $valid_purchase = $valid->error_display($form_name, 'godown_id', $godown_id_error, 'select');
        //         }
        //     }
        // }else{
        //     if(isset($_POST['godown_id'])) {
        //         $godown_id = $_POST['godown_id'];
        //         $godown_id = trim($godown_id);
        //     }
        // }

        if(isset($_POST['company_state'])) {
            $company_state = $_POST['company_state'];
            $company_state = trim($company_state);
        }
        if(isset($_POST['party_state'])) {
            $party_state = $_POST['party_state'];
            $party_state = trim($party_state);
        }
        if(isset($_POST['location_id'])) {
            $location_ids = $_POST['location_id'];
        }
        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
        }
        if(isset($_POST['entry_quantity'])) {
            $quantity = $_POST['entry_quantity'];
        }
        if(isset($_POST['unit_type'])) {
            $unit_types = $_POST['unit_type'];
        }
        if(isset($_POST['entry_content'])) {
            $contents = $_POST['entry_content'];
        }

        if(isset($_POST['entry_rate'])) {
            $rates = $_POST['entry_rate'];
        }
        if(isset($_POST['entry_per'])) {
            $per = $_POST['entry_per'];
        }
        if(isset($_POST['product_tax'])) {
            $product_tax = $_POST['product_tax'];
        }
        
        if(isset($_POST['unit_id']))
        {
            $unit_ids = $_POST['unit_id'];
        }

        if(isset($_POST['entry_per_type']))
        {
            $per_type = $_POST['entry_per_type'];
        }
        $rate_per_cases =array(); $rate_per_pieces =array(); $final_rate =array(); $rate_per_unit =array(); $individual_stock = array();
        if(!empty($product_ids)) {
            for($i=0; $i < count($product_ids); $i++) {
                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;

                    if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                        $location_name = "";
                        $location_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_ids[$i], 'godown_name');
                        $location_names[] = $location_name;
                    }
                    else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
                        $location_name = "";
                        $location_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $location_ids[$i], 'magazine_name');
                        $location_names[] = $location_name;
                    }
                    // $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'unit_id');
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                    $sub_unit_id = "";
                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');
                    $unit_names[$i] = $unit_name; 
                    
                    $quantity[$i] = trim($quantity[$i]);
                    if(!empty($quantity[$i])) {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) 
                        {
                            $unit_types[$i] = trim($unit_types[$i]);
                            if(!empty($unit_types[$i])) {
                                $contents[$i] = trim($contents[$i]);
                                if(!empty($edit_id)) {
                                    if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                                        $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, $location_ids[$i],'',$product_ids[$i], $unit_ids[$i],$contents[$i]);
                                    }
                                    else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
                                        $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, '', $location_ids[$i],$product_ids[$i], $unit_ids[$i],$contents[$i]);
                                    }
                                }
                                if(!empty($contents[$i]) || (empty($sub_unit_id) || $sub_unit_id == "NULL")) {
                                    // if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $contents[$i]) && $contents[$i] <= 99999) 
                                    // {
                                        if($unit_types[$i] == '1' && $sub_unit_id != "NULL")
                                        {
                                            $total_qty[$i] = $quantity[$i] * $contents[$i];
                                        }
                                        else
                                        {
                                            $total_qty[$i] = $quantity[$i];
                                        }

                                        $individual_tax[] = array( 'location_id' => $location_ids[$i],'product_id' => $product_ids[$i],'subunit_contains' => $contents[$i],'quantity' => $quantity);

                                        $rates[$i] = trim($rates[$i]);
                                        if(!empty($rates[$i])) {
                                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $rates[$i]) && $rates[$i] <= 99999) 
                                            {
                                                $per[$i] = trim($per[$i]);
                                                if(!empty($per[$i])) {
                                                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $per[$i]) && $per[$i] <= 99999) 
                                                    {
                                                        $per_type[$i] = trim($per_type[$i]);
                                                        if(!empty($per_type[$i])) {
                                                            
                                                            if($unit_types[$i] == '1')
                                                            {
                                                                if($per_type[$i] == '1')
                                                                {
                                                                    $rate_per_cases[$i] = $rates[$i]/$per[$i];
                                                                    $final_rate[$i] = $rate_per_cases[$i];
                                                                }
                                                                elseif($per_type[$i] == '2')
                                                                {
                                                                    $rate_per_pieces[$i] = $rates[$i]/$per[$i];
                                                                    $final_rate[$i] = $rate_per_pieces[$i] * $contents[$i];
                                                                }
                                                            }
                                                            elseif($unit_types[$i] =='2')
                                                            {
                                                                if($per_type[$i] == '1')
                                                                {
                                                                    $rate_per_cases[$i] = $rates[$i]/$per[$i];
                                                                    $final_rate[$i] = $rate_per_cases[$i]/$contents[$i];
                                                                }
                                                                elseif($per_type[$i] == '2')
                                                                {
                                                                    $final_rate[$i] = $rates[$i]/$per[$i];
                                                                }
                                                            }
                                                            if($gst_option == '1')
                                                            {
                                                                if($tax_option == '2')
                                                                {
                                                                    $tax ="";
                                                                    if($tax_type == '1')
                                                                    {
                                                                        $tax= $product_tax[$i];
                                                                    }
                                                                    else
                                                                    {
                                                                        $tax = $overall_tax;
                                                                    }
                                                                    $tax = trim(str_replace("%", "",$tax));
                                                                    if($tax == ""){
                                                                        $tax = 0;
                                                                    }
                                                                    if($tax != ""){
                                                                        $final_rate[$i] = $final_rate[$i]-($final_rate[$i] * $tax)/($tax + 100);
                                                                    }
                                                                }
                                                            }
                                                            // echo $final_rate[$i];
                                                            if(!empty($final_rate[$i]) && !empty($quantity[$i]))
                                                            {
                                                                $rate_per_unit[$i] = $final_rate[$i];
                                                                $product_amount[$i] = $final_rate[$i] * $quantity[$i];
                                                            }
                                                            $sub_total += $product_amount[$i];
                                                        }
                                                        else {
                                                            $product_error = "Empty Per Type in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                        }
                                                    }
                                                    else {
                                                        $product_error = "Invalid per in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                    }
                                                }
                                                else {
                                                    $product_error = "Empty Per in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                }
                                            }
                                            else {
                                                $product_error = "Invalid rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                                            }
                                        }
                                        else {
                                            $product_error = "Empty Rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                                        } 
                                        
                                    // }
                                    // else {
                                    //     $product_error = "Invalid Content in Product - ".($obj->encode_decode('decrypt', $product_name));
                                    // }
                                }
                                else {
                                    $product_error = "Empty Content in Product - ".($obj->encode_decode('decrypt', $product_name));
                                } 
                            }
                            else {
                                $product_error = "Empty Unit Type in Product - ".($obj->encode_decode('decrypt', $product_name));
                            }  
                        }
                        else {
                            $product_error = "Invalid quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    }
                    else {
                        $product_error = "Empty quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                    }
                    $individual_stock[] = array( 'location_id' => $location_ids[$i],'product_id' => $product_ids[$i],'subunit_contains' => $contents[$i],'quantity' => $quantity[$i]); 
                }
                else {
                    $product_error = "Invalid Product";
                }
            }
        }
        else {
            $product_error = "Add Products";
        }

        $total_amount = $sub_total;

        if(empty($product_error) && empty($total_amount)) {
            $product_error = "Bill value cannot be 0";
        }
        if(isset($_POST['other_charges_id'])) {
            $other_charges_id = $_POST['other_charges_id'];
        }
        if(isset($_POST['charges_type'])) {
            $charges_type = $_POST['charges_type'];
        }
        if(isset($_POST['charges_value'])) {
            $other_charges_values = $_POST['charges_value'];
        }
        $charges_total_amounts = array();
        if(!empty($other_charges_id) && empty($product_error)) {
            for($i=0; $i < count($other_charges_id); $i++) {
                $other_charges_id[$i] = trim($other_charges_id[$i]);
                if(!empty($other_charges_id[$i])) {
                    $other_charges_name = ""; $other_charges_value = 0;
                    $other_charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id[$i], 'charges_name');
                    $other_charges_names[$i] = $other_charges_name;
                    $charges_type[$i] = trim($charges_type[$i]);
                    $other_charges_values[$i] = trim($other_charges_values[$i]);
                    if(isset($other_charges_values[$i])) {
                        $other_charges_error = "";
                        if(strpos($other_charges_values[$i], '%') !== false) {
                            $other_charges_value = str_replace('%', '', $other_charges_values[$i]);
                            $other_charges_value = trim($other_charges_value);
                        }
                        else {
                            $other_charges_value = $other_charges_values[$i];
                        }
                        $other_charges_error = $valid->valid_price($other_charges_value, ($obj->encode_decode('decrypt', $other_charges_name)), 1, '');
                        if(!empty($other_charges_error)) {
                            if(!empty($purchase_entry_error)) {
                                $purchase_entry_error = $purchase_entry_error."<br>".$other_charges_error;
                            }
                            else {
                                $purchase_entry_error = $other_charges_error;
                            }
                        }
                        else {
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_charges_value = ($other_charges_value * $total_amount) / 100;
                                $other_charges_value = number_format($other_charges_value, 2);
                                $other_charges_value = str_replace(",", "", $other_charges_value);
                            }
                        }
                    }
                    if(empty($purchase_entry_error)) {
                        $other_charges_total[$i] = $other_charges_value;
                        if($charges_type[$i] == "minus") {
                            $total_amount -= $other_charges_value;
                        }
                        else if($charges_type[$i] == "plus") {
                            $total_amount += $other_charges_value;
                        }
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                if(empty($purchase_entry_error)) {
                    for($j=$i+1; $j < count($other_charges_id); $j++) {
                        if($other_charges_id[$i] == $other_charges_id[$j]) {
                            $purchase_entry_error = "Same Charges Repeatedly Exists";
                            break;
                        }
                    }
                }
            }
        }
     
    
        $total_amount = number_format((float)$total_amount, 2, '.', '');
        $grand_total = $total_amount;


        if($gst_option == '1' && empty($product_error) && empty($valid_purchase)) {
            $percentage = 100;
            if($tax_type == '1')
            {
                for ($a = 0; $a < count($product_ids); $a++) {
                    $tax = trim(str_replace("%", "",$product_tax[$a]));

                    if ($product_tax[$a] != '' && $tax != '%') {
                        $tax_plus_value = ($product_amount[$a] * $tax) / 100;
                        
                        $total_tax_value += $tax_plus_value;
                        $total_tax_amount = $total_tax_value;
                    } else {
                        $tax_error = "Select tax for product - ".($obj->encode_decode('decrypt', $product_names[$a]));
                    }
                    if (!empty($tax_error)) {
                        if (!empty($purchase_entry_error)) {
                            $purchase_entry_error = $purchase_entry_error . "<br>" . $tax_error;
                        } else {
                            $purchase_entry_error = $tax_error;
                        }
                    }
                }
            }
            elseif($tax_type == '2') {
                $tax = "";
                $tax = str_replace("%", "", $overall_tax);
                $tax = trim($tax);
                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $tax)) {
                    $total_tax_value = ($tax * $grand_total) / $percentage;
                }
                else {
                    $product_error = "Invalid Overall tax";
                }
            }
            // echo $total_tax_value."hai";
            if(!empty($total_tax_value)) {
                $total_tax_value = number_format($total_tax_value, 2);
                $total_tax_value = str_replace(",", "", $total_tax_value);
                if($company_state == $party_state) {
                    $cgst_value = $total_tax_value / 2;
                    $cgst_value = number_format($cgst_value, 2);
                    $cgst_value = str_replace(",", "", $cgst_value);
                    $sgst_value = $total_tax_value / 2;
                    $sgst_value = number_format($sgst_value, 2);
                    $sgst_value = str_replace(",", "", $sgst_value);
                }
                else {
                    $igst_value = $total_tax_value;
                    $igst_value = number_format($igst_value, 2);
                    $igst_value = str_replace(",", "", $igst_value);
                }
                $total_amount = $total_amount + $total_tax_value;
            }
        }
        // echo $total_amount;
        $round_off = 0;
        if(!empty($total_amount)) {	
            if (strpos( $total_amount, "." ) !== false) {
                $pos = strpos($total_amount, ".");
                $decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
                if($decimal != "00") {
                    if(strlen($decimal) == 1) {
                        $decimal = $decimal."0";
                    }
                    if($decimal >= 50) {				
                        $round_off = 100 - $decimal;
                        if($round_off < 10) {
                            $round_off = "0.0".$round_off;
                        }
                        else {
                            $round_off = "0.".$round_off;
                        }
                        
                        $total_amount = $total_amount + $round_off;
                    }
                    else {
                        $decimal = "0.".$decimal;
                        $round_off = "-".$decimal;
                        $total_amount = $total_amount - $decimal;
                    }
                }
            }
        }
        $result = "";

        for($i=0;$i<count($product_ids);$i++)
        {
            for($j=$i+1;$j<count($product_ids);$j++)
            {
				if(!empty($product_ids[$i]) && !empty($product_ids[$j]) && !empty($brand_ids[$i]) && !empty($brand_ids[$j]) && !empty($content[$i]) && !empty($content[$j])) {
					if($product_ids[$i] == $product_ids[$j] && $brand_ids[$i] == $brand_ids[$j] && $content[$i] == $content[$j] && $unit_types[$i] == $unit_types[$j])
					{
                        $godown = ""; $product = ""; $brand = "";
						$product = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$j],'product_name');
						$brand = $obj->getTableColumnValue($GLOBALS['brand_table'],'brand_id',$brand_ids[$j],'brand_name');

						
						if(!empty($product))
						{
							$product = $obj->encode_decode("decrypt",$product);
							
						}
                        
						if(!empty($brand))
						{
							$brand = $obj->encode_decode("decrypt",$brand);	
						}
                            $product_error ="Product : ".$product."&nbsp;&nbsp;  > &nbsp;&nbsp;  Brand : "."Product : ".$product."&nbsp;&nbsp;  > &nbsp;&nbsp;  Brand : ".$brand ."  &nbsp;&nbsp; Contains : ".$content[$j]."&nbsp;&nbsp;  > &nbsp;&nbsp; &nbsp;&nbsp;  already exist";
					}
				}
            }
        }

        if(!empty($individual_stock)){
            array_multisort(array_column($individual_stock, "location_id"), SORT_ASC,array_column($individual_stock, "product_id"), SORT_ASC,array_column($individual_stock, "subunit_contains"),  SORT_ASC, $individual_stock);
            $final_array = combineAndSumUp($individual_stock);
        }

        $stock_error = 0; $valid_stock = "";
        if(!empty($final_array) && empty($valid_purchase))
        {
            foreach($final_array as $data)
            {
                $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0; $subunit_need = 0; $product ="";
                $current_stock_subunit = 0; $available_stock_unit = 0; $available_stock_subunit = 0;
                if($product_group =='4d5449774e4449774d6a55784d44557a4d444a664d444d3d' || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                    $inward_unit = $obj->getInwardQty($edit_id,$data['location_id'],'',$data['product_id'],$data['subunit_contains']);
                    $outward_unit = $obj->getOutwardQty('',$data['location_id'], '',$data['product_id'],$data['subunit_contains']);
                }else{
                    $inward_unit = $obj->getInwardQty($edit_id,'',$data['location_id'],$data['product_id'],$data['subunit_contains']);
                    $outward_unit = $obj->getOutwardQty('','', $data['location_id'],$data['product_id'],$data['subunit_contains']);
                }
                
                if($product_group =='4d5449774e4449774d6a55784d44557a4d444a664d444d3d' || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                    $inward_subunit = $obj->getInwardSubunitQty($edit_id,$data['location_id'],'',$data['product_id'],$data['subunit_contains']);
                    $outward_subunit = $obj->getOutwardSubunitQty('',$data['location_id'],'',$data['product_id'],$data['subunit_contains']); 
                }else{
                    $inward_subunit = $obj->getInwardSubunitQty($edit_id,'',$data['location_id'],$data['product_id'],$data['subunit_contains']);
                    $outward_subunit = $obj->getOutwardSubunitQty('','',$data['location_id'],$data['product_id'],$data['subunit_contains']); 
                }

                $available_stock_unit = $inward_unit - $outward_unit;
                $available_stock_subunit = $inward_subunit - $outward_subunit;
                // echo $inward_unit.' - inward<br>';
                // echo "available_stock :".$available_stock_unit;
                $inward_unit += $data['quantity'];
                if(!empty($data['subunit_contains']) && $data['subunit_contains'] != $GLOBALS['null_value']){
                    $outward_subunit += ($data['quantity'] * $data['subunit_contains']);
                }

                $current_stock_unit = $inward_unit - $outward_unit;
                $current_stock_subunit = $inward_subunit - $outward_subunit;

                if($current_stock_unit < 0) {
                    $product = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'product_name');
                    if(!empty($product)) {
                        $product = $obj->encode_decode("decrypt",$product);
                    }
                    $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'subunit_need'); 
                    $negative_stock = 0;
                    $negative_stock = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'negative_stock');
                    
                    $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'unit_id');
                    $unit_name = "";
                    
                    if(!empty($unit_id)) {
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode("decrypt", $unit_name);
                        }   
                    }

                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'subunit_id');
                    $sub_unit_name = "";
                    
                    if(!empty($sub_unit_id)) {
                        $sub_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id', $sub_unit_id, 'unit_name');
                        if(!empty($sub_unit_name)) {
                            $sub_unit_name = $obj->encode_decode("decrypt", $sub_unit_name);
                        }   
                    }

                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'product_name');
                    if(!empty($product_name)) {
                        $product_name = $obj->encode_decode("decrypt", $product_name);
                    }
                    
                    // echo "negative stock :".$negative_stock."  / ".$subunit_need;
                    if($negative_stock !='1') {
                       
                        if($subunit_need == 1) {
                            $valid_stock = "Stock goes to Negative for <b>" . $product_name . "</b> with " .  $unit_name . " & " . (!empty($data['subunit_contains']) ? ($data['subunit_contains'] . " " . $sub_unit_name ) : "") . "<br>Current Stock : " . $available_stock_unit . " " . $unit_name . " & " . $available_stock_subunit . " " . $sub_unit_name;
                            $stock_error = 1;
                        } else {
                            $valid_stock = "Stock goes to Negative for <b>" . $product_name . "</b> with " .  $unit_name . "<br>Current Stock : " . $available_stock_unit . " " . $unit_name;
                            $stock_error = 1;
                        }
                         $stock_error = 1;
                    }
                }
            }
        }

        if (!empty($edit_id) && empty($product_error)) {
            $prev_stock_list = array();
            $prev_stock_list = $obj->PrevStockList($edit_id);
            if (!empty($prev_stock_list)) {
                foreach ($prev_stock_list as $data) {
                    $stock_id = "";
                    $stock_godown_id = "";
                    $stock_magazine_id = "";
                    $stock_product_id = "";
                    $stock_type = "";
                    $inward_unit = 0;
                    $inward_subunit = 0;
                    $outward_unit = 0;
                    $outward_subunit = 0;
                    $stock_case_contains = 0;
                    if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
                    }
                    if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $stock_godown_id = $data['godown_id'];
                    }
                    if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                        $stock_case_contains = $data['case_contains'];
                    }
                    if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_magazine_id = $data['magazine_id'];
                    }
                    if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $stock_product_id = $data['product_id'];
                    }
                    if (!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward_unit = $data['inward_unit'];
                    }
                    if (!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                        $inward_subunit = $data['inward_subunit'];
                    }
                    if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                    }
                    if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                        $outward_subunit = $data['outward_subunit'];
                    }
                    
                    $current_stock_unit = 0;
                    $current_stock_subunit = 0;
                    $stock_table_unique_id = "";
                    $stock_unique_table = "";
                    // if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                       
                    // } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                      
                    // }

                    if($product_group =='4d5449774e4449774d6a55784d44557a4d444a664d444d3d' || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                        $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                        $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                    }
                    else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
                        $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                        $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    }

                    // echo $stock_table_unique_id."/".$stock_unique_ids."*";
                    if (!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                        $current_stock_unit = $current_stock_unit - $inward_unit;
                    } else {
                        $current_stock_unit = 0;
                    }
                    if (!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                        $current_stock_subunit = $current_stock_subunit - $inward_subunit;
                    } else {
                        $current_stock_subunit = $GLOBALS['null_value'];
                    }
    
                    if (!in_array($stock_id, $stock_unique_ids)) {
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
    
                        if (preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($GLOBALS['stock_by_godown_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }


    
        if(empty($valid_purchase) && empty($product_error) && empty($purchase_entry_error) && empty($stock_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                // if (!empty($bill_company_id)) {
                //     $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['estimate_table']);
                // }
    
                if(!empty($bill_date)) {
                    $bill_date = date('Y-m-d', strtotime($bill_date));
                }
                if(empty($purchase_entry_number)) {
                    $purchase_entry_number = $GLOBALS['null_value'];
                }
                $supplier_name ="";
                if(!empty($supplier_id)) {
                    $supplier_name_mobile_city = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'name_mobile_city');
                    $supplier_name = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'supplier_name');
                    $supplier_details = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'supplier_details');
                }
                else {
                    $supplier_id = $GLOBALS['null_value'];
                    $supplier_name = $GLOBALS['null_value'];
                    $supplier_name_mobile_city = $GLOBALS['null_value'];
                    $supplier_details = $GLOBALS['null_value'];
                }

                if(!empty($location_ids)) {
                    $location_ids = array_reverse($location_ids);
                    $location_ids = implode(",", $location_ids);
                }else{
                    $location_ids = $GLOBALS['null_value'];
                }

                if(!empty($location_names)) {
                    $location_names = array_reverse($location_names);
                    $location_names = implode(",", $location_names);
                }else{
                    $location_names = $GLOBALS['null_value'];
                }
             
                if(!empty($product_ids)) {
                    $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                }else{
                    $product_ids = $GLOBALS['null_value'];
                }
               
                if(!empty($product_names)) {
                    $product_names = array_reverse($product_names);
                    $product_names = implode(",", $product_names);
                }else{
                    $product_names = $GLOBALS['null_value'];
                }
    
                if(!empty($unit_ids)) {
                    $unit_ids = array_reverse($unit_ids);
                    $unit_ids = implode(",", $unit_ids);
                }else{
                    $unit_ids = $GLOBALS['null_value'];
                }

                if(!empty($unit_names)) {
                    $unit_names = array_reverse($unit_names);
                    $unit_names = implode(",", $unit_names);
                }else{
                    $unit_names = $GLOBALS['null_value'];
                }

                if(!empty($brand_ids)) {
                    $brand_ids = array_reverse($brand_ids);
                    $brand_ids = implode(",", $brand_ids);
                }else{
                    $brand_ids = $GLOBALS['null_value'];
                }

                if(!empty($brand_names)) {
                    $brand_names = array_reverse($brand_names);
                    $brand_names = implode(",", $brand_names);
                }else{
                    $brand_names = $GLOBALS['null_value'];
                }

                if(!empty($quantity)) {
                    $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                }else{
                    $quantity = $GLOBALS['null_value'];
                }
                if(!empty($unit_types)) {
                    $unit_types = array_reverse($unit_types);
                    $unit_types = implode(",", $unit_types);
                }else{
                    $unit_types = $GLOBALS['null_value'];
                }

                if(!empty($contents)) {
                    $contents = array_reverse($contents);
                    $contents = implode(",", $contents);
                }else{
                    $contents = $GLOBALS['null_value'];
                }

                if(!empty($total_qty)) {
                    $total_qty = array_reverse($total_qty);
                    $total_qty = implode(",", $total_qty);
                }else{
                    $total_qty = $GLOBALS['null_value'];
                }

                if(!empty($rates)) {
                    $rates = array_reverse($rates);
                    $rates = implode(",", $rates);
                }else{
                    $rates = $GLOBALS['null_value'];
                }

                if(!empty($per)) {
                    $per = array_reverse($per);
                    $per = implode(",", $per);
                }else{
                    $per = $GLOBALS['null_value'];
                }

                if(!empty($per_type)) {
                    $per_type = array_reverse($per_type);
                    $per_type = implode(",", $per_type);
                }else{
                    $per_type = $GLOBALS['null_value'];
                }

                if(!empty($final_rate)) {
                    $final_rate = array_reverse($final_rate);
                    $final_rate = implode(",", $final_rate);
                }else{
                    $final_rate = $GLOBALS['null_value'];
                }

                if(!empty($product_amount)) {
                    $product_amount = array_reverse($product_amount);
                    $product_amount = implode(",", $product_amount);
                }else{
                    $product_amount = $GLOBALS['null_value'];
                }

                if(!empty($product_tax)) {
                    $product_tax = array_reverse($product_tax);
                    $product_tax = implode(",", $product_tax);
                }else{
                    $product_tax = $GLOBALS['null_value'];
                }

                if(!empty($rate_per_unit)) {
                    $rate_per_unit = array_reverse($rate_per_unit);
                    $rate_per_unit = implode(",", $rate_per_unit);
                }else{
                    $rate_per_unit = $GLOBALS['null_value'];
                }

                if(!empty(array_filter($other_charges_id, fn($value) => $value !== ""))) {
                    $other_charges_id = implode(",", $other_charges_id);
                }
                else {
                    $other_charges_id = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_type, fn($value) => $value !== ""))) {
                    $charges_type = implode(",", $charges_type);
                }
                else {
                    $charges_type = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($other_charges_values, fn($value) => $value !== ""))) {
                    $other_charges_values = implode(",", $other_charges_values);
                }
                else {
                    $other_charges_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($other_charges_total, fn($value) => $value !== ""))) {
                    $other_charges_total = implode(",", $other_charges_total);
                }
                else {
                    $other_charges_total = $GLOBALS['null_value'];
                }
                if(!empty($charges_total_amounts)) {
                    $charges_total_amounts = implode(",", $charges_total_amounts);
                }else{
                    $charges_total_amounts = $GLOBALS['null_value'];
                }

                $purchase_entry_error = "";$check_bills ="";
                if(!empty($purchase_entry_number) && !empty($bill_company_id)) {
                    $prev_bill_id="";
                    $prev_bill_id=$obj->PurchaseBillNumberAlreadyExists($bill_company_id,$purchase_entry_number);
                    if(!empty($prev_bill_id) && $prev_bill_id != $edit_id) {
                        $purchase_entry_error = "This bill number is already exist";
                    }	
                }

                $received_slip_id = "";
                if(!empty($conversion_id) && $conversion_update == '1') {
                    $received_slip_id = $conversion_id;
                }
                else {
                    $received_slip_id = $GLOBALS['null_value'];
                }

                // if(!empty($godown_id))
                // {
                //     $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_name');
                // }
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $stock_update = 0; $balance =0; $stockupdation = 1;
                if(empty($edit_id)) {
                    if(empty($prev_bill_id)) {
                        $action = "";
                        if(!empty($purchase_entry_number)) {
                            $action = "New Purchase Created. Bill No. - ".$purchase_entry_number;
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array(); $values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'purchase_entry_id', 'purchase_entry_number', 'purchase_entry_date','supplier_id', 'supplier_name_mobile_city', 'supplier_details', 'vehicle', 'gst_option', 'tax_type', 'tax_option', 'company_state', 'supplier_state','product_id', 'product_name','quantity', 'unit_type', 'content', 'total_qty', 'rate','per','per_type','final_rate', 'product_amount','overall_tax', 'sub_total',  'other_charges_id', 'charges_type', 'other_charges_value', 'other_charges_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'total_amount','stockupdate','received_slip_id','unit_id','unit_name','product_tax','rate_per_unit', 'cancelled', 'deleted', 'location_id', 'location_type', 'product_group', 'location_name');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$purchase_entry_number."'", "'".$bill_date."'","'".$supplier_id."'", "'".$supplier_name_mobile_city."'", "'".$supplier_details."'", "'".$Vehicle_name."'",  "'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$company_state."'", "'".$party_state."'", "'".$product_ids."'", "'".$product_names."'","'".$quantity."'", "'".$unit_types."'",  "'".$contents."'", "'".$total_qty."'","'".$rates."'","'".$per."'","'".$per_type."'","'".$final_rate."'", "'".$product_amount."'","'".$overall_tax."'", "'".$sub_total."'",  "'".$other_charges_id."'", "'".$charges_type."'", "'".$other_charges_values."'", "'".$other_charges_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'", "'".$round_off."'", "'".$total_amount."'", "'".$stockupdation."'","'".$received_slip_id."'","'".$unit_ids."'","'".$unit_names."'","'".$product_tax."'","'".$rate_per_unit."'", "'0'", "'0'", "'".$location_ids."'", "'".$location_type."'", "'".$product_group."'", "'".$location_names."'");
                        $purchase_insert_id = $obj->InsertSQL($GLOBALS['purchase_entry_table'], $columns, $values,'purchase_entry_id', '', $action);
                        
                        if(preg_match("/^\d+$/", $purchase_insert_id)) {
                            $stock_update = 1;
                            $purchase_entry_id = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'id', $purchase_insert_id, 'purchase_entry_id');
                            $purchase_entry_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'id', $purchase_insert_id, 'purchase_entry_number');
                            $result = array('number' => '1', 'msg' => 'Purchase Entry Successfully Created','redirection_page' =>'purchase_entry.php');
                                $balance =1;
                            // if(!empty($conversion_update) && $conversion_update == '1') { 
                                
                            //         $received_slip_unique_id = "";
                            //         $received_slip_unique_id = $obj->getTableColumnValue($GLOBALS['received_slip_table'], 'received_slip_id', $received_slip_id, 'id');
                                
                            //         if(preg_match("/^\d+$/", $received_slip_unique_id)) {
                                        
                            //             $action = "";
                            //             $columns = array(); $values = array();			
                            //             $columns = array('is_converted','purchase_entry_number');
                            //             $values = array("'1'","'".$purchase_entry_number."'");
                            //             $msg = $obj->UpdateSQL($GLOBALS['received_slip_table'], $received_slip_unique_id, $columns, $values, $action);
                                        
                            //         }
                            //         else {
                            //             $msg = "Invalid Received Slip";
                            //         }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $purchase_insert_id);
                        }

                        
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $purchase_entry_error);
                    }
                }
                else
                {
                    if((empty($prev_bill_id) || $prev_bill_id == $edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($purchase_entry_number)) {
                                $action = "Purchase Entry Updated. Bill No. - ".$purchase_entry_number;
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','bill_company_details', 'purchase_entry_date','supplier_id', 'supplier_name_mobile_city', 'supplier_details', 'vehicle', 'gst_option', 'tax_type', 'tax_option', 'company_state', 'supplier_state','product_id', 'product_name','quantity', 'unit_type', 'content', 'total_qty','rate','per','per_type','final_rate','product_amount', 'overall_tax',  'sub_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'total_amount','unit_id','unit_name','other_charges_id', 'charges_type', 'other_charges_value', 'other_charges_total','product_tax','rate_per_unit', 'location_id', 'location_type', 'product_group', 'location_name');
                            $values = array("'".$creator_name."'", "'".$bill_company_details."'", "'".$bill_date."'","'".$supplier_id."'", "'".$supplier_name_mobile_city."'", "'".$supplier_details."'", "'".$Vehicle_name."'", "'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$company_state."'", "'".$party_state."'","'".$product_ids."'", "'".$product_names."'","'".$quantity."'", "'".$unit_types."'",  "'".$contents."'", "'".$total_qty."'","'".$rates."'","'".$per."'","'".$per_type."'","'".$final_rate."'", "'".$product_amount."'","'".$overall_tax."'", "'".$sub_total."'",  "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'", "'".$round_off."'", "'".$total_amount."'","'".$unit_ids."'","'".$unit_names."'", "'".$other_charges_id."'", "'".$charges_type."'", "'".$other_charges_values."'", "'".$other_charges_total."'","'".$product_tax."'","'".$rate_per_unit."'", "'".$location_ids."'", "'".$location_type."'", "'".$product_group."'", "'".$location_names."'");
                            $purchase_update_id = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $getUniqueID, $columns, $values, $action);

                            if(preg_match("/^\d+$/", $purchase_update_id)) {
                                $stock_update = 1;
                                $purchase_entry_id = $edit_id;
                                $purchase_entry_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'purchase_entry_number');
                                $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'purchase_entry.php');
                                $balance =1;
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $purchase_update_id);
                            }							
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $purchase_entry_error);
                    }
                }

                if(!empty($balance) && $balance == 1) {
                    $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $purchase_entry_id; $bill_date = date('Y-m-d');$credit  = 0; $debit = 0; $bill_type ="Purchase Bill";$bill_number = $purchase_entry_number;

                    $credit  = $total_amount; 
                    $opening_balance_type = 'Credit';
                    if(empty($credit)){
                        $credit = 0;
                    }
                    if(empty($debit)){
                        $debit = 0;
                    }
                    if(empty($opening_balance)){
                        $opening_balance = 0;
                    }
                    if(empty($opening_balance_type)){
                        $opening_balance_type = $GLOBALS['null_value'];
                    }
                    $update_balance ="";
                    $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$GLOBALS['null_value'],$GLOBALS['null_value'],$supplier_id,$supplier_name,'Supplier',$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$credit,$debit,$opening_balance_type);
                        
                }

                if (!empty($stock_update) && $stock_update == 1) {
                    if (!empty($location_ids) && !empty($product_ids) && !empty($quantity)) {
                        $product_id = explode(",", $product_ids);
                        $unit_type = explode(",", $unit_types);
                        $quantity = explode(",", $quantity);
                        $contents = explode(",", $contents);
                        $location_id = explode(",", $location_ids);
                        $remarks = $obj->encode_decode("encrypt", $purchase_entry_number);
                        for($i = 0; $i < count($product_id); $i++) {
                            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                            if(!empty($product_list)) {
                                foreach ($product_list as $P_list) {
                                    if(!empty($P_list['group_id'])) {
                                        $group_id = $P_list['group_id'];
                                    }
                                    if(!empty($P_list['unit_id'])) {
                                        $unit_id = $P_list['unit_id'];
                                    }
                                    if(!empty($P_list['subunit_id'])) {
                                        $subunit_id = $P_list['subunit_id'];
                                    }
                                }
                            }
                            if($unit_type[$i] == '1') {
                                $unit_sub = $unit_id;                                
                            } else if($unit_type[$i] == '2') {
                                $unit_sub = $subunit_id;
                            }

                            if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                                $stock_update_id = $obj->StockUpdate($GLOBALS['purchase_entry_table'], "In", $purchase_entry_id, '', $product_id[$i], $remarks, date('Y-m-d'), $location_id[$i], $GLOBALS['null_value'], $unit_sub, $quantity[$i], $contents[$i], $group_id, 1);
                            }
                            else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
                                $stock_update_id = $obj->StockUpdate($GLOBALS['purchase_entry_table'], "In", $purchase_entry_id, '', $product_id[$i], $remarks, date('Y-m-d'), $GLOBALS['null_value'] ,$location_id[$i], $unit_sub, $quantity[$i], $contents[$i], $group_id, 2);
                            }
                        }
                    }
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }else {
            if(!empty($valid_purchase)) {
                $result = array('number' => '3', 'msg' => $valid_purchase);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($purchase_entry_error)) {
                $result = array('number' => '2', 'msg' => $purchase_entry_error);
            }
            else if(!empty($valid_stock)) {
                $result = array('number' => '2', 'msg' => $valid_stock);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;

    }

    if (isset($_REQUEST['delete_purchase_entry_id'])) {
        $delete_purchase_entry_id = $_REQUEST['delete_purchase_entry_id'];
        $msg = ""; $godown_id = ""; $location_id = ""; $product_id = array();  $content_id = array(); 
        if (!empty($delete_purchase_entry_id)) {
            $purchase_unique_id = "";
            $purchase_unique_id = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'id');

            $product_group = "";
            $product_group = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'product_group');

            $purchase_entry_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, '');
            if(!empty($purchase_entry_list)) {
                foreach($purchase_entry_list as $data) {
                    if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $godown_id = $data['godown_id'];
                        $godown_id = explode(",", $godown_id);
                    }
                    if(!empty($data['location_id']) && $data['location_id'] != $GLOBALS['null_value']) {
                        $location_id = $data['location_id'];
                        $location_id = explode(",", $location_id);
                    }
                    if(!empty($data['product_id'])) {
                        $product_id = $data['product_id'];
                        $product_id = explode(",", $product_id);
                    }
                    if(!empty($data['unit_id'])) {
                        $unit_ids = $data['unit_id'];
                        $unit_ids = explode(",", $unit_ids);
                    }
                    if(!empty($data['content'])) {
                        $case_contains = $data['content'];
                        $case_contains = explode(",", $case_contains);
                    }
                }
            }
            $can_delete = 1;
            if(!empty($product_id)) {
                for($i=0; $i < count($product_id); $i++) {
                    if(!empty($product_id[$i])) {
                        $product_subunit_id = "";
                        $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'subunit_id');
                        if(empty($case_contains[$i]) || $case_contains[$i] == $GLOBALS['null_value']){
                            $case_contains[$i] = "";
                        }
                        $inward_quantity = 0; $outward_quantity = 0;$inward_subquantity = 0; $outward_subquantity = 0;
                        if(!empty($location_id[$i])) {
                            if($unit_ids[$i] == $product_subunit_id){
                                $inward_quantity = $obj->getInwardSubunitQty($delete_purchase_entry_id, $location_id[$i], '',$product_id[$i], $case_contains[$i]);
                                $outward_quantity = $obj->getOutwardSubunitQty('', $location_id[$i], '', $product_id[$i],$case_contains[$i]);
                            }else{
                                $inward_quantity = $obj->getInwardQty($delete_purchase_entry_id, $location_id[$i], '',$product_id[$i], $case_contains[$i]);
                                $outward_quantity = $obj->getOutwardQty('', $location_id[$i], '', $product_id[$i],$case_contains[$i]);
                            }    
                        } else if(!empty($location_id[$i])) {
                            if($unit_ids[$i] == $product_subunit_id){
                                $inward_quantity = $obj->getInwardSubunitQty($delete_purchase_entry_id, '', $location_id[$i], $product_id[$i], $case_contains[$i]);
                                $outward_quantity = $obj->getOutwardSubunitQty('', '', $location_id[$i], $product_id[$i], $case_contains[$i]);
                            }else{
                                $inward_quantity = $obj->getInwardQty($delete_purchase_entry_id, '', $location_id[$i], $product_id[$i], $case_contains[$i]);
                                $outward_quantity = $obj->getOutwardQty('', '', $location_id[$i], $product_id[$i], $case_contains[$i]);
                            }    
                        }
                    
                        if($inward_quantity < $outward_quantity) {
                            $can_delete = 0;
                        }
                    }
                }
            }

            if($can_delete == '1'){
            if (preg_match("/^\d+$/", $purchase_unique_id)) {
                $action = "Purchase Entry Deleted. ";
                
                $prev_stock_list = array();
                $tables = "";
                $prev_stock_list = $obj->PrevStockList($delete_purchase_entry_id);
                if (!empty($prev_stock_list)) {
                    foreach ($prev_stock_list as $data) {
                        $stock_godown_id = "";
                        $stock_magazine_id = "";
                        $stock_case_contains = "";
                        $stock_purchase_entry_id = $delete_purchase_entry_id;
                        $stock_id = "";
                        if (!empty($data['id'])) {
                            $stock_id = $data['id'];
                        }
                        if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                            $stock_godown_id = $data['godown_id'];
                        }
                        if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $stock_magazine_id = $data['magazine_id'];
                        }
                        if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                            $stock_case_contains = $data['case_contains'];
                        }
                        if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                            $stock_product_id = $data['product_id'];
                        }
                        if (!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                            $inward_unit = $data['inward_unit'];
                        }
                        if (!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                            $inward_subunit = $data['inward_subunit'];
                        }
                        if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                            $outward_unit = $data['outward_unit'];
                        }
                        if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                            $outward_subunit = $data['outward_subunit'];
                        }
                        if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_godown_table'];
                        } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_magazine_table'];
                        }
                        $current_stock_unit = 0;
                        $current_stock_subunit = 0;
                        if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                            $current_stock_unit = $obj->getCurrentStockUnit($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                            $current_stock_subunit = $obj->getCurrentStockSubunit($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                            $stock_table_unique_id = "";
                            $stock_table_unique_id = $obj->getStockTablesUniqueID($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        }
                        else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
                            $current_stock_unit = $obj->getCurrentStockUnit($tables, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                            $current_stock_subunit = $obj->getCurrentStockSubunit($tables, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                            $stock_table_unique_id = "";
                            $stock_table_unique_id = $obj->getStockTablesUniqueID($tables, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        }

                        if(!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            $current_stock_unit = $current_stock_unit - $inward_unit;
                        }
                        else {
                            $current_stock_unit = 0;
                        }
                        if(!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit - $inward_subunit;
                        }
                        else {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }

                        if (empty($current_stock_unit) && $current_stock_unit == $GLOBALS['null_value']) {
                            $current_stock_unit = 0;
                        }
                        if (empty($current_stock_subunit) && $current_stock_subunit == $GLOBALS['null_value']) {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }

                        if($inward_quantity < $outward_quantity) {
                            $can_delete = 0;
                        }
                   
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
                    
                        if(preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($tables, $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
                $columns = array();
                $values = array();
                $columns = array('cancelled');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $purchase_unique_id, $columns, $values, $action);   
            }
        }else{
            $msg = "Can't Delete. Stock goes to negative!";
        }
      }
        echo $msg;
        exit;
    }

    ?>