<?php

include("../include_user_check.php");
include("../include/number2words.php");

$company_list = array(); $company_details = "";
$company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
if(!empty($company_list)){
    $company_details = $obj->encode_decode('decrypt',$company_list);
    $company_details = explode("$$$", $company_details);
}

$company_logo = "";
$company_logo = $obj->getTableColumnValue($GLOBALS['company_table'],'primary_company','1','logo');


$view_material_transfer_id = "";
if (isset($_REQUEST['view_material_transfer_id'])) {
    $view_material_transfer_id = $_REQUEST['view_material_transfer_id'];
} else {
    header("Location: ../material_transfer.php");
    exit;
}

$material_transfer_date = date('Y-m-d'); $current_date = date('Y-m-d');$material_transfer_number = "";$from_godown_ids = "";$location = ""; $from_location = "";$to_godown_ids = "";$to_location = "";$product_ids = array();$product_names = array();$case_contains = array();$unit_id = array();$unit_names = array();$quantity = ""; $quantity_values = array(); $total_quantity = 0; $deleted = ""; $unit_type = "";
$from_godown_name = ""; $to_godown_name = ""; $from_magazine_name = ""; $to_magazine_name = "";
$total_unit = 0; $total_subunit = 0; $get_final_y =0; $unit_ids = array();

if (!empty($view_material_transfer_id)) {
    $material_transfer_list = array();
    $material_transfer_list = $obj->getAllRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $view_material_transfer_id);

    if(!empty($material_transfer_list)) {
        foreach($material_transfer_list as $data) {
            if(!empty($data['material_transfer_date'])) {
                // $material_transfer_date = date('Y-m-d', strtotime($data['material_transfer_date']));
                $material_transfer_date = date('d-m-Y', strtotime($data['material_transfer_date']));
            }
            if(!empty($data['material_transfer_number']) && $data['material_transfer_number'] != $GLOBALS['null_value']) {
                $material_transfer_number = $data['material_transfer_number'];
            }
            if(!empty($data['from_godown_id']) && $data['from_godown_id'] != $GLOBALS['null_value']) {
                $from_godown_ids = $data['from_godown_id'];
            }
            if(!empty($data['to_godown_id']) && $data['to_godown_id'] != $GLOBALS['null_value']) {
                $to_godown_ids = $data['to_godown_id'];
            }
            if(!empty($data['from_location']) && $data['from_location'] != $GLOBALS['null_value']) {
                $from_location =$data['from_location'];
            }
            if(!empty($data['to_location']) && $data['to_location'] != $GLOBALS['null_value']) {
                $to_location =$data['to_location'];
            }
            if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                $product_ids = $data['product_id'];
                $product_ids = explode(",", $product_ids);
                $product_count = count($product_ids);
            }
            if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                $product_names = $data['product_name'];
                $product_names = explode(",", $product_names);
            }
            if(!empty($data['content']) && $data['content'] != $GLOBALS['null_value']) {
                $case_contains = $data['content'];
                $case_contains = explode(",", $case_contains);
            }
            if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                $unit_ids = $data['unit_id'];
                $unit_ids = explode(",", $unit_ids);
            }
            if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                $unit_names = $data['unit_name'];
                $unit_names = explode(",", $unit_names);
            }
            if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                $quantity = $data['quantity'];
                $quantity_values = explode(",", $quantity);
            }
            if(!empty($data['drafted']) && $data['drafted'] != $GLOBALS['null_value']) {
                $draft = $data['drafted'];
            }
            if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']) {
                $total_quantity = $data['total_quantity'];
            }
            if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']) {
                $location = $data['location'];
            }
            if(!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                $unit_type = explode(",", $data['unit_type']);
            }
            $deleted = $data['deleted'];
        }
    }

$company_name = "";
$company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
    $company_name = html_entity_decode($obj->encode_decode('decrypt', $company_name));
}


require_once('../fpdf/AlphaPDF.php');
$pdf = new AlphaPDF('P', 'mm', 'A5');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetTitle('Material Transfer');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'BI', 10);
$pdf->SetY(5);
$pdf->Cell(0, 5, 'Material Transfer', 0, 1, 'C', 0);
$pdf->SetFont('Arial', 'BI', 10);
$height = 0;

if($deleted == '1') {
    if(file_exists('../include/images/cancelled.jpg')) {
        $pdf->SetAlpha(0.3);
        $pdf->Image('../include/images/cancelled.jpg',40,80,70,30);
        $pdf->SetAlpha(1);
    }
}

