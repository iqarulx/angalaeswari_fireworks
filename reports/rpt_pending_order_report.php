<?php

include("../include_user_check.php");

$current_date = date('Y-m-d');

$from_date = "";
if(isset($_POST['from_date'])) {
    $from_date = $_POST['from_date'];
} else {
    $from_date = date('Y-m-d', strtotime('-30 days'));
}

$to_date = "";
if(isset($_POST['to_date'])) {
    $to_date = $_POST['to_date'];
} else {
    $to_date = date('Y-m-d');
}

$unit_type = "";
if(isset($_GET['filter_unit_type'])) {
    $unit_type = $_GET['filter_unit_type'];
} else {
    $unit_type = "1";
}

$customer_id = "";
if(isset($_GET['filter_customer_id'])) {
    $customer_id = $_GET['filter_customer_id'];
}

$agent_id = "";
if(isset($_GET['filter_agent_id'])) {
    $agent_id = $_GET['filter_agent_id'];
}

$total_records_list = array();
$total_records_list = $obj->GetPendingOrderReportAgentWise($from_date, $to_date, $customer_id, $agent_id, $unit_type);

$date_display ="";
if($from_date == $to_date) {
    $date_display = '( ' . date('d-m-Y', strtotime($from_date)) . ' )';
} else {
    $date_display = '('.date('d-m-Y', strtotime($from_date)) . ' to '. date('d-m-Y', strtotime($to_date)) . ')';
}

$agent_display = "";
if(!empty($agent_id)) {
    $agent_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $agent_id, 'agent_name');
    if(!empty($agent_name)) {
        $agent_name = $obj->encode_decode('decrypt', $agent_name) ;
    }
    if(!empty($from_date) && !empty($to_date) && !empty($agent_name)) {
        $agent_display =  $agent_name . " (Pending Stock : " . date('d-m-Y', strtotime($from_date)) . " To " . date('d-m-Y', strtotime($to_date)) . ")";
    }
}

