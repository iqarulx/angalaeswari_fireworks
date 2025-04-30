<?php

include("../include_user_check.php");
// include("../include.php");
include("../include/number2words.php");

$view_consumption_entry_id = "";
if (isset($_REQUEST['view_consumption_entry_id'])) {
    $view_consumption_entry_id = $_REQUEST['view_consumption_entry_id'];
} else {
    header("Location: ../consumption_entry.php");
    exit;
}

$from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d');
$entry_date = date('Y-m-d'); $bill_number = ""; $entry_date = date('Y-m-d');
$contractor_id = ""; $contractor_name_mobile_city = ""; 
$consumption_entry_number = ""; $consumption_entry_date = "";
$product_ids = array(); $product_name = ""; $unit_ids = array(); $unit_names = array(); $quantity = array();
 $total_amount = 0; $party_type = ""; $godown_id ="";
$consumption_list = array();$factory_details =array();$factory_details1 =array(); $total_quantity = 0; $contractor_details = array(); 
$party_details = array(); $outsourceparty_details = array(); $godown_details = array(); $godown_details = array(); $consumption_content = array();
 $quantity = array(); $company_name = "";  $end_y = "";
$case_contains = array();  $group_id = ""; $group_name = "";

$company_logo = "";
$company_logo = $obj->getTableColumnValue($GLOBALS['company_table'],'primary_company','1','logo');


if (!empty($view_consumption_entry_id)) {
    $consumption_list = array();
    $consumption_list = $obj->getTableRecords($GLOBALS['consumption_entry_table'], 'consumption_id', $view_consumption_entry_id, '');    

    if(!empty($consumption_list)) {
        foreach($consumption_list as $consumption_entry) {
            if(!empty($consumption_entry['consumption_entry_number']) && $consumption_entry['consumption_entry_number'] != $GLOBALS['null_value']) {
                $consumption_entry_number = $consumption_entry['consumption_entry_number'];
            }
            if(!empty($consumption_entry['entry_date'])) {
                $consumption_entry_date = date('d-m-Y', strtotime($consumption_entry['entry_date']));
            }

            if(!empty($consumption_entry['contractor_id'])) {
                $contractor_id = $consumption_entry['contractor_id'];
            }
            if(!empty($consumption_entry['godown_type'])) {
                $godown_type = $consumption_entry['godown_type'];
            }
            if(!empty($consumption_entry['total_quantity'])) {
                $total_quantity = $consumption_entry['total_quantity'];
            }
            if(!empty($consumption_entry['godown_id'])) {
                $godown_id = explode(",", $consumption_entry['godown_id']);
                // print_r($godown_id);
            }
            if(!empty($consumption_entry['product_id'])) {
                $product_id = explode(",", $consumption_entry['product_id']);
            }
            if(!empty($consumption_entry['unit_type'])) {
                $unit_type = explode(",", $consumption_entry['unit_type']);
            }
            if(!empty($consumption_entry['quantity'])) {
                $quantity = explode(",", $consumption_entry['quantity']);
            }
            if(!empty($consumption_entry['content'])) {
                $consumption_content = explode(",", $consumption_entry['content']);
            }
            
            if(!empty($consumption_entry['entry_date'])) {
                $entry_date = date('Y-m-d', strtotime($consumption_entry['entry_date']));
            }
            if($godown_type == 1){
                $first_godown_id = trim($godown_id[0]);
            }
            if(!empty($consumption_entry['company_details']) && $consumption_entry['company_details'] != $GLOBALS['null_value']) {
                $company_details = $consumption_entry['company_details'];
                $company_details = $obj->encode_decode('decrypt',$company_details);
                $company_details = explode("$$$", $company_details);
            }
            if(!empty($consumption_entry['contractor_details']) && $consumption_entry['contractor_details'] != $GLOBALS['null_value']) {
                $contractor_details = $consumption_entry['contractor_details'];
                $contractor_details = $obj->encode_decode('decrypt',$contractor_details);
                $contractor_details = explode("$$$", $contractor_details);
            }
            if(!empty($consumption_entry['contractor_details']) && $consumption_entry['contractor_details'] != $GLOBALS['null_value']) {
                $contractor_details = $consumption_entry['contractor_details'];
                $contractor_details = $obj->encode_decode('decrypt',$contractor_details);
                $contractor_details = explode("$$$", $contractor_details);
            }


            if(!empty($company_details)){
                for($n=0;$n<count($company_details);$n++){
                    if($company_details[0] != "NULL"){
                        $company_name = $company_details[0];
                    }
                }
            }
        }
    }
}


