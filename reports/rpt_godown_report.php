<?php

	include("../include_user_check.php");

    
    $party_id = ""; $from = ""; $brand_id = "";
    $product_id = ""; $group_id = ""; $godown_id = ""; $unit_type = ""; $stock_type = ""; $case_contains = "";
    if(isset($_REQUEST['filter_group_id'])) {
        $group_id = $_REQUEST['filter_group_id'];
    }
    if(isset($_REQUEST['filter_godown_id'])) {
        $godown_id = $_REQUEST['filter_godown_id'];
    }
    if(isset($_REQUEST['filter_product_id'])) {
        $product_id = $_REQUEST['filter_product_id'];
    }
    if(isset($_REQUEST['unit_type'])) {
        $unit_type = $_REQUEST['unit_type'];
    }
    if(isset($_REQUEST['stock_type'])) {
        $stock_type = $_REQUEST['stock_type'];
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

    $group_list = array();
    $group_list = $obj->getGroupList('1');

    $product_list = array();
    if(!empty($group_id)) {
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'group_id', $group_id, '');
    }
    else {
        $product_list = $obj->getProducts('1');
    }

    $godown_list = array();
    $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');

    $product_subunit_id = ""; $subunit_hide = 1;
    if(!empty($product_id)) {
        $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        if(empty($product_subunit_id) || $product_subunit_id == $GLOBALS['null_value']) {
            $subunit_hide = 0;
        }
    }

    $total_records_list = array(); $contains_list = array();
    if(empty($product_id)) {
        $total_records_list = $product_list;
    }
    else if(!empty($product_id)) {
        if($subunit_hide == '1') {
            $contains_list = $obj->getStockContainsList($product_id);
        }
        $total_records_list = $obj->getStockReportList($group_id, $godown_id, '', $product_id, $stock_type, $case_contains, '');
    }


    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Godown Report";
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
        $pdf->Cell(190,7,'Godown Report ',1,1,'C',0);
        $pdf->SetX(10);
        $pdf->Cell(20,8,'#',1,0,'C',0);
        $pdf->Cell(90,8,'Product',1,0,'C',0);
        $pdf->Cell(80,8,'Current Stock',1,1,'C',0);
        $pdf->SetFont('Arial','',7);
        
        $y_axis=$pdf->GetY();

        $s_no = "1"; $total_stock = 0; $content_height = 0;
        if(!empty($total_stock)){
            $height -= 15;
            $footer_height += 15;
        }
        if(!empty($total_records_list)) {
           
            $total_unit_stock = 0; $unit_name_array = []; $sub_unit_name_array = [];
            foreach($total_records_list as $key => $data) {
                $inward_unit = 0; $outward_unit = 0; $unit_name = ""; $subunit_name = ""; $outward_unit = 0; $outward_subunit = 0;
                $index = $key + 1; 
                if($pdf->GetY() > 270){
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->Cell(20,276-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(90,276-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(80,276-$y_axis,'',1,1,'C',0);

                    $pdf->SetFont('Arial','B',10);
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

                    $file_name="Godown Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,'Godown Report ',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(20,8,'#',1,0,'C',0);
                    $pdf->Cell(90,8,'Product',1,0,'C',0);
                    $pdf->Cell(80,8,'Current Stock',1,1,'C',0);
                    $pdf->SetFont('Arial','',7);

                    $y_axis=$pdf->GetY();
                }
                $inward_unit = 0; $outward_unit = 0; $current_stock = "";
                $inward_array = array(); $outward_array = array();
                $inward_unit_stock = 0; $inward_subunit_stock = 0;
                $outward_unit_stock = 0; $outward_subunit_stock = 0;
                $current_unit_stock = 0; $current_subunit_stock = 0;
                $subunit_need = 0; $unit_name = ""; $subunit_name = "";
                $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_need');
                $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'unit_name');
                if($subunit_need == '1') {
                    $subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_name');
                }

                if($unit_type == "Unit") {
                    if($subunit_need == '1') {
                        $current_stock_array = $obj->getCurrentStockCasewise($godown_id, '', $data['product_id'], '', 1);
                        $current_unit_stock = $current_stock_array[0];
                        $current_subunit_stock = $current_stock_array[1];
                        if(!empty($current_unit_stock)) {
                            $current_stock = $current_unit_stock." ".($obj->encode_decode('decrypt', $unit_name));
                            $unit_name_array[] = $unit_name;
                            $total_unit_stock += $current_unit_stock;
                        }
                        if(!empty($current_subunit_stock)) {
                            if(!empty($current_stock)) {
                                $current_stock = $current_stock." ".$current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                $sub_unit_name_array[] = $subunit_name;
                            } else {
                                $current_stock = $current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                                $sub_unit_name_array[] = $subunit_name;
                            }
                            $total_subunit_stock += $current_subunit_stock;
                        }
                    } else {
                        $inward_unit = $obj->getInwardQty('', $godown_id, '', $data['product_id'], '');
                        $outward_unit = $obj->getOutwardQty('', $godown_id, '', $data['product_id'], '');
                        $current_stock = $inward_unit - $outward_unit;
                        $total_unit_stock += $current_stock;
                        $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $unit_name));
                        $unit_name_array[] = $unit_name;
                    }
                } else if($unit_type == "Subunit") {
                    $inward_unit = $obj->getInwardSubunitQty('', $godown_id, '', $data['product_id'], '');
                    $outward_unit = $obj->getOutwardSubunitQty('', $godown_id, '', $data['product_id'], '');
                    $current_stock = $inward_unit - $outward_unit;
                    $total_subunit_stock += $current_stock;
                    $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                    $sub_unit_name_array[] = $subunit_name;
                }
                
                if(preg_match('/^[0]+$/', $current_stock) || !empty($obj->getProductStockTransactionExist($data['product_id']))) {
                    $pdf->SetX(10);
                    $pdf->Cell(20,6,$s_no,0,0,'C',0);
                    
                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $product_name = "";
                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                        $product_name = html_entity_decode($obj->encode_decode('decrypt', $product_name));
                        $pdf->Cell(90,6,$product_name,0,0,'C',0);
                    } else {
                        $pdf->Cell(90,6,' - ',0,0,'C',0);
                    }
                    
                    if(!empty($current_stock)) {
                        $pdf->Cell(80,6, $current_stock,0,1,'R',0);
                    } else {
                        $pdf->Cell(80,6,' - ',0,1,'R',0);
                    }
                    $s_no++;
                }
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
        
                $pdf->SetFont('Arial','B',9);
        
                // $next_page = $pdf->PageNo()+1;
        
                // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Godown Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Godown Report )',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'#',1,0,'C',0);
                $pdf->Cell(90,8,'Product',1,0,'C',0);
                $pdf->Cell(80,8,'Current Stock',1,1,'C',0);
                $pdf->SetFont('Arial','',7);
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
                $pdf->SetY($content_height);
            } else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
            }
            
            $pdf->SetFont('Arial','B',8);
        
            $total_stock_display = "";
            if(!empty($total_unit_stock)) {
                $total_stock_display .= $total_unit_stock;

                if(!empty($unit_name_array)) {
                    $unique_unit_names = array_unique($unit_name_array);
                    if(count($unique_unit_names) == 1) {
                        $total_stock_display .= " " . $obj->encode_decode('decrypt', $unique_unit_names[0]);
                    }
                }
            }
            if(!empty($total_subunit_stock)) {
                $total_stock_display .= $total_subunit_stock;

                if(!empty($sub_unit_name_array)) {
                    $unique_sub_unit_names = array_unique($sub_unit_name_array);
                    if(count($unique_sub_unit_names) == 1) {
                        $total_stock_display .= " " . $obj->encode_decode('decrypt', $unique_sub_unit_names[0]);
                    }
                }
            }

            $pdf->SetX(10);
            $pdf->Cell(110,8,'Total Stock',1,0,'R',0);
            if(!empty($total_stock_display)){
                $pdf->SetX(120);
                $pdf->Cell(80,8,$total_stock_display,1,1,'R',0);
            }
            else{
                $pdf->SetX(120);
                $pdf->Cell(80,8,' 0 ',1,1,'R',0);
            }

        }else{
            $pdf->Cell(190,8,'Sorry! No records found',1,1,'C',0);
        }

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        
    } else if(!empty($product_id)) {
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        
        
        $pdf->SetY($bill_to_y);
        
        $inward_unit = 0; $outward_unit = 0; $current_stock = "";
        $inward_array = array(); $outward_array = array();
        $inward_unit_stock = 0; $inward_subunit_stock = 0;
        $outward_unit_stock = 0; $outward_subunit_stock = 0;
        $current_unit_stock = 0; $current_subunit_stock = 0;
        $subunit_need = 0; $unit_name = ""; $subunit_name = "";
        $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_need');
        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'unit_name');
        if($subunit_need == '1') {
            $subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_name');
        }

        if($unit_type == "Unit") {
            if($subunit_need == '1') {
                $current_stock_array = $obj->getCurrentStockCasewise($godown_id, '', $product_id, $case_contains, 1);
                $current_unit_stock = $current_stock_array[0];
                $current_subunit_stock = $current_stock_array[1];
                if(!empty($current_unit_stock)) {
                    $current_stock = $current_unit_stock." ".($obj->encode_decode('decrypt', $unit_name));
                }
                if(!empty($current_subunit_stock)) {
                    if(!empty($current_stock)) {
                        $current_stock = $current_stock." ".$current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                    }
                    else {
                        $current_stock = $current_subunit_stock." ".($obj->encode_decode('decrypt', $subunit_name));
                    }
                }
            }
            else {
                $inward_unit = $obj->getInwardQty('', $godown_id, '', $product_id, $case_contains);
                $outward_unit = $obj->getOutwardQty('', $godown_id, '', $product_id, $case_contains);
                $current_stock = $inward_unit - $outward_unit;
                $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $unit_name));
            }
        }
        else if($unit_type == "Subunit") {
            $inward_unit = $obj->getInwardSubunitQty('', $godown_id, '', $product_id, $case_contains);
            $outward_unit = $obj->getOutwardSubunitQty('', $godown_id, '', $product_id, $case_contains);
            $current_stock = $inward_unit - $outward_unit;
            $current_stock = $current_stock." ".($obj->encode_decode('decrypt', $subunit_name));
        }

        if(!empty($product_id)) {
            $product_name_code = "";
            $product_name_code = $obj->GetTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
        }

        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(190,7,html_entity_decode($obj->encode_decode('decrypt', $product_name_code)). '  ( Current stock : '.$current_stock.' )',1,1,'C',0);
        $product_start_y = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Date', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Type ', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Remarks', 1, 0, 'C', 0);
        $pdf->Cell(36, 10, 'Party', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Godown', 1, 0, 'C', 0);
        // $pdf->Cell(21, 10, 'Brand', 1, 0, 'C', 0);
        $pdf->MultiCell(18, 5, 'Case Contains',0, 'C', 0);
        $pdf->SetY($product_start_y);
        $pdf->SetX(136);
        $pdf->Cell(18,10,'',1,0,'C',0);
        $pdf->SetY($product_start_y);
        $pdf->SetX(154);
        $pdf->Cell(23, 10, 'Inward', 1, 0, 'C', 0);
        $pdf->Cell(23, 10, 'Outward', 1, 1, 'C', 0);
        $start_y = $pdf->GetY();

        $y_axis = $pdf->GetY();

        $total_inward_unit = 0; $total_inward_subunit = 0; $total_outward_unit = 0;
        $total_outward_subunit = 0;
        if(!empty($total_inward_unit) || !empty($total_outward_unit)){
            $height -= 15;
            $footer_height += 15;
        }
        $pdf->SetFont('Arial','',7);
        
        if(!empty($total_records_list)) { 
            foreach($total_records_list as $data) {
                $inward_unit = 0; $outward_unit = 0;$outward_unit = 0; $outward_subunit = 0;
                if($pdf->GetY() > 260){
                    
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->Cell(10,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(36,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(18,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(23,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(23,277-$y_axis,'',1,1,'C',0);
                    
                    $pdf->SetFont('Arial','B',10);
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
                    $file_name="Godown Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,html_entity_decode($obj->encode_decode('decrypt', $product_name_code)). '  ( Current stock : '.$current_stock." ".$unit_name.  ')',1,1,'C',0);

                    $pdf->SetX(10);
                    $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Date', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Type ', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Remarks', 1, 0, 'C', 0);
                    $pdf->Cell(36, 10, 'Party', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Godown', 1, 0, 'C', 0);
                    $pdf->MultiCell(18, 5, 'Case Contains',0, 'C', 0);
                    $pdf->SetY($product_start_y);
                    $pdf->SetX(136);
                    $pdf->Cell(18,10,'',1,0,'C',0);
                    $pdf->SetY($product_start_y);
                    $pdf->SetX(154);
                    $pdf->Cell(23, 10, 'Inward', 1, 0, 'C', 0);
                    $pdf->Cell(23, 10, 'Outward', 1, 1, 'C', 0);
                    $start_y = $pdf->GetY();
                    $pdf->SetFont('Arial','',7);
                    $y_axis=$pdf->GetY();
                }
                $date_y = ""; $type_y = ""; $remarks_y = ""; $party_y = ""; $godown_y = ""; $case_y = ""; $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = "";$godown_room_y = "";

                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->MultiCell(10, 5, $s_no, 0, 'C', 0);
                
                if(!empty($data['stock_date'])) {
                    $stock_date = "";
                    $stock_date = date('d-m-Y', strtotime($data['stock_date']));
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(20, 5, $stock_date, 0, 'C', 0);
                    $date_y = $pdf->GetY();
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(20, 5,'-', 0, 'C', 0);
                    $date_y = $pdf->GetY();
                }

                if(!empty($data['stock_type'])) {
                    $stock_type = "";
                    $stock_type = $data['stock_type'];
                    $pdf->SetY($start_y);
                    $pdf->SetX(40);
                    $pdf->MultiCell(20, 5, $stock_type, 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(30);
                    $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }

                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = "";
                    $remarks= $data['remarks'];
                    $pdf->SetY($start_y);
                    $pdf->SetX(60);
                    $pdf->MultiCell(20, 5, $obj->encode_decode('decrypt', $remarks), 0,  'C', 0);
                    $remarks_y = $pdf->GetY();
                }
                else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(55);
                    $pdf->MultiCell(20, 5, '-', 0,  'C', 0);
                    $remarks_y = $pdf->GetY();
                }

                $remarks_y = $pdf->GetY() - $start_y;

                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                    $pdf->SetY($start_y);
                    $pdf->SetX(75);
                    if(!empty($party_id)) {
                        $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $data['party_id'], 'name_mobile_city');          
                        if(empty($party_name) || $party_name == $GLOBALS['null_value']) {
                            $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $data['party_id'], 'name_mobile_city');
                            if(empty($party_name) || $party_name == $GLOBALS['null_value']) {
                                $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $data['party_id'], 'name_mobile_city');
                            }
                        }              
                        $party_name = html_entity_decode($obj->encode_decode('decrypt', $party_name));
                        $pdf->MultiCell(36, 5, $party_name, 0, 'C', 0);
                        $party_y = $pdf->GetY();
                    }
                    
                }
                else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(80);
                    $party_y = $pdf->GetY();
                    $pdf->MultiCell(36, 5, '-', 0, 'C', 0);
                }
        
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$data['godown_id'],'godown_name');
                    $godown_name = $obj->encode_decode('decrypt', $godown_name);
                    $pdf->SetY($start_y);
                    $pdf->SetX(117);
                    $pdf->MultiCell(20, 5,  $godown_name, 0, 'C', 0);
                    $godown_y = $pdf->GetY();
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(117);
                    $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                    $godown_y = $pdf->GetY();
                }

                $godown_room_y = $pdf->GetY();
                if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                    $pdf->SetY($start_y);
                    $pdf->SetX(129);
                    $pdf->MultiCell(18, 5, $data['case_contains'], 0, 'R', 0);
                    $case_y = $pdf->GetY();
                }
                else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(129);
                    $pdf->MultiCell(18, 5, '-', 0,  'R', 0);
                    $case_y = $pdf->GetY();
                }

                $inward_display = "";
                if(!empty($unit_type)) {
                    if($unit_type == "Subunit") {
                        if(!empty($data['inward_subunit'])) { 
                            $inward_display .= $data['inward_subunit']." ".($obj->encode_decode('decrypt', $subunit_name)); 
                            $total_inward_subunit += $data['inward_subunit'];
                        }
                    } else {
                        if(!empty($data['inward_unit'])) { 
                            $multiplied_value = 0; $quotient = 0; $remainder = 0;
                            if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                $multiplied_value = $data['inward_unit'] * $data['case_contains'];
                                $quotient = floor($multiplied_value / $data['case_contains']); 
                                $remainder = round(fmod($multiplied_value, $data['case_contains']));
                            }
                            else {
                                $quotient = $data['inward_unit'];
                            }
                            if(!empty($quotient)) {
                                $total_inward_unit += $quotient;
                                $inward_display .= $quotient." ".($obj->encode_decode('decrypt', $unit_name));
                            }
                            if(!empty($quotient) && !empty($remainder)) {
                                $inward_display .= " ";
                            }
                            if(!empty($remainder)) {
                                $total_inward_subunit += $remainder;
                                $inward_display .= $remainder." ".($obj->encode_decode('decrypt', $subunit_name));
                            }
                        }
                    }
                }

                $pdf->SetY($start_y);
                $pdf->SetX(152);
                if(!empty($inward_display)){
                    $pdf->MultiCell(23, 5,  $inward_display, 0,  'R', 0);
                }else{
                    $pdf->MultiCell(23, 5,  $inward_display, 0,  'R', 0); 
                }
                $inward_y = $pdf->GetY();
            
                $outward_display = "";
                if(!empty($unit_type)) {
                    if($unit_type == "Subunit") {
                        if(!empty($data['outward_subunit'])) { 
                            $outward_display .= $data['outward_subunit']." ".($obj->encode_decode('decrypt', $subunit_name)); 
                            $total_outward_subunit += $data['outward_subunit'];
                        }
                    } else {
                        if(!empty($data['outward_unit'])) { 
                            $multiplied_value = 0; $quotient = 0; $remainder = 0;
                            if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                $multiplied_value = $data['outward_unit'] * $data['case_contains'];
                                $quotient = floor($multiplied_value / $data['case_contains']); 
                                $remainder = round(fmod($multiplied_value, $data['case_contains']));
                            } else {
                                $quotient = $data['outward_unit'];
                            }
                            if(!empty($quotient)) {
                                $total_outward_unit += $quotient;
                                $outward_display .= $quotient." ".($obj->encode_decode('decrypt', $unit_name));
                            }
                            if(!empty($quotient) && !empty($remainder)) {
                                $outward_display .= " ";
                            }
                            if(!empty($remainder)) {
                                $total_outward_subunit += $remainder;
                                $outward_display .= $remainder." ".($obj->encode_decode('decrypt', $subunit_name));
                            }
                        }
                    }
                }  

                $pdf->SetY($start_y);
                $pdf->SetX(174);
                if(!empty($outward_display)){
                    $pdf->MultiCell(23, 5, $outward_display, 0,  'R', 0);
                }else{
                    $pdf->MultiCell(23, 5, $outward_display, 0,  'R', 0); 
                }
                $outward_y = $pdf->GetY();

                $max_y = max(array($date_y,$type_y,$remarks_y,$party_y,$godown_y,$case_y,$inward_y, $outward_y, $godown_room_y));

                $pdf->SetY($max_y);

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
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(36,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(18,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(23,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(23,270 - $y_axis,'',1,1,'C');
                 
                $pdf->SetFont('Arial','B',9);
    
                // $next_page = $pdf->PageNo()+1;
        
                // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);

                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Godown Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,html_entity_decode($obj->encode_decode('decrypt', $product_name_code)). '  ( Current stock : '.$current_stock." ".$unit_name.  ')',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Date', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Type ', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Remarks', 1, 0, 'C', 0);
                $pdf->Cell(36, 10, 'Party', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Godown', 1, 0, 'C', 0);
                $pdf->MultiCell(18, 5, 'Case Contains',0, 'C', 0);
                $pdf->SetY($product_start_y);
                $pdf->SetX(136);
                $pdf->Cell(18,10,'',1,0,'C',0);
                $pdf->SetY($product_start_y);
                $pdf->SetX(154);
                $pdf->Cell(23, 10, 'Inward', 1, 0, 'C', 0);
                $pdf->Cell(23, 10, 'Outward', 1, 1, 'C', 0);

                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(10,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(36,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(18,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(23,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(23,$content_height - $y_axis,'',1,1,'C');
                $pdf->SetY($content_height);
            } 
            else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);                
                $pdf->Cell(10,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(36,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(18,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(23,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(23,$content_height - $y_axis,'',1,1,'C');
            }

            $pdf->SetFont('Arial','B',7);
            $pdf->SetX(10);
            $pdf->Cell(144,8,'Total Stock',1,0,'R',0);

            $inward_display = "";
            if(!empty($total_inward_unit)) {
                $inward_display .= $total_inward_unit;
                if(!empty($unit_name)) {
                    $inward_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                }
            }
            if(!empty($total_inward_subunit)) {
                $inward_display .= $total_inward_subunit;
                if(!empty($subunit_name)) {
                    $inward_display .= " " . $obj->encode_decode('decrypt', $subunit_name);
                }
            }

            if(!empty($inward_display)){
                $pdf->SetX(154);
                $pdf->Cell(23,8,$inward_display,1,0,'R',0);
            } else{
                $pdf->SetX(154);
                $pdf->Cell(23,8,' - ',1,0,'R',0);
            }

            $outward_display = "";
            if(!empty($total_outward_unit)) {
                $outward_display .= $total_outward_unit;
                if(!empty($unit_name)) {
                    $outward_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                }
            }
            if(!empty($total_outward_subunit)) {
                $outward_display .= $total_outward_subunit;
                if(!empty($subunit_name)) {
                    $outward_display .= " " . $obj->encode_decode('decrypt', $subunit_name);
                }
            }

            if(!empty($outward_display)){
                $pdf->Cell(23,8,$outward_display,1,1,'R',0);
            } else {
                $pdf->SetX(177);
                $pdf->Cell(23,8,' - ',1,1,'R',0);
            }
           
        }else{
            $pdf->Cell(190,8,'Sorry! No records found',1,1,'C',0);
        }

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }

    $pdf_name = "Godown Report.pdf";
    $pdf->Output($from, $pdf_name);
?>