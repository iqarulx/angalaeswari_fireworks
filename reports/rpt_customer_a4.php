<?php
    include("../include.php");

    $total_records_list = array();

    $search_text = "";
    if(isset($_REQUEST['search_text'])) {
        $search_text = $_REQUEST['search_text'];
    }

    $filter_agent_id = "";
    if(isset($_REQUEST['filter_agent_id'])) {
        $filter_agent_id = $_REQUEST['filter_agent_id'];
    }

    if(!empty($filter_agent_id)) {
        $total_records_list = $obj->getTableRecords($GLOBALS['customer_table'], 'agent_id', $filter_agent_id, 'DESC');
    }
    else {
        $total_records_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '', 'DESC');
    }
    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }
    
    if(!empty($search_text)) {
        $search_text = strtolower($search_text);
        $list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $val) {
                if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_city'])), $search_text) !== false) {
                    $list[] = $val;
                }
            }
        }
        $total_records_list = $list;
    }

    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    
    $file_name="Customer List";

    include("rpt_header.php");

    $pdf->SetFont('Arial','B',10);
    $pdf->SetX(10);
    $pdf->Cell(10,10,'S.No',1,0,'C');
    $pdf->SetX(20);
    $pdf->Cell(25,10,'Name',1,0,'C');
    $pdf->SetX(45);
    $pdf->Cell(20,10,'Mobile No.',1,0,'C');
    $pdf->SetX(65);
    $pdf->Cell(25,10,'Agent',1,0,'C');
    $pdf->SetX(90);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(20,10,'Identification',1,0,'C');
    $pdf->SetX(110);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,10,'Address',1,0,'C');
    $pdf->SetX(140);
    $pdf->Cell(20,10,'State',1,0,'C');
    $pdf->SetX(160);
    $pdf->Cell(20,10,'District',1,0,'C');
    $pdf->SetX(180);
    $pdf->Cell(20,10,'City',1,1,'C');
    $start_y = $pdf->GetY();

    if(!empty($total_records_list)) {
        foreach($total_records_list as $key => $list) {
            if($pdf->GetY() > 260) {
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Customer List";
                include("rpt_header.php");

                $pdf->SetFont('Arial','B',10);
                $pdf->SetX(10);
                $pdf->Cell(10,10,'S.No',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(25,10,'Name',1,0,'C');
                $pdf->SetX(45);
                $pdf->Cell(20,10,'Mobile No.',1,0,'C');
                $pdf->SetX(65);
                $pdf->Cell(25,10,'Agent',1,0,'C');
                $pdf->SetX(90);
                $pdf->Cell(20,10,'Identification',1,0,'C');
                $pdf->SetX(110);
                $pdf->Cell(30,10,'Address',1,0,'C');
                $pdf->SetX(140);
                $pdf->Cell(20,10,'State',1,0,'C');
                $pdf->SetX(160);
                $pdf->Cell(20,10,'District',1,0,'C');
                $pdf->SetX(180);
                $pdf->Cell(20,10,'City',1,1,'C');

                $start_y = $pdf->GetY();
            }
            $key = $key + 1;

            $name_y = ""; $id_y = ""; $address_y = ""; $state_y = ""; $district_y = ""; $city_y = "";
            $y_array = array(); $max_y = "";
            $pdf->SetFont('Arial','',8);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,6,$key,0,0,'C');

            if(!empty($list['customer_name'])) {
                $list['customer_name'] = html_entity_decode($obj->encode_decode('decrypt',$list['customer_name']));
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(25,6,$list['customer_name'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(25,6,'-',0,'C');
            }
            $name_y = $pdf->GetY() - $start_y;

            if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']) {
                $list['mobile_number'] = $obj->encode_decode('decrypt',$list['mobile_number']);
                $pdf->SetY($start_y);
                $pdf->SetX(45);
                $pdf->Cell(20,6,$list['mobile_number'],0,0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(45);
                $pdf->Cell(20,6,'-',0,0,'C');
            }

            if(!empty($list['agent_id']) && $list['agent_id'] != $GLOBALS['null_value']) {
                $list['agent_name'] = $obj->encode_decode('decrypt',$list['agent_name']);
                $pdf->SetY($start_y);
                $pdf->SetX(65);
                $pdf->Cell(25,6,$list['agent_name'],0,0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(65);
                $pdf->Cell(25,6,'-',0,0,'C');
            }

            if(!empty($list['identification']) && $list['identification'] != $GLOBALS['null_value']) {
                $list['identification'] = html_entity_decode($list['identification']);
                $pdf->SetY($start_y);
                $pdf->SetX(90);
                $pdf->MultiCell(20,6,$list['identification'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(90);
                $pdf->MultiCell(20,6,'-',0,'C');
            }
            $id_y = $pdf->GetY() - $start_y;

            if(!empty($list['address']) && $list['address'] != $GLOBALS['null_value']) {
                $list['address'] = html_entity_decode($obj->encode_decode('decrypt',$list['address']));
                $pdf->SetY($start_y);
                $pdf->SetX(110);
                $pdf->MultiCell(30,6,$list['address'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(110);
                $pdf->MultiCell(30,6,'-',0,'C');
            }
            $address_y = $pdf->GetY() - $start_y;

            if(!empty($list['state'])) {
                $list['state'] = $obj->encode_decode('decrypt',$list['state']);
                $pdf->SetY($start_y);
                $pdf->SetX(140);
                $pdf->MultiCell(20,6,$list['state'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(140);
                $pdf->MultiCell(20,6,'-',0,'C');
            }
            $state_y = $pdf->GetY() - $start_y;

            if(!empty($list['district']) && $list['district'] != $GLOBALS['null_value']) {
                $list['district'] = $obj->encode_decode('decrypt',$list['district']);
                $pdf->SetY($start_y);
                $pdf->SetX(160);
                $pdf->MultiCell(20,6,$list['district'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(160);
                $pdf->MultiCell(20,6,'-',0,'C');
            }
            $district_y = $pdf->GetY() - $start_y;

            if(!empty($list['city']) && $list['city'] != $GLOBALS['null_value']) {
                $list['city'] = $obj->encode_decode('decrypt',$list['city']);
                $pdf->SetY($start_y);
                $pdf->SetX(180);
                $pdf->MultiCell(20,6,$list['city'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(180);
                $pdf->MultiCell(20,6,'-',0,'C');
            }
            $city_y = $pdf->GetY() - $start_y;

            $y_array = array($name_y, $id_y, $address_y, $state_y, $district_y, $city_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(45);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(65);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(90);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(110);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(140);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(160);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(180);
            $pdf->Cell(20,$max_y,'',1,0,'C');

            $start_y += $max_y;
        }
    }
    
    $pdf->Output($from,'customer List.pdf');
?>