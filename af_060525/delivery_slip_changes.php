<?php
	include("include.php");
    include("include_incharger_access.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['delivery_slip_module'];
        }
    }

    if(isset($_REQUEST['show_delivery_slip_id'])) { 
        $show_delivery_slip_id = $_REQUEST['show_delivery_slip_id'];

        $conversion_update = 0;
        if(isset($_REQUEST['conversion_update'])) {
            $conversion_update = $_REQUEST['conversion_update'];
        }
        $current_date = date('Y-m-d');
        $proforma_invoice_id = ""; $proforma_invoice_number = ""; $proforma_invoice_date = date('Y-m-d'); $customer_id = ""; $agent_id = ""; $transport_id = ""; $bank_id = ""; $magazine_type = ""; $magazine_id = ""; $gst_option = 0; $address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $indv_magazine_ids = array(); $product_names = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array(); $unit_names = array(); $quantity = array(); $old_quantity = array(); $rate = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array();$charges_type = array(); $other_charges_value = array(); $agent_commission = ""; $bill_total = ""; $charges_count = 0;

        if(!empty($show_delivery_slip_id)) {
            $delivery_slip_list = $obj->getDeliverySlipIndex($show_delivery_slip_id, $conversion_update);

            if(!empty($delivery_slip_list)) {
                $ds = $delivery_slip_list;
                if(!empty($ds['proforma_invoice_id'])) {
                    $proforma_invoice_id = $ds['proforma_invoice_id'];
                }
                if(!empty($ds['proforma_invoice_number'])) {
                    $proforma_invoice_number = $ds['proforma_invoice_number'];
                }
                if(!empty($ds['customer_id'])) {
                    $customer_id = $ds['customer_id'];
                }
                if(!empty($ds['proforma_invoice_date'])) {
                    $proforma_invoice_date = date('Y-m-d', strtotime($ds['proforma_invoice_date']));
                }
                if(!empty($ds['delivery_slip_date'])) {
                    $delivery_slip_date = date('Y-m-d', strtotime($ds['delivery_slip_date']));
                }
                if(!empty($ds['agent_id'])) {
                    $agent_id = $ds['agent_id'];
                }
                if(!empty($ds['transport_id'])) {
                    $transport_id = $ds['transport_id'];
                }
                if(!empty($ds['bank_id'])) {
                    $bank_id = $ds['bank_id'];
                }
                if(!empty($ds['magazine_type'])) {
                    $magazine_type = $ds['magazine_type'];
                }
                if(!empty($ds['magazine_id'])) {
                    $magazine_id = $ds['magazine_id'];
                }
                if(!empty($ds['gst_option'])) {
                    $gst_option = $ds['gst_option'];
                }
                if(!empty($ds['address'])) {
                    $address = $ds['address'];
                }
                if(!empty($ds['tax_option'])) {
                    $tax_option = $ds['tax_option'];
                }
                if(!empty($ds['tax_type'])) {
                    $tax_type = $ds['tax_type'];
                }
                if(!empty($ds['overall_tax'])) {
                    $overall_tax = $ds['overall_tax'];
                }
                if(!empty($ds['company_state'])) {
                    $company_state = $ds['company_state'];
                }
                if(!empty($ds['party_state'])) {
                    $party_state = $ds['party_state'];
                }

                if(!empty($ds['product_id'])) {
                    $product_ids = $ds['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($ds['indv_magazine_id'])) {
                    $indv_magazine_ids = $ds['indv_magazine_id'];
                    $indv_magazine_ids = explode(",", $indv_magazine_ids);
                    $indv_magazine_ids = array_reverse($indv_magazine_ids);
                }
                if(!empty($ds['product_name'])) {
                    $product_names = $ds['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($ds['unit_type'])) {
                    $unit_types = $ds['unit_type'];
                    $unit_types = explode(",", $unit_types);
                    $unit_types = array_reverse($unit_types);
                }
                if(!empty($ds['subunit_need'])) {
                    $subunit_needs = $ds['subunit_need'];
                    $subunit_needs = explode(",", $subunit_needs);
                    $subunit_needs = array_reverse($subunit_needs);
                }
                if(!empty($ds['content'])) {
                    $contents = $ds['content'];
                    $contents = explode(",", $contents);
                    $contents = array_reverse($contents);
                }
                if(!empty($ds['unit_id'])) {
                    $unit_ids = $ds['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($ds['unit_name'])) {
                    $unit_names = $ds['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    $unit_names = array_reverse($unit_names);
                }
                if(!empty($ds['quantity'])) {
                    $quantity = $ds['quantity'];
                    $quantity = explode(",", $quantity);
                    $quantity = array_reverse($quantity);
                }
                if(!empty($ds['quantity'])) {
                    $old_quantity = $ds['quantity'];
                    $old_quantity = explode(",", $old_quantity);
                    $old_quantity = array_reverse($old_quantity);
                }
                if(!empty($ds['rate'])) {
                    $rate = $ds['rate'];
                    $rate = explode(",", $rate);
                    $rate = array_reverse($rate);
                }       
                if(!empty($ds['per'])) {
                    $per = $ds['per'];
                    $per = explode(",", $per);
                    $per = array_reverse($per);
                }    
                if(!empty($ds['per_type'])) {
                    $per_type = $ds['per_type'];
                    $per_type = explode(",", $per_type);
                    $per_type = array_reverse($per_type);
                }     
                if(!empty($ds['product_tax'])) {
                    $product_tax = $ds['product_tax'];
                    $product_tax = explode(",", $product_tax);
                    $product_tax = array_reverse($product_tax);
                }     
                if(!empty($ds['final_rate'])) {
                    $final_rate = $ds['final_rate'];
                    $final_rate = explode(",", $final_rate);
                    $final_rate = array_reverse($final_rate);
                }      
                    
                if(!empty($ds['amount'])) {
                    $amount = $ds['amount'];
                    $amount = explode(",", $amount);
                    $amount = array_reverse($amount);
                }

                if(!empty($ds['other_charges_id'])) {
                    $other_charges_id = $ds['other_charges_id'];
                    $other_charges_id = explode(",", $other_charges_id);
                    $other_charges_id = array_reverse($other_charges_id);
                    $charges_count = count($other_charges_id);
                }      
                    
                if(!empty($ds['charges_type'])) {
                    $charges_type = $ds['charges_type'];
                    $charges_type = explode(",", $charges_type);
                    $charges_type = array_reverse($charges_type);
                } 
                if(!empty($ds['other_charges_value'])) {
                    $other_charges_value = $ds['other_charges_value'];
                    $other_charges_value = explode(",", $other_charges_value);
                    $other_charges_value = array_reverse($other_charges_value);
                }    
                if(!empty($ds['agent_commission'])) {
                    $agent_commission = $ds['agent_commission'];
                }              
            }

            if(!empty($conversion_update) && $conversion_update == '1') {
                $proforma_invoice_id = $show_delivery_slip_id;
            }
        }

        $customer_list = array();
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', '');
        $charges_list =array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');
        $agent_list =array();
        $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');
        $transport_list =array();
        $transport_list = $obj->getTableRecords($GLOBALS['transport_table'], '', '', '');
        $magazine_list = array();
        if(empty($login_user_factory_id) && empty($login_user_magazine_id) && empty($login_godown_id)) {
            $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        } else {
            if(!empty($login_user_factory_id)) {
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'factory_id', $login_user_factory_id, '');
            }
            if(!empty($login_user_magazine_id)) {
                $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], 'magazine_id', $login_user_magazine_id, '');
            }
        }
        $magazine_count = 0;
        $magazine_count = count($magazine_list);

        $other_charges_list = array();
        $other_charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');
        $bank_list =array();
        $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '', '', '');
        $product_list =array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
        $country = "India"; $state = "";
        $company_state = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'state');
        if(!empty($company_state)) {
			$company_state = $obj->encode_decode('decrypt', $company_state);
		}

        $proforma_products = array();
        if(!empty($proforma_invoice_id)) {
            $proforma_invoice_list = $obj->getTableRecords($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $proforma_invoice_id, '');

            if(!empty($proforma_invoice_list)) {
                foreach($proforma_invoice_list as $proforma) {
                    $pi_product_ids = explode(',', $proforma['product_id']);
                    $quantitys = explode(',', $proforma['quantity']);
                    if(!empty($pi_product_ids)) {
                        for($i = 0; $i < count($pi_product_ids); $i++) {
                            $proforma_products[$pi_product_ids[$i]] = ["product_id" => $pi_product_ids[$i], "quantity" => $quantitys[$i]];
                        }
                    }
                }
            }

            $ds_list = $obj->getTableRecords($GLOBALS['delivery_slip_table'], 'proforma_invoice_id', $proforma_invoice_id, '');

            if(!empty($ds_list)) {
                foreach($ds_list as $ds) {
                    $ds_product_ids = explode(',', $ds['product_id']);
                    $quantitys = explode(',', $ds['quantity']);
                    if(!empty($ds_product_ids)) {
                        for($i = 0; $i < count($ds_product_ids); $i++) {
                            if(!empty($proforma_products[$ds_product_ids[$i]]['quantity'])) {
                                $proforma_products[$ds_product_ids[$i]]['quantity'] = $proforma_products[$ds_product_ids[$i]]['quantity'] - $quantitys[$i];
                            }
                        }
                    }
                }
            }
        }
        
    ?>
        <form class="poppins pd-20 redirection_form" name="delivery_slip_form" method="POST">
            <div class="card-header">
                <div class="row p-2">
                    <div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <div class="h5"><?php if(!empty($proforma_invoice_id)) { echo "Convert Proforma Invoice To Delivery Slip"; } else { echo "Edit Delivery Slip"; } ?></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('proforma_invoice.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_delivery_slip_id) &&  $conversion_update == 0) { echo $show_delivery_slip_id; } ?>">   
                <input type="hidden" name="proforma_invoice_id" value="<?php if(!empty($proforma_invoice_id)) { echo $proforma_invoice_id; } ?>"> 
                <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } else { echo "Tamil Nadu"; } ?>">  
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="proforma_invoice_date" class="form-control shadow-none" placeholder="" value="<?php if (!empty($proforma_invoice_date)) { echo $proforma_invoice_date; } ?>" required="" readonly>
                            <label>Date</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" style="pointer-events: none; background-color: #e9ecef;">
                            <select name="agent_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getAgentCustomer(this.value);">
                                <option value="">Select</option>
                                <?php
                                    if(!empty($agent_list)) {
                                        foreach($agent_list as $data) {
                                            if(!empty($data['agent_id']) && $data['agent_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['agent_id']; ?>" <?php if(!empty($agent_id) && $data['agent_id'] == $agent_id) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Agent</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-3 col-md-3 col-12 px-lg-1 py-2">
                    <div class="form-group pb-1">
                        <div class="form-label-group in-border pb-1" style="pointer-events: none; background-color: #e9ecef;">
                            <select class="select2 select2-danger" name="customer_id" data-dropdown-css-class="select2-danger"
                                style="width: 100%;">
                                <option value="">Select Customer</option>
                                <?php if (!empty($customer_list)) {
                                    foreach ($customer_list as $customer) { ?>
                                        <option value="<?php if (!empty($customer['customer_id'])) {
                                            echo $customer['customer_id'];
                                        } ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { ?> selected <?php } ?>>
                                            <?php
                                                if(!empty($customer['name_mobile_city']) && $customer['name_mobile_city'] != $GLOBALS['null_value']) {
                                                    echo html_entity_decode($obj->encode_decode('decrypt', $customer['name_mobile_city']));
                                                }
                                            ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Customer<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" style="pointer-events: none; background-color: #e9ecef;">
                            <select class="select2 select2-danger" name="transport_id" data-dropdown-css-class="select2-danger"
                                        style="width: 100%;">
                                <option value="">Select Transport</option>
                                <?php if (!empty($transport_list)) {
                                    foreach ($transport_list as $list) { ?>
                                        <option value="<?php if (!empty($list['transport_id'])) {
                                            echo $list['transport_id'];
                                        } ?>" <?php if(!empty($transport_id) && $transport_id == $list['transport_id']) { echo "selected"; } ?>>
                                            <?php if (!empty($list['transport_name'])) {
                                                echo $obj->encode_decode('decrypt', $list['transport_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Transport</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" style="pointer-events: none; background-color: #e9ecef;">
                            <select class="select2 select2-danger" name="bank_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Bank</option>
                                <?php if (!empty($bank_list)) {
                                    foreach ($bank_list as $list) { ?>
                                        <option value="<?php if (!empty($list['bank_id'])) {
                                            echo $list['bank_id'];
                                        } ?>" <?php if(!empty($bank_id) && $bank_id == $list['bank_id']) { echo "selected"; } ?>>
                                            <?php if (!empty($list['bank_name'])) {
                                                echo $obj->encode_decode('decrypt', $list['bank_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Bank<span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" id="div_selected_magazine_type">
                            <select class="select2 select2-danger" name="magazine_type" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:magazineList();">
                                <option value="">Magazie Type</option>
                                <option value="1" <?php if(!empty($magazine_type) && $magazine_type == '1') { ?> selected <?php } ?>>Overall Magazie</option>
                                <option value="2" <?php if(!empty($magazine_type) && $magazine_type == '2') { ?> selected <?php } ?>>Productwise Magazie</option>
                            </select>
                            <label>Select Magazine<span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 overall_magazine <?php if(empty($magazine_type) || $magazine_type == '2') { ?> d-none <?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border" id="div_selected_magazine_id">
                            <select class="select2 select2-danger" name="magazine_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:magazineList();">
                                <option value="">Select Magazine</option>
                                <?php if (!empty($magazine_list)) {
                                    foreach ($magazine_list as $list) { ?>
                                        <option value="<?php if (!empty($list['magazine_id'])) {
                                            echo $list['magazine_id'];
                                        } ?>" <?php if(!empty($magazine_id) && $magazine_id == $list['magazine_id'] || (!empty($magazine_count) && $magazine_count == 1)) { echo "selected"; } ?>>
                                            <?php if (!empty($list['magazine_name'])) {
                                                echo $obj->encode_decode('decrypt', $list['magazine_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Magazine</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2 d-none">
                    <div class="form-group">
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="FormSelectDefault" class="form-label text-muted smallfnt">GST  ON / OFF</label>
                                <input id="gst_option" class="form-check-input code-switcher" name="gst_option" value="<?php if($gst_option == '1'){ echo $gst_option; } ?>" <?php if($gst_option == '1'){ ?>checked<?php } ?> type="checkbox" id="FormSelectDefault">
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-4 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address" readonly><?php if(!empty($address)) { echo $address; } ?></textarea>
                            <label>Delivery Address</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 d-none tax_cover1" id="tax_option_div">
                    <div class="form-group">
                        <div class="form-label-group in-border" style="pointer-events: none; background-color: #e9ecef;">
                            <select class="select2 select2-danger" name="tax_option" data-dropdown-css-class="select2-danger" style="width: 100%!important;"  onchange="Javascript:getRateByTaxOption();">
                                <!-- <option value="">Select</option> -->
                                <option value="1" <?php if($tax_option == '1'){ ?>selected<?php } ?>>Exclusive Tax</option>
                                <option value="2" <?php if($tax_option == '2'){ ?>selected<?php } ?>>Inclusive Tax</option>
                            </select>
                            <label>Tax Option</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 tax_cover d-none">
                    <div class="form-group">
                        <div class="form-label-group in-border" style="pointer-events: none; background-color: #e9ecef;">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="tax_type" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);">
                                <option value="">Select Tax Type</option>
                                <option value="1" <?php if($tax_type == '1'){ ?>selected<?php } ?>>Product</option>
                                <option value="2" <?php if($tax_type == '2'){ ?>selected<?php } ?>>Overall</option>
                            </select>
                            <label>Tax Type</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-2 col-md-3 col-6 py-2 d-none tax_cover2">
                    <div class="form-group">
                        <div class="form-label-group in-border" style="pointer-events: none; background-color: #e9ecef;">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="overall_tax" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);">
                                <option value="">Select Tax</option>
                                <option value="0%" <?php if($overall_tax == '0%'){ ?>selected<?php } ?>>0%</option>
                                <option value="5%" <?php if($overall_tax == '5%'){ ?>selected<?php } ?>>5%</option>
                                <option value="12%" <?php if($overall_tax == '12%'){ ?>selected<?php } ?>>12%</option>
                                <option value="18%" <?php if($overall_tax == '18%'){ ?>selected<?php } ?>>18%</option>
                                <option value="28%" <?php if($overall_tax == '28%'){ ?>selected<?php } ?>>28%</option>
                            </select>
                            <label>Tax</label>
                        </div>
                    </div> 
                </div>                   
            </div>               
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                        <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } ?>">

                        <table class="table nowrap cursor text-center table-bordered smallfnt w-100 proforma_invoice_table">
                            <thead class="bg-dark">
                                <tr style="white-space:pre;">
                                    <th style="width: 100px;">#</th>
                                    <th style="width: 150px;">Product</th>
                                    <th style="width: 100px;" class="indv_magazine <?php if(empty($magazine_type) || ($magazine_type == 1)) { echo "d-none"; } ?>">Magazine</th>
                                    <th style="width: 100px;">Type</th>
                                    <th style="width: 100px;">QTY</th>
                                    <th style="width: 100px;">Content</th>
                                    <?php /*
                                    <th style="width: 100px;">Rate</th>
                                    <th style="width: 150px;">Per</th>
                                    <th class="tax_element d-none" style="width: 70px;">Tax</th>
                                    <th style="width: 70px;">Final Rate</th>
                                    <th style="width: 100px;">Amount</th>
                                    */ ?>
                                    <th  style="width: 70px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($product_ids)){
                                        $product_count = 0;
                                        $product_count = count($product_ids);

                                        for($i = 0; $i < $product_count; $i++){
                                            ?>
                                            <tr class="product_row" id="product_row<?php echo $i; ?>">
                                                <th class="text-center px-2 py-2 sno"><?php echo ($i+1); ?></th>
                                                <th class="text-center px-2 py-2">
                                                    <?php
                                                        if(!empty($product_ids[$i])) {
                                                            $product_name = "";
                                                            $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                                                            if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $product_name);
                                                            }
                                                        }
                                                    ?>
                                                    <input type="hidden" name="product_id[]" value="<?php if(!empty($product_ids[$i])) { echo $product_ids[$i]; } ?>"><br>
                                                </th>
                                                <th class="text-center px-2 py-2 indv_magazine <?php if(empty($magazine_type) || ($magazine_type == 1)) { echo "d-none"; }?>">
                                                    <div class="form-group">
                                                        <div class="form-label-group in-border">
                                                            <select class="select2 select2-danger" name="indv_magazine_id[]" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                                <option value="">Select Magazine</option>
                                                                <?php if (!empty($magazine_list)) {
                                                                    foreach ($magazine_list as $list) { ?>
                                                                        <option value="<?php if (!empty($list['magazine_id'])) {
                                                                            echo $list['magazine_id'];
                                                                        } ?>" <?php if(!empty($indv_magazine_ids[$i]) && $indv_magazine_ids[$i] == $list['magazine_id'] ||  (!empty($magazine_count) && $magazine_count == 1)) { echo "selected"; } ?>>
                                                                            <?php if (!empty($list['magazine_name'])) {
                                                                                echo $obj->encode_decode('decrypt', $list['magazine_name']);
                                                                            } ?>
                                                                        </option>
                                                                    <?php }
                                                                } ?>
                                                            </select>
                                                            <label>Select Magazine</label>
                                                        </div>
                                                    </div> 
                                                </th>
                                                <th class="text-center px-2 py-2">
                                                    <?php if(!empty($unit_types[$i]) && $unit_types[$i] == '1'){
                                                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_id');
                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');
                                                    }
                                                    elseif(!empty($unit_types[$i]) && $unit_types[$i] == '2')
                                                    {
                                                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_id');
                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_name');
                                                        
                                                    }

                                                    if(!empty($unit_name) && $unit_name !='NULL')
                                                    {
                                                        echo $unit_name = $obj->encode_decode("decrypt",$unit_name);
                                                    }
                                                    ?>
                                                    <input type="hidden" name="unit_type[]" class="form-control shadow-none" value="<?php if(!empty($unit_types[$i])) { echo $unit_types[$i]; } ?>">
                                                    <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_id)) { echo $unit_ids[$i]; } ?>">
                                                    <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>" >
                                                    <input type="hidden" name="subunit_need[]" class="form-control shadow-none" value="<?php if(!empty($subunit_needs[$i])) { echo $subunit_needs[$i]; } ?>" >
                                                </th>
                                                <th class="text-center px-2 py-2">
                                                    <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                                    <input type="hidden" name="old_quantity[]" class="form-control shadow-none" value="<?php if(!empty($proforma_products[$product_ids[$i]]['quantity'])) { echo $proforma_products[$product_ids[$i]]['quantity']; } ?>">
                                                    </th>
                                                <th class="text-center px-2 py-2">
                                                    <input type="hidden" name="content[]" class="form-control shadow-none" value="<?php if(!empty($contents[$i]) && $contents[$i] != "NULL") { echo $contents[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                                    <?php if(!empty($contents[$i]) && $contents[$i] != "NULL") { echo $contents[$i]; } ?>
                                                </th>
                                                <td class="d-none">
                                                    <div class="form-group mb-1">
                                                        <div class="form-label-group in-border">
                                                            <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width:65px;" value="<?php if(!empty($rate[$i])){ echo $rate[$i]; }?>" required>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td class="d-none">
                                                    <?php
                                                        $per_unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');
                                                        $per_subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_name');
                                                    ?>
                                                    <input type="hidden" id="" name="per[]" value="<?php if(!empty($per[$i])){ echo $per[$i]; }?>" class="form-control shadow-none" onkeyup="ProductRowCheck(this);">
                                                    <input type="hidden" id="" name="per_type[]" value="<?php if(!empty($per_type[$i])){ echo $per_type[$i]; }?>">
                                                    <?php if(!empty($per[$i]) && !empty($per_type[$i])){
                                                        echo $per[$i]." ".$obj->encode_decode("decrypt", $per_unit_name);
                                                    } ?>
                                                </td>
                                                <?php if(!empty($product_tax[$i])) { ?>
                                                    <td class="tax_element d-none">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border mb-0">
                                                                <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);">
                                                                    <option value="">Select Tax</option>
                                                                    <option value="0%" <?php if($product_tax[$i] == "0%") {?> selected <?php } ?> >0%</option>
                                                                    <option value="5%" <?php if($product_tax[$i] == "5%") {?> selected <?php } ?> >5%</option>
                                                                    <option value="12%" <?php if($product_tax[$i] == "12%") {?> selected <?php } ?> >12%</option>
                                                                    <option value="18%" <?php if($product_tax[$i] == "18%") {?> selected <?php } ?> >18%</option>
                                                                    <option value="28%" <?php if($product_tax[$i] == "28%") {?> selected <?php } ?> >28%</option>
                                                                </select>
                                                                <label>Select Tax</label>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                <?php } ?>
                                                <td class="d-none">
                                                    <p class="final_rate"><?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?></p>
                                                    <input type="hidden" id="final_rate[]" name="final_rate[]" value="<?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <td class="d-none">
                                                    <p class="amount"><?php if(!empty($amount[$i])){ echo $amount[$i]; }?></p>
                                                    <input type="hidden" id="amount[]" name="amount[]" value="<?php if(!empty($amount[$i])){ echo $amount[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <th class="text-center px-2 py-2">
                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php echo $i;?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                </th>
                                            </tr>       
                                            <script src="include/select2/js/select2.min.js"></script>
                                            <script src="include/select2/js/select.js"></script>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                            <?php /*
                            <tfoot>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end sub_tot"> Total : </td>
                                    <td colspan="1" class="text-end sub_total"></td>
                                </tr>
                                <input type="hidden" name="charges_count" value="<?php if(!empty($charges_count)) { echo $charges_count - 1; } else { echo '0'; } ?>">
                                <?php 
                                    $count = 1;
                                    if(!empty($other_charges_id) && !empty($show_proforma_invoice_id)) {
                                        for($i=0; $i < count($other_charges_id); $i++) {
                                            ?>
                                                <tr class="smallfnt1 charges_row" id="charges_row_<?php if(!empty($count)) { echo $count; } else { echo '0'; } ?>">
                                                    <td class="charges_head" colspan="6"></td>
                                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>4<?php }else{ ?>3<?php }?>">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border mb-0">
                                                                <select name="other_charges_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:GetChargesType(this);">
                                                                    <option value="">Select Charges</option>
                                                                    <?php 
                                                                        if(!empty($other_charges_list)) {
                                                                            foreach($other_charges_list as $data) {
                                                                                if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                                                    ?>
                                                                                    <option value="<?php echo $data['charges_id']; ?>" <?php if(!empty($other_charges_id[$i]) && $other_charges_id[$i] == $data['charges_id']) { ?>selected<?php } ?>>
                                                                                        <?php
                                                                                            if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                                                echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                                                                if($data['action'] == 'minus') {
                                                                                                    echo " (-)";
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label>Select Charges</label>
                                                            </div>
                                                            <input type="hidden" name="charges_type[]" value="<?php if(!empty($charges_type[$i]) && $charges_type[$i] != "NULL") { echo $charges_type[$i]; } ?>">
                                                        </div> 
                                                    </td>
                                                    <td colspan="1"> 
                                                        <div class="d-flex">
                                                            <input type="text" class="form-control me-2" style="width: 85px;" name="other_charges_value[]" value="<?php if(!empty($other_charges_value[$i]) && $other_charges_value[$i] != "NULL") { echo $other_charges_value[$i]; } ?>" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                                                            <?php if($i == '0') { ?>
                                                                <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:AddChargesRow(this);"><i class="bi bi-plus fw-bold text-white"></i></button>
                                                            <?php } else { ?>
                                                                <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:DeleteChargesRow(this,'<?php echo $count; ?>');"><i class="bi bi-trash fw-bold text-white"></i></button>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                    <td colspan="1">
                                                        <div class="text-end"><span class="other_charges_total text-end"></span></div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr class="charges_row" id="charges_row_total_<?php if(!empty($count)) { echo $count; } else { echo '0'; } ?>">
                                                    <td colspan="10" class="text-end charges_sub">Total :</td>
                                                    <td colspan="1" class="text-end charges_sub_total"></td>
                                                </tr>
                                            <?php
                                            $charges_count --;
                                            $count++;
                                        }
                                    } else {
                                        ?>
                                        <tr class="smallfnt1 charges_row" id="charges_row_1">  
                                            <td class="charges_head" colspan="4"></td>
                                            <td colspan="3">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border mb-0">
                                                        <select name="other_charges_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:GetChargesType(this);">
                                                            <option value="">Select Charges</option>
                                                            <?php 
                                                                if(!empty($other_charges_list)) {
                                                                    foreach($other_charges_list as $data) {
                                                                        if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                                            ?>
                                                                            <option value="<?php echo $data['charges_id']; ?>">
                                                                                <?php
                                                                                    if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                                                        if($data['action'] == 'minus') {
                                                                                            echo " (-)";
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <label>Select Charges</label>
                                                    </div>
                                                    <input type="hidden" name="charges_type[]" value="">
                                                </div> 
                                            </td>
                                            <td colspan="1"> 
                                                <div class="d-flex">
                                                    <input type="text" class="form-control me-2" style="width: 85px;" id="" name="other_charges_value[]" value="" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                                                    <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:AddChargesRow(this);"><i class="bi bi-plus fw-bold text-white"></i></button>
                                                </div>
                                            </td>
                                            <td colspan="1">
                                                <div class="other_charges_total text-end"></div>
                                            </td>
                                        </tr>
                                        <tr class="charges_row" id="charges_row_total_1">
                                            <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end charges_sub">Total :</td>
                                            <td colspan="1" class="text-end charges_sub_total"></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                <tr class="d-none">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end cgst">CGST :</td>
                                    <td class="text-end cgst_value"></td>
                                </tr>
                                <tr class="d-none">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end sgst">SGST :</td>
                                    <td class="text-end sgst_value"></td>
                                </tr>
                                <tr class="d-none">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end igst">IGST :</td>
                                    <td class="text-end igst_value"></td>
                                </tr>
                                <tr class="d-none">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end total_tax">Total Tax :</td>
                                    <td class="text-end total_tax_value"></td>
                                </tr>
                                <tr style="color:green;" class="agent_tr <?php if(empty($agent_id) || $agent_id == "NULL"){ ?>d-none<?php } ?>">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end agent_commission">
                                        Commission : <?php if(!empty($agent_commission)){ echo $agent_commission;}?>
                                    </td>
                                    <input type="hidden" name="agent_commission" value="<?php if(!empty($agent_commission)){ echo $agent_commission; }?>">
                                    <td class="text-end ">
                                        <span class="commission_total"><?php if(!empty($agent_commission_value)){ echo $agent_commission_value; }?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end round">Round OFF :</td>
                                    <td colspan="1" class="text-end round_off"></td>
                                </tr>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end grand_total">Total :</td>
                                    <td colspan="2" class="text-end"><i class="bi bi-currency-rupee text-danger me-2"></i><span class="overall_total"></span></td>
                                </tr>
                            </tfoot>
                            */ ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'delivery_slip_form', 'delivery_slip_changes.php', 'delivery_slip.php');">
                        Submit
                    </button>
                </div>
            </div>
        </form>       
        <script>
            jQuery(document).ready(function(){
                <?php if(!empty($show_delivery_slip_id)) { ?> calTotal(); <?php }?>
            });
        </script>                    
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
    <?php 
    }

    if(isset($_POST['edit_id'])) {
        // Strings
        $proforma_invoice_id = ""; $proforma_invoice_date = ""; $proforma_invoice_date_error = ""; $proforma_invoice_number = ""; $proforma_invoice_number_error = "";  $customer_id = ""; $customer_id_error = "";  $agent_id = ""; $agent_id_error = ""; $transport_id = ""; $bank_id = ""; $bank_id_error = "";  $valid_delivery_slip = "";  $edit_id = ""; $delivery_slip_error = ""; $draft = "0"; $price_type_error = ""; $price_type = ""; $gst_option = ""; $address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $product_count = ""; $charges_count = ""; $agent_commission = ""; $company_state = ""; $party_state = ""; $product_error = "";  $magazine_type = ""; $magazine_type_error = "";  $magazine_id = ""; $magazine_id_error = ""; $delivery_slip_id = ""; $delivery_slip_number = ""; $delivery_slip_date = date('Y-m-d');
        
        // Arrays
        $product_ids = array(); $unit_types = array(); $unit_ids = array(); $unit_names = array(); $subunit_need = array(); $quantity = array(); $old_quantity = array(); $contents = array(); $rates = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array(); $charges_type = array(); $other_charges_values = array();$other_charges_total = array(); $product_names = array(); $indv_magazine_id = array();
       
        // Doubles
        $total_amount = 0; $round_off = 0; $grand_total = 0; $total_unit_qty = 0; $sub_total = 0; $total_tax_value = 0;
       
        // Statics
        $form_name = "delivery_slip_form"; $current_date = date('Y-m-d'); 

        function combineAndSumUp ($myArray) {
            $finalArray = Array ();
            foreach ($myArray as $nkey => $nvalue) {
                $has = false;
                $fk = false;
                foreach ($finalArray as $fkey => $fvalue) {
                    if(($fvalue['godown_id'] == $nvalue['godown_id']) && ($fvalue['product_id'] == $nvalue['product_id'])  && ($fvalue['content'] == $nvalue['content'])) {    
                        $has = true;
                        $fk = $fkey;
                        break;
                    }
                }
    
                if($has === false) {
                    $finalArray[] = $nvalue;
                } else {
                    $finalArray[$fk]['product_id'] = $nvalue['product_id'];
                    $finalArray[$fk]['content'] = $nvalue['content'];
                    $finalArray[$fk]['quantity'] += $nvalue['quantity'];
                }
            }
            return $finalArray;
        }

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['proforma_invoice_id'])) {
            $proforma_invoice_id = $_POST['proforma_invoice_id'];
            $proforma_invoice_id = trim($proforma_invoice_id);
        }

        if(isset($_POST['proforma_invoice_date'])) {
            $proforma_invoice_date = $_POST['proforma_invoice_date'];
            $proforma_invoice_date = trim($proforma_invoice_date);
            $proforma_invoice_date_error = $valid->valid_date($proforma_invoice_date, 'Bill Date', '1');
            if(empty($proforma_invoice_date_error)) {
                if($proforma_invoice_date > $current_date) {
                    $proforma_invoice_date_error = "Future Date not allowed";
                }
            }
        }

        if(!empty($proforma_invoice_date_error)) {
            if(!empty($valid_delivery_slip)) {
                $valid_delivery_slip = $valid_delivery_slip." ".$valid->error_display($form_name, "proforma_invoice_date", $proforma_invoice_date_error, 'text');
            }
            else {
                $valid_delivery_slip = $valid->error_display($form_name, "proforma_invoice_date", $proforma_invoice_date_error, 'text');
            }
        }

        if(isset($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
            $customer_id = trim($customer_id);
            $customer_id_error = $valid->common_validation($customer_id, 'Customer', 'select');
        }

        if(!empty($customer_id_error)) {
            if(!empty($valid_delivery_slip)) {
                $valid_delivery_slip = $valid_delivery_slip." ".$valid->error_display($form_name, "customer_id", $customer_id_error, 'select');
            }
            else {
                $valid_delivery_slip = $valid->error_display($form_name, "customer_id", $customer_id_error, 'select');
            }
        }

        if(isset($_POST['agent_id'])) {
            $agent_id = $_POST['agent_id'];
            $agent_id = trim($agent_id);
            if(!empty($agent_id)) {
                $agent_id_error = $valid->common_validation($agent_id, 'Agent', 'select');
            }
        }

        if(!empty($agent_id_error)) {
            if(!empty($valid_delivery_slip)) {
                $valid_delivery_slip = $valid_delivery_slip." ".$valid->error_display($form_name, "agent_id", $agent_id_error, 'select');
            }
            else {
                $valid_delivery_slip = $valid->error_display($form_name, "agent_id", $agent_id_error, 'select');
            }
        }

        if(isset($_POST['transport_id'])) {
            $transport_id = $_POST['transport_id'];
            $transport_id = trim($transport_id);
        }

        if(isset($_POST['bank_id'])) {
            $bank_id = $_POST['bank_id'];
            $bank_id = trim($bank_id);
            $bank_id_error = $valid->common_validation($bank_id, 'Bank', 'select');
        }

        if(!empty($bank_id_error)) {
            if(!empty($valid_delivery_slip)) {
                $valid_delivery_slip = $valid_delivery_slip." ".$valid->error_display($form_name, "bank_id", $bank_id_error, 'select');
            }
            else {
                $valid_delivery_slip = $valid->error_display($form_name, "bank_id", $bank_id_error, 'select');
            }
        }

        if(isset($_POST['magazine_type'])) {
            $magazine_type = $_POST['magazine_type'];
            $magazine_type = trim($magazine_type);
            $magazine_type_error = $valid->common_validation($magazine_type, 'Magazine Type', 'select');
        }

        if(!empty($magazine_type_error)) {
            if(!empty($valid_delivery_slip)) {
                $valid_delivery_slip = $valid_delivery_slip." ".$valid->error_display($form_name, "magazine_type", $magazine_type_error, 'select');
            }
            else {
                $valid_delivery_slip = $valid->error_display($form_name, "magazine_type", $magazine_type_error, 'select');
            }
        }
        
        if(isset($_POST['magazine_id'])) {
            $magazine_id = $_POST['magazine_id'];
            $magazine_id = trim($magazine_id);
            if(!empty($magazine_type)){
                if($magazine_type == 1){
                    $magazine_id_error = $valid->common_validation($magazine_id, 'Magazine', 'select');
                }
            }
        }

        if(!empty($magazine_id_error)) {
            if(!empty($valid_delivery_slip)) {
                $valid_delivery_slip = $valid_delivery_slip." ".$valid->error_display($form_name, "magazine_id", $magazine_id_error, 'select');
            }
            else {
                $valid_delivery_slip = $valid->error_display($form_name, "magazine_id", $magazine_id_error, 'select');
            }
        }

        if(isset($_POST['gst_option'])){
            $gst_option = $_POST['gst_option'];
            $gst_option = trim($gst_option);
            $gst_option_error = $valid->common_validation($gst_option, 'GST option', 'select');
            if(empty($gst_option_error)) {
                if($gst_option != '1' && $gst_option != '2') {
                    $gst_option_error = "Invalid GST option";
                }
            }
        }
        
        if(!empty($gst_option_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            } else {
                $valid_purchase = $valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
        }

        if($gst_option == '1') {
            $tax_type = $_POST['tax_type'];
            $tax_type = trim($tax_type);
            $tax_type_error = $valid->common_validation($tax_type, 'Tax Type', 'select');
            if(empty($tax_type_error)) {
                if($tax_type != '1' && $tax_type != '2') {
                    $tax_type_error = "Invalid Tax Type";
                }
            }
            if(!empty($tax_type_error)) {
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                } else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
            }

            $tax_option = $_POST['tax_option'];
            $tax_option = trim($tax_option);
            $tax_option_error = $valid->common_validation($tax_option, 'Tax Option', 'select');
            if(empty($tax_option_error)) {
                if($tax_option != '1' && $tax_option != '2') {
                    $tax_option_error = "Invalid Tax Option";
                }
            }
            if(!empty($tax_option_error)) {
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                } else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
            }

            if($tax_type == '2') {
                if(isset($_POST['overall_tax'])) {
                    $overall_tax = $_POST['overall_tax'];
                    $overall_tax = trim($overall_tax);
                }
            }
        } else {
            $overall_tax = $GLOBALS['null_value']; 
        }

        if(isset($_POST['address'])) {
            $address = $_POST['address'];
            $address = trim($address);
        }

        if(isset($_POST['company_state'])) {
            $company_state = $_POST['company_state'];
            $company_state = trim($company_state);
        }

        if(isset($_POST['party_state'])) {
            $party_state = $_POST['party_state'];
            $party_state = trim($party_state);
        }

        if(isset($_POST['product_count'])) {
            $product_count = $_POST['product_count'];
            $product_count = trim($product_count);
        }

        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
            $product_ids = array_reverse($product_ids);
        }

        if(isset($_POST['unit_type'])) {
            $unit_types = $_POST['unit_type'];
            $unit_types = array_reverse($unit_types);
        }

        if(isset($_POST['unit_id'])) {
            $unit_ids = $_POST['unit_id'];
            $unit_ids = array_reverse($unit_ids);
        }

        if(isset($_POST['unit_name'])) {
            $unit_names = $_POST['unit_name'];
            $unit_names = array_reverse($unit_names);
        }

        if(isset($_POST['subunit_need'])) {
            $subunit_need = $_POST['subunit_need'];
            $subunit_need = array_reverse($subunit_need);
        }

        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
            $quantity = array_reverse($quantity);
        }

        if(isset($_POST['old_quantity'])) {
            $old_quantity = $_POST['old_quantity'];
            $old_quantity = array_reverse($old_quantity);
        }

        if(isset($_POST['indv_magazine_id'])) {
            $indv_magazine_id = $_POST['indv_magazine_id'];
            if(!empty($indv_magazine_id)){
                $indv_magazine_id = array_reverse($indv_magazine_id);
            }
        }

        if(isset($_POST['content'])) {
            $contents = $_POST['content'];
            $contents = array_reverse($contents);
        }

        if(isset($_POST['rate'])) {
            $rates = $_POST['rate'];
            $rates = array_reverse($rates);
        }

        if(isset($_POST['per'])) {
            $per = $_POST['per'];
            $per = array_reverse($per);
        }

        if(isset($_POST['per_type'])) {
            $per_type = $_POST['per_type'];
            $per_type = array_reverse($per_type);
        }

        if(isset($_POST['product_tax'])) {
            $product_tax = $_POST['product_tax'];
            $product_tax = array_reverse($product_tax);
        }

        if(isset($_POST['final_rate'])) {
            $final_rate = $_POST['final_rate'];
            $final_rate = array_reverse($final_rate);
        }

        if(isset($_POST['amount'])) {
            $amount = $_POST['amount'];
            $amount = array_reverse($amount);
        }

        if(isset($_POST['charges_count'])) {
            $charges_count = $_POST['charges_count'];
            $charges_count = trim($charges_count);
        }

        if(isset($_POST['other_charges_id'])) {
            $other_charges_id = $_POST['other_charges_id'];
            $other_charges_id = array_reverse($other_charges_id);
        }

        if(isset($_POST['charges_type'])) {
            $charges_type = $_POST['charges_type'];
            $charges_type = array_reverse($charges_type);
        }   
        
        if(isset($_POST['other_charges_value'])) {
            $other_charges_values = $_POST['other_charges_value'];
            $other_charges_values = array_reverse($other_charges_values);
        }   

        if(isset($_POST['agent_commission'])) {
            $agent_commission = $_POST['agent_commission'];
            $agent_commission = trim($agent_commission);
        }

        $rate_per_cases =array(); $rate_per_pieces =array(); $final_rate =array(); $rate_per_unit =array();
        if(!empty($product_ids)) {
            for($i = 0; $i < count($product_ids); $i++) {
                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;

                    $unit_ids[$i] = trim($unit_ids[$i]);
                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                    $unit_names[$i] = $unit_name; 
                    $quantity[$i] = trim($quantity[$i]);
                    $old_quantity[$i] = trim($old_quantity[$i]);

                    $sub_unit_id = "";
                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');

                    if(!empty($magazine_type) && ($magazine_type == 1 || !empty($indv_magazine_id[$i]))){
                        if(!empty($quantity[$i])) {
                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) {
                                if($quantity[$i] <= $old_quantity[$i]) {
                                    $unit_types[$i] = trim($unit_types[$i]);
                                    if(!empty($unit_types[$i])) {
                                        $contents[$i] = trim($contents[$i]);
                                        if(!empty($contents[$i]) || (empty($sub_unit_id) || $sub_unit_id == "NULL")) {
                                            // if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $contents[$i]) && $contents[$i] <= 99999) {
                                                if($unit_types[$i] == '1' && $sub_unit_id != "NULL") {
                                                    $total_qty[$i] = $quantity[$i] * $contents[$i];
                                                } else {
                                                    $total_qty[$i] = $quantity[$i];
                                                }
            
                                                $rates[$i] = trim($rates[$i]);
                                                if(!empty($rates[$i])) {
                                                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $rates[$i]) && $rates[$i] <= 99999) {
                                                        $per[$i] = trim($per[$i]);
                                                        if(!empty($per[$i])) {
                                                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $per[$i]) && $per[$i] <= 99999) {
                                                            $per_type[$i] = trim($per_type[$i]);
                                                                if(!empty($per_type[$i])) {        
                                                                    if($unit_types[$i] == '1') {
                                                                        if($per_type[$i] == '1') {
                                                                            $rate_per_cases[$i] = $rates[$i]/$per[$i];
                                                                            $final_rate[$i] = $rate_per_cases[$i];
                                                                        } else if($per_type[$i] == '2') {
                                                                            $rate_per_pieces[$i] = $rates[$i]/$per[$i];
                                                                            $final_rate[$i] = $rate_per_pieces[$i] * $contents[$i];
                                                                        }
                                                                    } else if($unit_types[$i] =='2') {
                                                                        if($per_type[$i] == '1') {
                                                                            $rate_per_cases[$i] = $rates[$i]/$per[$i];
                                                                            $final_rate[$i] = $rate_per_cases[$i]/$contents[$i];
                                                                        } else if($per_type[$i] == '2') {
                                                                            $final_rate[$i] = $rates[$i]/$per[$i];
                                                                        }
                                                                    }
                                                                    if($gst_option == '1') {
                                                                        if($tax_option == '2') {
                                                                            $tax ="";
                                                                            if($tax_type == '1') {
                                                                                $tax= $product_tax[$i];
                                                                            } else {
                                                                                $tax = $overall_tax;
                                                                            }
                                                                            $tax = trim(str_replace("%", "",$tax));
                                                                            $final_rate[$i] = $final_rate[$i]-($final_rate[$i] * $tax)/($tax + 100);
                                                                        }
                                                                    }
                                                                    if(!empty($final_rate[$i]) && !empty($quantity[$i])) {
                                                                        $rate_per_unit[$i] = $final_rate[$i];
                                                                        $product_amount[$i] = $final_rate[$i] * $quantity[$i];
                                                                    }
                                                                    $sub_total += $product_amount[$i];
                                                                } else {
                                                                    $product_error = "Empty Per Type in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                                }
                                                            } else {
                                                                $product_error = "Invalid per in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                            }
                                                        } else {
                                                            $product_error = "Empty Per in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                        }
                                                    } else {
                                                        $product_error = "Invalid rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                    }
                                                } else {
                                                    $product_error = "Empty Rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                                                }     
                                            // } else {
                                            //     $product_error = "Invalid Content in Product - ".($obj->encode_decode('decrypt', $product_name));
                                            // }
                                        } else {
                                            $product_error = "Empty Content in Product - ".($obj->encode_decode('decrypt', $product_name));
                                        } 
                                    } else {
                                        $product_error = "Empty Unit Type in Product - ".($obj->encode_decode('decrypt', $product_name));
                                    }
                                } else {
                                    $product_error = "New quantity must be lesser than or equal to old quantity - ".($obj->encode_decode('decrypt', $product_name)) . " : " . $old_quantity[$i];
                                }
                            } else {
                                $product_error = "Invalid quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                            }
                        } else {
                            $product_error = "Empty quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    } else {
                        $product_error = "Select Magazine - ".($obj->encode_decode('decrypt', $product_name));
                    }
                } else {
                    $product_error = "Invalid Product";
                }
            }
        } else {
            $product_error = "Add Products";
        }

        $total_amount = $sub_total;

        if(empty($product_error) && empty($total_amount)) {
            $product_error = "Bill value cannot be 0";
        }
       
        $charges_total_amounts = array();
        if(!empty($other_charges_id) && empty($product_error)) {
            for($i=0; $i < count($other_charges_id); $i++) {
                $other_charges_id[$i] = trim($other_charges_id[$i]);
                if(!empty($other_charges_id[$i])) {
                    $other_charges_name = ""; $other_charges_value = 0;
                    $other_charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id[$i], 'charges_name');
                    $other_charges_names[$i] = $other_charges_name;
                    $charges_type[$i] = trim($charges_type[$i]);
                    $other_charges_values[$i] = trim($other_charges_values[$i]);
                    if(isset($other_charges_values[$i])) {
                        $other_charges_error = "";
                        if(strpos($other_charges_values[$i], '%') !== false) {
                            $other_charges_value = str_replace('%', '', $other_charges_values[$i]);
                            $other_charges_value = trim($other_charges_value);
                        } else {
                            $other_charges_value = $other_charges_values[$i];
                        }
                        $other_charges_error = $valid->valid_price($other_charges_value, ($obj->encode_decode('decrypt', $other_charges_name)), 1, '');
                        if(!empty($other_charges_error)) {
                            if(!empty($purchase_entry_error)) {
                                $purchase_entry_error = $purchase_entry_error."<br>".$other_charges_error;
                            }
                            else {
                                $purchase_entry_error = $other_charges_error;
                            }
                        }
                        else {
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_charges_value = ($other_charges_value * $total_amount) / 100;
                                $other_charges_value = number_format($other_charges_value, 2);
                                $other_charges_value = str_replace(",", "", $other_charges_value);
                            }
                        }
                    }
                    if(empty($purchase_entry_error)) {
                        $other_charges_total[$i] = $other_charges_value;
                        if($charges_type[$i] == "minus") {
                            $total_amount -= $other_charges_value;
                        }
                        else if($charges_type[$i] == "plus") {
                            $total_amount += $other_charges_value;
                        }
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                if(empty($purchase_entry_error)) {
                    for($j=$i+1; $j < count($other_charges_id); $j++) {
                        if($other_charges_id[$i] == $other_charges_id[$j]) {
                            $purchase_entry_error = "Same Charges Repeatedly Exists";
                            break;
                        }
                    }
                }
            }
        }
    
        $total_amount = number_format((float)$total_amount, 2, '.', '');
        $grand_total = $total_amount;

        if($gst_option == '1' && empty($product_error) && empty($valid_delivery_slip)) {
            $percentage = 100;
            if($tax_type == '1') {
                for ($a = 0; $a < count($product_ids); $a++) {
                    $tax = trim(str_replace("%", "",$product_tax[$a]));

                    if ($product_tax[$a] != '' && $tax != '%') {
                        $tax_plus_value = ($product_amount[$a] * $tax) / 100;
                        
                        $total_tax_value += $tax_plus_value;
                        $total_tax_amount = $total_tax_value;
                    } else {
                        $tax_error = "Select tax for product - ".($obj->encode_decode('decrypt', $product_names[$a]));
                    }
                    if (!empty($tax_error)) {
                        if (!empty($delivery_slip_error)) {
                            $delivery_slip_error = $delivery_slip_error . "<br>" . $tax_error;
                        } else {
                            $delivery_slip_error = $tax_error;
                        }
                    }
                }
            } else if($tax_type == '2') {
                $tax = "";
                $tax = str_replace("%", "", $overall_tax);
                $tax = trim($tax);
                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $tax)) {
                    $total_tax_value = ($tax * $grand_total) / $percentage;
                }
                else {
                    $product_error = "Invalid Overall tax";
                }
            }
            if(!empty($total_tax_value)) {
                $total_tax_value = number_format($total_tax_value, 2);
                $total_tax_value = str_replace(",", "", $total_tax_value);
                if($company_state == $party_state) {
                    $cgst_value = $total_tax_value / 2;
                    $cgst_value = number_format($cgst_value, 2);
                    $cgst_value = str_replace(",", "", $cgst_value);
                    $sgst_value = $total_tax_value / 2;
                    $sgst_value = number_format($sgst_value, 2);
                    $sgst_value = str_replace(",", "", $sgst_value);
                } else {
                    $igst_value = $total_tax_value;
                    $igst_value = number_format($igst_value, 2);
                    $igst_value = str_replace(",", "", $igst_value);
                }
                $total_amount = $total_amount + $total_tax_value;
            }
        }

        $round_off = 0;
        if(!empty($total_amount)) {	
            if (strpos( $total_amount, "." ) !== false) {
                $pos = strpos($total_amount, ".");
                $decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
                if($decimal != "00") {
                    if(strlen($decimal) == 1) {
                        $decimal = $decimal."0";
                    }
                    if($decimal >= 50) {				
                        $round_off = 100 - $decimal;
                        if($round_off < 10) {
                            $round_off = "0.0".$round_off;
                        }
                        else {
                            $round_off = "0.".$round_off;
                        }
                        
                        $total_amount = $total_amount + $round_off;
                    }
                    else {
                        $decimal = "0.".$decimal;
                        $round_off = "-".$decimal;
                        $total_amount = $total_amount - $decimal;
                    }
                }
            }
        }
        
        $result = "";

        /** Stock Function */

        $final_array = array();
        $godown_id = array();
        $total_qty = 0;

        if(!empty($magazine_type)) {
            if($magazine_type == 1) {
                foreach($product_ids as $product_id){
                    $godown_id[] = $magazine_id;
                }
            } else if($magazine_type == 2) {
                if(!empty($indv_magazine_id)) {
                    $godown_id = $indv_magazine_id;
                }
            }
        }

        if(!empty($product_ids) && count($product_ids) > 0 && empty($valid_delivery_slip)) {
            if(empty($edit_id)) {
                $godown_id = array_reverse($godown_id);
                $product_ids = array_reverse($product_ids);
                $unit_types = array_reverse($unit_types);
                $quantity = array_reverse($quantity);
                $contents = array_reverse($contents);
            }

            $individual_array = array();

            for($i = 0; $i < count($product_ids); $i++) {
                $godown_id[$i] = trim($godown_id[$i]);
                $product_ids[$i] = trim($product_ids[$i]);
                $unit_types[$i] = trim($unit_types[$i]);
                $quantity[$i] = trim($quantity[$i]);
                if(!empty($contents[$i]) && $contents[$i] != $GLOBALS['null_value']){
                    $contents[$i] = trim($contents[$i]);
                } else {
                    $contents[$i] = $GLOBALS['null_value'];
                }
                $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_ids[$i], '');
                if(!empty($product_list)) {
                    foreach ($product_list as $pl) {
                        if(!empty($pl['group_id'])) {
                            $group_id[$i] = $pl['group_id'];
                        }
                        if(!empty($pl['unit_id'])) {
                            $unit_id[$i] = $pl['unit_id'];
                        }
                        if(!empty($pl['subunit_id'])) {
                            $subunit_id[$i] = $pl['subunit_id'];
                        }
                    }
                }
                if($unit_types[$i] == '1') {
                    $unit_sub[$i] = $unit_id[$i];
                } else if($unit_types[$i] == '2') {
                    $unit_sub[$i] = $subunit_id[$i];
                }
                $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id, $godown_id[$i], $GLOBALS['null_value'], $product_ids[$i], $unit_sub[$i], $contents[$i]);

                if(empty($quantity[$i]) || $quantity[$i] == 0) {
                    $quantity_error = "";
                    $quantity_error = $valid->common_validation($quantity[$i], 'quantity', 'text');
                    if(!empty($quantity_error)) {
                        if(!empty($valid_consumption)) {
                            $valid_consumption = $valid_consumption." ".$valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        } else {
                            $valid_consumption = $valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i + 1));
                        }
                    } 
                } else {
                    $total_qty += $quantity[$i];
                }
                $individual_array[] = array('godown_id' => $godown_id[$i],'product_id' => $product_ids[$i],'content' => $contents[$i],'quantity' => $quantity[$i]);
            }

            array_multisort(array_column($individual_array, "godown_id"), SORT_ASC, array_column($individual_array, "content"), SORT_ASC, array_column($individual_array, "product_id"), SORT_ASC, $individual_array);
    
            if(empty($edit_id)) {
                $godown_id = array_reverse($godown_id);
                $product_ids = array_reverse($product_ids);
                $unit_types = array_reverse($unit_types);
                $quantity = array_reverse($quantity);
                $contents = array_reverse($contents);
            }

            if(empty($valid_consumption)) {
                $final_array = combineAndSumUp($individual_array);
            }
        } else {
            $product_error = "Please select product and its detials";
        }
    
        $stock_error = 0; $valid_stock = "";
        if(!empty($final_array) && empty($valid_delivery_slip)) {
            foreach($final_array as $data) {
                $inward_unit = 0; $inward_subunit = 0; $outward_unit = 0; $outward_subunit = 0;

                $inward_unit = $obj->getInwardQty($edit_id, '', $data['godown_id'], $data['product_id'], $data['content']);
                $outward_unit = $obj->getOutwardQty($edit_id, '', $data['godown_id'], $data['product_id'], $data['content']);

                $current_stock_unit = $inward_unit - $outward_unit;

                if($data['quantity'] > $current_stock_unit) {
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'product_name');
                    if(!empty($product_name)) {
                        $product_name = $obj->encode_decode("decrypt", $product_name);
                    }

                    $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'unit_id');
                    $unit_name = "";
                    
                    if(!empty($unit_id)) {
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode("decrypt", $unit_name);
                        }   
                    }

                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $data['product_id'], 'subunit_id');
                    $sub_unit_name = "";
                    
                    if(!empty($sub_unit_id)) {
                        $sub_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id', $sub_unit_id, 'unit_name');
                        if(!empty($sub_unit_name)) {
                            $sub_unit_name = $obj->encode_decode("decrypt", $sub_unit_name);
                        }   
                    }
                   
                    $negative_stock = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'negative_stock');
                    if($negative_stock !='1') {
                        $valid_stock = "Max stock for <b>" . $product_name . "</b> with " .  $unit_name . " & " . (!empty($data['content'] && $data['content'] != "NULL") ? ($data['content'] . " " . $sub_unit_name ) : "") . "<br>Current Stock : " . $current_stock_unit;
                        $stock_error = 1;
                    }
                }
            }
        }

        if (!empty($edit_id) && empty($product_error) && empty($valid_stock)) {
            $prev_stock_list = array();
            $prev_stock_list = $obj->PrevStockList($edit_id);
            if (!empty($prev_stock_list)) {
                foreach ($prev_stock_list as $data) {
                    $stock_id = "";
                    $stock_godown_id = "";
                    $stock_magazine_id = "";
                    $stock_product_id = "";
                    $stock_type = "";
                    $inward_unit = 0;
                    $inward_subunit = 0;
                    $outward_unit = 0;
                    $outward_subunit = 0;
                    $stock_case_contains = 0;
                    if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $stock_id = $data['id'];
                    }
                    if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $stock_godown_id = $data['godown_id'];
                    }
                    if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                        $stock_case_contains = $data['case_contains'];
                    }
                    if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $stock_magazine_id = $data['magazine_id'];
                    }
                    if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $stock_product_id = $data['product_id'];
                    }
                    if (!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward_unit = $data['inward_unit'];
                    }
                    if (!empty($data['inward_subunit']) && $data['inward_subunit'] != $GLOBALS['null_value']) {
                        $inward_subunit = $data['inward_subunit'];
                    }
                    if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                    }
                    if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                        $outward_subunit = $data['outward_subunit'];
                    }
                  
                    $current_stock_unit = 0;
                    $current_stock_subunit = 0;
                    $stock_table_unique_id = "";
                    $stock_unique_table = "";
                    $stock_unique_table = $GLOBALS['stock_by_godown_table'];
                   
                    $current_stock_unit = $obj->getCurrentStockUnit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                    $current_stock_subunit = $obj->getCurrentStockSubunit($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                    $stock_table_unique_id = $obj->getStockTablesUniqueID($stock_unique_table, $stock_godown_id, '', $stock_product_id, $stock_case_contains);

                    if (!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                        $current_stock_unit = $current_stock_unit + $outward_unit;
                    } else {
                        $current_stock_unit = 0;
                    }
                    if (!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                        $current_stock_subunit = $current_stock_subunit + $outward_subunit;
                    } else {
                        $current_stock_subunit = $GLOBALS['null_value'];
                    }
    
                    if (!in_array($stock_id, $stock_unique_ids)) {
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
    
                        if (preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($GLOBALS['stock_by_godown_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }
        }
        
        /** End Stock Function */

        if(empty($valid_delivery_slip) && empty($product_error) && empty($delivery_slip_error) && empty($valid_stock)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) { 
                $customer_name_mobile_city = ""; $customer_details = "";
                $agent_name_mobile_city = ""; $agent_details = "";
                if(!empty($proforma_invoice_id)) {
                    $proforma_invoice_number = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $proforma_invoice_id, 'proforma_invoice_number');
                }

                if(!empty($proforma_invoice_date)) {
                    $proforma_invoice_date = date('Y-m-d', strtotime($proforma_invoice_date));
                }
                if(!empty($agent_id)) {
                    $agent_name_mobile_city = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'name_mobile_city');
                    $agent_details = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'agent_details');
                } else {
                    $agent_id = $GLOBALS['null_value'];
                    $agent_name_mobile_city = $GLOBALS['null_value'];
                    $agent_details = $GLOBALS['null_value'];
                }
                
                if(!empty($customer_id)) {
                    $customer_name_mobile_city = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'name_mobile_city');
                    $customer_details = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'customer_details');
                } else {
                    $customer_id = $GLOBALS['null_value'];
                    $customer_name_mobile_city = $GLOBALS['null_value'];
                    $customer_details = $GLOBALS['null_value'];
                }

                if(!empty($product_ids)) {
                    $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                } else {
                    $product_ids = $GLOBALS['null_value'];
                }

                if(!empty($indv_magazine_id)) {
                    $indv_magazine_id = array_reverse($indv_magazine_id);
                    $indv_magazine_id = implode(",", $indv_magazine_id);
                } else {
                    $indv_magazine_id = $GLOBALS['null_value'];
                }
               
                if(!empty($product_names)) {
                    $product_names = array_reverse($product_names);
                    $product_names = implode(",", $product_names);
                } else {
                    $product_names = $GLOBALS['null_value'];
                }
    
                if(!empty($unit_types)) {
                    $unit_types = array_reverse($unit_types);
                    $unit_types = implode(",", $unit_types);
                } else {
                    $unit_types = $GLOBALS['null_value'];
                }

                if(!empty($subunit_need)) {
                    $subunit_need = array_reverse($subunit_need);
                    $subunit_need = implode(",", $subunit_need);
                } else {
                    $subunit_need = $GLOBALS['null_value'];
                }

                if(!empty($contents)) {
                    $contents = array_reverse($contents);
                    $contents = implode(",", $contents);
                } else {
                    $contents = $GLOBALS['null_value'];
                }

                if(!empty($unit_ids)) {
                    $unit_ids = array_reverse($unit_ids);
                    $unit_ids = implode(",", $unit_ids);
                } else {
                    $unit_ids = $GLOBALS['null_value'];
                }

                if(!empty($unit_names)) {
                    $unit_names = array_reverse($unit_names);
                    $unit_names = implode(",", $unit_names);
                } else {
                    $unit_names = $GLOBALS['null_value'];
                }

                if(!empty($quantity)) {
                    $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                } else {
                    $quantity = $GLOBALS['null_value'];
                }
                
                if(!empty($rates)) {
                    $rates = array_reverse($rates);
                    $rates = implode(",", $rates);
                } else {
                    $rates = $GLOBALS['null_value'];
                }
                
                if(!empty($per)) {
                    $per = array_reverse($per);
                    $per = implode(",", $per);
                } else {
                    $per = $GLOBALS['null_value'];
                }

                if(!empty($per_type)) {
                    $per_type = array_reverse($per_type);
                    $per_type = implode(",", $per_type);
                } else {
                    $per_type = $GLOBALS['null_value'];
                }

                if(!empty($product_tax)) {
                    $product_tax = array_reverse($product_tax);
                    $product_tax = implode(",", $product_tax);
                } else {
                    $product_tax = $GLOBALS['null_value'];
                }

                if(!empty($final_rate)) {
                    $final_rate = array_reverse($final_rate);
                    $final_rate = implode(",", $final_rate);
                } else {
                    $final_rate = $GLOBALS['null_value'];
                }

                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(",", $amount);
                } else {
                    $amount = $GLOBALS['null_value'];
                }

                if(!empty(array_filter($other_charges_id, fn($value) => $value !== ""))) {
                    $other_charges_id = implode(",", $other_charges_id);
                } else {
                    $other_charges_id = $GLOBALS['null_value'];
                }

                if(!empty(array_filter($charges_type, fn($value) => $value !== ""))) {
                    $charges_type = implode(",", $charges_type);
                } else {
                    $charges_type = $GLOBALS['null_value'];
                }

                if(!empty(array_filter($other_charges_values, fn($value) => $value !== ""))) {
                    $other_charges_values = implode(",", $other_charges_values);
                } else {
                    $other_charges_values = $GLOBALS['null_value'];
                }
                
                if(!empty(array_filter($other_charges_total, fn($value) => $value !== ""))) {
                    $other_charges_total = implode(",", $other_charges_total);
                } else {
                    $other_charges_total = $GLOBALS['null_value'];
                }
                     
                if(!empty($charges_total_amounts)) {
                    $charges_total_amounts = implode(",", $charges_total_amounts);
                } else {
                    $charges_total_amounts = $GLOBALS['null_value'];
                }

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator']; $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']); $bill_company_id = $GLOBALS['bill_company_id']; $null_value = $GLOBALS['null_value']; $stock_update = 0; $delivery_slip_insert_id = ""; $stock_conversion = 0;

                if(empty($edit_id)) {
                    $action = "";
                    if(!empty($customer_name_mobile_city) && $customer_name_mobile_city != $GLOBALS['null_value']) {
                        $action = "New delivery slip created. Party - ".($obj->encode_decode('decrypt', $customer_name_mobile_city));
                    }
                    
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'delivery_slip_id', 'delivery_slip_number', 'delivery_slip_date',  'proforma_invoice_id', 'proforma_invoice_number', 'proforma_invoice_date',  'customer_id', 'customer_name_mobile_city', 'customer_details', 'agent_id', 'agent_name_mobile_city', 'agent_details', 'transport_id', 'bank_id', 'magazine_type', 'magazine_id', 'gst_option', 'address', 'tax_option', 'tax_type', 'overall_tax',  'company_state', 'party_state', 'product_id', 'indv_magazine_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount', 'other_charges_id', 'charges_type', 'other_charges_value', 'agent_commission', 'bill_total', 'cancelled', 'deleted');
                    $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $bill_company_id . "'", "'" . $null_value . "'", "'" . $null_value . "'", "'" . $delivery_slip_date . "'", "'" . $proforma_invoice_id . "'", "'" . $proforma_invoice_number . "'", "'" . $proforma_invoice_date . "'", "'" . $customer_id . "'", "'" . $customer_name_mobile_city . "'", "'" . $customer_details . "'","'" . $agent_id . "'", "'" . $agent_name_mobile_city . "'", "'" . $agent_details .  "'", "'" . $transport_id . "'" , "'" . $bank_id . "'" , "'" . $magazine_type . "'", "'" . $magazine_id . "'", "'" . $gst_option . "'" , "'" . $address . "'" , "'" . $tax_option . "'" ,"'" . $tax_type . "'", "'" . $overall_tax . "'" ,"'" . $company_state . "'" ,"'" . $party_state . "'" ,"'" . $product_ids . "'" , "'" . $indv_magazine_id . "'", "'" . $product_names . "'", "'" . $unit_types . "'","'" . $subunit_need . "'","'" . $contents . "'","'" . $unit_ids . "'","'" . $unit_names . "'","'" . $quantity . "'","'" . $rates . "'","'" . $per . "'","'" . $per_type . "'","'" . $product_tax . "'","'" . $final_rate . "'","'" . $amount . "'","'" . $other_charges_id . "'","'" .  $charges_type . "'","'" . $other_charges_values . "'","'" . $agent_commission . "'","'" . $total_amount . "'", "'0'", "'0'");

                    $delivery_slip_insert_id = $obj->InsertSQL($GLOBALS['delivery_slip_table'], $columns, $values, 'delivery_slip_id', 'delivery_slip_number', $action);

                    if(preg_match("/^\d+$/", $delivery_slip_insert_id)) {
                        $stock_update = 1;
                        $stock_conversion = 1;
                        $result = array('number' => '1', 'msg' => 'Delivery Slip Successfully Created','redirection_page'=> 'delivery_slip.php');
                    } else {
                        $result = array('number' => '2', 'msg' => $delivery_slip_insert_id);
                    }
                } else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $edit_id, 'id');
                    $delivery_slip_number = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $edit_id, 'delivery_slip_number');

                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if(!empty($customer_name_mobile_city) && $customer_name_mobile_city != $GLOBALS['null_value']) {
                            $action = "Delivery Slip Updated. Customer - ".($obj->encode_decode('decrypt', $customer_name_mobile_city));
                        }

                        $columns = array(); $values = array();		
                        $columns = array('delivery_slip_date', 'customer_id', 'customer_name_mobile_city', 'customer_details', 'agent_id', 'agent_name_mobile_city', 'agent_details', 'transport_id', 'bank_id', 'magazine_type', 'magazine_id', 'gst_option', 'address', 'tax_option', 'tax_type', 'overall_tax',  'company_state', 'party_state', 'product_id', 'indv_magazine_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount', 'other_charges_id', 'charges_type', 'other_charges_value', 'agent_commission', 'bill_total');
                        $values = array("'" . $delivery_slip_date . "'", "'" . $customer_id . "'", "'" . $customer_name_mobile_city . "'", "'" . $customer_details . "'","'" . $agent_id . "'", "'" . $agent_name_mobile_city . "'", "'" . $agent_details .  "'", "'" . $transport_id . "'" , "'" . $bank_id . "'" , "'" . $magazine_type . "'", "'" . $magazine_id . "'", "'" . $gst_option . "'" , "'" . $address . "'" , "'" . $tax_option . "'" ,"'" . $tax_type . "'", "'" . $overall_tax . "'" ,"'" . $company_state . "'" ,"'" . $party_state . "'" ,"'" . $product_ids . "'" , "'" . $indv_magazine_id . "'", "'" . $product_names . "'", "'" . $unit_types . "'","'" . $subunit_need . "'","'" . $contents . "'","'" . $unit_ids . "'","'" . $unit_names . "'","'" . $quantity . "'","'" . $rates . "'","'" . $per . "'","'" . $per_type . "'","'" . $product_tax . "'","'" . $final_rate . "'","'" . $amount . "'","'" . $other_charges_id . "'","'" .  $charges_type . "'","'" . $other_charges_values . "'","'" . $agent_commission . "'","'" . $total_amount . "'");

                        $delivery_slip_update_id = $obj->UpdateSQL($GLOBALS['delivery_slip_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $delivery_slip_update_id)) {
                            $stock_update = 1;
                            $stock_conversion = 1;
                            $result = array('number' => '1', 'msg' => 'Delivery Slip Updated Successfully','redirection_page'=> 'delivery_slip.php');
                        } else {
                            $result = array('number' => '2', 'msg' => $delivery_slip_update_id);
                        }							
                    }
                }

                if (!empty($stock_update) && $stock_update == 1) {
                    if (!empty($godown_id) && !empty($product_ids) && !empty($quantity)) {
                        $product_id = explode(",", $product_ids);
                        $unit_type = explode(",", $unit_types);
                        $quantity = explode(",", $quantity);
                        $contents = explode(",", $contents);
                        $location_id = $godown_id;
                        $remarks = "";
                        $delivery_slip_id = "";
                        if(empty($edit_id)){
                            if(!empty($delivery_slip_insert_id)) {
                                $delivery_slip_number = "";
                                $delivery_slip_number = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'id', $delivery_slip_insert_id, 'delivery_slip_number');
                                $delivery_slip_id = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'id', $delivery_slip_insert_id, 'delivery_slip_id');                            
                                $remarks = $obj->encode_decode("encrypt", $delivery_slip_number);
                            }
                        } else {
                            $delivery_slip_number = "";
                            $delivery_slip_number = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $edit_id, 'delivery_slip_number');
                            $delivery_slip_id = $edit_id;
                            $remarks = $obj->encode_decode("encrypt", $delivery_slip_number);
                        }

                        for($i = 0; $i < count($product_id); $i++) {
                            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                            if(!empty($product_list)) {
                                foreach ($product_list as $pl) {
                                    if(!empty($pl['group_id'])) {
                                        $group_id = $pl['group_id'];
                                    }
                                    if(!empty($pl['unit_id'])) {
                                        $unit_id = $pl['unit_id'];
                                    }
                                    if(!empty($pl['subunit_id'])) {
                                        $subunit_id = $pl['subunit_id'];
                                    }
                                }
                            }
                            if($unit_type[$i] == '1') {
                                $unit_sub = $unit_id;                                
                            } else if($unit_type[$i] == '2') {
                                $unit_sub = $subunit_id;
                            }
                    
                            $stock_update_id = $obj->StockUpdate($GLOBALS['delivery_slip_table'], "Out", $delivery_slip_id, '', $product_id[$i], $remarks, date('Y-m-d'), $location_id[$i], $GLOBALS['null_value'], $unit_sub, $quantity[$i], $contents[$i], $group_id, 2);
                        }
                    }
                }

                if (!empty($stock_conversion) && $stock_conversion == 1) {
                    $delivery_slip_id = "";
                    if(empty($edit_id)) {
                        if(!empty($delivery_slip_insert_id)) {
                            $delivery_slip_id = "";
                            $delivery_slip_id = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'id', $delivery_slip_insert_id, 'delivery_slip_id');
                        }
                    } else {
                        $delivery_slip_id = $edit_id;
                    }

                    $obj->UpdateConversionStock($delivery_slip_id, "Delivery Slip");
                }
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_delivery_slip)) {
                $result = array('number' => '3', 'msg' => $valid_delivery_slip);
            } else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            } else if(!empty($delivery_slip_error)) {
                $result = array('number' => '2', 'msg' => $delivery_slip_error);
            } else if(!empty($valid_stock)) {
                $result = array('number' => '2', 'msg' => $valid_stock);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }

    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number']; $page_limit = $_POST['page_limit']; $page_title = $_POST['page_title'];
        $from_date = ""; $to_date = ""; $search_text = ""; $show_bill = 0;$agent_id = "";
        $customer_id = "";$transport_id = "";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(isset($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
        }
        if(isset($_POST['transport_id'])) {
             $transport_id = $_POST['transport_id'];
        }
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }
      
        if(isset($_POST['agent_id'])) {
            $agent_id = $_POST['agent_id'];
        }
        $total_records_list = array();
        $total_records_list = $obj->getDeliverySlipList($from_date, $to_date, $customer_id, $search_text, $show_bill, $agent_id, $transport_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['delivery_slip_number']), $search_text) !== false) ) {
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
        ?>
        <?php if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php include("pagination.php"); ?> 
            </div> 
        <?php } ?>
        <?php
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { 
        ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Bill No / Bill Date</th>
                    <th>Customer Name</th>
                    <!-- <th>Amount</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(!empty($show_records_list)) {
                    foreach($show_records_list as $key => $list) {
                        $index = $key + 1;
                        if(!empty($prefix)) { $index = $index + $prefix; }   
                        ?>
                        <tr>
                            <td>
                                <?php echo $index; ?>
                            </td>
                            <td> 
                                <?php
                                    if(!empty($list['delivery_slip_number']) && $list['delivery_slip_number'] != $GLOBALS['null_value']) {
                                        echo $list['delivery_slip_number'];
                                    }
                                ?>
                                <br>
                                <?php
                                    if(!empty($list['delivery_slip_date'])) {
                                        echo date('d-m-Y', strtotime($list['delivery_slip_date']));
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['customer_name_mobile_city']) && $list['customer_name_mobile_city'] != $GLOBALS['null_value']) {
                                        echo html_entity_decode($obj->encode_decode('decrypt', $list['customer_name_mobile_city']));
                                    }
                                    else {
                                        echo '-';
                                    }
                                
                                if(!empty($list['cancelled'])) {
                                    ?>
                                        <span style="color: red;">Cancelled</span>
                                    <?php	
                                }	 ?>
                            </td>
                            <?php /*
                            <td>
                                <?php
                                    if(!empty($list['bill_total'])) {
                                        echo number_format($list['bill_total'],2);
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                            */ ?>

                            <td>
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
                                <?php 
                                    $delivery_slip_actions = array();
                                    $delivery_slip_actions = $obj->getDeliverySlipActions($list['delivery_slip_id']);

                                        ?>
                                            <div class="dropdown">
                                                <button class="btn btn-dark show-button" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <li>
                                                        <a class="dropdown-item" href="#" onclick="window.open('reports/rpt_delivery_slip_a5.php?delivery_slip_id=<?php if(!empty($list['delivery_slip_id'])) { echo $list['delivery_slip_id']; } ?>')"><i class="fa fa-print"></i> &ensp;Print</a>
                                                    </li>
                                                    <?php
                                                        if((!empty($delivery_slip_actions) && ($show_bill == 0))) {
                                                            if(in_array("convert", $delivery_slip_actions)){
                                                                ?>
                                                                <li>
                                                                    <a class="dropdown-item" href="Javascript:ShowConversion('<?php if(!empty($list['delivery_slip_id'])) { echo $list['delivery_slip_id']; } ?>', '<?php if(!empty($page_title)) { echo $page_title; } ?>');"><i class="fa fa-undo" ></i>&ensp; Convert To Estimate</a>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        if((!empty($delivery_slip_actions) && ($show_bill == 0))) {

                                                            if(in_array("edit", $delivery_slip_actions)){
                                                                if(empty($edit_access_error)) { 
                                                                ?>
                                                                    <li>
                                                                        <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['delivery_slip_id'])) { echo $list['delivery_slip_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                                    </li>
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                        if((!empty($delivery_slip_actions) && ($show_bill == 0))) {

                                                            if(in_array("delete", $delivery_slip_actions)){
                                                                if(empty($delete_access_error)) {
                                                                ?>
                                                                    <li>
                                                                        <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['delivery_slip_id'])) { echo $list['delivery_slip_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a>
                                                                    </li>
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php
                                ?>
                            </td>
                        </tr>
                        
                        <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7" class="text-center">Sorry! No records found</td>
                    </tr>
                <?php 
                    } 
                ?>
            </tbody>
        </table>              
    <?php }
    }

    if(isset($_REQUEST['delete_delivery_slip_id'])) {
        $delete_delivery_slip_id = $_REQUEST['delete_delivery_slip_id'];
        $msg = "";
        if(!empty($delete_delivery_slip_id)) {
            $delivery_slip_unique_id = "";
            $delivery_slip_unique_id = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $delete_delivery_slip_id, 'id');
            if(preg_match("/^\d+$/", $delivery_slip_unique_id)) {
    
                $prev_stock_list = array();
                $tables = "";
                $prev_stock_list = $obj->PrevStockList($delete_delivery_slip_id);
                if (!empty($prev_stock_list)) {
                    foreach ($prev_stock_list as $data) {
                        $stock_godown_id = "";
                        $stock_magazine_id = "";
                        $stock_case_contains = "";
                        $stock_id = "";
                        if (!empty($data['id'])) {
                            $stock_id = $data['id'];
                        }
                        if (!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                            $stock_godown_id = $data['godown_id'];
                        }
                        if (!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $stock_magazine_id = $data['magazine_id'];
                        }
                        if (!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                            $stock_case_contains = $data['case_contains'];
                        }
                        if (!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                            $stock_product_id = $data['product_id'];
                        }
                        if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                            $outward_unit = $data['outward_unit'];
                        }
                        if(!empty($data['outward_subunit']) && $data['outward_subunit'] != $GLOBALS['null_value']) {
                            $outward_subunit = $data['outward_subunit'];
                        }
                        if($data['godown_id'] != $GLOBALS['null_value'] && $data['magazine_id'] == $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_godown_table'];
                        } else if($data['godown_id'] == $GLOBALS['null_value'] && $data['magazine_id'] != $GLOBALS['null_value']) {
                            $tables = $GLOBALS['stock_by_magazine_table'];
                        }
                        $current_stock_unit = 0;
                        $current_stock_subunit = 0;
                        $current_stock_unit = $obj->getCurrentStockUnit($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $current_stock_subunit = $obj->getCurrentStockSubunit($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);
                        $stock_table_unique_id = "";
                        $stock_table_unique_id = $obj->getStockTablesUniqueID($tables, $stock_godown_id, '', $stock_product_id, $stock_case_contains);

                        if(!empty($current_stock_unit) && $current_stock_unit != $GLOBALS['null_value']) {
                            $current_stock_unit = $current_stock_unit + $outward_unit;
                        }
                        else {
                            $current_stock_unit = 0;
                        }
                        if(!empty($current_stock_subunit) && $current_stock_subunit != $GLOBALS['null_value']) {
                            $current_stock_subunit = $current_stock_subunit + $outward_subunit;
                        } else {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }

                        if (empty($current_stock_unit) && $current_stock_unit == $GLOBALS['null_value']) {
                            $current_stock_unit = 0;
                        }
                        if (empty($current_stock_subunit) && $current_stock_subunit == $GLOBALS['null_value']) {
                            $current_stock_subunit = $GLOBALS['null_value'];
                        }
                   
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

                        if (preg_match("/^\d+$/", $stock_update_id)) {
                            if (preg_match("/^\d+$/", $stock_table_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('current_stock_unit', 'current_stock_subunit');
                                $values = array("'".$current_stock_unit."'", "'".$current_stock_subunit."'");
                                $stock_table_update_id = $obj->UpdateSQL($GLOBALS['stock_by_magazine_table'], $stock_table_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
    
                $delivery_slip_number = "";
                $delivery_slip_number = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $delete_delivery_slip_id, 'delivery_slip_number');
    
                $action = "";
                if(!empty($delivery_slip_number)) {
                    $action = "Delivery Slip Deleted. Name - " . $delivery_slip_number;
                }

                $stock_conversion_records = $obj->getTableRecords($GLOBALS['stock_conversion_table'], 'bill_id', $delete_delivery_slip_id, '');
                if(!empty($stock_conversion_records)) {
                    foreach($stock_conversion_records as $sc) {
                        $columns = array(); $values = array();
                        $columns = array('deleted'); $values = array("'1'");
                        $obj->UpdateSQL($GLOBALS['stock_conversion_table'], $sc['id'], $columns, $values, $action);
                    }
                }

                $columns = array();
                $values = array();
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['delivery_slip_table'], $delivery_slip_unique_id, $columns, $values, $action);
            }
        }
        echo $msg;
        exit;
    }