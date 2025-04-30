<?php

include("../include_user_check.php");


    $from_date ="";
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }

    $to_date ="";
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $party_id ="";
    if(isset($_REQUEST['party_id'])) {
        $party_id = $_REQUEST['party_id'];
    }

    $payment_mode_id ="";
    if(isset($_REQUEST['payment_mode_id'])) {
        $payment_mode_id = $_REQUEST['payment_mode_id'];
    }

    $sales_party_id="";
    $sales_type="";
	$total_records_list = array();
	$total_records_list = $obj->getDayBookReportList($from_date,$to_date,$party_id,$payment_mode_id);

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


        require_once('../fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
               
        $current_y = $pdf->GetY();
        $box_y = $pdf->GetY();
    
        $yaxis = $pdf->GetY();
                    
        $file_name="Daybook Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);
        $pdf->SetX(10);
    
        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        if($from_date != $to_date){
            $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($from_date)).'  to  '.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
        }else{
            $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
        }
        $pdf->SetFont('Arial','B',8);
        $starty = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->Cell(10,10,'S.No.',1,0,'C',0);
        $pdf->Cell(40,10,'Entry Number & Date',1,0,'C',0);
        $pdf->Cell(60,10,'Party Name',1,0,'C',0);
        $pdf->Cell(40,10,'Payment Mode',1,0,'C',0);
        $pdf->Cell(20,10,'Credit',1,0,'C',0);
        $pdf->Cell(20,10,'Debit',1,1,'C',0);
        $pdf->SetFont('Arial','',7);
    
        $index = 0;
        $product_count = 0; $quantity = ""; $grand_amount = 0; $grand_quantity = 0; $credit = 0; $debit = 0;$s_no = 0;
        $credit_amount = 0;
        $debit_amount = 0; $name ="";
        
        if (!empty($total_records_list)) {
            foreach ($total_records_list as $key => $data) {
              
                if ($pdf->GetY() > 250) {
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(285);
                    $pdf->SetX(10);
                    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $yaxis = $pdf->GetY();
                    
                    $file_name="Daybook Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);
                    $pdf->SetX(10);
                
                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    if($from_date != $to_date){
                        $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($from_date)).'  to  '.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
                    }else{
                        $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
                    }
                    $pdf->SetFont('Arial', 'B', 9);
                    $starty = $pdf->GetY();
                    $pdf->SetX(10);
                    $pdf->Cell(10, 10, 'S.No.', 1, 0, 'C', 0);
                    $pdf->Cell(40, 10, 'Entry Number & Date', 1, 0, 'C', 0);
                    $pdf->Cell(60, 10, 'Party Name', 1, 0, 'C', 0);
                    $pdf->Cell(40, 10, 'Payment Mode', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Credit', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Debit', 1, 1, 'C', 0);
                    $pdf->SetFont('Arial', '', 7);
                }
                $starty = $pdf->GetY();
                $s_no = $key + 1;
                $starty = $pdf->GetY();
                
                $pdf->SetX(10);
                $pdf->Cell(10, 8, $s_no, 0, 0, 'C', 0);
        
                $pdf->SetX(20);
                if(!empty($data['bill_number'])) {
                    $bill_number = $data['bill_number'];
                    $pdf->Cell(40,4,$bill_number,0,1,'C',0);
                }
                $pdf->SetX(20);
                if(!empty($data['bill_date'])) {
                    $bill_date = date('d-m-Y', strtotime($data['bill_date'])); 
                    $pdf->Cell(40,4,$bill_date,0,0,'C',0);
                }
                $bill_date_y = $pdf->getY();
                $pdf->SetY($starty);
                $pdf->SetX(20);
                $pdf->Cell(40,8,'',0,0,'C',0);
                if (!empty($data['party_name'])) {
                //    $customer_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $data['party_id'], 'name_mobile_city');
                    if(!empty($data['party_name'])){ 
                        $name =html_entity_decode($obj->encode_decode('decrypt', $data['party_name'])); 
                    }
                    
                    // $pdf->SetX(60);
                    $pdf->MultiCell(60, 8, substr($name, 0, 50), 0, 'C', 0);
                    $pdf->MultiCell(60, 8,$name, 0, 'C', 0);
                }
                // if (!empty($data['agent_id'])) {
                //     $customer_name ="";
                //     $customer_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $data['agent_id'], 'name_mobile_city');
                //     if(!empty($customer_name)){ 
                //         $name =html_entity_decode($obj->encode_decode('decrypt', $customer_name)); 
                //     }
                //     $pdf->SetX(60);
                //     $pdf->MultiCell(60, 8, substr($name, 0, 50), 0, 'C', 0);
                // }
                else {
                    $pdf->SetX(60);
                    $pdf->Cell(60, 8, ' - ', 0, 0, 'C', 0);
                }
                
                $customer_name_y = $pdf->GetY();
                            
                $pdf->setY($starty);
                if (!empty($data['payment_type']) || !empty($data['bank_id'])) {
                    $payment_type = explode(",", $data['payment_type']);
                    $bank_id = explode(",", $data['bank_id']);
                    $decoded_payment_type = array_map([$obj, 'encode_decode'], array_fill(0, count($payment_type), 'decrypt'), $payment_type);
                    $payment_bank_pairs = [];
                    for ($i = 0; $i < count($payment_type); $i++) {
                        if (!empty($bank_id[$i])) {
                            $current_bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                            $current_bank_name = $obj->encode_decode('decrypt', $current_bank_name);
                            if (!empty($decoded_payment_type[$i]) && !empty($current_bank_name)) {
                                $payment_bank_pairs[] = $decoded_payment_type[$i] . ' (' . $current_bank_name . ')';
                            }
                        }
                        else {
                            if (!empty($decoded_payment_type[$i])) {
                                $payment_bank_pairs[] = $decoded_payment_type[$i];
                            }
                        }
                    }
                
                    if (!empty($payment_bank_pairs)) {
                        $payment_bank_str = implode(", ", $payment_bank_pairs);
                    } else {
                        $payment_bank_str = '';
                    }
                    
                   
                    $pdf->SetX(120);
                    $pdf->MultiCell(40, 8, $payment_bank_str ?: ' - ', 0,  'C', 0);
                    
                }else {
                    $pdf->SetX(120);
                    $pdf->MultiCell(40, 8, ' - ', 0,  'C', 0);
                }
                $pdf->SetY($starty);
                if (!empty($data['type'])) {
                    if ($data['type'] == "receipt" || $data['type'] == "Purchase Entry") {
                        if (!empty($data['amount'])) {
                            $amount_credit = $data['amount'];
                            $amounts_credit = explode(",", $amount_credit);
                            $amount_credit = array_sum(array_map('floatval', $amounts_credit));  
                            $credit_amount += $amount_credit;
                            $formatted_amount_credit = $obj->numberFormat($amount_credit,2);
                            $pdf->SetX(160);
                            $pdf->Cell(20, 8, $formatted_amount_credit, 0, 0, 'R', 0);
                            $pdf->SetX(180);
                            $pdf->Cell(20, 8, '-', 0, 1, 'R', 0);
                        }else {
                            $pdf->SetX(160);
                            $pdf->Cell(20, 8, '-', 0, 0, 'C', 0);
                            $pdf->SetX(180);
                            $pdf->Cell(20, 8, '-', 0, 1, 'C', 0);
                        }
                    }else if ($data['type'] == "voucher" || $data['type'] == "expense" || ($data['type'] == 'Estimate')) {
                        if (!empty($data['amount'])) {
                            $amount = $data['amount'];
                            $amounts = explode(",", $amount);
                            $amount = array_sum(array_map('floatval', $amounts)); 
                            $debit_amount += $amount;
                            $formatted_amount = $obj->numberFormat($amount,2);
                            $pdf->SetX(160);
                            $pdf->Cell(20, 8, '-', 0, 0, 'C', 0);
                            $pdf->SetX(180);
                            $pdf->Cell(20, 8, $formatted_amount, 0, 1, 'R', 0);
                        }else {
                            $pdf->SetX(160);
                            $pdf->Cell(20, 8, '-', 0, 0, 'C', 0);
                            $pdf->SetX(180);
                            $pdf->Cell(20, 8, '-', 0, 1, 'C', 0);
                        }
                    }else if ($data['type'] == 'estimate' || $data['type'] == 'invoice' || $data['type'] == 'quotation') {
                        if (!empty($data['amount'])) {
                            $amounts = explode(",", $data['amount']);
                            $total_amount = array_sum(array_map('floatval', $amounts));
                            $debit_amount += $total_amount;
                            $formatted_total_amount = $obj->numberFormat($total_amount,2);
                            $pdf->SetX(160);
                            $pdf->Cell(20, 8, '-', 0, 0, 'C', 0);
                            $pdf->SetX(180);
                            $pdf->Cell(20, 8, $formatted_total_amount, 0, 1, 'R', 0);
                        }else {
                            $pdf->SetX(160);
                            $pdf->Cell(20, 8, '-', 0, 0, 'C', 0);
                            $pdf->SetX(180);
                            $pdf->Cell(20, 8, '-', 0, 1, 'C', 0);
                        }
                    }else {
                        $pdf->SetX(160);
                        $pdf->Cell(20, 8, '-', 0, 0, 'C', 0);
                        $pdf->SetX(180);
                        $pdf->Cell(20, 8, '-', 0, 1, 'C', 0);
                    }
                }

                $final_end_y = max($bill_date_y,$customer_name_y);
                // echo $final_end_y;
                $pdf->SetY($starty);
                $pdf->Cell(10,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(40,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(60,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(40,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(20,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(20,$final_end_y - $starty, '', 1, 1, 'C', 0);

            }
        }
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetX(10);
        $pdf->Cell(150, 8, 'Total', 1, 0, 'R', 0);
        if(strlen($obj->numberFormat($credit_amount,2)) <= 15) {
            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(20, 8, $obj->numberFormat($credit_amount,2), 1, 0, 'R', 0);
        }
        else {
            $pdf->SetFont('Arial', '', 5);
            $pdf->Cell(20, 8, $obj->numberFormat($credit_amount,2), 1, 0, 'R', 0);
        }
        if(strlen($obj->numberFormat($debit_amount,2)) <= 15) {
            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(20, 8, $obj->numberFormat($debit_amount,2), 1, 1, 'R', 0);
        }
        else {
            $pdf->SetFont('Arial', '', 5);
            $pdf->Cell(20, 8, $obj->numberFormat($debit_amount,2), 1, 1, 'R', 0);
        }
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(150, 8, 'Balance', 1, 0, 'R', 0);
        $balance = $credit_amount - $debit_amount;
        if(strlen($obj->numberFormat($balance,2)) <= 15) {
            $pdf->SetFont('Arial', '', 7);
            if ($balance > 0) {
                $pdf->Cell(20, 8, $obj->numberFormat($balance,2), 1, 0, 'R', 0);
                $pdf->Cell(20, 8, '', 1, 1, 'R', 0);
            } else {
                $pdf->Cell(20, 8, '', 1, 0, 'R', 0);
                $pdf->Cell(20, 8, $obj->numberFormat($balance,2), 1, 1, 'R', 0);
            }
        }
        else {
            $pdf->SetFont('Arial', '', 5);
            if ($balance > 0) {
                $pdf->Cell(20, 8, $obj->numberFormat($balance,2), 1, 0, 'R', 0);
                $pdf->Cell(20, 8, '', 1, 1, 'R', 0);
            } else {
                $pdf->Cell(20, 8, '', 1, 0, 'R', 0);
                $pdf->Cell(20, 8, $obj->numberFormat($balance,2), 1, 1, 'R', 0);
            }
        }
        
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        
        $pdf->Output();
        ?> 
       