<?php

	include("../include_user_check.php");

    
    $product_id = ""; $group_id = ""; $godown_id = ""; $unit_type = ""; $stock_type = "Consumption Entry"; $case_contains = "";
    $contractor_id = ""; $from = "";
    if(isset($_REQUEST['filter_group_id'])) {
        $group_id = $_REQUEST['filter_group_id'];
    }
    if(isset($_REQUEST['filter_godown_id'])) {
        $godown_id = $_REQUEST['filter_godown_id'];
    }
    if(isset($_REQUEST['filter_product_id'])) {
        $product_id = $_REQUEST['filter_product_id'];
    }
    if(isset($_REQUEST['filter_contractor_id'])) {
        $contractor_id = $_REQUEST['filter_contractor_id'];
    }

    if(isset($_REQUEST['unit_type'])) {
        $unit_type = $_REQUEST['unit_type'];
    }
    if(isset($_REQUEST['filter_contains'])) {
        $case_contains = $_REQUEST['filter_contains'];
    }
    if(empty($unit_type)) {
        $unit_type = "Unit";
    }

    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    $product_subunit_id = ""; $subunit_hide = 1;
    if(!empty($product_id)) {
        $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        if(empty($product_subunit_id) || $product_subunit_id == $GLOBALS['null_value']) {
            $subunit_hide = 0;
            $unit_type = "Unit";
        }
    }

    $total_records_list = array(); $contains_list = array();
    if(empty($product_id)) {
        $total_records_list = $obj->getConsumptionQtyList($group_id);
    }
    else if(!empty($product_id)) {
        if($subunit_hide == '1') {
            $contains_list = $obj->getStockContainsList($product_id);
        }
        $total_records_list = $obj->getStockReportList($group_id, $godown_id, '', $product_id, $stock_type, $case_contains, $contractor_id);
    }

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Consumption Report";
    include("rpt_header.php");
    
    $pdf->SetY($header_end);

    $bill_to_y = $pdf->GetY();

    $s_no = 1; $footer_height = 15; $height = 0; $l = 0; 
    $pdf->SetFont('Arial','B',8);
    if(empty($product_id)) {
        $total_stock = 0; $sno = 1;

        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        
        
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(190,7,'Consumption Report ',1,1,'C',0);
        $pdf->SetX(10);
        $pdf->Cell(20,10,'#',1,0,'C',0);
        $pdf->Cell(90,10,'Product',1,0,'C',0);
        $pdf->Cell(80,10,'Quantity',1,1,'C',0);
        $pdf->SetFont('Arial','',7);
        
        $y_axis=$pdf->GetY();

        $s_no = "1"; $total_stock = 0; $content_height = 0;
        if(!empty($total_stock)){
            $height -= 15;
            $footer_height += 15;
        }
        if(!empty($total_records_list)) {
            $total_quantity = 0;

            foreach($total_records_list as $key => $data) {
                $inward_unit = 0; $outward_unit = 0; $unit_name = ""; $subunit_name = ""; $outward_unit = 0; $outward_subunit = 0;
                $index = $key + 1; 
                if($pdf->GetY() > 270){
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(90,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(80,277-$y_axis,'',1,1,'C',0);

                    // $pdf->SetFont('Arial','B',10);
                    // $next_page = $pdf->PageNo() +1;
                    // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(285);
                    $pdf->SetX(10);
                    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;

                    $file_name="Consumption Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,'Consumption Report ',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(20,8,'#',1,0,'C',0);
                    $pdf->Cell(90,8,'Product',1,0,'C',0);
                    $pdf->Cell(80,8,'Quantity',1,1,'C',0);
                    $pdf->SetFont('Arial','',7);

                    $y_axis=$pdf->GetY();
                }

                $pdf->SetX(10);
                $pdf->Cell(20,6,$s_no,1,0,'C',0);
                
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                    $product_name = $obj->encode_decode('decrypt', $product_name);
                    $pdf->Cell(90,6,$product_name,1,0,'C',0);
                }
                else{
                    $pdf->Cell(90,6,' - ',1,0,'C',0);
                }

                $consumption_qty = []; $subunit_need = 0;
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $consumption_qty = $obj->getConsumptionQtyByProduct($data['product_id'], $unit_type);
                }
                
                if(!empty($consumption_qty)) {
                    $pdf->Cell(80,6, $consumption_qty['quantity'] . " " . $consumption_qty['unit_name'],1,1,'R',0);
                    $total_quantity += $consumption_qty['quantity'];
                }
                else {
                    $pdf->Cell(80,6,' - ',1,1,'R',0);
                }
                $s_no++;
            }

            $end_y = $pdf->GetY();

            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
        
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(90,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(80,270-$y_axis,'',1,1,'C',0);
        
                // $pdf->SetFont('Arial','B',9);
        
                // $next_page = $pdf->PageNo()+1;
        
                // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Consumption Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Consumption Report )',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'#',1,0,'C',0);
                $pdf->Cell(90,8,'Product',1,0,'C',0);
                $pdf->Cell(80,8,'Quantity',1,1,'C',0);
                $pdf->SetFont('Arial','',7);
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
                $pdf->SetY($content_height);
            } 
            else {
                
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
            }
            
            $pdf->SetFont('Arial','B',8);
        
            $pdf->SetX(10);
            $pdf->Cell(110,8,'Total',1,0,'R',0);
            if(!empty($total_quantity)){
                $pdf->SetX(120);
                $pdf->Cell(80,8,$total_quantity,1,1,'R',0);
            }
            else{
                $pdf->SetX(120);
                $pdf->Cell(80,8,' 0 ',1,1,'C',0);
            }

        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }
    else if(!empty($product_id)) {
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        
        
        $pdf->SetY($bill_to_y);
        
        $stock_unit_name = "";
        
        if($unit_type == "Unit") {
            $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_name');
            if($unit_name != $GLOBALS['null_value']) {
                $stock_unit_name = $obj->encode_decode('decrypt', $unit_name);
            }
        }
        else if($unit_type == "Subunit") {
            $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_name');
            if($unit_name != $GLOBALS['null_value']) {
                $stock_unit_name = $obj->encode_decode('decrypt', $unit_name);
            }
        }

        if(!empty($product_id)) {
            $product_name_code = "";
            $product_name_code = $obj->GetTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
        }

        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name_code),1,1,'C',0);
        if(!empty($contractor_id)) {
            $contractor_name = "";
            $contractor_name = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $contractor_id, 'name_mobile_city');
            if(!empty($contractor_name) && $contractor_name != $GLOBALS['null_value']) {
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Contractor - '.$obj->encode_decode('decrypt', $contractor_name),1,1,'C',0);
            }
        }

       
        $product_start_y = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Date', 1, 0, 'C', 0);
        $pdf->Cell(25, 10, 'Type ', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Remarks', 1, 0, 'C', 0);
        $pdf->Cell(35, 10, 'Contractor', 1, 0, 'C', 0);
        $pdf->Cell(30, 10, 'Godown', 1, 0, 'C', 0);
        // if($subunit_hide == '1') {
            $pdf->Cell(20,10,'Contains',1,0,'C',0);
        // }
        $pdf->Cell(30, 10, 'Quantity in ( '.$stock_unit_name.' )', 1, 1, 'C', 0);
        $start_y = $pdf->GetY();

        $y_axis = $pdf->GetY();

        $total_inward = 0; $total_outward = 0; $s_no='1'; $content_height = 0;
        if(!empty($total_inward) || !empty($total_outward)){
            $height -= 15;
            $footer_height += 15;
        }
        $pdf->SetFont('Arial','',7);

        if(!empty($total_records_list)) { 
            foreach($total_records_list as $data) {
                $inward_unit = 0; $outward_unit = 0; $unit_name = ""; $subunit_name = ""; $outward_unit = 0; $outward_subunit = 0;
                if($pdf->GetY() > 260){
                    
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->Cell(10,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(25,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(35,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(30,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(30,277-$y_axis,'',1,1,'C',0);
                    
                    // $pdf->SetFont('Arial','B',10);
                    // $next_page = $pdf->PageNo() +1;
                    // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(285);
                    $pdf->SetX(10);
                    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;
                    $file_name="Consumption Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name_code),1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Date', 1, 0, 'C', 0);
                    $pdf->Cell(25, 10, 'Type ', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Remarks', 1, 0, 'C', 0);
                    $pdf->Cell(35, 10, 'Contractor', 1, 0, 'C', 0);
                    $pdf->Cell(30, 10, 'Godown', 1, 0, 'C', 0);
                    // if($subunit_hide == '1') {
                        $pdf->Cell(20,10,'Contains',1,0,'C',0);
                    // }
                    $pdf->Cell(30, 10, 'Quantity in ( '.$stock_unit_name.' )', 1, 1, 'C', 0);
                    $start_y = $pdf->GetY();
                    $pdf->SetFont('Arial','',7);
                    $y_axis=$pdf->GetY();
                }
                $date_y = ""; $type_y = ""; $remarks_y = ""; $party_y = ""; $godown_y = ""; $case_y = ""; $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = "";$godown_room_y = "";

                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->MultiCell(10, 7, $s_no, 0, 'C', 0);
                
                if(!empty($data['stock_date'])) {
                    $stock_date = "";
                    $stock_date = date('d-m-Y', strtotime($data['stock_date']));
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(20, 7, $stock_date, 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(20, 7,'-', 0, 'C', 0);
                }

                $date_y = $pdf->GetY() - $start_y;

                
                if(!empty($data['stock_type'])) {
                    $stock_type = "";
                    $stock_type = $data['stock_type'];
                    $pdf->SetY($start_y);
                    $pdf->SetX(40);
                    $pdf->MultiCell(25, 7, $stock_type, 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(40);
                    $pdf->MultiCell(25, 7, '-', 0, 'C', 0);
                }

                $type_y = $pdf->GetY() - $start_y;

                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = "";
                    $remarks= $obj->encode_decode('decrypt', $data['remarks']);
                    $pdf->SetY($start_y);
                    $pdf->SetX(65);
                    $pdf->MultiCell(20, 7, $remarks, 0,  'C', 0);
                }
                else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(65);
                    $pdf->MultiCell(20, 7, '-', 0,  'C', 0);
                }

                $remarks_y = $pdf->GetY() - $start_y;

                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                    $pdf->SetY($start_y);
                    $pdf->SetX(85);
                    
                    $party_name = "";
                    $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $data['party_id'], 'name_mobile_city');          
                    $party_name = $obj->encode_decode('decrypt', $party_name);
                    $pdf->MultiCell(35, 7, $party_name, 0, 'C', 0);

                }
                else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(85);
                    $pdf->MultiCell(35, 7, '-', 0, 'C', 0);
                }

                $party_y = $pdf->GetY() - $start_y;
        
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$data['godown_id'],'godown_name');
                    $godown_name = $obj->encode_decode('decrypt', $godown_name);
                    $pdf->SetY($start_y);
                    $pdf->SetX(120);
                    $pdf->MultiCell(30, 7,  $godown_name, 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(120);
                    $pdf->MultiCell(30, 7, '-', 0, 'C', 0);
                }

                $godown_y = $pdf->GetY() - $start_y;

                // if($subunit_hide == '1') {

                    if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                        $pdf->SetY($start_y);
                        $pdf->SetX(150);
                        $pdf->MultiCell(20, 7,$data['case_contains'], 0, 'R', 0);
                    }
                    else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(150);
                        $pdf->MultiCell(20, 7, '-', 0,  'C', 0);
                    }
                // }
            
                $case_y = $pdf->GetY() - $start_y;
            
                $unit_name = "";
                if($unit_type == "Unit") {
                    if(!empty($product_id)) {
                        $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_id');

                        if(!empty($unit_id)) {
                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                            if(!empty($unit_name)) {
                                $unit_name = $obj->encode_decode('decrypt', $unit_name);
                            }
                        }
                    }
                } else {
                    $unit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
    
                    if(!empty($unit_id)) {
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode('decrypt', $unit_name);
                        }
                    }
                }

                if($unit_type == "Unit") {
                    if($data['outward_unit'] != $GLOBALS['null_value']) {
                        $total_outward += $data['outward_unit'];
                        $outward = $data['outward_unit'];
                        $pdf->SetY($start_y);
                        $pdf->SetX(170);
                        $pdf->MultiCell(30, 7, $outward . " " . $unit_name, 0,  'R', 0);
                    }else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(170);
                        $pdf->MultiCell(30, 7, '-', 0,  'R', 0);
                    }
                }
                else if($unit_type == "Subunit") {
                    if($data['outward_subunit'] != $GLOBALS['null_value']) {
                        $total_outward += $data['outward_subunit'];
                        $outward_subunit = $data['outward_subunit'];
                        $pdf->SetY($start_y);
                        $pdf->SetX(170);
                        $pdf->MultiCell(30, 7, $outward_subunit . " " . $unit_name, 0,  'R', 0);
                    }
                    else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(170);
                        $pdf->MultiCell(30, 7, '-', 0,  'R', 0);
                    }
                }

                $outward_y = $pdf->GetY() - $start_y;

                $max_y = max(array($date_y,$type_y,$remarks_y,$party_y,$godown_y,$case_y,$outward_y));

                $pdf->SetY($start_y);                            
                $pdf->SetX(10);
                $pdf->Cell(10,$max_y,'',1,0,'C',0);
                $pdf->Cell(20,$max_y,'',1,0,'C',0);
                $pdf->Cell(25,$max_y,'',1,0,'C',0);
                $pdf->Cell(20,$max_y,'',1,0,'C',0);
                $pdf->Cell(35,$max_y,'',1,0,'C',0);
                $pdf->Cell(30,$max_y,'',1,0,'C',0);
                $pdf->Cell(20,$max_y,'',1,0,'C',0);
                $pdf->Cell(30,$max_y,'',1,1,'C',0);

                $s_no++;
                $start_y = $pdf->GetY();

            }


            $end_y = $pdf->GetY();

            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
    
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(10,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(25,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(35,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(30,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(30,270 - $y_axis,'',1,1,'C');
                
                // $pdf->SetFont('Arial','B',9);
    
                // $next_page = $pdf->PageNo()+1;
        
                // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Consumption Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name_code). '  ( Quantity : '.$current_stock." ".$unit_name.  ')',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Date', 1, 0, 'C', 0);
                $pdf->Cell(25, 10, 'Type ', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Remarks', 1, 0, 'C', 0);
                $pdf->Cell(35, 10, 'Contractor', 1, 0, 'C', 0);
                $pdf->Cell(30, 10, 'Godown', 1, 0, 'C', 0);
                // if($subunit_hide == '1') {
                    $pdf->Cell(20,10,'Contains',1,0,'C',0);
                // }
                $pdf->Cell(30, 10, 'Quantity in ( '.$stock_unit_name.' )', 1, 1, 'C', 0);

                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(10,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(25,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(35,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,1,'C');
                $pdf->SetY($content_height);
            } 
            else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);                
                $pdf->Cell(10,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(25,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(35,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,1,'C');
            }

            
            $pdf->SetFont('Arial','B',7);
            $pdf->SetX(10);
            $pdf->Cell(160,8,'T0tal',1,0,'R',0);
            if(!empty($total_outward)){
                $pdf->Cell(30,8,$total_outward,1,1,'R',0);
            }
            else{
                $pdf->SetX(160);
                $pdf->Cell(30,8,' - ',1,1,'C',0);
            }
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }

    $pdf_name = "Consumption Report.pdf";
    $pdf->Output($from, $pdf_name);
?>