<?php
	include("include_files.php");
	if(isset($_REQUEST['show_consumption_entry_id'])) { 
        $show_consumption_entry_id = $_REQUEST['show_consumption_entry_id'];
        $godown_id = array(); $product_id = array(); $unit_type = array(); $quantity = array(); $contractor_id = "";
       if(!empty($show_consumption_entry_id)) {
            $show_consumption_entry_list = $obj->getTableRecords($GLOBALS['consumption_entry_table'], 'consumption_id', $show_consumption_entry_id, '');
            if(!empty($show_consumption_entry_list)) {
                foreach($show_consumption_entry_list as $consumption_entry) {
                    if(!empty($consumption_entry['contractor_id'])) {
                        $contractor_id = $consumption_entry['contractor_id'];
                    }
                    if(!empty($consumption_entry['godown_id'])) {
                        $godown_id = explode(",", $consumption_entry['godown_id']);
                    }
                    if(!empty($consumption_entry['product_id'])) {
                        $product_id = explode(",", $consumption_entry['product_id']);
                    }
                    if(!empty($consumption_entry['unit_type'])) {
                        $unit_type = explode(",", $consumption_entry['unit_type']);
                    }
                    if(!empty($consumption_entry['quantity'])) {
                        $quantity = explode(",", $consumption_entry['quantity']);
                    }
                }
            }
        }
        $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], "", "", "");
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], "", "", "");
        $product_list = $obj->getProductWithGroup('semi finished', 'finished', '');
        ?>
        <form class="poppins pd-20" name="consumption_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_consumption_entry_id)){ ?>
                            <div class="h5">Edit consumption</div>
                            <?php
                        }else{ ?>
                            <div class="h5">Add consumption</div>
                            <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('consumption_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_consumption_entry_id)) { echo $show_consumption_entry_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger <?php if(!empty($show_consumption_entry_id)) { echo 'Product_Fix_field'; } ?>" name="contractor" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_consumption_entry_id)) { echo "disabled"; } ?>>
                                        <option value="">Select Contractor</option>
                                        <?php if(!empty($contractor_list)) {
                                            foreach($contractor_list as $contractor) { ?>
                                                <option value="<?php echo $contractor['contractor_id']; ?>" <?php if(!empty($contractor_id) && $contractor_id == $contractor['contractor_id']) { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $contractor['contractor_name']); ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <label>Select Contractor<span class="text-danger">*</span></label>
                                </div>
                            </div>       
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="godown" onchange="GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Godown</option>
                                        <?php if(!empty($godown_list)) {
                                            foreach($godown_list as $godown) { ?>
                                                <option value="<?php echo $godown['godown_id']; ?>"><?php echo $obj->encode_decode('decrypt', $godown['godown_name']); ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <label>Select Godown</label>
                                </div>
                            </div>       
                        </div>
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="product" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="GetProdetails();GetStockLimit();">
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
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" name="selected_quantity" class="form-control shadow-none">
                                    <label>QTY</label>
                                </div>
                                <div class="new_smallfnt" id="qty_limit"></div>
                            </div> 
                        </div>
                        <input type="hidden" name="stock_limit" value="0">
                        <input type="hidden" name="stock_negative" value="0">
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_unit_type" onchange="GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Type</option>    
                                        <option value="1">Unit</option>
                                        <option value="2">Sub Unit</option>
                                    </select>
                                    <label>Type</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 d-none" id="contents_div">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_consumption_content" onchange="GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Contents</option>    
                                    </select>
                                    <label>Contents</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-2 col-12 py-2 px-lg-1 text-center">
                            <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddConsumptionProducts();">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-10">
                            <div class="table-responsive text-center">
                                <input type="hidden" name="product_count" value="<?php if (!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
                                <table class="table nowrap cursor smallfnt table-bordered product_consumption_table">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th>Godown</th>
                                            <th>Product Group</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(!empty($product_id)) {
                                                $product_row_index = 0;
                                                for($i = 0; $i < count($product_id); $i++) {
                                                    $product_row_index++;
                                                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id[$i], 'godown_name');
                                                    $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                                                    if(!empty($product_list)) {
                                                        foreach ($product_list as $P_list) {
                                                            if(!empty($P_list['group_id'])) {
                                                                $group_id = $P_list['group_id'];
                                                            }
                                                            if(!empty($P_list['group_name'])) {
                                                                $group_name = $P_list['group_name'];
                                                            }
                                                            if(!empty($P_list['product_name'])) {
                                                                $product_name = $P_list['product_name'];
                                                            }
                                                            if(!empty($P_list['unit_id'])) {
                                                                $unit_id = $P_list['unit_id'];
                                                            }
                                                            if(!empty($P_list['unit_name'])) {
                                                                $unit_name = $P_list['unit_name'];
                                                            }
                                                            if(!empty($P_list['subunit_id'])) {
                                                                $subunit_id = $P_list['subunit_id'];
                                                            }
                                                            if(!empty($P_list['subunit_name'])) {
                                                                $subunit_name = $P_list['subunit_name'];
                                                            }

                                                        }
                                                    } ?>
                                                    <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
                                                        <td class="sno text-center px-2 py-2"><?php echo $product_row_index; ?></td>
                                                
                                                        <td class="text-center px-2 py-2">
                                                            <?php
                                                            if ($godown_name != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $godown_name);
                                                            }
                                                            ?>
                                                            <input type="hidden" name="godown_id[]" id="godown_id_<?php echo $product_row_index;?>" value="<?php echo $godown_id[$i]; ?>">
                                                        </td>
                                                        <td class="text-center px-2 py-2">
                                                            <?php
                                                            if ($group_name != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $group_name);
                                                            }
                                                            ?>
                                                        </td>

                                                        <td class="text-center px-2 py-2">
                                                            <?php
                                                            if ($product_name != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $product_name);
                                                            }
                                                            ?>
                                                            <input type="hidden" name="product_id[]" id="product_id_<?php echo $product_row_index;?>" value="<?php echo $product_id[$i]; ?>">
                                                        </td>
                                                
                                                        <td class="text-center px-2 py-2">
                                                            <input type="text" name="quantity[]" id="quantity_<?php echo $product_row_index;?>" class="form-control shadow-none" value="<?php echo $quantity[$i]; ?>" onkeyup="CalculateTotalQuantity();" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                                                        </td>

                                                        <td class="text-center px-2 py-2">
                                                            <?php
                                                                echo ($unit_type[$i] == '1') ? $obj->encode_decode('decrypt', $unit_name) : $obj->encode_decode('decrypt', $subunit_name);
                                                            ?>
                                                            <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $product_row_index;?>" value="<?php echo $unit_id; ?>">
                                                            <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $product_row_index;?>" value="<?php echo $unit_name; ?>">
                                                            <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $product_row_index;?>" value="<?php echo $subunit_id; ?>">
                                                            <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $product_row_index;?>" value="<?php echo $subunit_name; ?>">
                                                            <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $product_row_index;?>" value="<?php echo $unit_type[$i]; ?>">
                                                        </td>

                                                        <td class="text-center px-2 py-2">
                                                            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $product_row_index; ?>', 'product_row');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr class="fw-bold">
                                            <td colspan="4" class="text-end">Total</td>
                                            <td id="total_qty_td">00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-dark " type="button" onClick="Formsubmit();">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>     
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/creation_modules.js"></script>
            <script type="text/javascript" src="include/js/action.js"></script>
            <script>
                $(document).ready(function() {
                   <?php if(!empty($show_consumption_entry_id)) { ?>
                        CalculateTotalQuantity();
                    <?php } ?>
                });
                function Formsubmit() {
                    if(jQuery('.Product_Fix_field').length > 0) {
                        jQuery('.Product_Fix_field').attr('disabled', false);
                    }
                    SaveModalContent(event,'consumption_form', 'consumption_entry_changes.php', 'consumption_entry.php')
                }
            </script>
        </form>
		<?php
    } 

    if(isset($_POST['edit_id'])) {
        $edit_id = ""; $contractor_id = ""; $form_name = "consumption_form"; $product_id = array(); $unit_type = array(); $quantity = array(); $result = ""; $update_stock = 0; $unit_sub = array();
        $consumption_id = ""; $stock_unique_ids = array(); $group_id = array(); $unit_id = array(); $subunit_id = array();
        $contractor_error = ""; $consumption_content = array();
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $consumption_id = $edit_id;
        }

        if(isset($_POST['contractor'])) {
            $contractor_id = $_POST['contractor'];
        }
        if(empty($contractor_id)) {
            $contractor_error = "Please select contractor.";
        }
        if (!empty($contractor_error)) {
            if (!empty($valid_consumption)) {
                $valid_consumption = $valid_consumption . " " . $valid->error_display($form_name, 'contractor', $contractor_error, 'select');
            } else {
                $valid_consumption = $valid->error_display($form_name, 'contractor', $contractor_error, 'select');
            }
        }

        if(isset($_POST['godown_id'])) {
            $godown_id = $_POST['godown_id'];
        }
        if(isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
        }
        if(isset($_POST['unit_type'])) {
            $unit_type = $_POST['unit_type'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['consumption_content'])) {
            $consumption_content = $_POST['consumption_content'];
        }
        $total_qty = 0;
        if(!empty($product_id) && count($product_id) > 0) {
            if(empty($edit_id)) {
                $godown_id = array_reverse($godown_id);
                $product_id = array_reverse($product_id);
                $unit_type = array_reverse($unit_type);
                $quantity = array_reverse($quantity);
                $consumption_content = array_reverse($consumption_content);
            }
            for($i = 0; $i < count($product_id); $i++) {
                $godown_id[$i] = trim($godown_id[$i]);
                $product_id[$i] = trim($product_id[$i]);
                $unit_type[$i] = trim($unit_type[$i]);
                $quantity[$i] = trim($quantity[$i]);
                $consumption_content[$i] = trim($consumption_content[$i]);
                $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                if(!empty($product_list)) {
                    foreach ($product_list as $P_list) {
                        if(!empty($P_list['group_id'])) {
                            $group_id[$i] = $P_list['group_id'];
                        }
                        if(!empty($P_list['unit_id'])) {
                            $unit_id[$i] = $P_list['unit_id'];
                        }
                        if(!empty($P_list['subunit_id'])) {
                            $subunit_id[$i] = $P_list['subunit_id'];
                        }
                    }
                }
                if($unit_type[$i] == '1') {
                    $unit_sub[$i] = $unit_id[$i];
                } else if($unit_type[$i] == '2') {
                    $unit_sub[$i] = $subunit_id[$i];
                }
                $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, $godown_id[$i], $GLOBALS['null_value'], $edit_id, $unit_sub[$i], '');
                if(empty($quantity[$i]) || $quantity[$i] == 0) {
                    $quantity_error = "";
                    $quantity_error = $valid->common_validation($quantity[$i], 'quantity', 'text');
                    if(!empty($quantity_error)) {
                        if(!empty($valid_consumption)) {
                            $valid_consumption = $valid_consumption." ".$valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_consumption = $valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                    } 
                } else {
                    $total_qty += $quantity[$i];
                }
            }
            if(empty($edit_id)) {
                $godown_id = array_reverse($godown_id);
                $product_id = array_reverse($product_id);
                $unit_type = array_reverse($unit_type);
                $quantity = array_reverse($quantity);
                $consumption_content = array_reverse($consumption_content);
            }

        } else {
            $product_error = "Please select product and its detials";
        }
        if (!empty($edit_id) && empty($product_error)) {
            $prev_stock_list = array();
            $prev_stock_list = $obj->PrevStockList($edit_id);
            if (!empty($prev_stock_list)) {
                foreach ($prev_stock_list as $data) {
                    $stock_id = "";
                    $stock_godown_id = "";
                    $stock_magazine_id = "";
                    $stock_product_id = "";
                    $stock_type = "";
                    $inward_unit = 0;
                    $inward_subunit = 0;
                    $outward_unit = 0;
                    $outward_subunit = 0;
                    $stock_case_contains = 0;
                    if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
                    }
                    if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $stock_godown_id = $data['godown_id'];
                    }
                    if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                        $stock_case_contains = $data['case_contains'];
                    }
                    if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_magazine_id = $data['magazine_id'];
                    }
                    if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $stock_product_id = $data['product_id'];
                    }
                    if (!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward_unit = $data['inward_unit'];
                    }
                    if (!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                        $inward_subunit = $data['inward_subunit'];
                    }
                    $current_stock_unit = 0;
                    $current_stock_subunit = 0;
                    $stock_table_unique_id = "";
                    $stock_unique_table = "";
                    if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                        $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                    } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                    }
                    $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);

                    if (!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                        $current_stock_unit = $current_stock_unit - $inward_unit;
                    } else {
                        $current_stock_unit = 0;
                    }
                    if (!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                        $current_stock_subunit = $current_stock_subunit - $inward_subunit;
                    } else {
                        $current_stock_subunit = $GLOBALS['null_value'];
                    }
    
                    if (!in_array($stock_id, $stock_unique_ids)) {
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
    
                        if (preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $stock_table_update_id = $obj->UpdateSQL($stock_unique_table, $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }

        if(empty($valid_consumption) && empty($product_error)) {
            $check_user_id_ip_address = "";
            $check_user_id_ip_address = $obj->check_user_id_ip_address();

            if (preg_match("/^\d+$/", $check_user_id_ip_address)) {
                if(!empty($godown_id)) {
                    $godown_id = implode(",", $godown_id);
                } else {
                    $godown_id = $GLOBALS['null_value'];
                }
                if(!empty($product_id)) {
                    $product_id = implode(",", $product_id);
                } else {
                    $product_id = $GLOBALS['null_value'];
                }
                if(!empty($quantity)) {
                    $quantity = implode(",", $quantity);
                } else {
                    $quantity = $GLOBALS['null_value'];
                }

                if(!empty($consumption_content)) {
                    $consumption_content = implode(",", $consumption_content);
                } else {
                    $consumption_content = $GLOBALS['null_value'];
                }

                if (!empty($unit_type)) {
                    $unit_type = implode(",", $unit_type);
                } else {
                    $unit_type = $GLOBALS['null_value'];
                }

                $bill_company_id = $GLOBALS['bill_company_id'];
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                if (empty($edit_id)) {
                    $action = "New consumption Created ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'consumption_id', 'contractor_id', 'product_id', 'godown_id', 'unit_type', 'quantity','contants', 'total_quantity', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$contractor_id."'", "'".$product_id."'", "'".$godown_id."'", "'".$unit_type."'", "'".$quantity."'", "'".$consumption_content."'", "'".$total_qty."'", "'0'");
                    $insert_id = $obj->InsertSQL($GLOBALS['consumption_entry_table'], $columns, $values, "consumption_id", "", $action);
                    if (preg_match("/^\d+$/", $insert_id)) {
                        $consumption_id = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'id', $insert_id, 'consumption_id');
                        $update_stock = 1;
                        $result = array('number' => '1', 'msg' => 'consumption Successfully Created');
                    } else {
                        $result = array('number' => '2', 'msg' => $insert_id);
                    }
                } else {
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'consumption_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "consumption Updated.";
                        $columns = array(); $values = array();	
                        $columns = array('product_id', 'godown_id', 'unit_type', 'quantity', 'total_quantity');
                        $values = array("'".$product_id."'", "'".$godown_id."'", "'".$unit_type."'", "'".$quantity."'", "'".$total_qty."'");
                        $consumption_update_id = $obj->UpdateSQL($GLOBALS['consumption_entry_table'], $getUniqueID, $columns, $values, $action);
                        if(preg_match("/^\d+$/", $consumption_update_id)) {
                            $update_stock = 1;	
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');
                        } else {
                            $result = array('number' => '2', 'msg' => $consumption_update_id);
                        }
                    }
                }
                if (!empty($update_stock) && $update_stock == 1) {
                    if (!empty($godown_id) && !empty($product_id) && !empty($unit_type) && !empty($quantity)) {
                        $product_id = explode(",", $product_id);
                        $unit_type = explode(",", $unit_type);
                        $quantity = explode(",", $quantity);
                        $consumption_content = explode(",", $consumption_content);
                        $godown_id = explode(",", $godown_id);
                        $remarks = $obj->encode_decode("encrypt", "Consumption Entry Stock");
                        for($i = 0; $i < count($product_id); $i++) {
                            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                            if(!empty($product_list)) {
                                foreach ($product_list as $P_list) {
                                    if(!empty($P_list['group_id'])) {
                                        $group_id = $P_list['group_id'];
                                    }
                                    if(!empty($P_list['unit_id'])) {
                                        $unit_id = $P_list['unit_id'];
                                    }
                                    if(!empty($P_list['subunit_id'])) {
                                        $subunit_id = $P_list['subunit_id'];
                                    }
                                }
                            }
                            if($unit_type[$i] == '1') {
                                $unit_sub = $unit_id;                                
                            } else if($unit_type[$i] == '2') {
                                $unit_sub = $subunit_id;
                            }

                            $stock_update_id = $obj->StockUpdate($GLOBALS['consumption_entry_table'], "Out", $consumption_id, '', $product_id[$i], $remarks, date('Y-m-d'), $godown_id[$i], $GLOBALS['null_value'], $unit_sub, $quantity[$i], $consumption_content[$i], $group_id, 1);
                        }
                    }
                }

            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if (!empty($valid_consumption)) {
                $result = array('number' => '3', 'msg' => $valid_consumption);
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

        $total_records_list = $obj->getConsumptionTableRecords();

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
            if(!empty($loginner_id)) {
                $permission_action = $view_action;
                include('permission_action.php');
            }
            if(empty($access_error)) {  ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>contractor Name</th>
                    <th>QTY</th>
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
                        <td class="ribbon-header" style="cursor:default;">
                            <?php 
                                if(!empty($data['total_quantity'])) {
                                    echo $data['total_quantity'];
                                }
                            ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <?php 
                                        $access_error = "";
                                        if(!empty($loginner_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($access_error)) {
                                    ?> 
                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['consumption_id'])) { echo $data['consumption_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                    <?php } ?>
                                        <?php 
                                            $access_error = "";
                                            if(!empty($loginner_id)) {
                                                $permission_action = $delete_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($access_error)) {
                                                $linked_count = 0;
                                                // $linked_count = $obj->GetconsumptionLinkedCount($data['consumption_id']); 
                                                if($linked_count > 0) {
                                        ?>                             
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                    <?php 
                                        }
                                        else {
                                    ?>
                                    <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['consumption_id'])) { echo $data['consumption_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                
                                    <?php 
                                            }
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

    if (isset($_REQUEST['delete_consumption_entry_id'])) {
        $delete_consumption_id = $_REQUEST['delete_consumption_entry_id'];
        $msg = "";
        if (!empty($delete_consumption_id)) {
            $consumption_unique_id = "";
            $consumption_unique_id = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'consumption_id', $delete_consumption_id, 'id');
            if (preg_match("/^\d+$/", $consumption_unique_id)) {
                $action = "consumption Deleted. ";
                $columns = array();
                $values = array();
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['consumption_entry_table'], $consumption_unique_id, $columns, $values, $action);
                $prev_stock_list = array();
                $tables = "";
                $prev_stock_list = $obj->PrevStockList($delete_consumption_id);
                if (!empty($prev_stock_list)) {
                    foreach ($prev_stock_list as $data) {
                        $stock_godown_id = "";
                        $stock_magazine_id = "";
                        $stock_case_contains = "";
                        $stock_consumption_id = $delete_consumption_id;
                        $stock_id = "";
                        if (!empty($data['id'])) {
                            $stock_id = $data['id'];
                        }
                        if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                            $stock_godown_id = $data['godown_id'];
                        }
                        if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $stock_magazine_id = $data['magazine_id'];
                        }
                        if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                            $stock_case_contains = $data['case_contains'];
                        }
                        if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                            $stock_product_id = $data['product_id'];
                        }
                        if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_godown_table'];
                        } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_magazine_table'];
                        }
                        $current_stock_unit = 0;
                        $current_stock_subunit = 0;
                        $current_stock_unit = $obj->getCurrentStockUnit($tables, $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($tables, $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        if (empty($current_stock_unit) && $current_stock_unit == $GLOBALS['null_value']) {
                            $current_stock_unit = 0;
                        }
                        if (empty($current_stock_subunit) && $current_stock_subunit == $GLOBALS['null_value']) {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }
                        $stock_table_unique_id = "";
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($tables, $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

                        if (preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array();
                                $values = array();
                                $columns = array('deleted');
                                $values = array('"1"');
                                $stock_table_update_id = $obj->UpdateSQL($tables, $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
               
            }
        }
        echo $msg;
        exit;
    }