<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['group_module'];
        }
    }

	if(isset($_REQUEST['show_group_id'])) { 
        $show_group_id = "";
        $show_group_id = $_REQUEST['show_group_id']; ?>
        <form class="poppins pd-20 redirection_form" name="group_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Group</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('group.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_group_id)) { echo $show_group_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="group_name" name="group_name" value="<?php if(!empty($group_name)) { echo $group_name; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',20,'');" onkeyup="Javascript:InputBoxColor(this,'text');">
                            <label>Group Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Text Only allowed.(Max 25 char)</div>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'group_form', 'group_changes.php', 'group.php');">
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
        $valid_unit = ""; $form_name = "group_form"; $group_name = ""; $group_name_error = "";
        $lower_case_name = "";
    
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['group_name'])) {
            $group_name = $_POST['group_name'];

            if(!empty($group_name)){
                if(!preg_match("/^[a-zA-Z\s ]+$/", $group_name) || strlen($group_name) > 20) {
                    $group_name_error = "Invalid Group name - " . $group_name;
                }
            } else {
                $group_name_error = "Enter Group name";
            }

            if(!empty($group_name_error)) {
                if(!empty($valid_group)) {
                    $valid_group = $valid_group." ".$valid->error_display($form_name, "group_name", $group_name_error, 'text');
                }
                else {
                    $valid_group = $valid->error_display($form_name, "group_name", $group_name_error, 'text');
                }
            }
        }
        
    
        $result = "";
        if(empty($valid_group)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
    
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                $lower_case_name=""; 

                if(!empty($group_name)) {
                    $group_name = htmlentities($group_name, ENT_QUOTES);
                    $lower_case_name = strtolower($group_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                    $group_name = $obj->encode_decode('encrypt', $group_name);
                }
                $group_exist_error = ""; $prev_group_id = "";
                if(!empty($lower_case_name)) {
                    $prev_group_id = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', $lower_case_name, 'group_id');
                    if(!empty($prev_group_id)) {
                        $group_exist_error = "This Group is already exist";
                    }
                }

                if(empty($edit_id)) {
                    if(empty($prev_group_id)) {	
                        $action = "";
                        if(!empty($group_name)) {
                            $action = "New Group Created. Details - ".$group_name;
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'group_id', 'group_name', 'lower_case_name','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$group_name."'", "'".$lower_case_name."'","'0'");
                        $group_insert_id = $obj->InsertSQL($GLOBALS['group_table'], $columns, $values, 'group_id', '', $action);
                        if(preg_match("/^\d+$/", $group_insert_id)) {	
                            $group_id = "";
                            $group_id = $obj->getTableColumnValue($GLOBALS['group_table'], 'id', $group_insert_id, 'group_id');   
                            $result = array('number' => '1', 'msg' => 'Group Successfully Created','group_id' => $group_id);
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $group_insert_id);
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $group_exist_error);
                    }
                }
                else {
                    if(empty($prev_group_id) || $prev_group_id == $edit_id){
                         $getUniqueID = ""; $group_id = $edit_id;
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['group_table'], 'group_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($group_name)) {
                                $action = "group Updated. Details - ".$group_name;
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','group_name', 'lower_case_name');
                            $values = array("'".$creator_name."'", "'".$group_name."'", "'".$lower_case_name."'");
                            $user_update_id = $obj->UpdateSQL($GLOBALS['group_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $user_update_id)) {	
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $user_update_id);
                            }							
                        }
                    }else{
                        $result = array('number' => '2', 'msg' => $group_exist_error);
                    }
                } 
    
                
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_group)) {
                $result = array('number' => '3', 'msg' => $valid_group);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['group_table'], '', '','');
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['group_name']))), $search_text) !== false)) {
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
                        <th style="width: 300px;">S.No</th>
                        <th class="text-start">Group Name</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_group = 0;
                            foreach ($show_records_list as $key => $list) {
                                $index = $key + 1;
    
                                if(!empty($prefix)) {
                                    $index = $index + $prefix;
                                } 
                                ?>
                                <tr style="cursor:default;">
                                    <td style="width: 300px;"><?php echo $index; ?></td>
    
                                    <td class="text-start">
                                        <?php
                                            $group_name = "";
                                            if(!empty($list['group_name'])) {
                                                $group_name = $list['group_name'];
                                                $group_name = $obj->encode_decode('decrypt', $group_name);
                                                echo $group_name;
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
                                </tr>
                                <?php
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
    
    ?>