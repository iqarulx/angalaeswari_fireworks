<?php
include("../include_user_check.php");
include("../include/number2words.php");

if(isset($_REQUEST['proforma_invoice_id'])) {
    $proforma_invoice_id = $_REQUEST['proforma_invoice_id'];
    $pdf_download_name ="";
    $pdf_download_name = "proforma Invice Report PDF";
    $proforma_invoice_number = ""; $proforma_invoice_date = date('d-m-Y'); $customer_id = ""; $agent_id = ""; $transport_id = ""; $transport_name = ""; $bank_id = ""; $magazine_type = ""; $magazine_id = ""; $gst_option = "";$address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $indv_magazine_ids = array(); $product_names = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array();
    $unit_names = array(); $quantity = array(); $rate = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array();$charges_type = array(); $other_charges_value = array(); $agent_commission = ""; $bill_total = "";$charges_count = 0;

    if(!empty($proforma_invoice_id)) {
        $proforma_invoice_list = $obj->getTableRecords($GLOBALS['proforma_invoice_table'], 'proforma_invoice_id', $proforma_invoice_id, '');
        if(!empty($proforma_invoice_list)) {
            foreach($proforma_invoice_list as $pi) {
                if(!empty($pi['proforma_invoice_number'])) {
                    $proforma_invoice_number = $pi['proforma_invoice_number'];
                }
                if(!empty($pi['customer_id'])) {
                    $customer_id = $pi['customer_id'];
                }
                if(!empty($pi['customer_details'])) {
                    $customer_details = $obj->encode_decode('decrypt', $pi['customer_details']);
                    $customer_details = explode("$$$", $customer_details);
                }
                if(!empty($pi['proforma_invoice_date'])) {
                    $proforma_invoice_date = date('d-m-Y', strtotime($proforma_invoice_date));
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
                if(!empty($pi['bill_total'])) {
                    $bill_total = $pi['bill_total'];
                }
            }
        }
    }

    // require_once('../fpdf/fpdf.php');
    // $pdf = new FPDF('P','mm','A4');
    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();

    $file_name="Proforma Invoice";
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
    $pdf->Cell(25,8,'Total Qty',1,0,'C',0);
    $pdf->Cell(19,8,'Rate(Rs.)',1,0,'C',0);
    $pdf->Cell(18,8,'Per',1,0,'C',0);
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
            $file_name="Proforma Invoice";

            include("rpt_header.php");
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
            $pdf->Cell(20,8,'S.No.',1,0,'C',0);
            $pdf->Cell(40,8,'Products',1,0,'C',0);
            $pdf->Cell(30,8,'Quantity',1,0,'C',0);
            $pdf->Cell(18,8,'contents',1,0,'C',0);
            $pdf->Cell(25,8,'Total Qty',1,0,'C',0);
            $pdf->Cell(19,8,'Rate(Rs.)',1,0,'C',0);
            $pdf->Cell(18,8,'Per',1,0,'C',0);
            $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
            $pdf->SetFont('Arial','',8);
            $pdf->SetTextColor(0,0,0);

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
        $pdf->Cell(25,8,$subunit_qty.' ' . (isset($subunit_needs[$i]) && $subunit_needs == '1' ? $subunit_name : $unit_name),1,0,'C',0);
        $pdf->Cell(19,8,number_format($final_rate[$i],2),1,0,'C',0);
        $pdf->Cell(18,8,$per[$i]. ' '. ($per_type[$i] == '1' ? $unit_name : $subunit_name),1,0,'C',0);
        $pdf->Cell(20,8,$amount[$i],1,1,'C',0);
        $purchase_subtotal += $amount[$i];
    }
    
    $pdf->SetFont('Arial','B',8);

    $pdf->Line(30,$y_axis,30,210);
    $pdf->Line(70,$y_axis,70,210);
    $pdf->Line(100,$y_axis,100,210);
    $pdf->Line(118,$y_axis,118,210);
    $pdf->Line(143,$y_axis,143,210);
    $pdf->Line(162,$y_axis,162,210);
    $pdf->Line(180,$y_axis,180,210);
    $pdf->Line(200,$y_axis,200,210);
    if($pdf->GetY() >= 210){
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
        
        $file_name="Proforma Invoice";
        include("rpt_header.php");
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
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20,8,'S.No.',1,0,'C',0);
        $pdf->Cell(40,8,'Products',1,0,'C',0);
        $pdf->Cell(30,8,'Quantity',1,0,'C',0);
        $pdf->Cell(18,8,'contents',1,0,'C',0);
        $pdf->Cell(25,8,'Total Qty',1,0,'C',0);
        $pdf->Cell(19,8,'Rate(Rs.)',1,0,'C',0);
        $pdf->Cell(18,8,'Per',1,0,'C',0);
        $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(0,0,0);

        $y_axis=$pdf->GetY();
    }

    $pdf->setY(210);
    $pdf->Line(30,$y_axis,30,210);
    $pdf->Line(70,$y_axis,70,210);
    $pdf->Line(100,$y_axis,100,210);
    $pdf->Line(118,$y_axis,118,210);
    $pdf->Line(143,$y_axis,143,210);
    $pdf->Line(162,$y_axis,162,210);
    $pdf->Line(180,$y_axis,180,210);
    $pdf->Line(200,$y_axis,200,210);

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
    if(!empty($other_charges_id) && empty($product_error)) {
        for($i=0; $i < count($other_charges_id); $i++) {
            $charge_in[$i] = "Rs.";
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
                } else if($charges_type[$i] == "plus") {
                    $total_amount_car += $other_charges_values[$i];
                }
                $charges_total_amounts[] = $total_amount_car;
            }
        }
    }
    $total_amount_ = $purchase_subtotal;
    if(!empty($other_charges_id)) {
        $total_charge = 0;
        for($o = 0; $o < count($other_charges_id); $o++) {
            if($charges_type[$o] == "minus") {
                $total_amount_ -= $other_charges_values[$o];
            } else if($charges_type[$o] == "plus") {
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

    if($gst_option == '1') {
        $percentage = 100;
        if($tax_type == '1') {
            for ($a = 0; $a < count($product_id); $a++) {
                $tax = trim(str_replace("%", "",$product_tax[$a]));
                if ($product_tax[$a] != '' && $tax != '%') {
                    $tax_plus_value = ($product_amount[$a] * $tax) / 100;
                    
                    $total_tax_value += $tax_plus_value;
                    $total_tax_amount = $total_tax_value;
                } else {
                    $tax_error = "Select tax for product - ".($obj->encode_decode('decrypt', $product_names[$a]));
                }
                if (!empty($tax_error)) {
                    if (!empty($proforma_invoice_error)) {
                        $proforma_invoice_error = $proforma_invoice_error . "<br>" . $tax_error;
                    } else {
                        $proforma_invoice_error = $tax_error;
                    }
                }
            }
        } else if($tax_type == '2') {
            $tax = "";
            $tax = str_replace("%", "", $overall_tax);
            $tax = trim($tax);
            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $tax)) {
                $total_tax_value = ($tax * $total_amount_) / $percentage;
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
            $total_amount_ = $total_amount_ + $total_tax_value;
        }
    }

    $round_off = 0;
    if(!empty($total_amount_)) {	
        if (strpos( $total_amount_, "." ) !== false) {
            $pos = strpos($total_amount_, ".");
            $decimal = substr($total_amount_, ($pos + 1), strlen($total_amount_));
            if($decimal != "00") {
                if(strlen($decimal) == 1) {
                    $decimal = $decimal."0";
                }
                if($decimal >= 50) {		
                    $round_off = 100 - $decimal;
                    if($round_off < 10 && $round_off > 0) {
                        $round_off = "0.0".$round_off;
                    } else if($round_off > 0){
                        $round_off = "0.".$round_off;
                    } else {
                        $round_off = str_replace("-", "", $round_off);
                        $round_off = "0.".$round_off;
                    }		
                    
                    $total_amount_ = (float)$total_amount_ - (float)$round_off;
                } else {
                    $decimal = "0.".$decimal;
                    $round_off = "-".$decimal;
                    $total_amount_ = $total_amount_ - $decimal;
                }
            }
        }
    }

    if($gst_option == 1 && $company_state == $party_state) {
        if(!empty($cgst_value)){  
            $cgst_value = $obj->numberFormat($cgst_value,2);
            $pdf->SetX(100);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(80,5,'CGST (9%)',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,$cgst_value,1,1,'R',0);
        }
        if(!empty($sgst_value)){  
            $sgst_value = $obj->numberFormat($sgst_value,2);

            $pdf->SetX(100);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(80,5,'SGST (9%)',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,$sgst_value,1,1,'R',0);
        }
    }
    if($gst_option == 1 && $company_state != $party_state) {
        if(!empty($igst_value)){  
            $igst_value = $obj->numberFormat($igst_value,2);

            $pdf->SetX(100);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(80,5,'IGST (18%)',1,0,'R',0);
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