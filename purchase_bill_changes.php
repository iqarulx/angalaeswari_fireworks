<?php
	include("include.php");
	if(isset($_REQUEST['show_purchase_bill_id'])) { ?>
    <form class="poppins pd-20" name="company_form" method="POST">
        <div class="card-header">
            <div class="row p-2">
                <div class="col-lg-8 col-md-8 col-8 align-self-center">
                    <div class="h5">Add Purchase Bill</div>
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('purchase_bill.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                </div>
            </div>
        </div> 
        <div class="row p-2">
            <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">      
            <div class="col-lg-2 col-md-2 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <input type="date" class="form-control shadow-none" placeholder="" required="">
                        <label>Date</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-1 col-md-2 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <input type="text" class="form-control shadow-none" required="">
                        <label>Bill No</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Party</option>
                            <option>Party 1</option>
                            <option>Party 2</option>
                        </select>
                        <label>Select Party</label>
                    </div>
                </div> 
            </div>                   
            <div class="col-lg-3 col-md-3 col-12 pb-1">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Godown</option>
                            <option>Godown 1</option>
                            <option>Godown 2</option>
                        </select>
                        <label>Select Category</label>
                    </div>
                </div> 
            </div>  
            <div class="col-lg-3 col-md-2 col-12 pb-1">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option>Select Brand</option>
                            <option>Brand 1</option>
                            <option>Brand 2</option>
                        </select>
                        <label>Select Brand</label>
                    </div>
                </div> 
            </div>  
        </div>                  
        <div class="row justify-content-center p-2">    
            <div class="col-lg-3 col-md-6 col-12">
                <div class="form-group mb-1">
                    <div class="form-label-group in-border">
                        <div class="input-group mb-3">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" data-placeholder="Select a State" style="width: 100%;">
                                <option>Select Product</option>
                                <option>Product 1</option>
                                <option>Product 2</option>
                            </select>
                            <label>Select Product</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <input type="text" class="form-control shadow-none" required="">
                        <label>Cases</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-1 col-md-3 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <input type="text" class="form-control shadow-none" required="">
                        <label>Pcs/Case</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-1 col-md-3 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <input type="text" class="form-control shadow-none" required="">
                        <label>Rate/Pcs</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-1 col-md-3 col-12">
                <div class="form-group pb-1">
                    <div class="form-label-group in-border pb-1">
                        <input type="text" class="form-control shadow-none" required="">
                        <label>Rate/Case</label>
                    </div>
                </div> 
            </div>
            <div class="col-lg-1 col-md-6 col-12">
                <button class="btn btn-danger py-2" style="font-size:12px; width:100%;" type="button">  Add </button>
            </div>
        </div>   
        <div class="row"> 
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table nowrap cursor text-center table-bordered smallfnt w-100">
                        <thead class="bg-dark">
                            <tr style="white-space:pre;">
                                <th>#</th>
                                <th>Product</th>
                                <th style="width: 100px;">Case</th>
                                <th style="width: 100px;">Pcs/Case</th>
                                <th style="width: 100px;">Rate/Pcs</th>
                                <th style="width: 100px;">Rate/Case</th>
                                <th style="width: 100px;">Amount</th>
                                <th style="width: 70px;">Action</th>
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
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="name" name="name" class="form-control shadow-none" style="width:65px;" required>
                                            <label>Case</label>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="name" name="name" class="form-control shadow-none" style="width:65px;" required>
                                            <label>Rate/Pcs</label>
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="name" name="name" class="form-control shadow-none" style="width:65px;" required>
                                            <label>Rate/Case</label>
                                        </div>
                                    </div> 
                                </td>
                                <td>99,000.00</td>
                                <td>99,000.00</td>
                                <td>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-end"> Total : </td>
                                <td class="text-end sub_total"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">Extra charges</td>
                                <td colspan="2" class="text-end">
                                    <input type="text" name="" class="form-control shadow-none extra_charges" value="" placeholder="Extra charges">
                                </td>
                                <td class="text-end delivery_charges_value"></td>
                                <td colspan="1" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Total :</td>
                                <td class="text-end delivery_charges_total"></td>
                                <td colspan="1" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">Discount</td>
                                <td colspan="2" class="text-end">
                                    <input type="text" name="" class="form-control shadow-none load" value="" placeholder="Discount">
                                </td>
                                <td class="text-end loading_charges_value"></td>
                                <td colspan="1" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Total :</td>
                                <td class="text-end loading_charges_total"></td>
                                <td colspan="1" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Round OFF :</td>
                                <td class="text-end round_off">  </td>
                                <td colspan="1" class="text-end"></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end ">Total :</td>
                                <td class="text-end overall_total"></td>
                                <td colspan="1" class="text-end"></td>
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
                    <th>Date</th>
                    <th>Purchase Order Number</th>
                    <th>Purchase Party Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>19-02-2025</td>
                    <td>PO/25/001 </td>
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
                <tr>
                    <td>02</td>
                    <td>19-02-2025</td>
                    <td>PO/25/001 </td>
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
	<?php }?>