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
    $delivery_list = array(); 
    $delivery_slip_id = ""; $transport_name = "";
    $proforma_invoice_id = ""; $proforma_invoice_number = ""; $proforma_invoice_date = date('Y-m-d'); $delivery_slip_id = ""; $delivery_slip_number = ""; $delivery_slip_date = date('Y-m-d'); $customer_id = ""; $agent_id = ""; $transport_id = ""; $bank_id = ""; $magazine_type = ""; $magazine_id = ""; $gst_option = 0; $address = ""; $tax_option = ""; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $indv_magazine_ids = array(); $product_names = array();$unit_types = array(); $subunit_needs = array(); $contents = array(); $unit_ids = array(); $unit_names = array(); $quantity = array(); $old_quantity = array(); $rate = array(); $per = array(); $per_type = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $other_charges_id = array();$charges_type = array(); $other_charges_value = array(); $agent_commission = ""; $bill_total = ""; $charges_count = 0; $deleted = 0;
    if(isset($_REQUEST['delivery_slip_id'])) {
        $delivery_slip_id = $_REQUEST['delivery_slip_id'];
    }
    if(!empty($delivery_slip_id)) {
        $delivery_list = $obj->getDeliverySlipIndex($delivery_slip_id, 0);

        if(!empty($delivery_list)) {
            $ds = $delivery_list;
            if(!empty($ds['proforma_invoice_number'])) {
                $proforma_invoice_number = $ds['proforma_invoice_number'];
            }
            if(!empty($ds['delivery_slip_number'])) {
                $delivery_slip_number = $ds['delivery_slip_number'];
            }
            if(!empty($ds['customer_id'])) {
                $customer_id = $ds['customer_id'];
            }
            if(!empty($ds['customer_details'])) {
                $customer_details = $obj->encode_decode('decrypt', $ds['customer_details']);
                $customer_details = explode("$$$", $customer_details);
            }
            if(!empty($ds['proforma_invoice_date'])) {
                $proforma_invoice_date = date('d-m-Y', strtotime($ds['proforma_invoice_date']));
            }
            if(!empty($ds['delivery_slip_date'])) {
                $delivery_slip_date = date('d-m-Y', strtotime($ds['delivery_slip_date']));
            }
            if(!empty($ds['agent_id'])) {
                $agent_id = $ds['agent_id'];
            }
            if(!empty($ds['transport_id'])) {
                $transport_id = $ds['transport_id'];
                $transport_name = $obj->encode_decode('decrypt', $obj->getTableColumnValue($GLOBALS['transport_table'], 'transport_id', $transport_id, 'transport_name'));
            }
            if(!empty($ds['bank_id'])) {
                $bank_id = $ds['bank_id'];
            }
            if(!empty($ds['magazine_type'])) {
                $magazine_type = $ds['magazine_type'];
            }
            if(!empty($ds['magazine_id'])) {
                $magazine_id = $ds['magazine_id'];
            }
            if(!empty($ds['gst_option'])) {
                $gst_option = $ds['gst_option'];
            }
            if(!empty($ds['address'])) {
                $address = $ds['address'];
            }
            if(!empty($ds['tax_option'])) {
                $tax_option = $ds['tax_option'];
            }
            if(!empty($ds['tax_type'])) {
                $tax_type = $ds['tax_type'];
            }
            if(!empty($ds['overall_tax'])) {
                $overall_tax = $ds['overall_tax'];
            }
            if(!empty($ds['company_state'])) {
                $company_state = $ds['company_state'];
            }
            if(!empty($ds['party_state'])) {
                $party_state = $ds['party_state'];
            }

            if(!empty($ds['product_id'])) {
                $product_ids = $ds['product_id'];
                $product_ids = explode(",", $product_ids);
                $product_ids = array_reverse($product_ids);
            }
            if(!empty($ds['indv_magazine_id'])) {
                $indv_magazine_ids = $ds['indv_magazine_id'];
                $indv_magazine_ids = explode(",", $indv_magazine_ids);
                $indv_magazine_ids = array_reverse($indv_magazine_ids);
            }
            if(!empty($ds['product_name'])) {
                $product_names = $ds['product_name'];
                $product_names = explode(",", $product_names);
                $product_names = array_reverse($product_names);
            }
            if(!empty($ds['unit_type'])) {
                $unit_types = $ds['unit_type'];
                $unit_types = explode(",", $unit_types);
                $unit_types = array_reverse($unit_types);
            }
            if(!empty($ds['subunit_need'])) {
                $subunit_needs = $ds['subunit_need'];
                $subunit_needs = explode(",", $subunit_needs);
                $subunit_needs = array_reverse($subunit_needs);
            }
            if(!empty($ds['content'])) {
                $contents = $ds['content'];
                $contents = explode(",", $contents);
                $contents = array_reverse($contents);
            }
            if(!empty($ds['unit_id'])) {
                $unit_ids = $ds['unit_id'];
                $unit_ids = explode(",", $unit_ids);
                $unit_ids = array_reverse($unit_ids);
            }
            if(!empty($ds['unit_name'])) {
                $unit_names = $ds['unit_name'];
                $unit_names = explode(",", $unit_names);
                $unit_names = array_reverse($unit_names);
            }
            if(!empty($ds['quantity'])) {
                $quantity = $ds['quantity'];
                $quantity = explode(",", $quantity);
                $quantity = array_reverse($quantity);
            }
            if(!empty($ds['quantity'])) {
                $old_quantity = $ds['quantity'];
                $old_quantity = explode(",", $old_quantity);
                $old_quantity = array_reverse($old_quantity);
            }
            if(!empty($ds['rate'])) {
                $rate = $ds['rate'];
                $rate = explode(",", $rate);
                $rate = array_reverse($rate);
            }       
            if(!empty($ds['per'])) {
                $per = $ds['per'];
                $per = explode(",", $per);
                $per = array_reverse($per);
            }    
            if(!empty($ds['per_type'])) {
                $per_type = $ds['per_type'];
                $per_type = explode(",", $per_type);
                $per_type = array_reverse($per_type);
            }     
            if(!empty($ds['product_tax'])) {
                $product_tax = $ds['product_tax'];
                $product_tax = explode(",", $product_tax);
                $product_tax = array_reverse($product_tax);
            }     
            if(!empty($ds['final_rate'])) {
                $final_rate = $ds['final_rate'];
                $final_rate = explode(",", $final_rate);
                $final_rate = array_reverse($final_rate);
            }      
                
            if(!empty($ds['amount'])) {
                $amount = $ds['amount'];
                $amount = explode(",", $amount);
                $amount = array_reverse($amount);
            }

            if(!empty($ds['other_charges_id'])) {
                $other_charges_id = $ds['other_charges_id'];
                $other_charges_id = explode(",", $other_charges_id);
                $other_charges_id = array_reverse($other_charges_id);
                $charges_count = count($other_charges_id);
            }      
                
            if(!empty($ds['charges_type'])) {
                $charges_type = $ds['charges_type'];
                $charges_type = explode(",", $charges_type);
                $charges_type = array_reverse($charges_type);
            } 
            if(!empty($ds['other_charges_value'])) {
                $other_charges_value = $ds['other_charges_value'];
                $other_charges_value = explode(",", $other_charges_value);
                $other_charges_value = array_reverse($other_charges_value);
            }    
            if(!empty($ds['agent_commission'])) {
                $agent_commission = $ds['agent_commission'];
            }
            if(!empty($ds['deleted'])) {
                $deleted = $ds['deleted'];
            }
        }
    }

   
    $pdf_download_name ="";
    $pdf_download_name = "delivery Slip PDF";
    // require_once('../fpdf/fpdf.php');
    // $pdf = new FPDF('P','mm','A5');
    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A5');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();
    

    $pdf->SetTitle('Delivery Slip');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetY(5);
    $pdf->Cell(0, 5, 'Delivery Slip', 0, 1, 'C', 0);
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
                    $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                    $rt = $pdf->gety();
                } elseif (strpos(html_entity_decode($company_details[$i]), "GST") !== false) {
                    $pdf->sety($y);
                    $pdf->setx(105);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                } else {
                    $pdf->SetFont('Arial', '', 8);
                    // $pdf->sety($rt);
                    $pdf->SetX(50);
                    $pdf->MultiCell(40, 4, html_entity_decode($company_details[$i]), 0, 'C');
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
    
    if($deleted == '1') {
        if(file_exists('../include/images/cancelled.jpg')) {
            $pdf->SetAlpha(0.3);
            $pdf->Image('../include/images/cancelled.jpg',40,80,70,30);
            $pdf->SetAlpha(1);
        }
    } else {
        if(!empty($company_logo)) {
            $pdf->SetAlpha(0.2);
            if(!empty($company_logo)){
                if(file_exists('../include/images/upload/'.$company_logo)){
                    $pdf->Image('../include/images/upload/'.$company_logo,42,80,65,65);
                }
            }
            
            $pdf->SetAlpha(1);
        }
    }
    

    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(130,($end_y - 10),'',1,1,'C');
    $header_end = $pdf->GetY();

    // $pdf->SetY($header_end);

    $pdf->SetY($header_end);
    $pdf->Cell(20,8,'To :',0,1,'C',0);
    if (!empty($customer_details)) {
        for ($i = 0; $i < count($customer_details); $i++) {
            $customer_details[$i] = trim($customer_details[$i]);
            if (!empty($customer_details[$i]) && $customer_details[$i] != $GLOBALS['null_value']) {
                $pdf->SetX(20);
                $pdf->Cell(40,5,html_entity_decode($customer_details[$i]),0,1,'L',0);
            }
        }
    }

    $detials_y = $pdf->GetY();
    $pdf->SetY($header_end);
    $pdf->SetX(80);
    $pdf->Cell(20,10,'Bill Date',0,0,'L',0);
    $pdf->Cell(30,10,":  ".$proforma_invoice_date,0,1,'L',0);
    $pdf->SetX(80);
    $pdf->Cell(20,10,'Bill No',0,0,'L',0);
    $pdf->Cell(30,10,":  ".$delivery_slip_number,0,1,'L',0);
    if(!empty($transport_name)) {
        $pdf->SetX(80 );   
        $pdf->Cell(20,10,'Transport',0,0,'L',0);   
        $pdf->Cell(30,10,":  ".$transport_name,0,1,'L',0);
    }
    $bill_y = $pdf->GetY();

    if($detials_y > $bill_y) {
    $pdf->Line(75,$header_end,75, $detials_y);
    $pdf->SetY($detials_y);
    } else if($bill_y > $detials_y) {
        $pdf->SetY($bill_y);
    }

    $current_y = $pdf->GetY();
    $box_y = $pdf->GetY();

    $pdf->SetY($yaxis);
    $pdf->SetX(10);
    $pdf->Cell(130, ($current_y - $yaxis), '', 1, 1, 'L', 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($box_y);
    $pdf->SetX(10);
    $pdf->Cell(20,8,'S.No.',1,0,'C',0);
    $pdf->Cell(65,8,'Products',1,0,'C',0);
    $pdf->Cell(25,8,'Quantity',1,0,'C',0);
    $pdf->Cell(20,8,'contents',1,1,'C',0);
    
    $pdf->SetFont('Arial','',7);
    $y_axis=$pdf->GetY();

    $index = 0;
    $total_unit = $total_subunit = $purchase_subtotal = 0; $total_cal_y = 0; $unit_name_array = []; $sub_unit_name_array = [];

    for($i = 0; $i < count( $product_ids); $i++) {
        if($pdf->GetY() >= 190){
            $y = $pdf->GetY();
            $pdf->SetY(195);
            $pdf->SetX(10);

            $pdf->SetFont('Arial','B',10);
            $next_page = $pdf->PageNo() +1;
            $pdf->Cell(130,5,'Continued to Page Number '.$next_page,1,1,'R',0);
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $page_number += 1;
            $total_pages[] = $page_number;
            $yaxis = $pdf->GetY();
    

            $pdf->SetTitle('Delivery Slip');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(5);
            $pdf->Cell(0, 5, 'Delivery Slip', 0, 1, 'C', 0);
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
            $pdf->SetY($header_end);
            $pdf->Cell(20,8,'To :',0,1,'C',0);
            if (!empty($customer_details)) {
                for ($i = 0; $i < count($customer_details); $i++) {
                    $customer_details[$i] = trim($customer_details[$i]);
                    if (!empty($customer_details[$i]) && $customer_details[$i] != $GLOBALS['null_value']) {
                        $pdf->SetX(20);
                        $pdf->Cell(40,5,html_entity_decode($customer_details[$i]),0,1,'L',0);
                    }
                }
            }
        
            $detials_y = $pdf->GetY();
            $pdf->SetY($header_end);
            $pdf->SetX(80);
            $pdf->Cell(20,10,'Bill Date',0,0,'L',0);
            $pdf->Cell(30,10,":  ".$proforma_invoice_date,0,1,'L',0);
            $pdf->SetX(80);
            $pdf->Cell(20,10,'Bill No',0,0,'L',0);
            $pdf->Cell(30,10,":  ".$delivery_slip_number,0,1,'L',0);
            if(!empty($transport_name)) {
                $pdf->SetX(80);   
                $pdf->Cell(20,10,'Transport',0,0,'L',0);   
                $pdf->Cell(30,10,":  ".$transport_name,0,1,'L',0);
            }
            $bill_y = $pdf->GetY();
        
            if($detials_y > $bill_y) {
            $pdf->Line(75,$header_end,75, $detials_y);
            $pdf->SetY($detials_y);
            } else if($bill_y > $detials_y) {
                $pdf->SetY($bill_y);
            }
        
            $current_y = $pdf->GetY();
            $box_y = $pdf->GetY();
        
            $pdf->SetY($yaxis);
            $pdf->SetX(10);
            $pdf->Cell(130, ($current_y - $yaxis), '', 1, 1, 'L', 0);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($box_y);
            $pdf->SetX(10);
            $pdf->Cell(20,8,'S.No.',1,0,'C',0);
            $pdf->Cell(65,8,'Products',1,0,'C',0);
            $pdf->Cell(25,8,'Quantity',1,0,'C',0);
            $pdf->Cell(20,8,'contents',1,1,'C',0);
            
            $pdf->SetFont('Arial','',7);
            $y_axis=$pdf->GetY();
        }
        $index = $i + 1;
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_ids[$i], '');
        $unit_name = $subunit_name = "";
        if(!empty($product_list)) {
            foreach($product_list as $p_list) {
                if(!empty($p_list['unit_name'])) {
                    $unit_name = $obj->encode_decode('decrypt', $p_list['unit_name']);
                    $unit_name_array[] = $unit_name;
                }
                if(!empty($p_list['subunit_name']) && $p_list['subunit_name'] != $GLOBALS['null_value']) {
                    $subunit_name = $obj->encode_decode('decrypt',$p_list['subunit_name']);
                    $sub_unit_name_array[] = $unit_name;
                }
            }
        }
        $pdf->Cell(20,8,$index,1,0,'C',0);
        $pdf->Cell(65,8,html_entity_decode($obj->encode_decode('decrypt', $product_names[$i])),1,0,'C',0);
        $pdf->Cell(25,8,$quantity[$i].' '. ($unit_types[$i] == '1' ? $unit_name : $subunit_name),1,0,'C',0);
        $pdf->Cell(20,8,($contents[$i] != '' && $contents[$i] != 'NULL' ? $contents[$i] . ' '. $subunit_name : '-'),1,1,'C',0);
        if($unit_types[$i] == '1') {
            $total_unit = $total_unit + $quantity[$i];
        } else if($unit_types[$i] == '2') {
            $total_subunit = $total_subunit + $quantity[$i];
        }
    }        

    $pdf->Line(10, $y_axis, 10, 190);
    $pdf->Line(30, $y_axis, 30, 190);
    $pdf->Line(95, $y_axis, 95, 190);
    $pdf->Line(120, $y_axis, 120, 190);
    $pdf->Line(140, $y_axis, 140, 190);
    $pdf->SetY(190);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(10);
    $pdf->Cell(85,10,'Total',1,0,'R',0);

    $total_display = "";
    if(!empty($total_unit)) {
        $total_display = $total_unit;
        if(!empty($unit_name_array)) {
            $unique_unit_names = array_unique($unit_name_array);
            if(count($unique_unit_names) == 1) {
                $total_display .= " " . $unique_unit_names[0];
            }
        }
    }

    if(!empty($total_subunit)) {
        $total_display .= $total_subunit;
        if(!empty($sub_unit_name_array)) {
            $unique_sub_unit_names = array_unique($sub_unit_name_array);
            if(count($unique_sub_unit_names) == 1) {
                $total_display .= " " . $unique_sub_unit_names[0];
            }
        }
    }


    $pdf->Cell(45 ,10, $total_display ,1,1,'C',0);
    
    $pdf->Output('', $pdf_download_name . '.pdf');
?>