require_once('../fpdf/AlphaPDF.php');
$pdf = new AlphaPDF('P', 'mm', 'A5');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetTitle('Consumption Entry');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(5);
$pdf->Cell(0, 5, 'Consumption Entry', 0, 1, 'C', 0);
$pdf->SetFont('Arial', 'BI', 10);
$height = 0;



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

$bill_to_y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(10);
$pdf->Cell(0, 1, '', 0, 1, 'L', 0);
$pdf->Cell(74, 4, 'From', 0, 1, 'L', 0);
$pdf->Cell(0, 1, '', 0, 1, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(12);

if(!empty($contractor_details)) {
    for($i=0; $i<count($contractor_details); $i++) {
        if($i==0) {
            $pdf->SetFont("Arial", "B", 10);
            $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
        } 
        else {
            $pdf->SetX(12);
            $pdf->SetFont("Arial", "", 8);
            if($contractor_details[$i] != "NULL"){
                $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
            }
        }
    }
}
$bill_to_y1 = $pdf->GetY();

$pdf->SetY($bill_to_y);


$godown_name = "";
if(!empty($godown_id) && $godown_type == '1'){
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX(75);
    $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9);

    for($i = 0;$i <count($godown_id);$i++){
        $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_name');
    }
    $pdf->SetX(80);
    $pdf->cell(60, 5, html_entity_decode($obj->encode_decode("decrypt", $godown_name)), 0, 1, 'L', 0);
}

$bill_to_y2 = $pdf->GetY();

$y_array = array($bill_to_y1, $bill_to_y2);
$max_bill_y = max($y_array);
$pdf->SetY($bill_to_y);

$pdf->SetX(10);
$pdf->cell(65, ($max_bill_y - $bill_to_y), '', 1, 0, 'L', 0);

$pdf->SetX(75);
$pdf->Cell(65, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);


$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(10);
$pdf->Cell(65, 6, 'Entry No. : ' . $consumption_entry_number, 1, 0, 'L');

$pdf->SetY($bill_to_y1);
$pdf->SetX(75);
$pdf->Cell(65, 6, 'Date : ' . $consumption_entry_date, 1, 1, 'L'); 


$header_height = $max_bill_y - 10;
if ($header_height > 55) {
    $height -= ($header_height - 45);
}
$address_height = $max_bill_y - $bill_to_y;

$starting_y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(10);

if(!empty($godown_id) && $godown_type == '1'){
    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
    $pdf->Cell(35, 7, 'Product Group', 1, 0, 'C', 0);
    $pdf->Cell(35, 7, 'Product', 1, 0, 'C', 0);
    $pdf->Cell(20, 7, 'Type', 1, 0, 'C', 0);
    $pdf->Cell(15, 7, 'QTY', 1, 0, 'C', 0);
    $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
}else{
    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
    $pdf->Cell(24, 7, 'Godown Name', 1, 0, 'C', 0);
    $pdf->Cell(24, 7, 'Product Group', 1, 0, 'C', 0);
    $pdf->Cell(28, 7, 'Product', 1, 0, 'C', 0);
    $pdf->Cell(15, 7, 'Type', 1, 0, 'C', 0);
    $pdf->Cell(14, 7, 'QTY', 1, 0, 'C', 0);
    $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
}
   

$pdf->SetFont('Arial', '', 8);

$y_axis = $pdf->GetY();
$s_no = 1;
$net_amount = 0;
$footer_height = 0;


$footer_height += 25;
$total_pages = array(1);
$page_number = 1;
$last_count = 0;

