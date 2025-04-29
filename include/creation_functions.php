<?php 
    class Creation_functions extends Basic_Functions{
    
		public function CheckUnitAlreadyExists($bill_company_id, $unit_name) {
			$list = array(); $select_query = ""; $unit_id = ""; $where = "";
		
			if(!empty($unit_name)) {
				$select_query = "SELECT unit_id FROM ".$GLOBALS['unit_table']." WHERE ".$where." lower_case_name = '".$unit_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['unit_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['unit_id'])) {
							$unit_id = $data['unit_id'];
						}
					}
				}
			}
			return $unit_id;
		}

		public function CheckGroupAlreadyExists($bill_company_id, $group_name) {
			$list = array(); $select_query = ""; $group_id = ""; $where = "";
		
			if(!empty($group_name)) {
				$select_query = "SELECT group_id FROM ".$GLOBALS['group_table']." WHERE ".$where." lower_case_name = '".$group_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['group_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['group_id'])) {
							$group_id = $data['group_id'];
						}
					}
				}
			}
			return $group_id;
		}

		public function GetUnitLinkedCount($unit_id) {
			$list = array(); $select_query = ""; $count = 0;
			if(!empty($unit_id)) {
				$select_query = "SELECT id_count FROM ((SELECT count(id) as id_count FROM ".$GLOBALS['product_table']." WHERE FIND_IN_SET('".$unit_id."', unit_id) AND deleted = '0')) as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		public function CheckChargesAlreadyExists($bill_company_id, $charge_name) {
			$list = array(); $select_query = ""; $charges_id = ""; $where = "";

			if(!empty($charge_name)) {
				$select_query = "SELECT charges_id FROM ".$GLOBALS['charges_table']." WHERE ".$where." lower_case_name = '".$charge_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['charges_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['charges_id'])) {
							$charges_id = $data['charges_id'];
						}
					}
				}
			}
			return $charges_id;
		}


		public function GetChargesLinkedCount($charges_id) {
			$list = array(); $select_query = ""; $where = ""; $count = 0;
			if(!empty($charges_id)) {
				$where = " FIND_IN_SET('".$charges_id."', charges_id) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['estimate_table']." WHERE FIND_IN_SET('".$charges_id."', other_charges_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['perfoma_invoice_table']." WHERE FIND_IN_SET('".$charges_id."', other_charges_id) AND deleted = '0') UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['delivery_slip_table']." WHERE FIND_IN_SET('".$charges_id."', other_charges_id) AND deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}


		public function TransportMobileExists($mobile_number) {
			$list = array(); $select_query = ""; $transport_id = ""; 
			
			if(!empty($mobile_number)) {
				$select_query = "SELECT transport_id FROM ".$GLOBALS['transport_table']." WHERE mobile_number = '".$mobile_number."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['transport_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['transport_id'])) {
							$transport_id = $data['transport_id'];
						}
					}
				}
			}
			return $transport_id;
		}

		public function GetFactoryLinkedCount($factory_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($factory_id)) {
				$where = " FIND_IN_SET('".$factory_id."', factory_id) AND ";
				$mt_where = " (FIND_IN_SET('".$factory_id."', from_factory_id) OR FIND_IN_SET('".$factory_id."', to_factory_id)) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['consumption_entry_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['daily_production_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['godown_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['inward_entry_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['magazine_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['material_transfer_table']." WHERE ".$mt_where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['stock_adjustment_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['user_table']." WHERE ".$where." deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function GetGodownLinkedCount($godown_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($godown_id)) {
				$where = " FIND_IN_SET('".$godown_id."', godown_id) AND ";
				$mt_where = " (FIND_IN_SET('".$godown_id."', from_location_id) OR FIND_IN_SET('".$godown_id."', to_location_id)) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['consumption_entry_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['inward_entry_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['material_transfer_table']." WHERE ".$mt_where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['semifinished_inward_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['stock_adjustment_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['godown_table']." WHERE ".$where." factory_id != '".$GLOBALS['null_value']."' AND deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['user_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['product_table']." WHERE ".$where." deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		public function GetMagazineLinkedCount($magazine_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($magazine_id)) {
				$where = " FIND_IN_SET('".$magazine_id."', magazine_id) AND ";
				$mt_where = " (FIND_IN_SET('".$magazine_id."', from_location_id) OR FIND_IN_SET('".$magazine_id."', to_location_id)) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['daily_production_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['material_transfer_table']." WHERE ".$mt_where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['sales_invoice_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['stock_adjustment_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['magazine_table']." WHERE ".$where." factory_id != '".$GLOBALS['null_value']."' AND deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['user_table']." WHERE ".$where." deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		
		public function GetPaymentmodeLinkedCount($payment_mode_id) {
			$list = array(); $select_query = ""; $count = 0;
			if(!empty($payment_mode_id)) {
				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['bank_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['expense_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['voucher_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		public function GetBankLinkedCount($bank_id) {
			$list = array(); $select_query = ""; $where = ""; $count = 0;
			if(!empty($bank_id)) {
				$where = " FIND_IN_SET('".$bank_id."', bank_id) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['estimate_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['performa_invoice_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['sales_invoice_table']." WHERE ".$where." cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['voucher_table']." WHERE ".$where." deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function CheckPaymentModeAlreadyExists($company_id, $payment_mode_name) {
			$list = array(); $select_query = ""; $payment_mode_id = ""; $where = "";
		
			if(!empty($payment_mode_name)) {
				$select_query = "SELECT payment_mode_id FROM ".$GLOBALS['payment_mode_table']." WHERE ".$where." lower_case_name = '".$payment_mode_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['payment_mode_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['payment_mode_id'])) {
							$payment_mode_id = $data['payment_mode_id'];
						}
					}
				}
			}
			return $payment_mode_id;
		}
		public function CheckFactoryAlreadyExist($lowercase_name_location) {
			$list = array(); $select_query = ""; $factory_id = ""; $where = "";
		
			if(!empty($lowercase_name_location)) {
				$select_query = "SELECT factory_id FROM ".$GLOBALS['factory_table']." WHERE ".$where." lowercase_name_location = '".$lowercase_name_location."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['factory_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['factory_id'])) {
							$factory_id = $data['factory_id'];
						}
					}
				}
			}
			return $factory_id;
		}
		public function CheckGodownAlreadyExist($lowercase_name_location) {
			$list = array(); $select_query = ""; $godown_id = ""; $where = "";
		
			if(!empty($lowercase_name_location)) {
				$select_query = "SELECT godown_id FROM ".$GLOBALS['godown_table']." WHERE ".$where." lowercase_name_location = '".$lowercase_name_location."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['godown_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['godown_id'])) {
							$godown_id = $data['godown_id'];
						}
					}
				}
			}
			return $godown_id;
		}
		public function CheckMagazineAlreadyExist($lowercase_name_location) {
			$list = array(); $select_query = ""; $magazine_id = ""; $where = "";
		
			if(!empty($lowercase_name_location)) {
				$select_query = "SELECT magazine_id FROM ".$GLOBALS['magazine_table']." WHERE ".$where." lowercase_name_location = '".$lowercase_name_location."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['magazine_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['magazine_id'])) {
							$magazine_id = $data['magazine_id'];
						}
					}
				}
			}
			return $magazine_id;
		}

		public function getContractorKuliId($contractor_id, $product_id, $unit_type) {
			$id = "";
			if(!empty($contractor_id) && !empty($product_id) && $unit_type) {
				$select_query = "SELECT id FROM ".$GLOBALS['contractor_product_table']." WHERE contractor_id = '".$contractor_id."' AND product_id = '".$product_id."' AND unit_type = '".$unit_type."' AND deleted = '0'";
				if(!empty($select_query)) {
					// echo $select_query;
					$list = $this->getQueryRecords($GLOBALS['contractor_product_table'], $select_query);
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['id'])) {
								$id = $data['id'];
							}
						}
					}
				}
				
			}
			return $id;
		}

		public function getContractorProductTable($contractor_id) {
			$list = array(); $select_query = "";
		
			if(!empty($contractor_id)) {
				$select_query = "SELECT product.product_id, product.product_name, kuli.unit_type, kuli.unit_id, kuli.unit_name, kuli.subunit_id, kuli.subunit_name, kuli.quantity, kuli.rate  FROM ".$GLOBALS['contractor_product_table']." AS kuli LEFT JOIN ".$GLOBALS['product_table']. " AS product ON kuli.product_id = product.product_id WHERE kuli.contractor_id = '".$contractor_id."' AND kuli.deleted = '0' AND product.deleted = '0'";	
			}
			// echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['contractor_product_table'], $select_query);
			}
			return $list;
		}

		public function DeleteContractorKuli($contractor_id) {
			$delete = ''; $select_query = "";
		
			if(!empty($contractor_id)) {
				$select_query = "SELECT * FROM ".$GLOBALS['contractor_product_table']."  WHERE contractor_id = '".$contractor_id."' AND deleted = '0'";	
			}
			// echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['contractor_product_table'], $select_query);
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['id'])) {
								$columns = array(); $values = array();			
								$columns = array('deleted');
								$values = array("'1'");
								$delete = $this->UpdateSQL($GLOBALS['contractor_product_table'], $data['id'], $columns, $values, 'delete kuli');
							}
						}
					}
			}
			return $delete;
		}

		public function getProductWithGroup($type1, $type2, $type3) {
			$where = $list = []; $select_query = "";
			if(!empty($type1)) {
				$where[] = "groups.lower_case_name = '".$this->encode_decode('encrypt',$type1)."'";
			}
			if(!empty($type2)) {
				$where[] = "groups.lower_case_name = '".$this->encode_decode('encrypt',$type2)."'";
			}
			if(!empty($type3)) {
				$where[] = "groups.lower_case_name = '".$this->encode_decode('encrypt',$type3)."'";
			}

			$join_condition = "product.group_id = groups.group_id";
			if (!empty($where)) {
			$join_condition .= " AND (" . implode(' OR ', $where) . ")";

			$select_query = "SELECT product.* FROM " . $GLOBALS['product_table'] . " AS product " .
                "LEFT JOIN " . $GLOBALS['group_table'] . " AS groups ON " . $join_condition . " " .
                "WHERE product.deleted = '0'";
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['product_table']." WHERE deleted = '0'";	
			}
			// echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['product_table'], $select_query);
			}

			return $list;
		}
		public function CheckTransportAlreadyExist($lowercase_name_location) {
			$list = array(); $select_query = ""; $transport_id = ""; $where = "";

			if(!empty($lowercase_name_location)) {
				$select_query = "SELECT transport_id FROM ".$GLOBALS['transport_table']." WHERE ".$where." lower_case_name_location = '".$lowercase_name_location."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['transport_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['transport_id'])) {
							$transport_id = $data['transport_id'];
						}
					}
				}
			}
			return $transport_id;
		}

		public function getConsumptionTableRecords() {
			$list = array(); $select_query = ""; 

			$select_query = "SELECT consumption.*, contractor.name_mobile_city FROM " . $GLOBALS['consumption_entry_table'] . " AS consumption LEFT JOIN " . $GLOBALS['contractor_table'] . " AS contractor ON consumption.contractor_id = contractor.contractor_id WHERE consumption.deleted = '0' ORDER BY consumption.id DESC";
			// echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['consumption_entry_table'], $select_query);
			}
			return $list;
		}

		public function PurchaseBillNumberAlreadyExists($bill_company_id, $purchase_entry_number) {
			$list = array(); $select_query = ""; $purchase_entry_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$bill_company_id."' AND ";
			}
			if(!empty($purchase_entry_number)) {
				$select_query = "SELECT purchase_entry_id FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." purchase_entry_number = '".$purchase_entry_number."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['purchase_entry_id'])) {
							$purchase_entry_id = $data['purchase_entry_id'];
						}
					}
				}
			}
			return $purchase_entry_id;
		}

		public function getPurchaseList($from_date, $to_date,$search_text,$show_bill) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."' ";
			}
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND purchase_entry_date >= '".$from_date."'";
                }
                else {
                    $where = "purchase_entry_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND purchase_entry_date <= '".$to_date."'";
                }
                else {
                    $where = "purchase_entry_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND cancelled = '".$show_bill."' ";
                }
                else {
                    $where = "cancelled = '".$show_bill."' ";
                }
            }

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
            
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
            }
            return $list;
        }

		public function getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text, $show_bill) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
				$where = "proforma_invoice_date >= '".$from_date."'";
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND proforma_invoice_date <= '".$to_date."'";
                }
                else {
                    $where = "proforma_invoice_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND cancelled = '".$show_bill."' ";
                }
                else {
                    $where = "cancelled = '".$show_bill."' ";
                }
            }

			if(!empty($customer_id)){
                if(!empty($where)) {
                    $where = $where." AND customer_id = '".$customer_id."' ";
                } else {
                    $where = "customer_id = '".$customer_id."' ";
                }
            }

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['proforma_invoice_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['proforma_invoice_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
            
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['proforma_invoice_table'], $select_query);
            }
            return $list;
        }

		public function getDeliverySlipList($from_date, $to_date, $customer_id, $search_text, $show_bill) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
				$where = "delivery_slip_date >= '".$from_date."'";
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND delivery_slip_date <= '".$to_date."'";
                } else {
                    $where = "delivery_slip_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND cancelled = '".$show_bill."' ";
                }
                else {
                    $where = "cancelled = '".$show_bill."' ";
                }
            }

			if(!empty($customer_id)){
                if(!empty($where)) {
                    $where = $where." AND customer_id = '".$customer_id."' ";
                } else {
                    $where = "customer_id = '".$customer_id."' ";
                }
            }

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
            
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['delivery_slip_table'], $select_query);
            }
            return $list;
        }

		public function getDeliverySlipIndex($delivery_slip_id, $conversion_update) {
			$list = array();
			if(!empty($conversion_update) && $conversion_update == 1) {
				$old_delivery_slip = array();
				$old_delivery_slip_query = "SELECT * FROM " . $GLOBALS['delivery_slip_table'] . " WHERE proforma_invoice_id = '" . $delivery_slip_id . "' AND deleted = '0' AND cancelled = '0'";

				$old_delivery_slip = $this->getQueryRecords('', $old_delivery_slip_query);
	
				$old_products_list = array();

				if (!empty($old_delivery_slip)) {
					foreach ($old_delivery_slip as $old_delivery_slip_data) {
						$product_ids = explode(',', $old_delivery_slip_data['product_id']);
						$quantities = explode(',', $old_delivery_slip_data['quantity']);

						for ($i = 0; $i < count($product_ids); $i++) {
							$old_products_list[] = [
								'product_id' => trim($product_ids[$i]),
								'quantity' => (float)trim($quantities[$i])
							];
						}
					}
				}

				$merged_old_products = array();

				foreach ($old_products_list as $old_product) {
					$product_id = $old_product['product_id'];
					$quantity = (float) $old_product['quantity'];

					if (isset($merged_old_products[$product_id])) {
						$merged_old_products[$product_id]['quantity'] += $quantity;
					} else {
						$merged_old_products[$product_id] = array(
							'product_id' => $product_id,
							'quantity' => $quantity
						);
					}
				}

				$old_products_list = array_values($merged_old_products);

				$proforma_invoice_list = $this->getTableRecords($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $delivery_slip_id, '');

				if (!empty($proforma_invoice_list)) {
					$proforma_invoice = $proforma_invoice_list[0];

					if (!empty($proforma_invoice)) {
						if (!empty($old_products_list)) {
							$filtered_products = [
								'product_id' => [],
								'indv_magazine_id' => [],
								'product_name' => [],
								'unit_type' => [],
								'subunit_need' => [],
								'content' => [],
								'unit_id' => [],
								'unit_name' => [],
								'quantity' => [],
								'rate' => [],
								'per' => [],
								'per_type' => [],
								'product_tax' => [],
								'final_rate' => [],
								'amount' => [],
							];

							// Explode the proforma fields
							$product_ids = explode(',', $proforma_invoice['product_id']);
							$indv_magazine_ids = explode(',', $proforma_invoice['indv_magazine_id']);
							$product_names = explode(',', $proforma_invoice['product_name']);
							$unit_types = explode(',', $proforma_invoice['unit_type']);
							$subunit_needs = explode(',', $proforma_invoice['subunit_need']);
							$contents = explode(',', $proforma_invoice['content']);
							$unit_ids = explode(',', $proforma_invoice['unit_id']);
							$unit_names = explode(',', $proforma_invoice['unit_name']);
							$quantitys = explode(',', $proforma_invoice['quantity']);
							$rates = explode(',', $proforma_invoice['rate']);
							$pers = explode(',', $proforma_invoice['per']);
							$per_types = explode(',', $proforma_invoice['per_type']);
							$product_taxs = explode(',', $proforma_invoice['product_tax']);
							$final_rates = explode(',', $proforma_invoice['final_rate']);
							$amounts = explode(',', $proforma_invoice['amount']);

							for ($i = 0; $i < count($product_ids); $i++) {
								$current_product_id = trim($product_ids[$i]);
								$current_quantity = (float)trim($quantitys[$i]);

								// Check if this product_id exists in old products list
								$found = false;
								foreach ($old_products_list as $old_product) {
									if ($old_product['product_id'] == $current_product_id) {
										$found = true;
										$old_quantity = $old_product['quantity'];

										if ($old_quantity < $current_quantity) {
											// Adjust quantity
											$new_quantity = $current_quantity - $old_quantity;

											$filtered_products['product_id'][] = $current_product_id;
											$filtered_products['indv_magazine_id'][] = trim($indv_magazine_ids[$i]);
											$filtered_products['product_name'][] = trim($product_names[$i]);
											$filtered_products['unit_type'][] = trim($unit_types[$i]);
											$filtered_products['subunit_need'][] = trim($subunit_needs[$i]);
											$filtered_products['content'][] = trim($contents[$i]);
											$filtered_products['unit_id'][] = trim($unit_ids[$i]);
											$filtered_products['unit_name'][] = trim($unit_names[$i]);
											$filtered_products['quantity'][] = $new_quantity;
											$filtered_products['rate'][] = trim($rates[$i]);
											$filtered_products['per'][] = trim($pers[$i]);
											$filtered_products['per_type'][] = trim($per_types[$i]);
											$filtered_products['product_tax'][] = trim($product_taxs[$i]);
											$filtered_products['final_rate'][] = trim($final_rates[$i]);
											$filtered_products['amount'][] = trim($amounts[$i]);
										}
										// If old == current quantity, skip adding (means remove)
										break;
									}
								}

								if (!$found) {
									// If not found in old products, add as it is
									$filtered_products['product_id'][] = $current_product_id;
									$filtered_products['indv_magazine_id'][] = trim($indv_magazine_ids[$i]);
									$filtered_products['product_name'][] = trim($product_names[$i]);
									$filtered_products['unit_type'][] = trim($unit_types[$i]);
									$filtered_products['subunit_need'][] = trim($subunit_needs[$i]);
									$filtered_products['content'][] = trim($contents[$i]);
									$filtered_products['unit_id'][] = trim($unit_ids[$i]);
									$filtered_products['unit_name'][] = trim($unit_names[$i]);
									$filtered_products['quantity'][] = $current_quantity;
									$filtered_products['rate'][] = trim($rates[$i]);
									$filtered_products['per'][] = trim($pers[$i]);
									$filtered_products['per_type'][] = trim($per_types[$i]);
									$filtered_products['product_tax'][] = trim($product_taxs[$i]);
									$filtered_products['final_rate'][] = trim($final_rates[$i]);
									$filtered_products['amount'][] = trim($amounts[$i]);
								}
							}

							// Merge new proforma data
							$new_proforma_invoice = [
								'product_id' => implode(',', $filtered_products['product_id']),
								'indv_magazine_id' => implode(',', $filtered_products['indv_magazine_id']),
								'product_name' => implode(',', $filtered_products['product_name']),
								'unit_type' => implode(',', $filtered_products['unit_type']),
								'subunit_need' => implode(',', $filtered_products['subunit_need']),
								'content' => implode(',', $filtered_products['content']),
								'unit_id' => implode(',', $filtered_products['unit_id']),
								'unit_name' => implode(',', $filtered_products['unit_name']),
								'quantity' => implode(',', $filtered_products['quantity']),
								'rate' => implode(',', $filtered_products['rate']),
								'per' => implode(',', $filtered_products['per']),
								'per_type' => implode(',', $filtered_products['per_type']),
								'product_tax' => implode(',', $filtered_products['product_tax']),
								'final_rate' => implode(',', $filtered_products['final_rate']),
								'amount' => implode(',', $filtered_products['amount']),
							];

							// Final list
							$list = array_merge($proforma_invoice, $new_proforma_invoice);

						} else {
							$list = $proforma_invoice;
						}
					}
				}
			} else {
				$list = $this->getTableRecords($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $delivery_slip_id, '');

				if(!empty($list)) {
					$list = $list[0];
				}
			}
			return $list;
        }

		public function getProformaInvoiceActions($proforma_invoice_id) {
			$list = array();
			$proforma_invoice_query = "SELECT * FROM ".$GLOBALS['proforma_invoice_table']." WHERE proforma_invoice_id = '" . $proforma_invoice_id . "' AND deleted = '0'";    
			$delivery_slip_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']." WHERE proforma_invoice_id = '" . $proforma_invoice_id . "' AND deleted = '0'";
		
			$delivery_slip_list = $this->getQueryRecords($GLOBALS['delivery_slip_table'], $delivery_slip_query);
			$proforma_invoice_list = $this->getQueryRecords($GLOBALS['proforma_invoice_table'], $proforma_invoice_query);
		
			if (!empty($delivery_slip_list)) {
				$old_products_list = array();
		
				foreach ($delivery_slip_list as $delivery_slip_data) {
					$product_ids = explode(',', $delivery_slip_data['product_id']);
					$quantities = explode(',', $delivery_slip_data['quantity']);
		
					for ($i = 0; $i < count($product_ids); $i++) {
						$old_products_list[] = [
							'product_id' => trim($product_ids[$i]),
							'quantity' => (float)trim($quantities[$i])
						];
					}
				}
		
				// Merge old products (combine quantities of duplicate products)
				$merged_old_products = array();
				foreach ($old_products_list as $old_product) {
					$product_id = $old_product['product_id'];
					$quantity = $old_product['quantity'];
		
					if (isset($merged_old_products[$product_id])) {
						$merged_old_products[$product_id]['quantity'] += $quantity;
					} else {
						$merged_old_products[$product_id] = array(
							'product_id' => $product_id,
							'quantity' => $quantity
						);
					}
				}
		
				// Get proforma invoice
				if (!empty($proforma_invoice_list)) {
					$proforma_invoice = $proforma_invoice_list[0];
				}
		
				if (!empty($proforma_invoice)) {
					$product_ids = explode(',', $proforma_invoice['product_id']);
					$quantities = explode(',', $proforma_invoice['quantity']);
		
					$merged_new_products = array();
					for ($i = 0; $i < count($product_ids); $i++) {
						$product_id = trim($product_ids[$i]);
						$quantity = (float)trim($quantities[$i]);
		
						if (isset($merged_new_products[$product_id])) {
							$merged_new_products[$product_id]['quantity'] += $quantity;
						} else {
							$merged_new_products[$product_id] = array(
								'product_id' => $product_id,
								'quantity' => $quantity
							);
						}
					}
		
					// Now compare merged_old_products vs merged_new_products
					$mismatch_found = false;

		
					foreach ($merged_old_products as $product_id => $old_product) {
						$old_qty = $old_product['quantity'];
						$new_qty = isset($merged_new_products[$product_id]['quantity']) ? $merged_new_products[$product_id]['quantity'] : 0;
		
						if ($old_qty != $new_qty) {
							$mismatch_found = true;
							break;
						}
					}
		
					// Also check if there are extra products in new which are not in old
					foreach ($merged_new_products as $product_id => $new_product) {
						if (!isset($merged_old_products[$product_id])) {
							$mismatch_found = true;
							break;
						}
					}
		
					if ($mismatch_found) {
						$list = [ "edit", "convert" ];
					} else {
						$list = []; // all quantities match
					}
				}
			} else {
				$list = [ "edit", "delete", "convert" ];
			}
		
			return $list;
		}	
		
		public function getDeliverySlipActions($delivery_slip_id) {
			$list = array();
			$estimate_query = "SELECT * FROM ".$GLOBALS['estimate_table']." WHERE delivery_slip_id = '" . $delivery_slip_id . "' AND deleted = '0'";
			$delivery_slip_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']." WHERE proforma_invoice_id = '" . $delivery_slip_id . "' AND deleted = '0'";
		
			$delivery_slip_list = $this->getQueryRecords($GLOBALS['delivery_slip_table'], $delivery_slip_query);
			$estimate_list = $this->getQueryRecords($GLOBALS['estimate_table'], $estimate_query);
		
			if (!empty($estimate_list)) {
				$old_products_list = array();
		
				foreach ($estimate_list as $delivery_slip_data) {
					$product_ids = explode(',', $delivery_slip_data['product_id']);
					$quantities = explode(',', $delivery_slip_data['quantity']);
		
					for ($i = 0; $i < count($product_ids); $i++) {
						$old_products_list[] = [
							'product_id' => trim($product_ids[$i]),
							'quantity' => (float)trim($quantities[$i])
						];
					}
				}
		
				// Merge old products (combine quantities of duplicate products)
				$merged_old_products = array();
				foreach ($old_products_list as $old_product) {
					$product_id = $old_product['product_id'];
					$quantity = $old_product['quantity'];
		
					if (isset($merged_old_products[$product_id])) {
						$merged_old_products[$product_id]['quantity'] += $quantity;
					} else {
						$merged_old_products[$product_id] = array(
							'product_id' => $product_id,
							'quantity' => $quantity
						);
					}
				}
		
				// Get proforma invoice
				if (!empty($delivery_slip_list)) {
					$proforma_invoice = $delivery_slip_list[0];
				}
		
				if (!empty($proforma_invoice)) {
					$product_ids = explode(',', $proforma_invoice['product_id']);
					$quantities = explode(',', $proforma_invoice['quantity']);
		
					$merged_new_products = array();
					for ($i = 0; $i < count($product_ids); $i++) {
						$product_id = trim($product_ids[$i]);
						$quantity = (float)trim($quantities[$i]);
		
						if (isset($merged_new_products[$product_id])) {
							$merged_new_products[$product_id]['quantity'] += $quantity;
						} else {
							$merged_new_products[$product_id] = array(
								'product_id' => $product_id,
								'quantity' => $quantity
							);
						}
					}
		
					// Now compare merged_old_products vs merged_new_products
					$mismatch_found = false;

		
					foreach ($merged_old_products as $product_id => $old_product) {
						$old_qty = $old_product['quantity'];
						$new_qty = isset($merged_new_products[$product_id]['quantity']) ? $merged_new_products[$product_id]['quantity'] : 0;
		
						if ($old_qty != $new_qty) {
							$mismatch_found = true;
							break;
						}
					}
		
					// Also check if there are extra products in new which are not in old
					foreach ($merged_new_products as $product_id => $new_product) {
						if (!isset($merged_old_products[$product_id])) {
							$mismatch_found = true;
							break;
						}
					}
		
					if ($mismatch_found) {
						$list = [ "edit", "convert" ];
					} else {
						$list = []; // all quantities match
					}
				}
			} else {
				$list = [ "edit", "delete", "convert" ];
			}
		
			return $list;
		}	

		public function getDeliveryProductsFromPI($proforma_invoice_id) {
			$list = array();
		
			$delivery_slip_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']." WHERE proforma_invoice_id = '" . $proforma_invoice_id . "' AND deleted = '0'";
			$delivery_slip_list = $this->getQueryRecords($GLOBALS['delivery_slip_table'], $delivery_slip_query);
		
			$old_products_list = array();
		
			if (!empty($delivery_slip_list)) {
				foreach ($delivery_slip_list as $delivery_slip_data) {
					$product_ids = explode(',', $delivery_slip_data['product_id']);
					$quantities = explode(',', $delivery_slip_data['quantity']);
		
					for ($i = 0; $i < count($product_ids); $i++) {
						$old_products_list[] = trim($product_ids[$i]);
					}
				}
			}
		
			$merged_old_products = array_values(array_unique($old_products_list));
			
			$list = $merged_old_products;

			return $list;
		}		

		public function getEstimateIndex($estimate_id, $conversion_update) {
			$list = array();
			if(!empty($conversion_update) && $conversion_update == 1) {
			// 	$old_delivery_slip = array();
			// 	$old_delivery_slip_query = "SELECT * FROM " . $GLOBALS['delivery_slip_table'] . " WHERE proforma_invoice_id = '" . $delivery_slip_id . "' AND deleted = '0' AND cancelled = '0'";

			// 	$old_delivery_slip = $this->getQueryRecords('', $old_delivery_slip_query);
	
			// 	$old_products_list = array();

			// 	if (!empty($old_delivery_slip)) {
			// 		foreach ($old_delivery_slip as $old_delivery_slip_data) {
			// 			$product_ids = explode(',', $old_delivery_slip_data['product_id']);
			// 			$quantities = explode(',', $old_delivery_slip_data['quantity']);

			// 			for ($i = 0; $i < count($product_ids); $i++) {
			// 				$old_products_list[] = [
			// 					'product_id' => trim($product_ids[$i]),
			// 					'quantity' => (float)trim($quantities[$i])
			// 				];
			// 			}
			// 		}
			// 	}

			// 	$merged_old_products = array();

			// 	foreach ($old_products_list as $old_product) {
			// 		$product_id = $old_product['product_id'];
			// 		$quantity = (float) $old_product['quantity'];

			// 		if (isset($merged_old_products[$product_id])) {
			// 			$merged_old_products[$product_id]['quantity'] += $quantity;
			// 		} else {
			// 			$merged_old_products[$product_id] = array(
			// 				'product_id' => $product_id,
			// 				'quantity' => $quantity
			// 			);
			// 		}
			// 	}

			// 	$old_products_list = array_values($merged_old_products);

				$delivery_slip_list = $this->getTableRecords($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $estimate_id, '');

				if (!empty($delivery_slip_list)) {
					$delivery_slip = $delivery_slip_list[0];

					// if (!empty($delivery_slip)) {
			// 			if (!empty($old_products_list)) {
			// 				$filtered_products = [
			// 					'product_id' => [],
			// 					'indv_magazine_id' => [],
			// 					'product_name' => [],
			// 					'unit_type' => [],
			// 					'subunit_need' => [],
			// 					'content' => [],
			// 					'unit_id' => [],
			// 					'unit_name' => [],
			// 					'quantity' => [],
			// 					'rate' => [],
			// 					'per' => [],
			// 					'per_type' => [],
			// 					'product_tax' => [],
			// 					'final_rate' => [],
			// 					'amount' => [],
			// 				];

			// 				// Explode the proforma fields
			// 				$product_ids = explode(',', $proforma_invoice['product_id']);
			// 				$indv_magazine_ids = explode(',', $proforma_invoice['indv_magazine_id']);
			// 				$product_names = explode(',', $proforma_invoice['product_name']);
			// 				$unit_types = explode(',', $proforma_invoice['unit_type']);
			// 				$subunit_needs = explode(',', $proforma_invoice['subunit_need']);
			// 				$contents = explode(',', $proforma_invoice['content']);
			// 				$unit_ids = explode(',', $proforma_invoice['unit_id']);
			// 				$unit_names = explode(',', $proforma_invoice['unit_name']);
			// 				$quantitys = explode(',', $proforma_invoice['quantity']);
			// 				$rates = explode(',', $proforma_invoice['rate']);
			// 				$pers = explode(',', $proforma_invoice['per']);
			// 				$per_types = explode(',', $proforma_invoice['per_type']);
			// 				$product_taxs = explode(',', $proforma_invoice['product_tax']);
			// 				$final_rates = explode(',', $proforma_invoice['final_rate']);
			// 				$amounts = explode(',', $proforma_invoice['amount']);

			// 				for ($i = 0; $i < count($product_ids); $i++) {
			// 					$current_product_id = trim($product_ids[$i]);
			// 					$current_quantity = (float)trim($quantitys[$i]);

			// 					// Check if this product_id exists in old products list
			// 					$found = false;
			// 					foreach ($old_products_list as $old_product) {
			// 						if ($old_product['product_id'] == $current_product_id) {
			// 							$found = true;
			// 							$old_quantity = $old_product['quantity'];

			// 							if ($old_quantity < $current_quantity) {
			// 								// Adjust quantity
			// 								$new_quantity = $current_quantity - $old_quantity;

			// 								$filtered_products['product_id'][] = $current_product_id;
			// 								$filtered_products['indv_magazine_id'][] = trim($indv_magazine_ids[$i]);
			// 								$filtered_products['product_name'][] = trim($product_names[$i]);
			// 								$filtered_products['unit_type'][] = trim($unit_types[$i]);
			// 								$filtered_products['subunit_need'][] = trim($subunit_needs[$i]);
			// 								$filtered_products['content'][] = trim($contents[$i]);
			// 								$filtered_products['unit_id'][] = trim($unit_ids[$i]);
			// 								$filtered_products['unit_name'][] = trim($unit_names[$i]);
			// 								$filtered_products['quantity'][] = $new_quantity;
			// 								$filtered_products['rate'][] = trim($rates[$i]);
			// 								$filtered_products['per'][] = trim($pers[$i]);
			// 								$filtered_products['per_type'][] = trim($per_types[$i]);
			// 								$filtered_products['product_tax'][] = trim($product_taxs[$i]);
			// 								$filtered_products['final_rate'][] = trim($final_rates[$i]);
			// 								$filtered_products['amount'][] = trim($amounts[$i]);
			// 							}
			// 							// If old == current quantity, skip adding (means remove)
			// 							break;
			// 						}
			// 					}

			// 					if (!$found) {
			// 						// If not found in old products, add as it is
			// 						$filtered_products['product_id'][] = $current_product_id;
			// 						$filtered_products['indv_magazine_id'][] = trim($indv_magazine_ids[$i]);
			// 						$filtered_products['product_name'][] = trim($product_names[$i]);
			// 						$filtered_products['unit_type'][] = trim($unit_types[$i]);
			// 						$filtered_products['subunit_need'][] = trim($subunit_needs[$i]);
			// 						$filtered_products['content'][] = trim($contents[$i]);
			// 						$filtered_products['unit_id'][] = trim($unit_ids[$i]);
			// 						$filtered_products['unit_name'][] = trim($unit_names[$i]);
			// 						$filtered_products['quantity'][] = $current_quantity;
			// 						$filtered_products['rate'][] = trim($rates[$i]);
			// 						$filtered_products['per'][] = trim($pers[$i]);
			// 						$filtered_products['per_type'][] = trim($per_types[$i]);
			// 						$filtered_products['product_tax'][] = trim($product_taxs[$i]);
			// 						$filtered_products['final_rate'][] = trim($final_rates[$i]);
			// 						$filtered_products['amount'][] = trim($amounts[$i]);
			// 					}
			// 				}

			// 				// Merge new proforma data
			// 				$new_proforma_invoice = [
			// 					'product_id' => implode(',', $filtered_products['product_id']),
			// 					'indv_magazine_id' => implode(',', $filtered_products['indv_magazine_id']),
			// 					'product_name' => implode(',', $filtered_products['product_name']),
			// 					'unit_type' => implode(',', $filtered_products['unit_type']),
			// 					'subunit_need' => implode(',', $filtered_products['subunit_need']),
			// 					'content' => implode(',', $filtered_products['content']),
			// 					'unit_id' => implode(',', $filtered_products['unit_id']),
			// 					'unit_name' => implode(',', $filtered_products['unit_name']),
			// 					'quantity' => implode(',', $filtered_products['quantity']),
			// 					'rate' => implode(',', $filtered_products['rate']),
			// 					'per' => implode(',', $filtered_products['per']),
			// 					'per_type' => implode(',', $filtered_products['per_type']),
			// 					'product_tax' => implode(',', $filtered_products['product_tax']),
			// 					'final_rate' => implode(',', $filtered_products['final_rate']),
			// 					'amount' => implode(',', $filtered_products['amount']),
			// 				];

			// 				// Final list
			// 				$list = array_merge($proforma_invoice, $new_proforma_invoice);

						// } else {
							$list = $delivery_slip;
						// }
					}
			// 	}
			} else {
				$list = $this->getTableRecords($GLOBALS['estimate_table'], 'estimate_id', $estimate_id, '');

				if(!empty($list)) {
					$list = $list[0];
				}
			}
			return $list;
        }

		public function getEstimateList($from_date, $to_date, $customer_id, $search_text, $show_bill) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
				$where = "estimate_date >= '".$from_date."'";
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND estimate_date <= '".$to_date."'";
                } else {
                    $where = "estimate_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND cancelled = '".$show_bill."' ";
                }
                else {
                    $where = "cancelled = '".$show_bill."' ";
                }
            }

			if(!empty($customer_id)){
                if(!empty($where)) {
                    $where = $where." AND customer_id = '".$customer_id."' ";
                } else {
                    $where = "customer_id = '".$customer_id."' ";
                }
            }

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['estimate_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['estimate_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
            
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['estimate_table'], $select_query);
            }
            return $list;
        }
		
		public function getContractorFinishedProducts($contractor_id,$finished_product_group_id) {
			$list = array(); $select_query = "";
		
			if(!empty($contractor_id)) {
				$select_query = "SELECT cp.product_id, p.product_name, cp.unit_type, cp.unit_id, cp.unit_name, cp.subunit_id, cp.subunit_name, cp.quantity, cp.rate  FROM ".$GLOBALS['contractor_product_table']." AS cp LEFT JOIN ".$GLOBALS['product_table']. " AS p ON cp.product_id = p.product_id WHERE cp.contractor_id = '".$contractor_id."' AND cp.group_id = '".$finished_product_group_id."' AND cp.deleted = '0' AND p.deleted = '0' GROUP BY cp.product_id ";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['contractor_product_table'], $select_query);
			}
			return $list;
		}
		
		public function ProductContainsList($product_id){
			$list = array(); $select_query = "";
		
			if(!empty($product_id)) {
				 $select_query = "SELECT Distinct case_contains FROM ".$GLOBALS['stock_table']." WHERE  product_id = '".$product_id."' AND deleted = '0'";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['stock_table'], $select_query);
			}
			return $list;
		}
		
		public function getDailyProductionList($from_date, $to_date, $filter_factory_id, $filter_magazine_id, $filter_contractor_id, $show_bill) {
			$list = array(); $select_query = ""; $where = "";
			if(!empty($filter_magazine_id)) {
				if(!empty($where)) {
					$where = $where." AND magazine_id = '".$filter_magazine_id."'";
				}
				else {
					$where = "magazine_id = '".$filter_magazine_id."'";
				}
			}
			if(!empty($filter_contractor_id)) {
				if(!empty($where)) {
					$where = $where." AND contractor_id = '".$filter_contractor_id."'";
				}
				else {
					$where = "contractor_id = '".$filter_contractor_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND entry_date >= '".$from_date."'";
				}
				else {
					$where = "entry_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND entry_date <= '".$to_date."'";
				}
				else {
					$where = "entry_date <= '".$to_date."'";
				}
			}
			if($show_bill == '0' || $show_bill == '1'){
				if(!empty($where)) {
					$where = $where." AND cancelled = '".$show_bill."' ";
				}
				else {
					$where = "cancelled = '".$show_bill."' ";
				}
			}
	
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['daily_production_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['daily_production_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['daily_production_table'], $select_query);
			}
			return $list;
		}
	
		public function getCoolyRate($contractor_id, $product_id, $unit_type) {
			$select_query = ""; $list = array(); $rate_type = ""; $amount = 0;

			if(!empty($contractor_id) && !empty($product_id)) {
				$select_query = "SELECT rate_per_unit, rate_per_subunit, unit_type FROM ".$GLOBALS['contractor_product_table']." WHERE contractor_id = '".$contractor_id."' AND product_id = '".$product_id."' AND deleted = '0'";
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['contractor_product_table'], $select_query);
				}
			}
		  
			return $list;
		}
		//new 


		public function getContractorSemiFinishedProducts($contractor_id,$finished_product_group_id) {
			$list = array(); $select_query = "";

			if(!empty($contractor_id)) {
				echo $select_query = "SELECT cp.product_id, p.product_name, cp.unit_type, cp.unit_id, cp.unit_name, cp.subunit_id, cp.subunit_name, cp.quantity, cp.rate  FROM ".$GLOBALS['contractor_product_table']." AS cp LEFT JOIN ".$GLOBALS['product_table']. " AS p ON cp.product_id = p.product_id WHERE cp.contractor_id = '".$contractor_id."' AND cp.group_id = '".$finished_product_group_id."' AND cp.deleted = '0' AND p.deleted = '0' GROUP BY cp.product_id ";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['contractor_product_table'], $select_query);
			}
			return $list;
		}

			
		public function getSemiFinishedInwardList($from_date, $to_date, $filter_factory_id, $filter_godown_id, $filter_contractor_id, $show_bill) {
			$list = array(); $select_query = ""; $where = "";
			if(!empty($filter_godown_id)) {
				if(!empty($where)) {
					$where = $where." AND goodwn_id = '".$filter_godown_id."'";
				}
				else {
					$where = "goodwn_id = '".$filter_godown_id."'";
				}
			}
			if(!empty($filter_contractor_id)) {
				if(!empty($where)) {
					$where = $where." AND contractor_id = '".$filter_contractor_id."'";
				}
				else {
					$where = "contractor_id = '".$filter_contractor_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND entry_date >= '".$from_date."'";
				}
				else {
					$where = "entry_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND entry_date <= '".$to_date."'";
				}
				else {
					$where = "entry_date <= '".$to_date."'";
				}
			}
			if($show_bill == '0' || $show_bill == '1'){
				if(!empty($where)) {
					$where = $where." AND cancelled = '".$show_bill."' ";
				}
				else {
					$where = "cancelled = '".$show_bill."' ";
				}
			}
	
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['semifinished_inward_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['semifinished_inward_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['semifinished_inward_table'], $select_query);
			}
			return $list;
		}

		public function getAgentCustomerList($agent_id)
        {
            if(empty($agent_id))
            {
                $agent_id =$GLOBALS['null_value'];
            }
            $select_query ="";
            $select_query ="SELECT * FROM ".$GLOBALS['customer_table']." WHERE agent_id ='".$agent_id."'  AND deleted = '0' ";
            $agent_customer_list = $this->getQueryRecords($GLOBALS['customer_table'],$select_query);
            return $agent_customer_list;
        }
		
    }
?>
