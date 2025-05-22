<?php
	$page_title = "Pending Balance Report";

    $filter_party_id =""; 
    $bill_company_id = $GLOBALS['bill_company_id'];

    // $from_date = date('Y-m-d', strtotime('-30 days', strtotime($to_date)));
    $to_date = ""; $from_date = ""; $current_date = "";
    $to_date = date('Y-m-d'); $current_date = date('Y-m-d');

    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }

    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }

    if(isset($_POST['filter_party_id'])) {
        $filter_party_id = $_POST['filter_party_id'];
    }

    $view_type = [];
    // if (!isset($view_type) || empty($view_type)) {
    //     $view_type = ['1']; // Default to "Agent"
    // } else {
    //     $view_type = (array) $view_type; // Ensure it's treated as an array
    // }
    if (isset($view_type) || !empty($view_type)) {
        $view_type = (array) $view_type; // Ensure it's treated as an array
    }
    if (isset($_POST['view_type'])) {
        $view_type = $_POST['view_type']; // This will be an array
    }
    
    $filter_agent_customer ="";
    if(isset($_POST['filter_agent_customer']))
    {
        $filter_agent_customer = $_POST['filter_agent_customer'];
    }

    $party_list =array();
    $party_list = $obj->getCustomerList();
    
    $agent_list = array();
    $agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '','');

    $supplier_list = array();
    $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '','');

    $contractor_list = array();
    $contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '','');
 
    $total_party_list = array();
    if (!empty($view_type)) {
        if (in_array('1', $view_type)) {
            $total_party_list = array_merge($total_party_list, $agent_list);
        }
        if (in_array('2', $view_type)) {
            $total_party_list = array_merge($total_party_list, $supplier_list);
        }
        if (in_array('3', $view_type)) {
            $total_party_list = array_merge($total_party_list, $contractor_list);
        }
        if (in_array('4', $view_type)) {
            $total_party_list = array_merge($total_party_list, $party_list);
        }
    } else {
        if(!empty($agent_list)) {
            foreach($agent_list as $data) {
                if(!empty($data)) {
                    $total_party_list[] = $data;
                }
            }
        }
        if(!empty($supplier_list)) {
            foreach($supplier_list as $data) {
                if(!empty($data)) {
                    $total_party_list[] = $data;
                }
            }
        }
        if(!empty($contractor_list)) {
            foreach($contractor_list as $data) {
                if(!empty($data)) {
                    $total_party_list[] = $data;
                }
            }
        }
        if(!empty($party_list)) {
            foreach($party_list as $data) {
                if(!empty($data)) {
                    $total_party_list[] = $data;
                }
            }
        }
       
    }

    $sales_list = array(); $total_records_list =array();
    $type = [];

    if (!empty($view_type)) {
        if (in_array('1', $view_type)) {
            $type[] = "Agent";
        }
        if (in_array('2', $view_type)) {
            $type[] = "Supplier";
        }
        if (in_array('3', $view_type)) {
            $type[] = "Contractor";
        }
        if (in_array('4', $view_type)) {
            $type[] = "Customer";
        }
    }
    
    // Optional: Convert array to comma-separated string if needed
    $type_str = implode(', ', $type); // e.g., "Agent, Supplier"
    
    if(!empty($filter_party_id)) {
        $total_records_list= $obj->balance_report($type_str,$filter_party_id,$GLOBALS['bill_company_id'],$filter_agent_customer,$from_date,$to_date);
    } else {
        $sales_list = ""; 
        $sales_list= $obj->balance_report($type_str,'',$GLOBALS['bill_company_id'],'', $from_date,$to_date);
    }

    $excel_name = "";
    $excel_name = "Pending Balance Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";

?>

