<?php
	include("include.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['daily_production_module'];
        }
    }

	if(isset($_REQUEST['show_daily_production_id'])) {
        $show_daily_production_id = $_REQUEST['show_daily_production_id'];
        $show_daily_production_id = trim($show_daily_production_id);
        
        $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d');
        $entry_date = date('Y-m-d'); $bill_date = date('Y-m-d'); $contractor_id = "";
        $magazine_id = ""; $contractor_name_mobile_city = "";
        $product_ids = array(); $product_names = array(); $unit_ids = array(); $unit_names = array(); $quantity = array();
        $cooly_per_qty = array(); $cooly_rate = array(); $total_amount = ""; $contains = array();
        $daily_production_list = array();
        $daily_production_list = $obj->getTableRecords($GLOBALS['daily_production_table'], 'daily_production_id', $show_daily_production_id, '');
        if(!empty($daily_production_list)) {
            foreach($daily_production_list as $data) {
                if(!empty($data['entry_date'])) {
                    $entry_date = date('Y-m-d', strtotime($data['entry_date']));
                }
                if(!empty($data['bill_date'])) {
                    $bill_date = date('Y-m-d', strtotime($data['bill_date']));
                }
                if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                    $magazine_id = $data['magazine_id'];
                }
                if(!empty($data['contractor_id']) && $data['contractor_id'] != $GLOBALS['null_value']) {
                    $contractor_id = $data['contractor_id'];
                }
                if(!empty($data['contractor_name_mobile_city']) && $data['contractor_name_mobile_city'] != $GLOBALS['null_value']) {
                    $contractor_name_mobile_city = $data['contractor_name_mobile_city'];
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
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_names = $data['unit_name'];
                    $unit_names = explode(",", $unit_names);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                }
                if(!empty($data['cooly_per_qty']) && $data['cooly_per_qty'] != $GLOBALS['null_value']) {
                    $cooly_per_qty = $data['cooly_per_qty'];
                    $cooly_per_qty = explode(",", $cooly_per_qty);
                }
                if(!empty($data['cooly_rate']) && $data['cooly_rate'] != $GLOBALS['null_value']) {
                    $cooly_rate = $data['cooly_rate'];
                    $cooly_rate = explode(",", $cooly_rate);
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_amount = $data['total_amount'];
                }
                if(!empty($data['subunit_contains'])) {
                    $contains = $data['subunit_contains'];
                    $contains = explode(",", $contains);
                }
            }
        }

        $magazine_list = array();
        if(!empty($login_magazine_id)) {
            $magazine_id = $login_magazine_id;
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_magazine_id, '');
        }
        else {
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        }
        $magazine_count = 0;
        $magazine_count = count($magazine_list);

        $product_list =array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '');

        $count_of_product = 0; $selected_product_id = "";
        $count_of_product = count($product_list);
    
        $contractor_list = array();
        $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '', '');

        $finished_group_list = array();
        $finished_group_list = $obj->getTableRecords($GLOBALS['finished_group_table'], '', '', '');

        ?>
        <form class="poppins pd-20" name="daily_production_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_daily_production_id)) { ?>
                            <div class="h5">Edit Daily Production</div>
                        <?php } else { ?>
                            <div class="h5">Add Daily Production</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('daily_production.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_daily_production_id)) { echo $show_daily_production_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-4 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" name="entry_date" class="form-control shadow-none" value="<?php if(!empty($entry_date)) { echo $entry_date; } ?>" min="<?php /* if(!empty($from_date)) { echo $from_date; } */ ?>" max="<?php if(!empty($to_date)) { echo $to_date; } ?>">
                                    <label>Entry Date <span class="text-danger">*</span></label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="selected_contractor_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:GetProducts();" <?php if(!empty($show_daily_production_id)) { ?>disabled<?php } ?>>
                                        <option value="">Select Contractor</option>
                                        <?php
                                            if(!empty($contractor_list)) {
                                                foreach($contractor_list as $data) {
                                                    if(!empty($data['contractor_id']) && $data['contractor_id'] != $GLOBALS['null_value']) {
                                                        ?>
                                                        <option value="<?php echo $data['contractor_id']; ?>" <?php if((!empty($contractor_id) && $contractor_id == $data['contractor_id'])) { ?>selected<?php } ?>>
                                                            <?php
                                                                if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                                    echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                                } 
                                                            ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    <label>Select Contractor <span class="text-danger">*</span></label>
                                </div>
                            </div>       
                        </div>
                        <input type="hidden" name="selected_contractor_id" value="<?php if(!empty($contractor_id)) { echo $contractor_id; } ?>" <?php if(empty($show_daily_production_id)) { ?>disabled<?php } ?>>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="selected_magazine_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_daily_production_id)) { ?>disabled<?php } ?>>
                                        <option value="">Select Magazine</option>
                                        <?php
                                            if(!empty($magazine_list)) {
                                                foreach($magazine_list as $data) {
                                                    if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                                                        ?>
                                                        <option value="<?php echo $data['magazine_id']; ?>" <?php if((!empty($magazine_id) && $magazine_id == $data['magazine_id']) || !empty($magazine_count) && $magazine_count == 1) { ?>selected<?php } ?>>
                                                            <?php
                                                                if(!empty($data['name_location']) && $data['name_location'] != $GLOBALS['null_value']) {
                                                                    echo $obj->encode_decode('decrypt', $data['name_location']);
                                                                } 
                                                            ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    <label>Select Magazine <span class="text-danger">*</span></label>
                                </div>
                            </div>       
                        </div>
                    </div>
                    <input type="hidden" name="selected_magazine_id"  value="<?php if(!empty($magazine_id)) { echo $magazine_id; } ?>" <?php if(empty($show_daily_production_id)) { ?>disabled<?php } ?>>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-2 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="finished_group_id"  data-dropdown-css-class="select2-danger" onchange="GetGroupProducts();" style="width: 100%;">
                                        <option value="">Select</option>
                                        <?php if(!empty($finished_group_list)) {
                                            foreach($finished_group_list as $group) { ?>
                                                <option value="<?php if(!empty($group['finished_group_id'])) { echo $group['finished_group_id']; } ?>"><?php if(!empty($group['finished_group_name'])) { echo $obj->encode_decode('decrypt', $group['finished_group_name']); }?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <label>Finished Group</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="selected_product_id" class="select2 select2-danger"  onchange="Javascript:GetUnit(this.value);" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Product</option>
                                        <?php if (!empty($product_list)) {
                                            foreach ($product_list as $Pro_list) { ?>
                                                <option value="<?php if (!empty($Pro_list['product_id'])) {
                                                    echo $Pro_list['product_id'];
                                                } ?>" <?php if(!empty($count_of_product) && $count_of_product == 1){ ?> Selected <?php } ?>>
                                                    <?php 
                                                        if($count_of_product == 1){
                                                             $selected_product_id = $Pro_list['product_id'];
                                                         }
                                                    
                                                    if (!empty($Pro_list['product_name'])) {
                                                        echo $obj->encode_decode('decrypt', $Pro_list['product_name']);
                                                    } ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <label>Select Product <span class="text-danger">*</span></label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="selected_unit_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Unit</option>    
                                    </select>
                                    <label>Unit <span class="text-danger">*</span></label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 contains_div d-none">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="selected_contains" class="select2 select2-danger"  data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Product</option>
                                    </select>
                                    <label>Select Content <span class="text-danger">*</span></label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" class="form-control shadow-none" name="selected_quantity">
                                    <label>QTY <span class="text-danger">*</span></label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-1 col-md-2 col-12 py-2 px-lg-1 text-center">
                            <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddDailyProductionProducts();">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-10">
                            <div class="table-responsive text-center">
                                <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">
                                <table class="table nowrap cursor smallfnt table-bordered daily_production_product_table" id="daily_production_product_table">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th style="width:50px;">#</th>
                                            <th style="width:300px;">Product</th>
                                            <th style="width:150px;">Unit</th>
                                            <th style="width:100px;">Content</th>
                                            <th style="width:100px;">Qty</th>
                                            <th style="width:100px;">Cooly</th>
                                            <th style="width:100px;">Total Cooly</th>
                                            <th style="width:100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($product_ids)) {
                                                for($i=0; $i < count($product_ids); $i++) {
                                                    $product_subunit_need = 0;
                                                    $product_subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_need');
                                        ?>
                                                    <tr class="product_row" id="product_row<?php if(!empty($product_count)) { echo $product_count; } ?>">
                                                        <th class="text-center px-2 py-2 sno"><?php if(!empty($product_count)) { echo $product_count; } ?></th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($product_ids[$i])) {
                                                                    $product_name = "";
                                                                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                                                                    if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $product_name);
                                                                    }
                                                                }
                                                            ?>
                                                            <input type="hidden" name="product_id[]" value="<?php if(!empty($product_ids[$i])) { echo $product_ids[$i]; } ?>">
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($unit_ids[$i])) {
                                                                    $unit_name = "";
                                                                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                                                                    if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $unit_name);
                                                                    }
                                                                }
                                                            ?>
                                                            <input type="hidden" name="unit_id[]" value="<?php if(!empty($unit_ids[$i])) { echo $unit_ids[$i]; } ?>">
                                                        </th>
                                                        <?php if(!empty($contains[$i]) && $contains[$i] != $GLOBALS['null_value']){  ?>
                                                            <th class="text-center px-2 py-2">
                                                                <?php if(!empty($contains[$i])) { echo $contains[$i]; } ?>
                                                            </th>
                                                        <?php } else { ?>
                                                            <th> <?php echo " - "; ?></th>
                                                            <?php
                                                        } ?>
                                                        <input type="hidden" name="contains[]" class="form-control shadow-none" value="<?php if(!empty($contains[$i])) { echo $contains[$i]; } ?>">
                                                        <th class="text-center px-2 py-2">
                                                            <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calQuantityTotal(this);">
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <input type="text" name="cooly_per_qty[]" class="form-control shadow-none" value="<?php if(!empty($cooly_per_qty[$i])) { echo $cooly_per_qty[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calQuantityTotal(this);">
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <input type="text" name="cooly_amount[]" class="form-control shadow-none" value="<?php if(!empty($cooly_rate[$i])) { echo $cooly_rate[$i]; } ?>" readonly>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                            $negative_stock_allowed = "";
                                                            $negative_stock_allowed = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'negative_stock');
                                                            $inward_quantity = 0; $outward_quantity = 0;
                                                             if(!empty($contains[$i]) && $contains[$i] != $GLOBALS['null_value']){ 

                                                                $inward_quantity = $obj->getInwardQty($show_daily_production_id, '', $magazine_id, $product_ids[$i], $contains[$i]);
                                                                $outward_quantity = $obj->getOutwardQty('', '',$magazine_id, $product_ids[$i],$contains[$i]);
                                                             }else{
                                                                $inward_quantity = $obj->getInwardQty($show_daily_production_id, '', $magazine_id, $product_ids[$i], '');
                                                                $outward_quantity = $obj->getOutwardQty('', '',$magazine_id, $product_ids[$i],'');
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
                                                            if($show_button == '1') {

                                                            ?>
                                                                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteDailyProductionRow('<?php if(!empty($product_count)) { echo $product_count; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                            <?php } else { ?>
                                                                <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>
                                                            <?php } ?>
                                                        </th>
                                                    </tr>
                                        <?php
                                                    $product_count --;
                                                }
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
                            <div class="col-lg-4 col-md-6 col-12 text-end">
                                <h4>Total Cooly : <span class="overall_total"></span></h3>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'daily_production_form', 'daily_production_changes.php', 'daily_production.php');">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>     
            </div>
            <script type="text/javascript">     
                jQuery(document).ready(function(){
                    <?php
                        if(!empty($show_daily_production_id)) { 
                            ?>
                            calQuantityTotal();
                            GetProducts();
                            <?php 
                        }

                        if(empty($show_daily_production_id)) { 
                            if($count_of_product == 1){ ?>  GetUnit('<?php if(!empty($selected_product_id)) { echo  $selected_product_id; } ?>'); <?php } 
                        } 
                    ?>

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
                    if(($fvalue['magazine_id'] == $nvalue['magazine_id']) && ($fvalue['product_id'] == $nvalue['product_id'])  && ($fvalue['subunit_content'] == $nvalue['subunit_content'])) {    
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
        $magazine_id = ""; $magazine_id_error = ""; $contractor_id = ""; $contractor_id_error = "";
        $product_ids = array(); $unit_ids = array(); $quantity = array(); $cooly_per_qty = array(); $total_cooly = array(); $product_error = ""; $product_names = array(); $unit_names = array(); $total_quantity = 0; $total_amount = 0; $stock_unique_ids = array();
        $case_contains = array(); $cooly_amount = array();
        $valid_daily_production = ""; $form_name = "daily_production_form"; $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(isset($_POST['entry_date'])) {
            $entry_date = $_POST['entry_date'];
            $entry_date = trim($entry_date);
            $entry_date_error = $valid->valid_date($entry_date, 'Entry Date', '1');
            if(!empty($entry_date_error)) {
                if(!empty($valid_daily_production)) {
                    $valid_daily_production = $valid_daily_production." ".$valid->error_display($form_name, 'entry_date', $entry_date_error, 'text');
                } else {
                    $valid_daily_production = $valid->error_display($form_name, 'entry_date', $entry_date_error, 'text');
                }
            }
        }

        if(isset($_POST['selected_magazine_id'])) {

            $magazine_id = $_POST['selected_magazine_id'];
            $magazine_id = trim($magazine_id);
            $magazine_id_error = $valid->common_validation($magazine_id, 'Magazine', 'select');
            if(empty($magazine_id_error)) {
                $magazine_unique_id = "";
                $magazine_unique_id = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $magazine_id, 'id');
                if(!preg_match("/^\d+$/", $magazine_unique_id)) {
                    $magazine_id_error = "Invalid Magazine";
                }
            }
            if(!empty($magazine_id_error)) {
                if(!empty($valid_daily_production)) {
                    $valid_daily_production = $valid_daily_production." ".$valid->error_display($form_name, 'selected_magazine_id', $magazine_id_error, 'select');
                } else {
                    $valid_daily_production = $valid->error_display($form_name, 'selected_magazine_id', $magazine_id_error, 'select');
                }
            }
        }
        
        if(isset($_POST['selected_contractor_id'])) {
            $contractor_id = $_POST['selected_contractor_id'];
            $contractor_id = trim($contractor_id);
            $contractor_id_error = $valid->common_validation($contractor_id, 'Contractor', 'select');
            if(empty($contractor_id_error)) {
                $contractor_unique_id = "";
                $contractor_unique_id = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'id');
                if(!preg_match("/^\d+$/", $contractor_unique_id)) {
                    $contractor_id_error = "Invalid contractor";
                }
            }
            if(!empty($contractor_id_error)) {
                if(!empty($valid_daily_production)) {
                    $valid_daily_production = $valid_daily_production." ".$valid->error_display($form_name, 'selected_contractor_id', $contractor_id_error, 'select');
                }
                else {
                    $valid_daily_production = $valid->error_display($form_name, 'selected_contractor_id', $contractor_id_error, 'select');
                }
            }
        }

        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
        }
        if(isset($_POST['unit_id'])) {
            $unit_ids = $_POST['unit_id'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['contains'])) {
            $case_contains = $_POST['contains'];
        }
        if(isset($_POST['cooly_per_qty'])) {
            $cooly_per_qty = $_POST['cooly_per_qty'];
        }
        if(isset($_POST['cooly_amount'])) {
            $cooly_amount = $_POST['cooly_amount'];
        }
        $total_cooly = 0; $total_quantity = 0; $overall_cooly_total = 0; 
        if(!empty($product_ids)) {
            for($i=0; $i < count($product_ids); $i++) {
                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;
                    $group_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'group_id');
                    $product_unit_id = "";
                    $product_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'unit_id');
                    $product_subunit_id = "";
                    $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');
                    if(!empty($case_contains[$i])){
                        $case_contains[$i] = trim($case_contains[$i]);
                    } else {
                        $case_contains[$i] = $GLOBALS['null_value'];
                    }
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    if(!empty($unit_ids[$i])) {
                        $unit_type = ""; $product_qty = 0;
                        if($unit_ids[$i] == $product_unit_id) {
                            $unit_type = 1; 
                        } else if ($unit_ids[$i] == $product_subunit_id) {
                            $unit_type = 2;
                        } else {
                            $unit_type = ""; 
                        }
                        $unit_unique_id = "";
                        $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'id');
                        if(preg_match("/^\d+$/", $unit_unique_id)) {
                            $unit_name = "";
                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                            $unit_names[$i] = $unit_name;
                            if(!empty($edit_id)) {
                                $stock_unique_ids[] = $obj->getStockUniqueID($edit_id, '', $magazine_id, $product_ids[$i], $unit_ids[$i], $case_contains[$i]);
                            }
                            $quantity[$i] = trim($quantity[$i]);
                            if(!empty($quantity[$i])) {
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) {
                                    $total_quantity += $quantity[$i];

                                    if(!empty($cooly_amount[$i])){
                                        $overall_cooly_total += $cooly_amount[$i];
                                    }

                                    $negative_stock_allowed = "";
                                    $negative_stock_allowed = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'negative_stock');
                                    $inward_quantity = 0; $outward_quantity = 0; $current_stock_unit = 0;
                                    $inward_quantity = $obj->getInwardQty($edit_id, '', $magazine_id, $product_ids[$i], $case_contains[$i]);
                                    $outward_quantity = $obj->getOutwardQty('', '', $magazine_id, $product_ids[$i], $case_contains[$i]);

                                    if($unit_ids[$i] == $product_subunit_id && !empty($case_contains[$i]) && $case_contains[$i] != $GLOBALS['null_value']) {
                                        $inward_quantity = $inward_quantity * $case_contains[$i];
                                        $outward_quantity = $outward_quantity * $case_contains[$i];
                                    }
                                    $comparable_qty = 0;
                                    $comparable_qty = $inward_quantity + $quantity[$i];
                                    if(empty($negative_stock_allowed)){
                                        if($comparable_qty < $outward_quantity) {
                                            $accurate_qty = 0;
                                            $accurate_qty = $outward_quantity - $inward_quantity;
                                            $product_error = "Max Qty:  ".$accurate_qty." in Product - ".($obj->encode_decode('decrypt', $product_name));
                                        }
                                    }

                                    if ($unit_type == '1') {
                                        $product_qty = $quantity[$i];
                                    } else if ($unit_type == '2') {
                                        $product_qty = $quantity[$i] / $case_contains[$i];
                                    }

                                    $individual_product_detail[] = array('magazine_id' => $magazine_id,'product_id' => $product_ids[$i],'subunit_content' => $case_contains[$i],'quantity' => $product_qty); 
                            
                                } else {
                                    $product_error = "Invalid Quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                                }
                            } else {
                                $product_error = "Empty Quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                            }
                        } else {
                            $product_error = "Invalid Unit in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    } else {
                        $product_error = "Empty Unit in Product - ".($obj->encode_decode('decrypt', $product_name));
                    }
                } else {
                    $product_error = "Invalid Product";
                }

                array_multisort(array_column($individual_product_detail, "magazine_id"), SORT_ASC, array_column($individual_product_detail, "subunit_content"), SORT_ASC, array_column($individual_product_detail, "product_id"), SORT_ASC, $individual_product_detail);

                if(empty($valid_material_transfer)) {
                    $final_array = combineAndSumUp($individual_product_detail);
                }
            }
        } else {
            $product_error = "Add Products";
        }

        if(!empty($overall_cooly_total)) { 
            $overall_cooly_total = number_format($overall_cooly_total,2); 
            $overall_cooly_total = trim(str_replace(",", "", $overall_cooly_total));
        }
        $total_amount = number_format((float)$total_amount, 2, '.', '');

		$round_off = 0;
		if(!empty($total_amount)) {	
			if (strpos( $total_amount, "." ) !== false) {
				$pos = strpos($total_amount, ".");
				$decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
				if($decimal != "00") {
					if(strlen($decimal) == 1) {
						$decimal = $decimal."0";
					}
					if($decimal >= 50) {				
						$round_off = 100 - $decimal;
						if($round_off < 10) {
							$round_off = "0.0".$round_off;
						} else {
							$round_off = "0.".$round_off;
						}
						
						$total_amount = $total_amount + $round_off;
					} else {
						$decimal = "0.".$decimal;
						$round_off = "-".$decimal;
						$total_amount = $total_amount - $decimal;
					}
				}
			}
		}

        if(empty($product_error) && empty($total_amount)) {
            $product_error = "Bill value cannot be 0";
        }

        $stock_error = 0; $valid_stock = "";
        if(!empty($final_array) && empty($valid_daily_production)) {
            foreach($final_array as $data)
            {
                $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0; $current_stock_subunit = 0;
                $subunit_need =0;$subunit_need = 0; $product ="";
                $current_stock_subunit = 0; $available_stock_unit = 0; $available_stock_subunit = 0;
                
                $inward_unit = $obj->getInwardQty($edit_id,'',$data['magazine_id'],$data['product_id'],$data['subunit_content']);
                $outward_unit = $obj->getOutwardQty('','',$data['magazine_id'],$data['product_id'],$data['subunit_content']); 

                $inward_subunit = $obj->getInwardSubunitQty($edit_id,'',$data['magazine_id'],$data['product_id'],$data['subunit_content']);
                $outward_subunit = $obj->getOutwardSubunitQty('','',$data['magazine_id'],$data['product_id'],$data['subunit_content']); 
                $available_stock_unit = $inward_unit - $outward_unit;
                $available_stock_subunit = $inward_subunit - $outward_subunit;

                $inward_unit += $data['quantity'];
                if(!empty($data['subunit_content']) && $data['subunit_content'] != $GLOBALS['null_value']){
                      $inward_subunit += ($data['quantity'] * $data['subunit_content']);
                }

                $current_stock_unit = $inward_unit - $outward_unit;
                $current_stock_subunit = $inward_subunit - $outward_subunit;
                // echo ($data['quantity'] ." / ". $current_stock_unit);
                if($current_stock_unit < 0) {
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
                    if($negative_stock !='1') {
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

        if(!empty($edit_id)  && empty($product_error) && empty($valid_stock)) {
            $prev_stock_list = array();
            $prev_stock_list = $obj->PrevStockList($edit_id);
            if(!empty($prev_stock_list)) {
                foreach($prev_stock_list as $data) {
                    $stock_id = ""; $stock_magazine_id = "";  $stock_group_id = ""; $stock_product_id = "";
                    $inward_unit = 0; $inward_subunit = 0; $stock_case_contains = 0;
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
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
                    }
                    if(!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                        $inward_subunit = $data['inward_subunit'];
                    }

                    $current_stock_unit = 0; $current_stock_subunit = 0;
                    $current_stock_unit = $obj->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'], '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    $current_stock_subunit = $obj->getCurrentStockSubunit($GLOBALS['stock_by_magazine_table'], '', $stock_magazine_id,  $stock_product_id, $stock_case_contains);
                    if(!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                        $current_stock_unit = $current_stock_unit - $inward_unit;
                    }
                    else {
                        $current_stock_unit = 0;
                    }
                    if(!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                        $current_stock_subunit = $current_stock_subunit - $inward_subunit;
                    }
                    else {
                        $current_stock_subunit = $GLOBALS['null_value'];
                    }
                    $stock_table_unique_id = "";

                    $stock_table_unique_id = $obj->getStockTablesUniqueID($GLOBALS['stock_by_magazine_table'], '',$stock_magazine_id, $stock_product_id, $stock_case_contains);

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
                                $stock_table_update_id = $obj->UpdateSQL($GLOBALS['stock_by_magazine_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }

        $result = "";
        if(empty($valid_daily_production) && empty($product_error) && empty($valid_stock)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $factory_id = ""; $factory_name_location = ""; $magazine_name_location = ""; $contractor_name_mobile_city = ""; $contractor_details = ""; $factory_details = ""; $magazine_details = ""; 
                if(!empty($entry_date)) {
                    $entry_date = date('Y-m-d', strtotime($entry_date));
                }
       
                if(!empty($magazine_id)) {
                    $magazine_name_location = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $magazine_id, 'name_location');
                    $magazine_details = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $magazine_id, 'magazine_details');
                    $factory_id = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $magazine_id, 'factory_id');
                    if(!empty($factory_id) && $factory_id != $GLOBALS['null_value']) {
                        $factory_name_location = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'name_location');
                        $factory_details = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'factory_details');
                    }
                    else {
                        $factory_id = $GLOBALS['null_value'];
                        $factory_name_location = $GLOBALS['null_value'];
                        $factory_details = $GLOBALS['null_value'];
                    }
                }
                else {
                    $magazine_id = $GLOBALS['null_value'];
                    $magazine_name_location = $GLOBALS['null_value'];
                    $magazine_details = $GLOBALS['null_value'];
                    $factory_id = $GLOBALS['null_value'];
                    $factory_name_location = $GLOBALS['null_value'];
                    $factory_details = $GLOBALS['null_value'];
                }
                if(!empty($contractor_id)) {
                    $contractor_name_mobile_city = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'name_mobile_city');
                    $contractor_details = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'contractor_details');
        
                } else {
                    $contractor_id = $GLOBALS['null_value'];
                    $contractor_name_mobile_city = $GLOBALS['null_value'];
                }

                if(!empty($product_ids)) {
                    $product_ids = implode(",", $product_ids);
                }
                if(!empty($case_contains)) {
                    $case_contains = implode(",", $case_contains);
                }
                if(!empty($product_names)) {
                    $product_names = implode(",", $product_names);
                }
                if(!empty($unit_ids)) {
                    $unit_ids = implode(",", $unit_ids);
                }
                if(!empty($unit_names)) {
                    $unit_names = implode(",", $unit_names);
                }
                if(!empty($quantity)) {
                    $quantity = implode(",", $quantity);
                }
                if(!empty($cooly_amount)) {
                    $cooly_amount = implode(",", $cooly_amount);
                }
                if(!empty($cooly_per_qty)) {
                    $cooly_per_qty = implode(",", $cooly_per_qty);
                }
                
              
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $stock_update = 0; $bill_company_id = $GLOBALS['bill_company_id'];

                if(empty($bill_company_id)){
                    $bill_company_id = $GLOBALS['null_value'];
                }

                $company_details = array();
                $company_details = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');

                if(empty($edit_id)) {
                    $action = "";
                    $action = "New Daily Production Created.";

                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'daily_production_id', 'daily_production_number', 'entry_date', 'company_details','factory_id', 'factory_name_location', 'factory_details', 'magazine_id', 'magazine_name_location', 'magazine_details', 'contractor_id', 'contractor_name_mobile_city', 'contractor_details', 'product_id', 'product_name', 'unit_id', 'unit_name', 'quantity', 'subunit_contains', 'cooly_per_qty','cooly_rate', 'overall_cooly_total', 'total_quantity', 'cancelled', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$null_value."'", "'".$entry_date."'", "'".$company_details."'","'".$factory_id."'", "'".$factory_name_location."'", "'".$factory_details."'", "'".$magazine_id."'", "'".$magazine_name_location."'", "'".$magazine_details."'", "'".$contractor_id."'", "'".$contractor_name_mobile_city."'",  "'".$contractor_details."'", "'".$product_ids."'", "'".$product_names."'", "'".$unit_ids."'", "'".$unit_names."'", "'".$quantity."'", "'".$case_contains."'", "'".$cooly_per_qty."'","'".$cooly_amount."'", "'" . $overall_cooly_total . "'", "'".$total_quantity."'" ,"'0'", "'0'");
                    $daily_production_insert_id = $obj->InsertSQL($GLOBALS['daily_production_table'], $columns, $values,'daily_production_id', 'daily_production_number', $action);

                    if(preg_match("/^\d+$/", $daily_production_insert_id)) {
                        $stock_update = 1; $update_payment = 1;
                        $daily_production_id = $obj->getTableColumnValue($GLOBALS['daily_production_table'], 'id', $daily_production_insert_id, 'daily_production_id');
                        $daily_production_number = $obj->getTableColumnValue($GLOBALS['daily_production_table'], 'id', $daily_production_insert_id, 'daily_production_number');
                        $result = array('number' => '1', 'msg' => 'Daily Production Successfully Created');
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $daily_production_insert_id);
                    }
                }
                else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['daily_production_table'], 'daily_production_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        $action = "Daily Production Updated.";

                        $columns = array(); $values = array();						
                        $columns = array('creator_name', 'entry_date', 'company_details','factory_id', 'factory_name_location', 'factory_details', 'magazine_id', 'magazine_name_location', 'magazine_details', 'contractor_id', 'contractor_name_mobile_city', 'contractor_details', 'product_id', 'product_name', 'unit_id', 'unit_name', 'quantity', 'subunit_contains', 'cooly_per_qty','cooly_rate','overall_cooly_total', 'total_quantity');
                        $values = array("'".$creator_name."'", "'".$entry_date."'", "'".$company_details."'","'".$factory_id."'", "'".$factory_name_location."'", "'".$factory_details."'", "'".$magazine_id."'", "'".$magazine_name_location."'", "'".$magazine_details."'", "'".$contractor_id."'", "'".$contractor_name_mobile_city."'",  "'".$contractor_details."'", "'".$product_ids."'", "'".$product_names."'", "'".$unit_ids."'", "'".$unit_names."'", "'".$quantity."'", "'".$case_contains."'", "'".$cooly_per_qty."'","'".$cooly_amount."'", "'" . $overall_cooly_total . "'", "'".$total_quantity."'");    

                        $daily_production_update_id = $obj->UpdateSQL($GLOBALS['daily_production_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $daily_production_update_id)) {
                            $stock_update = 1; $update_payment = 1;
                            $daily_production_id = $edit_id;
                            $daily_production_number = $obj->getTableColumnValue($GLOBALS['daily_production_table'], 'daily_production_id', $edit_id, 'daily_production_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $daily_production_update_id);
                        }							
                    }
                }	
                if($stock_update == '1') {
                    if(!empty($daily_production_id) && !empty($daily_production_number) && !empty($entry_date) && !empty($product_ids)) {
                        $remarks = $obj->encode_decode('encrypt', $daily_production_number);
                        $product_ids = explode(",", $product_ids);
                        $unit_ids = explode(",", $unit_ids);
                        $quantity = explode(",", $quantity);
                        $case_contains = explode(",", $case_contains);

                        for($i=0; $i < count($product_ids); $i++) {

                            if(!empty($magazine_id)) {
                                $group_id = "";
                                $group_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'group_id');

                                $stock_update = $obj->StockUpdate($GLOBALS['daily_production_table'], "In", $daily_production_id, $daily_production_number, $product_ids[$i], $remarks, $entry_date,'',  $magazine_id,$unit_ids[$i],$quantity[$i], $case_contains[$i], $group_id,'2');
                            }
                        }
                    }
                }
                
                if ($update_payment == 1) {
                    $bill_date = date("Y-m-d");   $bill_number = $daily_production_number; $bill_type = "Daily Production";
                    $party_id = $contractor_id;  $party_name = $contractor_name_mobile_city; $party_type = 'Contractor';
                    $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value']; $bank_id = $GLOBALS['null_value'];
                    $bank_name = $GLOBALS['null_value'];  $credit  = 0; $debit = 0; $opening_balance = $GLOBALS['null_value']; $opening_balance_type = $GLOBALS['null_value']; $agent_id = $GLOBALS['null_value']; $agent_name = $GLOBALS['null_value'];
                    $opening_balance_type = 'Credit';
                    
                    if(!empty($overall_cooly_total)){
                        $credit = $overall_cooly_total;
                    }
                    if(empty($opening_balance_type)){
                        $opening_balance_type = $GLOBALS['null_value'];
                    }

                    $update_balance = "";
                    $update_balance = $obj->UpdateBalance($daily_production_id,$bill_number,$bill_date,$bill_type, $agent_id, $agent_name,$contractor_id,$party_name,$party_type,$payment_mode_id, $payment_mode_name, $bank_id, $bank_name, $credit,$debit, $opening_balance_type); 
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_daily_production)) {
                $result = array('number' => '3', 'msg' => $valid_daily_production);
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
        
        $from_date = ""; $to_date = ""; $search_text = ""; $filter_factory_id = ""; $filter_magazine_id = ""; $filter_contractor_id = "";
        $show_bill = 0;
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['filter_factory_id'])) {
            $filter_factory_id = $_POST['filter_factory_id'];
        }
        if(isset($_POST['filter_magazine_id'])) {
            $filter_magazine_id = $_POST['filter_magazine_id'];
        }
        if(isset($_POST['filter_contractor_id'])) {
            $filter_contractor_id = $_POST['filter_contractor_id'];
        }
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        // if(!empty($login_factory_id)) {
        //     $filter_factory_id = $login_factory_id;
        // }
        // if(!empty($login_magazine_id)) {
        //     $filter_magazine_id = $login_magazine_id;
        // }

        $total_records_list = array();
        $total_records_list = $obj->getDailyProductionList($from_date, $to_date, $filter_factory_id, $filter_magazine_id, $filter_contractor_id, $show_bill);

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['daily_production_number']), $search_text) !== false) ) {
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
    if(empty($view_access_error)) {  ?>
        <table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Entry Date</th>
                    <th>Daily Production No</th>
                    <th>Magazine</th>
                    <th>Contractor</th>
                    <th>Total Amount</th>
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
                                        if(!empty($list['entry_date'])) {
                                            echo date('d-m-Y', strtotime($list['entry_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['daily_production_number']) && $list['daily_production_number'] != $GLOBALS['null_value']) {
                                            echo $list['daily_production_number'];
                                        }
                                        
                                    ?>
                                    <div class="w-100 py-2">
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo " Creator : ". $list['creator_name'];
                                            }
                                            if(!empty($list['cancelled'])) {
                                            ?>
                                                <br><span style="color: red;">Cancelled</span>
                                            <?php
                                        }
                                        ?>                                        
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['magazine_name_location']) && $list['magazine_name_location'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['magazine_name_location']);
                                        }
                                    ?>
                                
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['contractor_name_mobile_city']) && $list['contractor_name_mobile_city'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['contractor_name_mobile_city']);
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['overall_cooly_total']) && $list['overall_cooly_total'] != $GLOBALS['null_value']) {
                                            echo $list['overall_cooly_total'];
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
                                        <a href="#" role="button" id="dropdownMenuLink1"  class="btn btn-dark show-button"  data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" target="_blank" style="cursor:pointer;" href="reports/rpt_daily_production_a5.php?view_daily_production_id=<?php if(!empty($list['daily_production_id'])) { echo $list['daily_production_id']; } ?>"><i class="fa fa-print"></i> &ensp; Print</a></li>
                                            <?php
                                                $edit_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $edit_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($edit_access_error) && empty($list['cancelled'])) { 
                                                    ?>
                                                <li><a class="dropdown-item" style="cursor:pointer;" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['daily_production_id'])) { echo $list['daily_production_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                <?php } 
                                                $delete_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $delete_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($delete_access_error) && empty($list['cancelled'])) {
                                                    $linked_count = 0;
                                                    if(!empty($linked_count)) {
                                                        ?>
                                                        <li><a style="cursor:pointer;" class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php }else{ ?>
                                                    <li><a style="cursor:pointer;" class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['daily_production_id'])) { echo $list['daily_production_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                    <?php } 
                                                        }
                                                ?>
                                        </ul>
                                    </div> 
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Sorry! No records found</td>
                        </tr> <?php 
                    } 
                ?>
            </tbody>
        </table>                  
        <?php 
    } 
}

