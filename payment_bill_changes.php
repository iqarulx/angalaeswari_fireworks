<?php
include("include.php");

if(isset($_REQUEST['payment_row_index'])) {
    $payment_row_index = $_REQUEST['payment_row_index'];

    $payment_mode_id = $_REQUEST['selected_payment_mode_id'];
    $payment_mode_id = trim($payment_mode_id);

    $bank_id = $_REQUEST['selected_bank_id'];
    $bank_id = trim($bank_id);

    $amount = $_REQUEST['selected_amount'];
    $amount = trim($amount);
    ?>
    <tr class="payment_row" id="payment_row<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>">
        <td class="sno text-center">
            <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
        </td>
        <td class="text-center">
            <?php
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_id, 'payment_mode_name');
                echo $obj->encode_decode('decrypt', $payment_mode_name);
            ?>
            <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_id)) { echo $payment_mode_id; } ?>">
        </td>
        <td class="text-center">
            <?php
                $bank_name = "";
                $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id, 'bank_name');
                $account_number = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id, 'account_number');
                if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $bank_name) ." - ". $obj->encode_decode('decrypt',$account_number);
                }
                else {
                    echo '-';
                }   
            ?>
            <input type="hidden" name="bank_id[]" value="<?php if(!empty($bank_id)) { echo $bank_id; } ?>">
        </td>
        <td class="text-center">
            <input type="text" name="amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentTotal();InputBoxColor(this, 'text');">
        </td>
        <td class="text-center">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeletePaymentRow('<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php
}

if(isset($_REQUEST['selected_bank_payment_mode'])) {
	$selected_bank_payment_mode = "";
	$selected_bank_payment_mode = $_REQUEST['selected_bank_payment_mode'];
	
	if(!empty($selected_bank_payment_mode)) {
		$bank_list = array();
        $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '', '','');
        $filtered_banks = array();
        foreach($bank_list as $bank) {
            $payment_modes = explode(',', $bank['payment_mode_id']);
            if (in_array($selected_bank_payment_mode, $payment_modes)) {
                $filtered_banks[] = $bank;
            }
        }

        $count_of_bank = 0;
        $count_of_bank = count($filtered_banks);

		if(!empty($filtered_banks)){
		    ?>
                <option value="">Select Bank</option>
                <?php
                    foreach ($filtered_banks as $list){
                        ?>
                        <option value="<?php if(!empty($list['bank_id'])){echo $list['bank_id'];} ?>" <?php if(!empty($bank_id) && $list['bank_id'] == $bank_id || !empty($count_of_bank) && $count_of_bank == 1){ ?>selected<?php } ?>> 
                        <?php
                            $account_name = "";
                            $account_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $list['bank_id'], 'bank_name');
                            $account_number = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $list['bank_id'], 'account_number');
                            if(!empty($account_name)) {
                                $account_name = $obj->encode_decode('decrypt', $account_name);
                                echo $account_name ." - ".$obj->encode_decode('decrypt',$account_number);
                            }
                            ?>
                        </option>
                        <?php
                    }
                ?>
			<?php
		}

    }
}

