<?php
	include("include_files.php");
	if(isset($_REQUEST['show_material_transfer_id'])) { 
        $show_material_transfer_id = $_REQUEST['show_material_transfer_id'];

        ?>
        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Material Transfer</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('material_transfer.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" class="form-control shadow-none">
                                    <label>Date</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="location" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Location</option>
                                        <option value="1">Godown</option>
                                        <option value="2">Magazine</option>
                                    </select>
                                    <label>Select Location</label>
                                </div>
                            </div>       
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="from_location" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select From</option>
                                    </select>
                                    <label>Select From </label>
                                </div>
                            </div>       
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="to_location" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select To</option>
                                       
                                    </select>
                                    <label>Select To</label>
                                </div>
                            </div>        
                        </div>
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="product" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Product</option>
                                    </select>
                                    <label>Select Product</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" class="form-control shadow-none" required="">
                                    <label>QTY</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_unit_type" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="1">Unit</option>
                                        <option value="2">Sub Unit</option>
                                    </select>
                                    <label>Type</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 d-none">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_consumption_content" onchange="GetStockLimit();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select Contents</option>    
                                    </select>
                                    <label>Contents</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-2 col-5 text-center px-lg-1 py-2">
                            <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddInwardProducts();">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-10">
                            <div class="table-responsive text-center">
                                <table class="table nowrap cursor smallfnt table-bordered">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th>Product Group</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Type</th>
                                            <th>Total Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Raw Material</td>
                                            <td>Ground Chakkar Special</td>
                                            <td>5</td>
                                            <td>Unit</td>
                                            <td>5</td>
                                            <td>
                                                <a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="5" class="text-end">Total</td>
                                            <td>10</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-danger" type="button">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>     
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
	<?php
    } 
    if(isset($_POST['page_number'])) {
        $page_number = $_POST['page_number'];
        $page_limit = $_POST['page_limit'];
        $page_title = $_POST['page_title']; ?>
    
    <table class="table nowrap cursor text-center smallfnt">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>From Godown</th>
                <th>To Godown</th>
                <th>QTY</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>                
<?php	}?>