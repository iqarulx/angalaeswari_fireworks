<?php
    include("../include.php");

    function getMultiCellHeight($pdf, $width, $lineHeight, $text) {
        // $fontFamily = $pdf->FontFamily;
        // $fontStyle = $pdf->FontStyle;
        // $fontSizePt = $pdf->FontSizePt;

        // $pdf->SetFont($fontFamily, $fontStyle, $fontSizePt); // Ensure font is set
        $lines = [];
        $words = preg_split('/\s+/', $text);
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine === '' ? $word : $currentLine . ' ' . $word;
            $lineWidth = $pdf->GetStringWidth($testLine);

            if ($lineWidth <= $width) {
                $currentLine = $testLine;
            } else {
                $lines[] = $currentLine;
                $currentLine = $word;
            }
        }

        if ($currentLine !== '') {
            $lines[] = $currentLine;
        }

        return count($lines) * $lineHeight;
    }


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
    $pdf->Cell(45,10,'Name',1,0,'C');
    $pdf->SetX(65);
    $pdf->Cell(30,10,'Mobile No.',1,0,'C');
    $pdf->SetX(95);
    $pdf->Cell(35,10,'Agent',1,0,'C');
    $pdf->SetX(130);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,10,'Identification',1,0,'C');
    $pdf->SetX(160);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40,10,'Address',1,1,'C');
    // $pdf->SetX(140);
    // $pdf->Cell(20,10,'State',1,0,'C');
    // $pdf->SetX(160);
    // $pdf->Cell(20,10,'District',1,0,'C');
    // $pdf->SetX(180);
    // $pdf->Cell(20,10,'City',1,1,'C');
    $start_y = $pdf->GetY();

    if(!empty($total_records_list)) {
        foreach($total_records_list as $key => $list) {
            $address_height = $start_y + getMultiCellHeight($pdf, 40, 6, $list['address']);

            if(($pdf->GetY() > 260) || ($address_height > 260)) {
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Customer List";
                include("rpt_header.php");

                $pdf->SetFont('Arial','B',10);
                $pdf->SetX(10);
                $pdf->Cell(10,10,'S.No',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(45,10,'Name',1,0,'C');
                $pdf->SetX(65);
                $pdf->Cell(30,10,'Mobile No.',1,0,'C');
                $pdf->SetX(95);
                $pdf->Cell(35,10,'Agent',1,0,'C');
                $pdf->SetX(130);
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(30,10,'Identification',1,0,'C');
                $pdf->SetX(160);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(40,10,'Address',1,1,'C');

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
                $pdf->MultiCell(45,6,html_entity_decode($list['customer_name']),0,'C');
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(45,6,'-',0,'C');
            }
            $name_y = $pdf->GetY() - $start_y;

            if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']) {
                $list['mobile_number'] = $obj->encode_decode('decrypt',$list['mobile_number']);
                $pdf->SetY($start_y);
                $pdf->SetX(65);
                $pdf->Cell(30,6,$list['mobile_number'],0,0,'C');
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(65);
                $pdf->Cell(30,6,'-',0,0,'C');
            }

            if(!empty($list['agent_id']) && $list['agent_id'] != $GLOBALS['null_value']) {
                $list['agent_name'] = $obj->encode_decode('decrypt',$list['agent_name']);
                $pdf->SetY($start_y);
                $pdf->SetX(95);
                $pdf->Cell(35,6,$list['agent_name'],0,0,'C');
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(95);
                $pdf->Cell(35,6,'-',0,0,'C');
            }

            if(!empty($list['identification']) && $list['identification'] != $GLOBALS['null_value']) {
                $list['identification'] = $obj->encode_decode('decrypt',$list['identification']);
                $list['identification'] = html_entity_decode($list['identification']);
                $pdf->SetY($start_y);
                $pdf->SetX(130);
                $pdf->MultiCell(30,6,$list['identification'],0,'C');
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(130);
                $pdf->MultiCell(30,6,'-',0,'C');
            }

            $id_y = $pdf->GetY() - $start_y;

            

            if(!empty($list['address']) && $list['address'] != $GLOBALS['null_value']) {
                $list['address'] = html_entity_decode($obj->encode_decode('decrypt',$list['address']));
                $list['address'] = str_replace("\r\n", ', ', $list['address']);
                $pdf->SetY($start_y);
                $pdf->SetX(160);
                $pdf->MultiCell(40,6,$list['address'],0,'C');
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(160);
                $pdf->MultiCell(40,6,'-',0,'C');
            }
            
            $address_y = $pdf->GetY() - $start_y;
            // echo "Y :".$key."-".$pdf->GetY()."<br>";
            // if(!empty($list['state'])) {
            //     $list['state'] = $obj->encode_decode('decrypt',$list['state']);
            //     $pdf->SetY($start_y);
            //     $pdf->SetX(140);
            //     $pdf->MultiCell(20,6,$list['state'],0,'C');
            // } else {
            //     $pdf->SetY($start_y);
            //     $pdf->SetX(140);
            //     $pdf->MultiCell(20,6,'-',0,'C');
            // }
            // $state_y = $pdf->GetY() - $start_y;

            // if(!empty($list['district']) && $list['district'] != $GLOBALS['null_value']) {
            //     $list['district'] = $obj->encode_decode('decrypt',$list['district']);
            //     $pdf->SetY($start_y);
            //     $pdf->SetX(160);
            //     $pdf->MultiCell(20,6,$list['district'],0,'C');
            // } else {
            //     $pdf->SetY($start_y);
            //     $pdf->SetX(160);
            //     $pdf->MultiCell(20,6,'-',0,'C');
            // }
            // $district_y = $pdf->GetY() - $start_y;

            // if(!empty($list['city']) && $list['city'] != $GLOBALS['null_value']) {
            //     $list['city'] = $obj->encode_decode('decrypt',$list['city']);
            //     $pdf->SetY($start_y);
            //     $pdf->SetX(180);
            //     $pdf->MultiCell(20,6,$list['city'],0,'C');
            // } else {
            //     $pdf->SetY($start_y);
            //     $pdf->SetX(180);
            //     $pdf->MultiCell(20,6,'-',0,'C');
            // }
            // $city_y = $pdf->GetY() - $start_y;

            $y_array = array($name_y, $id_y, $address_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(45,$max_y,'',1,0,'C');
            $pdf->SetX(65);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(95);
            $pdf->Cell(35,$max_y,'',1,0,'C');
            $pdf->SetX(130);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(160);
            $pdf->Cell(40,$max_y,'',1,0,'C');
            // $pdf->SetX(40);
            // $pdf->Cell(20,$max_y,'',1,0,'C');
            // $pdf->SetX(160);
            // $pdf->Cell(20,$max_y,'',1,0,'C');
            // $pdf->SetX(180);
            // $pdf->Cell(20,$max_y,'',1,0,'C');

            $start_y += $max_y;
        }
    }
    
    $pdf->Output($from,'customer List.pdf');
?>