if (!empty($view_consumption_entry_id) && !empty($product_id)) {
    for ($p = 0; $p < count($product_id); $p++) {

        if ($pdf->GetY() >= 180) {
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
           
            if(!empty($godown_id) && $godown_type == '1'){
                $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(35, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(35, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);
            }else{
                $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(28, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(14, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);

            }
                
           
            $pdf->SetFont('Arial', 'B', 9);

            $next_page = $pdf->PageNo() + 1;

            $pdf->Cell(130, 5, 'Continued to Page Number ' . $next_page, 1, 1, 'R', 0);
            $pdf->AddPage();
            $page_number += 1;
            $total_pages[] = $page_number;
            $last_count = $p + 1;
            $pdf->SetTitle('Consumption Entry');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(5);
            $pdf->Cell(0, 5, 'Consumption Entry', 0, 1, 'C', 0);
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

            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetX(10);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->Cell(74, 4, 'From', 0, 1, 'L', 0);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(12);
            
            if(!empty($contractor_details)) {
                for($i=0; $i<count($contractor_details); $i++) {
                    if($i==0) {
                        $pdf->SetFont("Arial", "B", 10);
                        $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                    } 
                    else {
                        $pdf->SetX(12);
                        $pdf->SetFont("Arial", "", 8);
                        if($contractor_details[$i] != "NULL"){
                            $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                        }
                    }
                }
            }
            $bill_to_y1 = $pdf->GetY();
            
            $pdf->SetY($bill_to_y);
            
            
            
            if(!empty($godown_id) && $godown_type == '1'){
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetX(75);
                $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
                $pdf->SetFont('Arial', 'B', 9);
            
                for($i = 0;$i <count($godown_id);$i++){
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_name');
                }
                $pdf->SetX(80);
                $pdf->cell(60, 5, html_entity_decode($obj->encode_decode("decrypt", $godown_name)), 0, 1, 'L', 0);
            }
            
            $bill_to_y2 = $pdf->GetY();
            
            $y_array = array($bill_to_y1, $bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->cell(65, ($max_bill_y - $bill_to_y), '', 1, 0, 'L', 0);
            
            $pdf->SetX(75);
            $pdf->Cell(65, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);
            
            
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            $pdf->Cell(65, 6, 'Entry No. : ' . $consumption_entry_number, 1, 0, 'L');
            
            $pdf->SetY($bill_to_y1);
            $pdf->SetX(75);
            $pdf->Cell(65, 6, 'Date : ' . $consumption_entry_date, 1, 1, 'L');            
         

            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetX(10);
           
            if(!empty($godown_id) && $godown_type == '1'){
                $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
                $pdf->Cell(35, 7, 'Product Group', 1, 0, 'C', 0);
                $pdf->Cell(35, 7, 'Product', 1, 0, 'C', 0);
                $pdf->Cell(20, 7, 'Type', 1, 0, 'C', 0);
                $pdf->Cell(15, 7, 'QTY', 1, 0, 'C', 0);
                $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
            }else{
                $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
                $pdf->Cell(24, 7, 'Godown Name', 1, 0, 'C', 0);
                $pdf->Cell(24, 7, 'Product Group', 1, 0, 'C', 0);
                $pdf->Cell(28, 7, 'Product', 1, 0, 'C', 0);
                $pdf->Cell(15, 7, 'Type', 1, 0, 'C', 0);
                $pdf->Cell(14, 7, 'QTY', 1, 0, 'C', 0);
                $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
            }
            
            $pdf->SetFont('Arial', '', 8);

            $y_axis = $pdf->GetY();
        }

        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$p], '');
        if(!empty($product_list)) {
            foreach ($product_list as $P_list) {
                if(!empty($P_list['group_id'])) {
                    $group_id = $P_list['group_id'];
                }
                if(!empty($P_list['group_name'])) {
                    $group_name = $P_list['group_name'];
                }
                if(!empty($P_list['product_name'])) {
                    $product_name = $P_list['product_name'];
                }
                if(!empty($P_list['unit_id'])) {
                    $unit_id = $P_list['unit_id'];
                }
                if(!empty($P_list['unit_name'])) {
                    $unit_name = $P_list['unit_name'];
                }
            }
        }

        $quantity[$p] = trim($quantity[$p]);

        // $consumption_content[$p] = trim($consumption_content[$p]);

        if(!empty($godown_id) && $godown_type == '1'){
            $y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(15, 6, $s_no, 0, 0, 'L', 0);

            $pdf->SetY($y);
            $pdf->SetX(20);
            $pdf->MultiCell(35, 6, html_entity_decode($obj->encode_decode("decrypt", $group_name)), 0, 'L');
            $group_y = $pdf->GetY();


            $pdf->SetY($y);
            $pdf->SetX(55);
            $pdf->MultiCell(35, 6, html_entity_decode($obj->encode_decode("decrypt", $product_name)), 0, 'L');
            $product_y = $pdf->GetY();

            $pdf->SetY($y);
            $pdf->SetX(90);
            $pdf->MultiCell(20, 6,html_entity_decode($obj->encode_decode("decrypt", $unit_name)), 0, 'C');
            
            $pdf->SetY($y);
            $pdf->SetX(110);
            $pdf->MultiCell(15, 6,$obj->numberFormat($quantity[$p],2)." ", 0, 'R');
            

            $pdf->SetY($y);
            $pdf->SetX(120);
            if(!empty($consumption_content) && $consumption_content[$p] != $GLOBALS['null_value']){

                $pdf->MultiCell(15, 6,$consumption_content[$p], 0, 'R');

            }else{
                $pdf->MultiCell(15, 6," - ", 0, 'R');
            }
            

        }else{

            for($i = 0;$i <count($godown_id);$i++){
                $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$p],'godown_name');
            }

            $y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(15, 6, $s_no, 0, 0, 'L', 0);

            $pdf->SetY($y);
            $pdf->SetX(20);
            $pdf->MultiCell(24, 6, html_entity_decode($obj->encode_decode("decrypt", $godown_name)), 0, 'L');
            $godown_y = $pdf->GetY();


            $pdf->SetY($y);
            $pdf->SetX(44);
            $pdf->MultiCell(24, 6, html_entity_decode($obj->encode_decode("decrypt", $group_name)), 0, 'L');
            $group_y = $pdf->GetY();


            $pdf->SetY($y);
            $pdf->SetX(68);
            $pdf->MultiCell(28, 6, html_entity_decode($obj->encode_decode("decrypt", $product_name)), 0, 'L');
            $product_y = $pdf->GetY();

            $pdf->SetY($y);
            $pdf->SetX(96);
            $pdf->MultiCell(15, 6,html_entity_decode($obj->encode_decode("decrypt", $unit_name)), 0, 'C');
            
            $pdf->SetY($y);
            $pdf->SetX(111);
            $pdf->MultiCell(14, 6,$obj->numberFormat($quantity[$p],2)." ", 0, 'R');
            

            $pdf->SetY($y);
            $pdf->SetX(120);
            if(!empty($consumption_content) && $consumption_content[$p] != $GLOBALS['null_value']){

                $pdf->MultiCell(15, 6,$consumption_content[$p], 0, 'R');

            }else{
                $pdf->MultiCell(15, 6," - ", 0, 'R');
            }
        }
        $s_no++;
        $middle_y = $pdf->GetY();
    } 
}
$end_y = $pdf->GetY();

