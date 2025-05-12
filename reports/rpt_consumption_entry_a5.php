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
$cancelled = 0;

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
                $godown_id = array_reverse($godown_id);
            }
            if(!empty($consumption_entry['product_id'])) {
                $product_id = explode(",", $consumption_entry['product_id']);
                $product_id = array_reverse($product_id);
            }
            if(!empty($consumption_entry['unit_type'])) {
                $unit_type = explode(",", $consumption_entry['unit_type']);
                $unit_type = array_reverse($unit_type);
            }
            if(!empty($consumption_entry['quantity'])) {
                $quantity = explode(",", $consumption_entry['quantity']);
                $quantity = array_reverse($quantity);

            }
            if(!empty($consumption_entry['content'])) {
                $consumption_content = explode(",", $consumption_entry['content']);
                $consumption_content = array_reverse($consumption_content);

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

            if(!empty($consumption_entry['cancelled'])) {
                $cancelled = $consumption_entry['cancelled'];
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

if($cancelled == '1') {
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
                $pdf->MultiCell(50, 7,html_entity_decode($company_details[$i]), 0, 'C');
                $rt = $pdf->gety();
            } else if (strpos($company_details[$i], "GST") !== false) {
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
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->SetX(10);
// $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
// $pdf->Cell(74, 4, 'Contractor Details', 0, 1, 'L', 0);
// $pdf->Cell(74, 4, '', 0, 1, 'L', 0);
// $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
// $pdf->SetFont('Arial', 'B', 9);
// $pdf->SetX(12);

// if(!empty($contractor_details)) {
//     for($i=0; $i<count($contractor_details); $i++) {
//         if($i==0) {
//             $pdf->SetFont("Arial", "B", 10);
//             $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
//         } else {
//             $pdf->SetX(12);
//             $pdf->SetFont("Arial", "", 8);
//             if($contractor_details[$i] != "NULL"){
//                 $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
//             }
//         }
//     }
// } else {
//     for($i = 0; $i < 3; $i++) {
//         $pdf->SetX(12);
//         $pdf->cell(60, 5, '', 0, 1, 'L', 0);
//     }
// }

$bill_to_y1 = $pdf->GetY();

$pdf->SetY($bill_to_y);

 
$godown_name = ""; $godown_details ="";
if(!empty($godown_id) && $godown_type == '1'){
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX(12);
    $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9);

    for($i = 0;$i <count($godown_id);$i++){
        $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_name');
        $godown_details = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_details');
        if(!empty($godown_details)){
            $godown_details = $obj->encode_decode('decrypt',$godown_details);
            $godown_details = explode("$$$", $godown_details);
        }

    }
    $pdf->SetX(12);
    // $pdf->cell(60, 5, html_entity_decode($obj->encode_decode("decrypt", $godown_details)), 0, 1, 'L', 0);
    if(!empty($godown_details)) {
        for($i=0; $i<count($godown_details); $i++) {
            if($i==0) {
                $pdf->SetFont("Arial", "B", 10);
                $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
            } else {
                $pdf->SetX(12);
                $pdf->SetFont("Arial", "", 8);
                if($godown_details[$i] != "NULL"){
                    $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                }
            }
        }
    }
}

$bill_to_y2 = $pdf->GetY();
    $y_array = array($bill_to_y1, $bill_to_y2);
    $max_bill_y = max($y_array);
    $pdf->SetY($bill_to_y);

    $pdf->SetX(10);
    $pdf->cell(65, ($max_bill_y - $bill_to_y), '', 1, 0, 'L', 0);

    $pdf->SetX(75);
    $pdf->Cell(65, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

// $pdf->SetY($bill_to_y1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(10);
$pdf->Cell(65, 6, 'Entry No. : ' . $consumption_entry_number, 1, 0, 'L');

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
    $pdf->Cell(45, 7, 'Product', 1, 0, 'C', 0);
    $pdf->Cell(20, 7, 'Type', 1, 0, 'C', 0);
    $pdf->Cell(20, 7, 'QTY', 1, 1, 'C', 0);
    // $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
} else {
    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
    $pdf->Cell(24, 7, 'Godown Name', 1, 0, 'C', 0);
    $pdf->Cell(24, 7, 'Product Group', 1, 0, 'C', 0);
    $pdf->Cell(38, 7, 'Product', 1, 0, 'C', 0);
    $pdf->Cell(15, 7, 'Type', 1, 0, 'C', 0);
    $pdf->Cell(19, 7, 'QTY', 1, 1, 'C', 0);
    // $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
}

$pdf->SetFont('Arial', '', 8);

$y_axis = $pdf->GetY();
$s_no = 1;
$net_amount = 0;
$footer_height = 0;

$footer_height += 25;
$total_pages = array(1);
$page_number = 1;
$last_count = 0; $total_unit = 0; $total_subunit = 0;

if (!empty($view_consumption_entry_id) && !empty($product_id)) {
    for ($p = 0; $p < count($product_id); $p++) {
        if ($pdf->GetY() >= 180) {
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            if(!empty($godown_id) && $godown_type == '1'){
                $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(35, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(45, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(20, 190 - $y_axis, '', 1, 1, 'C', 0);
                // $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);
            } else {
                $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(38, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(19, 190 - $y_axis, '', 1, 1, 'C', 0);
                // $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);
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
                        } else if (strpos($company_details[$i], "GST") !== false) {
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
            // $pdf->SetFont('Arial', 'B', 10);
            // $pdf->SetX(10);
            // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            // $pdf->Cell(74, 4, 'Contractor Details', 0, 1, 'L', 0);
            // $pdf->Cell(74, 4, '', 0, 1, 'L', 0);
            // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            // $pdf->SetFont('Arial', 'B', 9);
            // $pdf->SetX(12);
            
            // if(!empty($contractor_details)) {
            //     for($i=0; $i<count($contractor_details); $i++) {
            //         if($i==0) {
            //             $pdf->SetFont("Arial", "B", 10);
            //             $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
            //         } else {
            //             $pdf->SetX(12);
            //             $pdf->SetFont("Arial", "", 8);
            //             if($contractor_details[$i] != "NULL"){
            //                 $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
            //             }
            //         }
            //     }
            // } else {
            //     for($i = 0; $i < 3; $i++) {
            //         $pdf->SetX(12);
            //         $pdf->cell(60, 5, '', 0, 1, 'L', 0);
            //     }
            // }
            
            $bill_to_y1 = $pdf->GetY();
            
            $pdf->SetY($bill_to_y);
            
            if(!empty($godown_id) && $godown_type == '1'){
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetX(12);
                $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
                $pdf->SetFont('Arial', 'B', 9);
            
                for($i = 0;$i <count($godown_id);$i++){
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_name');
                }
                $pdf->SetX(12);
                // $pdf->cell(60, 5, html_entity_decode($obj->encode_decode("decrypt", $godown_name)), 0, 1, 'L', 0);
                if(!empty($godown_details)) {
                    for($i=0; $i<count($godown_details); $i++) {
                        if($i==0) {
                            $pdf->SetFont("Arial", "B", 10);
                            $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                        } else {
                            $pdf->SetX(12);
                            $pdf->SetFont("Arial", "", 8);
                            if($godown_details[$i] != "NULL"){
                                $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                            }
                        }
                    }
                }
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
                $pdf->Cell(45, 7, 'Product', 1, 0, 'C', 0);
                $pdf->Cell(20, 7, 'Type', 1, 0, 'C', 0);
                $pdf->Cell(20, 7, 'QTY', 1, 1, 'C', 0);
                // $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
            } else {
                $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
                $pdf->Cell(24, 7, 'Godown Name', 1, 0, 'C', 0);
                $pdf->Cell(24, 7, 'Product Group', 1, 0, 'C', 0);
                $pdf->Cell(38, 7, 'Product', 1, 0, 'C', 0);
                $pdf->Cell(15, 7, 'Type', 1, 0, 'C', 0);
                $pdf->Cell(19, 7, 'QTY', 1, 1, 'C', 0);
                // $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
            }
            
            $pdf->SetFont('Arial', '', 8);
            $y_axis = $pdf->GetY();
        }

        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$p], '');
        $subunit_id = "";
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
                if(!empty($P_list['subunit_id'])) {
                    $subunit_id = $P_list['subunit_id'];
                }
                if(!empty($P_list['unit_name'])) {
                    $unit_name = $P_list['unit_name'];
                }
                if(!empty($P_list['subunit_name'])) {
                    $subunit_name = $P_list['subunit_name'];
                }
            }
        }

        $quantity[$p] = trim($quantity[$p]);
        if($unit_type[$p] == 1) {
            $total_unit += $quantity[$p];
        } else if($unit_type[$p] == 2) {
            $total_subunit += $quantity[$p];
            $unit_name = $subunit_name;
        }
        // $consumption_content[$p] = trim($consumption_content[$p]);

        $content_display = "";
        if(!empty($consumption_content) && $consumption_content[$p] != $GLOBALS['null_value']) {
            $content_display .= ' (' . $consumption_content[$p];

            if(!empty($subunit_id)) {
                $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $subunit_id, 'unit_name');

                if(!empty($subunit_name)) {
                    $subunit_name = $obj->encode_decode('decrypt', $subunit_name);
                    $content_display .= " " . $subunit_name;
                }
            }

            $content_display .= ')';
        }

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
            $pdf->MultiCell(45, 6, html_entity_decode($obj->encode_decode("decrypt", $product_name).$content_display), 0, 'L');
            $product_y = $pdf->GetY();

            $pdf->SetY($y);
            $pdf->SetX(100);
            $pdf->MultiCell(20, 6,html_entity_decode($obj->encode_decode("decrypt", $unit_name)), 0, 'C');
            
            $pdf->SetY($y);
            $pdf->SetX(120);
            $pdf->MultiCell(20, 6,$obj->numberFormat($quantity[$p],2)." ", 0, 'R');

            // $pdf->SetY($y);
            // $pdf->SetX(120);
            // if(!empty($consumption_content) && $consumption_content[$p] != $GLOBALS['null_value']){
            //     $pdf->MultiCell(15, 6,$consumption_content[$p], 0, 'R');
            // } else {
            //     $pdf->MultiCell(15, 6," - ", 0, 'R');
            // }
        } else {
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
            $pdf->MultiCell(38, 6, html_entity_decode($obj->encode_decode("decrypt", $product_name). $content_display), 0, 'L');
            $product_y = $pdf->GetY();

            $pdf->SetY($y);
            $pdf->SetX(106);
            $pdf->MultiCell(15, 6,html_entity_decode($obj->encode_decode("decrypt", $unit_name)), 0, 'C');
            
            $pdf->SetY($y);
            $pdf->SetX(121);
            $pdf->MultiCell(19, 6,$obj->numberFormat($quantity[$p],2)." ", 0, 'R');
            

            // $pdf->SetY($y);
            // $pdf->SetX(120);
            // if(!empty($consumption_content) && $consumption_content[$p] != $GLOBALS['null_value']){
            //     $pdf->MultiCell(15, 6,$consumption_content[$p], 0, 'R');
            // } else {
            //     $pdf->MultiCell(15, 6," - ", 0, 'R');
            // }
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
        $pdf->Cell(45, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(20, 190 - $y_axis, '', 1, 1, 'C', 0);
        // $pdf->Cell(15, 190 - $y_axis, '', 1, 1, 'C', 0);
    } else {
        $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(38, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(14, 190 - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(19, 190 - $y_axis, '', 1, 1, 'C', 0);
    }
   
    $pdf->SetFont('Arial', 'B', 9);
    $next_page = $pdf->PageNo() + 1;

    $pdf->Cell(130, 5, 'Continued to Page Number ' . $next_page, 1, 1, 'R', 0);
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
                } else if (strpos($company_details[$i], "GST") !== false) {
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
    // $pdf->SetFont('Arial', 'B', 10);
    // $pdf->SetX(10);
    // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    // $pdf->Cell(74, 4, 'Contractor Details', 0, 1, 'L', 0);
    // $pdf->Cell(74, 4, '', 0, 1, 'L', 0);
    // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
    // $pdf->SetFont('Arial', 'B', 9);
    // $pdf->SetX(12);

    // if(!empty($contractor_details)) {
    //     for($i=0; $i<count($contractor_details); $i++) {
    //         if($i==0) {
    //             $pdf->SetFont("Arial", "B", 10);
    //             $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
    //         } else {
    //             $pdf->SetX(12);
    //             $pdf->SetFont("Arial", "", 8);
    //             if($contractor_details[$i] != "NULL"){
    //                 $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
    //             }
    //         }
    //     }
    // } else {
    //     for($i = 0; $i < 3; $i++) {
    //         $pdf->SetX(12);
    //         $pdf->cell(60, 5, '', 0, 1, 'L', 0);
    //     }
    // }
    
    $bill_to_y1 = $pdf->GetY();
    $pdf->SetY($bill_to_y);
    
    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(12);
        $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
        $pdf->SetFont('Arial', 'B', 9);

        for($i = 0;$i <count($godown_id);$i++){
            $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id[$i],'godown_name');
        }
        $pdf->SetX(12);
        // $pdf->cell(60, 5, html_entity_decode($obj->encode_decode("decrypt", $godown_name)), 0, 1, 'L', 0);
        if(!empty($godown_details)) {
            for($i=0; $i<count($godown_details); $i++) {
                if($i==0) {
                    $pdf->SetFont("Arial", "B", 10);
                    $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                } else {
                    $pdf->SetX(12);
                    $pdf->SetFont("Arial", "", 8);
                    if($godown_details[$i] != "NULL"){
                        $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                    }
                }
            }
        }
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
        $pdf->Cell(45, 7, 'Product', 1, 0, 'C', 0);
        $pdf->Cell(20, 7, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(20, 7, 'QTY', 1, 1, 'C', 0);
        // $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
    } else {
        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
        $pdf->Cell(24, 7, 'Godown Name', 1, 0, 'C', 0);
        $pdf->Cell(24, 7, 'Product Group', 1, 0, 'C', 0);
        $pdf->Cell(38, 7, 'Product', 1, 0, 'C', 0);
        $pdf->Cell(15, 7, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(19, 7, 'QTY', 1, 1, 'C', 0);
        // $pdf->Cell(15, 7, 'Content', 1, 1, 'C', 0);
    }
    
    $pdf->SetFont('Arial', '', 8);

    $y_axis = $pdf->GetY();
    $content_height = 204 - $footer_height;

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    
    if(!empty($godown_id) && $godown_type == '1'){
        $pdf->Cell(10, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(45, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 1, 'C', 0);
        // $pdf->Cell(15, $content_height - $y_axis, '', 1, 1, 'C', 0);
    } else {
        $pdf->Cell(10, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(24, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(38, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 0, 'C', 0);
        $pdf->Cell(19, $content_height - $y_axis, '', 1, 0, 'C', 0);
        // $pdf->Cell(15, $content_height - $y_axis, '', 1, 1, 'C', 0);
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
    $pdf->Cell(10, 100 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(35, 100 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(45, 100 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(20, 100 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(20, 100 + $height, '', 1, 1, 'C', 0);
    // $pdf->Cell(15, 100 + $height, '', 1, 1, 'C', 0);
} else {
    $pdf->Cell(10, 115 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(24, 115 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(24, 115 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(38, 115 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(15, 115 + $height, '', 1, 0, 'C', 0);
    $pdf->Cell(19, 115 + $height, '', 1, 1, 'C', 0);
    // $pdf->Cell(15, 115 + $height, '', 1, 1, 'C', 0);

}

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(10);
$get_final_Y = $pdf->GetY();

$unit_arrays = [];
$unit_quantity = [];
$sub_unit_arrays = [];
$sub_unit_quantity = [];
for($i = 0; $i < count($product_id); $i++) {
    $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');

    foreach($product_list as $product) {
        if(!empty($product['unit_id'])) {
            if($unit_type[$i] == "1") {
                $unit_arrays[] = $product['unit_id'];
                $unit_quantity[] = $quantity[$i];
            } else if($unit_type[$i] == "2") {
                $sub_unit_arrays[] = $product['subunit_id'];
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

if(!empty($godown_id) && $godown_type == '1'){
    $pdf->Cell(90, 5, 'Total Quantity', 1, 0, 'R', 0);
    // $pdf->Cell(15, 5, $obj->numberFormat($total_quantity,2), 1, 0, 'R', 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetX(100);

    if(!empty($total_display)) {
        $pdf->MultiCell(40,5,$total_display,0,'R',0);
    } else {
        $pdf->MultiCell(40,5,"-",0,'C',0);
    }
        
    $get_total_y = $pdf->GetY();

    $pdf->SetX(100);
    $pdf->Cell(40,$get_final_Y - $get_total_y,'',1,0,'C',0);
} else {
    $pdf->Cell(96, 5, 'Total Quantity', 1, 0, 'R', 0);
    // $pdf->Cell(14, 5, $obj->numberFormat($total_quantity,2), 1, 0, 'R', 0);
    // $pdf->Cell(15, 5, '', 1, 0, 'R', 0);
    $pdf->SetFont('Arial','',8);
    $pdf->SetX(106);

    if(!empty($total_display)) {
        $pdf->MultiCell(34,5,$total_display,0,'R',0);
    } else {
        $pdf->MultiCell(34,5,"-",0,'C',0);
    }
        
    $get_total_y = $pdf->GetY();

    $pdf->SetX(106);
    $pdf->Cell(34,$get_final_Y - $get_total_y,'',1,0,'C',0);
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
$pdf->MultiCell(50, 5,html_entity_decode($company_name), 0, 'L', 0);
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