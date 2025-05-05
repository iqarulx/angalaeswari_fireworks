<?php
	include("include_user_check.php");
    
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['product_module'];
        }
    }

	if(isset($_REQUEST['show_product_id'])) { 
        $show_product_id = $_REQUEST['show_product_id'];
        $show_product_id = trim($show_product_id);
        $product_name = ""; $unit_id = ""; $subunit_id = ""; $subunit_contains = ""; $sales_rate = ""; $per = ""; $opening_stock = array(); $group_list = array(); $unit_list = array(); $subunit_need = 0; $per_type = 1; $negative_stock = 0; $product_row_index = 0; $stock_date = array(); $group_id = ""; $location_ids = array(); $location_names = array(); $unit_name = ""; $subunit_name = "";$hsn_code = "";$group_lowercase =""; $description = ""; $finished_group_id = "";

        if (!empty($show_product_id)) {
            $product_list = array();
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $show_product_id, '');
            if (!empty($product_list)) {
                foreach ($product_list as $data) {
                    if (!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                        $product_name = $obj->encode_decode('decrypt', $data['product_name']);
                    }
                    if (!empty($data['group_id']) && $data['group_id'] != $GLOBALS['null_value']) {
                        $group_id = $data['group_id'];
                    }
                    if ($data['subunit_need'] != $GLOBALS['null_value']) {
                        $subunit_need = $data['subunit_need'];
                    }
                    if (!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                        $unit_id = $data['unit_id'];
                    }
                    if (!empty($data['subunit_id']) && $data['subunit_id'] != $GLOBALS['null_value']) {
                        $subunit_id = $data['subunit_id'];
                    }
                    if (!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                        $unit_name = $data['unit_name'];
                    }
                    if (!empty($data['subunit_name']) && $data['subunit_name'] != $GLOBALS['null_value']) {
                        $subunit_name = $data['subunit_name'];
                    }
                    if (!empty($data['subunit_contains']) && $data['subunit_contains'] != $GLOBALS['null_value']) {
                        $subunit_contains = explode(",", $data['subunit_contains']);
                    }
                    if (!empty($data['sales_rate']) && $data['sales_rate'] != $GLOBALS['null_value']) {
                        $sales_rate = $data['sales_rate'];
                    }
                    if (!empty($data['per']) && $data['per'] != $GLOBALS['null_value']) {
                        $per = $data['per'];
                    }
                    if (!empty($data['per_type']) && $data['per_type'] != $GLOBALS['null_value']) {
                        $per_type = $data['per_type'];
                    }
                    if (!empty($data['location_id']) && $data['location_id'] != $GLOBALS['null_value']) {
                        $location_ids = explode(",", $data['location_id']);
                        $product_count = count($location_ids);
                    }
                    if (!empty($data['location_name']) && $data['location_name'] != $GLOBALS['null_value']) {
                        $location_names = explode(",", $data['location_name']);
                    }
                    if (!empty($data['opening_stock']) && $data['opening_stock'] != $GLOBALS['null_value']) {
                        $opening_stock = explode(",", $data['opening_stock']);
                    }
                    if (!empty($data['stock_date']) && $data['stock_date'] != $GLOBALS['null_value']) {
                        $stock_date = explode(",", $data['stock_date']);
                    }
                    if (!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                        $unit_type = explode(",", $data['unit_type']);
                    }
                    if (!empty($data['negative_stock'])) {
                        $negative_stock = $data['negative_stock'];
                    }
                    if(!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                        $hsn_code = $data['hsn_code'];
                    }
                    if(!empty($data['description']) && $data['description'] != $GLOBALS['null_value']) {
                        $description = $obj->encode_decode('decrypt', $data['description']);
                    }
                    if(!empty($data['finished_group_id']) && $data['finished_group_id'] != $GLOBALS['null_value']) {
                        $finished_group_id = $data['finished_group_id'];
                    }
                }
            }
        }
        $group_list = $obj->getTableRecords($GLOBALS['group_table'], '', '', '');

        $finished_group_list = array();
        $finished_group_list = $obj->getTableRecords($GLOBALS['finished_group_table'], '', '', '');

        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], '', '', '');

        $linked_count = 0;
        if(!empty($show_product_id)) {
            $linked_count = $obj->GetProductLinkedCount($show_product_id);
        }

        $opening_stock_count = 0;
        if(!empty($show_product_id)) {
            $opening_stock_count = $obj->getOpeningStockCount($show_product_id);
        }

        if(!empty($group_id)){
            $group_lowercase = $obj->getTableColumnValue($GLOBALS['group_table'],'group_id',$group_id,'lower_case_name');
            $group_lowercase = $obj->encode_decode('decrypt',$group_lowercase);
        } 

        ?>
        <form class="poppins pd-20" name="product_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if (empty($show_product_id)) { ?>
                            <div class="h5">Add Product</div>
                        <?php } else if (!empty($show_product_id)) { ?>
                                <div class="h5">Edit Product</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('product.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="Product_Fix_field" value="<?php if(!empty($show_product_id)) { echo $show_product_id; } ?>">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_product_id)) { echo $show_product_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger Product_Fix_field" name="group" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="ChangeLocation();getSalesRate();" <?php if(!empty($linked_count) || !empty($opening_stock_count)) { ?>disabled<?php } ?>>
                                <option value="">Select Group</option>
                                <?php
                                    if($group_list) {
                                        foreach($group_list as $group) { ?>
                                            <option value="<?php if(!empty($group['group_id'])){ echo $group['group_id']; } ?>" <?php if(!empty($group_id) && $group_id == $group['group_id']) { ?>selected<?php } ?>>
                                                <?php if(!empty($group['group_name'])) { echo $obj->encode_decode('decrypt', $group['group_name']); } ?>
                                            </option>
                                        <?php }
                                    }
                                ?>
                            </select>
                            <label>Select Group <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="group" value="<?php if(!empty($group_id)) { echo $group_id; } ?>" <?php if(empty($linked_count) && empty($opening_stock_count)) { ?>disabled<?php } ?>>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="product_name" class="form-control shadow-none" value="<?php if (!empty($product_name)) { echo $product_name; } ?>"  onkeyup="Javascript:InputBoxColor(this,'text');">
                            <label>Product Name <span class="text-danger">*</span></label>
                        </div>
                        <!-- <div class="new_smallfnt">Contains Text Only</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                           <input type="number" name="hsn_code" value="<?php if (!empty($hsn_code)) { echo $hsn_code; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                            <label>HSN Code <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Number Only</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger Product_Fix_field" name="unit_id" data-dropdown-css-class="select2-danger" onchange="AddUnitForStock();" style="width: 100%;" <?php if(!empty($linked_count) || !empty($opening_stock_count)) { ?>disabled<?php } ?>>
                                <option value="">Select Unit</option>
                                <?php
                                    if (!empty($unit_list)) {
                                        foreach ($unit_list as $data) {
                                            if (!empty($data['unit_id'])) {
                                                ?>
                                                <option value="<?php echo $data['unit_id']; ?>" <?php if (!empty($unit_id) && $data['unit_id'] == $unit_id) { ?>selected<?php } ?>>
                                                    <?php
                                                    if (!empty($data['unit_name'])) {
                                                        $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                        echo $data['unit_name'];
                                                    }
                                                    ?>

                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Select Unit <span class="text-danger">*</span></label>
                        </div>
                    </div>     
                    <input type="hidden" name="unit_id" value="<?php if(!empty($unit_id)) { echo $unit_id; } ?>" <?php if(empty($linked_count) && empty($opening_stock_count)) { ?>disabled<?php } ?>>
                    
                        <div class="form-group mb-1">
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="FormSelectDefault" class="form-label text-muted smallfnt">Need Sub Unit  YES / NO</label>
                                    <input name="subunit_need"  id="subunit_need"class="form-check-input code-switcher Product_Fix_field" type="checkbox"  onchange="Javascript:subunitNeed();AddUnitForStock();per_type_change();" value="<?php if ($subunit_need == '1') { echo '1';} else { echo '0'; } ?>" <?php if ($subunit_need == '1') { ?>checked="checked" <?php } ?> <?php if(!empty($linked_count) || !empty($opening_stock_count)) { ?>disabled<?php } ?>>
                                </div>
                            </div>
                        </div>    
                    
                    </div>

                    <input type="hidden" name="subunit_need" id="subunit_input" value="<?php if($subunit_need == '1'){echo '1';}else{echo '0';} ?>" <?php if(empty($linked_count) && empty($opening_stock_count)) { ?>disabled<?php } ?>>
                <div id="subunit_need_fields_div" class="col-lg-3 col-md-4 col-6 py-2 <?php if (empty($subunit_need)) { ?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <div class="input-group-append" style="width:100%;">
                                    <select name="subunit_id" class="select2 select2-danger select2-hidden-accessible Product_Fix_field" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="AddUnitForStock()" <?php if(!empty($linked_count) || !empty($opening_stock_count)) { ?>disabled<?php } ?> >
                                    <option value="">Select SubUnit</option>
                                    <?php
                                        if (!empty($unit_list)) {
                                            foreach ($unit_list as $data) {
                                                if (!empty($data['unit_id'])) {
                                                    ?>
                                                    <option value="<?php echo $data['unit_id']; ?>" <?php if (!empty($subunit_id) && $data['unit_id'] == $subunit_id) { ?>selected<?php } ?>>
                                                        <?php
                                                        if (!empty($data['unit_name'])) {
                                                            $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                            echo $data['unit_name'];
                                                        }
                                                        ?>

                                                    </option>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                    </select>
                                    <label>Sub Unit <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="subunit_id" value="<?php if(!empty($subunit_id)) { echo $subunit_id; } ?>" <?php if(empty($linked_count) && empty($opening_stock_count)) { ?>disabled<?php } ?>>
                 
                <div class="col-lg-3 col-md-4 col-12 py-2 sales_rate_div <?php if($group_lowercase !='finished'){ ?>d-none<?php }?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control shadow-none " id="sales_rate" name="sales_rate" value="<?php if (!empty($sales_rate)) { echo $sales_rate; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                            <label>Sales Rate <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Number Only</div>
                    </div>
                </div>
              
                <input type="hidden" name="rate_per_case">
                <input type="hidden" name="rate_per_piece">
                <div class="col-lg-3 col-md-4 col-12 py-2 per_div <?php if($group_lowercase !='finished'){ ?>d-none<?php }?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                            <input type="text" id="per" name="per" class="form-control shadow-none " value="<?php if (!empty($per)) { echo $per; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',7,'');" onkeyup="Javascript:InputBoxColor(this,'text');">
                            <label>Per <span class="text-danger">*</span></label>
                            <div class="input-group-append" style="width:50%!important;">
                                <select name="per_type" class="select2 select2-danger " data-dropdown-css-class="select2-danger" style="width: 100%;" >
                                    <option value="1" <?php if($per_type == '1') { ?>selected<?php } ?>>Unit</option>
                                    
                                    <?php if($subunit_need == '1') { ?>
                                        <option value="2" <?php if($per_type == '2') { ?>selected<?php } ?>>Subunit</option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">  
                    <div class="form-group mb-1">
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="negative_stock" class="form-label text-muted" style="font-size: 12px;">Allow Negative Stock YES / NO</label>
                            <input name="negative_stock" class="form-check-input code-switcher" type="checkbox" id="negative_stock_button" onChange="Javascript:ShowNegativeStockDetails(this);" value="<?php if ($negative_stock == '1') { echo '1'; } else { echo '0'; } ?>" <?php if ($negative_stock == '1') { ?>checked="checked" <?php } ?> <?php if (!empty($linked_count) || !empty($opening_stock_count)) { ?>disabled<?php } ?>>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="description" name="description" placeholder="Enter Your Description" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');"><?php if(!empty($description)) { echo $description; } ?></textarea>
                            <label>Description</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 finished_group_div d-none">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="finished_group_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Filter Group</option>
                                <?php
                                    if (!empty($finished_group_list)) {
                                        foreach ($finished_group_list as $data) {
                                            if (!empty($data['finished_group_id'])) {
                                                ?>
                                                <option value="<?php echo $data['finished_group_id']; ?>" <?php if (!empty($finished_group_id) && $data['finished_group_id'] == $finished_group_id) { ?>selected<?php } ?>>
                                                    <?php
                                                    if (!empty($data['finished_group_name'])) {
                                                        $data['finished_group_name'] = $obj->encode_decode('decrypt', $data['finished_group_name']);
                                                        echo $data['finished_group_name'];
                                                    }
                                                    ?>

                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Finished Group</label>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row justify-content-center p-3">
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="location" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Location</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <input type="hidden" name="godown_magazine">
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                        <input type="date" name="selected_stock_date" class="form-control shadow-none" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>">
                            <label>Stock Date</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                        <input type="text" name="selected_quantity" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="FindTotalQty()">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_unit_type" data-dropdown-css-class="select2-danger" onchange="FindTotalQty()" style="width: 100%!important;">
                                <option value="1">Unit</option>
                                <?php if ($subunit_need == '1') { ?>
                                    <option value="2">Subunit</option>
                                <?php } ?>
                            </select>
                            <label>Type</label>
                        </div>
                    </div>        
                </div>
                <div id="subunit_need_fields" class="col-lg-1 col-md-3 col-6 px-lg-1 py-2 <?php if (empty($subunit_need)) { ?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                        <input type="text" name="selected_content" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="FindTotalQty()">
                            <label>Content</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                        <input type="number" name="selected_total_qty" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="FindTotalQty()">
                            <label class="px-0">Total Qty</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1  py-2">
                    <button class="btn btn-danger py-2" onclick="Javascript:AddProductStock();" style="font-size:12px; width:100%;" type="button"> Add </button>
                </div>
                <div class="col-lg-10">
                    <div class="table-responsive text-center">
                    <input type="hidden" name="godown_count" value="<?php if (!empty($product_count)) { echo $product_count; } else { echo "0"; } ?>">

                        <table class="table nowrap cursor smallfnt w-100 table-bordered product_stock_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Location Name</th>
                                    <th>Unit Type</th>
                                    <th>Stock Date</th>
                                    <th style="width:150px;">Opening Stock</th>
                                    <th class="<?php if (empty($subunit_need)) { ?>d-none<?php } ?>" id="subunit_need_fields_th">Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!empty($location_ids)) {
                                    for ($i = 0; $i < count($location_ids); $i++) {
                                        ?>
                                        <tr class="product_row" id="product_row<?php echo $i; ?>">
                                            <th class="sno text-center px-2 py-2">
                                                <?php echo $i+1; ?>
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                if (!empty($location_names[$i]) && $location_names[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $location_names[$i]);
                                                }
                                                ?>
                                                <input type="hidden" name="location_id[]" value="<?php if (!empty($location_ids[$i])) {
                                                    echo $location_ids[$i];
                                                } ?>">

                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                               if($unit_type[$i] == '1') {
                                                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                                                    echo $obj->encode_decode('decrypt', $unit_name);
                                                } else {
                                                     $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');
                                                    echo $obj->encode_decode('decrypt', $subunit_name);
                                                }
                                                ?>
                                                <input type="hidden" name="unit_type[]" value="<?php if (!empty($unit_type[$i])) {
                                                    echo $unit_type[$i];
                                                } ?>">
                                            </th>
                                          
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                if (!empty($stock_date[$i])) {
                                                    echo date('d-M-Y', strtotime($stock_date[$i]));
                                                }
                                                ?>
                                                <input type="hidden" name="stock_date[]" value="<?php if (!empty($stock_date[$i])) {
                                                    echo $stock_date[$i];
                                                } ?>">
                                            </th>

                                            <th class="text-center px-2 py-2">
                                                <?php if (!empty($opening_stock[$i])) {
                                                    echo $opening_stock[$i];
                                                } else { echo 0; } ?>
                                                <input type="hidden" name="opening_stock[]" class="form-control shadow-none" value="<?php if (!empty($opening_stock[$i])) { echo $opening_stock[$i]; } else { echo 0; } ?>">
                                            </th>
                                           
                                            <th class="text-center px-2 py-2 <?php if (empty($subunit_need)) { ?>d-none<?php } ?>" id="subunit_need_fields_th">

                                                <?php if (!empty($subunit_contains[$i])) {
                                                    echo $subunit_contains[$i];
                                                } else {
                                                    echo "-";
                                                } ?>
                                                <input type="hidden" name="content[]" value="<?php if (!empty($subunit_contains[$i])) {
                                                    echo $subunit_contains[$i];
                                                } ?>">
                                            </th>
                                            <th class="text-center text-danger px-2 py-2">
                                                <?php if (empty($linked_count)) { ?>
                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $i; ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    Can't Delete
                                                <?php } ?>
                                            </th>
                                        </tr>
                                        <?php
                                        
                                    }
                                }

                                ?>
                            </tbody> 
                        </table>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                <button class="btn btn-danger " type="button" onClick="SaveModalContent(event,'product_form', 'product_changes.php', 'product.php');">
                    Submit
                </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/action.js"></script>
            <script type="text/javascript" src="include/js/product_upload.js"></script>
            <script>
                 jQuery(document).ready(function () {
                    AddUnitForStock();
                    subunitNeed();
                    CalProductAmount();
                    per_type_change();     
                    ChangeLocation();
                    <?php if(count($location_ids) > 0) { ?>
                        // DisableProduct_Fix_field();
                    <?php } ?>
                   
                    
                });
               
            </script>
        </form>
		<?php
    }

    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; 
        
        $search_text = ""; $filter_group = "";

        if (isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }

        if (isset($_POST['filter_group'])) {
            $filter_group = $_POST['filter_group'];
        }

        if (isset($_POST['filter_finished_group'])) {
            $filter_finished_group = $_POST['filter_finished_group'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getProductsListing($filter_group, $filter_finished_group);

        if (!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if (!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if ((strpos(strtolower($obj->encode_decode('decrypt', $val['product_name'])), $search_text) !== false)) {
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
        if (!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if ($total_pages > $page_limit) {
                if ($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            } else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }
        $show_records_list = array();
        if (!empty($total_records_list)) {
            foreach ($total_records_list as $key => $val) {
                if ($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }

        $prefix = 0;
        if (!empty($page_number) && !empty($page_limit)) {
            $prefix = ($page_number * $page_limit) - $page_limit;
        }
        if ($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3">
                <?php
                include("pagination.php");
                ?>
            </div>
        <?php } ?>
        <?php
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if (empty($access_error)) {
        ?>
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th>Group Name</th>
                        <th>Product Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($show_records_list)) {
                        foreach ($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if (!empty($prefix)) {
                                $index = $index + $prefix;
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php echo $index; ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($list['group_name']) && $list['group_name'] != $GLOBALS['null_value']) {
                                        echo $obj->encode_decode('decrypt', $list['group_name']);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($list['product_name']) && $list['product_name'] != $GLOBALS['null_value']) {
                                        echo $obj->encode_decode('decrypt', $list['product_name']);
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
                                            <button class="btn btn-dark show-button poppins" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php
                                                if (empty($edit_access_error)) {
                                                    ?>
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if (!empty($page_title)) {
                                                        echo $page_title;
                                                    } ?>', '<?php if (!empty($list['product_id'])) {
                                                        echo $list['product_id'];
                                                    } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                <?php } ?>
                                                <?php
                                             
                                                if (empty($delete_access_error)) {
                                                    $linked_count = 0;
                                                    $linked_count = $obj->GetProductLinkedCount($list['product_id']); 
                                                    if ($linked_count > 0) { ?>
                                                        <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if (!empty($page_title)) {
                                                            echo $page_title;
                                                        } ?>', '<?php if (!empty($list['product_id'])) {
                                                            echo $list['product_id'];
                                                        } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>

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
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Sorry! No records found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>               
            <?php	
        }
    }

    if (isset($_REQUEST['unit_select_change'])) {
        $list = json_decode($_REQUEST['unit_select_change'], true);
        

        $option = "";
        foreach ($list as $option_list) {
            if ($option_list['subunit_need'] == '1') {
                if (!empty($option_list['unit_id'])) {
                    $case = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $option_list['unit_id'], 'unit_name');
                    $case = $obj->encode_decode('decrypt', $case);
                } else {
                    $case = "Unit";
                }
                  
                $option .= "<option value='1'";
                if ($option_list['per_type'] == '1') {
                    $option .= " selected";
                }
                $option .= ">$case</option>";

    
                if (!empty($option_list['subunit_id'])) {
                    $piece = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $option_list['subunit_id'], 'unit_name');
                    $piece = $obj->encode_decode('decrypt', $piece);
                } else {
                    $piece = "SubUnit";
                }
               
                $option .= "<option value='2'";
                if ($option_list['per_type'] == '2') {
                    $option .= " selected";
                }
                $option .= ">$piece</option>";
                
            } else {
                if (!empty($option_list['unit_id'])) {
                    $case = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $option_list['unit_id'], 'unit_name');
                    $case = $obj->encode_decode('decrypt', $case);
                } else {
                    $case = "Unit";
                }
                $option = $option . "<option value = '1' selected>" . $case . "</option>";
            }
    
            echo $option;
        }
    }

    if(isset($_REQUEST['group_change_get_location'])) {
        $group_id = $_REQUEST['group_change_get_location'];
        $option = "<option value=''>Select Location</option>";
        $location_list = "";
        $getUniqueID = 1;
        $getUniquename = $obj->getTableColumnValue($GLOBALS['group_table'],'group_id',$group_id,'lower_case_name');
        $getUniquename = $obj->encode_decode('decrypt', $getUniquename);
        if(!empty($getUniquename)) {
            if ($getUniquename == 'finished') {
                $getUniqueID = 2;
                $location_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
                if(!empty($location_list)) {
                    foreach($location_list as $list) {
                        $option = $option."<option value='".$list['magazine_id']."'>".$obj->encode_decode('decrypt',$list['magazine_name'])."</option>";
                    }
                }
            } else {
                $location_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
                if(!empty($location_list)) {
                    foreach($location_list as $list) {
                        $option = $option."<option value='".$list['godown_id']."'>".$obj->encode_decode('decrypt',$list['godown_name'])."</option>";
                    }   
                }
            }
        }
        echo $option . "$$$" .  $getUniqueID;
    }

    if(isset($_REQUEST['product_row_index'])){
        $product_row_index = $_REQUEST['product_row_index'];
        $location_id = $_REQUEST['location'];
        $unit_type = $_REQUEST['selected_unit_type'];
        $stock_date = $_REQUEST['selected_stock_date'];
        $quantity = $_REQUEST['selected_quantity'];
        $content = $_REQUEST['selected_content'];
        $godown_magazine = $_REQUEST['godown_magazine'];
        $subunit_need = $_REQUEST['subunit_need'];
        ?>
        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
            <th class="sno text-center px-2 py-2"><?php if (!empty($product_row_index)) {
                echo $product_row_index;
            } ?></th>
    
            <th class="text-center px-2 py-2">
                <?php
                $location_name = "";
                if($godown_magazine == 1) {
                    $location_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_id, 'godown_name');
                } else {
                    $location_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $location_id, 'magazine_name');
                }
                if ($location_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $location_name);
                }
                ?>
                <input type="hidden" name="location_id[]" value="<?php if (!empty($location_id)) {
                    echo $location_id;
                } ?>">
    
            </th>
            <th class="text-center px-2 py-2">
                <?php
                if (!empty($unit_type)) {
                    if ($unit_type == '1') {
                        echo "Unit";
                    } else if ($unit_type == '2') {
                        echo "Subunit";
                    }
                }
                ?>
                <input type="hidden" name="unit_type[]" value="<?php if (!empty($unit_type)) {
                    echo $unit_type;
                } ?>">
            </th>

            <th class="text-center px-2 py-2">
                <?php
                if (!empty($stock_date)) {
                    echo date('d-M-Y', strtotime($stock_date));
                }
                ?>
                <input type="hidden" name="stock_date[]" value="<?php if (!empty($stock_date)) {
                    echo $stock_date;
                } ?>">
            </th>
            <th class="text-center px-2 py-2">
                <input type="text" name="opening_stock[]" class="form-control shadow-none" value="<?php if (!empty($quantity)) { echo $quantity; } else { echo 0; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
            </th>
            <th class="text-center px-2 py-2 <?php if($subunit_need == '0') { ?>d-none<?php } ?>"> 
                <input type="hidden" name="content[]" class="form-control shadow-none"
                    onfocus="Javascript:KeyboardControls(this,'number',8,'');" value="<?php if (!empty($content)) {
                        echo $content;
                    } ?>">
                    <?php if (!empty($content)) {
                        echo $content;
                    } ?>
            </th>
            <th class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php if (!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
            </th>
        </tr>
        <?php
    }

    if (isset($_POST['edit_id'])) {
        $product_name = ""; $product_name_error = ""; $unit_id = ""; $unit_id_error = ""; $subunit_id = ""; $subunit_id_error = ""; $subunit_contains = ""; $subunit_contains_error = ""; $sales_rate = ""; $sales_rate_error = ""; $per = ""; $per_error = ""; $per_type = ""; $per_type = ""; $opening_stock = array(); $stock_unique_ids = array();
        $subunit_need = 0; $location_name = array(); $stock_date = array(); $per_type = ""; $unit_type = array(); $unit_type_name = array(); $negative_stock = 0; $rate_per_piece = 0; $rate_per_case = 0; $contents = ""; $valid_product = ""; $form_name = "product_form"; $edit_id = ""; $group = ""; $group_error = ""; $godown_magazine = ''; $location_ids = array();$hsn_code = ""; $hsn_code_error = ""; $group_lowercase = ""; $description = ""; $finished_group_id = "";

        if (isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        // print_r($_POST);
        if (isset($_POST['group'])) {
            $group = $_POST['group'];
            $group = trim($group);
            $group_error = $valid->common_validation($group, 'Group Name', 'select');
            if (!empty($group_error)) {
                if (!empty($valid_product)) {
                    $valid_product = $valid_product . " " . $valid->error_display($form_name, 'group', $group_error, 'select');
                } else {
                    $valid_product = $valid->error_display($form_name, 'group', $group_error, 'select');
                }
            }
        }

        if(!empty($group)){
            $group_lowercase =$obj->getTableColumnValue($GLOBALS['group_table'],'group_id',$group,'lower_case_name');
            $group_lowercase = $obj->encode_decode('decrypt',$group_lowercase);
        } 

        if (isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
            $product_name = trim($product_name);
            $product_name_error = $valid->valid_product_name($product_name, 'Product Name', '1', '50');
            if (!empty($product_name_error)) {
                if (!empty($valid_product)) {
                    $valid_product = $valid_product . " " . $valid->error_display($form_name, 'product_name', $product_name_error, 'text');
                } else {
                    $valid_product = $valid->error_display($form_name, 'product_name', $product_name_error, 'text');
                }
            }
        }

        if(isset($_POST['hsn_code'])) {
            $hsn_code = $_POST['hsn_code'];
            $hsn_code = trim($hsn_code);
        }
        $hsn_code_error = $valid->valid_number($hsn_code, "Hsn Code", "1", "8");
        if (!empty($hsn_code_error)) {
            if (!empty($valid_product)) {
                $valid_product = $valid_product . " " . $valid->error_display($form_name, 'hsn_code', $hsn_code_error, 'text');
            } else {
                $valid_product = $valid->error_display($form_name, 'hsn_code', $hsn_code_error, 'text');
            }
        }

        if(isset($_POST['description'])) {
            $description = $_POST['description'];
            $description = trim($description);
        }

        if(isset($_POST['finished_group_id'])) {
            $finished_group_id = $_POST['finished_group_id'];
            $finished_group_id = trim($finished_group_id);
        }

        if (isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
            $unit_id = trim($unit_id);
            $unit_id_error = $valid->common_validation($unit_id, 'Unit', 'select');
            if (empty($unit_id_error)) {
                $unit_unique_id = "";
                $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'id');
                if (!preg_match("/^\d+$/", $unit_unique_id)) {
                    $unit_id_error = "Invalid Unit";
                }
            }
            if (!empty($unit_id_error)) {
                if (!empty($valid_product)) {
                    $valid_product = $valid_product . " " . $valid->error_display($form_name, 'unit_id', $unit_id_error, 'select');
                } else {
                    $valid_product = $valid->error_display($form_name, 'unit_id', $unit_id_error, 'select');
                }
            }
        }
    
        if (isset($_POST['subunit_need'])) {
            $subunit_need = $_POST['subunit_need'];
        }
        if (isset($_POST['negative_stock'])) {
            $negative_stock = $_POST['negative_stock'];
        }
        if (isset($_POST['rate_per_case'])) {
            $rate_per_case = $_POST['rate_per_case'];
        }
        if (isset($_POST['rate_per_piece'])) {
            $rate_per_piece = $_POST['rate_per_piece'];
        }
        if ($subunit_need == '1') {
            if (isset($_POST['subunit_id'])) {
                $subunit_id = $_POST['subunit_id'];
                $subunit_id = trim($subunit_id);
                $subunit_id_error = $valid->common_validation($subunit_id, 'Subunit', 'select');
                if (empty($subunit_id_error)) {
                    $unit_unique_id = "";
                    $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'id');
                    if (!preg_match("/^\d+$/", $unit_unique_id)) {
                        $subunit_id_error = "Invalid Subunit";
                    }
                }
                if (!empty($subunit_id_error)) {
                    if (!empty($valid_product)) {
                        $valid_product = $valid_product . " " . $valid->error_display($form_name, 'subunit_id', $subunit_id_error, 'select');
                    } else {
                        $valid_product = $valid->error_display($form_name, 'subunit_id', $subunit_id_error, 'select');
                    }
                }
            }
        }

        if($group_lowercase =='finished'){ 

            if (isset($_POST['sales_rate'])) {
                $sales_rate = $_POST['sales_rate'];
                $sales_rate = trim($sales_rate);
                $sales_rate_error = $valid->valid_price($sales_rate, 'Sales Rate', 1, '99999');
                if (empty($sales_rate_error) && !empty($sales_rate) && $sales_rate > 99999) {
                    $sales_rate_error = "Only 99999 is allowed";
                }
            }
            if (isset($_POST['per'])) {
                $per = $_POST['per'];
                $per = trim($per);
                $per_error = $valid->valid_price($per, 'Per Unit', 1, '99999');
                if (empty($per_error) && !empty($per) && $per > 99999) {
                    $per_error = "Only 99999 is allowed";
                }
                if (isset($_POST['per_type'])) {
                    $per_type = $_POST['per_type'];
                    $per_type = trim($per_type);
                }
            }
            if (empty($per) && !empty($sales_rate) && empty($per_error)) {
                $per_error = "Enter per value (Sales Rate is given)";
            }
            if (!empty($per) && empty($sales_rate) && empty($sales_rate_error)) {
                $sales_rate_error = "Enter Sales Rate (Per is given)";
            }
            if (!empty($sales_rate_error)) {
                if (!empty($valid_product)) {
                    $valid_product = $valid_product . " " . $valid->error_display($form_name, 'sales_rate', $sales_rate_error, 'text');
                } else {
                    $valid_product = $valid->error_display($form_name, 'sales_rate', $sales_rate_error, 'text');
                }
            }
            if (!empty($per_error)) {
                if (!empty($valid_product)) {
                    $valid_product = $valid_product . " " . $valid->error_display($form_name, 'per', $per_error, 'text');
                } else {
                    $valid_product = $valid->error_display($form_name, 'per', $per_error, 'text');
                }
            }

        }else{
            
            $sales_rate = $GLOBALS['null_value'];
            $per = $GLOBALS['null_value'];
            $per_type = $GLOBALS['null_value'];
            
        }
        if (isset($_POST['content'])) {
            $contents = $_POST['content'];
        }
        if (isset($_POST['unit_type'])) {
            $unit_type = $_POST['unit_type'];
        }
        if (isset($_POST['stock_date'])) {
            $stock_date = $_POST['stock_date'];
        }
        if (isset($_POST['opening_stock'])) {
            $opening_stock = $_POST['opening_stock'];
        }
        if (isset($_POST['location_id'])) {
            $location_ids = $_POST['location_id'];
        }
        if (isset($_POST['godown_magazine'])) {
             $godown_magazine = $_POST['godown_magazine'];
        }

        if (!empty($location_ids) && empty($location_error)) {
            for ($i = 0; $i < count($location_ids); $i++) {
                $location_ids[$i] = trim($location_ids[$i]);
                if (!empty($location_ids[$i])) {
                    if($godown_magazine == 1) {
                        $location_name[$i] = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_ids[$i], 'godown_name');
                    } else {
                        $location_name[$i] = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $location_ids[$i], 'magazine_name');
                    }
                    if (!empty($unit_type[$i])) {
                        if ($unit_type[$i] == '1') {
                            $unit_type_name[$i] = "Unit";
                            $str_unit_id = $unit_id;
                        } else if ($unit_type[$i] == '2') {
                            $unit_type_name[$i] = "Subunit";
                            $str_unit_id = $subunit_id;
                        } else {
                            $unit_type_name[$i] = "";
                        }
                        if (!empty($edit_id)) {
                            if (!empty($location_ids[$i])) {
                                if($godown_magazine == 1) {
                                    $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, $location_ids[$i], $GLOBALS['null_value'], $edit_id, $str_unit_id, $contents[$i]);
                                } else {
                                    $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, $GLOBALS['null_value'], $location_ids[$i], $edit_id, $str_unit_id, $contents[$i]);


                                }
                            }
                        }
                        $stock_date[$i] = trim($stock_date[$i]);
                        if (!empty($stock_date[$i])) {
                            $opening_stock[$i] = trim($opening_stock[$i]);
                            // if (!empty($opening_stock[$i])) {
                                if (!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $opening_stock[$i])) {
                                    $location_error = "Invalid Opening Stock in location - " . ($obj->encode_decode('decrypt', $location_name[$i]));
                                }
                            // } else {
                            //     $location_error = "Empty Opening Stock in location - " . ($obj->encode_decode('decrypt', $location_name[$i]));
                            // }
                        } else {
                            $location_error = "Stock Date is empty in location - " . ($obj->encode_decode('decrypt', $location_name[$i]));
                        }
                    } else {
                        $location_error = "Select Unit Type in location - " . ($obj->encode_decode('decrypt', $location_name[$i]));
                    }

                }  else {
                    $location_error = "location is empty";
                }
            }
        }
        if (!empty($unit_id) && !empty($subunit_id) && $unit_id == $subunit_id && empty($location_error)) {
            $location_error = "Unit and Subunit must be different";
        }

        if (!empty($edit_id) && empty($godown_error)) {
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
                    // if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                    //     $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                    // } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                    //     $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                    // }
                    if($godown_magazine == '1'){
                        $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                    }else{
                        $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                    }
                    if($godown_magazine == '1'){
                        $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                    }else{
                        $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, '', $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    }
                

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

        $result = "";
    if (empty($valid_product) && empty($location_error)) {
        $check_user_id_ip_address = "";
        $check_user_id_ip_address = $obj->check_user_id_ip_address();
        if (preg_match("/^\d+$/", $check_user_id_ip_address)) {
            $lower_case_name = "";
            $unit_name = "";
            $group_name = "";
            $subunit_name = "";
            if (!empty($product_name)) {
                $lower_case_name = strtolower($product_name);
                $product_name = $obj->encode_decode('encrypt', $product_name);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
            } else {
                $product_name = $GLOBALS['null_value'];
                $lower_case_name = $GLOBALS['null_value'];
            }
            if(!empty($group)) {
                $group_name = $obj->getTableColumnValue($GLOBALS['group_table'], 'group_id', $group, 'group_name');
                if (empty($group_name)) {
                    $group_name = $GLOBALS['null_value'];
                }
            } else {
                $group_name = $GLOBALS['null_value'];
            }
            if (!empty($unit_id)) {
                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
            } else {
                $unit_id = $GLOBALS['null_value'];
                $unit_name = $GLOBALS['null_value'];
            }
            if (!empty($subunit_id)) {
                $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');
            } else {
                $subunit_id = $GLOBALS['null_value'];
                $subunit_name = $GLOBALS['null_value'];
                $subunit_contains = $GLOBALS['null_value'];
            }
            if (!empty($location_ids)) {
                $location_ids = implode(",", $location_ids);
            } else {
                $location_ids = $GLOBALS['null_value'];
            }
            if (!empty($location_name)) {
                $location_name = implode(",", $location_name);
            } else {
                $location_name = $GLOBALS['null_value'];
            }
            if (!empty($unit_type)) {
                $unit_type = implode(",", $unit_type);
            } else {
                $unit_type = $GLOBALS['null_value'];
            }
            if (!empty($unit_type_name)) {
                $unit_type_name = implode(",", $unit_type_name);
            } else {
                $unit_type_name = $GLOBALS['null_value'];
            }
            if (!empty($opening_stock)) {
                $opening_stock = implode(",", $opening_stock);
            } else {
                $opening_stock = $GLOBALS['null_value'];
            }
            if (!empty($stock_date)) {
                $stock_date = implode(",", $stock_date);
            } else {
                $stock_date = $GLOBALS['null_value'];
            }
            if (!empty($contents)) {
                $contents = implode(",", $contents);
            } else {
                $contents = $GLOBALS['null_value'];
            }
            if (empty($sales_rate)) {
                $sales_rate = $GLOBALS['null_value'];
            }
            if (empty($per)) {
                $per = $GLOBALS['null_value'];
            }
            if (empty($rate_per_piece)) {
                $rate_per_piece = $GLOBALS['null_value'];
            }
            if (empty($rate_per_case)) {
                $rate_per_case = $GLOBALS['null_value'];
            }
            if (empty($hsn_code)) {
                $hsn_code = $GLOBALS['null_value'];
            }
            if (!empty($description)) {
                $description = $obj->encode_decode('encrypt', $description);
            } else {
                $description = $GLOBALS['null_value'];
            }
            if (empty($finished_group_id)) {
                $finished_group_id = $GLOBALS['null_value'];
            }

            $prev_product_id = "";
            $product_error = "";
            if (!empty($lower_case_name)) {
                $prev_product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'lower_case_name', $lower_case_name, 'product_id');
                if (!empty($prev_product_id)) {
                    $product_error = "This Product name already exists";
                }
            }
            $bill_company_id = $GLOBALS['bill_company_id'];
            $created_date_time = $GLOBALS['create_date_time_label'];
            $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            $update_stock = 0;
            if (empty($edit_id)) {
                if (empty($prev_product_id)) {
                    $action = "";
                    if (!empty($product_name)) {
                        $action = "New Product Created - " . $obj->encode_decode("decrypt", $product_name);
                    }
                    $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id',  'product_id', 'product_name', 'lower_case_name','hsn_code', 'group_id', 'group_name', 'unit_id', 'unit_name', 'subunit_need', 'subunit_id', 'subunit_name', 'subunit_contains', 'sales_rate', 'per', 'per_type', 'opening_stock', 'unit_type', 'stock_date', 'location_id', 'location_name',  'negative_stock', 'rate_per_case', 'rate_per_piece', 'finished_group_id', 'description', 'deleted');
                    $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $bill_company_id . "'", "'" . $null_value . "'", "'" . $product_name . "'", "'" . $lower_case_name . "'", "'" . $hsn_code . "'", "'" . $group . "'", "'" . $group_name . "'", "'" . $unit_id . "'", "'" . $unit_name . "'", "'" . $subunit_need . "'", "'" . $subunit_id . "'", "'" . $subunit_name . "'", "'" . $contents . "'", "'" . $sales_rate . "'", "'" . $per . "'", "'" . $per_type . "'", "'" . $opening_stock . "'", "'" . $unit_type . "'", "'" . $stock_date . "'", "'" . $location_ids . "'", "'" . $location_name . "'", "'" . $negative_stock . "'", "'" . $rate_per_case . "'", "'" . $rate_per_piece . "'", "'" . $finished_group_id . "'", "'" . $description . "'", "'0'");
                    $product_insert_id = $obj->InsertSQL($GLOBALS['product_table'], $columns, $values, 'product_id', '', $action);
                    if (preg_match("/^\d+$/", $product_insert_id)) {
                        $product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'id', $product_insert_id, 'product_id');

                        $update_stock = 1;
                        $result = array('number' => '1', 'msg' => 'Product Successfully Created', 'product_id' => $product_id);
                    } else {
                        $result = array('number' => '2', 'msg' => $product_insert_id);
                    }
                } else {
                    if (!empty($product_error)) {
                        $result = array('number' => '2', 'msg' => $product_error);
                    }
                }
            } else {
                if (empty($prev_product_id) || $prev_product_id == $edit_id) {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $edit_id, 'id');
                    if (preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if (!empty($product_name)) {
                            $action = "Product Updated - " . $obj->encode_decode("decrypt", $product_name);
                        }

                        $columns = array();
                        $values = array();
                        $columns = array('creator_name','group_id', 'group_name', 'product_name', 'lower_case_name','hsn_code', 'unit_id', 'unit_name', 'subunit_need', 'subunit_id', 'subunit_name', 'subunit_contains', 'sales_rate', 'per', 'per_type', 'stock_date', 'opening_stock', 'unit_type', 'location_id', 'location_name', 'negative_stock', 'rate_per_case', 'rate_per_piece', 'finished_group_id', 'description');
                        $values = array("'" . $creator_name . "'", "'" . $group . "'", "'" . $group_name . "'", "'" . $product_name . "'", "'" . $lower_case_name . "'", "'" . $hsn_code . "'", "'" . $unit_id . "'", "'" . $unit_name . "'", "'" . $subunit_need . "'", "'" . $subunit_id . "'", "'" . $subunit_name . "'", "'" . $contents . "'", "'" . $sales_rate . "'", "'" . $per . "'", "'" . $per_type . "'", "'" . $stock_date . "'", "'" . $opening_stock . "'", "'" . $unit_type . "'","'" . $location_ids . "'", "'" . $location_name . "'", "'" . $negative_stock . "'", "'" . $rate_per_case . "'", "'" . $rate_per_piece . "'", "'" . $finished_group_id . "'", "'" . $description . "'",);
                        $entry_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                        if (preg_match("/^\d+$/", $entry_update_id)) {
                            $update_stock = 1;
                            $product_id = $edit_id;
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');

                        } else {
                            $result = array('number' => '2', 'msg' => $entry_update_id);
                        }
                    }
                } else {
                    if (!empty($product_error)) {
                        $result = array('number' => '2', 'msg' => $product_error);
                    }
                }
            }
            if (!empty($update_stock) && $update_stock == 1) {
                if (!empty($product_id) && !empty($unit_id)) {
                    $stock_date = explode(",", $stock_date);
                    $opening_stock = explode(",", $opening_stock);
                    $unit_type = explode(",", $unit_type);
                    $remarks = $obj->encode_decode("encrypt", 'Opening Stock');
                    if (!empty($location_ids) && $location_ids != $GLOBALS['null_value']) {
                        $location_ids = explode(",", $location_ids);
                        $contents = explode(",", $contents);
                        for ($i = 0; $i < count($location_ids); $i++) {
                            if($godown_magazine == 1) {
                                $godown_ids = $location_ids[$i];
                                $magazine_ids = $GLOBALS['null_value'];
                            } else {
                                $godown_ids = $GLOBALS['null_value'];
                                $magazine_ids = $location_ids[$i];
                            }
                            if(empty($contents[$i])) {
                                $contents[$i] = $GLOBALS['null_value'];
                            }
                            if ($unit_type[$i] == '1') {
                                $stock_update_id = $obj->StockUpdate($GLOBALS['product_table'], "In", $product_id, '', $product_id, $remarks, $stock_date[$i], $godown_ids, $magazine_ids, $unit_id, $opening_stock[$i], $contents[$i], $group, $godown_magazine);

                            } else if ($unit_type[$i] == '2') {
                                $stock_update_id = $obj->StockUpdate($GLOBALS['product_table'], "In", $product_id, '', $product_id, $remarks, $stock_date[$i], $godown_ids, $magazine_ids, $subunit_id, $opening_stock[$i], $contents[$i], $group, $godown_magazine);
                            }
                        }
                    }
                }
            }
        } else {
            $result = array('number' => '2', 'msg' => 'Invalid IP');
        }
    } else {
        if (!empty($valid_product)) {
            $result = array('number' => '3', 'msg' => $valid_product);
        } else if (!empty($location_error)) {
            $result = array('number' => '2', 'msg' => $location_error);
        }
    }

    if (!empty($result)) {
        $result = json_encode($result);
    }
    echo $result;
    exit;
    
    }

    if (isset($_REQUEST['delete_product_id'])) {
        $delete_product_id = $_REQUEST['delete_product_id'];
        $msg = "";
        if (!empty($delete_product_id)) {
            $product_unique_id = "";
            $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $delete_product_id, 'id');
            if (preg_match("/^\d+$/", $product_unique_id)) {
                $name = "";
                $name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $delete_product_id, 'product_name');
    
                $action = "";
                if (!empty($name)) {
                    $action = "Product Deleted. Name - " . $obj->encode_decode('decrypt', $name);
                }
    
                $linked_count = 0;
                $linked_count = $obj->GetProductLinkedCount($delete_product_id); 
    
                if (empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['product_table'], $product_unique_id, $columns, $values, $action);
                    $prev_stock_list = array();
                    $tables = "";
                    $prev_stock_list = $obj->PrevStockList($delete_product_id);
                    if (!empty($prev_stock_list)) {
                        foreach ($prev_stock_list as $data) {
                            $stock_godown_id = "";
                            $stock_magazine_id = "";
                            $stock_case_contains = "";
                            $stock_product_id = $delete_product_id;
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
                } else {
                    $msg = "This Product is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }

    if(isset($_REQUEST['check_product_count'])){
        $check_product_count = $_REQUEST['check_product_count'];
       
        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '','');
        
        if(!empty($product_list)){
            echo $product_count = count($product_list);
        }
    }

    if(isset($_REQUEST['clear_category_product_tables'])) {
        $clear_category_product_tables = $_REQUEST['clear_category_product_tables'];
        if(!empty($clear_category_product_tables) && $clear_category_product_tables == 1) {
            $clear_records = 1;
            $tables = array($GLOBALS['product_table']);
            $clear_records = $obj->getClearTableRecords($tables);
            echo $clear_records;
            exit;
        }
    }
    
    ?>