<?php

    include("../include_user_check.php");
    include("../include/number2words.php");

    $view_semifinished_inward_id = "";
    if (isset($_REQUEST['view_semifinished_inward_id'])) {
        $view_semifinished_inward_id = $_REQUEST['view_semifinished_inward_id'];
    } else {
        header("Location: ../semifinished_inward.php");
        exit;
    }


    $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d');
    $entry_date = date('Y-m-d'); $bill_number = ""; $entry_date = date('Y-m-d');
    $contractor_id = ""; $godown_id = ""; $contractor_name_mobile_city = ""; $dailyproduction_entry_number = "";
    $product_ids = array(); $product_names = array(); $unit_ids = array(); $unit_names = array(); $quantity = array();
    $total_amount = 0; $party_type = ""; $godown_id ="";
    $semifinished_inward_list = array();$factory_details =array();$factory_details1 =array(); $total_quantity = 0; $contractor_details = array();
    $party_details = array(); $outsourceparty_details = array(); $godown_details = array(); $godown_details = array(); 
    $quantity_values = array(); $company_name = "";  $godown_details = array();
    $case_contains = array();

    $company_logo = "";
    $company_logo = $obj->getTableColumnValue($GLOBALS['company_table'],'primary_company','1','logo');
    $cancelled = 0;

    if (!empty($view_semifinished_inward_id)) {
        $semifinished_inward_list = array();
        $semifinished_inward_list = $obj->getTableRecords($GLOBALS['semifinished_inward_table'], 'semifinished_inward_id', $view_semifinished_inward_id, '');
            
        if (!empty($semifinished_inward_list)) {
            foreach ($semifinished_inward_list as $data) {
                if(!empty($data['entry_date'])) {
                    $entry_date = date('Y-m-d', strtotime($data['entry_date']));
                }
                if(!empty($data['semifinished_inward_number']) && $data['semifinished_inward_number'] != $GLOBALS['null_value']) {
                    $dailyproduction_entry_number = $data['semifinished_inward_number'];
                }
                if(!empty($data['entry_date'])) {
                    $dailyproduction_entry_date = date('d-m-Y', strtotime($data['entry_date']));
                }
                if(!empty($data['party_type'])) {
                    $party_type = $data['party_type'];
                }
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_id = $data['godown_id'];
                }
                if(!empty($data['contractor_id']) && $data['contractor_id'] != $GLOBALS['null_value']) {
                    $contractor_id = $data['contractor_id'];
                }
                if(!empty($data['contractor_name_mobile_city']) && $data['contractor_name_mobile_city'] != $GLOBALS['null_value']) {
                    $contractor_name_mobile_city = $data['contractor_name_mobile_city'];
                }
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_count = count($product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_names = $data['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    $unit_names = array_reverse($unit_names);
                }
                if(!empty($data['subunit_contains']) && $data['subunit_contains'] != $GLOBALS['null_value']) {
                    $case_contains = $data['subunit_contains'];
                    $case_contains = explode(",", $case_contains);
                    $case_contains = array_reverse($case_contains);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity_values = $data['quantity'];
                    $quantity_values = explode(",", $quantity_values);
                    $quantity_values = array_reverse($quantity_values);
                }
                if(!empty($data['contractor_details']) && $data['contractor_details'] != $GLOBALS['null_value']) {
                    $contractor_details = $data['contractor_details'];
                    $contractor_details = $obj->encode_decode('decrypt',$contractor_details);
                    $contractor_details = explode("$$$", $contractor_details);
                }

                if(!empty($data['godown_details']) && $data['godown_details'] != $GLOBALS['null_value']) {
                    $godown_details = $data['godown_details'];
                    $godown_details = $obj->encode_decode('decrypt',$godown_details);
                    $godown_details = explode("$$$", $godown_details);
                }
                if(!empty($data['company_details']) && $data['company_details'] != $GLOBALS['null_value']) {
                    $company_details = $data['company_details'];
                    $company_details = $obj->encode_decode('decrypt',$company_details);
                    $company_details = explode("$$$", $company_details);
                }
                if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']){
                    $total_quantity = $data['total_quantity'];
                }

                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_amount = $data['total_amount'];
                }

                if($contractor_details != "NULL" && !empty($contractor_details)){
                    $party_details = $contractor_details;
                }

                // if($factory_details == "NULL" || empty($factory_details)){
                //     if($godown_details != "NULL" && !empty($godown_details)) {
                //         $company_details = $godown_details; 
                //     } else {
                //         if($godown_details != "NULL" && !empty($godown_details)) {

                //             $company_details = $godown_details; 
                //         } 
                //     }
                // } else {
                //     $company_details = $factory_details;
                // }

                if(!empty($company_details)){
                    for($n=0;$n<count($company_details);$n++){
                        if($company_details[0] != "NULL"){
                            $company_name = $company_details[0];
                        }
                    }
                }

                if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                    $cancelled = $data['cancelled'];
                }
            }
        }

        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A5');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Semi Finished Inward');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetY(5);
        $pdf->Cell(0, 5, 'Semi Finished Inward', 0, 0, 'C', 0);
        $pdf->SetFont('Arial', 'BI', 10);

        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',40,80,70,30);
                $pdf->SetAlpha(1);
            }
        }

        
        if(!empty($company_logo)) {
            if(file_exists('../include/images/upload/'.$company_logo)){
                $pdf->Image('../include/images/upload/'.$company_logo,15,15,20,20);
            }
        }

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        if(!empty($company_details)) {
            for($i=0; $i<count($company_details); $i++) {
                if($i==0) {
                    $pdf->SetFont("Arial", "B", 10);
                    $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
                } 
                else {
                    $pdf->SetFont("Arial", "", 8);
                    $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
                }
            }
        }

        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $y1 = $pdf->GetY();
        $pdf->SetY(10);
        $pdf->Cell(128, ($y1 - 10), '', 1, 1, 'L', 0);

        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(75);
        // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->Cell(74, 4, 'Contractor Details', 0, 1, 'L', 0);
        // $pdf->Cell(74, 4, '', 0, 1, 'L', 0);
        // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(80);

        if(!empty($contractor_details)) {
            for($i=0; $i<count($contractor_details); $i++) {
                if($i==0) {
                    $pdf->SetFont("Arial", "B", 10);
                    $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                } else {
                    $pdf->SetX(80);
                    $pdf->SetFont("Arial", "", 8);
                    if($contractor_details[$i] != "NULL"){
                        $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                    }
                }
            }
        } else {
            for($i = 0; $i < 3; $i++) {
                $pdf->SetX(80);
                $pdf->cell(60, 5, '', 0, 1, 'L', 0);
            }
        }

        $bill_to_y1 = $pdf->GetY();

        $pdf->SetY($bill_to_y);

        $godown_name = ""; $godown_details ="";
        
        if(!empty($godown_id)) {
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetX(12);
            $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
            $pdf->SetFont('Arial', 'B', 9);

            $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_name');
            $godown_details = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_details');
            if(!empty($godown_details)){
                $godown_details = $obj->encode_decode('decrypt',$godown_details);
                $godown_details = explode("$$$", $godown_details);
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
        $pdf->Cell(63, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

        // $pdf->SetY($bill_to_y1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(10);
        $pdf->Cell(65, 6, 'Entry No. : ' . $dailyproduction_entry_number, 1, 0, 'L');

        $pdf->SetX(75);
        $pdf->Cell(63, 6, 'Date : ' . $dailyproduction_entry_date, 1, 1, 'L'); 


        $header_height = $max_bill_y - 10;
        if ($header_height > 55) {
            $height -= ($header_height - 45);
        }
        $address_height = $max_bill_y - $bill_to_y;

        $starting_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);

        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
        $pdf->Cell(58, 7, 'Products', 1, 0, 'C', 0);
        $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 0);
        // $pdf->Cell(20, 7, 'Content', 1, 0, 'C', 0);
        $pdf->Cell(20, 7, 'Qty', 1, 1, 'C', 0);

        $pdf->SetFont('Arial', '', 8);

        $y_axis = $pdf->GetY();
        $s_no = 1;
        $net_amount = 0;
        $footer_height = 0;

        $footer_height += 25;
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0; $total_unit = 0; $total_subunit = 0;

        if (!empty($view_semifinished_inward_id) && !empty($product_ids)) {
            for ($p = 0; $p < count($product_ids); $p++) {
                if ($pdf->GetY() >= 180) {
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                
                    $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(58, 190 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(40, 190 - $y_axis, '', 1, 0, 'C', 0);
                    // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, 190 - $y_axis, '', 1, 1, 'C', 0);
                
                    $pdf->SetFont('Arial', 'B', 9);
                    $next_page = $pdf->PageNo() + 1;

                    $pdf->Cell(128, 5, 'Continued to Page Number ' . $next_page, 1, 1, 'R', 0);
                    $pdf->AddPage();
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $p + 1;
                    $pdf->SetTitle('Semi Finished Inward');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetY(5);
                    $pdf->Cell(0, 5, 'Semi Finished Inward', 0, 0, 'C', 0);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);

                    if(!empty($company_details)) {
                        for($i=0; $i<count($company_details); $i++) {
                            if($i==0) {
                                $pdf->SetFont("Arial", "B", 10);
                                $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
                            } else {
                                $pdf->SetFont("Arial", "", 8);
                                $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
                            }
                        }
                    }
                    
                    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $y1 = $pdf->GetY();
                    $pdf->SetY(10);
                    $pdf->Cell(128, ($y1 - 10), '', 1, 1, 'L', 0);
                    
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetX(75);
                    // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $pdf->Cell(74, 4, 'Contractor Details', 0, 1, 'L', 0);
                    // $pdf->Cell(74, 4, '', 0, 1, 'L', 0);
                    // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(80);

                    if(!empty($contractor_details)) {
                        for($i=0; $i<count($contractor_details); $i++) {
                            if($i==0) {
                                $pdf->SetFont("Arial", "B", 10);
                                $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                            } else {
                                $pdf->SetX(80);
                                $pdf->SetFont("Arial", "", 8);
                                if($contractor_details[$i] != "NULL"){
                                    $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                                }
                            }
                        }
                    } else {
                        for($i = 0; $i < 3; $i++) {
                            $pdf->SetX(80);
                            $pdf->cell(60, 5, '', 0, 1, 'L', 0);
                        }
                    }

                    $bill_to_y1 = $pdf->GetY();

                    $pdf->SetY($bill_to_y);

                    $godown_name = ""; $godown_details ="";
                    
                    if(!empty($godown_id)) {
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->SetX(12);
                        $pdf->Cell(50, 5, 'Godown Details', 0, 1, 'L', 0);
                        $pdf->SetFont('Arial', 'B', 9);

                        $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_name');
                        $godown_details = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_details');
                        if(!empty($godown_details)){
                            $godown_details = $obj->encode_decode('decrypt',$godown_details);
                            $godown_details = explode("$$$", $godown_details);
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
                    $pdf->Cell(63, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

                    // $pdf->SetY($bill_to_y1);

                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(10);
                    $pdf->Cell(65, 6, 'Entry No. : ' . $dailyproduction_entry_number, 1, 0, 'L');

                    $pdf->SetX(75);
                    $pdf->Cell(63, 6, 'Date : ' . $dailyproduction_entry_date, 1, 1, 'L'); 


                    $header_height = $max_bill_y - 10;
                    if ($header_height > 55) {
                        $height -= ($header_height - 45);
                    }
                    $address_height = $max_bill_y - $bill_to_y;

                    $starting_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetX(10);

                    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
                    $pdf->Cell(58, 7, 'Products', 1, 0, 'C', 0);
                    $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 0);
                    // $pdf->Cell(20, 7, 'Content', 1, 0, 'C', 0);
                    $pdf->Cell(20, 7, 'Qty', 1, 1, 'C', 0);
                    
                    $pdf->SetFont('Arial', '', 8);
                    $y_axis = $pdf->GetY();
                }

                $quantity_values[$p] = trim($quantity_values[$p]);
                $product_names[$p] = trim($product_names[$p]);
                $unit_names[$p] = trim($unit_names[$p]);
                if(!empty($case_contains[$p]) && $case_contains[$p] != $GLOBALS['null_value']){
                    $case_contains[$p] = trim($case_contains[$p]);
                }
            
                if (!empty($unit_names[$p])) {
                    $unit_names[$p] = $obj->encode_decode('decrypt', $unit_names[$p]);
                }

                $product_unit_id = "";
                $product_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$p], 'unit_id');
                $product_subunit_id = "";
                $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$p], 'subunit_id');
                $unit_type = ""; $product_qty = 0;
                if($unit_ids[$p] == $product_unit_id) {
                    $unit_type = 1; 
                }  else if ($unit_ids[$p] == $product_subunit_id) {
                    $unit_type = 2;
                } else {
                    $unit_type = ""; 
                }
                if($unit_type == 1) {
                    $total_unit += $quantity_values[$p];
                } else if($unit_type == 2) {
                    $total_subunit += $quantity_values[$p];
                }
            
                $y = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

                $content_display = "";
                if(!empty($case_contains[$p]) && $case_contains[$p] != $GLOBALS['null_value']) {                 
                    $content_display .= ' (' . $case_contains[$p];

                    if(!empty($product_subunit_id)) {
                        $subunit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $product_subunit_id, 'unit_name');

                        if(!empty($subunit_name)) {
                            $subunit_name = $obj->encode_decode('decrypt', $subunit_name);
                            $content_display .= " " . $subunit_name;
                        }
                    }

                    $content_display .= ')';
                }

                $pdf->SetY($y);
                $pdf->SetX(20);
                $pdf->MultiCell(58, 6, html_entity_decode($obj->encode_decode("decrypt", $product_names[$p])).$content_display, 0, 'L');
                $product_y = $pdf->GetY();

                $pdf->SetY($y);
                $pdf->SetX(78);
                $pdf->MultiCell(40, 6,$unit_names[$p], 0, 'C');
            
                // $pdf->SetY($y);
                // $pdf->SetX(98);
                // if(!empty($case_contains[$p]) && $case_contains[$p] != $GLOBALS['null_value']){
                //     $pdf->MultiCell(20, 6,$case_contains[$p], 0, 'R');
                // } else {
                //     $pdf->MultiCell(20, 6," - ", 0, 'R');
                // }

                $pdf->SetY($y);
                $pdf->SetX(118);
                $pdf->MultiCell(20, 6,$obj->numberFormat($quantity_values[$p],2)." ", 0, 'R');
            
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
            $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(58, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(40, 190 - $y_axis, '', 1, 0, 'C', 0);
            // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 190 - $y_axis, '', 1, 1, 'C', 0);
            $pdf->SetFont('Arial', 'B', 9);

            $next_page = $pdf->PageNo() + 1;

            $pdf->Cell(128, 5, 'Continued to Page Number ' . $next_page, 1, 1, 'R', 0);
            $pdf->AddPage();
            $pdf->SetTitle('Semi Finished Inward');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(5);
            $pdf->Cell(0, 5, 'Semi Finished Inward', 0, 0, 'C', 0);
            $pdf->SetFont('Arial', 'BI', 10);

            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
            
            if(!empty($company_details)) {
                for($i=0; $i<count($company_details); $i++) {
                    if($i==0) {
                        $pdf->SetFont("Arial", "B", 10);
                        $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
                    } else {
                        $pdf->SetFont("Arial", "", 8);
                        $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
                    }
                }
            }

            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $y1 = $pdf->GetY();
            $pdf->SetY(10);
            $pdf->Cell(128, ($y1 - 10), '', 1, 1, 'L', 0);

            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetX(75);
            // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->Cell(74, 4, 'Contractor Details', 0, 1, 'L', 0);
            // $pdf->Cell(74, 4, '', 0, 1, 'L', 0);
            // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(80);

            if(!empty($contractor_details)) {
                for($i=0; $i<count($contractor_details); $i++) {
                    if($i==0) {
                        $pdf->SetFont("Arial", "B", 10);
                        $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                    } else {
                        $pdf->SetX(80);
                        $pdf->SetFont("Arial", "", 8);
                        if($contractor_details[$i] != "NULL"){
                            $pdf->cell(60, 5, $contractor_details[$i], 0, 1, 'L', 0);
                        }
                    }
                }
            } else {
                for($i = 0; $i < 3; $i++) {
                    $pdf->SetX(80);
                    $pdf->cell(60, 5, '', 0, 1, 'L', 0);
                }
            }

            $bill_to_y1 = $pdf->GetY();
            $pdf->SetY($bill_to_y);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetX(75);
            $pdf->Cell(50, 4, 'Godown Details', 0, 1, 'L', 0);
            $pdf->SetFont('Arial', 'B', 9);

            if(!empty($godown_details)) {
                for($i=0; $i<count($godown_details); $i++) {
                    if($i==0) {
                        $pdf->SetX(80);
                        $pdf->SetFont("Arial", "B", 10);
                        $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                    } else {
                        $pdf->SetX(80);
                        $pdf->SetFont("Arial", "", 8);
                        if($godown_details[$i] != "NULL"){
                            $pdf->cell(60, 5, $godown_details[$i], 0, 1, 'L', 0);
                        }
                    }
                }
            }

            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1, $bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->cell(64, ($max_bill_y - $bill_to_y), '', 1, 0, 'L', 0);
            $pdf->SetX(74);
            $pdf->Cell(64, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            $pdf->Cell(64, 6, 'Entry No. : ' . $dailyproduction_entry_number, 1, 0, 'L');

            $pdf->SetY($bill_to_y1);
            $pdf->SetX(74);
            $pdf->Cell(64, 6, 'Date : ' . $dailyproduction_entry_date, 1, 1, 'L'); 

            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetX(10);

            $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 0);
            $pdf->Cell(58, 7, 'Products', 1, 0, 'C', 0);
            $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 0);
            // $pdf->Cell(20, 7, 'Content', 1, 0, 'C', 0);
            $pdf->Cell(20, 7, 'Qty', 1, 1, 'C', 0);
            
            $pdf->SetFont('Arial', '', 8);
            $y_axis = $pdf->GetY();
            $content_height = 204 - $footer_height;

            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(58, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(40, $content_height - $y_axis, '', 1, 0);
            // $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 1);
        
            $pdf->SetY($content_height);
        }

        $max_page = max($total_pages);
        // if ($max_page != 1) {
        //     $height += $address_height;
        // }

        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        $pdf->Cell(10, 100 + $height, '', 1, 0);
        $pdf->Cell(58, 100 + $height, '', 1, 0);
        $pdf->Cell(40, 100 + $height, '', 1, 0);
        // $pdf->Cell(20, 100 + $height, '', 1, 0);
        $pdf->Cell(20, 100 + $height, '', 1, 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);

        // $pdf->Cell(108, 5, 'Total', 1, 0, 'R', 0);
        // $pdf->Cell(20, 5, $obj->numberFormat($total_quantity,2), 1, 0, 'R', 0);
        $get_final_Y = $pdf->GetY();

        $pdf->Cell(68, 5, 'Total', 1, 0, 'R', 0);
        // $pdf->Cell(20, 5, $obj->numberFormat($total_quantity,2), 1, 0, 'R', 0);

        $pdf->SetFont('Arial','',8);
        $pdf->SetX(78);

        $unit_arrays = [];
        $unit_quantity = [];
        $sub_unit_arrays = [];
        $sub_unit_quantity = [];
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

        if(!empty($total_display)) {
            $pdf->MultiCell(60,5, $total_display,1,'R',0);
        } else {
            $pdf->MultiCell(60,5,"-",0,'C',0);
        }
            
        $get_total_y = $pdf->GetY();
        $pdf->SetX(78);
        $pdf->Cell(60,$get_final_Y - $get_total_y,'',1,0,'C',0);
        $line_y = $pdf->GetY();
        // $pdf->Line(10, $line_y, 110, $line_y);

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

        $pdf->Cell(128, 24, '', 1, 0, 'C');
        $pdf->OutPut('', $dailyproduction_entry_number);
    }