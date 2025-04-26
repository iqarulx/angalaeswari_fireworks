<?php
class Stock_functions extends Basic_Functions
{
    public function PrevStockList($bill_unique_id)
    {
        $select_query = "";
        $list = array();
        $select_query = "SELECT * FROM " . $GLOBALS['stock_table'] . " WHERE bill_unique_id = '" . $bill_unique_id . "' AND deleted = '0'";
        $list = $this->getQueryRecords('', $select_query);
        return $list;
    }

    public function getStockUniqueID($bill_unique_id, $godown_id, $magazine_id, $product_id, $unit_id, $case_contains)
    {
        // *** Only use this for Overall Stock Table ***
        $where = "";
        $select_query = "";
        $list = array();
        $unique_id = "";
        if (!empty($bill_unique_id)) {
            if (!empty($where)) {
                $where = $where . " bill_unique_id = '" . $bill_unique_id . "' AND ";
            } else {
                $where = " bill_unique_id = '" . $bill_unique_id . "' AND ";
            }
        }

        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if (!empty($unit_id)) {
            if (!empty($where)) {
                $where = $where . " unit_id = '" . $unit_id . "' AND ";
            } else {
                $where = " unit_id = '" . $unit_id . "' AND ";
            }
        }
        if (!empty($case_contains)) {
            if (!empty($where)) {
                $where = $where . " case_contains = '" . $case_contains . "' AND ";
            } else {
                $where = " case_contains = '" . $case_contains . "' AND ";
            }
        }
        if (!empty($where)) {
            $select_query = "SELECT id FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                    $unique_id = $data['id'];
                }
            }
        }

        return $unique_id;
    }

    public function getStockTablesUniqueID($table, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        // *** Not for Overall Stock Table ***
        $where = "";
        $select_query = "";
        $list = array();
        $unique_id = "";
        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) { 
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if (!empty($case_contains)) {
            if (!empty($where)) {
                $where = $where . " case_contains = '" . $case_contains . "' AND ";
            } else {
                $where = " case_contains = '" . $case_contains . "' AND ";
            }
        }
        if (!empty($table)) {
            if ($table == $GLOBALS['stock_by_godown_table']) {
                $select_query = "SELECT id FROM " . $GLOBALS['stock_by_godown_table'] . " WHERE " . $where . " deleted = '0'";
            }
            if ($table == $GLOBALS['stock_by_magazine_table']) {
                $select_query = "SELECT id FROM " . $GLOBALS['stock_by_magazine_table'] . " WHERE " . $where . " deleted = '0'";
            }
        }
        if (!empty($select_query)) {
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                    $unique_id = $data['id'];
                }
            }
        }
        return $unique_id;
    }

    public function StockUpdate($page_table, $in_out_type, $bill_unique_id, $bill_unique_number, $product_id, $remarks, $stock_date, $godown_id, $magazine_id, $unit_id, $quantity, $case_contains, $group, $godown_magazine)
    {
       
        // echo $page_table,"==><br>", $in_out_type,"==><br>", $bill_unique_id,"==><br>", $bill_unique_number,"==><br>", $product_id,"==><br>", $remarks,"==><br>", $stock_date,"==><br>", $godown_id,"==><br>", $magazine_id,"==><br>", $unit_id,"==><br>", $quantity,"==><br>", $case_contains,"==><br>", $group,"==><br>", $godown_magazine;

        $bill_company_id = $GLOBALS['bill_company_id'];

        $group_name = "";
        $group_id = "";
        $unit_name = "";
        $product_name = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
        $unit_name = $this->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');

        $godown_name = "";
        $magazine_name = "";

        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            $godown_name = $this->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
        } else {
            $godown_id = $GLOBALS['null_value'];
            $godown_name = $GLOBALS['null_value'];
        }

        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) {
            $magazine_name = $this->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $magazine_id, 'magazine_name');
        } else {
            $magazine_id = $GLOBALS['null_value'];
            $magazine_name = $GLOBALS['null_value'];
        }

        $inward_unit = 0;
        $inward_subunit = 0;
        $outward_unit = 0;
        $outward_subunit = 0;
        $subunit_need = 1;
        $product_unit_id = "";
        $product_subunit_id = "";
        $subunit_need = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');
        $product_subunit_id = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        $product_unit_id = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_id');
        // echo $this->encode_decode('decrypt', $unit_id) ,"== <br>",$this->encode_decode('decrypt', $product_unit_id);
        if ($subunit_need == '1') {
            if ($unit_id == $product_unit_id) {
                if ($in_out_type == "In") {
                    $inward_unit = $quantity;
                    if($case_contains != $GLOBALS['null_value']) {
                        $inward_subunit = ((int) $quantity * (int) $case_contains);
                    } else {
                        $inward_subunit = 0;
                    }
                    $inward_subunit = number_format($inward_subunit, 2);
                    $inward_subunit = str_replace(",", "", $inward_subunit);
                } else if ($in_out_type == "Out") {
                    $outward_unit = $quantity;
                    if($case_contains != $GLOBALS['null_value']) {
                        $outward_subunit = ((int) $quantity * (int) $case_contains);
                    } else {
                        $outward_subunit = 0;
                    }
                    $outward_subunit = number_format($outward_subunit, 2);
                    $outward_subunit = str_replace(",", "", $outward_subunit);
                }
            } else if ($unit_id == $product_subunit_id) {
                if ($in_out_type == "In") {
                    $inward_subunit = (int) $quantity;
                    if($case_contains != $GLOBALS['null_value']) {
                        $inward_unit = ((int) $quantity / (int) $case_contains);
                    } else {
                        $inward_unit = 1;
                    }
                    $inward_unit = number_format($inward_unit, 2);
                    $inward_unit = str_replace(",", "", $inward_unit);
                } else if ($in_out_type == "Out") {
                    $outward_subunit = (int) $quantity;
                    if($case_contains != $GLOBALS['null_value']) {
                        $outward_unit = ((int) $quantity / (int) $case_contains);
                    } else {
                        $outward_unit = 1;
                    }
                    $outward_unit = number_format($outward_unit, 2);
                    $outward_unit = str_replace(",", "", $outward_unit);
                }
            }
        } else {
            if ($in_out_type == "In") {
                $inward_unit = $quantity;
            } else if ($in_out_type == "Out") {
                $outward_unit = $quantity;
            }
            $inward_subunit = $GLOBALS['null_value'];
            $outward_subunit = $GLOBALS['null_value'];
            $product_subunit_id = $GLOBALS['null_value'];
            $case_contains = $GLOBALS['null_value'];
        }
        $created_date_time = $GLOBALS['create_date_time_label'];
        $creator = $GLOBALS['creator'];
        $creator_name = $this->encode_decode('encrypt', $GLOBALS['creator_name']);

        $stock_action = "";
        if ($in_out_type == "In") {
            $stock_action = $GLOBALS['stock_action_plus'];
        } else if ($in_out_type == "Out") {
            $stock_action = $GLOBALS['stock_action_minus'];
        }

        $stock_type = "";
        if ($page_table == $GLOBALS['product_table']) {
            $stock_type =  "Opening Stock";
        } else if ($page_table == $GLOBALS['daily_production_table']) {
            $stock_type =  "Daily Production";
        }
        
        if (empty($bill_unique_number)) {
            $bill_unique_number = $GLOBALS['null_value'];
        }
        if (!empty($stock_date)) {
            $stock_date = $stock_date . " " . date('H:i:s');
        }

        $stock_unique_id = "";
        $stock_unique_id = $this->getStockUniqueID($bill_unique_id, $godown_id, $magazine_id, $product_id, $unit_id, $case_contains);
        if (preg_match("/^\d+$/", $stock_unique_id)) {
            $action = "Updated Successfully!";
            $columns = array();
            $values = array();
            $columns = array('creator_name', 'stock_date', 'case_contains', 'inward_unit', 'inward_subunit', 'outward_unit', 'outward_subunit', 'remarks');
            $values = array("'" . $creator_name . "'", "'" . $stock_date . "'", "'" . $case_contains . "'", "'" . $inward_unit . "'", "'" . $inward_subunit . "'", "'" . $outward_unit . "'", "'" . $outward_subunit . "'", "'" . $remarks . "'");
            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_unique_id, $columns, $values, $action);
        } else {
            $action = "Inserted Successfully!";
            $columns = array();
            $values = array();
            $columns = array('created_date_time', 'creator', 'creator_name', 'stock_date', 'godown_id', 'magazine_id', 'group_id', 'product_id', 'unit_id', 'case_contains', 'inward_unit', 'inward_subunit', 'outward_unit', 'outward_subunit', 'stock_type', 'bill_unique_id', 'remarks', 'deleted');
            $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $stock_date . "'", "'" . $godown_id . "'", "'" . $magazine_id . "'",  "'" . $group . "'", "'" . $product_id . "'", "'" . $unit_id . "'", "'" . $case_contains . "'", "'" . $inward_unit . "'", "'" . $inward_subunit . "'", "'" . $outward_unit . "'", "'" . $outward_subunit . "'", "'" . $stock_type . "'", "'" . $bill_unique_id . "'", "'" . $remarks . "'", "'0'");
            $stock_update_id = $this->InsertSQL($GLOBALS['stock_table'], $columns, $values, '', '', $action);
        }

        if (preg_match("/^\d+$/", $stock_update_id)) {
            $stock_table_unique_id = "";
            $stock_unique_table = "";
            $stock_field = "";
            $field_value = "";

            // if($page_table == $GLOBALS['stock_adjustment_table']) {
            if($godown_magazine == 1) {
                $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_godown_table'], $godown_id, $GLOBALS['null_value'], $product_id, $case_contains);
                $stock_field = 'godown_id';
                $field_value = $godown_id;
            } else {
                $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_magazine_table'], $GLOBALS['null_value'], $magazine_id,  $product_id, $case_contains);
                $stock_field = 'magazine_id';
                $field_value = $magazine_id;
            }
            // }
            $inward_unit = 0;
            $inward_subunit = 0;
            $outward_unit = 0;
            $outward_subunit = 0;
            $current_stock_unit = "";
            $current_stock_subunit = "";

           
            $inward_unit = $this->getInwardQty('', $godown_id, $magazine_id, $product_id, $case_contains);
            $outward_unit = $this->getOutwardQty('', $godown_id, $magazine_id, $product_id, $case_contains);


            $current_stock_unit = $inward_unit - $outward_unit;
            $current_stock_unit = number_format($current_stock_unit, 2);
            $current_stock_unit = str_replace(",", '', $current_stock_unit);
            if ($subunit_need == '1') {
                if($case_contains != $GLOBALS['null_value']) {
                    $inward_subunit = $inward_unit * $case_contains;
                    $outward_subunit = $outward_unit * $case_contains;
                } 
                $current_stock_subunit = $inward_subunit - $outward_subunit;
                $current_stock_subunit = number_format($current_stock_subunit, 2);
                $current_stock_subunit = str_replace(",", '', $current_stock_subunit);
            } else {
                $current_stock_subunit = $GLOBALS['null_value'];
            }
            if (!empty($stock_unique_table) && !empty($stock_field) && !empty($field_value)) {
                if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                    $action = "Updated Successfully!";
                    $columns = array();
                    $values = array();
                    $columns = array('unit_id', 'subunit_id', 'case_contains', 'current_stock_unit', 'current_stock_subunit');
                    $values = array("'" . $product_unit_id . "'", "'" . $product_subunit_id . "'", "'" . $case_contains . "'", "'" . $current_stock_unit . "'", "'" . $current_stock_subunit . "'");
                    $stock_table_update_id = $this->UpdateSQL($stock_unique_table, $stock_table_unique_id, $columns, $values, $action);
                } else {
                    $action = "Inserted Successfully!";
                    $columns = array();
                    $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', $stock_field,  'group_id', 'product_id', 'unit_id', 'subunit_id', 'case_contains', 'current_stock_unit', 'current_stock_subunit', 'deleted');
                    $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $field_value . "'", "'" . $group . "'", "'" . $product_id . "'", "'" . $product_unit_id . "'", "'" . $product_subunit_id . "'", "'" . $case_contains . "'", "'" . $current_stock_unit . "'", "'" . $current_stock_subunit . "'", "'0'");
                    $stock_table_update_id = $this->InsertSQL($stock_unique_table, $columns, $values, '', '', $action);
                }
            }
        }
    }


    public function getInwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        $where = "";
        $select_query = "";
        $list = array();
        $inward_unit = 0;

        if (!empty($bill_unique_id)) {
            if (!empty($where)) {
                $where = $where . " bill_unique_id != '" . $bill_unique_id . "' AND ";
            } else {
                $where = " bill_unique_id != '" . $bill_unique_id . "' AND ";
            }
        }

        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if (!empty($case_contains)) {
            if (!empty($where)) {
                $where = $where . " case_contains = '" . $case_contains . "' AND ";
            } else {
                $where = " case_contains = '" . $case_contains . "' AND ";
            }
        }
        if (!empty($where)) {
            $select_query = "SELECT SUM(inward_unit) as inward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        } else {
            $select_query = "SELECT SUM(inward_unit) as inward_unit FROM " . $GLOBALS['stock_table'] . " WHERE  deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                    $inward_unit = $data['inward_unit'];
                }
            }
        }
        return $inward_unit;
    }

    public function getOutwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        $where = "";
        $select_query = "";
        $list = array();
        $outward_unit = 0;

        if (!empty($bill_unique_id)) {
            if (!empty($where)) {
                $where = $where . " bill_unique_id != '" . $bill_unique_id . "' AND ";
            } else {
                $where = " bill_unique_id != '" . $bill_unique_id . "' AND ";
            }
        }

        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if (!empty($case_contains)) {
            if (!empty($where)) {
                $where = $where . " case_contains = '" . $case_contains . "' AND ";
            } else {
                $where = " case_contains = '" . $case_contains . "' AND ";
            }
        }
        if (!empty($where)) {
            $select_query = "SELECT SUM(outward_unit) as outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        } else {
            $select_query = "SELECT SUM(outward_unit) as outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE  deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                    $outward_unit = $data['outward_unit'];
                }
            }
        }
        return $outward_unit;
    }

    public function getCurrentStockUnit($table, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        $where = "";
        $select_query = "";
        $list = array();
        $current_stock_unit = 0;
        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if (!empty($case_contains)) {
            if (!empty($where)) {
                $where = $where . " case_contains = '" . $case_contains . "' AND ";
            } else {
                $where = " case_contains = '" . $case_contains . "' AND ";
            }
        }
        if (!empty($table)) {
            if ($table == $GLOBALS['stock_by_godown_table']) {
                $select_query = "SELECT current_stock_unit FROM " . $GLOBALS['stock_by_godown_table'] . " WHERE " . $where . " deleted = '0'";
            }
            if ($table == $GLOBALS['stock_by_magazine_table']) {
                $select_query = "SELECT current_stock_unit FROM " . $GLOBALS['stock_by_magazine_table'] . " WHERE " . $where . " deleted = '0'";
            }
        }
        if (!empty($select_query)) {
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['current_stock_unit']) && $data['current_stock_unit'] != $GLOBALS['null_value']) {
                    $current_stock_unit = $data['current_stock_unit'];
                }
            }
        }
        return $current_stock_unit;
    }

    public function getCurrentStockSubunit($table, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        $where = "";
        $select_query = "";
        $list = array();
        $current_stock_subunit = 0;
        if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($magazine_id) && $magazine_id != $GLOBALS['null_value']) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if (!empty($case_contains)) {
            if (!empty($where)) {
                $where = $where . " case_contains = '" . $case_contains . "' AND ";
            } else {
                $where = " case_contains = '" . $case_contains . "' AND ";
            }
        }

        if (!empty($table)) {
            if ($table == $GLOBALS['stock_by_godown_table']) {
                $select_query = "SELECT current_stock_subunit FROM " . $GLOBALS['stock_by_godown_table'] . " WHERE " . $where . " deleted = '0'";
            }
            if ($table == $GLOBALS['stock_by_magazine_table']) {
                $select_query = "SELECT current_stock_subunit FROM " . $GLOBALS['stock_by_magazine_table'] . " WHERE " . $where . " deleted = '0'";
            }
        }

        if (!empty($select_query)) {
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['current_stock_subunit']) && $data['current_stock_subunit'] != $GLOBALS['null_value']) {
                    $current_stock_subunit = $data['current_stock_subunit'];
                }
            }
        }
        return $current_stock_subunit;
    }

    public function getProductContentsFromGodown($product_id) {
        $list = array(); $select_query = ""; 
        
        $select_query = "SELECT * FROM " . $GLOBALS['stock_by_godown_table'] . " WHERE product_id = '" . $product_id . "' AND deleted = '0' AND case_contains != '".$GLOBALS['null_value']."' GROUP BY case_contains";

        // echo $select_query;
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['stock_by_godown_table'], $select_query);
        }
        return $list;
    }

    public function DeleteDailyProduction($bill_unique_id) {
        $daily_production_list = array(); $magazine_id = ""; $product_id = array(); $party_type = ""; $case_contains = array();
        $daily_production_list = $this->getTableRecords($GLOBALS['daily_production_table'], 'daily_production_id', $bill_unique_id, '');
        if(!empty($daily_production_list)) {
            foreach($daily_production_list as $data) {
                if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                    $magazine_id = $data['magazine_id'];
                }
                if(!empty($data['product_id'])) {
                    $product_id = $data['product_id'];
                    $product_id = explode(",", $product_id);
                }
                if(!empty($data['subunit_contains'])) {
                    $case_contains = $data['subunit_contains'];
                    $case_contains = explode(",", $case_contains);
                }
            }
        }
        $can_delete = 1;
        if(!empty($product_id)) {
            for($i=0; $i < count($product_id); $i++) {
                if(!empty($product_id[$i]) && !empty($magazine_id)) {
                    $negative_stock_allowed = "";
                    $negative_stock_allowed = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id[$i], 'negative_stock');
    
                    $inward_quantity = 0; $outward_quantity = 0;
                    $inward_quantity = $this->getInwardQty($bill_unique_id, '', $magazine_id, $product_id[$i], $case_contains[$i]);
                    $outward_quantity = $this->getOutwardQty('', '', $magazine_id, $product_id[$i], $case_contains[$i]);
                    if($negative_stock_allowed == 0){
                        if($inward_quantity < $outward_quantity) {
                            $can_delete = 0;
                        }
                    }
                }
            }
        }
        $prev_list = array();
        if($can_delete == '1'){
            $prev_list = $this->PrevStockList($bill_unique_id);
            if(!empty($prev_list)) {
                foreach($prev_list as $data) {
                    $stock_id = ""; $stock_magazine_id = ""; $stock_category_id = ""; $stock_group_id = ""; $stock_product_id = "";
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
                    $current_stock_unit = $this->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'], '',$stock_magazine_id, $stock_product_id, $stock_case_contains);
                    $current_stock_subunit = $this->getCurrentStockSubunit($GLOBALS['stock_by_magazine_table'], '',$stock_magazine_id, $stock_product_id, $stock_case_contains);
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
                    $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_magazine_table'], '', $stock_magazine_id,  $stock_product_id, $stock_case_contains);
    
                    if(preg_match("/^\d+$/", $stock_id)) {
                        $columns = array(); $values = array();
                        $columns = array('deleted');
                        $values = array("'1'");
                        $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
    
                        if(preg_match("/^\d+$/", $stock_update_id)) {
                            if(preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $this->UpdateSQL($GLOBALS['stock_by_magazine_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                        $action = "Payment Successfully Deleted";
                        $payment_unique_id = $this->getTableColumnValue($GLOBALS['payment_table'], 'bill_id', $bill_unique_id, 'id');
                        $columns = array(); $values = array();			
                        $columns = array('deleted');
                        $values = array("'1'");
                        $msg = $this->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                    }
                }
            }
        }
        return $can_delete;
    }
}

?>