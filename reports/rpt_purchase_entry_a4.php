<?php

    include("../include_user_check.php");
    include("../include/number2words.php");

    $view_purchase_entry_id = "";
    if(isset($_REQUEST['view_purchase_entry_id'])) {
        $view_purchase_entry_id = $_REQUEST['view_purchase_entry_id'];
       
    } else {
        header("Location: ../purchase_entry.php");
        exit;
    }

    $purchase_entry_date = date('Y-m-d'); $current_date = date('Y-m-d'); $purchase_entry_number = ""; $supplier_id = ""; $supplier_name_mobile_city = ""; $supplier_details = "";  $vehicle = ""; $company_state = ""; $supplier_state = ""; $gst_option = 0; $tax_type = 0; $tax_option = 0; $godown_id = ""; $godown_ids = array(); $godown_name = ""; $godown_names = array(); $product_count = 0; $product_ids = ""; $product_ids = array(); $product_names = ""; $product_names = array(); $quantity = ""; $quantity = array(); $unit_type = ""; $unit_type = array();  $content = ""; $content = array(); $total_qty = array(); $rate = array(); $per = array(); $per_type = array(); $final_rate = array(); $overall_tax = ""; $product_amount = ""; $product_amount = array(); $sub_total = 0; $other_charges_id = array(); $charges_types = array(); $other_charges_values = array();$other_charges_total = array(); $cgst_value = 0; $sgst_value = 0; $igst_value = 0; $total_tax_value = 0; $product_tax = array(); $round_off = 0; $total_amount = 0; $stock_update = 0; $received_slip_id = ""; $unit_ids =""; $unit_ids = array(); $unit_names=""; $unit_names = array(); $rate_per_unit = array(); $cancelled = 0; $deleted = 0; $location_id = array(); $location_name = array(); $location_type = ""; $product_group = "";
    
    if(!empty($view_purchase_entry_id)) {
        $purchase_entry_list = array();
        $purchase_entry_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $view_purchase_entry_id,'');
        if(!empty($purchase_entry_list)) {
            foreach($purchase_entry_list as $data) {
                if(!empty($data['purchase_entry_date'])) {
                    $purchase_entry_date = date('d-m-Y', strtotime($data['purchase_entry_date']));
                }
                if(!empty($data['purchase_entry_number'])) {
                    $purchase_entry_number = $data['purchase_entry_number'];
                }
                if(!empty($data['supplier_id']) && $data['supplier_id'] != $GLOBALS['null_value']) {
                    $supplier_id = $data['supplier_id'];
                }
                if(!empty($data['supplier_name_mobile_city']) && $data['supplier_name_mobile_city'] != $GLOBALS['null_value']) {
                    $supplier_name_mobile_city = $data['supplier_name_mobile_city'];
                }
                if(!empty($supplier_id)) {
                    if(!empty($data['supplier_details']) && $data['supplier_details'] != $GLOBALS['null_value']) {
                        $supplier_details = $data['supplier_details'];
                        $party_detail = $obj->encode_decode('decrypt',$supplier_details);
                        $party_detail = html_entity_decode($party_detail);
                        $supplier_details = explode("$$$",$party_detail);
                    }
                }                
                if(!empty($data['vehicle']) && $data['vehicle'] != $GLOBALS['null_value']) {
                    $vehicle = $data['vehicle'];
                }
                if(!empty($data['supplier_state']) && $data['supplier_state'] != $GLOBALS['null_value']) {
                    $supplier_state = $data['supplier_state'];
                }
                if(!empty($data['company_state']) && $data['company_state'] != $GLOBALS['null_value']) {
                    $company_state = $data['company_state'];
                }
                if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                    $gst_option = $data['gst_option'];
                }
                if(!empty($data['tax_type']) && $data['tax_type'] != $GLOBALS['null_value']) {
                    $tax_type = $data['tax_type'];
                }
                if(!empty($data['tax_option']) && $data['tax_option'] != $GLOBALS['null_value']) {
                    $tax_option = $data['tax_option'];
                }
                if(!empty($data['godown_type']) && $data['godown_type'] != $GLOBALS['null_value']) {
                    $godown_type = $data['godown_type'];
                }
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_id = $data['godown_id'];
                    $godown_ids = explode(",", $godown_id);
                    // $godown_ids = array_reverse($godown_ids);
                }
                if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                    $godown_name = $data['godown_name'];
                    $godown_names = explode(",", $godown_name);
                    // $godown_names = array_reverse($godown_names);
                }
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    // $product_ids = array_reverse($product_ids);
                    $product_count = count($product_ids);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                    // $product_names = array_reverse($product_names);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                    // $quantity = array_reverse($quantity);
                }
                if(!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                    $unit_type = $data['unit_type'];
                    $unit_type = explode(",", $unit_type);
                    // $unit_type = array_reverse($unit_type);
                }
                if(!empty($data['content']) && $data['content'] != $GLOBALS['null_value']) {
                    $content = $data['content'];
                    $content = explode(",", $content);
                    // $content = array_reverse($content);
                }
                if(!empty($data['total_qty']) && $data['total_qty'] != $GLOBALS['null_value']) {
                    $total_qty = $data['total_qty'];
                    $total_qty = explode(",", $total_qty);
                    // $total_qty = array_reverse($total_qty);
                }
                if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                    $rate = $data['rate'];
                    $rate = explode(",", $rate);
                    // $rate = array_reverse($rate);
                }
                if(!empty($data['per']) && $data['per'] != $GLOBALS['null_value']) {
                    $per = $data['per'];
                    $per = explode(",", $per);
                    // $per = array_reverse($per);
                }
                if(!empty($data['per_type']) && $data['per_type'] != $GLOBALS['null_value']) {
                    $per_type = $data['per_type'];
                    $per_type = explode(",", $per_type);
                    // $per_type = array_reverse($per_type);
                }
                if(!empty($data['final_rate']) && $data['final_rate'] != $GLOBALS['null_value']) {
                    $final_rate = $data['final_rate'];
                    $final_rate = explode(",", $final_rate);
                    // $final_rate = array_reverse($final_rate);
                }
                if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                    $product_amount = $data['product_amount'];
                    $product_amount = explode(",", $product_amount);
                    // $product_amount = array_reverse($product_amount);
                }
                if(!empty($data['sub_total']) && $data['sub_total'] != $GLOBALS['null_value']) {
                    $sub_total = $data['sub_total'];
                }
                if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value']) {
                    $overall_tax = $data['overall_tax'];
                }
                if(!empty($data['other_charges_id']) && $data['other_charges_id'] != $GLOBALS['null_value']) {
                    $other_charges_id = $data['other_charges_id'];
                    $other_charges_id = explode(",", $other_charges_id);
                    // $other_charges_id = array_reverse($other_charges_id);
                }
                if(!empty($data['charges_type']) && $data['charges_type'] != $GLOBALS['null_value']) {
                    $charges_types = $data['charges_type'];
                    $charges_types = explode(",", $charges_types);
                    // $charges_types = array_reverse($charges_types);
                }
                if(!empty($data['other_charges_value']) && $data['other_charges_value'] != $GLOBALS['null_value']) {
                    $other_charges_values = $data['other_charges_value'];
                    $other_charges_values = explode(",", $other_charges_values);
                    // $other_charges_values = array_reverse($other_charges_values);
                }
                if(!empty($data['other_charges_total']) && $data['other_charges_total'] != $GLOBALS['null_value']) {
                    $other_charges_total = $data['other_charges_total'];
                    $other_charges_total = explode(",", $other_charges_total);
                    // $other_charges_total = array_reverse($other_charges_total);
                }
                if(!empty($data['cgst_value']) && $data['cgst_value'] != $GLOBALS['null_value']) {
                    $cgst_value = $data['cgst_value'];
                }
                if(!empty($data['sgst_value']) && $data['sgst_value'] != $GLOBALS['null_value']) {
                    $sgst_value = $data['sgst_value'];
                }
                if(!empty($data['igst_value']) && $data['igst_value'] != $GLOBALS['null_value']) {
                    $igst_value = $data['igst_value'];
                }
                if(!empty($data['total_tax_value']) && $data['total_tax_value'] != $GLOBALS['null_value']) {
                    $total_tax_value = $data['total_tax_value'];
                }
                if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                    $product_tax = $data['product_tax'];
                    $product_tax = explode(",", $product_tax);
                    // $product_tax = array_reverse($product_tax);
                }
                if(!empty($data['round_off']) && $data['round_off'] != $GLOBALS['null_value']) {
                    $round_off = $data['round_off'];
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_amount = $data['total_amount'];
                }
                if(!empty($data['stock_update']) && $data['stock_update'] != $GLOBALS['null_value']) {
                    $stock_update = $data['stock_update'];
                }
                if(!empty($data['received_slip_id']) && $data['received_slip_id'] != $GLOBALS['null_value']) {
                    $received_slip_id = $data['received_slip_id'];
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    // $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_names = $data['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    // $unit_names = array_reverse($unit_names);
                }
                if(!empty($data['rate_per_unit']) && $data['rate_per_unit'] != $GLOBALS['null_value']) {
                    $rate_per_unit = $data['rate_per_unit'];
                    $rate_per_unit = explode(",", $rate_per_unit);
                    // $rate_per_unit = array_reverse($rate_per_unit);
                }
                if(!empty($data['drafted']) && $data['drafted'] != $GLOBALS['null_value']) {
                    $drafted = $data['drafted'];
                }
                if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                    $cancelled = $data['cancelled'];
                } 
                if(!empty($data['deleted']) && $data['deleted'] != $GLOBALS['null_value']) {
                    $deleted = $data['deleted'];
                }  
                if(!empty($data['location_type']) && $data['location_type'] != $GLOBALS['null_value']) {
                    $location_type = $data['location_type'];
                }
                if(!empty($data['location_id']) && $data['location_id'] != $GLOBALS['null_value']) {
                    $location_id = $data['location_id'];
                    $location_ids = explode(",", $location_id);
                    // $location_ids = array_reverse($location_ids);
                }
                if(!empty($data['location_name']) && $data['location_name'] != $GLOBALS['null_value']) {
                    $location_name = $data['location_name'];
                    $location_names = explode(",", $location_name);
                    // $location_names = array_reverse($location_names);
                } 
                if(!empty($data['product_group']) && $data['product_group'] != $GLOBALS['null_value']) {
                    $product_group = $data['product_group'];
                    $product_groups = explode(",", $product_group);
                    // $product_groups = array_reverse($product_groups);
                }           
            }
        }
    
        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = html_entity_decode($obj->encode_decode('decrypt', $company_name));
        }

        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        
        $file_name="Purchase Entry";

        include("rpt_header.php");
        if($cancelled == '0'){
            include("rpt_watermark.php");
        }

        $pdf->SetY($header_end);
        $bill_to_y = $pdf->GetY();

        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(10);
        $pdf->Cell(95,4,'Supplier : ',0,1,'L',0);
        $pdf->Cell(0,1,'',0,1,'L',0);
        if(!empty($supplier_details)){
            for($i=0;$i<count($supplier_details);$i++) {
                if($supplier_details[$i]!="NULL" && $supplier_details[$i]!="") {
                    $pdf->SetFont('Arial','',8);
                    $pdf->SetX(15);
                    if($i==0) {
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(95,4,html_entity_decode($supplier_details[$i]),0,1,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    } else {
                        $pdf->MultiCell(95,4,html_entity_decode($supplier_details[$i]),0,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    }
                }
            }
        }
        
        
        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                $pdf->SetAlpha(1);
            }
        }

        $y2 = $pdf->GetY();

        $pdf->SetFont('Arial','B',8);
        $pdf->SetY($bill_to_y);
        $pdf->Cell(0,1,'',0,1,'R',0);
        $pdf->SetX(115);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(33,5,'Purchase Entry No',0,0,'',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(16,5,': '.$purchase_entry_number,0,1,'L',0);
        $pdf->SetX(115);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(31,5,'Purchase Entry Date',0,0,'',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(20,5,' : '.$purchase_entry_date,0,1,'R',0);
        $pdf->SetX(115);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(25,5,'Vehicle Details   :',0,0,'',0);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(50,5,'  '.$vehicle,0,'L',0);
        
        $pdf->SetY($bill_to_y);
        $pdf->cell(100,$y2-$bill_to_y,'',1,0,'L',0);
        $pdf->cell(90,$y2-$bill_to_y,'',1,1,'L',0);

        if($tax_type == 1) {
            $pdf->SetFont('Arial','B',8);   
            $y=$pdf->GetY();
            $pdf->SetX(10);
            $pdf->SetFillColor(52,58,64);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFont('Arial','B',6.5);  
            $pdf->Cell(7,10,'S.No',1,0,'L',1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(35,10,'Product',1,0,'C',1);
            $pdf->Cell(15,10,'Quantity',1,0,'C',1);
            $case_y = $pdf->GetY();
            $pdf->Cell(22,5,'Case',1,1,'C',1);
            $pdf->SetX(67);
            $pdf->Cell(22,5,'Contains',1,0,'C',1);
            $pdf->SetY($case_y);
            $pdf->SetX(89);
            $pdf->Cell(17,10,'Total Qty',1,0,'C',1);
            $pdf->Cell(18,10,'Rate (Rs.)',1,0,'C',1);
            $pdf->Cell(18,10,'Per',1,0,'C',1);
            $pdf->SetFont('Arial','B',6.5);  
            $pdf->Cell(17,10,'Tax',1,0,'C',1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(18,10,'Per Rate (Rs.)',1,0,'C',1);
            $pdf->Cell(23,10,'Amount (Rs.)',1,1,'C',1);
            $pdf->SetFont('Arial','',8);
            $pdf->SetTextColor(0,0,0);
        } else {
            $pdf->SetFont('Arial','B',8);   
            $y=$pdf->GetY();
            $pdf->SetX(10);
            $pdf->SetFillColor(52,58,64);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFont('Arial','B',6.5);  
            $pdf->Cell(8,10,'S.No',1,0,'L',1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(35,10,'Product',1,0,'C',1);
            $pdf->Cell(15,10,'Quantity',1,0,'C',1);
            $case_y = $pdf->GetY();
            $pdf->Cell(22,5,'Case',1,1,'C',1);
            $pdf->SetX(68);
            $pdf->Cell(22,5,'Contains',1,0,'C',1);
            $pdf->SetY($case_y);
            $pdf->SetX(90);
            $pdf->Cell(17,10,'Total Qty',1,0,'C',1);
            $pdf->Cell(18,10,'Rate (Rs.)',1,0,'C',1);
            $pdf->Cell(25,10,'Per',1,0,'C',1);
            $pdf->Cell(25,10,'Per Rate (Rs.)',1,0,'C',1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(25,10,'Amount (Rs.)',1,1,'C',1);
            $pdf->SetFont('Arial','',8);
            $pdf->SetTextColor(0,0,0);
        }

        $y_axis=$pdf->GetY();
        $s_no = 1; $footer_height = 0; $height = 0;

        if(!empty($extra_charges_values)){
            $height -= 5;
            $footer_height += 5;
        }
        if($gst_option == 1){
            if($company_state == $supplier_state){
                $height -= 15;
                $footer_height += 15;
            } else{
                $height -= 10;
                $footer_height += 10;
            }
        }
        if(!empty($round_off)){
            $height -= 5;
            $footer_height += 5;
        }
        $footer_height += 35; //include all rows
    
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        
        $total_product_amount = 0; $total_quantity = 0; $total_unit = 0; $total_subunit = 0;
        if(!empty($view_purchase_entry_id) && !empty($product_ids)) { 
            for($l = 0; $l < count($product_ids); $l++) {
                if($pdf->GetY() >= 260){
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    if($tax_type == 1) {
                        $pdf->Cell(7,277-$y_axis,'',1,0,'L',0);
                        $pdf->Cell(35,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(15,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(22,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(17,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(17,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(23,277-$y_axis,'',1,1,'C',0);
                    } else {
                        $pdf->Cell(8,277-$y_axis,'',1,0,'L',0);
                        $pdf->Cell(35,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(15,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(22,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(17,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(25,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(25,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(25,277-$y_axis,'',1,1,'C',0);
                    }

                    $pdf->SetFont('Arial','B',8);
                    $next_page = $pdf->PageNo() +1;
                    $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;
                    
                    $file_name="Purchase Entry";

                    include("rpt_header.php");
                    if($cancelled == '0'){
                        include("rpt_watermark.php");
                    }
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();

                    $pdf->Cell(0,1,'',0,1,'L',0);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetX(10);
                    $pdf->Cell(95,4,'Supplier : ',0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                    for($i=0;$i<count($supplier_details);$i++) {
                        if($supplier_details[$i]!="NULL" && $supplier_details[$i]!="") {
                            $pdf->SetFont('Arial','',8);
                            $pdf->SetX(15);
                            if($i==0) {
                                $pdf->SetFont('Arial','B',8);
                                $pdf->Cell(95,4,$supplier_details[$i],0,1,'L',0);
                                $pdf->Cell(0,1,'',0,1,'L',0);
                            } else {
                                $pdf->MultiCell(95,4,$supplier_details[$i],0,'L',0);
                                $pdf->Cell(0,1,'',0,1,'L',0);
                            }
                        }
                    }

                    if($cancelled == '1') {
                        if(file_exists('../include/images/cancelled.jpg')) {
                            $pdf->SetAlpha(0.3);
                            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                            $pdf->SetAlpha(1);
                        }
                    }

                    $y2 = $pdf->GetY();
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetY($bill_to_y);
                    $pdf->Cell(0,1,'',0,1,'R',0);
                    $pdf->SetX(115);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(33,5,'Purchase Entry No',0,0,'',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(16,5,': '.$purchase_entry_number,0,1,'L',0);
                    $pdf->SetX(115);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(31,5,'Purchase Entry Date',0,0,'',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(20,5,' : '.$purchase_entry_date,0,1,'R',0);
                    $pdf->SetX(115);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(25,5,'Vehicle Details   :',0,0,'',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->MultiCell(50,5,'  '.$vehicle,0,'L',0);
                    
                    $pdf->SetY($bill_to_y);
                    $pdf->cell(100,$y2-$bill_to_y,'',1,0,'L',0);
                    $pdf->cell(90,$y2-$bill_to_y,'',1,1,'L',0);

                    if($tax_type == 1) {
                        $pdf->SetFont('Arial','B',8);   
                        $y=$pdf->GetY();
                        $pdf->SetX(10);
                        $pdf->SetFillColor(52,58,64);
                        $pdf->SetTextColor(255,255,255);
                        $pdf->SetFont('Arial','B',6.5);  
                        $pdf->Cell(7,10,'S.No',1,0,'L',1);
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(35,10,'Product',1,0,'C',1);
                        $pdf->Cell(15,10,'Quantity',1,0,'C',1);
                        $case_y = $pdf->GetY();
                        $pdf->Cell(22,5,'Case',1,1,'C',1);
                        $pdf->SetX(67);
                        $pdf->Cell(22,5,'Contains',1,0,'C',1);
                        $pdf->SetY($case_y);
                        $pdf->SetX(89);
                        $pdf->Cell(17,10,'Total Qty',1,0,'C',1);
                        $pdf->Cell(18,10,'Rate (Rs.)',1,0,'C',1);
                        $pdf->Cell(18,10,'Per',1,0,'C',1);
                        $pdf->SetFont('Arial','B',6.5);  
                        $pdf->Cell(17,10,'Tax',1,0,'C',1);
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(18,10,'Per Rate (Rs.)',1,0,'C',1);
                        $pdf->Cell(23,10,'Amount (Rs.)',1,1,'C',1);
                        $pdf->SetFont('Arial','',8);
                        $pdf->SetTextColor(0,0,0);
                    } else {
                        $pdf->SetFont('Arial','B',8);   
                        $y=$pdf->GetY();
                        $pdf->SetX(10);
                        $pdf->SetFillColor(52,58,64);
                        $pdf->SetTextColor(255,255,255);
                        $pdf->SetFont('Arial','B',6.5);  
                        $pdf->Cell(8,10,'S.No',1,0,'L',1);
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(35,10,'Product',1,0,'C',1);
                        $pdf->Cell(15,10,'Quantity',1,0,'C',1);
                        $case_y = $pdf->GetY();
                        $pdf->Cell(22,5,'Case',1,1,'C',1);
                        $pdf->SetX(68);
                        $pdf->Cell(22,5,'Contains',1,0,'C',1);
                        $pdf->SetY($case_y);
                        $pdf->SetX(90);
                        $pdf->Cell(17,10,'Total Qty',1,0,'C',1);
                        $pdf->Cell(18,10,'Rate (Rs.)',1,0,'C',1);
                        $pdf->Cell(25,10,'Per',1,0,'C',1);
                        $pdf->Cell(25,10,'Per Rate (Rs.)',1,0,'C',1);
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(25,10,'Amount (Rs.)',1,1,'C',1);
                        $pdf->SetFont('Arial','',8);
                        $pdf->SetTextColor(0,0,0);
                    }
                    $y_axis=$pdf->GetY();
                }

                $product_row_index = $l + 1;
                $product_names[$l] = $obj->encode_decode('decrypt', $product_names[$l]);
                $unit_names[$l] = $obj->encode_decode('decrypt', $unit_names[$l]);
                $product_unit_name = "";
                $product_unit_name = $unit_names[$l];                
                $product_subunit_name = "";
                $product_subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$l], 'subunit_name');
                if(!empty($product_subunit_name) && $product_subunit_name != $GLOBALS['null_value']) {
                    $product_subunit_name = $obj->encode_decode("decrypt", $product_subunit_name);
                }
                
                if($per_type[$l] == '2') {
                    if(!empty($product_subunit_name)) {
                        $per_name = $product_subunit_name;
                    } else {
                        $per_name = $product_unit_name;
                    }
                } else if($per_type[$l] == '1') {
                    $per_name = $product_unit_name;
                }

                if($unit_type[$l] == 1) {
                    $total_unit += $quantity[$l];
                } else if($unit_type[$l] == 2) {
                    $total_subunit += $quantity[$l];
                }
                    
                $total_product_amount += $product_amount[$l];
                $per_y = $pdf->GetY(); 

                $max_y1 = ""; $max_y2 = ""; $max_y3 = ""; $max_y4 = ""; $max_y5 = ""; $max_y6 = ""; $max_y7 = ""; $max_y8 = ""; $max_y9 = ""; $max_y10 = "";
                if($tax_type == 1) {
                    $pdf->SetY($per_y);
                    $pdf->SetX(10);
                    $pdf->MultiCell(7,6,$s_no,0,'L',0);
                    $max_y1 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(17);
                    $pdf->MultiCell(35,6,html_entity_decode(($product_names[$l]),ENT_QUOTES),0,'L',0);
                    $max_y3 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(52);
                    $pdf->MultiCell(15,6,$quantity[$l] . " ".html_entity_decode(($unit_names[$l]),ENT_QUOTES)."",0,'C',0);
                    $max_y4 = $pdf->GetY();
                    if(!empty($content[$l])) {
                        $pdf->SetY($per_y);
                        $pdf->SetX(67);
                        $pdf->MultiCell(22,6,$content[$l] . " ".html_entity_decode(($product_subunit_name),ENT_QUOTES)."",0,'C',0);
                        $max_y5 = $pdf->GetY();
                        $pdf->SetY($per_y);
                        $pdf->SetX(89);
                        $pdf->MultiCell(17,6,$total_qty[$l] . " ".html_entity_decode(($product_subunit_name),ENT_QUOTES)."",0,'C',0);
                    } else {
                        $pdf->SetY($per_y);
                        $pdf->SetX(67);
                        $pdf->MultiCell(22,6, " - ",0,'C',0);
                        $max_y5 = $pdf->GetY();
                        $pdf->SetY($per_y);
                        $pdf->SetX(89);
                        $pdf->MultiCell(17,6,$total_qty[$l],0,'C',0);
                    }

                    $max_y6 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(106);
                    $pdf->MultiCell(18,6,$obj->numberFormat($rate[$l],2),0,'R',0);
                    $max_y7 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(124);
                    $pdf->MultiCell(18,6,$per[$l] . html_entity_decode(($per_name),ENT_QUOTES)."",0,'R',0);
                    $max_y8 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(142);
                    $pdf->MultiCell(17,6,html_entity_decode(($product_tax[$l]),ENT_QUOTES),0,'C',0);
                    $max_y2 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(159);
                    $pdf->MultiCell(18,6,$obj->numberFormat($final_rate[$l],2),0,'R',0);
                    $max_y9 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(177);
                    $pdf->MultiCell(23,6,$obj->numberFormat($product_amount[$l],2),0,'R',0);
                    $max_y10 = $pdf->GetY();
                } else {
                    $pdf->SetY($per_y);
                    $pdf->SetX(10);
                    $pdf->MultiCell(8,6,$s_no,0,'L',0);
                    $max_y1 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(18);
                    $pdf->MultiCell(35,6,html_entity_decode(($product_names[$l]),ENT_QUOTES),0,'L',0);
                    $max_y3 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(53);
                    $pdf->MultiCell(15,6,$quantity[$l] . " ".html_entity_decode(($unit_names[$l]),ENT_QUOTES)."",0,'C',0);
                    $max_y4 = $pdf->GetY();
                    if(!empty($content[$l])) {
                        $pdf->SetY($per_y);
                        $pdf->SetX(68);
                        $pdf->MultiCell(22,6,$content[$l] . " ".html_entity_decode(($product_subunit_name),ENT_QUOTES)."",0,'C',0);
                        $max_y5 = $pdf->GetY();
                        $pdf->SetY($per_y);
                        $pdf->SetX(90);
                        $pdf->MultiCell(17,6,$total_qty[$l] . " ".html_entity_decode(($product_subunit_name),ENT_QUOTES)."",0,'C',0);
                    } else {
                        $pdf->SetY($per_y);
                        $pdf->SetX(68);
                        $pdf->MultiCell(22,6, " - ",0,'C',0);
                        $max_y5 = $pdf->GetY();
                        $pdf->SetY($per_y);
                        $pdf->SetX(90);
                        $pdf->MultiCell(17,6,$total_qty[$l],0,'C',0);
                    }
                    
                    $max_y6 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(107);
                    $pdf->MultiCell(18,6,$obj->numberFormat($rate[$l],2),0,'R',0);
                    $max_y7 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(125);
                    $pdf->MultiCell(25,6,$per[$l] . html_entity_decode(($per_name),ENT_QUOTES)."",0,'R',0);
                    $max_y8 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $max_y2 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(150);
                    $pdf->MultiCell(25,6,$obj->numberFormat($final_rate[$l],2),0,'R',0);
                    $max_y9 = $pdf->GetY();
                    $pdf->SetY($per_y);
                    $pdf->SetX(175);
                    $pdf->MultiCell(25,6,$obj->numberFormat($product_amount[$l],2),0,'R',0);
                    $max_y10 = $pdf->GetY();
                }
                
                $s_no++;
                $total_quantity += $quantity[$l]; 

                $max_y = max(array($max_y1,$max_y2,$max_y3,$max_y4,$max_y5,$max_y6,$max_y7,$max_y8,$max_y9,$max_y10));

                $pdf->SetY($max_y);
                $middle_y = $pdf->GetY();
            }
            
            $end_y = $pdf->GetY();
            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                if($tax_type == 1) {
                    $pdf->Cell(7,270-$y_axis,'',1,0,'L',0);
                    $pdf->Cell(35,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(15,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(22,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(23,270-$y_axis,'',1,1,'C',0);
                } else {
                    $pdf->Cell(8,270-$y_axis,'',1,0,'L',0);
                    $pdf->Cell(35,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(15,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(22,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,270-$y_axis,'',1,1,'C',0);
                }

                $pdf->SetFont('Arial','B',8);
                $next_page = $pdf->PageNo()+1;
        
                $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                $pdf->AddPage();
                
                $file_name="Purchase Entry";

                include("rpt_header.php");
                if($cancelled == '0'){
                    include("rpt_watermark.php");
                }
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->Cell(0,1,'',0,1,'L',0);
                $pdf->SetFont('Arial','B',10);
                $pdf->SetX(10);
                $pdf->Cell(95,4,'Supplier : ',0,1,'L',0);
                $pdf->Cell(0,1,'',0,1,'L',0);
                for($i=0;$i<count($supplier_details);$i++) {
                    if($supplier_details[$i]!="NULL" && $supplier_details[$i]!="") {
                        $pdf->SetFont('Arial','',8);
                        $pdf->SetX(15);
                        if($i==0) {
                            $pdf->SetFont('Arial','B',8);
                            $pdf->Cell(95,4,$supplier_details[$i],0,1,'L',0);
                            $pdf->Cell(0,1,'',0,1,'L',0);
                        } else {
                            $pdf->MultiCell(95,4,$supplier_details[$i],0,'L',0);
                            $pdf->Cell(0,1,'',0,1,'L',0);
                        }
                    }
                }
                
                if($cancelled == '1') {
                    if(file_exists('../include/images/cancelled.jpg')) {
                        $pdf->SetAlpha(0.3);
                        $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                        $pdf->SetAlpha(1);
                    }
                }
                $y2 = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->Cell(0,1,'',0,1,'R',0);
                $pdf->SetX(115);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(33,5,'Purchase Entry No',0,0,'',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(16,5,': '.$purchase_entry_number,0,1,'L',0);
                $pdf->SetX(115);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(31,5,'Purchase Entry Date',0,0,'',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,' : '.$purchase_entry_date,0,1,'R',0);
                $pdf->SetX(115);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(25,5,'Vehicle Details   :',0,0,'',0);
                $pdf->SetFont('Arial','',8);
                $pdf->MultiCell(50,5,'  '.$vehicle,0,'L',0);
                
                $pdf->SetY($bill_to_y);
                $pdf->cell(100,$y2-$bill_to_y,'',1,0,'L',0);
                $pdf->cell(90,$y2-$bill_to_y,'',1,1,'L',0);

                if($tax_type == 1) {
                    $pdf->SetFont('Arial','B',8);   
                    $y=$pdf->GetY();
                    $pdf->SetX(10);
                    $pdf->SetFillColor(52,58,64);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial','B',6.5);  
                    $pdf->Cell(7,10,'S.No',1,0,'L',1);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(35,10,'Product',1,0,'C',1);
                    $pdf->Cell(15,10,'Quantity',1,0,'C',1);
                    $case_y = $pdf->GetY();
                    $pdf->Cell(22,5,'Case',1,1,'C',1);
                    $pdf->SetX(67);
                    $pdf->Cell(22,5,'Contains',1,0,'C',1);
                    $pdf->SetY($case_y);
                    $pdf->SetX(89);
                    $pdf->Cell(17,10,'Total Qty',1,0,'C',1);
                    $pdf->Cell(18,10,'Rate (Rs.)',1,0,'C',1);
                    $pdf->Cell(18,10,'Per',1,0,'C',1);
                    $pdf->SetFont('Arial','B',6.5);  
                    $pdf->Cell(17,10,'Tax',1,0,'C',1);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(18,10,'Per Rate (Rs.)',1,0,'C',1);
                    $pdf->Cell(23,10,'Amount (Rs.)',1,1,'C',1);
                    $pdf->SetFont('Arial','',8);
                    $pdf->SetTextColor(0,0,0);
                } else {
                    $pdf->SetFont('Arial','B',8);   
                    $y=$pdf->GetY();
                    $pdf->SetX(10);
                    $pdf->SetFillColor(52,58,64);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial','B',6.5);  
                    $pdf->Cell(8,10,'S.No',1,0,'L',1);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(35,10,'Product',1,0,'C',1);
                    $pdf->Cell(15,10,'Quantity',1,0,'C',1);
                    $case_y = $pdf->GetY();
                    $pdf->Cell(22,5,'Case',1,1,'C',1);
                    $pdf->SetX(68);
                    $pdf->Cell(22,5,'Contains',1,0,'C',1);
                    $pdf->SetY($case_y);
                    $pdf->SetX(90);
                    $pdf->Cell(17,10,'Total Qty',1,0,'C',1);
                    $pdf->Cell(18,10,'Rate (Rs.)',1,0,'C',1);
                    $pdf->Cell(25,10,'Per',1,0,'C',1);
                    $pdf->Cell(25,10,'Per Rate (Rs.)',1,0,'C',1);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(25,10,'Amount (Rs.)',1,1,'C',1);
                    $pdf->SetFont('Arial','',8);
                    $pdf->SetTextColor(0,0,0);
                }

                $y_axis=$pdf->GetY();
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
        
                if($tax_type == 1) {
                    $pdf->Cell(7,$content_height-$y_axis,'',1,0,'L',0);
                    $pdf->Cell(35,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(15,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(22,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(23,$content_height-$y_axis,'',1,1,'C',0);
                } else {
                    $pdf->Cell(8,$content_height-$y_axis,'',1,0,'L',0);
                    $pdf->Cell(35,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(15,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(22,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,$content_height-$y_axis,'',1,1,'C',0);
                }
                $pdf->SetY($content_height);
            } else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                if($tax_type == 1) {
                    $pdf->Cell(7,$content_height-$y_axis,'',1,0,'L',0);
                    $pdf->Cell(35,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(15,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(22,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(23,$content_height-$y_axis,'',1,1,'C',0);
                } else {
                    $pdf->Cell(8,$content_height-$y_axis,'',1,0,'L',0);
                    $pdf->Cell(35,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(15,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(22,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(17,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,$content_height-$y_axis,'',1,1,'C',0);
                }
            }
           
            $unit_arrays = [];
            $unit_quantity = [];
            $sub_unit_arrays = [];
            $sub_unit_quantity = [];
            for($i = 0; $i < count($product_ids); $i++) {
                $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_ids[$i], '');

                foreach($product_list as $product) {
                    if(!empty($product['unit_id'])) {
                        if($product['unit_id'] == $unit_ids[$i] && $product['unit_id'] != "NULL") {
                            $unit_arrays[] = $unit_ids[$i];
                            $unit_quantity[] = $quantity[$i];
                        } else if($product['subunit_id'] == $unit_ids[$i] && $product['subunit_id'] != "NULL") {
                            $sub_unit_arrays[] = $unit_ids[$i];
                            $sub_unit_quantity[] = $quantity[$i];
                        }
                    }
                }
            }

            $total_display = "";
            $unique_unit_arrays = [];
            $unique_unit_arrays = array_unique($unit_arrays);

            if(!empty($unique_unit_arrays) && count($unique_unit_arrays) == 1) {
                if(array_sum($unit_quantity) != 0) {
                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unique_unit_arrays[0], 'unit_name');
                    if(!empty($unit_name)) {
                        $unit_name = $obj->encode_decode('decrypt', $unit_name);
                    }

                    $total_display .= array_sum($unit_quantity) . ' ' . $unit_name;
                }
            } else {
                if(array_sum($unit_quantity) != 0) {
                    $total_display .= array_sum($unit_quantity);
                }
            }

            $unique_sub_unit_arrays = [];
            $unique_sub_unit_arrays = array_unique($sub_unit_arrays);

            if(!empty($unique_sub_unit_arrays) && count($unique_sub_unit_arrays) == 1) {
                if(array_sum($sub_unit_quantity) != 0) {
                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unique_sub_unit_arrays[0], 'unit_name');
                    if(!empty($unit_name)) {
                        $unit_name = $obj->encode_decode('decrypt', $unit_name);
                    }
                    if(!empty($total_display)) {
                        $total_display .= ' + ' . array_sum($sub_unit_quantity) . ' ' . $unit_name;
                    } else {
                        $total_display .= array_sum($sub_unit_quantity) . ' ' . $unit_name;
                    }
                }
            } else {
                if(array_sum($sub_unit_quantity) != 0) {
                    $total_display .= array_sum($sub_unit_quantity);
                }
            }

            $get_final_Y = $pdf->GetY();
            if($tax_type == 1) {
                if(!empty($total_quantity)) {
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetY($get_final_Y);
                    $pdf->SetX(10);
                    $pdf->Cell(42,5,'Total Quantity',0,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    if(!empty($total_display)) {
                        $pdf->MultiCell(35,5,$total_display,0,'C',0);
                    } else {
                        $pdf->MultiCell(35,5,"-",0,'C',0);
                    }
                    
                    $get_total_y = $pdf->GetY();
                    $pdf->SetX(10);
                    $pdf->Cell(42,$get_final_Y - $get_total_y,'',1,0,'C',0);
                    $pdf->Cell(37,$get_final_Y - $get_total_y,'',1,0,'C',0);
                }

                if(!empty($sub_total)) {
                    $sub_total_val = $obj->numberFormat($sub_total,2);
                    $pdf->SetY($get_final_Y);
                    $pdf->SetX(89);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(88,5,'Sub Total',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(23,5,$sub_total_val,1,1,'R',0);
                }
    
                if(!empty($other_charges_id)) {
                    for($i=0; $i < count($other_charges_id); $i++) {
                        $other_charges_id[$i] = trim($other_charges_id[$i]);
                        $other_charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id[$i], 'charges_name');
                        $other_charges_name = $obj->encode_decode("decrypt", $other_charges_name);

                        $other_charges_values[$i] = trim($other_charges_values[$i]);
                        if(isset($other_charges_values[$i])) {
                            $other_charges_error = "";
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_charges_value = str_replace('%', '', $other_charges_values[$i]);
                                $other_charges_value = trim($other_charges_value);
                            } else {
                                $other_charges_value = $other_charges_values[$i];
                                $other_percentage = "Rs. ". $other_charges_values[$i];
                            }
                        
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_percentage = $other_charges_values[$i];
                                $other_charges_value = ($other_charges_value * $sub_total) / 100;
                                $other_charges_value = number_format($other_charges_value, 2);
                                $other_charges_value = str_replace(",", "", $other_charges_value);
                            }
                        }

                        if($charges_types[$i] == "minus") {
                            $other_charges_total[$i] -= $other_charges_value;
                        } else if($charges_types[$i] == "plus") {
                            $other_charges_total[$i] += $other_charges_value;
                        }
                    
                        $pdf->SetX(67);
                        $pdf->SetFont('Arial','B',8);
                        if(!empty($other_percentage)) {
                            $pdf->Cell(110,5,$other_charges_name. " (" . $other_percentage.") ",1,0,'R',0);
                        } else {
                            $pdf->Cell(110,5,$other_charges_name,1,0,'R',0);
                        }
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(23,5,$other_charges_value,1,1,'R',0);
                    }
                }

                if($gst_option == 1 && $company_state == $supplier_state) {
                    if(!empty($cgst_value)){
                        $cgst_value = $obj->numberFormat($cgst_value,2);
                        $pdf->SetX(67);
                        $pdf->SetFont('Arial','B',8);
                        if($tax_type == 2) {
                            $pdf->Cell(110,5,'CGST ('. !empty($overall_tax) ? ((str_replace("%", "", $overall_tax)) / 2) : '' .')',1,0,'R',0);
                        } else {
                            $pdf->Cell(110,5,'CGST',1,0,'R',0);
                        }
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(23,5,$cgst_value,1,1,'R',0);
                    }
                    if(!empty($sgst_value)){  
                        $sgst_value = $obj->numberFormat($sgst_value,2);
                        $pdf->SetX(67);
                        $pdf->SetFont('Arial','B',8);
                        if($tax_type == 2) {
                            $pdf->Cell(110,5,'SGST ('. !empty($overall_tax) ? ((str_replace("%", "", $overall_tax)) / 2) : '' .'%)',1,0,'R',0);
                        } else {
                            $pdf->Cell(110,5,'SGST',1,0,'R',0);
                        }
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(23,5,$sgst_value,1,1,'R',0);
                    }
                }

                if($gst_option == 1 && $company_state != $supplier_state) {
                    if(!empty($igst_value)){  
                        $igst_value = $obj->numberFormat($igst_value,2);
    
                        $pdf->SetX(67);
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(110,5,'IGST ('. !empty($overall_tax) ?  : '' .')',1,0,'R',0);
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(23,5,$igst_value,1,1,'R',0);
                    }
                }

                if(!empty($total_tax_value)){  
                    $total_tax_value = $obj->numberFormat($total_tax_value,2);
    
                    $pdf->SetX(67);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(110,5,'Total Tax',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(23,5,$total_tax_value,1,1,'R',0);
                }       

                if(!empty($round_off)){  
                    $pdf->SetX(67);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(110,5,'Round Off',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(23,5,$round_off,1,1,'R',0);
                }

                if(!empty($total_amount)){
                    $total_amount = $obj->numberFormat($total_amount,2);
    
                    $pdf->SetX(67);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(110,5,'Bill Total',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(23,5,$total_amount,1,1,'R',0);
                } 
            } else {
                if(!empty($total_quantity)) {
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetY($get_final_Y);
                    $pdf->SetX(10);
                    $pdf->Cell(43,5,'Total Quantity',0,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    if(!empty($total_display)) {
                        $pdf->MultiCell(35,5,$total_display,0,'C',0);
                    } else {
                        $pdf->MultiCell(35,5,"-",0,'C',0);
                    }
                    $get_total_y = $pdf->GetY();

                    $pdf->SetX(10);
                    $pdf->Cell(43,$get_final_Y - $get_total_y,'',1,0,'C',0);
                    $pdf->Cell(37,$get_final_Y - $get_total_y,'',1,0,'C',0);
                }

                if(!empty($sub_total)) {
                    $sub_total_val = $obj->numberFormat($sub_total,2);
                    $pdf->SetY($get_final_Y);
                    $pdf->SetX(90);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(85,5,'Sub Total',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(25,5,$sub_total_val,1,1,'R',0);
                }
    
                if(!empty($other_charges_id)) {
                    for($i=0; $i < count($other_charges_id); $i++) {
                        $other_charges_id[$i] = trim($other_charges_id[$i]);
                        $other_charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id[$i], 'charges_name');
                        $other_charges_name = $obj->encode_decode("decrypt", $other_charges_name);
                
                        $other_charges_values[$i] = trim($other_charges_values[$i]);
                        if(isset($other_charges_values[$i])) {
                            $other_charges_error = "";
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_charges_value = str_replace('%', '', $other_charges_values[$i]);
                                $other_charges_value = trim($other_charges_value);
                            } else {
                                $other_percentage = "Rs. ". $other_charges_values[$i];

                                $other_charges_value = $other_charges_values[$i];
                            }
                        
                            if(strpos($other_charges_values[$i], '%') !== false) {
                                $other_percentage = $other_charges_values[$i];
                                $other_charges_value = ($other_charges_value * $sub_total) / 100;
                                $other_charges_value = number_format($other_charges_value, 2);
                                $other_charges_value = str_replace(",", "", $other_charges_value);
                            }
                        }

                        if($charges_types[$i] == "minus") {
                            $other_charges_total[$i] -= $other_charges_value;
                        } else if($charges_types[$i] == "plus") {
                            $other_charges_total[$i] += $other_charges_value;
                        }
                    
                                               $pdf->SetX(90);
                        $pdf->SetFont('Arial','B',8);
                        if(!empty($other_percentage)) {
                            $pdf->Cell(85,5,$other_charges_name. " (" . $other_percentage.") ",1,0,'R',0);
                        } else {
                            $pdf->Cell(85,5,$other_charges_name,1,0,'R',0);
                        }
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(25,5,$other_charges_value,1,1,'R',0);
                    }
                }

                if($gst_option == 1 && $company_state == $supplier_state) {
                    if(!empty($cgst_value)){  
                        $cgst_value = $obj->numberFormat($cgst_value,2);
                        $pdf->SetX(90);
                        $pdf->SetFont('Arial','B',8);
                        if($tax_type == 2) {
                            if(!empty($overall_tax)) {
                                $tax_per = str_replace("%", "", $overall_tax);
                                $pdf->Cell(85,5,'CGST (' . $tax_per / 2 . '%)',1,0,'R',0);
                            } else {
                                $pdf->Cell(85,5,'CGST',1,0,'R',0);
                            }
                        } else {
                            $pdf->Cell(85,5,'CGST',1,0,'R',0);
                        }
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(25,5,$cgst_value,1,1,'R',0);
                    }
                    if(!empty($sgst_value)){  
                        $sgst_value = $obj->numberFormat($sgst_value,2);
                        $pdf->SetX(90);
                        $pdf->SetFont('Arial','B',8);
                        if($tax_type == 2) {
                            if(!empty($overall_tax)) {
                                $tax_per = str_replace("%", "", $overall_tax);
                                $pdf->Cell(85,5,'SGST (' . $tax_per / 2 . '%)',1,0,'R',0);
                            } else {
                                $pdf->Cell(85,5,'SGST',1,0,'R',0);
                            }
                        } else {
                            $pdf->Cell(85,5,'SGST',1,0,'R',0);
                        }
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(25,5,$sgst_value,1,1,'R',0);
                    }
                }
                if($gst_option == 1 && $company_state != $supplier_state) {
                    if(!empty($igst_value)){  
                        $igst_value = $obj->numberFormat($igst_value,2);
                        $pdf->SetX(90);
                        $pdf->SetFont('Arial','B',8);
                        if($tax_type == 2) {
                            if(!empty($overall_tax)) {
                                $tax_per = str_replace("%", "", $overall_tax);
                                $pdf->Cell(85,5,'IGST (' . $tax_per . '%)',1,0,'R',0);
                            } else {
                                $pdf->Cell(85,5,'IGST',1,0,'R',0);
                            }
                        } else {
                            $pdf->Cell(85,5,'IGST',1,0,'R',0);
                        }
                        
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(25,5,$igst_value,1,1,'R',0);
                    }
                }

                if(!empty($total_tax_value)){  
                    $total_tax_value = $obj->numberFormat($total_tax_value,2);
    
                    $pdf->SetX(90);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(85,5,'Total Tax',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(25,5,$total_tax_value,1,1,'R',0);
                }

                if(!empty($round_off)){  
                    $pdf->SetX(90);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(85,5,'Round Off',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(25,5,$round_off,1,1,'R',0);
                }

                if(!empty($total_amount)){
                    $total_amount = $obj->numberFormat($total_amount,2);
    
                    $pdf->SetX(90);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(85,5,'Bill Total',1,0,'R',0);
                    $pdf->SetFont('Arial','',8);
                    $pdf->Cell(25,5,$total_amount,1,1,'R',0);
                } 
                
            }
        }
        
        $line_y = $pdf->GetY();
  
        $pdf->Line(10,$line_y,200,$line_y);
        $y1=$pdf->GetY();
        $pdf->SetFont('Arial','BU',8);
        $pdf->SetX(10);
        $pdf->Cell(90,5,'Declaration',0,0,'L',0);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(147);
        $pdf->MultiCell(50,7, 'FOR  ' . html_entity_decode($company_name,ENT_QUOTES),0,'R',0);
        $pdf->SetFont('Arial','',9);
        $pdf->SetY($line_y +7);
        $pdf->SetX(15);
        $pdf->MultiCell(90,5,'We declare that this bill shows the actual price of the goods described and that all particulars are true and correct ',0,'L',0);
        $pdf->SetY($line_y +20);
        $pdf->SetY(270);
        $pdf->SetX(153);
        $pdf->Cell(45,2,'Authorised Signatory',0,1,'C',0);
        $pdf->SetFont('Arial','',7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(190,265,'',1,0,'C');
        $yz = $pdf ->GetY();
        $pdf->SetY(275);
        $pdf->Cell(190,5,'***This is a Computer Generated bill. Hence Digital Signature is not required.***',0,1,'C',0);
    
    }
    $pdf->Output();
?>