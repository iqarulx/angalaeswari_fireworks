<?php
	include("include.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['magazine_module'];
        }
    }

	if(isset($_REQUEST['show_magazine_id'])) { 
        $show_magazine_id = $_REQUEST['show_magazine_id'];
        $show_magazine_id = trim($show_magazine_id);
        
        $magazine_name = ""; $incharge_name = ""; $user_id = ""; $password = "";  $mobile_number = "";
       $district = ""; $location = "";

        if(!empty($show_magazine_id)) {
            $magazine_list = array();
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $show_magazine_id,'');
            
			if(!empty($magazine_list)) {
				foreach($magazine_list as $data) {
					if(!empty($data['magazine_name'])) {
						$magazine_name = $obj->encode_decode('decrypt', $data['magazine_name']);
					}
                    if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']) {
						$location = $obj->encode_decode('decrypt', $data['location']);
					}
                    if(!empty($data['incharge_name']) && $data['incharge_name'] != $GLOBALS['null_value']) {
						$incharge_name = $obj->encode_decode('decrypt', $data['incharge_name']);
					}
					if(!empty($data['user_id'])) {
						$user_id = $obj->encode_decode('decrypt', $data['user_id']);
					}
                    if(!empty($data['password']) && $data['password'] != $GLOBALS['null_value']) {
						$password = $obj->encode_decode('decrypt', $data['password']);
					} 
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					} 
				}
            }
        } 
       
  
        ?>
        <form class="poppins pd-20 redirection_form" name="magazine_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(empty($show_magazine_id)) { ?>
                            <div class="h5">Add Magazine</div>
                        <?php } else { ?>
                            <div class="h5">Edit Magazine</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('magazine.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_magazine_id)) { echo $show_magazine_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="magazine_name" name="magazine_name" onkeydown="Javascript:KeyboardControls(this,'text',50,1);" class="form-control shadow-none"  value="<?php if(!empty($magazine_name)) { echo $magazine_name; } ?>">
                            <label>Magazine Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" id="location" name="location" onkeydown="Javascript:KeyboardControls(this,'text',50,1);"  value="<?php if(!empty($location)) { echo $location; } ?>">
                            <label>Location <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="incharge_name" name="incharge_name"  value="<?php if(!empty($incharge_name)) { echo $incharge_name; } ?>" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" class="form-control shadow-none">
                            <label>Incharger Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" value="<?php if(!empty($mobile_number)) { echo $mobile_number; } ?>" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'');" onkeyup="Javascript:InputBoxColor(this,'text');">
                            <label>Phone Number <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-12 py-2">
                     <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="user_id" name="user_id" class="form-control shadow-none"  value="<?php if(!empty($user_id)) { echo $user_id; } ?>">
                            <label>User ID <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div id="password_cover" class="form-group">
                        <div class="form-group">
                            <div class="form-label-group in-border">
                                <div class="input-group">
                                    <input type="password" class="form-control shadow-none" id="password" name="password" value="<?php if(!empty($password)) { echo $password; } ?>" onkeyup="Javascript:CheckPassword('password');" onfocus="Javascript:KeyboardControls(this,'password',20,'');" onkeydown="Javascript:InputBoxColor(this,'text');">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <div style="position: inherit; top: 0px;" class="input-group-append" data-toggle="tooltip" data-placement="right" title="Show Password">
                                        <button class="btn btn-dark" type="button" id="passwordBtn" data-toggle="button" aria-pressed="false"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="smallfnt p-gray">Password must include:</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="length_check" value="" id="defaultCheck1" disabled>
                                <label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
                                    8 - 20 characters
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="letter_check" value="" id="defaultCheck1" disabled>
                                <label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
                                    Atleast one upper case and lower case letter
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="number_symbol_check" value="" id="defaultCheck1" disabled>
                                <label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
                                    Atleast one number and one symbol
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="space_check" value="" id="defaultCheck1" disabled>
                                <label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
                                    No space
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center" >
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'magazine_form', 'magazine_changes.php', 'magazine.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                jQuery(document).ready(function() {
                    const passBtn = $("#passwordBtn");
                    passBtn.click(togglePassword);

                    function togglePassword() {
                        const passInput = $("#password");
                        if (passInput.attr("type") === "password") {
                            passInput.attr("type", "text");
                        } 
                        else {
                            passInput.attr("type", "password");
                        }
                    }

                    <?php
                        if(!empty($show_magazine_id)){ ?>CheckPassword('password');<?php }
                    ?>
                });
            </script>
        
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    if(isset($_POST['magazine_name'])) {	
        $magazine_name = ""; $magazine_name_error = ""; $incharge_name = ""; $incharge_name_error = ""; $user_id = "";$user_id_error = ""; $password = "";  $mobile_number = "";$mobile_number_error = ""; $state = ""; $state_error = ""; $district = ""; $district_error = ""; 
        $city = ""; $city_error = ""; $others_city = ""; $others_city_error = "";
        $valid_magazine = ""; $form_name = "magazine_form"; $edit_id = "";


        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        
        $magazine_name = $_POST['magazine_name'];
        $magazine_name = trim($magazine_name);
       
        if(!empty($magazine_name) && strlen($magazine_name) > 50) {
            $magazine_name_error = "Only 50 characters allowed";
        }
        else {
            $magazine_name_error = $valid->valid_company_name($magazine_name,'magazine Name','1');
        }
        if(empty($magazine_name_error) && empty($edit_id)) {
            $magazine_list = array(); $magazine_count = 0;
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '','');
            if(!empty($magazine_list)) {
                $magazine_count = count($magazine_list);
            }
            if($magazine_count == $GLOBALS['max_magazine_count']) {
                $magazine_name_error = "Max. ".$GLOBALS['max_magazine_count']." magazines are allowed";
            }
        }
        if(!empty($magazine_name_error)) {
            if(!empty($valid_magazine)) {
                $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "magazine_name", $magazine_name_error, 'text');
            }
            else {
                $valid_magazine = $valid->error_display($form_name, "magazine_name", $magazine_name_error, 'text');
            }
        }

        if(isset($_POST['state'])) {
            $state = $_POST['state'];
            $state = trim($state);
            $state_error = $valid->common_validation($state,'State','select');
            if(!empty($state_error)) {
                if(!empty($valid_magazine)) {
                    $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "state", $state_error, 'select');
                }
                else {
                    $valid_magazine = $valid->error_display($form_name, "state", $state_error, 'select');
                }
            }
        }

        if(isset($_POST['district'])) {
            $district = $_POST['district'];
            $district = trim($district);
            if(!empty($district)) {
                $district_error = $valid->common_validation($district,'District','select');
            }
            if(!empty($district_error)) {
                if(!empty($valid_factory)) {
                    $valid_factory = $valid_factory." ".$valid->error_display($form_name, "district", $district_error, 'select');
                }
                else {
                    $valid_factory = $valid->error_display($form_name, "district", $district_error, 'select');
                }
            }
        }

        if(isset($_POST['city'])) {
            $city = $_POST['city'];
            $city = trim($city);
            if(!empty($city)) {
                $city_error = $valid->common_validation($city,'City','select');
            }
            if(!empty($city_error)) {
                if(!empty($valid_factory)) {
                    $valid_factory = $valid_factory." ".$valid->error_display($form_name, "city", $city_error, 'select');
                }
                else {
                    $valid_factory = $valid->error_display($form_name, "city", $city_error, 'select');
                }
            }
            else{
                if(isset($_POST['others_city']))
                {
                    $others_city = $_POST['others_city'];
                    $others_city = trim($others_city);
                    if(!empty($city) && $city == "Others") {
                        if(!empty($others_city) && strlen($others_city) > 30) {
                            $others_city_error = "Only 30 characters allowed";
                        }
                        else {
                            $others_city_error = $valid->valid_text($others_city,'City','1');
                        }
                        if(!empty($others_city_error)) {
                            if(!empty($valid_factory)) {
                                $valid_factory = $valid_factory." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
                            }
                            else {
                                $valid_factory = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
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

        $incharge_name = $_POST['incharge_name'];
        $incharge_name = trim($incharge_name);
        if(!empty($incharge_name) && strlen($incharge_name) > 25) {
            $incharge_name_error = "Only 25 characters allowed";
        }
        else {
            $incharge_name_error = $valid->valid_company_name($incharge_name,'Incharge name','1');
        }
        if(!empty($incharge_name_error)) {
            if(!empty($valid_magazine)) {
                $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "incharge_name", $incharge_name_error, 'text');
            }
            else {
                $valid_magazine = $valid->error_display($form_name, "incharge_name", $incharge_name_error, 'text');
            }
        }

        if(isset($_POST['mobile_number'])) {
            $mobile_number = $_POST['mobile_number'];
            $mobile_number = trim($mobile_number);
            $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile Number", "1");
            if(!empty($mobile_number_error)) {
                if(!empty($valid_magazine)) {
                    $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
                else {
                    $valid_magazine = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
            }
        }
        if(isset($_POST['location'])) {
            $location = $_POST['location'];
            $location = trim($location);
            if(!empty($location) && strlen($location) > 50) {
                $location_error = "Only 50 characters allowed";
            }
            else 
            {
                $location_error = $valid->valid_address($location,'location','1');
            }
            if(!empty($location_error)) {
                if(!empty($valid_magazine)) {
                    $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "location", $location_error, 'text');
                }
                else {
                    $valid_magazine = $valid->error_display($form_name, "location", $location_error, 'text');
                }
            }
          
        }
        if(isset($_POST['user_id'])) {

            $user_id = $_POST['user_id'];
            $user_id = trim($user_id);
            if(!empty($user_id) && strlen($user_id) > 25) {
                $user_id_error = "Only 25 digits allowed";
            }
            else {
                $user_id_error = $valid->valid_company_name($user_id, 'User ID', '1');
            }        
            if(!empty($user_id_error)) {
                if(!empty($valid_magazine)) {
                    $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "user_id", $user_id_error, 'text');
                }
                else {
                    $valid_magazine = $valid->error_display($form_name, "user_id", $user_id_error, 'text');
                }
            }
        }
        if(isset($_POST['password'])) {
            $password = $_POST['password'];
            $password = trim($password);
            if(strpos($password," ") == true) {
                $password_error = "Password should not contain spaces";
            }
            else if(strlen($password) > 20) {
                $password_error = "Only 20 digits allowed(recommended)";
            }
            else {
                $password_error = $valid->valid_password($password, "Password", "1");
            }        
            if(!empty($password_error)) {
                if(!empty($valid_magazine)) {
                    $valid_magazine = $valid_magazine." ".$valid->error_display($form_name, "password", $password_error, 'input_group');
                }
                else {
                    $valid_magazine = $valid->error_display($form_name, "password", $password_error, 'input_group');
                }
            }   
        }
        $user_count = 0; $count_error = "";
        $user_list = array();
        $user_list = $obj->getTableRecords($GLOBALS['user_table'], '', '', '');
        $user_count = count($user_list);
        if(empty($edit_id)) {
            if($user_count >= $GLOBALS['max_user_count']) {
                $count_error = "Max User Count Reached.";
            }
        }
        
        $result = ""; $lower_case_name = "";
        
        if(empty($valid_magazine) && empty($count_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
               
                $magazine_details = ""; $lower_case_name = ""; $lower_case_user_id = ""; $name_city = "";
                $incharge_name_mobile = ""; $admin = 0; $type = $GLOBALS['magazine_user_type'];
                $lower_case_name = ""; $lower_case_user_id = ""; $name_location = ""; $lowercase_incharge_name = "";$lowercase_name_location = "";
                if(!empty($magazine_name)) { 
                    $magazine_details = $magazine_name;
                    $name_city = $magazine_name;
                    $name_location = $magazine_name;
                    $magazine_name = htmlentities($magazine_name,ENT_QUOTES);
                    $lower_case_name = strtolower($magazine_name);   
                    $magazine_name = $obj->encode_decode('encrypt', $magazine_name);
                    $lower_case_name = htmlentities($lower_case_name,ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }
                if(!empty($location)) {
                    if(!empty($magazine_details)) {
                        $magazine_details = $magazine_details."$$$".$location;
                    }
                    if(!empty($name_location)) {
                        $name_location = $name_location." - ".$location;
                        $lowercase_name_location = strtolower($name_location); 
                    }
                    $location = $obj->encode_decode('encrypt', $location);
                }
                else {
                    $location = $GLOBALS['null_value'];
                }

                if(!empty($incharge_name)) { 
                    if(!empty($magazine_details)) {
                        $magazine_details = $magazine_details."$$$"."Incharge - ".$incharge_name;
                    }
                    $incharge_name_mobile = $incharge_name;
                    $lowercase_incharge_name =  strtolower($incharge_name); 
                    $incharge_name = $obj->encode_decode('encrypt', $incharge_name);
                }
                else {
                    $incharge_name = $GLOBALS['null_value'];
                }

                if(!empty($user_id)) {
                    $lower_case_user_id = strtolower($user_id);                   
                    $user_id = $obj->encode_decode('encrypt', $user_id);
                    $lower_case_user_id = $obj->encode_decode('encrypt', $lower_case_user_id);
                }
                else {
                    $user_id = $GLOBALS['null_value'];
                }
                
                if(!empty($password)) {                   
                    $password = $obj->encode_decode('encrypt', $password);
                }
                else {
                    $password = $GLOBALS['null_value'];
                }   
               
                if(!empty($mobile_number)) {    
                    if(!empty($magazine_details)) {
                        $magazine_details = $magazine_details." (".$mobile_number.")";
                    }    
                    if(!empty($incharge_name_mobile)) {
                        $incharge_name_mobile = $incharge_name_mobile." (".$mobile_number.")";
                    }            
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }
                else {
                    $mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($name_city)) {
                    $name_city = $obj->encode_decode('encrypt', $name_city);
                }
                if(!empty($magazine_details)) {
                    $magazine_details = $obj->encode_decode('encrypt', $magazine_details);
                }
                if(!empty($incharge_name_mobile)) {
                    $incharge_name_mobile = $obj->encode_decode('encrypt', $incharge_name_mobile);
                }
                if(!empty($name_location)) {
                    $name_location = $obj->encode_decode('encrypt', $name_location);
                }
                if(!empty($lowercase_name_location)) {
                    $lowercase_name_location = $obj->encode_decode('encrypt', $lowercase_name_location);
                }
                if(!empty($lowercase_incharge_name)) {
                    $lowercase_incharge_name = $obj->encode_decode('encrypt', $lowercase_incharge_name);
                }
                $prev_magazine_id = "";$magazine_error = ""; $prev_user_id = ""; $user_error = ""; $str_user_id = ""; $prev_user_magazine_id =""; $prev_user_mbl_magazine_id = "";
                // if(!empty($lower_case_name)) {
                //     $prev_magazine_id = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'lowercase_name_location', $lower_case_name, 'magazine_id');
                //     if(!empty($prev_magazine_id)) {
                //         $magazine_error = "This Magazine name already exists";
                //     }
                // }  
                // if(!empty($lower_case_user_id)) {
                //     $prev_user_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'lower_case_login_id', $lower_case_user_id, 'user_id');
                //     if(!empty($prev_user_id)) {
                //         $user_error = "This User ID already exists";
                //     }
                // }   
                // if(!empty($mobile_number) && empty($user_error)) {
                //     $prev_user_id = "";
                //     $prev_user_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'mobile_number', $mobile_number, 'user_id');
                //     if(!empty($prev_user_id)) {
                //         $prev_user_name = "";
                //         $prev_user_name = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $prev_user_id, 'name');
				// 		$prev_user_name = $obj->encode_decode("decrypt", $prev_user_name);
                //         $user_error = "This User Mobile No. already exists in ".$prev_user_name;
                //     }
                // }

                if(!empty($lowercase_name_location)) {
                    $prev_magazine_id = $obj ->CheckMagazineAlreadyExist($lowercase_name_location);
                    if(!empty($prev_magazine_id)) {
                        $magazine_error = "This Magazine name already exists";
                    }
                }

                if(!empty($lower_case_user_id)) {
                    $prev_user_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'lower_case_login_id', $lower_case_user_id, 'user_id');
                    $prev_user_magazine_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'lower_case_login_id', $lower_case_user_id, 'magazine_id');

                    if(!empty($prev_user_id)) {
                        if(!empty($edit_id)){
                            if(!empty($prev_user_magazine_id) && $prev_user_magazine_id != $edit_id){
                                $user_error = "This User ID already exists";
                            }
                        }else{
                            $user_error = "This User ID already exists";
                        }
                    }
                }        

                $mobile_no_error = "";
                if(!empty($mobile_number) && empty($user_error)) {
                    $prev_user_mbl_id = "";
                    $prev_user_mbl_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'mobile_number', $mobile_number, 'user_id');
                    $prev_user_mbl_magazine_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'mobile_number', $mobile_number, 'magazine_id');

                    if(!empty($prev_user_mbl_id)) {
                        $prev_user_name = "";
                        $prev_user_name = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $prev_user_mbl_id, 'name');
						$prev_user_name = $obj->encode_decode("decrypt", $prev_user_name);

                        if(!empty($edit_id)){
                            if(!empty($prev_user_mbl_magazine_id) && $prev_user_mbl_magazine_id != $edit_id){
                                $mobile_no_error = "This User Mobile No. already exists in ".$prev_user_name;
                            }
                        }else{
                            $mobile_no_error = "This User Mobile No. already exists in ".$prev_user_name;
                        }
                      
                    }
                }


                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if(empty($edit_id)) {
                    if(empty($prev_magazine_id)) {
                        if(empty($prev_user_id)) {
                            if(empty($prev_user_mbl_magazine_id)) {
                                $action = "";
                                if(!empty($magazine_name)) {
                                    $action = "New Magazine Created. Name - ".($obj->encode_decode('decrypt', $magazine_name));
                                }

                                $null_value = $GLOBALS['null_value'];

                                $columns = array(); $values = array();
                                $columns = array('created_date_time', 'creator', 'creator_name', 'magazine_id', 'magazine_name', 'lower_case_name', 'location', 'name_location', 'lowercase_name_location', 'incharge_name', 'mobile_number', 'user_id', 'password', 'lowercase_incharge_name', 'magazine_details','factory_id', 'godown_id', 'deleted');

                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$magazine_name."'", "'".$lower_case_name."'", "'".$location."'", "'".$name_location."'", "'".$lowercase_name_location."'", "'".$incharge_name."'", "'".$mobile_number."'", "'".$user_id."'", "'".$password."'", "'".$lowercase_incharge_name."'", "'".$magazine_details."'","'".$null_value."'", "'".$null_value."'","'0'");

                                $magazine_insert_id = $obj->InsertSQL($GLOBALS['magazine_table'], $columns, $values,'magazine_id', '', $action);

                                if(preg_match("/^\d+$/", $magazine_insert_id)) {
                                    $magazine_id = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'id', $magazine_insert_id, 'magazine_id');

                                    $role_name = "Magazine Incharger";
                                    $role_name = $obj->encode_decode('encrypt',$role_name);
                                    $check_role_name_exist = 0;
                                    $check_role_name_exist = $obj->getTableColumnValue($GLOBALS['role_table'], 'role_name', $role_name,'id');
                                    if(empty($check_role_name_exist)){
                                        $columns = array(); $values = array();
                                        $columns = array('created_date_time', 'creator', 'creator_name', 'role_id', 'role_name', 'lower_case_name', 'incharger','deleted');
                                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$role_name."'", "'".$lower_case_name."'", "'1'","'0'");
                                        $role_insert_id = $obj->InsertSQL($GLOBALS['role_table'], $columns, $values,'role_id','', $action);
                                    }


                                    $columns = array(); $values = array();
                                    $columns = array('created_date_time', 'creator', 'creator_name', 'user_id', 'name', 'mobile_number', 'name_mobile', 'login_id', 'lower_case_login_id', 'password', 'admin', 'type', 'factory_id', 'godown_id', 'magazine_id', 'deleted');
        
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$incharge_name."'", "'".$mobile_number."'", "'".$incharge_name_mobile."'", "'".$user_id."'", "'".$lower_case_user_id."'", "'".$password."'", "'".$admin."'", "'".$type."'", "'".$null_value."'", "'".$null_value."'", "'".$magazine_id."'", "'0'");
                                    $user_insert_id = $obj->InsertSQL($GLOBALS['user_table'], $columns, $values,'user_id', '', $action);

                                    if(preg_match("/^\d+$/", $user_insert_id)) {
                                        $result = array('number' => '1', 'msg' => 'Magazine Successfully Created');
                                    }
                                    else {
                                        $result = array('number' => '2', 'msg' => $user_insert_id);
                                    }
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $magazine_insert_id);
                                }
                            }
                            else {
                                if(!empty($mobile_no_error)) {
                                    $result = array('number' => '2', 'msg' => $mobile_no_error);
                                } 
                            }	
                        }
                        else {
                            if(!empty($user_error)) {
                                $result = array('number' => '2', 'msg' => $user_error);
                            } 
                        }	
                    }
                    else {
                        if(!empty($magazine_error)) {
                            $result = array('number' => '2', 'msg' => $magazine_error);
                        } 
                    }	
                }
                else {
                    if(empty($prev_magazine_id) || $prev_magazine_id == $edit_id) {
                        if(empty($prev_user_magazine_id) || $prev_user_magazine_id == $edit_id){
                            if(empty($prev_user_mbl_magazine_id) || $prev_user_mbl_magazine_id == $edit_id){
                                $getUniqueID = "";
                                $getUniqueID = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $edit_id, 'id');
                                if(preg_match("/^\d+$/", $getUniqueID)) {
                                    $action = "";
                                    if(!empty($magazine_name)) {
                                        $action = "Magazine Updated. Name - ".($obj->encode_decode('decrypt', $magazine_name));
                                    }

                                    $columns = array(); $values = array();		
                                    $columns = array('creator_name','magazine_name', 'lower_case_name', 'location', 'name_location', 'lowercase_name_location','lowercase_incharge_name', 'incharge_name', 'mobile_number', 'user_id', 'password', 'magazine_details');
                                    $values = array("'".$creator_name."'", "'".$magazine_name."'", "'".$lower_case_name."'", "'".$location."'", "'".$name_location."'", "'".$lowercase_name_location."'", "'".$lowercase_incharge_name."'",  "'".$incharge_name."'", "'".$mobile_number."'", "'".$user_id."'", "'".$password."'", "'".$magazine_details."'");

                                    $magazine_update_id = $obj->UpdateSQL($GLOBALS['magazine_table'], $getUniqueID, $columns, $values, $action);
                                    if(preg_match("/^\d+$/", $magazine_update_id)) {

                                        $user_unique_id = "";
                                        $user_unique_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'magazine_id', $edit_id, 'id');

                                        $columns = array(); $values = array();						
                                        $columns = array('creator_name', 'name', 'mobile_number', 'name_mobile', 'lower_case_login_id', 'password', 'login_id');

                                        $values = array("'".$creator_name."'", "'".$incharge_name."'", "'".$mobile_number."'", "'".$incharge_name_mobile."'", "'".$lower_case_user_id."'", "'".$password."'", "'".$user_id."'");

                                        $user_update_id = $obj->UpdateSQL($GLOBALS['user_table'], $user_unique_id, $columns, $values, $action);
                                        if(preg_match("/^\d+$/", $user_update_id)) {
                                            $result = array('number' => '1', 'msg' => 'Updated Successfully');		
                                        }else{
                                            $result = array('number' => '2', 'msg' => $user_update_id);
                                        }
                                    
                                    }
                                    else {
                                        $result = array('number' => '2', 'msg' => $magazine_update_id);
                                    }		
                                                        
                                }
                            }
                            else {
                                if(!empty($mobile_no_error)){
                                    $result = array('number' => '2', 'msg' => $mobile_no_error);
                                }
                            }
                        }
                        else {
                            if(!empty($user_error)) {
                                $result = array('number' => '2', 'msg' => $user_error);
                            } 
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $magazine_error);
                    }
                }	
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_magazine)) {
                $result = array('number' => '3', 'msg' => $valid_magazine);
            }
            if(!empty($count_error)) {
                $result = array('number' => '2', 'msg' => $count_error);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', 'DESC'); 

        // if(!empty($login_magazine_id) && !empty($total_records_list)) {
		// 	$records_list = array();
		// 	foreach($total_records_list as $row) {
		// 		if(!empty($row['magazine_id']) && $row['magazine_id'] == $login_magazine_id) {
		// 			$records_list[] = $row;
		// 		}
		// 	}
		// 	$total_records_list = $records_list;
		// }

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if((strpos(strtolower($obj->encode_decode('decrypt', $val['name_location'])), $search_text) !== false) ) {
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
        $view_access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($view_access_error)) { 
        ?>    
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Magazine Name</th>
                    <th>Incharge Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
          
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td>
                                     <?php
                                        if(!empty($list['magazine_name']) && $list['magazine_name'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['magazine_name']);
                                            if(!empty($list['location']) && $list['location'] != $GLOBALS['null_value']) {
                                                echo ' - '.$obj->encode_decode('decrypt', $list['location']);
                                            }
                                        }
                                    ?>
                                    <div class="w-100 py-2">
                                       <?php
                                           if(!empty($list['creator_name'])) {
                                               $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                               echo " Creator : ". $list['creator_name'];
                                           }
                                       ?>                                        
                                   </div>
                                </td>   
                                <td>
                                    <?php
                                        if(!empty($list['incharge_name']) && $list['incharge_name'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['incharge_name']);
                                            if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']) {
                                                echo ' - '.$obj->encode_decode('decrypt', $list['mobile_number']);
                                            }
                                        }
                                    ?>
                                </td> 
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
                                        <?php if($list['factory_id'] == $GLOBALS['null_value'] && $list['godown_id'] == $GLOBALS['null_value']){ ?>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" role="button" class="btn btn-dark show-button"  id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php
                                                    $edit_access_error = "";
                                                    if(!empty($login_staff_id)) {
                                                        $permission_action = $edit_action;
                                                        include('permission_action.php');
                                                    }
                                                    if(empty($edit_access_error)) { 
                                                        ?>
                                                    <li><a class="dropdown-item" style="cursor:pointer;" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['magazine_id'])) { echo $list['magazine_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                    <?php } 
                                                    $delete_access_error = "";
                                                    if(!empty($login_staff_id)) {
                                                        $permission_action = $delete_action;
                                                        include('permission_action.php');
                                                    }
                                                    if(empty($delete_access_error)) {
                                                        $linked_count = 0;
                                                        // $linked_count = $obj->GetMagazineLinkedCount($list['magazine_id']);
                                                        if(!empty($linked_count)) {
                                                            ?>
                                                            <li><a style="cursor:pointer;" class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                    <?php }else{ ?>
                                                        <li><a style="cursor:pointer;" class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['magazine_id'])) { echo $list['magazine_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        <?php } 
                                                            }
                                                        ?>
                                                </ul>
                                            </div> 
                                        </td>
                                        <?php } ?>
                                    <?php } ?>
                            </tr>
                            <?php
                        }
                    }
                    else { ?>
                        <tr>
                            <td colspan="5" class="text-center">Sorry! No records found</td>
                        </tr> <?php 
                    } 
                ?>
            </tbody>
        </table>   
                      
		<?php	
        }
	}

     

