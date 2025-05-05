<?php 

class PaymentFunctions extends Basic_Functions {

    public function getPaymentDetails($party_id, $payment_number, $payment_type) {
        $select_query = "SELECT * FROM ". $GLOBALS['payment_table'] . " WHERE party_id = '$party_id' AND payment_number = '$payment_number' AND payment_type = '$payment_type'";
        
        $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
        return $list;
    }

    public function UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type){
        $query = ""; $list = array(); $unique_id = "";
    
        if($bill_type == "Voucher" || $bill_type == "Receipt" || $bill_type == "Expense" || $bill_type == "Suspense Voucher" || $bill_type == "Suspense Receipt"){
            $query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_id = '".$bill_id."' AND payment_mode_id = '".$payment_mode_id."' AND bank_id = '". $bank_id."' AND deleted = '0'";
        } else {
            if(!empty($agent_id)) {
                $query = "SELECT id FROM " . $GLOBALS['payment_table'] . " WHERE bill_id = '" . $bill_id . "' AND agent_id = '" . $agent_id . "' AND deleted = '0'";
            } else {
                $query = "SELECT id FROM " . $GLOBALS['payment_table'] . " WHERE bill_id = '" . $bill_id . "' AND deleted = '0'";
            }
        }
    
        $list = $this->getQueryRecords('', $query);
        if(!empty($list)) {
            foreach($list as $data) {
                if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                    $unique_id = $data['id'];
                }
            }
        }
    
        $created_date_time = $GLOBALS['create_date_time_label'];
        $creator = $GLOBALS['creator'];
        $creator_name = $GLOBALS['creator_name'];
        if(preg_match("/^\d+$/", $unique_id)) {
            $action = "Updated Successfully";
            $columns = array(); $values = array();
            $columns = array('creator_name','bill_date', 'agent_id','agent_name', 'party_id','party_name','party_type','bank_id','bank_name','payment_mode_id','payment_mode_name','open_balance_type','credit','debit');
            $values = array("'".$creator_name."'","'".$bill_date."'", "'".$agent_id."'","'".$agent_name."'", "'".$party_id."'","'".$party_name."'","'".$party_type."'","'".$bank_id."'","'".$bank_name."'","'".$payment_mode_id."'","'".$payment_mode_name."'","'".$open_balance_type."'","'".$credit."'","'".$debit."'");
            $payment_update_id = $this->UpdateSQL($GLOBALS['payment_table'], $unique_id, $columns, $values, $action);
        }
        else {
            $action = "Inserted Successfully";
            $null_value = $GLOBALS['null_value'];
            $columns = array(); $values = array();
            $columns = array('created_date_time','creator', 'creator_name', 'bill_id','bill_number','bill_date','bill_type', 'agent_id','agent_name', 'party_id','party_name','party_type','bank_id','bank_name','payment_mode_id','payment_mode_name','open_balance_type', 'credit','debit','deleted');
            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_id."'","'".$bill_number."'","'".$bill_date."'","'".$bill_type."'", "'".$agent_id."'","'".$agent_name."'", "'".$party_id."'","'".$party_name."'","'".$party_type."'","'".$bank_id."'","'".$bank_name."'","'".$payment_mode_id."'","'".$payment_mode_name."'", "'".$open_balance_type."'", "'".$credit."'","'".$debit."'","'0'");
            $payment_insert_id = $this->InsertSQL($GLOBALS['payment_table'], $columns, $values, '', '', $action);
        }
    }
    
    public function DeletePayment($bill_id){
        $payment_bill_list = array(); $payment_unique_id = "";

        $payment_bill_list = $this->getTableRecords($GLOBALS['payment_table'], 'bill_id', $bill_id,'');
        if(!empty($payment_bill_list)){
            foreach($payment_bill_list as $value){
                if(!empty($value['id'])){
                    $payment_unique_id = $value['id'];
                }
                if(preg_match("/^\d+$/", $payment_unique_id)) {
                    $action = "Payment Deleted.";
                
                    $columns = array(); $values = array();						
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $this->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                }
            }
        }
    }

    public function CurrentBalance($party_id) {
        $select_query = "SELECT * FROM ". $GLOBALS['payment_table'] . " WHERE party_id = '$party_id' AND deleted = '0'";
        $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
        if(!empty($list)) {
            $credit = 0; $debit = 0;
            foreach ($list as $key => $value) {
                if(!empty($value['credit'])) {
                    $credit += $value['credit'];
                }
                if(!empty($value['debit'])) {
                    $debit += $value['debit'];
                }
            }
            $current_balance = $credit - $debit;
            return $current_balance;
        }
    }

    public function UpdateClosingBalance($contractor_id, $current_balance) {
        $contractor_unique_id = $this->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'id');
        if(preg_match("/^\d+$/", $contractor_unique_id)) {
                $column = array( 'closing_balance');
                $value = array( "'".$current_balance."'");
                $update_id = $this->UpdateSQL($GLOBALS['contractor_table'], $contractor_unique_id, $column, $value, "Update Closing Balance");
                return $update_id;
        }
    }

    public function getPartyOpeningBalanceInPaymentExist($party_id, $bill_type) {
        $list = array(); $select_query = ""; $id = ""; $where = ""; $payment_id = "";
     
        if(!empty($party_id)){
            if(!empty($where)) {
                $where = $where." party_id = '".$party_id."' AND ";
            }
            else {
                $where = "party_id = '".$party_id."' AND ";
            }
        }
        if(!empty($bill_type)){
            if(!empty($where)) {
                $where = $where." bill_type = '".$bill_type."' AND ";
            }
            else {
                $where = "bill_type = '".$bill_type."' AND ";
            }
        }
        if(!empty($where)) {
            $select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE ".$where." deleted='0'";    
        }
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
        }
        if(!empty($list)) {
            foreach($list as $data) {
                if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                    $payment_id = $data['id'];
                }
            }
        }
        return $payment_id;
    }
    public function getExpenseentryList($from_date, $to_date, $show_bill, $filter_expense_category_id) {
        $list = array(); $select_query = ""; $where = "";

        if(!empty($from_date)) {
            $from_date = date("Y-m-d", strtotime($from_date));
            if(!empty($where)) {
                $where = $where." AND expense_date >= '".$from_date."'";
            } else {
                $where = "expense_date >= '".$from_date."'";
            }
        }

        if(!empty($to_date)) {
            $to_date = date("Y-m-d", strtotime($to_date));
            if(!empty($where)) {
                $where = $where." AND expense_date <= '".$to_date."'";
            } else {
                $where = "expense_date <= '".$to_date."'";
            }
        }

        if(!empty($filter_expense_category_id)) {
            if(!empty($where)) {
                $where = $where." AND expense_category_id = '".$filter_expense_category_id."'";
            } else {
                $where = "expense_category_id = '".$filter_expense_category_id."'";
            }
        }

        if($show_bill == '0' || $show_bill == '1') {
            if(!empty($where)) {
                $where = $where." AND deleted = '".$show_bill."' ";
            } else {
                $where = "deleted = '".$show_bill."' ";
            }
        }

        if(!empty($where)) {
            $select_query = "SELECT * FROM ".$GLOBALS['expense_table']." WHERE ".$where." ORDER BY id DESC";
        } 
        else {
            $select_query = "SELECT * FROM ".$GLOBALS['expense_table']." WHERE deleted = '0' ORDER BY id DESC";
        }
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['expense_table'], $select_query);
        }
        return $list;
    }

    public function getPendingList($party_type, $party_id) {
        $select_query = ""; $list = array();
        if(!empty($party_id)) {
            
            $select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE (party_id = '" . $party_id . "' OR agent_id = '" . $party_id . "') AND deleted = '0' ORDER BY bill_date ASC";
            
            $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
        }
        return $list;
    }

    public function getVoucherList($from_date, $to_date, $show_bill, $filter_party_id, $party_type) {
        $list = array(); $select_query = ""; $where = "";

        if(!empty($filter_party_id)) {
            $where = "party_id = '".$filter_party_id."'";
        }

        if(!empty($party_type)) {
            if(!empty($where)) {
                $where = $where." AND party_type = '".$party_type."'";
            } else {
                $where = "party_type = '".$party_type."'";
            }
        }

        if(!empty($from_date)) {
            $from_date = date("Y-m-d", strtotime($from_date));
            if(!empty($where)) {
                $where = $where." AND voucher_date >= '".$from_date."'";
            } else {
                $where = "voucher_date >= '".$from_date."'";
            }
        }

        if(!empty($to_date)) {
            $to_date = date("Y-m-d", strtotime($to_date));
            if(!empty($where)) {
                $where = $where." AND voucher_date <= '".$to_date."'";
            } else {
                $where = "voucher_date <= '".$to_date."'";
            }
        }

        if($show_bill == '0' || $show_bill == '1') {
            if(!empty($where)) {
                $where = $where." AND deleted = '".$show_bill."' ";
            } else {
                $where = "deleted = '".$show_bill."' ";
            }
        }

        if(!empty($where)) {
            $select_query = "SELECT * FROM ".$GLOBALS['voucher_table']." WHERE ".$where." ORDER BY id DESC";
        } 
        else {
            $select_query = "SELECT * FROM ".$GLOBALS['voucher_table']." WHERE deleted = '0' ORDER BY id DESC";
        }
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['voucher_table'], $select_query);
        }
        return $list;
    }

    public function getreceiptList($from_date, $to_date, $show_bill, $filter_party_id,$party_type) {
        $list = array(); $select_query = ""; $where = "";

        if(!empty($filter_party_id)) {
            $where = "party_id = '".$filter_party_id."'";
        }

        if(!empty($party_type)) {
            if(!empty($where)) {
                $where = $where." AND party_type = '".$party_type."'";
            } else {
                $where = "party_type = '".$party_type."'";
            }
        }

        if(!empty($from_date)) {
            $from_date = date("Y-m-d", strtotime($from_date));
            if(!empty($where)) {
                $where = $where." AND receipt_date >= '".$from_date."'";
            } else {
                $where = "receipt_date >= '".$from_date."'";
            }
        }

        if(!empty($to_date)) {
            $to_date = date("Y-m-d", strtotime($to_date));
            if(!empty($where)) {
                $where = $where." AND receipt_date <= '".$to_date."'";
            } else {
                $where = "receipt_date <= '".$to_date."'";
            }
        }

        if($show_bill == '0' || $show_bill == '1') {
            if(!empty($where)) {
                $where = $where." AND deleted = '".$show_bill."' ";
            } else {
                $where = "deleted = '".$show_bill."' ";
            }
        }

        if(!empty($where)) {
            $select_query = "SELECT * FROM ".$GLOBALS['receipt_table']." WHERE ".$where." ORDER BY id DESC";
        } 
        else {
            $select_query = "SELECT * FROM ".$GLOBALS['receipt_table']." WHERE deleted = '0' ORDER BY id DESC";
        }
        if(!empty($select_query)) {
            $list = $this->getQueryRecords($GLOBALS['receipt_table'], $select_query);
        }
        return $list;
    }

    public function getSupplierAgentContractorList(){

        $list = array(); $select_query = ""; $where = "";

         $select_query = "SELECT party_id, party_name, name_mobile_city,type 
        FROM (
            (SELECT sp.supplier_id as party_id, sp.supplier_name as party_name, name_mobile_city,'Supplier' as type     
             FROM ".$GLOBALS['supplier_table']." as sp 
             WHERE sp.deleted = '0')
            UNION ALL
            (SELECT ct.contractor_id as party_id, ct.contractor_name as party_name, name_mobile_city,'Contractor' as type     
             FROM ".$GLOBALS['contractor_table']." as ct 
             WHERE ct.deleted = '0')
                 UNION ALL
              (SELECT at.agent_id as party_id, at.agent_name as party_name, name_mobile_city,'Agent' as type     
             FROM ".$GLOBALS['agent_table']." as at 
             WHERE at.deleted = '0')
        ) as g ";

        if(!empty($select_query)) {
            $list = $this->getQueryRecords('', $select_query);
        }
        return $list;
    }
    
    public function getCustomerList(){
        $list = array(); $select_query = ""; $where = "";
        $select_query = "SELECT * FROM " . $GLOBALS['customer_table'] . " WHERE agent_id = '' AND agent_id != 'NULL' AND deleted = 0 ORDER BY id DESC";
        if(!empty($select_query)) {
            $list = $this->getQueryRecords('', $select_query);
        }
        return $list;
    }
}