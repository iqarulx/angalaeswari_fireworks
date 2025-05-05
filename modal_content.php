<button type="button" data-bs-toggle="modal" data-bs-target="#DeleteModal" class="d-none delete_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-success no" onClick="Javascript:cancel_delete_modal(this);" data-bs-dismiss="modal">Cancel</button> -->
                <button type="button" class="btn btn-danger yes" onClick="Javascript:confirm_delete_modal(this);" >Delete</button>
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#ReceiptDeleteModal" class="d-none receipt_delete_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ReceiptDeleteModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close d-none" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            Modal body..
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success yes" onClick="Javascript:confirm_receipt_delete_modal(this);">Yes</button>
            <button type="button" class="btn btn-danger no" onClick="Javascript:cancel_delete_modal(this);">No</button>
        </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#PreviewUpdateModal" class="d-none preview_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PreviewUpdateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Preview Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#RemarksUpdateModal" class="d-none remarks_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="RemarksUpdateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success yes" onClick="Javascript:confirm_delete_receipt_modal(this);">Submit</button>
            </div>
        </div>
    </div>
</div>
<button type="button" data-bs-toggle="modal" data-bs-target="#UploadModal" class="d-none upload_modal_button"></button>
						    <!-- The Modal -->
<div class="modal fade" id="UploadModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="height:150px !important;">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Product Upload</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="window.open('product.php','_self');" aria-label="Close">
                </button>

            </div>
        
            <!-- Modal body -->
            <div class="modal-body text-center">
                <button type="button" class="btn btn-success" onClick="Javascript:UploadExcel('1');">New</button>
                &nbsp;
                <button type="button" class="btn btn-success" onClick="Javascript:UploadExcel('2');">Overwrite</button>
            </div>                                    
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#ViewDetailsModal" class="d-none details_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ViewDetailsModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
             
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#PendingDetailsModal" class="d-none pending_modal_button"></button>
<!-- The Modal -->
<div class="modal modal-lg fade" id="PendingDetailsModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>


<button type="button" data-bs-toggle="modal" data-bs-target="#CustomPartyModal" class="d-none custom_party_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="CustomPartyModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Custom Party</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#ViewDetailsModal" class="d-none details_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ViewDetailsModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center"></h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#CustomProductModal" class="d-none custom_product_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="CustomProductModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Custom Product</h4>
                <button type="button" class="close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>


<button type="button" data-toggle="modal" data-target="#DebitReceiptModal" class="d-none debit_receipt_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="DebitReceiptModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Debit Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>


<button type="button" data-bs-toggle="modal" data-bs-target="#ViewOrderDetailsModal" class="d-none order_details_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ViewOrderDetailsModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="width:600px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center"></h4>
                <button type="button" class="close btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>

<button type="button" data-toggle="modal" data-target="#PaymentReportModal" class="d-none payment_report_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PaymentReportModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment Report</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#PaymentModal" class="d-none payment_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
               
            </div>
        </div>
    </div>
</div>
