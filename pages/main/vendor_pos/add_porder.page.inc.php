<?php 
if(isset($_GET['prid']) && isset($_GET['vid'])){
    $vendor_preq = getVendorPreqById($_GET['prid']);  
    $vendor_preq_lines = getVendorPreqLinesByVendorId($_GET['prid'], $_GET['vid']);
} 
else {
    echo "Invalid Page"; 
    exit;
}
?>

<div class="row my-2">
    <div class="col-md-12">

        <div class="card my-3">
            <div class="card-header bg-theme-accent" style="font-weight: bold; font-size: 18px;">
                Create Vendor Purchase Order
            </div>
            <div class="card-body">

                <?php if ($vendor_preq == -1 || empty($vendor_preq)) {
                    echo "No Record Found"; 
                } else { ?>

                <form id="vendor_porder_form">
                    <input type="hidden" name="vendor_porder_prid" id="vendor_porder_prid" value="<?= $_GET['prid'] ?>">
                    <input type="hidden" name="vendor_porder_prno" id="vendor_porder_prno" value="<?= $vendor_preq['preq_no'] ?>">
                    <input type="hidden" name="vendor_porder_vid" id="vendor_porder_vid" value="<?= $_GET['vid'] ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <input type="text" name="vendor_porder_supplier" id="vendor_porder_supplier" class="form-control form-control-sm" value="">
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
                                    <input type='text' id="picker" name="vendor_porder_date" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="vendor_porder_domainid" name="vendor_porder_domainid" value="<?= $vendor_preq['domain_id'] ?>">
                                <label for="domainid">Company Domain:</label>
                                <input type='text' id="vendor_porder_domain" name="vendor_porder_domain" class="form-control form-control-sm" value="<?= $vendor_preq['domain_name'] ?>" readonly />
                            </div>                                
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="vendor_porder_subdomid" name="vendor_porder_subdomid" value="<?= $vendor_preq['sub_dom_id'] ?>">
                                <label for="subdomid">Subdomain:</label>
                                <input type='text' id="vendor_porder_subdom" name="vendor_porder_subdom" class="form-control form-control-sm" value="<?= $vendor_preq['sub_dom_name'] ?>" readonly />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Purchase Order Description</label>
                                <input type="text" name="vendor_porder_descr" id="vendor_porder_descr" class="form-control form-control-sm" required value="<?php echo isset($vendor_porder_descr) ? $vendor_porder_descr : '' ?>">
                            </div>
                        </div>
                    </div>

                    <table class="table table-orders" id="add_vendor_porder_list">
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
                        <tbody id="vendor_porder_item">

                            <?php
                            if ($vendor_preq_lines == -1 || empty($vendor_preq_lines)) {
                                echo "No Record Found"; 
                            } else {  
                                
                                $i = 1;
                                $subtotal = 0;
                                $vat = 0.075;       // TODO: get a system variable for this

                                foreach ($vendor_preq_lines as $row) { ?>
                          
                                <tr>
                                    <td class="text-center pt-3"><b class="number">1</b></td>
                                    <td class="text-left">
                                        <?= $row['product_name'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $row['brand'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $row['product_name_descr'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['unit'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= stdNumFormat($row['rate']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['quantity'] ?>
                                    </td>
                                    <td class="text-right">
                                        <span class="product_total"><?= stdNumFormat($row['total']) ?></span>
                                    </td>
                                </tr>

                                <?php 
                                    $i++;
                                    $subtotal += $row['total'];
                                } 
                            }?>

                        </tbody>
                    </table>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sub-Total</label>
                                <input type="text" name="vendor_porder_subtotal" id="vendor_porder_subtotal" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Total Amount</label>
                                <input type="text" name="vendor_porder_total_amt" id="vendor_porder_total_amt" class="form-control form-control-sm" 
                                required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Paid Amount</label>
                                <input type="text" name="vendor_porder_paid_amount" id="vendor_porder_paid_amount" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">VAT (7.5%)</label>
                                <input type="text" name="vendor_porder_vat" id="vendor_porder_vat" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Cost</label>
                                <input type="text" name="vendor_porder_shipping" id="vendor_porder_shipping" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Due Amount</label>
                                <input type="text" name="vendor_porder_due_amount" id="vendor_porder_due_amount" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Discount</label>
                                <input type="text" name="vendor_porder_discount" id="vendor_porder_discount" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Method</label>
                                <select type="text" name="vendor_porder_shipping_method" class="form-control form-control-sm" id="vendor_porder_shipping_method" required>
                                    <option>Variable</option>
                                    <option>Free</option>
                                    <option>Flat Rate</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select type="text" name="vendor_porder_payment_method" class="form-control form-control-sm" id="vendor_porder_payment_method" required>
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
                                <input type="text" name="vendor_porder_grand_total" id="vendor_porder_grand_total" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Payment Status</label>
                                <input type="text" name="vendor_porder_payment_status" id="vendor_porder_payment_status" class="form-control form-control-sm">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8 pt-2">
                            <label for="porder_notes">Order Issuer Notes</label>
                            <textarea class="form-control" name="vendor_porder_issuer_notes" id="vendor_porder_issuer_notes" rows="5" required></textarea>
                        </div>
                        <div class="col-md-4 pt-2">

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="approver" class="col-md-4 col-form-label-sm text-left"><b>Requester:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="vendor_porder_requester" 
                                        id="vendor_porder_requester"
                                        value="<?= $vendor_preq['requester'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="vendor_porder_requester_id" value="<?= $vendor_preq['requester_id'] ?>">
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
                                    <input type="hidden" name="vendor_porder_issuer_id" value="<?= $user['id'] ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 d-flex justify-content-end">
                            <button id="vendor_porder_create_btn" type="button" class="btn btn-sm bg-theme-accent px-3 mr-2">Submit Order</button>
                            <button class="btn btn-sm btn-secondary px-3" type="button" 
                                onclick="location.href = 'main.php?dir=vendor_pos&page=add_porders&amp;id=<?php echo $_GET['prid']; ?>&amp;prno=<?php echo $vendor_preq['preq_no']; ?>'"
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

    // Set the vendor name
    getVendorById();

    // Initialize the calculated totals
    calculate_vendor_porder(0, 0, 0);

    $("#vendor_porder_discount").keyup(function() {
        validateVendorPorderDiscount(this);
    });

    $("#vendor_porder_paid_amount").keyup(function() {
        validateVendorPorderPaidAmount(this);
    });

    $("#vendor_porder_shipping").keyup(function() {
        validateVendorPorderShipping(this);
    });

    // Create the vendor purchase order
    $("#vendor_porder_create_btn").click(function() {
        var form_data = $("#vendor_porder_form").serializeArray(); 
        createVendorPurchaseOrder(form_data); 
    });    

});

</script>