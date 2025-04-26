<?php
	include("include_files.php");
	if(isset($_REQUEST['show_proforma_invoice_id'])) { 
        $show_proforma_invoice_id = $_REQUEST['show_proforma_invoice_id'];

        $proforma_invoice_number =""; $customer_id =""; $proforma_invoice_date =date('Y-m-d');  $sub_total =""; $grand_total =""; $total_amount =""; $round_off =""; $product_id =array(); $product_name =array(); $brand_id =array(); $brand_name =array(); $per =array(); $per_type =array(); $unit_type =array(); $unit_id =array(); $subunit_id =array(); $subunit_name =array();  $unit_name =array(); $subunit_content =array(); $sales_rate =array();  $product_name =array(); $charges_id =array(); $charges_type =array(); $charges_value =array(); $charges_total =array(); $product_quantity =array(); $agent_id =array(); $gst_option =""; $tax_option =""; $tax_type =""; $product_tax =""; $overall_tax ="";
        
        if(!empty($show_proforma_invoice_id)) {
            $proforma_invoice_list = $obj->getTableRecords($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $show_proforma_invoice_id, '');
            $agent_id = "";
            if(!empty($proforma_invoice_list)) {
                foreach($proforma_invoice_list as $Q_list) {
                    if(!empty($Q_list['proforma_invoice_number'])) {
                        $proforma_invoice_number = $Q_list['proforma_invoice_number'];
                    }
                    if(!empty($Q_list['customer_id'])) {
                        $customer_id = $Q_list['customer_id'];
                    }
                    if(!empty($Q_list['proforma_invoice_date'])) {
                        $proforma_invoice_date = $Q_list['proforma_invoice_date'];
                    }
                    if(!empty($Q_list['sub_total'])) {
                        $sub_total = $Q_list['sub_total'];
                    }
                    if(!empty($Q_list['grand_total'])) {
                        $grand_total = $Q_list['grand_total'];
                    }
                    if(!empty($Q_list['total_amount'])) {
                        $total_amount = $Q_list['total_amount'];
                    }
                    if(!empty($Q_list['round_off'])) {
                        $round_off = $Q_list['round_off'];
                    }
                    if(!empty($Q_list['product_id'])) {
                        $product_id = $Q_list['product_id'];
                        $product_id = explode(",", $product_id);
                        $product_id = array_reverse($product_id);
                    }
                    if(!empty($Q_list['product_name'])) {
                        $product_name = $Q_list['product_name'];
                        $product_name = explode(",", $product_name);
                        $product_name = array_reverse($product_name);
                    }
                    if(!empty($Q_list['brand_id'])) {
                        $brand_id = $Q_list['brand_id'];
                        $brand_id = explode(",", $brand_id);
                        $brand_id = array_reverse($brand_id);
                    }
                    if(!empty($Q_list['brand_name'])) {
                        $brand_name = $Q_list['brand_name'];
                        $brand_name = explode(",", $brand_name);
                        $brand_name = array_reverse($brand_name);
                    }
                    if(!empty($Q_list['per'])) {
                        $per = $Q_list['per'];
                        $per = explode(",", $per);
                        $per = array_reverse($per);
                    }
                    if(!empty($Q_list['per_type'])) {
                        $per_type = $Q_list['per_type'];
                        $per_type = explode(",", $per_type);
                        $per_type = array_reverse($per_type);
                    }
                    if(!empty($Q_list['unit_type'])) {
                        $unit_type = $Q_list['unit_type'];
                        $unit_type = explode(",", $unit_type);
                        $unit_type = array_reverse($unit_type);
                    }
                    if(!empty($Q_list['unit_id'])) {
                        $unit_id = $Q_list['unit_id'];
                        $unit_id = explode(",", $unit_id);
                        $unit_id = array_reverse($unit_id);
                    }
                    if(!empty($Q_list['subunit_id'])) {
                        $subunit_id = $Q_list['subunit_id'];
                        $subunit_id = explode(",", $subunit_id);
                        $subunit_id = array_reverse($subunit_id);
                    }
                    if(!empty($Q_list['unit_name'])) {
                        $unit_name = $Q_list['unit_name'];
                        $unit_name = explode(",", $unit_name);
                        $unit_name = array_reverse($unit_name);
                    }
                    if(!empty($Q_list['subunit_name'])) {
                        $subunit_name = $Q_list['subunit_name'];
                        $subunit_name = explode(",", $subunit_name);
                        $subunit_name = array_reverse($subunit_name);
                    }
                    if(!empty($Q_list['content'])) {
                        $subunit_content = $Q_list['content'];
                        $subunit_content = explode(",", $subunit_content);
                        $subunit_content = array_reverse($subunit_content);
                    }
                    if(!empty($Q_list['product_rate'])) {
                        $sales_rate = $Q_list['product_rate'];
                        $sales_rate = explode(",", $sales_rate);
                        $sales_rate = array_reverse($sales_rate);
                    }
                    if(!empty($Q_list['product_amount'])) {
                        $product_amount = $Q_list['product_amount'];
                        $product_amount = explode(",", $product_amount);
                        $product_amount = array_reverse($product_amount);
                    }
                    if(!empty($Q_list['charges_id'])) {
                        $charges_id = $Q_list['charges_id'];
                        $charges_id = explode(",", $charges_id);
                    }
                    if(!empty($Q_list['charges_type'])) {
                        $charges_type = $Q_list['charges_type'];
                        $charges_type = explode(",", $charges_type);
                    }
                    if(!empty($Q_list['charges_value'])) {
                        $charges_value = $Q_list['charges_value'];
                        $charges_value = explode(",", $charges_value);
                    }
                    if(!empty($Q_list['charges_total'])) {
                        $charges_total = $Q_list['charges_total'];
                        $charges_total = explode(",", $charges_total);
                    }
                    if(!empty($Q_list['product_quantity'])) {
                        $product_quantity = $Q_list['product_quantity'];
                        $product_quantity = explode(",", $product_quantity);
                        $product_quantity = array_reverse($product_quantity);
                    }
                    if(!empty($Q_list['agent_id']) && $Q_list['agent_id'] != $GLOBALS['null_value']) {
                        $agent_id = $Q_list['agent_id'];
                    }
                }
            }
        }

        $customer_list =array();
        $customer_list = $obj->getTableRecords($GLOBALS['customer_table'],'','','');
        $product_list =array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
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
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="proforma_invoice_date" class="form-control shadow-none" placeholder="" value="<?php if (!empty($proforma_invoice_date)) { echo $proforma_invoice_date; } ?>" required="">
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
                            <select class="select2 select2-danger" name="customer_id" data-dropdown-css-class="select2-danger"
                                style="width: 100%;">
                                <option value="">Select Customer</option>
                                <?php if (!empty($customer_list)) {
                                    foreach ($customer_list as $P_list) { ?>
                                        <option value="<?php if (!empty($P_list['customer_id'])) {
                                            echo $P_list['customer_id'];
                                        } ?>" <?php if(!empty($customer_id) && $customer_id == $P_list['customer_id']) { echo "selected"; } ?>>
                                            <?php if (!empty($P_list['customer_name'])) {
                                                echo $obj->encode_decode('decrypt', $P_list['customer_name']);
                                            } ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <label>Select Customer</label>
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
                            <select class="select2 select2-danger" name="magazine_type" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:magazineList();">
                                <option value="">Magazie Type</option>
                                <option value="1">Overall Magazie</option>
                                <option value="2">Productwise Magazie</option>
                            </select>
                            <label>Select Magazine</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 overall_magazine d-none">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="magazine_id" data-dropdown-css-class="select2-danger"
                                        style="width: 100%;">
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
                <div class="col-lg-2 col-md-3 col-6 py-2">
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
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"></textarea>
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
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>"">
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
            <div class="row justify-content-center p-3">
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
                            <div class="form-label-group in-border">
                                <input type="text" name="selected_content"  onkeyup="CalProductAmount();" onfocus="Javascript:KeyboardControls(this,'number',7,'');" class="form-control shadow-none">
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
                        <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">
                        <table class="table nowrap cursor text-center table-bordered smallfnt w-100 proforma_invoice_table">
                            <thead class="bg-dark">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th style="width: 150px;">Product</th>
                                    <th style="width: 100px;" class="indv_magazine d-none">Magazine</th>
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
                                    if(!empty($product_ids)) {
                                        for($i=0; $i < count($product_ids); $i++) {    
                                            ?>
                                            <tr class="product_row" id="product_row<?php if(!empty($product_count)) { echo $product_count; } ?>">
                                                <th class="text-center px-2 py-2 sno"><?php if(!empty($product_count)) { echo $product_count; } ?></th>
                                            
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
                                                    $unit_ids[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_id');
                                                    $unit_names[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');
                                                }
                                                elseif($unit_types[$i] == '2')
                                                {
                                                    $unit_ids[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_id');
                                                    $unit_names[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'subunit_name');
                                                    
                                                }

                                                if(!empty($unit_names[$i]) && $unit_names[$i] !='NULL')
                                                {
                                                    echo $unit_names[$i] = $obj->encode_decode("decrypt",$unit_names[$i]);
                                                }
                                                ?>                                            <input type="hidden" name="unit_type[]" class="form-control shadow-none" value="<?php if(!empty($unit_types[$i])) { echo $unit_types[$i]; } ?>">
                                                <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_ids[$i])) { echo $unit_ids[$i]; } ?>">
                                                <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_names[$i])) { echo $unit_names[$i]; } ?>" >
                                                    <!-- <input type="text" name="unit_type[]" class="form-control shadow-none" value="<?php if(!empty($unit_types[$i])) { echo $unit_types[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);"> -->
                                                </th>
                                                <th class="text-center px-2 py-2">
                                                    <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);" <?php if($conversion_update == '1' || !empty($received_slip_id)){ ?>readonly<?php } ?>>
                                                </th>
                                                

                                                <th class="text-center px-2 py-2">
                                                    <input type="text" name="content[]" class="form-control shadow-none" value="<?php if(!empty($contents[$i])) { echo $contents[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);" <?php if($conversion_update == '1' || !empty($received_slip_id)){ ?>readonly<?php } ?>>
                                                </th>
                                            
                                                <td>
                                                    <div class="form-group mb-1">
                                                        <div class="form-label-group in-border">
                                                            <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width:65px;" value="<?php if(!empty($rates[$i])){ echo $rates[$i]; }?>" required>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-label-group in-border">
                                                            <div class="input-group">
                                                                <input type="text" id="" name="per[]" value="<?php if(!empty($per[$i])){ echo $per[$i]; }?>" class="form-control shadow-none" onkeyup="ProductRowCheck(this);">
                                                                <label>Per</label>
                                                                <div class="input-group-append" style="width:50%!important;">
                                                                    <select name="per_type[]" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="ProductRowCheck(this);">
                                                                        <option value="1" <?php if(!empty($per_type[$i]) && $per_type[$i] == '1'){ ?>selected<?php } ?>>Unit</option>
                                                                        <option value="2" <?php if(!empty($per_type[$i]) && $per_type[$i] == '2'){ ?>selected<?php } ?>>Sub Unit</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tax_element d-none">
                                                    <div class="form-group">
                                                        <div class="form-label-group in-border mb-0">
                                                            <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);">
                                                                <option value="">Select Tax</option>
                                                                <option value="0%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '0%'){ ?>selected<?php } } ?>>0%</option>
                                                                <option value="5%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '5%'){ ?>selected<?php } } ?>>5%</option>
                                                                <option value="12%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '12%'){ ?>selected<?php } } ?>>12%</option>
                                                                <option value="18%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '18%'){ ?>selected<?php } } ?>>18%</option>
                                                                <option value="28%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '28%'){ ?>selected<?php } } ?>>28%</option>
                                                            </select>
                                                            <label>Select Tax</label>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <p class="final_rate"><?php if(!empty($final_rate[$i])){ echo number_format($final_rate[$i],2); }?></p>
                                                    <input type="hidden" id="final_rate[]" name="final_rate[]" value="<?php if(!empty($final_rate[$i])){ echo $final_rate[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <td>
                                                    <p class="amount"><?php if(!empty($product_amount[$i])){ echo number_format($product_amount[$i],2); } ?></p>
                                                    <input type="hidden" id="amount[]" name="amount[]" value="<?php if(!empty($product_amount[$i])){ echo $product_amount[$i]; }?>" class="form-control shadow-none">
                                                </td>
                                                <?php if($conversion_update == '' || $received_slip_id == ''){?>
                                                    <td class="text-center px-2 py-2">
                                                        <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php if(!empty($product_count)) { echo $product_count; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            <?php
                                            $product_count --;
                                        }
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end sub_tot"> Total : </td>
                                    <td colspan="1" class="text-end sub_total"></td>
                                </tr>
                                <input type="hidden" name="charges_count" value="<?php if(!empty($charges_count)) { echo $charges_count-1; } else { echo '0'; } ?>">
                                <?php 
                                $count = 1;
                                if(!empty($other_charges_id) && !empty($show_purchase_bill_id)) {
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
                                                                                            if($obj->encode_decode('decrypt',$data['action'] ) == 'minus') {
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
                                                        <input type="hidden" name="charges_type[]" value="<?php if(!empty($charges_type[$i])) { echo $charges_type[$i]; } ?>">
                                                    </div> 
                                                </td>
                                                <td colspan="1"> 
                                                    <div class="d-flex">
                                                        <input type="text" class="form-control me-2" style="width: 85px;" name="other_charges_value[]" value="<?php if(!empty($other_charges_value[$i])) { echo $other_charges_value[$i]; } ?>" placeholder="Value" onkeyup="Javascript:CheckCharges();"> 
                                                        <?php if($i == '0') { ?>
                                                            <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:AddChargesRow(this);"><i class="bi bi-plus fw-bold text-white"></i></button>
                                                        <?php } else { ?>
                                                            <button type="button" class="bg-danger border-0 px-3" onclick="Javascript:DeleteChargesRow(this,'<?php echo $count; ?>');"><i class="bi bi-trash fw-bold text-white"></i></button>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td colspan="1">
                                                    <div class="text-end"><span class="other_charges_total"></span></div>
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
                                }
                                else
                                {
                                    ?>
                                    <tr class="smallfnt1 charges_row" id="charges_row_1">  
                                        <td class="charges_head" colspan="6"></td>
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
                                            <div class="other_charges_total"></div>
                                        </td>
                                    </tr>
                                    <tr class="charges_row" id="charges_row_total_1">
                                        <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>11<?php }else{ ?>10<?php }?>" class="text-end charges_sub">Total :</td>
                                        <td colspan="1" class="text-end charges_sub_total"></td>
                                    </tr>
                                    <?php
                                }?>
                                
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
                                <!-- <tr>
                                    <td colspan="10" class="text-end ">Total :</td>
                                    <td colspan="1" class="text-end"></td>
                                </tr>  -->
                                <tr style="color:green;" class="agent_tr <?php if(empty($agent_id)){ ?>d-none<?php } ?>">
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end agent_commission">Commission : <?php if(!empty($agent_commission)){ echo $agent_commission;}?></td>
                                    <input type="hidden" name="agent_commission" value="<?php if(!empty($agent_commission)){ echo $agent_commission; }?>">
                                    <td colspan="1" class="text-end "><span class="commission_total"><?php if(!empty($agent_commission_value)){ echo $agent_commission_value; }?></span></td>
                                </tr>
                                    
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end round">Round OFF :</td>
                                    <td colspan="1" class="text-end round_off"></td>
                                </tr>
                                <tr>
                                    <td colspan="<?php if($tax_type =='1' && $gst_option =='2'){ ?>9<?php }else{ ?>8<?php }?>" class="text-end grand_total">Total :</td>
                                    <td colspan="2" class="text-end "><i class="bi bi-currency-rupee text-danger me-2"></i><span class="overall_total"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'purchase_bill_form', 'purchase_bill_changes.php', 'purchase_bill.php');">
                        Submit
                    </button>
                </div>
            </div>
        </form>       
        <script>
            jQuery(document).ready(function(){
                <?php 
                    if(!empty($show_purchase_bill_id)) { ?>calTotal();<?php }
                ?>
            });
        </script>                    
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
    <?php 
    } 

    if(isset($_POST['form_name'])) {
        $proforma_invoice_date = ""; $proforma_invoice_date_error = ""; $proforma_invoice_number = ""; $proforma_invoice_number_error = "";  $party_id = ""; $party_id_error = ""; $product_ids = array(); $product_names = array(); $brand_ids = array(); $brand_names = array(); $product_quantity = array(); $unit_ids = array(); $unit_names = array(); $subunit_contains = array();  $subunit_ids = array(); $subunit_names = array();
        $product_rate = array(); $per = array(); $per_type = array(); $rate_per_unit = array(); $product_amount = array(); $sub_total = 0; $charges_id = array(); $charges_names = array(); $price_type = ""; $price_type_error = "";
        $charges_values = array(); $charges_type = array(); $charges_total = array();
        $total_amount = 0; $round_off = 0; $grand_total = 0; $total_unit_qty = 0;
        $agent_id = ""; $agent_id_error = "";
        $valid_proforma_invoice = ""; $form_name = ""; $edit_id = ""; $current_date = date('Y-m-d'); $proforma_invoice_error = ""; $draft = "0";
        // print_r($_POST);
        if(isset($_POST['form_name'])) {
            $form_name = $_POST['form_name'];
            $form_name = trim($form_name);
        
        }
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

        if(isset($_POST['party_id'])) {
            $party_id = $_POST['party_id'];
            $party_id = trim($party_id);
            $party_id_error = $valid->common_validation($party_id, 'Party', 'select');
        }
        if(!empty($party_id_error)) {
            if(!empty($valid_proforma_invoice)) {
                $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->error_display($form_name, "party_id", $party_id_error, 'select');
            }
            else {
                $valid_proforma_invoice = $valid->error_display($form_name, "party_id", $party_id_error, 'select');
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
    
        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
            $product_ids = array_reverse($product_ids);
        }
        if(isset($_POST['brand_id'])) {
            $brand_ids = $_POST['brand_id'];
            $brand_ids = array_reverse($brand_ids);
        }
        if(isset($_POST['proforma_invoice_qty'])) {
            $product_quantity = $_POST['proforma_invoice_qty'];
            $product_quantity = array_reverse($product_quantity);
        }
        if(isset($_POST['proforma_invoice_unit_type'])) {
            $unit_types = $_POST['proforma_invoice_unit_type'];
            $unit_types = array_reverse($unit_types);
        }
        if(isset($_POST['proforma_invoice_unit_id'])) {
            $unit_ids = $_POST['proforma_invoice_unit_id'];
            $unit_ids = array_reverse($unit_ids);
        }
        if(isset($_POST['proforma_invoice_subunit_id'])) {
            $subunit_ids = $_POST['proforma_invoice_subunit_id'];
            $subunit_ids = array_reverse($subunit_ids);
        }
        if(isset($_POST['proforma_invoice_subunit_name'])) {
            $subunit_names = $_POST['proforma_invoice_subunit_name'];
            $subunit_names = array_reverse($subunit_names);
        }
        if(isset($_POST['proforma_invoice_content'])) {
            $subunit_contains = $_POST['proforma_invoice_content'];
            $subunit_contains = array_reverse($subunit_contains);
        }
        if(isset($_POST['proforma_invoice_sales_rate'])) {
            $product_rate = $_POST['proforma_invoice_sales_rate'];
            $product_rate = array_reverse($product_rate);
        }
        if(isset($_POST['proforma_invoice_per'])) {
            $per = $_POST['proforma_invoice_per'];
            $per = array_reverse($per);
        }
        if(isset($_POST['proforma_invoice_per_type'])) {
            $per_type = $_POST['proforma_invoice_per_type'];
            $per_type = array_reverse($per_type);
        }
        if(isset($_POST['total_qty'])) {
            $total_subunit_quantity = $_POST['total_qty'];
            $total_subunit_quantity = array_reverse($total_subunit_quantity);
        }
        if(!empty($product_ids)) {
            $product_quantity = array_reverse($product_quantity);
            // $quantity_limit = array_reverse($quantity_limit);
            $a =1;
            for($i=0; $i < count($product_ids); $i++) {
                $product_ids[$i] = trim($product_ids[$i]);
                $product_name = "";
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');


                $product_unit_id = "";
                $product_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'unit_id');

                $product_subunit_id = "";
                $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');

                $product_names[$i] = $product_name;

                $brand_ids[$i] = trim($brand_ids[$i]);
                if(isset($brand_ids[$i])) {
                    $brand_error = "";
                    $brand_error = $valid->common_validation($brand_ids[$i], 'Brand', 'select');
                    if(!empty($brand_error)) {
                        if(!empty($valid_proforma_invoice)) {
                            $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->row_error_display($form_name, 'brand_id[]', $brand_error, 'text', 'proforma_invoice_row', ($a));
                        }
                        else {
                            $valid_proforma_invoice = $valid->row_error_display($form_name, 'brand_id[]', $brand_error, 'text', 'proforma_invoice_row', ($a));
                        }
                    }
                }

                $product_quantity[$i] = trim($product_quantity[$i]);
                if(isset($product_quantity[$i])) {
                    $quantity_error = "";
                    $quantity_error = $valid->valid_number($product_quantity[$i], 'Qty', '1', '5');
                    if(!empty($quantity_error)) {
                        if(!empty($valid_proforma_invoice)) {
                            $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->row_error_display($form_name, 'proforma_invoice_qty[]', $quantity_error, 'text', 'proforma_invoice_row', ($a));
                        }
                        else {
                            $valid_proforma_invoice = $valid->row_error_display($form_name, 'proforma_invoice_qty[]', $quantity_error, 'text', 'proforma_invoice_row', ($a));
                        }
                    }
                }

                $subunit_contains[$i] = trim($subunit_contains[$i]);
                if(isset($subunit_contains[$i])) {
                    $contains_error = ""; $required = 0;
                    if($unit_ids[$i] == $product_unit_id && $product_subunit_id != $GLOBALS['null_value']) {
                        $required = 1;
                    }
                    $contains_error = $valid->valid_number($subunit_contains[$i], 'Contains', $required, '5');
                    if(!empty($contains_error)) {
                        if(!empty($valid_proforma_invoice)) {
                            $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->row_error_display($form_name, 'proforma_invoice_content[]', $contains_error, 'text', 'proforma_invoice_row', ($a));
                        }
                        else {
                            $valid_proforma_invoice = $valid->row_error_display($form_name, 'proforma_invoice_content[]', $contains_error, 'text', 'proforma_invoice_row', ($a));
                        }
                    }
                }

                $product_rate[$i] = trim($product_rate[$i]);
                if(isset($product_rate[$i])) {
                    $rate_error = "";
                    $rate_error = $valid->valid_price($product_rate[$i], 'Rate', '1', '99999');
                    if(!empty($rate_error)) {
                        if(!empty($valid_proforma_invoice)) {
                            $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->row_error_display($form_name, 'proforma_invoice_sales_rate[]', $rate_error, 'text', 'proforma_invoice_row', ($a));
                        }
                        else {
                            $valid_proforma_invoice = $valid->row_error_display($form_name, 'proforma_invoice_sales_rate[]', $rate_error, 'text', 'proforma_invoice_row', ($a));
                        }
                    }
                }

                $per[$i] = trim($per[$i]);
                if(isset($per[$i])) {
                    $per_error = "";
                    $per_error = $valid->valid_number($per[$i], 'Per', '1', '5');
                    if(!empty($per_error)) {
                        if(!empty($valid_proforma_invoice)) {
                            $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->row_error_display($form_name, 'proforma_invoice_per[]', $per_error, 'text', 'proforma_invoice_row', ($a));
                        }
                        else {
                            $valid_proforma_invoice = $valid->row_error_display($form_name, 'proforma_invoice_per[]', $per_error, 'text', 'proforma_invoice_row', ($a));
                        }
                    }
                }

                $per_type[$i] = trim($per_type[$i]);
                if(isset($per_type[$i])) {
                    $per_type_error = "";
                    $per_type_error = $valid->common_validation($per_type[$i], 'Unit Type', 'select');
                    if(!empty($per_type_error)) {
                        if(!empty($valid_proforma_invoice)) {
                            $valid_proforma_invoice = $valid_proforma_invoice." ".$valid->row_error_display($form_name, 'proforma_invoice_per_type[]', $per_type_error, 'text', 'proforma_invoice_row', ($a));
                        }
                        else {
                            $valid_proforma_invoice = $valid->row_error_display($form_name, 'proforma_invoice_per_type[]', $per_type_error, 'text', 'proforma_invoice_row', ($a));
                        }
                    }
                }
                if ($draft == "1") {
                    $valid_proforma_invoice = "";
                }
                if(empty($valid_proforma_invoice)) {
                    $brand_name = "";
                    $brand_name = $obj->getTableColumnValue($GLOBALS['brand_table'], 'brand_id', $brand_ids[$i], 'brand_name');
                    $brand_names[$i] = $brand_name;

                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                    $unit_names[$i] = $unit_name;

                    $total_qty = 0; 
                    $amount = 0;
                    if($per_type[$i] == '1' || $per_type[$i] == 1) {
                        $rate_per_case = $product_rate[$i] / $per[$i];
                        $rate_per_piece = $rate_per_case / (int)$subunit_contains[$i];
                    } else {
                        $rate_per_piece = $product_rate[$i] / $per[$i];
                        $rate_per_case = (int)$subunit_contains[$i] * $rate_per_piece;
                    }

                    if($unit_types[$i] == '1' || $unit_types[$i] == 1) {
                        $rate_per_unit[$i]= $rate_per_case;
                        $amount = (int)$product_quantity[$i] * $rate_per_case;
                    } else {
                        $amount = (int)$product_quantity[$i] * $rate_per_piece;
                        $rate_per_unit[$i] = $rate_per_piece;
                    }
                    $amount = number_format($amount, 2);
                    $amount = str_replace(",", "", $amount);
                    $product_amount[$i] = $amount;
                    $sub_total += $amount;
                    if($unit_ids[$i] == $product_unit_id) {
                        $total_unit_qty += (int)$product_quantity[$i];
                    }
                    else if($unit_ids[$i] == $product_subunit_id) {
                        $total_subunit_qty += (int)$product_quantity[$i];
                    }
                    for($j=$i+1; $j < count($product_ids); $j++) {
                        if ($product_ids[$i] == $product_ids[$j] &&
                            $brand_ids[$i] == $brand_ids[$j] &&
                            $unit_types[$i] == $unit_types[$j] &&
                            $subunit_contains[$i] == $subunit_contains[$j]) {
                                $proforma_invoice_error = "Same Combination exists in Row No.".($i+1)." & ".($j+1);
                                break;
                        }
                    }
                }
                $a++;
            }
            $product_quantity = array_reverse($product_quantity);
            // $quantity_limit = array_reverse($quantity_limit);
        }
        else {
            $proforma_invoice_error = "Select Products";
        }
        $total_amount = $sub_total;
        if(isset($_POST['charges_id'])) {
            $charges_id = $_POST['charges_id'];
        }
        if(isset($_POST['charges_type'])) {
            $charges_type = $_POST['charges_type'];
        }
        if(isset($_POST['charges_value'])) {
            $charges_values = $_POST['charges_value'];
        }
        if(!empty($charges_id) && empty($proforma_invoice_error)) {
            for($i=0; $i < count($charges_id); $i++) {
                $charges_id[$i] = trim($charges_id[$i]);
                if(!empty($charges_id[$i])) {
                    $charges_name = ""; $charges_value = 0;
                    $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $charges_id[$i], 'charges_name');
                    $charges_names[$i] = $charges_name;
                    $charges_type[$i] = trim($charges_type[$i]);
                    $charges_values[$i] = trim($charges_values[$i]);
                    if(isset($charges_values[$i])) {
                        $charges_error = "";
                        if(strpos($charges_values[$i], '%') !== false) {
                            $charges_value = str_replace('%', '', $charges_values[$i]);
                            $charges_value = trim($charges_value);
                        }
                        else {
                            $charges_value = $charges_values[$i];
                        }
                        $charges_error = $valid->valid_price($charges_value, ($obj->encode_decode('decrypt', $charges_name)), 1, '');
                        if(!empty($charges_error)) {
                            if(!empty($proforma_invoice_error)) {
                                $proforma_invoice_error = $proforma_invoice_error."<br>".$charges_error;
                            }
                            else {
                                $proforma_invoice_error = $charges_error;
                            }
                        }
                        else {
                            if(strpos($charges_values[$i], '%') !== false) {
                                $charges_value = ($charges_value * $total_amount) / 100;
                                $charges_value = number_format($charges_value, 2);
                                $charges_value = str_replace(",", "", $charges_value);
                            }
                        }
                    }
                    if(empty($proforma_invoice_error)) {
                        $charges_total[$i] = $charges_value;
                        if($charges_type[$i] == "minus") {
                            $total_amount -= $charges_value;
                        }
                        else if($charges_type[$i] == "plus") {
                            $total_amount += $charges_value;
                        }
                    }
                }
                if(empty($proforma_invoice_error)) {
                    for($j=$i+1; $j < count($charges_id); $j++) {
                        if($charges_id[$i] == $charges_id[$j]) {
                            $proforma_invoice_error = "Same Charges Repeatedly Exists";
                            break;
                        }
                    }
                }
            }
        }
    

        $total_amount = number_format((float)$total_amount, 2, '.', '');
        $grand_total = $total_amount;

        $round_off = 0;
        if(!empty($grand_total)) {	
            if (strpos( $grand_total, "." ) !== false) {
                $pos = strpos($grand_total, ".");
                $decimal = substr($grand_total, ($pos + 1), strlen($grand_total));
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
                        
                        $grand_total = $grand_total + $round_off;
                    }
                    else {
                        $decimal = "0.".$decimal;
                        $round_off = "-".$decimal;
                        $grand_total = $grand_total - $decimal;
                    }
                }
            }
        }



        $party_error = "";
        if ($draft == "1" && empty($party_id)) {
            $valid_proforma_invoice = "";
            $proforma_invoice_error = "";
            $party_error = "Select Party Name";
        } else if ($draft == "1" && !empty($party_id)) {
            $valid_proforma_invoice = "";
            $proforma_invoice_error = "";
        }
        $result = "";
        if(empty($valid_proforma_invoice) && empty($proforma_invoice_error) && empty($party_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) { 
                $party_name_mobile_city = ""; $party_details = "";
                $agent_name_mobile_city = ""; $agent_details = "";
                if(!empty($proforma_invoice_number)) {
                    $proforma_invoice_number = $obj->encode_decode('encrypt', $proforma_invoice_number);
                }
                else {
                    $proforma_invoice_number = $GLOBALS['null_value'];
                }
                if(!empty($proforma_invoice_date)) {
                    $proforma_invoice_date = date('Y-m-d', strtotime($proforma_invoice_date));
                }
                if(!empty($agent_id)) {
                    $agent_name_mobile_city = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'name_mobile_city');
                    $agent_details = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'agent_details');
                }
                else {
                    $agent_id = $GLOBALS['null_value'];
                    $agent_name_mobile_city = $GLOBALS['null_value'];
                    $agent_details = $GLOBALS['null_value'];
                }
                
                if(!empty($party_id)) {
                    $party_name_mobile_city = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
                    $party_details = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_details');
                }
                else {
                    $party_id = $GLOBALS['null_value'];
                    $party_name_mobile_city = $GLOBALS['null_value'];
                    $party_details = $GLOBALS['null_value'];
                }
                if(!empty($product_ids)) {
                    // $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                }
                else {
                    $product_ids = $GLOBALS['null_value'];
                }
                if(!empty($product_names)) {
                    // $product_names = array_reverse($product_names);
                    $product_names = implode(",", $product_names);
                }
                else {
                    $product_names = $GLOBALS['null_value'];
                }
                if(!empty($brand_ids)) {
                    // $brand_ids = array_reverse($brand_ids);
                    $brand_ids = implode(",", $brand_ids);
                }
                else {
                    $brand_ids = $GLOBALS['null_value'];
                }
                if(!empty($brand_names)) {
                    // $brand_names = array_reverse($brand_names);
                    $brand_names = implode(",", $brand_names);
                }
                else {
                    $brand_names = $GLOBALS['null_value'];
                }
                if(!empty($unit_ids)) {
                    // $unit_ids = array_reverse($unit_ids);
                    $unit_ids = implode(",", $unit_ids);
                }
                else {
                    $unit_ids = $GLOBALS['null_value'];
                }
                if(!empty($unit_names)) {
                    // $unit_names = array_reverse($unit_names);
                    $unit_names = implode(",", $unit_names);
                }
                else {
                    $unit_names = $GLOBALS['null_value'];
                }
                if(!empty($subunit_ids)) {
                    // $subunit_ids = array_reverse($subunit_ids);
                    $subunit_ids = implode(",", $subunit_ids);
                }
                else {
                    $subunit_ids = $GLOBALS['null_value'];
                }
                if(!empty($subunit_names)) {
                    // $subunit_names = array_reverse($subunit_names);
                    $subunit_names = implode(",", $subunit_names);
                }
                else {
                    $subunit_names = $GLOBALS['null_value'];
                }
                if(!empty($unit_types)) {
                    // $unit_types = array_reverse($unit_types);
                    $unit_types = implode(",", $unit_types);
                }
                else {
                    $unit_types = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($subunit_contains, fn($value) => $value !== ""))) {
                    // $subunit_contains = array_reverse($subunit_contains);
                    $subunit_contains = implode(",", $subunit_contains);
                }
                else {
                    $subunit_contains = $GLOBALS['null_value'];
                }
                if(!empty($product_quantity)) {
                    // $product_quantity = array_reverse($product_quantity);
                    $product_quantity = implode(",", $product_quantity);
                }
                else {
                    $product_quantity = $GLOBALS['null_value'];
                }
                if(!empty($product_rate)) {
                    // $product_rate = array_reverse($product_rate);
                    $product_rate = implode(",", $product_rate);
                }
                else {
                    $product_rate = $GLOBALS['null_value'];
                }
                if(!empty($per)) {
                    // $per = array_reverse($per);
                    $per = implode(",", $per);
                }
                else {
                    $per = $GLOBALS['null_value'];
                }
                if(!empty($per_type)) {
                    // $per_type = array_reverse($per_type);
                    $per_type = implode(",", $per_type);
                }
                else {
                    $per_type = $GLOBALS['null_value'];
                }
                if(!empty($rate_per_unit)) {
                    // $rate_per_unit = array_reverse($rate_per_unit);
                    $rate_per_unit = implode(",", $rate_per_unit);
                }
                else {
                    $rate_per_unit = $GLOBALS['null_value'];
                }
                if(!empty($product_amount)) {
                    // $product_amount = array_reverse($product_amount);
                    $product_amount = implode(",", $product_amount);
                }
                else {
                    $product_amount = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_id, fn($value) => $value !== ""))) {
                    $charges_id = implode(",", $charges_id);
                }
                else {
                    $charges_id = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_type, fn($value) => $value !== ""))) {
                    $charges_type = implode(",", $charges_type);
                }
                else {
                    $charges_type = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_values, fn($value) => $value !== ""))) {
                    $charges_values = implode(",", $charges_values);
                }
                else {
                    $charges_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_total, fn($value) => $value !== ""))) {
                    $charges_total = implode(",", $charges_total);
                }
                else {
                    $charges_total = $GLOBALS['null_value'];
                }
                if(!empty($total_unit_qty)) {
                    $total_quantity = $total_unit_qty." Case";
                }
                else {
                    $total_unit_qty = $GLOBALS['null_value'];
                }
                if(!empty($total_subunit_qty)) {
                    if(!empty($total_quantity)) {
                        $total_quantity = $total_quantity." ".$total_subunit_qty." Pcs";
                    }
                    else {
                        $total_quantity = $total_subunit_qty." Pcs";
                    }
                }
                else {
                    $total_subunit_qty = $GLOBALS['null_value'];
                }
                
                $grand_qty = 0;
                if(!empty($total_subunit_quantity)) {
                    $total_subunit_quantity = array_reverse($total_subunit_quantity);
                    for($i = 0; $i< count($total_subunit_quantity); $i++) {
                        $total_subunit_quantity[$i] = trim($total_subunit_quantity[$i]);
                        if(!empty($total_subunit_quantity[$i])) {
                            $grand_qty += (int)$total_subunit_quantity[$i];
                        }
                    }
                    $total_subunit_quantity = implode(",", $total_subunit_quantity);
                }
                else {
                    $total_subunit_quantity = $GLOBALS['null_value'];
                }


                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $bill_company_id = $GLOBALS['bill_company_id'];
                $null_value = $GLOBALS['null_value'];
                $proforma_invoice_number = $null_value;

                if(empty($edit_id)) {
                    $action = "";
                    if(!empty($party_name_mobile_city) && $party_name_mobile_city != $GLOBALS['null_value']) {
                        $action = "New proforma_invoice Created. Party - ".($obj->encode_decode('decrypt', $party_name_mobile_city));
                    }
                    if(empty($draft) && $draft != "1") {
                        $proforma_invoice_number = $obj->automate_number($GLOBALS['proforma_invoice_table'], 'proforma_invoice_number');
                    }
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'proforma_invoice_id', 'proforma_invoice_number', 'proforma_invoice_date',  'party_id', 'party_name_mobile_city', 'party_details', 'agent_id', 'agent_name_mobile_city', 'agent_details', 'product_id', 'product_name', 'brand_id', 'brand_name', 'content', 'unit_id', 'unit_name', 'subunit_id', 'subunit_name', 'product_quantity', 'unit_type', 'product_rate', 'per', 'per_type', 'product_amount', 'rate_per_unit', 'sub_total', 'charges_id', 'charges_type', 'charges_value', 'charges_total',  'total_amount', 'round_off', 'grand_total','total_unit_qty', 'total_subunit_qty','total_quantity', 'total_qty','grand_qty', 'drafted', 'cancelled', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$proforma_invoice_number."'", "'".$proforma_invoice_date."'", "'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'","'".$agent_id."'", "'".$agent_name_mobile_city."'", "'".$agent_details."'", "'".$product_ids."'", "'".$product_names."'", "'".$brand_ids."'", "'".$brand_names."'", "'".$subunit_contains."'", "'".$unit_ids."'", "'".$unit_names."'",  "'".$subunit_ids."'", "'".$subunit_names."'", "'".$product_quantity."'", "'".$unit_types."'",  "'".$product_rate."'", "'".$per."'", "'".$per_type."'", "'".$product_amount."'", "'".$rate_per_unit."'", "'".$sub_total."'", "'".$charges_id."'", "'".$charges_type."'", "'".$charges_values."'", "'".$charges_total."'", "'".$total_amount."'", "'".$round_off."'", "'".$grand_total."'", "'".$total_unit_qty."'", "'".$total_subunit_qty."'", "'".$total_quantity."'","'".$total_subunit_quantity."'", "'".$grand_qty."'", "'".$draft."'", "'0'", "'0'");

                    $proforma_invoice_insert_id = $obj->InsertSQL($GLOBALS['proforma_invoice_table'], $columns, $values,'proforma_invoice_id', '', $action);

                    if(preg_match("/^\d+$/", $proforma_invoice_insert_id)) {
                        if ($draft != "1") {
                            $proforma_invoice_id = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'id', $proforma_invoice_insert_id, 'proforma_invoice_id');
                            $proforma_invoice_number = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'id', $proforma_invoice_insert_id, 'proforma_invoice_number');

                            if(!empty($product_ids)) {
                                $product_ids = explode(",", $product_ids);
                            }
                            else {
                                $product_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($product_names)) {
                                $product_names = explode(",", $product_names);
                            }
                            else {
                                $product_names = $GLOBALS['null_value'];
                            }
                            if(!empty($brand_ids)) {
                                $brand_ids = explode(",", $brand_ids);
                            }
                            else {
                                $brand_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($brand_names)) {
                                $brand_names = explode(",", $brand_names);
                            }
                            else {
                                $brand_names = $GLOBALS['null_value'];
                            }
                            if(!empty($unit_ids)) {
                                $unit_ids = explode(",", $unit_ids);
                            }
                            else {
                                $unit_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($unit_names)) {
                                $unit_names = explode(",", $unit_names);
                            }
                            else {
                                $unit_names = $GLOBALS['null_value'];
                            }
                            if(!empty($subunit_ids)) {
                                $subunit_ids = explode(",", $subunit_ids);
                            }
                            else {
                                $subunit_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($subunit_names)) {
                                $subunit_names = explode(",", $subunit_names);
                            }
                            else {
                                $subunit_names = $GLOBALS['null_value'];
                            }
                            if(!empty($unit_types)) {
                                $unit_types = explode(",", $unit_types);
                            }
                            else {
                                $unit_types = $GLOBALS['null_value'];
                            }
                            if(!empty($subunit_contains)) {
                                $subunit_contains = explode(",", $subunit_contains);
                            }
                            else {
                                $subunit_contains = $GLOBALS['null_value'];
                            }
                            if(!empty($product_quantity)) {
                                $product_quantity = explode(",", $product_quantity);
                            }
                            else {
                                $product_quantity = $GLOBALS['null_value'];
                            }
                            if(!empty($product_rate)) {
                                $product_rate = explode(",", $product_rate);
                            }
                            else {
                                $product_rate = $GLOBALS['null_value'];
                            }
                            if(!empty($per)) {
                                $per = explode(",", $per);
                            }
                            else {
                                $per = $GLOBALS['null_value'];
                            }
                            if(!empty($per_type)) {
                                $per_type = explode(",", $per_type);
                            }
                            else {
                                $per_type = $GLOBALS['null_value'];
                            }
                            if(!empty($rate_per_unit)) {
                                $rate_per_unit = explode(",", $rate_per_unit);
                            }
                            else {
                                $rate_per_unit = $GLOBALS['null_value'];
                            }
                            if(!empty($product_amount)) {
                                $product_amount = explode(",", $product_amount);
                            }
                            else {
                                $product_amount = $GLOBALS['null_value'];
                            }

                            if(!empty($product_ids) && $product_ids != $GLOBALS['null_value']) {
                                for($i=0; $i < count($product_ids); $i++) {
                                    $columns = array(); $values = array();
                                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id',  'proforma_invoice_number', 'product_id', 'product_name', 'brand_id', 'brand_name', 'subunit_contains', 'unit_id', 'unit_name', 'subunit_id', 'subunit_name', 'product_quantity','balance_qty', 'unit_type', 'product_rate', 'per', 'per_type', 'product_amount',  'deleted');
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$proforma_invoice_number."'", "'".$product_ids[$i]."'", "'".$product_names[$i]."'", "'".$brand_ids[$i]."'", "'".$brand_names[$i]."'", "'".$subunit_contains[$i]."'", "'".$unit_ids[$i]."'", "'".$unit_names[$i]."'",  "'".$subunit_ids[$i]."'", "'".$subunit_names[$i]."'", "'".$product_quantity[$i]."'","'".$product_quantity[$i]."'", "'".$unit_types[$i]."'",  "'".$product_rate[$i]."'", "'".$per[$i]."'", "'".$per_type[$i]."'", "'".$product_amount[$i]."'", "'0'");
                                    $proforma_invoice_insert_id = $obj->InsertSQL($GLOBALS['proforma_invoice_product_table'], $columns, $values,'', '', $action);
                                }
                            }

                            $result = array('number' => '1', 'msg' => 'proforma_invoice Successfully Created','redirection_page'=>'proforma_invoice.php');
                        } else {

                            $result = array('number' => '1', 'msg' => 'proforma_invoice Saved in Draft');
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $proforma_invoice_insert_id);
                    }
                }
                else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $edit_id, 'id');
                    $proforma_invoice_number = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $edit_id, 'proforma_invoice_number');
                    if (empty($draft) || $draft == '0') {
                        if (empty($proforma_invoice_number) || $proforma_invoice_number == $null_value) {
                            $proforma_invoice_number = $obj->automate_number($GLOBALS['proforma_invoice_table'], 'proforma_invoice_number');
                        }
                    }
                    if (empty($proforma_invoice_number)) {
                        $proforma_invoice_number = $null_value;
                    }
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if(!empty($party_name_mobile_city) && $party_name_mobile_city != $GLOBALS['null_value']) {
                            $action = "proforma_invoice Updated. Party - ".($obj->encode_decode('decrypt', $party_name_mobile_city));
                        }

                        $columns = array(); $values = array();		
                        $columns = array('creator_name', 'proforma_invoice_number', 'proforma_invoice_date', 'party_id', 'party_name_mobile_city', 'party_details','agent_id', 'agent_name_mobile_city', 'agent_details',  'product_id', 'product_name', 'brand_id', 'brand_name', 'content', 'unit_id', 'unit_name','subunit_id', 'subunit_name', 'product_quantity', 'unit_type', 'product_rate', 'per', 'per_type', 'product_amount', 'rate_per_unit', 'sub_total', 'charges_id', 'charges_type', 'charges_value', 'charges_total',  'total_amount', 'round_off', 'grand_total', 'total_unit_qty', 'total_subunit_qty', 'total_quantity', 'total_qty','grand_qty', 'drafted');
                        $values = array("'".$creator_name."'", "'".$proforma_invoice_number."'", "'".$proforma_invoice_date."'",  "'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$agent_id."'", "'".$agent_name_mobile_city."'", "'".$agent_details."'", "'".$product_ids."'", "'".$product_names."'", "'".$brand_ids."'", "'".$brand_names."'", "'".$subunit_contains."'", "'".$unit_ids."'", "'".$unit_names."'", "'".$subunit_ids."'", "'".$subunit_names."'", "'".$product_quantity."'", "'".$unit_types."'", "'".$product_rate."'", "'".$per."'", "'".$per_type."'", "'".$product_amount."'", "'".$rate_per_unit."'", "'".$sub_total."'", "'".$charges_id."'", "'".$charges_type."'", "'".$charges_values."'", "'".$charges_total."'", "'".$total_amount."'", "'".$round_off."'", "'".$grand_total."'", "'".$total_unit_qty."'", "'".$total_subunit_qty."'",  "'".$total_quantity."'", "'".$total_subunit_quantity."'", "'".$grand_qty."'", "'".$draft."'");

                        $proforma_invoice_update_id = $obj->UpdateSQL($GLOBALS['proforma_invoice_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $proforma_invoice_update_id)) {
                            if ($draft != "1") {
                                $proforma_invoice_id = $edit_id;
                                $proforma_invoice_number = $obj->getTableColumnValue($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $edit_id, 'proforma_invoice_number');
                                if(!empty($product_ids)) {
                                    $product_ids = explode(",", $product_ids);
                                }
                                else {
                                    $product_ids = $GLOBALS['null_value'];
                                }
                                if(!empty($product_names)) {
                                    $product_names = explode(",", $product_names);
                                }
                                else {
                                    $product_names = $GLOBALS['null_value'];
                                }
                                if(!empty($brand_ids)) {
                                    $brand_ids = explode(",", $brand_ids);
                                }
                                else {
                                    $brand_ids = $GLOBALS['null_value'];
                                }
                                if(!empty($brand_names)) {
                                    $brand_names = explode(",", $brand_names);
                                }
                                else {
                                    $brand_names = $GLOBALS['null_value'];
                                }
                                if(!empty($unit_ids)) {
                                    $unit_ids = explode(",", $unit_ids);
                                }
                                else {
                                    $unit_ids = $GLOBALS['null_value'];
                                }
                                if(!empty($unit_names)) {
                                    $unit_names = explode(",", $unit_names);
                                }
                                else {
                                    $unit_names = $GLOBALS['null_value'];
                                }
                                if(!empty($subunit_ids)) {
                                    $subunit_ids = explode(",", $subunit_ids);
                                }
                                else {
                                    $subunit_ids = $GLOBALS['null_value'];
                                }
                                if(!empty($subunit_names)) {
                                    $subunit_names = explode(",", $subunit_names);
                                }
                                else {
                                    $subunit_names = $GLOBALS['null_value'];
                                }
                                if(!empty($unit_types)) {
                                    $unit_types = explode(",", $unit_types);
                                }
                                else {
                                    $unit_types = $GLOBALS['null_value'];
                                }
                                if(!empty($subunit_contains)) {
                                    $subunit_contains = explode(",", $subunit_contains);
                                }
                                else {
                                    $subunit_contains = $GLOBALS['null_value'];
                                }
                                if(!empty($product_quantity)) {
                                    $product_quantity = explode(",", $product_quantity);
                                }
                                else {
                                    $product_quantity = $GLOBALS['null_value'];
                                }
                                if(!empty($product_rate)) {
                                    $product_rate = explode(",", $product_rate);
                                }
                                else {
                                    $product_rate = $GLOBALS['null_value'];
                                }
                                if(!empty($per)) {
                                    $per = explode(",", $per);
                                }
                                else {
                                    $per = $GLOBALS['null_value'];
                                }
                                if(!empty($per_type)) {
                                    $per_type = explode(",", $per_type);
                                }
                                else {
                                    $per_type = $GLOBALS['null_value'];
                                }
                                if(!empty($rate_per_unit)) {
                                    $rate_per_unit = explode(",", $rate_per_unit);
                                }
                                else {
                                    $rate_per_unit = $GLOBALS['null_value'];
                                }
                                if(!empty($product_amount)) {
                                    $product_amount = explode(",", $product_amount);
                                }
                                else {
                                    $product_amount = $GLOBALS['null_value'];
                                }
                                if(!empty($product_ids) && $product_ids != $GLOBALS['null_value']) {
                                    $proforma_invoice_product_list = $obj->getTableRecords($GLOBALS['proforma_invoice_product_table'], 'proforma_invoice_number', $proforma_invoice_number, '');
                                    $proforma_invoice_product_all_id =[];
                                    for($i=0; $i < count($product_ids); $i++) {
                                        // $getUniqueID = "";
                                        // $getUniqueID = $obj->getTableproforma_invoiceProduct($proforma_invoice_number,$product_ids[$i],$brand_ids[$i],$unit_types[$i]);
                                        // $columns = array(); $values = array();
                                        // $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id',  'proforma_invoice_number', 'product_id', 'product_name', 'brand_id', 'brand_name', 'subunit_contains', 'unit_id', 'unit_name', 'subunit_id', 'subunit_name', 'product_quantity','balance_qty', 'unit_type', 'product_rate', 'per', 'per_type', 'product_amount',  'deleted');
                                        // $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$proforma_invoice_number."'", "'".$product_ids[$i]."'", "'".$product_names[$i]."'", "'".$brand_ids[$i]."'", "'".$brand_names[$i]."'", "'".$subunit_contains[$i]."'", "'".$unit_ids[$i]."'", "'".$unit_names[$i]."'",  "'".$subunit_ids[$i]."'", "'".$subunit_names[$i]."'", "'".$product_quantity[$i]."'","'".$product_quantity[$i]."'", "'".$unit_types[$i]."'",  "'".$product_rate[$i]."'", "'".$per[$i]."'", "'".$per_type[$i]."'", "'".$product_amount[$i]."'", "'0'");
                                        // if($getUniqueID == $GLOBALS['null_value']) {
                                        //     $proforma_invoice_insert_id = $obj->InsertSQL($GLOBALS['proforma_invoice_product_table'], $columns, $values,'', '', $action);
                                        // } else {
                                        //     $proforma_invoice_update_id = $obj->UpdateSQL($GLOBALS['proforma_invoice_product_table'], $getUniqueID, $columns, $values, $action);
                                        // }
                                        // $proforma_invoice_product_all_id[] = $getUniqueID;
                                    }
                                }
                                $filtered_ids = array_column(array_filter($proforma_invoice_product_list, function($item) use ($proforma_invoice_product_all_id) {
                                    return !in_array($item['id'], $proforma_invoice_product_all_id);
                                }), 'id');
                                
                                if(!empty($filtered_ids)) {
                                    for($i = 0; $i< count($filtered_ids); $i++) {
                                        $columns = array(); $values = array();
                                        $columns = array('deleted');
                                        $values = array("'1'");
                                        $proforma_invoice_update_id = $obj->UpdateSQL($GLOBALS['proforma_invoice_product_table'], $filtered_ids[$i], $columns, $values, $action);
                                    }
                                }
                                $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'proforma_invoice.php');
                            } else {

                                $result = array('number' => '1', 'msg' => 'Draft Updated Successfully');
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $proforma_invoice_update_id);
                        }							
                    }
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_proforma_invoice)) {
                $result = array('number' => '3', 'msg' => $valid_proforma_invoice);
            } else if(!empty($proforma_invoice_error)) {
                $result = array('number' => '2', 'msg' => $proforma_invoice_error);
            } else if (!empty($party_error)) {
                $result = array('number' => '2', 'msg' => $party_error);
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
		$page_title = $_POST['page_title']; ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Proforma Invoice No /  Date</th>
                    <th>Party Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>IO/25/001 / 19-02-2025 </td>
                    <td>Mahesh Prabhu - Sivakasi</td>
                    <td>50,000.00</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div> 
                    </td>
                </tr>
            </tbody>
        </table>               
	<?php 
    }

    if(isset($_REQUEST['change_product_id'])) {
        $product_id =$_REQUEST['change_product_id'];
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id, '');
        $sales_rate = $unit_id = $subunit_id = $per = $per_type = $subunit_need = "0"; $unit_name =""; $subunit_name ="";
        if (!empty($product_list)) {
            foreach ($product_list as $P_list) {
                if (!empty($P_list['unit_id'])) {
                    $unit_id = $P_list['unit_id'];
                }
                if (!empty($P_list['subunit_id'])) {
                    $subunit_id = $P_list['subunit_id'];
                }
                if (!empty($P_list['unit_name'])) {
                    $unit_name = $P_list['unit_name'];
                    $unit_name = $obj->encode_decode("decrypt",$unit_name);
                }
                if (!empty($P_list['subunit_name'])) {
                    $subunit_name = $P_list['subunit_name'];
                    $subunit_name = $obj->encode_decode("decrypt",$subunit_name);
                }
                if (!empty($P_list['sales_rate'])) {
                    $sales_rate = $P_list['sales_rate'];
                }
                if (!empty($P_list['per'])) {
                    $per = $P_list['per'];
                }
                if (!empty($P_list['per_type'])) {
                    $per_type = $P_list['per_type'];
                }
                if (!empty($P_list['subunit_need'])) {
                    $subunit_need = $P_list['subunit_need'];
                }
            }
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
        
        echo "$$$" . $sales_rate . "$$$" . $per . "$$$" . "$$$" . $subunit_need . "$$$". $unit . "$$$" . $subunit ;
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

        $magazine_list =array();
        $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');

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
                <th class="text-center px-2 py-2 indv_magazine d-none">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="magazine_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                    <input type="text" name="content[]" class="form-control shadow-none" value="<?php if(!empty($selected_content)) { echo $selected_content; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                </th>
                
                <td>
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width:65px;" value="<?php if(!empty($selected_rate)){ echo $selected_rate; }?>" required>
                        </div>
                    </div> 
                </td>
                <td>
                    <?php
                        $per_unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_name');
                        $per_subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'subunit_name');
                    ?>
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
        $customer_list = $obj->getAgentcustomerList($agent_id);
        $agent_commission = $obj->getTableColumnValue($GLOBALS['agent_table'],'agent_id',$agent_id,'commission');
        // $customer_list = $obj->getTableRecords($GLOBALS['customer_table'],'agent_id',$agent_id,'');
        ?>
        <option value="">Select customer</option>
        <?php
        foreach($customer_list as $data)
        {
            ?>
                <option value="<?php if(!empty($data['customer_id'])){ echo $data['customer_id']; }?>"><?php if(!empty($data['customer_name'])){ echo $obj->encode_decode("decrypt",$data['customer_name']); } ?></option>
            <?php
        }
        echo "$$$ Commission : ".$agent_commission."$$$".$agent_commission;
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
                <div class="text-end"><span class="other_charges_total"></span></div>
            </td>
            <td></td>
        </tr>
        <tr class="charges_row" id="charges_row_total_<?php if(!empty($charges_count)) { echo $charges_count; } ?>">
            <td colspan="10" class="text-end ">Total :</td>
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
?>