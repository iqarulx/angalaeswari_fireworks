<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['contractor_module'];
        }
    }

    if(isset($_REQUEST['show_contractor_id'])) { 

        $show_contractor_id = $_REQUEST['show_contractor_id'];
        $contractor_name = $location = $mobile = $opening_balance = $opening_balance_type = "";
        $product_id = $unit_id = $subunit_id = $unit_name = $subunit_name = $unit_type = $quantity = $rate = array();
        if(!empty($show_contractor_id)) {
            $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], 'contractor_id', $show_contractor_id, '');
            $contractor_product_list = $obj->getContractorProductTable($show_contractor_id);
            if(!empty($contractor_list)) {
                foreach($contractor_list as $con_list) {
                    if(!empty($con_list['contractor_name'])) {
                        $contractor_name = $obj->encode_decode('decrypt', $con_list['contractor_name']);
                    }
                    if(!empty($con_list['location'])) {
                        $location = $obj->encode_decode('decrypt', $con_list['location']);
                    }
                    if(!empty($con_list['mobile'])) {
                        $mobile = $obj->encode_decode('decrypt', $con_list['mobile']);
                    }
                    if(!empty($con_list['opening_balance']) && $con_list['opening_balance'] != $GLOBALS['null_value']) {
                        $opening_balance =  $con_list['opening_balance'];
                    }
                    if(!empty($con_list['opening_balance_type']) && $con_list['opening_balance_type'] != $GLOBALS['null_value']) {
                        $opening_balance_type =  $con_list['opening_balance_type'];
                    }
                }
            }
        }
        // $product_list = $obj->getProductWithGroup('semi finished', 'finished', '');
        $rawmaterial_group_name = "raw material";
        $rawmaterial_group_name = $obj->encode_decode('encrypt', $rawmaterial_group_name);
        $rawmaterial_group_id = "";
        if(!empty($rawmaterial_group_name)){
            $rawmaterial_group_id = $obj->getTableColumnValue($GLOBALS['group_table'],'lower_case_name',$rawmaterial_group_name,'group_id');
        }
        $product_list = $obj->GetFinishedSemiFinishedProductList($rawmaterial_group_id);

        $linked_contractor = 0;
        if(!empty($show_contractor_id)){
             $linked_contractor = $obj->linkedContractor($show_contractor_id);
        }
        ?>
        <form class="poppins pd-20" name="contractor_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
                    <div class="col-lg-8 col-md-8 col-8 align-self-center">
                            <?php if(!empty($show_contractor_id)){ ?>
                                <div class="h5">Edit Contractor</div>
                                <?php
                            }else{ ?>
                                <div class="h5">Add Contractor</div>
                                <?php
                            } ?>
                        </div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('contractor.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_contractor_id)) { echo $show_contractor_id; } ?>">
                <div class="col-lg-3 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="contractor_name" name="contractor_name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" value="<?php if(!empty($contractor_name)) { echo  $contractor_name; } ?>">
                            <label>Contractor Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile" name="mobile" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',10,'');" value="<?php if(!empty($mobile)) { echo  $mobile; } ?>">
                            <label>Phone Number</label>
                             <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" id="location" name="location" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');" value="<?php if(!empty($location)) { echo  $location; } ?>">
                            <label>Location</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" value="<?php if(!empty($opening_balance)) { echo  (float)$opening_balance; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',7,'');" <?php if(!empty($linked_contractor)){ ?> readonly <?php } ?>>
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                    <select name="opening_balance_type" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($linked_contractor)){ ?> disabled <?php } ?>>
                                        <option value="Credit" <?php if($opening_balance_type == 'Credit') { echo "selected"; } ?>>Credit</option>
                                        <option value="Debit" <?php if($opening_balance_type == 'Debit') { echo "selected"; } ?>>Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($linked_contractor)){ ?>
                <input type="hidden" name="opening_balance_type" value="<?php if(!empty($opening_balance_type)){ echo $opening_balance_type; } ?>">
                <?php 
               } ?>
            <div class="row justify-content-center p-3">
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="product" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="GetContractorProdetails();">
                                <option value="">Select Product</option>
                                <?php if (!empty($product_list)) {
                                    foreach ($product_list as $Pro_list) { ?>
                                        <option value="<?php if (!empty($Pro_list['product_id'])) {
                                            echo $Pro_list['product_id'];
                                        } ?>">
                                            <?php if (!empty($Pro_list['product_name'])) {
                                                echo $obj->encode_decode('decrypt', $Pro_list['product_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Product</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_unit_type" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Type</option>    
                                <option value="1">Unit</option>
                                <option value="2">Sub Unit</option>
                            </select>
                            <label>Type</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_quantity" class="form-control shadow-none" required="">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control shadow-none" name="selected_rate">
                            <label>Rate</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-12 py-2 px-lg-1 text-center">
                    <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddContractorProducts();">
                        Add
                    </button>
                </div> 
            </div>
            <div class="row justify-content-center"> 
                <div class="col-lg-8">
                    <div class="table-responsive text-center">
                    <input type="hidden" name="product_count" value="<?php if (!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
                        <table class="table nowrap cursor smallfnt table-bordered product_constractor_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th >#</th>
                                    <th style="width: 150px;">Product</th>
                                    <th style="width: 150px;">Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   if(!empty($contractor_product_list)) {
                                    $i =1;
                                    foreach($contractor_product_list as $con_product_list) { ?>
                                            <tr class="product_row" id="product_row<?php echo $i; ?>">
                                                <td class="sno text-center px-2 py-2"><?php echo $i; ?></td>

                                                <td class="text-center px-2 py-2">
                                                    <?php
                                                        if(!empty($con_product_list['product_name'])) {
                                                            echo $obj->encode_decode('decrypt', $con_product_list['product_name']);
                                                        }
                                                    ?>
                                                    <input type="hidden" name="product_id[]" id="product_id_<?php echo $i;?>" value="<?php echo $con_product_list['product_id']; ?>">
                                                </td>

                                                <td class="text-center px-2 py-2">
                                                    <?php
                                                     if(($con_product_list['unit_type'] == '1') ){
                                                        if( $con_product_list['unit_name'] != $GLOBALS['null_value']) { 
                                                            echo $obj->encode_decode('decrypt', $con_product_list['unit_name']);
                                                        }
                                                    } else { 
                                                        if(!empty($con_product_list['subunit_name']) && $con_product_list['subunit_name'] != $GLOBALS['null_value']) { 
                                                            echo $obj->encode_decode('decrypt', $con_product_list['subunit_name']); 
                                                        } 
                                                    }
                                                    ?>
                                                    <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $i;?>" value="<?php if(!empty($con_product_list['unit_id']) && $con_product_list['unit_id'] != $GLOBALS['null_value']) { echo $con_product_list['unit_id']; } ?>">
                                                    <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $i;?>" value="<?php if(!empty($con_product_list['unit_name']) && $con_product_list['unit_name'] != $GLOBALS['null_value']) { echo $con_product_list['unit_name']; } ?>">
                                                    <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $i;?>" value="<?php if(!empty($con_product_list['subunit_id']) && $con_product_list['subunit_id'] != $GLOBALS['null_value']) { echo $con_product_list['subunit_id']; } ?>">
                                                    <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $i;?>" value="<?php if(!empty($con_product_list['subunit_name']) && $con_product_list['subunit_name'] != $GLOBALS['null_value']) { echo $con_product_list['subunit_name']; } ?>">
                                                    <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $i;?>" value="<?php if(!empty($con_product_list['unit_type']) && $con_product_list['unit_type'] != $GLOBALS['null_value']) { echo $con_product_list['unit_type']; } ?>">
                                                </td>

                                                <td class="text-center px-2 py-2">
                                                    <input type="text" name="quantity[]" id="quantity_<?php echo $i;?>" class="form-control shadow-none" value="<?php echo $con_product_list['quantity']; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                                                </td>

                                                <td class="text-center px-2 py-2">
                                                    <input type="text" name="rate[]" id="rate_<?php echo $i;?>" class="form-control shadow-none" value="<?php echo $con_product_list['rate']; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalculateTotalRate();">
                                                </td>

                                                <td class="text-center px-2 py-2">
                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $i; ?>', 'product_row');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $i++; }
                                    } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align: right;">Total:</td>
                                    <td colspan="2" id="total_rate_td"></td>
                                </tr>
                            </tfoot>
                            <input type="hidden" name="total_rate" id="total_rate" class="form-control shadow-none">
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <div class="col-md-12 pt-3 text-center">
                        <button class="btn btn-dark " type="button"  onClick="Javascript:SaveModalContent(event,'contractor_form', 'contractor_changes.php', 'contractor.php');">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/creation_modules.js"></script>
            <script type="text/javascript" src="include/js/action.js"></script>
            <script>
                $(document).ready(function() {
                   <?php if(!empty($show_contractor_id)) { ?>
                        CalculateTotalRate();
                    <?php } ?>
                });
            </script>
        </form>
		<?php
    } 

    if(isset($_POST['edit_id'])) {
        $edit_id = ""; $contractor_name = $location = $mobile = $open_balance = $open_balance_type = $valid_contractor = ""; $product_error = ""; $contractor_id = "";
        $form_name = "contractor_form"; $product_id = array(); $unit_id = array(); $subunit_id = array(); $unit_name = array(); $subunit_name = array(); $unit_type = array(); $quantity = array(); $rate = array();$contractor_details = "";
        $result = ""; $update_payment = 0;
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $contractor_id = $edit_id;
        }
        
        if(isset($_POST['contractor_name'])) {
            $contractor_name = $_POST['contractor_name'];
            $contractor_name = trim($contractor_name);
            $contractor_name_error = $valid->valid_product_name($contractor_name, 'contractor Name', '1', '25');
            if (!empty($contractor_name_error)) {
                if (!empty($valid_contractor)) {
                    $valid_contractor = $valid_contractor . " " . $valid->error_display($form_name, 'contractor_name', $contractor_name_error, 'text');
                } else {
                    $valid_contractor = $valid->error_display($form_name, 'contractor_name', $contractor_name_error, 'text');
                }
            }
        }

        if(isset($_POST['mobile'])) {
            $mobile = $_POST['mobile'];
            $mobile = trim($mobile);
            $mobile_error = $valid->valid_mobile_number($mobile, "Mobile", "0");
            if(!empty($mobile_error)) {
                if(!empty($valid_contractor)) {
                    $valid_contractor = $valid_contractor." ".$valid->error_display($form_name, "mobile", $mobile_error, 'text');
                }
                else {
                    $valid_contractor = $valid->error_display($form_name, "mobile", $mobile_error, 'text');
                }
            }
        }

        if(isset($_POST['location'])) {
            $location = $_POST['location'];
            $location = trim($location);
            if(strlen($location) > 150) {
                $location_error = "Only 150 characters allowed";
            }
            else {
                $location_error = $valid->valid_address($location, "location", "1");   
            }
        }  
        if(!empty($location_error)) {
            if(!empty($valid_contractor)) {
                $valid_contractor = $valid_contractor." ".$valid->error_display($form_name, "location", $location_error, 'text');
            }
            else {
                $valid_contractor = $valid->error_display($form_name, "location", $location_error, 'text');
            }
        }  

        if(isset($_POST['opening_balance'])){
			$opening_balance = $_POST['opening_balance'];
			if(!empty($opening_balance)) {
				$opening_balance_error = $valid->valid_number($opening_balance, "opening_balance", "0");
				if(!empty($opening_balance_error)) {
					if(!empty($valid_contractor)) {
						$valid_contractor = $valid_contractor." ".$valid->error_display($form_name, "opening_balance", $opening_balance_error, 'text');
					}
					else {
						$valid_contractor = $valid->error_display($form_name, "opening_balance", $opening_balance_error, 'text');
					}
				}
			} 
		}
        if(isset($_POST['opening_balance_type'])) {
            $opening_balance_type = $_POST['opening_balance_type'];
        }

        if(isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
        }
        if(isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
        }
        if(isset($_POST['subunit_id'])) {
            $subunit_id = $_POST['subunit_id'];
        }
        if(isset($_POST['unit_name'])) {
            $unit_name = $_POST['unit_name'];
        }
        if(isset($_POST['subunit_name'])) {
            $subunit_name = $_POST['subunit_name'];
        }
        if(isset($_POST['unit_type'])) {
            $unit_type = $_POST['unit_type'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['rate'])) {
            $rate = $_POST['rate'];
        }
        $total_rate = 0; $group_id = array();
        if(!empty($product_id) && count($product_id) > 0) {
            if(empty($edit_id)) {
                $product_id = array_reverse($product_id);
                $unit_id = array_reverse($unit_id);
                $unit_name = array_reverse($unit_name);
                $subunit_id = array_reverse($subunit_id);
                $subunit_name = array_reverse($subunit_name);
                $unit_type = array_reverse($unit_type);
                $quantity = array_reverse($quantity);
                $rate = array_reverse($rate);
            }
            for($i = 0; $i < count($product_id); $i++) {
                $product_id[$i] = trim($product_id[$i]);
                $unit_id[$i] = trim($unit_id[$i]);
                if($subunit_id[$i] == "") {
                    $subunit_id[$i] = $GLOBALS['null_value'];
                } else {
                    $subunit_id[$i] = trim($subunit_id[$i]);
                }
                $unit_name[$i] = trim($unit_name[$i]);
                if($subunit_name[$i] == "") {
                    $subunit_name[$i] = $GLOBALS['null_value'];
                } else {
                    $subunit_name[$i] = trim($subunit_name[$i]);
                }
                $unit_type[$i] = trim($unit_type[$i]);
                $quantity[$i] = trim($quantity[$i]);
                $rate[$i] = trim($rate[$i]);

                if(!empty($edit_id)){
                    $contractor_product_unique_ids[$i] = $obj->getContractorProductUniqueIds($edit_id, $product_id[$i], $unit_type[$i]);
                }
                if(empty($quantity[$i]) || $quantity[$i] == 0) {
                    $quantity_error = "";
                    $quantity_error = $valid->common_validation($quantity[$i], 'quantity', 'text');
                    if(!empty($quantity_error)) {
                        if(!empty($valid_contractor)) {
                            $valid_contractor = $valid_contractor." ".$valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_contractor = $valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                    }
                }

                if(empty($rate[$i]) || $rate[$i] == 0) {
                    $rate_error = "";
                    $rate_error = $valid->common_validation($rate[$i], 'rate', 'text');
                    if(!empty($rate_error)) {
                        if(!empty($valid_contractor)) {
                            $valid_contractor = $valid_contractor." ".$valid->row_error_display($form_name, 'rate[]', $rate_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_contractor = $valid->row_error_display($form_name, 'rate[]', $rate_error, 'text', 'product_row', ($i+1));
                        }
                    }
                } else {
                    $total_rate += $rate[$i];
                }
                
            }
            if(empty($edit_id)) {
                $product_id = array_reverse($product_id);
                $unit_id = array_reverse($unit_id);
                $unit_name = array_reverse($unit_name);
                $subunit_id = array_reverse($subunit_id);
                $subunit_name = array_reverse($subunit_name);
                $unit_type = array_reverse($unit_type);
                $quantity = array_reverse($quantity);
                $rate = array_reverse($rate);
            }

        } else {
            $product_error = "Please select product and its details";
        }
        if (!empty($edit_id) && empty($product_error)) {
            $prev_product_list = array();
            $prev_product_list = $obj->getTableRecords($GLOBALS['contractor_product_table'],'contractor_id', $edit_id, '');

            if (!empty($prev_product_list)) {
                foreach ($prev_product_list as $data) {
                     $prev_id = "";  $prev_product_id = "";
                    if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $prev_product_id = $data['product_id'];
                    }
                    if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $prev_id = $data['id'];
                    }
             
                    if (!in_array($prev_id, $contractor_product_unique_ids)) {
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $update_id = $obj->UpdateSQL($GLOBALS['contractor_product_table'], $prev_id, $columns, $values, '');
                    }
                }
            }
        }
    

        if(empty($valid_contractor) && empty($product_error)) {
            $check_user_id_ip_address = ""; $name_location = ""; $lowercase_name_location = "";
            $check_user_id_ip_address = $obj->check_user_id_ip_address();

            if (preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $lower_case_name = "";
                $name_mobile_city = "";
                if (!empty($contractor_name)) {
                    $name_mobile_city = $contractor_name;        
                    $contractor_details = $name_mobile_city;
                    $name_location = $contractor_name;

                    $lower_case_name = strtolower($contractor_name);
                    $contractor_name = $obj->encode_decode('encrypt', $contractor_name);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                } else {
                    $contractor_name = $GLOBALS['null_value'];
                    $lower_case_name = $GLOBALS['null_value'];
                }
                if(!empty($mobile)) {
                    if(!empty($name_mobile_city)) {
                        $name_mobile_city = $name_mobile_city." (".$mobile.")";                       
                    }
                    if(!empty($contractor_details)) {
                        $contractor_details = $contractor_details."$$$". $mobile;
                    }
                    $mobile = $obj->encode_decode('encrypt', $mobile);
                } else {
                    $mobile = $GLOBALS['null_value'];
                }
                if(!empty($location)) {
                    if(!empty($name_mobile_city)) {
                        $name_mobile_city = $name_mobile_city." (".$location.")";                       
                    }
                    if(!empty($name_location)) {
                        $name_location = $name_location." - ".$location;
                        $lowercase_name_location = strtolower($name_location); 
                    }
                    if(!empty($contractor_details)) {
                        $contractor_details = $contractor_details."$$$". $location;
                    }
                    $location = $obj->encode_decode('encrypt', $location);
                } else {
                    $location = $GLOBALS['null_value'];
                }
                
                if(!empty($contractor_details)) {
                    $contractor_details = $obj->encode_decode('encrypt', $contractor_details);
                }
                if(!empty($lowercase_name_location)) {
                    $lowercase_name_location = $obj->encode_decode('encrypt', $lowercase_name_location);
                }
                if(!empty($name_mobile_city)) {
                    $name_mobile_city = $obj->encode_decode('encrypt',$name_mobile_city);                       
                }
                if(empty($opening_balance)) {
                    $opening_balance = $GLOBALS['null_value'];
                }
                if(empty($opening_balance_type)) {
                    $opening_balance_type = $GLOBALS['null_value'];
                }

                $prev_contractor_id = ""; $prev_mbl_contractor_id = ""; $prev_contractor_name = ""; $contractor_mbl_error = "";
                $contractor_error = "";
                // if (!empty($lower_case_name)) {
                //     $prev_contractor_id = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'lower_case_name', $lower_case_name, 'contractor_id');
                //     if (!empty($prev_contractor_id)) {
                //         $contractor_error = "This contractor name already exists";
                //     }
                
                if(!empty($lowercase_name_location)) {
                    $prev_contractor_id = $obj ->CheckContractorAlreadyExist($lowercase_name_location);
                    if(!empty($prev_contractor_id)) {
                        $contractor_error = "This Contractor already exists";
                    }
                }

                if(!empty($mobile)) {
                    $prev_mbl_contractor_id = $obj ->CheckContractorMobileNoAlreadyExist($mobile);
                    if(!empty($prev_mbl_contractor_id)) {
                            $prev_contractor_name = $obj->getTableColumnValue($GLOBALS['contractor_table'],'contractor_id',$prev_mbl_contractor_id,'contractor_name');
						    $prev_contractor_name = $obj->encode_decode("decrypt",$prev_contractor_name);
                        $contractor_mbl_error =  "This mobile number is already exist in ".$prev_contractor_name;
                    }
                }


                $bill_company_id = $GLOBALS['bill_company_id'];
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if (empty($edit_id)) {
                    if (empty($prev_contractor_id) && empty($prev_mbl_contractor_id)) {
                        $action = "";
                        if (!empty($contractor_name)) {
                            $action = "New contractor Created - " . $obj->encode_decode("decrypt", $contractor_name);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'contractor_id', 'contractor_name', 'lower_case_name','mobile', 'location', 'name_mobile_city', 'opening_balance', 'opening_balance_type', 'contractor_details', 'lowercase_name_location','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$contractor_name."'", "'".$lower_case_name."'", "'".$mobile."'", "'".$location."'",  "'".$name_mobile_city."'",  "'".$opening_balance."'",  "'".$opening_balance_type."'", "'".$contractor_details."'", "'".$lowercase_name_location."'","'0'");
                        $contractor_insert_id = $obj->InsertSQL($GLOBALS['contractor_table'], $columns, $values, 'contractor_id', '', $action);
                        if (preg_match("/^\d+$/", $contractor_insert_id)) {
                            $contractor_id = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'id', $contractor_insert_id, 'contractor_id');

                            if(!empty($contractor_id)) {
                                for($i = 0; $i < count($product_id); $i++) {

                                    if(empty($product_id[$i])) {
                                        $product_id = $GLOBALS['null_value'];
                                    }
                                    if(empty($unit_id[$i])) {
                                        $unit_id = $GLOBALS['null_value'];
                                    }
                                    if(empty($unit_name[$i])) {
                                        $unit_name = $GLOBALS['null_value'];
                                    }
                                    if(empty($subunit_id[$i])) {
                                        $subunit_id = $GLOBALS['null_value'];
                                    }
                                    if(empty($subunit_name[$i])) {
                                        $subunit_name = $GLOBALS['null_value'];
                                    }
                                    if(empty($unit_type[$i])) {
                                        $unit_type = $GLOBALS['null_value'];
                                    }
                                    if(empty($quantity[$i])) {
                                        $quantity = $GLOBALS['null_value'];
                                    }
                                    if(empty($rate[$i])) {
                                        $rate = $GLOBALS['null_value'];
                                    }

                                    $rate_per_unit = 0; $rate_per_subunit = 0; 
                                    if($unit_type[$i] == 1){
                                        $rate_per_unit = $rate[$i] / $quantity[$i];
                                    }else if($unit_type[$i] == 2){
                                        $rate_per_subunit = $rate[$i] / $quantity[$i];
                                    }
                                    if(!empty($rate_per_unit)) { 
                                        $rate_per_unit = number_format($rate_per_unit,2); 
                                        $rate_per_unit = trim(str_replace(",", "", $rate_per_unit));
                                    }
                                    if(!empty($rate_per_subunit)) { 
                                        $rate_per_subunit = number_format($rate_per_subunit,2); 
                                        $rate_per_subunit = trim(str_replace(",", "", $rate_per_subunit));
                                    }

                                    $group_id = "";
                                    $group_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id[$i],'group_id');
                                
                                    $column = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'contractor_id', 'product_id', 'group_id','unit_id', 'subunit_id', 'unit_name', 'subunit_name', 'unit_type', 'quantity', 'rate', 'rate_per_unit', 'rate_per_subunit','deleted');
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$contractor_id."'", "'".$product_id[$i]."'", "'".$group_id."'", "'".$unit_id[$i]."'", "'".$subunit_id[$i]."'", "'".$unit_name[$i]."'", "'".$subunit_name[$i]."'", "'".$unit_type[$i]."'", "'".$quantity[$i]."'", "'".$rate[$i]."'", "'".$rate_per_unit."'", "'".$rate_per_subunit."'","'0'");
                                    $contractor_product_insert_id = $obj->InsertSQL($GLOBALS['contractor_product_table'], $column, $values, '', '', $action);
                                }
                            }
                            if (preg_match("/^\d+$/", $contractor_product_insert_id)) {
                                $update_payment = 1;
                                $result = array('number' => '1', 'msg' => 'contractor Successfully Created');
                            }
                        } else {
                            $result = array('number' => '2', 'msg' => $contractor_insert_id);
                        }
                    } else {
                        if (!empty($contractor_error)) {
                            $result = array('number' => '2', 'msg' => $contractor_error);
                        }else if(!empty($contractor_mbl_error)) {
                            $result = array('number' => '2', 'msg' => $contractor_mbl_error);
                        }
                    }
                } else {
                    if(empty($prev_contractor_id) || $prev_contractor_id == $edit_id) {
                        if(empty($prev_mbl_contractor_id) || $prev_mbl_contractor_id == $edit_id){

                            $getUniqueID = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $edit_id, 'id');
                            if(preg_match("/^\d+$/", $getUniqueID)) {
                                $action = "";
                                if(!empty($name_mobile_city)) {
                                    $action = "contractor Updated. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                                }
                            
                                $columns = array(); $values = array();			
                                $columns = array('contractor_name', 'lower_case_name','mobile', 'location', 'name_mobile_city', 'opening_balance', 'opening_balance_type', 'contractor_details', 'lowercase_name_location','deleted');	
                                $values = array("'".$contractor_name."'", "'".$lower_case_name."'", "'".$mobile."'", "'".$location."'", "'".$name_mobile_city."'", "'".$opening_balance."'", "'".$opening_balance_type."'", "'".$contractor_details."'", "'".$lowercase_name_location."'","'0'");

                                $contractor_update_id = $obj->UpdateSQL($GLOBALS['contractor_table'], $getUniqueID, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $contractor_update_id)) {	
                                    for($i = 0; $i < count($product_id); $i++) {

                                        if(empty($product_id[$i])) {
                                            $product_id = $GLOBALS['null_value'];
                                        }
                                        if(empty($unit_id[$i])) {
                                            $unit_id = $GLOBALS['null_value'];
                                        }
                                        if(empty($unit_name[$i])) {
                                            $unit_name = $GLOBALS['null_value'];
                                        }
                                        if(empty($subunit_id[$i])) {
                                            $subunit_id = $GLOBALS['null_value'];
                                        }
                                        if(empty($subunit_name[$i])) {
                                            $subunit_name = $GLOBALS['null_value'];
                                        }
                                        if(empty($unit_type[$i])) {
                                            $unit_type = $GLOBALS['null_value'];
                                        }
                                        if(empty($quantity[$i])) {
                                            $quantity = $GLOBALS['null_value'];
                                        }
                                        if(empty($rate[$i])) {
                                            $rate = $GLOBALS['null_value'];
                                        }
                                        $getUniqueID = $obj->getContractorKuliId( $edit_id, $product_id[$i], $unit_type[$i]);
                                        $rate_per_unit = 0; $rate_per_subunit = 0; 
                                        if($unit_type[$i] == 1){
                                            $rate_per_unit = $rate[$i] / $quantity[$i];
                                        }else if($unit_type[$i] == 2){
                                            $rate_per_subunit = $rate[$i] / $quantity[$i];
                                        }
                                        $group_id = "";
                                        $group_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id[$i],'group_id');

                                        if(empty($getUniqueID)) {
                                            $column = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'contractor_id', 'product_id', 'group_id','unit_id', 'subunit_id', 'unit_name', 'subunit_name', 'unit_type', 'quantity', 'rate',  'rate_per_unit', 'rate_per_subunit','deleted');
                                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$edit_id."'", "'".$product_id[$i]."'", "'".$group_id."'", "'".$unit_id[$i]."'", "'".$subunit_id[$i]."'", "'".$unit_name[$i]."'", "'".$subunit_name[$i]."'", "'".$unit_type[$i]."'", "'".$quantity[$i]."'", "'".$rate[$i]."'", "'".$rate_per_unit."'", "'".$rate_per_subunit."'","'0'");
                                            $contractor_product_update_id = $obj->InsertSQL($GLOBALS['contractor_product_table'], $column, $values, '', '', $action);
                                        } else {
                                            $columns = array('product_id', 'group_id','unit_id', 'subunit_id', 'unit_name', 'subunit_name', 'unit_type', 'quantity', 'rate', 'rate_per_unit', 'rate_per_subunit', 'deleted');

                                            $values = array("'" . $product_id[$i] . "'", "'".$group_id."'","'" . $unit_id[$i] . "'", "'" . $subunit_id[$i] . "'","'" . $unit_name[$i] . "'", "'" . $subunit_name[$i] . "'", "'" . $unit_type[$i] . "'", "'" . $quantity[$i] . "'", "'" . $rate[$i] . "'", "'".$rate_per_unit."'", "'".$rate_per_subunit."'","'0'"
                                            );
                                            $contractor_product_update_id = $obj->UpdateSQL($GLOBALS['contractor_product_table'], $getUniqueID, $columns, $values, $action);
                                        }
                                    }
                                    if(preg_match("/^\d+$/", $contractor_product_update_id)) {	
                                        $update_payment = 1;
                                        $result = array('number' => '1', 'msg' => 'Updated Successfully');
                                    }	
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $contractor_update_id);
                                }	
                            }
                        }else {
                            if(!empty($contractor_mbl_error)) {
                                $result = array('number' => '2', 'msg' => $contractor_mbl_error);
                            }
                        }
                    }else{
                        if (!empty($contractor_error)) {
                            $result = array('number' => '2', 'msg' => $contractor_error);
                        }
                    }
                }

                if ($update_payment == 1) {
                    $bill_date = date("Y-m-d");
                    $bill_number = $GLOBALS['null_value'];
                    $bill_type = "Contractor Opening Balance";
                    $party_id = $contractor_id;
                    $party_name = $contractor_name;
                    $party_type = "Contractor";
                    $payment_mode_id = $GLOBALS['null_value'];
                    $payment_mode_name = $GLOBALS['null_value'];
                    $bank_id = $GLOBALS['null_value'];
                    $bank_name = $GLOBALS['null_value'];
                    $credit  = 0; $debit = 0; 
                    $balance_type = $GLOBALS['null_value'];
                    if($opening_balance_type =='Credit'){
                        $credit  = $opening_balance; 
                        $balance_type = 'Credit';
                    }else if($opening_balance_type =='Debit'){
                        $debit  = $opening_balance; 
                        $balance_type = 'Debit';
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
                    if(!empty($opening_balance) && $opening_balance != $GLOBALS['null_value'] && !empty($opening_balance_type) && $open_balance_type != $GLOBALS['null_value']){

                        $update_balance ="";
                        $update_balance = $obj->UpdateBalance($contractor_id,$bill_number,$bill_date,$bill_type,$GLOBALS['null_value'],$GLOBALS['null_value'], $party_id,$party_name,$party_type,$payment_mode_id, $payment_mode_name, $bank_id, $bank_name, $credit,$debit,$balance_type);
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
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }

        } else {
            if (!empty($valid_contractor)) {
                $result = array('number' => '3', 'msg' => $valid_contractor);
            } else if (!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
        }

        
        if (!empty($result)) {
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
		}

        $total_records_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '', 'DESC');

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
                    <tr>
                        <th>S.No</th>
                        <th>Contractor Name</th>
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
                                        <?php  echo $index; ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['name_mobile_city'])) {
                                                $data['name_mobile_city'] = $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                echo $data['name_mobile_city'];
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
                                                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-dark show-button">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <?php 
                                                      
                                                        if(empty($edit_access_error)) {
                                                    ?> 
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                    <?php } ?>
                                                        <?php 
                                                           
                                                            if(empty($delete_access_error)) {
                                                                $linked_count = 0;
                                                                $linked_count = $obj->GetContractorLinkedCount($data['contractor_id']); 
                                                    if($linked_count > 0) {
                                                        ?>                             
                                                    <li><a class="dropdown-item text-secondary" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                    <?php 
                                                        }
                                                        else {
                                                    ?>
                                                    <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                                
                                                    <?php 
                                                            }
                                                        } 
                                                    ?>
                                                </ul>
                                            </div> 
                                        <?php } ?>
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

    if(isset($_REQUEST['delete_contractor_id'])) {
        $delete_contractor_id = $_REQUEST['delete_contractor_id'];
        $delete_contractor_id = trim($delete_contractor_id);
        $msg = "";
        if(!empty($delete_contractor_id)) {	
            $contractor_product_unique_id = "";
            $contractor_unique_id = "";
            $contractor_unique_id = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $delete_contractor_id, 'id');
            if(preg_match("/^\d+$/", $contractor_unique_id)) {
                $name_mobile_city = "";
                $name_mobile_city = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $delete_contractor_id, 'name_mobile_city');
            
                $action = "";
                if(!empty($name_mobile_city)) {
                    $action = "contractor Deleted. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                }
                    $delete_id = $obj->DeletePayment($delete_contractor_id);	
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['contractor_table'], $contractor_unique_id, $columns, $values, $action);
                    $delet_kuli = $obj->DeleteContractorKuli($delete_contractor_id);
                
            }
            else {
                $msg = "Invalid contractor";
            }
        }
        else {
            $msg = "Empty contractor";
        }
        echo $msg;
        exit;	
    }
    ?>