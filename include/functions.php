<?php
	include("basic_functions.php");
	include("creation_functions.php");
	include("stock_functions.php");
	include("payment_function.php");
	include("report_functions.php");

	
	class billing extends Basic_Functions {
		// Basic Functions
		public function basic_functions_object() {
			$basic_obj = "";		
			$basic_obj = new Basic_Functions();
			return $basic_obj;
		}
		public function getProjectTitle() {
			$string = parent::getProjectTitle();
			return $string;
		}
		public function encode_decode($action, $string) {
			$string = parent::encode_decode($action, $string);
			return $string;
		}		
		public function getOtherCityList($district) {
			$list = array();
			$list = parent::getOtherCityList($district);
			return $list;
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
		public function automate_number($table, $column) {
			$next_number = "";
			$next_number = parent::automate_number($table, $column);
			return $next_number;
		}	
		public function CheckRoleAccessPage($role_id,$permission_page) {
			$access = "";
			$access = parent::CheckRoleAccessPage($role_id,$permission_page);
			return $access;
		}

		// Creation Functions
		public function creation_function_object() {
			$create_obj = "";		
			$create_obj = new Creation_functions();
			return $create_obj;
		}
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
		public function CheckFinishedGroupAlreadyExists($unit_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckFinishedGroupAlreadyExists($unit_name);
			return $result;
		}
		public function GetFinishedGroupLinkedCount($finished_group_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetFinishedGroupLinkedCount($finished_group_id);
			return $result;
		}
		public function GetProductsListing($group_id, $finished_group_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetProductsListing($group_id, $finished_group_id);
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
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getAgentCustomerList($agent_id);
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
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetPaymentmodeLinkedCount($payment_mode_id);
			return $result;
		}
		public function GetBankLinkedCount($bank_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetBankLinkedCount($bank_id);
			return $result;
		}
		public function CheckFactoryAlreadyExist($lowercase_name_location) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckFactoryAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function CheckGodownAlreadyExist($lowercase_name_location) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckGodownAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function CheckMagazineAlreadyExist($lowercase_name_location) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckMagazineAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function getContractorKuliId($contractor_id, $product_id, $unit_type) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->getContractorKuliId($contractor_id, $product_id, $unit_type);
			return $result;
		}
		public function getContractorProductTable($contractor_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->getContractorProductTable($contractor_id);
			return $result;
		}
		public function DeleteContractorKuli($contractor_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->DeleteContractorKuli($contractor_id);
			return $result;
		}
		public function getProductWithGroup($type1,$type2,$type3) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->getProductWithGroup($type1,$type2,$type3);
			return $result;
		}
		public function CheckTransportAlreadyExist($lowercase_name_location) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckTransportAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function getConsumptionTableRecords($filter_contractor_id, $show_bill, $from_date, $to_date) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getConsumptionTableRecords($filter_contractor_id, $show_bill, $from_date, $to_date);
			return $result;
		}
		public function PurchaseBillNumberAlreadyExists($bill_company_id,$purchase_bill_number) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->PurchaseBillNumberAlreadyExists($bill_company_id,$purchase_bill_number);
			return $result;
		}
		public function getPurchaseList($from_date, $to_date,$search_text,$show_bill, $product_group) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getPurchaseList($from_date, $to_date,$search_text,$show_bill, $product_group);
			return $list;
		}
		public function getMaterialTransferList($from_date, $to_date, $show_bill) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getMaterialTransferList($from_date, $to_date, $show_bill);
			return $list;
		}	
		public function getContractorProductUniqueIds($contractor_id, $product_id, $unit_type){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getContractorProductUniqueIds($contractor_id, $product_id, $unit_type);
			return $result;
		}
		public function CheckContractorAlreadyExist($lowercase_name_location) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckContractorAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function CheckContractorMobileNoAlreadyExist($mobile_number) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckContractorMobileNoAlreadyExist($mobile_number);
			return $result;
		}
		public function GetFinishedSemiFinishedProductList($rawmaterial_group_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetFinishedSemiFinishedProductList($rawmaterial_group_id);
			return $result;
		}
		public function CheckExpenseCategoryAlreadyExists($expense_category_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckExpenseCategoryAlreadyExists($expense_category_name);
			return $result;
		}
		public function getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text,$show_bill, $agent_id, $transport_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text,$show_bill, $agent_id, $transport_id);
			return $list;
		}
		public function getDeliverySlipList($from_date, $to_date, $customer_id, $search_text,$show_bill,$agent_id, $transport_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getDeliverySlipList($from_date, $to_date, $customer_id, $search_text,$show_bill,$agent_id, $transport_id);
			return $list;
		}
		public function getDeliverySlipIndex($delivery_slip_id, $conversion_update) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getDeliverySlipIndex($delivery_slip_id, $conversion_update);
			return $list;
		}
		public function getProformaInvoiceActions($proforma_invoice_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getProformaInvoiceActions($proforma_invoice_id);
			return $list;
		}
		public function getDeliverySlipActions($delivery_slip_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getDeliverySlipActions($delivery_slip_id);
			return $list;
		}
		public function getDeliveryProductsFromPI($proforma_invoice_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getDeliveryProductsFromPI($proforma_invoice_id);
			return $list;
		}
		public function getEstimateIndex($estimate_id, $conversion_update) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getEstimateIndex($estimate_id, $conversion_update);
			return $list;
		}
		public function getEstimateList($from_date, $to_date, $customer_id, $search_text,$show_bill, $agent_id, $transport_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getEstimateList($from_date, $to_date, $customer_id, $search_text,$show_bill, $agent_id, $transport_id);
			return $list;
		}
		public function getContractorFinishedProducts($contractor_id,$finished_product_group_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getContractorFinishedProducts($contractor_id,$finished_product_group_id);
			return $list;
		}
		public function ProductContainsList($product_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->ProductContainsList($product_id);
			return $list;
		}
		public function getDailyProductionList($from_date, $to_date, $filter_factory_id, $filter_magazine_id, $filter_contractor_id, $show_bill) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getDailyProductionList($from_date, $to_date, $filter_factory_id, $filter_magazine_id, $filter_contractor_id, $show_bill);
			return $list;
		}
		public function getCoolyRate($contractor_id, $product_id, $unit_type) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj-> getCoolyRate($contractor_id, $product_id, $unit_type);
			return $list;
		}
		public function GetProductLinkedCount($product_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->  GetProductLinkedCount($product_id);
			return $list;
		}
		public function getOpeningStockCount($product_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getOpeningStockCount($product_id);
			return $list;
		}
		public function getProductFromGodown($godown_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getProductFromGodown($godown_id);
			return $list;
		}	
		public function getProductFromMagazine($magazine_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj-> getProductFromMagazine($magazine_id);
			return $list;
		}
		public function getProducts($product_type) {
            $create_obj = "";
            $create_obj = $this->creation_function_object();
            $list = array();
            $list = $create_obj-> getProducts($product_type);
            return $list;
        }
		public function getStockAdjustmentList($from_date, $to_date, $show_bill) {
			$create_obj = "";
            $create_obj = $this->creation_function_object();
            $list = array();
            $list = $create_obj-> getStockAdjustmentList($from_date, $to_date, $show_bill);
            return $list;
        }
		public function getContractorSemiFinishedProducts($contractor_id,$finished_product_group_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj-> getContractorSemiFinishedProducts($contractor_id,$finished_product_group_id);
			return $list;
		}
		public function getSemiFinishedInwardList($from_date, $to_date, $filter_factory_id, $filter_godown_id, $filter_contractor_id, $show_bill) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getSemiFinishedInwardList($from_date, $to_date, $filter_factory_id, $filter_godown_id, $filter_contractor_id, $show_bill);
			return $list;
		}
		public function getPurchaseReportList($from_date, $to_date, $supplier_id,$cancel_bill_btn) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getPurchaseReportList($from_date, $to_date, $supplier_id,$cancel_bill_btn);
			return $list;
		}
		public function getSalesReportList($from_date, $to_date, $customer_id, $agent_id, $transport_id,$cancel_bill_btn) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getSalesReportList($from_date, $to_date, $customer_id, $agent_id, $transport_id,$cancel_bill_btn);
			return $list;
		}

		// Stock Functions
		public function stock_function_object() {
			$stock_obj = "";		
			$stock_obj = new Stock_Functions();
			return $stock_obj;
		}
		public function getInwardSubunitQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->getInwardSubunitQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains);
			return $result;
		}
		public function getOutwardSubunitQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->getOutwardSubunitQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains);
			return $result;
		}
		public function getProductContentsFromMagazine($product_id, $magazine_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->getProductContentsFromMagazine($product_id, $magazine_id);
			return $result;
		}
		public function DeleteStockAdjustment($bill_unique_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->DeleteStockAdjustment($bill_unique_id);
			return $stock_update;
		}
		public function getGodownContractorStockProduct($godown_id, $contractor_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->getGodownContractorStockProduct($godown_id, $contractor_id);
			return $result;
		}
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
		public function getProductContentsFromGodown($product_id, $godown_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->getProductContentsFromGodown($product_id, $godown_id);
			return $result;
		}
		public function getGodownStockProduct($godown_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->getGodownStockProduct($godown_id);
			return $list;
		}
		public function DeleteDailyProduction($bill_unique_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeleteDailyProduction($bill_unique_id);
			return $list;
		}
		public function getOutwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->getOutwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}
		public function getInwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->getInwardQty($bill_unique_id, $godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}
		public function DeleteMaterialTransfer($bill_unique_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeleteMaterialTransfer($bill_unique_id);
			return $list;
		}
		public function getProductContainsListFromGodown($product_id, $godown_id, $magazine_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->getProductContainsListFromGodown($product_id, $godown_id, $magazine_id);
			return $list;
		}

		// Payment Functions
		public function payment_function_object() {
			$payment_obj = "";		
			$payment_obj = new paymentFunctions();
			return $payment_obj;
		}
		public function DeletePayment($bill_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$payment_update = 0;
			$payment_update = $payment_obj->DeletePayment($bill_id);
			return $payment_update;
		}
		public function getPendingList($party_type, $party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPendingList($party_type, $party_id);
			return $list;
		}
		public function getSupplierAgentContractorList(){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getSupplierAgentContractorList();
			return $list;
		}
		public function getVoucherList($from_date, $to_date, $show_bill, $filter_party_id,$party_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getVoucherList($from_date, $to_date, $show_bill, $filter_party_id,$party_type);
			return $list;
		}
		public function getreceiptList($from_date, $to_date, $show_bill, $filter_party_id,$party_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getreceiptList($from_date, $to_date, $show_bill, $filter_party_id,$party_type);
			return $list;
		}
		public function getExpenseentryList($from_date, $to_date, $show_bill, $filter_expense_category_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getExpenseentryList($from_date, $to_date, $show_bill, $filter_expense_category_id);
			return $list;
		}
		public function UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$agent_id,$agent_name,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type);
			return $list;
		}
		public function getPartyOpeningBalanceInPaymentExist($party_id, $bill_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$payment_update = 0;
			$payment_update = $payment_obj->getPartyOpeningBalanceInPaymentExist($party_id, $bill_type);
			return $payment_update;
		}
		public function getCustomerList() {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getCustomerList();
			return $list;
		}

		// Report Functions
		public function report_function_object() {
			$report_obj = "";		
			$report_obj = new Report_functions();
			return $report_obj;
		}
		public function getPaymentPartyList($filter_party_type,$filter_bill_type) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getPaymentPartyList($filter_party_type,$filter_bill_type);
			return $list;
		}
		public function getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id,$filter_category_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id,$filter_category_id);
			return $list;
		}
		public function getGroupList($group_type) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getGroupList($group_type);
			return $list;
		}
		public function getStockReportList($group_id, $godown_id, $magazine_id, $product_id, $stock_type, $case_contains, $contractor_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getStockReportList($group_id, $godown_id, $magazine_id, $product_id, $stock_type, $case_contains, $contractor_id);
			return $list;
		}
		public function getStockContainsList($product_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getStockContainsList($product_id);
			return $list;
		}
		public function getConsumptionQtyList($contractor_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getConsumptionQtyList($contractor_id);
			return $list;
		}
		public function getConsumptionQtyByProduct($product_id, $unit_type) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getConsumptionQtyByProduct($product_id, $unit_type);
			return $list;
		}
		public function getPurchaseTaxReport($filter_party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getPurchaseTaxReport($filter_party_id,$from_date, $to_date);
			return $list;
		}
		public function getDayBookReportList($from_date,$to_date,$party_id,$payment_mode_id) {
			$reportobj = "";
			$reportobj = $this->report_function_object();
			$list = array();
			$list = $reportobj->getDayBookReportList($from_date,$to_date,$party_id,$payment_mode_id);
			return $list;
		}
		public function getPartyList($type){
			$reportobj = "";
			$reportobj = $this->report_function_object();
			$list = array();
			$list = $reportobj->getPartyList($type);
			return $list;
		}
		public function balance_report($type, $party_id,$bill_company_id,$filter_agent_party,$from_date,$to_date){
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$result = "";
			$result = $report_obj->balance_report($type, $party_id,$bill_company_id,$filter_agent_party,$from_date,$to_date);
			return $result;
		}
		public function getSelectedAgentCustomerList($filter_party_id){
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$result = "";
			$result = $report_obj->getSelectedAgentCustomerList($filter_party_id);
			return $result;
		}
		public function getProductStockTransactionExist($product_id){
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$result = "";
			$result = $report_obj->getProductStockTransactionExist($product_id);
			return $result;
		}
		
		public function getOpeningBalance($party_id,$from_date,$to_date,$bill_company_id,$filter_agent_party,$view_type){
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getOpeningBalance($party_id,$from_date,$to_date,$bill_company_id,$filter_agent_party,$view_type);
			return $list;
		}

		//Jegan
		public function getClearTableRecords($table) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getClearTableRecords($table);
			return $list;
		}

		//Arul Murugan
		public function UpdateConversionStock($bill_id, $bill_type) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->UpdateConversionStock($bill_id, $bill_type);
			return $result;
		}
		
		public function getPendingOrderReport($from_date, $to_date, $unit_type, $product_id,$customer_id, $agent_id,$case_contains) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getPendingOrderReport($from_date, $to_date, $unit_type, $product_id,$customer_id, $agent_id,$case_contains);
			return $list;
		}
		
		public function GetPendingOrderReportAgentWise($from_date, $to_date, $customer_id, $agent_id, $unit_type) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetPendingOrderReportAgentWise($from_date, $to_date, $customer_id, $agent_id, $unit_type);
			return $list;
		}


		// New 01052025

		public function GetRoleLinkedCount($role_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetRoleLinkedCount($role_id);
			return $result;
		}
		public function GetSupplierLinkedCount($supplier_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetSupplierLinkedCount($supplier_id);
			return $result;
		}
		public function GetContractorLinkedCount($contractor_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetContractorLinkedCount($contractor_id);
			return $result;
		}
		public function GetAgentLinkedCount($agent_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetAgentLinkedCount($agent_id);
			return $result;
		}

		public function GetCustomerLinkedCount($customer_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetCustomerLinkedCount($customer_id);
			return $result;
		}
		public function GetTransportLinkedCount($transport_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetTransportLinkedCount($transport_id);
			return $result;
		}
		public function getCurrentStockDetails($product_id, $case_contains){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->getCurrentStockDetails($product_id, $case_contains);
			return $list;
		}
		public function getStatusInfo($proforma_invoice_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->getStatusInfo($proforma_invoice_id);
			return $list;
		}
		public function linkedContractor($contractor_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->linkedContractor($contractor_id);
			return $list;
		}
		public function PaymentlinkedSupplier($supplier_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->PaymentlinkedSupplier($supplier_id);
			return $list;
		}
		public function PaymentlinkedCustomer($customer_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->PaymentlinkedCustomer($customer_id);
			return $list;
		}
		public function PaymentlinkedAgent($agent_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->PaymentlinkedAgent($agent_id);
			return $list;
		}
		public function GetInwardStockCasewise($godown_id, $magazine_id, $product_id, $case_contains) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetInwardStockCasewise($godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}
		public function GetOutwardStockCasewise($godown_id, $magazine_id, $product_id, $case_contains) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetOutwardStockCasewise($godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}
		public function getCurrentStockCasewise($godown_id, $magazine_id, $product_id, $case_contains) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getCurrentStockCasewise($godown_id, $magazine_id, $product_id, $case_contains);
			return $list;
		}
	}
?>