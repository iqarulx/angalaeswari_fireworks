<?php
	include("include.php");
	if(isset($_REQUEST['show_material_transfer_id'])) { 
        $show_material_transfer_id = $_REQUEST['show_material_transfer_id'];
        $location_list = $material_transfer_list = $product_id = $product_name = $unit_id = $unit_name = $subunit_id = $subunit_name = $unit_type = $content = $quantity = $quantity_limit = $negative = array();
        $product_count = ''; $current_date = date('Y-m-d');
        $material_transfer_list = $obj->getTableRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $show_material_transfer_id, '');
        if(!empty($material_transfer_list)) {
            foreach($material_transfer_list as $data) {
                if(!empty($data['material_transfer_date'])) {
                    $material_date = date('Y-m-d', strtotime($data['material_transfer_date']));
                }
                if(!empty($data['material_transfer_number']) && $data['material_transfer_number'] != $GLOBALS['null_value']) {
                    $material_transfer_number = $data['material_transfer_number'];
                }
                if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']) {
                    $location = $data['location'];
                }
                if(!empty($data['from_location']) && $data['from_location'] != $GLOBALS['null_value']) {
                    $from_location = $data['from_location'];
                }
                if(!empty($data['to_location']) && $data['to_location'] != $GLOBALS['null_value']) {
                    $to_location = $data['to_location'];
                }
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_id = explode(",", $data['product_id']);
                    $product_count = count($product_id);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_name = explode(",", $data['product_name']);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_id = explode(",", $data['unit_id']);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    
                    $unit_name = explode(",", $data['unit_name']);
                }
                if(!empty($data['subunit_id']) && $data['subunit_id'] != $GLOBALS['null_value']) {
                    $subunit_id = explode(",", $data['subunit_id']);
                }
                if(!empty($data['subunit_name']) && $data['subunit_name'] != $GLOBALS['null_value']) {
                    $subunit_name = explode(",", $data['subunit_name']);
                }
                if(!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                    $unit_type = explode(",", $data['unit_type']);
                }
                if(!empty($data['content']) && $data['content'] != $GLOBALS['null_value']) {
                    $content = explode(",", $data['content']);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = explode(",", $data['quantity']);
                }
                if($data['negative'] != $GLOBALS['null_value']) {
                    $negative = explode(",", $data['negative']);
                }
                if(!empty($data['quantity_limit']) && $data['quantity_limit'] != $GLOBALS['null_value']) {
                    $quantity_limit = explode(",", $data['quantity_limit']);
                }
            }
        }
        if(!empty($location) && $location == '1') {
            $location_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
        } else if(!empty($location) && $location == '2') {
            $location_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        }
        ?>
        <form class="poppins pd-20" name="material_transfer_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						
                        <?php if(!empty($show_material_transfer_id)) { ?>
                            <div class="h5">Edit Material Transfer</div>
                        <?php } else { ?>
                            <div class="h5">Add Material Transfer</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('material_transfer.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="Product_Fix_field" value="<?php if(!empty($show_material_transfer_id) && count($product_id) > 0) { echo $show_material_transfer_id; } ?>">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_material_transfer_id)) { echo $show_material_transfer_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" name="material_date" class="form-control shadow-none" value="<?php if(!empty($material_date)) { echo $material_date; } else { echo date("Y-m-d"); } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" >
                                    <label>Date</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger Product_Fix_field" name="location" onchange="locationChange();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Location</option>
                                        <option value="1" <?php if(!empty($location) && $location == '1') { echo 'selected'; } ?>>Godown</option>
                                        <option value="2" <?php if(!empty($location) && $location == '2') { echo 'selected'; } ?>>Magazine</option>
                                    </select>
                                    <label>Select Location</label>
                                </div>
                            </div>   
                              <input type="hidden" name="location" value = "<?php if(!empty($location)) { echo $location; } ?>">
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger Product_Fix_field" name="from_location" onchange="FromLocationChange();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select From</option>
                                        <?php if(!empty($location_list)) {
                                            foreach($location_list as $list) { 
                                                if($location == '1') {?>
                                                    <option value="<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>" <?php if(!empty($from_location) && $from_location == $list['godown_id']) { echo 'selected'; } ?>> <?php if(!empty($list['godown_name'])) { echo $obj->encode_decode('decrypt', $list['godown_name']); } ?></option>
                                                    <?php } else if($location == '2') { ?>
                                                        <option value="<?php if(!empty($list['magazine_id'])) { echo $list['magazine_id']; } ?>" <?php if(!empty($from_location) && $from_location == $list['magazine_id']) { echo 'selected'; } ?>> <?php if(!empty($list['magazine_name'])) { echo $obj->encode_decode('decrypt', $list['magazine_name']); } ?></option>
                                                <?php }
                                            }
                                        } ?>
                                    </select>
                                    <label>Select From </label>
                                </div>
                            </div>       
                        </div>
                        <input type="hidden" name="from_location" value = "<?php if(!empty($from_location)) { echo $from_location; } ?>">
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger Product_Fix_field" name="to_location" onchange="Javascript:ToLocationId();" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_material_transfer_id)){ ?> disabled <?php } ?>>
                                        <option>Select To</option>
                                        <?php if(!empty($location_list)) {
                                            foreach($location_list as $list) { 
                                                if($location == '1') {?>
                                                    <option value="<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>" <?php if(!empty($to_location) && $to_location == $list['godown_id']) { echo 'selected'; } ?>> <?php if(!empty($list['godown_name'])) { echo $obj->encode_decode('decrypt', $list['godown_name']); } ?></option>
                                                    <?php } else if($location == '2') { ?>
                                                        <option value="<?php if(!empty($list['magazine_id'])) { echo $list['magazine_id']; } ?>" <?php if(!empty($to_location) && $to_location == $list['magazine_id']) { echo 'selected'; } ?>> <?php if(!empty($list['magazine_name'])) { echo $obj->encode_decode('decrypt', $list['magazine_name']); } ?></option>
                                                <?php }
                                            }
                                        } ?>
                                    </select>
                                    <label>Select To</label>
                                </div>
                            </div>        
                        </div>
                        <input type="hidden" name="to_location" value = "<?php if(!empty($to_location)) { echo $to_location; } ?>">
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_product" onchange="GetProductdetails();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Product</option>
                                    </select>
                                    <label>Select Product</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" name="selected_quantity" class="form-control shadow-none" required="">
                                    <label>QTY</label>
                                </div>
                                <div class="new_smallfnt" id="qty_limit" style="font-weight:bold;font-size:14px;"></div>
                            </div> 
                        </div>
                        <input type="hidden" name="stock_limit" value="0">
                        <input type="hidden" name="stock_negative" value="0">
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_unit_type" onchange="GetProductStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="1">Unit</option>
                                        <option value="2">Sub Unit</option>
                                    </select>
                                    <label>Type</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2 d-none" id="contents_div">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_content" onchange="GetProductStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Contents</option>    
                                    </select>
                                    <label>Contents</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-2 col-5 text-center px-lg-1 py-2">
                            <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddMaterialProducts();">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-10">
                            <div class="table-responsive text-center">
                            <input type="hidden" name="product_count" value="<?php if (!empty($product_count)) { echo $product_count; } else { echo "0"; } ?>">
                                <table class="table nowrap cursor smallfnt table-bordered product_material_table">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th style="width:40px;">#</th>
                                            <th style="width:400px;">Product</th>
                                            <th style="width:150px;">Qty</th>
                                            <th style="width:150px;">Type</th>
                                            <th style="width:150px;">Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($product_id)) {
                                            for($i = 0; $i < count($product_id); $i++) { ?>
                                                <tr class="product_row" id="product_row<?php echo $i; ?>">
                                                    <td class="sno text-center px-2 py-2"><?php echo $i+1; ?></td>

                                                    <td class="text-center px-2 py-2">
                                                        <?php
                                                        if ($product_name[$i] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $product_name[$i]);
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_id[]" id="product_id_<?php echo $i;?>" value="<?php echo $product_id[$i]; ?>">
                                                        <input type="hidden" name="product_name[]" id="product_name_<?php echo $i;?>" value="<?php echo $product_name[$i]; ?>">
                                                    </td>
                                            
                                                    <td class="text-center px-2 py-2">
                                                        <input type="text" name="quantity[]" id="quantity_<?php echo $i;?>" class="form-control shadow-none" value="<?php echo $quantity[$i]; ?>" onkeyup="calQtyTotal();" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                                                    </td>

                                                    <td class="text-center px-2 py-2">
                                                        <?php
                                                            echo ($unit_type[$i] == '1') ? $obj->encode_decode('decrypt', $unit_name[$i]) : $obj->encode_decode('decrypt', $subunit_name[$i]);
                                                        ?>
                                                        <input type="hidden" name="negative[]" id="negative_<?php echo $i;?>" value="<?php echo $negative[$i]; ?>">
                                                        <input type="hidden" name="quantity_limit[]" id="quantity_limit_<?php echo $i;?>" value="<?php echo $quantity_limit[$i]; ?>">
                                                        <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $i;?>" value="<?php echo $unit_id[$i]; ?>">
                                                        <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $i;?>" value="<?php echo $unit_name[$i]; ?>">
                                                        <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $i;?>" value="<?php echo $subunit_id[$i]; ?>">
                                                        <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $i;?>" value="<?php echo $subunit_name[$i]; ?>">
                                                        <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $i;?>" value="<?php echo $unit_type[$i]; ?>">
                                                        <input type="hidden" name="content[]" id="content_<?php echo $i;?>" value="<?php if(!empty($content[$i]) && $content[$i] != $GLOBALS['null_value']) { echo $content[$i]; } else { echo $GLOBALS['null_value']; } ?>">
                                                    </td>
                                                    <td>
                                                    <?php if(!empty($content[$i]) && $content[$i] != $GLOBALS['null_value']) { 
                                                            echo $content[$i]; 
                                                        } else { 
                                                            echo '-'; 
                                                        } ?>
                                                    </td>
                                                    <td class="text-center px-2 py-2">
                                                        <?php
                                                        $show_button = 0;
                                                        $negative_stock_allowed = "";
                                                        $negative_stock_allowed = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'negative_stock');
                                                        if(!empty($to_location)) {
                                                            $inward_quantity = 0; $outward_quantity = 0;

                                                            if($location == 1) {
                                                                $inward_quantity = $obj->getInwardQty($show_material_transfer_id,$to_location,'',$product_id[$i],$content[$i]);
                                                                $outward_quantity = $obj->getOutwardQty($show_material_transfer_id,$to_location, '',$product_id[$i],$content[$i]);
                                            
                                                               
                                                            } else {
                                                                $inward_quantity = $obj->getInwardQty($show_material_transfer_id,'',$to_location,$product_id[$i],$content[$i]);
                                                                $outward_quantity = $obj->getOutwardQty($show_material_transfer_id,'',$to_location,$product_id[$i],$content[$i]);                                                                
                                                            }
                                                                                                                        
                                                            // if($inward_quantity >= $outward_quantity) {
                                                            //     $show_button = 1;
                                                            // }
                                                            $show_button = 0;
                                                            if($negative_stock_allowed == 0){
                                                         
                                                                if($inward_quantity >= $outward_quantity){
                                                                    $show_button = 1;
                                                                }
                                                            }else if($negative_stock_allowed == 1){
                                                                $show_button = 1;
                                                            }
                                                        }
                                                        if($show_button == '1') {
                                                            ?>

                                                            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteMaterialTransferRow('<?php echo $i; ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                        <?php } else { ?>
                                                            <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>
                                                        <?php } ?>
                                                    </td>

                                                    <?php /* <td class="text-center px-2 py-2">
                                                        <button class="btn btn-danger" type="button" onclick="Javascript:DeleteMaterialTransferRow('<?php echo $i; ?>', 'product_row');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td> */ ?>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end">Total:</td>
                                            <td class="total_quantity"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>
                        </div>
                        <div class="row mx-0 my-3">
                            <div class="col-lg-6 col-md-6 col-12 text-end">
                                <h4>Total Quantity : <span class="overall_qty"></span></h3>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-danger" type="button" onClick="Formsubmit();">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>     
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script src="include/js/material_transfer.js"></script>
            <script>
                 jQuery(document).ready(function () {
                    loadProductForFromLocation();
                    calQtyTotal();
                    <?php if(count($product_id) > 0) { ?>
                        DisableProduct_Fix_field();
                    <?php } ?>
                 });
                 function Formsubmit() {
                    if(jQuery('.Product_Fix_field').length > 0) {
                        jQuery('.Product_Fix_field').attr('disabled', false);
                    }
                    SaveModalContent(event,'material_transfer_form', 'material_transfer_changes.php', 'material_transfer.php');
                }
            </script>
        </form>
	<?php
    } 

    
    if(isset($_REQUEST['edit_id'])) {

        function combineAndSumUp ($myArray) {
            $finalArray = Array ();
            foreach ($myArray as $nkey => $nvalue) {
                $has = false;
                $fk = false;
                foreach ($finalArray as $fkey => $fvalue) {
                    if(($fvalue['godown_id'] == $nvalue['godown_id']) && ($fvalue['product_id'] == $nvalue['product_id'])  && ($fvalue['subunit_content'] == $nvalue['subunit_content'])) {    
                        $has = true;
                        $fk = $fkey;
                        break;
                    }
                }
    
                if($has === false) {
                    $finalArray[] = $nvalue;
                } else {
                    $finalArray[$fk]['product_id'] = $nvalue['product_id'];
                    $finalArray[$fk]['subunit_content'] = $nvalue['subunit_content'];
                    $finalArray[$fk]['quantity'] += $nvalue['quantity'];
                }
            }
            return $finalArray;
            // print_r($final_array);
        }

        $location = $from_location = $to_location = $material_date = $valid_material_transfer = $product_error = ""; 
        $form_name = "material_transfer_form"; $stock_unique_ids = array();
        if (isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $material_date = $_POST['material_date'];
        if(empty($material_date)) {
            $material_date_error = "Select date";
            if(!empty($valid_material_transfer)) {
                $valid_material_transfer = $valid_material_transfer." ".$valid->error_display($form_name, 'material_date', $material_date_error, 'text');
            }
            else {
                $valid_material_transfer = $valid->error_display($form_name, 'material_date', $material_date_error, 'text');
            }
        }
        
        $location = $_POST['location'];
        $location = trim($location);
        $location_error = $valid->common_validation($location, 'Location', 'select');
        if(!empty($location_error)) {
            if(!empty($valid_material_transfer)) {
                $valid_material_transfer = $valid_material_transfer." ".$valid->error_display($form_name, 'location', $location_error, 'select');
            }
            else {
                $valid_material_transfer = $valid->error_display($form_name, 'location', $location_error, 'select');
            }
        }

        $from_location = $_POST['from_location'];
        $from_location = trim($from_location);
        $from_location_error = $valid->common_validation($from_location, 'From location', 'select');
        if(!empty($from_location_error)) {
            if(!empty($valid_material_transfer)) {
                $valid_material_transfer = $valid_material_transfer." ".$valid->error_display($form_name, 'from_location', $from_location_error, 'select');
            }
            else {
                $valid_material_transfer = $valid->error_display($form_name, 'from_location', $from_location_error, 'select');
            }
        }

        $to_location = $_POST['to_location'];
        $to_location = trim($to_location);
        $to_location_error = $valid->common_validation($to_location, 'To location', 'select');
        if(!empty($to_location_error)) {
            if(!empty($valid_material_transfer)) {
                $valid_material_transfer = $valid_material_transfer." ".$valid->error_display($form_name, 'to_location', $to_location_error, 'select');
            }
            else {
                $valid_material_transfer = $valid->error_display($form_name, 'to_location', $to_location_error, 'select');
            }
        }

        if(isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
        }

        if(isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
        }

        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }

        if(isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
        }

        if(isset($_POST['unit_name'])) {
            $unit_name = $_POST['unit_name'];
        }

        if(isset($_POST['subunit_id'])) {
            $subunit_id = $_POST['subunit_id'];
        }

        if(isset($_POST['subunit_name'])) {
            $subunit_name = $_POST['subunit_name'];
        }
        
        if(isset($_POST['unit_type'])) {
            $unit_type = $_POST['unit_type'];
        }

        if(isset($_POST['content'])) {
            $content = $_POST['content'];
        }

        if(isset($_POST['quantity_limit'])) {
            $quantity_limit = $_POST['quantity_limit'];
        }

        if(isset($_POST['negative'])) {
            $negative = $_POST['negative'];
        }

        if(!empty($product_id)) {
            for($i=0; $i < count($product_id); $i++) {
                $product_qty = "";
                $product_id[$i] = trim($product_id[$i]);
                $product_name[$i] = trim($product_name[$i]);
                $quantity[$i] = trim($quantity[$i]);
                $unit_id[$i] = trim($unit_id[$i]);
                $unit_name[$i] = trim($unit_name[$i]);
                $subunit_id[$i] = trim($subunit_id[$i]);
                $subunit_name[$i] = trim($subunit_name[$i]);
                $unit_type[$i] = trim($unit_type[$i]);
                $content[$i] = trim($content[$i]);
                $quantity_limit[$i] = trim($quantity_limit[$i]);
                $negative[$i] = trim($negative[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    if(!empty($quantity[$i])) {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999)  { 
                            // if((float) $quantity[$i] > (float) $quantity_limit[$i] && $negative[$i] == 0) {
                            //     $product_error = "Exceeded quantity in Product - ".($obj->encode_decode('decrypt', $product_name[$i]). "on ". $i+1);
                            // }
                        }
                    }
                    if ($unit_type[$i] == '1') {
                        $str_unit_id = $unit_id[$i];
                    } else if ($unit_type[$i] == '2') {
                        $str_unit_id = $subunit_id[$i];
                    }
                    
                    if($location == 1) {
                        $stock_unique_ids[] = $obj->getStockUniqueID($edit_id, $from_location, $GLOBALS['null_value'], $product_id[$i], $str_unit_id, $content[$i]);
                    } else {
                        $stock_unique_ids[] = $obj->getStockUniqueID($edit_id, $GLOBALS['null_value'], $from_location, $product_id[$i], $str_unit_id, $content[$i]);
                    }

                    if($location == 1) {
                        $stock_unique_ids[] = $obj->getStockUniqueID($edit_id, $to_location, $GLOBALS['null_value'], $product_id[$i], $str_unit_id, $content[$i]);
                    } else {
                        $stock_unique_ids[] = $obj->getStockUniqueID($edit_id, $GLOBALS['null_value'], $to_location, $product_id[$i], $str_unit_id, $content[$i]);
                    }

                    // for($j=0; $j < count($product_id); $j++) {
                    //     $product_id[$j] = trim($product_id[$j]);
                    //     $quantity[$j] = trim($quantity[$j]);
                    //     $unit_type[$j] = trim($unit_type[$j]);
                    //     $content[$j] = trim($content[$j]);
                    //     $total_qty =  0;
                    //     if($product_id[$j] == $product_id[$i]) {
                        
                    //         if($unit_type[$i] == '1') {
                    //             $qty = (int) $quantity[$i];
                    //             if(!empty($content[$j]) && $content[$j] != 0 && $content[$j] != $GLOBALS['null_value']) {
                    //                 $qty2 = (int) $quantity[$j] / (int) $content[$j];
                    //             } else {
                    //                 $qty2 = (int) $quantity[$j];
                    //             }
                    //             $total_qty = $qty + $qty2;
                    //             if($total_qty > $quantity_limit[$i] && $negative[$i] == 0) {
                    //                 $product_error = "Stock Limit ". $quantity_limit[$i]. " ". $obj->encode_decode('decrypt', $unit_name[$i]). " Exceeded - ".($obj->encode_decode('decrypt', $product_name[$i]). " on ". ($i+1));
                    //             } 
                    //         } else if ($unit_type[$i] == '2') {
                    //             $qty = (int) $quantity[$i];
                    //             if(!empty($content[$j]) && $content[$j] != 0 && $content[$j] != $GLOBALS['null_value']) {
                    //                 $qty2 = (int) $quantity[$j] * (int) $content[$j];
                    //             }
                    //             $total_qty = $qty + $qty2;
                    //             if($total_qty > $quantity_limit[$i] && $negative[$i] == 0) {
                    //                 $product_error = "Stock Limit ". $quantity_limit[$i]. " ". $obj->encode_decode('decrypt', $unit_name[$i]). " Exceeded - ".($obj->encode_decode('decrypt', $product_name[$i]). " on ". ($i+1));
                    //             } 
                    //         }
                    //     }
                    // }

                    if ($unit_type[$i] == '1') {
                        $product_qty =$quantity[$i];
                    } else if ($unit_type[$i] == '2') {
                        $product_qty = $quantity[$i] / $content[$i];
                    }

                    // $product_qty =$quantity[$i];
                    // if($product_subunit_id == $unit_id[$i])
                    // {
                    //     $product_qty = $quantity[$i] / $content[$i];
                    // }

                    $individual_product_detail[] = array('godown_id' => $from_location,'product_id' => $product_id[$i],'subunit_content' => $content[$i],'quantity' => $product_qty); 
                }
                array_multisort(array_column($individual_product_detail, "godown_id"), SORT_ASC, array_column($individual_product_detail, "subunit_content"), SORT_ASC, array_column($individual_product_detail, "product_id"), SORT_ASC, $individual_product_detail);

                if(empty($valid_material_transfer))
                {
                    $final_array = combineAndSumUp($individual_product_detail);
                }

            }
        } else {
            $product_error = "Add Products";
        }

        $stock_error = 0; $valid_stock = "";
        if(!empty($final_array) && empty($valid_material_transfer))
        {
            foreach($final_array as $data)
            {
                $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0; $current_stock_subunit = 0;
                $subunit_need = 0; $product ="";
                $current_stock_subunit = 0; $available_stock_unit = 0; $available_stock_subunit = 0;
                if($location == 1) {
                    // echo "hi";
                    $inward_unit = $obj->getInwardQty($edit_id,$data['godown_id'],'',$data['product_id'],$data['subunit_content']);
                    $outward_unit = $obj->getOutwardQty($edit_id,$data['godown_id'], '',$data['product_id'],$data['subunit_content']);

                
                    $inward_subunit = $obj->getInwardSubunitQty($edit_id,$data['godown_id'],'',$data['product_id'],$data['subunit_content']);
                    $outward_subunit = $obj->getOutwardSubunitQty($edit_id,$data['godown_id'], '',$data['product_id'],$data['subunit_content']);
                } else {
                    $inward_unit = $obj->getInwardQty($edit_id,'',$data['godown_id'],$data['product_id'],$data['subunit_content']);
                    $outward_unit = $obj->getOutwardQty($edit_id,'',$data['godown_id'],$data['product_id'],$data['subunit_content']);

                    $inward_subunit = $obj->getInwardSubunitQty($edit_id,'',$data['godown_id'],$data['product_id'],$data['subunit_content']);
                    $outward_subunit = $obj->getOutwardSubunitQty($edit_id,'',$data['godown_id'],$data['product_id'],$data['subunit_content']);
                }

                $available_stock_unit = $inward_unit - $outward_unit;
                $available_stock_subunit = $inward_subunit - $outward_subunit;

                $outward_unit -= $data['quantity'];
                if(!empty($data['subunit_content']) && $data['subunit_content'] != $GLOBALS['null_value']){
                    $outward_subunit -= ($data['quantity'] * $data['subunit_content']);
                }
                // echo $inward_subunit."/".$outward_subunit."<br>";
                $current_stock_unit = $inward_unit - $outward_unit;
                $current_stock_subunit = $inward_subunit - $outward_subunit;
                // echo ($data['quantity'] ." / ". $current_stock_unit);
                if($data['quantity'] > $current_stock_unit) {
                    $product = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'product_name');
                    $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'subunit_need');


                    if(!empty($product))
                    {
                        $product = $obj->encode_decode("decrypt",$product);
                    }
                   
                    $negative_stock = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'negative_stock');
                    if($negative_stock !='1')
                    {
                        if($subunit_need == 1){
                            $valid_stock = "Max stock for ".$product."  <br> unit => ".$available_stock_unit." ,  Subunit => ".$available_stock_subunit ;
                        }else{
                            $valid_stock = "Max stock for ".$product."  <br> unit => ".$available_stock_unit;
                        }            
                        $stock_error = 1;
                    }
                }
            }
        }


        // echo $edit_id. " / " .$product_error." // ".$valid_stock."<br>";
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
                        $stock_type = 1;
                    }
                    if (!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                        $inward_subunit = $data['inward_subunit'];
                        $stock_type = 1;

                    }
                    if (!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                        $stock_type = 2;

                    }
                    if (!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                        $outward_subunit = $data['outward_subunit'];
                        $stock_type = 2;
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

                    if($stock_type == 1) {
                        if (!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            $current_stock_unit = $current_stock_unit - $inward_unit;
                        } else {
                            $current_stock_unit = 0;
                        }
                        if (!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit - $inward_subunit;
                        } else {
                            $current_stock_subunit = 0;
                        }
                    } else {
                        if (!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            $current_stock_unit = $current_stock_unit + $outward_unit;
                        } else {
                            $current_stock_unit = 0;
                        }
                        if (!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit + $outward_subunit;
                        } else {
                            $current_stock_subunit = 0;
                        }
                    }
                    

                    // echo $stock_id ." / ";
                    // print_r($stock_unique_ids);
                    // echo " / ". $stock_table_unique_id. "<br>";

                    // echo $current_stock_unit." / ". $current_stock_subunit." <br>";                   
    
                     if(!in_array($stock_id, $stock_unique_ids)) {
                        $columns = array(); $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
                        
                        if(preg_match("/^\d+$/", $stock_update_id)) {
                            if(preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($stock_unique_table, $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                    // else if(!in_array($stock_id, $stock_unique_ids)) {
                    //     $columns = array(); $values = array();
                    //     $columns = array('deleted');
                    //     $values = array('"1"');
                    //     $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
                        
                    //     if(preg_match("/^\d+$/", $stock_update_id)) {
                    //         if(preg_match("/^\d+$/", $stock_table_unique_id)) {
                    //             $columns = array(); $values = array();
                    //             $columns = array('current_stock_unit', 'current_stock_subunit');
                    //             $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                    //             $stock_table_update_id = $obj->UpdateSQL($stock_unique_table, $stock_table_unique_id, $columns, $values, '');
                    //         }
                    //     }
                    // }
                }
            }
        }

        $result = "";

        // echo $valid_stock .= "hi";

        if(empty($valid_material_transfer) && empty($product_error) && empty($valid_stock)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";

                if(!empty($product_id)) {
                    $product_id = array_reverse($product_id);
                    $product_id = implode(",", $product_id);
                }else{
                    $product_id = $GLOBALS['null_value'];
                }
               
                if(!empty($product_name)) {
                    $product_name = array_reverse($product_name);
                    $product_name = implode(",", $product_name);
                }else{
                    $product_name = $GLOBALS['null_value'];
                }
    
                if(!empty($unit_id)) {
                    $unit_id = array_reverse($unit_id);
                    $unit_id = implode(",", $unit_id);
                }else{
                    $unit_id = $GLOBALS['null_value'];
                }

                if(!empty($unit_name)) {
                    $unit_name = array_reverse($unit_name);
                    $unit_name = implode(",", $unit_name);
                }else{
                    $unit_name = $GLOBALS['null_value'];
                }

                if(!empty($subunit_id)) {
                    $subunit_id = array_reverse($subunit_id);
                    $subunit_id = implode(",", $subunit_id);
                }else{
                    $subunit_id = $GLOBALS['null_value'];
                }

                if(!empty($subunit_name)) {
                    $subunit_name = array_reverse($subunit_name);
                    $subunit_name = implode(",", $subunit_name);
                }else{
                    $subunit_name = $GLOBALS['null_value'];
                }

                if(!empty($quantity)) {
                    $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                }else{
                    $quantity = $GLOBALS['null_value'];
                }
                if(!empty($unit_type)) {
                    $unit_type = array_reverse($unit_type);
                    $unit_type = implode(",", $unit_type);
                }else{
                    $unit_type = $GLOBALS['null_value'];
                }

                if(!empty($content)) {
                    $content = array_reverse($content);
                    $content = implode(",", $content);
                }else{
                    $content = $GLOBALS['null_value'];
                }

                if(!empty($quantity_limit)) {
                    $quantity_limit = array_reverse($quantity_limit);
                    $quantity_limit = implode(",", $quantity_limit);
                }else{
                    $quantity_limit = $GLOBALS['null_value'];
                }

                if(!empty($negative)) {
                    $negative = array_reverse($negative);
                    $negative = implode(",", $negative);
                }else{
                    $negative = $GLOBALS['null_value'];
                }
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $stock_update = 0;
                if(empty($edit_id)) {
                    $action = "New Material Transferd";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'material_transfer_id', 'material_transfer_number', 'material_transfer_date', 'location', 'from_location', 'to_location', 'product_id', 'product_name', 'unit_type', 'unit_id', 'unit_name', 'subunit_id', 'subunit_name', 'negative', 'content', 'quantity', 'quantity_limit', 'deleted', 'cancelled');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$null_value."'", "'".$material_date."'", "'".$location."'", "'".$from_location."'", "'".$to_location."'", "'".$product_id."'", "'".$product_name."'", "'".$unit_type."'", "'".$unit_id."'", "'".$unit_name."'", "'".$subunit_id."'", "'".$subunit_name."'", "'".$negative."'", "'".$content."'", "'".$quantity."'", "'".$quantity_limit."'", "'0'", "'0'");
                    $material_transfer_insert_id = $obj->InsertSQL($GLOBALS['material_transfer_table'], $columns, $values,'material_transfer_id', 'material_transfer_number', $action);
                    if(preg_match("/^\d+$/", $material_transfer_insert_id)) {
                        $stock_update = 1;
                        $material_transfer_id = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'id', $material_transfer_insert_id, 'material_transfer_id');
                        $material_transfer_number = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'id', $material_transfer_insert_id, 'material_transfer_number');
                        $result = array('number' => '1', 'msg' => 'Material Transfer Entry Successfully Created','redirection_page' =>'material_transfer.php');
                    }
                } else {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "Material Transfer Updated";
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','bill_company_details','location', 'from_location', 'to_location', 'product_id', 'product_name', 'unit_type', 'unit_id', 'unit_name', 'subunit_id', 'subunit_name', 'negative', 'content', 'quantity', 'quantity_limit', 'material_transfer_date', 'deleted', 'cancelled');
                            $values = array("'".$creator_name."'", "'".$bill_company_details."'", "'".$location."'", "'".$from_location."'", "'".$to_location."'", "'".$product_id."'", "'".$product_name."'", "'".$unit_type."'", "'".$unit_id."'", "'".$unit_name."'", "'".$subunit_id."'", "'".$subunit_name."'", "'".$negative."'", "'".$content."'", "'".$quantity."'", "'".$quantity_limit."'", "'".$material_date."'","'0'", "'0'");
                            
                            $material_transfer_update_id = $obj->UpdateSQL($GLOBALS['material_transfer_table'], $getUniqueID, $columns, $values, $action);

                            if(preg_match("/^\d+$/", $material_transfer_update_id)) {
                                $stock_update = 1;
                                $material_transfer_id = $edit_id;
                                $material_transfer_number = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $edit_id, 'material_transfer_number');
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $material_transfer_update_id);
                            }		
                        }
                }
                if (!empty($stock_update) && $stock_update == 1) {
                    if (!empty($from_location) && !empty($to_location) && !empty($product_id) && !empty($quantity) && !empty($material_transfer_number)) {
                        $product_id = explode(",", $product_id);
                        $unit_type = explode(",", $unit_type);
                        $unit_id = explode(",", $unit_id);
                        $subunit_id = explode(",", $subunit_id);
                        $quantity = explode(",", $quantity);
                        $contents = explode(",", $content);
                        $remarks = $obj->encode_decode("encrypt",$material_transfer_number);
                        for($i = 0; $i < count($product_id); $i++) {
                            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                            if(!empty($product_list)) {
                                foreach ($product_list as $P_list) {
                                    if(!empty($P_list['group_id'])) {
                                        $group_id = $P_list['group_id'];
                                    }
                                }
                            }
                            if($unit_type[$i] == '1') {
                                $unit_sub = $unit_id[$i];                                
                            } else if($unit_type[$i] == '2') {
                                $unit_sub = $subunit_id[$i];
                            }
                            if($location == '1') {

                                $stock_update_id = $obj->StockUpdate($GLOBALS['material_transfer_table'], "Out", $material_transfer_id, $material_transfer_number, $product_id[$i], $remarks, $material_date, $from_location, $GLOBALS['null_value'], $unit_sub, $quantity[$i], $contents[$i], $group_id, 1);

                                $stock_update_id = $obj->StockUpdate($GLOBALS['material_transfer_table'], "In", $material_transfer_id, $material_transfer_number, $product_id[$i], $remarks, $material_date, $to_location, $GLOBALS['null_value'], $unit_sub, $quantity[$i], $contents[$i], $group_id, 1);

                            } else if($location == '2') {
                                $stock_update_id = $obj->StockUpdate($GLOBALS['material_transfer_table'], "Out", $material_transfer_id, $material_transfer_number, $product_id[$i], $remarks, $material_date, $GLOBALS['null_value'], $from_location, $unit_sub, $quantity[$i], $contents[$i], $group_id, 2);

                                $stock_update_id = $obj->StockUpdate($GLOBALS['material_transfer_table'], "In", $material_transfer_id, $material_transfer_number, $product_id[$i], $remarks, $material_date, $GLOBALS['null_value'], $to_location, $unit_sub, $quantity[$i], $contents[$i], $group_id, 2);
                            }
                        }
                    }
                }

            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_material_transfer)) {
                $result = array('number' => '3', 'msg' => $valid_material_transfer);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($valid_stock)) {
                $result = array('number' => '2', 'msg' => $valid_stock);
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
        $from_date = ""; $to_date = ""; $godown = ""; $magazine = ""; $show_bill = 0;
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['godown'])) {
            $godown = $_POST['godown'];
        }
        if(isset($_POST['magazine'])) {
            $magazine = $_POST['magazine'];
        }
        
        $total_records_list = array();
        $total_records_list = $obj->getMaterialTransferList($from_date, $to_date);

        if(!empty($magazine)) {
            $magazine = strtolower($magazine);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos($val['from_location'], $magazine) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        if(!empty($godown)) {
            $godown = strtolower($godown);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos($val['from_location'], $godown) !== false) ) {
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
                        <th>#</th>
                        <th>Date</th>
                        <th>From Godown</th>
                        <th>To Godown</th>
                        <!-- <th>QTY</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($show_records_list)) {
                    foreach($show_records_list as $key => $list) {
                        $index = $key + 1;
                        if(!empty($prefix)) { $index = $index + $prefix; }   
                        ?>
                        <tr>
                            <td>
                                <?php echo $index; ?>
                            </td>
                            <td>
                                <?php echo  date("d-m-Y", strtotime($list['material_transfer_date'])); ?>
                            </td>
                            <td>
                                <?php if($list['location'] == 1) {
                                    $name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $list['from_location'], 'godown_name');
                                    echo $obj->encode_decode('decrypt', $name);
                                } else if($list['location'] == 2) {
                                    $name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $list['from_location'], 'magazine_name');
                                    echo $obj->encode_decode('decrypt', $name);
                                } ?>
                            </td>
                            <td>
                                <?php if($list['location'] == 1) {
                                    $name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $list['to_location'], 'godown_name');
                                    echo $obj->encode_decode('decrypt', $name);
                                } else if($list['location'] == 2) {
                                    $name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $list['to_location'], 'magazine_name');
                                    echo $obj->encode_decode('decrypt', $name);
                                } ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-dark show-button" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                       <li><a class="dropdown-item" target="_blank" style="cursor:pointer;" href="reports/rpt_material_transfer_a5.php?view_material_transfer_id=<?php if(!empty($list['material_transfer_id'])) { echo $list['material_transfer_id']; } ?>"><i class="fa fa-print"></i> &ensp; Print</a></li>
                                        <?php 
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $edit_action;
                                                include('permission_action.php');
                                            }
                                            if(empty($access_error) && empty($list['cancelled'])) {
                                            ?> 
                                            <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['material_transfer_id'])) { echo $list['material_transfer_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                            <?php } ?>
                                            <?php 
                                                $access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $delete_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($access_error) && empty($list['cancelled'])) {
                                            ?>     
                                        <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['material_transfer_id'])) { echo $list['material_transfer_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;Delete</a></li>
                                        <?php } ?>
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
                        <td colspan="7" class="text-center">Sorry! No records found</td>
                    </tr>
                <?php 
                    } 
                ?>
                    
                </tbody>
            </table>                
    <?php }
    }

    // if (isset($_REQUEST['delete_material_transfer_id'])) {
    //     $delete_material_transfer_id = $_REQUEST['delete_material_transfer_id'];
    //     $msg = "";
    //     if (!empty($delete_material_transfer_id)) {
    //         $material_transfer_unique_id = "";
    //         $material_transfer_unique_id = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $delete_material_transfer_id, 'id');
    //         if (preg_match("/^\d+$/", $material_transfer_unique_id)) {
    
    //             $action =  "material_transfer Deleted.";

    //             $columns = array();
    //             $values = array();
    //             $columns = array('deleted');
    //             $values = array("'1'");
    //             $msg = $obj->UpdateSQL($GLOBALS['material_transfer_table'], $material_transfer_unique_id, $columns, $values, $action);
    //             $prev_stock_list = array();
    //             $tables = "";
    //             $prev_stock_list = $obj->PrevStockList($delete_material_transfer_id);
    //             if (!empty($prev_stock_list)) {
    //                 foreach ($prev_stock_list as $data) {
    //                     $stock_godown_id = "";
    //                     $stock_magazine_id = "";
    //                     $stock_case_contains = "";
    //                     $stock_material_transfer_id = $delete_material_transfer_id;
    //                     $stock_id = "";
    //                     if (!empty($data['id'])) {
    //                         $stock_id = $data['id'];
    //                     }
    //                     if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
    //                         $stock_godown_id = $data['godown_id'];
    //                     }
    //                     if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
    //                         $stock_magazine_id = $data['magazine_id'];
    //                     }
    //                     if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
    //                         $stock_case_contains = $data['case_contains'];
    //                     }
    //                     if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
    //                         $tables = $GLOBALS['stock_by_godown_table'];
    //                     } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
    //                         $tables = $GLOBALS['stock_by_magazine_table'];
    //                     }
    //                     $current_stock_unit = 0;
    //                     $current_stock_subunit = 0;
    //                     $current_stock_unit = $obj->getCurrentStockUnit($tables, $stock_godown_id, $stock_magazine_id, $stock_material_transfer_id, $stock_case_contains);
    //                     $current_stock_subunit = $obj->getCurrentStockSubunit($tables, $stock_godown_id, $stock_magazine_id, $stock_material_transfer_id, $stock_case_contains);
    //                     if (empty($current_stock_unit) && $current_stock_unit == $GLOBALS['null_value']) {
    //                         $current_stock_unit = 0;
    //                     }
    //                     if (empty($current_stock_subunit) && $current_stock_subunit == $GLOBALS['null_value']) {
    //                         $current_stock_subunit = $GLOBALS['null_value'];
    //                     }
    //                     $stock_table_unique_id = "";
    //                     $stock_table_unique_id = $obj->getStockTablesUniqueID($tables, $stock_godown_id, $stock_magazine_id, $stock_material_transfer_id, $stock_case_contains);
    //                     $columns = array();
    //                     $values = array();
    //                     $columns = array('deleted');
    //                     $values = array('"1"');
    //                     $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

    //                     if (preg_match("/^\d+$/", $stock_update_id)) {
    //                         if (preg_match("/^\d+$/", $stock_table_unique_id)) {
    //                             $columns = array();
    //                             $values = array();
    //                             $columns = array('deleted');
    //                             $values = array('"1"');
    //                             $stock_table_update_id = $obj->UpdateSQL($tables, $stock_table_unique_id, $columns, $values, '');
    //                         }
    //                     }
    //                 }
                    
    //             } else {
    //                 $msg = "This material_transfer is associated with other screens";
    //             }
    //         }
    //     }
    //     echo $msg;
    //     exit;
    // }

    if(isset($_REQUEST['delete_material_transfer_id'])) {
        $delete_material_transfer_id = $_REQUEST['delete_material_transfer_id'];
        $delete_material_transfer_id = trim($delete_material_transfer_id);
        $msg = "";
        if(!empty($delete_material_transfer_id)) {	
            $materialtransfer_unique_id = "";
            $materialtransfer_unique_id = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $delete_material_transfer_id, 'id');
        
            if(preg_match("/^\d+$/", $materialtransfer_unique_id)) {
                $material_transfer_number = "";
                $material_transfer_number = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $delete_material_transfer_id, 'material_transfer_number');
            
                $action = "";
                if(!empty($material_transfer_number)) {
                    $action = "Material Transfer Cancelled. Bill No. - ".$material_transfer_number;
                }
                $stock_delete = "";
                $stock_delete = $obj->DeleteMaterialTransfer($delete_material_transfer_id);
                if($stock_delete == '1') {
                    $columns = array(); $values = array();			
                    $columns = array('cancelled');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['material_transfer_table'], $materialtransfer_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "Can't Delete. Stock goes to negative!";
                }
            }
            else {
                $msg = "Invalid Material Transfer";
            }
        }
        else {
            $msg = "Empty Material Transfer";
        }
        echo $msg;
        exit;	
    }