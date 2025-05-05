<?php
	include("include.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['proforma_invoice_module'];
        }
    }

	if(isset($_REQUEST['show_proforma_invoice_id'])) { 
        $show_proforma_invoice_id = $_REQUEST['show_proforma_invoice_id'];
        $current_date = date('Y-m-d');
        $proforma_invoice_number = ""; $proforma_invoice_date = date('Y-m-d'); $customer_id = ""; $agent_id = ""; $transport_id = ""; $bank_id = ""; $magazine_type = ""; $magazine_id = ""; $gst_option = 0;$address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $indv_magazine_ids = array(); $product_names = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array();
        $unit_names = array(); $quantity = array(); $rate = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array();$charges_type = array(); $other_charges_value = array(); $agent_commission = ""; $bill_total = "";$charges_count = 0; $ds_product_ids = array();

        if(!empty($show_proforma_invoice_id)) {
            $proforma_invoice_list = $obj->getTableRecords($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $show_proforma_invoice_id, '');
            if(!empty($proforma_invoice_list)) {
                foreach($proforma_invoice_list as $pi) {
                    if(!empty($pi['proforma_invoice_number'])) {
                        $proforma_invoice_number = $pi['proforma_invoice_number'];
                    }
                    if(!empty($pi['customer_id'])) {
                        $customer_id = $pi['customer_id'];
                    }
                    if(!empty($pi['proforma_invoice_date'])) {
                        $proforma_invoice_date = date('Y-m-d', strtotime($pi['proforma_invoice_date']));
                    }
                    if(!empty($pi['agent_id'])) {
                        $agent_id = $pi['agent_id'];
                    }
                    if(!empty($pi['transport_id'])) {
                        $transport_id = $pi['transport_id'];
                    }
                    if(!empty($pi['bank_id'])) {
                        $bank_id = $pi['bank_id'];
                    }
                    if(!empty($pi['magazine_type'])) {
                        $magazine_type = $pi['magazine_type'];
                    }
                    if(!empty($pi['magazine_id'])) {
                        $magazine_id = $pi['magazine_id'];
                    }
                    if(!empty($pi['gst_option'])) {
                        $gst_option = $pi['gst_option'];
                    }
                    if(!empty($pi['address'])) {
                        $address = $pi['address'];
                    }
                    if(!empty($pi['tax_option'])) {
                        $tax_option = $pi['tax_option'];
                    }
                    if(!empty($pi['tax_type'])) {
                        $tax_type = $pi['tax_type'];
                    }
                    if(!empty($pi['overall_tax'])) {
                        $overall_tax = $pi['overall_tax'];
                    }
                    if(!empty($pi['company_state'])) {
                        $company_state = $pi['company_state'];
                    }
                    if(!empty($pi['party_state'])) {
                        $party_state = $pi['party_state'];
                    }
                    if(!empty($pi['product_id'])) {
                        $product_ids = $pi['product_id'];
                        $product_ids = explode(",", $product_ids);
                        $product_ids = array_reverse($product_ids);
                    }
                    if(!empty($pi['indv_magazine_id'])) {
                        $indv_magazine_ids = $pi['indv_magazine_id'];
                        $indv_magazine_ids = explode(",", $indv_magazine_ids);
                        $indv_magazine_ids = array_reverse($indv_magazine_ids);
                    }
                    if(!empty($pi['product_name'])) {
                        $product_names = $pi['product_name'];
                        $product_names = explode(",", $product_names);
                        $product_names = array_reverse($product_names);
                    }
                    if(!empty($pi['unit_type'])) {
                        $unit_types = $pi['unit_type'];
                        $unit_types = explode(",", $unit_types);
                        $unit_types = array_reverse($unit_types);
                    }
                    if(!empty($pi['subunit_need'])) {
                        $subunit_needs = $pi['subunit_need'];
                        $subunit_needs = explode(",", $subunit_needs);
                        $subunit_needs = array_reverse($subunit_needs);
                    }
                    if(!empty($pi['content'])) {
                        $contents = $pi['content'];
                        $contents = explode(",", $contents);
                        $contents = array_reverse($contents);
                    }
                    if(!empty($pi['unit_id'])) {
                        $unit_ids = $pi['unit_id'];
                        $unit_ids = explode(",", $unit_ids);
                        $unit_ids = array_reverse($unit_ids);
                    }
                    if(!empty($pi['unit_name'])) {
                        $unit_names = $pi['unit_name'];
                        $unit_names = explode(",", $unit_names);
                        $unit_names = array_reverse($unit_names);
                    }
                    if(!empty($pi['quantity'])) {
                        $quantity = $pi['quantity'];
                        $quantity = explode(",", $quantity);
                        $quantity = array_reverse($quantity);
                    }
                    if(!empty($pi['rate'])) {
                        $rate = $pi['rate'];
                        $rate = explode(",", $rate);
                        $rate = array_reverse($rate);
                    }       
                    if(!empty($pi['per'])) {
                        $per = $pi['per'];
                        $per = explode(",", $per);
                        $per = array_reverse($per);
                    }    
                    if(!empty($pi['per_type'])) {
                        $per_type = $pi['per_type'];
                        $per_type = explode(",", $per_type);
                        $per_type = array_reverse($per_type);
                    }     
                    if(!empty($pi['product_tax'])) {
                        $product_tax = $pi['product_tax'];
                        $product_tax = explode(",", $product_tax);
                        $product_tax = array_reverse($product_tax);
                    }     
                    if(!empty($pi['final_rate'])) {
                        $final_rate = $pi['final_rate'];
                        $final_rate = explode(",", $final_rate);
                        $final_rate = array_reverse($final_rate);
                    }      
            
                    if(!empty($pi['amount'])) {
                        $amount = $pi['amount'];
                        $amount = explode(",", $amount);
                        $amount = array_reverse($amount);
                    }
                    
                    if(!empty($pi['other_charges_id'])) {
                        $other_charges_id = $pi['other_charges_id'];
                        $other_charges_id = explode(",", $other_charges_id);
                        $other_charges_id = array_reverse($other_charges_id);
                        $charges_count = count($other_charges_id);
                    }      
            
                    if(!empty($pi['charges_type'])) {
                        $charges_type = $pi['charges_type'];
                        $charges_type = explode(",", $charges_type);
                        $charges_type = array_reverse($charges_type);
                    } 
                    if(!empty($pi['other_charges_value'])) {
                        $other_charges_value = $pi['other_charges_value'];
                        $other_charges_value = explode(",", $other_charges_value);
                        $other_charges_value = array_reverse($other_charges_value);
                    }    
                    if(!empty($pi['agent_commission'])) {
                        $agent_commission = $pi['agent_commission'];
                    }
                }
            }
            $ds_product_ids = $obj->getDeliveryProductsFromPI($show_proforma_invoice_id);
        }

        $customer_list = array();
        $customer_list = $obj->getCustomerList();
        $charges_list = array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');
        $agent_list = array();
        $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '', '');
        $transport_list = array();
        $transport_list = $obj->getTableRecords($GLOBALS['transport_table'], '', '', '');
        $magazine_list = array();
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');
        $other_charges_list = array();
        $other_charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');
        $bank_list = array();
        $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '', '', '');
        $finished_group_list = array();
        $finished_group_list = $obj->getTableRecords($GLOBALS['finished_group_table'], '', '', '');
        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '');
        $country = "India"; $state = "";
        $company_state = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'state');
        if(!empty($company_state)) {
			$company_state = $obj->encode_decode('decrypt', $company_state);
		}

    ?>
        <form class="poppins pd-20" name="proforma_invoice_form" method="POST">
            <div class="card-header">
                <div class="row p-2">
                    <div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <div class="h5">Add Proforma Invoice</div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('proforma_invoice.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_proforma_invoice_id)) { echo $show_proforma_invoice_id; } ?>">    
                <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } else { echo "Tamil Nadu"; } ?>">  
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="proforma_invoice_date" class="form-control shadow-none" placeholder="" value="<?php if (!empty($proforma_invoice_date)) { echo $proforma_invoice_date; } ?>" required=""  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
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
                        <div class="form-label-group in-border pb-1">
                            <select class="select2 select2-danger" name="customer_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:changeState();">
                                <option value="">Select Customer</option>
                                <?php if (!empty($customer_list)) {
                                    foreach ($customer_list as $customer) { ?>
                                        <option value="<?php if (!empty($customer['customer_id'])) {
                                            echo $customer['customer_id'];
                                        } ?>" <?php if(!empty($customer_id) && $customer_id == $customer['customer_id']) { echo "selected"; } ?>>
                                            <?php
                                                if(!empty($customer['name_mobile_city']) && $customer['name_mobile_city'] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $customer['name_mobile_city']);
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
                        <div class="form-label-group in-border">
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
                        <div class="form-label-group in-border">
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
                                <option value="1">Overall Magazie</option>
                                <option value="2">Productwise Magazie</option>
                            </select>
                            <label>Select Magazine<span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 overall_magazine d-none">
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
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"><?php if(!empty($address)) { echo $address; } ?></textarea>
                            <label>Delivery Address</label>
                        </div>
                    </div>
                </div>
                <?php /* <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 <?php if($gst_option !='1'){?>d-none<?php } ?> tax_cover1" id="tax_option_div"> */ ?>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 d-none tax_cover1" id="tax_option_div">
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
                <?php /* <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>"> */ ?>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 tax_cover d-none">
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
                <?php /* <div class="col-lg-2 col-md-3 col-6 py-2 <?php if($tax_type !='2'){ ?>d-none <?php } ?> tax_cover2"> */ ?>
                <div class="col-lg-2 col-md-3 col-6 py-2 d-none tax_cover2">
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
            <div class="row justify-content-center p-3">
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_finished_group_id" data-dropdown-css-class="select2-danger"
                                data-placeholder="Select a Finished Group" style="width: 100%;"
                                onchange="GetFinishedGroupProducts();">
                                <option value="">Select</option>
                                <?php if (!empty($finished_group_list)) {
                                    foreach ($finished_group_list as $fg) { ?>
                                        <option value="<?php if (!empty($fg['finished_group_id'])) {
                                            echo $fg['finished_group_id'];
                                        } ?>">
                                            <?php if (!empty($fg['finished_group_name'])) {
                                                echo $obj->encode_decode('decrypt', $fg['finished_group_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Finished Group</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_product_id" data-dropdown-css-class="select2-danger"
                                data-placeholder="Select a State" style="width: 100%;"
                                onchange="GetProdetails();CalProductAmount();">
                                <option value="">Select Product</option>
                                <?php if (!empty($product_list)) {
                                    foreach ($product_list as $Pro_list) { ?>
                                        <option value="<?php if (!empty($Pro_list['product_id'])) {
                                            echo $Pro_list['product_id'];
                                        } ?>">
                                            <?php if (!empty($Pro_list['product_name'])) {
                                                echo $obj->encode_decode('decrypt', $Pro_list['product_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Product</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-1 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" onchange="CalProductAmount();" name="selected_unit_type" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="1">Unit</option>
                                <option value="2">Sub Unit</option>
                            </select>
                            <label>Type</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_quantity" class="form-control shadow-none" onkeyup="CalProductAmount();" required="">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2 content_td">
                        <div class="form-group">
                            <?php /*
                            <div class="form-label-group in-border">
                                <input type="text" name="selected_content" onkeyup="CalProductAmount();" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
                                <label>Content</label>
                            </div>
                            */ ?>
                            <div class="form-label-group in-border">
                                <select class="select2 select2-danger" onchange="CalProductAmount();" name="selected_content" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">Select</option>
                                </select>
                                <label>Content</label>
                            </div>
                        </div>  
                    </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="number" name="selected_sales_rate" onkeyup="CalProductAmount();" class="form-control shadow-none" required="">
                            <label>Rate</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="" name="selected_per" onkeyup="CalProductAmount();"
                                    class="form-control shadow-none">
                                <label>Per</label>
                                <div class="input-group-append" style="width:50%!important;">
                                    <select name="selected_per_type" class="select2 select2-danger select2-hidden-accessible"
                                        data-dropdown-css-class="select2-danger" onchange="CalProductAmount();"
                                        style="width: 100%;">
                                        <option value="1">Unit</option>
                                        <option value="2">Sub Unit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <input type="hidden" name="selected_subunit_need" id="subunit_need" value="">
                <input type="hidden" name="selected_final_rate" id="final_rate" value="">
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="number" id="selected_amount" name="selected_amount" class="form-control shadow-none" readonly>
                            <label>Amount</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-4 py-2 px-lg-1 text-center">
                    <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddproformaProducts(event);">
                        Add
                    </button>
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
                                    <th>#</th>
                                    <th style="width: 150px;">Product</th>
                                    <!-- <th style="width: 100px;" class="indv_magazine d-none">Magazine</th> -->
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

                                        for($i =0; $i < $product_count; $i++){
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
                                                <th class="text-center px-2 py-2">
                                                    <?php if($unit_types[$i] == '1'){
                                                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_id');
                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');
                                                    }
                                                    elseif($unit_types[$i] == '2')
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
                                                    <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);" <?php if(!empty($ds_product_ids) && in_array($product_ids[$i], $ds_product_ids)) { ?> readonly <?php } ?>>
                                                </th>
                                                <th class="text-center px-2 py-2">
                                                    <input type="hidden" name="content[]" class="form-control shadow-none" value="<?php if(!empty($contents[$i])) { echo $contents[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">

                                                    <?php if(!empty($contents[$i])) { echo $contents[$i]; } ?>
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
                                                <td>
                                                    <p class="final_rate"><?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?></p>
                                                    <input type="hidden" id="final_rate[]" name="final_rate[]" value="<?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <td>
                                                    <p class="amount"><?php if(!empty($amount[$i])){ echo $amount[$i]; }?></p>
                                                    <input type="hidden" id="amount[]" name="amount[]" value="<?php if(!empty($amount[$i])){ echo $amount[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <th class="text-center px-2 py-2" style="<?php if(!empty($ds_product_ids) && in_array($product_ids[$i], $ds_product_ids)) { echo "pointer-events: none; background-color: #e9ecef;"; } ?>">
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
                                <!-- <tr style="color:green;" class="agent_tr <?php if(empty($agent_id) || $agent_id == "NULL"){ ?>d-none<?php } ?>"> -->
                                <tr style="color:green;" class="d-none">
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
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'proforma_invoice_form', 'proforma_invoice_changes.php', 'proforma_invoice.php');">
                        Submit
                    </button>
                </div>
            </div>
        </form>       
        <script>
            jQuery(document).ready(function(){
                <?php if(!empty($show_proforma_invoice_id)) { ?> calTotal(); <?php }?>
            });
        </script>                    
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
    <?php 
    }

    if(isset($_POST['edit_id'])) {
        // Strings
        $proforma_invoice_date = ""; $proforma_invoice_date_error = ""; $proforma_invoice_number = ""; $proforma_invoice_number_error = "";  $customer_id = ""; $customer_id_error = "";  $agent_id = ""; $agent_id_error = ""; $transport_id = ""; $bank_id = ""; $bank_id_error = "";  $valid_proforma_invoice = "";  $edit_id = ""; $proforma_invoice_error = ""; $draft = "0"; $price_type_error = ""; $price_type = ""; /* $magazine_type = 0; $magazine_id = ""; */ $gst_option = ""; $address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $product_count = ""; $charges_count = ""; $agent_commission = ""; $company_state = ""; $party_state = ""; $product_error = "";
        
        // Arrays
        $product_ids = array(); $unit_types = array(); $unit_ids = array(); $unit_names = array(); $subunit_need = array(); $quantity = array(); $contents = array(); $rates = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array(); $charges_type = array(); $other_charges_values = array();$other_charges_total = array(); $product_names = array(); $indv_magazine_id = array();
       
        // Doubles
        $total_amount = 0; $round_off = 0; $grand_total = 0; $total_unit_qty = 0; $sub_total = 0; $total_tax_value = 0; $cgst_value = 0; $sgst_value = 0; $igst_value = 0;
       
        // Statics
        $form_name = "proforma_invoice_form"; $current_date = date('Y-m-d'); 

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        
        if (isset($_POST['draft'])) {
            $draft = $_POST['draft'];
            $draft = trim($draft);
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
            if(!empty($valid_proforma_invoice)) {
                $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->error_display($form_name, "proforma_invoice_date", $proforma_invoice_date_error, 'text');
            }
            else {
                $valid_proforma_invoice = $valid->error_display($form_name, "proforma_invoice_date", $proforma_invoice_date_error, 'text');
            }
        }

        if(isset($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
            $customer_id = trim($customer_id);
            $customer_id_error = $valid->common_validation($customer_id, 'Customer', 'select');
        }

        if(!empty($customer_id_error)) {
            if(!empty($valid_proforma_invoice)) {
                $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->error_display($form_name, "customer_id", $customer_id_error, 'select');
            }
            else {
                $valid_proforma_invoice = $valid->error_display($form_name, "customer_id", $customer_id_error, 'select');
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
            if(!empty($valid_proforma_invoice)) {
                $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->error_display($form_name, "agent_id", $agent_id_error, 'select');
            }
            else {
                $valid_proforma_invoice = $valid->error_display($form_name, "agent_id", $agent_id_error, 'select');
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
            if(!empty($valid_proforma_invoice)) {
                $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->error_display($form_name, "bank_id", $bank_id_error, 'select');
            }
            else {
                $valid_proforma_invoice = $valid->error_display($form_name, "bank_id", $bank_id_error, 'select');
            }
        }

        // if(isset($_POST['magazine_type'])) {
        //     $magazine_type = $_POST['magazine_type'];
        //     $magazine_type = trim($magazine_type);
        // }

        // if(isset($_POST['magazine_id'])) {
        //     $magazine_id = $_POST['magazine_id'];
        //     $magazine_id = trim($magazine_id);
        // }

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
            for($i=0; $i < count($product_ids); $i++) {
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

                    $sub_unit_id = "";
                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');
                    
                    if(!empty($quantity[$i])) {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999){
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
    
        if(!empty($other_charges_total)) {
            $other_charges_total = array_sum($other_charges_total);
        } else {
            $other_charges_total = 0;
        }

        $total_amount = number_format((float)$total_amount, 2, '.', '');
        $grand_total = $total_amount;

        if($gst_option == '1' && empty($product_error) && empty($valid_proforma_invoice)) {
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
                        if (!empty($purchase_entry_error)) {
                            $purchase_entry_error = $purchase_entry_error . "<br>" . $tax_error;
                        } else {
                            $purchase_entry_error = $tax_error;
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
                }
                else {
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

        if(empty($valid_proforma_invoice) && empty($product_error) && empty($proforma_invoice_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) { 
                $customer_name_mobile_city = ""; $customer_details = "";
                $agent_name_mobile_city = ""; $agent_details = "";
                if(!empty($proforma_invoice_number)) {
                    $proforma_invoice_number = $obj->encode_decode('encrypt', $proforma_invoice_number);
                } else {
                    $proforma_invoice_number = $GLOBALS['null_value'];
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
                }
                else {
                    $customer_id = $GLOBALS['null_value'];
                    $customer_name_mobile_city = $GLOBALS['null_value'];
                    $customer_details = $GLOBALS['null_value'];
                }

                //'product_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount',
               
                if(!empty($product_ids)) {
                    $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                } else {
                    $product_ids = $GLOBALS['null_value'];
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

                // if(!empty($indv_magazine_id)) {
                //     $indv_magazine_id = array_reverse($indv_magazine_id);
                //     $indv_magazine_id = implode(",", $indv_magazine_id);
                // }else{
                //     $indv_magazine_id = $GLOBALS['null_value'];
                // }

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

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $bill_company_id = $GLOBALS['bill_company_id'];
                $null_value = $GLOBALS['null_value'];
                $proforma_invoice_number = $null_value;
                $proforma_invoice_insert_id = $null_value;
                $stock_conversion = 1;

                if(empty($edit_id)) {
                    $action = "";
                    if(!empty($customer_name_mobile_city) && $customer_name_mobile_city != $GLOBALS['null_value']) {
                        $action = "New proforma invoice Created. Party - ".($obj->encode_decode('decrypt', $customer_name_mobile_city));
                    }
                    
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'proforma_invoice_id', 'proforma_invoice_number', 'proforma_invoice_date',  'customer_id', 'customer_name_mobile_city', 'customer_details', 'agent_id', 'agent_name_mobile_city', 'agent_details', 'transport_id', 'bank_id', 'gst_option', 'address', 'tax_option', 'tax_type', 'overall_tax',  'company_state', 'party_state', 'product_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount', 'other_charges_id', 'charges_type', 'other_charges_value', 'agent_commission', 'sub_total', 'grand_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'other_charges_total', 'bill_total', 'cancelled', 'deleted');
                    $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $bill_company_id . "'", "'" . $null_value . "'", "'" . $proforma_invoice_number . "'", "'" . $proforma_invoice_date . "'", "'" . $customer_id . "'", "'" . $customer_name_mobile_city . "'", "'" . $customer_details . "'","'" . $agent_id . "'", "'" . $agent_name_mobile_city . "'", "'" . $agent_details .  "'", "'" . $transport_id . "'" , "'" . $bank_id . "'" , "'" . $gst_option . "'" , "'" . $address . "'" , "'" . $tax_option . "'" ,"'" . $tax_type . "'", "'" . $overall_tax . "'" ,"'" . $company_state . "'" ,"'" . $party_state . "'" ,"'" . $product_ids . "'" , "'" . $product_names . "'", "'" . $unit_types . "'","'" . $subunit_need . "'","'" . $contents . "'","'" . $unit_ids . "'","'" . $unit_names . "'","'" . $quantity . "'","'" . $rates . "'","'" . $per . "'","'" . $per_type . "'","'" . $product_tax . "'","'" . $final_rate . "'","'" . $amount . "'","'" . $other_charges_id . "'","'" .  $charges_type . "'","'" . $other_charges_values . "'", "'" . $agent_commission . "'","'" . $sub_total . "'", "'" . $grand_total . "'", "'" . $cgst_value . "'", "'" . $sgst_value ."'", "'" . $igst_value . "'", "'" . $total_tax_value . "'", "'" . $round_off ."'", "'" . $other_charges_total . "'", "'" . $total_amount . "'", "'0'", "'0'");

                    $proforma_invoice_insert_id = $obj->InsertSQL($GLOBALS['proforma_invoice_table'], $columns, $values, 'proforma_invoice_id', 'proforma_invoice_number', $action);

                    if(preg_match("/^\d+$/", $proforma_invoice_insert_id)) {
                        $stock_conversion = 1;
                        $result = array('number' => '1', 'msg' => 'Proforma Invoice Successfully Created','redirection_page'=>'proforma_invoice.php');
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $proforma_invoice_insert_id);
                    }
                } else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $edit_id, 'id');
                    $proforma_invoice_number = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $edit_id, 'proforma_invoice_number');

                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if(!empty($customer_name_mobile_city) && $customer_name_mobile_city != $GLOBALS['null_value']) {
                            $action = "Proforma invoice Updated. Customer - ".($obj->encode_decode('decrypt', $customer_name_mobile_city));
                        }

                        $columns = array(); $values = array();		
                        $columns = array('proforma_invoice_date',  'customer_id', 'customer_name_mobile_city', 'customer_details', 'agent_id', 'agent_name_mobile_city', 'agent_details', 'transport_id', 'bank_id', 'gst_option', 'address', 'tax_option', 'tax_type', 'overall_tax',  'company_state', 'party_state', 'product_id', 'product_name', 'unit_type', 'subunit_need', 'content', 'unit_id', 'unit_name', 'quantity', 'rate', 'per', 'per_type', 'product_tax', 'final_rate', 'amount', 'other_charges_id', 'charges_type', 'other_charges_value', 'agent_commission', 'sub_total', 'grand_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'other_charges_total', 'bill_total');
                        $values = array("'" . $proforma_invoice_date . "'", "'" . $customer_id . "'", "'" . $customer_name_mobile_city . "'", "'" . $customer_details . "'","'" . $agent_id . "'", "'" . $agent_name_mobile_city . "'", "'" . $agent_details .  "'", "'" . $transport_id . "'" , "'" . $bank_id . "'" , "'" . $gst_option . "'" , "'" . $address . "'" , "'" . $tax_option . "'" ,"'" . $tax_type . "'", "'" . $overall_tax . "'" ,"'" . $company_state . "'" ,"'" . $party_state . "'" ,"'" . $product_ids . "'" , "'" . $product_names . "'", "'" . $unit_types . "'","'" . $subunit_need . "'","'" . $contents . "'","'" . $unit_ids . "'","'" . $unit_names . "'","'" . $quantity . "'","'" . $rates . "'","'" . $per . "'","'" . $per_type . "'","'" . $product_tax . "'","'" . $final_rate . "'","'" . $amount . "'","'" . $other_charges_id . "'","'" .  $charges_type . "'","'" . $other_charges_values . "'","'" . $agent_commission . "'","'" . $sub_total . "'", "'" . $grand_total . "'", "'" . $cgst_value . "'", "'" . $sgst_value ."'", "'" . $igst_value . "'", "'" . $total_tax_value . "'", "'" . $round_off ."'", "'" . $other_charges_total . "'",  "'" . $total_amount . "'");

                        $proforma_invoice_update_id = $obj->UpdateSQL($GLOBALS['proforma_invoice_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $proforma_invoice_update_id)) {
                            $stock_conversion = 1;
                            $result = array('number' => '1', 'msg' => 'Proforma Invoice Updated Successfully','redirection_page'=> 'proforma_invoice.php');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $proforma_invoice_update_id);
                        }							
                    }
                }

                if (!empty($stock_conversion) && $stock_conversion == 1) {
                    $proforma_invoice_id = "";
                    if(empty($edit_id)){
                        if(!empty($proforma_invoice_insert_id)) {
                            $proforma_invoice_id = "";
                            $proforma_invoice_id = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'id', $proforma_invoice_insert_id, 'proforma_invoice_id');
                        }
                    } else {
                        $proforma_invoice_id = $edit_id;
                    }

                    $obj->UpdateConversionStock($proforma_invoice_id, "Proforma Invoice");
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_proforma_invoice)) {
                $result = array('number' => '3', 'msg' => $valid_proforma_invoice);
            } else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            } else if(!empty($proforma_invoice_error)) {
                $result = array('number' => '2', 'msg' => $proforma_invoice_error);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }

    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number']; $page_limit = $_POST['page_limit']; $page_title = $_POST['page_title'];
        $from_date = ""; $to_date = ""; $search_text = ""; $show_bill = 0; $agent_id = ""; $transport_id = "";
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
        $total_records_list = $obj->getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text, $show_bill, $agent_id, $transport_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['proforma_invoice_number']), $search_text) !== false) ) {
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
                    <th>Status</th>
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
                        $proforma_actions = array();
                        $proforma_actions = $obj->getProformaInvoiceActions($list['proforma_invoice_id']);
                        ?>
                        <tr>
                            <td>
                                <?php echo $index; ?>
                            </td>
                            <td> 
                                <?php
                                    if(!empty($list['proforma_invoice_number']) && $list['proforma_invoice_number'] != $GLOBALS['null_value']) {
                                        echo $list['proforma_invoice_number'];
                                    }
                                ?>
                                <br>
                                <?php
                                    if(!empty($list['proforma_invoice_date'])) {
                                        echo date('d-m-Y', strtotime($list['proforma_invoice_date']));
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['customer_name_mobile_city']) && $list['customer_name_mobile_city'] != $GLOBALS['null_value']) {
                                        echo ($obj->encode_decode('decrypt', $list['customer_name_mobile_city']));
                                    } else {
                                        echo '-';
                                    }
                                
                                if(!empty($list['cancelled'])) {
                                    ?>
                                    <br><span style="color: red;">Cancelled</span>
                                    <?php	
                                } ?>
                            </td>
                            <td> 
                                <?php 
                                    if(!empty($proforma_actions)) {
                                        $status_list = array();
                                        $status_list = $obj->getStatusInfo($list['proforma_invoice_id']); 

                                        if(!empty($status_list)) {
                                            ?>
                                            <div class="tooltip-container">
                                                <?php 
                                                    echo "(";
                                                    if(!empty($status_list['total_unit'])) {
                                                        echo $status_list['total_unit'];
                                                    }
                                                    if(!empty($status_list['total_sub_unit'])) {
                                                        echo " + " . $status_list['total_sub_unit'];
                                                    }
                                                    echo ") / ";
                                                    echo "(";
                                                    if(!empty($status_list['total_stock_unit'])) {
                                                        echo $status_list['total_stock_unit'];
                                                    }
                                                    if(!empty($status_list['total_stock_sub_unit'])) {
                                                        echo " + " . $status_list['total_stock_sub_unit'];
                                                    }
                                                    echo ")";
                                                ?>
                                                <div class="tooltip-text">
                                                    <?php
                                                        echo "( ";
                                                        if(!empty($status_list['total_unit'])) {
                                                            echo $status_list['total_unit'];
                                                        }
                                                        if(!empty($status_list['unit_name'])) {
                                                            echo " " . $status_list['unit_name'];
                                                        }
                                                        if(!empty($status_list['total_sub_unit'])) {
                                                            echo " + " . $status_list['total_sub_unit'];
                                                        }
                                                        if(!empty($status_list['sub_unit_name'])) {
                                                            echo " " . $status_list['sub_unit_name'];
                                                        }
                                                        echo " ) / (";
                                                        if(!empty($status_list['total_stock_unit'])) {
                                                            echo $status_list['total_stock_unit'];
                                                        }
                                                        if(!empty($status_list['stock_unit_name'])) {
                                                            echo " " . $status_list['stock_unit_name'];
                                                        }
                                                        if(!empty($status_list['total_stock_sub_unit'])) {
                                                            echo " + " . $status_list['total_stock_sub_unit'];
                                                        }
                                                        if(!empty($status_list['stock_sub_unit_name'])) {
                                                            echo " " . $status_list['stock_sub_unit_name'];
                                                        }
                                                        echo " )";
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                ?>
                                <br>
                                <a href="Javascript:ViewStatusDetails('<?php echo $list['proforma_invoice_id'] ?>');" class="order_details" style="font-size: 12px;font-weight: bold;"><i class="bi bi-info-circle text-dark"></i></a>
                                <?php } else {
                                    echo "-";
                                } ?>
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
                                <div class="dropdown">
                                    <button class="btn btn-dark show-button" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="window.open('reports/rpt_proforma_invoice_a4.php?proforma_invoice_id=<?php if(!empty($list['proforma_invoice_id'])) { echo $list['proforma_invoice_id']; } ?>')"><i class="fa fa-print"></i> &ensp;Print</a>
                                        </li>
                                        <?php
                                            if((!empty($proforma_actions) && ($show_bill == 0))) {
                                                if(in_array("convert", $proforma_actions)){
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:ShowConversion('<?php if(!empty($list['proforma_invoice_id'])) { echo $list['proforma_invoice_id']; } ?>', '<?php if(!empty($page_title)) { echo $page_title; } ?>');" ><i class="fa fa-undo" ></i>&ensp; Convert To Delivery Slip</a>
                                                        </li>
                                                    <?php
                                                }
                                            }
                                            if((!empty($proforma_actions) && ($show_bill == 0))) {
                                                if(in_array("edit", $proforma_actions)){
                                                    if(empty($edit_access_error)) { 
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['proforma_invoice_id'])) { echo $list['proforma_invoice_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                        </li>
                                                    <?php
                                                    }
                                                }
                                            }
                                            if((!empty($proforma_actions) && ($show_bill == 0))) {
                                                if(in_array("delete", $proforma_actions)){
                                                    if(empty($delete_access_error)) {
                                                        ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['proforma_invoice_id'])) { echo $list['proforma_invoice_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
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

    if(isset($_REQUEST['change_product_id'])) {
        $product_id =$_REQUEST['change_product_id'];
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
        $sales_rate = $unit_id = $subunit_id = $per = $per_type = $subunit_need = ""; $unit_name =""; $subunit_name ="";
        if (!empty($product_list)) {
            foreach ($product_list as $pl) {
                if (!empty($pl['unit_id'])) {
                    $unit_id = $pl['unit_id'];
                }
                if (!empty($pl['subunit_id'])) {
                    $subunit_id = $pl['subunit_id'];
                }
                if (!empty($pl['unit_name'])) {
                    $unit_name = $pl['unit_name'];
                    $unit_name = $obj->encode_decode("decrypt",$unit_name);
                }
                if (!empty($pl['subunit_name'])) {
                    $subunit_name = $pl['subunit_name'];
                    if(!empty($subunit_name) && $subunit_name != "NULL"){
                        $subunit_name = $obj->encode_decode("decrypt",$subunit_name);
                    }
                }
                if (!empty($pl['sales_rate'])) {
                    $sales_rate = $pl['sales_rate'];
                }
                if (!empty($pl['per'])) {
                    $per = $pl['per'];
                }
                if (!empty($pl['per_type'])) {
                    $per_type = $pl['per_type'];
                }
                if (!empty($pl['subunit_need'])) {
                    $subunit_need = $pl['subunit_need'];
                }
            }
        }
    
        $case_contents_list = array();
        if(!empty($subunit_need) && $subunit_need == "1") {
            $case_contents_query = "SELECT DISTINCT case_contains as case_contains FROM " . $GLOBALS['stock_by_magazine_table'] . " WHERE product_id = '" . $product_id . "' ORDER BY case_contains DESC";

            $case_contents_list = $obj->getQueryRecords('', $case_contents_query);
        }

        $type_option = "";
    
        ?>
            <option value="">Select</option>
            <option value="1" selected><?php if(!empty($unit_id)){ echo $unit_name; }?> </option>
            <?php
                if($subunit_need =='1')
                {
            ?>
            <option value="2"><?php if(!empty($subunit_id)){ echo $subunit_name; }?> </option>
            <?php } ?>
        <?php
        
        echo "$$$" . $sales_rate . "$$$" . $per . "$$$" . "$$$" . $subunit_need . "$$$". $unit_id . "$$$" . $subunit_id . "$$$";

        if(!empty($case_contents_list)) {
            ?>
                <option value="">Select</option>
                <?php
                    foreach($case_contents_list as $case_contents) {
                        ?>
                        <option value="<?php if(!empty($case_contents['case_contains'])) { echo $case_contents['case_contains']; } ?>"><?php if(!empty($case_contents['case_contains'])) { echo $case_contents['case_contains']; } ?></option>
                        <?php
                    }    
                ?>
            <?php
        }

    }

    if(isset($_REQUEST['get_product_by_finished_group'])) {
        $finished_group_id = $_REQUEST['finished_group_id'];

        if(!empty($finished_group_id)) {
            $product_list = array();
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'finished_group_id', $finished_group_id, '');
            
            if(!empty($product_list)) {
                ?>
                <option value="">Select</option>
                <?php
                foreach($product_list as $pl) {
                    ?>
                    <option value="<?php if (!empty($pl['product_id'])) { echo $pl['product_id']; } ?>">
                        <?php if (!empty($pl['product_name'])) {
                            echo $obj->encode_decode('decrypt', $pl['product_name']);
                        } ?>
                    </option>
                    <?php
                }
            }
        } else {
            $product_list = array();
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
            
            if(!empty($product_list)) {
                ?>
                <option value="">Select</option>
                <?php
                foreach($product_list as $pl) {
                    ?>
                    <option value="<?php if (!empty($pl['product_id'])) { echo $pl['product_id']; } ?>">
                        <?php if (!empty($pl['product_name'])) {
                            echo $obj->encode_decode('decrypt', $pl['product_name']);
                        } ?>
                    </option>
                    <?php
                }
            }
        }
    }

    if(isset($_REQUEST['product_row_index'])){
        $product_row_index = $_REQUEST['product_row_index'];
        $product_id = $_REQUEST['selected_product_id'];
        $selected_quantity = $_REQUEST['selected_quantity'];
        $selected_unit_type = $_REQUEST['selected_unit_type'];
        $selected_content = $_REQUEST['selected_content'];
        $selected_rate = $_REQUEST['selected_rate'];
        $selected_per = $_REQUEST['selected_per'];
        $selected_per_type = $_REQUEST['selected_per_type'];
        $selected_final_rate = $_REQUEST['selected_final_rate'];
        $selected_amount = $_REQUEST['selected_amount'];
        $subunit_need = $_REQUEST['subunit_need'];

        // $magazine_list = array();
        // $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');

        ?>
            <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
                <th class="text-center px-2 py-2 sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
                
                <th class="text-center px-2 py-2">
                    <?php
                        if(!empty($product_id)) {
                            $product_name = "";
                            $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                            if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                                echo $obj->encode_decode('decrypt', $product_name);
                            }
                        }
                    ?>
                    <input type="hidden" name="product_id[]" value="<?php if(!empty($product_id)) { echo $product_id; } ?>"><br>
                    
                </th>
                <?php /*
                <th class="text-center px-2 py-2 indv_magazine d-none">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="indv_magazine_id[]" data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                </th>
                */ ?>
                <th class="text-center px-2 py-2">
                    <?php if($selected_unit_type == '1'){
                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_id');
                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_name');
                    }
                    elseif($selected_unit_type == '2')
                    {
                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'subunit_id');
                        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'subunit_name');
                        
                    }

                    if(!empty($unit_name) && $unit_name !='NULL')
                    {
                        echo $unit_name = $obj->encode_decode("decrypt",$unit_name);
                    }
                    ?>
                    <input type="hidden" name="unit_type[]" class="form-control shadow-none" value="<?php if(!empty($selected_unit_type)) { echo $selected_unit_type; } ?>">
                    <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_id)) { echo $unit_id; } ?>">
                    <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>" >
                    <input type="hidden" name="subunit_need[]" class="form-control shadow-none" value="<?php if(!empty($subunit_need)) { echo $subunit_need; } ?>" >
                </th>
                <th class="text-center px-2 py-2">
                    <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($selected_quantity)) { echo $selected_quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                </th>
                <th class="text-center px-2 py-2">
                    <input type="hidden" name="content[]" class="form-control shadow-none" value="<?php if(!empty($selected_content)) { echo $selected_content; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                    <?php if(!empty($selected_content)) { echo $selected_content; } ?>
                </th>
                
                <td>
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width:65px;" value="<?php if(!empty($selected_rate)){ echo $selected_rate; }?>" required>
                        </div>
                    </div> 
                </td>
                <td class="text-center px-2 py-2">
                    <?php
                        $per_unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_name');
                        $per_subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'subunit_name');
                    ?>
                     <input type="hidden" id="" name="per[]" value="<?php if(!empty($selected_per)){ echo $selected_per; }?>" class="form-control shadow-none" onkeyup="ProductRowCheck(this);">
                    <input type="hidden" id="" name="per_type[]" value="<?php if(!empty($selected_per_type)){ echo $selected_per_type; }?>">
                    <?php if(!empty($selected_per) && !empty($selected_per_type)){
                        echo $selected_per." ".$obj->encode_decode("decrypt", $per_unit_name);
                    } ?>
                    <?php /*
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="" name="per[]" value="<?php if(!empty($selected_per)){ echo $selected_per; }?>" class="form-control shadow-none" onkeyup="ProductRowCheck(this);">
                                <label>Per</label>
                                <div class="input-group-append" style="width:50%!important;">
                                    <select name="per_type[]" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="ProductRowCheck(this);">
                                        <option value="1" <?php if(!empty($selected_per_type) && $selected_per_type == '1'){ ?>selected<?php } ?>><?php if(!empty($per_unit_name)){ echo $obj->encode_decode("decrypt",$per_unit_name); } ?></option>
                                        <option value="2" <?php if(!empty($selected_per_type) && $selected_per_type == '2'){ ?>selected<?php } ?>><?php if(!empty($per_subunit_name)){ echo $obj->encode_decode("decrypt",$per_subunit_name); } ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    */ ?>
                </td>
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
                <td>
                    <p class="final_rate"><?php if(!empty($selected_final_rate)){ echo $selected_final_rate; }?></p>
                    <input type="hidden" id="final_rate[]" name="final_rate[]" value="<?php if(!empty($selected_final_rate)){ echo $selected_final_rate; }?>" class="form-control shadow-none">
                </td>
                <td>
                    <p class="amount"><?php if(!empty($selected_amount)){ echo $selected_amount; }?></p>
                    <input type="hidden" id="amount[]" name="amount[]" value="<?php if(!empty($selected_amount)){ echo $selected_amount; }?>" class="form-control shadow-none">
                </td>
                <th class="text-center px-2 py-2">
                    <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                </th>
            </tr>       
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        <?php
    }

    if(isset($_REQUEST['get_agent_customer_id'])){
        $agent_id = $_REQUEST['get_agent_customer_id'];

        if(!empty($agent_id) && $agent_id != $GLOBALS['null_value']) {
            $customer_list = $obj->getAgentcustomerList($agent_id);
            $agent_commission = $obj->getTableColumnValue($GLOBALS['agent_table'],'agent_id',$agent_id,'commission');
            ?>
            <option value="">Select customer</option>
            <?php
            foreach($customer_list as $data)
            {
                ?>
                    <option value="<?php if(!empty($data['customer_id'])){ echo $data['customer_id']; }?>">
                        <?php
                            if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                            }
                        ?>
                    </option>
                <?php
            }
            echo "$$$ Commission : ".$agent_commission."$$$".$agent_commission;
        } else {
            $customer_list = $obj->getCustomerList();
            ?>
            <option value="">Select customer</option>
            <?php
            foreach($customer_list as $data)
            {
                ?>
                    <option value="<?php if(!empty($data['customer_id'])){ echo $data['customer_id']; }?>">
                        <?php
                            if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                            }
                        ?>
                    </option>
                <?php
            }
            echo "$$$$$$";
        }
    }

    if(isset($_REQUEST['get_product_by_magazine'])){
        $magazine_type = $_REQUEST['get_product_by_magazine'];
        if($magazine_type == '1') {
            $magazine_id = $_REQUEST['magazine_id'];
            if(!empty($magazine_id)) {
                $product_list =array();
                $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'location_id', $magazine_id, '');

                if(!empty($product_list)) {
                    ?>
                    <option value="">Select product</option>
                    <?php
                    foreach($product_list as $data)
                    {
                        ?>
                            <option value="<?php if (!empty($data['product_id'])) { echo $data['product_id']; } ?>">
                                <?php if (!empty($data['product_name'])) {
                                    echo $obj->encode_decode('decrypt', $data['product_name']);
                                } ?>
                            </option>
                        <?php
                    }
                }
            }
        } else {
            $product_list =array();
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');

            if(!empty($product_list)) {
                ?>
                <option value="">Select product</option>
                <?php
                foreach($product_list as $data)
                {
                    ?>
                        <option value="<?php if (!empty($data['product_id'])) { echo $data['product_id']; } ?>">
                            <?php if (!empty($data['product_name'])) {
                                echo $obj->encode_decode('decrypt', $data['product_name']);
                            } ?>
                        </option>
                    <?php
                }
            }
        }
    }

    if(isset($_REQUEST['get_charges_row']) && $_REQUEST['get_charges_row'] == '1') {
        $other_charges_list = array();
        $other_charges_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '', '');

        $charges_count = $_REQUEST['charges_count']+1;
        ?>
        
        <tr class="smallfnt1 charges_row" id="charges_row_<?php if(!empty($charges_count)) { echo $charges_count; } ?>" >
            <td colspan="4"></td>
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
                    <input type="text" class="form-control me-2" style="width: 85px;" name="other_charges_value[]" value="" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                    <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:DeleteChargesRow(this,'<?php echo $charges_count; ?>');"><i class="bi bi-trash fw-bold text-white"></i></button>
                </div>
            </td>
            <td colspan="1">
                <div class="text-end"><span class="other_charges_total text-end"></span></div>
            </td>
            <td></td>
        </tr>
        <tr class="charges_row" id="charges_row_total_<?php if(!empty($charges_count)) { echo $charges_count; } ?>">
            <td colspan="8" class="text-end">Total :</td>
            <td colspan="1" class="text-end charges_sub_total"></td>
        </tr>
        <script>
            if(jQuery('#charges_row_<?php if(!empty($charges_count)) { echo $charges_count; } ?>').length > 0) {
                jQuery('#charges_row_<?php if(!empty($charges_count)) { echo $charges_count; } ?>').find('select').select2();
            }
        </script>
        <?php
    }

    if(isset($_REQUEST['get_charges_type'])) {
        $other_charges_id = $_REQUEST['get_charges_type'];
        $other_charges_id = trim($other_charges_id);

        $charges_type = "";
        if(!empty($other_charges_id)) {
            $charges_type = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id, 'action');
            if(!empty($charges_type) && $charges_type != $GLOBALS['null_value']) {
                echo $charges_type;
            }
        }
    }

    if(isset($_REQUEST['party_change_state'])) {
        $customer_id = $_REQUEST['party_change_state'];
        $customer_id = trim($customer_id);

        $party_state = "";
        if(!empty($customer_id)) {
            $party_state = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'state');
            if(!empty($party_state) && $party_state != $GLOBALS['null_value']) {
                echo $obj->encode_decode('decrypt', $party_state);
            }
        }
    }

    if(isset($_REQUEST['delete_proforma_invoice_id'])) {
        $delete_proforma_invoice_id = $_REQUEST['delete_proforma_invoice_id'];
        $msg = "";
        if(!empty($delete_proforma_invoice_id)) {
            $proforma_invoice_unique_id = "";
            $proforma_invoice_unique_id = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $delete_proforma_invoice_id, 'id');
            if(preg_match("/^\d+$/", $proforma_invoice_unique_id)) {
                $proforma_invoice_number = "";
                $proforma_invoice_number = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $delete_proforma_invoice_id, 'proforma_invoice_number');
    
                $action = "";
                if(!empty($proforma_invoice_number)) {
                    $action = "Proforma Invoice Deleted. Name - " . $proforma_invoice_number;
                }

                $stock_conversion_records = $obj->getTableRecords($GLOBALS['stock_conversion_table'], 'bill_id', $delete_proforma_invoice_id, '');
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
                $msg = $obj->UpdateSQL($GLOBALS['proforma_invoice_table'], $proforma_invoice_unique_id, $columns, $values, $action);
            }
        }
        echo $msg;
        exit;
    }

    if(isset($_REQUEST['status_proforma_invoice_id'])) {
        $status_proforma_invoice_id = ""; $product_names = array();; $product_ids = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array(); $current_stock_unit = 0; $current_stock_subunit = 0; $magazine_id = "";
        $unit_names = array();$quantity = array(); 
        $status_proforma_invoice_id = $_REQUEST['status_proforma_invoice_id'];
        $status_proforma_invoice_id = trim($status_proforma_invoice_id);
        if(!empty($status_proforma_invoice_id)) {
            $proforma_invoice_list = $obj->getTableRecords($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $status_proforma_invoice_id, '');
            if(!empty($proforma_invoice_list)) {
                foreach($proforma_invoice_list as $list) {
               
                    if(!empty($list['magazine_type'])) {
                        $magazine_type = $list['magazine_type'];
                    }
                    if(!empty($list['magazine_id'])) {
                        $magazine_id = $list['magazine_id'];
                    }
               
                    if(!empty($list['indv_magazine_id'])) {
                        $indv_magazine_ids = $list['indv_magazine_id'];
                        $indv_magazine_ids = explode(",", $indv_magazine_ids);
                        $indv_magazine_ids = array_reverse($indv_magazine_ids);
                    }
                    if(!empty($list['product_name'])) {
                        $product_names = $list['product_name'];
                        $product_names = explode(",", $product_names);
                        $product_names = array_reverse($product_names);
                    }
                    if(!empty($list['product_id'])) {
                        $product_ids = $list['product_id'];
                        $product_ids = explode(",", $product_ids);
                        $product_ids = array_reverse($product_ids);
                    }
                    if(!empty($list['subunit_need'])) {
                        $subunit_needs = $list['subunit_need'];
                        $subunit_needs = explode(",", $subunit_needs);
                        $subunit_needs = array_reverse($subunit_needs);
                    }
                    if(!empty($list['content']) && $list['content'] != $GLOBALS['null_value']) {
                        $contents = $list['content'];
                        $contents = explode(",", $contents);
                        $contents = array_reverse($contents);
                    }
                    if(!empty($list['unit_id'])) {
                        $unit_ids = $list['unit_id'];
                        $unit_ids = explode(",", $unit_ids);
                        $unit_ids = array_reverse($unit_ids);
                    }
                    if(!empty($list['unit_name'])) {
                        $unit_names = $list['unit_name'];
                        $unit_names = explode(",", $unit_names);
                        $unit_names = array_reverse($unit_names);
                    }
                    if(!empty($list['quantity'])) {
                        $quantity = $list['quantity'];
                        $quantity = explode(",", $quantity);
                        $quantity = array_reverse($quantity);
                    }
                 
                }
            }
        }
        if(!empty($product_ids)){
            for($i=0; $i<count($product_names); $i++){
                $product_ids[$i] = trim($product_ids[$i]);

                if(!empty($product_names[$i])){ 
                    $group_name = "";
                    $group_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'group_name');

                    $getCurrentStock = array();
                    if(!empty($contents[$i])){
                        $getCurrentStock = $obj->getCurrentStockDetails($product_ids[$i], $contents[$i]);
                    } else {
                        $getCurrentStock = $obj->getCurrentStockDetails($product_ids[$i], '');
                    }

                    ?>
                    <div>
                        <strong>Group:</strong> <?php echo $obj->encode_decode('decrypt', $group_name) ?>&nbsp;&nbsp;
                        <strong>Product Name:</strong> <?php echo $obj->encode_decode('decrypt', $product_names[$i]); ?>&nbsp;&nbsp;
                        <?php
                        if(!empty($contents[$i]) && $contents[$i] != $GLOBALS['null_value']){ ?>
                            <strong>Content:</strong> <?php echo $contents[$i]; 
                        } ?>
                    </div><br>
                    <div>
                        Order Quantity : <?php if(!empty($quantity[$i])){ echo $quantity[$i]. " ". $obj->encode_decode('decrypt', $unit_names[$i]); } ?>
                    </div><br>
            		<table class="table nowrap cursor text-center smallfnt">
                        <thead class="bg-light">
                            <th> Magazine</th>
                            <th> Current Stock Unit</th>
                            <th> Current Stock Subunit</th>
                        </thead>
                        <tbody>
                           <?php
                           if(!empty($getCurrentStock)){
                                $magazine_name = "";
                                $current_stock_unit = 0;
                                $current_stock_subunit = 0;
                                foreach($getCurrentStock as $data){
                                    if(!empty($data['current_stock_unit']) && $data['current_stock_unit'] != $GLOBALS['null_value']) {
                                        $current_stock_unit += $data['current_stock_unit'];
                                    }
                                    if(!empty($data['current_stock_subunit']) && $data['current_stock_subunit'] != $GLOBALS['null_value']) {
                                        $current_stock_subunit += $data['current_stock_subunit'];
                                    }
                                    if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value'] ) {
                                        $magazine_id = $data['magazine_id'];
                                    }
                                }

                                if(!empty($magazine_id)){
                                    $magazine_name = $obj->getTableColumnValue($GLOBALS['magazine_table'],'magazine_id',$magazine_id,'magazine_name');
                                    $magazine_name =  $obj->encode_decode('decrypt', $magazine_name);
                                } ?>
                                <td><?php if(!empty($magazine_name)){ echo $magazine_name; } ?></td>
                                <td><?php if(!empty($current_stock_unit)){ echo $current_stock_unit; } ?></td>
                                <td><?php if(!empty($current_stock_subunit)){ echo $current_stock_subunit; }else{ echo "-"; } ?></td>


                                <?php
                           }
                           ?>
                        </tbody>
                    </table><br><br><br>
                     <?php
                }

            }
        }

    }
?>