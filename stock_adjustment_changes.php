<?php
	include("include_files.php");
	if(isset($_REQUEST['show_stock_adjustment_id'])) { ?>
        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Stock Adjustment</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('stock_adjustment.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" class="form-control shadow-none" placeholder="" required="">
                            <label style="font-size:10px;">Stock Adjustment Date</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Product Group</option>
                                <option>Raw Material</option>
                                <option>Semi Finished</option>
                                <option>Finished</option>
                            </select>
                            <label>Product Group</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Product</option>
                                <option>Product 1</option>
                                <option>Product 2</option>
                            </select>
                            <label>Select Product</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Type</option>    
                                <option>Unit</option>
                                <option>Sub Unit</option>
                            </select>
                            <label>Type</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Action</option>
                                <option>Add</option>
                                <option>Remove</option>
                            </select>
                            <label>Select Action</label>
                        </div>
                    </div>        
                </div>  
            </div>
            <div class="row justify-content-center p-2"> 
                <div class="col-lg-10">
                    <div class="table-responsive text-center">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Product Group</th>
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Stock Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Category 1</td>
                                    <td>Category 1</td>
                                    <td>Product Name</td>
                                    <td>Category 1</td>
                                    <td><a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                            </tbody> 
                        </table>
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
                    <th>Product Group</th>
                    <th>Product Name</th>
                    <th>Stock Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Raw Material</td>
                    <td>Product 1</td>
                    <td>Plus</td>
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
		<?php	
	}
    ?>