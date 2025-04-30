<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['supplier_module'];
        }
    }

	if(isset($_REQUEST['show_supplier_id'])) {
        $show_supplier_id = $_REQUEST['show_supplier_id'];
        $show_supplier_id = trim($show_supplier_id);
        
        $country = "India";$state = "";$district = "";$city = "";$supplier_name = "";$mobile_number = "";$address = "";$email = "";$pincode = "";$product_id="";$product_name="";$pincode = ""; $state = "Tamil Nadu";$identification = "";


        if(!empty($show_supplier_id)){
            $supplier_list = array();
            $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'],'supplier_id',$show_supplier_id,'');
            if(!empty($supplier_list)) {
                foreach($supplier_list as $data){ 
                    if(!empty($data['supplier_name']) && $data['supplier_name'] != $GLOBALS['null_value']){
                        $supplier_name = $obj->encode_decode("decrypt",$data['supplier_name']);
                        $supplier_name = html_entity_decode($supplier_name);
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
                    if(!empty($data['supplier_details']) && $data['supplier_details'] != $GLOBALS['null_value']) {
                        $supplier_details = $obj->encode_decode('decrypt', $data['supplier_details']);
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
                }
            }
        }

        ?>
		<script type="text/javascript" src="include/js/creation_modules.js"></script>


        <form class="poppins pd-20 redirection_form" name="supplier_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_supplier_id)){ ?>
                            <div class="h5">Edit Supplier</div>
                            <?php
                        } else { ?>
                            <div class="h5">Add Supplier</div>
                            <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('supplier.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_supplier_id)) { echo $show_supplier_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="supplier_name" name="supplier_name" class="form-control shadow-none" value="<?php if(!empty($supplier_name)){echo $supplier_name;} ?>"  onkeydown="Javascript:KeyboardControls(this,'text',25,1);"  required>
                            <label>Supplier Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" required value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'');">
                            <label>Mobile Number<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');" > <?php if(!empty($address)){echo $address;} ?></textarea>
                            <label>Address</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-12 pb-3">
                    <div class="form-group pb-3">
                        <div class="form-label-group in-border mb-0">
                            <div class="w-100" style="display:none;">
                                <select class="select2 select2-danger" name="country" id="country" onchange="Javascript:getCountries('supplier',this.value,'','','');" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>India</option>
                                </select>
                            </div>
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger"  style="width: 100%;" name="state" onchange="Javascript:getStates('supplier',this.value,'','');">
                                <option value="">Select State</option>
                            </select>
                            <label>State <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>

                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="district" class="select2 select2-danger" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getDistricts('supplier',this.value,'');">
                                <option value="">Select District</option>
                            </select>
                            <label>District <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <select name="city" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getCities('supplier','',this.value);">
                                <option value = "">Select City</option>
                            </select>
                            <label>City <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-12 pb-3 d-none" id="others_city_cover">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border">
                            <input type="text" id="others_city" name="others_city" class="form-control shadow-none" value="<?php if(!empty($others_city)){echo $others_city;} ?>"onkeydown="Javascript:KeyboardControls(this,'text',30,1);">
                            <label>Others city <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Text Only(Max Char: 30)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="gst_number" name="gst_number" class="form-control shadow-none" value="<?php if(!empty($gst_number)){echo $gst_number;} ?>">
                            <label>GST Number</label>
                        </div>
                        <div class="new_smallfnt">Format : 22AAAAA0000A1Z5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" class="form-control shadow-none" required  value="<?php if(!empty($opening_balance)){echo $opening_balance;} ?>" onfocus="Javascript:KeyboardControls(this,'number',6,1);" maxlength="6">
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                    <select name="opening_balance_type" class="select2 select2-danger" style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');">
                                        <option value="">Select</option>
                                        <option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Credit"){ ?>selected<?php } ?>>Credit</option>
                                        <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Debit"){ ?>selected<?php } ?>>Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center submit_button">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'supplier_form', 'supplier_changes.php', 'supplier.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script type="text/javascript">
                getCountries('supplier','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
            </script>
             <script type="text/javascript">                
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
        $supplier_name = ""; $supplier_name_error = "";  $mobile_number = ""; $mobile_number_error = ""; 	$address = ""; $address_error = ""; $state = ""; $state_error = ""; $district = ""; $district_error = ""; $city = ""; $city_error = ""; $others_city = ""; $others_city_error = ""; $gst_number = ""; $gst_number_error = ""; $opening_balance = 0; $opening_balance_error = ""; $opening_balance_type = ""; $opening_balance_type_error = ""; 
        $valid_supplier = ""; $form_name = "supplier_form"; $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $supplier_name = $_POST['supplier_name'];
        $supplier_name = trim($supplier_name);
        if(!empty($supplier_name)) {
            $supplier_name_error = $valid->valid_name_text($supplier_name, 'Supplier Name', '1');
        }
        if(!empty($supplier_name) && strlen($supplier_name) > 25) {
            $supplier_name_error = "Only 25 characters allowed";
        }
        if(empty($supplier_name)){
            $supplier_name_error = "Enter the Supplier name";
        }
        if(!empty($supplier_name_error)) {
            $valid_supplier = $valid->error_display($form_name, "supplier_name", $supplier_name_error, 'text');		
            if(!empty($address_error)) {
                if(!empty($valid_supplier)) {
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "supplier_name", $supplier_name_error, 'text');
                }
                else {
                    $valid_supplier = $valid->error_display($form_name, "supplier_name", $supplier_name_error, 'text');
                }
            }  	
        }
    
        $mobile_number = $_POST['mobile_number'];
        $mobile_number = trim($mobile_number);
        $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile number", "1");
        if(!empty($mobile_number_error)) {
            if(!empty($valid_supplier)) {
                $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
            }
            else {
                $valid_supplier = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
            }
        }
    
        $address = $_POST['address'];
        $address = trim($address);
        if(!empty($address)) {
            if(strlen($address) > 150) {
                $address_error = "Only 150 characters allowed";
            }
            $address_error = $valid->valid_address($address, "address", "0","150");   
        }  
        if(!empty($address_error)) {
            if(!empty($valid_supplier)) {
                $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "address", $address_error, 'textarea');
            }
            else {
                $valid_supplier = $valid->error_display($form_name, "address", $address_error, 'textarea');
            }
        }  

        if(isset($_POST['state'])) {
            $state = $_POST['state'];
            $state = trim($state);
            $state_error = $valid->common_validation($state,'State','select');
            if(!empty($state_error)) {
                if(!empty($valid_supplier)) {
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "state", $state_error, 'select');
                }
                else {
                    $valid_supplier = $valid->error_display($form_name, "state", $state_error, 'select');
                }
            }
        }

        if(isset($_POST['district'])) {
            $district = $_POST['district'];
            $district = trim($district);
            $district_error = $valid->common_validation($district,'District','select');
            if(!empty($district_error)) {
                if(!empty($valid_supplier)) {
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "district", $district_error, 'select');
                }
                else {
                    $valid_supplier = $valid->error_display($form_name, "district", $district_error, 'select');
                }
            }
        }

        if(isset($_POST['city'])) {
            $city = $_POST['city'];
            $city = trim($city);
            $city_error = $valid->common_validation($city,'City','select');
            
            if(!empty($city_error)) {
                if(!empty($valid_supplier)) {
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "city", $city_error, 'select');
                }
                else {
                    $valid_supplier = $valid->error_display($form_name, "city", $city_error, 'select');
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
                            if(!empty($valid_supplier)) {
                                $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
                            }
                            else {
                                $valid_supplier = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
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
        
        if(isset($_POST['gst_number'])) {
            $gst_number = $_POST['gst_number'];
            $gst_number = trim($gst_number);
            $gst_number_error = $valid->valid_gst_number($gst_number,'gst number','text');
            if(!empty($gst_number_error)) {
                if(!empty($valid_supplier)) {
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
                }
                else {
                    $valid_supplier = $valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
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
            if(!empty($valid_supplier)) {
                $valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
            else {
                $valid_supplier = $valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
        }
      
        $result = "";
        if(empty($valid_supplier)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
    
                $name_mobile_city = ""; $supplier_details = ""; $lower_case_name="";
                if(!empty($supplier_name)) {
                    $supplier_name = htmlentities($supplier_name, ENT_QUOTES);
                    $lower_case_name = strtolower($supplier_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($supplier_name)) {
                    $name_mobile_city = $supplier_name;
                    $supplier_details = $supplier_name;
                    $supplier_name = $obj->encode_decode('encrypt', $supplier_name);
                }
               
                if(!empty($address)) {
                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$".str_replace("\r\n", "$$$", $address);
                    }
                    $address = $obj->encode_decode('encrypt', $address);
                }
                else {
                    $address = $GLOBALS['null_value'];
                }

                if(!empty($city)) {
                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$".$city;
                    }
                }

                if(!empty($district)) {
                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$".$district."(Dist.)";
                    }
                }

                if(!empty($state)) {
                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$".$state;
                    }
                    $state = $obj->encode_decode('encrypt', $state);
                }

                if(!empty($mobile_number)) {
                    $mobile_number = str_replace(" ", "", $mobile_number);

                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$ Mobile : ".$mobile_number;
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
                if(!empty($supplier_details)) {
                    $supplier_details = $obj->encode_decode('encrypt', $supplier_details);
                }
                
                $balance = 0;

                $prev_supplier_id = ""; $supplier_error = "";	$prev_supplier_name ="";
                if(!empty($mobile_number)) {
                    // $obj->SupplierMobileExists($mobile_number);
                    $prev_supplier_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'mobile_number', $mobile_number, 'supplier_id');

                    if(!empty($prev_supplier_id) && $prev_supplier_id != $edit_id) {
                        $prev_supplier_name = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$prev_supplier_id,'supplier_name');
						$prev_supplier_name = $obj->encode_decode("decrypt",$prev_supplier_name);
                        $supplier_error = "This mobile number is already exist in ".$prev_supplier_name;
                    }
                }

                $prev_gst_supplier_id = ""; $gst_supplier_error = "";	$prev_gst_supplier_name ="";
                if(!empty($gst_number)) {
                    // $obj->SuppliergstnumberExists($gst_number);
                    $prev_gst_supplier_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'gst_number', $gst_number, 'supplier_id');
                    if(!empty($prev_gst_supplier_id) && $prev_gst_supplier_id != $edit_id) {
                        $prev_gst_supplier_name = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$prev_gst_supplier_id,'supplier_name');
						$prev_gst_supplier_name = $obj->encode_decode("decrypt",$prev_gst_supplier_name);
                        $gst_supplier_error = "This GST number is already exist in ".$prev_gst_supplier_name;
                    }
                }
        
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);                
                
                if(empty($edit_id)) {
                    if(empty($prev_supplier_id) && empty($prev_gst_supplier_id)) {
                        $action = "";
                        if(!empty($name_mobile_city)) {
                            $action = "New supplier Created. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'supplier_id', 'supplier_name', 'lower_case_name', 'address', 'city', 'district', 'state', 'mobile_number', 'others_city', 'opening_balance', 'opening_balance_type', 'supplier_details',  'gst_number', 'name_mobile_city', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$supplier_name."'", "'".$lower_case_name."'", "'".$address."'", "'".$city."'", "'".$district."'", "'".$state."'", "'".$mobile_number."'", "'".$others_city."'","'".$opening_balance."'","'".$opening_balance_type."'", "'".$supplier_details."'", "'".$gst_number."'", "'".$name_mobile_city."'", "'0'");
                        $supplier_insert_id = $obj->InsertSQL($GLOBALS['supplier_table'], $columns, $values, 'supplier_id', '', $action);
                        if(preg_match("/^\d+$/", $supplier_insert_id)) {	
                            $supplier_id = "";
                            $supplier_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'id', $supplier_insert_id, 'supplier_id');
                           	
                            $balance = 1;
                            $result = array('number' => '1', 'msg' => 'Supplier Successfully Created','supplier_id' => $supplier_id);
                            				
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $supplier_insert_id);
                        }
                    
                    }
                    else {
                        
                        if(!empty($supplier_error)) {
                            $result = array('number' => '2', 'msg' => $supplier_error);
                        }
                        if(!empty($gst_supplier_error)) {
                            $result = array('number' => '2', 'msg' => $gst_supplier_error);
                        }
                    }
                }
                else {
                    if(empty($prev_supplier_id) || $prev_supplier_id == $edit_id && empty($prev_gst_supplier_id) || $prev_gst_supplier_id == $edit_id) {

                        $getUniqueID = ""; $supplier_id =$edit_id;
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($name_mobile_city)) {
                                $action = "supplier Updated. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','supplier_name', 'lower_case_name', 'address', 'city', 'district', 'state', 'mobile_number', 'others_city', 'opening_balance', 'opening_balance_type', 'supplier_details',  'gst_number', 'name_mobile_city');
                            $values = array("'".$creator_name."'", "'".$supplier_name."'", "'".$lower_case_name."'", "'".$address."'", "'".$city."'", "'".$district."'", "'".$state."'", "'".$mobile_number."'", "'".$others_city."'","'".$opening_balance."'","'".$opening_balance_type."'", "'".$supplier_details."'", "'".$gst_number."'", "'".$name_mobile_city."'");
                            $user_update_id = $obj->UpdateSQL($GLOBALS['supplier_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $user_update_id)) {
                                
                                $balance = 1;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $user_update_id);
                            }							
                        }
                    }
                    else {
                        if(!empty($supplier_error)) {
                            $result = array('number' => '2', 'msg' => $supplier_error);
                        }
                        if(!empty($gst_supplier_error)) {
                            $result = array('number' => '2', 'msg' => $gst_supplier_error);
                        }
                    }
                }  
                if(!empty($balance) && $balance == 1) {
                    
                        $bill_id = $supplier_id; 
                        $bill_date = date("Y-m-d");
                        $bill_number = $GLOBALS['null_value'];
                        $bill_type = "Supplier Opening Balance";
                        $agent_id = $GLOBALS['null_value'];
                        $agent_name = $GLOBALS['null_value'];
                        $party_id = $supplier_id;
                        $party_name = $supplier_name;
                        $party_type = 'Supplier';
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
                            $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name, $party_id,$party_name,$party_type,$payment_mode_id, $payment_mode_name, $bank_id, $bank_name, $credit,$debit,$opening_balance_type);
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
            if(!empty($valid_supplier)) {
                $result = array('number' => '3', 'msg' => $valid_supplier);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '', 'DESC');

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
                        <th>Supplier Name</th>
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
                                <td class="ribbon-header" style="cursor:default;"> <?php
                                    echo $index; ?>
                                </td>
                                <td> <?php
                                    if(!empty($data['name_mobile_city'])) {
                                        $data['name_mobile_city'] = $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                        echo $data['name_mobile_city'];
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
                                    if(!empty($data['state'])) {
                                        $data['state'] = $obj->encode_decode('decrypt', $data['state']);
                                        echo $data['state'];
                                    } ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1"> <?php 
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $edit_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($access_error)) { ?> 
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li> <?php 
                                            }
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $delete_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($access_error)) { 
                                                $linked_count = 0;
                                                // $linked_count = $obj->GetsupplierLinkedCount($data['supplier_id']); 
                                                if($linked_count > 0) { ?>
                                                    <li><a class="dropdown-item bg-secondary" ><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php 
                                                }
                                                else { ?> 
                                                    <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php 
                                                }
                                            } ?>  
                                        </ul>
                                    </div> 
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

    if(isset($_REQUEST['delete_supplier_id'])) {
        $delete_supplier_id = $_REQUEST['delete_supplier_id'];
        $delete_supplier_id = trim($delete_supplier_id);
        $msg = "";
        if(!empty($delete_supplier_id)) {	
            $supplier_unique_id = "";
            $supplier_unique_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $delete_supplier_id, 'id');
            if(preg_match("/^\d+$/", $supplier_unique_id)) {
                $name_mobile_city = "";
                $name_mobile_city = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $delete_supplier_id, 'name_mobile_city');
            
                $action = "";
                if(!empty($name_mobile_city)) {
                    $action = "supplier Deleted. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                }
                $linked_count = 0;
                // $linked_count = $obj->GetsupplierLinkedCount($delete_supplier_id); 
                if(empty($linked_count)) {
                    $delete_id = $obj->DeletePayment($delete_supplier_id);	
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['supplier_table'], $supplier_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This supplier is associated with other screens";
                }
            }
            else {
                $msg = "Invalid supplier";
            }
        }
        else {
            $msg = "Empty supplier";
        }
        echo $msg;
        exit;	
    }


?>