<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['agent_module'];
        }
    }

	if(isset($_REQUEST['show_agent_id'])) { 
        $show_agent_id = "";
        $show_agent_id = $_REQUEST['show_agent_id'];
        $show_agent_id = trim($show_agent_id);

        $add_custom_agent = "";
		if(isset($_REQUEST['add_custom_agent'])) {
			$add_custom_agent = $_REQUEST['add_custom_agent'];
			$add_custom_agent = trim($add_custom_agent);
		}

        $custom_agent_form = "";
		if(isset($_REQUEST['form_name'])) {
			$custom_agent_form = $_REQUEST['form_name'];
			$custom_agent_form = trim($custom_agent_form);
		}

        $country = "India";$state = "";$district = "";$city = "";$agent_name = "";$mobile_number = "";$address = "";$pincode = "";$product_id="";$product_name="";$pincode = ""; $identification = ""; $opening_balance = "";$opening_balance_type = ""; $commission = "";
        $state = "Tamil Nadu";
        if(!empty($show_agent_id)){
            $agent_list = array();
            $agent_list = $obj->getTableRecords($GLOBALS['agent_table'],'agent_id',$show_agent_id,'');
            if(!empty($agent_list)) {
                foreach($agent_list as $data){ 
                    if(!empty($data['agent_name']) && $data['agent_name'] != $GLOBALS['null_value']){
                        $agent_name = $obj->encode_decode("decrypt",$data['agent_name']);
                        $agent_name = html_entity_decode($agent_name);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                        $mobile_number = $obj->encode_decode("decrypt",$data['mobile_number']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']){
                        $pincode = $obj->encode_decode("decrypt",$data['pincode']);
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
                    if(!empty($data['agent_details']) && $data['agent_details'] != $GLOBALS['null_value']) {
                        $agent_details = $obj->encode_decode('decrypt', $data['agent_details']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']){
                        $pincode = $obj->encode_decode("decrypt",$data['pincode']);
                    }
                    if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']){
                        $identification = $obj->encode_decode("decrypt",$data['identification']);
                    }
                    if(!empty($data['opening_balance']) && $data['opening_balance'] != $GLOBALS['null_value']){
                        $opening_balance = $data['opening_balance'];
                    }
                    if(!empty($data['opening_balance_type']) && $data['opening_balance_type'] != $GLOBALS['null_value']){
                        $opening_balance_type = $data['opening_balance_type'];
                    }
                    if(!empty($data['commission']) && $data['commission'] != $GLOBALS['null_value']){
                        $commission = $data['commission'];
                    }
                }
            }
        }
        $linked_agent = 0;
        if(!empty($show_agent_id)){
             $linked_agent = $obj->PaymentlinkedAgent($show_agent_id);
        }

        ?>

		<script type="text/javascript" src="include/js/creation_modules.js"></script>

        <form class="poppins pd-20 redirection_form" name="agent_form" method="POST">
            <?php if(empty($add_custom_agent)) { ?>
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-lg-8 col-md-8 col-8 align-self-center">
                            <?php if(!empty($show_agent_id)){ ?>
                                <div class="h5">Edit Agent</div>
                                <?php
                            }
                            else{ ?>
                                <div class="h5">Add Agent</div>
                                <?php
                            } ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-4">
                            <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('agent.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                        </div>
                    </div>
                </div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_agent_id)) { echo $show_agent_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" value="<?php if(!empty($agent_name)){echo $agent_name;} ?>"  onkeydown="Javascript:KeyboardControls(this,'text',25,1);">
                            <label>Agent Name (*)</label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'');">
                            <label>Contact Number (*)</label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="w-100" style="display:none;">
                                <select class="select2 select2-danger" name="country" id="country" onchange="Javascript:getCountries('agent',this.value,'','','');" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>India</option>
                                </select>
                            </div>
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="state" onchange="Javascript:getStates('agent',this.value,'','');">
                                <option value="">Select State</option>
                            </select>
                            <label>State (*)</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="district" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getDistricts('agent',this.value,'');">
                                <option value="">Select District</option>
                            </select>
                            <label>District (*)</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <select name = "city" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getCities('agent','',this.value);">
                                <option value = "">Select City</option>
                            </select>
                            <label>Select City (*)</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-12 pb-3 d-none" id="others_city_cover">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border">
                            <input type="text" id="others_city" name="others_city" class="form-control shadow-none" value="<?php if(!empty($others_city)){echo $others_city;} ?>" onkeydown="Javascript:KeyboardControls(this,'text',30,1);">
                            <label>Others city <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Text Only(Max Char: 30)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="commission" name="commission" class="form-control shadow-none" value="<?php if(!empty($commission)){echo $commission;} ?>" onfocus="Javascript:KeyboardControls(this,'number',3,'');" maxlength = "3">
                            <label>Commission % </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" class="form-control shadow-none" required  value="<?php if(!empty($opening_balance)){echo $opening_balance;} ?>" onfocus="Javascript:KeyboardControls(this,'number',6,1);" maxlength="6" <?php if(!empty($linked_agent)){ ?> readonly <?php } ?>>
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                    <select name="opening_balance_type" class="select2 select2-danger" style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');"  <?php if(!empty($linked_agent)){ ?> disabled <?php } ?>>
                                        <option value="">Select</option>
                                        <option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Credit"){ ?>selected<?php } ?>>Credit</option>
                                        <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Debit"){ ?>selected<?php } ?>>Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($linked_agent) && !empty($show_agent_id)){ ?>
                    <input type="hidden" name="opening_balance_type" value="<?php if(!empty($opening_balance_type)){ echo $opening_balance_type; } ?>">
                <?php 
               } ?>
                <div class="col-md-12 pt-3 text-center submit_button">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'agent_form', 'agent_changes.php', 'agent.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script type="text/javascript">
                getCountries('agent','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
            </script>
             <script type="text/javascript">                
				jQuery(document).ready(function(){
					jQuery('select').select2();
				});
            </script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                <?php if(isset($add_custom_agent) && $add_custom_agent == '1') { ?>
                    jQuery('#CustomAgentModal').on('shown.bs.modal', function () {
                        jQuery('form[name="agent_form"]').find('select').select2({
                            dropdownParent: jQuery('#CustomAgentModal')
                        });
                    });
                <?php } ?>
            </script>
        </form> <?php
        } 
    }

    if(isset($_POST['edit_id'])) {	
        $name = ""; $name_error = "";  $mobile_number = ""; $mobile_number_error = ""; 	$address = ""; $address_error = ""; $state = ""; $state_error = ""; $district = ""; $district_error = ""; $city = ""; $city_error = ""; $others_city = ""; $others_city_error = ""; $opening_balance = 0;$opening_balance_error = ""; $opening_balance_type = "";$opening_balance_type_error = ""; $commission = 0; $commission_error = "";
        $valid_agent = ""; $form_name = "agent_form";  $agent_error="";
        
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(isset($_POST['name'])) {	
            $name = $_POST['name'];
            $name = trim($name);
            if(!empty($name)) {
                $name_error = $valid->valid_name_text($name, 'Name', '1');
            }
            if(!empty($name) && strlen($name) > 25) {
                $name_error = "Only 25 characters allowed";
            }
            if(empty($name)){
                $name_error = "Enter the name";
            }
            // else {
            //     $name_error = $valid->valid_name($name,'name','1','25');
            // }
            if(!empty($name_error)) {
                $valid_agent = $valid->error_display($form_name, "name", $name_error, 'text');			
            }
        }
        if(isset($_POST['mobile_number'])) {	
            $mobile_number = $_POST['mobile_number'];
            $mobile_number = trim($mobile_number);
            $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile number", "1");
            if(!empty($mobile_number_error)) {
                if(!empty($valid_agent)) {
                    $valid_agent = $valid_agent." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
                else {
                    $valid_agent = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
            }
        }
        if(isset($_POST['address'])) {	
            $address = $_POST['address'];
            $address = trim($address);
            if(!empty($address)) {
                if(strlen($address) > 150) {
                    $address_error = "Only 150 characters allowed";
                }
                else {
                    $address_error = $valid->valid_address($address, "address", "0","150");   
                }
            }  
            if(!empty($address_error)) {
                if(!empty($valid_agent)) {
                    $valid_agent = $valid_agent." ".$valid->error_display($form_name, "address", $address_error, 'textarea');
                }
                else {
                    $valid_agent = $valid->error_display($form_name, "address", $address_error, 'textarea');
                }
            }
        }  
        if(isset($_POST['state'])) {
            $state = $_POST['state'];
            $state = trim($state);
            $state_error = $valid->common_validation($state,'State','select');
            if(!empty($state_error)) {
                if(!empty($valid_agent)) {
                    $valid_agent = $valid_agent." ".$valid->error_display($form_name, "state", $state_error, 'select');
                }
                else {
                    $valid_agent = $valid->error_display($form_name, "state", $state_error, 'select');
                }
            }
        }
        if(isset($_POST['district'])) {
            $district = $_POST['district'];
            $district = trim($district);
            $district_error = $valid->common_validation($district,'District','select');
            if(!empty($district_error)) {
                if(!empty($valid_agent)) {
                    $valid_agent = $valid_agent." ".$valid->error_display($form_name, "district", $district_error, 'select');
                }
                else {
                    $valid_agent = $valid->error_display($form_name, "district", $district_error, 'select');
                }
            }
        }
        if(isset($_POST['city'])) {
            $city = $_POST['city'];
            $city = trim($city);
            $city_error = $valid->common_validation($city,'City','select');
            if(!empty($city_error)) {
                if(!empty($valid_agent)) {
                    $valid_agent = $valid_agent." ".$valid->error_display($form_name, "city", $city_error, 'select');
                }
                else {
                    $valid_agent = $valid->error_display($form_name, "city", $city_error, 'select');
                }
            }
            else{
                if(isset($_POST['others_city'])) {
                    $others_city = $_POST['others_city'];
                    $others_city = trim($others_city);
                    if(!empty($city) && $city == "Others") {
                        if(!empty($others_city) && strlen($others_city) > 30) {
                            $others_city_error = "Only 30 characters allowed";
                        }
                        else {
                            $others_city_error = $valid->valid_text($others_city,'City','0','30');
                        }
                        if(!empty($others_city_error)) {
                            if(!empty($valid_agent)) {
                                $valid_agent = $valid_agent." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
                            }
                            else {
                                $valid_agent = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
                            }
                        }
                        else {
                            $city = $others_city;
                            $city = trim($city);
                        }
                    }
                }
            }
        }

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
            if(!empty($valid_agent)) {
                $valid_agent = $valid_agent." ".$valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
            else {
                $valid_agent = $valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
        }

        if(isset($_POST['commission'])){
			$commission = $_POST['commission'];
            $commission_error = $valid->common_validation($commission,'commission','text');
            if(!empty($commission_error)) {
                if(!empty($valid_agent)) {
                    $valid_agent = $valid_agent." ".$valid->error_display($form_name, "commission", $commission_error, 'text');
                }
                else {
                    $valid_agent = $valid->error_display($form_name, "commission", $commission_error, 'text');
                }
            }
			if(!empty($commission)) {
				$commission_error = $valid->valid_percentage($commission, "commission", "1");

                if($commission > 99) {
                    $commission_error = "Commission allowed lessthan 100%";
                }
                if(!empty($commission_error)) {
                    if(!empty($valid_agent)) {
                        $valid_agent = $valid_agent." ".$valid->error_display($form_name, "commission", $commission_error, 'text');
                    }
                    else {
                        $valid_agent = $valid->error_display($form_name, "commission", $commission_error, 'text');
                    }
                }
			} 
            
		}
   
        $result = "";
        if(empty($valid_agent)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
    
                $name_mobile_city = ""; $agent_details = ""; $lower_case_name=""; $product_name="";$unit_name = "";
                if(!empty($name)) {
                    $name = htmlentities($name, ENT_QUOTES);
                    $lower_case_name = strtolower($name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }
                if(!empty($name)) {
                    $name_mobile_city = $name;
                    $agent_details = $name;
                    $name = $obj->encode_decode('encrypt', $name);
                }
               
                if(!empty($pincode)) {
                    $pincode = $obj->encode_decode('encrypt', $pincode);
                } else {
                    $pincode = $GLOBALS['null_value'];
                }
                if(!empty($address)) {
                    if(!empty($agent_details)) {
                        $agent_details = $agent_details."<br>".str_replace("\r\n", "<br>", $address);
                    }
                    $address = $obj->encode_decode('encrypt', $address);
                }
                else {
                    $address = $GLOBALS['null_value'];
                }
                if(!empty($city)) {
                    if(!empty($agent_details)) {
                        $agent_details = $agent_details."<br>".$city;
                    }
                }
                if(!empty($district)) {
                    if(!empty($agent_details)) {
                        $agent_details = $agent_details."<br>".$district."(Dist.)";
                    }
                }
                if(!empty($state)) {
                    if(!empty($agent_details)) {
                        $agent_details = $agent_details."<br>".$state;
                    }
                    $state = $obj->encode_decode('encrypt', $state);
                }
                if(!empty($mobile_number)) {
                    $mobile_number = str_replace(" ", "", $mobile_number);

                    if(!empty($agent_details)) {
                        $agent_details = $agent_details."<br> Mobile : ".$mobile_number;
                    }
                    if(!empty($name_mobile_city)) {
                        $name_mobile_city = $name_mobile_city." (".$mobile_number.")";
                        if(!empty($city)) {
                            $name_mobile_city = $name_mobile_city." - ".$city;
                        }
                       
                    }
                   
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }else {
                    $mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($name_mobile_city)){
                    $name_mobile_city = $obj->encode_decode('encrypt', $name_mobile_city);
                }
                if(!empty($identification)) {
                    if(!empty($agent_details)) {
                        $agent_details = $agent_details."<br>".$identification;
                    }
                    $identification = $obj->encode_decode('encrypt', $identification);
                }
                else {
                    $identification = $GLOBALS['null_value'];
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
                if(!empty($agent_details)) {
                    $agent_details = $obj->encode_decode('encrypt', $agent_details);
                }
                $prev_agent_id = ""; $agent_error = "";	$prev_agent_name ="";
                if(!empty($mobile_number)) {
                    // $prev_agent_id = $obj->AgentMobileExists($mobile_number);
                    
                    $prev_agent_id = $obj->getTableColumnValue($GLOBALS['agent_table'], 'mobile_number', $mobile_number, 'agent_id');
                    if(!empty($prev_agent_id) && $prev_agent_id != $edit_id) {
                        $prev_agent_name = $obj->getTableColumnValue($GLOBALS['agent_table'],'agent_id',$prev_agent_id,'agent_name');
						$prev_agent_name = $obj->encode_decode("decrypt",$prev_agent_name);
                        $agent_error = "This mobile number is already exist in ".$prev_agent_name;
                        
                    }
                }
                if(!empty($commission)){
                    if(strpos($commission, "%") === false) {
                        $commission = $commission.'%';
                    }
                }
                
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);                
                $balance = 0;
                if(empty($edit_id)) {
                    if(empty($prev_agent_id)) {
                        $action = "";
                        if(!empty($name_mobile_city)) {
                            $action = "New agent Created. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'agent_id', 'agent_name', 'mobile_number', 'name_mobile_city', 'address', 'state', 'district', 'city', 'agent_details','lower_case_name', 'others_city','opening_balance','opening_balance_type', 'commission', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$name."'", "'".$mobile_number."'", "'".$name_mobile_city."'", "'".$address."'", "'".$state."'", "'".$district."'", "'".$city."'", "'".$agent_details."'","'".$lower_case_name."'", "'".$others_city."'", "'".$opening_balance."'","'".$opening_balance_type."'", "'".$commission."'","'0'");
                        $agent_insert_id = $obj->InsertSQL($GLOBALS['agent_table'], $columns, $values, 'agent_id', '', $action);
                        if(preg_match("/^\d+$/", $agent_insert_id)) {	
                            $balance = 1;
                            $agent_id = "";
                            $agent_id = $obj->getTableColumnValue($GLOBALS['agent_table'], 'id', $agent_insert_id, 'agent_id');			
                            $result = array('number' => '1', 'msg' => 'Agent Successfully Created','agent_id' => $agent_id);
                            				
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $agent_insert_id);
                        }
                    
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $agent_error);
                    }
                }
                else {
                    if(empty($prev_agent_id) || $prev_agent_id == $edit_id) {

                        $getUniqueID = ""; $agent_id =$edit_id;
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($name_mobile_city)) {
                                $action = "agent Updated. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','agent_name', 'mobile_number', 'name_mobile_city', 'address', 'state',  'district', 'city', 'agent_details','lower_case_name','others_city', 'opening_balance','opening_balance_type', 'commission');
                            $values = array("'".$creator_name."'", "'".$name."'", "'".$mobile_number."'", "'".$name_mobile_city."'", "'".$address."'", "'".$state."'", "'".$district."'", "'".$city."'", "'".$agent_details."'","'".$lower_case_name."'","'".$others_city."'", "'".$opening_balance."'","'".$opening_balance_type."'", "'".$commission."'");
                            $user_update_id = $obj->UpdateSQL($GLOBALS['agent_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $user_update_id)) {	
                                $balance = 1;
                                $agent_id = $edit_id;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $user_update_id);
                            }							
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $agent_error);
                    }
                }    
                if(!empty($balance) && $balance == 1) {
                    
                    $bill_id = $agent_id; 
                    $bill_date = date("Y-m-d");
                    $bill_number = $GLOBALS['null_value'];
                    $bill_type = "Agent Opening Balance";
                    $party_id = $GLOBALS['null_value'];
                    $party_name = $GLOBALS['null_value'];
                    $party_type = 'Agent';
                    $payment_mode_id = $GLOBALS['null_value'];
                    $payment_mode_name = $GLOBALS['null_value'];
                    $bank_id = $GLOBALS['null_value'];
                    $bank_name = $GLOBALS['null_value'];
                    $imploded_amount = $GLOBALS['null_value'];
                    $credit  = 0; $debit = 0; 

                    if($opening_balance_type =='Credit'){
                        $credit  = $opening_balance; 
                    }else if($opening_balance_type =='Debit'){
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
                    if(!empty($opening_balance) && !empty($opening_balance_type)){

                        $update_balance ="";
                        $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$name, $party_id,$party_name,$party_type,$payment_mode_id, $payment_mode_name, $bank_id, $bank_name, $credit,$debit,$opening_balance_type);
                    }else{
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
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_agent)) {
                $result = array('number' => '3', 'msg' => $valid_agent);
            }else if(!empty($whole_agent_error)) {
				$result = array('number' => '2', 'msg' => $whole_agent_error);
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

        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', 'DESC');

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
                    <tr>
                        <th>S.No</th>
                        <th>Agent Name</th>
                        <th>Mobile</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php
                    if(!empty($show_records_list)) { 
                        foreach($show_records_list as $key => $data) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                            <tr>
                                <td class="ribbon-header" style="cursor:default;">
                                    <?php echo $index; ?>
                                </td>
                                <td> <?php
                                    if(!empty($data['agent_name'])) {
                                        $data['agent_name'] = $obj->encode_decode('decrypt', $data['agent_name']);
                                        echo html_entity_decode($data['agent_name']);
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
                                    if(!empty($data['mobile_number'])) {
                                        $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                        echo $data['mobile_number'];
                                    } ?>
                                </td>
                                <td> <?php
                                    if(!empty($data['state'])) {
                                        $data['state'] = $obj->encode_decode('decrypt', $data['state']);
                                        echo $data['state'];
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
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1"> 
                                                    <?php 
                                                        if(empty($edit_access_error)) { ?> 
                                                            <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>');"> <i class="fa fa-pencil"></i> &ensp; Edit</a></li> <?php 
                                                        } 

                                                        if(empty($delete_access_error)) { 
                                                            $linked_count = 0;
                                                            $linked_count = $obj->GetAgentLinkedCount($data['agent_id']); 

                                                            if($linked_count > 0) { ?>
                                                                <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php
                                                            } 
                                                            else { ?>
                                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php
                                                            }
                                                        } 
                                                    ?>
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

    if(isset($_REQUEST['delete_agent_id'])) {
        $delete_agent_id = $_REQUEST['delete_agent_id'];
        $delete_agent_id = trim($delete_agent_id);
        $msg = "";$delete_id ="";
        if(!empty($delete_agent_id)) {
            $agent_unique_id = "";
            $agent_unique_id = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $delete_agent_id, 'id');
            if(preg_match("/^\d+$/", $agent_unique_id)) {
                $name_mobile_city = "";
                $name_mobile_city = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $delete_agent_id, 'name_mobile_city');
            
                $action = "";
                if(!empty($name_mobile_city)) {
                    $action = "agent Deleted. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                }
                $linked_count = 0;
                $linked_count = $obj->GetAgentLinkedCount($delete_agent_id); 
                if(empty($linked_count)) {
                    $delete_id = $obj->DeletePayment($delete_agent_id);	
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['agent_table'], $agent_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This agent is associated with other screens";
                }
            }
            else {
                $msg = "Invalid agent";
            }
        }
        else {
            $msg = "Empty agent";
        }
        echo $msg;
        exit;	
    }
?>