<?php
include("../include_user_check.php");
include("../include/number2words.php");


    $filter_party_id = "";
    if(isset($_REQUEST['filter_party_id'])) {
        $filter_party_id = $_REQUEST['filter_party_id'];
    }

    $from_date = "";
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    
    $to_date = "";
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $agent_id = "";
    if(isset($_REQUEST['agent_id'])) {
        $agent_id = $_REQUEST['agent_id'];
    }

    
    $transport_id = "";
    if(isset($_REQUEST['transport_id'])) {
        $transport_id = $_REQUEST['transport_id'];
    }

    $pdf_download_name ="";
    $pdf_download_name = "Sales Report PDF -"." (".$from_date ." to ".$to_date .")";

    $total_records_list = array();
    $total_records_list = $obj->getSalesReportList($from_date, $to_date, $filter_party_id, $agent_id, $transport_id);
    $from_date = date('d-m-Y',strtotime($from_date));
    $to_date = date('d-m-Y',strtotime($to_date));
    
    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();

    $file_name="Sales Report";
    include("rpt_header.php");
    
    $pdf->SetY($header_end);
           
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,5,'Sales Report - ('.$from_date.' - '.$to_date.')',0,1,'C',0);

    $current_y = $pdf->GetY();
    $box_y = $pdf->GetY();

    $pdf->SetY($yaxis);
    $pdf->SetX(10);

    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($box_y);
    $pdf->SetX(10);
    $pdf->Cell(20,10,'S.No.',1,0,'C',0);
    $pdf->Cell(60,10,'Bill Number & Date',1,0,'C',0);
    $pdf->Cell(80,10,'Party Name',1,0,'C',0);
    $pdf->Cell(30,10,'Amount',1,1,'C',0);
    $pdf->SetFont('Arial','',7);
    $content_start_y = $pdf->GetY();
    $index = 0;
    if(!empty($total_records_list)) {
        $edit_action = $obj->encode_decode('encrypt', 'edit_action');
        $product_count = 0; $quantity = ""; $grand_amount = 0;
        foreach($total_records_list as $key => $data) {
            if($pdf->GetY()>250){
                $closing_balance = $grand_amount;
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(160,10,'Closing Balance',1,0,'R',0);
                $pdf->Cell(30,10,$obj->numberFormat($closing_balance,2),1,1,'R',0);
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);
                $yaxis = $pdf->GetY();

                $file_name="Sales Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                    
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0,5,'Sales Report - ('.$from_date.' - '.$to_date.')',0,1,'C',0);
                $current_y = $pdf->GetY();
                $box_y = $pdf->GetY();


                $pdf->SetY($yaxis);
                $pdf->SetX(10);

                $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                $pdf->SetFont('Arial','B',10);
                $pdf->SetX(10);
                $pdf->Cell(20,10,'S.No.',1,0,'C',0);
                $pdf->Cell(60,10,'Bill Number & Date',1,0,'C',0);
                $pdf->Cell(80,10,'Party Name',1,0,'C',0);
                $pdf->Cell(30,10,'Amount',1,1,'C',0);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(160,10,'Opening Balance',1,0,'R',0);
                $pdf->Cell(30,10,$obj->numberFormat($closing_balance,2),1,1,'R',0);
                $pdf->SetFont('Arial','',8);
                $content_start_y = $pdf->GetY();
            }
            // echo $key."/";
            // $start_y = $pdf->getY();                

            $index = $key + 1;
            if(!empty($data['product_id'])) {
                $product_ids = explode(",", $data['product_id']);
                $product_count = count($product_ids);
            }
            if(!empty($data['quantity'])) {
                $quantity = explode(",", $data['quantity']);
            }
            if(!empty($data['unit_name'])) {
                $unit_names = explode(',',$data['unit_name']);
               $unit_names =array_reverse($unit_names);
           }
           if(!empty($data['product_name'])) {
                                                                            
            $product_names = explode(',',$data['product_name']);
            $product_names =array_reverse($product_names);
           }

            if(!empty($prefix)) { $index = $index + $prefix; }

            $start_y = $pdf->GetY();                

            $pdf->SetX(10);
            $pdf->Cell(20,10,$index,0,0,'C',0);
        
            if(!empty($data['estimate_number'])) {
                $pdf->SetX(30);
                $pdf->MultiCell(60,5,$data['estimate_number']."\n".date('d-m-Y',strtotime($data['estimate_date'])),0,'C',0);
            }
            $pdf->SetTextColor(255,0,0);
            // if (($data['cancelled']) == '1') {
            //     $pdf->SetX(30);
            //     $pdf->Cell(60,5,'Cancelled',0,1,'C',0);   
            // } else {
            //     $pdf->Cell(60,0,'',0,1,'C',0);   

            // }
            $pdf->SetTextColor(0,0,0);
            $date_end = $pdf->GetY();

            $pdf->SetY($start_y);   

            if(!empty($data['customer_name_mobile_city'])) {
                $party_name = $obj->encode_decode('decrypt',$data['customer_name_mobile_city']);
                $pdf->SetX(90);
                $pdf->MultiCell(80,10,($party_name),0,'C',0);
            }
            
            $qty_end =$pdf->GetY();
            $pdf->SetY($start_y); 

            if(!empty($data['bill_total'])) 
            { 
                $pdf->SetX(150);
                $pdf->MultiCell(50,10,number_format($data['bill_total'], 2),0,'R',0);
                if($data['cancelled'] == '0'){
                    $grand_amount += $data['bill_total'];
                }
            }
            $amt_end =$pdf->GetY();

            $max_y = max(array($date_end,$amt_end,$qty_end));
            $pdf->SetY($start_y);                            
            $pdf->SetX(10);
            $pdf->Cell(20,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(60,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(80,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(30,($max_y-$start_y),'',1,1,'C',0);
        }
        $pdf->Line(10, $content_start_y, 10, 270);
        $pdf->Line(30, $content_start_y, 30, 270);
        $pdf->Line(90, $content_start_y, 90, 270);
        $pdf->Line(170, $content_start_y, 170, 270);
        $pdf->Line(200, $content_start_y, 200, 270);
        $pdf->SetY(270);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(160,10,'Total',1,0,'R',0);
        $pdf->Cell(30
        ,10,number_format($grand_amount,2),1,1,'R',0);
    }

    $pdf->Output('',$pdf_download_name . '.pdf');

?>