if(isset($_REQUEST['get_party_list_voucher'])) {
	$party_type = "";
	$party_type = $_REQUEST['get_party_list_voucher'];
	if($party_type == '1'){
		$party_list = array();
        $party_list =$obj->getTableRecords($GLOBALS['supplier_table'],'','','');

        $party_count = 0;
        $party_count = count($party_list);
		?>
            <div class="form-group">
                <div class="form-label-group in-border" >
                    <select name="party_id" id="party_id" class="form-control" onchange="Javascript:HideDetails('supplier');">
                        <option value="">Select Party</option>
                        <?php
                            if(!empty($party_list)) {
                                foreach($party_list as $data) { ?>
                                    <option value="<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>" <?php if(!empty($party_id) && $data['supplier_id'] == $party_id || (!empty($party_count) && $party_count == 1)) { ?> selected <?php } ?> >
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
                    <label>Party</label>
                </div>
                <a href="Javascript:ViewPartyDetails('supplier');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
            </div>
            <div class="col-lg-8 col-md-4 col-12 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <a href="Javascript:ViewPendingDetails('1');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view Pending details</a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.add_update_form_content').find('select').select2();
				}); 
			</script>
		<?php
	}else if($party_type == '2'){
		$agent_list = array();
	    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'],'','','');

        $agent_count = 0;
        $agent_count = count($agent_list);
		?>
        <div class="form-group">
            <div class="form-label-group in-border" >
                <select name="party_id" id="party_id" class="form-control" onchange="Javascript:HideDetails('agent');">
                    <option value="">Select Party</option>
                    <?php
                        if(!empty($agent_list)) {
                            foreach($agent_list as $data) { ?>
                                <option value="<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>" <?php if(!empty($agent_id) && $data['agent_id'] == $agent_id || (!empty($agent_count) && $agent_count == 1)) { ?> selected <?php } ?> >
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
                <label>Agent</label>
                <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('.add_update_form_content').find('select').select2();
                        }); 
                </script>
            </div>
            <a href="Javascript:ViewPartyDetails('agent');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
        </div>
        <div class="col-lg-8 col-md-4 col-12 py-2">
            <div class="form-group">
                <div class="form-label-group in-border">
                    <a href="Javascript:ViewPendingDetails('2');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view Pending details</a>
                </div>
            </div>
        </div>
		<?php
	} else if($party_type == '3'){
        $contractor_list = array();
	    $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'],'','','');
		?>
        <div class="form-group">
            <div class="form-label-group in-border" >
                <select name="party_id" id="party_id" class="form-control" onchange="Javascript:HideDetails('contractor');">
                    <option value="">Select Party</option>
                    <?php
                        if(!empty($contractor_list)) {
                            foreach($contractor_list as $data) { ?>
                                <option value="<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>">
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
                <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('.add_update_form_content').find('select').select2();
                        }); 
                </script>
            </div>
            <a href="Javascript:ViewPartyDetails('contractor');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
        </div>
        <div class="col-lg-8 col-md-4 col-12 py-2">
            <div class="form-group">
                <div class="form-label-group in-border">
                    <a href="Javascript:ViewPendingDetails('3');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view Pending details</a>
                </div>
            </div>
        </div>
		<?php
    }
}


if(isset($_REQUEST['details_type'])) {
    $type = $_REQUEST['details_type'];
    $type = trim($type);
    $type_id = $_REQUEST['view_party_details'];
    $type_id = trim($type_id);
    
    $details_list = array();
    
    if(!empty($type)) {
        $details_list = $obj->getTableRecords($GLOBALS[$type.'_table'], $type.'_id', $type_id, '');
        if(!empty($details_list)) {
            foreach($details_list as $data) {
                if($type == 'contractor') {
                    if(!empty($data[$type.'_name']) && $data[$type.'_name'] != $GLOBALS['null_value']) {
                        $name = $obj->encode_decode('decrypt', $data[$type.'_name']);
                    }
                    if(!empty($data['mobile']) && $data['mobile'] != $GLOBALS['null_value']) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile']);
                    }
                    if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']) {
                        $location = $obj->encode_decode('decrypt', $data['location']);
                    }
                }
                else {
                    if(!empty($data[$type.'_name']) && $data[$type.'_name'] != $GLOBALS['null_value']) {
                        $name = $obj->encode_decode('decrypt', $data[$type.'_name']);
                    }
                    if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
                        $address = $obj->encode_decode('decrypt', $data['address']);
                    }
                    if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                        $city = $obj->encode_decode('decrypt', $data['city']);
                    }
                    if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
                        $district = $obj->encode_decode('decrypt', $data['district']);
                    }
                    if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                        $state = $obj->encode_decode('decrypt', $data['state']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
                        $pincode = $obj->encode_decode('decrypt', $data['pincode']);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                    }
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
                        $email = $obj->encode_decode('decrypt', $data['email']);
                    }
                    if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                        $identification = $obj->encode_decode('decrypt', $data['identification']);
                    }
                }
            }	
        } else {
            if($type == "customer") {
                $details_list = $obj->getTableRecords($GLOBALS['agent_table'], 'agent_id', $type_id, '');
                if(!empty($details_list)) {
                    foreach($details_list as $data) {
                        if(!empty($data['agent_name']) && $data['agent_name'] != $GLOBALS['null_value']) {
                            $name = $obj->encode_decode('decrypt', $data['agent_name']);
                        }
                        if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
                            $address = $obj->encode_decode('decrypt', $data['address']);
                        }
                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                            $city = $obj->encode_decode('decrypt', $data['city']);
                        }
                        if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
                            $district = $obj->encode_decode('decrypt', $data['district']);
                        }
                        if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                            $state = $obj->encode_decode('decrypt', $data['state']);
                        }
                        if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
                            $pincode = $obj->encode_decode('decrypt', $data['pincode']);
                        }
                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                            $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                        }
                        if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
                            $email = $obj->encode_decode('decrypt', $data['email']);
                        }
                        if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                            $identification = $obj->encode_decode('decrypt', $data['identification']);
                        }
                    }	
                }
            }
        }

        ?>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-12 col-xl-12 d-flex">
                <div class="col-lg-4 col-xl-4 col-sm-6"><b>Name </b></div>
                <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($name)){ echo ": " .$name; }?> </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-12 col-xl-12 d-flex">
                <div class="col-lg-4 col-xl-4 col-sm-6"><b>Phone Number </b></div>
                <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($mobile_number)){ echo ": " .$mobile_number; }?> </div>
            </div>
        </div>
        <?php if(!empty($email) && ($email != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Email </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($email)){ echo ": " .$email; }?> </div>
                </div>
            </div> <?php
        } ?>
        <?php if(!empty($address) && ($address != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Address </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($address)){ echo ": " .$address; }?> </div>
                </div>
            </div> <?php
        } 
        if(!empty($city) && ($city != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>City </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($city)){ echo ": " .$city; }?> </div>
                </div>
            </div> <?php
        } ?>
        <?php if(!empty($district) && ($district != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>District </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($district)){ echo ": " .$district; }?> </div>
                </div>
            </div> <?php
        } ?>
        <?php if(!empty($state) && ($state != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>State </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($state)){ echo ": " .$state; }?> </div>
                </div> 
            </div> <?php
        } ?>
        <?php if(!empty($location) && ($location != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Location </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($location)){ echo ": " .$location; }?> </div>
                </div> 
            </div> <?php
        } ?>
        <?php if(!empty($identification) && ($identification != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Identification </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($identification)){ echo ": " .$identification; }?> </div>
                </div>
            </div> <?php
        }  
    
    }
}