if(isset($_REQUEST['delete_magazine_id'])) {
    $delete_magazine_id = $_REQUEST['delete_magazine_id'];
    $delete_magazine_id = trim($delete_magazine_id);
    $msg = "";
    if(!empty($delete_magazine_id)) {	
        $magazine_unique_id = "";
        $magazine_unique_id = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $delete_magazine_id, 'id');
    
        $user_unique_id = "";
        $user_unique_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'magazine_id', $delete_magazine_id, 'id');
        if(preg_match("/^\d+$/", $magazine_unique_id)) {
            $name = "";
            $name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $delete_magazine_id, 'magazine_name');
        
            $action = "";
            if(!empty($name)) {
                $action = "Magazine Deleted. Name - ".($obj->encode_decode('decrypt', $name));
            }
            $linked_count = 0;
            // $linked_count = $obj->GetMagazineLinkedCount($delete_magazine_id); 
        
            if(empty($linked_count)) {
                $columns = array(); $values = array();			
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['magazine_table'], $magazine_unique_id, $columns, $values, $action);

                if(!empty($msg)){
                    if(preg_match("/^\d+$/", $user_unique_id)) {
                        $columns = array(); $values = array();			
                        $columns = array('deleted');
                        $values = array("'1'");
                        $msg = $obj->UpdateSQL($GLOBALS['user_table'], $user_unique_id, $columns, $values, $action);
                    }
                }
            }
            else {
                $msg = "This Magazine is associated with other screens";
            }
        }
        else {
            $msg = "Invalid Magazine";
        }
    }
    else {
        $msg = "Empty Magazine";
    }
    echo $msg;
    exit;	
}

    ?>