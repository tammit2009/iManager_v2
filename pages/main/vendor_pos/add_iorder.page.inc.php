<div class="row">
    <div class="col-md-12">

        <div class="card my-2">

            <div class="card-header bg-theme-accent" style="font-size: 18px;">
                Create Vendor Purchase Requisition
            </div>

            <div class="card-body"> 

                <form id="vendor_preq_form"> 

                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="row">

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Purchase Requisition Description</label>
                                <input type="text" name="vendor_preq_descr" id="vendor_preq_descr" class="form-control form-control-sm" required value="<?php echo isset($order_req_descr) ? $order_req_descr : '' ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Purchase Requisition Date</label>
                                <div class='input-group' id='datetimepicker1' style="width: 100%;">
                                    <div class="input-group-prepend">
                                        <button type="button" id="toggle" class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                    <input type='text' id="picker" name="vendor_preq_date" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <table class="table table-orders" id="add_vendor_preq_list">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 4%;">#</th>
                                <th class="text-left"  style="width: 18%;">Product</th>
                                <th class="text-left"  style="width: 12%;">Supplier</th>
                                <th class="text-left"  style="width: 20%;">Description</th>
                                <th class="text-center" style="width: 12%;">Rate</th>
                                <th class="text-center" style="width: 12%;">Quantity</th>
                                <th class="text-center" style="width: 10%;">Total</th>
                                <!-- <th class="text-center" style="width: 5%;">Action</th> -->
                            </tr>
                        </thead>

                        <tbody id="vendor_preq_item">

                            <!-- Placeholder -->

                        </tbody>

                    </table>

                    <div class="col-md-12">
                        <button id="add" type="button" class="btn btn-default text-default">
                            <i class="fa fa-plus p-1"></i>
                            <span style="font-size: 13px; font-weight: bold;">Add Line Item</span>
                        </button>

                        <button id="remove" type="button" class="btn btn-default text-danger">
                            <i class="fa fa-minus p-1"></i>
                            <span style="font-size: 13px; font-weight: bold;">Remove Line Item</span>
                        </button>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="requester" class="col-md-4 col-form-label-sm text-right"><b>Requester</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="requester" 
                                        id="requester"
                                        value="<?= $user['name'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="requester_id" value="<?= $user['id'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="approver" class="col-md-4 col-form-label-sm text-right"><b>Approver</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="approver" 
                                        id="approver"
                                        value="Administrator"
                                        readonly
                                    >
                                    <input type="hidden" name="approver_id" value="48">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end px-4">
                            <button id="vendor_preq_create_btn" type="button" class="btn bg-theme-accent px-3 mr-2">Create Requisition</button>
                            <button class="btn btn-secondary px-4" type="button" onclick="location.href = 'main.php?dir=vendor_reqs&page=list_preqs'">Cancel</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<?php include('./pages/modals/vproduct_selector.php'); ?>

<script>

$(document).ready(function() {

    $('.page-title').addClass('d-none');

    // Event Date Picker
    $.datetimepicker.setDateFormatter('moment');
    $('#picker').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'YYYY-MM-DD HH:mm',    // use momentjs format
        value: new Date(),              // default value
    });
    $('#toggle').on('click', function() {
        $('#picker').datetimepicker('toggle');
    });

    // add the first row
    addNewVendorPurchaseRequisitionRow();
    
    $("#add").click(function() {
        addNewVendorPurchaseRequisitionRow();
    });

    $("#remove").click(function() {
        $("#vendor_preq_item").children("tr:last").remove();
        // calculate(0, 0, 0);
        calculate_vendor_preq(0, 0, 0);
    });

    $("#vendor_preq_item").delegate('.vproduct_id', "change", function() {
        vendorPurchaseRequisitionItemChangeUpdate(this);
    });

    $("#vendor_preq_item").delegate(".vproduct_qty", "keyup", function() {
        validateVendorPreqProductQty(this);
    });

    // Vendor Purchase Requisition Creation
    $("#vendor_preq_create_btn").click(function() {
        var form_data = $("#vendor_preq_form").serializeArray(); 
        createVendorPurchaseRequisition(form_data);
    });  
});
</script>