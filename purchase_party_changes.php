<?php
	include("include_files.php");
	if(isset($_REQUEST['show_purchase_party_id'])) { ?>
        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Purchase Party</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('purchase_party.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Party Type</option>
                                <option>Sales</option>
                                <option>Purchase</option>
                                <option>Both</option>
                            </select>
                            <label>Select Party Type</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                            <label>Party Name</label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                            <label>Contact Number</label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"></textarea>
                            <label>Address</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select City</option>
                                <option>City 1</option>
                                <option>City 2</option>
                            </select>
                            <label>Select City</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select State</option>
                                <option>State 1</option>
                                <option>State 2</option>
                            </select>
                            <label>Select State</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                            <label>Pincode</label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 6 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                            <label>GST Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                            <label>Identification</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" value="" class="form-control shadow-none">
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                    <select name="opening_balance_type" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="1" data-select2-id="14">Credit</option>
                                        <option value="2">Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-danger" type="button">
                        Submit
                    </button>
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
                <th>S.No</th>
                <th>Purchase Party Name</th>
                <th>Mobile</th>
                <th>State</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>Mahesh Prabhu</td>
                <td>9876543456</td>
                <td>Tamilnadu</td>
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
            <tr>
                <td>02</td>
                <td>Vinoth</td>
                <td>9876543456</td>
                <td>Kerala</td>
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