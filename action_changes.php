<?php 

    if(isset($_REQUEST['view_type'])) {
		$view_type = ""; $view_type = $_REQUEST['view_type'];
		if($view_type == "1"){ ?>
				<option value="">Select</option>
				<?php
					$agent_list = array();
					$agent_list = $obj->getTableRecords($GLOBALS['agent_table'], '', '');
					if(!empty($agent_list)) {
						foreach($agent_list as $data) { ?>
							<option value="<?php if(!empty($data['agent_id'])) { echo $data['agent_id']; } ?>">
								<?php
									if(!empty($data['agent_name'])) {
										$data['agent_name'] = $obj->encode_decode('decrypt', $data['agent_name']);
										echo $data['agent_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php }else if($view_type == "2"){ ?>
				<option value="">Select</option>
				<?php
					$supplier_list = array();
					$supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '');
					if(!empty($supplier_list)) {
						foreach($supplier_list as $data) { ?>
							<option value="<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>">
								<?php
									if(!empty($data['supplier_name'])) {
										$data['supplier_name'] = $obj->encode_decode('decrypt', $data['supplier_name']);
										echo $data['supplier_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php }else if($view_type == "3"){ ?>
				<option value="">Select</option>
				<?php
					$contractor_list = array();
					$contractor_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '');
					if(!empty($contractor_list)) {
						foreach($contractor_list as $data) { ?>
							<option value="<?php if(!empty($data['contractor_id'])) { echo $data['contractor_id']; } ?>">
								<?php
									if(!empty($data['contractor_name'])) {
										$data['contractor_name'] = $obj->encode_decode('decrypt', $data['contractor_name']);
										echo $data['contractor_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php } else if($view_type == "4"){ ?>
				<option value="">Select</option>
				<?php
					$customer_list = array();
					$customer_list = $obj->getTableRecords($GLOBALS['customer_table'], '', '');
					if(!empty($customer_list)) {
						foreach($customer_list as $data) { ?>
							<option value="<?php if(!empty($data['customer_id'])) { echo $data['customer_id']; } ?>">
								<?php
									if(!empty($data['customer_name'])) {
										$data['customer_name'] = $obj->encode_decode('decrypt', $data['customer_name']);
										echo $data['customer_name'];
										if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
											$data['city'] = $obj->encode_decode('decrypt', $data['city']);
											echo " - ".$data['city'];
										}
									}
								?>
							</option>
				<?php
						}
					}
				?>
			
		<?php }  ?>
		
		<script type="text/javascript">                
			jQuery(document).ready(function(){
				jQuery('select[name="filter_party_id"]').select2();
			});
		</script>
	<?php }


?>