$last_page_count = $s_no - $last_count;

if (($footer_height + $end_y) > 190) {
    $y = $pdf->GetY();
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
   
    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(35, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(35, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);
    }else{
        $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(28, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(14, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);

    }
    
   
    $pdf->SetFont('Arial', 'B', 9);

    $next_page = $pdf->PageNo() + 1;

    $pdf->Cell(128, 5, 'Continued to Page Number ' . $next_page, 1, 1, 'R', 0);
    $pdf->AddPage();
    $pdf->SetTitle('Consumption Entry');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetY(5);
    $pdf->Cell(0, 5, 'Consumption Entry', 0, 1, 'C', 0);
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


    $bill_to_y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX(10);
    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    $pdf->Cell(74, 4, 'From', 0, 1, 'L', 0);
    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetX(12);

    if(!empty($contractor_details)) {
        for($i=0; $i<count($contractor_details); $i++) {
            if($i==0) {
                $pdf->SetFont("Arial", "B", 10);
                $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
            } 
            else {
                $pdf->SetX(12);
                $pdf->SetFont("Arial", "", 8);
                if($contractor_details[$i] != "NULL"){
                    $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                }
            }
        }
    }
    $bill_to_y1 = $pdf->GetY();

    $pdf->SetY($bill_to_y);

    
    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(75);
        $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
        $pdf->SetFont('Arial', 'B', 9);

        for($i = 0;$i <count($godown_id);$i++){
            $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_name');
        }
        $pdf->SetX(80);
        $pdf->cell(60, 5, html_entity_decode($obj->encode_decode("decrypt", $godown_name)), 0, 1, 'L', 0);
    }

    $bill_to_y2 = $pdf->GetY();

    $y_array = array($bill_to_y1, $bill_to_y2);
    $max_bill_y = max($y_array);
    $pdf->SetY($bill_to_y);
    
    $pdf->SetX(10);
    $pdf->cell(65, ($max_bill_y - $bill_to_y), '', 1, 0, 'L', 0);

    $pdf->SetX(75);
    $pdf->Cell(65, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);


    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetX(10);
    $pdf->Cell(65, 6, 'Entry No. : ' . $consumption_entry_number, 1, 0, 'L');

    $pdf->SetY($bill_to_y1);
    $pdf->SetX(75);
    $pdf->Cell(64, 6, 'Date : ' . $consumption_entry_date, 1, 1, 'L'); 



    $starting_y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetX(10);
    
    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
        $pdf->Cell(35, 7, 'Product Group', 1, 0, 'C', 0);
        $pdf->Cell(35, 7, 'Product', 1, 0, 'C', 0);
        $pdf->Cell(20, 7, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(15, 7, 'QTY', 1, 0, 'C', 0);
        $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
    }else{
        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
        $pdf->Cell(24, 7, 'Godown Name', 1, 0, 'C', 0);
        $pdf->Cell(24, 7, 'Product Group', 1, 0, 'C', 0);
        $pdf->Cell(28, 7, 'Product', 1, 0, 'C', 0);
        $pdf->Cell(15, 7, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(14, 7, 'QTY', 1, 0, 'C', 0);
        $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
    }
    
    $pdf->SetFont('Arial', '', 8);

    $y_axis = $pdf->GetY();
    $content_height = 204 - $footer_height;

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    
    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->Cell(10, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 1, 'C', 0);
    }else{
        $pdf->Cell(10, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(28, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(14, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 1, 'C', 0);

    }
    
   
    $pdf->SetY($content_height);
}

    $max_page = max($total_pages);
    // if ($max_page != 1) {
    //     $height += $address_height;
    // }


    $pdf->SetY($y_axis);
    $pdf->SetX(10);

    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->Cell(10, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(35, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(35, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(20, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 105 + $height, '', 1, 1, 'C', 0);
    }else{
        $pdf->Cell(10, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(24, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(24, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(28, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(14, 105 + $height, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 105 + $height, '', 1, 1, 'C', 0);

    }
    
    

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetX(10);


    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->Cell(100, 5, 'Total Quantity', 1, 0, 'R', 0);
        $pdf->Cell(15, 5, $obj->numberFormat($total_quantity,2), 1, 0, 'R', 0);
        $pdf->Cell(15, 5, '', 1, 0, 'R', 0);
    }else{
        $pdf->Cell(101, 5, 'Total Quantity', 1, 0, 'R', 0);
        $pdf->Cell(14, 5, $obj->numberFormat($total_quantity,2), 1, 0, 'R', 0);
        $pdf->Cell(15, 5, '', 1, 0, 'R', 0);
    }


    $line_y = $pdf->GetY();

    $pdf->Line(10, $line_y, 110, $line_y);

    $pdf->SetFont('Arial', 'BU', 8);
    $pdf->SetX(10);

    $pdf->SetY($line_y);
    $pdf->SetX(90);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetY($line_y+5);
    $pdf->SetX(95);
    $pdf->Cell(50, 5,$company_name, 0, 1, 'L', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetY($line_y + 15);
    $pdf->SetX(95);
    $pdf->Cell(50, 5, 'Authorized Signatory', 0, 1, 'L', 0);

    $pdf->SetFont('Arial', '', 7);
    $pdf->SetX(10);
    $pdf->SetY($line_y);

    $pdf->Cell(130, 24, '', 1, 0, 'C');
    $pdf->OutPut('', $consumption_entry_number);
// }