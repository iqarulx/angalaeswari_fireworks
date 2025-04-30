<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['transport_module'];
        }
    }


	if(isset($_REQUEST['show_transport_id'])) { 
        $show_transport_id = $_REQUEST['show_transport_id'];
        $show_transport_id = trim($show_transport_id); 

        if(!empty($show_transport_id)){
            $transport_list = array();
            $transport_list = $obj->getTableRecords($GLOBALS['transport_table'],'transport_id',$show_transport_id,'');
            if(!empty($transport_list)) {
                foreach($transport_list as $data){
                    if(!empty($data['transport_name']) && $data['transport_name'] != $GLOBALS['null_value']){
                        $transport_name = $obj->encode_decode("decrypt",$data['transport_name']);
                        $transport_name = html_entity_decode($transport_name);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                        $mobile_number = $data['mobile_number'];
                    }
                    if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']){
                        $gst_number = $obj->encode_decode("decrypt",$data['gst_number']);
                    }
                    if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']){
                        $location = $obj->encode_decode("decrypt",$data['location']);
                    }
                    if(!empty($data['transport_details']) && $data['transport_details'] != $GLOBALS['null_value']) {
                        $transport_details = $obj->encode_decode("decrypt",$data['transport_details']);
                    }
                }
            }
        } ?>

        <form class="poppins pd-20 redirection_form" name="transport_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_transport_id)){ ?>
                            <div class="h5">Edit Transport</div>
                            <?php
                        }else{ ?>
                            <div class="h5">Add Transport</div>
                            <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('transport.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_transport_id)) { echo $show_transport_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="transport_name" name="transport_name" class="form-control shadow-none" value="<?php if(!empty($transport_name)){echo $transport_name;} ?>"  required>
                            <label>Transport Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.(Max 25 char)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" required value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'');">
                            <label>Phone Number <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="gst_number" name="gst_number" class="form-control shadow-none" required value="<?php if(!empty($gst_number)){echo $gst_number;} ?>" class="form-control shadow-none">
                            <label>GST Number</label>
                        </div>
                        <div class="new_smallfnt">Format : 22AAAAA0000A1Z5 </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="location" name="location" class="form-control shadow-none" required value="<?php if(!empty($location)){echo $location;} ?>" class="form-control shadow-none">
                            <label>Location <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'transport_form', 'transport_changes.php', 'transport.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {	
        
        $valid_transport = ""; $form_name = "transport_form"; $transport_name = ""; $transport_name_error = ""; $valid_transport = ""; $mobile_number = ""; $mobile_number_error = ""; $gst_number = ""; $gst_number_error = ""; $location = ""; $location_error = ""; 

        
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['transport_name'])){
            $transport_name = $_POST['transport_name'];
            $transport_name = trim($transport_name);
        }
        
        if(!empty($transport_name) && strlen($transport_name) > 25) {
            $transport_name_error = "Only 25 characters allowed";
        }
        if(empty($transport_name)){
            $transport_name_error = "Enter the Transport Name";
        }
        if(!empty($transport_name_error)) {            
            if(!empty($valid_transport)) {
                $valid_transport = $valid_transport." ".$valid->error_display($form_name, "transport_name", $transport_name_error, 'text');
            }
            else {
                $valid_transport = $valid->error_display($form_name, "transport_name", $transport_name_error, 'text');
            }
        }
    
        $mobile_number = $_POST['mobile_number'];
        $mobile_number = trim($mobile_number);
        $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile number", "1");
        if(!empty($mobile_number_error)) {
            if(!empty($valid_transport)) {
                $valid_transport = $valid_transport." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
            }
            else {
                $valid_transport = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
            }
        }
        
        $gst_number = $_POST['gst_number'];
        $gst_number = trim($gst_number);
        if(!empty($gst_number)) {
            $gst_number_error = $valid->common_validation($gst_number, "gst_number",'text');	
        }
        if(!empty($gst_number_error)) {
            if(!empty($valid_transport)) {
                $valid_transport = $valid_transport." ".$valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
            }
            else {
                $valid_transport = $valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
            }
        }

        $location = $_POST['location'];
        $location = trim($location);
        if(!empty($location) && strlen($location) > 25) {
            $location_error = "Only 25 characters allowed";
        }
        if(empty($location)){
            $location_error = "Enter the Location";
        }
        if(!empty($location_error)) {
            if(!empty($valid_transport)) {
                $valid_transport = $valid_transport." ".$valid->error_display($form_name, "location", $location_error, 'text');
            }
            else {
                $valid_transport = $valid->error_display($form_name, "location", $location_error, 'text');
            }
        }

      
        $result = "";
        if(empty($valid_transport)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
    
                $name_mobile_city = ""; $transport_details = ""; $lower_case_name=""; $product_name="";$unit_name = ""; $name_location = "";
                $lowercase_name_location = "";
                if(!empty($transport_name)) {
                    $transport_name = htmlentities($transport_name, ENT_QUOTES);
                    $name_location = $transport_name;
                    $lower_case_name = strtolower($transport_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($transport_name)) {
                    $transport_details = $transport_name;
                  
                    $transport_name = $obj->encode_decode('encrypt', $transport_name);
                }else {
                    $transport_name = $GLOBALS['null_value'];
                }

                if(!empty($mobile_number)) {
                    $mobile_number = str_replace(" ", "", $mobile_number);
                    if(!empty($transport_details)) {
                        $transport_details = $transport_details."<br> Mobile : ".$mobile_number;
                    }
                }else {
                    $mobile_number = $GLOBALS['null_value'];
                }

                if(!empty($location)) {
                    if(!empty($transport_details)) {
                        $transport_details = $transport_details."<br>".str_replace("\r\n", "<br>", $location);
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

                if(!empty($transport_details)){
                    $transport_details = $obj->encode_decode('encrypt',$transport_details);
                }

                if(!empty($gst_number)){
                    $gst_number = $obj->encode_decode('encrypt',$gst_number);
                }
                if(!empty($lowercase_name_location)) {
                    $lowercase_name_location = $obj->encode_decode('encrypt', $lowercase_name_location);
                }
                if(!empty($name_location)) {
                    $name_location = $obj->encode_decode('encrypt', $name_location);
                }
                $transport_name_location_error = ""; $prev_transport_name_id = "";
                if(!empty($lowercase_name_location)) {
                    $prev_transport_name_id = $obj ->CheckTransportAlreadyExist($lowercase_name_location);
                    if(!empty($prev_transport_name_id)) {
                        $transport_name_location_error = "This Transport name already exists";
                    }
                }
                
                $prev_transport_id = ""; $transport_error = "";	$prev_transport_name ="";
                if(!empty($mobile_number)) {
                    $prev_transport_id = $obj->TransportMobileExists($mobile_number);
                    
                    // $obj->getTableColumnValue($GLOBALS['transport_table'], 'mobile_number', $mobile_number, 'transport_id');
                    if(!empty($prev_transport_id) && $prev_transport_id != $edit_id) {
                        $prev_transport_name = $obj->getTableColumnValue($GLOBALS['transport_table'],'transport_id',$prev_transport_id,'transport_name');
						$prev_transport_name = $obj->encode_decode("decrypt",$prev_transport_name);
                        $transport_error = "This mobile number is already exist in ".$prev_transport_name;
                        
                    }
                }
        
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);                
                
                if(empty($edit_id)) {
                    if(empty($prev_transport_id)) {
                        if(empty($prev_transport_name_id)) {

                            $action = "";
                            if(!empty($name_mobile_city)) {
                                $action = "New transport Created. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                            }
                            $null_value = $GLOBALS['null_value'];
                            $columns = array('created_date_time', 'creator', 'creator_name', 'transport_id', 'transport_name', 'mobile_number', 'gst_number', 'location','transport_details','lower_case_name', 'name_location', 'lower_case_name_location','deleted');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$transport_name."'", "'".$mobile_number."'", "'".$gst_number."'", "'".$location."'", "'".$transport_details."'", "'".$lower_case_name."'", "'".$name_location."'", "'".$lowercase_name_location."'","'0'");
                            $transport_insert_id = $obj->InsertSQL($GLOBALS['transport_table'], $columns, $values, 'transport_id', '', $action);
                            if(preg_match("/^\d+$/", $transport_insert_id)) {	
                                $transport_id = "";
                                $transport_id = $obj->getTableColumnValue($GLOBALS['transport_table'], 'id', $transport_insert_id, 'transport_id');
                                
                                                    
                                $result = array('number' => '1', 'msg' => 'Transport Successfully Created','transport_id' => $transport_id);
                                                
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $transport_insert_id);
                            }
                        }else{
                            $result = array('number' => '2', 'msg' => $transport_name_location_error);
                        }
                    
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $transport_error);
                    }
                }
                else {
                    if(empty($prev_transport_id) || $prev_transport_id == $edit_id) {
                        if(empty($prev_transport_name_id) || $prev_transport_name_id == $edit_id){
                            $getUniqueID = ""; $transport_id =$edit_id;
                            $getUniqueID = $obj->getTableColumnValue($GLOBALS['transport_table'], 'transport_id', $edit_id, 'id');
                            if(preg_match("/^\d+$/", $getUniqueID)) {
                                $action = "";
                                if(!empty($transport_name)) {
                                    $action = "Transport Updated. Details - ".$obj->encode_decode('decrypt', $transport_name);
                                }
                            
                                $columns = array(); $values = array();						
                                $columns = array('creator_name','transport_name', 'mobile_number', 'lower_case_name', 'gst_number', 'location','transport_details','name_location','lower_case_name_location');
                                $values = array("'".$creator_name."'", "'".$transport_name."'", "'".$mobile_number."'", "'".$lower_case_name."'", "'".$gst_number."'", "'".$location."'", "'".$transport_details."'", "'".$name_location."'", "'".$lowercase_name_location."'");
                                $user_update_id = $obj->UpdateSQL($GLOBALS['transport_table'], $getUniqueID, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $user_update_id)) {	
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $user_update_id);
                                }							
                            }
                        }else{
                           $result = array('number' => '2', 'msg' => $transport_name_location_error);
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $transport_error);
                    }
                }    
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_transport)) {
                $result = array('number' => '3', 'msg' => $valid_transport);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['transport_table'], '', '', 'DESC');

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($obj->encode_decode('decrypt', $val['transport_name'])), $search_text) !== false) {
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
            </div> 
        <?php } ?>
        <?php
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
                    <th>Transport Name</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        if(!empty($show_records_list)) { 
                            foreach($show_records_list as $key => $data) {
                                $index = $key + 1;
                                if(!empty($prefix)) { $index = $index + $prefix; } 
                                ?>
                                <tr>
                                    <td class="ribbon-header" style="cursor:default;">
                                        <?php
                                            echo $index; 
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['transport_name'])) {
                                                $data['transport_name'] = $obj->encode_decode('decrypt', $data['transport_name']);
                                                echo $data['transport_name'];
                                            }
                                        ?>
                                        <div class="w-100 py-2">
                                            Creator :
                                            <?php
                                                if(!empty($data['creator_name'])) {
                                                    $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                                    echo $data['creator_name'];
                                                }
                                            ?>                                        
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['location'])) {
                                                $data['location'] = $obj->encode_decode('decrypt', $data['location']);
                                                echo $data['location'];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                    <div class="dropdown">
                                            <a href="#" class="btn btn-dark show-button poppins" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <?php 
                                                $access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $edit_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($access_error)) {
                                            ?> 
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['transport_id'])) { echo $data['transport_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                <?php } ?>  
                                                <?php 
                                                    $access_error = "";
                                                    if(!empty($login_staff_id)) {
                                                        $permission_action = $delete_action;
                                                        include('permission_action.php');
                                                    }
                                                    if(empty($access_error)) {  ?>
                                                        
                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['transport_id'])) { echo $data['transport_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        
                                                <?php
                                                    } 
                                                ?>  
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
                                <td colspan="4" class="text-center">Sorry! No records found</td>
                            </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
        </table>   
                      
		<?php	
        }
	}

    if(isset($_REQUEST['delete_transport_id'])) {
        $delete_transport_id = $_REQUEST['delete_transport_id'];
        $delete_transport_id = trim($delete_transport_id);
        $msg = "";
        if(!empty($delete_transport_id)) {	
            $transport_unique_id = "";
            $transport_unique_id = $obj->getTableColumnValue($GLOBALS['transport_table'], 'transport_id', $delete_transport_id, 'id');
            if(preg_match("/^\d+$/", $transport_unique_id)) {
                $transport_name = "";
                $transport_name = $obj->getTableColumnValue($GLOBALS['transport_table'], 'transport_id', $delete_transport_id, 'transport_name');
            
                $action = "";
                if(!empty($transport_name)) {
                    $action = "Transport Deleted. Details - ".$obj->encode_decode('decrypt', $transport_name);
                }
                $linked_count = 0;
                // $linked_count = $obj->GetAgentLinkedCount($delete_transport_id); 
                if(empty($linked_count)) {
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['transport_table'], $transport_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This transport is associated with other screens";
                }
            }
            else {
                $msg = "Invalid transport";
            }
        }
        else {
            $msg = "Empty agent";
        }
        echo $msg;
        exit;	
    }


?>