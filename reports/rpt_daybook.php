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

    $selected_payment_mode_name = "";
    if (!empty($payment_mode_id)) {
        $selected_payment_mode_name = $obj->encode_decode("decrypt", $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_id, 'payment_mode_name'));
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
        if(!empty($from_date) || !empty($to_date)) {
            if($from_date != $to_date){
                $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($from_date)).'  to  '.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
            } else {
                $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
            }
        } else {
            $pdf->Cell(190,6,'Daybook Report',1,1,'C',0);
        }
        
        $pdf->SetFont('Arial','B',8);
        $starty = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->Cell(10,10,'S.No.',1,0,'C',0);
        $pdf->Cell(30,10,'Entry Number & Date',1,0,'C',0);
        $pdf->Cell(30,10,'Bill Type',1,0,'C',0);
        $pdf->Cell(50,10,'Party Name',1,0,'C',0);
        $pdf->Cell(30,10,'Payment Mode',1,0,'C',0);
        $pdf->Cell(20,10,'Credit',1,0,'C',0);
        $pdf->Cell(20,10,'Debit',1,1,'C',0);
        $pdf->SetFont('Arial','',7);
    
        $index = 0;
        $product_count = 0; $quantity = ""; $grand_amount = 0; $grand_quantity = 0; $credit = 0; $debit = 0;$s_no = 0;
        $credit_amount = 0;
        $debit_amount = 0; $name ="";
        
 

            if (!empty($total_records_list)) {
                foreach ($total_records_list as $key => $data) {

                    $selected_mode = strtolower(trim($selected_payment_mode_name));

                    // Payment mode filtering
                    if (!empty($payment_mode_id)) {
                        $types = !empty($data['payment_type']) ? explode(",", $data['payment_type']) : [];
                        $has_match = false;

                        foreach ($types as $pt_enc) {
                            $pt_enc = trim($pt_enc);
                            if ($pt_enc === '') continue;

                            $pt = strtolower(trim($obj->encode_decode("decrypt", $pt_enc)));

                            if ($pt === $selected_mode) {
                                $has_match = true;
                                break;
                            }
                        }

                        if (!$has_match) {
                            continue;
                        }
                    }

                    // Page break
                    if ($pdf->GetY() > 250) {
                        $pdf->SetFont('Arial','I',7);
                        $pdf->SetY(285);
                        $pdf->SetX(10);
                        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                        $pdf->AddPage();
                        $yaxis = $pdf->GetY();
                        include("rpt_header.php");

                        $pdf->SetY($header_end);
                        $pdf->SetX(10);
                        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);

                        $pdf->SetFont('Arial','B',9);
                        $pdf->SetX(10);
                        if(!empty($from_date) || !empty($to_date)) {
                            $title = ($from_date != $to_date)
                                ? 'Daybook Report - ('.date('d-m-Y',strtotime($from_date)).'  to  '.date('d-m-Y',strtotime($to_date)).')'
                                : 'Daybook Report - ('.date('d-m-Y',strtotime($to_date)).')';
                            $pdf->Cell(190,6,$title,1,1,'C',0);
                        } else {
                            $pdf->Cell(190,6,'Daybook Report',1,1,'C',0);
                        }

                        $pdf->SetFont('Arial', 'B', 9);
                        $pdf->SetX(10);
                        $pdf->Cell(10,10,'S.No.',1,0,'C',0);
                        $pdf->Cell(30,10,'Entry Number & Date',1,0,'C',0);
                        $pdf->Cell(30,10,'Bill Type',1,0,'C',0);
                        $pdf->Cell(50,10,'Party Name',1,0,'C',0);
                        $pdf->Cell(30,10,'Payment Mode',1,0,'C',0);
                        $pdf->Cell(20,10,'Credit',1,0,'C',0);
                        $pdf->Cell(20,10,'Debit',1,1,'C',0);
                        $pdf->SetFont('Arial', '', 7);
                    }

                    // Setup variables
                    $starty = $pdf->GetY();
                    $s_no = $key + 1;
                    $pdf->SetX(10);
                    $pdf->Cell(10, 8, $s_no, 0, 0, 'C', 0);

                    // Entry Number & Date
                    $pdf->SetX(20);
                    $pdf->Cell(30, 4, $data['bill_number'] ?? '', 0, 1, 'C', 0);
                    $pdf->SetX(20);
                    $pdf->Cell(30, 4, (!empty($data['bill_date']) ? date('d-m-Y', strtotime($data['bill_date'])) : ''), 0, 0, 'C', 0);
                    $bill_date_y = $pdf->GetY();

                    // Bill Type
                    $pdf->SetY($starty);
                    $pdf->SetX(50);
                    $pdf->Cell(30, 8, $data['type'], 0, 0, 'C', 0);

                    // Party Name
                    if (!empty($data['party_name']) && $data['party_name'] != 'NULL') {
                        $pdf->SetY($starty);
                        $pdf->SetX(80);
                        $name = ($data['type'] != "Expense")
                            ? html_entity_decode($obj->encode_decode('decrypt', $data['party_name']))
                            : html_entity_decode($obj->encode_decode('decrypt',
                                $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $data['party_id'], 'expense_party_name')
                            ));
                        $pdf->MultiCell(50, 8, $name ?: ' - ', 0, 'C', 0);
                    } else {
                        $expense_category_name ="";
                        if(!empty($data['category_id'])){
                            
                            $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $data['category_id'], 'expense_category_name');
                           
                        }
                        $pdf->SetY($starty);
                        $pdf->SetX(80);
                        $pdf->MultiCell(50, 8, $obj->encode_decode('decrypt',$expense_category_name), 0, 'C', 0);
                    }
                    $customer_name_y = $pdf->GetY();

                    // Payment Mode (with bank)
                    $pdf->SetY($starty);
                    $pdf->SetX(130);
                    $payment_type = explode(",", $data['payment_type']);
                    $bank_id = explode(",", $data['bank_id']);
                    $payment_bank_pairs = [];

                    for ($i = 0; $i < count($payment_type); $i++) {
                        $pt_enc = trim($payment_type[$i]);
                        if ($pt_enc === '') continue;

                        $type = strtolower(trim($obj->encode_decode('decrypt', $pt_enc)));

                        if (empty($payment_mode_id) || $type === $selected_mode) {
                            $bank_name = '';
                            if (!empty($bank_id[$i])) {
                                $bank_name = $obj->encode_decode('decrypt',
                                    $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name')
                                );
                            }
                            $payment_bank_pairs[] = ucfirst($type) . ($bank_name ? " ($bank_name)" : "");
                        }
                    }

                    $payment_bank_str = (!empty($payment_bank_pairs)) ? implode(", ", $payment_bank_pairs) : ' - ';
                    $pdf->MultiCell(30, 4, $payment_bank_str, 0, 'C', 0);
                    $payment_name_y = $pdf->GetY();

                    // Amount calculation (accurate for Purchase Entry & Estimate)
                    $credit_val = '-';
                    $debit_val = '-';
                    $sum = 0.0;

                    $is_purchase_or_estimate = in_array($data['type'], ['Purchase Entry', 'Estimate']);
                    $amount_source = $is_purchase_or_estimate ? explode(",", $data['amount'] ?? '') : explode(",", $data['payment_amount'] ?? '');
                    $types_to_check = explode(",", $data['payment_type'] ?? '');

                    $used = false;

                    foreach ($types_to_check as $idx => $pt_enc) {
                        $pt_enc = trim($pt_enc);
                        if ($pt_enc === '') continue;

                        $pt = strtolower(trim($obj->encode_decode("decrypt", $pt_enc)));

                        if (empty($payment_mode_id) || $pt === $selected_mode) {
                            if (isset($amount_source[$idx])) {
                                $sum += floatval($amount_source[$idx]);
                                $used = true;
                            }
                        }
                    }

                    // Fallback: if nothing added but amount exists and matches type
                    if (!$used && $is_purchase_or_estimate && !empty($data['amount'])) {
                        $sum = array_sum(array_map('floatval', explode(",", $data['amount'])));
                    }

                    if (in_array($data['type'], ['Receipt', 'Purchase Entry'])) {
                        if ($sum > 0) {
                            $credit_amount += $sum;
                            $credit_val = $obj->numberFormat($sum, 2);
                        }
                    } elseif (in_array($data['type'], ['Expense', 'Voucher', 'Estimate'])) {
                        if ($sum > 0) {
                            $debit_amount += $sum;
                            $debit_val = $obj->numberFormat($sum, 2);
                        }
                    }

                    // Output amounts
                    $pdf->SetY($starty);
                    $pdf->SetX(160);
                    $pdf->Cell(20, 8, $credit_val, 0, 0, 'R', 0);
                    $pdf->SetX(180);
                    $pdf->Cell(20, 8, $debit_val, 0, 1, 'R', 0);

                    // Border Drawing
                    $final_end_y = max($bill_date_y, $customer_name_y, $payment_name_y);
                    $pdf->SetY($starty);
                    $pdf->Cell(10, $final_end_y - $starty, '', 1, 0, 'C', 0);
                    $pdf->Cell(30, $final_end_y - $starty, '', 1, 0, 'C', 0);
                    $pdf->Cell(30, $final_end_y - $starty, '', 1, 0, 'C', 0);
                    $pdf->Cell(50, $final_end_y - $starty, '', 1, 0, 'C', 0);
                    $pdf->Cell(30, $final_end_y - $starty, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, $final_end_y - $starty, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, $final_end_y - $starty, '', 1, 1, 'C', 0);
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

        $balance_str = $obj->numberFormat(abs($balance), 2);
        $font_size = (strlen($balance_str) <= 15) ? 7 : 5;
        $pdf->SetFont('Arial', '', $font_size);

        if ($credit_amount > $debit_amount) {
           
            $pdf->Cell(20, 8, $balance_str, 1, 0, 'R', 0); 
            $pdf->Cell(20, 8, '', 1, 1, 'R', 0);           
        } elseif ($debit_amount > $credit_amount) {
           
            $pdf->Cell(20, 8, '', 1, 0, 'R', 0);           
            $pdf->Cell(20, 8, $balance_str, 1, 1, 'R', 0); 
        } else {
           
            $pdf->Cell(20, 8, '', 1, 0, 'R', 0);
            $pdf->Cell(20, 8, '', 1, 1, 'R', 0);
        }

        
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        
        $pdf->Output();
        ?> 
       