if(isset($_REQUEST['delete_daily_production_id'])) {
    $delete_daily_production_id = $_REQUEST['delete_daily_production_id'];
    $delete_daily_production_id = trim($delete_daily_production_id);
    $msg = "";
    if(!empty($delete_daily_production_id)) {	
        $daily_production_unique_id = "";
        $daily_production_unique_id = $obj->getTableColumnValue($GLOBALS['daily_production_table'], 'daily_production_id', $delete_daily_production_id, 'id');
    
        if(preg_match("/^\d+$/", $daily_production_unique_id)) {
            $daily_production_number = "";
            $daily_production_number = $obj->getTableColumnValue($GLOBALS['daily_production_table'], 'daily_production_id', $delete_daily_production_id, 'daily_production_number');
        
            $action = "";
            if(!empty($daily_production_number)) {
                $action = "Daily Production Cancelled. Bill No. - ".$daily_production_number;
            }
            $stock_delete = "";
            $stock_delete = $obj->DeleteDailyProduction($delete_daily_production_id);
            if($stock_delete == '1') {
                $columns = array(); $values = array();			
                $columns = array('cancelled');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['daily_production_table'], $daily_production_unique_id, $columns, $values, $action);
            }
            else {
                $msg = "Can't Delete. Stock goes to negative!";
            }
        }
        else {
            $msg = "Invalid Daily Production";
        }
    }
    else {
        $msg = "Empty Daily Production";
    }
    echo $msg;
    exit;	
}



