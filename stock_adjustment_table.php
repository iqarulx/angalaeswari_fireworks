

<?php 
include("include.php");
if (isset($_REQUEST['change_product_id'])) {

    $product_id = $_REQUEST['change_product_id'];
    $godown_id = $_REQUEST['selected_godown_id'];
    $magazine_id = $_REQUEST['selected_magazine_id'];

    $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
    $unit = $subunit = ""; $type_option = ""; $content_option = ""; $negative_stock = "";
    $content_list = $obj->getProductContainsListFromGodown($product_id,$godown_id,$magazine_id);
    // print_r($content_list);
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


if(isset($_REQUEST['get_limit_product'])) {
    $selected_godown_id = ""; $selected_godown_id = "";    $limit = ""; $magazine_id = ""; $godown_id ="";
    $product_id = $_REQUEST['get_limit_product'];
    $product_group = $_REQUEST['product_group'];
    $magazine_id = $_REQUEST['selected_magazine_id'];
    $godown_id = $_REQUEST['selected_godown_id'];
    $case_contains = $_REQUEST['content'];
    $unit_type = $_REQUEST['unit_type'];

    $product_id = trim($product_id);
    $magazine_id = trim($magazine_id);
    $product_group = trim($product_group);
    
    if($product_group == 1){
        if($unit_type == '2') {
            $limit = $obj->getCurrentStockSubUnit($GLOBALS['stock_by_godown_table'], $godown_id, $GLOBALS['null_value'], $product_id, $case_contains);
        } 
        else if($unit_type == '1') {
            $limit = $obj->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $godown_id, $GLOBALS['null_value'], $product_id, $case_contains);
        }
    }else if($product_group == 2){
        if($unit_type == '2') {
            $limit = $obj->getCurrentStockSubUnit($GLOBALS['stock_by_magazine_table'], $GLOBALS['null_value'], $magazine_id, $product_id, $case_contains);
        } 
        else if($unit_type == '1') {
            $limit = $obj->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'], $GLOBALS['null_value'], $magazine_id, $product_id, $case_contains);
        }
    }
  
    echo $limit;
}



if(isset($_REQUEST['product_row_index'])) {
    $location_id = ""; $product_group = ""; $lcoation_name = ""; $unit_display = "";
    $product_row_index = $_REQUEST['product_row_index'];
    $product = $_REQUEST['product'];
    $unit_type = $_REQUEST['unit_type'];
    $quantity = $_REQUEST['selected_quantity'];
    $content = $_REQUEST['content'];
    $stock_action = $_REQUEST['selected_stock_action'];
    if(isset($_REQUEST['product_group'])){
        $product_group = $_REQUEST['product_group'];
    }
 
    if($product_group == "1"){
        if(isset($_REQUEST['selected_godown_id'])){
            $location_id = $_REQUEST['selected_godown_id'];
        }
    }else{
        if(isset($_REQUEST['selected_magazine_id'])){
            $location_id = $_REQUEST['selected_magazine_id'];
        }
    }
 
    $total_rate = 0; $group_name = "";
    $unit_subunit = explode(",", $_REQUEST['unit_subunit']);
    $group_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product, 'group_name');

    if($product_group == "1"){
        $lcoation_name = '';
        $lcoation_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_id, 'godown_name');
    }
    else if($product_group == "2"){
        $lcoation_name = '';
        $lcoation_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $location_id, 'magazine_name');
    } ?>
    <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
        <td class="sno text-center px-2 py-2"><?php echo $product_row_index; ?></td>

        <td class="text-center px-2 py-2">
            <?php
            if ($lcoation_name != $GLOBALS['null_value']) {
                echo $obj->encode_decode('decrypt', $lcoation_name);
            }
            ?>
            <input type="hidden" name="location_id[]" id="location_id_<?php echo $product_row_index;?>" value="<?php echo $location_id; ?>">
        </td>
        <td class="text-center px-2 py-2">
                <?php
                if ($group_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $group_name);
                }
                ?>
            <input type="hidden" name="group_name[]" value="<?php echo $group_name; ?>">

        </td>
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
            <input type="hidden" name="unit_id[]" id="unit_id_<?php echo $product_row_index;?>" value="<?php if($unit_type == '1') { echo $unit_id; } else { echo $subunit_id; }?>">
            <input type="hidden" name="unit_name[]" id="unit_name_<?php echo $product_row_index;?>" value="<?php if($unit_type == '1') { echo $unit_name; } else { echo $subunit_name; }?>">
            <input type="hidden" name="unit_type[]" id="unit_type_<?php echo $product_row_index;?>" value="<?php echo $unit_type; ?>">
        </td>
  
        <td class="text-center px-2 py-2">
             <?php if(!empty($content) && $content != $GLOBALS['null_value']){ 
                echo $content;
             }else{
                echo " - ";
             }
             ?>

            <input type="hidden" name="content[]"  class="form-control shadow-none" value="<?php  if(!empty($content)){ echo $content; }else{ echo "NULL"; } ?>">
        </td>
        
        <td class="text-center px-2 py-2">
            <input type="text" name="quantity[]" class="form-control shadow-none" onkeyup="Javascript:calcTotalQuantity();" value="<?php echo $quantity; ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" >
        </td>
        <td class="text-center px-2 py-2">
            <?php 
                if(!empty($stock_action)) { 
                    if($stock_action == '1') {
                        echo 'Add';
                    }
                    else if($stock_action == '2') {
                        echo 'Remove';
                    }
                } 
            ?>
            <input type="hidden" name="stock_action[]" class="form-control shadow-none" value="<?php if(!empty($stock_action)) { echo $stock_action; } ?>">
        </td>

        <td class="text-center px-2 py-2">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteStockAdjRow('<?php echo $product_row_index; ?>', 'product_row');">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>

    <?php
}

?>