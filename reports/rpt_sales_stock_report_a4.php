<?php

    include("../include_user_check.php");
    
    $current_date = date("Y-m-d"); $product_id = ""; $magazine_id = ""; $magazine_room_id = ""; $party_id = ""; $category_id = ""; $brand_id = ""; $stock_type = "";  $subunit_contains = 0; $case_contains = 0; $unit_type = ""; $from = "";$group_id ="";
    $finished_group_id = "";
    if(isset($_REQUEST['filter_group_id'])) {
        $group_id = $_REQUEST['filter_group_id'];
    }
    if(isset($_REQUEST['filter_finished_group_id'])) {
        $finished_group_id = $_REQUEST['filter_finished_group_id'];
    }
    if(isset($_REQUEST['filter_magazine_id'])) {
        $magazine_id = $_REQUEST['filter_magazine_id'];
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
    if(empty($unit_type)) {
        $unit_type = "Unit";
    }
    if(isset($_REQUEST['filter_contains'])) {
        $case_contains = $_REQUEST['filter_contains'];
    }    
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    $group_list = array();
    $group_list = $obj->getGroupList('2');

    $group_type = "finished";
	$encrypted_group_type = $obj->encode_decode('encrypt',$group_type);

    $group_id = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', $encrypted_group_type, 'group_id');
    
    $product_list = array();
    if(!empty($finished_group_id)) {
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'finished_group_id', $finished_group_id, '');
    } else {
        $product_list = $obj->getProducts('2');
    }

    $magazine_list = array();
    $magazine_list = $obj->getTableRecords($GLOBALS['magazine_table'], '', '', '');

    $product_subunit_id = ""; $subunit_hide = 1;
    if(!empty($product_id)) {
        $product_subunit_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'subunit_id');
        if(empty($product_subunit_id) || $product_subunit_id == $GLOBALS['null_value']) {
            $subunit_hide = 0;
        }
    }

    if($case_contains != "" && $case_contains == "undefined" && $subunit_hide == 0) {
        $case_contains = "";
    }

    $total_records_list = array(); $contains_list = array();
    if(empty($product_id)) {
        $total_records_list = $product_list;
    } else if(!empty($product_id)) {
        if($subunit_hide == '1') {
            $contains_list = $obj->getStockContainsList($product_id);
        }
        $total_records_list = $obj->getStockReportListSales($group_id, '', $magazine_id, $product_id, $stock_type, $case_contains, '');
    }

    $company_logo = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $GLOBALS['bill_company_id'], 'logo');

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Sales Stock Report";
    include("rpt_header.php");
    
    $pdf->SetY($header_end);

    $bill_to_y = $pdf->GetY();

    $s_no = 1; $footer_height = 15; $height = 0; $l = 0; 
    $pdf->SetFont('Arial','B',8);
    if(empty($product_id)) {
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            if(!empty($current_date)) {
                $current_date = date('d-m-Y', strtotime($current_date));
            }
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(190,7,'Sales Stock Report - ( '.$current_date.' )',1,1,'C',0);
            $pdf->SetX(10);
            $pdf->Cell(20,8,'#',1,0,'C',0);
            $pdf->Cell(60,8,'Product',1,0,'C',0);
            $pdf->Cell(30,8,'Contains',1,0,'C',0);
            $pdf->Cell(40,8,'Sales Stock',1,0,'C',0);
            $pdf->Cell(40,8,'Stock Value',1,1,'C',0);
            $pdf->SetFont('Arial','',7);
            
            $y_axis=$pdf->GetY();

            $s_no = "1"; $total_stock = 0; $content_height = 0;
            if(!empty($total_stock)){
                $height -= 15;
                $footer_height += 15;
            }

            $total_stock = 0; $sno = 1; $total_unit_stock = 0; $total_subunit_stock = 0;
            $unit_name_array = []; $sub_unit_name_array = [];   $total_current_unit = 0; $total_current_subunit = 0; $total_amount = 0; 

            foreach($total_records_list as $key => $data) {
                $index = $key + 1; 
                if($pdf->GetY() > 270){
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->Cell(20,275-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(60,275-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(30,275-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(40,275-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(40,275-$y_axis,'',1,1,'C',0);

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

                    $file_name="Sales Stock Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,'Sales Stock Report - ( '.$current_date.' )',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(20,8,'#',1,0,'C',0);
                    $pdf->Cell(60,8,'Product',1,0,'C',0);
                    $pdf->Cell(30,8,'Contains',1,0,'C',0);
                    $pdf->Cell(40,8,'Sales Stock',1,0,'C',0);
                    $pdf->Cell(40,8,'Stock Value',1,1,'C',0);
                    $pdf->SetFont('Arial','',7);

                    $y_axis=$pdf->GetY();
                }

                $unit_name = ""; $subunit_name = ""; $subunit_need = 0;
                $rate = 0; $per = 0; $rate_per_unit = 0;
                $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'unit_name');
                $subunit_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_name');
                $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'subunit_need');
                $rate = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'sales_rate');
                $per = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'per');
                $rate_per_unit = $rate / $per;
                $case_contains_list = array();
                if(!empty($subunit_need) && $subunit_need == 1) {
                    $case_contains_list = $obj->getCaseContainsList($data['product_id']);
                }
                $str_product_id = "";
                if(!empty($case_contains_list)) {
                    foreach($case_contains_list as $row) {
                        if(!empty($row['case_contains']) && $row['case_contains'] != $GLOBALS['null_value']) {
                            $outward_subunit = 0; $total_rate = 0;
                            $unit_rate = 0;
                            $current_stock_subunit = 0;
                           
                            $outward_subunit = $obj->getSubunitQtySales('', '', $magazine_id, $data['product_id'], $row['case_contains']);
                            $current_stock_subunit = $outward_subunit;
                            $total_rate = $current_stock_subunit * $rate_per_unit;
                            if($unit_type == "Subunit") {
                                $total_current_subunit += $current_stock_subunit;
                            }
                            $current_stock_quotient = 0; $current_stock_remainder = 0;
                            $current_stock = 0;
                            $current_stock_quotient = floor($current_stock_subunit / $row['case_contains']);
                            $current_stock_remainder = round(fmod($current_stock_subunit, $row['case_contains']));
                            if(!empty($current_stock_quotient)) {
                                if($unit_type == "Unit") {
                                    $total_current_unit += $current_stock_quotient;
                                }
                                $current_stock = $current_stock_quotient . " " . ($obj->encode_decode('decrypt', $unit_name));
                                $unit_name_array[] = $obj->encode_decode('decrypt', $unit_name);
                            }
                            if(!empty($current_stock_remainder)) {
                                if($unit_type == "Unit") {
                                    $total_current_subunit += $current_stock_remainder;
                                }
                                if(!empty($current_stock)) {
                                    $current_stock = $current_stock . " " . $current_stock_remainder . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    $sub_unit_name_array[] = $obj->encode_decode('decrypt', $subunit_name);
                                } else {
                                    $current_stock = $current_stock_remainder . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    $sub_unit_name_array[] = $obj->encode_decode('decrypt', $subunit_name);
                                }
                            }

                            if(preg_match('/^[0]+$/', $current_stock) || preg_match('/^[0]+$/', $current_stock_subunit) || !empty($obj->getProductStockTransactionExistSales($data['product_id']))) {
                                $pdf->SetX(10);
                                $pdf->Cell(20,6,$s_no,1,0,'C',0);
                                
                                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                    $product_name = "";
                                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                                    $product_name = html_entity_decode($obj->encode_decode('decrypt', $product_name));
                                    $pdf->Cell(60,6,$product_name,1,0,'C',0);
                                } else {
                                    $pdf->Cell(60,6,' - ',1,0,'C',0);
                                }

                                if(!empty($row['case_contains']) && $row['case_contains'] != $GLOBALS['null_value']) {
                                    $pdf->Cell(30,6,$row['case_contains'],1,0,'C',0);
                                } else {
                                    $pdf->Cell(30,6,' - ',1,0,'C',0);
                                }

                                if($unit_type == "Subunit") {
                                    $current_stock_subunit . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    if(!empty($current_stock_subunit)) {
                                        $pdf->Cell(80,6, $current_stock_subunit,1,0,'C',0);
                                    } else {
                                        $pdf->Cell(80,6,' - ',1,0,'C',0);
                                    }
                                    $sub_unit_name_array[] = $obj->encode_decode('decrypt', $subunit_name);
                                } else {
                                    if(!empty($current_stock)) {
                                        $pdf->Cell(40,6, $current_stock,1,0,'C',0);
                                    } else {
                                        $pdf->Cell(40,6,' - ',1,0,'C',0);
                                    }
                                }

                                if($total_rate > 0) {
                                    $pdf->Cell(40,6, "Rs . " . number_format($total_rate),1,1,'R',0);
                                    $total_amount += $total_rate;
                                } else {
                                    $pdf->Cell(40,6,'0',1,1,'R',0);
                                }

                                $s_no++;
                            }
                        }
                    }
                } else {
                    $outward_unit = 0; $total_rate = 0;
                    $current_stock_unit = 0;
                    $outward_unit = $obj->getOutwardQtySales('', '', $magazine_id, $data['product_id'], '');
                    $current_stock_unit = $outward_unit;
                    if(!empty($current_stock_unit)) {
                        $total_current_unit += $current_stock_unit;
                    }

                    if(!empty($current_stock_unit) || !empty($obj->getProductStockTransactionExist($data['product_id']))) {
                        $pdf->SetX(10);
                        $pdf->Cell(20,6,$s_no,1,0,'C',0);
                    
                        if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                            $product_name = "";
                            $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                            $product_name =html_entity_decode($obj->encode_decode('decrypt', $product_name));
                            $pdf->Cell(60,6,$product_name,1,0,'C',0);
                        } else {
                            $pdf->Cell(60,6,' - ',1,0,'C',0);
                        }

                        $pdf->Cell(30,6,' - ',1,0,'C',0);

                        if($current_stock_unit > 0) {
                            $total_rate = $current_stock_unit * $rate_per_unit;
                            $pdf->Cell(40,6, $current_stock_unit . " " . ($obj->encode_decode('decrypt', $unit_name)),1,0,'C',0);
                            $unit_name_array[] = $obj->encode_decode('decrypt', $unit_name);
                        } else {
                            $pdf->Cell(40,6,' 0 ',1,0,'C',0);
                        }

                        if($total_rate > 0) {
                            $pdf->Cell(40,6, "Rs . " . number_format($total_rate),1,1,'R',0);
                            $total_amount += $total_rate;
                        } else {
                            $pdf->Cell(40,6,'0',1,1,'R',0);
                        }

                        $s_no++;
                    }
                }
            }

            
            $end_y = $pdf->GetY();
            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(60,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(30,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(40,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(40,270-$y_axis,'',1,1,'C',0);
        
                // $pdf->SetFont('Arial','B',9);
        
                // $next_page = $pdf->PageNo()+1;
        
                // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Sales Stock Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Sales Stock Report - ( '.$current_date.' )',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'#',1,0,'C',0);
                $pdf->Cell(60,8,'Product',1,0,'C',0);
                $pdf->Cell(30,8,'Contains',1,0,'C',0);
                $pdf->Cell(40,8,'Sales Stock',1,0,'C',0);
                $pdf->Cell(40,8,'Stock Value',1,1,'C',0);
                $pdf->SetFont('Arial','',7);
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(60,($content_height-$y_axis),'',1,0);
                $pdf->Cell(30,($content_height-$y_axis),'',1,0);
                $pdf->Cell(40,($content_height-$y_axis),'',1,0);
                $pdf->Cell(40,($content_height-$y_axis),'',1,1);
                $pdf->SetY($content_height);
            } else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(60,($content_height-$y_axis),'',1,0);
                $pdf->Cell(30,($content_height-$y_axis),'',1,0);
                $pdf->Cell(40,($content_height-$y_axis),'',1,0);
                $pdf->Cell(40,($content_height-$y_axis),'',1,1);
            }
            
            $pdf->SetFont('Arial','B',8);
        
            $total_display = "";

            if(!empty($total_current_unit)) {
                $total_display .= $total_current_unit;
                if(!empty($unit_name_array)) {
                    $unique_unit_names = array_unique($unit_name_array);
                    if(count($unique_unit_names) == 1) {
                        $total_display .= $unique_unit_names[0];
                    }
                }
            }
            if(!empty($total_current_unit) && !empty($total_current_subunit)) {
                $total_display .= " + ";
            }
            if(!empty($total_current_subunit)) {
                $total_display .= $total_current_subunit;
                if(!empty($sub_unit_name_array)) {
                    $unique_sub_unit_names = array_unique($sub_unit_name_array);
                    if(count($unique_sub_unit_names) == 1) {
                        $total_display .= ' ' . $unique_sub_unit_names[0];
                    }
                }
            }

            $pdf->SetX(10);
            $pdf->Cell(110,8,'Total',1,0,'R',0);
            if(!empty($total_display)){
                $pdf->SetX(120);
                $pdf->Cell(40,8,$total_display,1,0,'R',0);
            } else {
                $pdf->SetX(120);
                $pdf->Cell(40,8,' - ',1,0,'R',0);
            }

            if(!empty($total_amount)) {
                $pdf->SetX(160);
                $pdf->Cell(40,8, "Rs . " . number_format($total_amount, 0),1,1,'R',0);
            } else {
                $pdf->SetX(160);
                $pdf->Cell(40,8,' - ',1,1,'R',0);
            }

        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    } else if(!empty($product_id)) {
        $product_name = "";
        $product_names = $obj->GetTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
        if(!empty($product_names) && $product_names != $GLOBALS['null_value']) {
            $product_name =html_entity_decode($obj->encode_decode('decrypt', $product_names));
        } 
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            
            if(!empty($current_date)) {
                $current_date = date('d-m-Y', strtotime($current_date));
            }
            $pdf->SetY($bill_to_y);
            
            $outward_unit = 0; $current_stock = "";
            $outward_array = array();
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
                    $current_stock_array = $obj->getCurrentStockCasewise('', $magazine_id, $product_id, $case_contains, 2);
                    $current_unit_stock = $current_stock_array[0];
                    $current_subunit_stock = $current_stock_array[1];
                    if(!empty($current_unit_stock)) {
                        $current_stock = $current_unit_stock . " " . ($obj->encode_decode('decrypt', $unit_name));
                    }
                    if(!empty($current_subunit_stock)) {
                        if(!empty($current_stock)) {
                            $current_stock = $current_stock . " " . $current_subunit_stock . " " . ($obj->encode_decode('decrypt', $subunit_name));
                        } else {
                            $current_stock = $current_subunit_stock . " " . ($obj->encode_decode('decrypt', $subunit_name));
                        }
                    }
                } else {
                    $outward_unit = $obj->getOutwardQtySales('', '', $magazine_id, $product_id, $case_contains);
                    $current_stock = $outward_unit;
                    $current_stock = $current_stock . " " . ($obj->encode_decode('decrypt', $unit_name));
                }
            } else if($unit_type == "Subunit") {
                $outward_unit = $obj->getSubunitQtySales('', '', $magazine_id, $product_id, $case_contains);
                $current_stock = $inward_unit - $outward_unit;
                $current_stock = $current_stock . " " . ($obj->encode_decode('decrypt', $subunit_name));
            }

            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(190,7,$product_name . '  ( Sales stock : '.$current_stock.')',1,1,'C',0);
            $product_start_y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
            $pdf->Cell(15, 10, 'Date', 1, 0, 'C', 0);
            $pdf->Cell(20, 10, 'Type ', 1, 0, 'C', 0);
            $pdf->Cell(30, 10, 'Remarks', 1, 0, 'C', 0);
            $pdf->Cell(30, 10, 'Party', 1, 0, 'C', 0);
            $pdf->Cell(25, 10, 'Magazine', 1, 0, 'C', 0);
            if($subunit_hide == 1) {
                $pdf->SetY($product_start_y);
                $pdf->SetX(140);
                $pdf->MultiCell(20, 5, 'Case Contains',0, 'C', 0);
                $pdf->SetY($product_start_y);
                $pdf->SetX(160);
                $pdf->Cell(20, 10, 'Inward', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Outward', 1, 1, 'C', 0);
            } else {
                $pdf->SetY($product_start_y);
                $pdf->SetX(140);
                $pdf->Cell(30, 10, 'Inward', 1, 0, 'C', 0);
                $pdf->Cell(30, 10, 'Outward', 1, 1, 'C', 0);
            }

            $start_y = $pdf->GetY();
            $y_axis = $pdf->GetY();

            $total_inward = 0; $total_outward = 0; $s_no='1'; $content_height = 0;
            if(!empty($total_inward) || !empty($total_outward)){
                $height -= 15;
                $footer_height += 15;
            }
            $pdf->SetFont('Arial','',7);
            $total_inward_unit = 0; $total_inward_subunit = 0; $total_outward_unit = 0;  $total_outward_subunit = 0;

            foreach($total_records_list as $data) {
                if(!empty($data['inward_unit']) || !empty($data['inward_subunit']) || !empty($data['outward_unit']) || !empty($data['outward_subunit'])) {

                    if($pdf->GetY() > 260) {
                        $y = $pdf->GetY();
                        $pdf->SetY($y_axis);
                        $pdf->SetX(10);
                        $pdf->Cell(10,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(15,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(30,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(30,277-$y_axis,'',1,0,'C',0);
                        $pdf->Cell(25,277-$y_axis,'',1,0,'C',0);
                        if($subunit_hide == 1) {
                            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                            $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                            $pdf->Cell(20,277-$y_axis,'',1,1,'C',0);
                        } else {
                            $pdf->Cell(30,277-$y_axis,'',1,0,'C',0);
                            $pdf->Cell(30,277-$y_axis,'',1,1,'C',0);
                        }

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
                        $file_name="Sales Stock Report";
                        include("rpt_header.php");
                        
                        $pdf->SetY($header_end);

                        $bill_to_y = $pdf->GetY();
                        $pdf->SetY($bill_to_y);
                        $pdf->SetX(10);
                        $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name_code). '  ( Sales stock : '.$current_stock . " " . $unit_name.  ')',1,1,'C',0);
                        $product_start_y = $pdf->GetY();
                        $pdf->SetX(10);
                        $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
                        $pdf->Cell(15, 10, 'Date', 1, 0, 'C', 0);
                        $pdf->Cell(20, 10, 'Type ', 1, 0, 'C', 0);
                        $pdf->Cell(30, 10, 'Remarks', 1, 0, 'C', 0);
                        $pdf->Cell(30, 10, 'Party', 1, 0, 'C', 0);
                        $pdf->Cell(25, 10, 'Magazine', 1, 0, 'C', 0);
                        if($subunit_hide == 1) {
                            $pdf->SetY($product_start_y);
                            $pdf->SetX(140);
                            $pdf->MultiCell(20, 5, 'Case Contains',0, 'C', 0);
                            $pdf->SetY($product_start_y);
                            $pdf->SetX(160);
                            $pdf->Cell(20, 10, 'Inward', 1, 0, 'C', 0);
                            $pdf->Cell(20, 10, 'Outward', 1, 1, 'C', 0);
                        } else {
                            $pdf->SetY($product_start_y);
                            $pdf->SetX(140);
                            $pdf->Cell(30, 10, 'Inward', 1, 0, 'C', 0);
                            $pdf->Cell(30, 10, 'Outward', 1, 1, 'C', 0);
                        }
                        
                        $start_y = $pdf->GetY();
                        $pdf->SetFont('Arial','',7);
                        $y_axis=$pdf->GetY();
                    }
                    $date_y = ""; $type_y = ""; $remarks_y = ""; $party_y = ""; $magazine_y = ""; $case_y = ""; $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = ""; $brand_y = ""; $magazine_room_y = "";

                    $pdf->SetY($start_y);
                    $pdf->SetX(10);
                    $pdf->MultiCell(10, 5, $s_no, 0, 'C', 0);
                    
                    if(!empty($data['stock_date'])) {
                        $stock_date = "";
                        $stock_date = date('d-m-Y', strtotime($data['stock_date']));
                        $pdf->SetY($start_y);
                        $pdf->SetX(20);
                        $pdf->MultiCell(15, 5, $stock_date, 0, 'C', 0);
                        $date_y = $pdf->GetY();
                    } else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(20);
                        $pdf->MultiCell(15, 5,'-', 0, 'C', 0);
                        $date_y = $pdf->GetY();
                    }
                    
                    if(!empty($data['stock_type'])) {
                        $stock_type = "";
                        $stock_type = $data['stock_type'];
                        $pdf->SetY($start_y);
                        $pdf->SetX(35);
                        $pdf->MultiCell(20, 5, $stock_type, 0, 'C', 0);
                        $type_y = $pdf->GetY();
                    } else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(35);
                        $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                        $type_y = $pdf->GetY();
                    }

                    if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                        $remarks = "";
                        $remarks= $data['remarks'];
                        $remarks= $obj->encode_decode("decrypt", $remarks);
                        $pdf->SetY($start_y);
                        $pdf->SetX(55);
                        $pdf->MultiCell(30, 5, $remarks, 0,  'C', 0);
                        $remarks_y = $pdf->GetY();
                    } else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(55);
                        $pdf->MultiCell(30, 5, '-', 0,  'C', 0);
                        $remarks_y = $pdf->GetY();
                    }

                    // $remarks_y = $pdf->GetY() - $start_y;

                    if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                        $pdf->SetY($start_y);
                        $pdf->SetX(85);
                        if(!empty($data['party_id'])) {
                            $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $data['party_id'], 'supplier_name');
                            if(empty($party_name)) {
                                $party_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $data['party_id'], 'agent_name');
                                if(empty($party_name)) {
                                    $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $data['party_id'], 'customer_name');
                                }
                            }
                            $party_name = $obj->encode_decode('decrypt', $party_name);
                            $pdf->MultiCell(30, 5, $party_name, 0, 'C', 0);
                            $party_y = $pdf->GetY();
                        }
                    } else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(85);
                        $party_y = $pdf->GetY();
                        $pdf->MultiCell(30, 5, '-', 0, 'C', 0);
                    }
            
                    if(!empty($data['magazine_id']) && $data['magazine_id'] != $GLOBALS['null_value']) {
                        $magazine_name = $obj->getTableColumnValue($GLOBALS['magazine_table'],'magazine_id',$data['magazine_id'],'magazine_name');
                        $magazine_name = $obj->encode_decode('decrypt', $magazine_name);
                        $pdf->SetY($start_y);
                        $pdf->SetX(115);
                        $pdf->MultiCell(25, 5,  $magazine_name, 0, 'C', 0);
                        $magazine_y = $pdf->GetY();
                    } else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(115);
                        $pdf->MultiCell(25, 5, '-', 0, 'C', 0);
                        $magazine_y = $pdf->GetY();
                    }
                    
                    if($subunit_hide == 1) {
                        if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                            $pdf->SetY($start_y);
                            $pdf->SetX(140);
                            $pdf->MultiCell(20, 5, $data['case_contains'], 0, 'R', 0);
                            $case_y = $pdf->GetY();
                        } else {
                            $pdf->SetY($start_y);
                            $pdf->SetX(140);
                            $pdf->MultiCell(20, 5, '-', 0,  'R', 0);
                            $case_y = $pdf->GetY();
                        }

                        $inward_display = "";
                        if(!empty($unit_type)) {
                            if($unit_type == "Subunit") {
                                if(!empty($data['inward_subunit'])) { 
                                    $inward_display .= $data['inward_subunit'] . " " . ($obj->encode_decode('decrypt', $subunit_name)); 
                                    $total_inward_subunit += $data['inward_subunit'];
                                }
                            } else {
                                if(!empty($data['inward_unit'])) { 
                                    $multiplied_value = 0; $quotient = 0; $remainder = 0;
                                    if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                        $multiplied_value = $data['inward_unit'] * $data['case_contains'];
                                        $quotient = floor($multiplied_value / $data['case_contains']); 
                                        $remainder = round(fmod($multiplied_value, $data['case_contains']));
                                    } else {
                                        $quotient = $data['inward_unit'];
                                    }
                                    if(!empty($quotient)) {
                                        $total_inward_unit += $quotient;
                                        $inward_display .= $quotient . " " . ($obj->encode_decode('decrypt', $unit_name));
                                    }
                                    if(!empty($quotient) && !empty($remainder)) {
                                        $inward_display .= " ";
                                    }
                                    if(!empty($remainder)) {
                                        $total_inward_subunit += $remainder;
                                        $inward_display .= $remainder . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    }
                                }
                            }
                        }  
                        
                        if(!empty($inward_display)) {
                            $pdf->SetY($start_y);
                            $pdf->SetX(160);
                            $pdf->MultiCell(20, 5, $inward_display, 0, 'R', 0);
                            $inward_y = $pdf->GetY();
                        } else {
                            $pdf->SetY($start_y);
                            $pdf->SetX(160);
                            $pdf->MultiCell(20, 5, '', 0, 'R', 0);
                            $inward_y = $pdf->GetY();
                        }

                        $outward_display = "";

                        if(!empty($unit_type)) {
                            if($unit_type == "Subunit") {
                                if(!empty($data['outward_subunit'])) { 
                                    $outward_display .= $data['outward_subunit'] . " " . ($obj->encode_decode('decrypt', $subunit_name)); 
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
                                        $outward_display .= $quotient . " " . ($obj->encode_decode('decrypt', $unit_name));
                                    }
                                    if(!empty($quotient) && !empty($remainder)) {
                                        $outward_display .= " ";
                                    }
                                    if(!empty($remainder)) {
                                        $total_outward_subunit += $remainder;
                                        $outward_display .= $remainder . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    }
                                }
                            }
                        }  

                        if(!empty($outward_display)) {
                            $pdf->SetY($start_y);
                            $pdf->SetX(180);
                            $pdf->MultiCell(20, 5, $outward_display, 0, 'R', 0);
                            $outward_y = $pdf->GetY();
                        } else {
                            $pdf->SetY($start_y);
                            $pdf->SetX(180);
                            $pdf->MultiCell(20, 5, '', 0, 'R', 0);
                            $outward_y = $pdf->GetY();
                        }
                    } else {
                        $inward_display = "";
                        if(!empty($unit_type)) {
                            if($unit_type == "Subunit") {
                                if(!empty($data['inward_subunit'])) { 
                                    $inward_display .= $data['inward_subunit'] . " " . ($obj->encode_decode('decrypt', $subunit_name)); 
                                    $total_inward_subunit += $data['inward_subunit'];
                                }
                            } else {
                                if(!empty($data['inward_unit'])) { 
                                    $multiplied_value = 0; $quotient = 0; $remainder = 0;
                                    if(!empty($data['case_contains']) && $data['case_contains'] != $GLOBALS['null_value']) {
                                        $multiplied_value = $data['inward_unit'] * $data['case_contains'];
                                        $quotient = floor($multiplied_value / $data['case_contains']); 
                                        $remainder = round(fmod($multiplied_value, $data['case_contains']));
                                    } else {
                                        $quotient = $data['inward_unit'];
                                    }
                                    if(!empty($quotient)) {
                                        $total_inward_unit += $quotient;
                                        $inward_display .= $quotient . " " . ($obj->encode_decode('decrypt', $unit_name));
                                    }
                                    if(!empty($quotient) && !empty($remainder)) {
                                        $inward_display .= " ";
                                    }
                                    if(!empty($remainder)) {
                                        $total_inward_subunit += $remainder;
                                        $inward_display .= $remainder . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    }
                                }
                            }
                        }  
                        
                        if(!empty($inward_display)) {
                            $pdf->SetY($start_y);
                            $pdf->SetX(140);
                            $pdf->MultiCell(30, 5, $inward_display, 0, 'R', 0);
                            $inward_y = $pdf->GetY();
                        } else {
                            $pdf->SetY($start_y);
                            $pdf->SetX(140);
                            $pdf->MultiCell(30, 5, '', 0, 'R', 0);
                            $inward_y = $pdf->GetY();
                        }

                        $outward_display = "";

                        if(!empty($unit_type)) {
                            if($unit_type == "Subunit") {
                                if(!empty($data['outward_subunit'])) { 
                                    $outward_display .= $data['outward_subunit'] . " " . ($obj->encode_decode('decrypt', $subunit_name)); 
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
                                        $outward_display .= $quotient . " " . ($obj->encode_decode('decrypt', $unit_name));
                                    }
                                    if(!empty($quotient) && !empty($remainder)) {
                                        $outward_display .= " ";
                                    }
                                    if(!empty($remainder)) {
                                        $total_outward_subunit += $remainder;
                                        $outward_display .= $remainder . " " . ($obj->encode_decode('decrypt', $subunit_name));
                                    }
                                }
                            }
                        }  

                        if(!empty($outward_display)) {
                            $pdf->SetY($start_y);
                            $pdf->SetX(170);
                            $pdf->MultiCell(30, 5, $outward_display, 0, 'R', 0);
                            $outward_y = $pdf->GetY();
                        } else {
                            $pdf->SetY($start_y);
                            $pdf->SetX(170);
                            $pdf->MultiCell(30, 5, '', 0, 'R', 0);
                            $outward_y = $pdf->GetY();
                        }
                    }

                    $max_y = max(array($date_y,$type_y,$remarks_y,$party_y,$magazine_y,$case_y,$inward_y, $outward_y));
                    $pdf->SetY($max_y);
                    $s_no++;
                    $start_y = $pdf->GetY();
                }
            }

            $end_y = $pdf->GetY();
            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(10,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(15,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(20,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(30,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(30,270 - $y_axis,'',1,0,'C');
                $pdf->Cell(25,270 - $y_axis,'',1,0,'C');
                if($subunit_hide == 1) {
                    $pdf->Cell(20,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,270-$y_axis,'',1,1,'C',0);
                } else {
                    $pdf->Cell(30,270-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(30,270-$y_axis,'',1,1,'C',0);
                }
                
                // $pdf->SetFont('Arial','B',9);
                // $next_page = $pdf->PageNo()+1;
                // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Sales Stock Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name). '  ( Sales stock : '.$current_stock . " " . $unit_name.  ')',1,1,'C',0);
                $product_start_y = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(10, 10, '#', 1, 0, 'C', 0);
                $pdf->Cell(15, 10, 'Date', 1, 0, 'C', 0);
                $pdf->Cell(20, 10, 'Type ', 1, 0, 'C', 0);
                $pdf->Cell(30, 10, 'Remarks', 1, 0, 'C', 0);
                $pdf->Cell(30, 10, 'Party', 1, 0, 'C', 0);
                $pdf->Cell(25, 10, 'Magazine', 1, 0, 'C', 0);
                if($subunit_hide == 1) {
                    $pdf->SetY($product_start_y);
                    $pdf->SetX(140);
                    $pdf->MultiCell(20, 5, 'Case Contains',0, 'C', 0);
                    $pdf->SetY($product_start_y);
                    $pdf->SetX(160);
                    $pdf->Cell(20, 10, 'Inward', 1, 0, 'C', 0);
                    $pdf->Cell(20, 10, 'Outward', 1, 1, 'C', 0);
                } else {
                    $pdf->SetY($product_start_y);
                    $pdf->SetX(140);
                    $pdf->Cell(30, 10, 'Inward', 1, 0, 'C', 0);
                    $pdf->Cell(30, 10, 'Outward', 1, 1, 'C', 0);
                }
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(10,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(15,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(25,$content_height - $y_axis,'',1,0,'C');
                if($subunit_hide == 1) {
                    $pdf->Cell(20,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,$content_height-$y_axis,'',1,1,'C',0);
                } else {
                    $pdf->Cell(30,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(30,$content_height-$y_axis,'',1,1,'C',0);
                }
                $pdf->SetY($content_height);
            } else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);                
                $pdf->Cell(10,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(15,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(20,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(30,$content_height - $y_axis,'',1,0,'C');
                $pdf->Cell(25,$content_height - $y_axis,'',1,0,'C');
                if($subunit_hide == 1) {
                    $pdf->Cell(20,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(20,$content_height-$y_axis,'',1,1,'C',0);
                } else {
                    $pdf->Cell(30,$content_height-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(30,$content_height-$y_axis,'',1,1,'C',0);
                }
            }

            if($subunit_hide == 1) {
                $pdf->SetFont('Arial','B',7);
                $pdf->SetX(10);
                $pdf->Cell(150,8,'Total Stock',1,0,'R',0);

                $inward_display = "";
                if(!empty($total_inward_unit)) {
                    $inward_display .= $total_inward_unit;
                    if(!empty($unit_name)) {
                        $inward_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                    }
                }
                if(!empty($total_inward_subunit)) {
                    $inward_display .= " " . $total_inward_subunit;
                    if(!empty($subunit_name)) {
                        $inward_display .= " " . $obj->encode_decode('decrypt', $subunit_name);
                    }
                }

                $inward_y = $pdf->GetY();
                if(!empty($inward_display)){
                    $pdf->SetX(160);
                    $pdf->MultiCell(20,4,$inward_display,0,'R',0);
                    $pdf->SetY($inward_y);
                    $pdf->SetX(160);
                    $pdf->Cell(20,8,'',1, 0,'R',0);
                } else {
                    $pdf->SetX(160);
                    $pdf->Cell(20,8,' - ',1,0,'R',0);
                }

                $outward_display = "";
                if(!empty($total_outward_unit)) {
                    $outward_display .= $total_outward_unit;
                    if(!empty($unit_name)) {
                        $outward_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                    }
                }
                if(!empty($total_outward_subunit)) {
                    $outward_display .= " " . $total_outward_subunit;
                    if(!empty($subunit_name)) {
                        $outward_display .= " " . $obj->encode_decode('decrypt', $subunit_name);
                    }
                }

                $pdf->SetY($inward_y);
                if(!empty($outward_display)){
                    $pdf->SetX(180);
                    $pdf->MultiCell(20,4,$outward_display,0,'R',0);
                    $pdf->SetY($inward_y);
                    $pdf->SetX(180);
                    $pdf->Cell(20,8,'',1, 1,'R',0);
                } else{
                    $pdf->SetX(180);
                    $pdf->Cell(20,8,' - ',1,1,'R',0);
                }
            } else {
                $pdf->SetFont('Arial','B',7);
                $pdf->SetX(10);
                $pdf->Cell(130,8,'Total Stock',1,0,'R',0);

                $inward_display = "";
                if(!empty($total_inward_unit)) {
                    $inward_display .= $total_inward_unit;
                    if(!empty($unit_name)) {
                        $inward_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                    }
                }
                if(!empty($total_inward_subunit)) {
                    $inward_display .= " " . $total_inward_subunit;
                    if(!empty($subunit_name)) {
                        $inward_display .= " " . $obj->encode_decode('decrypt', $subunit_name);
                    }
                }

                if(!empty($inward_display)){
                    $pdf->SetX(140);
                    $pdf->Cell(30,8,$inward_display,1,0,'R',0);
                } else {
                    $pdf->SetX(140);
                    $pdf->Cell(30,8,' - ',1,0,'R',0);
                }

                $outward_display = "";
                if(!empty($total_outward_unit)) {
                    $outward_display .= $total_outward_unit;
                    if(!empty($unit_name)) {
                        $outward_display .= " " . $obj->encode_decode('decrypt', $unit_name);
                    }
                }
                if(!empty($total_outward_subunit)) {
                    $outward_display .= " " . $total_outward_subunit;
                    if(!empty($subunit_name)) {
                        $outward_display .= " " . $obj->encode_decode('decrypt', $subunit_name);
                    }
                }

                if(!empty($outward_display)){
                    $pdf->SetX(170);
                    $pdf->Cell(30,8,$outward_display,1,1,'R',0);
                } else{
                    $pdf->SetX(170);
                    $pdf->Cell(30,8,' - ',1,1,'R',0);
                }
                // $pdf->SetFont('Arial','B',7);
                // $pdf->SetX(10);
                // $pdf->Cell(130,8,'Current Stock',1,0,'R',0);
                // $current_stock = 0;
                // $current_stock = $total_inward_unit - $total_outward_unit;
                // if(!empty($current_stock)){
                //     $pdf->SetX(140);
                //     $pdf->Cell(60,8,$current_stock,1,1,'C',0);
                // }
                // else{
                //     $pdf->SetX(140);
                //     $pdf->Cell(60,8,' - ',1,1,'C',0);
                // }
            }
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }
    
    $pdf_name = "Sales Stock Report (" . $current_date . ").pdf";
    $pdf->Output($from, $pdf_name);
?>