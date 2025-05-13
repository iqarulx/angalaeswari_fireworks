<?php
	/*require 'mailin_sms/sms_api.php';
	$GLOBALS['mailin_sms_api_key'] = "zaG0R7cJBhkUbf54";*/

	date_default_timezone_set('Asia/Calcutta');
	$GLOBALS['create_date_time_label'] = date('Y-m-d H:i:s');
	
	$GLOBALS['site_name_user_prefix'] = "af_".date("d-m-Y"); $GLOBALS['user_id'] = ""; $GLOBALS['creator'] = "";
	$GLOBALS['creator_details'] = ""; $GLOBALS['user_type'] = ""; $GLOBALS['user_name'] = ""; $GLOBALS['user_mobile_number'] = "";
	$GLOBALS['user_email'] = ""; $GLOBALS['login_id'] = ""; $GLOBALS['ip_address'] = ""; $GLOBALS['null_value'] = "NULL";
	$GLOBALS['bill_company_id'] = $GLOBALS['null_value'];
	
	// User Type
	$GLOBALS['admin_user_type'] = "Super Admin"; 
	$GLOBALS['staff_user_type'] = "Staff"; 
	$GLOBALS['factory_user_type'] = "Factory Incharge"; 
	$GLOBALS['godown_user_type'] = "Godown Incharge"; 
	$GLOBALS['magazine_user_type'] = "Magazine Incharge";

	// Folder name
	$GLOBALS['admin_folder_name'] = "angalaeswari_fireworks";
	$GLOBALS['backup_folder_name'] = 'backup'; 
	$GLOBALS['log_backup_folder_name'] = 'backup/logs'; 

	// Page limit
	$GLOBALS['page_number'] = 1; 
	$GLOBALS['page_limit'] = 10; 
	$GLOBALS['page_limit_list'] = array("10", "25", "50", "100", "500", "1000");

	// Max Count
	$GLOBALS['max_log_file_count'] = 5; 
	$GLOBALS['max_log_file_size_mb'] = 10; 
	$GLOBALS['expire_log_file_days'] = 90;
	$GLOBALS['max_user_count'] = 10; 
	$GLOBALS['max_role_count'] = 10; 
	$GLOBALS['max_company_count'] = 1;
	$GLOBALS['max_factory_count'] = 5;
	$GLOBALS['max_godown_count'] = 5;
	$GLOBALS['max_magazine_count'] = 5;
	$GLOBALS['max_group_count'] = 3;

	// Tables
	$GLOBALS['table_prefix'] = "af_";
	
	$GLOBALS['user_table'] = $GLOBALS['table_prefix'].'user';
	$GLOBALS['login_table'] = $GLOBALS['table_prefix'].'login'; 
	$GLOBALS['company_table'] = $GLOBALS['table_prefix'].'company';
	$GLOBALS['role_table'] = $GLOBALS['table_prefix'].'role';
	$GLOBALS['factory_table'] = $GLOBALS['table_prefix'].'factory';
	$GLOBALS['godown_table'] = $GLOBALS['table_prefix'].'godown';
	$GLOBALS['magazine_table'] = $GLOBALS['table_prefix'].'magazine'; 
	$GLOBALS['category_table'] = $GLOBALS['table_prefix'].'category'; 
	$GLOBALS['unit_table'] = $GLOBALS['table_prefix'].'unit'; 
	$GLOBALS['finished_group_table'] = $GLOBALS['table_prefix'].'finished_group'; 
	$GLOBALS['raw_material_group_table'] = $GLOBALS['table_prefix'].'raw_material_group'; 
	$GLOBALS['semi_finished_group_table'] = $GLOBALS['table_prefix'].'semi_finished_group'; 
	$GLOBALS['group_table'] = $GLOBALS['table_prefix'].'group';
	$GLOBALS['product_table'] = $GLOBALS['table_prefix'].'product';
	$GLOBALS['transport_table'] = $GLOBALS['table_prefix'].'transport';
	$GLOBALS['charges_table'] = $GLOBALS['table_prefix'].'charges';
	$GLOBALS['contractor_table'] = $GLOBALS['table_prefix'].'contractor';
	$GLOBALS['payment_table'] = $GLOBALS['table_prefix'].'payment';
	$GLOBALS['consumption_entry_table'] = $GLOBALS['table_prefix'].'consumption_entry';
	$GLOBALS['purchase_entry_table'] = $GLOBALS['table_prefix'].'purchase_entry';
	$GLOBALS['contractor_product_table'] = $GLOBALS['table_prefix'].'contractor_product';
	$GLOBALS['customer_table'] = $GLOBALS['table_prefix'].'customer'; 
	$GLOBALS['agent_table'] = $GLOBALS['table_prefix'].'agent';
	$GLOBALS['supplier_table'] = $GLOBALS['table_prefix'].'supplier'; 
	$GLOBALS['payment_mode_table'] = $GLOBALS['table_prefix'].'payment_mode'; 
	$GLOBALS['bank_table'] = $GLOBALS['table_prefix'].'bank'; 
	$GLOBALS['stock_table'] = $GLOBALS['table_prefix'].'stock';
	$GLOBALS['stock_by_godown_table'] = $GLOBALS['table_prefix'].'stock_by_godown';
	$GLOBALS['stock_by_magazine_table'] = $GLOBALS['table_prefix'].'stock_by_magazine';
	$GLOBALS['daily_production_table'] = $GLOBALS['table_prefix'].'daily_production';
	$GLOBALS['stock_adjustment_table'] = $GLOBALS['table_prefix'].'stock_adjustment';
	$GLOBALS['semifinished_inward_table'] = $GLOBALS['table_prefix'].'semifinished_inward';
	$GLOBALS['material_transfer_table'] = $GLOBALS['table_prefix'].'material_transfer';
	$GLOBALS['proforma_invoice_table'] = $GLOBALS['table_prefix'].'proforma_invoice';
	$GLOBALS['proforma_invoice_product'] = $GLOBALS['table_prefix'].'proforma_invoice_product';
	$GLOBALS['estimate_table'] = $GLOBALS['table_prefix'].'estimate';
	$GLOBALS['delivery_slip_table'] = $GLOBALS['table_prefix'].'delivery_slip';
	$GLOBALS['voucher_table'] = $GLOBALS['table_prefix'].'voucher'; 
	$GLOBALS['receipt_table'] = $GLOBALS['table_prefix'].'receipt'; 
	$GLOBALS['expense_category_table'] = $GLOBALS['table_prefix'].'expense_category'; 
	$GLOBALS['expense_table'] = $GLOBALS['table_prefix'].'expense'; 
	$GLOBALS['stock_conversion_table'] = $GLOBALS['table_prefix'].'stock_conversion'; 

	// Session variables
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		$GLOBALS['user_id'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
		$GLOBALS['creator'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
	}	
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name'])) {
		$GLOBALS['user_name'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name'];
	}
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number'])) {
		$GLOBALS['user_mobile_number'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number'];
	}
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name_mobile'])) {
		$GLOBALS['user_name_mobile'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name_mobile'];
	}		
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_login_record_id'])) {
		$GLOBALS['user_login_record_id'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_login_record_id'];
	}
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address'])) {
		$GLOBALS['ip_address'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address'];
	}
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name_mobile']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name_mobile'])) {
		$GLOBALS['creator_name'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name_mobile'];
	}
	if(isset($_SESSION['bill_company_id']) && !empty($_SESSION['bill_company_id'])) {
		$GLOBALS['bill_company_id'] = $_SESSION['bill_company_id'];
	}
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
		$GLOBALS['user_type'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'];
	}

	// Modules
	$GLOBALS['dashboard_module'] = "Dashboard";
	$GLOBALS['factory_module'] = "Factory";
	$GLOBALS['godown_module'] = "Godown";
	$GLOBALS['magazine_module'] = "Magazine";
	$GLOBALS['group_module'] = "Group";
	$GLOBALS['unit_module'] = "Unit";
	$GLOBALS['finished_group_module'] = "Finished Group";
	$GLOBALS['raw_material_group_module'] = "Raw Material Group";
	$GLOBALS['semi_finished_group_module'] = "Semi Finished Group";
	$GLOBALS['product_module'] = "Product";
	$GLOBALS['supplier_module'] = "Supplier";
	// $GLOBALS['contractor_module'] = "Contractor";
	$GLOBALS['agent_module'] = "Agent";
	$GLOBALS['customer_module'] = "Customer";
	$GLOBALS['payment_mode_module'] = "Payment Mode";
	$GLOBALS['bank_module'] = "Bank";
	$GLOBALS['charges_module'] = "Charges";
	$GLOBALS['transport_module'] = "Transport";
	$GLOBALS['purchase_entry_module'] = "Purchase Entry";
	$GLOBALS['consumption_entry_module'] = "Consumption Entry";
	$GLOBALS['stock_adjustment_module'] = "Stock Adjustment";
	$GLOBALS['daily_production_module'] = "Daily Production";
	$GLOBALS['semifinished_entry_module'] = "Semifinished Entry";
	$GLOBALS['material_transfer_module'] = "Material Transfer";
	$GLOBALS['proforma_invoice_module'] = "Proforma Invoice";
	$GLOBALS['delivery_slip_module'] = "Delivery Slip";
	$GLOBALS['estimate_module'] = "Estimate";
	$GLOBALS['expense_category_module'] = "Expense Category";
	$GLOBALS['expense_module'] = "Expense";
	$GLOBALS['voucher_module'] = "Voucher";
	$GLOBALS['receipt_module'] = "Receipt";
	$GLOBALS['reports_module'] = "Report";

	// Access Pages List
	$GLOBALS['access_pages_list'] = [$GLOBALS['dashboard_module'], $GLOBALS['factory_module'], $GLOBALS['godown_module'], $GLOBALS['magazine_module'], $GLOBALS['group_module'], $GLOBALS['unit_module'], $GLOBALS['finished_group_module'], $GLOBALS['raw_material_group_module'], $GLOBALS['semi_finished_group_module'],$GLOBALS['product_module'], $GLOBALS['supplier_module'], $GLOBALS['agent_module'], $GLOBALS['customer_module'], $GLOBALS['payment_mode_module'], $GLOBALS['bank_module'], $GLOBALS['charges_module'], $GLOBALS['transport_module'], $GLOBALS['purchase_entry_module'], $GLOBALS['consumption_entry_module'], $GLOBALS['stock_adjustment_module'], $GLOBALS['daily_production_module'], $GLOBALS['semifinished_entry_module'], $GLOBALS['material_transfer_module'], $GLOBALS['proforma_invoice_module'], $GLOBALS['delivery_slip_module'], $GLOBALS['estimate_module'], $GLOBALS['voucher_module'], $GLOBALS['receipt_module'], $GLOBALS['expense_category_module'], $GLOBALS['expense_module'], $GLOBALS['reports_module']];
	
	// Stock Actions
	$GLOBALS['stock_action_plus'] = "Plus"; $GLOBALS['stock_action_minus'] = "Minus";
	$GLOBALS['stock_action_list'] = array($GLOBALS['stock_action_plus'], $GLOBALS['stock_action_minus']); 

	$GLOBALS['raw_material_group_id'] = "4d5449774e4449774d6a55784d44557a4d444a664d444d3d";
	$GLOBALS['semi_finished_group_id'] = "4d5449774e4449774d6a55784d4455794e4464664d44493d";
	$GLOBALS['finished_group_id'] = "4d5449774e4449774d6a55784d4455794d7a4e664d44453d";
	?>