if(isset($_REQUEST['get_filter_party_list_voucher'])) {
	$party_type = "";
	$party_type = $_REQUEST['get_filter_party_list_voucher'];
	if($party_type == '1'){
		$party_list = array();
        $party_list =$obj->getTableRecords($GLOBALS['supplier_table'],'','','');
		?>
            <div class="form-group">
                <div class="form-label-group in-border" onchange="Javascript:table_listing_records_filter();Javascript:table_listing_records_filter();">
                    <select name="filter_party_id" id="filter_party_id" class="form-control">
                        <option value="">Select Party</option>
                        <?php
                            if(!empty($party_list)) {
                                foreach($party_list as $data) { ?>
                                    <option value="<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>" <?php if(!empty($party_id) && $data['supplier_id'] == $party_id) { ?> selected <?php } ?> >
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
                    <label>Party</label>                   
                </div>
            </div>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.add_update_form_content').find('select').select2();
				}); 
			</script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
		<?php
	}else if($party_type == '2'){
		$agent_list = array();
	    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'],'','','');
		?>
        <div class="form-group">
            <div class="form-label-group in-border" onchange="Javascript:table_listing_records_filter();">
                <select name="filter_party_id" id="filter_party_id" class="form-control">
                    <option value="">Select Party</option>
                    <?php
                        if(!empty($agent_list)) {
                            foreach($agent_list as $data) { ?>
                                <option value="<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>">
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
                <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('.add_update_form_content').find('select').select2();
                        }); 
                </script>
                <script src="include/select2/js/select2.min.js"></script>
                <script src="include/select2/js/select.js"></script>
            </div>
        </div>
		<?php
	} else if($party_type == '3'){
        $contractor_list = array();
	    $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'],'','','');
		?>
        <div class="form-group">
            <div class="form-label-group in-border" onchange="Javascript:table_listing_records_filter();">
                <select name="filter_party_id" id="filter_party_id" class="form-control">
                    <option value="">Select Party</option>
                    <?php
                        if(!empty($contractor_list)) {
                            foreach($contractor_list as $data) { ?>
                                <option value="<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>">
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
                <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('.add_update_form_content').find('select').select2();
                        }); 
                </script>
                <script src="include/select2/js/select2.min.js"></script>
                <script src="include/select2/js/select.js"></script>
            </div>
        </div>
		<?php
    }
}

