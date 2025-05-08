<?php

    include("../include_user_check.php");
    $current_date = date("Y-m-d");
    $from_date = ""; $to_date = ""; $search_text = ""; $show_bill = 0; $agent_id = ""; $transport_id = "";
    $customer_id = "";
    if(isset($_GET['from_date'])) {
        $from_date = $_GET['from_date'];
    }
    if(isset($_GET['to_date'])) {
        $to_date = $_GET['to_date'];
    }
    if(isset($_GET['show_bill'])) {
        $show_bill = $_GET['show_bill'];
    }
    if(isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];
    }

    if(isset($_GET['search_text'])) {
        $search_text = $_GET['search_text'];
    }
    if(isset($_GET['agent_id'])) {
        $agent_id = $_GET['agent_id'];
    }
    if(isset($_GET['transport_id'])) {
        $transport_id = $_GET['transport_id'];
    }

    $total_records_list = array();
    $total_records_list = $obj->getProfomaInvoiceList($from_date, $to_date, $customer_id, $search_text, $show_bill, $agent_id, $transport_id);
    
    if(!empty($search_text)) {
        $search_text = strtolower($search_text);
        $list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $val) {
                if( (strpos(strtolower($val['proforma_invoice_number']), $search_text) !== false) ) {
                    $list[] = $val;
                }
            }
        }
        $total_records_list = $list;
    }

    $company_logo = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $GLOBALS['bill_company_id'], 'logo');

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Proforma Invoice";
    include("rpt_header.php");
    
    $pdf->SetY($header_end);

    $bill_to_y = $pdf->GetY();

    $s_no = 1; $footer_height = 15; $height = 0; $l = 0; 
    $pdf->SetFont('Arial','B',8);

    if(!empty($total_records_list)) {
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        
        if(!empty($current_date)) {
            $current_date = date('d-m-Y', strtotime($current_date));
        }
        $starty = $pdf->GetY();
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(190,7,'Proforma Invoice - ( '.date('d-m-Y', strtotime($from_date)).' To '.date('d-m-Y', strtotime($to_date)).' )',1,1,'C',0);
        $pdf->SetX(10);
        $pdf->Cell(10,8,'#',1,0,'C',0);
        $pdf->Cell(65,8,'Bill No / Bill Date',1,0,'C',0);
        $pdf->Cell(65,8,'Customer Name',1,0,'C',0);
        $pdf->Cell(50,8,'Amount',1,1,'C',0);
        $pdf->SetFont('Arial','',7);
        
        $y_axis=$pdf->GetY();

        $s_no = "1"; $content_height = 0;
        if(!empty($total_amount)){
            $height -= 15;
            $footer_height += 15;
        }

        $sno = 1; $total_amount = 0;

        foreach($total_records_list as $key => $data) {
            $index = $key + 1;
            if($pdf->GetY() > 270) {
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);

                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);
                $page_number += 1;
                $total_pages[] = $page_number;
                $last_count = $l+1;

                $file_name="Proforma Invoice";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);

                $bill_to_y = $pdf->GetY();
                $pdf->SetY($bill_to_y);
                $starty = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Proforma Invoice - ( '.date('d-m-Y', strtotime($from_date)).' To '.date('d-m-Y', strtotime($to_date)).' )',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(10,8,'#',1,0,'C',0);
                $pdf->Cell(65,8,'Bill No / Bill Date',1,0,'C',0);
                $pdf->Cell(65,8,'Customer Name',1,0,'C',0);
                $pdf->Cell(50,8,'Amount',1,1,'C',0);
                $pdf->SetFont('Arial','',7);

                $y_axis=$pdf->GetY();
            }

            $pdf->SetX(10);
            $starty = $pdf->GetY();

            $pdf->Cell(10, 10, $s_no, 0, 0, 'C', 0); 

            if (!empty($data['proforma_invoice_number']) && $data['proforma_invoice_number'] != $GLOBALS['null_value']) {
                $pdf->SetX(20);
                $pdf->Cell(65, 5, $data['proforma_invoice_number'], 0, 1, 'C', 0);

                $pdf->SetX(20);
                $pdf->Cell(65, 5, date('d-m-Y', strtotime($data['proforma_invoice_date'])), 0, 0, 'C', 0);
            } else {
                $pdf->SetX(20);
                $pdf->Cell(65, 10, '', 0, 0, 'C', 0);
            }

            $bill_date_y = $pdf->GetY();

            $pdf->SetY($starty);
            if (!empty($data['customer_name_mobile_city']) && $data['customer_name_mobile_city'] != $GLOBALS['null_value']) {
                $pdf->SetX(85);
                $pdf->MultiCell(65, 10, $obj->encode_decode('decrypt', $data['customer_name_mobile_city']), 0, 'C', 0);
            } else {
                $pdf->SetX(85);
                $pdf->Cell(65, 10, '', 0, 0, 'C', 0);
            }
            $customer_name_y = $pdf->GetY();

            $pdf->SetY($starty);
            $pdf->SetX(150);
            $pdf->Cell(50, 10, !empty($data['bill_total']) ? $data['bill_total'] : '', 0, 1, 'C', 0);

            $total_amount += $data['bill_total'];

            $final_end_y = max($bill_date_y, $customer_name_y);
            $row_height = $final_end_y - $starty;

            $pdf->SetY($starty);
            $pdf->SetX(10);
            $pdf->Cell(10, $row_height, '', 1, 0);
            $pdf->Cell(65, $row_height, '', 1, 0);
            $pdf->Cell(65, $row_height, '', 1, 0);
            $pdf->Cell(50, $row_height, '', 1, 1);

            $s_no++;

        }

        $end_y = $pdf->GetY();

        $last_page_count = $s_no - $last_count;
        
        if(($footer_height+$end_y) >= 270){
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10,270-$y_axis,'',1,0,'C',0);
            $pdf->Cell(65,270-$y_axis,'',1,0,'C',0);
            $pdf->Cell(65,270-$y_axis,'',1,0,'C',0);
            $pdf->Cell(50,270-$y_axis,'',1,1,'C',0);

            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(285);
            $pdf->SetX(10);
            $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $file_name="Proforma Invoice";
            include("rpt_header.php");
            
            $pdf->SetY($header_end);
            $bill_to_y = $pdf->GetY();

            $pdf->SetFont('Arial','B',8);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(190,7,'Proforma Invoice - ( '.date('d-m-Y', strtotime($from_date)).' To '.date('d-m-Y', strtotime($to_date)).' )',1,1,'C',0);
            $pdf->SetX(10);
            $pdf->Cell(10,10,'#',1,0,'C',0);
            $pdf->Cell(65,8,'Bill No / Bill Date',1,0,'C',0);
            $pdf->Cell(65,8,'Customer Name',1,0,'C',0);
            $pdf->Cell(50,8,'Amount',1,1,'C',0);
            $pdf->SetFont('Arial','',7);
            
            $y_axis=$pdf->GetY();

            $content_height = 270 - $footer_height;
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10,($content_height-$y_axis),'',1,0);
            $pdf->Cell(65,($content_height-$y_axis),'',1,0);
            $pdf->Cell(65,($content_height-$y_axis),'',1,0);
            $pdf->Cell(50,($content_height-$y_axis),'',1,1);
            $pdf->SetY($content_height);
        } else {
            $content_height = 270 - $footer_height;
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10,($content_height-$y_axis),'',1,0);
            $pdf->Cell(65,($content_height-$y_axis),'',1,0);
            $pdf->Cell(65,($content_height-$y_axis),'',1,0);
            $pdf->Cell(50,($content_height-$y_axis),'',1,1);
        }
        
        $pdf->SetFont('Arial','B',8);
    
        $pdf->SetX(10);
        $pdf->Cell(140,8,'Total Amount',1,0,'R',0);
        if(!empty($total_amount)){
            $pdf->SetX(150);
            $pdf->Cell(50,8,number_format($total_amount, 2),1,1,'R',0);
        } else {
            $pdf->SetX(150);
            $pdf->Cell(50,8,' - ',1,1,'R',0);
        }
    }

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(285);
    $pdf->SetX(10);
    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    $pdf_name = "Stock Report (".$current_date.").pdf";
    $pdf->Output('', $pdf_name);
?>