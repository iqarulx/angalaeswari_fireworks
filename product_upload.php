<?php
    include("include_user_check.php");
   
    if(isset($_REQUEST['show_upload_excel'])) {
		$show_upload_excel = $_REQUEST['show_upload_excel'];
		if(!empty($show_upload_excel) && $show_upload_excel == 1) { ?>
			<form class="py-4 poppins pd-20" name="excel_upload_form" method="POST">
                <div class="col-12 my-3">
                    <div class="excel_back_upload_details back_button">
                        <button  onclick="window.open('product.php','_self')" style="font-size:11px;color:white;padding:5px 7px;margin-left:24px;" class=" btn btn-danger" type="button"><i class="fa fa-chevron-circle-left"></i> Back</button>
                        <span  style="color:green;">Per Type 1 means Unit , </span><br>
                        <span style="color:green;">Per Type 2 means Subunit  </span><br>
                        <span style="color:green;">Group 1 means Raw Material  </span><br>
                        <span style="color:green;">Group 2 means Semi Fineshed  </span><br>
                        <span style="color:green;">Group 3 means Fineshed  </span><br>
                    </div>
                </div>
                <div class="col-12 my-3" style="position: relative;">
                    <div class="excel_upload_details" style="display: none;">
                        <span class="excel_upload_count"></span> upload in out of <span class="excel_upload_total_count"></span>
                    </div>
                </div>
				<div class="col-lg-11">
					<div class="col-12">
                        <input type="hidden" name="upload_row_index" value="1">
						<div class="table-responsive">
							<table id="excel_upload_details_table" class="data-table table tablefont" style="margin: auto;width:1355px;">
                                <tbody>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center; width: 50px;">S.No</th>
                                            <th style="text-align: center; width: 125px;">Group</th>
                                            <th style="text-align: center; width: 125px;">Product Name</th>
                                            <th style="text-align: center; width: 125px;">HSN Code</th>
                                            <th style="text-align: center; width: 125px;">Unit</th>
                                            <th style="text-align: center; width: 125px;">SubUnit</th>
                                            <th style="text-align: center; width: 125px;">Case Rate</th>                 
                                            <th style="text-align: center; width: 125px;">Per</th>                 
                                            <th style="text-align: center; width: 125px;">Per Type</th>   
                                        </tr>
                                    </thead>
								</tbody>
							</table>
						</div>
					</div>
                    <!-- <div class="col-12 my-3" style="position: relative;">
                        <div class="excel_upload_details" style="display: none;">
                            <span class="excel_upload_count"></span> upload in out of <span class="excel_upload_total_count"></span>
                        </div>
                    </div> -->
					
					<div class="col-md-12 pt-3 text-center">
						<button class="btn btn-primary btnwidth submit_button" disabled type="button" onClick="Javascript:UploadExcelData(event, 'excel_upload_form');">Submit</button>
					</div>
				</div>
			</form>
<?php			
		}
	}

    if(isset($_REQUEST['excel_row_index'])) {
        $excel_row_index = ""; $excel_row_values = ""; $sno = ""; $hsn_code = ""; $group = "";$product_name = ""; $product_name_error = ""; $unit_id = ""; $unit_id_error = "";  $unit_name = ""; $unit_name_error = ""; $upload_type = ""; $purchase_price = ""; $purchase_price_error = ""; $case_rate = ""; $case_rate_error = "";  $per = ""; $per_error = ""; $per_type = ""; $per_type_error = "";
       $product_error="";

        if(isset($_REQUEST['upload_type'])){
            $upload_type = $_REQUEST['upload_type'];
        }

        $excel_row_index = $_REQUEST['excel_row_index'];
        $excel_row_index = trim($excel_row_index);

		$excel_row_values = $_REQUEST['excel_row_values'];
		$excel_row_values = trim($excel_row_values);


        if(!empty($excel_row_values)) {
            $excel_row_values = json_decode($excel_row_values);
            
            if($excel_row_values['0'] != "undefined" && $excel_row_values['0'] != $GLOBALS['null_value']) {
				$sno = trim($excel_row_values['0']);
			}

            if($excel_row_values['1'] != "undefined" && $excel_row_values['1'] != $GLOBALS['null_value']) {
				$group = trim($excel_row_values['1']);
			}

            if(!empty($excel_row_values['2']) && $excel_row_values['2'] != 'undefined' && $excel_row_values['2'] != $GLOBALS['null_value']){
                $excel_row_values['2']=trim($excel_row_values['2']);
                $product_name = $excel_row_values['2'];
				$product_name_error = $valid->valid_product_name($product_name, "Product Name", "1","50");              
            }

            if(!empty($excel_row_values['3']) && $excel_row_values['3'] != 'undefined' && $excel_row_values['3'] != $GLOBALS['null_value']){
                $excel_row_values['3']=trim($excel_row_values['3']);
                $hsn_code = $excel_row_values['3'];
				$hsn_code_error = $valid->valid_hsn($hsn_code, "HSN Code", "1");
            }

            if(!empty($excel_row_values['4']) && $excel_row_values['4'] != 'undefined' && $excel_row_values['4'] != $GLOBALS['null_value']){
                $excel_row_values['4']=trim($excel_row_values['4']);
                $unit_name = $excel_row_values['4'];
				$unit_name_error = $valid->valid_text($unit_name, "Unit Name", "1");
            }
        
            if(!empty($excel_row_values['5']) && $excel_row_values['5'] != 'undefined' && $excel_row_values['5'] != $GLOBALS['null_value']){
                $excel_row_values['5']=trim($excel_row_values['5']);
                $subunit_name = $excel_row_values['5'];
				$subunit_name_error = $valid->valid_text($subunit_name, "SubUnit Name", "0");
            }

            if(!empty($excel_row_values['6']) && $excel_row_values['6'] != "undefined" && $excel_row_values['6'] != $GLOBALS['null_value']) {
                $excel_row_values['6'] = trim($excel_row_values['6']);
                $case_rate = $excel_row_values['6'];
                $case_rate_error = $valid->valid_price($case_rate, "Case Rate", "1","8");                 
			}

            if(!empty($excel_row_values['7']) && $excel_row_values['7'] != "undefined" && $excel_row_values['7'] != $GLOBALS['null_value']) {
                $excel_row_values['7'] = trim($excel_row_values['7']);
                $per = $excel_row_values['7'];
                $per_error = $valid->valid_price($per, "Per", "0","4");                 
			}

            if(!empty($excel_row_values['8']) && $excel_row_values['8'] != "undefined" && $excel_row_values['8'] != $GLOBALS['null_value']) {
                $excel_row_values['8'] = trim($excel_row_values['8']);
                $per_type = $excel_row_values['8'];
                $per_type_error = $valid->valid_price($per_type, "Per Type", "0","1");                 
			}
         
        }

        $row_id = date("dmyhis")."_".$excel_row_index;

        ?>
    
        <tr id="<?php if(!empty($row_id)) { echo $row_id; } ?>" class="excel_row">
            <td style="width: 10px; text-align: center;">
                <?php if(!empty($sno)) { echo $sno; } ?>
                <input type="hidden" name="excel_upload_type" value="<?php if(!empty($upload_type)) { echo $upload_type; } ?>" placeholder="excel_upload_type">
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="group" value="<?php if(!empty($group)) { echo $group; } ?>" placeholder="Group number" maxlength="1">
                <?php if(!empty($group_error)) { ?>
                <span class="infos"><?php $group_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="product_name" value="<?php if(!empty($product_name)) { echo $product_name; } ?>" placeholder="Product Name" onfocus="Javascript:KeyboardControls(this,'text',25,'');">
                <?php if(!empty($product_name_error)) { ?>
                <span class="infos"><?php $product_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="hsn_code" value="<?php if(!empty($hsn_code)) { echo $hsn_code; } ?>" placeholder="HSN Code" onfocus="Javascript:KeyboardControls(this,'text',25,'');">
                <?php if(!empty($hsn_code_error)) { ?>
                <span class="infos"><?php $hsn_code_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="unit_name" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>" placeholder="Unit Name" onfocus="Javascript:KeyboardControls(this,'text',25,'');">
                <?php if(!empty($unit_name_error)) { ?>
                <span class="infos"><?php $unit_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="subunit_name" value="<?php if(!empty($subunit_name)) { echo $subunit_name; } ?>" placeholder="SubUnit Name" onfocus="Javascript:KeyboardControls(this,'text',25,'');">
                <?php if(!empty($subunit_name_error)) { ?>
                <span class="infos"><?php $subunit_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="case_rate" value="<?php if(!empty($case_rate)) { echo $case_rate; } ?>" placeholder="Case Rate" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                <?php if(!empty($case_rate_error)) { ?>
                <span class="infos"><?php $case_rate_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="per" value="<?php if(!empty($per)) { echo $per; } ?>" placeholder="Per" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                <?php if(!empty($per_error)) { ?>
                <span class="infos"><?php $per_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="per_type" value="<?php if(!empty($per_type)) { echo $per_type; } ?>" placeholder="Per Type" maxlength="1" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                <?php if(!empty($per_type_error)) { ?>
                <span class="infos"><?php $per_type_error; ?></span>
                <?php } ?>
            </td>
            <td class="excel_upload_status" style="width: 50px;"></td>
        </tr>
<?php
    }

    if(isset($_REQUEST['product_name'])) {
       $product_name = ""; $product_name_error = ""; $unit_name = ""; $unit_name_error = ""; $excel_upload_type=""; $subunit_contains = ""; $subunit_contains_error = "";$case_rate = ""; $case_rate_error = "";$subunit_name = ""; $subunit_name_error = "";  $per = ""; $per_error = ""; $per_type = ""; $per_type_error = "";
        $excel_upload_error = ""; $subunit_need = 1;
        $hsn_code = $hsn_code_error = "";
        $group = $group_error = $group_id = $group_name = "";
        
        if(isset($_REQUEST['excel_upload_type'])){
            $excel_upload_type = $_REQUEST['excel_upload_type'];
        }

        if(isset($_REQUEST['product_name'])){
            $product_name = $_REQUEST['product_name'];

            $product_name = trim($product_name);
            $product_name = str_replace("_____","#",$product_name);
            $product_name = str_replace("____","+",$product_name);
            $product_name = str_replace("___","&",$product_name);
            $product_name = str_replace("__",'"',$product_name);
            $product_name = str_replace("_","'",$product_name);

            if(empty($product_name)){
                $excel_upload_error = "Enter the Product Name";
            }
            if(!empty($product_name)){
                if(!empty($product_name) && strlen($product_name) > 50) {
                    $product_name_error = "Product - Max.Character Count : 50";
                }
                else if(!preg_match("/^(?!\d+$)[a-zA-Z\d][\w'\"\s\(\)\-\.@\&\/\\\]+$/",$product_name)){
                    $product_name_error = "Invalid Product Name";
                }
               
            }
            

            if(!empty($product_name_error) ) {
                if(!empty($excel_upload_error)) {
                    $excel_upload_error = $excel_upload_error." ".$product_name_error;
                }
                else {
                    $excel_upload_error = $product_name_error;
                }
            }
        }

        if(isset($_REQUEST['group'])){
            $group = $_REQUEST['group'];
            $group = trim($group);
            $group_error = $valid->valid_number($group, "Group", "1");
            
            if (!empty($group)) {
                $valid_types = ['1', '2', '3'];  // List of valid types
                if (!in_array($group, $valid_types)) {
                    $group_error = "Group Type must be (1 or 2 or 3)";
                }
            }
            
            if(!empty($group_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$group_error;
                }
                else {
                    $excel_upload_error = $group_error;
                }
            } else {
                if($group == '1') {
                    $group_id = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', '636d4633494731686447567961574673', 'group_id');
                    $group_name = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', '636d4633494731686447567961574673', 'group_name');
                } else if($group == '2') {
                    $group_id = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', '633256746153426d615735706332686c5a413d3d', 'group_id');
                    $group_name = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', '633256746153426d615735706332686c5a413d3d', 'group_name');
                } else if($group == '3') {
                    $group_id = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', '5a6d6c7561584e6f5a57513d', 'group_id');
                    $group_name = $obj->getTableColumnValue($GLOBALS['group_table'], 'lower_case_name', '5a6d6c7561584e6f5a57513d', 'group_name');
                }
               
            }
        }

        if(isset($_REQUEST['hsn_code'])){
            $hsn_code = $_REQUEST['hsn_code'];
            $hsn_code = trim($hsn_code);
            $hsn_code_error = $valid->valid_hsn($hsn_code, "HSN Code", "1");
    
            
            if(!empty($hsn_code_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$hsn_code_error;
                }
                else {
                    $excel_upload_error = $hsn_code_error;
                }
            }
        }

        if(isset($_REQUEST['unit_name'])){
            $unit_name = $_REQUEST['unit_name'];
            $unit_name = trim($unit_name);
            $unit_name_error = $valid->valid_text($unit_name, "Unit Name", "1");
    
            if(!empty($unit_name) && empty($unit_name_error) && strlen($unit_name) > 10) {
                $unit_name_error = "Unit Name - Max.Character Count : 10";
            }
            
            if(!empty($unit_name_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$unit_name_error;
                }
                else {
                    $excel_upload_error = $unit_name_error;
                }
            }
        }
       
        
        if(isset($_REQUEST['subunit_name'])){
            $subunit_name = $_REQUEST['subunit_name'];
            $subunit_name = trim($subunit_name);
            $subunit_name_error = $valid->valid_text($subunit_name, "SubUnit Name", "0");
    
            if(!empty($subunit_name) && empty($subunit_name_error) && strlen($subunit_name) > 10) {
                $subunit_name_error = "Unit Name - Max.Character Count : 10";
            }
            
            if(!empty($subunit_name_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$subunit_name_error;
                }
                else {
                    $excel_upload_error = $subunit_name_error;
                }
            }
        }

        if(empty($subunit_name)) {
            $subunit_need = 0;
        }
        if(isset($_REQUEST['case_rate'])){
            $case_rate = $_REQUEST['case_rate'];
            $case_rate = trim($case_rate);
            $case_rate_error = $valid->valid_number($case_rate, "Case Rate", "0");
    
            if(!empty($case_rate) && empty($case_rate_error) && strlen($case_rate) > 8) {
                $case_rate_error = "Case Rate - Max.Character Count : 8";
            }
            
           
        }

        if(isset($_REQUEST['per'])){
            $per = $_REQUEST['per'];
            $per = trim($per);
            $per_error = $valid->valid_number($per, "Case Rate", "0");
    
            if(!empty($per) && empty($per_error) && strlen($per) > 8) {
                $per_error = "Per - Max.Character Count : 4";
            }
            
              
        }

        if(isset($_REQUEST['per_type'])){
            $per_type = $_REQUEST['per_type'];
            $per_type = trim($per_type);
            $per_type_error = $valid->valid_number($per_type, "Per Type", "0");

            if (!empty($per_type)) {
                $valid_types = ['1', '2'];  // List of valid types
                if (!in_array($per_type, $valid_types)) {
                    $per_type_error = "Per Type must be (1 or 2)";
                }
            }
            

              
        }
        if($group != 3) {
            $case_rate = $GLOBALS['null_value'];
            $per_type = $GLOBALS['null_value'];
            $per = $GLOBALS['null_value'];
        } else {

            if(!empty($case_rate_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$case_rate_error;
                }
                else {
                    $excel_upload_error = $case_rate_error;
                }
            }    

            if(!empty($per_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$per_error;
                }
                else {
                    $excel_upload_error = $per_error;
                }
            }  

            if(!empty($per_type_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$per_type_error;
                }
                else {
                    $excel_upload_error = $per_type_error;
                }
            }  
        }

       
        $result = "";  
        if(empty($excel_upload_error)) {
            $product_unit_id = "";  $product_category_id = ""; 

            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            $bill_company_id = $GLOBALS['bill_company_id'];
            $null_value = $GLOBALS['null_value'];
            
            if(!empty($unit_name)) {
                $lower_case_name = "";
                $lower_case_name = strtolower($unit_name);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                $unit_name = $obj->encode_decode('encrypt',$unit_name);
                // $bill_company_id = $GLOBALS['bill_company_id'];

                $prev_unit_id = "";	
				if(!empty($lower_case_name)) {
                    $prev_unit_id = ""; $unit_error = "";
                    if(!empty($lower_case_name)) {
                        $prev_unit_id = $obj->getTableColumnValue($GLOBALS['unit_table'],'lower_case_name',$lower_case_name,'unit_id');
                    }
					if(empty($prev_unit_id)) {						
                        $action = ""; $unit_insert_id = "";
                        if(!empty($unit_name)) {
                            $action = "New unit Created. Name - ".$obj->encode_decode('decrypt', $unit_name);
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array();$values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name',  'unit_id', 'unit_name', 'lower_case_name', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$unit_name."'", "'".$lower_case_name."'", "'0'");
                        $unit_insert_id = $obj->InsertSQL($GLOBALS['unit_table'], $columns, $values, 'unit_id', '', $action);		
                        if(preg_match("/^\d+$/", $unit_insert_id)) {
                            $unit_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'id', $unit_insert_id, 'unit_id');

                            $product_unit_id = $unit_id;
                        }
                    }
                    else {
                        $product_unit_id = $prev_unit_id;
                    }
                }
            }

            if(!empty($subunit_name)) {
                $lower_case_name = "";
                $lower_case_name = strtolower($subunit_name);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                $subunit_name = $obj->encode_decode('encrypt',$subunit_name);
                // $bill_company_id = $GLOBALS['bill_company_id'];

                $prev_subunit_id = "";	
				if(!empty($lower_case_name)) {
                    $prev_subunit_id = ""; $unit_error = "";
                    if(!empty($lower_case_name)) {
                        $prev_subunit_id = $obj->getTableColumnValue($GLOBALS['unit_table'],'lower_case_name',$lower_case_name,'unit_id');
                    }
					if(empty($prev_subunit_id)) {						
                        $action = ""; $subunit_insert_id = "";
                        if(!empty($subunit_name)) {
                            $action = "New unit Created. Name - ".$obj->encode_decode('decrypt', $subunit_name);
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array();$values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name',  'unit_id', 'unit_name', 'lower_case_name', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$subunit_name."'", "'".$lower_case_name."'", "'0'");
                        $subunit_insert_id = $obj->InsertSQL($GLOBALS['unit_table'], $columns, $values, 'unit_id', '', $action);		
                        if(preg_match("/^\d+$/", $subunit_insert_id)) {
                            $subunit_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'id', $subunit_insert_id, 'unit_id');

                            $product_subunit_id = $subunit_id;
                        }
                    }
                    else {
                        $product_subunit_id = $prev_subunit_id;
                    }
                }
            }

            if(empty($case_rate)) {
                $case_rate = $GLOBALS['null_value'];
            }

          
            if(!empty($product_name)){
                $lower_case_name = strtolower($product_name);
                $product_name = $obj->encode_decode('encrypt', $product_name);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);


                $prev_product_id = ""; $prev_product_name = "";$product_error = ""; 
                if(!empty($lower_case_name) && $lower_case_name != $GLOBALS['null_value']) {
                    $prev_product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'lower_case_name', $lower_case_name, 'product_id');
                    if(!empty($prev_product_id)) {
                        $prev_product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $prev_product_id, 'product_name');
                        $prev_product_name =$obj->encode_decode('decrypt',$prev_product_name);
                        $product_error = "This Product Name already exists in ".$prev_product_name;
                    }
                }
                if(empty($prev_product_id)) {						
                    $action = "";
                    if(!empty($product_name)) {
                        $action = "New Product Created. Name - ".$obj->encode_decode('decrypt', $product_name);
                    }

                    $product_insert_id = ""; $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name','group_id', 'group_name', 'hsn_code',  'product_id', 'product_name', 'lower_case_name', 'unit_id', 'unit_name', 'subunit_need','subunit_id', 'subunit_name', 'sales_rate', 'subunit_contains', 'per','per_type', 'opening_stock', 'unit_type', 'stock_date', 'negative_stock', 'deleted');

                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$group_id."'","'".$group_name."'", "'".$hsn_code."'","'".$null_value."'","'".$product_name."'", "'".$lower_case_name."'", "'".$product_unit_id."'", "'".$unit_name."'","'".$subunit_need."'", "'".$product_subunit_id."'","'".$subunit_name."'", "'".$case_rate."'", "'".$null_value."'", "'".$per."'","'".$per_type."'", "'".$null_value."'", "'".$null_value."'", "'".$null_value."'", "'0'","'0'");
                    $product_insert_id = $obj->InsertSQL($GLOBALS['product_table'], $columns, $values,'product_id','', $action);

                    if(preg_match("/^\d+$/", $product_insert_id)) {
                        // $product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'id', $product_insert_id, 'product_id');
                        // $result = array('number' => '1', 'msg' => 'Product Successfully Created');
                        $result = 1;						
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $product_insert_id);
                    }
                }
                else {
                    if($excel_upload_type == "2"){
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $prev_product_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            
                            if(!empty($product_name)) {
                                $action = "Product Updated. Name - ".$product_name;
                            }

                            $columns = array(); $values = array();						
                            $columns = array('creator_name','group_id', 'group_name', 'hsn_code',  'product_id', 'product_name', 'lower_case_name', 'unit_id', 'unit_name', 'subunit_need','subunit_id', 'subunit_name', 'sales_rate', 'subunit_contains', 'per','per_type', 'opening_stock', 'unit_type', 'stock_date', 'negative_stock');
                            $values = array("'".$creator_name."'","'".$group_id."'","'".$group_name."'", "'".$hsn_code."'","'".$null_value."'","'".$product_name."'", "'".$lower_case_name."'", "'".$product_unit_id."'", "'".$unit_name."'","'".$subunit_need."'", "'".$product_subunit_id."'","'".$subunit_name."'", "'".$case_rate."'", "'".$null_value."'", "'".$per."'","'".$per_type."'", "'".$null_value."'", "'".$null_value."'", "'".$null_value."'", "'0'");

                            $product_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                            $result = $product_update_id;
                        }
                        else{
                            $result = $product_error;
                        }
                    }
                    else {
                        echo $excel_upload_error = $product_error;
                    }
                }
            }
           echo  $result; exit;
        } else{
            echo  $excel_upload_error;
        }
    }

    ?>

   