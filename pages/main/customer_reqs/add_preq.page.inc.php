<div class="row">
    <div class="col-md-12">

        <div class="card my-2">

            <div class="card-header bg-theme-accent" style="font-size: 18px;">
                Create Customer Purchase Requisition
            </div>

            <div class="card-body">
                
                <form id="preq_form"> 

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <input type="text" name="preq_supplier" id="preq_supplier" class="form-control form-control-sm" value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="preq_customer_id" id="preq_customer_id">
                                <label for="">Customer</label>
                                <input type="text" name="preq_customer" id="preq_customer" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Purchase Requisition Date</label>
                                <div class='input-group' id='datetimepicker1' style="width: 100%;">
                                    <div class="input-group-prepend">
                                        <button type="button" id="toggle" class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                    <input type='text' id="picker" name="preq_date" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="domainid">Company Domain:</label>
                                <select name="domainid" id="domainid" class="custom-select custom-select-sm">
                                    <option value="0">Company Domain</option>
                                </select>
                            </div>                                
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subdomid">Subdomain:</label>
                                <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                                    <option value="0">Unit Subdomain</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Purchase Requisition Description</label>
                                <input type="text" name="preq_descr" id="preq_descr" class="form-control form-control-sm" required value="<?php echo isset($order_descr) ? $order_descr : '' ?>">
                            </div>
                        </div>

                    </div>

                    <table class="table table-porders" id="add_preq_list">

                        <thead>
                            <tr>
                                <th class="text-center" style="width: 4%;">#</th>
                                <th class="text-left"  style="width: 18%;">Product</th>
                                <th class="text-left"  style="width: 8%;">Brand</th>
                                <th class="text-left"  style="width: 8%;">Category</th>
                                <th class="text-left"  style="width: 18%;">Description</th>
                                <th class="text-center"  style="width: 10%;">Unit</th>
                                <th class="text-center" style="width: 10%;">Quantity</th>
                                <th class="text-center" style="width: 12%;">Rate</th>
                                <th class="text-center" style="width: 10%;">Total</th>
                                <!-- <th class="text-center" style="width: 5%;">Action</th> -->
                            </tr>
                        </thead>

                        <tbody id="preq_item">
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

                        <div class="col-md-8 pt-2 mb-3">
                            <!-- <label for="preq_notes">Purchase Requisition Notes</label> -->
                            <textarea class="form-control" name="preq_notes" id="preq_notes" rows="5" 
                                            placeholder="Purchase Requisition Notes" required></textarea>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="preq_subtotal" class="col-md-4 col-form-label text-right">Sub-Total:</label>
                                <div class="col-md-8">
                                    <input type="text" name="preq_subtotal" id="preq_subtotal" 
                                            class="form-control form-control-sm" required readonly>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="originator" class="col-md-4 col-form-label-sm text-right"><b>Originator:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="preq_originator" 
                                        id="preq_originator"
                                        value="<?= $user['name'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="preq_originator_id" value="<?= $user['id'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="approver" class="col-md-4 col-form-label-sm text-left"><b>Approver:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="preq_approver" 
                                        id="preq_approver"
                                        value="Administrator"
                                        readonly
                                    >
                                    <input type="hidden" name="preq_approver_id" value="1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 d-flex justify-content-end px-4">
                            <button id="preq_create_btn" type="button" class="btn btn-sm bg-theme-accent px-3 mr-2">Submit Requisition</button>
                            <!-- <button type="button" id="order_print_invoice" class="btn btn-success px-3 mr-2">Print Invoice</button> -->
                            <button class="btn btn-sm btn-secondary px-3" type="button" onclick="location.href = 'main.php?dir=customer_reqs&page=list_preqs'">Cancel</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<?php include('./pages/modals/product_selector.php'); ?>


<script>

$(document).ready(function() {

    $('.page-title').addClass('d-none');

    getPlatformCompanyDetails();

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

    initializeStoreReqDomainsSelect();

    $('#domainid').on('change', function() {
        // alert( this.value );
        domainsChangeStoreReqUpdateSubDomSelect( this.value );
    });

    // add the first row
    addNewPurchaseRequisitionRow();
    
    $("#add").click(function() {
        addNewPurchaseRequisitionRow();
    });

    $("#remove").click(function() {
        $("#preq_item").children("tr:last").remove();
        // calculate(0, 0, 0);
        calculate_customer_preq(0, 0, 0);
    });

    $("#preq_item").delegate('.product_id', "change", function() {
        customerPurchaseRequisitionItemChangeUpdate(this);
    });

    $("#preq_item").delegate(".product_qty", "keyup", function() {
        validateCustomerPreqProductQty(this);
    });

    $("#preq_discount").keyup(function() {
        recalculateCustomerPreqDiscount(this);
    });

    $("#preq_paid_amount").keyup(function() {
        recalculateCustomerPreqPaidAmt(this);
    });

    $("#preq_shipping").keyup(function() {
        recalculateCustomerPreqShipping(this);
    });

    // Purchase Requisition Creation
    $("#preq_create_btn").click(function() {
        var form_data = $("#preq_form").serializeArray(); 
        createPurchaseRequisition(form_data);
    });    
});

</script>