if(isset($_REQUEST['products_contractor_id'])) {
    $contractor_id = $_REQUEST['products_contractor_id'];
    $contractor_id = trim($contractor_id);
    $product_type = ""; $finished_product_group_id = "";
    $product_type = "finished";
    $product_type = $obj->encode_decode('encrypt',$product_type);
    if(!empty($product_type)){
        $finished_product_group_id = $obj->getTableColumnValue($GLOBALS['group_table'],'lower_case_name',$product_type,'group_id');
    }
    $product_list = array();
    if(!empty($contractor_id) && $contractor_id != "undefined") {
        $products_list = $obj->getContractorFinishedProducts($contractor_id,$finished_product_group_id);
    }

    $product_count = 0;
    $product_count = count($products_list);
    ?>
    <option value="">Select</option>
    <?php
    if(!empty($products_list)) {
        foreach($products_list as $data) {
            if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                ?>
                <option value="<?php echo $data['product_id']; ?>" <?php if(!empty($product_count) && $product_count == 1){ ?> Selected <?php } ?>>
                    <?php
                        if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $data['product_name']);
                        }
                    ?>
                </option>
                <?php
            }
        }
    }
}

if(isset($_REQUEST['get_unit'])) {
    $product_id = $_REQUEST['get_unit'];
    $product_id = trim($product_id);
    $magazine_id = $_REQUEST['product_magazine_id'];
    $magazine_id = trim($magazine_id);

    $unit_id = "";
    $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_id');

    $subunit_id = "";
    $subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
    $subunit_need = 0;
     $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');
    // $current_stock_unit = 0;
    // $current_stock_unit = $obj->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'],'', $magazine_id, $product_id, $case_contains);

    // $current_stock_subunit = 0;
    // $current_stock_subunit = $obj->getCurrentStockSubunit($GLOBALS['stock_by_magazine_table'], '',$magazine_id, $product_id, $case_contains);
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
            <option value="<?php echo $unit_id; ?>" <?php if(empty($subunit_need)){ ?> selected <?php } ?>>
                <?php
                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                    if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                        echo $obj->encode_decode('decrypt', $unit_name);
                    }
                ?>
            </option>
        <?php
    }
    if(!empty($subunit_id) && $subunit_id != $GLOBALS['null_value']) {
        ?>
            <option value="<?php echo $subunit_id; ?>">
                <?php
                    $subunit_name = "";
                    $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');
                    if(!empty($subunit_name) && $subunit_name != $GLOBALS['null_value']) {
                        echo $obj->encode_decode('decrypt', $subunit_name);
                    }
                ?>
            </option>
        <?php
    }
    ?>
    $$$
    <?php
    if($subunit_need == 1) {
       ?>
        <option value="">Select Content</option>
        <?php 
        if(!empty($case_contains)){
            $contains_count = 0;
            $contains_count = count($case_contains);
            for($i=0; $i< count($case_contains); $i++){ 
                if(!empty($case_contains[$i]) && $case_contains[$i] != $GLOBALS['null_value']) { ?>
                    <option value="<?php if(!empty($case_contains[$i]) && $case_contains[$i] != $GLOBALS['null_value']) { echo $case_contains[$i]; } ?>" <?php if(!empty($case_contains) && $case_contains[$i] != $GLOBALS['null_value'] && $contains_count == 1) { ?> selected <?php } ?>><?php echo  $case_contains[$i]; ?></option>
                    <?php 
                } 
            }
        }
    }
}
  /*  ?>
    
    <span class="w-100 text-center" style="font-weight:bold!important;">
        <?php if(!empty($unit_id) && !empty($product_id)) { ?>
        Current Stock By Unit (<?php echo number_format($current_stock_unit, 2); ?>)<br>
        <?php } ?>
        <?php if($subunit_id != $GLOBALS['null_value'] && !empty($product_id)) { ?>
        Current Stock By Subunit (<?php echo number_format($current_stock_subunit, 2); ?>)
        <?php } ?>
    </span> 
    <?php
    */

