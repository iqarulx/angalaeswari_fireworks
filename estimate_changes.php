<?php
    include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['estimate_module'];
        }
    }

    if(isset($_REQUEST['show_estimate_id'])) { 
        $show_estimate_id = $_REQUEST['show_estimate_id'];
        $current_date = date('Y-m-d');
        $conversion_update = 0;
        if(isset($_REQUEST['conversion_update'])) {
            $conversion_update = $_REQUEST['conversion_update'];
        }

        $delivery_slip_id = ""; $delivery_slip_number = ""; $delivery_slip_date = date('Y-m-d'); $estimate_date = date('Y-m-d'); $customer_id = ""; $agent_id = ""; $transport_id = ""; $bank_id = ""; $magazine_type = ""; $magazine_id = ""; $gst_option = "";$address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $product_names = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array(); $unit_names = array(); $quantity = array(); $old_quantity = array(); $rate = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array();$charges_type = array(); $other_charges_value = array(); $agent_commission = ""; $bill_total = ""; $charges_count = 0; $proforma_invoice_id = "";
    
        if(!empty($show_estimate_id)) {
            $estimate_list = $obj->getEstimateIndex($show_estimate_id, $conversion_update);

            if(!empty($estimate_list)) {
                $est = $estimate_list;
                if(!empty($est['delivery_slip_number'])) {
                    $delivery_slip_number = $est['delivery_slip_number'];
                }
                if(!empty($est['proforma_invoice_id'])) {
                    $proforma_invoice_id = $est['proforma_invoice_id'];
                }
                if(!empty($est['customer_id'])) {
                    $customer_id = $est['customer_id'];
                }
                if(!empty($est['delivery_slip_date'])) {
                    $delivery_slip_date = date('Y-m-d', strtotime($est['delivery_slip_date']));
                }
                if(!empty($est['estimate_date'])) {
                    $estimate_date = date('Y-m-d', strtotime($est['estimate_date']));
                }
                if(!empty($est['agent_id'])) {
                    $agent_id = $est['agent_id'];
                }
                if(!empty($est['transport_id'])) {
                    $transport_id = $est['transport_id'];
                }
                if(!empty($est['bank_id'])) {
                    $bank_id = $est['bank_id'];
                }
                if(!empty($est['magazine_type'])) {
                    $magazine_type = $est['magazine_type'];
                }
                if(!empty($est['magazine_id'])) {
                    $magazine_id = $est['magazine_id'];
                }
                if(!empty($est['gst_option'])) {
                    $gst_option = $est['gst_option'];
                }
                if(!empty($est['address'])) {
                    $address = $est['address'];
                }
                if(!empty($est['tax_option'])) {
                    $tax_option = $est['tax_option'];
                }
                if(!empty($est['tax_type'])) {
                    $tax_type = $est['tax_type'];
                }
                if(!empty($est['overall_tax'])) {
                    $overall_tax = $est['overall_tax'];
                }
                if(!empty($est['company_state'])) {
                    $company_state = $est['company_state'];
                }
                if(!empty($est['party_state'])) {
                    $party_state = $est['party_state'];
                }
                if(!empty($est['product_id'])) {
                    $product_ids = $est['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                // if(!empty($est['indv_magazine_id'])) {
                //     $indv_magazine_ids = $est['indv_magazine_id'];
                //     $indv_magazine_ids = explode(",", $indv_magazine_ids);
                //     $indv_magazine_ids = array_reverse($indv_magazine_ids);
                // }
                if(!empty($est['product_name'])) {
                    $product_names = $est['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($est['unit_type'])) {
                    $unit_types = $est['unit_type'];
                    $unit_types = explode(",", $unit_types);
                    $unit_types = array_reverse($unit_types);
                }
                if(!empty($est['subunit_need'])) {
                    $subunit_needs = $est['subunit_need'];
                    $subunit_needs = explode(",", $subunit_needs);
                    $subunit_needs = array_reverse($subunit_needs);
                }
                if(!empty($est['content'])) {
                    $contents = $est['content'];
                    $contents = explode(",", $contents);
                    $contents = array_reverse($contents);
                }
                if(!empty($est['unit_id'])) {
                    $unit_ids = $est['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($est['unit_name'])) {
                    $unit_names = $est['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    $unit_names = array_reverse($unit_names);
                }
                if(!empty($est['quantity'])) {
                    $quantity = $est['quantity'];
                    $quantity = explode(",", $quantity);
                    $quantity = array_reverse($quantity);
                }
                if(!empty($est['quantity'])) {
                    $old_quantity = $est['quantity'];
                    $old_quantity = explode(",", $old_quantity);
                    $old_quantity = array_reverse($old_quantity);
                }
                if(!empty($est['rate'])) {
                    $rate = $est['rate'];
                    $rate = explode(",", $rate);
                    $rate = array_reverse($rate);
                }       
                if(!empty($est['per'])) {
                    $per = $est['per'];
                    $per = explode(",", $per);
                    $per = array_reverse($per);
                }    
                if(!empty($est['per_type'])) {
                    $per_type = $est['per_type'];
                    $per_type = explode(",", $per_type);
                    $per_type = array_reverse($per_type);
                }     
                if(!empty($est['product_tax'])) {
                    $product_tax = $est['product_tax'];
                    $product_tax = explode(",", $product_tax);
                    $product_tax = array_reverse($product_tax);
                }     
                if(!empty($est['final_rate'])) {
                    $final_rate = $est['final_rate'];
                    $final_rate = explode(",", $final_rate);
                    $final_rate = array_reverse($final_rate);
                }      
                    
                if(!empty($est['amount'])) {
                    $amount = $est['amount'];
                    $amount = explode(",", $amount);
                    $amount = array_reverse($amount);
                }

                if(!empty($est['other_charges_id'])) {
                    $other_charges_id = $est['other_charges_id'];
                    $other_charges_id = explode(",", $other_charges_id);
                    $charges_count = count($other_charges_id);
                }      
                    
                if(!empty($est['charges_type'])) {
                    $charges_type = $est['charges_type'];
                    $charges_type = explode(",", $charges_type);
                }

                if(!empty($est['other_charges_value'])) {
                    $other_charges_value = $est['other_charges_value'];
                    $other_charges_value = explode(",", $other_charges_value);
                }   

                if(!empty($est['agent_commission'])) {
                    $agent_commission = $est['agent_commission'];
                } else {
                    if(!empty($agent_id)) {
                        $agent_commission = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'commission');

                        if(!empty($bill_total)){
                            $commission_percent = str_replace("%", "", $agent_commission);
                            $commission_percent = floatval($commission_percent);
                            $agent_commission_value = ($bill_total * $commission_percent) / 100;
                        }
                    }
                }
            }

            if(!empty($conversion_update) && $conversion_update == '1') {
                $delivery_slip_id = $show_estimate_id;
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
        $magazine_list =array();
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
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
        if(!empty($customer_id)) {
            $party_state = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'state');
            if(!empty($party_state)) {
                $party_state = $obj->encode_decode('decrypt', $party_state);
            }
        }
    ?>
        <form class="poppins pd-20 redirection_form" name="estimate_form" method="POST">
            <div class="card-header">
                <div class="row p-2">
                    <div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <div class="h5"><?php if(!empty($delivery_slip_id)) { echo "Convert Delivery Slip To Estimate"; } else { echo "Edit Estimate"; } ?></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('delivery_slip.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_estimate_id) &&  $conversion_update == 0) { echo $show_estimate_id; } ?>">   
                <input type="hidden" name="delivery_slip_id" value="<?php if(!empty($delivery_slip_id)) { echo $delivery_slip_id; } ?>">
                <input type="hidden" name="proforma_invoice_id" value="<?php if(!empty($proforma_invoice_id)) { echo $proforma_invoice_id; } ?>">
                <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } else { echo "Tamil Nadu"; } ?>">  
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="hidden" name="delivery_slip_date" class="form-control shadow-none" placeholder="" value="<?php if (!empty($delivery_slip_date)) { echo $delivery_slip_date; } ?>">
                            <label>Date</label>
                            <input type="date" name="estimate_date" class="form-control shadow-none" placeholder="" value="<?php if (!empty($estimate_date)) { echo $estimate_date; } ?>" required="">
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
                                                            echo html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
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
                                        } ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { echo "selected"; } ?>>
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
                <?php /*
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
                                        } ?>" <?php if(!empty($magazine_id) && $magazine_id == $list['magazine_id']) { echo "selected"; } ?>>
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
                */ ?>
                <div class="col-lg-2 col-md-3 col-6 py-2 d-none">
                    <div class="form-group">
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="FormSelectDefault" class="form-label text-muted smallfnt">GST  ON / OFF</label>
                                <input id="gst_option" class="form-check-input code-switcher" name="gst_option" onchange="Javascript:ShowGST(this,this.value);" value="<?php if($gst_option == '1'){ echo $gst_option; } ?>" <?php if($gst_option == '1'){ ?>checked<?php } ?> type="checkbox" id="FormSelectDefault">
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
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 <?php if($gst_option !='1'){?>d-none<?php } ?> tax_cover1" id="tax_option_div">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="tax_option" data-dropdown-css-class="select2-danger" style="width: 100%!important;"  onchange="Javascript:getRateByTaxOption();">
                                <!-- <option value="">Select</option> -->
                                <option value="1" <?php if($tax_option == '1'){ ?>selected<?php } ?>>Exclusive Tax</option>
                                <option value="2" <?php if($tax_option == '2'){ ?>selected<?php } ?>>Inclusive Tax</option>
                            </select>
                            <label>Tax Option</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="tax_type" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);">
                                <option value="">Select Tax Type</option>
                                <option value="1" <?php if($tax_type == '1'){ ?>selected<?php } ?>>Product</option>
                                <option value="2" <?php if($tax_type == '2'){ ?>selected<?php } ?>>Overall</option>
                            </select>
                            <label>Tax Type</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-2 col-md-3 col-6 py-2 <?php if($tax_type !='2'){ ?>d-none <?php } ?> tax_cover2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
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
                                    <?php /* <th style="width: 100px;" class="indv_magazine <?php if(empty($magazine_type) || ($magazine_type == 1)) { echo "d-none"; } ?>">Magazine</th> */?>
                                    <th style="width: 100px;">Type</th>
                                    <th style="width: 100px;">QTY</th>
                                    <th style="width: 100px;">Content</th>
                                    <th style="width: 100px;">Rate</th>
                                    <th style="width: 150px;">Per</th>
                                    <th class="tax_element d-none" style="width: 70px;">Tax</th>
                                    <th style="width: 70px;">Final Rate</th>
                                    <th style="width: 100px;">Amount</th>
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
                                                <?php /*
                                                <th class="text-center px-2 py-2 indv_magazine <?php if(empty($magazine_type) || ($magazine_type == 1)) { echo "d-none"; }?>">
                                                    <div class="form-group">
                                                        <div class="form-label-group in-border">
                                                            <select class="select2 select2-danger" name="indv_magazine_id[]" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                                <option value="">Select Magazine</option>
                                                                <?php if (!empty($magazine_list)) {
                                                                    foreach ($magazine_list as $list) { ?>
                                                                        <option value="<?php if (!empty($list['magazine_id'])) {
                                                                            echo $list['magazine_id'];
                                                                        } ?>" <?php if(!empty($indv_magazine_ids[$i]) && $indv_magazine_ids[$i] == $list['magazine_id']) { echo "selected"; } ?>>
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
                                                </th> */ ?>
                                                <th class="text-center px-2 py-2">
                                                    <?php if($unit_types[$i] == '1'){
                                                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_id');
                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');
                                                    }
                                                    elseif($unit_types[$i] == '2') {
                                                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_id');
                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_name');
                                                    }

                                                    if(!empty($unit_name) && $unit_name !='NULL') {
                                                        echo $unit_name = $obj->encode_decode("decrypt",$unit_name);
                                                    }
                                                    ?>
                                                    <input type="hidden" name="unit_type[]" class="form-control shadow-none" value="<?php if(!empty($unit_types[$i])) { echo $unit_types[$i]; } ?>">
                                                    <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_id)) { echo $unit_ids[$i]; } ?>">
                                                    <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>" >
                                                    <input type="hidden" name="subunit_need[]" class="form-control shadow-none" value="<?php if(!empty($subunit_needs[$i])) { echo $subunit_needs[$i]; } ?>" >
                                                </th>
                                                <th class="text-center px-2 py-2">
                                                    <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);" readonly>
                                                    <input type="hidden" name="old_quantity[]" class="form-control shadow-none" value="<?php if(!empty($old_quantity[$i])) { echo $old_quantity[$i]; } ?>">
                                                    </th>
                                                <th class="text-center px-2 py-2">
                                                    <input type="hidden" name="content[]" class="form-control shadow-none" value="<?php if(!empty($contents[$i]) && $contents[$i] != "NULL") { echo $contents[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                                    <?php if(!empty($contents[$i]) && $contents[$i] != "NULL") { echo $contents[$i]; } ?>
                                                </th>
                                                <td>
                                                    <div class="form-group mb-1">
                                                        <div class="form-label-group in-border">
                                                            <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width:65px;" value="<?php if(!empty($rate[$i])){ echo $rate[$i]; }?>" required>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <?php
                                                    $per_unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');
                                                    $per_subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_name');
                                                    /*     
                                                    ?>
                                                    <input type="hidden" id="" name="per[]" value="<?php if(!empty($per[$i])){ echo $per[$i]; }?>" class="form-control shadow-none" onkeyup="ProductRowCheck(this);">
                                                    <input type="hidden" id="" name="per_type[]" value="<?php if(!empty($per_type[$i])){ echo $per_type[$i]; }?>">
                                                    <?php if(!empty($per[$i]) && !empty($per_type[$i])){
                                                        echo $per[$i]." ".$obj->encode_decode("decrypt", $per_unit_name);
                                                    } ?>
                                                    */ ?>
                                                     <div class="form-group">
                                                        <div class="form-label-group in-border">
                                                            <div class="input-group">
                                                                <input type="text" id="" name="per[]" value="<?php if(!empty($per[$i])){ echo $per[$i]; }?>" class="form-control shadow-none" onkeyup="ProductRowCheck(this);">
                                                                <label>Per</label>
                                                                <div class="input-group-append" style="width:50%!important;">
                                                                    <select name="per_type[]" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="ProductRowCheck(this);">
                                                                        <option value="1" <?php if(!empty($per_type[$i]) && $per_type[$i] == '1'){ ?>selected<?php } ?>><?php if(!empty($per_unit_name)){ echo $obj->encode_decode("decrypt",$per_unit_name); } ?></option>
                                                                        <option value="2" <?php if(!empty($per_type[$i]) && $per_type[$i] == '2'){ ?>selected<?php } ?>><?php if(!empty($per_subunit_name)){ echo $obj->encode_decode("decrypt",$per_subunit_name); } ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                <?php } else { ?>
                                                    <td class="tax_element d-none">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border mb-0">
                                                                <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);">
                                                                    <option value="">Select Tax</option>
                                                                    <option value="0%">0%</option>
                                                                    <option value="5%">5%</option>
                                                                    <option value="12%">12%</option>
                                                                    <option value="18%">18%</option>
                                                                    <option value="28%">28%</option>
                                                                </select>
                                                                <label>Select Tax</label>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <p class="final_rate"><?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?></p>
                                                    <input type="hidden" id="final_rate[]" name="final_rate[]" value="<?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <td>
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
                            <tfoot>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end sub_tot"> Total : </td>
                                    <td colspan="1" class="text-end sub_total"></td>
                                </tr>
                                <?php if(!empty($agent_commission)){ ?>
                                <tr style="color:green;" class="agent_tr <?php if(empty($agent_id) || $agent_id == "NULL"){ ?>d-none<?php } ?>">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end agent_commission">
                                        Commission : <?php if(!empty($agent_commission)){ if(strpos($agent_commission, "%") !== false) { echo $agent_commission; } else { echo $agent_commission . "%"; }}?>
                                    </td>
                                    <input type="hidden" name="agent_commission" value="<?php if(!empty($agent_commission)){ echo $agent_commission; }?>">
                                    <td class="text-end ">
                                        <span class="commission_total"><?php if(!empty($agent_commission_value)){ echo $agent_commission_value; }?></span>
                                    </td>
                                </tr>
                                <?php } ?>
                                <input type="hidden" name="charges_count" value="<?php if(!empty($charges_count)) { echo $charges_count - 1; } else { echo '0'; } ?>">
                                <?php 
                                    $count = 1;
                                    if(!empty($other_charges_id) && !empty($show_estimate_id)) {
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
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end round">Round OFF :</td>
                                    <td colspan="1" class="text-end round_off"></td>
                                </tr>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end grand_total">Total :</td>
                                    <td colspan="1" class="text-end"><i class="bi bi-currency-rupee text-danger me-2"></i><span class="overall_total"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'estimate_form', 'estimate_changes.php', 'estimate.php');">
                        Submit
                    </button>
                </div>
            </div>
        </form>       
        <script>
            jQuery(document).ready(function(){
                <?php if(!empty($show_estimate_id)) { ?> calTotal(); <?php }?>
            });
        </script>                    
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
    <?php 
    }


    if(isset($_POST['edit_id'])) {
        // Strings
        $delivery_slip_id = ""; $delivery_slip_date = ""; $delivery_slip_date_error = ""; $delivery_slip_number = ""; $delivery_slip_number_error = "";  $customer_id = ""; $customer_id_error = "";  $agent_id = ""; $agent_id_error = ""; $transport_id = ""; $bank_id = ""; $bank_id_error = "";  $valid_estimate = "";  $edit_id = ""; $estimate_error = ""; $draft = "0"; $price_type_error = ""; $price_type = ""; $gst_option = ""; $address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $product_count = ""; $charges_count = ""; $agent_commission = ""; $company_state = ""; $party_state = ""; $product_error = ""; $estimate_id = ""; $estimate_number = ""; $proforma_invoice_id = "";
        
        // Arrays
        $product_ids = array(); $unit_types = array(); $unit_ids = array(); $unit_names = array(); $subunit_need = array(); $quantity = array(); $old_quantity = array(); $contents = array(); $rates = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array(); $charges_type = array(); $other_charges_values = array(); $other_charges_total = array(); $product_names = array(); $indv_magazine_id = array();
       
        // Doubles
        $total_amount = 0; $round_off = 0; $grand_total = 0; $total_unit_qty = 0; $sub_total = 0; $total_tax_value = 0; $cgst_value = 0; $sgst_value = 0; $igst_value = 0;
       
        // Statics
        $form_name = "estimate_form"; $current_date = date('Y-m-d'); 

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['delivery_slip_id'])) {
            $delivery_slip_id = $_POST['delivery_slip_id'];
            $delivery_slip_id = trim($delivery_slip_id);
        }

        if(isset($_POST['proforma_invoice_id'])) {
            $proforma_invoice_id = $_POST['proforma_invoice_id'];
            $proforma_invoice_id = trim($proforma_invoice_id);
        }

        if(isset($_POST['estimate_date'])) {
            $estimate_date = $_POST['estimate_date'];
            $estimate_date = trim($estimate_date);
            $estimate_date_error = $valid->valid_date($estimate_date, 'Bill Date', '1');
            if(empty($estimate_date_error)) {
                if($estimate_date > $current_date) {
                    $estimate_date_error = "Future Date not allowed";
                }
            }
        }

        if(!empty($estimate_date_error)) {
            if(!empty($valid_estimate)) {
                $valid_estimate = $valid_estimate." ".$valid->error_display($form_name, "estimate_date", $estimate_date_error, 'text');
            }
            else {
                $valid_estimate = $valid->error_display($form_name, "estimate_date", $estimate_date_error, 'text');
            }
        }

        if(isset($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
            $customer_id = trim($customer_id);
            $customer_id_error = $valid->common_validation($customer_id, 'Customer', 'select');
        }

        if(!empty($customer_id_error)) {
            if(!empty($valid_estimate)) {
                $valid_estimate = $valid_estimate." ".$valid->error_display($form_name, "customer_id", $customer_id_error, 'select');
            }
            else {
                $valid_estimate = $valid->error_display($form_name, "customer_id", $customer_id_error, 'select');
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
            if(!empty($valid_estimate)) {
                $valid_estimate = $valid_estimate." ".$valid->error_display($form_name, "agent_id", $agent_id_error, 'select');
            }
            else {
                $valid_estimate = $valid->error_display($form_name, "agent_id", $agent_id_error, 'select');
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
            if(!empty($valid_estimate)) {
                $valid_estimate = $valid_estimate." ".$valid->error_display($form_name, "bank_id", $bank_id_error, 'select');
            }
            else {
                $valid_estimate = $valid->error_display($form_name, "bank_id", $bank_id_error, 'select');
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

        // if(isset($_POST['indv_magazine_id'])) {
        //     $indv_magazine_id = $_POST['indv_magazine_id'];
        //     if(!empty($indv_magazine_id)){
        //         $indv_magazine_id = array_reverse($indv_magazine_id);
        //     }
        // }

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
        }

        if(isset($_POST['charges_type'])) {
            $charges_type = $_POST['charges_type'];
        }   
        
        if(isset($_POST['other_charges_value'])) {
            $other_charges_values = $_POST['other_charges_value'];
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
                                                                    
                                                                    $tax = "";
                                                                    if($tax_type == '1') {
                                                                        if(!empty($product_tax[$i])) {
                                                                            $tax = $product_tax[$i];
                                                                        } else {
                                                                            $product_error = "Select Tax for product - ".($obj->encode_decode('decrypt', $product_name));
                                                                        }
                                                                    } else {
                                                                        $tax = $overall_tax;
                                                                    }

                                                                    if($tax_option == '2') {
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
                                $product_error = "New quantity must be lesser than or equal to old quantity - ".($obj->encode_decode('decrypt', $product_name));
                            }
                        } else {
                            $product_error = "Invalid quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    } else {
                        $product_error = "Empty quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
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

        $agent_commission_value = 0;
        if(!empty($agent_commission)){
            $agent_commission = str_replace('%', '', $agent_commission);
            $agent_commission = trim($agent_commission);
            if(!empty($total_amount)){
                $agent_commission_value = ($total_amount * $agent_commission) / 100;
                $before_charges_total = $total_amount - $agent_commission_value;
                $total_amount = $before_charges_total;
            }
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
                            if($other_charges_value >= 100) {
                                $proforma_invoice_error = $obj->encode_decode('decrypt', $other_charges_names[$i]) . " cannot be above 100%";
                            }
                            $other_charges_value = trim($other_charges_value);
                        } else {
                            $other_charges_value = $other_charges_values[$i];
                        }
                        $other_charges_error = $valid->valid_price($other_charges_value, ($obj->encode_decode('decrypt', $other_charges_name)), 1, '');
                        if(!empty($other_charges_error)) {
                            if(!empty($estimate_error)) {
                                $estimate_error = $estimate_error."<br>".$other_charges_error;
                            } else {
                                $estimate_error = $other_charges_error;
                            }
                        } else {
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_charges_value = ($other_charges_value * $total_amount) / 100;
                                $other_charges_value = number_format($other_charges_value, 2);
                                $other_charges_value = str_replace(",", "", $other_charges_value);
                            }
                        }
                    }
                    if(empty($estimate_error)) {
                        $other_charges_total[$i] = $other_charges_value;
                        if($charges_type[$i] == "minus") {
                            $total_amount -= $other_charges_value;
                        } else if($charges_type[$i] == "plus") {
                            $total_amount += $other_charges_value;
                        }
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                // if(empty($estimate_error)) {
                    for($j=$i+1; $j < count($other_charges_id); $j++) {
                        if($other_charges_id[$i] == $other_charges_id[$j]) {
                            $estimate_error = "Same Charges Repeatedly Exists";
                            break;
                        }
                    }
                // }
            }
        }
        $total_amount = number_format((float)$total_amount, 2, '.', '');
        $grand_total = $total_amount;


        if($gst_option == '1' && empty($product_error) && empty($valid_estimate)) {
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
                        if (!empty($estimate_error)) {
                            $estimate_error = $estimate_error . "<br>" . $tax_error;
                        } else {
                            $estimate_error = $tax_error;
                        }
                    }
                }
            } else if($tax_type == '2') {
                $tax = "";
                $tax = str_replace("%", "", $overall_tax);
                $tax = trim($tax);
                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $tax)) {
                    $total_tax_value = ($tax * $grand_total) / $percentage;
                } else {
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
                        } else {
                            $round_off = "0.".$round_off;
                        }
                        $total_amount = $total_amount + $round_off;
                    } else {
                        $decimal = "0.".$decimal;
                        $round_off = "-".$decimal;
                        $total_amount = $total_amount - $decimal;
                    }
                }
            }
        }
        
        $result = "";

        if(empty($valid_estimate) && empty($product_error) && empty($estimate_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) { 
                $customer_name_mobile_city = ""; $customer_details = "";
                $agent_name_mobile_city = ""; $agent_details = "";
                if(!empty($delivery_slip_id)) {
                    $delivery_slip_number = $obj->getTableColumnValue($GLOBALS['delivery_slip_table'], 'delivery_slip_id', $delivery_slip_id, 'delivery_slip_number');
                }

                if(!empty($estimate_date)) {
                    $estimate_date = date('Y-m-d', strtotime($estimate_date));
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

                // if(!empty($indv_magazine_id)) {
                //     $indv_magazine_id = array_reverse($indv_magazine_id);
                //     $indv_magazine_id = implode(",", $indv_magazine_id);
                // } else {
                //     $indv_magazine_id = $GLOBALS['null_value'];
                // }
               
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
                     
                if(!empty($charges_total_amounts)) {
                    $charges_total_amounts = implode(",", $charges_total_amounts);
                } else {
                    $charges_total_amounts = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($other_charges_total, fn($value) => $value !== ""))) {
                    $other_charges_total = implode(",", $other_charges_total);
                } else {
                    $other_charges_total = $GLOBALS['null_value'];
                }

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator']; $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']); $bill_company_id = $GLOBALS['bill_company_id']; $null_value = $GLOBALS['null_value']; $balance = 0; $estimate_insert_id = "";

                if(empty($edit_id)) {
                    $action = "";
                    if(!empty($customer_name_mobile_city) && $customer_name_mobile_city != $GLOBALS['null_value']) {
                        $action = "New estimate created. Party - ".($obj->encode_decode('decrypt', $customer_name_mobile_city));
                    }
                    
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'estimate_id', 'estimate_number', 'estimate_date', 'delivery_slip_id', 'delivery_slip_number', 'delivery_slip_date', 'proforma_invoice_id', 'customer_id', 'customer_name_mobile_city', 'customer_details', 'agent_id', 'agent_name_mobile_city', 'agent_details', 'transport_id', 'bank_id', 'gst_option', 'address', 'tax_option', 'tax_type', 'overall_tax',  'company_state', 'party_state', 'product_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount', 'other_charges_id', 'charges_type', 'other_charges_value', 'agent_commission', 'sub_total', 'grand_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'other_charges_total', 'bill_total', 'cancelled', 'deleted');
                    $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $bill_company_id . "'", "'" . $null_value . "'", "'" . $null_value . "'", "'" . $estimate_date . "'", "'" . $delivery_slip_id . "'", "'" . $delivery_slip_number . "'", "'" . $delivery_slip_date . "'", "'" . $proforma_invoice_id . "'", "'" . $customer_id . "'", "'" . $customer_name_mobile_city . "'", "'" . $customer_details . "'", "'" . $agent_id . "'", "'" . $agent_name_mobile_city . "'", "'" . $agent_details .  "'", "'" . $transport_id . "'" , "'" . $bank_id . "'" , "'" . $gst_option . "'" , "'" . $address . "'" , "'" . $tax_option . "'" ,"'" . $tax_type . "'", "'" . $overall_tax . "'" ,"'" . $company_state . "'" ,"'" . $party_state . "'" ,"'" . $product_ids . "'" , "'" . $product_names . "'", "'" . $unit_types . "'","'" . $subunit_need . "'","'" . $contents . "'","'" . $unit_ids . "'","'" . $unit_names . "'","'" . $quantity . "'","'" . $rates . "'","'" . $per . "'","'" . $per_type . "'","'" . $product_tax . "'","'" . $final_rate . "'","'" . $amount . "'","'" . $other_charges_id . "'","'" .  $charges_type . "'","'" . $other_charges_values . "'","'" . $agent_commission . "'", "'" . $sub_total . "'", "'" . $grand_total . "'", "'" . $cgst_value . "'", "'" . $sgst_value ."'", "'" . $igst_value . "'", "'" . $total_tax_value . "'", "'" . $round_off ."'", "'" . $other_charges_total . "'", "'" . $total_amount . "'", "'0'", "'0'");

                    $estimate_insert_id = $obj->InsertSQL($GLOBALS['estimate_table'], $columns, $values, 'estimate_id', 'estimate_number', $action);

                    if(preg_match("/^\d+$/", $estimate_insert_id)) {
                        $balance = 1;
                        $result = array('number' => '1', 'msg' => 'Estimate Successfully Created','redirection_page'=> 'estimate.php');
                    } else {
                        $result = array('number' => '2', 'msg' => $estimate_insert_id);
                    }
                } else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'estimate_id', $edit_id, 'id');
                    $estimate_number = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'estimate_id', $edit_id, 'estimate_number');

                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if(!empty($customer_name_mobile_city) && $customer_name_mobile_city != $GLOBALS['null_value']) {
                            $action = "Estimate Updated. Customer - ".($obj->encode_decode('decrypt', $customer_name_mobile_city));
                        }

                        $columns = array(); $values = array();		
                        $columns = array('estimate_date', 'gst_option', 'tax_option', 'tax_type', 'overall_tax',  'company_state', 'party_state', 'product_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount', 'other_charges_id', 'charges_type', 'other_charges_value', 'agent_commission','sub_total', 'grand_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'other_charges_total', 'bill_total');
                        $values = array("'" . $estimate_date . "'", "'" . $gst_option . "'" , "'" . $tax_option . "'" ,"'" . $tax_type . "'", "'" . $overall_tax . "'" ,"'" . $company_state . "'" ,"'" . $party_state . "'" ,"'" . $product_ids . "'" , "'" . $product_names . "'", "'" . $unit_types . "'","'" . $subunit_need . "'","'" . $contents . "'","'" . $unit_ids . "'","'" . $unit_names . "'","'" . $quantity . "'","'" . $rates . "'","'" . $per . "'","'" . $per_type . "'","'" . $product_tax . "'","'" . $final_rate . "'","'" . $amount . "'","'" . $other_charges_id . "'","'" .  $charges_type . "'","'" . $other_charges_values . "'", "'" . $agent_commission . "'", "'" . $sub_total . "'", "'" . $grand_total . "'", "'" . $cgst_value . "'", "'" . $sgst_value ."'", "'" . $igst_value . "'", "'" . $total_tax_value . "'", "'" . $round_off ."'", "'" . $other_charges_total . "'", "'" . $total_amount . "'");
                        $estimate_update_id = $obj->UpdateSQL($GLOBALS['estimate_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $estimate_update_id)) {
                            $balance = 1;
                            $result = array('number' => '1', 'msg' => 'Estimate Updated Successfully','redirection_page'=> 'estimate.php');
                        } else {
                            $result = array('number' => '2', 'msg' => $estimate_update_id);
                        }							
                    }
                }

                $balance = 1;
                if(!empty($balance) && $balance == 1) {
                    $bill_id = ""; $bill_number = ""; $bill_date = date('Y-m-d'); $credit  = 0; $debit = 0; $bill_type = "Estimate";

                    $debit = $total_amount; 
                    $opening_balance_type = 'Debit';
                    if(empty($credit)) { $credit = 0; }
                    if(empty($debit)) { $debit = 0; }
                    if(empty($opening_balance)) { $opening_balance = 0; }
                    if(empty($opening_balance_type)) { $opening_balance_type = $GLOBALS['null_value']; }
                    if(empty($edit_id)){
                        if(!empty($estimate_insert_id)) {
                            $estimate_number = "";
                            $estimate_number = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'id', $estimate_insert_id, 'estimate_number');

                            $estimate_id = "";
                            $estimate_id = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'id', $estimate_insert_id, 'estimate_id');   
                            
                            if(!empty($estimate_id)) {
                                $bill_id = $estimate_id;
                            }
                            if(!empty($estimate_number)) {
                                $bill_number = $estimate_number;
                            }
                        }
                    } else {
                        $estimate_number = "";
                        $estimate_number = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'estimate_id', $edit_id, 'estimate_number');
                        if(!empty($edit_id)) {
                            $bill_id = $edit_id;
                        }
                        if(!empty($estimate_number)) {
                            $bill_number = $estimate_number;
                        }
                    }

                    $customer_name = "";
                    $customer_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'customer_name');

                    if(!empty($agent_id)) {
                        $agent_name = "";
                        $agent_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'agent_name');

                        $obj->UpdateBalance($bill_id, $bill_number, $bill_date, $bill_type,  $agent_id, $agent_name, $GLOBALS['null_value'], $GLOBALS['null_value'],'Agent', $GLOBALS['null_value'], $GLOBALS['null_value'], $GLOBALS['null_value'], $GLOBALS['null_value'], $credit, $debit, $opening_balance_type);
                    } else {
                        $update_balance = "";                    
                        $update_balance = $obj->UpdateBalance($bill_id, $bill_number, $bill_date, $bill_type, $GLOBALS['null_value'], $GLOBALS['null_value'], $customer_id, $customer_name, 'Customer', $GLOBALS['null_value'], $GLOBALS['null_value'], $GLOBALS['null_value'], $GLOBALS['null_value'], $credit, $debit, $opening_balance_type);    
                    }
                }
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_estimate)) {
                $result = array('number' => '3', 'msg' => $valid_estimate);
            } else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            } else if(!empty($estimate_error)) {
                $result = array('number' => '2', 'msg' => $estimate_error);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }

    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number']; $page_limit = $_POST['page_limit']; $page_title = $_POST['page_title'];
        $from_date = ""; $to_date = ""; $search_text = ""; $show_bill = 0; $agent_id = "";$transport_id = "";
        $customer_id = "";
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

        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }
        if(isset($_POST['agent_id'])) {
            $agent_id = $_POST['agent_id'];
        }
        if(isset($_POST['transport_id'])) {
            $transport_id = $_POST['transport_id'];
        }
        $total_records_list = array();
        $total_records_list = $obj->getEstimateList($from_date, $to_date, $customer_id, $search_text, $show_bill, $agent_id, $transport_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['estimate_number']), $search_text) !== false) ) {
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
			} else {
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
                    <th>Amount</th>
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
                                    if(!empty($list['estimate_number']) && $list['estimate_number'] != $GLOBALS['null_value']) {
                                        echo $list['estimate_number'];
                                    }
                                ?>
                                <br>
                                <?php
                                    if(!empty($list['estimate_date'])) {
                                        echo date('d-m-Y', strtotime($list['estimate_date']));
                                    }
                                    if(!empty($list['deleted'])) {
                                        ?>
                                            <br><span style="color: red;">Cancelled</span>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['customer_name_mobile_city']) && $list['customer_name_mobile_city'] != $GLOBALS['null_value']) {
                                        echo html_entity_decode($obj->encode_decode('decrypt', $list['customer_name_mobile_city']));
                                    } else {
                                        echo '-';
                                    }
                                
                                if(!empty($list['cancelled'])) {
                                    ?>
                                        <span style="color: red;">Cancelled</span>
                                    <?php	
                                }	 ?>
                            </td>
                            
                            <td>
                                <?php
                                    if(!empty($list['bill_total'])) {
                                        echo number_format($list['bill_total'],2);
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </td>

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
                                        ?>
                                        <div class="dropdown">
                                            <button class="btn btn-dark show-button" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <li>
                                                    <a class="dropdown-item" href="#" onclick="window.open('reports/rpt_estimate_a4.php?estimate_id=<?php if(!empty($list['estimate_id'])) { echo $list['estimate_id']; } ?>')"><i class="fa fa-print"></i> &ensp;Print</a>
                                                </li>
                                                <?php 
                                                    if(($show_bill == 0)){
                                                        if(empty($edit_access_error)) {
                                                            ?>
                                                            <li>
                                                                <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['estimate_id'])) { echo $list['estimate_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                            </li>
                                                            <?php
                                                        } 
                                                    }
                                                ?>  
                                                 <?php 
                                                    if(($show_bill == 0)){
                                                        if(empty($delete_access_error)) {
                                                            ?>
                                                                <li>
                                                                    <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['estimate_id'])) { echo $list['estimate_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
                                                                </li>  
                                                            <?php
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

    if(isset($_REQUEST['delete_estimate_id'])) {
        $delete_estimate_id = $_REQUEST['delete_estimate_id'];
        $msg = "";
        if(!empty($delete_estimate_id)) {
            $estimate_unique_id = "";
            $estimate_unique_id = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'estimate_id', $delete_estimate_id, 'id');
            if(preg_match("/^\d+$/", $estimate_unique_id)) {
                $estimate_number = "";
                $estimate_number = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'estimate_id', $delete_estimate_id, 'estimate_number');
    
                $payment_unique_id = "";
                $payment_unique_id = $obj->getTableColumnValue($GLOBALS['payment_table'], 'bill_id', $delete_estimate_id, 'id');

                if(!empty($payment_unique_id)) {
                    $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, array('deleted'), array("'1'"), "Payment Deleted");
                }

                $action = "";
                if(!empty($estimate_number)) {
                    $action = "Estimate Deleted. Name - " . $estimate_number;
                }

                $columns = array();
                $values = array();
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['estimate_table'], $estimate_unique_id, $columns, $values, $action);
            }
        }
        echo $msg;
        exit;
    }