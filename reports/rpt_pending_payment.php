<?php

    include("../include_user_check.php");

    $party_id = ""; 
    if(isset($_REQUEST['filter_party_id'])) {
        $party_id = $_REQUEST['filter_party_id'];
    }
    else {
        header("Location: ../pending_balance_report.php");
        exit;
    }

    $from_date =""; $to_date ="";
    if(!empty($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    if(!empty($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }
    $bill_company_id =$GLOBALS['bill_company_id'];
    if(isset($_REQUEST['filter_party_id'])) {
        $party_id = $_REQUEST['filter_party_id'];
    }

    $filter_agent_party = "";
    if(isset($_REQUEST['filter_agent_party'])){
        $filter_agent_party = $_REQUEST['filter_agent_party'];
    }

    $view_type = "";
    if(isset($_REQUEST['view_type'])){
        $view_type = $_REQUEST['view_type'];
    }

    $is_download ="";
    if(isset($_REQUEST['is_download']))
    {
        $is_download =$_REQUEST['is_download'];
    }

    $sales_list =array(); $total_records_list =array();
    $type ="";
    if($view_type == '1')
    {
        $type ="Agent";
    }
    elseif($view_type == '2')
    {
        $type = "Supplier";
    }
    elseif($view_type == '3')
    {
        $type ="Contractor";
    }
    elseif($view_type == '4')
    {
        $type ="Customer";
    }
    if(!empty($view_type))
    {
        $party_list = $obj->getPartyList($view_type);
    }
    // print_r($party_list);
    // echo $filter_party_id;
    if(!empty($party_id))
    {
        // $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
        // echo $party_name."hello";
        if(!empty($party_name)){
            // $total_records_list = $obj->balance_report($bill_company_id,$party_id,$from_date,$to_date);
            $total_records_list= $obj->balance_report($type,$party_id,$GLOBALS['bill_company_id'],'',$from_date,$to_date);
            $view_type = 2;
        }else{
            if(!empty($filter_agent_party)){
             
                $total_records_list= $obj->balance_report($type,$party_id,$GLOBALS['bill_company_id'],$filter_agent_party,$from_date,$to_date);
            }
            else{
                $total_records_list= $obj->balance_report($type,$party_id,$GLOBALS['bill_company_id'],'',$from_date,$to_date);
            }
        }
    }
    else {
        if(!empty($view_type))
        {
            $sales_list = ""; 
            $sales_list= $obj->balance_report($type,'',$GLOBALS['bill_company_id'],'',$from_date,$to_date);
        }
        else
        {   
            $sales_list = ""; 
            $sales_list= $obj->balance_report('','',$GLOBALS['bill_company_id'],'',$from_date,$to_date);

        }
    }

    if(empty($party_id)) {
        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        
        $yaxis = $pdf->GetY();

        $file_name="Pending Balance Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);
            
        $current_y = $pdf->GetY();

        $pdf->SetY($yaxis);
        $pdf->SetX(10);

        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,10,'Customer Wise Transaction - ('.date('d-m-Y').')',1,1,'C',0);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(15,10,'S.No.',1,0,'C',0);
        $pdf->SetX(25);
        $pdf->Cell(85,10,'Party Name',1,0,'C',0);
        $pdf->SetX(110);
        $pdf->Cell(45,10,'Credit',1,0,'C',0);
        $pdf->SetX(155);
        $pdf->Cell(45,10,'Debit',1,1,'C',0);
        $pdf->SetFont('Arial','',8);

        $index = 0;
      
        if(!empty($sales_list)) {
            $grand_pending = 0; $debit_amount =0; $debit_total =0; $debit_total_amount =0; $credit =0; $credit_amount =0; $credit_total =0; $credit_total_amount =0; $total = 0; $debit = 0; $grand_debit_total =0 ; $grand_credit_total =0;
            foreach($sales_list as $key => $data) {
                $credit_total = 0; $debit_total=0;
               
                if($pdf->GetY()>250){
                    $pdf->AddPage();
                    $yaxis = $pdf->GetY();
            
                    $file_name="Pending Balance Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell(0,10,'Customer Wise Transaction - ('.date('d-m-Y').')',1,1,'C',0);
                    $current_y = $pdf->GetY();
                    $pdf->SetY($yaxis);
                    $pdf->SetX(10);
                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    $pdf->Cell(15,10,'S.No.',1,0,'C',0);
                    $pdf->SetX(25);
                    $pdf->Cell(85,10,'Party Name',1,0,'C',0);
                    $pdf->SetX(110);
                    $pdf->Cell(45,10,'Credit',1,0,'C',0);
                    $pdf->SetX(155);
                    $pdf->Cell(45,10,'Debit',1,1,'C',0);
                    $pdf->SetFont('Arial','',8);

                }
                $index = $key + 1;  
                $name = ""; $pending = 0; $index = $key + 1;

                $z = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(15,10,$index,0,0,'C',0);
                
                $pdf->SetX(25);
                $pdf->Cell(85,10,html_entity_decode($obj->encode_decode('decrypt',$data['party_name']),ENT_QUOTES),0,0,'L',0); 
                if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Credit') ) {
                    $credit_total = $credit_total + $data['opening_balance'];
                    $credit = $credit + $credit_total;
                } 
                if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Debit') ) {
                    $debit_total = $debit_total + $data['opening_balance'];
                    $debit = $debit + $debit_total;
                }
                
                if(!empty($data['credit'])) {
                    $credit_total = $credit_total + $data['credit'];
                    $credit = $credit + $credit_total;
                }
                if(!empty($data['debit'])) {
                    $debit_total = $debit_total + $data['debit'];
                    $debit = $debit + $debit_total;
                }
                if($credit_total > $debit_total)
                {
                    $total_amount = $debit_total - $credit_total;
                }   
                else{
                    $total_amount = $credit_total - $debit_total;
                }
                 if($credit_total > $debit_total) { 
                    $total_amount = $credit_total  -$debit_total; 
                    $pdf->SetX(110);
                    $pdf->Cell(45,10,$obj->numberFormat(($total_amount),2),0,0,'R',0);
                     $credit_total_amount = $credit_total_amount + $total_amount; 
                }else{
                    $pdf->SetX(110);
                    $pdf->Cell(45,10,"-",0,0,'C',0);
                }
                if($debit_total > $credit_total){ 
                    $total_amount = $debit_total - $credit_total;
                    $pdf->SetX(155);
                    $pdf->Cell(45,10,$obj->numberFormat(($total_amount),2),0,0,'R',0);
                     $debit_total_amount = $debit_total_amount + $total_amount;
                }else{
                    $pdf->SetX(155);
                    $pdf->Cell(45,10,"-",0,0,'C',0);
                }
                $pdf->SetY($z);
                $pdf->SetX(10);
                $pdf->Cell(15,10,'',1,0,'C',0);
                $pdf->SetX(25);
                $pdf->Cell(85,10,'',1,0,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(45,10,'',1,0,'C',0);
                $pdf->SetX(155);
                $pdf->Cell(45,10,'',1,1,'C',0);

            }

            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(100,10,'Total',1,0,'R',0);
            $pdf->SetX(110);
            $pdf->Cell(45,10,$obj->numberFormat($credit_total_amount,2),1,0,'R',0);
            $pdf->SetX(155);
            $pdf->Cell(45,10,$obj->numberFormat($debit_total_amount,2),1,1,'R',0);
            $pdf->SetX(10);
            $pdf->Cell(100,10,'Current Balance',1,0,'R',0);

            if($credit_total_amount < $debit_total_amount)
            {
                $grand_debit_total = $debit_total_amount - $credit_total_amount;
    
            }   
            else{
                $grand_credit_total = $credit_total_amount - $debit_total_amount;
    
            }

                $pdf->SetX(110);
                $pdf->Cell(45,10,$obj->numberFormat($grand_credit_total,2),1,0,'R',0);
           
                $pdf->SetX(155);
                $pdf->Cell(45,10,$obj->numberFormat($grand_debit_total,2),1,0,'R',0);
            
        }
    }
    else{
        require_once('../fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Pending Balance Report');
        $pdf->SetFont('Arial','B',10);

        $yaxis = $pdf->GetY();

        $file_name="Pending Balance Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);

        $sy = $pdf->GetY();
        if(!empty($from_date)){
            $pdf->Cell(0,10,'Party Overall Pending - '.date('d-m-Y',strtotime($from_date))." - ".date('d-m-Y',strtotime($to_date)),0,1,'C',0);
        }else{
            $pdf->Cell(0,10,'Party Overall Pending - '.date('d-m-Y',strtotime($to_date)),0,1,'C',0);
        }

        $current_y = $pdf->GetY();

        $pdf->SetY($yaxis);
        $pdf->SetX(10);

        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $party_name = "";
        $pdf->SetFont('Arial', 'B', 10);

    if($view_type =='1'){
        $party_name = $obj->getTableColumnValue($GLOBALS['agent_table'], 'agent_id', $party_id, 'agent_name');
    }else if($view_type =='2'){
        $party_name = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $party_id, 'supplier_name');
    }
    else if($view_type =='3'){
        $party_name = $obj->getTableColumnValue($GLOBALS['contractor_table'], 'contractor_id', $party_id, 'contractor_name');
    }
    else if($view_type =='4'){
        $party_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $party_id, 'customer_name');
    }


        if(!empty($party_name)) { 
            $party_name = $obj->encode_decode('decrypt', $party_name);
            $pdf->SetX(10);
            $pdf->Cell(0,5,'Customer Name - '.html_entity_decode($party_name,ENT_QUOTES),1,1,'C',0); 
        }
        
        $pdf->SetFont('Arial','B',9);

        $pdf->SetX(10);
        $pdf->Cell(15,10,'S.No.',1,0,'C',0);
        $pdf->SetX(25);
        $pdf->Cell(25,10,'Date',1,0,'C',0);
        $pdf->SetX(50);
        $pdf->Cell(40,10,'Bill Number',1,0,'C',0);
        $pdf->SetX(90);
        $pdf->Cell(40,10,'Type',1,0,'C',0);
        $pdf->SetX(130);
        $pdf->Cell(35,10,'Credit',1,0,'C',0);
        $pdf->SetX(165);
        $pdf->Cell(35,10,'Debit',1,1,'C',0);
        $pdf->SetFont('Arial','',8);

        $index = 0;
        if(!empty($total_records_list)) {

            $credit_amount = 0; $debit_amount = 0;
            foreach($total_records_list as $key => $val) {
                if($pdf->GetY()>250){
                    $pdf->AddPage();
                    
                    $file_name="Pending Balance Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $current_y = $pdf->GetY();
            
                    $pdf->SetY($yaxis);
                    $pdf->SetX(10);
                    $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                    if(!empty($party_name)) { 
                        $party_name = $obj->encode_decode('decrypt', $party_name);
                        $pdf->SetX(10);
                        $pdf->Cell(0,5,'Customer Name - '.html_entity_decode($party_name,ENT_QUOTES),1,1,'C',0); 
                    }
                    
                    $party_name = "";
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetX(10);
                    $pdf->Cell(15,10,'S.No.',1,0,'C',0);
                    $pdf->SetX(25);
                    $pdf->Cell(25,10,'Date',1,0,'C',0);
                    $pdf->SetX(50);
                    $pdf->Cell(40,10,'Bill Number',1,0,'C',0);
                    $pdf->SetX(90);
                    $pdf->Cell(40,10,'Type',1,0,'C',0);
                    $pdf->SetX(130);
                    $pdf->Cell(35,10,'Credit',1,0,'C',0);
                    $pdf->SetX(165);
                    $pdf->Cell(35,10,'Debit',1,1,'C',0);
                    $pdf->SetFont('Arial','',8);
                    
                }
                $opening_balance_list = array();
                $opening_balance_list = $obj->getOpeningBalance($party_id,$from_date,$to_date,$GLOBALS['bill_company_id'],$filter_agent_party,$view_type);
                $opening_debit = 0; $opening_credit = 0;
                if(!empty($opening_balance_list)) {
                    foreach($opening_balance_list as $data) {
                        if(!empty($data['debit'])) {
                            $opening_debit += $data['debit'];
                        }
                        if(!empty($data['credit'])) {
                            $opening_credit += $data['credit'];
                        }
                        if($data['opening_balance_type'] == 'Credit') { 
                            $opening_credit += $data['opening_balance'];
                        } 
                        
                        if($data['opening_balance_type'] == 'Debit') { 
                            
                            $opening_debit += $data['opening_balance'];
                        } 
                    }
                }

                if(!empty($opening_debit) || !empty($opening_credit)) {

                    $pdf->Cell(120,10,'Opening Balance',1,0,'R',0);
                    if($opening_credit > $opening_debit) {
                        $credit_amount = $opening_credit - $opening_debit;
                        $pdf->Cell(35,10,$obj->numberFormat($credit_amount,2),1,0,'R',0); 
                        $pdf->Cell(35,10,'-',1,1,'C',0);
                    }
                    if($opening_debit > $opening_credit){
                        $debit_amount = $opening_debit - $opening_credit;
                        $pdf->Cell(35,10,'-',1,0,'C',0);
                        $pdf->Cell(35,10,$obj->numberFormat($debit_amount,2),1,1,'R',0);  
                    }  
                }
                if(!empty($val['bill_list'])) {
                    foreach($val['bill_list'] as $key => $data) {
                        if($pdf->GetY()>250){
                            $pdf->AddPage();
                            
                            $yaxis = $pdf->GetY();
                            $file_name="Pending Balance Report";
                            include("rpt_header.php");
                            
                            $pdf->SetY($header_end);
                            $pdf->SetX(10);

                            $pdf->SetFont('Arial','B',10);
                            $sy = $pdf->GetY();
                            $pdf->Cell(0,10,'Party Overall Pending - '.date('d-m-Y'),1,1,'C',0);

                            $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                            if(!empty($party_name)) { 
                                $party_name = $obj->encode_decode('decrypt', $party_name);
                                $pdf->SetX(10);
                                $pdf->Cell(0,5,'Customer Name - '.html_entity_decode($party_name,ENT_QUOTES),1,1,'C',0); 
                            }

                            $current_y = $pdf->GetY();
                            $party_name = "";
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->SetX(10);
                            $pdf->Cell(15,10,'S.No.',1,0,'C',0);
                            $pdf->SetX(25);
                            $pdf->Cell(25,10,'Date',1,0,'C',0);
                            $pdf->SetX(50);
                            $pdf->Cell(40,10,'Bill Number',1,0,'C',0);
                            $pdf->SetX(90);
                            $pdf->Cell(40,10,'Type',1,0,'C',0);
                            $pdf->SetX(130);
                            $pdf->Cell(35,10,'Credit',1,0,'C',0);
                            $pdf->SetX(165);
                            $pdf->Cell(35,10,'Debit',1,1,'C',0);
                            $pdf->SetFont('Arial','',8);
                            
                        }
                        $index = $key + 1;
                      
                        $pdf->SetX(10);
                        $pdf->Cell(15,10,$index,0,0,'C',0);
                        $pdf->SetX(25);
                        if(!empty($data['bill_date']))
                        {
                            $pdf->SetX(25);
                            $pdf->Cell(25,10,date('d-m-Y',strtotime($data['bill_date'])),0,0,'C',0);
                        }
                        
                        if(!empty($data['bill_number'])) {
                            $bill_number = $data['bill_number'];
                            if (!preg_match('/^[A-Fa-f0-9]{32,}$/', $bill_number) && !base64_decode($bill_number, true)) {
                                $pdf->SetX(50);
                                $pdf->Cell(40,10,$bill_number,0,0,'L',0);
                            }else{
                                $pdf->SetX(50);
                                $pdf->Cell(40,10,"-",0,0,'C',0);
                            }
                        }
                        if(!empty($data['bill_type'])) {
                            $pdf->SetX(90);
                            $pdf->Cell(40,10,$data['bill_type'],0,0,'L',0);
                        }
                        if(!empty($data['credit']))
                        {
                            $credit_amount+=$data['credit']; 
                            $pdf->SetX(130);
                            $pdf->Cell(35,10,$obj->numberFormat($data['credit'],2),0,0,'R',0);
                            
                        }else{
                            $pdf->SetX(130);
                            $pdf->Cell(35,10,"-",0,0,'C',0);
                        }
                        if(!empty($data['debit']))
                        {
                            $debit_amount+=$data['debit']; 
                            $pdf->SetX(165);
                            $pdf->Cell(35,10,$obj->numberFormat($data['debit'],2),0,0,'R',0);
                            
                        }else{
                            $pdf->SetX(165);
                            $pdf->Cell(35,10,"-",0,0,'C',0);
                        }

                        $pdf->SetX(10);
                        $pdf->Cell(15,10,'',1,0,'C',0);
                        $pdf->SetX(25);
                        $pdf->Cell(25,10,'',1,0,'C',0);
                        $pdf->SetX(50);
                        $pdf->Cell(40,10,'',1,0,'C',0);
                        $pdf->SetX(90);
                        $pdf->Cell(40,10,'',1,0,'C',0);
                        $pdf->SetX(130);
                        $pdf->Cell(35,10,'',1,0,'C',0);
                        $pdf->SetX(165);
                        $pdf->Cell(35,10,'',1,1,'C',0);
                            
                    }
                    
                }    
            }
            
            $display_status ="";
            $pdf->SetFont('Arial','B',8);

            if($credit_amount < $debit_amount )
            {
                $display_status="Current Balance";
            }   
            else{
                $display_status ="Current Balance";
            }
            $pdf->SetX(10);
            $pdf->Cell(120,10,'Total',1,0,'R',0);
            if(!empty($credit_amount)){ 
                $pdf->SetX(130);
                $pdf->Cell(35,10,$obj->numberFormat($credit_amount,2),0,0,'R',0);   
            } 
            if(!empty($debit_amount)){ 
                $pdf->SetX(165);
                $pdf->Cell(35,10,$obj->numberFormat($debit_amount,2),0,0,'R',0);
            }
            $pdf->SetX(130);
            $pdf->Cell(35,10,'',1,0,'R',0);
            $pdf->SetX(165);
            $pdf->Cell(35,10,'',1,1,'R',0);

            $pdf->SetX(10);
            $pdf->Cell(120,10,$display_status,1,0,'R',0);
            if($credit_amount > $debit_amount) { 
                $pdf->SetX(130);
                $pdf->Cell(35,10,$obj->numberFormat(($credit_amount  -$debit_amount),2),1,0,'R',0); 
                $pdf->SetX(165);
                $pdf->Cell(35,10,'',1,0,'R',0);
            } 
            if($debit_amount > $credit_amount){ 
                $pdf->SetX(130);
                $pdf->Cell(35,10,'',1,0,'R',0); 
                $pdf->SetX(165);
                $pdf->Cell(35,10,$obj->numberFormat(($debit_amount - $credit_amount),2),1,1,'R',0);
            }
        }

    }

    $excel_name = "Pending Balance Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";

    // if($is_download == '1')
    // {
        $pdf->Output($is_download, $excel_name.'.pdf');
    // }
    // else
    // {
    //     $pdf->OutPut();
    // }

?>

