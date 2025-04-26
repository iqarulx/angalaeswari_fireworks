<?php
	include("include_files.php");
	if(isset($_REQUEST['show_estimate_id'])) { ?>
    <form class="poppins pd-20" name="company_form" method="POST">
        <div class="card-header">
            <div class="row p-2">
                <div class="col-lg-8 col-md-8 col-8 align-self-center">
                    <div class="h5">Add Estimate</div>
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('estimate.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">      
            <div class="col-lg-2 col-md-3 col-6 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <input type="date" class="form-control shadow-none" placeholder="" required="">
                        <label>Date</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Agent</option>
                            <option>Agent 1</option>
                            <option>Agent 2</option>
                        </select>
                        <label>Select Agent</label>
                    </div>
                </div> 
            </div> 
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Customer</option>
                            <option>Customer 1</option>
                            <option>Customer 2</option>
                        </select>
                        <label>Select Customer</label>
                    </div>
                </div> 
            </div>  
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Transport</option>
                            <option>Transport 1</option>
                            <option>Transport 2</option>
                        </select>
                        <label>Select Transport</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Magazine</option>
                            <option>Magazine 1</option>
                            <option>Magazine 2</option>
                        </select>
                        <label>Select Magazine</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-2 col-md-3 col-6 py-2">
                <div class="form-group">
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="FormSelectDefault" class="form-label text-muted smallfnt">GST  ON / OFF</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="FormSelectDefault">
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4 col-md-3 col-12 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"></textarea>
                        <label>Delivery Address</label>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Tax Type</option>
                            <option>Inclusive</option>
                            <option>Exclusive</option>
                        </select>
                        <label>Tax Type</label>
                    </div>
                </div> 
            </div> 
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Tax Option</option>
                            <option>Product</option>
                            <option>Overall</option>
                        </select>
                        <label>Tax Option</label>
                    </div>
                </div> 
            </div> 
            <div class="col-lg-2 col-md-3 col-6 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Tax</option>
                            <option>0%</option>
                            <option>5%</option>
                            <option>12%</option>
                            <option>18%</option>
                            <option>28%</option>
                        </select>
                        <label>Tax</label>
                    </div>
                </div> 
            </div>                   
        </div>    
        <div class="row justify-content-center p-3">
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Product</option>
                            <option>Ground Chakkar Special</option>
                        </select>
                        <label>Select Product</label>
                    </div>
                </div>        
            </div>
            <div class="col-lg-1 col-md-3 col-6 py-2 px-lg-1">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Unit</option>
                            <option>Sub Unit</option>
                        </select>
                        <label>Type</label>
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
                        <input type="number" class="form-control shadow-none" required="">
                        <label>Rate</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <div class="input-group">
                            <input type="text" id="" name="" value="" class="form-control shadow-none">
                            <label>Per</label>
                            <div class="input-group-append" style="width:50%!important;">
                                <select name="opening_balance_type" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="1">Unit</option>
                                    <option value="2">Sub Unit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <input type="number" class="form-control shadow-none" required="">
                        <label>Amount</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-1 col-md-2 col-4 py-2 px-lg-1 text-center">
                <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddInwardProducts();">
                    Add
                </button>
            </div> 
        </div>                  
        <div class="row"> 
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table nowrap cursor text-center table-bordered smallfnt w-100">
                        <thead class="bg-dark">
                            <tr style="white-space:pre;">
                                <th style="width: 20px;">#</th>
                                <th style="width: 250px;">Product</th>
                                <th style="width: 100px;">Type</th>
                                <th style="width: 70px;">QTY</th>
                                <th style="width: 90px;">Rate</th>
                                <th style="width: 150px;">Per</th>
                                <th style="width: 50px;">Tax</th>
                                <th style="width: 70px;">Amount</th>
                                <th style="width: 40px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>    
                                <td>
                                    <div class="form-group">
                                        <div class="form-label-group in-border mb-0">
                                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option>Select Product</option>
                                                <option>Product 1</option>
                                                <option>Product 2</option>
                                                <option>Product 3</option>
                                            </select>
                                            <label>Select Product</label>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                   Unit 
                                </td>
                                <td>
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="name" name="name" class="form-control shadow-none" style="width: 70px;" required>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="name" name="name" class="form-control shadow-none" style="width: 90px;" required>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <div class="input-group">
                                                <input type="text" id="" name="" value="" class="form-control shadow-none">
                                                <label>Per</label>
                                                <div class="input-group-append" style="width:50%!important;">
                                                    <select name="opening_balance_type" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option value="1">Unit</option>
                                                        <option value="2">Sub Unit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="form-label-group in-border mb-0">
                                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option> Tax</option>
                                                <option>0%</option>
                                                <option>5%</option>
                                                <option>12%</option>
                                                <option>18%</option>
                                                <option>28%</option>
                                            </select>
                                            <label>Tax</label>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    90,000
                                </td>
                                <td>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-end"> Total : </td>
                                <td></td>
                                <td colspan="2" class="text-end"></td>
                            </tr>
                            <tr class="smallfnt1">
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <div class="form-group">
                                        <div class="form-label-group in-border mb-0">
                                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option>Select Charges</option>
                                                <option>Packing Charges</option>
                                                <option>Makamai Charges</option>
                                                <option>Transport Charges</option>
                                            </select>
                                            <label>Select Charges</label>
                                        </div>
                                    </div> 
                                </td>
                                <td colspan="1"> 
                                    <div class="d-flex">
                                        <input type="number" class="form-control me-2" style="width: 85px;" id="" name="" value="" placeholder="Value"> 
                                        <button class="bg-danger border-0 px-3"><i class="bi bi-plus fw-bold text-white"></i></button>
                                    </div>
                                </td>
                                <td></td>
                                <td colspan="2">
                                    <div><i class="bi bi-currency-rupee text-danger me-2"></i><span>99,999.00</span></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Total :</td>
                                <td></td>
                                <td colspan="2" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Round OFF :</td>
                                <td></td>
                                <td colspan="2" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Total :</td>
                                <td></td>
                                <td colspan="2" class="text-end"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-12 py-3 text-center">
                <button class="btn btn-danger" type="button">
                    Submit
                </button>
            </div>
        </div>
    </form>                      
    <script src="include/select2/js/select2.min.js"></script>
    <script src="include/select2/js/select.js"></script>
<?php } 
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Estimate Number /  Date</th>
                    <th>Sales Party Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>PO/25/001 / 19-02-2025 </td>
                    <td>Mahesh Prabhu - Sivakasi</td>
                    <td>50,000.00</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div> 
                    </td>
                </tr>
            </tbody>
        </table>               
	<?php } ?>