<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['expense_party_module'];
        }
    }

	if(isset($_REQUEST['show_expense_party_id'])) {
        $show_expense_party_id = $_REQUEST['show_expense_party_id'];
        $show_expense_party_id = trim($show_expense_party_id);
        
        $country = "India";$state = "";$district = "";$city = "";$expense_party_name = "";$mobile_number = "";$address = "";$email = "";$pincode = "";$product_id="";$product_name="";$pincode = ""; $state = "Tamil Nadu";$identification = ""; $raw_material_group_id = "";


        if(!empty($show_expense_party_id)){
            $expense_party_list = array();
            $expense_party_list = $obj->getTableRecords($GLOBALS['expense_party_table'],'expense_party_id',$show_expense_party_id,'');
            if(!empty($expense_party_list)) {
                foreach($expense_party_list as $data){ 
                    if(!empty($data['expense_party_name']) && $data['expense_party_name'] != $GLOBALS['null_value']){
                        $expense_party_name = $obj->encode_decode("decrypt",$data['expense_party_name']);
                        $expense_party_name = html_entity_decode($expense_party_name);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                        $mobile_number = $obj->encode_decode("decrypt",$data['mobile_number']);
                    }
                    if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']){
                        $state = $obj->encode_decode("decrypt",$data['state']);
                    }
                    if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']){
                        $district = $obj->encode_decode("decrypt",$data['district']);
                    }
                    if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']){
                        $city = $obj->encode_decode("decrypt",$data['city']);
                    }
                    if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']){
                        $address = $obj->encode_decode("decrypt",$data['address']);
                        $address = html_entity_decode($address);
                    }
                    if(!empty($data['expense_party_details']) && $data['expense_party_details'] != $GLOBALS['null_value']) {
                        $expense_party_details = $obj->encode_decode('decrypt', $data['expense_party_details']);
                    }
                    if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']){
                        $gst_number = $data['gst_number'];
                    }
                    if(!empty($data['opening_balance']) && $data['opening_balance'] != $GLOBALS['null_value']){
                        $opening_balance = $data['opening_balance'];
                    }
                    if(!empty($data['opening_balance_type']) && $data['opening_balance_type'] != $GLOBALS['null_value']){
                        $opening_balance_type = $data['opening_balance_type'];
                    }
                    if(!empty($data['raw_material_group_id']) && $data['raw_material_group_id'] != $GLOBALS['null_value']){
                        $raw_material_group_id = $data['raw_material_group_id'];
                    }
                }
            }
        }
        $linked_expense_party = 0;
        if(!empty($show_expense_party_id)){
             $linked_expense_party = $obj->PaymentlinkedExpenseParty($show_expense_party_id);
        }

        $expense_category_list = array();
        $expense_category_list = $obj->getTableRecords($GLOBALS['expense_category_table'], '', '', '');
        ?>
		<script type="text/javascript" src="include/js/creation_modules.js"></script>


        <form class="poppins pd-20 redirection_form" name="expense_party_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_expense_party_id)){ ?>
                            <div class="h5">Edit Expense Party</div>
                            <?php
                        } else { ?>
                            <div class="h5">Add Expense Party</div>
                            <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('expense_party.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_expense_party_id)) { echo $show_expense_party_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="expense_party_name" name="expense_party_name" class="form-control shadow-none" value="<?php if(!empty($expense_party_name)){echo $expense_party_name;} ?>"  onkeydown="Javascript:KeyboardControls(this,'text',25,1);"  required>
                            <label>Expense Party Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" required value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'');">
                            <label>Mobile Number</span></label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" class="form-control shadow-none" required  value="<?php if(!empty($opening_balance)){echo $opening_balance;} ?>" onfocus="Javascript:KeyboardControls(this,'number',6,1);" maxlength="6" <?php if(!empty($linked_expense_party)){ ?> readonly <?php } ?>>
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                    <select name="opening_balance_type" class="select2 select2-danger" style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');" <?php if(!empty($linked_expense_party)){ ?> disabled <?php } ?>>
                                        <option value="">Select</option>
                                        <option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Credit"){ ?>selected<?php } ?>>Credit</option>
                                        <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Debit"){ ?>selected<?php } ?>>Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($linked_expense_party) && !empty($show_expense_party_id)){ ?>
                    <input type="hidden" name="opening_balance_type" value="<?php if(!empty($opening_balance_type)){ echo $opening_balance_type; } ?>">
                <?php 
                } ?>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="expense_category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select</option>
                                <?php
                                    if (!empty($expense_category_list)) {
                                        foreach ($expense_category_list as $data) {
                                            if (!empty($data['expense_category_id'])) {
                                                ?>
                                                <option value="<?php echo $data['expense_category_id']; ?>" <?php if (!empty($expense_category_id) && $data['expense_category_id'] == $expense_category_id || (!empty($count_group) && $count_group == 1)) { ?>selected<?php } ?>>
                                                    <?php
                                                    if (!empty($data['expense_category_name'])) {
                                                        $data['expense_category_name'] = $obj->encode_decode('decrypt', $data['expense_category_name']);
                                                        echo $data['expense_category_name'];
                                                    }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Expense Category<span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-md-12 py-3 text-center submit_button">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'expense_party_form', 'expense_party_changes.php', 'expense_party.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script type="text/javascript">
                getCountries('expense_party','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
                jQuery(document).ready(function(){
					jQuery('select').select2();
				});
            </script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 


    if(isset($_POST['edit_id'])) {	
        $expense_party_name = ""; $expense_party_name_error = "";  $mobile_number = ""; $mobile_number_error = ""; $opening_balance = 0; $opening_balance_error = ""; $opening_balance_type = ""; $opening_balance_type_error = ""; $expense_category_id = ""; $expense_category_id_error = ""; 
        $valid_expense_party = ""; $form_name = "expense_party_form"; $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $expense_party_name = $_POST['expense_party_name'];
        $expense_party_name = trim($expense_party_name);
        if(!empty($expense_party_name)) {
            $expense_party_name_error = $valid->valid_name_text($expense_party_name, 'Expense Party Name', '1');
        }
        if(!empty($expense_party_name) && strlen($expense_party_name) > 25) {
            $expense_party_name_error = "Only 25 characters allowed";
        }
        if(empty($expense_party_name)){
            $expense_party_name_error = "Enter the Expense Party name";
        }
        if(!empty($expense_party_name_error)) {
            $valid_expense_party = $valid->error_display($form_name, "expense_party_name", $expense_party_name_error, 'text');		
            if(!empty($address_error)) {
                if(!empty($valid_expense_party)) {
                    $valid_expense_party = $valid_expense_party." ".$valid->error_display($form_name, "expense_party_name", $expense_party_name_error, 'text');
                }
                else {
                    $valid_expense_party = $valid->error_display($form_name, "expense_party_name", $expense_party_name_error, 'text');
                }
            }  	
        }
    
        $mobile_number = $_POST['mobile_number'];
        $mobile_number = trim($mobile_number);

        if(isset($_POST['opening_balance'])){
            $opening_balance = $_POST['opening_balance'];
            if(!empty($opening_balance)){
                $opening_balance_error = $valid->valid_number($opening_balance,"opening balance",'0','');
                if($opening_balance > 999999){
                    $opening_balance_error = "Only 6 digits allowed";
                }
            }
           
        }

        if(isset($_POST['opening_balance_type'])){
            $opening_balance_type = $_POST['opening_balance_type'];
        }

        if(!empty($opening_balance) && empty($opening_balance_type)){
            $opening_balance_error = "Select opening balance type";
        }

        if($opening_balance == "" && !empty($opening_balance_type)) {
            $opening_balance_error = "Enter opening balance as type is selected";
        }
        
        if(!empty($opening_balance_error)){
            if(!empty($valid_expense_party)) {
                $valid_expense_party = $valid_expense_party." ".$valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
            else {
                $valid_expense_party = $valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
        }
      
        if(isset($_POST['expense_category_id'])) {
            $expense_category_id = $_POST['expense_category_id'];
            $expense_category_id = trim($expense_category_id);
            $expense_category_id_error = $valid->common_validation($expense_category_id,'Expense Category','select');
            if(!empty($expense_category_id_error)) {
                if(!empty($valid_expense_party)) {
                    $valid_expense_party = $valid_expense_party." ".$valid->error_display($form_name, "expense_category_id", $expense_category_id_error, 'select');
                } else {
                    $valid_expense_party = $valid->error_display($form_name, "expense_category_id", $expense_category_id_error, 'select');
                }
            }
        }

        $result = "";
        if(empty($valid_expense_party)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
    
                $name_mobile_city = ""; $expense_party_details = ""; $lower_case_name="";
                if(!empty($expense_party_name)) {
                    $expense_party_name = htmlentities($expense_party_name, ENT_QUOTES);
                    $lower_case_name = strtolower($expense_party_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($expense_party_name)) {
                    $name_mobile_city = $expense_party_name;
                    $expense_party_details = $expense_party_name;
                    $expense_party_name = $obj->encode_decode('encrypt', $expense_party_name);
                }
               
                if(!empty($address)) {
                    if(!empty($expense_party_details)) {
                        $expense_party_details = $expense_party_details."$$$".str_replace("\r\n", "$$$", $address);
                    }
                    $address = $obj->encode_decode('encrypt', $address);
                } else {
                    $address = $GLOBALS['null_value'];
                }

                if(!empty($city)) {
                    if(!empty($expense_party_details)) {
                        $expense_party_details = $expense_party_details."$$$".$city;
                    }
                }

                if(!empty($district)) {
                    if(!empty($expense_party_details)) {
                        $expense_party_details = $expense_party_details."$$$".$district."(Dist.)";
                    }
                }

                if(!empty($state)) {
                    if(!empty($expense_party_details)) {
                        $expense_party_details = $expense_party_details."$$$".$state;
                    }
                    $state = $obj->encode_decode('encrypt', $state);
                }

                if(!empty($mobile_number)) {
                    $mobile_number = str_replace(" ", "", $mobile_number);

                    if(!empty($expense_party_details)) {
                        $expense_party_details = $expense_party_details."$$$ Mobile : ".$mobile_number;
                    }

                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }else {
                    $mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($name_mobile_city)){
                    $name_mobile_city = $obj->encode_decode('encrypt', $name_mobile_city);
                }
                

                if(!empty($city)) {
                    $city = $obj->encode_decode('encrypt', $city);
                }
                else{
                    $city = $GLOBALS['null_value'];
                }
               
                if(!empty($district)) {
                    $district = $obj->encode_decode('encrypt', $district);
                }
                else{
                    $district = $GLOBALS['null_value'];
                }
                if(!empty($expense_party_details)) {
                    $expense_party_details = $obj->encode_decode('encrypt', $expense_party_details);
                }
               
                $balance = 0;

                $prev_expense_party_id = ""; $expense_party_error = "";	$prev_expense_party_name ="";
                if(!empty($mobile_number)) {
                    $prev_expense_party_id = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'lower_case_name', $lower_case_name, 'expense_party_id');

                    if(!empty($prev_expense_party_id) && $prev_expense_party_id != $edit_id) {
                        $prev_expense_party_name = $obj->getTableColumnValue($GLOBALS['expense_party_table'],'expense_party_id',$prev_expense_party_id,'expense_party_name');
						$prev_expense_party_name = $obj->encode_decode("decrypt",$prev_expense_party_name);
                        $expense_party_error = "This name is already used";
                    }
                }
        
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);                
                
                if(empty($edit_id)) {
                    if(empty($prev_expense_party_id) && empty($prev_gst_expense_party_id)) {
                        $action = "";
                        if(!empty($name_mobile_city)) {
                            $action = "New expense_party Created. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'expense_party_id', 'expense_party_name', 'lower_case_name', 'mobile_number', 'opening_balance', 'opening_balance_type', 'expense_party_details', 'expense_category_id', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$expense_party_name."'", "'".$lower_case_name."'", "'".$mobile_number."'", "'".$opening_balance."'", "'".$opening_balance_type."'", "'".$expense_party_details."'", "'" . $expense_category_id . "'", "'0'");
                        $expense_party_insert_id = $obj->InsertSQL($GLOBALS['expense_party_table'], $columns, $values, 'expense_party_id', '', $action);
                        if(preg_match("/^\d+$/", $expense_party_insert_id)) {	
                            $expense_party_id = "";
                            $expense_party_id = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'id', $expense_party_insert_id, 'expense_party_id');
                           	
                            $balance = 1;
                            $result = array('number' => '1', 'msg' => 'Expense Party Successfully Created','expense_party_id' => $expense_party_id);
                            				
                        } else {
                            $result = array('number' => '2', 'msg' => $expense_party_insert_id);
                        }
                    } else {
                        if(!empty($expense_party_error)) {
                            $result = array('number' => '2', 'msg' => $expense_party_error);
                        }
                        if(!empty($gst_expense_party_error)) {
                            $result = array('number' => '2', 'msg' => $gst_expense_party_error);
                        }
                    }
                } else {
                    if(empty($prev_expense_party_id) || $prev_expense_party_id == $edit_id && empty($prev_gst_expense_party_id) || $prev_gst_expense_party_id == $edit_id) {
                        $getUniqueID = ""; $expense_party_id =$edit_id;
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($name_mobile_city)) {
                                $action = "expense_party Updated. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','expense_party_name', 'lower_case_name', 'mobile_number',  'opening_balance', 'opening_balance_type', 'expense_party_details',  'expense_category_id');
                            $values = array("'".$creator_name."'", "'".$expense_party_name."'", "'".$lower_case_name."'", "'".$mobile_number."'", "'".$opening_balance."'","'".$opening_balance_type."'", "'".$expense_party_details."'", "'" . $expense_category_id . "'");
                            $user_update_id = $obj->UpdateSQL($GLOBALS['expense_party_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $user_update_id)) {
                                
                                $balance = 1;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $user_update_id);
                            }							
                        }
                    } else {
                        if(!empty($expense_party_error)) {
                            $result = array('number' => '2', 'msg' => $expense_party_error);
                        }
                        if(!empty($gst_expense_party_error)) {
                            $result = array('number' => '2', 'msg' => $gst_expense_party_error);
                        }
                    }
                }

                if(!empty($balance) && $balance == 1) {
                    $bill_id = $expense_party_id; 
                    $bill_date = date("Y-m-d");
                    $bill_number = $GLOBALS['null_value'];
                    $bill_type = "Expense Party Opening Balance";
                    $agent_id = $GLOBALS['null_value'];
                    $agent_name = $GLOBALS['null_value'];
                    $party_id = $expense_party_id;
                    $party_name = $expense_party_name;
                    $party_type = 'Expense Party';
                    $payment_mode_id = $GLOBALS['null_value'];
                    $payment_mode_name = $GLOBALS['null_value'];
                    $bank_id = $GLOBALS['null_value'];
                    $bank_name = $GLOBALS['null_value'];
                    $imploded_amount = $GLOBALS['null_value'];
                    $credit  = 0; $debit = 0; 

                    if($opening_balance_type =='Credit'){
                        $credit  = $opening_balance; 
                    } else if($opening_balance_type =='Debit'){
                        $debit  = $opening_balance; 
                    }
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

                    if(!empty($edit_id)) {
                        $date = $obj->getTableColumnValue($GLOBALS['payment_table'], 'bill_id', $bill_id, 'bill_date');
                        if(!empty($date)) {
                            $bill_date = $date;
                        }
                    }

                    if(!empty($opening_balance) && !empty($opening_balance_type)){
                        $update_balance ="";
                        $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name, $party_id,$party_name,$party_type,$payment_mode_id, $payment_mode_name, $bank_id, $bank_name, $credit,$debit,$opening_balance_type);
                    } else {
                        $payment_unique_id = "";
                        $payment_unique_id = $obj->getPartyOpeningBalanceInPaymentExist($party_id,$bill_type);
                        if(preg_match("/^\d+$/", $payment_unique_id)) {
                            $action = "Payment Deleted.";
                        
                            $columns = array(); $values = array();						
                            $columns = array('deleted');
                            $values = array("'1'");
                            $msg = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                        }
                    }
                }  
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_expense_party)) {
                $result = array('number' => '3', 'msg' => $valid_expense_party);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }


    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title'];

        $search_text = "";
		if(isset($_POST['search_text'])) {
		   $search_text = $_POST['search_text'];
		}

        $show_draft_bill = "";
		if(isset($_POST['show_draft_bill'])) {
		   $show_draft_bill = $_POST['show_draft_bill'];
		}

        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['expense_party_table'], '', '', 'DESC');

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_city'])), $search_text) !== false) {
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
        if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php include("pagination.php"); ?> 
            </div> <?php 
        } 
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) {  ?>
    
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr style="white-space:pre;">
                        <th>S.No</th>
                        <th>Expense Party Name</th>
                        <th>Expense Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php
                    if(!empty($show_records_list)) { 
                        foreach($show_records_list as $key => $data) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                            <tr>
                                <td class="ribbon-header" style="cursor:default;"> <?php
                                    echo $index; ?>
                                </td>
                                <td> <?php
                                    if(!empty($data['expense_party_details'])) {
                                        $data['expense_party_details'] = html_entity_decode($obj->encode_decode('decrypt', $data['expense_party_details']));
                                        echo $data['expense_party_details'];
                                    } ?>
                                    <div class="w-100 py-2">
                                        Creator : <?php
                                        if(!empty($data['creator_name'])) {
                                            $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                            echo $data['creator_name'];
                                        } ?>                                        
                                    </div>
                                </td>
                                <td> <?php
                                    if(!empty($data['expense_category_id'])) {
                                        $expense_category_name = "";
                                        $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $data['expense_category_id'], 'expense_category_name');

                                        if(!empty($expense_category_name)) {
                                            $expense_category_name = $obj->encode_decode('decrypt', $expense_category_name);

                                            echo $expense_category_name;
                                        }
                                    } ?>
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
                                    <?php if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                        <div class="dropdown">
                                            <button class="btn btn-dark show-button poppins" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1"> <?php 
                                                if(empty($edit_access_error)) { ?> 
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['expense_party_id'])) { echo $data['expense_party_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li> <?php 
                                                }
                                                if(empty($delete_access_error)) { 
                                                    $linked_count = 0;
                                                    $linked_count = $obj->GetExpensePartyLinkedCount($data['expense_party_id']); 
                                                    if($linked_count > 0) { ?>
                                                        <li><a class="dropdown-item text-secondary" ><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php 
                                                    }
                                                    else { ?> 
                                                        <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['expense_party_id'])) { echo $data['expense_party_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php 
                                                    }
                                                } ?>  
                                            </ul>
                                        </div> 
                                    <?php } ?>
                                </td>
                            </tr> <?php 
                        } 
                    }  
                    else { ?>
                        <tr>
                            <td colspan="4" class="text-center">Sorry! No records found</td>
                        </tr> <?php 
                    } ?>
                </tbody>
            </table> <?php	
        }
	}

    if(isset($_REQUEST['delete_expense_party_id'])) {
        $delete_expense_party_id = $_REQUEST['delete_expense_party_id'];
        $delete_expense_party_id = trim($delete_expense_party_id);
        $msg = "";
        if(!empty($delete_expense_party_id)) {	
            $expense_party_unique_id = "";
            $expense_party_unique_id = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $delete_expense_party_id, 'id');
            if(preg_match("/^\d+$/", $expense_party_unique_id)) {
                $name_mobile_city = "";
                $name_mobile_city = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $delete_expense_party_id, 'name_mobile_city');
            
                $action = "";
                if(!empty($name_mobile_city)) {
                    $action = "expense_party Deleted. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                }
                $linked_count = 0;
                $linked_count = $obj->GetExpensePartyLinkedCount($delete_expense_party_id); 
                if(empty($linked_count)) {
                    $delete_id = $obj->DeletePayment($delete_expense_party_id);	
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['expense_party_table'], $expense_party_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This expense_party is associated with other screens";
                }
            }
            else {
                $msg = "Invalid expense_party";
            }
        }
        else {
            $msg = "Empty expense_party";
        }
        echo $msg;
        exit;	
    }


?>