$y = $pdf->GetY(); 
$pdf->SetFont('Arial','B',8);

$pdf->SetY($y);
$pdf->SetX(50);

if (!empty($company_details)) {
    for ($i = 0; $i < count($company_details); $i++) {
        $company_details[$i] = trim($company_details[$i]);
        if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
            
            if ($i === 0) {  // Corrected comparison
                $pdf->SetFont('Arial', 'B', 11);
                $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                $rt = $pdf->gety();
            } elseif (strpos($company_details[$i], "GST") !== false) {
                $pdf->sety($y);
                $pdf->setx(105);
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(35, 5, $company_details[$i], 0, 1, 'R', 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                // $pdf->sety($rt);
                $pdf->SetX(50);
                $pdf->MultiCell(40, 4, $company_details[$i], 0, 'C');
                    $end_y =$pdf->GetY();
            }
        }
    }
}

if(!empty($company_logo)) {
    if(file_exists('../include/images/upload/'.$company_logo)){
        $pdf->Image('../include/images/upload/'.$company_logo,15,15,20,20);
    }
}

$pdf->SetY(10);
$pdf->SetX(10);
$pdf->Cell(130,($end_y - 10),'',1,1,'C');
$header_end = $pdf->GetY();

$pdf->SetY($header_end);


$bill_to_y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(10);
$pdf->Cell(0, 1, '', 0, 1, 'L', 0);
$pdf->Cell(90, 4, 'Material Transfer Date : ', 0, 0, 'L', 0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(43);
$pdf->Cell(20, 4,date('d-m-Y',strtotime($material_transfer_date)), 0, 1, 'L', 0);
$pdf->Cell(0, 2, '', 0, 1, 'L', 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(12);
$bill_to_y1 = $pdf->GetY();

$pdf->SetY($bill_to_y);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(0, 1, '', 0, 1, 'C', 0);

$pdf->SetFont('Arial', '', 9);

$pdf->SetX(85);
$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(95, 4, 'Material Transfer No : ', 0, 0, 'L', 0);

$pdf->SetFont('Arial', '', 8);
$pdf->SetX(115);
$pdf->Cell(20, 4, $material_transfer_number, 0, 1, 'L', 0);
$bill_to_y2 = $pdf->GetY();
$y_array = array($bill_to_y1, $bill_to_y2);
$max_bill_y = max($y_array);
$pdf->SetY($bill_to_y);
$pdf->SetX(10);
$pdf->cell(130, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

    
if($location == '1'){
    $from_godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $from_location, 'godown_name');
    if(!empty($from_godown_name) && $from_godown_name != $GLOBALS['null_value']){
        $from_godown_name = $obj->encode_decode('decrypt', $from_godown_name);
    }

    $to_godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $to_location, 'godown_name');
    if(!empty($to_godown_name) && $to_godown_name != $GLOBALS['null_value']){
        $to_godown_name = $obj->encode_decode('decrypt', $to_godown_name);
    }


}else{
    $from_magazine_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $from_location, 'magazine_name');
    if(!empty($from_magazine_name) && $from_magazine_name != $GLOBALS['null_value']){
        $from_magazine_name = $obj->encode_decode('decrypt', $from_magazine_name);
    }

    $to_magazine_name = $obj->getTableColumnValue($GLOBALS['magazine_table'], 'magazine_id', $to_location, 'magazine_name');
    if(!empty($to_magazine_name) && $to_magazine_name != $GLOBALS['null_value']){
        $to_magazine_name = $obj->encode_decode('decrypt', $to_magazine_name);
    }
}

$bill_to_y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(10);

if($location == '1'){
    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    $pdf->Cell(90, 4, 'From Godown : ', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(35);
    $pdf->Cell(20, 4,$from_godown_name, 0, 1, 'L', 0);
    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);
}else{
    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    $pdf->Cell(90, 4, 'From Magazine : ', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(35);
    $pdf->Cell(20, 4,$from_magazine_name, 0, 1, 'L', 0);
    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);
}

$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(12);

$bill_to_y1 = $pdf->GetY();
$pdf->SetY($bill_to_y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 1, '', 0, 1, 'C', 0);

$pdf->SetX(85);
$pdf->SetFont('Arial', 'B', 8);

