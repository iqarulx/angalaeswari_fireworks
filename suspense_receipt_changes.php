<?php
	include("include_files.php");
	if(isset($_REQUEST['show_suspense_receipt_id'])) { ?>
        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Suspense Receipt</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('suspense_receipt.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border ">
                                    <input type="date" class="form-control shadow-none" placeholder="" required="">
                                    <label>Date</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select Suspense Party</option>
                                        <option>Mahesh Prabhu</option>
                                        <option>Vinoth Kumar</option>
                                    </select>
                                    <label>Select Suspense Party</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                                    <label>Amount</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"></textarea>
                                    <label>Narration</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select Payment Mode</option>
                                        <option>Gpay</option>
                                    </select>
                                    <label>Select Payment Mode</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option>Select Bank</option>
                                        <option>Bank of Baroda</option>
                                    </select>
                                    <label>Select Bank</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-12 py-2">
                            <button class="btn btn-success add_products_button" style="font-size:12px;" type="button" onclick="Javascript:AddInwardProducts();">
                                Add To Bill
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center pt-2"> 
                        <div class="col-lg-8">
                            <div class="table-responsive text-center">
                                <table class="table nowrap cursor smallfnt w-100 table-bordered">
                                    <thead class="bg-dark">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th style="with:400px;">Payment Mode</th>
                                            <th style="width:200px;">Bank Name</th>
                                            <th style="width:200px;">Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Gpay</td>
                                            <td>State Bank Of India</td>
                                            <td>Rs.6,240.00</td>
                                            <td>
                                                <a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
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
                <th>Receipt No / Date</th>
                <th>Suspense Party</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>001 24-25 / 18-02-2025</td>
                <td>Mahesh Prabhu</td>
                <td>Rs.6,240.00</td>
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