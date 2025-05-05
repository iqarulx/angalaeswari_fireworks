<?php
    class Report_functions extends Basic_Functions{
        
		public function getPaymentPartyList($party_type,$bill_type) {
			$list = array(); $select_query = ""; $where = ""; 
		
			if($bill_type == 1) {
				$bill_type = "Voucher";
			}
			if($bill_type == 2) {
				$bill_type = "Receipt";
			}
			if($bill_type == 3) {
				$bill_type = "Expense";
			}
			if($party_type == 1) {
				$party_type = "Supplier";
			}
			if($party_type == 2) {
				$party_type = "Agent";
			}
			if($party_type == 3) {
				$party_type = "Contractor";
			}
			if($party_type == 4) {
				$party_type = "Customer";
			}
			if(!empty($bill_type)){
				if(!empty($where)) {
					$where .= " bill_type = '".$bill_type."' AND";
				} else {
					$where = " bill_type = '".$bill_type."' AND";
				}
			}
			if(!empty($party_type)){
				if(!empty($where)) {
					$where .= " party_type = '".$party_type."' AND";
				} else {
					$where = " party_type = '".$party_type."' AND";
				}
			}
	
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']."  WHERE ".$where." deleted = '0' GROUP BY party_id ORDER BY created_date_time ASC ";
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']."  WHERE deleted = '0' GROUP BY party_id ORDER BY created_date_time ASC";
			}

			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		
		public function getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_type,$filter_party_id,$payment_mode_id,$bank_id,$filter_category_id){
			$reports = array();
			$where ="";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND bill_date >= '".$from_date."'";
				} else {
					$where = "bill_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND bill_date <= '".$to_date."'";
				} else {
					$where = "bill_date <= '".$to_date."' AND";
				}
			}
			if(!empty($filter_party_type)){ 
				if($filter_party_type == 1) {
					$filter_party_type = "Supplier";
				}
				if($filter_party_type == 2) {
					$filter_party_type = "Agent";
				}
				if($filter_party_type == 3) {
					$filter_party_type = "Contractor";
				}
				if($filter_party_type == 4) {
					$filter_party_type = "Customer";
				}
				if(!empty($where)) {
					$where = $where." AND party_type = '".$filter_party_type."' ";
				} else {
					$where = "party_type = '".$filter_party_type."'";
				}
			}
			if(!empty($filter_party_id)){ 
				if(!empty($where)) {
					$where = $where." AND party_id = '".$filter_party_id."' ";
				} else {
					$where = "party_id = '".$filter_party_id."'";
				}
			}

			if(!empty($filter_category_id)){ 
				if(!empty($where)) {
					$where = $where." AND party_id = '".$filter_category_id."' ";
				} else {
					$where = "party_id = '".$filter_category_id."'";
				}
			}

			if(!empty($bank_id)){ 
				if(!empty($where)) {
					$where = $where." AND bank_id = '".$bank_id."' ";
				} else {
					$where = "bank_id = '".$bank_id."'";
				}
			}

			if(!empty($payment_mode_id)){ 
				if(!empty($where)) {
					$where = $where." AND payment_mode_id = '".$payment_mode_id."' ";
				} else {
					$where = "payment_mode_id = '".$payment_mode_id."'";
				}
			}

			if($filter_bill_type == 1){
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." AND bill_type = 'Voucher' AND deleted = '0' ORDER BY bill_date ASC"; 	
			} else if($filter_bill_type == 2){
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." AND bill_type = 'Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
			} else if($filter_bill_type == 3){
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." AND bill_type = 'Expense' AND deleted = '0' ORDER BY bill_date ASC"; 	
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." AND bill_number != '".$GLOBALS['null_value']."' AND bill_type IN ('voucher', 'expense', 'receipt')  AND deleted = '0' ORDER BY bill_date ASC";
			}

			$reports = $this->getQueryRecords('', $select_query);

			return $reports;
		}

		public function getGroupList($group_type) {
			$finish_product_type = "finished"; $select_query = ""; $list = array();
			$encrypted_product_type = $this->encode_decode('encrypt',$finish_product_type);
	
			if($group_type == '1') {
				$select_query = "SELECT * FROM ".$GLOBALS['group_table']." WHERE lower_case_name != '".$encrypted_product_type."' AND deleted = '0'";
			} else if($group_type == '2') {
				$select_query = "SELECT * FROM ".$GLOBALS['group_table']." WHERE lower_case_name = '".$encrypted_product_type."' AND deleted = '0'";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}

		public function getStockReportList($group_id, $godown_id, $magazine_id, $product_id, $stock_type, $case_contains, $contractor_id) {
			$select_query = ""; $list = array(); $where = "";
			if(!empty($group_id)) {
				if(!empty($where)) {
					$where = $where." AND group_id = '".$group_id."'";
				} else {
					$where = "group_id = '".$group_id."'";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				} else {
					$where = "godown_id = '".$godown_id."'";
				}
			}
			if(!empty($magazine_id)) {
				if(!empty($where)) {
					$where = $where." AND magazine_id = '".$magazine_id."'";
				} else {
					$where = "magazine_id = '".$magazine_id."'";
				}
			}
			if(!empty($product_id)) {
				if(!empty($where)) {
					$where = $where." AND product_id = '".$product_id."'";
				} else {
					$where = "product_id = '".$product_id."'";
				}
			}
			if(!empty($stock_type)) {
				if(!empty($where)) {
					$where = $where." AND stock_type = '".$stock_type."'";
				} else {
					$where = "stock_type = '".$stock_type."'";
				}
			}
			if(!empty($case_contains)) {
				if(!empty($where)) {
					$where = $where." AND case_contains = '".$case_contains."'";
				} else {
					$where = "case_contains = '".$case_contains."'";
				}
			}
			if(!empty($contractor_id)) {
				if(!empty($where)) {
					$where = $where." AND party_id = '".$contractor_id."'";
				} else {
					$where = "party_id = '".$contractor_id."'";
				}
			}
			if(!empty($where)) {
				 $select_query = "SELECT * FROM ".$GLOBALS['stock_table']." WHERE ".$where." AND deleted = '0' ORDER BY id ASC";	
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_table']." WHERE deleted = '0' ORDER BY id ASC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['stock_table'], $select_query);
			}
			return $list;
		}

		public function getProductStockTransactionExist($product_id) {
			$select_query = "";
			$select_query = "SELECT COUNT(*) as count FROM ".$GLOBALS['stock_table']." WHERE product_id = '" . $product_id . "' AND deleted = '0'";
			
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['stock_table'], $select_query);
			}

			if(!empty($list)) {
				return $list[0]['count'];
			}
			return 0;
		}

		public function getStockContainsList($product_id) {
			$select_query = ""; $list = array();
			if(!empty($product_id)) {
				$select_query = "SELECT DISTINCT(case_contains) as case_contains FROM ".$GLOBALS['stock_table']." WHERE product_id = '".$product_id."' AND deleted = '0'";
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}

		public function getConsumptionQtyList($contractor_id) {
			$select_query = ""; $list = array(); $where = "";

			if(!empty($contractor_id)) {
				if(!empty($where)) {
					$where = $where." party_id = '".$contractor_id."' AND ";
				} else {
					$where = "party_id = '".$contractor_id."' AND ";
				}
			}
			 $select_query = "SELECT DISTINCT(product_id) as product_id,party_id FROM ".$GLOBALS['stock_table']." WHERE ".$where."  stock_type = 'Consumption Entry' AND deleted = '0'";
			$list = $this->getQueryRecords('', $select_query);
			return $list;
		}
		public function getConsumptionQtyByProduct($product_id, $unit_type) {
			$select_query = ""; $list = array(); $quantity = 0;
			if(!empty($product_id)) {
				if($unit_type == "Unit") {
					$select_query = "SELECT SUM(outward_unit) as quantity FROM ".$GLOBALS['stock_table']." WHERE product_id = '".$product_id."' AND stock_type = 'Consumption Entry' AND deleted = '0'";
				} else if($unit_type == "Subunit") {
					$select_query = "SELECT SUM(outward_subunit) as quantity FROM ".$GLOBALS['stock_table']." WHERE product_id = '".$product_id."' AND stock_type = 'Consumption Entry' AND deleted = '0'";
				}
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
						$quantity = $data['quantity'];
					}
				}
			}
			return $quantity;
		}

		public function getPurchaseTaxReport($filter_supplier_id,$from_date, $to_date) {
			$list = array(); $select_query = ""; $where = "";
			if(!empty($filter_supplier_id)) {
				if(!empty($where)) {
					$where = $where." supplier_id = '".$filter_supplier_id."' AND ";
				} else {
					$where = "supplier_id = '".$filter_supplier_id."' AND ";
				}
			}

			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." purchase_entry_date >= '".$from_date."' AND"; 
				} else {
					$where = "purchase_entry_date >= '".$from_date."' AND ";
				}
			}

			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." purchase_entry_date <= '".$to_date."' AND "; 	
				} else {
					$where = "purchase_entry_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where."  deleted = '0'  AND gst_option = '1' ORDER BY id DESC";	
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE deleted = '0' AND gst_option ='1' ORDER BY id DESC";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
			}
			return $list;
		}

		//dhivya
		public function getDayBookReportList($from_date,$to_date,$party_id,$payment_mode_id) {
			$con = $this->connect();
			
			$stock_report_list = array(); $where = "";
		
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND bill_date >= '".$from_date."'";
				} else {
					$where = "bill_date >= '".$from_date."'";
				}
			}
		
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND bill_date <= '".$to_date."'";
				} else {
					$where = "bill_date <= '".$to_date."'";
				}
			}
		
			if(!empty($party_id)) {
				if(!empty($where)) {
					$where = $where." AND party_id = '".$party_id."'";
				} else {
					$where = "party_id = '".$party_id."'";
				}
			}
		
			if(!empty($payment_mode_id)){
				if(!empty($where)){
					$where .= "AND FIND_IN_SET('".$payment_mode_id."' ,payment_mode_id) ";
				} else{
					$where = "FIND_IN_SET('".$payment_mode_id."' ,payment_mode_id) ";
				}
			}
			
			$select_query = "";
				$select_query = "SELECT bill_id,bill_number, bill_date,agent_id, party_id, party_name, amount, payment_type, type,payment_mode_id,bank_id FROM ( 
			
				(SELECT vo.voucher_id as bill_id,vo.voucher_number as bill_number, vo.voucher_date as bill_date, '' as agent_id,vo.party_id as party_id, party_name as party_name, vo.total_amount as amount, payment_mode_name as payment_type, 'voucher' as type,vo.payment_mode_id as payment_mode_id,vo.bank_id as bank_id FROM ".$GLOBALS['voucher_table']." as vo WHERE vo.deleted = '0' ORDER BY vo.created_date_time ASC) 
				UNION ALL
				(SELECT re.receipt_id as bill_id,re.receipt_number as bill_number, re.receipt_date as bill_date,'' as agent_id, re.party_id as party_id, party_name as party_name, re.total_amount as amount, payment_mode_name as payment_type,  'receipt' as type,re.payment_mode_id as payment_mode_id,re.bank_id as bank_id FROM ".$GLOBALS['receipt_table']." as re WHERE re.deleted = '0' ORDER BY re.created_date_time ASC) 
				UNION ALL 
				(SELECT py.expense_id as bill_id,py.expense_number as bill_number, (py.expense_date) as bill_date,'' as agent_id,py.narration as party_id, narration as party_name, py.total_amount as amount,payment_mode_name as payment_type,  'expense' as type,py.payment_mode_id as payment_mode_id,'' as bank_id FROM ".$GLOBALS['expense_table']." as py WHERE py.deleted = '0'  ORDER BY py.id ASC)
				   UNION ALL 
				(SELECT e.estimate_id as bill_id,e.estimate_number as bill_number, (e.estimate_date) as bill_date,e.agent_id as agent_id,e.customer_id as party_id, e.customer_name_mobile_city as party_name, e.bill_total as amount,'' as payment_type,  'Estimate' as type,'' as payment_mode_id,'' as bank_id FROM ".$GLOBALS['estimate_table']." as e WHERE e.deleted = '0'  ORDER BY e.id ASC)
				UNION ALL 
				(SELECT pb.purchase_entry_id as bill_id,pb.purchase_entry_number as bill_number, (pb.purchase_entry_date) as bill_date,'' as agent_id,pb.supplier_id as party_id, pb.supplier_name_mobile_city as party_name, pb.total_amount as amount,'' as payment_type,  'Purchase Entry' as type,'' as payment_mode_id,'' as bank_id FROM ".$GLOBALS['purchase_entry_table']." as pb WHERE pb.deleted = '0'  ORDER BY pb.id ASC)
				) as g where ".$where." ORDER BY bill_date DESC";
			   
				// UNION ALL
				// (SELECT pb.purchase_bill_id as bill_id,pb.purchase_bill_number as bill_number, (pb.purchase_bill_date) as bill_date, pb.party_id as party_id, pb.total_amount as amount, '' as payment_type, 'purchase' as type,'' as payment_mode_id,'' as bank_id FROM ".$GLOBALS['purchase_bill_table']." as pb WHERE pb.deleted = '0' AND pb.cancelled='0' AND pb.bill_company_id = '".$GLOBALS['bill_company_id']."' ORDER BY pb.id ASC)
				// UNION ALL 
				// (SELECT est.estimate_id as bill_id,est.estimate_number as bill_number, (est.estimate_date) as bill_date, est.party_id as party_id, est.total_amount as amount,'' as payment_type, 'estimate' as type,'' as payment_mode_id,'' as bank_id FROM ".$GLOBALS['estimate_table']." as est WHERE est.deleted = '0' AND est.cancelled='0' AND est.bill_company_id = '".$GLOBALS['bill_company_id']."' ORDER BY est.id ASC)  
		
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		
		public function getPartyList($type)
		{
			$total_records_list =array();
			$select_query ="";
			if($type == '1') {
				$select_query ="SELECT agent_id as party_id,agent_name as party_name,city FROM ".$GLOBALS['agent_table']." WHERE deleted ='0'";
			} else if($type == '2') {
				$select_query ="SELECT supplier_id as party_id,supplier_name as party_name,city FROM ".$GLOBALS['supplier_table']." WHERE deleted ='0'";
			} else if($type == '3') {
				$select_query ="SELECT contractor_id as party_id,contractor_name as party_name,name_mobile_city as city FROM ".$GLOBALS['contractor_table']." WHERE deleted ='0'";
			}
			else if($type == '4') {
				$select_query ="SELECT customer_id as party_id,customer_name as party_name,city FROM ".$GLOBALS['customer_table']." WHERE deleted ='0'";
			}
			// echo $select_query;
			$total_records_list = $this->getQueryRecords('',$select_query);
			return $total_records_list;
		}

		public function balance_report($type, $party_id,$bill_company_id,$filter_agent_party,$from_date,$to_date) {
			$con = $this->connect();
			$select_query = ""; $list = array(); $reports = array(); $payment_query = "";
			$bill_where = ""; 
			// echo $type."hello".$party_id;
			if(!empty($type) && !empty($party_id)) {
				if(!empty($from_date)) {
					$from_date = date("Y-m-d",strtotime($from_date));
					$bill_where = "bill_date >='".$from_date."' AND ";

				}
				if(!empty($to_date)) {
					$to_date = date("Y-m-d",strtotime($to_date));
					if(empty($bill_where)) {
						$bill_where = "bill_date <='".$to_date."' AND ";
					} else {
						$bill_where = $bill_where."bill_date <='".$to_date."' AND ";
					}
				}
				if($type == "Agent") {
					$select_query = "SELECT agent_id,agent_name, mobile_number FROM ".$GLOBALS['agent_table']." WHERE agent_id = '".$party_id."' AND deleted = '0' ";
					$list = $this->getQueryRecords($GLOBALS['agent_table'], $select_query);
					// print_r($list);
					if(!empty($filter_agent_party)){
						if(!empty($list)) {
							foreach($list as $data) {
								if(!empty($data['agent_id'])) {
									$bill_list = array();
									 $payment_query = "SELECT bill_date, bill_number,bill_type, 
									SUM(credit) as credit,SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$bill_where."  party_id = '".$filter_agent_party."' AND  deleted = '0'  AND  bill_date >= '".$from_date."' AND bill_date <= '".$to_date."' AND bill_type !='Customer Opening Balance' GROUP BY bill_number";

									$bill_list = $this->getQueryRecords($GLOBALS['agent_table'], $payment_query);

									$reports[] = array('party_id' => $data['agent_id'], 'party_name' => $data['agent_name'], 'party_mobile_number' => $data['mobile_number'],'bill_list' => $bill_list);
								}
							}
						}
					} else {
						if(!empty($list)) {
							foreach($list as $data) {
								if(!empty($data['agent_id'])) {
									$bill_list = array();

									$payment_query = "SELECT bill_date, bill_number, bill_type, 
									SUM(credit) as credit,SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$bill_where." agent_id = '".$data['agent_id']."' AND party_id ='NULL' AND  bill_type !='Customer Opening Balance' AND bill_type !='Agent Opening Balance' AND deleted = '0'  AND bill_type !='Agent Opening Balance' GROUP BY bill_number";

									$bill_list = $this->getQueryRecords($GLOBALS['agent_table'], $payment_query);

									$reports[] = array('party_id' => $data['agent_id'], 'party_name' => $data['agent_name'], 'party_mobile_number' => $data['mobile_number'], 'bill_list' => $bill_list);
								}
							}
						}
					}
				} else if($type == "Supplier") {
					$select_query = "SELECT supplier_id,supplier_name, mobile_number FROM ".$GLOBALS['supplier_table']." WHERE supplier_id = '".$party_id."' AND deleted = '0'  ";
					$list = $this->getQueryRecords($GLOBALS['supplier_table'], $select_query);
					
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['supplier_id'])) {
								$bill_list = array();

								$payment_query = "SELECT bill_date, bill_number, bill_type, 
								SUM(credit) as credit,SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$bill_where." party_id = '".$data['supplier_id']."'  AND bill_type !='Supplier Opening Balance' AND deleted = '0'  AND bill_type !='Agent Opening Balance' GROUP BY bill_number";

								$bill_list = $this->getQueryRecords($GLOBALS['agent_table'], $payment_query);

								$reports[] = array('party_id' => $data['supplier_id'], 'party_name' => $data['supplier_name'], 'party_mobile_number' => $data['mobile_number'], 'bill_list' => $bill_list);
							}
						}
					}
				} else if($type == "Contractor") {
					$select_query = "SELECT contractor_id,contractor_name, mobile as mobile_number FROM ".$GLOBALS['contractor_table']." WHERE contractor_id = '".$party_id."' AND deleted = '0'  ";
					$list = $this->getQueryRecords($GLOBALS['contractor_table'], $select_query);
					
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['contractor_id'])) {
								$bill_list = array();

								$payment_query = "SELECT bill_date, bill_number, bill_type, 
								SUM(credit) as credit,SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$bill_where." party_id = '".$data['contractor_id']."' AND  bill_type !='Contractor Opening Balance' AND deleted = '0'  AND bill_type !='Agent Opening Balance' GROUP BY bill_number";

								$bill_list = $this->getQueryRecords($GLOBALS['agent_table'], $payment_query);

								$reports[] = array('party_id' => $data['contractor_id'], 'party_name' => $data['contractor_name'], 'party_mobile_number' => $data['mobile_number'], 'bill_list' => $bill_list);
							}
						}
					}
				} else if($type == "Customer") {
					$select_query = "SELECT customer_id,customer_name, mobile_number FROM ".$GLOBALS['customer_table']." WHERE customer_id = '".$party_id."' AND deleted = '0'  ";
					$list = $this->getQueryRecords($GLOBALS['customer_table'], $select_query);
					
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['customer_id'])) {
								$bill_list = array();

								$payment_query = "SELECT bill_date, bill_number, bill_type, 
								SUM(credit) as credit,SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$bill_where." party_id = '".$data['customer_id']."' AND  bill_type !='Customer Opening Balance' AND deleted = '0' GROUP BY bill_number";

								$bill_list = $this->getQueryRecords($GLOBALS['agent_table'], $payment_query);

								$reports[] = array('party_id' => $data['customer_id'], 'party_name' => $data['customer_name'], 'party_mobile_number' => $data['mobile_number'], 'bill_list' => $bill_list);
							}
						}
					}
				}
				// else
				// {
				// 	$select_query = "SELECT party_id,party_name, mobile_number FROM ".$GLOBALS['party_table']." WHERE party_id = '".$party_id."' AND deleted = '0' AND bill_company_id = '".$bill_company_id."' ";
				// 	$list = $this->getQueryRecords($GLOBALS['party_table'], $select_query);
				// 	if(!empty($list)) {
				// 		foreach($list as $data) {
				// 			if(!empty($data['party_id'])) {
				// 				$bill_list = array();

				// 				$payment_query = "SELECT bill_date, bill_number,bill_type, 
				// 				SUM(credit) as credit,SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$bill_where." (agent_id='' OR agent_id='NULL') AND  bill_type !='Party Opening Balance' AND party_id = '".$data['party_id']."' AND deleted = '0' AND bill_company_id = '".$bill_company_id."' GROUP BY bill_number";

				// 				$bill_list = $this->getQueryRecords($GLOBALS['party_table'], $payment_query);

				// 				$reports[] = array('party_id' => $data['party_id'], 'party_name' => $data['party_name'], 'party_mobile_number' => $data['mobile_number'], 'bill_list' => $bill_list);
				// 			}
				// 		}
				// 	}
				// }
			} else if(!empty($type) && empty($party_id)) {
				if(!empty($from_date)) {
					$from_date = date("Y-m-d",strtotime($from_date));
					$bill_where = "bill_date >='".$from_date."' AND ";
				}
				if(!empty($to_date)) {
					$to_date = date("Y-m-d",strtotime($to_date));
					if(empty($bill_where)) {
						$bill_where = "bill_date <='".$to_date."' AND ";
					} else {
						$bill_where = $bill_where."bill_date <='".$to_date."' AND ";
					}
				}
				if($type == "Agent") {
					$payment_query = "SELECT 'agent' as party_type, sp.agent_id as party_id, sp.agent_name as party_name, 
					sp.mobile_number as party_mobile_number,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.agent_id = sp.agent_id AND e.party_id ='NULL' AND e.deleted = '0'  GROUP BY e.agent_id) as debit,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.agent_id = sp.agent_id AND e.party_id ='NULL' AND e.deleted = '0' GROUP BY e.agent_id) as credit 
					FROM ".$GLOBALS['agent_table']." as sp WHERE sp.deleted = '0'  ";
				} else if($type == "Supplier") {
					$payment_query = "SELECT 'supplier' as party_type, sp.supplier_id as party_id, sp.supplier_name as party_name, sp.mobile_number as party_mobile_number,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.party_id = sp.supplier_id AND e.deleted = '0'  GROUP BY e.party_id) as debit,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.party_id = sp.supplier_id AND e.deleted = '0' GROUP BY e.party_id) as credit 
					FROM ".$GLOBALS['supplier_table']." as sp WHERE sp.deleted = '0'  ";
				} else if($type == "Contractor") {
					$payment_query = "SELECT 'contractor' as party_type, sp.contractor_id as party_id, sp.contractor_name as party_name, sp.mobile as party_mobile_number,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.party_id = sp.contractor_id AND e.deleted = '0'  GROUP BY e.party_id) as debit,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.party_id = sp.contractor_id AND e.deleted = '0' GROUP BY e.party_id) as credit 
					FROM ".$GLOBALS['contractor_table']." as sp WHERE sp.deleted = '0'   ";
				} else if($type == "Customer") {
					$payment_query = "SELECT 'customer' as party_type, sp.customer_id as party_id, sp.customer_name as party_name, sp.mobile_number as party_mobile_number,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.party_id = sp.customer_id AND e.deleted = '0'  GROUP BY e.party_id) as debit,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.party_id = sp.customer_id AND e.deleted = '0' GROUP BY e.party_id) as credit 
					FROM ".$GLOBALS['customer_table']." as sp WHERE sp.deleted = '0'   ";
				}
				$select_query = "SELECT party_type, party_id, party_name, party_mobile_number,debit,credit FROM ((".$payment_query.") ) as g";
				if(!empty($select_query)) {
					$list = $this->getQueryRecords('',$select_query);
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['party_type']) && !empty($data['party_id'])) {
								$total_credit = 0; $total_debit = 0; $balance = 0;
								if(!empty($data['credit'])) {
									$total_credit = $total_credit + $data['credit'];
								}
								if(!empty($data['debit'])) {
									$total_debit = $total_debit + $data['debit'];
								}
								if(!empty($total_credit)) {
									$balance = $balance + $total_credit;
								}
								if(!empty($total_debit)) {
									$balance = $balance - $total_debit;
								}
								if(!empty($balance)) {
									$reports[] = array('party_type' => $data['party_type'], 'party_id' => $data['party_id'], 'party_name' => $data['party_name'], 'party_mobile_number' => $data['party_mobile_number'], "balance" => $balance,"credit"=>$data['credit'], "debit"=>$data['debit']);
								}
							}
						}
					}
				}
			} else {
				if(!empty($from_date)) {
					$from_date = date("Y-m-d",strtotime($from_date));
					$bill_where = "e.bill_date >='".$from_date."' AND ";
				}
				if(!empty($to_date)) {
					$to_date = date("Y-m-d",strtotime($to_date));
				
					if(empty($bill_where)) {
						$bill_where = "e.bill_date <='".$to_date."' AND ";
					} else {
						$bill_where = $bill_where."e.bill_date <='".$to_date."' AND ";
					}
				}

				$agent_query = "SELECT 'agent' as party_type, sp.agent_id as party_id, sp.agent_name as party_name,sp.mobile_number as party_mobile_number,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.agent_id = sp.agent_id AND e.party_id ='NULL' AND  e.deleted = '0'  GROUP BY e.agent_id) as credit,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.agent_id = sp.agent_id AND e.party_id ='NULL'  AND e.deleted = '0'  GROUP BY e.agent_id) as debit FROM ".$GLOBALS['agent_table']." as sp WHERE sp.deleted = '0'  ";
				$contractor_query = "SELECT 'contractor' as party_type, c.contractor_id as party_id, c.contractor_name as party_name,c.mobile as party_mobile_number,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.party_id = c.contractor_id  AND e.deleted = '0'  GROUP BY e.party_id) as credit,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.party_id = c.contractor_id  AND e.deleted = '0'  GROUP BY e.party_id) as debit FROM ".$GLOBALS['contractor_table']." as c WHERE c.deleted = '0'  ";
				$supplier_query = "SELECT 'supplier' as party_type, s.supplier_id as party_id, s.supplier_name as party_name,s.mobile_number as party_mobile_number,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.party_id = s.supplier_id  AND e.deleted = '0'  GROUP BY e.party_id) as credit,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.party_id = s.supplier_id  AND e.deleted = '0'  GROUP BY e.party_id) as debit FROM ".$GLOBALS['supplier_table']." as s WHERE s.deleted = '0'  ";
				$customer_query = "SELECT 'customer' as party_type, cu.customer_id as party_id, cu.customer_name as party_name,cu.mobile_number as party_mobile_number,
					(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
					WHERE ".$bill_where." e.party_id = cu.customer_id  AND e.deleted = '0'  GROUP BY e.party_id) as credit,
					(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
					WHERE ".$bill_where." e.party_id = cu.customer_id  AND e.deleted = '0'  GROUP BY e.party_id) as debit FROM ".$GLOBALS['customer_table']." as cu WHERE cu.deleted = '0'  ";

				$select_query = "SELECT party_type, party_id, party_name, party_mobile_number,credit,debit FROM ( (".$agent_query.") UNION ALL (".$contractor_query.") UNION ALL (".$supplier_query.") UNION ALL (".$customer_query.") ) as g";

				if(!empty($select_query)) {
					$list = $this->getQueryRecords('',$select_query);
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['party_type']) && !empty($data['party_id'])) {
								$total_credit = 0; $total_debit = 0; $balance = 0;
								if(!empty($data['credit'])) {
									$total_credit = $total_credit + $data['credit'];
								}
								if(!empty($data['debit'])) {
									$total_debit = $total_debit + $data['debit'];
								}

								if(!empty($total_credit)) {
									$balance = $balance + $total_credit;
								}
								if(!empty($total_debit)) {
									$balance = $balance - $total_debit;
								}
								if(!empty($balance)) {
									$reports[] = array('party_type' => $data['party_type'], 'party_id' => $data['party_id'], 'party_name' => $data['party_name'], 'party_mobile_number' => $data['party_mobile_number'], "balance" => $balance,"credit"=>$data['credit'],"debit"=>$data['debit']);
								}
							}
						}
					}
				}
			}
			return $reports;
		}
		
		public function getSelectedAgentCustomerList($filter_party_id)
		{
			$select_query ="";
			$select_query ="SELECT customer_id as party_id,customer_name as party_name,city FROM ".$GLOBALS['customer_table']." WHERE agent_id='".$filter_party_id."' AND deleted ='0' ";
			$agent_customer_list = $this->getQueryRecords($GLOBALS['customer_table'],$select_query);
			return $agent_customer_list;
		}
		
		public function getOpeningBalance($party_id,$from_date,$to_date,$bill_company_id,$filter_agent_party,$view_type)
		{
			$bill_where = ""; $agent_where = ""; $supplier_where =""; $contractor_where =""; $customer_where ="";$select_bill_query ="";
			if(!empty($to_date)) {
				$bill_where = "bill_date < '".date("Y-m-d",strtotime($from_date))."' AND";	
			}
			if($view_type == '1') {
				$agent_where = "sp.agent_id = '".$party_id."' AND";
			}
			if($view_type == '2')  {
				$supplier_where = "sp.supplier_id = '".$party_id."' AND";
			}
			if($view_type == '3') {
				$contractor_where = "sp.contractor_id = '".$party_id."' AND";
			}
			if($view_type == '4') {
				$customer_where = "sp.customer_id = '".$party_id."' AND";
			}

			if($view_type == '1') {
				$select_bill_query = "SELECT 'agent' as party_type, sp.agent_id as party_id, sp.agent_name as party_name,sp.mobile_number as party_mobile_number, sp.opening_balance, sp.opening_balance_type,
				(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
				WHERE ".$bill_where." e.agent_id = sp.agent_id AND e.deleted = '0'  GROUP BY e.agent_id) as credit,
				(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
				WHERE ".$bill_where." e.agent_id = sp.agent_id AND e.deleted = '0'   GROUP BY e.agent_id) as debit FROM ".$GLOBALS['agent_table']." as sp WHERE ".$agent_where." sp.deleted = '0' ";
				
			} else if($view_type =='2') {
				
				$select_bill_query = "SELECT 'supplier' as party_type, sp.supplier_id as party_id, sp.supplier_name as party_name,sp.mobile_number as party_mobile_number, sp.opening_balance, sp.opening_balance_type,
				(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
				WHERE ".$bill_where." e.party_id = sp.supplier_id AND e.deleted = '0'  GROUP BY e.party_id) as credit,
				(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
				WHERE ".$bill_where." e.party_id = sp.supplier_id AND e.deleted = '0' GROUP BY e.party_id) as debit FROM ".$GLOBALS['supplier_table']." as sp WHERE ".$supplier_where." sp.deleted = '0'   ";
			} else if($view_type =='3') {
				
				$select_bill_query = "SELECT 'contractor' as party_type, sp.contractor_id as party_id, sp.contractor_name as party_name,sp.mobile as party_mobile_number, sp.opening_balance, sp.opening_balance_type,
				(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
				WHERE ".$bill_where." e.party_id = sp.contractor_id AND e.deleted = '0'  GROUP BY e.party_id) as credit,
				(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
				WHERE ".$bill_where." e.party_id = sp.contractor_id AND e.deleted = '0' GROUP BY e.party_id) as debit FROM ".$GLOBALS['contractor_table']." as sp WHERE ".$contractor_where." sp.deleted = '0'   ";
			} else if($view_type =='4') {
				
				$select_bill_query = "SELECT 'customer' as party_type, sp.customer_id as party_id, sp.customer_name as party_name,sp.mobile_number as party_mobile_number, sp.opening_balance, sp.opening_balance_type,
				(SELECT SUM(e.credit) FROM ".$GLOBALS['payment_table']." as e
				WHERE ".$bill_where." e.party_id = sp.customer_id AND e.deleted = '0'  GROUP BY e.party_id) as credit,
				(SELECT SUM(e.debit) FROM ".$GLOBALS['payment_table']." as e 
				WHERE ".$bill_where." e.party_id = sp.customer_id AND e.deleted = '0' GROUP BY e.party_id) as debit FROM ".$GLOBALS['customer_table']." as sp WHERE ".$customer_where." sp.deleted = '0'   ";
			}
			
			$select_query = "SELECT party_type, party_id, party_name, party_mobile_number, opening_balance, opening_balance_type,credit,debit FROM (".$select_bill_query.") as g";

			if(!empty($select_query)) {
				$list = $this->getQueryRecords('',$select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						
						if(!empty($data['party_type']) && !empty($data['party_id'])) {
							$total_credit = 0; $total_debit = 0; $balance = 0;
							if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 1) ) {
								$total_credit = $total_credit + $data['opening_balance'];
							}
							if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 2) ) {
								$total_debit = $total_debit + $data['opening_balance'];
							}
							if(!empty($data['credit'])) {
								$total_credit = $total_credit + $data['credit'];
							}
							if(!empty($data['debit'])) {
								$total_debit = $total_debit + $data['debit'];
							}
							if(!empty($total_credit)) {
								$balance = $balance + $total_credit;
							}
							if(!empty($total_debit)) {
								$balance = $balance - $total_debit;
							}
							if(!empty($balance)) {
								$reports[] = array('party_type' => $data['party_type'], 'party_id' => $data['party_id'], 'party_name' => $data['party_name'], 'party_mobile_number' => $data['party_mobile_number'], "balance" => $balance,"credit"=>$data['credit'], "debit"=>$data['debit'],"opening_balance"=>$data['opening_balance'], "opening_balance_type"=>$data['opening_balance_type']);
							}
						}
					}
				}
			}
			
			return $list;
		}


		//Arul Murugan
		public function getPendingOrderReport($from_date, $to_date, $unit_type, $product_id,$customer_id, $agent_id,$case_contains) {
			$list = array();
		
			$where = "";
			if (!empty($from_date)) {
				$where = "bill_date >= '" . $from_date . "'";
			}
			if (!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if (!empty($where)) {
					$where .= " AND bill_date <= '" . $to_date . "'";
				} else {
					$where = "bill_date <= '" . $to_date . "'";
				}
			}
			if(!empty($product_id)) {
				if(!empty($where)) {
					$where = $where." AND product_id = '".$product_id."'";
				} else {
					$where = "product_id = '".$product_id."'";
				}
			}
			if(!empty($customer_id)) {
				if(!empty($where)) {
					$where = $where." AND party_id = '".$customer_id."'";
				} else {
					$where = "party_id = '".$customer_id."'";
				}
			}
			if(!empty($agent_id)) {
				if(!empty($where)) {
					$where = $where." AND agent_id = '".$agent_id."'";
				} else {
					$where = "agent_id = '".$agent_id."'";
				}
			}
			if(!empty($case_contains)) {
				if(!empty($where)) {
					$where = $where." AND case_contains = '".$case_contains."'";
				} else {
					$where = "case_contains = '".$case_contains."'";
				}
			}
		
			if(!empty($product_id)) {
				$select_query = "";
		
				if ($unit_type == "1") {
					$select_query = "SELECT bill_id, bill_number, bill_type, bill_date, product_id, unit_id, agent_id, party_id, case_contains, inward_unit, outward_unit FROM " . $GLOBALS['stock_conversion_table'] . " WHERE " . $where . " AND deleted = '0'";
				} else {
					$select_query = "SELECT bill_id, bill_number, bill_type, bill_date, product_id, unit_id, agent_id, party_id, case_contains, inward_sub_unit, outward_sub_unit FROM " . $GLOBALS['stock_conversion_table'] . " WHERE " . $where . " AND deleted = '0'";
				}
			
				if (!empty($select_query)) {
					$conversion_records = $this->getQueryRecords('', $select_query);
					return $conversion_records;
				}
			} else {
				$select_query = "";
				if ($unit_type == "1") {
					$select_query = "SELECT product_id, unit_id, SUM(inward_unit) AS inward_unit, SUM(outward_unit) AS outward_unit FROM " . $GLOBALS['stock_conversion_table'] . " WHERE " . $where . " AND deleted = '0' GROUP BY product_id";
				} else {
					$select_query = "SELECT product_id, unit_id, SUM(inward_sub_unit) AS inward_sub_unit, SUM(outward_sub_unit) AS outward_sub_unit FROM " . $GLOBALS['stock_conversion_table'] . " WHERE " . $where . " AND deleted = '0' GROUP BY product_id";
				}
			
				if (!empty($select_query)) {
					$conversion_records = $this->getQueryRecords('', $select_query);
			
					if (!empty($conversion_records)) {
						foreach ($conversion_records as $key => $data) {
							$stock_obj = new Stock_functions();
							$stock_inward_unit = $stock_obj->getInwardQty($GLOBALS['stock_by_magazine_table'], '', '', $data['product_id'], '');
							$stock_outward_unit = $stock_obj->getOutwardQty($GLOBALS['stock_by_magazine_table'], '', '', $data['product_id'], '');
							$current_stock_unit = $stock_inward_unit - $stock_outward_unit;
			
							if ($unit_type == "1") {
								$pending_order_unit = $data['inward_unit'] - $data['outward_unit'];
							} else {
								$pending_order_unit = $data['inward_sub_unit'] - $data['outward_sub_unit'];
							}
			
							$need_order_unit = max(0, $pending_order_unit - $current_stock_unit);
			
							$list[$key] = array(
								'product_id' => $data['product_id'],
								'unit_id' => $data['unit_id'],
								'current_stock_unit' => $current_stock_unit,
								'pending_order_unit' => $pending_order_unit,
								'need_order_unit' => $need_order_unit
							);
						}
					}
				}
			}
			return $list;
		}
    }
?>