<?php
include("include.php");

$login_staff_id = "";
if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
    if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
        $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
        $permission_module = $GLOBALS['charges_module'];
    }
}

if(isset($_REQUEST['show_charges_id'])) {
    $show_charges_id = "";
    $show_charges_id = $_REQUEST['show_charges_id'];

    $charges_names = ''; $charges_action = '';
    if(!empty($show_charges_id)) {
        $charges_list = array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], 'charges_id', $show_charges_id, '');
        if(!empty($charges_list)) {
            foreach ($charges_list as $data) {
                if(!empty($data['charges_name'])) {
                    $charges_names = $obj->encode_decode('decrypt', $data['charges_name']);
                }
                if(!empty($data['action'])){
                    $charges_action = $data['action'];
                }
            }
        }
    } 
    ?>
    <form class="poppins pd-20 redirection_form" name="charges_form" method="POST">
        <div class="card-header">
            <div class="row p-2">
                <div class="col-8 align-self-center">
                    <?php if(!empty($show_charges_id)){ ?>
                        <div class="h5">Edit Charges</div>
                    <?php 
                    } else{ ?>
                        <div class="h5">Add Charges</div>
                    <?php
                    } ?>
                </div>
                <div class="col-4">
                    <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('charges.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center p-3">
            <input type="hidden" name="edit_id" value="<?php if(!empty($show_charges_id)) {  echo $show_charges_id; } ?>">
            <div class="col-lg-12 col-md-10 col-10">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-8 col-12">
                        <div class="form-label-group in-border">
                            <div class="input-group mb-1">
                                <input type="text" id="charges_name" name="charges_name" value="<?php if(!empty($charges_names)) { echo $charges_names; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,'');" onkeyup="Javascript:InputBoxColor(this,'text');">
                                <label>Charges Name <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="new_smallfnt">Text Only (Character up to 15)</div>
                    </div>

					<div class="col-lg-3 col-md-6 col-12 mb-3">
						<div class="form-group mb-1">
							<div class="form-label-group in-border pb-2">
								<select name="action" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
									<option value="">Select action</option>
									<option value="plus" <?php if(!empty($charges_action) && ($charges_action == "plus")) { echo "Selected" ; } ?>>Plus</option>
									<option value="minus" <?php if(!empty($charges_action) && ($charges_action == "minus")) { echo "Selected" ; } ?>>Minus</option>
								</select>
								<label>Select action</label>
							</div>
						</div>
					</div>

                    <?php if(empty($show_charges_id)){ ?>
                        <div class="col-lg-2 col-md-3 col-12">
                            <button class="btn btn-success add_charges_button" style="font-size:12px;" type="button" onclick="Javascript:AddChargesDetails();">
                                Add Charges
                            </button>
                        </div>
                    <?php } ?>
				</div>
            </div>

            <?php if(empty($show_charges_id)) { ?>
                <div class="row py-2 mx-0">	
                    <div class="col-10 mx-auto">
                        <div class="table-responsive text-center">
                            <input type="hidden" name="charges_count" value="0">
                            <table class="table nowrap cursor smallfnt w-100 border charges_table">
                                <thead class="bg-dark smallfnt">
                                    <tr style="white-space:pre;">
                                        <th style="width:50px;">S.No</th>
                                        <th style="width:100px;">Charges Name</th>
                                        <th style="width:100px;">Charges Action</th>
                                        <th style="width:100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
           
            <div class="col-md-12 pt-3 text-center">
                <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event,'charges_form', 'charges_changes.php', 'charges.php');">
                    Submit
                </button>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                jQuery('#charges_name').on("keypress", function(e) {
                    if(e.keyCode == 13) {
                        AddChargesDetails();
                        return false;
                    }
                });
            });
        </script>
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
    </form>
    <?php
}


