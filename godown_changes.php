<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['godown_module'];
        }
    }

	if(isset($_REQUEST['show_godown_id'])) { 
        $show_godown_id = $_REQUEST['show_godown_id'];
        $show_godown_id = trim($show_godown_id);
        
        $godown_name = ""; $incharge_name = ""; $user_id = ""; $password = "";  $mobile_number = "";
       $district = ""; $location = "";

        if(!empty($show_godown_id)) {
            $godown_list = array();
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $show_godown_id,'');
            
			if(!empty($godown_list)) {
				foreach($godown_list as $data) {
					if(!empty($data['godown_name'])) {
						$godown_name = $obj->encode_decode('decrypt', $data['godown_name']);
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
        <form class="poppins pd-20 redirection_form" name="godown_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(empty($show_godown_id)) { ?>
                            <div class="h5">Add Godown</div>
                        <?php } else { ?>
                            <div class="h5">Edit Godown</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('godown.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_godown_id)) { echo $show_godown_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="godown_name" name="godown_name" onkeydown="Javascript:KeyboardControls(this,'text',50,1);" class="form-control shadow-none"  value="<?php if(!empty($godown_name)) { echo $godown_name; } ?>">
                            <label>Godown Name <span class="text-danger">*</span></label>
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
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'godown_form', 'godown_changes.php', 'godown.php');">
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
                        if(!empty($show_godown_id)){ ?>CheckPassword('password');<?php }
                    ?>
                });
            </script>
        
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    
  
    if(isset($_POST['godown_name'])) {	
        $godown_name = ""; $godown_name_error = ""; $incharge_name = ""; $incharge_name_error = ""; $user_id = "";$user_id_error = ""; $password = "";  $mobile_number = "";$mobile_number_error = ""; $district = ""; $district_error = ""; 
        $location = ""; $location_error = ""; $others_location = ""; $others_location_error = "";
        $valid_godown = ""; $form_name = "godown_form"; $edit_id = "";


        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        
        $godown_name = $_POST['godown_name'];
        $godown_name = trim($godown_name);
       
        if(!empty($godown_name) && strlen($godown_name) > 50) {
            $godown_name_error = "Only 50 characters allowed";
        }
        else {
            $godown_name_error = $valid->valid_company_name($godown_name,'godown Name','1');
        }
        if(empty($godown_name_error) && empty($edit_id)) {
            $godown_list = array(); $godown_count = 0;
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '','');
            if(!empty($godown_list)) {
                $godown_count = count($godown_list);
            }
            if($godown_count == $GLOBALS['max_godown_count']) {
                $godown_name_error = "Max. ".$GLOBALS['max_godown_count']." godowns are allowed";
            }
        }
        if(!empty($godown_name_error)) {
            if(!empty($valid_godown)) {
                $valid_godown = $valid_godown." ".$valid->error_display($form_name, "godown_name", $godown_name_error, 'text');
            }
            else {
                $valid_godown = $valid->error_display($form_name, "godown_name", $godown_name_error, 'text');
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
                if(!empty($valid_godown)) {
                    $valid_godown = $valid_godown." ".$valid->error_display($form_name, "location", $location_error, 'text');
                }
                else {
                    $valid_godown = $valid->error_display($form_name, "location", $location_error, 'text');
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
            if(!empty($valid_godown)) {
                $valid_godown = $valid_godown." ".$valid->error_display($form_name, "incharge_name", $incharge_name_error, 'text');
            }
            else {
                $valid_godown = $valid->error_display($form_name, "incharge_name", $incharge_name_error, 'text');
            }
        }

        if(isset($_POST['mobile_number'])) {
            $mobile_number = $_POST['mobile_number'];
            $mobile_number = trim($mobile_number);
            $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile Number", "1");
            if(!empty($mobile_number_error)) {
                if(!empty($valid_godown)) {
                    $valid_godown = $valid_godown." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
                else {
                    $valid_godown = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
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
                if(!empty($valid_godown)) {
                    $valid_godown = $valid_godown." ".$valid->error_display($form_name, "user_id", $user_id_error, 'text');
                }
                else {
                    $valid_godown = $valid->error_display($form_name, "user_id", $user_id_error, 'text');
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
                if(!empty($valid_godown)) {
                    $valid_godown = $valid_godown." ".$valid->error_display($form_name, "password", $password_error, 'input_group');
                }
                else {
                    $valid_godown = $valid->error_display($form_name, "password", $password_error, 'input_group');
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
        
        if(empty($valid_godown) && empty($count_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
               
                $prev_user_id = ""; $user_error = ""; $str_user_id = "";$prev_user_godown_id = "";
                $prev_user_mbl_godown_id = "";
                $godown_details = ""; $lower_case_name = ""; $lower_case_user_id = ""; $name_location = "";
                $incharge_name_mobile = ""; $admin = 0; $type = $GLOBALS['godown_user_type'];
                $lower_case_name = ""; $lower_case_user_id = ""; $name_location = ""; $lowercase_incharge_name = "";$lowercase_name_location = "";
                if(!empty($godown_name)) { 
                    $godown_details = $godown_name;
                    $name_location = $godown_name;
                    $godown_name = htmlentities($godown_name,ENT_QUOTES);
                    $lower_case_name = strtolower($godown_name);   
                    $godown_name = $obj->encode_decode('encrypt', $godown_name);
                    $lower_case_name = htmlentities($lower_case_name,ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($location)) {
                    if(!empty($godown_details)) {
                        $godown_details = $godown_details."$$$".$location;
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
                    if(!empty($godown_details)) {
                        $godown_details = $godown_details."$$$"."Incharge - ".$incharge_name;
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
                    if(!empty($godown_details)) {
                        $godown_details = $godown_details." (".$mobile_number.")";
                    }    
                    if(!empty($incharge_name_mobile)) {
                        $incharge_name_mobile = $incharge_name_mobile." (".$mobile_number.")";
                    }            
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }
                else {
                    $mobile_number = $GLOBALS['null_value'];
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
                if(!empty($godown_details)) {
                    $godown_details = $obj->encode_decode('encrypt', $godown_details);
                }
                if(!empty($incharge_name_mobile)) {
                    $incharge_name_mobile = $obj->encode_decode('encrypt', $incharge_name_mobile);
                }

                $prev_godown_id = "";$godown_error = ""; $prev_user_id = ""; $user_error = ""; $str_user_id = "";
                // if(!empty($lower_case_name)) {
                //     $prev_godown_id = $obj->getTableColumnValue($GLOBALS['godown_table'], 'lowercase_name_location', $lower_case_name, 'godown_id');
                //     if(!empty($prev_godown_id)) {
                //         $godown_error = "This Godown name already exists";
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
                    $prev_godown_id = $obj ->CheckGodownAlreadyExist($lowercase_name_location);
                    if(!empty($prev_godown_id)) {
                        $godown_error = "This Godown name already exists";
                    }
                }

                if(!empty($lower_case_user_id)) {
                    $prev_user_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'lower_case_login_id', $lower_case_user_id, 'user_id');
                    $prev_user_godown_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'lower_case_login_id', $lower_case_user_id, 'godown_id');

                    if(!empty($prev_user_id)) {
                        if(!empty($edit_id)){
                            if(!empty($prev_user_godown_id) && $prev_user_godown_id != $edit_id){
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
                    $prev_user_mbl_godown_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'mobile_number', $mobile_number, 'godown_id');

                    if(!empty($prev_user_mbl_id)) {
                        $prev_user_name = "";
                        $prev_user_name = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $prev_user_mbl_id, 'name');
						$prev_user_name = $obj->encode_decode("decrypt", $prev_user_name);

                        if(!empty($edit_id)){
                            if(!empty($prev_user_mbl_godown_id) && $prev_user_mbl_godown_id != $edit_id){
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
                    if(empty($prev_godown_id)) {
                        if(empty($prev_user_id)) {
                            if(empty($prev_user_mbl_godown_id)) {
                                $action = "";
                                if(!empty($godown_name)) {
                                    $action = "New Godown Created. Name - ".($obj->encode_decode('decrypt', $godown_name));
                                }

                                $null_value = $GLOBALS['null_value'];

                                $columns = array(); $values = array();
                                $columns = array('created_date_time', 'creator', 'creator_name', 'godown_id', 'godown_name', 'lower_case_name', 'location', 'name_location', 'lowercase_name_location', 'incharge_name', 'mobile_number', 'user_id', 'password', 'lowercase_incharge_name', 'godown_details', 'factory_id','deleted');

                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$godown_name."'", "'".$lower_case_name."'", "'".$location."'", "'".$name_location."'", "'".$lowercase_name_location."'", "'".$incharge_name."'", "'".$mobile_number."'", "'".$user_id."'", "'".$password."'", "'".$lowercase_incharge_name."'", "'".$godown_details."'",  "'".$null_value."'","'0'");

                                $godown_insert_id = $obj->InsertSQL($GLOBALS['godown_table'], $columns, $values,'godown_id', '', $action);

                                if(preg_match("/^\d+$/", $godown_insert_id)) {
                                    $godown_id = $obj->getTableColumnValue($GLOBALS['godown_table'], 'id', $godown_insert_id, 'godown_id');

                                    $role_name = "Godown Incharger";
                                    $role_name = $obj->encode_decode('encrypt',$role_name);
                                    $check_role_name_exist = 0;
                                    $check_role_name_exist = $obj->getTableColumnValue($GLOBALS['role_table'], 'role_name', $role_name,'id');
                                    if(empty($check_role_name_exist)){
                                        $columns = array(); $values = array();
                                        $columns = array('created_date_time', 'creator', 'creator_name', 'role_id', 'role_name', 'lower_case_name', 'incharger','deleted');
                                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$role_name."'", "'".$lower_case_name."'", "'1'","'0'");
                                        $role_insert_id = $obj->InsertSQL($GLOBALS['role_table'], $columns, $values,'role_id','', $action);
                                    }

                                    $role_id = "";
                                    $role_id = $obj->getTableColumnValue($GLOBALS['role_table'], 'role_name', $role_name,'role_id');

                                    $columns = array(); $values = array();
                                    $columns = array('created_date_time', 'creator', 'creator_name', 'user_id', 'name', 'mobile_number', 'name_mobile', 'login_id', 'lower_case_login_id', 'password', 'admin', 'type', 'factory_id', 'godown_id', 'magazine_id', 'role_id','deleted');
        
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$incharge_name."'", "'".$mobile_number."'", "'".$incharge_name_mobile."'", "'".$user_id."'", "'".$lower_case_user_id."'", "'".$password."'", "'".$admin."'", "'".$type."'", "'".$null_value."'", "'".$godown_id."'", "'".$null_value."'", "'".$role_id."'","'0'");
                                    $user_insert_id = $obj->InsertSQL($GLOBALS['user_table'], $columns, $values,'user_id', '', $action);

                                    if(preg_match("/^\d+$/", $user_insert_id)) {
                                        $result = array('number' => '1', 'msg' => 'Godown Successfully Created');
                                    }
                                    else {
                                        $result = array('number' => '2', 'msg' => $user_insert_id);
                                    }
                                        
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $godown_insert_id);
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
                        if(!empty($godown_error)) {
                            $result = array('number' => '2', 'msg' => $godown_error);
                        } 
                    }	
                }
                else {
                    if(empty($prev_godown_id) || $prev_godown_id == $edit_id) {
                        if(empty($prev_user_godown_id) || $prev_user_godown_id == $edit_id){
                            if(empty($prev_user_mbl_godown_id) || $prev_user_mbl_godown_id == $edit_id){
                                $getUniqueID = "";
                                $getUniqueID = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $edit_id, 'id');
                                if(preg_match("/^\d+$/", $getUniqueID)) {
                                    $action = "";
                                    if(!empty($godown_name)) {
                                        $action = "Godown Updated. Name - ".($obj->encode_decode('decrypt', $godown_name));
                                    }

                                    $columns = array(); $values = array();		
                                    $columns = array('creator_name','godown_name', 'lower_case_name', 'location', 'name_location', 'lowercase_name_location','lowercase_incharge_name',  'incharge_name', 'mobile_number', 'user_id', 'password','godown_details');
                                    $values = array("'".$creator_name."'", "'".$godown_name."'", "'".$lower_case_name."'", "'".$location."'", "'".$name_location."'", "'".$lowercase_name_location."'", "'".$lowercase_incharge_name."'", "'".$incharge_name."'", "'".$mobile_number."'", "'".$user_id."'", "'".$password."'",  "'".$godown_details."'");

                                    $godown_update_id = $obj->UpdateSQL($GLOBALS['godown_table'], $getUniqueID, $columns, $values, $action);

                                    if(preg_match("/^\d+$/", $godown_update_id)) {

                                        $user_unique_id = "";
                                        $user_unique_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'godown_id', $edit_id, 'id');

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
                                        $result = array('number' => '2', 'msg' => $godown_update_id);
                                    }
                                }	
                                
                            }else {
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
                        $result = array('number' => '2', 'msg' => $godown_error);
                    }
                }	
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_godown)) {
                $result = array('number' => '3', 'msg' => $valid_godown);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', 'DESC'); 

        // if(!empty($login_godown_id) && !empty($total_records_list)) {
		// 	$records_list = array();
		// 	foreach($total_records_list as $row) {
		// 		if(!empty($row['godown_id']) && $row['godown_id'] == $login_godown_id) {
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
                    <th>S.No</th>
                    <th>godown Name</th>
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
                                        if(!empty($list['godown_name']) && $list['godown_name'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['godown_name']);
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
                                         <?php if($list['factory_id'] == $GLOBALS['null_value']){ ?>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" role="button" class="btn btn-dark show-button"  id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <?php
                                                        if(empty($edit_access_error)) { 
                                                            ?>
                                                        <li><a class="dropdown-item" style="cursor:pointer;" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                        <?php } 
                                                        
                                                        if(empty($delete_access_error)) {
                                                            $linked_count = 0;
                                                            $linked_count = $obj->GetgodownLinkedCount($list['godown_id']);
                                                            if(!empty($linked_count)) {
                                                                ?>
                                                                <li><a style="cursor:pointer;" class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        <?php }else{ ?>
                                                            <li><a style="cursor:pointer;" class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
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

    

if(isset($_REQUEST['delete_godown_id'])) {
    $delete_godown_id = $_REQUEST['delete_godown_id'];
    $delete_godown_id = trim($delete_godown_id);
    $msg = "";
    if(!empty($delete_godown_id)) {	
        $godown_unique_id = "";
        $godown_unique_id = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $delete_godown_id, 'id');
    
        $user_unique_id = "";
        $user_unique_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'godown_id', $delete_godown_id, 'id');

        if(preg_match("/^\d+$/", $godown_unique_id)) {
            $name = "";
            $name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $delete_godown_id, 'godown_name');
        
            $action = "";
            if(!empty($name)) {
                $action = "godown Deleted. Name - ".($obj->encode_decode('decrypt', $name));
            }
            $linked_count = 0;
            // $linked_count = $obj->GetgodownLinkedCount($delete_godown_id); 
        
            if(empty($linked_count)) {
                $columns = array(); $values = array();			
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['godown_table'], $godown_unique_id, $columns, $values, $action);
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
                $msg = "This godown is associated with other screens";
            }
        }
        else {
            $msg = "Invalid godown";
        }
    }
    else {
        $msg = "Empty godown";
    }
    echo $msg;
    exit;	
}

    ?>
