<?php 
if(isset($_GET['prid']) && isset($_GET['prno'])) {
    $customer_preq = getCustomerPreqById($_GET['prid']);  
    $customer_preq_lines = getCustomerPreqLinesById($_GET['prid']);
} 
else {
    echo "Invalid Page"; 
    exit;
}
?>

<div class="row my-2">
    <div class="col-md-12">

        <div class="card my-2">
            <div class="card-header bg-theme-accent" style="font-weight: bold; font-size: 18px;">
                Create Customer Purchase Order
            </div>
            <div class="card-body">

                <?php if ($customer_preq == -1 || empty($customer_preq)) {
                    echo "No Record Found"; 
                } else { ?>

                <form id="customer_porder_form">

                    <input type="hidden" name="customer_porder_prid" id="customer_porder_prid" value="<?= $_GET['prid'] ?>">
                    <input type="hidden" name="customer_porder_prno" id="customer_porder_prno" value="<?= $customer_preq['preq_no'] ?>">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="customer_porder_customer_id" id="customer_porder_customer_id" value="<?= $customer_preq['customer_id'] ?>">
                                <label for="">Customer</label>
                                <input type="text" name="customer_porder_customer" id="customer_porder_customer" class="form-control form-control-sm" value="<?= $customer_preq['customer'] ?>">
                            </div>
                        </div>

                        <div class="col-md-3"></div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Order Date</label>
                                <div class='input-group' id='datetimepicker1' style="width: 100%;">
                                    <div class="input-group-prepend">
                                        <button type="button" id="toggle" class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                    <input type='text' id="picker" name="customer_porder_date" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="customer_porder_domainid" name="customer_porder_domainid" value="<?= $customer_preq['domain_id'] ?>">
                                <label for="domainid">Company Domain:</label>
                                <input type='text' id="customer_porder_domain" name="customer_porder_domain" class="form-control form-control-sm" value="<?= $customer_preq['domain_name'] ?>" readonly />
                                <!-- <select name="domainid" id="domainid" class="custom-select custom-select-sm">
                                    <option value="</?= $customer_preq['domain_id'] ?>"></?= $customer_preq['domain_name'] ?></option>
                                </select> -->
                            </div>                                
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="customer_porder_subdomid" name="customer_porder_subdomid" value="<?= $customer_preq['sub_dom_id'] ?>">
                                <label for="subdomid">Subdomain:</label>
                                <input type='text' id="customer_porder_subdom" name="customer_porder_subdom" class="form-control form-control-sm" value="<?= $customer_preq['subdom_name'] ?>" readonly />
                                <!-- <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                                    <option value="</?= $customer_preq['sub_dom_id'] ?>"></?= $customer_preq['subdom_name'] ?></option>
                                </select> -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Purchase Order Description</label>
                                <input type="text" name="customer_porder_descr" id="customer_porder_descr" class="form-control form-control-sm" required value="<?php echo isset($customer_porder_descr) ? $customer_porder_descr : '' ?>">
                            </div>
                        </div>
                    </div>

                    <table class="table table-orders" id="add_customer_porder_list">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-left"  style="width: 12%;">Product</th>
                                <th class="text-left"  style="width: 12%;">Brand</th>
                                <th class="text-left"  style="width: 25%;">Description</th>
                                <th class="text-center" style="width: 12%;">Unit</th>
                                <th class="text-center" style="width: 12%;">Rate</th>
                                <th class="text-center" style="width: 12%;">Quantity</th>
                                <th class="text-center" style="width: 10%;">Total</th>
                                <!-- <th class="text-center" style="width: 5%;">Action</th> -->
                            </tr>
                        </thead>
                        <tbody id="customer_porder_item">

                            <?php
                            if ($customer_preq_lines == -1 || empty($customer_preq_lines)) {
                                echo "No Record Found"; 
                            } else {  
                                
                                $i = 1;
                                $subtotal = 0;
                                $vat = 0.075;       // TODO: get a system variable for this

                                foreach ($customer_preq_lines as $row) { ?>
                          
                                <tr>
                                    <td class="text-center pt-3"><b class="number">1</b></td>
                                    <td class="text-left">
                                        <?= $row['product_name'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $row['brand'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $row['product_descr'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['unit'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= stdNumFormat($row['unit_price']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['quantity'] ?>
                                    </td>
                                    <td class="text-right">
                                        <span class="product_total"><?= stdNumFormat($row['total_cost']) ?></span>
                                    </td>
                                </tr>

                                <?php 
                                    $i++;
                                    $subtotal += $row['total_cost'];
                                } 
                            }?>

                        </tbody>
                    </table>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sub-Total</label>
                                <input type="text" name="customer_porder_subtotal" id="customer_porder_subtotal" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Total Amount</label>
                                <input type="text" name="customer_porder_total_amt" id="customer_porder_total_amt" class="form-control form-control-sm" 
                                required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Paid Amount</label>
                                <input type="text" name="customer_porder_paid_amount" id="customer_porder_paid_amount" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">VAT (7.5%)</label>
                                <input type="text" name="customer_porder_vat" id="customer_porder_vat" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Cost</label>
                                <input type="text" name="customer_porder_shipping" id="customer_porder_shipping" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Due Amount</label>
                                <input type="text" name="customer_porder_due_amount" id="customer_porder_due_amount" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Discount</label>
                                <input type="text" name="customer_porder_discount" id="customer_porder_discount" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Method</label>
                                <select type="text" name="customer_porder_shipping_method" class="form-control form-control-sm" id="customer_porder_shipping_method" required>
                                    <option>Variable</option>
                                    <option>Free</option>
                                    <option>Flat Rate</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select type="text" name="customer_porder_payment_method" class="form-control form-control-sm" id="customer_porder_payment_method" required>
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
                                <input type="text" name="customer_porder_grand_total" id="customer_porder_grand_total" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Payment Status</label>
                                <input type="text" name="customer_porder_payment_status" id="customer_porder_payment_status" class="form-control form-control-sm">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8 pt-2">
                            <label for="porder_notes">Order Issuer Notes</label>
                            <textarea class="form-control" name="customer_porder_issuer_notes" id="customer_porder_issuer_notes" rows="5" required></textarea>
                        </div>
                        <div class="col-md-4 pt-2">

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="" class="col-md-4 col-form-label-sm text-left"><b>Originator:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="customer_porder_originator" 
                                        id="customer_porder_originator"
                                        value="<?= $customer_preq['originator'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="customer_porder_originator_id" value="<?= $customer_preq['originator_id'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="issuer" class="col-md-4 col-form-label-sm text-right"><b>Issuer:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="issuer" 
                                        id="issuer"
                                        value="<?= $user['name'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="customer_porder_issuer_id" value="<?= $user['id'] ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 d-flex justify-content-end">
                            <button id="customer_porder_create_btn" type="button" class="btn btn-sm bg-theme-accent px-3 mr-2">Submit Order</button>
                            <button class="btn btn-sm btn-secondary px-3" type="button" 
                                onclick="location.href = 'main.php?dir=customer_pos&page=list_porders'"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>

                </form>

                <?php } ?>

            </div>
        </div>


    </div>
</div>


<script>

$(document).ready(function(){

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

    // Initialize the calculated totals
    calculate_customer_porder(0, 0, 0);

    $("#customer_porder_discount").keyup(function() {
        validateCustomerPorderDiscount(this);
    });

    $("#customer_porder_paid_amount").keyup(function() {
        validateCustomerPorderPaidAmount(this);
    });

    $("#customer_porder_shipping").keyup(function() {
        validateCustomerPorderShipping(this);
    });

    // Create the vendor purchase order
    $("#customer_porder_create_btn").click(function() {
        var form_data = $("#customer_porder_form").serializeArray(); 
        createCustomerPurchaseOrder(form_data); 
    });    

});

</script>