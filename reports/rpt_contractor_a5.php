<?php
    include("../include.php");

    $company_list = array(); $company_details = "";
    $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
    if(!empty($company_list)){
        $company_details = $obj->encode_decode('decrypt',$company_list);
        $company_details = explode("$$$", $company_details);
    }

    $company_logo = "";
    $company_logo = $obj->getTableColumnValue($GLOBALS['company_table'],'primary_company','1','logo');

    $total_records_list = array();

    $search_text = "";
    if(isset($_REQUEST['search_text'])) {
        $search_text = $_REQUEST['search_text'];
    }

    $total_records_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '', 'DESC');

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
    $pdf = new FPDF('P','mm','A5');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    

    $pdf->SetTitle('Contractor List');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetY(5);
    $pdf->Cell(0, 5, 'Contractor List', 0, 1, 'C', 0);
    $pdf->SetFont('Arial', 'BI', 10);

    $y = $pdf->GetY(); 
    $pdf->SetFont('Arial','B',8);
    
    $pdf->SetY($y);
    $pdf->SetX(50);

    if (!empty($company_details)) {
        for ($i = 0; $i < count($company_details); $i++) {
            $company_details[$i] = trim($company_details[$i]);
            if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                
                if ($i === 0) {  // Corrected comparison
                    $pdf->SetFont('Arial', 'B', 11);
                    $pdf->MultiCell(50, 7, $company_details[$i], 0, 'C');
                    $rt = $pdf->gety();
                } elseif (strpos($company_details[$i], "GST") !== false) {
                    $pdf->sety($y);
                    $pdf->setx(105);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(35, 5, $company_details[$i], 0, 1, 'R', 0);
                } else {
                    $pdf->SetFont('Arial', '', 8);
                    // $pdf->sety($rt);
                    $pdf->SetX(50);
                    $pdf->MultiCell(40, 4, $company_details[$i], 0, 'C');
                      $end_y =$pdf->GetY();
                }
            }
        }
    }

    if(!empty($company_logo)) {
        if(file_exists('../include/images/upload/'.$company_logo)){
            $pdf->Image('../include/images/upload/'.$company_logo,15,15,20,20);
        }
    }

    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(130,($end_y - 10),'',1,1,'C');
    $header_end = $pdf->GetY();

    $pdf->SetY($header_end);

    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(10);
    $pdf->Cell(15,10,'S.No',1,0,'C');
    $pdf->SetX(25);
    $pdf->Cell(35,10,'Name',1,0,'C');
    $pdf->SetX(60);
    $pdf->Cell(30,10,'Mobile Number',1,0,'C');
    $pdf->SetX(90);
    $pdf->Cell(50,10,'Location',1,1,'C');
    
    $start_y = $pdf->GetY();

    if(!empty($total_records_list)) {
        foreach($total_records_list as $key => $list) {
           
            if ($pdf->GetY() >= 180) {
                $y = $pdf->GetY();
                $pdf->SetY($start_y);
                $pdf->SetX(10);
               
                    $pdf->Cell(15, 185 - $start_y, '', 1, 0, 'C', 0);
                    $pdf->Cell(35, 185 - $start_y, '', 1, 0, 'C', 0);
                    $pdf->Cell(30, 185 - $start_y, '', 1, 0, 'C', 0);
                    $pdf->Cell(50, 185 - $start_y, '', 1, 1, 'C', 0);
                    
               
                $pdf->SetFont('Arial', 'B', 9);
    
                $next_page = $pdf->PageNo() + 1;
    
                $pdf->Cell(130, 6, 'Continued to Page Number ' . $next_page, 1, 1, 'R', 0);
                $pdf->AddPage();
                $page_number += 1;
                $total_pages[] = $page_number;
                // $last_count = $p + 1;
                $last_count = $key + 1;
                $pdf->SetTitle('Contarctor List');
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetY(5);
                $pdf->Cell(0, 5, 'Contarctor List', 0, 1, 'C', 0);
                $pdf->SetFont('Arial', 'BI', 10);
    
                $y = $pdf->GetY(); 
                $pdf->SetFont('Arial','B',8);
                
                $pdf->SetY($y);
                $pdf->SetX(50);

                if (!empty($company_details)) {
                    for ($i = 0; $i < count($company_details); $i++) {
                        $company_details[$i] = trim($company_details[$i]);
                        if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                            
                            if ($i === 0) {  // Corrected comparison
                                $pdf->SetFont('Arial', 'B', 11);
                                $pdf->MultiCell(50, 7, $company_details[$i], 0, 'C');
                                $rt = $pdf->gety();
                            } elseif (strpos($company_details[$i], "GST") !== false) {
                                $pdf->sety($y);
                                $pdf->setx(105);
                                $pdf->SetFont('Arial', 'B', 8);
                                $pdf->Cell(35, 5, $company_details[$i], 0, 1, 'R', 0);
                            } else {
                                $pdf->SetFont('Arial', '', 8);
                                // $pdf->sety($rt);
                                $pdf->SetX(50);
                                $pdf->MultiCell(40, 4, $company_details[$i], 0, 'C');
                                $end_y =$pdf->GetY();
                            }
                        }
                    }
                }

                if(!empty($company_logo)) {
                    if(file_exists('../include/images/upload/'.$company_logo)){
                        $pdf->Image('../include/images/upload/'.$company_logo,15,15,20,20);
                    }
                }

                $pdf->SetY(10);
                $pdf->SetX(10);
                $pdf->Cell(130,($end_y - 10),'',1,1,'C');
                $header_end = $pdf->GetY();

                $pdf->SetY($header_end);               
    
                $pdf->Cell(15,10,'S.No',1,0,'C');
                $pdf->SetX(25);
                $pdf->Cell(35,10,'Name',1,0,'C');
                $pdf->SetX(60);
                $pdf->Cell(30,10,'Mobile Number',1,0,'C');
                $pdf->SetX(90);
                $pdf->Cell(50,10,'Location',1,1,'C');
                
                
                $pdf->SetFont('Arial', '', 8);
    
                $start_y = $pdf->GetY();
            }
            $key = $key + 1;

            $name_y = "";  $address_y = ""; 
            $y_array = array(); $max_y = "";
            $pdf->SetFont('Arial','',8);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(15,6,$key,0,0,'C');

            if(!empty($list['contractor_name'])) {
                $list['contractor_name'] = html_entity_decode($obj->encode_decode('decrypt',$list['contractor_name']));
                $pdf->SetY($start_y);
                $pdf->SetX(25);
                $pdf->MultiCell(35,6,$list['contractor_name'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(25);
                $pdf->MultiCell(35,6,'-',0,'C');
            }
            $name_y = $pdf->GetY() - $start_y;

            if(!empty($list['mobile']) && $list['mobile'] != $GLOBALS['null_value']) {
                $list['mobile'] = $obj->encode_decode('decrypt',$list['mobile']);
                $pdf->SetY($start_y);
                $pdf->SetX(60);
                $pdf->Cell(30,6,$list['mobile'],0,0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(60);
                $pdf->Cell(30,6,'-',0,0,'C');
            }

            if(!empty($list['location']) && $list['location'] != $GLOBALS['null_value']) {
                $list['location'] = html_entity_decode($obj->encode_decode('decrypt',$list['location']));
                $pdf->SetY($start_y);
                $pdf->SetX(90);
                $pdf->MultiCell(50,6,$list['location'],1,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(90);
                $pdf->MultiCell(50,6,'-',0,'C');
            }
            $address_y = $pdf->GetY() - $start_y;

            
            $y_array = array($name_y, $address_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(15,$max_y,'',1,0,'C');
            $pdf->SetX(25);
            $pdf->Cell(35,$max_y,'',1,0,'C');
            $pdf->SetX(60);
            $pdf->Cell(30,$max_y,'',1,0,'C');
            $pdf->SetX(90);
            $pdf->Cell(50,$max_y,'',1,1,'C');
            
            $start_y += $max_y;
        }
        
    }
    
    $pdf->Output($from,'Contractor List.pdf');
?>