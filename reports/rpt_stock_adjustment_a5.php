<?php

    include("../include_user_check.php");
    include("../include/number2words.php");

    $view_stock_adjustment_id = "";
    if (isset($_REQUEST['view_stock_adjustment_id'])) {
        $view_stock_adjustment_id = $_REQUEST['view_stock_adjustment_id'];
    } else {
        header("Location: ../stock_adjustment.php");
        exit;
    }


    $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d');
    $bill_number = ""; $stock_adjustment_date = date('Y-m-d');
    $stock_adjustment_number = "";
    $product_ids = array(); $product_names = array(); $unit_ids = array(); $unit_names = array(); $quantity = array();
    $total_amount = 0;  $stock_adjustment_list = array(); $location_ids =array(); $brand_ids =array(); $total_quantity = 0; $location_names = array();
    $quantity_values = array(); $company_name = "";  $stock_action = ""; $remarks = ""; $group_name = array(); $case_contains_values = array(); $total_case_contains = 0; $cancelled = 0;

    if (!empty($view_stock_adjustment_id)) {
        $stock_adjustment_list = array();
        $stock_adjustment_list = $obj->getTableRecords($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $view_stock_adjustment_id, '');
                
        if (!empty($stock_adjustment_list)) {
            foreach ($stock_adjustment_list as $data) {
                if(!empty($data['entry_date'])) {
                    $stock_adjustment_date = date('Y-m-d', strtotime($data['entry_date']));
                }
                if(!empty($data['stock_adjustment_number']) && $data['stock_adjustment_number'] != $GLOBALS['null_value']) {
                    $stock_adjustment_number = $data['stock_adjustment_number'];
                }
                if(!empty($data['entry_date'])) {
                    $entry_date = date('Y-m-d', strtotime($data['entry_date']));
                }
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $location_ids = $data['godown_id'];
                    $location_ids = explode(",", $location_ids);
                    $location_ids = array_reverse($location_ids);
                }
                if(!empty($data['brand_id']) && $data['brand_id'] != $GLOBALS['null_value']) {
                    $brand_ids = $data['brand_id'];
                    $brand_ids = explode(",", $brand_ids);
                    $brand_ids = array_reverse($brand_ids);
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
                if(!empty($data['unit_type']) && $data['unit_type'] != $GLOBALS['null_value']) {
                    $unit_types = $data['unit_type'];
                    $unit_types = explode(",", $unit_types);
                    $unit_types = array_reverse($unit_types);
                }
                if(!empty($data['location_name']) && $data['location_name'] != $GLOBALS['null_value']) {
                    $location_names = $data['location_name'];
                    $location_names = explode(",", $location_names);
                    $location_names = array_reverse($location_names);
                }
                if(!empty($data['group_name']) && $data['group_name'] != $GLOBALS['null_value']) {
                    $group_name = $data['group_name'];
                    $group_name = explode(",", $group_name);
                    $group_name = array_reverse($group_name);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity_values = $data['quantity'];
                    $quantity_values = explode(",", $quantity_values);
                    $quantity_values = array_reverse($quantity_values);
                }
            
                if(!empty($data['content']) && $data['content'] != $GLOBALS['null_value']) {
                    $case_contains_values = $data['content'];
                    $case_contains_values = explode(",", $case_contains_values);
                    $case_contains_values = array_reverse($case_contains_values);
                }

                if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']){
                    $total_quantity = $data['total_quantity'];
                }

                if(!empty($data['stock_action']) && $data['stock_action'] != $GLOBALS['null_value']) {
                    $stock_action = $data['stock_action'];
                    $stock_action = explode(",", $stock_action);
                    $stock_action = array_reverse($stock_action);
                }
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $data['remarks'];
                    $remarks = $obj->encode_decode('decrypt', $remarks);
                }

                if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                    $cancelled = $data['cancelled'];
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

        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = html_entity_decode($obj->encode_decode('decrypt', $company_name));
        }

        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Stock Adjustment Entry');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Stock Adjustment";
        include("rpt_header.php");
        if($cancelled == '0'){
            include("rpt_watermark.php");
        }

        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                $pdf->SetAlpha(1);
            }
        }

        // if(!empty($company_details)) {
        //     for($i=0; $i<count($company_details); $i++) {
        //         if($i==0) {
        //             $pdf->SetFont("Arial", "B", 11);
        //             $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
        //         } 
        //         else {
        //             $pdf->SetFont("Arial", "", 8);
        //             $pdf->cell(0, 4, $company_details[$i], 0, 1, 'C', 0);
        //         }
        //     }
        // }

        // $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        // $y1 = $pdf->GetY();
        // $pdf->SetY(10);
        // $pdf->Cell(190, ($y1 - 10), '', 1, 1, 'L', 0);

        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(10);
        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->Cell(90, 4, 'Stock Adjustment Date : ', 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(50);
        $pdf->Cell(20, 4,date('d-m-Y',strtotime($stock_adjustment_date)), 0, 1, 'L', 0);
        $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(12);
        $bill_to_y1 = $pdf->GetY();

        $pdf->SetY($bill_to_y);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 1, '', 0, 1, 'C', 0);
        $pdf->SetFont('Arial', '', 9);

        $pdf->SetX(110);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(95, 4, 'Stock Adjustment No : ', 0, 0, 'L', 0);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(145);
        $pdf->Cell(20, 4, $stock_adjustment_number, 0, 1, 'L', 0);
        $bill_to_y2 = $pdf->GetY();
        $y_array = array($bill_to_y1, $bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

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
        $pdf->Cell(30, 7, 'Location', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'Group', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'Unit', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'Contains', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'Stock Action', 1, 1, 'C', 1);
        $pdf->SetTextColor(0,0,0);
        
        $pdf->SetFont('Arial', '', 8);
        $product_y = $pdf->GetY();

        $y_axis = $pdf->GetY();
        $s_no = 1;
        $net_amount = 0;
        $footer_height = 0;

        $footer_height += 25;
        $total_pages = array(1); $total_unit = 0; $total_subunit = 0;
        $page_number = 1;
        $last_count = 0;

        if (!empty($view_stock_adjustment_id) && !empty($product_ids)) {
            for ($p = 0; $p < count($product_ids); $p++) {
                if ($pdf->GetY() >= 265) {
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                
                    $pdf->Cell(10, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(40, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(30, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(30, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, 277 - $y_axis, '', 1, 0, 'C', 0);
                    $pdf->Cell(20, 277 - $y_axis, '', 1, 1, 'C', 0);
                    
                    $pdf->SetFont('Arial', 'B', 9);
                    $next_page = $pdf->PageNo() + 1;
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);

                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $p + 1;
                    $pdf->SetTitle('Stock Adjustment Entry');
                    $pdf->SetFont('Arial', 'B', 10);
                    // $pdf->SetY(5);
                    // $pdf->Cell(0, 5, 'Stock Adjustment Entry', 0, 0, 'C', 0);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);
            
                    $file_name="Stock Adjustment";
                    include("rpt_header.php");
                    if($cancelled == '0'){
                        include("rpt_watermark.php");
                    }
                    if($cancelled == '1') {
                        if(file_exists('../include/images/cancelled.jpg')) {
                            $pdf->SetAlpha(0.3);
                            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                            $pdf->SetAlpha(1);
                        }
                    }

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(10);
                    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $pdf->Cell(90, 4, 'Stock Adjustment Date : ', 0, 0, 'L', 0);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(50);
                    $pdf->Cell(20, 4, date('d-m-Y',strtotime($stock_adjustment_date)), 0, 1, 'L', 0);
                    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);
        
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(12);

                    $bill_to_y1 = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetFont('Arial', 'B', 10);

                    $pdf->Cell(0, 1, '', 0, 1, 'C', 0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetX(110);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(95, 4, 'Stock Adjustment No : ', 0, 0, 'L', 0);

                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetX(145);
                    $pdf->Cell(20, 4, $stock_adjustment_number, 0, 1, 'L', 0);

                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($bill_to_y1, $bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

                    $starting_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
                    $pdf->Cell(40, 7, 'Products', 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, 'Location', 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, 'Group', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'Unit', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'Contains', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'Stock Action', 1, 1, 'C', 1);
                    $pdf->SetTextColor(0,0,0);
                    
                    $pdf->SetFont('Arial', '', 8);
                    $product_y = $pdf->GetY();
                }

                $quantity_values[$p] = trim($quantity_values[$p]);
                if(!empty($case_contains_values[$p]) && $case_contains_values[$p] != $GLOBALS['null_value']){
                $case_contains_values[$p] = trim($case_contains_values[$p]);
                }
                $product_names[$p] = trim($product_names[$p]);
                $location_names[$p] = trim($location_names[$p]);
                $group_name[$p] = trim($group_name[$p]);
                $unit_names[$p] = trim($unit_names[$p]);
                $stock_action[$p] = trim($stock_action[$p]);
                if(!empty($case_contains_values[$p] && $case_contains_values[$p] != $GLOBALS['null_value'])){
                $total_case_contains += $case_contains_values[$p]; 
                }
                if(!empty($stock_action[$p])){
                    if($stock_action[$p] == "1"){
                        $stock_action[$p] = "Plus";
                    } else if ($stock_action[$p] == "2"){
                        $stock_action[$p] = "Minus";
                    }
                }
            
                if (!empty($unit_names[$p])) {
                    $unit_names[$p] = $obj->encode_decode('decrypt', $unit_names[$p]);
                }
            
                if($unit_types[$p] == 1) {
                    $total_unit += $quantity_values[$p];
                } else if($unit_types[$p] == 2) {
                    $total_subunit += $quantity_values[$p];
                }
                $y = $pdf->GetY();
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

                $pdf->SetY($product_y);
                $pdf->SetX(20);
                $pdf->MultiCell(40, 6, html_entity_decode($obj->encode_decode("decrypt", $product_names[$p])), 0, 'L');
                $name_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                $pdf->SetX(60);
                $pdf->MultiCell(30, 6, html_entity_decode($obj->encode_decode("decrypt", $location_names[$p])), 0, 'L');
                $godown_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                $pdf->SetX(90);
                $pdf->MultiCell(30, 6, html_entity_decode($obj->encode_decode("decrypt", $group_name[$p])), 0, 'L');
                $brand_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                $pdf->SetX(120);
                $pdf->MultiCell(20, 6,$unit_names[$p], 0, 'C');
                $unit_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                $pdf->SetX(140);
                if(!empty($case_contains_values[$p]) && $case_contains_values[$p] != $GLOBALS['null_value']){
                    $pdf->MultiCell(20, 6,$case_contains_values[$p], 0, 'R');
                } else {
                    $pdf->MultiCell(20, 6, '-', 0, 'R');
                }
                $contains_y = $pdf->GetY() - $product_y;
                
                $pdf->SetY($product_y);
                $pdf->SetX(160);
                $pdf->MultiCell(20, 6,$quantity_values[$p], 0, 'R');
                $qty_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                $pdf->SetX(180);
                $pdf->MultiCell(20, 6,$stock_action[$p], 1, 'C');
                $amt_y = $pdf->GetY() - $product_y;
                
                $y_array = array($name_y, $godown_y, $brand_y, $unit_y, $qty_y, $amt_y);
                $product_max = max($y_array);

                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$product_max,'',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(40,$product_max,'',1,0,'C');
                $pdf->SetX(60);
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->SetX(90);
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->SetX(120);
                $pdf->Cell(20,$product_max,'',1,0,'C');
                $pdf->SetX(140);
                $pdf->Cell(20,$product_max,'',1,0,'C');
                $pdf->SetX(160);
                $pdf->Cell(20,$product_max,'',1,0,'C');
                $pdf->SetX(180);
                $pdf->Cell(20,$product_max,'',1,1,'C');

                $product_y += $product_max;
                $s_no++;
            }
        }
        $end_y = $pdf->GetY();

        $last_page_count = $s_no - $last_count;

        if (($footer_height + $end_y) > 270) {
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
        
            $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(40, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 1, 'C', 0);
    
            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $pdf->SetTitle('Stock Adjustment Entry');
            $pdf->SetFont('Arial', 'B', 10);
            // $pdf->SetY(5);
            // $pdf->Cell(0, 5, 'Stock Adjustment Entry', 0, 0, 'C', 0);
            $pdf->SetFont('Arial', 'BI', 10);
        
            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
            
            $file_name="Stock Adjustment";
            include("rpt_header.php");
            if($cancelled == '0'){
                include("rpt_watermark.php");
            }
            if($cancelled == '1') {
                if(file_exists('../include/images/cancelled.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                    $pdf->SetAlpha(1);
                }
            }
            
            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->Cell(90, 4, 'Stock Adjustment Date : ', 0, 0, 'L', 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(50);
            $pdf->Cell(20, 4, date('d-m-Y',strtotime($stock_adjustment_date)), 0, 1, 'L', 0);
            $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(12);
            $bill_to_y1 = $pdf->GetY();
            $pdf->SetY($bill_to_y);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 1, '', 0, 1, 'C', 0);
            $pdf->SetFont('Arial', '', 10);

            $pdf->SetX(110);
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(95, 4, 'Stock Adjustment No : ', 0, 0, 'L', 0);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetX(145);
            $pdf->Cell(20, 4, $stock_adjustment_number, 0, 1, 'L', 0);

            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1, $bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetX(10);
            $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
            $pdf->Cell(40, 7, 'Products', 1, 0, 'C', 1);
            $pdf->Cell(30, 7, 'Location', 1, 0, 'C', 1);
            $pdf->Cell(30, 7, 'Group', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Unit', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Contains', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Stock Action', 1, 1, 'C', 1);
            $pdf->SetTextColor(0,0,0);
            
            $pdf->SetFont('Arial', '', 8);

            $y_axis = $pdf->GetY();
            $content_height = 270 - $footer_height;

            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(40, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 1);
        
            $pdf->SetY($content_height);
        }

        $max_page = max($total_pages);
        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        $pdf->Cell(10, 200 + $height, '', 1, 0);
        $pdf->Cell(40, 200 + $height, '', 1, 0);
        $pdf->Cell(30, 200 + $height, '', 1, 0);
        $pdf->Cell(30, 200 + $height, '', 1, 0);
        $pdf->Cell(20, 200 + $height, '', 1, 0);
        $pdf->Cell(20, 200 + $height, '', 1, 0);
        $pdf->Cell(20, 200 + $height, '', 1, 0);
        $pdf->Cell(20, 200 + $height, '', 1, 1);
            
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);

        $get_final_Y = $pdf->GetY();
        $pdf->Cell(150, 5, 'Total', 1, 0, 'R', 0);
        // $pdf->Cell(20, 5, $total_quantity." ", 1, 0, 'R', 0);
        $pdf->SetFont('Arial','',8);
        $pdf->SetX(160);

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
            $pdf->MultiCell(40,5, $total_display,0,'R',0);
        } else {
            $pdf->MultiCell(40,5,"-",0,'R',0);
        }
        
        $get_total_y = $pdf->GetY();
        $pdf->SetX(90);
        $pdf->Cell(50,$get_final_Y - $get_total_y,'',1,0,'C',0);
        // $pdf->Cell(20, 5, '', 1, 1, 'R', 0);
 
        $line_y = $pdf->GetY();
        $pdf->Line(10, $line_y, 200, $line_y);
        $pdf->SetFont('Arial', 'BU', 8);
        $pdf->SetX(10);

        $pdf->SetY($line_y);
        $pdf->SetX(155);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y+2);
        $pdf->SetX(150);
        $pdf->MultiCell(50, 5,html_entity_decode($company_name), 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);

        $pdf->SetY(-15);
        $pdf->SetX(155);
        $pdf->Cell(90, 5, 'Authorized Signatory', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y);
        $pdf->SetX(10);
        $pdf->MultiCell(140,5,'Remarks : '.$remarks,0,'L');

        $pdf->SetFont('Arial', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(190, 277, '', 1, 0, 'C');

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(287);
        // $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        $pdf->OutPut('', $stock_adjustment_number);
    }
