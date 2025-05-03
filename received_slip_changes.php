<?php
	include("include.php");
	if(isset($_REQUEST['show_received_slip_id'])) { ?>
        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Received Slip</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('received_slip.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" class="form-control shadow-none" placeholder="" required="">
                                    <label>Date</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select Party</option>
                                        <option>Party 1</option>
                                        <option>Party 2</option>
                                    </select>
                                    <label>Select Party</label>
                                </div>
                            </div>       
                        </div>
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border mb-0">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select Product</option>
                                        <option>Ground Chakkar Special</option>
                                    </select>
                                    <label>Select Product</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border mb-0">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select Brand</option>
                                        <option>Mothers</option>
                                    </select>
                                    <label>Select Brand</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-3 col-6">
                            <div class="form-group pb-1">
                                <div class="form-label-group in-border pb-1">
                                    <input type="text" class="form-control shadow-none" required="">
                                    <label>Per</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-1 col-md-3 col-6">
                            <div class="form-group pb-1">
                                <div class="form-label-group in-border pb-1">
                                    <input type="text" class="form-control shadow-none" required="">
                                    <label>QTY</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 p-0">
                            <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:AddInwardProducts();">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-9">
                            <div class="table-responsive text-center">
                                <table class="table nowrap cursor smallfnt table-bordered">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th style="with:400px;">Brand</th>
                                            <th style="width:200px;">Product</th>
                                            <th style="width:200px;">Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Mothers</td>
                                            <td>Ground Chakkar Special</td>
                                            <td>5</td>
                                            <td>
                                                <a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>Mothers</td>
                                            <td>Ground Chakkar Deluxe</td>
                                            <td>5</td>
                                            <td>
                                                <a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="3" class="text-end">Total</td>
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
                <th>Product</th>
                <th>Brand</th>
                <th>QTY</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>Ground Chakkar</td>
                <td>Sonny</td>
                <td>50</td>
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
<?php	}?>