if(isset($_REQUEST['get_total'])) {
    $selected_product_ids = $_REQUEST['product_ids'];
    $selected_unit_ids = $_REQUEST['unit_ids'];
    $selected_contains = $_REQUEST['contains'];
    $selected_quantity = $_REQUEST['quantity'];

    $product_ids = array(); $unit_ids = array(); $contains = array(); $quantity = array();
    $product_ids = explode(',' , $selected_product_ids);
    $unit_ids = explode(',' , $selected_unit_ids);
    $contains = explode(',' , $selected_contains);
    $quantity = explode(',' , $selected_quantity);

    $unit_arrays = [];
    $unit_quantity = [];
    $sub_unit_arrays = [];
    $sub_unit_quantity = [];
    for($i = 0; $i < count($product_ids); $i++) {
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_ids[$i], '');

        foreach($product_list as $product) {
            if(!empty($product['unit_id'])) {
                if($product['unit_id'] == $unit_ids[$i] && $product['unit_id'] != "NULL") {
                    $unit_arrays[] = $unit_ids[$i];
                    $unit_quantity[] = $quantity[$i];
                } else if($product['subunit_id'] == $unit_ids[$i] && $product['subunit_id'] != "NULL") {
                    $sub_unit_arrays[] = $unit_ids[$i];
                    $sub_unit_quantity[] = $quantity[$i];
                }
            }
        }
    }

    $total_display = "";
    $unique_unit_arrays = [];
    $unique_unit_arrays = array_unique($unit_arrays);

    if(!empty($unique_unit_arrays) && count($unique_unit_arrays) == 1) {
        if(array_sum($unit_quantity) != 0) {
            $unit_name = "";
            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unique_unit_arrays[0], 'unit_name');
            if(!empty($unit_name)) {
                $unit_name = $obj->encode_decode('decrypt', $unit_name);
            }

            $total_display .= array_sum($unit_quantity) . ' ' . $unit_name;
        }
    } else {
        if(array_sum($unit_quantity) != 0) {
            $total_display .= array_sum($unit_quantity);
        }
    }

    $unique_sub_unit_arrays = [];
    $unique_sub_unit_arrays = array_unique($sub_unit_arrays);

    if(!empty($unique_sub_unit_arrays) && count($unique_sub_unit_arrays) == 1) {
        if(array_sum($sub_unit_quantity) != 0) {
            $unit_name = "";
            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unique_sub_unit_arrays[0], 'unit_name');
            if(!empty($unit_name)) {
                $unit_name = $obj->encode_decode('decrypt', $unit_name);
            }
            if(!empty($total_display)) {
                $total_display .= ' + ' . array_sum($sub_unit_quantity) . ' ' . $unit_name;
            } else {
                $total_display .= array_sum($sub_unit_quantity) . ' ' . $unit_name;
            }
        }
    } else {
        if(array_sum($sub_unit_quantity) != 0) {
            $total_display .= array_sum($sub_unit_quantity);
        }
    }

    echo $total_display;
}

