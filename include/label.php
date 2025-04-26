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
	$GLOBALS['group_table'] = $GLOBALS['table_prefix'].'group';
	$GLOBALS['product_table'] = $GLOBALS['table_prefix'].'product';
	$GLOBALS['transport_table'] = $GLOBALS['table_prefix'].'transport';
	$GLOBALS['charges_table'] = $GLOBALS['table_prefix'].'charges';
	$GLOBALS['contractor_table'] = $GLOBALS['table_prefix'].'contractor';
	$GLOBALS['payment_table'] = $GLOBALS['table_prefix'].'payment';
	$GLOBALS['consumption_entry_table'] = $GLOBALS['table_prefix'].'consumption_entry';
	$GLOBALS['purchase_entry_table'] = $GLOBALS['table_prefix'].'purchase_entry';
	$GLOBALS['contractor_product_table'] = $GLOBALS['table_prefix'].'contractor_product';
	// $GLOBALS['outsourceparty_table'] = $GLOBALS['table_prefix'].'outsourceparty'; 
	// $GLOBALS['party_cooly_table'] = $GLOBALS['table_prefix'].'party_cooly'; 
	$GLOBALS['customer_table'] = $GLOBALS['table_prefix'].'customer'; 
	$GLOBALS['agent_table'] = $GLOBALS['table_prefix'].'agent';
	$GLOBALS['supplier_table'] = $GLOBALS['table_prefix'].'supplier'; 
	$GLOBALS['payment_mode_table'] = $GLOBALS['table_prefix'].'payment_mode'; 
	$GLOBALS['bank_table'] = $GLOBALS['table_prefix'].'bank'; 
	$GLOBALS['stock_table'] = $GLOBALS['table_prefix'].'stock';
	$GLOBALS['stock_by_godown_table'] = $GLOBALS['table_prefix'].'stock_by_godown';
	$GLOBALS['stock_by_magazine_table'] = $GLOBALS['table_prefix'].'stock_by_magazine';
	// $GLOBALS['inward_entry_table'] = $GLOBALS['table_prefix'].'inward_entry';
	// $GLOBALS['consumption_entry_table'] = $GLOBALS['table_prefix'].'consumption_entry';
	$GLOBALS['daily_production_table'] = $GLOBALS['table_prefix'].'daily_production';
	// $GLOBALS['stock_adjustment_table'] = $GLOBALS['table_prefix'].'stock_adjustment';
	$GLOBALS['semifinished_inward_table'] = $GLOBALS['table_prefix'].'semifinished_inward';
	// $GLOBALS['material_transfer_table'] = $GLOBALS['table_prefix'].'material_transfer';
	$GLOBALS['proforma_invoice_table'] = $GLOBALS['table_prefix'].'proforma_invoice';
	$GLOBALS['proforma_invoice_product'] = $GLOBALS['table_prefix'].'proforma_invoice_product';
	// $GLOBALS['estimate_table'] = $GLOBALS['table_prefix'].'estimate';
	// $GLOBALS['sales_invoice_table'] = $GLOBALS['table_prefix'].'sales_invoice';
	// $GLOBALS['voucher_table'] = $GLOBALS['table_prefix'].'voucher'; 
	// $GLOBALS['receipt_table'] = $GLOBALS['table_prefix'].'receipt'; 
	// $GLOBALS['expense_category_table'] = $GLOBALS['table_prefix'].'expense_category'; 
	// $GLOBALS['expense_table'] = $GLOBALS['table_prefix'].'expense'; 

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
	$GLOBALS['factory_module'] = "Factory";
	$GLOBALS['godown_module'] = "Godown";
	$GLOBALS['magazine_module'] = "Magazine";
	$GLOBALS['category_module'] = "Category";
	$GLOBALS['unit_module'] = "Unit";
	$GLOBALS['group_module'] = "Group";
	$GLOBALS['product_module'] = "Product";
	$GLOBALS['charges_module'] = "Charges";
	$GLOBALS['transport_module'] = "Transport";
	$GLOBALS['agent_module'] = "Agent";
	$GLOBALS['customer_module'] = "Customer";
	$GLOBALS['supplier_module'] = "Supplier";
	$GLOBALS['contractor_module'] = "Contractor";
	$GLOBALS['purchase_entry_module'] = "Purchase Entry";
	// $GLOBALS['outsourceparty_module'] = "Out Source Party";
	$GLOBALS['payment_mode_module'] = "Payment Mode";
	$GLOBALS['bank_module'] = "Bank";
	// $GLOBALS['expense_category_module'] = "Expense Category";
	// $GLOBALS['expense_module'] = "Expense";
	// $GLOBALS['inward_entry_module'] = "Inward Entry";
	// $GLOBALS['consumption_entry_module'] = "Consumption Entry";
	// $GLOBALS['stock_adjustment_module'] = "Stock Adjustment";
	$GLOBALS['daily_production_module'] = "Daily Production";
	$GLOBALS['semifinished_entry_module'] = "Semifinished Entry";
	// $GLOBALS['material_transfer_module'] = "Material Transfer";
	$GLOBALS['proforma_invoice_module'] = "proforma Invoice";
	// $GLOBALS['estimate_module'] = "Estimate";
	// $GLOBALS['sales_invoice_module'] = "Sales Invoice";
	// $GLOBALS['voucher_module'] = "Voucher";
	// $GLOBALS['receipt_module'] = "Receipt";
	// $GLOBALS['report_module'] = "Report";

	// Access Pages List
	$access_pages_list = array();
	$access_pages_list[] = $GLOBALS['factory_module'];
	$access_pages_list[] = $GLOBALS['godown_module'];
	$access_pages_list[] = $GLOBALS['magazine_module'];
	$access_pages_list[] = $GLOBALS['category_module'];
	$access_pages_list[] = $GLOBALS['unit_module'];
	$access_pages_list[] = $GLOBALS['group_module'];
	$access_pages_list[] = $GLOBALS['product_module'];
	$access_pages_list[] = $GLOBALS['charges_module'];
	$access_pages_list[] = $GLOBALS['transport_module'];
	$access_pages_list[] = $GLOBALS['customer_module'];
	$access_pages_list[] = $GLOBALS['agent_module'];
	$access_pages_list[] = $GLOBALS['supplier_module'];
	$access_pages_list[] = $GLOBALS['contractor_module'];
	$access_pages_list[] = $GLOBALS['purchase_entry_module'];
	// $access_pages_list[] = $GLOBALS['outsourceparty_module'];
	$access_pages_list[] = $GLOBALS['payment_mode_module'];
	$access_pages_list[] = $GLOBALS['bank_module'];
	// $access_pages_list[] = $GLOBALS['expense_category_module'];
	// $access_pages_list[] = $GLOBALS['expense_module'];
	// $access_pages_list[] = $GLOBALS['inward_entry_module'];
	// $access_pages_list[] = $GLOBALS['consumption_entry_module'];
	// $access_pages_list[] = $GLOBALS['stock_adjustment_module'];
	$access_pages_list[] = $GLOBALS['daily_production_module'];
	$access_pages_list[] = $GLOBALS['semifinished_entry_module'];
	// $access_pages_list[] = $GLOBALS['material_transfer_module'];
	$access_pages_list[] = $GLOBALS['proforma_invoice_module'];
	// $access_pages_list[] = $GLOBALS['estimate_module'];
	// $access_pages_list[] = $GLOBALS['sales_invoice_module'];
	// $access_pages_list[] = $GLOBALS['voucher_module'];
	// $access_pages_list[] = $GLOBALS['receipt_module'];
	// $access_pages_list[] = $GLOBALS['report_module'];
	
	$GLOBALS['access_pages_list'] = $access_pages_list;

	$godown_access_pages_list = array();
	$godown_access_pages_list[] = $GLOBALS['godown_module'];
	$godown_access_pages_list[] = $GLOBALS['category_module'];
	$godown_access_pages_list[] = $GLOBALS['unit_module'];
	$godown_access_pages_list[] = $GLOBALS['group_module'];
	$godown_access_pages_list[] = $GLOBALS['product_module'];
	$godown_access_pages_list[] = $GLOBALS['charges_module'];
	$godown_access_pages_list[] = $GLOBALS['transport_module'];
	$godown_access_pages_list[] = $GLOBALS['customer_module'];
	$godown_access_pages_list[] = $GLOBALS['agent_module'];
	$godown_access_pages_list[] = $GLOBALS['supplier_module'];
	$godown_access_pages_list[] = $GLOBALS['contractor_module'];
	$godown_access_pages_list[] = $GLOBALS['payment_mode_module'];
	$godown_access_pages_list[] = $GLOBALS['bank_module'];
	// $godown_access_pages_list[] = $GLOBALS['expense_category_module'];
	// $godown_access_pages_list[] = $GLOBALS['expense_module'];
	// $godown_access_pages_list[] = $GLOBALS['inward_entry_module'];
	// $godown_access_pages_list[] = $GLOBALS['consumption_entry_module'];
	// $godown_access_pages_list[] = $GLOBALS['stock_adjustment_module'];
	$godown_access_pages_list[] = $GLOBALS['semifinished_entry_module'];
	// $godown_access_pages_list[] = $GLOBALS['material_transfer_module'];
	// $godown_access_pages_list[] = $GLOBALS['voucher_module'];
	// $godown_access_pages_list[] = $GLOBALS['receipt_module'];
	// $godown_access_pages_list[] = $GLOBALS['report_module'];
	
	$GLOBALS['godown_access_pages_list'] = $godown_access_pages_list;

	$magazine_access_pages_list = array();
	$magazine_access_pages_list[] = $GLOBALS['magazine_module'];
	$magazine_access_pages_list[] = $GLOBALS['category_module'];
	$magazine_access_pages_list[] = $GLOBALS['unit_module'];
	$magazine_access_pages_list[] = $GLOBALS['transport_module'];
	$magazine_access_pages_list[] = $GLOBALS['customer_module'];
	$magazine_access_pages_list[] = $GLOBALS['group_module'];
	$magazine_access_pages_list[] = $GLOBALS['product_module'];
	$magazine_access_pages_list[] = $GLOBALS['customer_module'];
	$magazine_access_pages_list[] = $GLOBALS['agent_module'];
	$magazine_access_pages_list[] = $GLOBALS['supplier_module'];
	$magazine_access_pages_list[] = $GLOBALS['contractor_module'];
	// $magazine_access_pages_list[] = $GLOBALS['outsourceparty_module'];
	$magazine_access_pages_list[] = $GLOBALS['payment_mode_module'];
	$magazine_access_pages_list[] = $GLOBALS['bank_module'];
	// $magazine_access_pages_list[] = $GLOBALS['expense_category_module'];
	// $magazine_access_pages_list[] = $GLOBALS['expense_module'];
	// $magazine_access_pages_list[] = $GLOBALS['stock_adjustment_module'];
	// $magazine_access_pages_list[] = $GLOBALS['daily_production_module'];
	// $magazine_access_pages_list[] = $GLOBALS['material_transfer_module'];
	$magazine_access_pages_list[] = $GLOBALS['proforma_invoice_module'];
	// $magazine_access_pages_list[] = $GLOBALS['estimate_module'];
	// $magazine_access_pages_list[] = $GLOBALS['sales_invoice_module'];
	// $magazine_access_pages_list[] = $GLOBALS['voucher_module'];
	// $magazine_access_pages_list[] = $GLOBALS['receipt_module'];
	// $magazine_access_pages_list[] = $GLOBALS['report_module'];
	
	$GLOBALS['magazine_access_pages_list'] = $magazine_access_pages_list;
	
	// Stock Actions
	$GLOBALS['stock_action_plus'] = "Plus"; $GLOBALS['stock_action_minus'] = "Minus";
	$GLOBALS['stock_action_list'] = array($GLOBALS['stock_action_plus'], $GLOBALS['stock_action_minus']); 

	?>