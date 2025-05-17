<?php
include("../include_user_check.php");
include("../include/number2words.php");

$expense_id = "";
if(isset($_REQUEST['view_expense_id'])) {
    $expense_id = $_REQUEST['view_expense_id'];
}
$from = "";
if(isset($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
}

$expense_list = array();
$expense_list = $obj->getAllRecords($GLOBALS['expense_table'], 'expense_id', $expense_id);

$expense_number = ""; $expense_date = ""; $expense_category_id = ""; $expense_category_name = "";
$narration = ""; $amounts = array(); $payment_mode_ids = array(); $payment_mode_names = array(); $bank_ids = array(); 
$bank_names = array(); $total_amount = 0; $deleted = 0; $company_id = ""; $expense_party_id = "";

if(!empty($expense_list)) {
    foreach($expense_list as $data) {
        if(!empty($data['expense_number']) && $data['expense_number'] != $GLOBALS['null_value']) {
            $expense_number = $data['expense_number'];
        }
        if(!empty($data['expense_date']) && $data['expense_date'] != "0000-00-00") {
            $expense_date = date('d-m-Y', strtotime($data['expense_date']));
        }
        if(!empty($data['expense_category_id']) && $data['expense_category_id'] != $GLOBALS['null_value']) {
            $expense_category_id = $data['expense_category_id'];
        }
        if(!empty($data['expense_category_name']) && $data['expense_category_name'] != $GLOBALS['null_value']) {
            $expense_category_name = $obj->encode_decode('decrypt', $data['expense_category_name']);
        }
        if(!empty($data['expense_party_id']) && $data['expense_party_id'] != $GLOBALS['null_value']) {
            $expense_party_id = $data['expense_party_id'];
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

if(!empty($expense_category_id)) {
    $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $expense_category_id, 'expense_category_name');
    $expense_category_name = $obj->encode_decode("decrypt",$expense_category_name);
}
$expense_party_name = "";
if(!empty($expense_party_id)) {
    $expense_party_name = $obj->getTableColumnValue($GLOBALS['expense_party_table'], 'expense_party_id', $expense_party_id, 'expense_party_name');
    $expense_party_name = $obj->encode_decode("decrypt",$expense_party_name);
}

require_once('../fpdf/AlphaPDF.php');
$pdf = new AlphaPDF('L','mm','A5');
$pdf->AliasNbPages(); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

$file_name="Expense";
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
$pdf->Cell(93,5,'Expense For',0,1,'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(20);
$pdf->MultiCell(85,4, (!empty($expense_party_name) ? $expense_party_name . ' - ' : '' ). $expense_category_name,0,'L',0);

$expense_category_y = $pdf->GetY();

$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($header_end_y);
$pdf->SetX(110);
$pdf->Cell(25,6,'Expense No ',0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3,6,':',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(57,6,$expense_number,0,1,'L');
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,130,0);
$pdf->SetX(110);
$pdf->Cell(25,6,'Expense Date ',0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3,6,':',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(57,6,$expense_date,0,1,'L');

$bill_y = $pdf->GetY();
$max_no_y = max($expense_category_y, $bill_y);

$pdf->SetY($header_end_y);
$pdf->SetX(10);
$pdf->Cell(190,($max_no_y - $header_end_y),'',1,1,'C');

$remarks_start_y = $pdf->GetY();

$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($remarks_start_y);
$pdf->SetX(12);
$pdf->Cell(20,5,'Remarks ',0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetX(32);
$pdf->Cell(3,5,' : ',0,0,'L');
$pdf->SetX(35);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(165,5,$narration,0,'L');

$remarks_end_y = $pdf->GetY();

if($remarks_end_y > 76) {
    $pdf->SetY($remarks_start_y);
    $pdf->Cell(190,$remarks_end_y - $remarks_start_y,'',1,1,'C');
}
else {
    $pdf->SetY($remarks_start_y);
    $pdf->Cell(190,25,'',1,1,'C');
}

$payment_start_y = $pdf->GetY();
$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($payment_start_y);
$pdf->SetX(12);
$pdf->Cell(30,5,'Payment Mode   : ',0,0,'L');
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
        if(!empty($bank_names[$i]) && $bank_names[$i] != $GLOBALS['null_value']) {
            $pdf->Cell(158,5,($obj->encode_decode('decrypt', $payment_mode_names[$i])).' ('.($obj->encode_decode('decrypt', $bank_names[$i])).') - '.($obj->encode_decode('decrypt', $account_number)).' - '.($obj->numberFormat($amounts[$i],2)),0,1,'L');
        }
        else {
            $pdf->Cell(158,5,($obj->encode_decode('decrypt', $payment_mode_names[$i])).' - '.($obj->numberFormat($amounts[$i],2)),0,1,'L');
        }
    }
}
$payment_end_y = $pdf->GetY();

if($payment_end_y > 96) {
    $pdf->SetY($payment_start_y);
    $pdf->Cell(190,$payment_end_y - $payment_start_y,'',1,1,'C');
}
else {
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
$pdf->SetFont('Arial','',9);
$pdf->Cell(158,5,$obj->numberFormat($total_amount,2),0,1,'L');
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','B',9);
$pdf->SetX(12);
$pdf->Cell(30,5,'Amount in words ',0,0,'L');
$pdf->SetX(42);
$pdf->Cell(3,5,' : ',0,0,'L');
$pdf->SetTextColor(0,130,0);
$pdf->SetX(45);
$pdf->SetFont('Arial','',9);
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

$pdf->Output($from, $expense_number.'.pdf');
?>