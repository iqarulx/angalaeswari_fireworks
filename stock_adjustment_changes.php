<?php
	include("include.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['stock_adjustment_module'];
        }
    }
	if(isset($_REQUEST['show_stock_adjustment_id'])) { 
        $show_stock_adjustment_id = $_REQUEST['show_stock_adjustment_id'];
        $show_stock_adjustment_id = trim($show_stock_adjustment_id);
        
        $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d');
        $entry_date = date('Y-m-d'); $category_id = "";
        $product_ids = array(); $product_name = array(); $unit_ids = array(); $unit_names = array(); $quantity = array();
        $stock_action = array(); $remarks = ""; $godown_id = ""; $godown_name_city = ""; $magazine_id = ""; $locations = array();
        $magazine_name_city = ""; $product_count = 0; $group_name = array(); $unit_types = array();
        $stock_adjustment_list = array(); $product_group = ""; $location_type = ""; $location_name = array();$content = array();
        $stock_adjustment_list = $obj->getTableRecords($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $show_stock_adjustment_id, ''); $first_location_id = "";
        if(!empty($stock_adjustment_list)) {
            foreach($stock_adjustment_list as $data) {
                if(!empty($data['entry_date'])) {
                    $entry_date = date('Y-m-d', strtotime($data['entry_date']));
                }
                if(!empty($data['location_id']) && $data['location_id'] != $GLOBALS['null_value']) {
                    $location_ids = $data['location_id'];
                    $location_ids = explode(",", $location_ids);
                }
                if(!empty($data['product_group']) && $data['product_group'] != $GLOBALS['null_value']) {
                    $product_group = $data['product_group'];
                }
                if(!empty($data['location_type']) && $data['location_type'] != $GLOBALS['null_value']) {
                    $location_type = $data['location_type'];
                }
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_count = count($product_ids);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                }
                if(!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                    $unit_types = $data['unit_type'];
                    $unit_types = explode(",", $unit_types);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_name = $data['product_name'];
                    $product_name = explode(",", $product_name);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_names = $data['unit_name'];
                    $unit_names = explode(",", $unit_names);
                }
                if(!empty($data['location_id']) && $data['location_id'] != $GLOBALS['null_value']) {
                    $location_id = $data['location_id'];
                    $location_id = explode(",", $location_id);
                }
                if(!empty($data['location_name']) && $data['location_name'] != $GLOBALS['null_value']) {
                    $location_name = $data['location_name'];
                    $location_name = explode(",", $location_name);
                }
                if(!empty($data['content']) && $data['content'] != $GLOBALS['null_value']) {
                    $content = $data['content'];
                    $content = explode(",", $content);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                }
                if(!empty($data['stock_action']) && $data['stock_action'] != $GLOBALS['null_value']) {
                    $stock_action = $data['stock_action'];
                    $stock_action = explode(",", $stock_action);
                }
                if(!empty($data['group_name']) && $data['group_name'] != $GLOBALS['null_value']) {
                    $group_name = $data['group_name'];
                    $group_name = explode(",", $group_name);
                }
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $obj->encode_decode('decrypt', $data['remarks']);
                }
                if($location_type == 1){
                     $first_location_id = trim($location_ids[0]);
                }
            }
        }
        
        $godown_list = array();
        if(!empty($login_godown_id)) {
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
        } else {
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
        }
        
        if(!empty($login_magazine_id)) {
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_magazine_id, '');
        }else{
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        }

        $group_list = array();
        $group_list = $obj->getTableRecords($GLOBALS['group_table'], '', '', '');

        $count_of_godown = 0;
        $count_of_godown = count($godown_list);

        $count_of_magazine = 0;
        $count_of_magazine = count($magazine_list);
        ?>
        <form class="poppins pd-20 redirection_form" name="stock_adjustment_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_stock_adjustment_id)) { ?>
                            <div class="h5">Edit Stock Adjustment</div>
                        <?php } else { ?>
                            <div class="h5">Add Stock Adjustment</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('stock_adjustment.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_stock_adjustment_id)) { echo $show_stock_adjustment_id; } ?>">
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="entry_date" value="<?php if(!empty($entry_date)) { echo $entry_date; } ?>" min="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($to_date)) { echo $to_date; } ?>" class="form-control shadow-none" placeholder="" required="">
                            <label style="font-size:10px;">Stock Adjustment Date <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-12 p-2 div_product_group">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="product_group" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:show_godown_magazine(this.value);Javascript:show_product(this.value)" <?php if(!empty($show_stock_adjustment_id)){ ?> disabled <?php } ?>>
                                <option value="">Select</option>
                                <?php
                                    if(!empty($group_list)) {
                                        foreach($group_list as $group) { 
                                            ?>
                                            <option value="<?php echo $group['group_id']; ?>" <?php if(!empty($product_group) && $product_group == $group['group_id']) { echo "selected"; } ?>>
                                                <?php 
                                                    if(!empty($group['group_name'])) {
                                                        echo $obj->encode_decode('decrypt', $group['group_name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                            <label>Product Group <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="product_group" value="<?php if(!empty($product_group)) { echo $product_group; } ?>">

                
                <div class="col-lg-2 col-md-3 col-12 p-2 div_location_type">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="location_type" data-dropdown-css-class="select2-danger" style="width: 100%!important;"  onchange="Javascript:location_type_value()" <?php if(!empty($show_stock_adjustment_id)){ ?> disabled <?php } ?>>
                                <option value="">Select</option>
                                <option value="1" <?php if(!empty($location_type) && $location_type =='1'){ ?>selected <?php } ?>>Single</option>
                                <option value="2"  <?php if(!empty($location_type) && $location_type =='2'){ ?>selected <?php } ?>>Multiple</option>
                            </select>
                            <label>Type <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="location_type" value="<?php if(!empty($location_type)) { echo $location_type; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea name="remarks" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'',50,'');InputBoxColor(this,'text');"><?php if(!empty($remarks)) { echo $remarks; } ?></textarea>
                            <label>Remarks <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Max Char : 50 (Restricted char : ?!<>$+=`~|?!;^*{})</div>
                    </div>        
                </div>
            </div>
            <div class="row justify-content-center p-2">
                <div class="col-lg-2 col-md-4 col-12 py-2 d-none div_selected_godown">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_godown_id" onchange="GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_stock_adjustment_id) && $location_type == 1){ ?> disabled <?php } ?>>
                                <option value="">Select Godown</option>
                                <?php if(!empty($godown_list)) {
                                    foreach($godown_list as $godown) { ?>
                                        <option value="<?php echo $godown['godown_id']; ?>" <?php if(!empty($first_location_id) && $first_location_id == $godown['godown_id'] || !empty($count_of_godown) && $count_of_godown == 1) { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $godown['godown_name']); ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label>Godown <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <input type="hidden" name="selected_godown_id">

                <div class="col-lg-2 col-md-4 col-12 py-2 d-none div_selected_magazine">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_magazine_id" onchange="GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_stock_adjustment_id) && $location_type == 1){ ?> disabled <?php } ?>>
                                <option value="">Select Magazine</option>
                                <?php if(!empty($magazine_list)) {
                                    foreach($magazine_list as $magazine) { ?>
                                        <option value="<?php echo $magazine['magazine_id']; ?>" <?php if(!empty($first_location_id) && $first_location_id == $magazine['magazine_id'] || !empty($count_of_magazine) && $count_of_magazine == 1) { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $magazine['magazine_name']); ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label>Magazine <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <input type="hidden" name="selected_magazine_id">
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="product" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="GetProdetails();">
                                <option value="">Select Product</option>
                                <?php /* if(!empty($product_list)) {
                                    foreach($product_list as $product) { ?>
                                        <option value="<?php echo $product['product_id']; ?>"><?php echo $obj->encode_decode('decrypt', $product['product_name']); ?></option>
                                <?php }
                                } */ ?>
                            </select>
                            <label>Select Product <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_unit_type"  onchange="Javascript:GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                             <option value="">Select</option>
                            </select>
                            <label>Unit <span class="text-danger">*</span></label>
                        </div>
                    </div>       
                    <div class="new_smallfnt" id="qty_limit" style="font-size:13px;"></div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2" id="contents_div">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="contains" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option value="">Select</option>
                            </select>
                            <label>Content <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_quantity" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger"  name="selected_stock_action" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select</option>
                                <option value="1">Add</option>
                                <option value="2">Remove</option>
                            </select>
                            <label>Select Action <span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div>  
                <div class="col-lg-1 col-md-3 col-12 py-2 text-center">
                    <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:AddStockAdjustmentProducts();">
                        Add
                    </button>
                </div> 
            </div>

            <div class="row justify-content-center p-2"> 
                <div class="col-lg-10">
                    <div class="table-responsive text-center">
                           <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered stockadjustment_product_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Location</th>
                                    <!-- <th>Product Group</th> -->
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Content</th>
                                    <th>Qty</th>
                                    <th>Stock Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php
                                if(!empty($product_ids)) {
                                    for($i=0; $i < count($product_ids); $i++) {    
                                        $unit_display = "";
                                        $unit_display = $obj->encode_decode('decrypt', $unit_names[$i]);
                                        ?>
                                        <tr class="product_row" id="product_row<?php echo $i; ?>">
                                            <td class="sno text-center px-2 py-2"><?php echo $i+1; ?></td>
                                            <td class="text-center px-2 py-2">
                                                <?php
                                                if ($location_name[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $location_name[$i]);
                                                }
                                                ?>
                                                <input type="hidden" name="location_id[]" id="location_id_<?php echo $i;?>" value="<?php echo $location_id[$i]; ?>">
                                            </td>
                                            <?php /*
                                            <td class="text-center px-2 py-2">
                                                <?php
                                                if ($group_name[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $group_name[$i]);
                                                }
                                                ?>
                                        
                                            </td>
                                            */ ?>
                                            <input type="hidden" name="group_name[]" value="<?php echo $group_name[$i]; ?>">

                                            <input type="hidden" name="group_id[]" value="<?php echo $group_id[$i]; ?>">
                                            <td class="text-center px-2 py-2">
                                                <?php
                                                if ($product_name[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $product_name[$i]);
                                                }
                                                ?>
                                                <input type="hidden" name="product_id[]" id="product_id_<?php echo $i;?>" value="<?php echo $product_ids[$i]; ?>">
                                            </td>

                                            <td class="text-center px-2 py-2">
                                                <?php
                                                    echo $obj->encode_decode('decrypt', $unit_names[$i]);
                                                ?>
                                                <input type="hidden" name="unit_id[]" value="<?php echo $unit_ids[$i]; ?>">
                                                <input type="hidden" name="unit_name[]" value="<?php echo $unit_names[$i]; ?>">
                                                <input type="hidden" name="unit_type[]" value="<?php echo $unit_types[$i]; ?>">
                                            </td>

                                            <td class="text-center px-2 py-2">
                                                <?php 
                                                if(!empty($content[$i]) && $content[$i] != $GLOBALS['null_value']){
                                                    echo $content[$i];
                                                }else{ 
                                                    echo " - ";
                                                } ?>
                                                <input type="hidden" name="content[]"  class="form-control shadow-none" value="<?php  if(!empty($content[$i]) && ($content[$i] != $GLOBALS['null_value'])){ echo $content[$i]; }else{ echo "NULL"; } ?>">
                                            </td>
                                           
                                            <td class="text-center px-2 py-2">
                                                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php echo $quantity[$i]; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcTotalQuantity('<?php echo $i;?>');">
                                            </td>
                                            <th class="text-center px-2 py-2">
                                                <?php 
                                                    if(!empty($stock_action[$i])) { 
                                                        if($stock_action[$i] == '1') {
                                                            echo 'Add';
                                                        }
                                                        else if($stock_action[$i] == '2') {
                                                            echo 'Remove';
                                                        }
                                                    } 
                                                ?>
                                                <input type="hidden" name="stock_action[]" class="form-control shadow-none" value="<?php if(!empty($stock_action[$i])) { echo $stock_action[$i]; } ?>">
                                            </th>
                                            <td class="text-center px-2 py-2">
                                            <?php
                                               $negative_stock_allowed = "";
                                               $negative_stock_allowed = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'negative_stock');

                                               
                                               $inward_quantity = 0; $outward_quantity = 0;
                                                    $show_button = 0;
                                                        if($stock_action[$i] == '1') {
                                                            $inward_quantity = 0; $outward_quantity = 0;
                                                            if(!empty($location_id[$i])) {
                                                                if(empty($content[$i]) || $content[$i] == $GLOBALS['null_value']){
                                                                    $content[$i] = "";
                                                                }
                                                                if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                                                                    $inward_quantity = $obj->getInwardQty($show_stock_adjustment_id, $location_id[$i], '', $product_ids[$i], $content[$i]);
                                                                    $outward_quantity = $obj->getOutwardQty('',$location_id[$i],'', $product_ids[$i], $content[$i]);
                                                                }else{
                                                                    $inward_quantity = $obj->getInwardQty($show_stock_adjustment_id, '',$location_id[$i], $product_ids[$i], $content[$i]);
                                                                    $outward_quantity = $obj->getOutwardQty('', '',$location_id[$i], $product_ids[$i], $content[$i]);
                                                                }
                                                            }
                                                            
                                                            if($negative_stock_allowed == 0){
                                                    
                                                                if($inward_quantity >= $outward_quantity){
                                                                    $show_button = 1;
                                                                }
                                                            }else if($negative_stock_allowed == 1){
                                                                $show_button = 1;
                                                            }
                                                        }
                                                        else if($stock_action[$i] == '2') {
                                                            $show_button = 1;
                                                        }

                                                    
                                                        if($show_button == '1') { ?>
                                                              <button class="btn btn-danger" type="button" onclick="Javascript:DeleteStockAdjRow('<?php echo $i; ?>', 'product_row');">
                                                             <i class="fa fa-trash"></i>
                                                             </button>
                                                        <?php } else { ?>
                                                        <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>
                                                    <?php } ?>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mx-0 my-3">
                    <div class="col-lg-8 col-md-6 col-12 text-end">
                        <h4>Total Quantity : <span class="overall_qty"></span></h3>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-danger" type="button"  onClick="Javascript:SaveModalContent(event,'stock_adjustment_form', 'stock_adjustment_changes.php', 'stock_adjustment.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                jQuery(document).ready(function(){
                    <?php
                        if(!empty($show_stock_adjustment_id)) { 
                            ?>
                            calcTotalQuantity();
                            show_godown_magazine('<?php if(!empty($product_group)){ echo $product_group; } ?>');
                            show_product('<?php if(!empty($product_group)){ echo $product_group; } ?>');
                            <?php 
                        }
                    ?>
                });
            </script>
              <script type="text/javascript">     
                jQuery(document).ready(function(){
                    jQuery('input[name="selected_quantity"]').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            if(jQuery('.add_products_button').length > 0) {
                                jQuery('.add_products_button').trigger('click');
                            }
                        }
                    });
                });
            </script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/stock_adjustment.js"></script>
            <script type="text/javascript" src="include/js/creation_modules.js"></script>
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
        }


        $entry_date = ""; $entry_date_error = ""; $bill_date = ""; $bill_date_error = "";
        $godown_id = ""; $godown_id_error = ""; $magazine_id = ""; $magazine_id_error = ""; $product_ids = array();
        $unit_ids = array(); $quantity = array(); $stock_action = array(); $remarks = ""; $remarks_error = ""; $product_error = ""; 
        $product_names = array(); $unit_names = array(); $stock_unique_ids = array(); $total_quantity = 0;
        $location_ids = array(); $contents = array();$stock_action = array(); $location_names = array(); $location_type ="";
        $valid_stockadjustment = ""; $form_name = "stock_adjustment_form"; $edit_id = ""; $product_group = ""; $product_group_error = "";
        $group_ids = array(); $unit_types = array();
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        
        
        $entry_date = $_POST['entry_date'];
        $entry_date = trim($entry_date);
        $entry_date_error = $valid->valid_date($entry_date, 'Entry Date', '1');
        if(!empty($entry_date_error)) {
       
                $valid_stockadjustment = $valid->error_display($form_name, 'entry_date', $entry_date_error, 'text');
        }

        if(isset($_POST['product_group'])) {
            $product_group = $_POST['product_group'];
            $product_group = trim($product_group);
            if(empty($product_group)){
                $product_group_error = "Select Product Group";
            }
        }
        if(!empty($product_group_error)) {
            if(!empty($valid_stockadjustment)) {
                $valid_stockadjustment = $valid_stockadjustment." ".$valid->error_display($form_name, 'product_group', $product_group_error, 'select');
            }
            else {
                $valid_stockadjustment = $valid->error_display($form_name, 'product_group', $product_group_error, 'select');
            }
        }

        if(isset($_POST['location_type'])) {
            $location_type = $_POST['location_type'];
            $location_type = trim($location_type);
            if(empty($location_type)){
                $location_type_error = "Select Type";
            }
        }
        if(!empty($location_type_error)) {
            if(!empty($valid_stockadjustment)) {
                $valid_stockadjustment = $valid_stockadjustment." ".$valid->error_display($form_name, 'location_type', $location_type_error, 'select');
            }
            else {
                $valid_stockadjustment = $valid->error_display($form_name, 'location_type', $location_type_error, 'select');
            }
        }
        if(isset($_POST['godown_id'])) {
            $godown_id = $_POST['godown_id'];
            $godown_id = trim($godown_id);
            $godown_id_error = $valid->common_validation($godown_id, 'Godown', 'select');
            if(empty($godown_id_error)) {
                $godown_unique_id = "";
                $godown_unique_id = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'id');
                if(!preg_match("/^\d+$/", $godown_unique_id)) {
                    $godown_id_error = "Invalid Godown";
                }
            }
        }
        if(!empty($godown_id_error)) {
            if(!empty($valid_stockadjustment)) {
                $valid_stockadjustment = $valid_stockadjustment." ".$valid->error_display($form_name, 'godown_id', $godown_id_error, 'select');
            }
            else {
                $valid_stockadjustment = $valid->error_display($form_name, 'godown_id', $godown_id_error, 'select');
            }
        }

     

        if(isset($_POST['remarks'])) {
            $remarks = $_POST['remarks'];
            $remarks = trim($remarks);
            if(empty($remarks)) {
                $remarks_error = "Enter the Remark";
            } else {
                $remarks_error = $valid->valid_address($remarks, 'Remarks', 'textarea');
            }
        }
        if(!empty($remarks_error)) {
            if(!empty($valid_stockadjustment)) {
                $valid_stockadjustment = $valid_stockadjustment." ".$valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
            }
            else {
                $valid_stockadjustment = $valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
            }
        }

        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
        }
        if(isset($_POST['unit_id'])) {
            $unit_ids = $_POST['unit_id'];
        }
        if(isset($_POST['content'])) {
            $case_contains = $_POST['content'];
        }
        if(isset($_POST['unit_type'])) {
            $unit_types = $_POST['unit_type'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        // print_r($quantity);
        if(isset($_POST['stock_action'])) {
            $stock_action = $_POST['stock_action'];
        }
        if(isset($_POST['location_id'])) {
            $location_ids = $_POST['location_id'];
        }
        if(isset($_POST['group_name'])) {
            $group_names = $_POST['group_name'];
        }
        if(!empty($product_ids)) {
            for($i=0; $i < count($product_ids); $i++) {
                $product_qty = "";
                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;
                    $group_id = "";
                    $group_ids[$i] = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'group_id');
                    $product_unit_id = "";
                    $product_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'unit_id');
                    $product_subunit_id = "";
                    $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    if(!empty($unit_ids[$i])) {
                        $unit_unique_id = "";
                        $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'id');
                            $unit_name = "";
                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                            $unit_names[$i] = $unit_name;
                            if(empty($case_contains[$i]) && $case_contains[$i] == $GLOBALS['null_value']){
                                $case_contains[$i] = "";
                            }
                            if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                                $location_names[] = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_ids[$i], 'godown_name');
                            }
                            else if($product_group  == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
                                $location_names[] = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $location_ids[$i], 'magazine_name');
                            }
                            if(!empty($edit_id)) {
                                if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                                    $stock_unique_ids[] = $obj->getStockUniqueID($edit_id, $location_ids[$i], '', $product_ids[$i], $unit_ids[$i], $case_contains[$i]);
                                }
                                else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
                                    $stock_unique_ids[] = $obj->getStockUniqueID($edit_id,'', $location_ids[$i], $product_ids[$i], $unit_ids[$i],$case_contains[$i]);
                                }

                            }
                            // if($unit_ids[$i] == $product_unit_id) {
                            //     $unit_types = 1; 
                            // }  else if ($unit_ids[$i] == $product_subunit_id) {
                            //     $unit_types = 2;
                            // } else {
                            //     $unit_types = ""; 
                            // }
                            $quantity[$i] = trim($quantity[$i]);
                            if(!empty($quantity[$i])) {
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) {
                                    $total_quantity += $quantity[$i];
                                    $stock_action[$i] = trim($stock_action[$i]);
                                    if(!empty($stock_action[$i])) {
                                        if($stock_action[$i] == '1' || $stock_action[$i] == '2') {
                                            $inward_quantity = 0; $outward_quantity = 0; $current_stock = 0;

                                            if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                                                $inward_quantity = $obj->getInwardQty($edit_id,$location_ids[$i], '', $product_ids[$i],$case_contains[$i]);
                                                $outward_quantity = $obj->getOutwardQty($edit_id, $location_ids[$i], '', $product_ids[$i],$case_contains[$i]);
                                            }else{
                                                $inward_quantity = $obj->getInwardQty($edit_id,'',$location_ids[$i], $product_ids[$i],$case_contains[$i]);
                                                $outward_quantity = $obj->getOutwardQty($edit_id,'', $location_ids[$i], $product_ids[$i],$case_contains[$i]);
                                            }

                                            if ($unit_types[$i] == '1') {
                                                 $product_qty = $quantity[$i];
                                            } else if ($unit_types[$i] == '2') {
                                                $product_qty = $quantity[$i] / $case_contains[$i];
                                            }

                                            if($case_contains[$i] == $GLOBALS['null_value']) {
                                                $case_contains[$i] = 0;
                                            }
                                     
                                            $individual_product_detail[] = array('godown_id' => $location_ids[$i],'product_id' => $product_ids[$i],'subunit_content' => $case_contains[$i],'quantity' => $product_qty,'stock_action_type' =>$stock_action[$i]);
                                        }
                                        else {
                                            $product_error = "Invalid Stock Action in Product - ".($obj->encode_decode('decrypt', $product_name));
                                        }
                                    }
                                    else {
                                        $product_error = "Empty Stock Action in Product - ".($obj->encode_decode('decrypt', $product_name));
                                    }
                                }
                                else {
                                    $product_error = "Invalid Quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                                }
                            }
                            else {
                                $product_error = "Empty Quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                            }
                       
                    }
                    else {
                        $product_error = "Empty Unit in Product - ".($obj->encode_decode('decrypt', $product_name));
                    }
                }
                else {
                    $product_error = "Invalid Product";
                }
                array_multisort(array_column($individual_product_detail, "godown_id"), SORT_ASC, array_column($individual_product_detail, "subunit_content"), SORT_ASC, array_column($individual_product_detail, "product_id"), SORT_ASC, $individual_product_detail);
                if(empty($valid_stockadjustment))
                {
                    $final_array = combineAndSumUp($individual_product_detail);
                }

            }
            
        }
        else {
            $product_error = "Add Products";
        }

        $stock_error = 0; $valid_stock = "";
        if(!empty($final_array) && empty($valid_stockadjustment))
        {
            foreach($final_array as $data)
            {
                $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0; $current_stock_subunit = 0;
                $subunit_need = 0; $product ="";
                $current_stock_subunit = 0; $available_stock_unit = 0; $available_stock_subunit = 0;
                if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
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

                if($data['stock_action_type'] == 1){
                    $inward_unit += $data['quantity'];
                    if(!empty($data['subunit_content']) && $data['subunit_content'] != $GLOBALS['null_value']){
                         $inward_subunit += ($data['quantity'] * $data['subunit_content']);
                    }
                } else if($data['stock_action_type'] == 2){
                    $outward_unit += $data['quantity'];
                    if(!empty($data['subunit_content']) && $data['subunit_content'] != $GLOBALS['null_value']){
                        $outward_subunit -= ($data['quantity'] * $data['subunit_content']);
                    }
                }

                // echo $inward_subunit."/".$outward_subunit;
                $current_stock_unit = $inward_unit - $outward_unit;
                $current_stock_subunit = $inward_subunit - $outward_subunit;

                if(($current_stock_unit < 0) && ($data['stock_action_type'] != 1)) {
                    $product = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'product_name');
                    $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'subunit_need');


                    if(!empty($product)) {
                        $product = $obj->encode_decode("decrypt",$product);
                    }
                   
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

                    $negative_stock = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'negative_stock');
                    if($negative_stock !='1')
                    {
                        if($subunit_need == 1) {
                            $valid_stock = "Max stock for <b>" . $product_name . "</b> with " .  $unit_name . " & " . (!empty($data['subunit_content'] && $data['subunit_content'] != "NULL") ? ($data['subunit_content'] . " " . $sub_unit_name ) : "") . "<br>Current Stock : " . $available_stock_unit . " " . $unit_name . " & " . $available_stock_subunit . " " . $sub_unit_name;
                            $stock_error = 1;
                        } else {
                            $valid_stock = "Max stock for <b>" . $product_name . "</b> with " .  $unit_name . "<br>Current Stock : " . $available_stock_unit . " " . $unit_name;
                            $stock_error = 1;
                        }  
            
                        $stock_error = 1;
                    }
                }
            }
        }

        if(empty($product_error) && empty($total_quantity)) {
            $product_error = "Bill Quantity cannot be 0";
        }
        // echo $valid_stock .= "ki";
        if(!empty($edit_id) && empty($product_error) && empty($valid_stock)) {
            $prev_stock_list = array();
            $prev_stock_list = $obj->PrevStockList($edit_id);
            if(!empty($prev_stock_list)) {
                foreach($prev_stock_list as $data) {
                    $stock_id = ""; $stock_godown_id = ""; $stock_magazine_id = ""; $stock_category_id = ""; $stock_group_id = ""; $stock_product_id = ""; $stock_table_action = ""; $stock_case_contains = "";
                    $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0;
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
                    }
                    if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $stock_godown_id = $data['godown_id'];
                    }
                    if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_magazine_id = $data['magazine_id'];
                    }
                 
                    if(!empty($data['group_id']) && $data['group_id'] != $GLOBALS['null_value']) {
                        $stock_group_id = $data['group_id'];
                    }
                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $stock_product_id = $data['product_id'];
                    }
                    if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                        $stock_case_contains = $data['case_contains'];
                    }
                    if(!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward_unit = $data['inward_unit'];
                        $stock_table_action = "Plus";
                    }
                    if(!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                        $inward_subunit = $data['inward_subunit'];
                        $stock_table_action = "Plus";
                    }
                    if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                        $stock_table_action = "Minus";
                    }
                    if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                        $outward_subunit = $data['outward_subunit'];
                        $stock_table_action = "Minus";
                    }
                    // if(!empty($data['stock_action']) && $data['stock_action'] != $GLOBALS['null_value']) {
                    //     $stock_table_action = $data['stock_action'];
                    // }
                    $current_stock_unit = 0; $current_stock_subunit = 0; $stock_table_unique_id = ""; $stock_unique_table = "";

                    if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {

                        $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                        $current_stock_unit = $obj->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $stock_godown_id, '',  $stock_product_id,$stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($GLOBALS['stock_by_godown_table'], $stock_godown_id, $stock_category_id, $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($GLOBALS['stock_by_godown_table'], $stock_godown_id, $stock_category_id, $stock_product_id, $stock_case_contains);
                    }
                    else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
                        $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                        $current_stock_unit = $obj->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'], '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($GLOBALS['stock_by_magazine_table'], '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($GLOBALS['stock_by_magazine_table'], '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    }
                    if($stock_table_action == "Plus") {
                        if(!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            // echo $current_stock_unit." // ".$inward_unit."<br>";

                            $current_stock_unit = $current_stock_unit - $inward_unit;
                        }
                        else {
                            $current_stock_unit = 0;
                        }
                        if(!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit - $inward_subunit;
                        }
                        else {
                            $current_stock_subunit = 0;
                        }
                    }
                    else if($stock_table_action == "Minus") {
                        if(!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            $current_stock_unit = $current_stock_unit + $outward_unit;
                        }
                        else {
                            $current_stock_unit = 0;
                        }
                        if(!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit + $outward_subunit;
                        }
                        else {
                            $current_stock_subunit = 0;
                        }
                    }
                    // echo $stock_id."*";
                    // print_r($stock_unique_ids);
                    // echo $stock_table_unique_id."<br>";
                    // echo $current_stock_unit."/".$current_stock_subunit."<br>";

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
                }
            }
        }

        // echo $product_error = "hi";

        $result = "";
        if(empty($valid_stockadjustment) && empty($product_error) && empty($valid_stock)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $factory_id = ""; $factory_name_city = ""; $factory_details = ""; 
                $godown_name_city = ""; $godown_details = ""; 
                $magazine_name_city = ""; $magazine_details = "";
                $category_name = "";

                if(!empty($entry_date)) {
                    $entry_date = date('Y-m-d', strtotime($entry_date));
                }
                if(!empty($category_id)) {
                    $category_name = $obj->getTableColumnValue($GLOBALS['category_table'], 'category_id', $category_id, 'name');
                }
                else {
                    $category_id = $GLOBALS['null_value'];
                    $category_name = $GLOBALS['null_value'];
                }
    
                if(!empty($remarks)) {
                    $remarks = $obj->encode_decode('encrypt', $remarks);
                }
                else {
                    $remarks = $GLOBALS['null_value'];
                }
                if(!empty($product_ids)) {
                    $product_ids = implode(",", $product_ids);
                }
                if(!empty($unit_types)) {
                    $unit_types = implode(",", $unit_types);
                }
                if(!empty($product_names)) {
                    $product_names = implode(",", $product_names);
                }
                if(!empty($unit_ids)) {
                    $unit_ids = implode(",", $unit_ids);
                }
                if(!empty($group_names)) {
                    $group_names = implode(",", $group_names);
                }
                if(!empty($location_ids)) {
                    $location_ids = implode(",", $location_ids);
                }
                if(!empty($unit_names)) {
                    $unit_names = implode(",", $unit_names);
                }
                if(!empty($quantity)) {
                    $quantity = implode(",", $quantity);
                }
                if(!empty($stock_action)) {
                    $stock_action = implode(",", $stock_action);
                }
                if(!empty($location_names)) {
                    $location_names = implode(",", $location_names);
                }
                if(!empty($case_contains)) {
                    $case_contains = implode(",", $case_contains);
                }
                if(!empty($group_ids)) {
                    $group_ids = implode(",", $group_ids);
                }
                
                $bill_company_details = array();
                $bill_company_details = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $stock_update = 0;
                if(empty($edit_id)) {
                    $action = "";
                    $action = "Stock Adjusted.";
                    
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'stock_adjustment_id', 'location_type','stock_adjustment_number', 'entry_date', 'location_id', 'bill_company_id', 'bill_company_details', 'group_name', 'location_name', 'product_id', 'product_name', 'unit_id', 'unit_name', 'quantity', 'content','stock_action', 'remarks', 'total_quantity', 'group_id', 'product_group', 'unit_type','cancelled', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$location_type."'","'".$null_value."'", "'".$entry_date."'", "'".$location_ids."'", "'".$GLOBALS['null_value']."'", "'".$bill_company_details."'", "'".$group_names."'", "'".$location_names."'", "'".$product_ids."'", "'".$product_names."'", "'".$unit_ids."'", "'".$unit_names."'", "'".$quantity."'", "'".$case_contains."'","'".$stock_action."'", "'".$remarks."'", "'".$total_quantity."'", "'".$group_ids."'","'".$product_group."'", "'".$unit_types."'","'0'", "'0'");

                    $stockadjustment_insert_id = $obj->InsertSQL($GLOBALS['stock_adjustment_table'], $columns, $values,'stock_adjustment_id', 'stock_adjustment_number', $action);

                    if(preg_match("/^\d+$/", $stockadjustment_insert_id)) {
                        $stock_update = 1;
                        $stock_adjustment_id = $obj->getTableColumnValue($GLOBALS['stock_adjustment_table'], 'id', $stockadjustment_insert_id, 'stock_adjustment_id');
                        $stock_adjustment_number = $obj->getTableColumnValue($GLOBALS['stock_adjustment_table'], 'id', $stockadjustment_insert_id, 'stock_adjustment_number');
                        $result = array('number' => '1', 'msg' => 'Stock Adjusted Successfully');
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $stockadjustment_insert_id);
                    }
                }
                else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        $action = "Stock Adjustment Updated.";

                        $columns = array(); $values = array();						
                        $columns = array('creator_name', 'entry_date', 'bill_company_details', 'group_name', 'location_name', 'bill_company_details', 'bill_company_id', 'location_id', 'location_type', 'product_id', 'product_name', 'unit_id', 'unit_name', 'quantity', 'stock_action', 'remarks', 'total_quantity','content','group_id','product_group','unit_type');
                        $values = array("'".$creator_name."'", "'".$entry_date."'","'".$bill_company_details."'", "'".$group_names."'", "'".$location_names."'", "'".$bill_company_details."'", "'".$bill_company_id."'", "'".$location_ids."'", "'".$location_type."'", "'".$product_ids."'", "'".$product_names."'", "'".$unit_ids."'", "'".$unit_names."'", "'".$quantity."'", "'".$stock_action."'", "'".$remarks."'", "'".$total_quantity."'","'".$case_contains."'","'".$group_ids."'","'".$product_group."'","'".$unit_types."'");    

                        $stockadjustment_update_id = $obj->UpdateSQL($GLOBALS['stock_adjustment_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $stockadjustment_update_id)) {
                            $stock_update = 1;
                            $stock_adjustment_id = $edit_id;
                            $stock_adjustment_number = $obj->getTableColumnValue($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $edit_id, 'stock_adjustment_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $stockadjustment_update_id);
                        }							
                    }
                }	
                if($stock_update == '1') {
                    if(!empty($stock_adjustment_id) && !empty($stock_adjustment_number) && !empty($entry_date) && !empty($product_ids)) {
                        $product_ids = explode(",", $product_ids);
                        $unit_ids = explode(",", $unit_ids);
                        $quantity = explode(",", $quantity);
                        $case_contains = explode(",", $case_contains);
                        $location_ids = explode(",", $location_ids);
                        $stock_action = explode(",", $stock_action);
                        $group_ids = explode(",", $group_ids);


                        $remarks = $obj->encode_decode('encrypt',$stock_adjustment_number);
                        for($i=0; $i < count($product_ids); $i++) {

                    
                            if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
                                if($stock_action[$i] == '1') {
                                    $stock_update = $obj->StockUpdate($GLOBALS['stock_adjustment_table'], "In",$stock_adjustment_id, $stock_adjustment_number,  $product_ids[$i],$remarks, $entry_date, $location_ids[$i], '', $unit_ids[$i], $quantity[$i],$case_contains[$i],$group_ids[$i],'1');
                                }
                                else if($stock_action[$i] == '2') {
                                    $stock_update = $obj->StockUpdate($GLOBALS['stock_adjustment_table'], "Out", $stock_adjustment_id, $stock_adjustment_number,  $product_ids[$i],$remarks, $entry_date, $location_ids[$i], '', $unit_ids[$i], $quantity[$i],$case_contains[$i],$group_ids[$i],'1');
                                }
                            }else{
                                if($stock_action[$i] == '1') {
                                    $stock_update = $obj->StockUpdate($GLOBALS['stock_adjustment_table'], "In",$stock_adjustment_id, $stock_adjustment_number,  $product_ids[$i],$remarks, $entry_date, '', $location_ids[$i], $unit_ids[$i], $quantity[$i],$case_contains[$i],$group_ids[$i],'2');
                                }
                                else if($stock_action[$i] == '2') {
                                    $stock_update = $obj->StockUpdate($GLOBALS['stock_adjustment_table'], "Out", $stock_adjustment_id, $stock_adjustment_number,  $product_ids[$i],$remarks, $entry_date, '', $location_ids[$i], $unit_ids[$i], $quantity[$i],$case_contains[$i],$group_ids[$i],'2');
                                }
                            }
                        
                        }
                    }
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_stockadjustment)) {
                $result = array('number' => '3', 'msg' => $valid_stockadjustment);
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
        $from_date = ""; $to_date = ""; $search_text = ""; $filter_factory_id = ""; $filter_godown_id = ""; $filter_magazine_id = "";
        $show_bill = 0;
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        } 
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(!empty($login_factory_id)) {
            $filter_factory_id = $login_factory_id;
        }
        if(!empty($login_godown_id)) {
            $filter_godown_id = $login_godown_id;
        }
        if(!empty($login_magazine_id)) {
            $filter_magazine_id = $login_magazine_id;
        }
        $total_records_list = array();
        $total_records_list = $obj->getStockAdjustmentList($from_date, $to_date, $show_bill);

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['stock_adjustment_number']), $search_text) !== false) ) {
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
                        <th>Entry Date</th>
                        <th>Stock Adjustment Number</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; }   ?>
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td>
                                    <?php
                                        if(!empty($list['entry_date'])) {
                                            echo date('d-m-Y', strtotime($list['entry_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['stock_adjustment_number']) && $list['stock_adjustment_number'] != $GLOBALS['null_value']) {
                                            echo $list['stock_adjustment_number'];
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
                                    <?php 
                                    if(!empty($list['cancelled'])) {
                                        ?>
                                        <span style="color: red;">Cancelled</span>
                                        <?php	
                                    }	 ?>                            
                                </td>
                               <td>
                                  <?php
                                        if(!empty($list['remarks']) && $list['remarks'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt',$list['remarks']);
                                        }
                                    ?>
                               </td>
                                <td>
                                      
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink1"  class="btn btn-dark show-button"  data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <a class="dropdown-item" style="cursor:pointer;"  target="_blank" href="reports/rpt_stock_adjustment_a5.php?view_stock_adjustment_id=<?php if(!empty($list['stock_adjustment_id'])) { echo $list['stock_adjustment_id']; } ?>"><i class="fa fa-print"></i>&ensp;Print</a>
                                            <?php 
                                                $edit_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $edit_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($edit_access_error) && empty($list['cancelled'])) {
                                            ?> 
                                                    <a class="dropdown-item"  style="cursor:pointer;" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['stock_adjustment_id'])) { echo $list['stock_adjustment_id']; } ?>');"><i class="fa fa-pencil"></i>&ensp; Edit</a>
                                            <?php } ?>
                                            <?php 
                                                $delete_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $delete_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($delete_access_error) && empty($list['cancelled'])) { 
                                            ?>                                        
                                                <a class="dropdown-item" style="cursor:pointer;"  href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['stock_adjustment_id'])) { echo $list['stock_adjustment_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;Delete</a>
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
            </table>                
	    	<?php	
        }
	}

    
    if(isset($_REQUEST['delete_stock_adjustment_id'])) {
        $delete_stock_adjustment_id = $_REQUEST['delete_stock_adjustment_id'];
        $delete_stock_adjustment_id = trim($delete_stock_adjustment_id);
        $msg = "";
        if(!empty($delete_stock_adjustment_id)) {	
            $stock_adjustment_unique_id = "";
            $stock_adjustment_unique_id = $obj->getTableColumnValue($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $delete_stock_adjustment_id, 'id');
        
            if(preg_match("/^\d+$/", $stock_adjustment_unique_id)) {
                $stock_adjustment_number = "";
                $stock_adjustment_number = $obj->getTableColumnValue($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $delete_stock_adjustment_id, 'stock_adjustment_number');
            
                $action = "";
                if(!empty($stock_adjustment_number)) {
                    $action = "Stock Adjustment Cancelled. Bill No. - ".($stock_adjustment_number);
                }
                $stock_delete = "";
                $stock_delete = $obj->DeleteStockAdjustment($delete_stock_adjustment_id);
                if($stock_delete == '1') {
                    $columns = array(); $values = array();			
                    $columns = array('cancelled');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['stock_adjustment_table'], $stock_adjustment_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "Can't Delete. Stock goes to negative!";
                }
            }
            else {
                $msg = "Invalid Stock Adjustment";
            }
        }
        else {
            $msg = "Empty Stock Adjustment";
        }
        echo $msg;
        exit;	
    }

    ?>