require_once('../fpdf/fpdf.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages(); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

$file_name = "Pending Order Report";
include("rpt_header.php");

$pdf->SetFont('Arial','B',9);
$pdf->SetX(10);
$pdf->Cell(190,7, (!empty($agent_id)) ?  $agent_display : 'Pending Order Report ' . $date_display ,1,1,'C',0);

$pdf->SetFont('Arial','B',7);
$y = $pdf->GetY();

$pdf->SetFillColor(101,114,122);
$pdf->SetTextColor(255,255,255);
$pdf->SetX(10);

$pdf->Cell(10,8,'#',1,0,'C',1);
$pdf->Cell(60,8,'Agent / Customer',1,0,'C',1);
$pdf->Cell(40,8,'Pending Stock',1,0,'C',1);
$pdf->Cell(40,8,'Ready Stock',1,0,'C',1);
$pdf->Cell(40,8,'Need Stock',1,1,'C',1);

$pdf->SetTextColor(0,0,0);
$start_y = $pdf->GetY();

$pdf->SetFont('Arial','',7);
$s_no = "1"; 

if (!empty($total_records_list)) {
    if(empty($product_id)) {
        $total_pending_order_unit = 0;
        $total_current_stock_unit = 0;
        $total_need_order_unit = 0;
    
        foreach($total_records_list as $record) {
            if($pdf->GetY() > 270) {
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(277);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
    
                $file_name = "Pending Order Report";
                include("rpt_header.php");
                
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Pending Order Report '.$date_display ,1,1,'C',0);
    
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                $pdf->Cell(10,8,'#',1,0,'C',1);
                $pdf->Cell(60,8,'Agent / Customer',1,0,'C',1);
                $pdf->Cell(40,8,'Pending Stock',1,0,'C',1);
                $pdf->Cell(40,8,'Ready Stock',1,0,'C',1);
                $pdf->Cell(40,8,'Need Stock',1,1,'C',1);
                
                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
            }
    
            $pdf->SetFont('Arial','',8);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetX(10);
            $pdf->Cell(10,5, $s_no , 0 , 0,'C',0);
    
            if(!empty($record['agent_id'])) {
                $agent_name = "";
                $agent_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $record['agent_id'], 'agent_name');
                $agent_name = $obj->encode_decode('decrypt', $agent_name);
    
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(60, 5, $agent_name, 0, 'L', 0);
                $pdf->SetTextColor(0,0,0);
            } else if(!empty($record['party_id'])) {
                $customer_name = "";
                $customer_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $record['party_id'], 'customer_name');
                $customer_name = $obj->encode_decode('decrypt', $customer_name);
    
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(60, 5, $customer_name, 0, 'L', 0);
                $pdf->SetTextColor(0,0,0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(60, 5, '-', 0, 'L', 0);
            }
    
            $agent_y = $pdf->GetY() - $start_y;
    
            if(!empty($record['pending_order_unit'])) {
                $pdf->SetY($start_y);
                $pdf->SetX(80);
                $pdf->MultiCell(40, 5, $record['pending_order_unit'], 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
                $total_pending_order_unit += $record['pending_order_unit'];
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(80);
                $pdf->MultiCell(40, 5, '-', 0, 'C', 0);
            }
            $pending_order_y = $pdf->GetY() - $start_y;
    
            if(!empty($record['current_stock_unit'])) {
                $pdf->SetY($start_y);
                $pdf->SetX(120);
                $pdf->MultiCell(40, 5, $record['current_stock_unit'], 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
                $total_current_stock_unit += $record['current_stock_unit'];
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(120);
                $pdf->MultiCell(40, 5, '-', 0, 'C', 0);
            }
            $current_stock_y = $pdf->GetY() - $start_y;
    
            if(!empty($record['need_order_unit'])) {
                $pdf->SetY($start_y);
                $pdf->SetX(160);
                $pdf->MultiCell(40, 5, $record['need_order_unit'], 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
                $total_need_order_unit += $record['need_order_unit'];
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(160);
                $pdf->MultiCell(40, 5, '-', 0, 'C', 0);
            }
            $need_order_y = $pdf->GetY() - $start_y;
    
            $y_array = array($agent_y, $pending_order_y, $current_stock_y, $need_order_y);
            $max_y = max($y_array);
    
            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(60,$max_y,'',1,0,'C');
            $pdf->SetX(80);
            $pdf->Cell(40,$max_y,'',1,0,'C');
            $pdf->SetX(120);
            $pdf->Cell(40,$max_y,'',1,0,'C');
            $pdf->SetX(160);
            $pdf->Cell(40,$max_y,'',1,1,'C');
    
            $start_y += $max_y;
            $pdf->SetY($start_y);
    
            $s_no++;
        }
    
        $pdf->SetX(10);
        $pdf->Cell(10,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(20);
        $pdf->Cell(60,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(80);
        $pdf->Cell(40,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(120);
        $pdf->Cell(40,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(160);
        $pdf->Cell(40,255-$pdf->GetY(),'',1,1,'C',0);
    
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(70,8,'Total',1,0,'R',0);
        if(!empty($total_pending_order_unit)) {
            $pdf->SetX(80);
            $pdf->Cell(40,8,$total_pending_order_unit,1,0,'R',0);
        } else {
            $pdf->SetX(80);
            $pdf->Cell(40,8,'-',1,0,'R',0);
        }
        if(!empty($total_current_stock_unit)) {
            $pdf->SetX(120);
            $pdf->Cell(40,8,$total_current_stock_unit,1,0,'R',0);
        } else {
            $pdf->SetX(120);
            $pdf->Cell(40,8,'-',1,1,'R',0);
        }
        if(!empty($total_need_order_unit)) {
            $pdf->SetX(160);
            $pdf->Cell(40,8,$total_need_order_unit,1,1,'R',0);
        } else {
            $pdf->SetX(160);
            $pdf->Cell(40,8,'-',1,1,'R',0);
        }
    } else {
        $total_inward = 0;
        $total_outward = 0;

        foreach($total_records_list as $record) {
            if($pdf->GetY() > 270) {
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(277);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
    
                $file_name = "Pending Order Report";
                include("rpt_header.php");
                
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(190,7, (!empty($product_id)) ?  $agent_display : 'Pending Order Report ' . $date_display ,1,1,'C',0);

                $pdf->SetFont('Arial','B',7);
                $y = $pdf->GetY();

                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                if(!empty($product_id)) {
                    $pdf->Cell(10,8,'#',1,0,'C',1);
                    $pdf->Cell(30,4,'Bill Number',0,1,'C',1);
                    $pdf->SetX(20);
                    $pdf->Cell(30,4,'Bill Type',0,0,'C',1);
                    $pdf->SetY($y);
                    $pdf->SetX(50);
                    $pdf->Cell(30,8,'Agent',1,0,'C',1);
                    $pdf->SetX(80);
                    $pdf->Cell(30,8,'Customer',1,0,'C',1);
                    $pdf->SetX(110);
                    $pdf->Cell(30,8,'Product',1,0,'C',1);
                    $pdf->SetX(140);
                    $pdf->Cell(20,8,'Contains',1,0,'C',1);
                    $pdf->SetX(160);
                    $pdf->Cell(20,8,'Inward ' . (!empty($unit_type) && $unit_type == "1" ? "Unit" : "Sub Unit"),1,0,'C',1);
                    $pdf->SetX(180);
                    $pdf->Cell(20,8,'Outward ' . (!empty($unit_type) && $unit_type == "1" ? "Unit" : "Sub Unit"),1,1,'C',1);
                
                } else {
                    $pdf->Cell(10,8,'#',1,0,'C',1);
                    $pdf->Cell(60,8,'Product',1,0,'C',1);
                    $pdf->Cell(40,8,'Pending Stock',1,0,'C',1);
                    $pdf->Cell(40,8,'Ready Stock',1,0,'C',1);
                    $pdf->Cell(40,8,'Need Stock',1,1,'C',1);
                }
                
                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
            }
    
            $pdf->SetFont('Arial','',8);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,5, $s_no , 0 , 0,'C',0);
    
            if(!empty($record['bill_number'])) {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->SetFont('Arial','',7);
                $pdf->MultiCell(30, 5, $record['bill_number'], 0, 'C', 0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(30, 5,'-', 0, 'C', 0);
            }
            $bill_number_y = $pdf->GetY() - $start_y;
            $bill_number_end_y = $pdf->GetY();

            if(!empty($record['bill_type'])) {
                $bill_type = "";
                $bill_type = $record['bill_type'];
                $pdf->SetY($bill_number_end_y);
                $pdf->SetX(20);
                $pdf->MultiCell(30, 5, $bill_type, 0, 'C', 0);
            } else {
                $pdf->SetY($bill_number_end_y);
                $pdf->SetX(20);
                $pdf->MultiCell(30, 5,'-', 0, 'C', 0);
            }
            $bill_type_y = $pdf->GetY() - $start_y;
    
            if(!empty($record['agent_id'])) {
                $name_mobile_city = "";
                $name_mobile_city = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $record['agent_id'], 'name_mobile_city');
                $name_mobile_city = $obj->encode_decode('decrypt', $name_mobile_city);

                $pdf->SetY($start_y);
                $pdf->SetX(50);
                $pdf->MultiCell(30, 5, $name_mobile_city, 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(50);
                $pdf->MultiCell(30, 5, '-', 0, 'C', 0);
            }
            $agent_y = $pdf->GetY() - $start_y;
    
            if(!empty($record['party_id'])) {
                $name_mobile_city = "";
                $name_mobile_city = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $record['party_id'], 'name_mobile_city');
                $name_mobile_city = $obj->encode_decode('decrypt', $name_mobile_city);

                $pdf->SetY($start_y);
                $pdf->SetX(80);
                $pdf->MultiCell(30, 5, $name_mobile_city, 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(80);
                $pdf->MultiCell(30, 5, '-', 0, 'C', 0);
            }
            $party_y = $pdf->GetY() - $start_y;

            if(!empty($record['product_id'])) {
                $product_name = "";
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $record['product_id'], 'product_name');
                $product_name = $obj->encode_decode('decrypt', $product_name);

                $pdf->SetY($start_y);
                $pdf->SetX(110);
                $pdf->MultiCell(30, 5, $product_name, 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(110);
                $pdf->MultiCell(30, 5, '-', 0, 'C', 0);
            }
            $agent_y = $pdf->GetY() - $start_y;

            if(!empty($record['case_contains'] && $record['case_contains'] != "NULL")) {
                $pdf->SetY($start_y);
                $pdf->SetX(140);
                $pdf->MultiCell(20, 5, $record['case_contains'], 0, 'C', 0);
                $pdf->SetTextColor(0,0,0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(140);
                $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
            }
    
            if($unit_type == "1") {
                if(!empty($record['inward_unit'] && $record['inward_unit'] != "NULL")) {
                    $pdf->SetY($start_y);
                    $pdf->SetX(160);
                    $pdf->MultiCell(20, 5, $record['inward_unit'], 0, 'R', 0);
                    $pdf->SetTextColor(0,0,0);
                    $total_inward += $record['inward_unit'];
                } else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(160);
                    $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                }
                $inward_y = $pdf->GetY() - $start_y;

                if(!empty($record['outward_unit']) && $record['outward_unit'] != "NULL") {
                    $pdf->SetY($start_y);
                    $pdf->SetX(180);
                    $pdf->MultiCell(20, 5, $record['outward_unit'], 0, 'R', 0);
                    $pdf->SetTextColor(0,0,0);
                    $total_outward += $record['outward_unit'];
                } else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(180);
                    $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                }
                $outward_y = $pdf->GetY() - $start_y;
            } else {
                if(!empty($record['inward_sub_unit']) && $record['inward_sub_unit'] != "NULL") {
                    $pdf->SetY($start_y);
                    $pdf->SetX(160);
                    $pdf->MultiCell(20, 5, $record['inward_sub_unit'], 0, 'R', 0);
                    $pdf->SetTextColor(0,0,0);
                    $total_inward += $record['inward_sub_unit'];
                } else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(160);
                    $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                }
                $inward_y = $pdf->GetY() - $start_y;

                if(!empty($record['outward_sub_unit']) && $record['outward_unit'] != "NULL") {
                    $pdf->SetY($start_y);
                    $pdf->SetX(180);
                    $pdf->MultiCell(20, 5, $record['outward_sub_unit'], 0, 'R', 0);
                    $pdf->SetTextColor(0,0,0);
                    $total_outward += $record['outward_sub_unit'];
                } else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(180);
                    $pdf->MultiCell(20, 5, '-', 0, 'C', 0);
                }
                $outward_y = $pdf->GetY() - $start_y;
            }
    
            $y_array = array($bill_number_y, $bill_type_y, $agent_y, $party_y, $agent_y, $inward_y, $outward_y);
            $max_y = max($y_array);
    
            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(50);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(80);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(110);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(140);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(160);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(180);
            $pdf->Cell(20,$max_y,'',1,1,'C');
    
            $start_y += $max_y;
            $pdf->SetY($start_y);
    
            $s_no++;
        }
    
        $pdf->SetX(10);
        $pdf->Cell(10,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->Cell(30,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(50);
        $pdf->Cell(30,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(80);
        $pdf->Cell(30,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(110);
        $pdf->Cell(30,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(140);
        $pdf->Cell(20,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(160);
        $pdf->Cell(20,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(180);
        $pdf->Cell(20,255-$pdf->GetY(),'',1,1,'C',0);
    
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(150,8,'Total',1,0,'R',0);
        if(!empty($total_inward)) {
            $pdf->SetX(160);
            $pdf->Cell(20,8,$total_inward,1,0,'R',0);
        } else {
            $pdf->SetX(160);
            $pdf->Cell(20,8,'-',1,0,'R',0);
        }
        if(!empty($total_outward)) {
            $pdf->SetX(180);
            $pdf->Cell(20,8,$total_outward,1,0,'R',0);
        } else {
            $pdf->SetX(180);
            $pdf->Cell(20,8,'-',1,1,'R',0);
        }
    }
}

/* End */
$pdf->SetFont('Arial','I',7);
$pdf->SetY(272);
$pdf->SetX(10);
$pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

$pdf_name = "Pending Order Report( ". $date_display." ).pdf";
$pdf->Output('', $pdf_name);
