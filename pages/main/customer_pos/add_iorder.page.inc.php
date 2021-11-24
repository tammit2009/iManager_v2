<div class="row">
    <div class="col-md-12">

        <div class="card my-2">

            <div class="card-header bg-theme-accent" style="font-size: 18px;">
                Create Inline Order
            </div>

            <div class="card-body">
                
                <form id="iorder_form"> 

                    <div class="row mb-3">

                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <input type="text" name="preq_supplier" id="preq_supplier" class="form-control form-control-sm" value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="preq_customer_id" value="9">
                                <label for="">Customer</label>
                                <input type="text" name="preq_customer" id="preq_customer" class="form-control form-control-sm" value="H1Plus Hotels Ltd">
                            </div>
                        </div> -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="domainid">Company Domain:</label>
                                <select name="domainid" id="domainid" class="custom-select custom-select-sm">
                                    <option value="0">Company Domain</option>
                                </select>
                            </div>                                
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subdomid">Subdomain:</label>
                                <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                                    <option value="0">Unit Subdomain</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Order Date</label>
                                <div class='input-group' id='datetimepicker1' style="width: 100%;">
                                    <div class="input-group-prepend">
                                        <button type="button" id="toggle" class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                    <input type='text' id="picker" name="iorder_date" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Order Description</label>
                                <input type="text" name="iorder_descr" id="iorder_descr" class="form-control form-control-sm" required value="<?php echo isset($order_descr) ? $order_descr : '' ?>">
                            </div>
                        </div>

                    </div>

                    <table class="table table-porders" id="add_iorder_list">

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

                        <tbody id="inline_order_item">
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
                            <textarea class="form-control" name="iorder_notes" id="iorder_notes" rows="5" 
                                            placeholder="Order Notes" required></textarea>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="iorder_subtotal" class="col-md-4 col-form-label text-right">Sub-Total:</label>
                                <div class="col-md-8">
                                    <input type="text" name="iorder_subtotal" id="iorder_subtotal" 
                                            class="form-control form-control-sm" required readonly>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Total Amount</label>
                                <input type="text" name="iorder_total_amt" id="iorder_total_amt" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Paid Amount</label>
                                <input type="text" name="iorder_paid_amount" id="iorder_paid_amount" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">VAT (7.5%)</label>
                                <input type="text" name="iorder_vat" id="iorder_vat" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Cost</label>
                                <input type="text" name="iorder_shipping" id="iorder_shipping" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Due Amount</label>
                                <input type="text" name="iorder_due_amount" id="iorder_due_amount" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Discount</label>
                                <input type="text" name="iorder_discount" id="iorder_discount" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Method</label>
                                <select type="text" name="iorder_shipping_method" class="form-control form-control-sm" id="iorder_shipping_method" required>
                                    <option>Variable</option>
                                    <option>Free</option>
                                    <option>Flat Rate</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select type="text" name="iorder_payment_method" class="form-control form-control-sm" id="iorder_payment_method" required>
                                    <option>Cash</option>
                                    <option>Card</option>
                                    <option>Draft</option>
                                    <option>Cheque</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Grand Total</label>
                                <input type="text" name="iorder_grand_total" id="iorder_grand_total" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Payment Status</label>
                                <input type="text" name="iorder_payment_status" id="iorder_payment_status" class="form-control form-control-sm">
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="attendant" class="col-md-4 col-form-label-sm text-right"><b>Attendant:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="iorder_attendant" 
                                        id="iorder_attendant"
                                        value="<?= $user['name'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="iorder_attendant_id" value="<?= $user['id'] ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 offset-md-4 d-flex justify-content-end pl-4">
                            <button id="iorder_create_btn" type="button" class="btn btn-sm bg-theme-accent px-3 mr-2">Process Payment</button>
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

    // getPlatformCompanyDetails();

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
    addNewInlineOrderItemRow();
    
    $("#add").click(function() {
        addNewInlineOrderItemRow();
    });

    $("#remove").click(function() {
        $("#inline_order_item").children("tr:last").remove();
        // calculate(0, 0, 0);
        calculate_inline_order(0, 0, 0);
    });

    $("#inline_order_item").delegate('.product_id', "change", function() {
        inlineOrderItemChangeUpdate(this);
    });

    $("#inline_order_item").delegate(".product_qty", "keyup", function() {
        validateInlineOrderProductQty(this);
    });

    $("#iorder_discount").keyup(function() {
        recalculateInlineOrderDiscount(this);
    });

    $("#iorder_paid_amount").keyup(function() {
        recalculateInlineOrderPaidAmt(this);
    });

    $("#iorder_shipping").keyup(function() {
        recalculateInlineOrderShipping(this);
    });

    // Purchase Requisition Creation
    $("#iorder_create_btn").click(function() {
        var form_data = $("#iorder_form").serializeArray(); 
        createInlineOrder(form_data);
    });    
});

</script>