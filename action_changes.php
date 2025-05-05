<?php 
    include("include.php");

    if (isset($_REQUEST['change_product_id'])) {

        $product_id = $_REQUEST['change_product_id'];

        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
        $unit = $subunit = ""; $type_option = ""; $content_option = ""; $negative_stock = "";
        $content_list = $obj->getProductContentsFromGodown($product_id,'');
        if (!empty($content_list)) {
            foreach($content_list as $C_list) {
                if (!empty($C_list['case_contains'])) {
                    $content_option = $content_option . "<option value = '" . $C_list['case_contains'] . "'>" . $C_list['case_contains'] . "</option>";
                }
            }
        }
        if (!empty($product_list)) {
            foreach ($product_list as $P_list) {
                if (!empty($P_list['unit_id'])) {
                    $unit = $P_list['unit_id'];
                }
                if (!empty($P_list['subunit_id'])) {
                    $subunit = $P_list['subunit_id'];
                }
                if(!empty($P_list['negative_stock'])) {
                    $negative_stock = $P_list['negative_stock'];
                }
            }
        }else {
            $type_option = $type_option . "<option value = '1'>Unit</option><option value = '2'>Subunit</option>";
        }


        if (!empty($unit) && $unit != $GLOBALS['null_value']) {
            $case = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit, 'unit_name');
            $unit_list = [1 => $unit];
            $case = $obj->encode_decode('decrypt', $case);
            $type_option = $type_option . "<option value = '1'>" . $case . "</option>";
        }
        

        if (!empty($subunit) && $subunit != $GLOBALS['null_value']) {
            $piece = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit, 'unit_name');
            $piece = $obj->encode_decode('decrypt', $piece);
            $type_option = $type_option . "<option value = '2'>" . $piece . "</option>";
        }


        echo $type_option . "$$" . $unit . "%%" . $subunit . "$$" . $content_option . "$$" . $negative_stock. '$$'.$subunit;

    }

    if (isset($_REQUEST['product_row_index'])) {
        $product_row_index = $_REQUEST['product_row_index'];
        $product = $_REQUEST['product'];
        $unit_type = $_REQUEST['selected_unit_type'];
        $quantity = $_REQUEST['selected_quantity'];
        $sales_rate = $_REQUEST['selected_rate'];
        $total_rate = 0;
        $unit_subunit = explode(",", $_REQUEST['unit_subunit']);
        ?>
        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
            <td class="sno text-center px-2 py-2"><?php echo $product_row_index; ?></td>

            <td class="text-center px-2 py-2">
                <?php
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product, 'product_name');
                if ($product_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $product_name);
                }
                ?>
                <input type="hidden" name="product_id[]" id="product_id_<?php echo $product_row_index;?>" value="<?php echo $product; ?>">
            </td>

            <td class="text-center px-2 py-2">
                <?php
                $unit_id = $unit_subunit[0];
                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                $subunit_id = $unit_subunit[1];
                $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$subunit_id,'unit_name');
                echo ($unit_type == '1') ? $obj->encode_decode('decrypt', $unit_name) : $obj->encode_decode('decrypt', $subunit_name);
                ?>
                <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $product_row_index;?>" value="<?php echo $unit_id; ?>">
                <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $product_row_index;?>" value="<?php echo $unit_name; ?>">
                <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $product_row_index;?>" value="<?php echo $subunit_id; ?>">
                <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $product_row_index;?>" value="<?php echo $subunit_name; ?>">
                <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $product_row_index;?>" value="<?php echo $unit_type; ?>">
            </td>

            <td class="text-center px-2 py-2">
                <input type="text" name="quantity[]" id="quantity_<?php echo $product_row_index;?>" class="form-control shadow-none" value="<?php echo $quantity; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
            </td>

            <td class="text-center px-2 py-2">
                <input type="text" name="rate[]" id="rate_<?php echo $product_row_index;?>" class="form-control shadow-none" value="<?php echo $sales_rate; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalculateTotalRate();">
            </td>

            <td class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $product_row_index; ?>', 'product_row');">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        
        <?php 
    }

    if(isset($_REQUEST['purchase_entry_row_index'])) {
        $location_id = ""; $product_group = ""; $lcoation_name = ""; $unit_display = "";
        $purchase_entry_row_index = $_REQUEST['purchase_entry_row_index'];
        $product = $_REQUEST['product'];
        $unit_type = $_REQUEST['unit_type'];
        $quantity = $_REQUEST['quantity'];
        $content = $_REQUEST['content'];
        $sales_rate = $_REQUEST['rate'];
        $per = $_REQUEST['per'];
        $per_type = $_REQUEST['per_type'];
        $amount = $_REQUEST['amount'];
        if(isset($_REQUEST['location_id'])){
            $location_id = $_REQUEST['location_id'];
        }
        if(isset($_REQUEST['product_group'])){
            $product_group = $_REQUEST['product_group'];
        }
        $total_rate = 0;
        $unit_subunit = explode(",", $_REQUEST['unit_subunit']);

        if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
            $lcoation_name = '';
            $lcoation_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_id, 'godown_name');
        } else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
            $lcoation_name = '';
            $lcoation_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $location_id, 'magazine_name');
        } 
        ?>
        <tr class="purchase_product_row" id="purchase_product_row<?php echo $purchase_entry_row_index; ?>">
            <td class="sno text-center px-2 py-2"><?php echo $purchase_entry_row_index; ?></td>

            <td class="text-center px-2 py-2">
                <?php
                if ($lcoation_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $lcoation_name);
                }
                ?>
                <input type="hidden" name="location_id[]" id="location_id_<?php echo $purchase_entry_row_index;?>" value="<?php echo $location_id; ?>">
            </td>
            <td class="text-center px-2 py-2">
                <?php
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product, 'product_name');
                if ($product_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $product_name);
                }
                ?>
                <input type="hidden" name="product_id[]" id="product_id_<?php echo $purchase_entry_row_index;?>" value="<?php echo $product; ?>">
            </td>

            <td class="text-center px-2 py-2">
                <input type="text" name="entry_quantity[]" id="entry_quantity_<?php echo $purchase_entry_row_index;?>" class="form-control shadow-none" value="<?php echo $quantity; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');">
            </td>

            <td class="text-center px-2 py-2">
                <?php
                $unit_id = $unit_subunit[0];
                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                $subunit_id = $unit_subunit[1];
                $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$subunit_id,'unit_name');
                echo ($unit_type == '1') ? $obj->encode_decode('decrypt', $unit_name) : $obj->encode_decode('decrypt', $subunit_name);

                if($per_type == "1"){
                    $unit_display = $obj->encode_decode('decrypt', $unit_name);
                }
                else if($per_type == "2"){
                    $unit_display = $obj->encode_decode('decrypt', $subunit_name);
                }

                ?>
                <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $purchase_entry_row_index;?>" value="<?php if($unit_type == '1') { echo $unit_id; } else { echo $subunit_id; }?>">
                <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $purchase_entry_row_index;?>" value="<?php if($unit_type == '1') { echo $unit_name; } else { echo $subunit_name; }?>">
                <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $purchase_entry_row_index;?>" value="<?php echo $unit_type; ?>">
            </td>

            <td class="text-center px-2 py-2">
                <input type="text" name="entry_content[]" id="entry_content_<?php echo $purchase_entry_row_index;?>" class="form-control shadow-none d-none" value="<?php echo $content; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');">
                <?php echo $content; ?>
            </td>

            <td class="text-center px-2 py-2">
                <input type="text" name="entry_rate[]" id="entry_rate_<?php echo $purchase_entry_row_index;?>" class="form-control shadow-none" value="<?php echo $sales_rate; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');">
            </td>        
            
            <td class="text-center px-2 py-2">
                <div class="input-group d-none">
                    <input type="text" name="entry_per[]" id="entry_per_<?php echo $purchase_entry_row_index;?>" onkeyup="calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');" value="<?php echo $per; ?>" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                    <div class="input-group-append" style="width:50%!important;">
                        <select name="entry_per_type[]" id="entry_per_type_<?php echo $purchase_entry_row_index;?>" onchange="calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option value="1" <?php if($per_type == '1') { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $unit_name); ?></option>
                            <option value="2" <?php if($per_type == '2') { echo "selected"; } ?>><?php echo $obj->encode_decode('decrypt', $subunit_name); ?></option>
                        </select>
                    </div>
                </div>
                <?php echo $per.' '.$unit_display; ?>
            </td>

            <td class="tax_element d-none tax_cover">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select class="select2 select2-danger" name="product_tax[]" id="product_tax_<?php echo $purchase_entry_row_index;?>" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');">
                            <option value="">Select Tax</option>
                            <option value="0%">0%</option>
                            <option value="5%">5%</option>
                            <option value="12%">12%</option>
                            <option value="18%">18%</option>
                            <option value="28%">28%</option>
                        </select>
                    </div>
                    <input type="hidden" name="tax_amt[]" id="tax_amt_<?php echo $purchase_entry_row_index;?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');">
                    
                </div>
            </td>

            <td class="text-center px-2 py-2 entry_amount_td" id="entry_amount_td_<?php echo $purchase_entry_row_index;?>">
                <?php if(!empty($amount)) {
                    echo $amount;
                } ?>
            </td>
            
            <td class="text-center px-2 py-2">
                <input type="hidden" name="entry_amount[]" id="entry_amount_<?php echo $purchase_entry_row_index;?>" class="form-control shadow-none" value="<?php echo $amount; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:calcToalPurchaseProductAmount('<?php echo $purchase_entry_row_index;?>');">
                
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $purchase_entry_row_index; ?>', 'purchase_product_row');">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <script>
            if(jQuery('#purchase_product_row<?php echo $purchase_entry_row_index; ?>').length > 0) {
                jQuery('#entry_per_type_<?php echo $purchase_entry_row_index;?>').select2();
                jQuery('#product_tax_<?php echo $purchase_entry_row_index;?>').select2();
            }
        </script>
        <?php
    }

    if(isset($_REQUEST['get_charges_row']) && $_REQUEST['get_charges_row'] == '1') {
        $colspan = "";
        if(isset($_REQUEST['charges_colspan'])) {
            $colspan = $_REQUEST['charges_colspan'];
            $colspan = trim($colspan);
        }
        $charges_list = array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');
        $charges_count = $_REQUEST['charges_count']+1;
        ?>
        <tr class="smallfnt1 charges_row">
            <td class="charges_head" colspan="<?php echo $colspan; ?>"></td>
            <td colspan="3">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select name="other_charges_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:GetChargesType(this);">
                            <option value="">Select Charges</option>
                            <?php 
                                if(!empty($charges_list)) {
                                    foreach($charges_list as $data) {
                                        if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                            ?>
                                            <option value="<?php echo $data['charges_id']; ?>">
                                                <?php
                                                    if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                        if($data['action'] == 'minus') {
                                                            echo " (-)";
                                                        }
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>Select Charges</label>
                    </div>
                    <input type="hidden" name="charges_type[]" value="">
                </div> 
            </td>
            <td colspan="1"> 
                <div class="d-flex">
                    <input type="text" class="form-control me-2" style="width: 85px;" name="charges_value[]" value="" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                    <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:DeleteChargesRow(this,'<?php if(!empty($charges_count)) { echo $charges_count; } ?>');"><i class="fa fa-trash fw-bold text-white"></i></button>
                </div>
            </td>
            <td colspan="2">
                <div class="text-end"><span class="charges_total"></span></div>
            </td>
        </tr>
        <tr class="charges_row" id="charges_row_total_<?php if(!empty($charges_count)) { echo $charges_count; } ?>">
            <td colspan="7" class="text-end ">Total :</td>
            <td colspan="2" class="text-end charges_sub_total"></td>
        </tr>
        <script>
            if(jQuery('.charges_row').length > 0) {
                jQuery('.charges_row').find('select').select2();
            }
        </script>
        <?php
    }

    if(isset($_REQUEST['get_charges_type'])) {
        $charges_id = $_REQUEST['get_charges_type'];
        $charges_id = trim($charges_id);
    
        $charges_type = "";
        if(!empty($charges_id)) {
            $charges_type = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $charges_id, 'action');
            if(!empty($charges_type) && $charges_type != $GLOBALS['null_value']) {
                echo $charges_type;
            }
        }
    }

    if(isset($_REQUEST['get_supplier_state'])) {
        $supplier_id = $_REQUEST['get_supplier_state'];
        $supplier_id = trim($supplier_id);
        $state = "";
        if(!empty($supplier_id)) {
            $state = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'state');
            if(!empty($state) && $state != $GLOBALS['null_value']) {
                echo $obj->encode_decode('decrypt', $state);
            }
        }

    }

    if(isset($_REQUEST['product_consumption_row_index'])) {
        $product_row_index = $_REQUEST['product_consumption_row_index'];
        $godown = $_REQUEST['godown'];
        $product = $_REQUEST['product'];
        $unit_type = $_REQUEST['selected_unit_type'];
        $quantity = $_REQUEST['selected_quantity'];
        $consumption_content =$_REQUEST['selected_consumption_content'];
        $subunit_need = $_REQUEST['subunit_need'];
        $total_rate = 0;
        $unit_subunit = explode(",", $_REQUEST['unit_subunit']);
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product, '');
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
            }
        }
        ?>
        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
            <td class="sno text-center px-2 py-2"><?php echo $product_row_index; ?></td>
    
            <td class="text-center px-2 py-2 indv_godown d-none">
                <?php
                $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown, 'godown_name');
                if ($godown_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $godown_name);
                }
                ?>
                <input type="hidden" name="godown_id[]" id="godown_id_<?php echo $product_row_index;?>" value="<?php echo $godown; ?>">
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
                <input type="hidden" name="product_id[]" id="product_id_<?php echo $product_row_index;?>" value="<?php echo $product; ?>">
            </td>
    
       
            <td class="text-center px-2 py-2">
                <?php
                $unit_id = $unit_subunit[0];
                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                $subunit_id = $unit_subunit[1];
                $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$subunit_id,'unit_name');
                echo ($unit_type == '1') ? $obj->encode_decode('decrypt', $unit_name) : $obj->encode_decode('decrypt', $subunit_name);
                ?>
                <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $product_row_index;?>" value="<?php echo $unit_id; ?>">
                <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $product_row_index;?>" value="<?php echo $unit_name; ?>">
                <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $product_row_index;?>" value="<?php echo $subunit_id; ?>">
                <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $product_row_index;?>" value="<?php echo $subunit_name; ?>">
                <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $product_row_index;?>" value="<?php echo $unit_type; ?>">
                
            </td>

            <td class="text-center px-2 py-2">
                <input type="text" name="quantity[]" id="quantity_<?php echo $product_row_index;?>" class="form-control shadow-none" value="<?php echo $quantity; ?>" onkeyup="CalculateTotalQuantity();" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
            </td>
            <td class="text-center px-2 py-2">
                <?php if(!empty($consumption_content)){ echo $consumption_content; }?>
                <input type="hidden" name="consumption_content[]" id="consumption_content_<?php echo $product_row_index;?>" class="form-control shadow-none" value="<?php echo $consumption_content; ?>"  onfocus="Javascript:KeyboardControls(this,'number',8,'');">
            </td>
            <td class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $product_row_index; ?>', 'product_row');">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        
        <?php 
    }

    if(isset($_REQUEST['get_limit_product'])) {
        $product_id = $_REQUEST['get_limit_product'];
        $product_id = trim($product_id);
        $limit = "";
        $godown_id = $_REQUEST['godown'];
        $case_contains = $_REQUEST['content'];
        $unit_type = $_REQUEST['unit_type'];
        
        if($unit_type == '2') {
            $limit = $obj->getCurrentStockSubUnit($GLOBALS['stock_by_godown_table'], $godown_id, $GLOBALS['null_value'], $product_id, $case_contains);
        } 
        elseif($unit_type == '1') {
            $limit = $obj->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $godown_id, $GLOBALS['null_value'], $product_id, $case_contains);
        }
        echo $limit;
    }

    if(isset($_REQUEST['get_stock_product'])) {
        $get_stock_product = $_REQUEST['get_stock_product'];
        // $contractor_id = $_REQUEST['contractor_id'];
        $godown_id = $_REQUEST['godown_id'];
        $product_list = array(); $unit_type =""; $case_contains ="";
        $product_list = $obj->getGodownContractorStockProduct($godown_id, '');
        
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
                    <option value="<?php echo $data['product_id']; ?>">
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
        
    if(isset($_REQUEST['show_purchase_product'])){
        $product_group = "";
        if(isset($_REQUEST['selected_product_group'])){
            $product_group = $_REQUEST['selected_product_group'];
        }
        $product_list = array();
        $product_type = "finished";
        $product_type = $obj->encode_decode('encrypt',$product_type);
        // if($product_group == "1"){
        //     $product_list = $obj->getProducts("1");
        // }
        // else if($product_group == "2"){
        //     $product_list = $obj->getProducts("2");
        // }
        
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $product_group, '');

        ?>
        <option value="">Select</option>
        <?php
        if(!empty($product_list)){
            foreach($product_list as $plist){
                if(!empty($plist['product_id'])){
                    $product_id = $plist['product_id'];
                }
                if(!empty($plist['product_name'])){
                    $product_name = $plist['product_name'];
                    $product_name = $obj->encode_decode('decrypt', $product_name);
                }
                ?>
                <option value="<?php if(!empty($product_id)){ echo $product_id; } ?>"><?php if(!empty($product_name)){ echo $product_name; } ?></option>
                <?php
            }
        }
    }

    
    if(isset($_REQUEST['get_agent_id'])){
        $agent_id = $_REQUEST['get_agent_id'];

        if(!empty($agent_id) && $agent_id != $GLOBALS['null_value']) {
            $customer_list = $obj->getAgentcustomerList($agent_id);
            ?>
            <option value="">Select customer</option>
            <?php
            foreach($customer_list as $data)
            {
                ?>
                    <option value="<?php if(!empty($data['customer_id'])){ echo $data['customer_id']; }?>">
                        <?php
                            if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                            }
                        ?>
                    </option>
                <?php
            }
        } else {
            $customer_list = $obj->getTableRecords($GLOBALS['customer_table'],'','','');
            ?>
            <option value="">Select customer</option>
            <?php
            foreach($customer_list as $data)
            {
                ?>
                    <option value="<?php if(!empty($data['customer_id'])){ echo $data['customer_id']; }?>">
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

    if(isset($_REQUEST['view_type'])) {
		$view_type = ""; $view_type = $_REQUEST['view_type'];
		if($view_type == "1"){ ?>
				<option value="">Select</option>
				<?php
					$agent_list = array();
					$agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');
					if(!empty($agent_list)) {
						foreach($agent_list as $data) { ?>
							<option value="<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>">
								<?php
									if(!empty($data['agent_name'])) {
										$data['agent_name'] = $obj->encode_decode('decrypt', $data['agent_name']);
										echo $data['agent_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php }else if($view_type == "2"){ ?>
				<option value="">Select</option>
				<?php
					$supplier_list = array();
					$supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '', '');
					if(!empty($supplier_list)) {
						foreach($supplier_list as $data) { ?>
							<option value="<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>">
								<?php
									if(!empty($data['supplier_name'])) {
										$data['supplier_name'] = $obj->encode_decode('decrypt', $data['supplier_name']);
										echo $data['supplier_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php }else if($view_type == "3"){ ?>
				<option value="">Select</option>
				<?php
					$contractor_list = array();
					$contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '', '');
					if(!empty($contractor_list)) {
						foreach($contractor_list as $data) { ?>
							<option value="<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>">
								<?php
									if(!empty($data['contractor_name'])) {
										$data['contractor_name'] = $obj->encode_decode('decrypt', $data['contractor_name']);
										echo $data['contractor_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php } else if($view_type == "4"){ ?>
				<option value="">Select</option>
				<?php
					$customer_list = array();
					$customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', '');
					if(!empty($customer_list)) {
						foreach($customer_list as $data) { ?>
							<option value="<?php if(!empty($data['customer_id'])) { echo $data['customer_id']; } ?>">
								<?php
									if(!empty($data['customer_name'])) {
										$data['customer_name'] = $obj->encode_decode('decrypt', $data['customer_name']);
										echo $data['customer_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php }  ?>
		
		<script type="text/javascript">                
			jQuery(document).ready(function(){
				jQuery('select[name="filter_party_id"]').select2();
			});
		</script>
	<?php }

?>