//dhivya
if(isset($_REQUEST['party_type'])) {
    $party_type = $_REQUEST['party_type'];
    $party_type = trim($party_type);

    $party_id = $_REQUEST['party_id'];
    $party_id = trim($party_id);

    $list = array();
    $list = $obj->getPendingList($party_type, $party_id);

    $party_name = ""; $opening_balance = 0; $opening_balance_type = "";
    // if($party_type == '1') {
        // $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $party_id, 'name_mobile_city');
        // $party_name = $obj->encode_decode('decrypt', $party_name);
    //     $opening_balance = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $party_id, 'opening_balance');
    //     $opening_balance_type = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $party_id, 'opening_balance_type');
    // }
    // elseif($party_type == '2') {
        // $party_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $party_id, 'name_mobile_city');
    //     $party_name = $obj->encode_decode('decrypt', $party_name);
    //     $opening_balance = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $party_id, 'opening_balance');
    //     $opening_balance_type = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $party_id, 'opening_balance_type');
    // }
    // elseif($party_type == '3') {
        // $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $party_id, 'name_mobile_city');
    //     $party_name = $obj->encode_decode('decrypt', $party_name);
    //     $opening_balance = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $party_id, 'opening_balance');
    //     $opening_balance_type = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $party_id, 'opening_balance_type');
    // }
    // elseif($party_type == '4') {
        // $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $party_id, 'name_mobile_city');
        // $party_name = $obj->encode_decode('decrypt', $party_name);
    //     $opening_balance = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $party_id, 'opening_balance');
    //     $opening_balance_type = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $party_id, 'opening_balance_type');
    // }
    $current_balance = 0; $current_type = "";
    ?>
    <div class="col-12 table-responsive">
        <table class="table table-bordered table-striped nowrap cursor text-center smallfnt" style="font-size:15px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bill No<br>Date</th>
                    <th>Bill Type</th>
                    <th>Particulars</th>
                    <th>Credit</th>
                    <th>Debit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total_credit = 0; $total_debit = 0;
                    // if(!empty($opening_balance) && $opening_balance != $GLOBALS['null_value']) {
                        ?>
                        <!-- <tr>
                            <td colspan="4" class="text-end text-primary" style="font-weight:bold;">
                                Opening Balance
                            </td>
                            <td class="text-end text-success"> -->
                                <?php
                                    // if($opening_balance_type == 'Credit') {
                                    //     $total_credit += $opening_balance;
                                    //     echo $obj->numberFormat($opening_balance,2).'&nbsp';
                                    // }
                                    // else {
                                    //     echo '-';
                                    // }
                                ?>
                            <!-- </td>
                            <td class="text-end text-danger"> -->
                                <?php
                                    // if($opening_balance_type == 'Debit') {
                                    //     $total_debit += $opening_balance;
                                    //     echo $obj->numberFormat($opening_balance,2).'&nbsp';
                                    // }
                                    // else {
                                    //     echo '-';
                                    // }
                                ?>
                            <!-- </td>
                        </tr> -->
                        <?php
                    // }
                    
                    $s_no = 1;
// print_r($list);
                    if (!empty($list)) {
                        $merged_data = [];

                        // foreach ($list as $data) {
                        //     $bill_number = $data['bill_number'];
                            
                        //     if (!isset($merged_data[$bill_number])) {
                        //         $merged_data[$bill_number] = [
                        //             'bill_number' => $bill_number,
                        //             'bill_date' => $data['bill_date'],
                        //             'bill_type' => $data['bill_type'],
                        //             'agent_name' => $data['agent_name'],
                        //             'party_name' => $data['party_name'],
                        //             'particulars' => [],
                        //             'credit' => 0,
                        //             'debit' => 0
                        //         ];
                        //     }

                            
                            
                        //     $detail = "";
                        //     if($data['bill_type'] != 'Purchase' && $data['bill_type'] != 'Estimate'){
                                
                        //         if (!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                        //             if(!empty($detail)) {
                        //                 $detail .= $obj->encode_decode('decrypt', $data['payment_mode_name']);
                        //             }
                        //             else {
                        //                 $detail = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                        //             }
                        //         }
                        //         $account_number = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $data['bank_id'], 'account_number');
                        //         if (!empty($data['bank_name']) && $data['bank_name'] != $GLOBALS['null_value']) {
                        //             if(!empty($detail)) {
                        //                 $detail .= " - (" . $obj->encode_decode('decrypt', $data['bank_name']) . ") - ".$obj->encode_decode('decrypt',$account_number);
                        //             }
                        //             else {
                        //                 $detail = " - (" . $obj->encode_decode('decrypt', $data['bank_name']) . ") - ".$obj->encode_decode('decrypt',$account_number);
                        //             }
                        //         }
                        //     }
                        //     else {
                        //         $detail = " - ";
                        //     }

                        //     $merged_data[$bill_number]['particulars'][] = $detail;
                        //     $merged_data[$bill_number]['credit'] += $data['credit'];
                        //     $merged_data[$bill_number]['debit'] += $data['debit'];
                        // }
                        
                        foreach ($list as $data) { 
                            if(!empty($data['party_name']) && $data['party_name'] != "NULL") {
                                $party_name = $obj->encode_decode('decrypt', $data['party_name']);
                            }

                            if(!empty($data['agent_name']) && $data['agent_name'] != "NULL") {
                                $party_name = $obj->encode_decode('decrypt', $data['agent_name']);
                            }
        ?>
                        <tr>
                            <td><?php echo $s_no ?></td>

                            <td>
                                <?php
                                if(!empty($data['bill_number']) && ($data['bill_number'] != 'NULL')){
                                    echo $data['bill_number'] ."<br>";
                                }  ?>
                                <?php echo date('d-m-Y', strtotime($data['bill_date'])); ?></td>
                            <td><?php echo $data['bill_type']; ?></td>
                            <td class="">
                                <?php 

                                if(!empty($data['payment_mode_name']) && ($data['payment_mode_name'] != 'NULL')) {
                                    $payment_mode_name = array();
                                    $payment_mode_name = explode(",", $data['payment_mode_name']);
                                    $payment_mode_name = array_reverse($payment_mode_name);

                                    $bank_id = explode(",",$data['bank_id']);
                                    $bank_id = array_reverse($bank_id);
                                    // print_r($payment_mode_name);
                                    for($i=0; $i < count($payment_mode_name); $i++) {
                                        $payment_mode ="";

                                        if($payment_mode_name[$i] != 'NULL' && $payment_mode_name != '')
                                        {
                                            $payment_mode =$obj->encode_decode("decrypt", $payment_mode_name[$i]);
                                        
                                            // echo $data['credit'];
                                            if (!empty($data['credit']) || !empty($data['debit'])) {
                                                $amounts= array();
                                                if($data['bill_type'] == 'Receipt' || $data['bill_type'] == 'Daily Production'){
                                                    $amounts = explode(",", $data['credit']);
                                                }else if($data['bill_type'] == 'Voucher' || $data['bill_type'] == 'Expense'){
                                                    $amounts = explode(",", $data['debit']);
                                                }
                                                $amounts = array_reverse($amounts);
                                            }
                                            // print_r($amounts);
                                            $bank_name = "";
                                            if(!empty($bank_id[$i]) && $bank_id[$i] != $GLOBALS['null_value']){
                                                $bank_name =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                                                $bank_name = $obj->encode_decode('decrypt',$bank_name);
                                            }

                                            if(!empty($bank_name)){
                                                echo $payment_mode ." - ( ".$bank_name." ) - ".$obj->numberFormat($amounts[$i],2) ;
                                            }else{
                                                if(!empty($payment_mode) && $payment_mode != $GLOBALS['null_value'])
                                                {
                                                    echo $payment_mode ." - ".$obj->numberFormat($amounts[$i],2) ;
                                                }
                                                else
                                                {
                                                    echo $obj->numberFormat($amounts[$i],2) ;
                                                }

                                            }  
                                            if($i < (count($payment_mode_name))-1) {
                                            echo ", <br>";

                                            }
                                        }
                                    }  

                                }else{
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td class="text-end text-success">
                                <?php
                                    if(!empty($data['credit'])) {
                                        $total_credit += $data['credit'];
                                        echo $obj->numberFormat($data['credit'],2).'&nbsp';
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                            <td class="text-end text-danger">
                                <?php
                                    if(!empty($data['debit'])) {
                                        $total_debit += $data['debit'];
                                        echo $obj->numberFormat($data['debit'],2).'&nbsp';
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $s_no++;
                        }
                        
                    }
                    

                    /*
                    else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">Sorry! No records found</td>
                        </tr>
                        <?php
                    }  */ ?>
                    <tr>
                        <?php
                            if($total_credit > $total_debit) {
                                $current_balance = $total_credit - $total_debit;
                                $current_type = " Cr";
                            }
                            else if($total_credit < $total_debit) {
                                $current_balance = $total_debit - $total_credit;
                                $current_type = " Dr";
                            }
                        ?>
                        <td class="text-danger" colspan="6" style="font-weight:bold;">
                            Current Balance : 
                            <?php
                                echo $obj->numberFormat($current_balance,2).$current_type;
                            ?>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php
    echo "$$$".$party_name." <span class='text-center text-danger'>(Balance : ".($obj->numberFormat($current_balance,2).$current_type).")</span>"; 
}

?>