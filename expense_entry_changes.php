<?php
	include("include_files.php");
	if(isset($_REQUEST['show_expense_entry_id'])) { ?>
        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Expense Entry</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('expense_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3 justify-content-center">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="form-group pb-1">
                        <div class="form-label-group in-border pb-1">
                            <input type="date" class="form-control shadow-none" placeholder="" required="">
                            <label>Date</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border mb-0">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Select Expense Category</option>
                                <option>Category 1</option>
                                <option>Category2</option>
                            </select>
                            <label>Expense Category</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="" name="" placeholder="Enter Your Description"></textarea>
                            <label>Description</label>
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
        
		<table class="table cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Expense Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>14-04-2025</td>
                    <td>Petrol</td>
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
                    <td>15-04-2025</td>
                    <td>Diesel</td>
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