if(isset($_POST['edit_id'])) {
    $charges_names = array(); $charges_name = ""; $charges_name_error = ""; $charges = array();
	$actions = array(); $action =""; $action_error = ""; $lower_case_name = array(); 
    $single_lower_case_name = "";
    $valid_charges = ""; $form_name = "charges_form"; $append_error = ""; $charges_error = "";

    $edit_id = "";
    if(isset($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id'];
        $edit_id = trim($edit_id);
    }
   

	if(isset($_POST['charges_names'])){
		$charges_names = $_POST['charges_names'];
	}

	if(empty($charges_names)){
		if(isset($_POST['charges_name'])) {
            $charges_name = $_POST['charges_name'];
            $charges_name_error = $valid->valid_text($charges_name,'charges name','1','30');
            if(!empty($valid_charges)) {
                $valid_charges = $valid_charges." ".$valid->error_display($form_name, "charges_name", $charges_name_error, 'text');
            }
            else {
                $valid_charges = $valid->error_display($form_name, "charges_name", $charges_name_error, 'text');
            }
        }
    
	}

	if(isset($_POST['actions'])){
		$actions = $_POST['actions'];
	}
	if(empty($actions)){
		if(isset($_POST['action'])) {
            $action = $_POST['action'];
            $action_error = $valid->valid_name($action,'action','1','10');
            if(!empty($valid_charges)) {
                $valid_charges = $valid_charges." ".$valid->error_display($form_name, "action", $action_error, 'select');
            }
            else {
                $valid_charges = $valid->error_display($form_name, "action", $action_error, 'select');
            }
        }
    
	}

    if($edit_id == ""){
        if(empty($charges_names) && empty($actions)){
            if(!empty($charges_name) && !empty($action)){
                $form_insert_error =  "Click Add button to append the row details";
                if(!empty($form_insert_error)){
                    $append_error = $valid->error_display($form_name, "action", $form_insert_error, 'select');
                }else{
                    $append_error = $valid->error_display($form_name, "action", $form_insert_error, 'select');
                }	
            }
        }
    }

 
    $result = "";
    if(empty($valid_charges) && empty($append_error)) {
        $check_user_id_ip_address = 0;
        $check_user_id_ip_address = $obj->check_user_id_ip_address();

        if(preg_match("/^\d+$/", $check_user_id_ip_address)) {

            for($i = 0; $i < count($charges_names); $i++){
                if(!empty($charges_names)){
                    $charges_names[$i] = trim($charges_names[$i]);
					$lower_case_name[$i] = strtolower($charges_names[$i]);
				}
                $charges_names[$i] = $obj->encode_decode('encrypt', $charges_names[$i]);
                $lower_case_name[$i] = $obj->encode_decode('encrypt', $lower_case_name[$i]);
                // $actions[$i] = $obj->encode_decode('encrypt', $actions[$i]);
            }

			for ($i = 0; $i < count($charges_names); $i++) {
                if(!empty($lower_case_name[$i])) {
                    $prev_charges_id = $obj->CheckChargesAlreadyExists('', $lower_case_name[$i]);
                    if(!empty($prev_charges_id)) {
                        $charges_error = "This Charges name - " . $obj->encode_decode("decrypt",$lower_case_name[$i]) . " is already exist";
                    }
                }
            }

            if(!empty($charges_name)){
                $charges_name = trim($charges_name);
                $single_lower_case_name = strtolower($charges_name);
                $charges_name = $obj->encode_decode('encrypt',$charges_name);
                $single_lower_case_name = $obj->encode_decode('encrypt',$single_lower_case_name);
                $update_action = $action;

                if(!empty($single_lower_case_name)) {
                    $prev_charges_id = $obj->CheckChargesAlreadyExists('', $single_lower_case_name);
                    if(!empty($prev_charges_id)) {
                        if($prev_charges_id != $edit_id) {
                            $charges_error = "This Charges name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " is already exist";
                        }
                    }
                }
            }

			$created_date_time = $GLOBALS['create_date_time_label'];
            $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

            if(empty($charges_error)) {
                if(empty($edit_id)) {
                    $action = "";
                    for ($p = 0; $p < count($charges_names); $p++) {
                        if(empty($prev_charges_id)) {
                            if(!empty($charges_names[$p])) {
                                $action = "New Charges Created. Name - " . $charges_names[$p];
                            }

                            $null_value = $GLOBALS['null_value'];
                            $columns = array('created_date_time', 'creator', 'creator_name', 'charges_id', 'charges_name', 'lower_case_name','action', 'deleted');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$charges_names[$p]."'", "'".$lower_case_name[$p]."'", "'".$actions[$p]."'", "'0'");

                            $charges_insert_id = $obj->InsertSQL($GLOBALS['charges_table'], $columns, $values, 'charges_id', '', $action);		
                            if(preg_match("/^\d+$/", $charges_insert_id)) {								
                                $result = array('number' => '1', 'msg' => 'Charges Successfully Created');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $charges_insert_id);
                            }
                        } 
                        else {
                            $result = array('number' => '2', 'msg' => $charges_error);
                        }
                    }
                } 
                else if(!empty($edit_id)) {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if(!empty($charges_name)) {
                            $action = "Charges Updated. Name - " .$charges_name;
                        }

                        $columns = array(); $values = array();
                        $columns = array('creator_name', 'charges_name', 'lower_case_name','action');
                        $values = array("'".$creator_name."'", "'".$charges_name."'", "'".$single_lower_case_name."'", "'".$update_action."'");
                        $unit_update_id = $obj->UpdateSQL($GLOBALS['charges_table'], $getUniqueID, $columns, $values, $action);
                        if(preg_match("/^\d+$/", $unit_update_id)) {
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');
                        } 
                        else {
                            $result = array('number' => '2', 'msg' => $unit_update_id);
                        }
                    }
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => $charges_error);
            }
        } 
        else {
            $result = array('number' => '2', 'msg' => 'Invalid IP');
        }
    }
    else {
        if(!empty($valid_charges)) {
            $result = array('number' => '3', 'msg' => $valid_charges);
        }
        if(!empty($append_error)) {
            $result = array('number' => '3', 'msg' => $append_error);
        }   
    }

    if(!empty($result)) {
        $result = json_encode($result);
    }
    echo $result;
    exit;
}
if(isset($_POST['page_number'])) {
    $page_number = $_POST['page_number'];
    $page_limit = $_POST['page_limit'];
    $page_title = $_POST['page_title'];

    $search_text = "";
    if(isset($_POST['search_text'])) {
        $search_text = $_POST['search_text'];
        $search_text = trim($search_text);
    }

    $total_records_list = array();
    $total_records_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '','');

    if(!empty($search_text)) {
        $search_text = strtolower($search_text);
        $list = array();
        if(!empty($total_records_list)) {
            foreach ($total_records_list as $val) {
                if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['charges_name']))), $search_text) !== false)) {
                    $list[] = $val;
                }
            }
        }
        $total_records_list = $list;
    }

    $total_pages = 0;
    $total_pages = count($total_records_list);

    $page_start = 0;
    $page_end = 0;
    if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
        if($total_pages > $page_limit) {
            if($page_number) {
                $page_start = ($page_number - 1) * $page_limit;
                $page_end = $page_start + $page_limit;
            }
        } else {
            $page_start = 0;
            $page_end = $page_limit;
        }
    }

    $show_records_list = array();
    if(!empty($total_records_list)) {
        foreach ($total_records_list as $key => $val) {
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
            <?php
            include("pagination.php");
            ?>
        </div>
        <?php 
    } 
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
                    <th>Charges Name</th>
					<th>Charges Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($show_records_list)) {
                        $count_unit = 0;
                        foreach ($show_records_list as $key => $list) {
                            $index = $key + 1;

                            if(!empty($prefix)) {
                                $index = $index + $prefix;
                            } 
                            ?>
                            <tr style="cursor:default;">
                                <td><?php echo $index; ?></td>

                                <td class="text-center">
                                    <?php
                                        $charges_name = "";
                                        if(!empty($list['charges_name'])) {
                                            $charges_name = $obj->encode_decode('decrypt',$list['charges_name']);
                                            echo $charges_name;
                                        }
                                    ?>
                                    <div class="w-100 py-2">
                                        
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo "Creator : ". $list['creator_name'];
                                            }
                                        ?>                                        
                                    </div>
                                </td>
								<td class="text-center">
                                    <?php
                                        if(!empty($list['action'])) {
                                            if($list['action'] == 'plus'){
                                                echo "Plus";
                                            }elseif($list['action'] == 'minus'){
                                                echo "Minus";
                                            }
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
                            
                                        <?php if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button"  class="btn btn-dark show-button poppins" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1"><?php
                                                    if(empty($edit_access_error)) { 
                                                        ?>
                                                    <li><a class="dropdown-item" style="cursor:pointer;"  href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['charges_id'])) { echo $list['charges_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                    <?php } 
                                                    if(empty($delete_access_error)) {
                                                        $linked_count = 0;
                                                        $linked_count = $obj->GetChargesLinkedCount($list['charges_id']);
                                                        if(!empty($linked_count)) {
                                                            ?>
                                                            <li><a class="dropdown-item text-secondary" style="cursor:pointer;"><i class="fa fa-trash"></i> &ensp; Delete</a></li><?php 
                                                        }else{ ?> 
                                                            <li><a class="dropdown-item" style="cursor:pointer;" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['charges_id'])) { echo $list['charges_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li><?php 
                                                        } 
                                                    } ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </td>
                    		</tr> <?php
                        }
                    } 
                    else {
                        ?>
                        <tr>
                            <td colspan="3" class="text-center">Sorry! No records found</td>
                        </tr>
                        <?php 
                    }  
                ?>
            </tbody>
        </table>
        <?php
    }
}

