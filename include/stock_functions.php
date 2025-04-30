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
    //    echo $product_id;
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
        $product_subunit_id = ""; $party_id = "";
        $subunit_need = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');
        $product_subunit_id = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        $product_unit_id = $this->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_id');
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
            $party_id = $this->getTableColumnValue($GLOBALS['daily_production_table'],'daily_production_id',$bill_unique_id,'contractor_id');

        } else if ($page_table == $GLOBALS['consumption_entry_table']) {
            $party_id = $this->getTableColumnValue($GLOBALS['consumption_entry_table'],'consumption_id',$bill_unique_id,'contractor_id');
            $stock_type =  "Consumption Entry";
        } else if ($page_table == $GLOBALS['purchase_entry_table']) {
            $stock_type =  "Purchase Entry";
        } else if ($page_table == $GLOBALS['semifinished_inward_table']) {
            $stock_type =  "Semifinished Inward";
        } else if ($page_table == $GLOBALS['material_transfer_table']) {
            $stock_type =  "Material Transfer";
        } else if ($page_table == $GLOBALS['proforma_invoice_table']) {
            $stock_type =  "Proforma Invoice";
        } else if ($page_table == $GLOBALS['delivery_slip_table']) {
            $stock_type =  "Delivery Slip";
        } else if ($page_table == $GLOBALS['estimate_table']) {
            $stock_type =  "Estimate";
        } else if ($page_table == $GLOBALS['stock_adjustment_table']) {
            $stock_type =  "Stock Adjustment";
        }
        
        if (empty($bill_unique_number)) {
            $bill_unique_number = $GLOBALS['null_value'];
        }
        if (!empty($stock_date)) {
            $stock_date = $stock_date . " " . date('H:i:s');
        }
        if (empty($party_id)) {
            $party_id = $GLOBALS['null_value'];
        }
        $stock_unique_id = "";
        $stock_unique_id = $this->getStockUniqueID($bill_unique_id, $godown_id, $magazine_id, $product_id, $unit_id, $case_contains);
        if (preg_match("/^\d+$/", $stock_unique_id)) {
            $action = "Updated Successfully!";
            $columns = array();
            $values = array();
            $columns = array('creator_name', 'stock_date','inward_unit', 'inward_subunit', 'outward_unit', 'outward_subunit', 'remarks', 'party_id');
            $values = array("'" . $creator_name . "'", "'" . $stock_date . "'", "'" . $inward_unit . "'", "'" . $inward_subunit . "'", "'" . $outward_unit . "'", "'" . $outward_subunit . "'", "'" . $remarks . "'", "'".$party_id."'");
            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_unique_id, $columns, $values, $action);
        } else {
            $action = "Inserted Successfully!";
            $columns = array();
            $values = array();
            $columns = array('created_date_time', 'creator', 'creator_name', 'stock_date', 'godown_id', 'magazine_id', 'group_id', 'product_id', 'unit_id', 'case_contains', 'inward_unit', 'inward_subunit', 'outward_unit', 'outward_subunit', 'stock_type', 'bill_unique_id', 'bill_unique_number', 'remarks', 'party_id','deleted');
            $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $stock_date . "'", "'" . $godown_id . "'", "'" . $magazine_id . "'",  "'" . $group . "'", "'" . $product_id . "'", "'" . $unit_id . "'", "'" . $case_contains . "'", "'" . $inward_unit . "'", "'" . $inward_subunit . "'", "'" . $outward_unit . "'", "'" . $outward_subunit . "'", "'" . $stock_type . "'", "'" . $bill_unique_id . "'", "'".$bill_unique_number."'","'" . $remarks . "'", "'".$party_id."'","'0'");
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
  

                if($case_contains != $GLOBALS['null_value'] && !empty($case_contains)) {
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
                    $columns = array('unit_id', 'subunit_id', 'current_stock_unit', 'current_stock_subunit');
                    $values = array("'" . $product_unit_id . "'", "'" . $product_subunit_id . "'", "'" . $current_stock_unit . "'", "'" . $current_stock_subunit . "'");
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

    public function getProductContentsFromGodown($product_id, $godown_id) {
        $list = array(); $select_query = ""; 

        if (!empty($godown_id)) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }

        
        $select_query = "SELECT * FROM " . $GLOBALS['stock_by_godown_table'] . " WHERE " . $where . " product_id = '" . $product_id . "' AND deleted = '0' AND case_contains != '".$GLOBALS['null_value']."' GROUP BY case_contains";

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

    
    public function getGodownStockProduct($godown_id)
    {
        $select_query ="";$where ="";  $stock_product_list = array(); 
        if(!empty($godown_id)){ 
             $select_query ="SELECT DISTINCT(product_id) as product_id FROM ".$GLOBALS['stock_table']." WHERE godown_id = '".$godown_id."' AND deleted = '0'";
        }
        $stock_product_list =$this->getQueryRecords($GLOBALS['stock_table'],$select_query);

            // $final_product_list = array();
		
			// if (!empty($stock_productt_list)) {
			// 	foreach ($stock_productt_list as $stock) {
			// 		$stock_product_id = "";
			// 		if (!empty($stock['product_id'])) {
			// 			$stock_product_id = $stock['product_id'];
			// 		}
		
			// 		$query = "SELECT SUM(inward_unit) as inward, SUM(outward_unit) as outward 
			// 				  FROM " . $GLOBALS['stock_table'] . " 
			// 				  WHERE product_id = '" . $stock_product_id . "' 
			// 				  AND godown_id = '" . $godown_id . "' 
			// 				  AND deleted = '0'";
		
			// 		if (!empty($query)) {
			// 			$currentstock_product_list = $this->getQueryRecords($GLOBALS['stock_table'], $query);
			// 			$stock_inward=0; $stock_outward=0; $current_stock =0;
		
			// 			if (!empty($currentstock_product_list)) {
						
			// 				foreach($currentstock_product_list as $data){
			// 					if (!empty($data['inward'])) {
			// 						$stock_inward = $data['inward'];
			// 					}
			// 					if (!empty($data['outward'])) {
			// 						$stock_outward = $data['outward'];
			// 					}
			// 				}
			// 				$current_stock = $stock_inward - $stock_outward;
		
			// 				if ($current_stock > 0) {
			// 					$final_product_list[] = array(
			// 						'product_id' => $stock_product_id,
			// 						'current_stock' => $current_stock
			// 					);
			// 				}
			// 			}
			// 		}
			// 	}
			// }
		
			return $stock_product_list;
    }
    
    public function getGodownContractorStockProduct($godown_id, $contractor_id)
    {
        $select_query ="";$where ="";  $stock_product_list = array(); 
        // if(!empty($contractor_id)) {
        //     $where = " contractor_id = '".$contractor_id."' AND ";
        // }
        $finished_group_name = "finished";
        $finished_group_name = $this->encode_decode('encrypt', $finished_group_name);
        $finished_group_id = "";
        if(!empty($finished_group_name)){
            $finished_group_id = $this->getTableColumnValue($GLOBALS['group_table'],'lower_case_name',$finished_group_name,'group_id');
        }

        if(!empty($godown_id) && !empty($finished_group_id)){ 
             $select_query ="SELECT DISTINCT(product_id) as product_id FROM ".$GLOBALS['stock_table']." WHERE godown_id = '".$godown_id."' AND group_id != '".$finished_group_id."' AND deleted = '0'";
        }
        if(!empty($select_query)){
            $stock_product_list =$this->getQueryRecords($GLOBALS['stock_table'],$select_query);
        }
        return $stock_product_list;

    }

    public function getInwardSubunitQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        $where = "";
        $select_query = "";
        $list = array();
        $inward_subunit = 0;

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
            $select_query = "SELECT SUM(inward_subunit) as inward_subunit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        } else {
            $select_query = "SELECT SUM(inward_subunit) as inward_subunit FROM " . $GLOBALS['stock_table'] . " WHERE  deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                    $inward_subunit = $data['inward_subunit'];
                }
            }
        }
        return $inward_subunit;
    }

    public function getOutwardSubunitQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains)
    {
        $where = "";
        $select_query = "";
        $list = array();
        $outward_subunit = 0;

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
            $select_query = "SELECT SUM(outward_subunit) as outward_subunit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        } else {
            $select_query = "SELECT SUM(outward_subunit) as outward_subunit FROM " . $GLOBALS['stock_table'] . " WHERE  deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
        }
        if (!empty($list)) {
            foreach ($list as $data) {
                if (!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                    $outward_subunit = $data['outward_subunit'];
                }
            }
        }
        return $outward_subunit;
    }

    public function getProductContentsFromMagazine($product_id, $magazine_id) {
        $list = array(); $select_query = ""; 

        if (!empty($magazine_id)) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }

        
        $select_query = "SELECT * FROM " . $GLOBALS['stock_by_magazine_table'] . " WHERE " . $where . " product_id = '" . $product_id . "' AND deleted = '0' AND case_contains != '".$GLOBALS['null_value']."' GROUP BY case_contains";

        // echo $select_query;
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['stock_by_magazine_table'], $select_query);
        }
        return $list;
    }

    public function DeleteMaterialTransfer($bill_unique_id) {
        $material_transfer_list = array(); $stock_bill_type = ""; $from_location_id = ""; $to_location_id = ""; $product_id = array(); $stock_action = array(); $content = array();
        $material_transfer_list = $this->getTableRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $bill_unique_id, '');
        if(!empty($material_transfer_list)) {
            foreach($material_transfer_list as $data) {
                if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']) {
                    $stock_bill_type = $data['location'];
                }
                if(!empty($data['from_location']) && $data['from_location'] != $GLOBALS['null_value']) {
                    $from_location_id = $data['from_location'];
                }
                if(!empty($data['to_location']) && $data['to_location'] != $GLOBALS['null_value']) {
                    $to_location_id = $data['to_location'];
                }
                if(!empty($data['product_id'])) {
                    $product_id = $data['product_id'];
                    $product_id = explode(",", $product_id);
                }
                if(!empty($data['content'])) {
                    $content = $data['content'];
                    $content = explode(",", $content);
                }
            }
        }
        $can_delete = 1;
        if(!empty($product_id)) {
            for($i=0; $i < count($product_id); $i++) {
                if(!empty($product_id[$i])) {
                    if(!empty($to_location_id)) {
                        $inward_quantity = 0; $outward_quantity = 0;
                        if($stock_bill_type == '1') {
                            $inward_quantity = $this->getInwardQty($bill_unique_id, $to_location_id, '', $product_id[$i], $content[$i]);
                            $outward_quantity = $this->getOutwardQty($bill_unique_id, $to_location_id, '', $product_id[$i], $content[$i]);
                        }
                        else if($stock_bill_type == '2') {
                            $inward_quantity = $this->getInwardQty($bill_unique_id, '', $to_location_id, $product_id[$i], $content[$i]);
                            $outward_quantity = $this->getOutwardQty($bill_unique_id, '', $to_location_id, $product_id[$i], $content[$i]);
                        }
                    }
                    if($inward_quantity < $outward_quantity) {
                        $can_delete = 0;
                    }
                }
            }
        }
        $prev_list = array();
        if($can_delete == '1'){
            $prev_list = $this->PrevStockList($bill_unique_id);
            if(!empty($prev_list)) {
                foreach($prev_list as $data) {
                    $stock_id = ""; $stock_godown_id = ""; $stock_magazine_id = ""; $stock_category_id = ""; $stock_group_id = ""; $stock_product_id = ""; $stock_table_action = ""; $stock_type = ""; $stock_case_contains = "";
                    $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0;
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
                    }
                    if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $stock_godown_id = $data['godown_id'];
                        $stock_type = 1;
                    }
                    if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_magazine_id = $data['magazine_id'];
                        $stock_type = 2;
                    }
                    // if(!empty($data['category_id']) && $data['category_id'] != $GLOBALS['null_value']) {
                    //     $stock_category_id = $data['category_id'];
                    // }
                    if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                        $stock_case_contains = $data['case_contains'];
                    }
                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $stock_product_id = $data['product_id'];
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

                    if($stock_type == '1') {
                        $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                        $current_stock_unit = $this->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $this->getCurrentStockSubunit($GLOBALS['stock_by_godown_table'], $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_godown_table'], $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    }
                    else if($stock_type == '2') {
                        $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                        $current_stock_unit = $this->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'], $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $this->getCurrentStockSubunit($GLOBALS['stock_by_magazine_table'], $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_magazine_table'], $stock_godown_id, $stock_magazine_id, $stock_product_id, $stock_case_contains);
                    }
                    if($stock_table_action == "Plus") {
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
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }
                    }
                
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
                                $stock_table_update_id = $this->UpdateSQL($stock_unique_table, $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }
        return $can_delete;
    }
    public function getProductContainsListFromGodown($product_id, $godown_id, $magazine_id){
        $list = array(); $select_query = ""; 

        if (!empty($magazine_id)) {
            if (!empty($where)) {
                $where = $where . " magazine_id = '" . $magazine_id . "' AND ";
            } else {
                $where = " magazine_id = '" . $magazine_id . "' AND ";
            }
        }
        if (!empty($godown_id)) {
            if (!empty($where)) {
                $where = $where . " godown_id = '" . $godown_id . "' AND ";
            } else {
                $where = " godown_id = '" . $godown_id . "' AND ";
            }
        }
        if (!empty($product_id)) {
            if (!empty($where)) {
                $where = $where . " product_id = '" . $product_id . "' AND ";
            } else {
                $where = " product_id = '" . $product_id . "' AND ";
            }
        }
        if(!empty($where)){
            $select_query = "SELECT DISTINCT case_contains FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . "  deleted = '0'";
        }
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['stock_table'], $select_query);
        }
        return $list;
    }

    public function DeleteStockAdjustment($bill_unique_id) {
        $stock_adjustment_list = array(); $godown_id = ""; $magazine_id = ""; $product_id = array(); $stock_action = array();
        $stock_adjustment_list = $this->getTableRecords($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $bill_unique_id, '');
        if(!empty($stock_adjustment_list)) {
            foreach($stock_adjustment_list as $data) {
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_id = $data['godown_id'];
                }
                if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                    $magazine_id = $data['magazine_id'];
                }
                if(!empty($data['product_id'])) {
                    $product_id = $data['product_id'];
                    $product_id = explode(",", $product_id);
                }
                if(!empty($data['stock_action'])) {
                    $stock_action = $data['stock_action'];
                    $stock_action = explode(",", $stock_action);
                }
            }
        }
        $can_delete = 1;
        if(!empty($product_id)) {
            for($i=0; $i < count($product_id); $i++) {
                if(!empty($product_id[$i])) {
                    if($stock_action[$i] == '1') {
                        $inward_quantity = 0; $outward_quantity = 0;
                        if(!empty($godown_id)) {

                            $inward_quantity = $this->getInwardQty($bill_unique_id, $godown_id, '',$product_id[$i], $case_contains[$i]);
                            $outward_quantity = $this->getOutwardQty('', $godown_id, '', $product_id[$i],$case_contains[$i]);
                        }
                        else if(!empty($magazine_id)) {
                            $inward_quantity = $this->getInwardQty($bill_unique_id, '', $magazine_id, $product_id[$i], $case_contains[$i]);
                            $outward_quantity = $this->getOutwardQty('', '', $magazine_id, $product_id[$i], $case_contains[$i]);
                        }
                    
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
                    $stock_id = ""; $stock_godown_id = ""; $stock_magazine_id = ""; $stock_category_id = ""; $stock_group_id = ""; $stock_product_id = ""; $stock_table_action = ""; $stock_case_contains = "";
                    $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0;
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
                    }
                    if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $stock_godown_id = $data['godown_id'];
                        $stock_type = 1;
                    }
                    if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_magazine_id = $data['magazine_id'];
                        $stock_type = 2;

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
                        // $stock_table_action = $data['stock_action'];
                    // }
                    $current_stock_unit = 0; $current_stock_subunit = 0; $stock_table_unique_id = ""; $stock_unique_table = "";

                    if(!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
                        $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                        $current_stock_unit = $this->getCurrentStockUnit($GLOBALS['stock_by_godown_table'], $stock_godown_id, '', $stock_product_id,$stock_case_contains);
                        $current_stock_subunit = $this->getCurrentStockSubunit($GLOBALS['stock_by_godown_table'], $stock_godown_id, '', $stock_product_id,$stock_case_contains);
                        $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_godown_table'], $stock_godown_id, '', $stock_product_id,$stock_case_contains);
                    }
                    else{
                        $stock_unique_table = $GLOBALS['stock_by_magazine_table'];
                        $current_stock_unit = $this->getCurrentStockUnit($GLOBALS['stock_by_magazine_table'], '',$stock_magazine_id, $stock_product_id,$stock_case_contains);
                        $current_stock_subunit = $this->getCurrentStockSubunit($GLOBALS['stock_by_magazine_table'], '',$stock_magazine_id,  $stock_product_id,$stock_case_contains);
                        $stock_table_unique_id = $this->getStockTablesUniqueID($GLOBALS['stock_by_magazine_table'], '',$stock_magazine_id,  $stock_product_id,$stock_case_contains);
                    }
                    if($stock_table_action == "Plus") {
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
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }
                    }
                   
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
                                $stock_table_update_id = $this->UpdateSQL($stock_unique_table, $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }
        return $can_delete;
    }

}

?>