if(isset($_REQUEST['product_daily_production_row_index'])) {
    $product_daily_production_row_index = $_REQUEST['product_daily_production_row_index'];
    $contractor_id = $_REQUEST['selected_contractor_id'];
    $product_id = $_REQUEST['selected_product_id'];
    $unit_id = $_REQUEST['selected_unit_id'];
    $quantity = $_REQUEST['selected_quantity'];
    $contains = $_REQUEST['selected_contains'];

    $product_unit_id = ""; $product_subunit_id = ""; $unit_type = ""; $party_type = "Contractor";
    $product_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_id');
    $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
    $product_subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');

    if($unit_id == $product_unit_id) {
        $unit_type = "Unit";
    } else if($unit_id == $product_subunit_id) {
        $unit_type = "Subunit";
    }
    
    $rate_per_unit = 0; $rate_per_subunit = 0; $contractor_unit_type = 0; $contractor_quantity = 0; $cooly_per_qty = 0; $total_cooly = 0; $rate_list = array();
    if(!empty($contractor_id) && $contractor_id != "undefined") {
        $rate_list = $obj->getCoolyRate($contractor_id, $product_id, $unit_type);
        if(!empty($rate_list)){
            foreach($rate_list as $data) {
                if(!empty($data['rate_per_unit'])){
                    $rate_per_unit = $data['rate_per_unit'];
                }
                if(!empty($data['rate_per_subunit'])){
                    $rate_per_subunit = $data['rate_per_subunit'];
                }
                if(!empty($data['quantity'])){
                    $contractor_quantity = $data['quantity'];
                }
                if(!empty($data['unit_type'])){
                    $contractor_unit_type = $data['unit_type'];
                }
            }
        }
    }

    $contractor_unit_id = $obj->getContractorProductUnitId($contractor_id, $product_id, $unit_type);

    $c_unit_name = "";
    if(!empty($contractor_unit_id)) {
        if(!empty($contractor_unit_id[0]) && !empty($contractor_unit_id[0]['unit_id'])) {
            $c_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $contractor_unit_id[0]['unit_id'], 'unit_name');
            if(!empty($c_unit_name)) {
                $c_unit_name = $obj->encode_decode('decrypt', $c_unit_name);
            }
        } else if(!empty($contractor_unit_id[0]) && !empty($contractor_unit_id[0]['subunit_id'])) {
            $c_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $contractor_unit_id[0]['subunit_id'], 'unit_name');
            if(!empty($c_unit_name)) {
                $c_unit_name = $obj->encode_decode('decrypt', $c_unit_name);
            }
        }
    }

    if($unit_type == 'Unit' && !empty($rate_per_unit)){
        $cooly_amount = $rate_per_unit * $quantity;
        $cooly_per_qty = $rate_per_unit;
    } else if($unit_type == 'Subunit' && !empty($rate_per_subunit)) {
        $cooly_amount = $rate_per_subunit * $quantity;
        $cooly_per_qty = $rate_per_subunit;
    } else if($unit_type == 'Unit' && !empty($rate_per_subunit) && empty($rate_per_unit)) {
        $rate_per_unit = $rate_per_subunit * $contains;
        $cooly_amount = $rate_per_unit * $quantity;
        $cooly_per_qty = $rate_per_unit;
    } else if($unit_type == 'Subunit' && empty($rate_per_subunit) && !empty($rate_per_unit)) {
        $rate_per_subunit = $rate_per_unit / $contains;
        $cooly_amount = $rate_per_subunit * $quantity;
        $cooly_per_qty = $rate_per_subunit;
    }

    if(!empty($cooly_per_qty)) { 
        $cooly_per_qty = number_format($cooly_per_qty,2); 
        $cooly_per_qty = trim(str_replace(",", "", $cooly_per_qty));
    }
    if(!empty($cooly_amount)) { 
        $cooly_amount = number_format($cooly_amount,2); 
        $cooly_amount = trim(str_replace(",", "", $cooly_amount));
    }
    ?>
    <tr class="product_row" id="product_row<?php if(!empty($product_daily_production_row_index)) { echo $product_daily_production_row_index; } ?>">
        <th class="text-center px-2 py-2 sno"><?php if(!empty($product_daily_production_row_index)) { echo $product_daily_production_row_index; } ?></th>
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
            <input type="hidden" name="unit_id[]" value="<?php if(!empty($unit_id)) { echo $unit_id; } ?>">
        </th>
        <?php if(!empty($contains) && $contains != $GLOBALS['null_value']){ ?>
            <th class="text-center px-2 py-2">
                 <?php if(!empty($contains)) { echo $contains; } ?>
            </th>
        <?php }else{ ?>
            <th> <?php echo " - "; ?></th>
            <?php
        } ?>
        <input type="hidden" name="contains[]" class="form-control shadow-none" value="<?php if(!empty($contains)) { echo $contains; } ?>">
        <th class="text-center px-2 py-2">
            <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity)) { echo $quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calQuantityTotal(this);">
        </th>
        <th class="text-center px-2 py-2">
            <input type="text" name="cooly_per_qty[]" class="form-control shadow-none" value="<?php if(!empty($cooly_per_qty)) { echo $cooly_per_qty; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calQuantityTotal(this);"><?php if(!empty($contains) && $contains != $GLOBALS['null_value']){ echo $contains . '/' . $c_unit_name; } else { echo $c_unit_name; }; ?>
        </th>
        <th class="text-center px-2 py-2">
            <input type="text" name="cooly_amount[]" class="form-control shadow-none" value="<?php if(!empty($cooly_amount)) { echo $cooly_amount; } ?>"  readonly>
        </th>
        <th class="text-center px-2 py-2">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteDailyProductionRow('<?php if(!empty($product_daily_production_row_index)) { echo $product_daily_production_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
        </th>
    </tr>
    <?php
}

if(isset($_REQUEST['get_product_by_group'])) {
    $finished_group_id = $_REQUEST['finished_group_id'];
    $contractor_id = $_REQUEST['contractor_id'];
    $product_list = array();

    if(!empty($contractor_id) && !empty($finished_group_id)) {
        $product_ids = array();
        $plist = $obj->getContractorFinishedProducts($contractor_id, '4d5449774e4449774d6a55784d4455794d7a4e664d44453d');
        
        foreach($plist as $product) {
            $fgid = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product['product_id'], 'finished_group_id');
            if(!empty($fgid) && $fgid != "NULL") {
                if($fgid == $finished_group_id) {
                    $product_data = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product['product_id'], '');
                    $product_list[] = $product_data[0];
                }
            }
        }
    } else if(!empty($finished_group_id)) {
        $product_query = "SELECT * FROM " . $GLOBALS['product_table'] . " WHERE finished_group_id = '" . $finished_group_id . "' AND deleted = '0'";
        $product_list = $obj->getQueryRecords($GLOBALS['product_table'], $product_query);
    } else {
        $product_query = "SELECT * FROM " . $GLOBALS['product_table'] . " WHERE group_id = '4d5449774e4449774d6a55784d4455794d7a4e664d44453d' AND deleted = '0'";
        $product_list = $obj->getQueryRecords($GLOBALS['product_table'], $product_query);
    }
    
    $product_count = 0;
    $product_count = count($product_list);

    ?>
    <option value="">Select Product</option>
    <?php
    if(!empty($product_list)) {
        foreach($product_list as $data) {
            // $current_stock_product = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'current_stock_unit');
            if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                $product_name = "";
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                ?>
                    <option value="<?php echo $data['product_id']; ?>" <?php if(!empty($product_count) && $product_count == 1){ ?> Selected <?php } ?>>
                        <?php
                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $product_name);
                        }
                    ?>
                </option>
                <?php
            }
        }
    }
}
?>