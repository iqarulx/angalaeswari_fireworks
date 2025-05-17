<?php

include("../include_user_check.php");

$current_date = date('Y-m-d');

$customer_id = "";
$customer_name = "";
$customer_mobile_number = "";
if(isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    $customer_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'customer_name');
    $customer_mobile_number = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $customer_id, 'mobile_number');
}

// $total_records_list = array();
// $total_records_list = $obj->getTableRecords($GLOBALS['proforma_invoice_table'], 'customer_id', $customer_id, '');

$total_records_list = array();
$total_records_list = $obj->getCustomerWiseProformaInvoiceList($customer_id);

$customer_display = "";
if(!empty($customer_name)) {
    $customer_display .= $obj->encode_decode('decrypt', $customer_name);

    if(!empty($customer_mobile_number)) {
        $customer_display .= " (" . $obj->encode_decode('decrypt', $customer_mobile_number) . ")";
    }
}

require_once('../fpdf/fpdf.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages(); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

$file_name = "Customer - Proforma List";
include("rpt_header.php");

$pdf->SetFont('Arial','B',9);
$pdf->SetX(10);
$pdf->Cell(190,7, (!empty($customer_display)) ? $customer_display . " - Proforma List" : 'Proforma List',1,1,'C',0);

$pdf->SetFont('Arial','B',7);
$y = $pdf->GetY();

$pdf->SetFillColor(101,114,122);
$pdf->SetTextColor(255,255,255);
$pdf->SetX(10);

$pdf->Cell(10,8,'#',1,0,'C',1);
$pdf->Cell(60,8,'Bill Number / Date',1,0,'C',1);
$pdf->Cell(60,8,'Product',1,0,'C',1);
$pdf->Cell(60,8,'Quantity',1,1,'C',1);

$pdf->SetTextColor(0,0,0);
$start_y = $pdf->GetY();

$pdf->SetFont('Arial','',7);
$s_no = "1";

if (!empty($total_records_list)) {
    foreach($total_records_list as $record) {
        if($pdf->GetY() > 280) {
            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(277);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();

            $file_name = "Customer - Proforma List";
            include("rpt_header.php");
            
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(190,7, (!empty($customer_display)) ? $customer_display . " - Proforma List" : 'Proforma List',1,1,'C',0);

            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetX(10);
            $pdf->Cell(10,8,'#',1,0,'C',1);
            $pdf->Cell(60,8,'Bill Number / Date',1,0,'C',1);
            $pdf->Cell(60,8,'Product',1,0,'C',1);
            $pdf->Cell(60,8,'Quantity',1,1,'C',1);
            
            $pdf->SetFont('Arial','',8);
            $start_y = $pdf->GetY();
        }

        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetX(10);
        $pdf->Cell(10,5, $s_no , 0 , 0,'C',0);

        if(!empty($record['proforma_invoice_number'])) {
            $pdf->SetY($start_y);
            $pdf->SetX(20);
            $pdf->MultiCell(60, 5, $record['proforma_invoice_number'] . "\n" . date('d-m-Y', strtotime( $record['proforma_invoice_date'])), 0, 'C', 0);
            $pdf->SetTextColor(0,0,0);
        } else {
            $pdf->SetY($start_y);
            $pdf->SetX(20);
            $pdf->MultiCell(60, 5, '-', 0, 'L', 0);
        }

        $bill_no_y = $pdf->GetY() - $start_y;

        if(!empty($record['product_id'])) {
            $product_ids = explode(',', $record['product_id']);
            $content = explode(',', $record['content']);

            $product_loop_y = $start_y;

            for($i = 0; $i < count($product_ids); $i++) {
                $product_id = $product_ids[$i];
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');

                $product_name = $obj->encode_decode('decrypt', $product_name);
                if(isset($content[$i]) && !empty($content[$i])) {
                    $product_name .= " (" . $content[$i];

                    $sub_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');

                    if(!empty($sub_unit_id)) {
                        $sub_unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $sub_unit_id, 'unit_name');
                        $product_name .= ' ' . $obj->encode_decode('decrypt', $sub_unit_name);
                    }

                    $product_name .= ")";
                }

                $pdf->SetY($product_loop_y);
                $pdf->SetX(80);
                $pdf->MultiCell(60, 5, $product_name, 0, 'C', 0);
                $pdf->SetTextColor(0, 0, 0);
                $product_loop_y = $pdf->GetY();
            }
        } else {
            $pdf->SetX(80);
            $pdf->MultiCell(60, 5, '', 0, 'C', 0);
            $pdf->SetTextColor(0, 0, 0);
        }

        $product_y = $pdf->GetY() - $start_y;

        if(!empty($record['quantity'])) {
            $quantity = explode(',', $record['quantity']);
            $unit_id = explode(',', $record['unit_id']);

            $quantity_loop_y = $start_y;

            $quantity_display = "";
            for($i = 0; $i < count($quantity); $i++) {
                $quantity_display = $quantity[$i];

                if(isset($unit_id[$i]) && !empty($unit_id[$i])) {
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$i], 'unit_name');
                    $quantity_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                }

                $pdf->SetY($quantity_loop_y);
                $pdf->SetX(140);
                $pdf->MultiCell(60, 5, $quantity_display, 0, 'C', 0);
                $pdf->SetTextColor(0, 0, 0);
                $quantity_loop_y = $pdf->GetY();
            }
        } else {
            $pdf->SetX(140);
            $pdf->MultiCell(60, 5, '', 0, 'C', 0);
            $pdf->SetTextColor(0, 0, 0);
        }

        $quantity_y = $pdf->GetY() - $start_y;

        $y_array = array($bill_no_y, $product_y, $quantity_y);
        $max_y = max($y_array);

        $pdf->SetY($start_y);
        $pdf->SetX(10);
        $pdf->Cell(10,$max_y,'',1,0,'C');
        $pdf->SetX(20);
        $pdf->Cell(60,$max_y,'',1,0,'C');
        $pdf->SetX(80);
        $pdf->Cell(60,$max_y,'',1,0,'C');
        $pdf->SetX(140);
        $pdf->Cell(60,$max_y,'',1,1,'C');
        
        $start_y += $max_y;
        $pdf->SetY($start_y);

        $s_no++;
    }

    $pdf->SetX(10);
    $pdf->Cell(10,265-$pdf->GetY(),'',1,0,'C',0);
    $pdf->SetX(20);
    $pdf->Cell(60,265-$pdf->GetY(),'',1,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(60,265-$pdf->GetY(),'',1,0,'C',0);
    $pdf->SetX(140);
    $pdf->Cell(60,265-$pdf->GetY(),'',1,1,'C',0);
    
    $unit_arrays = [];
    $unit_quantity = [];
    $sub_unit_arrays = [];
    $sub_unit_quantity = [];
    foreach($total_records_list as $record) {
        $product_ids = explode(',', $record['product_id']);
        $unit_ids = explode(',', $record['unit_id']);
        $quantity_values = explode(',', $record['quantity']);
        for($i = 0; $i < count($product_ids); $i++) {
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_ids[$i], '');

            foreach($product_list as $product) {
                if(!empty($product['unit_id'])) {
                    if($product['unit_id'] == $unit_ids[$i] && $product['unit_id'] != "NULL") {
                        $unit_arrays[] = $unit_ids[$i];
                        $unit_quantity[] = $quantity_values[$i];
                    } else if($product['subunit_id'] == $unit_ids[$i] && $product['subunit_id'] != "NULL") {
                        $sub_unit_arrays[] = $unit_ids[$i];
                        $sub_unit_quantity[] = $quantity_values[$i];
                    }
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

    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(10);
    $pdf->Cell(130,8,'Total',1,0,'R',0);
    if(!empty($total_display)) {
        $pdf->SetX(140);
        $pdf->Cell(60,8,$total_display,1,1,'R',0);
    } else {
        $pdf->SetX(140);
        $pdf->Cell(60,8,'-',1,1,'R',0);
    }
}

/* End */
$pdf->SetFont('Arial','I',7);
$pdf->SetY(280);
$pdf->SetX(10);
$pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

$pdf_name = $file_name . ".pdf";
$pdf->Output('', $file_name);