if(isset($_REQUEST['charges_row_index'])) {
    $charges_row_index = $_REQUEST['charges_row_index'];
    $selected_charges_name = $_REQUEST['selected_charges_name'];
    $selected_action = $_REQUEST['selected_action'];

    ?>
    <tr class="charges_row" id="charges_row<?php if(!empty($charges_row_index)) { echo $charges_row_index; } ?>">
        <td class="text-center sno"><?php if(!empty($charges_row_index)) { echo $charges_row_index; } ?></td>
        <td class="text-center">
            <?php
                if(!empty($selected_charges_name)) {
                    echo $selected_charges_name;
                }    
            ?>
            <input type="hidden" name="charges_names[]" value="<?php if(!empty($selected_charges_name)) { echo $selected_charges_name; } ?>">
        </td>
		<td class="text-center">
            <?php
                if(!empty($selected_action)) {
                    if($selected_action == 'plus'){
                        echo "Plus";
                    }elseif($selected_action == 'minus'){
                        echo "Minus";
                    }
                }    
            ?>
            <input type="hidden" name="actions[]" value="<?php if(!empty($selected_action)) { echo $selected_action; } ?>">
        </td>
        <td class="text-center product_pad">
            <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('charges', '<?php if(!empty($charges_row_index)) { echo $charges_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php
}

if(isset($_REQUEST['delete_charges_id'])) {
    $delete_charges_id = $_REQUEST['delete_charges_id'];
    $msg = "";
    if(!empty($delete_charges_id)) {
        $unit_unique_id = "";
        $unit_unique_id = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $delete_charges_id, 'id');
        if(preg_match("/^\d+$/", $unit_unique_id)) {
            $charges_name = "";
            $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $delete_charges_id, 'charges_name');

            $action = "";
            if(!empty($charges_name)) {
                $action = "Unit Deleted. Name - " . $obj->encode_decode('decrypt', $charges_name);
            }
            $linked_count = "";
            $linked_count = 0;
            $linked_count = $obj->GetChargesLinkedCount($delete_charges_id);
            if(empty($linked_count)) {
                $columns = array();
                $values = array();
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['charges_table'], $unit_unique_id, $columns, $values, $action);
            }
            else {
                $msg = "This Charges is associated with other screens";
            }
        }
    }
    echo $msg;
    exit;
}
?>