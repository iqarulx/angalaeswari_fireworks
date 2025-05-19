<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['expense_module'];
            include("permission_check.php");
        }
    }

	if(isset($_REQUEST['show_expense_entry_id'])) { 
        $show_expense_entry_id = $_REQUEST['show_expense_entry_id'];
        $expense_date = date("Y-m-d"); 
        $expense_category_list = array();
        $expense_category_list = $obj->getTableRecords($GLOBALS['expense_category_table'],'','','');

        $payment_mode_list = array();
		$payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '','',''); 
        
        $bank_list = array();
		$bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '','',''); 
        
        $expense_party_list = array();
		// $expense_party_list = $obj->getTableRecords($GLOBALS['expense_party_table'], '','',''); 
        
        $current_date = date("Y-m-d");
        $selected_payment_mode = "";
        
        $category_count = 0;
        $category_count = count($expense_category_list);

        $party_count = 0;
        $party_count = count($expense_party_list);

        $bank_count = 0;
        $bank_count = count($bank_list);

        $payment_mode_count = 0;
        $payment_mode_count = count($payment_mode_list);
       
        ?>

        <form class="poppins pd-20 redirection_form" name="expense_entry_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Expense Entry</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('expense_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
                <div class="row p-3 justify-content-center">
                    <input type="hidden" name="edit_id" value="<?php if(!empty($show_expense_entry_id)) { echo $show_expense_entry_id; } ?>">
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="form-group pb-1">
                            <div class="form-label-group in-border pb-1">
                                <input type="date" class="form-control shadow-none" name="expense_date" value="<?php if(!empty($expense_date)) { echo $expense_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                <label>Date</label>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="form-group pb-2">
                            <div class="form-label-group in-border mb-0">
                                <select name="expense_category_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:ExpenseCategoryChange();">
                                    <option value = "">Select Expense Category</option> <?php 
                                    if(!empty($expense_category_list)) {
                                        foreach($expense_category_list as $data) { ?>
                                            <option value="<?php if(!empty($data['expense_category_id'])) { echo $data['expense_category_id']; } ?>" <?php if(!empty($category_count) && $category_count == 1){ ?> selected <?php } ?>> <?php
                                                if(!empty($data['expense_category_name'])) {
                                                    echo $obj->encode_decode('decrypt', $data['expense_category_name']);
                                                } ?>
                                            </option> <?php
                                        }
                                    } ?>
                                </select>
                                <label>Expense Category (*)</label>
                            </div>
                        </div>        
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="form-group pb-2">
                            <div class="form-label-group in-border mb-0">
                                <select name="expense_party_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value = "">Select</option> <?php 
                                    if(!empty($expense_party_list)) {
                                        foreach($expense_party_list as $data) { ?>
                                            <option value="<?php if(!empty($data['expense_party_id'])) { echo $data['expense_party_id']; } ?>" <?php if(!empty($party_count) && $party_count == 1){ ?> selected <?php } ?>> <?php
                                                if(!empty($data['expense_party_name'])) {
                                                    echo $obj->encode_decode('decrypt', $data['expense_party_name']);
                                                } ?>
                                            </option> <?php
                                        }
                                    } ?>
                                </select>
                                <label>Expense Party</label>
                            </div>
                        </div>        
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="form-group mb-2">
                            <div class="form-label-group in-border">
                                <textarea class="form-control" id="" name="description" placeholder="Enter Your Description" onkeydown="return event.key !== 'Enter';"></textarea>
                                <label>Description (*)</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-3 justify-content-center">
                    <div class="col-lg-3 col-md-3 col-6 py-2">
                        <div class="form-group">
                            <div class="form-label-group in-border">
                                <select class="select2 select2-danger" name="selected_payment_mode_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);">
                                <option value="">Select Payment Mode</option> <?php
                                    if(!empty($payment_mode_list)) {
                                        foreach($payment_mode_list as $data) { ?>
                                            <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>" <?php if(!empty($payment_mode_count) && $payment_mode_count == 1){ ?> selected <?php } ?>> <?php

                                                $selected_payment_mode = $data['payment_mode_id'];

                                                if(!empty($data['payment_mode_name'])) {
                                                    $data['payment_mode_name'] = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                    echo $data['payment_mode_name'];
                                                } ?>
                                            </option> <?php
                                        }
                                    } ?>
                                </select>
                                <label>Payment Mode (*)</label>
                            </div>
                        </div>        
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 py-2 d-none" id="bank_list">
                        <div class="form-group">
                            <div class="form-label-group in-border">
                                <select name="selected_bank_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">Select Bank</option> <?php 
                                    if(!empty($bank_list)){
                                        foreach($bank_list as $col) { ?>
                                            <option value="<?php if(!empty($col['bank_id'])){echo $col['bank_id'];} ?>" <?php if(!empty($bank_id) && $col['bank_id'] == $bank_id || !empty($bank_count) && $bank_count == 1){ ?>selected<?php } ?>> <?php 
                                                if(!empty($col['bank_id'])){
                                                    echo "hello";
                                                    echo $obj->encode_decode('decrypt',$col['bank_name'])." - ".$obj->encode_decode('decrypt',$col['account_number']);
                                                } ?>
                                            </option> <?php
                                        }
                                    } ?>
                                </select>
                                <label>Select Bank</label>
                            </div>
                        </div>        
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 py-2">
                        <div class="form-group">
                            <div class="form-label-group in-border">
                                <input type="text" name="selected_amount"  class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number','',1);">
                                <label>Amount</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12 text-center py-2">
                        <button class="btn btn-success add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddPaymentRow();">
                            Add To Bill
                        </button>
                    </div> 
                </div>
                <div class="row justify-content-center pt-2"> 
                    <div class="col-lg-8">
                        <div class="table-responsive text-center">
                            <input type="hidden" name="payment_row_count" value="0">
                            <table class="table nowrap cursor smallfnt w-100 table-bordered payment_row_table">
                                <thead class="bg-dark">
                                    <tr style="white-space:pre;">
                                        <th>#</th>
                                        <th style="width:400px;">Payment Mode</th>
                                        <th style="width:200px;">Bank Name</th>
                                        <th style="width:200px;">Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total Amount : </th>
                                        <th class="overall_total"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 py-3 text-center">
                        <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'expense_entry_form', 'expense_entry_changes.php', 'expense_entry.php');">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/payment.js"></script>

            <script type="text/javascript">
                jQuery(document).ready(function(){
                    <?php 
                     if($payment_mode_count == 1){ ?>
                             getBankDetails('<?php if(!empty($selected_payment_mode)){ echo $selected_payment_mode; } ?>');
                    <?php } ?>
                    jQuery('.add_update_form_content').find('select').select2();
                    jQuery(".select2").on("select2:open", function () {
                        // Find the inner search field of the opened dropdown
                        var searchField = "";
                        searchField = document.querySelector(".select2-container--open .select2-search__field");
                        if (searchField) {
                            searchField.focus();
                        }
                    });
                    jQuery('input[name="selected_amount"]').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            if(jQuery('.add_payment_button').length > 0) {
                                jQuery('.add_payment_button').trigger('click');
                            }
                        }
                    });
                    ExpensePartyChange();
                });
            </script>
        </form> <?php
    } 

    if(isset($_POST['edit_id'])) {
        $expense_date = ""; $expense_date_error = ""; $expense_category_id = ""; $expense_category_id_error = "";
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $expense_category_name = ""; $description = ""; $description_error = "";  $balance_type=""; $balance_type_error=""; $selected_payment_mode_id = "";
        $form_name = "expense_entry_form"; $valid_expense = ""; $selected_amount = ""; $selected_amount_error = ""; $selected_bank_id = ""; $selected_payment_mode_id = ""; $selected_payment_mode_id_error = ""; $expense_party_id = "";

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        if(isset($_POST['expense_date'])){
            $expense_date = $_POST['expense_date'];
            $expense_date = trim($expense_date);
            $expense_date_error = $valid->valid_date($expense_date, 'Expense Entry Date', 1);
        }

        if(!empty($expense_date_error)) {
            $valid_expense = $valid->error_display($form_name, "expense_date", $expense_date_error, 'text');
        }

        if(isset($_POST['selected_payment_mode_id'])){
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(!empty($selected_payment_mode_id)){
            $payment_error = "Click Add Button to Append Payment";
        }

        if(isset($_POST['expense_category_id'])) {
			$expense_category_id = $_POST['expense_category_id'];
            $expense_category_id = trim($expense_category_id);
            $expense_category_id_error = $valid->common_validation($expense_category_id, 'expense category', 'select');

            if(!empty($expense_category_id_error)){
                if(!empty($valid_expense)) {
                    $valid_expense = $valid_expense." ".$valid->error_display($form_name, "expense_category_id", $expense_category_id_error, 'select');
                }
                else {
                    $valid_expense = $valid->error_display($form_name, "expense_category_id", $expense_category_id_error, 'select');
                }
            }
		}
        

        if(isset($_POST['description'])) {
            $description = $_POST['description'];
            $description = trim($description);
            $description_error = $valid->valid_address($description,'description','1','150');
        }
        if(!empty($description_error)) {
            if(!empty($valid_expense)) {
                $valid_expense = $valid_expense." ".$valid->error_display($form_name, "description", $description_error, 'textarea');
            }
            else {
                $valid_expense = $valid->error_display($form_name, "description", $description_error, 'textarea');
            }
        }

        if(isset($_POST['selected_amount'])) {
            $selected_amount = $_POST['selected_amount'];
        }

        if(isset($_POST['selected_payment_mode_id'])) {
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(isset($_POST['selected_bank_id'])) {
            $selected_bank_id = $_POST['selected_bank_id'];
        }

        if(isset($_POST['payment_mode_id'])) {
            $payment_mode_ids = $_POST['payment_mode_id'];
            $payment_mode_ids = array_reverse($payment_mode_ids);
        }
        if(isset($_POST['bank_id'])) {
            $bank_ids = $_POST['bank_id'];
            $bank_ids = array_reverse($bank_ids);
        }
        if(isset($_POST['amount'])) {
            $amount = $_POST['amount'];
            $amount = array_reverse($amount);
        }
        if(!empty($payment_mode_ids)) {
            for($i=0; $i < count($payment_mode_ids); $i++) {
                $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                $payment_mode_names[$i] = $payment_mode_name;
                
                $bank_ids[$i] = trim($bank_ids[$i]);
                if(!empty($bank_ids[$i])) {
                    $bank_name = "";
                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                    if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                        $bank_names[$i] = $bank_name;
                    }
                    else {
                        $bank_names[$i] = "";
                    }
                }
                else {
                    $bank_ids[$i] = "";
                    $bank_names[$i] = "";
                }
                $amount[$i] = trim($amount[$i]);
                if(isset($amount[$i])) {
                    $amount_error = "";
                    $amount_error = $valid->valid_price($amount[$i], 'Amount', '1', '');
                    if(!empty($amount_error)) {
                        if(!empty($valid_expense)) {
                            $valid_expense = $valid_expense." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_expense = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }
            }
        }
        else {
            if(count($payment_mode_ids) <= 0) {
                $selected_payment_mode_id_error = $valid->common_validation($selected_payment_mode_id, 'payment mode', 'select');
    
                if(!empty($valid_receipt)) {
                    $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "selected_payment_mode_id", $selected_payment_mode_id_error, 'select');
                }
                else {
                    $valid_receipt = $valid->error_display($form_name, "selected_payment_mode_id", $selected_payment_mode_id_error, 'select');
                }
            }

            if(count($amount) == 0) {
                $selected_amount_error = $valid->common_validation($selected_amount, 'Amount', 'text');
    
                if(!empty($valid_receipt)) {
                    $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "selected_amount", $selected_amount_error, 'text');
                }
                else {
                    $valid_receipt = $valid->error_display($form_name, "selected_amount", $selected_amount_error, 'text');
                }
            }
        }

        if(isset($_POST['expense_party_id'])) {
            $expense_party_id = $_POST['expense_party_id'];
        }
        
        if(empty($valid_expense) && empty($payment_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
            $bill_company_id = $GLOBALS['bill_company_id'];
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($expense_date)) {
					$expense_date = date("Y-m-d", strtotime($expense_date));
				}
                if(!empty($expense_category_id)) {
                    $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $expense_category_id, 'expense_category_name');
                }
                else {
                    $expense_category_id = $GLOBALS['null_value'];
                    $expense_category_name = $GLOBALS['null_value'];
                }
                if(!empty($payment_mode_ids)) {
                    $payment_mode_ids = array_reverse($payment_mode_ids);
                    $payment_mode_ids = implode(',', $payment_mode_ids);
                }
                else {
                    $payment_mode_ids = $GLOBALS['null_value'];
                }
                if(!empty($payment_mode_names)) {
                    $payment_mode_names = array_reverse($payment_mode_names);
                    $payment_mode_names = implode(',', $payment_mode_names);
                }
                else {
                    $payment_mode_names = $GLOBALS['null_value'];
                }
                if(!empty($bank_ids)) {
                    $bank_ids = array_reverse($bank_ids);
                    $bank_ids = implode(',', $bank_ids);
                }
                else {
                    $bank_ids = $GLOBALS['null_value'];
                }
                if(!empty($bank_names)) {
                    $bank_names = array_reverse($bank_names);
                    $bank_names = implode(',', $bank_names);
                }
                else {
                    $bank_names = $GLOBALS['null_value'];
                }
                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(',', $amount);
                }
                else {
                    $amount = $GLOBALS['null_value'];
                }
                if(!empty($description)) {
                    $description = $obj->encode_decode('encrypt', $description);
                }
                else {
                    $description = $GLOBALS['null_value'];
                }

                if(empty($expense_party_id)) {
                    $expense_party_id = $GLOBALS['null_value'];
                } 
                
                if(empty($edit_id)) {	
                    $action = "";
					if(!empty($expense_category_name) && $expense_category_name != $GLOBALS['null_value']) {
						$action = "New Entry Created. Name - ".($obj->encode_decode('decrypt', $expense_category_name));
					}
					$null_value = $GLOBALS['null_value'];
					$columns = array('created_date_time', 'creator', 'creator_name', 'expense_id', 'expense_number', 'expense_date', 'expense_category_id', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'expense_party_id', 'deleted');
					$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'",  "'".$null_value."'", "'".$null_value."'", "'".$expense_date."'", "'".$expense_category_id."'", "'".$description."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'" . $expense_party_id . "'","'0'");
                    $expense_insert_id = $obj->InsertSQL($GLOBALS['expense_table'], $columns, $values, 'expense_id', 'expense_number', $action);		
                    if(preg_match("/^\d+$/", $expense_insert_id)) {								
                        $balance = 1;
                        $expense_id = $obj->getTableColumnValue($GLOBALS['expense_table'], 'id', $expense_insert_id, 'expense_id');
                        $expense_number = $obj->getTableColumnValue($GLOBALS['expense_table'], 'id', $expense_insert_id, 'expense_number');
                        $result = array('number' => '1', 'msg' => 'Expense Entry Successfully Created');						
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $expense_insert_id);
                    }
                }

                if(!empty($balance) && $balance == 1) {
                    
                    $bill_id = $expense_id; $bill_date = $expense_date;
                    $credit  = 0; $debit = 0; $bill_type ="Expense";
                    $bill_number = $expense_number; 
                    $party_type = "Expense";

                    if(!empty($payment_mode_ids)) {
                        $payment_mode_id = explode(',', $payment_mode_ids);
                        $payment_mode_id = array_reverse($payment_mode_id);
                    }

                    if(!empty($bank_ids)) {
                        $bank_id = explode(',', $bank_ids);
                        $bank_id = array_reverse($bank_id);
                    }

                    if(!empty($payment_mode_names)) {
                        $payment_mode_name = explode(',', $payment_mode_names);
                        $payment_mode_name = array_reverse($payment_mode_name);
                    }
                    if(!empty($bank_names)) {
                        $bank_name = explode(',', $bank_names);
                        $bank_name = array_reverse($bank_name);
                    }
           
                    if(!empty($amount)) {
                        $amounts = explode(',', $amount);
                        $amounts = array_reverse($amounts);
                    }

                    if(!empty($payment_mode_id)){
                        for($i = 0; $i < count($payment_mode_id); $i++) {

                            // if($payment_mode_id[$i])
                            $debit = $amounts[$i];
                            $credit = 0;

                            if(empty($bank_id[$i])){
                                $bank_id[$i] =$GLOBALS['null_value'];
                            }
                            if(empty($bank_name[$i])){
                                $bank_name[$i] =$GLOBALS['null_value'];
                            }

                            $update_balance ="";
                            if(!empty($expense_party_id)) {
                                $expense_party_name = "";
                                $expense_party_name = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $expense_party_id, 'expense_party_name');
                                $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type, $null_value,$null_value,$expense_party_id,$expense_party_name,$party_type,$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],$credit,$debit,'');
                            } else {
                                $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type, $null_value,$null_value,$expense_category_id,$expense_category_name,$party_type,$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],$credit,$debit,'');
                            }
                        }
                    }
                    
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_expense)) {
				$result = array('number' => '3', 'msg' => $valid_expense);
			}
			else if(!empty($payment_error)) {
				$result = array('number' => '2', 'msg' => $payment_error);
			}
            
        }
        if(!empty($result)) {
			$result = json_encode($result);
		}
		echo $result; exit;
    }

    if(isset($_POST['page_number'])) {
        $page_number = $_POST['page_number'];
        $page_limit = $_POST['page_limit'];
        $page_title = $_POST['page_title']; 
        
        $search_text = ""; $from_date = ""; $to_date = "";

        $search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
            $search_text = trim($search_text);
		}

		$from_date = "";
		if(isset($_POST['from_date'])) {
			$from_date = $_POST['from_date'];
		}

		$to_date = "";
		if(isset($_POST['to_date'])) {
			$to_date = $_POST['to_date'];
		}

        $filter_expense_category_id = "";
		if(isset($_POST['filter_expense_category_id'])) {
			$filter_expense_category_id = $_POST['filter_expense_category_id'];
		}

		$show_bill = 0;
		if(isset($_POST['show_bill'])){
			$show_bill = $_POST['show_bill'];
		}

		$total_records_list = array();
		$total_records_list = $obj->getExpenseentryList($from_date, $to_date, $show_bill, $filter_expense_category_id);
        if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['expense_number']), $search_text) !== false) ) {
						$list[] = $val;
					}
				}
			}
			$total_records_list = $list;
		}
		
		$total_pages = 0;	
		$total_pages = count($total_records_list);
		
		$page_start = 0; $page_end = 0;
		if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
			if($total_pages > $page_limit) {
				if($page_number) {
					$page_start = ($page_number - 1) * $page_limit;
					$page_end = $page_start + $page_limit;
				}
			}
			else {
				$page_start = 0;
				$page_end = $page_limit;
			}
		}
		$show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
		
		$prefix = 0; 
		if(!empty($page_number) && !empty($page_limit)) {
			$prefix = ($page_number * $page_limit) - $page_limit;
		} 
        if($total_pages > $page_limit) { ?>
			<div class="pagination_cover mt-3"> <?php
				include("pagination.php"); ?> 
			</div> <?php 
        } 
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { ?>
    
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Expense Entry No / Date</th>
                        <th>Expense Category</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php 
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td> <?php
                                    if(!empty($list['expense_number'])) { echo $list['expense_number']." <br>".date("d-m-Y",strtotime($list['expense_date'])); } ?>
                                </td>
                                <td> <?php
                                    if(!empty($list['expense_category_id'])) {
                                        $expense_category_name = "";
                                        $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $list['expense_category_id'], 'expense_category_name');
                                        if(!empty($expense_category_name)) { 
                                            echo $obj->encode_decode("decrypt", $expense_category_name);
                                        }
                                    }
                                    if(!empty($list['deleted'] =='1')) { ?>
                                        <span style="color: red;">Cancelled</span> <?php	
                                    } ?>
                                </td>
                                <td> <?php 
                                    if(!empty($list['total_amount'])) { echo $obj->numberFormat($list['total_amount'], 2); } ?>
                                </td>
                                <td class="text-center px-2 py-2">
                                    <?php 
                                        $edit_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        $delete_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                    ?>
                                    <div class="dropdown">
                                        <a role="button" class="btn btn-dark show-button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" target="_blank" href="reports/rpt_expense_entry_a5.php?view_expense_id=<?php if(!empty($list['expense_id'])) { echo $list['expense_id']; } ?>&from="><i class="fa fa-print"></i> &ensp; Print</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="reports/rpt_expense_entry_a5.php?view_expense_id=<?php if(!empty($list['expense_id'])) { echo $list['expense_id']; } ?>&from=D"><i class="fa fa-download"></i> &ensp; Download</a></li> <?php 
                                            if(empty($list['deleted'])){ 

                                                if(empty($delete_access_error)) { ?>
                                                    <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['expense_id'])) { echo $list['expense_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li> <?php 
                                                }
                                            } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr> <?php
                        }
                    }
                    else { ?>
                        <tr>
                            <td colspan="5" class="text-center">Sorry! No records found</td>
                        </tr> <?php 
                    } ?>
                </tbody>
            </table> <?php	
        }
    }

    if(isset($_REQUEST['delete_expense_entry_id'])) {
        $delete_expense_entry_id = $_REQUEST['delete_expense_entry_id'];
        $msg = ""; $delete_id = "";
        if(!empty($delete_expense_entry_id)) {	
            $delete_id = $obj->DeletePayment($delete_expense_entry_id);
            $expense_unique_id = "";
            $expense_unique_id = $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_id', $delete_expense_entry_id, 'id');
            $expense_number= $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_id', $delete_expense_entry_id, 'expense_number');
            $action = "";
            if(!empty($expense_number)) {
                $action = "Expense Entry Deleted. Number - ".$expense_number;
            }
            $columns = array(); $values = array();						
            $columns = array('deleted');
            $values = array("'1'");
            $msg = $obj->UpdateSQL($GLOBALS['expense_table'], $expense_unique_id, $columns, $values, $action); 
        }
        echo $msg;
        exit;
    } ?>