if($location == '1'){
    $pdf->Cell(95, 4, 'To Godown : ', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(105);
    $pdf->Cell(20, 4, $to_godown_name, 0, 1, 'L', 0);
}else{
    $pdf->Cell(95, 4, 'To Magazine : ', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(105);
    $pdf->Cell(20, 4, $to_magazine_name, 0, 1, 'L', 0);
}

$bill_to_y2 = $pdf->GetY();
$y_array = array($bill_to_y1, $bill_to_y2);
$max_bill_y = max($y_array);
$pdf->SetY($bill_to_y);
$pdf->SetX(10);
$pdf->cell(130, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

$header_height = $max_bill_y - 10;
if ($header_height > 55) {
    $height -= ($header_height - 45);
}
$address_height = $max_bill_y - $bill_to_y;

$starting_y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(101,114,122);
$pdf->SetTextColor(255,255,255);
$pdf->SetX(10);
$pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
$pdf->Cell(40, 7, 'Products', 1, 0, 'C', 1);
$pdf->Cell(30, 7, 'Unit', 1, 0, 'C', 1);
$pdf->Cell(25, 7, 'Contains', 1, 0, 'C', 1);
$pdf->Cell(25, 7, 'Quantity', 1, 1, 'C', 1);
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial', '', 8);
$product_y = $pdf->GetY();

$y_axis = $pdf->GetY();
$s_no = 1;
$net_amount = 0;
$footer_height = 0;


$footer_height += 25;
$total_pages = array(1);
$page_number = 1;
$last_count = 0;

if (!empty($view_material_transfer_id) && !empty($product_ids)) {
    for ($p = 0; $p < count($product_ids); $p++) {
        if ($pdf->GetY() >= 180) {
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(40, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(30, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 190 - $y_axis, '', 1, 1, 'C', 0); 
           
            $pdf->SetFont('Arial', 'B', 9);

            $next_page = $pdf->PageNo() + 1;
            $pdf->SetFont('Arial','I',7);
            $pdf->SetX(10);
            $pdf->Cell(128,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $page_number += 1;
            $total_pages[] = $page_number;
            $last_count = $p + 1;
            $pdf->SetTitle('Material Transfer');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(5);
            $pdf->Cell(0, 5, 'Material Transfer', 0, 1, 'C', 0);
            $pdf->SetFont('Arial', 'BI', 10);

            $y = $pdf->GetY(); 
            $pdf->SetFont('Arial','B',8);

            $pdf->SetY($y);
            $pdf->SetX(50);

            if (!empty($company_details)) {
                for ($i = 0; $i < count($company_details); $i++) {
                    $company_details[$i] = trim($company_details[$i]);
                    if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                        
                        if ($i === 0) {  // Corrected comparison
                            $pdf->SetFont('Arial', 'B', 11);
                            $pdf->MultiCell(50, 7, $company_details[$i], 0, 'C');
                            $rt = $pdf->gety();
                        } elseif (strpos($company_details[$i], "GST") !== false) {
                            $pdf->sety($y);
                            $pdf->setx(105);
                            $pdf->SetFont('Arial', 'B', 8);
                            $pdf->Cell(35, 5, $company_details[$i], 0, 1, 'R', 0);
                        } else {
                            $pdf->SetFont('Arial', '', 8);
                            // $pdf->sety($rt);
                            $pdf->SetX(50);
                            $pdf->MultiCell(40, 4, $company_details[$i], 0, 'C');
                                $end_y =$pdf->GetY();
                        }
                    }
                }
            }

            if(!empty($company_logo)) {
                if(file_exists('../include/images/upload/'.$company_logo)){
                    $pdf->Image('../include/images/upload/'.$company_logo,15,15,20,20);
                }
            }

            $pdf->SetY(10);
            $pdf->SetX(10);
            $pdf->Cell(130,($end_y - 10),'',1,1,'C');
            $header_end = $pdf->GetY();

            $pdf->SetY($header_end);

            if($deleted == '1') {
                if(file_exists('../include/images/deleted.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/deleted.jpg',45,110,125,70);
                    $pdf->SetAlpha(1);
                }
            }

            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->Cell(90, 4, 'Material Transfer Date : ', 0, 0, 'L', 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(50);
            $pdf->Cell(20, 4,date('d-m-Y',strtotime($material_transfer_date)), 0, 1, 'L', 0);
            $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(12);

            $bill_to_y1 = $pdf->GetY();

            $pdf->SetY($bill_to_y);
            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

            $pdf->SetFont('Arial', '', 9);

            $pdf->SetX(85);
            $pdf->SetFont('Arial', 'B', 9);

            $pdf->Cell(95, 4, 'Material Transfer No : ', 0, 0, 'L', 0);

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(115);
            $pdf->Cell(20, 4, $material_transfer_number, 0, 1, 'L', 0);
            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1, $bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->cell(130, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);


            $bill_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            if($location == '1'){
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(90, 4, 'From Godown : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetX(35);
                $pdf->Cell(20, 4,$from_godown_name, 0, 1, 'L', 0);
                $pdf->Cell(0, 2, '', 0, 1, 'L', 0);
            }else{
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(90, 4, 'From Magazine : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetX(35);
                $pdf->Cell(20, 4,$from_magazine_name, 0, 1, 'L', 0);
                $pdf->Cell(0, 2, '', 0, 1, 'L', 0);
            }
            
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(12);



            $bill_y1 = $pdf->GetY();

            $pdf->SetY($bill_y);
            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(0, 1, '', 0, 1, 'C', 0);


            $pdf->SetX(85);
            $pdf->SetFont('Arial', 'B', 8);
            if($location == '1'){
                $pdf->Cell(95, 4, 'To Godown : ', 0, 0, 'L', 0);
            
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetX(105);
                $pdf->Cell(20, 4, $to_godown_name, 0, 1, 'L', 0);
            }else{
                $pdf->Cell(95, 4, 'To Magazine : ', 0, 0, 'L', 0);
            
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetX(105);
                $pdf->Cell(20, 4, $to_magazine_name, 0, 1, 'L', 0);
            }

            $bill_y2 = $pdf->GetY();
            $y_array = array($bill_y1, $bill_y2);
            $max_y = max($y_array);
            $pdf->SetY($bill_y);
            $pdf->SetX(10);
            $pdf->cell(130, ($max_y - $bill_y), '', 1, 1, 'L', 0);

            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetX(10);
            $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
            $pdf->Cell(40, 7, 'Products', 1, 0, 'C', 1);
            $pdf->Cell(30, 7, 'Unit', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Contains', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Quantity', 1, 1, 'C', 1);
            $pdf->SetTextColor(0,0,0);
            
            $pdf->SetFont('Arial', '', 8);
            $product_y = $pdf->GetY();

            // $y_axis = $pdf->GetY();
        }
        $quantity_values[$p] = trim($quantity_values[$p]);
        if(!empty($case_contains)){
            $case_contains[$p] = trim($case_contains[$p]);
        }
        $product_names[$p] = trim($product_names[$p]);
        if(!empty($unit_names[$p])){
            $unit_names[$p] = trim($unit_names[$p]);
        }
        
    
        //  if (!empty($unit_names[$p])) {
        //      $unit_names[$p] = $obj->encode_decode('decrypt', $unit_names[$p]);
        //  }
     
        $y = $pdf->GetY();
        $pdf->SetY($product_y);
        $pdf->SetX(15);
        $pdf->Cell(15, 6, $s_no, 0, 0, 'L', 0);

        $pdf->SetY($product_y);
        $pdf->SetX(22);
        $pdf->MultiCell(40, 6, html_entity_decode($obj->encode_decode("decrypt", $product_names[$p])), 0, 'L');
        $name_y = $pdf->GetY() - $product_y;

        if(!empty($unit_type[$p])) {
            $unit_name = "";
            if($unit_type[$p] == 1) {
                $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$p], 'unit_id');

                if(!empty($unit_id)) {
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');

                    if(!empty($unit_name)) {
                        $unit_name = $obj->encode_decode('decrypt', $unit_name);
                    }
                }
            } else {
                $subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$p], 'subunit_id');

                if(!empty($subunit_id)) {
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');

                    if(!empty($unit_name)) {
                        $unit_name = $obj->encode_decode('decrypt', $unit_name);
                    }
                }
            }

            $pdf->SetY($product_y);
            $pdf->SetX(60);
            $pdf->MultiCell(30, 6,$unit_name, 0, 'C');
            // $pdf->MultiCell(30, 6,'', 0, 'C');
        } else {
            $pdf->SetY($product_y);
            $pdf->SetX(120);
            $pdf->MultiCell(30, 6,'', 0, 'C');
        }
        $unit_y = $pdf->GetY() - $product_y;


        if(!empty($case_contains)){
            $pdf->SetY($product_y);
            $pdf->SetX(90);
            $pdf->MultiCell(25, 6,$case_contains[$p], 0, 'R');
            $contains_y = $pdf->GetY() - $product_y;
        }else{
            $pdf->SetY($product_y);
            $pdf->SetX(90);
            $pdf->MultiCell(25, 6,'-', 0, 'R');
            $contains_y = $pdf->GetY() - $product_y;
        }
        
        $pdf->SetY($product_y);
        $pdf->SetX(115);
        $pdf->MultiCell(25, 6,$quantity_values[$p], 0, 'R');
        $qty_y = $pdf->GetY() - $product_y;

        // $total_quantity += $quantity_values[$p]; 
        if($unit_type[$p] == 1) {
            $total_unit += $quantity_values[$p];
        }
        else if($unit_type[$p] == 2) {
            $total_subunit += $quantity_values[$p];
        }

    
        // $middle_y = $pdf->GetY();
        $y_array = array($name_y, $contains_y, $unit_y, $qty_y, $qty_y);
        $product_max = max($y_array);

        $pdf->SetY($product_y);
        // $pdf->SetX(10);
        // $pdf->Cell(10,$product_max,'',1,0,'C');
        // $pdf->SetX(20);
        // $pdf->Cell(40,$product_max,'',1,0,'C');
        // $pdf->SetX(60);
        // $pdf->Cell(30,$product_max,'',1,0,'C');
        // $pdf->SetX(120);
        // $pdf->Cell(25,$product_max,'',1,0,'C');
        // $pdf->SetX(175);
        // $pdf->Cell(25,$product_max,'',1,1,'C');

        $product_y += $product_max;
        $s_no++;
    }
}

$end_y = $pdf->GetY();
$last_page_count = $s_no - $last_count;

if (($footer_height + $end_y) > 190) {
    $y = $pdf->GetY();
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
   
    $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
    $pdf->Cell(40, 190 - $y_axis, '', 1, 0, 'C', 0);
    $pdf->Cell(30, 190 - $y_axis, '', 1, 0, 'C', 0);
    $pdf->Cell(25, 190 - $y_axis, '', 1, 0, 'C', 0);
    $pdf->Cell(25, 190 - $y_axis, '', 1, 1, 'C', 0);
    

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(128,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $pdf->SetTitle('Material Transfer');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetY(5);
    $pdf->Cell(0, 5, 'Material Transfer', 0, 1, 'C', 0);
    $pdf->SetFont('Arial', 'BI', 10);
    
    $y = $pdf->GetY(); 
    $pdf->SetFont('Arial','B',8);

    $pdf->SetY($y);
    $pdf->SetX(50);

    if (!empty($company_details)) {
        for ($i = 0; $i < count($company_details); $i++) {
            $company_details[$i] = trim($company_details[$i]);
            if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                
                if ($i === 0) {  // Corrected comparison
                    $pdf->SetFont('Arial', 'B', 11);
                    $pdf->MultiCell(50, 7, $company_details[$i], 0, 'C');
                    $rt = $pdf->gety();
                } elseif (strpos($company_details[$i], "GST") !== false) {
                    $pdf->sety($y);
                    $pdf->setx(105);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(35, 5, $company_details[$i], 0, 1, 'R', 0);
                } else {
                    $pdf->SetFont('Arial', '', 8);
                    // $pdf->sety($rt);
                    $pdf->SetX(50);
                    $pdf->MultiCell(40, 4, $company_details[$i], 0, 'C');
                        $end_y =$pdf->GetY();
                }
            }
        }
    }

    if(!empty($company_logo)) {
        if(file_exists('../include/images/upload/'.$company_logo)){
            $pdf->Image('../include/images/upload/'.$company_logo,15,15,20,20);
        }
    }

    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(130,($end_y - 10),'',1,1,'C');
    $header_end = $pdf->GetY();

    $pdf->SetY($header_end);

    if($deleted == '1') {
        if(file_exists('../include/images/deleted.jpg')) {
            $pdf->SetAlpha(0.3);
            $pdf->Image('../include/images/deleted.jpg',45,110,125,70);
            $pdf->SetAlpha(1);
        }
    }

    $bill_to_y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetX(10);
    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    $pdf->Cell(90, 4, 'Material Transfer Date : ', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetX(50);
    $pdf->Cell(20, 4, date('d-m-Y',strtotime($material_transfer_date)), 0, 1, 'L', 0);
    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetX(12);


    $bill_to_y1 = $pdf->GetY();

    $pdf->SetY($bill_to_y);
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

    $pdf->SetFont('Arial', '', 10);

    $pdf->SetX(85);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(95, 4, 'Material Transfer No : ', 0, 0, 'L', 0);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetX(115);
    $pdf->Cell(20, 4, $material_transfer_number, 0, 1, 'L', 0);

    $bill_to_y2 = $pdf->GetY();
    $y_array = array($bill_to_y1, $bill_to_y2);
    $max_bill_y = max($y_array);
    $pdf->SetY($bill_to_y);
    $pdf->SetX(10);
    $pdf->cell(130, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);




    $starting_y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(101,114,122);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetX(10);
    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
    $pdf->Cell(40, 7, 'Products', 1, 0, 'C', 1);
    $pdf->Cell(30, 7, 'Unit', 1, 0, 'C', 1);
    $pdf->Cell(25, 7, 'Contains', 1, 0, 'C', 1);
    $pdf->Cell(25, 7, 'Quantity', 1, 1, 'C', 1);
    $pdf->SetTextColor(0,0,0);
       
        
    
    $pdf->SetFont('Arial', '', 8);

    $y_axis = $pdf->GetY();
    $content_height = 181 - $footer_height;

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
    $pdf->Cell(40, $content_height - $y_axis, '', 1, 0);
    $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
    $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
    $pdf->Cell(25, $content_height - $y_axis, '', 1, 1);
   
    $pdf->SetY($content_height);


}

$max_page = max($total_pages);


$pdf->SetY($y_axis);
$pdf->SetX(10);

$pdf->Cell(10, 105 + $height, '', 1, 0);
$pdf->Cell(40, 105 + $height, '', 1, 0);
$pdf->Cell(30, 105 + $height, '', 1, 0);
$pdf->Cell(25, 105 + $height, '', 1, 0);
$pdf->Cell(25, 105 + $height, '', 1, 1);
    
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(10);

// $pdf->Cell(105, 5, 'Total Qty', 1, 0, 'R', 0);
// $pdf->Cell(25, 5, $total_quantity." ", 1, 1, 'R', 0);
$get_final_y = $pdf->GetY();


// if(!empty($total_unit) || !empty($total_subunit)) {
$pdf->SetFont('Arial','B',8);
// $pdf->SetY($get_final_y);

$unit_arrays = [];
$unit_quantity = [];
$sub_unit_arrays = [];
$sub_unit_quantity = [];
for($i = 0; $i < count($product_ids); $i++) {
    if($unit_type[$i]== 1) {
        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'unit_id');

        if(!empty($unit_id)) {
            $unit_arrays[] = $unit_id;
            $unit_quantity[] = $quantity_values[$i];
        }
    } else {
        $subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'subunit_id');

        if(!empty($subunit_id)) {
            $sub_unit_arrays[] = $subunit_id;
            $sub_unit_quantity[] = $quantity_values[$i];
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

$pdf->SetX(10);
$pdf->Cell(80,5,'Total Quantity',0,0,'R',0);
$pdf->SetFont('Arial','',8);
// $pdf->MultiCell(25,5,$obj->numberFormat($total_unit,2) ." Unit ". $obj->numberFormat($total_subunit,2) . " Subunit",0,'C',0);
if(!empty($total_display)) {
    $pdf->MultiCell(50,5,$total_display,0,'R',0);
} else {
    $pdf->MultiCell(50,5,"-",0,'C',0);
}
$get_total_y = $pdf->GetY();

$pdf->SetY($get_final_y);
$pdf->SetX(10);
$pdf->Cell(80,$get_total_y - $get_final_y,'',1,0,'C',0);
$pdf->Cell(50,$get_total_y - $get_final_y,'',1,1,'C',0);
// }

$pdf->SetY($get_total_y);
$line_y = $pdf->GetY();

$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(95);
$pdf->MultiCell(50, 5,html_entity_decode($company_name), 0, 'L', 0);
$pdf->Cell(50, 10,'', 0, 1, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->SetX(95);
$pdf->Cell(50, 5, 'Authorized Signatory', 0, 1, 'L', 0);

$pdf->SetFont('Arial', '', 7);
$pdf->SetY(10);
$pdf->SetX(10);

$pdf->Cell(130, 190, '', 1, 0, 'C');
$pdf->OutPut('', $material_transfer_number);
}
