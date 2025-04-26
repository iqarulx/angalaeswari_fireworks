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
            $query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_id = '".$bill_id."' AND payment_mode_id = '".$payment_mode_id."' AND deleted = '0'";
        }else{
            $query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_id = '".$bill_id."' AND deleted = '0'";
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
}