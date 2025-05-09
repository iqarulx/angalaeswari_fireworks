

<?php 
include("include.php");
if (isset($_REQUEST['change_product_id'])) {

    $product_id = $_REQUEST['change_product_id'];
    $godown_id = $_REQUEST['selected_godown_id'];
    $magazine_id = $_REQUEST['selected_magazine_id'];

    $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
    $unit = $subunit = "";  $content_option = ""; $negative_stock = ""; $subunit_need = 0; $type_option = "";
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
            if(!empty($P_list['subunit_need'])) {
                $subunit_need = $P_list['subunit_need'];
            }
        }
    }else {
        $type_option = $type_option . "<option value = '1'>Unit</option><option value = '2'>Subunit</option>";
    }
    
    if($subunit_need == 1){
         $type_option = "<option value = ''>Select Unit</option>";
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
    
    if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
        if(!empty($product_id) && (!empty($godown_id))){
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
        }
    } else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
        if(!empty($product_id) && (!empty($magazine_id))){
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
 

    if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
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

    if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || $product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
        $lcoation_name = '';
        $lcoation_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $location_id, 'godown_name');
    }
    else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
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
        <?php /*
        <td class="text-center px-2 py-2">
                <?php
                if ($group_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $group_name);
                }
                ?>

        </td>
        */ ?>
        <input type="hidden" name="group_name[]" value="<?php echo $group_name; ?>">

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

if(isset($_REQUEST['show_purchase_product'])){
    $product_group = "";
    if(isset($_REQUEST['selected_product_group'])){
        $product_group = $_REQUEST['selected_product_group'];
    }
    $product_list = array();
    $product_type = "finished";
    $product_type = $obj->encode_decode('encrypt',$product_type);

    $product_group_ids = array();

    // if($product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d"){
    //     $product_group_ids = ["4d5449774e4449774d6a55784d44557a4d444a664d444d3d"];

    // }else if($product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d"){
    //     $product_group_ids = ["4d5449774e4449774d6a55784d4455794e4464664d44493d"];
    // }
    // else if($product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d"){
    //     $product_group_ids = ["4d5449774e4449774d6a55784d4455794d7a4e664d44453d"];
    // }


    if(!empty($product_group)) {
        // if(count($product_group_ids) == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
        //     $raw_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $product_group_ids[0], '');
        //     $semi_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $product_group_ids[1], '');
        //     $product_list = array_merge($raw_list, $semi_list);
        // } else {
        //     $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $product_group_ids[0], '');
        // }   
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $product_group, ''); 
    }
    $product_count = 0;
    $product_count = count($product_list);
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
            <option value="<?php if(!empty($product_id)){ echo $product_id; } ?>" <?php if(!empty($product_count) && $product_count == 1){ ?> Selected <?php } ?>><?php if(!empty($product_name)){ echo $product_name; } ?></option>
            <?php
        }
    }
}
?>