<div class="main-content border p-3" style="max-height: 400px; overflow-y: auto;">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="bg-googleplus card-header">
                        <h5 class="text-dark">Pending Balance Report</h5>
                    </div>
                    <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                    <form name="pending_balance_report_form" method="POST">
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-items-center">
                                <div class="row justify-content-end p-2">   
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0">
                                            <?php
                                            if (!isset($view_type) || empty($view_type)) {
                                                $view_type = ["1", "2", "3", "4"]; 
                                            } else {
                                                $view_type = (array)$view_type;
                                            }
                                            ?>
                                            <select class="select2 select2-danger" name="view_type[]" data-dropdown-css-class="select2-danger"
                                                    style="width: 100%;" multiple onchange="Javascript:getPartyName(this);getReport();">
                                                <option value="1" <?php echo (in_array("1", $view_type) ? 'selected' : ''); ?>>Agent</option>
                                                <option value="2" <?php echo (in_array("2", $view_type) ? 'selected' : ''); ?>>Supplier</option>
                                                <option value="3" <?php echo (in_array("3", $view_type) ? 'selected' : ''); ?>>Contractor</option>
                                                <option value="4" <?php echo (in_array("4", $view_type) ? 'selected' : ''); ?>>Customer</option>
                                            </select>

                                                <label>Party Type</label>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-6 px-lg-1">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" name="filter_party_id"  data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getReport();" <?php if(empty($view_type)){ ?>disabled <?php } ?>>
                                                <option value="">Select</option>
                                                    <?php
                                                        if(!empty($total_party_list)) {
                                                            foreach($total_party_list as $data) {
                                                                
                                                                if(!empty($data['agent_id']) && $data['agent_id'] !=$GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>" <?php if(!empty($filter_party_id)){ if($filter_party_id == $data['agent_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['agent_name'])) {
                                                                                $data['agent_name'] = $obj->encode_decode('decrypt', $data['agent_name']);
                                                                                echo html_entity_decode($data['agent_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }

                                                                if(!empty($data['supplier_id']) && $data['supplier_id'] !=$GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>" <?php if(!empty($filter_party_id)){ if($filter_party_id == $data['supplier_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['supplier_name'])) {
                                                                                $data['supplier_name'] = $obj->encode_decode('decrypt', $data['supplier_name']);
                                                                                echo html_entity_decode($data['supplier_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }

                                                                if(!empty($data['contractor_id']) && $data['contractor_id'] !=$GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>" <?php if(!empty($filter_party_id)){ if($filter_party_id == $data['contractor_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['contractor_name'])) {
                                                                                $data['contractor_name'] = $obj->encode_decode('decrypt', $data['contractor_name']);
                                                                                echo html_entity_decode($data['contractor_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }

                                                                if(!empty($data['customer_id']) && $data['customer_id'] !=$GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['customer_id'])) { echo $data['customer_id']; } ?>" <?php if(!empty($filter_party_id)){ if($filter_party_id == $data['customer_id']){ echo "selected"; } } ?>>
                                                                        <?php
                                                                            if(!empty($data['customer_name'])) {
                                                                                $data['customer_name'] = $obj->encode_decode('decrypt', $data['customer_name']);
                                                                                echo html_entity_decode($data['customer_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }

                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Name</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <?php if(!empty($filter_party_id)){ ?>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-1">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="date" id="from_date" name="from_date" class="form-control shadow-none" onchange="Javascript:getReport();checkDateCheck();" value="<?php if(!empty($from_date)){ echo $from_date; }?>" placeholder="" required="" max="<?php if(!empty($current_date)){ echo $current_date; }?>">
                                                <label>From Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-1">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="date" id="to_date" name="to_date" class="form-control shadow-none"  onchange="Javascript:getReport();checkDateCheck();"  value="<?php if(!empty($to_date)){ echo $to_date; }?>" placeholder="" required="" max="<?php if(!empty($current_date)){ echo $current_date; }?>">
                                                <label>To Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-4 col-12 px-lg-1 text-end">
                                    <?php
                                        
                                        if (is_array($view_type)) {
                                            $view_type_value = implode(',', $view_type); // Convert array to comma-separated string
                                        } else {
                                            $view_type_value = '1'; // Default value if not array
                                        }  ?>
                                    
                                        <button class="btn btn-primary m-1" style="font-size:11px;" type="button"
                                            onclick="window.open('reports/rpt_pending_payment.php?filter_party_id=<?php echo $filter_party_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&view_type=<?php echo $view_type_value; ?>&is_download=','_blank')">
                                            <i class="fa fa-print"></i> Print
                                        </button>
                                        

                                        <button class="btn btn-success m-1" style="font-size:11px;" type="button" onclick="window.open('reports/rpt_pending_payment.php?filter_party_id=<?php echo $filter_party_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&view_type=<?php echo $view_type_value; ?>&is_download=D','_blank')"> <i class="fa fa-file-pdf-o"></i> Pdf </button>
                                        <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onClick="ExportToExcel()"> <i class="fa fa-download"></i> Export </button> 
                                    </div> 
                                    <form name="table_listing_form" method="post">
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="table-responsive table-bordered">
                                        <table cellpadding="0" cellspacing="0" class="table display report_table no_$obj->numberFormat" style="width: 100%; border:solid 1px black;" id="tbl_pending_balance_list">
                                            <?php if(!empty($filter_party_id)) { ?>
                                                <thead class="smallfnt">
                                                    <tr>
                                                        <th colspan="7" style="border-top: 1px solid #000!important; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 3px; font-size: 13px;">
                                                            Pending Payment Overall - <?php echo date('d-m-Y'); ?> <br>
                                                            <?php
                                                                $party_name = "";
                                                                if(!empty($filter_party_id)) {
                                                                    $party_name="";
                                                                    if(in_array('1', $view_type)) {
                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['agent_table'],'agent_id',$filter_party_id,'agent_name');
                                                                    } else if(in_array('2', $view_type)) {
                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$filter_party_id,'supplier_name');
                                                                    } else if(in_array('3', $view_type)) {
                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'],'contractor_id',$filter_party_id,'contractor_name');
                                                                    } else if(in_array('4', $view_type)) {
                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'],'customer_id',$filter_party_id,'customer_name');
                                                                    }
                                                                    if(!empty($party_name)) {
                                                                        echo html_entity_decode($obj->encode_decode("decrypt",$party_name));
                                                                    }
                                                                }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <!-- <th style="border-top: 1px solid #000!important; border-left: 1px solid #000!important; border-bottom: 1px solid #000!important; border-right: 1px solid #000!important; text-align: center; padding: 3px; font-size: 13px;">S.No</th> -->
                                                        <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Date</th>
                                                        <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Bill No</th>
                                                        <?php if(in_array('1', $view_type)) { ?> <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Customer</th> <?php } ?>
                                                        <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Type</th>
                                                        <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Credit</th>
                                                        <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Debit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $credit_amount = 0; $debit_amount = 0; $total =0; 
                                                        $opening_balance_list = array();
                                                        $opening_balance_list = $obj->getOpeningBalance($filter_party_id,$from_date,$to_date,$GLOBALS['bill_company_id'],$filter_agent_customer,$view_type);
                                                        $opening_debit = 0; $opening_credit = 0;
                                                        if(!empty($opening_balance_list)) {
                                                            foreach($opening_balance_list as $data) {
                                                                if(!empty($data['debit'])) {
                                                                    $opening_debit += $data['debit'];
                                                                }
                                                                if(!empty($data['credit'])) {
                                                                    $opening_credit += $data['credit'];
                                                                }
                                                                if(!empty($data['opening_balance']) && $data['opening_balance'] !=$GLOBALS['null_value']) {
                                                                    if($data['opening_balance_type'] == 'Credit') {
                                                                        $opening_credit += $data['opening_balance'];
                                                                    }
                                                                    if($data['opening_balance_type'] == 'Debit') {
                                                                        $opening_debit += $data['opening_balance'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                            <tr>
                                                                <th colspan="<?php if(in_array('1', $view_type)) { echo 4; } else { echo 3; }?>" style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                    Opening Balance
                                                                </th>
                                                                <th style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                    <?php
                                                                        if($opening_credit > $opening_debit) {
                                                                            $credit_amount = $opening_credit - $opening_debit;
                                                                            echo $obj->numberFormat($credit_amount, 2);
                                                                        } 
                                                                    ?>
                                                                </th>
                                                                <th style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                    <?php
                                                                        if($opening_debit > $opening_credit){
                                                                            $debit_amount = $opening_debit - $opening_credit;
                                                                            echo $obj->numberFormat($debit_amount, 2);
                                                                        } 
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                        <?php
                                                    if(!empty($total_records_list)) { ?>
                                                        <tbody>
                                                            <?php
                                                            $sno = 0;
                                                        
                                                            foreach($total_records_list as $key => $data) {
                                                                if(!empty($data['bill_list'])){
                                                                    foreach($data['bill_list'] as $key => $list) {
                                                                        $credit =0; $debit =0; $total_credit = 0; $total_debit = 0;
                                                                        if(!empty($list['credit'])) {
                                                                            $credit =$list['credit'];
                                                                        }
                                                                        if(!empty($list['debit'])) {
                                                                            $debit = $list['debit'];
                                                                        }
                                                                        
                                                                        $sno++;
                                                                        ?>
                                                                        <tr>
                                                                            <!-- <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $sno; ?></td> -->
                                                                            <td style="border:1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                                <?php 
                                                                                    echo date('d-m-Y',strtotime($list['bill_date']));
                                                                                ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;cursor: pointer; x" class="text-center px-2 py-2" onClick="Javascript:getBillPDF('<?php if(!empty($list['bill_id'])) { echo $list['bill_id']; } ?>');">
                                                                                <?php
                                                                                if(!empty($list['bill_number'])) {
                                                                                    echo $bill_number =  $list['bill_number'];
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <?php if(in_array('1', $view_type)) { ?>
                                                                            <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;cursor: pointer; x" class="text-center px-2 py-2" onClick="Javascript:getBillPDF('<?php if(!empty($list['bill_id'])) { echo $list['bill_id']; } ?>');">
                                                                                <?php
                                                                                    $customer_name = "";
                                                                                    if(!empty($list['bill_id']) && $list['bill_id'] != "NULL") {
                                                                                        $customer_id = $obj->getTableColumnValue($GLOBALS['estimate_table'],'estimate_id', $list['bill_id'], 'customer_id');
                                                    
                                                                                        if(!empty($customer_id)) {
                                                                                            $customer_name = $obj->getTableColumnValue($GLOBALS['customer_table'],'customer_id', $customer_id, 'customer_name');
                                                                                            if(!empty($customer_name)) {
                                                                                                $customer_name = $obj->encode_decode('decrypt', $customer_name);
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    if(!empty($customer_name)) {
                                                                                        echo $customer_name;
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <?php } ?>
                                                                            <td style="border: 1px solid #000; text-align: center; font-size: 13px; vertical-align: middle; height: 30px;cursor: pointer;" class="text-center px-2">
                                                                            <?php
                                                                                if (!empty($list['bill_type'])) {
                                                                                    if ($list['bill_type'] == "Estimate") {
                                                                                        ?>
                                                                                        <div style="display: flex;justify-content: space-between;">
                                                                                            <div onclick="viewpreview('1','<?php echo $list['bill_id']; ?>', '');" style="width: 50%; cursor: pointer;border-right:1px solid;">
                                                                                                Estimate
                                                                                            </div>
                                                                                            <?php 
                                                                                                if(!empty($list['bill_id'])) { 
                                                                                                    $proforma_invoice_id = $obj->getTableColumnValue($GLOBALS['estimate_table'], 'estimate_id', $list['bill_id'], 'proforma_invoice_id');
                                                                                                    ?>
                                                                                                    <div onclick="viewpreview('2','', '<?php echo $proforma_invoice_id; ?>');" style="width: 50%; cursor: pointer;">
                                                                                                        Proforma<br>Invoice
                                                                                                    </div>
                                                                                                    <?php
                                                                                                } 
                                                                                            ?>
                                                                                        </div>
                                                                                        <?php
                                                                                    } else if ($list['bill_type'] == "Voucher") { ?>
                                                                                        <div onclick="viewpreview('3','<?php echo $list['bill_id']; ?>', '');" style="width: 100%; cursor: pointer;">
                                                                                                Voucher
                                                                                            </div>
                                                                                        <?php 
                                                                                    } else if ($list['bill_type'] == "Receipt") { ?>
                                                                                        <div onclick="viewpreview('4','<?php echo $list['bill_id']; ?>', '');" style="width: 100%; cursor: pointer;">
                                                                                                Receipt
                                                                                            </div>
                                                                                        <?php 
                                                                                    } else if ($list['bill_type'] == "Purchase Bill") { ?>
                                                                                        <div onclick="viewpreview('5','<?php echo $list['bill_id']; ?>', '');" style="width: 100%; cursor: pointer;">
                                                                                                Purchase Bill
                                                                                            </div>
                                                                                        <?php 
                                                                                    } else if ($list['bill_type'] == "Daily Production") { ?>
                                                                                        <div onclick="viewpreview('6','<?php echo $list['bill_id']; ?>', '');" style="width: 100%; cursor: pointer;">Daily Production</div>
                                                                                        <?php 
                                                                                    } else if ($list['bill_type'] == "SemiFinished Inward") { ?>
                                                                                        <div onclick="viewpreview('7','<?php echo $list['bill_id']; ?>', '');" style="width: 100%; cursor: pointer;">SemiFinished Inward</div>
                                                                                        <?php 
                                                                                    }
                                                                                } else {
                                                                                    echo " - ";
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                                <?php if(!empty($credit)) { 
                                                                                    echo $obj->numberFormat($credit, 2); $credit_amount += $credit; ?>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                                <?php 
                                                                                if(!empty($debit)){ 
                                                                                    echo $obj->numberFormat($debit, 2); $debit_amount += $debit; ?>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    
                                                                        <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </tbody>
                                                        <?php 
                                                            $display_status =""; $id ="";
                                                            
                                                            if(!empty($id)) { 
                                                                if($credit_amount > $debit_amount ) {
                                                                    $display_status ="Total";
                                                                } else {
                                                                    $display_status ="Total";
                                                                }
                                                            } else {
                                                                if($credit_amount < $debit_amount ) {
                                                                    $display_status ="Total";
                                                                } else {
                                                                    $display_status ="Total";
                                                                }
                                                            }
                                                        ?>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="<?php if(in_array('1', $view_type)) { echo 4; } else { echo 3; }?>" style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;">Total</th>
                                                                <th class="sales_total" style="border: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;"><?php if(!empty($credit_amount)){ echo $obj->numberFormat($credit_amount,2); } ?></th>
                                                                <th class="receipt_total" style="border: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;"><?php if(!empty($debit_amount)){ echo $obj->numberFormat($debit_amount,2); } ?></th>
                                                            </tr>
                                                            <tr style="color:red;">
                                                                <th class="text-center px-2 py-2" colspan="<?php if(in_array('1', $view_type)) { echo 4; } else { echo 3; }?>" style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Total</th>
                                                                <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" class="text-right px-2 py-credit_amount2"><?php if($credit_amount > $debit_amount) { echo $obj->numberFormat(($credit_amount- $debit_amount),2)." Cr"; } ?>
                                                                <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" class="text-right px-2 py-2"> <?php if($debit_amount > $credit_amount){ 
                                                                    $total_pending_amount = $debit_amount - $credit_amount; echo $obj->numberFormat($total_pending_amount,2)." Dr"; } ?></td>
                                                                
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td colspan="<?php if(in_array('1', $view_type)) { echo 7; } else { echo 6; }?>" style="border: 1px solid #000; text-align: center; padding: 2px 5px;">
                                                                No Records Found
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            <?php }
                                            else{ ?>

                                                <thead>
                                                    <tr>
                                                        <th colspan="4" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Pending Payment Report - <?php echo date('d-m-Y'); ?> </th>
                                                    </tr>
                                                    <tr>
                                                        <th style="border: 1px solid #000; width: 43px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">S.No</th>
                                                        <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Party Name</th>
                                                        <th style="border: 1px solid #000; width: 100px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Debit</th>
                                                        <th style="border: 1px solid #000; width: 100px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Credit</th>
                                                    </tr>
                                                </thead>
                                                <?php if(!empty($sales_list)) {
                                                
                                                    ?>
                                                <tbody>
                                                    <?php
                                                        $grand_pending = 0; $credit = 0; $debit = 0; $estimate_debit = 0; $credit_total_amount =0; $debit_total_amount =0; $grand_credit_total = 0; $grand_debit_total =0; $sno = 1;
                                                        foreach($sales_list as $key => $data) {      
                                                            $index = $key + 1; $credit_total = 0; $debit_total=0;
                                                                ?>
                                                                <tr>
                                                                    <td style="border: 1px solid #000; width: 43px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $index; ?></td>
                                                                    <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; padding: 2px 10px; font-size: 13px; cursor: pointer; vertical-align: middle; height: 30px;" onClick="Javascript:showpartyList('<?php echo $data['party_id']; ?>','<?php echo $data['party_type'];?>');">
                                                                    <?php
                                                                        if(!empty($data['party_name'])) {
                                                                            echo html_entity_decode($obj->encode_decode('decrypt',$data['party_name'])); 
                                                                            if(!empty($data['party_mobile_number']) && $data['party_mobile_number'] !=$GLOBALS['null_value']) {
                                                                                echo " - (".$obj->encode_decode('decrypt',$data['party_mobile_number']).")"; 
                                                                            }
                                                                        }
                                                                    ?>
                                                                    </td>
                                                                    <?php 
                                                                        
                                                                        if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Credit') ) {
                                                                            $credit_total = $credit_total + $data['opening_balance'];
                                                                            $credit = $credit + $credit_total;
                                                                        } 
                                                                        if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Debit') ) {
                                                                            $debit_total = $debit_total + $data['opening_balance'];
                                                                            $debit = $debit + $debit_total;
                                                                        }
                                                                        
                                                                        if(!empty($data['credit'])) {
                                                                        
                                                                            $credit_total = $credit_total + $data['credit'];
                                                                            $credit = $credit + $credit_total;
                                                                        }

                                                                        if(!empty($data['debit'])) {
                                                                        
                                                                            $debit_total = $debit_total + $data['debit'];
                                                                            $debit = $debit + $debit_total;
                                                                        }

                                                                        if($credit_total > $debit_total) {
                                                                            $total_amount = $debit_total - $credit_total;
                                                                        } else{
                                                                            $total_amount = $credit_total - $debit_total;
                                                                        }

                                                                    ?>

                                                                    <td class="column1" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                        <?php 
                                                                        if($debit_total >= $credit_total){ $total_amount = $debit_total - $credit_total;echo $obj->numberFormat(($total_amount),2); $debit_total_amount = $debit_total_amount + $total_amount; }?>
                                                                    </td>
                                                                    <td class="column1" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                        <?php if($credit_total > $debit_total) { $total_amount = $credit_total  -$debit_total; echo $obj->numberFormat(($total_amount),2); $credit_total_amount = $credit_total_amount + $total_amount; }?>
                                                                    </td>
                                                                </tr>
                                                            <?php $sno++; 
                                                            // }

                                                            ?>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" style="border: 1px solid #000; padding: 2px 10px; font-size: 13px; text-align: right; vertical-align: middle; height: 30px;"></th>
                                                        <th class="column1_total" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                            <?php 
                                                            if(!empty($debit_total_amount)) {
                                                                    echo $obj->numberFormat(($debit_total_amount),2);
                                                                } 
                                                            ?>
                                                        </th>
                                                        <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                            <?php
                                                            if(!empty($credit_total_amount)) {
                                                                    echo $obj->numberFormat($credit_total_amount,2);
                                                            } 
                                                            ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2" style="border: 1px solid #000; padding: 2px 10px; font-size: 13px; text-align: right; vertical-align: middle; height: 30px;">Total</th>
                                                        <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                            <?php 
                                                            if(!empty($credit_total_amount || ($debit_total_amount))) {
                                                                if($debit_total_amount > $credit_total_amount)  {
                                                                    echo $obj->numberFormat(($debit_total_amount-$credit_total_amount),2);
                                                                }
                                                            } 
                                                            ?>
                                                        </th>
                                                        <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                            <?php 
                                                                if(!empty($credit_total_amount || ($debit_total_amount))) {
                                                                    if($credit_total_amount > $debit_total_amount)  {
                                                                        echo $obj->numberFormat(($credit_total_amount-$debit_total_amount),2);
                                                                    }
                                                                } 
                                                            ?>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td colspan="4" style="border: 1px solid #000; padding: 2px 5px; text-align: center;">
                                                            No Records Found
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>

<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script>
    $(document).ready(function(){
        $("#pending_balance_report").addClass("active");
        // table_listing_records_filter();
    });

    function getReport() {
        if(jQuery('form[name="pending_balance_report_form"]').length > 0){
            jQuery('form[name="pending_balance_report_form"]').submit();
        } 
    }

    function showpartyList(party_id,view_type) {
        if(jQuery('select[name="filter_party_id"]').length > 0) {
            jQuery('select[name="filter_party_id"]').prop('disabled', false);
        }
        if(jQuery('select[name="filter_party_id"]').length > 0) {
            jQuery('select[name="filter_party_id"]').val(party_id);
        }
        var type ="";
        if(view_type =='agent') {
            type = '1';
        } else if(view_type =='supplier') {
            type = '2';
            
        }else if(view_type =='contractor') {
            type = '3';
            
        } else if(view_type =='customer') {
            type = '4';
        }

        if(jQuery('select[name="view_type[]"]').length > 0) {
            jQuery('select[name="view_type[]"]').val(type).trigger('change');
        }
        getReport();
    }

    function viewpreview(type,bill_id, sub_bill_id){
        var url = "";
        bill_id = bill_id.trim();
        type = type.trim();
        if (type == '1') {
            type ="Estimate";
            url = "reports/rpt_estimate_a4.php?estimate_id=" + bill_id;
        } else if(type == '2') {
            type ="Proforma Invoice";
            url = "reports/rpt_proforma_invoice_a4.php?proforma_invoice_id=" + sub_bill_id;
        } else if(type == '3') {
            type ="Voucher";
            url = "reports/rpt_voucher_a5.php?view_voucher_id=" + bill_id;
        } else if(type == '4') {
            type ="Receipt";
            url = "reports/rpt_receipt_a5.php?view_receipt_id=" + bill_id;
        } else if(type == '5') {
            type ="Purchase Bill";
            url = "reports/rpt_purchase_entry_a4.php?view_purchase_entry_id=" + bill_id;
        } else if(type == '6') {
            type ="Daily Production";
            url = "reports/rpt_daily_production_a5.php?view_daily_production_id=" + bill_id;
        } else if(type == '7') {
            type ="Semifinished Inward";
            url = "reports/rpt_semifinished_inward_a5.php?view_semifinished_inward_id=" + bill_id;
        }
        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url,
            success: function (check_login_session) {
                if (check_login_session == 1) {
                    jQuery('#PaymentModal .modal-header h1').html(type +"  Preview");
                    jQuery('.payment_modal_button').trigger("click");
                    var iframe = '<iframe src="' + url + '" width="100%" height="500px" style="border:none;"></iframe>';
                    jQuery('#PaymentModal .modal-body').html(iframe);
                } else {
                    window.location.reload();
                }
            }
        });
    }
    
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_pending_balance_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("pending_balance_report.php","_self");
    }
</script>