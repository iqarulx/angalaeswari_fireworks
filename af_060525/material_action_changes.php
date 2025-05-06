<?php
	include("include.php");
    include("include_incharger_access.php");

    if(isset($_REQUEST['get_location_change'])) {
        $location = $_REQUEST['get_location_change'];
        $from_options = "";
        $options = "";

        if($location == '1') {
            $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
            if(!empty($godown_list)) {
                foreach($godown_list as $godown) {
                    $options = $options . "<option class='location_from_to' value='". $godown['godown_id'] ."'>". $obj->encode_decode('decrypt', $godown['godown_name']) ."</option>";
                }
            }
        } else if($location == 2) {
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
            if(!empty($magazine_list)) {
                foreach($magazine_list as $magazine) {
                    $options = $options . "<option class='location_from_to' value='". $magazine['magazine_id'] ."'>". $obj->encode_decode('decrypt', $magazine['magazine_name']) ."</option>";
                }
            }
        } else {
            $option = "<option value=''>Select</option>";
        }

        if(!empty($login_user_factory_id)) {
            if($location == 1) {
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'factory_id', $login_user_factory_id, '');
                if(!empty($godown_list)) {
                    foreach($godown_list as $godown) {
                        $from_options = $from_options . "<option class='location_from_to' value='". $godown['godown_id'] ."'>". $obj->encode_decode('decrypt', $godown['godown_name']) ."</option>";
                    }
                }
            } else if($location == 2) {
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'factory_id', $login_user_factory_id, '');
                if(!empty($magazine_list)) {
                    foreach($magazine_list as $magazine) {
                        $from_options = $from_options . "<option class='location_from_to' value='". $magazine['magazine_id'] ."'>". $obj->encode_decode('decrypt', $magazine['magazine_name']) ."</option>";
                    }
                }
            } 
        } else if(!empty($login_godown_id)) {
            if($location == 1) {
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
                if(!empty($godown_list)) {
                    foreach($godown_list as $godown) {
                        $from_options = $from_options . "<option class='location_from_to' value='". $godown['godown_id'] ."'>". $obj->encode_decode('decrypt', $godown['godown_name']) ."</option>";
                    }
                }
            } else if($location == 2) {
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
                if(!empty($magazine_list)) {
                    foreach($magazine_list as $magazine) {
                        $from_options = $from_options . "<option class='location_from_to' value='". $magazine['magazine_id'] ."'>". $obj->encode_decode('decrypt', $magazine['magazine_name']) ."</option>";
                    }
                }
            }
        } else if(!empty($login_magazine_id)) {
            if($location == 1) {
                $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
                if(!empty($godown_list)) {
                    foreach($godown_list as $godown) {
                        $from_options = $from_options . "<option class='location_from_to' value='". $godown['godown_id'] ."'>". $obj->encode_decode('decrypt', $godown['godown_name']) ."</option>";
                    }
                }
            } else if($location == 2) {
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_magazine_id, '');
                if(!empty($magazine_list)) {
                    foreach($magazine_list as $magazine) {
                        $from_options = $from_options . "<option class='location_from_to' value='". $magazine['magazine_id'] ."'>". $obj->encode_decode('decrypt', $magazine['magazine_name']) ."</option>";
                    }
                }
            }
        } 

        if(!empty($from_options)) {
            echo $options . "$$$" . $from_options;
        } else {
            echo $options;
        }
    }

    if(isset($_REQUEST['get_product_from_location'])) {
        $location = $_REQUEST['location'];
        $from_location = $_REQUEST['get_product_from_location'];
        $product_list = array();
        $option = "<option value=''>Select Product</option>";
        if($location == '1') {
            $product_list = $obj->getProductFromGodown($from_location);
        } else if($location == '2') {
            $product_list = $obj->getProductFromMagazine($from_location);
        }

        if(!empty($product_list)) {
            foreach($product_list as $list) {
                $option = $option . "<option value='". $list['product_id'] ."'>". $obj->encode_decode('decrypt', $list['product_name']) ."</option>";
            }
        }
        
       echo $option;
    }

    if (isset($_REQUEST['GetProductdetails'])) {

        $product_id = $_REQUEST['GetProductdetails'];
        $location = $_REQUEST['location'];
        $form_location = $_REQUEST['from_location'];
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
        $unit = $subunit = ""; $type_option = ""; $content_option = ""; $negative_stock = "";
        if($location == '1') {
            $content_list = $obj->getProductContentsFromGodown($product_id, $form_location);
        } else if ($location == '2') {
            $content_list = $obj->getProductContentsFromMagazine($product_id, $form_location);
        }
        if (!empty($content_list)) {
            $c = 1;
            foreach($content_list as $C_list) {
                if (!empty($C_list['case_contains'])) {
                    $content_option .= "<option value='" . $C_list['case_contains'] . "'" . ($c == 1 ? ' selected' : '') . ">" . $C_list['case_contains'] . "</option>";
                    $c++;
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
    
    
        echo $type_option . "$$" . $unit . "%%" . $subunit . "$$" . $content_option . "$$" . $negative_stock;
    
    }

    if(isset($_REQUEST['get_product_stock_limit'])) {
        $product_id = $_REQUEST['get_product_stock_limit'];
        $product_id = trim($product_id);
        $limit = "";
        $godown_id = $GLOBALS['null_value'];
        $magazine_id = $GLOBALS['null_value'];
        $case_contains = $_REQUEST['content'];
        if(empty($case_contains)) {
            $case_contains = $GLOBALS['null_value'];
        }
        $unit_type = $_REQUEST['unit_type'];
        $location = $_REQUEST['location'];
        $tables = $GLOBALS['null_value'];
        if($location == '1') {
            $godown_id = $_REQUEST['from_location'];
            $tables = $GLOBALS['stock_by_godown_table'];
        } else if ($location == '2') {
            $magazine_id = $_REQUEST['from_location'];
            $tables = $GLOBALS['stock_by_magazine_table'];
        }

        if($location == '1'){
            if($unit_type == '2') {
                $inward = 0; $outward = 0;
                $inward = $obj->getInwardSubunitQty('', $godown_id, '', $product_id, $case_contains);
                $outward = $obj->getOutwardSubunitQty('', $godown_id, '', $product_id, $case_contains);
                $current_unit = 0;
                $current_unit = $inward - $outward;
                $limit = $current_unit;
            } 
            else if($unit_type == '1') {
                $inward = 0; $outward = 0;
                $inward = $obj->getInwardQty('', $godown_id, '', $product_id, $case_contains);
                $outward = $obj->getOutwardQty('', $godown_id, '', $product_id, $case_contains);
                $current_unit = 0;
                $current_unit = $inward - $outward;
                $limit = $current_unit;
            }
        }else if($location == '2'){
            if($unit_type == '2') {
                $inward = 0; $outward = 0;
                $inward = $obj->getInwardSubunitQty('', '', $magazine_id, $product_id, $case_contains);
                $outward = $obj->getOutwardSubunitQty('', '', $magazine_id, $product_id, $case_contains);
                $current_unit = 0;
                $current_unit = $inward - $outward;
                $limit = $current_unit;
            } 
            else if($unit_type == '1') {
                $inward = 0; $outward = 0;
                $inward = $obj->getInwardQty('', '', $magazine_id, $product_id, $case_contains);
                $outward = $obj->getOutwardQty('', '', $magazine_id, $product_id, $case_contains);
                $current_unit = 0;
                $current_unit = $inward - $outward;
                $limit = $current_unit;
            }
        }
      
        echo $limit;
    }

    if(isset($_REQUEST['product_material_row_index'])) {
        $product_row_index = $_REQUEST['product_material_row_index'];
        $product = $_REQUEST['selected_product'];
        $unit_type = $_REQUEST['selected_unit_type'];
        $quantity = $_REQUEST['selected_quantity'];
        $content =$_REQUEST['selected_content'];
        $quantity_limit = $_REQUEST['limit'];
        $negative = $_REQUEST['negative'];
        $unit_subunit = explode( ",", $_REQUEST['unit_subunit']);
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product, '');
        if(!empty($product_list)) {
            foreach ($product_list as $P_list) {
                if(!empty($P_list['product_name'])) {
                    $product_name = $P_list['product_name'];
                }
            }
        }
        ?>
        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
            <td class="sno text-center px-2 py-2"><?php echo $product_row_index; ?></td>

            <td class="text-center px-2 py-2">
                <?php
                if ($product_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $product_name);
                }
                ?>
                <input type="hidden" name="product_id[]" id="product_id_<?php echo $product_row_index;?>" value="<?php echo $product; ?>">
                <input type="hidden" name="product_name[]" id="product_name_<?php echo $product_row_index;?>" value="<?php echo $product_name; ?>">
            </td>
    
            <td class="text-center px-2 py-2">
                <input type="text" name="quantity[]" id="quantity_<?php echo $product_row_index;?>" class="form-control shadow-none" value="<?php echo $quantity; ?>" onkeyup="calQtyTotal();" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
            </td>

            <td class="text-center px-2 py-2">
                <?php
                $unit_id = $unit_subunit[0];
                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                $subunit_id = $unit_subunit[1];
                $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$subunit_id,'unit_name');
                echo ($unit_type == '1') ? $obj->encode_decode('decrypt', $unit_name) : $obj->encode_decode('decrypt', $subunit_name);
                ?>
                <input type="hidden" name="negative[]" id="negative_<?php echo $product_row_index;?>" value="<?php echo $negative; ?>">
                <input type="hidden" name="quantity_limit[]" id="quantity_limit_<?php echo $product_row_index;?>" value="<?php echo $quantity_limit; ?>">
                <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $product_row_index;?>" value="<?php echo $unit_id; ?>">
                <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $product_row_index;?>" value="<?php echo $unit_name; ?>">
                <input type="hidden" name="subunit_id[]" id="subunit_id_<?php echo $product_row_index;?>" value="<?php echo $subunit_id; ?>">
                <input type="hidden" name="subunit_name[]" id="subunit_name_<?php echo $product_row_index;?>" value="<?php echo $subunit_name; ?>">
                <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $product_row_index;?>" value="<?php echo $unit_type; ?>">
                <input type="hidden" name="content[]" id="content_<?php echo $product_row_index;?>" value="<?php if(!empty($content)) { echo $content; } else { echo $GLOBALS['null_value']; } ?>">
            </td>

            <td>
                <?php if(!empty($content)) {
                    echo $content;
                } else {
                    echo '-';
                } ?>
                
            </td>

            <td class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteMaterialTransferRow('<?php echo $product_row_index; ?>', 'product_row');">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        
    <?php }