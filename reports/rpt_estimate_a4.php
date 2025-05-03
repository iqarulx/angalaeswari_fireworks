<?php
include("../include_user_check.php");
include("../include/number2words.php");

if(isset($_REQUEST['estimate_id'])) {
    $estimate_id = $_REQUEST['estimate_id'];
    $pdf_download_name ="";
    $pdf_download_name = "Estimate Report PDF";
    $estimate_number = ""; $estimate_date = date('d-m-Y'); $customer_id = ""; $agent_id = ""; $transport_id = ""; $bank_id = ""; $magazine_type = ""; $magazine_id = ""; $gst_option = "";$address = ""; $tax_option = ""; $igst_value = ''; $cgst_value = ''; $sgst_value = ''; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $indv_magazine_ids = array(); $product_names = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array();
    $unit_names = array(); $quantity = array(); $rate = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array();$charges_type = array(); $other_charges_value = array(); $agent_commission = ""; $bill_total = "";$charges_count = 0;
    $end_content = 220; $transport_name = "";
    if(!empty($estimate_id)) {
        $estimate_list = $obj->getTableRecords($GLOBALS['estimate_table'], 'estimate_id', $estimate_id, '');
        if(!empty($estimate_list)) {
            foreach($estimate_list as $pi) {
                if(!empty($pi['estimate_number'])) {
                    $estimate_number = $pi['estimate_number'];
                }
                if(!empty($pi['customer_id'])) {
                    $customer_id = $pi['customer_id'];
                }
                if(!empty($pi['customer_details'])) {
                    $customer_details = $obj->encode_decode('decrypt', $pi['customer_details']);
                    $customer_details = explode("$$$", $customer_details);
                }
                if(!empty($pi['estimate_date'])) {
                    $estimate_date = date('d-m-Y', strtotime($estimate_date));
                }
                if(!empty($pi['agent_id'])) {
                    $agent_id = $pi['agent_id'];
                }
                if(!empty($pi['transport_id'])) {
                    $transport_id = $pi['transport_id'];
                    $transport_name = $obj->encode_decode('decrypt', $obj->getTableColumnValue($GLOBALS['transport_table'], 'transport_id', $transport_id, 'transport_name'));
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
                if(!empty($pi['cgst_value'])) {
                    $cgst_value = $pi['cgst_value'];
                }
                if(!empty($pi['sgst_value'])) {
                    $sgst_value = $pi['sgst_value'];
                }
                if(!empty($pi['igst_value'])) {
                    $igst_value = $pi['igst_value'];
                }
                if(!empty($pi['total_tax_value'])) {
                    $total_tax_value = $pi['total_tax_value'];
                }
                if(!empty($pi['round_off'])) {
                    $round_off = $pi['round_off'];
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
                
                if(!empty($pi['other_charges_id']) && $pi['other_charges_id'] != $GLOBALS['null_value']) {
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
                if(!empty($pi['bill_total'])) {
                    $bill_total = $pi['bill_total'];
                }
            }
        }
    }
    $less_for_tax = 0;
    if(!empty($other_charges_id) && count($other_charges_id) > 1) {
        for($i=1; $i < count($other_charges_id); $i++) {
            $end_content = $end_content - 10;
        }
    }

    if($gst_option == 1 ) {
        $end_content = $end_content - 10;
        if($company_state == $party_state) {
            $end_content = $end_content -5;
        }
    }

    if($gst_option == '1' && $tax_type == '1') {
        $less_for_tax = 3;
    }


    // require_once('../fpdf/fpdf.php');
    // $pdf = new FPDF('P','mm','A4');
    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();
    $file_name="Estimate";
    include("rpt_header.php");
    if(!empty($company_logo)) {
        $pdf->SetAlpha(0.2);
        if(!empty($company_logo)){
            if(file_exists('../include/images/upload/'.$company_logo)){
                $pdf->Image('../include/images/upload/'.$company_logo,55,100,85,85);
            }
        }
        
        $pdf->SetAlpha(1);
    }   
    

    $pdf->SetY($header_end);
    $pdf->Cell(20,10,'To :',0,1,'C',0);
    if (!empty($customer_details)) {
        for ($i = 0; $i < count($customer_details); $i++) {
            $customer_details[$i] = trim($customer_details[$i]);
            if (!empty($customer_details[$i]) && $customer_details[$i] != $GLOBALS['null_value']) {
                $pdf->SetX(30);
                $pdf->Cell(50,5,$customer_details[$i],0,1,'L',0);
            }
        }
    }

    $detials_y = $pdf->GetY();
    $pdf->SetY($header_end);
    $pdf->SetX(110);
    $pdf->Cell(20,10,'Bill Date',0,0,'L',0);
    $pdf->Cell(30,10,":  ".$estimate_date,0,1,'L',0);
    $pdf->SetX(110);
    $pdf->Cell(20,10,'Bill No',0,0,'L',0);
    $pdf->Cell(30,10,":  ".$estimate_number,0,1,'L',0);
    if(!empty($transport_name)) {
        $pdf->SetX(110);   
        $pdf->Cell(20,10,'Transport',0,0,'L',0);   
        $pdf->Cell(30,10,":  ".$transport_name,0,1,'L',0);
    }
    $bill_y = $pdf->GetY();

    if($detials_y > $bill_y) {
    $pdf->Line(105,$header_end,105, $detials_y);
    $pdf->SetY($detials_y);
    } else if($bill_y > $detials_y) {
        $pdf->SetY($bill_y);
    }

    $current_y = $pdf->GetY();
    $box_y = $pdf->GetY();

    $pdf->SetY($yaxis);
    $pdf->SetX(10);
    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($box_y);
    $pdf->SetX(10);
    $pdf->Cell(20,8,'S.No.',1,0,'C',0);
    $pdf->Cell(40,8,'Products',1,0,'C',0);
    $pdf->Cell(30,8,'Quantity',1,0,'C',0);
    $pdf->Cell(18,8,'contents',1,0,'C',0);
    $pdf->Cell(25-$less_for_tax,8,'Total Qty',1,0,'C',0);
    if($gst_option == '1' && $tax_type == '1') {
        $pdf->Cell(9,8,'Tax',1,0,'C',0);
    }
    $pdf->Cell(19-$less_for_tax,8,'Rate(Rs.)',1,0,'C',0);
    $pdf->Cell(18-$less_for_tax,8,'Per',1,0,'C',0);
    $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
    $pdf->SetFont('Arial','',7);
    $y_axis=$pdf->GetY();

    $index = 0;
    $total_unit = $total_subunit = $purchase_subtotal = 0; $total_cal_y = 0;
    for($i = 0; $i < count($product_ids); $i++) {
        if($pdf->GetY() >= 260){
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(8,277-$y_axis,'',1,0,'L',0);
            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(32,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(25,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
            $pdf->Cell(25,277-$y_axis,'',1,1,'C',0);

            $pdf->SetFont('Arial','B',10);
            $next_page = $pdf->PageNo() +1;
            $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $page_number += 1;
            $total_pages[] = $page_number;
            $file_name="Estimate";

            include("rpt_header.php");
            if(!empty($company_logo)) {
                $pdf->SetAlpha(0.2);
                if(!empty($company_logo)){
                    if(file_exists('../include/images/upload/'.$company_logo)){
                        $pdf->Image('../include/images/upload/'.$company_logo,55,100,85,85);
                    }
                }
                
                $pdf->SetAlpha(1);
            }   
            $pdf->SetY($header_end);

            $pdf->SetY($header_end);
            $pdf->Cell(20,10,'To :',0,1,'C',0);
            if (!empty($customer_details)) {
                for ($i = 0; $i < count($customer_details); $i++) {
                    $customer_details[$i] = trim($customer_details[$i]);
                    if (!empty($customer_details[$i]) && $customer_details[$i] != $GLOBALS['null_value']) {
                        $pdf->SetX(30);
                        $pdf->Cell(50,5,$customer_details[$i],0,1,'L',0);
                    }
                }
            }
        
            $detials_y = $pdf->GetY();
            $pdf->SetY($header_end);
            $pdf->SetX(110);
            $pdf->Cell(20,10,'Bill Date',0,0,'L',0);
            $pdf->Cell(30,10,":  ".$estimate_date,0,1,'L',0);
            $pdf->SetX(110);
            $pdf->Cell(20,10,'Bill No',0,0,'L',0);
            $pdf->Cell(30,10,":  ".$estimate_number,0,1,'L',0);
            if(!empty($transport_name)) {
                $pdf->SetX(110);   
                $pdf->Cell(20,10,'Transport',0,0,'L',0);   
                $pdf->Cell(30,10,":  ".$transport_name,0,1,'L',0);
            }
            $bill_y = $pdf->GetY();
        
            if($detials_y > $bill_y) {
            $pdf->Line(105,$header_end,105, $detials_y);
            $pdf->SetY($detials_y);
            } else if($bill_y > $detials_y) {
                $pdf->SetY($bill_y);
            }

            $pdf->SetFont('Arial','B',8);   
            $y=$pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(20,8,'S.No.',1,0,'C',0);
            $pdf->Cell(40,8,'Products',1,0,'C',0);
            $pdf->Cell(30,8,'Quantity',1,0,'C',0);
            $pdf->Cell(18,8,'contents',1,0,'C',0);
            $pdf->Cell(25-$less_for_tax,8,'Total Qty',1,0,'C',0);
            if($gst_option == '1' && $tax_type == '1') {
                $pdf->Cell(9,8,'Tax',1,0,'C',0);
            }
            $pdf->Cell(19-$less_for_tax,8,'Rate(Rs.)',1,0,'C',0);
            $pdf->Cell(18-$less_for_tax,8,'Per',1,0,'C',0);
            $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
            $pdf->SetFont('Arial','',8);

            $y_axis=$pdf->GetY();
        }
        $index = $i + 1;
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_ids[$i], '');
        $unit_name = $subunit_name = "";
        if(!empty($product_list)) {
            foreach($product_list as $p_list) {
                if(!empty($p_list['unit_name'])) {
                    $unit_name = $obj->encode_decode('decrypt', $p_list['unit_name']);
                }
                if(!empty($p_list['subunit_name']) && $p_list['subunit_name'] != $GLOBALS['null_value']) {
                    $subunit_name = $obj->encode_decode('decrypt',$p_list['subunit_name']);
                }
            }
        }
        $pdf->Cell(20,8,$index,1,0,'C',0);
        $pdf->Cell(40,8,$obj->encode_decode('decrypt', $product_names[$i]),1,0,'C',0);
        $pdf->Cell(30,8,$quantity[$i].' ' .  ($unit_types[$i] == '1' ? $unit_name : $subunit_name),1,0,'C',0);
        $subunit_qty = 0;
        if($unit_types[$i] == '1') {
            $total_unit = $total_unit + $quantity[$i];
        } else if($unit_types[$i] == '2') {
            $total_subunit = $total_subunit + $quantity[$i];
        }

        if(!empty($contents[$i]) && $contents[$i] != $GLOBALS['null_value']) {
            if($unit_types[$i] == '1') {
                $subunit_qty = (int) $contents[$i] * (int) $quantity[$i];
            } else {
                $subunit_qty = $quantity[$i];
            }
            $pdf->Cell(18,8,$contents[$i].' '. $subunit_name,1,0,'C',0);
        } else {
            $subunit_qty = $quantity[$i];
            $pdf->Cell(18,8,'-',1,0,'C',0);
        }
        if(!empty($subunit_needs[$i]) && $subunit_needs[$i] =='1'){
            $pdf->Cell(25-$less_for_tax,8,$subunit_qty.' ' . $subunit_name,1,0,'C',0);
        }else{
            $pdf->Cell(25-$less_for_tax,8,$subunit_qty.' ' . $unit_name,1,0,'C',0);
        }
        if($gst_option == '1' && $tax_type == '1') {
            $pdf->Cell(9,8,$product_tax[$i],1,0,'C',0);
        }
        $pdf->Cell(19-$less_for_tax,8,number_format($final_rate[$i],2),1,0,'C',0);
        $pdf->Cell(18-$less_for_tax,8,$per[$i]. ' '. ($per_type[$i] == '1' ? $unit_name : $subunit_name),1,0,'C',0);
        $pdf->Cell(20,8,$amount[$i],1,1,'C',0);
        $purchase_subtotal += $amount[$i];
    }

    $pdf->SetFont('Arial','B',8);

    $pdf->Line(30,$y_axis,30,$end_content);
    $pdf->Line(70,$y_axis,70,$end_content);
    $pdf->Line(100,$y_axis,100,$end_content);
    $pdf->Line(118,$y_axis,118,$end_content);
    $pdf->Line(143-$less_for_tax,$y_axis,143-$less_for_tax,$end_content);
    if($gst_option == '1' && $tax_type == '1') {
        $pdf->Line(149,$y_axis,149,$end_content);
    }
    $pdf->Line(162+$less_for_tax,$y_axis,162+$less_for_tax,$end_content);
    $pdf->Line(180,$y_axis,180,$end_content);
    $pdf->Line(200,$y_axis,200,$end_content);
    if($pdf->GetY() >= $end_content){
        $y = $pdf->GetY();
        $pdf->SetY($y_axis);
        $pdf->SetX(10);
        $pdf->Cell(20,277-$y_axis,'',1,0,'L',0);
        $pdf->Cell(40,277-$y_axis,'',1,0,'C',0);
        $pdf->Cell(30,277-$y_axis,'',1,0,'C',0);
        $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
        $pdf->Cell(25,277-$y_axis,'',1,0,'C',0);
        $pdf->Cell(19,277-$y_axis,'',1,0,'C',0);
        $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
        $pdf->Cell(20,277-$y_axis,'',1,1,'C',0);

        $pdf->SetFont('Arial','B',10);
        $next_page = $pdf->PageNo() +1;
        $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $page_number += 1;
        $total_pages[] = $page_number;
        
        $file_name="Estimate";

        include("rpt_header.php");
        if(!empty($company_logo)) {
            $pdf->SetAlpha(0.2);
            if(!empty($company_logo)){
                if(file_exists('../include/images/upload/'.$company_logo)){
                    $pdf->Image('../include/images/upload/'.$company_logo,55,100,85,85);
                }
            }
            
            $pdf->SetAlpha(1);
        }   
        $pdf->SetY($header_end);

        $pdf->SetY($header_end);
        $pdf->Cell(20,10,'To :',0,1,'C',0);
        if (!empty($customer_details)) {
            for ($i = 0; $i < count($customer_details); $i++) {
                $customer_details[$i] = trim($customer_details[$i]);
                if (!empty($customer_details[$i]) && $customer_details[$i] != $GLOBALS['null_value']) {
                    $pdf->SetX(30);
                    $pdf->Cell(50,5,$customer_details[$i],0,1,'L',0);
                }
            }
        }
        $detials_y = $pdf->GetY();
        $pdf->SetY($header_end);
        $pdf->SetX(110);
        $pdf->Cell(20,10,'Bill Date',0,0,'L',0);
        $pdf->Cell(30,10,":  ".$proforma_invoice_date,0,1,'L',0);
        $pdf->SetX(110);
        $pdf->Cell(20,10,'Bill No',0,0,'L',0);
        $pdf->Cell(30,10,":  ".$proforma_invoice_number,0,1,'L',0);
        if(!empty($transport_name)) {
            $pdf->SetX(110);   
            $pdf->Cell(20,10,'Transport',0,0,'L',0);   
            $pdf->Cell(30,10,":  ".$transport_name,0,1,'L',0);
        }
        $bill_y = $pdf->GetY();
    
        if($detials_y > $bill_y) {
        $pdf->Line(105,$header_end,105, $detials_y);
        $pdf->SetY($detials_y);
        } else if($bill_y > $detials_y) {
            $pdf->SetY($bill_y);
        }
        $pdf->SetFont('Arial','B',8);   
        $y=$pdf->GetY();
        $pdf->SetX(10);
        $pdf->SetFillColor(52,58,64);
        $pdf->Cell(20,8,'S.No.',1,0,'C',0);
        $pdf->Cell(40,8,'Products',1,0,'C',0);
        $pdf->Cell(30,8,'Quantity',1,0,'C',0);
        $pdf->Cell(18,8,'contents',1,0,'C',0);
        $pdf->Cell(25-$less_for_tax,8,'Total Qty',1,0,'C',0);
        if($gst_option == '1' && $tax_type == '1') {
            $pdf->Cell(9,8,'Tax',1,0,'C',0);
        }
        $pdf->Cell(19-$less_for_tax,8,'Rate(Rs.)',1,0,'C',0);
        $pdf->Cell(18-$less_for_tax,8,'Per',1,0,'C',0);
        $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
        $pdf->SetFont('Arial','',8);

        $y_axis=$pdf->GetY();
    }

    $pdf->setY($end_content);
    $pdf->Line(30,$y_axis,30,$end_content);
    $pdf->Line(70,$y_axis,70,$end_content);
    $pdf->Line(100,$y_axis,100,$end_content);
    $pdf->Line(118,$y_axis,118,$end_content);
    $pdf->Line(143-$less_for_tax,$y_axis,143-$less_for_tax,$end_content);
    if($gst_option == '1' && $tax_type == '1') {
        $pdf->Line(149,$y_axis,149,$end_content);
    }
    $pdf->Line(162+$less_for_tax,$y_axis,162+$less_for_tax,$end_content);
    $pdf->Line(180,$y_axis,180,$end_content);
    $pdf->Line(200,$y_axis,200,$end_content);

    if(!empty($total_unit)) {
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(60,5,'Total Qty',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,5,$total_unit. ' Unit '. ($total_subunit != "" ? $total_subunit .' Subunit' : ''),1,0,'C',0);
    } 

    if(!empty($purchase_subtotal)) {
        $subtotal = $obj->numberFormat($purchase_subtotal,2);
        $pdf->SetX(100);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(80,5,'Sub Total',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(20,5,$subtotal,1,1,'R',0);
    }

    $bank_y = $pdf->GetY();
    $bank_start_y = $pdf->GetY();
    
    $bank_list = array();
    $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], 'bank_id', $bank_id, '');
    $bank_name = ""; $account_name = ""; $account_number = ""; $ifsc_code = "";
    if(!empty($bank_list)){
        foreach ($bank_list as $bank){
            $pdf->SetY($bank_y);
            if(!empty($bank['bank_name']) && $bank['bank_name'] != $GLOBALS['null_value']) {
                $bank_name = $bank['bank_name'];
                $bank_name = $obj->encode_decode("decrypt",$bank_name);
            }
            if(!empty($bank['account_name']) && $bank['account_name'] != $GLOBALS['null_value']) {
                $account_name = $bank['account_name'];
                $account_name = $obj->encode_decode("decrypt",$account_name);
            }
            if(!empty($bank['account_number']) && $bank['account_number'] != $GLOBALS['null_value']) {
                $account_number = $bank['account_number'];
                $account_number = $obj->encode_decode("decrypt",$account_number);
            }
            if(!empty($bank['ifsc_code']) && $bank['ifsc_code'] != $GLOBALS['null_value']) {
                $ifsc_code = $bank['ifsc_code'];
                $ifsc_code = $obj->encode_decode("decrypt",$ifsc_code);
            }
            $pdf->SetFont('Arial','BU',9);
            $pdf->Cell(0,1,'', 0, 1, '');
            $pdf->Cell(74,3,'Bank Details', 0, 1, '');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(12);
            $pdf->Cell(40,4, 'Bank Name', 0, 0, '');
            $pdf->SetX(35);
            $pdf->Cell(40,4, ' : '.$bank_name, 0, 1, '');
            $pdf->SetX(12);
            $pdf->Cell(40,4, 'Account Name', 0, 0, '');
            $pdf->SetX(35);
            $pdf->Cell(40,4, ' : '.$account_name, 0, 1, '');
            $pdf->SetX(12);
            $pdf->Cell(40,4, 'Account Number', 0, 0, '');
            $pdf->SetX(35);
            $pdf->Cell(40,4, ' : '.$account_number, 0, 1, '');
            $pdf->SetX(12);
            $pdf->Cell(40,4, 'IFSC Code', 0, 0, '');
            $pdf->SetX(35);
            $pdf->Cell(40,4, ' : '.$ifsc_code, 0, 1, '');
        }
    }
    $bank_y = $pdf->GetY();
    $pdf->SetY($bank_start_y);

    $charges_total_amounts = array(); $total_amount_car = 0; $charge_in = array();
        if(!empty($other_charges_id) && $other_charges_id != $GLOBALS['null_value']) {
            for($i=0; $i < count($other_charges_id); $i++) {
                $charge_in[$i] = "Rs.".$other_charges_value[$i];

                $other_charges_id[$i] = trim($other_charges_id[$i]);
                if(!empty($other_charges_id[$i])) {
                    $other_charges_name = "";
                    $other_charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id[$i], 'charges_name');
                    $other_charges_names[$i] = $other_charges_name;
                    $charges_type[$i] = trim($charges_type[$i]);
                    $other_charges_value[$i] = trim($other_charges_value[$i]);
                    if(isset($other_charges_value[$i])) {
                        $other_charges_error = "";
                        if(strpos($other_charges_value[$i], '%') !== false) {
                            $charge_in[$i] = $other_charges_value[$i];
                            $other_charges_values[$i] = str_replace('%', '', $other_charges_value[$i]);
                            $other_charges_values[$i] = trim($other_charges_values[$i]);
                            $other_charges_values[$i] = (float) $purchase_subtotal * $other_charges_values[$i] /100;
                           
                        } else {
                            $other_charges_values[$i] = $other_charges_value[$i];
                        }
                    }
                    $other_charges_total[$i] = $other_charges_values[$i];
                    if($charges_type[$i] == "minus") {
                        $total_amount_car -= $other_charges_values[$i];
                    }
                    else if($charges_type[$i] == "plus") {
                        $total_amount_car += $other_charges_values[$i];
                    }
                    $charges_total_amounts[] = $total_amount_car;
                }
            }
        }
        $total_amount_ = $purchase_subtotal;
        
        if(!empty($other_charges_id) && $other_charges_id != $GLOBALS['null_value']) {
            $total_charge = 0; 
            
            for($o = 0; $o < count($other_charges_id); $o++) {
                if($charges_type[$o] == "minus") {
                    $total_amount_ -= $other_charges_values[$o];
                }
                else if($charges_type[$o] == "plus") {
                    $total_amount_ += $other_charges_values[$o];
                }
                $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $other_charges_id[$o], 'charges_name');
                $pdf->SetX(100);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(80,5,$obj->encode_decode('decrypt', $charges_name)."(".$charge_in[$o].")",1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5, ($charges_type[$o] == "minus" ? '-' : '+').$other_charges_values[$o],1,1,'R',0);
                $pdf->SetX(100);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(80,5,'Total',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,number_format(((float) $total_amount_),2),1,1,'R',0);
            }
        }

        if($gst_option == 1 && $company_state == $party_state) {
            if(!empty($cgst_value)){  
                $cgst_value = $obj->numberFormat($cgst_value,2);
                $pdf->SetX(100);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(80,5,'CGST',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,$cgst_value,1,1,'R',0);
            }
            if(!empty($sgst_value)){  
                $sgst_value = $obj->numberFormat($sgst_value,2);

                $pdf->SetX(100);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(80,5,'SGST',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,$sgst_value,1,1,'R',0);
            }
        }
        if($gst_option == 1 && $company_state != $party_state) {
            if(!empty($igst_value)){  
                $igst_value = $obj->numberFormat($igst_value,2);

                $pdf->SetX(100);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(80,5,'IGST ',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,$igst_value,1,1,'R',0);
            }
        }
        if(!empty($total_tax_value)){  
            $total_tax_value = $obj->numberFormat($total_tax_value,2);

            $pdf->SetX(100);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(80,5,'Total Tax',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,$total_tax_value,1,1,'R',0);
        }          
        if(!empty($round_off)){  
            $pdf->SetX(100);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(80,5,'Round Off',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,number_format($round_off,2),1,1,'R',0);
        }
        if(!empty($bill_total)){
            $pdf->SetX(100);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(80,5,'Bill Total',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,$obj->numberFormat($bill_total,2),1,1,'R',0);
            $total_cal_y = $pdf->GetY();
            $line_y = $total_cal_y;
            if($total_cal_y >  $bank_y) {
                $line_y = $total_cal_y;
            } else if($bank_y > $total_cal_y) {
                $pdf->Line(100,$bank_start_y,100,$bank_y);
                $line_y = $bank_y;
            }
            $pdf->SetY($line_y);
            // echo $total_cal_y ,"<br>", $bank_y,"<br>", $line_y;
            $line_y = $pdf->GetY();
            $pdf->Line(10,$line_y,200,$line_y);

            $pdf->SetFont('Arial','',8);
            $pdf->SetX(10);
            $pdf->Cell(40,5,'Amount (in words) :',0,0,'L',0);
            $pdf->SetX(10);
            $pdf->Cell(0,5,'E. & O.E',0,1,'R',0);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(190,5,getIndianCurrency($bill_total).'Only',0,1,'L',0);
            $line_y = $pdf->GetY();
        }   

        $pdf->Line(10,$line_y,200,$line_y);
        $pdf->SetY($line_y);
        $pdf->SetFont('Arial','BU',9);
        // $pdf->Cell(100,2,'', 0, 1, '');
        $pdf->Cell(100,5,'Terms and Conditions', 0, 1, '');
        $pdf->SetY($line_y);
        $pdf->SetX(140);
        $pdf->SetFont('Arial','B',9);
        $pdf->MultiCell(60,7, 'FOR  ' . $company_details[0],0,'C',0);
        $pdf->SetFont('Arial','',8);
        $pdf->SetY(260);
        $pdf->setX(13);
        $pdf->MultiCell(90,4,'* We declare that this bill shows the actual price of the goods described and that all particulars are true and correct. ', 0, 1, '');
        $pdf->setX(13);
        $pdf->MultiCell(90,6,'* Subject to SIVAKASI jurisdiction only', 0, 1, '');
        $pdf->Cell(190,2,'', 0, 1, 'C');
        $pdf->SetY(270);
        $pdf->SetX(155);
        $pdf->Cell(45,2,'Authorised Signatory',0,1,'C',0);
        $pdf->SetFont('Arial','',7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(190,265,'',1,0,'C');
        $yz = $pdf ->GetY();
        $pdf->SetY(275);
        $pdf->Cell(190,5,'***This is Computer Generated bill. Hence Digital Signature is not required.***',0,1,'C',0);


    $pdf->Output('',$pdf_download_name . '.pdf');


}