<?php
	include("basic_functions.php");
	include("creation_functions.php");
	include("stock_functions.php");
	include("payment_function.php");
	
	class billing extends Basic_Functions {
		public function basic_functions_object() {
			$basic_obj = "";		
			$basic_obj = new Basic_Functions();
			return $basic_obj;
		}

		public function creation_function_object() {
			$create_obj = "";		
			$create_obj = new Creation_functions();
			return $create_obj;
		}

		public function stock_function_object() {
			$stock_obj = "";		
			$stock_obj = new Stock_Functions();
			return $stock_obj;
		}

		public function payment_function_object() {
			$payment_obj = "";		
			$payment_obj = new paymentFunctions();
			return $payment_obj;
		}

		public function getProjectTitle() {
			$string = parent::getProjectTitle();
			return $string;
		}
		
		public function encode_decode($action, $string) {
			$string = parent::encode_decode($action, $string);
			return $string;
		}		

		public function InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action) {
			$basic_obj = "";
			$basic_obj = $this->basic_functions_object();
			$last_insert_id = "";		
			$last_insert_id = $basic_obj->InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action);
			return $last_insert_id;
		}	
		public function UpdateSQL($table, $update_id, $columns, $values, $action) {
			$basic_obj = "";
			$basic_obj = $this->basic_functions_object();
			$msg = "";		
			$msg = $basic_obj->UpdateSQL($table, $update_id, $columns, $values, $action);
			return $msg;
		}
		public function UpdateClient($main_client_id, $merge_client_id) {
			$msg = "";		
			$msg = parent::UpdateClient($main_client_id, $merge_client_id);
			return $msg;
		}
		public function getTableColumnValue($table, $column, $value, $return_value) {
			$result = "";
			$result = parent::getTableColumnValue($table, $column, $value, $return_value);
			return $result;
		}
		public function CompanyCount() {
			$list = 0;
			$list = parent::CompanyCount();
			return $list;
		}
		public function getTableRecords($table, $column, $value, $order) {
			$basic_obj = "";
			$basic_obj = $this->basic_functions_object();
			$result = ""; $list = array();		
			$result = $basic_obj->getTableRecords($table, $column, $value, $order);
			return $result;
		}

		public function daily_db_backup() {
			$result = "";		
			$result = parent::daily_db_backup();
			return $result;
		}
		public function image_directory() {
			$target_dir = "";		
			$target_dir = parent::image_directory();
			return $target_dir;
		}
		public function temp_image_directory() {
			$temp_dir = "";		
			$temp_dir = parent::temp_image_directory();
			return $temp_dir;
		}
		public function clear_temp_image_directory() {
			$res = "";		
			$res = parent::clear_temp_image_directory();
			return $res;
		}
		
		public function check_user_id_ip_address() {
			$check_login_id = "";			
			$check_login_id = parent::check_user_id_ip_address();			
			return $check_login_id;	
		}
		public function checkUser() {
			$login_user_id = "";			
			$login_user_id = parent::checkUser();			
			return $login_user_id;	
		}
		public function getDailyReport($from_date, $to_date) {
			$list = array();
			$list = parent::getDailyReport($from_date, $to_date);
			return $list;
		}
		
		public function send_mobile_details($phone_number, $msg) {
			$res = "";
			$res = parent::send_mobile_details($phone_number, $msg);
			return true;
		}		
		public function numberFormat($number, $decimals) {
			$basic_obj = "";
			$basic_obj = $this->basic_functions_object();
			$msg = "";		
			$msg = $basic_obj->numberFormat($number, $decimals);
			return $msg;
		}	
		
		public function billing_function_object() {
			$billobj = "";		
			$billobj = new Billing_Functions();
			return $billobj;
		}
		public function automate_number($table, $column) {
			$next_number = "";
			$next_number = parent::automate_number($table, $column);
			return $next_number;
		}	


		// Creation Function
		

		public function CheckUnitAlreadyExists($company_id, $unit_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckUnitAlreadyExists($company_id, $unit_name);
			return $result;
		}

		public function GetUnitLinkedCount($unit_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetUnitLinkedCount($unit_id);
			return $result;
		}

		public function CheckChargesAlreadyExists($bill_company_id, $charge_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckChargesAlreadyExists($bill_company_id, $charge_name);
			return $result;
		}

		public function getAgentCustomerList($agent_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->getAgentCustomerList($agent_id);
			return $result;
		}

		public function GetChargesLinkedCount($charges_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetChargesLinkedCount($charges_id);
			return $result;
		}

		public function TransportMobileExists($mobile_number) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->TransportMobileExists($mobile_number);
			return $result;
		}
		
		public function CheckPaymentModeAlreadyExists($company_id, $payment_mode_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckPaymentModeAlreadyExists($company_id, $payment_mode_name);
			return $result;
		}

		public function GetFactoryLinkedCount($factory_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetFactoryLinkedCount($factory_id);
			return $result;
		}

		public function GetMagazineLinkedCount($magazine_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetMagazineLinkedCount($magazine_id);
			return $result;
		}

		public function GetGodownLinkedCount($godown_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetGodownLinkedCount($godown_id);
			return $result;
		}

		public function GetPaymentmodeLinkedCount($payment_mode_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->GetPaymentmodeLinkedCount($payment_mode_id);
			return $result;
		}
		public function GetBankLinkedCount($bank_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->GetBankLinkedCount($bank_id);
			return $result;
		}
		public function CheckFactoryAlreadyExist($lowercase_name_location) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->CheckFactoryAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function CheckGodownAlreadyExist($lowercase_name_location) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->CheckGodownAlreadyExist($lowercase_name_location);
			return $result;
		}

		public function CheckMagazineAlreadyExist($lowercase_name_location) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->CheckMagazineAlreadyExist($lowercase_name_location);
			return $result;
		}

		public function getContractorKuliId($contractor_id, $product_id, $unit_type) {
			$result = "";
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = $creationobj->getContractorKuliId($contractor_id, $product_id, $unit_type);
			return $result;
		}

		public function getContractorProductTable($contractor_id) {
			$result = "";
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = $creationobj->getContractorProductTable($contractor_id);
			return $result;
		}

		public function DeleteContractorKuli($contractor_id) {
			$result = "";
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = $creationobj->DeleteContractorKuli($contractor_id);
			return $result;
		}

		public function getProductWithGroup($type1,$type2,$type3) {
			$result = "";
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = $creationobj->getProductWithGroup($type1,$type2,$type3);
			return $result;
		}

		public function CheckTransportAlreadyExist($lowercase_name_location) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->CheckTransportAlreadyExist($lowercase_name_location);
			return $result;
		}

		public function getConsumptionTableRecords() {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->getConsumptionTableRecords();
			return $result;
		}

		public function PurchaseBillNumberAlreadyExists($bill_company_id,$purchase_bill_number) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->PurchaseBillNumberAlreadyExists($bill_company_id,$purchase_bill_number);
			return $result;
		}

		public function getPurchaseList($from_date, $to_date,$search_text,$show_bill) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getPurchaseList($from_date, $to_date,$search_text,$show_bill);
			return $list;
		}

		public function getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text,$show_bill) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text,$show_bill);
			return $list;
		}

		public function getDeliverySlipList($from_date, $to_date, $customer_id, $search_text,$show_bill) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getDeliverySlipList($from_date, $to_date, $customer_id, $search_text,$show_bill);
			return $list;
		}

		public function getDeliverySlipIndex($delivery_slip_id, $conversion_update) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getDeliverySlipIndex($delivery_slip_id, $conversion_update);
			return $list;
		}

		public function getProformaInvoiceActions($proforma_invoice_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getProformaInvoiceActions($proforma_invoice_id);
			return $list;
		}

		public function getDeliverySlipActions($delivery_slip_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getDeliverySlipActions($delivery_slip_id);
			return $list;
		}

		public function getDeliveryProductsFromPI($proforma_invoice_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getDeliveryProductsFromPI($proforma_invoice_id);
			return $list;
		}

		public function getEstimateIndex($estimate_id, $conversion_update) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getEstimateIndex($estimate_id, $conversion_update);
			return $list;
		}

		public function getEstimateList($from_date, $to_date, $customer_id, $search_text,$show_bill) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$list = array();
			$list = $creationobj->getEstimateList($from_date, $to_date, $customer_id, $search_text,$show_bill);
			return $list;
		}

		public function getContractorFinishedProducts($contractor_id,$finished_product_group_id) {
			$billobj = "";
			$billobj = $this->creation_function_object();
			$list = array();
			$list = $billobj->getContractorFinishedProducts($contractor_id,$finished_product_group_id);
			return $list;
		}
		public function ProductContainsList($product_id){
			$billobj = "";
			$billobj = $this->creation_function_object();
			$list = array();
			$list = $billobj->ProductContainsList($product_id);
			return $list;
		}
	
		public function getDailyProductionList($from_date, $to_date, $filter_factory_id, $filter_magazine_id, $filter_contractor_id, $show_bill) {
			$billobj = "";
			$billobj = $this->creation_function_object();
			$list = array();
			$list = $billobj->getDailyProductionList($from_date, $to_date, $filter_factory_id, $filter_magazine_id, $filter_contractor_id, $show_bill);
			return $list;
		}
		public function getCoolyRate($contractor_id, $product_id, $unit_type) {
			$billobj = "";
			$billobj = $this->creation_function_object();
			$list = array();
			$list = $billobj-> getCoolyRate($contractor_id, $product_id, $unit_type);
			return $list;
		}

		// Stock Function

		public function StockUpdate($page_table,$in_out_type,$bill_unique_id,$bill_unique_number,$product_id,$remarks, $stock_date, $godown_id, $magazine_id,$unit_id, $quantity,$case_contains, $group, $godown_magazine) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->StockUpdate($page_table,$in_out_type,$bill_unique_id,$bill_unique_number,$product_id,$remarks, $stock_date, $godown_id, $magazine_id,$unit_id, $quantity,$case_contains, $group, $godown_magazine);
			return $stock_update;
		}

		public function PrevStockList($bill_unique_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->PrevStockList($bill_unique_id);
			return $stock_update;
		}
		public function getCurrentStockUnit($table,$godown_id, $magazine_id,$product_id,$case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = "";
			$stock_update = $stock_obj->getCurrentStockUnit($table,$godown_id, $magazine_id,$product_id,$case_contains);
			return $stock_update;
		}
		public function getCurrentStockSubunit($table,$godown_id, $magazine_id,$product_id,$case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = "";
			$stock_update = $stock_obj->getCurrentStockSubunit($table,$godown_id, $magazine_id,$product_id,$case_contains);
			return $stock_update;
		}
		public function getStockTablesUniqueID($table, $godown_id, $magazine_id, $product_id,$case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getStockTablesUniqueID($table, $godown_id, $magazine_id, $product_id,$case_contains);
			return $stock_update;
		}
		public function getStockUniqueID($bill_unique_id,$godown_id, $magazine_id,$product_id, $unit_id,$case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getStockUniqueID($bill_unique_id,$godown_id, $magazine_id,$product_id, $unit_id,$case_contains);
			return $stock_update;
		}
		public function getProductContentsFromGodown($product_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->getProductContentsFromGodown($product_id);
			return $result;
		}

		public function DeleteDailyProduction($bill_unique_id) {
			$billobj = "";
			$billobj = $this->stock_function_object();
			$list = array();
			$list = $billobj->DeleteDailyProduction($bill_unique_id);
			return $list;
		}

		public function getOutwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains) {
			$billobj = "";
			$billobj = $this->stock_function_object();
			$list = array();
			$list = $billobj->getOutwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}

		public function getInwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains) {
			$billobj = "";
			$billobj = $this->stock_function_object();
			$list = array();
			$list = $billobj->getInwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}

		// payment function 

		public function DeletePayment($bill_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$payment_update = 0;
			$payment_update = $payment_obj->DeletePayment($bill_id);
			return $payment_update;
		}

		public function UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type);
			return $list;
		}

		public function getContractorSemiFinishedProducts($contractor_id,$finished_product_group_id) {
			$billobj = "";
			$billobj = $this->creation_function_object();
			$list = array();
			$list = $billobj-> getContractorSemiFinishedProducts($contractor_id,$finished_product_group_id);
			return $list;
		}

		public function getSemiFinishedInwardList($from_date, $to_date, $filter_factory_id, $filter_godown_id, $filter_contractor_id, $show_bill) {
			$billobj = "";
			$billobj = $this->creation_function_object();
			$list = array();
			$list = $billobj->getSemiFinishedInwardList($from_date, $to_date, $filter_factory_id, $filter_godown_id, $filter_contractor_id, $show_bill);
			return $list;
		}

	}
?>