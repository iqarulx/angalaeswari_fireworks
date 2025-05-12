<?php
    include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['raw_material_group_module'];
        }
    }

    if(isset($_REQUEST['show_raw_material_group_id'])) {
        $show_raw_material_group_id = "";
        $show_raw_material_group_id = $_REQUEST['show_raw_material_group_id'];

        $raw_material_group_name = "";
        if(!empty($show_raw_material_group_id)) {
            $raw_material_group_list = array();
            $raw_material_group_list = $obj->getTableRecords($GLOBALS['raw_material_group_table'], 'raw_material_group_id', $show_raw_material_group_id, '');
            if(!empty($raw_material_group_list)) {
                foreach ($raw_material_group_list as $data) {
                    if(!empty($data['raw_material_group_name'])) {
                        $raw_material_group_name = $obj->encode_decode('decrypt', $data['raw_material_group_name']);
                    }
                }
            }
        } 
        
        ?>
        <form class="poppins pd-20 redirection_form" name="raw_material_group_form" method="POST">
            <div class="card-header">
                <div class="row p-2">
                    <div class="col-8 align-self-center">
                        <?php if(!empty($show_raw_material_group_id)){ ?>
                            <div class="h5">Edit Raw Material Group</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add Raw Material Group</div>
                        <?php
                        } ?>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('raw_material_group.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_raw_material_group_id)) {  echo $show_raw_material_group_id; } ?>">
                <div class="col-lg-8 col-md-10 col-10">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-8 col-12">
                            <div class="form-label-group in-border">
                                <div class="input-group mb-1">
                                    <input type="text" id="raw_material_group_name" name="raw_material_group_name" value="<?php if(!empty($raw_material_group_name)) { echo $raw_material_group_name; } ?>" class="form-control shadow-none" onkeyup="Javascript:InputBoxColor(this,'text');">
                                    <label>Raw Material Group Name <span class="text-danger">*</span></label>
                                    <?php if(empty($show_raw_material_group_id)) { ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="Javascript:addCreationDetails('raw_material_group', 40);"><i class="fa fa-plus"></i></button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="new_smallfnt">Text Only (Character up to 40)</div>
                        </div>
                    </div>
                </div>
                <?php if(empty($show_raw_material_group_id)) { ?>
                    <div class="col-lg-6 col-md-8 col-12 mt-3">
                        <div class="table-responsive smallfnt text-center">
                            <input type="hidden" name="raw_material_group_count" value="0">
                            <table class="table nowrap cursor table-bordered text-center added_raw_material_group_table">
                                <thead class="bg-dark">
                                    <tr class="text-white">
                                        <th>S.No</th>
                                        <th>Raw Material Group Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event,'raw_material_group_form', 'raw_material_group_changes.php', 'raw_material_group.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#raw_material_group_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationDetails('raw_material_group', 40);
                            return false;
                        }
                    });
                });
            </script>
        </form>
        <?php
    }

    if(isset($_POST['edit_id'])) {
        $raw_material_group_name = array(); $raw_material_group_name_error = ""; $single_lower_case_name = "";
        $valid_raw_material_group = ""; $form_name = "raw_material_group_form"; $raw_material_group_error = "";
        $single_raw_material_group_name = ""; $prev_raw_material_group_id = ""; $lower_case_name = array();

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if(isset($_POST['raw_material_group_name'])) {
                $single_raw_material_group_name = $_POST['raw_material_group_name'];
                $single_raw_material_group_name = trim($single_raw_material_group_name);
                $raw_material_group_name_error = $valid->valid_product_name($single_raw_material_group_name, 'Raw Material Group', '1', '50');
            }
            if(!empty($raw_material_group_name_error)) {
                $valid_raw_material_group = $valid->error_display($form_name, "raw_material_group_name", $raw_material_group_name_error, 'text');
            } else {
                $single_lower_case_name = strtolower($single_raw_material_group_name);
                $single_raw_material_group_name = $obj->encode_decode("encrypt", $single_raw_material_group_name);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
                if(!empty($single_lower_case_name)) {
                    $prev_raw_material_group_id = $obj->CheckRawMaterialGroupAlreadyExists($single_lower_case_name);
                    if(!empty($prev_raw_material_group_id)) {
                        if($prev_raw_material_group_id != $edit_id) {
                            $raw_material_group_error = "This Raw Material Group name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " is already exist";
                        }
                    }
                }
            }
        }

        if(empty($edit_id)) {
            if(isset($_POST['raw_material_group_names'])) {
                $raw_material_group_name = $_POST['raw_material_group_names'];
            }

            $inputbox_raw_material_group_name = "";
            $inputbox_raw_material_group_name = $_POST['raw_material_group_name'];

            if(!empty($inputbox_raw_material_group_name) && empty($raw_material_group_name)) {
                $raw_material_group_add_error = "Click Add Button to Append Raw Material Group";
                if(!empty($raw_material_group_add_error)) {
                    $valid_raw_material_group = $valid->error_display($form_name, "raw_material_group_name", $raw_material_group_add_error, 'text');
                }
            } else if(empty($inputbox_raw_material_group_name) && empty($raw_material_group_name)) {
                $raw_material_group_add_error = "Enter Raw Material Group Name";
                if(!empty($raw_material_group_add_error)) {
                    $valid_raw_material_group = $valid->error_display($form_name, "raw_material_group_name", $raw_material_group_add_error, 'text');
                }
            } else if(!empty($inputbox_raw_material_group_name)) {
                $raw_material_group_add_error = "Click Add Button to Append Raw Material Group";
                if(!empty($raw_material_group_add_error)) {
                    $valid_raw_material_group = $valid->error_display($form_name, "raw_material_group_name", $raw_material_group_add_error, 'text');
                }
            }
            if(!empty($raw_material_group_name)) {
                for ($p = 0; $p < count($raw_material_group_name); $p++) {
                    // if(!preg_match("/^[a-zA-Z\s ]+$/", $raw_material_group_name[$p]) || strlen($raw_material_group_name[$p]) > 40) {
                    $raw_material_group_name[$p] = $obj->encode_decode('decrypt', $raw_material_group_name[$p]);
                    if(strlen($raw_material_group_name[$p]) > 40) {
                        $raw_material_group_name_error = "Invalid Raw Material Group name - " . $raw_material_group_name[$p];
                    } else {
                        $lower_case_name[$p] = strtolower($raw_material_group_name[$p]);
                        $raw_material_group_name[$p] = $obj->encode_decode('encrypt', $raw_material_group_name[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                    }

                    if(!empty($raw_material_group_name_error)) {
                        if(!empty($valid_raw_material_group)) {
                            $valid_raw_material_group = $valid_raw_material_group." ".$valid->error_display($form_name, "raw_material_group_name", $raw_material_group_name_error, 'text');
                        } else {
                            $valid_raw_material_group = $valid->error_display($form_name, "raw_material_group_name", $raw_material_group_name_error, 'text');
                        }
                    }
                }
            }
        }
        
        $result = "";
        if(empty($valid_raw_material_group) && empty($raw_material_group_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();

            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($lower_case_name); $i++) {
                    if(!empty($lower_case_name[$i])) {
                        $prev_raw_material_group_id = $obj->CheckRawMaterialGroupAlreadyExists($lower_case_name[$i]);
                        if(!empty($prev_raw_material_group_id)) {
                            $raw_material_group_error = "This Raw Material Group name - " . $obj->encode_decode("decrypt", $lower_case_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if(empty($raw_material_group_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($raw_material_group_name); $p++) {
                            if(empty($prev_raw_material_group_id)) {
                                if(!empty($raw_material_group_name[$p])) {
                                    $action[$p] = "New Raw Material Group Created. Name - " . $obj->encode_decode('decrypt', $raw_material_group_name[$p]);
                                }

                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name', 'raw_material_group_id', 'raw_material_group_name', 'lower_case_name', 'deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$raw_material_group_name[$p]."'", "'".$lower_case_name[$p]."'", "'0'");

                                $raw_material_group_insert_id = $obj->InsertSQL($GLOBALS['raw_material_group_table'], $columns, $values, 'raw_material_group_id', '', $action[$p]);		
                                if(preg_match("/^\d+$/", $raw_material_group_insert_id)) {								
                                    $result = array('number' => '1', 'msg' => 'Raw Material Group Successfully Created');						
                                } else {
                                    $result = array('number' => '2', 'msg' => $raw_material_group_insert_id);
                                }
                            } else {
                                $result = array('number' => '2', 'msg' => $raw_material_group_error);
                            }
                        }
                    } else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['raw_material_group_table'], 'raw_material_group_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_raw_material_group_name)) {
                                $action = "Raw Material Group Updated. Name - " . $obj->encode_decode('decrypt', $single_raw_material_group_name);
                            }

                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'raw_material_group_name', 'lower_case_name');
                            $values = array("'".$creator_name."'", "'".$single_raw_material_group_name."'", "'".$single_lower_case_name."'");
                            $raw_material_group_update_id = $obj->UpdateSQL($GLOBALS['raw_material_group_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $raw_material_group_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $raw_material_group_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $raw_material_group_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_raw_material_group)) {
                $result = array('number' => '3', 'msg' => $valid_raw_material_group);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['raw_material_group_table'], '', '','');

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['raw_material_group_name']))), $search_text) !== false)) {
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
                        <th>Raw Material Group Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_raw_material_group = 0;
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
                                            $raw_material_group_name = "";
                                            if(!empty($list['raw_material_group_name'])) {
                                                $raw_material_group_name = $list['raw_material_group_name'];
                                                $raw_material_group_name = $obj->encode_decode('decrypt', $raw_material_group_name);
                                                echo $raw_material_group_name;
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
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button"  data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-dark show-button poppins">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <?php
                                                    if(empty($edit_access_error)) { 
                                                        ?>
                                                        <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['raw_material_group_id'])) { echo $list['raw_material_group_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                    <?php } 
                                                    if(empty($delete_access_error)) {
                                                        $linked_count = 0;
                                                        $linked_count = $obj->GetRawMaterialGroupLinkedCount($list['raw_material_group_id']);
                                                        if(!empty($linked_count)) {
                                                            ?>
                                                            <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        <?php }else{ ?>
                                                            <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['raw_material_group_id'])) { echo $list['raw_material_group_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                            <?php } 
                                                    }
                                                    ?>                                             
                                                </ul>
                                            </div>
                                        </td>
                                    <?php } ?>
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

    if(isset($_REQUEST['raw_material_group_row_index'])) {
        $raw_material_group_row_index = $_REQUEST['raw_material_group_row_index'];
        $selected_raw_material_group_name = $_REQUEST['selected_raw_material_group_name'];
        ?>
        <tr class="raw_material_group_row" id="raw_material_group_row<?php if(!empty($raw_material_group_row_index)) { echo $raw_material_group_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($raw_material_group_row_index)) { echo $raw_material_group_row_index; } ?></td>
            <td class="text-center">
                <?php
                    if(!empty($selected_raw_material_group_name)) {
                        echo $selected_raw_material_group_name;
                    }    
                ?>
                <input type="hidden" name="raw_material_group_names[]" value="<?php if(!empty($selected_raw_material_group_name)) { echo $obj->encode_decode('encrypt', $selected_raw_material_group_name); } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('raw_material_group', '<?php if(!empty($raw_material_group_row_index)) { echo $raw_material_group_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['delete_raw_material_group_id'])) {
        $delete_raw_material_group_id = $_REQUEST['delete_raw_material_group_id'];
        $msg = "";
        if(!empty($delete_raw_material_group_id)) {
            $raw_material_group_unique_id = "";
            $raw_material_group_unique_id = $obj->getTableColumnValue($GLOBALS['raw_material_group_table'], 'raw_material_group_id', $delete_raw_material_group_id, 'id');
            if(preg_match("/^\d+$/", $raw_material_group_unique_id)) {
                $raw_material_group_name = "";
                $raw_material_group_name = $obj->getTableColumnValue($GLOBALS['raw_material_group_table'], 'raw_material_group_id', $delete_raw_material_group_id, 'raw_material_group_name');

                $action = "";
                if(!empty($raw_material_group_name)) {
                    $action = "Raw Material Group Deleted. Name - " . $obj->encode_decode('decrypt', $raw_material_group_name);
                }
                $linked_count = 0;
                $linked_count = $obj->GetRawMaterialGroupLinkedCount($delete_raw_material_group_id);
                if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['raw_material_group_table'], $raw_material_group_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Raw Material Group is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }
?>