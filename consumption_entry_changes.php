<?php
	include("include.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['consumption_entry_module'];
        }
    }
	if(isset($_REQUEST['show_consumption_entry_id'])) { 
        $show_consumption_entry_id = $_REQUEST['show_consumption_entry_id'];
        $godown_id = array(); $product_id = array(); $unit_type = array(); $quantity = array(); /* $contractor_id = "";*/ $consumption_content = array(); $godown_type = ""; $entry_date = date('Y-m-d'); $first_godown_id = ""; $product_count =0;
       if(!empty($show_consumption_entry_id)) {
            $show_consumption_entry_list = $obj->getTableRecords($GLOBALS['consumption_entry_table'], 'consumption_id', $show_consumption_entry_id, '');
            if(!empty($show_consumption_entry_list)) {
                foreach($show_consumption_entry_list as $consumption_entry) {
                    // if(!empty($consumption_entry['contractor_id'])) {
                    //     $contractor_id = $consumption_entry['contractor_id'];
                    // }
                    if(!empty($consumption_entry['godown_type'])) {
                        $godown_type = $consumption_entry['godown_type'];
                    }
                    if(!empty($consumption_entry['godown_id'])) {
                        $godown_id = explode(",", $consumption_entry['godown_id']);
                    }
                    if(!empty($consumption_entry['product_id'])) {
                        $product_id = explode(",", $consumption_entry['product_id']);
                        $product_count = count($product_id);
                    }
                    if(!empty($consumption_entry['unit_type'])) {
                        $unit_type = explode(",", $consumption_entry['unit_type']);
                    }
                    if(!empty($consumption_entry['quantity'])) {
                        $quantity = explode(",", $consumption_entry['quantity']);
                    }
                    if(!empty($consumption_entry['content'])) {
                        $consumption_content = explode(",", $consumption_entry['content']);
                    }
                    if(!empty($data['entry_date'])) {
                        $entry_date = date('Y-m-d', strtotime($data['entry_date']));
                    }
                    if($godown_type == 1){
                        $first_godown_id = trim($godown_id[0]);
                    }
                }
            }
        }

        // $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], "", "", "");
        
        if(!empty($login_godown_id)){
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
        } else {
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], "", "", "");
        }

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
                        <div class="col-lg-2 col-md-4 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" name="entry_date" class="form-control shadow-none" value="<?php if(!empty($entry_date)) { echo $entry_date; } ?>" min="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($to_date)) { echo $to_date; } ?>">
                                    <label>Entry Date <span class="text-danger">*</span></label>
                                </div>
                            </div> 
                        </div>
                        <?php /*
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger <?php if(!empty($show_consumption_entry_id)) { echo 'Product_Fix_field'; } ?>" name="contractor"  data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                        */ ?>
                        <?php /*
                        <input type="hidden" name="contractor" value="<?php if(!empty($contractor_id)) { echo $contractor_id; } ?>" <?php if(empty($show_consumption_entry_id)) { ?>disabled<?php } ?>>
                        <?php */ ?>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger <?php if(!empty($show_consumption_entry_id)) { echo 'Product_Fix_field'; } ?>" name="godown_type" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_consumption_entry_id)) { echo "disabled"; } ?> onchange="Javascript:getGodownType(this.value);">
                                        <option value="">Select Godown type</option>
                                        <option value="1"  <?php if(!empty($godown_type) && $godown_type == 1){ ?>Selected <?php } ?> >Overall Godown</option>
                                        <option value="2" <?php if(!empty($godown_type) && $godown_type == 2){ ?>Selected <?php } ?> >Productwise Godown</option>
                                    </select>
                                    <label>Select Godown Type<span class="text-danger">*</span></label>
                                </div>
                            </div>       
                        </div>
                        <input type="hidden" name="godown_type" value="<?php if(!empty($godown_type)) { echo $godown_type; } ?>" <?php if(empty($show_consumption_entry_id)) { ?>disabled<?php } ?>>
                        <div class="col-lg-3 col-md-3 col-6 py-2 overall_godown d-none">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="overall_godown" onchange="GetStockProduct();" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_consumption_entry_id)) { ?>disabled<?php } ?>>
                                        <option value="">Select Godown</option>
                                        <?php if(!empty($godown_list)) {
                                            foreach($godown_list as $godown) { ?>
                                                <option value="<?php echo $godown['godown_id']; ?>"  <?php if(!empty($godown['godown_id']) && $godown['godown_id'] == $first_godown_id){ ?>Selected <?php } ?> ><?php echo $obj->encode_decode('decrypt', $godown['godown_name']); ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <label>Select Godown <span class="text-danger">*</span></label>
                                </div>
                            </div>       
                        </div>
                    </div>
                    <input type="hidden" name="overall_godown" value="<?php if(!empty($godown_id)) { echo $godown_id; } ?>" <?php if(empty($show_consumption_entry_id)) { ?>disabled<?php } ?>>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-2 col-md-3 col-6 py-2 indv_godown d-none">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="indv_godown" onchange="GetStockProduct();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Godown</option>
                                        <?php if(!empty($godown_list)) {
                                            foreach($godown_list as $godown) { ?>
                                                <option value="<?php echo $godown['godown_id']; ?>" ><?php echo $obj->encode_decode('decrypt', $godown['godown_name']); ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <label>Select Godown</label>
                                </div>
                            </div>       
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="product" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="GetProdetails();">
                                        <option value="">Select Product</option>
                                    </select>
                                    <label>Select Product</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_unit_type" onchange="GetCurrentStock();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Unit</option>    
                                    </select>
                                    <label>Unit</label>
                                </div>
                            </div> 
                            <div class="current_stock_div text-center" style="font-size:11px!important;font-weight:bold!important;color:rgb(253, 10, 10) !important;"></div>       
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 d-none contains_div">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_content" onchange="GetCurrentStock();"  data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Content</option>    
                                    </select>
                                    <label>Content</label>
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
                        <input type="hidden" name="subunit_need" value="0">
                        <input type="hidden" name="stock_limit" value="0">
                        <input type="hidden" name="stock_negative" value="0">
                   
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
                                <input type="hidden" name="product_count" value="<?php if (!empty($product_count)) { echo $product_count; } else { echo "0"; } ?>">
                                <table class="table nowrap cursor smallfnt table-bordered consumption_product_table">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th style="width:50px;">#</th>
                                            <th style="width:200px;" class="indv_godown d-none">Godown</th>
                                            <th style="width:150px;">Product Group</th>
                                            <th style="width:200px;">Product</th>
                                            <th style="width:100px;">Type</th>
                                            <th style="width:100px;">Qty</th>
                                            <th style="width:100px;" class="subunit_contains">Content</th>
                                            <th style="width:30px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(!empty($product_id)) {
                                                // $product_row_index = 0;
                                                for($i = 0; $i < count($product_id); $i++) {
                                                    // $product_row_index++;
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
                                                    <tr class="product_row" id="product_row<?php echo $product_count; ?>">
                                                        <td class="sno text-center px-2 py-2"><?php echo $product_count; ?></td>
                                                        <?php if($godown_type == 2){ ?>
                                                    
                                                            <td class="text-center px-2 py-2 indv_godown">
                                                                <?php
                                                                if ($godown_name != $GLOBALS['null_value']) {
                                                                    echo $obj->encode_decode('decrypt', $godown_name);
                                                                }
                                                                ?>
                                                               
                                                            </td>
                                                        <?php   } ?>
                                                        <input type="hidden" name="godown_id[]" id="godown_id_<?php echo $product_count;?>" value="<?php echo $godown_id[$i]; ?>">
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
                                                            <input type="hidden" name="product_id[]" id="product_id_<?php echo $product_count;?>" value="<?php echo $product_id[$i]; ?>">
                                                        </td>
                                                
                                                        <td class="text-center px-2 py-2">
                                                            <?php
                                                                echo ($unit_type[$i] == '1') ? $obj->encode_decode('decrypt', $unit_name) : $obj->encode_decode('decrypt', $subunit_name);
                                                            ?>
                                                            <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $product_count;?>" value="<?php echo $unit_id; ?>">
                                                            <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $product_count;?>" value="<?php echo $unit_name; ?>">
                                                            <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $product_count;?>" value="<?php echo $subunit_id; ?>">
                                                            <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $product_count;?>" value="<?php echo $subunit_name; ?>">
                                                            <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $product_count;?>" value="<?php echo $unit_type[$i]; ?>">
                                                        </td>
                                                        <td class="text-center px-2 py-2">
                                                            <input type="text" name="quantity[]" id="quantity_<?php echo $product_count;?>" class="form-control shadow-none" value="<?php echo $quantity[$i]; ?>" onkeyup="calQtyTotal();" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                                                        </td>

                                                        <td>
                                                            <?php
                                                            if(!empty($consumption_content[$i]) && $consumption_content[$i] != $GLOBALS['null_value']){ echo $consumption_content[$i]; }else { echo " - "; }
                                                            ?>
                                                            <input type="hidden" name="contains[]" value="<?php if(!empty($consumption_content[$i]) && $consumption_content[$i] != $GLOBALS['null_value']){ echo $consumption_content[$i]; } else { echo "NULL"; } ?>">
                                                        </td>
                                                        <td class="text-center px-2 py-2">
                                                        <?php
                                                            $negative_stock_allowed = "";
                                                            $negative_stock_allowed = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'negative_stock');
                                                            $inward_quantity = 0; $outward_quantity = 0;
                                                             if(!empty($consumption_content[$i]) && $consumption_content[$i] != $GLOBALS['null_value']){ 

                                                                $inward_quantity = $obj->getInwardQty('', $godown_id[$i], '', $product_id[$i], $consumption_content[$i]);
                                                                $outward_quantity = $obj->getOutwardQty($show_consumption_entry_id, $godown_id[$i],'', $product_id[$i],$consumption_content[$i]);
                                                             }else{
                                                                $inward_quantity = $obj->getInwardQty('', $godown_id[$i], '', $product_id[$i], '');
                                                                $outward_quantity = $obj->getOutwardQty($show_consumption_entry_id, $godown_id[$i],'', $product_id[$i],'');
                                                             }
                                                             $show_button = 0;
                                                             if($negative_stock_allowed == 0){
                                                         
                                                                if($inward_quantity >= $outward_quantity){
                                                                    $show_button = 1;
                                                                }
                                                            } else if($negative_stock_allowed == 1){
                                                                $show_button = 1;
                                                            }
                                                            // if($inward_quantity >= $outward_quantity) {
                                                            if($show_button == '1') { ?>
                                                                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteConsumptionRow('<?php echo $product_count; ?>', 'product_row');">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            <?php } else { ?>
                                                                <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>
                                                           <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $product_count--;
                                             }

                                            } ?>
                                       
                                    </tbody>
                               
                                </table>
                            </div>
                        </div>
                        <div class="row mx-0 my-3">
                            <div class="col-lg-9 col-md-6 col-12 text-end">
                                <h4>Total Quantity : <span class="overall_qty"></span></h3>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-dark " type="button" onClick="Javascript:SaveModalContent(event,'consumption_form', 'consumption_entry_changes.php', 'consumption_entry.php');">
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
                    calQtyTotal();
                    GetStockProduct();
                    getGodownType('<?php if(!empty($godown_type)){ echo $godown_type; } ?>');

                    <?php } ?>
                });
           
            </script>
        </form>
		<?php
    } 

    if(isset($_POST['edit_id'])) {
        
        function combineAndSumUp ($myArray) {
            $finalArray = Array ();
            foreach ($myArray as $nkey => $nvalue) {
                $has = false;
                $fk = false;
                foreach ($finalArray as $fkey => $fvalue) {
                    if(($fvalue['godown_id'] == $nvalue['godown_id']) && ($fvalue['product_id'] == $nvalue['product_id'])  && ($fvalue['consumption_content'] == $nvalue['consumption_content'])) {    
                        $has = true;
                        $fk = $fkey;
                        break;
                    }
                }
    
                if($has === false) {
                    $finalArray[] = $nvalue;
                } else {
                    $finalArray[$fk]['product_id'] = $nvalue['product_id'];
                    $finalArray[$fk]['consumption_content'] = $nvalue['consumption_content'];
                    $finalArray[$fk]['quantity'] += $nvalue['quantity'];
                }
            }
            return $finalArray;
        }

        $edit_id = ""; /* $contractor_id = ""; */ $form_name = "consumption_form"; $product_id = array(); $unit_type = array(); $quantity = array(); $result = ""; $update_stock = 0; $unit_sub = array();  $entry_date = ""; $entry_date_error = "";
        $consumption_id = ""; $stock_unique_ids = array(); $group_id = array(); $unit_id = array(); $subunit_id = array();
        $contractor_error = ""; $consumption_content = array(); $godown_type_error = ""; $overall_godown_error = ""; $overall_godown = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $consumption_id = $edit_id;
        }
        if(isset($_POST['entry_date'])) {
            $entry_date = $_POST['entry_date'];
            $entry_date = trim($entry_date);
            $entry_date_error = $valid->valid_date($entry_date, 'Entry Date', '1');
            if(!empty($entry_date_error)) {
                if(!empty($valid_consumption)) {
                    $valid_consumption = $valid_consumption." ".$valid->error_display($form_name, 'entry_date', $entry_date_error, 'text');
                }
                else {
                    $valid_consumption = $valid->error_display($form_name, 'entry_date', $entry_date_error, 'text');
                }
            }
        }


        /* if(isset($_POST['contractor'])) {
            $contractor_id = $_POST['contractor'];
        }
        if(empty($contractor_id)) {
            $contractor_error = "Select contractor";
        }
        if (!empty($contractor_error)) {
            if (!empty($valid_consumption)) {
                $valid_consumption = $valid_consumption . " " . $valid->error_display($form_name, 'contractor', $contractor_error, 'select');
            } else {
                $valid_consumption = $valid->error_display($form_name, 'contractor', $contractor_error, 'select');
            }
        } */

        if(isset($_POST['godown_type'])) {
            $godown_type = $_POST['godown_type'];
            if(empty($godown_type)) {
                $godown_type_error = "Select Godown Type";
            }
            if (!empty($godown_type_error)) {
                if (!empty($valid_consumption)) {
                    $valid_consumption = $valid_consumption . " " . $valid->error_display($form_name, 'godown_type', $godown_type_error, 'select');
                } else {
                    $valid_consumption = $valid->error_display($form_name, 'godown_type', $godown_type_error, 'select');
                }
            }
        }
        if($godown_type == 1){
            
            $overall_godown = $_POST['overall_godown'];
            if(empty($overall_godown)) {
                $overall_godown_error = "Select Godown";
            }
            if (!empty($overall_godown_error)) {
                if (!empty($valid_consumption)) {
                    $valid_consumption = $valid_consumption . " " . $valid->error_display($form_name, 'overall_godown', $overall_godown_error, 'select');
                } else {
                    $valid_consumption = $valid->error_display($form_name, 'overall_godown', $overall_godown_error, 'select');
                }
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
        if(isset($_POST['contains'])) {
            $consumption_content = $_POST['contains'];
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
                if(!empty($consumption_content[$i]) && $consumption_content[$i] != $GLOBALS['null_value']){
                    $consumption_content[$i] = trim($consumption_content[$i]);
                }else{
                    $consumption_content[$i] = $GLOBALS['null_value'];
                }
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
                $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, $godown_id[$i], $GLOBALS['null_value'], $product_id[$i], $unit_sub[$i], $consumption_content[$i]);
                // echo $stock_unique_ids[$i]."/";
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
                $product_qty = 0;

                if ($unit_type[$i] == '1') {
                    $product_qty = $quantity[$i];
                } else if ($unit_type[$i] == '2') {
                    $product_qty = $quantity[$i] / $consumption_content[$i];
                }

                $individual_tax[] = array( 'godown_id' => $godown_id[$i],'product_id' => $product_id[$i],'consumption_content' => $consumption_content[$i],'quantity' => $product_qty);

            }
            // print_r($individual_tax);

            array_multisort(array_column($individual_tax, "godown_id"), SORT_ASC, array_column($individual_tax, "consumption_content"), SORT_ASC, array_column($individual_tax, "product_id"), SORT_ASC, $individual_tax);

            if(empty($edit_id)) {
                $godown_id = array_reverse($godown_id);
                $product_id = array_reverse($product_id);
                $unit_type = array_reverse($unit_type);
                $quantity = array_reverse($quantity);
                $consumption_content = array_reverse($consumption_content);
            }

            if(empty($valid_consumption))
            {
                $final_array = combineAndSumUp($individual_tax);
            }

        } else {
            $product_error = "Please select product and its detials";
        }

        $stock_error = 0; $valid_stock = "";
        if(!empty($final_array) && empty($valid_consumption))
        {
            foreach($final_array as $data)
            {
                $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0; $subunit_need = 0; $product ="";
                $current_stock_subunit = 0; $available_stock_unit = 0; $available_stock_subunit = 0;
                $inward_unit = $obj->getInwardQty('',$data['godown_id'],'',$data['product_id'],$data['consumption_content']);
                $outward_unit = $obj->getOutwardQty($edit_id,$data['godown_id'], '',$data['product_id'],$data['consumption_content']);
                
                $inward_subunit = $obj->getInwardSubunitQty('',$data['godown_id'],'',$data['product_id'],$data['consumption_content']);
                $outward_subunit = $obj->getOutwardSubunitQty($edit_id,$data['godown_id'],'',$data['product_id'],$data['consumption_content']); 

                $available_stock_unit = $inward_unit - $outward_unit;
                $available_stock_subunit = $inward_subunit - $outward_subunit;

                $outward_unit += $data['quantity'];
                // echo $data['quantity']."/".$data['consumption_content'];
                if(!empty($data['consumption_content']) && $data['consumption_content'] != $GLOBALS['null_value']){
                    $outward_subunit += ($data['quantity'] * $data['consumption_content']);
                }

                $current_stock_unit = $inward_unit - $outward_unit;
                $current_stock_subunit = $inward_subunit - $outward_subunit;

                // echo $current_stock_unit." / ".$data['quantity'];
                if($current_stock_unit < 0) {
                    $product = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'product_name');
                    if(!empty($product)) {
                        $product = $obj->encode_decode("decrypt",$product);
                    }
                    $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'subunit_need'); 
                    $negative_stock = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'negative_stock');
                    
                    $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'unit_id');
                    $unit_name = "";
                    
                    if(!empty($unit_id)) {
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode("decrypt", $unit_name);
                        }   
                    }

                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'subunit_id');
                    $sub_unit_name = "";
                    
                    if(!empty($sub_unit_id)) {
                        $sub_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id', $sub_unit_id, 'unit_name');
                        if(!empty($sub_unit_name)) {
                            $sub_unit_name = $obj->encode_decode("decrypt", $sub_unit_name);
                        }   
                    }

                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'product_name');
                    if(!empty($product_name)) {
                        $product_name = $obj->encode_decode("decrypt", $product_name);
                    }

                    if($negative_stock !='1') {
                        if($subunit_need == 1) {
                            $valid_stock = "Max stock for <b>" . $product_name . "</b> with " .  $unit_name . " & " . (!empty($data['consumption_content']) ? ($data['consumption_content'] . " " . $sub_unit_name ) : "") . "<br>Current Stock : " . $available_stock_unit . " " . $unit_name . " & " . $available_stock_subunit . " " . $sub_unit_name;
                            $stock_error = 1;
                        } else {
                            $valid_stock = "Max stock for <b>" . $product_name . "</b> with " .  $unit_name . "<br>Current Stock : " . $available_stock_unit . " " . $unit_name;
                            $stock_error = 1;
                        }
                    }
                }
            }
        }

        if (!empty($edit_id) && empty($product_error) && empty($valid_stock)) {
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
                    if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                    }
                    if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                        $outward_subunit = $data['outward_subunit'];
                    }
                  
                    $current_stock_unit = 0;
                    $current_stock_subunit = 0;
                    $stock_table_unique_id = "";
                    $stock_unique_table = "";
                    $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                   
                    $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                    $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                    $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);

                    if (!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                        $current_stock_unit = $current_stock_unit + $outward_unit;
                    } else {
                        $current_stock_unit = 0;
                    }
                    if (!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                        $current_stock_subunit = $current_stock_subunit + $outward_subunit;
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
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($GLOBALS['stock_by_godown_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }

        // echo $valid_stock.= "Hi";

        if(empty($valid_consumption) && empty($product_error) && empty($valid_stock)) {
            $check_user_id_ip_address = "";
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $factory_id = "";
            $factory_name_location = ""; $magazine_name_location = ""; $contractor_name_mobile_city = "";
            $factory_details = ""; $magazine_details = ""; $contractor_details = "";

       
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
                if(!empty($entry_date)) {
                    $entry_date = date('Y-m-d', strtotime($entry_date));
                }

                /* $contractor_details = ""; $consumption_entry_number = "";
                $contractor_details = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'contractor_details');
                $contractor_mobile_city = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'name_mobile_city'); */

                $company_details = "";
                $company_details = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
                
                $bill_company_id = $GLOBALS['bill_company_id'];
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                if (empty($edit_id)) {
                    $action = "New consumption Created ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'company_details','consumption_id','consumption_entry_number', 'entry_date','godown_type','product_id', 'godown_id', 'unit_type', 'quantity','content', 'total_quantity', 'cancelled','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$company_details."'","'".$null_value."'", "'".$null_value."'","'".$entry_date."'", "'".$godown_type."'", "'".$product_id."'", "'".$godown_id."'", "'".$unit_type."'", "'".$quantity."'", "'".$consumption_content."'", "'".$total_qty."'", "'0'","'0'");
                    $insert_id = $obj->InsertSQL($GLOBALS['consumption_entry_table'], $columns, $values, "consumption_id", "consumption_entry_number", $action);
                    if (preg_match("/^\d+$/", $insert_id)) {

                        $consumption_id = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'id', $insert_id, 'consumption_id');
                        $consumption_entry_number = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'id', $insert_id, 'consumption_entry_number');

                        $update_stock = 1;
                        $result = array('number' => '1', 'msg' => 'Consumption Successfully Created');
                    } else {
                        $result = array('number' => '2', 'msg' => $insert_id);
                    }
                } else {
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'consumption_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "consumption Updated.";
                        $columns = array(); $values = array();	
                        $columns = array('company_details', 'product_id', 'godown_id', 'unit_type', 'quantity', 'total_quantity','entry_date','content','godown_type');
                        $values = array("'".$company_details."'", "'".$product_id."'", "'".$godown_id."'", "'".$unit_type."'", "'".$quantity."'", "'".$total_qty."'","'".$entry_date."'","'".$consumption_content."'","'".$godown_type."'");
                        $consumption_update_id = $obj->UpdateSQL($GLOBALS['consumption_entry_table'], $getUniqueID, $columns, $values, $action);
                        if(preg_match("/^\d+$/", $consumption_update_id)) {
                            $consumption_id = $edit_id;
                            $consumption_entry_number = $obj->getTableColumnValue($GLOBALS['consumption_entry_table'], 'consumption_id', $edit_id, 'consumption_entry_number');
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
                        $remarks = $obj->encode_decode('encrypt', $consumption_entry_number);
                        $bill_type = "Consumption Entry";
                        $bill_number = $consumption_entry_number; 
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
                            $stock_update_id = $obj->StockUpdate($GLOBALS['consumption_entry_table'], "Out", $consumption_id, $bill_number, $product_id[$i], $remarks, $entry_date, $godown_id[$i], $GLOBALS['null_value'], $unit_sub, $quantity[$i], $consumption_content[$i], $group_id, 1);
                              
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
            } else if (!empty($valid_stock)) {
                $result = array('number' => '2', 'msg' => $valid_stock);
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
        $search_text = ""; $show_bill = 0;
		if(isset($_POST['search_text'])) {
		   $search_text = $_POST['search_text'];
		}

        /* $filter_contractor_id = "";  $from_date = ""; $to_date = "";
		if(isset($_POST['filter_contractor_id'])) {
		   $filter_contractor_id = $_POST['filter_contractor_id'];
		} */

        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        $total_records_list = $obj->getConsumptionTableRecords('', $show_bill, $from_date, $to_date);

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($val['consumption_entry_number']), $search_text) !== false) {
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
            $view_access_error = "";
            if(!empty($login_staff_id)) {
                $permission_action = $view_action;
                include('permission_action.php');
            }
            if(empty($view_access_error)) {  ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Entry Date</th>
                    <th>Consumption Entry No</th>
                    <!-- <th>Contractor Name</th> -->
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
                                if(!empty($data['entry_date'])) {
                                    echo date('d-m-Y', strtotime($data['entry_date']));
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if(!empty($data['consumption_entry_number']) && $data['consumption_entry_number'] != $GLOBALS['null_value']) {
                                    echo $data['consumption_entry_number'];
                                }
                            
                            ?>
                            <div class="w-100 py-2">
                                <?php
                                    if(!empty($data['creator_name'])) {
                                        $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                        echo " Creator : ". $data['creator_name'];
                                    }
                                ?>                                        
                            </div>
                            <?php
                                if(!empty($data['cancelled'])) {
                                    ?>
                                          <span style="color: red;">Cancelled</span>
                                    <?php	
                                }	 ?>
                        </td>
                        <?php /*
                        <td>
                            <?php
                                if(!empty($data['contractor_mobile_city'])) {
                                    $data['contractor_mobile_city'] = $obj->encode_decode('decrypt', $data['contractor_mobile_city']);
                                    echo $data['contractor_mobile_city'];
                                }
                            ?>
                         
                        </td>
                        */ ?>
                        <td class="ribbon-header" style="cursor:default;">
                            <?php 
                                if(!empty($data['total_quantity'])) {
                                    echo $data['total_quantity'];
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
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"  class="btn btn-dark show-button"  >
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                     <li><a class="dropdown-item" target="_blank" style="cursor:pointer;" href="reports/rpt_consumption_entry_a5.php?view_consumption_entry_id=<?php if(!empty($data['consumption_id'])) { echo $data['consumption_id']; } ?>"><i class="fa fa-print"></i> &ensp; Print</a></li>
                                    <?php 
                                        $edit_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($edit_access_error) && empty($data['cancelled'])) {
                                    ?> 
                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['consumption_id'])) { echo $data['consumption_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                    <?php } ?>
                                        <?php 
                                            $delete_access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $delete_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($delete_access_error) & empty($data['cancelled'])) {
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
                    } else {
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


    if(isset($_REQUEST['get_unit'])) {
        $product_id = $_REQUEST['get_unit'];
        $product_id = trim($product_id);
        $godown_id = $_REQUEST['product_godown_id'];
        $godown_id = trim($godown_id);

        $unit_id = "";
        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_id');

        $unit_name = "";
        if(!empty($unit_id)) {
            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
            if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                $unit_name = $obj->encode_decode('decrypt', $unit_name);
            } else {
                $unit_name = "";
            }
        }

        $subunit_id = "";
        $subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');

        $sub_unit_name = "";
        if(!empty($subunit_id)) {
            $sub_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');
            if(!empty($sub_unit_name) && $sub_unit_name != $GLOBALS['null_value']) {
                $sub_unit_name = $obj->encode_decode('decrypt', $sub_unit_name);
            } else {
                $sub_unit_name = "";
            }
        }

        $current_stock_unit = 0;
        $current_stock_unit = $obj->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $godown_id, '',$product_id,'');

        $current_stock_subunit = 0;
        $current_stock_subunit = $obj->getCurrentStockSubunit($GLOBALS['stock_by_godown_table'], $godown_id, '',$product_id, '');

        $subunit_need = 0;
        $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');

        $contains_list = array();
        if($subunit_need == 1) {
            $contains_list = $obj->ProductContainsList($product_id);
        }
    
        if(!empty($contains_list)) {
            foreach($contains_list as $contain) {
                $case_contains[] = $contain['case_contains'];
            }
        }
        ?>
        <option value="">Select</option>
        <?php
        if(!empty($unit_id) && $unit_id != $GLOBALS['null_value']) {
            ?>
                <option value="<?php echo $unit_id; ?>" selected>
                    <?php
                        if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                            echo $unit_name;
                        }
                    ?>
                </option>
            <?php
        }
        if(!empty($subunit_id) && $subunit_id != $GLOBALS['null_value']) {
            ?>
                <option value="<?php echo $subunit_id; ?>">
                    <?php
                        if(!empty($sub_unit_name) && $sub_unit_name != $GLOBALS['null_value']) {
                            echo $sub_unit_name;
                        }
                    ?>
                </option>
            <?php
        }
        ?>
        $$$
        <?php if(empty($subunit_need)){ ?>
            <span class="w-100 text-center" style="font-weight:bold!important;">
                <?php if(!empty($unit_id) && !empty($product_id)) { ?>
                Current Stock By Unit<br>(<?php echo number_format($current_stock_unit, 2); if(!empty($unit_name)) { echo " " . $unit_name; } ?>)<br>
                <?php } ?>
                <?php if($subunit_id != $GLOBALS['null_value'] && !empty($product_id)) { ?>
                Current Stock By Subunit (<?php echo number_format($current_stock_subunit, 2); if(!empty($sub_unit_name)) { echo " " . $sub_unit_name; } ?>)
                <?php } ?>
            </span>
        <?php } ?>
        $$$
        <?php
        if($subunit_need == 1 && !empty($case_contains)){
        ?>
            <option value="">Select Content</option>
                <?php 
            for($i=0; $i< count($case_contains); $i++){ 
                if(!empty($case_contains[$i]) && $case_contains[$i] != $GLOBALS['null_value']) { ?>
                    <option value="<?php if(!empty($case_contains[$i]) && $case_contains[$i] != $GLOBALS['null_value']) { echo $case_contains[$i]; } ?>">
                        <?php
                    
                                echo  $case_contains[$i];
                        ?>
                    </option>
                    <?php 
                } 
            }

        }
    }
    
  
    if(isset($_REQUEST['product_row_index'])) {
        $product_row_index = $_REQUEST['product_row_index'];
        $product_id = $_REQUEST['selected_product_id'];
        $unit_id = $_REQUEST['selected_unit_id'];
        $quantity = $_REQUEST['selected_quantity'];
        $contains = $_REQUEST['selected_content'];
        $godown_type = $_REQUEST['godown_type'];
        $godown_id = $_REQUEST['godown_id'];
        $product_unit_id = ""; $product_name = ""; $group_name = ""; $group_id = ""; $product_subunit_id = ""; $unit_type = "";
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
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
                    $product_unit_id = $P_list['unit_id'];
                }
                if(!empty($P_list['subunit_id'])) {
                    $product_subunit_id = $P_list['subunit_id'];
                }
            }
        }
        if($unit_id == $product_unit_id) {
            $unit_type = 1;
        } else if($unit_id == $product_subunit_id) {
            $unit_type = 2;
        }
        ?>
        <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <th class="text-center px-2 py-2 sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
            <?php if($godown_type == 2){ ?>
                <th class="text-center px-2 py-2">
                    <?php
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
                    if ($godown_name != $GLOBALS['null_value']) {
                        echo $obj->encode_decode('decrypt', $godown_name);
                    }
                    ?>
                </th>
            <?php } ?>
            <input type="hidden" name="godown_id[]" value="<?php if(!empty($godown_id)){ echo $godown_id; } ?>">

            <th class="text-center px-2 py-2">
                <?php
                if ($group_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $group_name);
                }
                ?>
            </th>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($product_id)) {
                        $product_name = "";
                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $product_name);
                        }
                    }
                ?>
                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_id)) { echo $product_id; } ?>">
            </th>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($unit_id)) {
                        $unit_name = "";
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $unit_name);
                        }
                    }
                ?>
                <input type="hidden" name="unit_type[]" value="<?php if(!empty($unit_type)) { echo $unit_type; } ?>">
                <input type="hidden" name="unit_id[]" value="<?php if(!empty($unit_id)) { echo $unit_id; } ?>">
            </th>
            <th class="text-center px-2 py-2">
                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity)) { echo $quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calQtyTotal(this);">
            </th>
            <th class="text-center px-2 py-2">
            <?php if(!empty($contains)) { 
                    echo $contains; 
                }else{
                    echo " - ";
                }
             ?>
                <input type="hidden" name="contains[]" class="form-control shadow-none" value="<?php if(!empty($contains)) { echo $contains; } ?>">
            </th>
            <th class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteConsumptionRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
            </th>
        </tr>
        <?php
    }

    if(isset($_REQUEST['get_current_stock_product_id'])) {
        $product_id = "";
        $product_id = $_REQUEST['get_current_stock_product_id'];  
        $unit_id = $_REQUEST['selected_unit_id'];
        $contains = $_REQUEST['selected_content'];
        $godown_id = $_REQUEST['godown_id'];

        $current_stock_unit = 0;
        $current_stock_unit = $obj->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $godown_id, '',$product_id, $contains);

        $current_stock_subunit = 0;
        $current_stock_subunit = $obj->getCurrentStockSubunit($GLOBALS['stock_by_godown_table'], $godown_id, '',$product_id, $contains);
        
        $subunit_id = "";
        $subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');

        $subunit_need = 0;
        $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');


        $unit_name = "";
        if(!empty($unit_id)) {
            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
        }

        $sub_unit_name = "";
        if(!empty($subunit_need) && !empty($subunit_id)) {
            if(!empty($unit_id)) {
                $sub_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');
            }
        }

         if(!empty($subunit_need)){ ?>
            <span class="w-100 text-center" style="font-weight:bold!important;">
                <?php if(!empty($unit_id) && !empty($product_id)) { ?>
                Current Stock By Unit<br>(<?php echo number_format($current_stock_unit, 2); if(!empty($unit_name)) { echo " " . $obj->encode_decode('decrypt', $unit_name); } ?>)<br>
                <?php } ?>
                <?php if($subunit_id != $GLOBALS['null_value'] && !empty($product_id)) { ?>
                Current Stock By Subunit<br>(<?php echo number_format($current_stock_subunit, 2); if(!empty($sub_unit_name)) { echo " " . $obj->encode_decode('decrypt', $sub_unit_name); } ?>) 
                <?php } ?>
            </span>
        <?php } else { ?>
            <span class="w-100 text-center" style="font-weight:bold!important;">
                <?php if(!empty($unit_id) && !empty($product_id)) { ?>
                Current Stock By Unit<br>(<?php echo number_format($current_stock_unit, 2); if(!empty($unit_name)) { echo " " . $obj->encode_decode('decrypt', $unit_name); } ?>)<br>
                <?php } ?>
            </span>
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
                        if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                            $outward_unit = $data['outward_unit'];
                        }
                        if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                            $outward_subunit = $data['outward_subunit'];
                        }
                        if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_godown_table'];
                        } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_magazine_table'];
                        }
                        $current_stock_unit = 0;
                        $current_stock_subunit = 0;
                        $current_stock_unit = $obj->getCurrentStockUnit($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = "";
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);

                        if(!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            $current_stock_unit = $current_stock_unit + $outward_unit;
                        } else {
                            $current_stock_unit = 0;
                        }
                        if(!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit + $outward_subunit;
                        } else {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }


                        if (empty($current_stock_unit) && $current_stock_unit == $GLOBALS['null_value']) {
                            $current_stock_unit = 0;
                        }
                        if (empty($current_stock_subunit) && $current_stock_subunit == $GLOBALS['null_value']) {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }
                   
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

                        if (preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($GLOBALS['stock_by_godown_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
                $columns = array();
                $values = array();
                $columns = array('cancelled');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['consumption_entry_table'], $consumption_unique_id, $columns, $values, $action);
               
            }
        }
        echo $msg;
        exit;
    }

    ?>