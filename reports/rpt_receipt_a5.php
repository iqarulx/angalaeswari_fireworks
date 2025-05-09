<?php
    include("../include_user_check.php");
    include("../include/number2words.php");

    $receipt_id = "";
    if(isset($_REQUEST['view_receipt_id'])) {
        $view_receipt_id = $_REQUEST['view_receipt_id'];
    }
    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    $receipt_list = array();
    $receipt_list = $obj->getAllRecords($GLOBALS['receipt_table'], 'receipt_id', $view_receipt_id);

    $receipt_number = ""; $receipt_date = ""; $party_id = ""; $party_name = "";
    $narration = ""; $amounts = array(); $payment_mode_ids = array(); $payment_mode_names = array(); $bank_ids = array(); 
    $bank_names = array(); $total_amount = 0; $deleted = 0; $company_id = "";

    if(!empty($receipt_list)) {
        foreach($receipt_list as $data) {
            if(!empty($data['bill_company_id']) && $data['bill_company_id'] != $GLOBALS['null_value']) {
                $company_id = $data['bill_company_id'];
            }
            if(!empty($data['receipt_number']) && $data['receipt_number'] != $GLOBALS['null_value']) {
                $receipt_number = $data['receipt_number'];
            }
            if(!empty($data['receipt_date']) && $data['receipt_date'] != "0000-00-00") {
                $receipt_date = date('d-m-Y', strtotime($data['receipt_date']));
            }
            if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                $party_id = $data['party_id'];
            }
            if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']) {
                $party_name = html_entity_decode($obj->encode_decode('decrypt', $data['party_name']));
            }
            if(!empty($data['narration']) && $data['narration'] != $GLOBALS['null_value']) {
                $narration = $obj->encode_decode('decrypt', $data['narration']);
                $narration = str_replace("\r\n", " ", $narration);
            }
            if(!empty($data['amount']) && $data['amount'] != $GLOBALS['null_value']) {
                $amounts = explode(',', $data['amount']);
                $amounts = array_reverse($amounts);
            }
            if(!empty($data['payment_mode_id']) && $data['payment_mode_id'] != $GLOBALS['null_value']) {
                $payment_mode_ids = explode(',', $data['payment_mode_id']);
                $payment_mode_ids = array_reverse($payment_mode_ids);
            }
            if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                $payment_mode_names = explode(',', $data['payment_mode_name']);
                $payment_mode_names = array_reverse($payment_mode_names);
            }
            if(!empty($data['bank_id']) && $data['bank_id'] != $GLOBALS['null_value']) {
                $bank_ids = explode(',', $data['bank_id']);
                $bank_ids = array_reverse($bank_ids);
            }
            if(!empty($data['bank_name']) && $data['bank_name'] != $GLOBALS['null_value']) {
                $bank_names = explode(',', $data['bank_name']);
                $bank_names = array_reverse($bank_names);
            }
            if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                $total_amount = $data['total_amount'];
            }
            if(!empty($data['deleted'])) {
                $deleted = $data['deleted'];
            }
        }
    }

    $party_list = array();
    $party_list = $obj->getTableRecords($GLOBALS['customer_table'], 'customer_id', $party_id, '');

    $party_mobile_number = ""; $party_address = ""; $party_state = "";

    if(!empty($party_list)) {
        foreach($party_list as $data) {
            if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                $party_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
            }
            if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
                $party_address = html_entity_decode($obj->encode_decode('decrypt', $data['address']));
                $party_address = str_replace("\r\n", " ", $party_address);
            }
            if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                $party_city = $obj->encode_decode('decrypt', $data['city']);
            }
            if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                $party_state = $obj->encode_decode('decrypt', $data['state']);
            }
        }
    }

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('L','mm','A5');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Receipt";
    include("rpt_header.php");

    if($deleted == '1') {
        if(file_exists('../include/images/cancelled.jpg')) {
            $pdf->SetAlpha(0.3);
            $pdf->Image('../include/images/cancelled.jpg',70,50,70,30);
            $pdf->SetAlpha(1);
        }
    }

    $header_end_y = $pdf->GetY();

    $pdf->SetTextColor(0,130,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($header_end_y);
    $pdf->SetX(12);
    $pdf->Cell(93,5,'To',0,1,'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(20);
    $pdf->Cell(85,4,'Mr/Mrs. '.html_entity_decode($party_name).',',0,1,'L');
    if(!empty($party_address)){
        $pdf->SetX(20);
        $pdf->MultiCell(85,4,$party_address.'.',0,'L');
    }
    if(!empty($party_city)) {
        $pdf->SetX(20);
        $pdf->Cell(85,4,$party_city.',',0,1,'L');
    }
    $pdf->SetX(20);
    $pdf->Cell(85,4,'Contact : '.$party_mobile_number,0,1,'L');
    $party_y = $pdf->GetY();

    $pdf->SetTextColor(0,130,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($header_end_y);
    $pdf->SetX(110);
    $pdf->Cell(40,6,'Receipt No ',0,0,'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(3,6,':',0,0,'L');
    $pdf->Cell(57,6,$receipt_number,0,1,'L');
    $pdf->SetTextColor(0,130,0);
    $pdf->SetX(110);
    $pdf->Cell(40,6,'Receipt Date ',0,0,'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(3,6,':',0,0,'L');
    $pdf->Cell(57,6,$receipt_date,0,1,'L');

    $bill_y = $pdf->GetY();
    $max_no_y = max($party_y, $bill_y);

    $pdf->SetY($header_end_y);
    $pdf->SetX(10);
    $pdf->Cell(190,($max_no_y - $header_end_y),'',1,1,'C');

    $remarks_start_y = $pdf->GetY();

    $pdf->SetTextColor(0,130,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($remarks_start_y);
    $pdf->SetX(12);
    $pdf->Cell(30,5,'Remarks ',0,0,'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(42);
    $pdf->Cell(3,5,' : ',0,0,'L');
    $pdf->SetX(45);
    $pdf->MultiCell(155,5,$narration,0,'L');

    $remarks_end_y = $pdf->GetY();

    if($remarks_end_y > 76) {
        $pdf->SetY($remarks_start_y);
        $pdf->Cell(190,$remarks_end_y - $remarks_start_y,'',1,1,'C');
    } else {
        $pdf->SetY($remarks_start_y);
        $pdf->Cell(190,25,'',1,1,'C');
    }

    $payment_start_y = $pdf->GetY();

    $pdf->SetTextColor(0,130,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($payment_start_y);
    $pdf->SetX(12);
    $pdf->Cell(30,5,'Payment Mode    : ',0,0,'L');
    $pdf->SetTextColor(0,0,0);
    if(!empty($payment_mode_names)) {
        $pdf->SetY($payment_start_y);
        for($i=0; $i < count($payment_mode_names); $i++) {
            $pdf->SetFont('Arial','',8);
            $pdf->SetX(40);
            $account_number = "";
            if(!empty($bank_names[$i]) && $bank_names[$i] != $GLOBALS['null_value']) {
                $account_number = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'account_number');
            }
            if(!empty($bank_names[$i]) && $bank_names[$i] != $GLOBALS['null_value'] && !empty($payment_mode_names[$i]) && $payment_mode_names[$i] != $GLOBALS['null_value']) {
                $pdf->Cell(158,5,($obj->encode_decode('decrypt', $payment_mode_names[$i])).' ('.($obj->encode_decode('decrypt', $bank_names[$i])).') - '.($obj->encode_decode('decrypt', $account_number)).' - Rs. '.($obj->numberFormat($amounts[$i],2)),0,1,'L');
            } else {
                if(!empty($payment_mode_names[$i]) && $payment_mode_names[$i]){
                    $pdf->Cell(158,5,($obj->encode_decode('decrypt', $payment_mode_names[$i])).' - Rs. '.($obj->numberFormat($amounts[$i],2)),0,1,'L');
                }
            }
        }
    }

    $payment_end_y = $pdf->GetY();
    if($payment_end_y > 96) {
        $pdf->SetY($payment_start_y);
        $pdf->Cell(190,$payment_end_y - $payment_start_y,'',1,1,'C');
    } else {
        $pdf->SetY($payment_start_y);
        $pdf->Cell(190,20,'',1,1,'C');
    }

    $amount_start_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($amount_start_y);
    $pdf->SetX(12);
    $pdf->Cell(30,5,'Total Amount ',0,0,'L');
    $pdf->SetX(42);
    $pdf->Cell(3,5,' : ',0,0,'L');
    $pdf->SetTextColor(0,130,0);
    $pdf->Cell(158,5,'Rs. '.$obj->numberFormat($total_amount,2),0,1,'L');
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(12);
    $pdf->Cell(30,5,'Amount in words ',0,0,'L');
    $pdf->SetX(42);
    $pdf->Cell(3,5,' : ',0,0,'L');
    $pdf->SetTextColor(0,130,0);
    $pdf->SetX(45);
    $pdf->MultiCell(155,5,getIndianCurrency($total_amount),0,'L');
    $pdf->SetTextColor(0,0,0);

    $amount_end_y = $pdf->GetY();

    $pdf->SetY($amount_start_y);
    $pdf->Cell(190,($amount_end_y - $amount_start_y),'',1,1,'C');

    $pdf->SetY($amount_end_y);

    $pdf->SetFont('Arial','B',9);
    $pdf->SetY(130);
    $pdf->SetX(12);
    $pdf->Cell(93,5,'(Verified)',0,0,'L');
    $pdf->SetX(107);
    $pdf->Cell(90,5,' Authorized Signature',0,1,'R');

    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(190,128,'',1,1,'C');

    $pdf->Output($from, $receipt_number.'.pdf');
?>