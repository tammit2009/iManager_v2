<?php 
if(isset($_GET['id']) && isset($_GET['prno'])){
    $related_vendors = getVendorsInfoFromPreqLineItemsByPreqId($_GET['id']);  
} 
?>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header bg-white p-3 d-flex align-items-center">
                <a href="./main.php?dir=vendor_reqs&page=list_preqs" class="btn btn-secondary mr-3">
                    <i class="fa fa-arrow-left">&nbsp;</i>Back              
                </a>
                <h3 style="margin:0"><?php echo "Create Purchase Orders from Requisition #". $_GET['prno']; ?></h3</div>
            </div>
        </div>

        <?php if ($related_vendors == -1 || empty($related_vendors)) {
            echo "No Record Found"; 
        } else { 
            foreach ($related_vendors as $vendor_row) { ?>    
                            
            <div class="card my-3">
                <form id="orders_form"> 

                    <!-- <div class="card-header bg-theme-accent" style="font-weight: bold; font-size: 18px;">
                        Create Order
                    </div> -->

                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-md-7">
                                <h5>Vendor: <b style="font-size: 25px; line-height: 25px"><?= $vendor_row['vendor'] ?></b></h5>
                            </div>

                            <div class="col-md-5 text-right">
                                <h5>Requisition Created: <b><?= substr($vendor_row['preq_date'], 0, 10) ?></b></h5>
                            </div>
                        </div>

                        <?php $vendorpreq_lines = getVendorPreqLinesByVendorId($_GET['id'], $vendor_row['vendor_id']);   
                        if ($vendorpreq_lines == -1 || empty($vendorpreq_lines)) {
                            echo "No Record Found"; 
                        } else {  ?> 

                        <table class="table table-orders" id="add_vendor_porder_list">

                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 4%;">#</th>
                                    <th class="text-left"  style="width: 15%;">Product</th>
                                    <th class="text-left"  style="width: 25%;">Description</th>
                                    <th class="text-center" style="width: 12%;">Rate</th>
                                    <th class="text-center" style="width: 12%;">Quantity</th>
                                    <th class="text-center" style="width: 10%;">Total</th>
                                    <!-- <th class="text-center" style="width: 5%;">Action</th> -->
                                </tr>
                            </thead>

                            <tbody id="vendor_porder_item">

                                <?php $i = 1;
                                $subtotal = 0;
                                $vat = 0.075;       // TODO: get a system variable for this
                                foreach ($vendorpreq_lines as $row) { ?>

                                <tr>
                                    <td class="text-center pt-3"><b class="number">1</b></td>
                                    <td class="text-left">
                                        <?= $row['product_name'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $row['product_name_descr'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= stdNumFormat($row['rate']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['quantity'] ?>
                                    </td>
                                    <td class="text-right">
                                        <?= stdNumFormat($row['total']) ?>
                                    </td>
                                </tr>

                                <?php 
                                    $i++;
                                    $subtotal += $row['total'];
                                } ?>

                            </tbody>
                        </table>

                        <?php } ?>

                        <hr>

                        <div class="row">
                            <!-- order subtotal -->
                            <div class="offset-md-7 col-md-5">
                                <div class="form-group row">
                                    <label for="order_subtotal" class="col-sm-7 col-form-label col-form-label-sm text-right"><b>Sub-Total:</b></label>
                                    <div class="col-sm-5 pt-0">
                                        <input 
                                            type="text" 
                                            class="form-control form-control-sm text-right" 
                                            style="border:none;background-color: transparent; font-weight: bold;"
                                            name="order_subtotal" 
                                            value="<?= stdNumFormat($subtotal); ?>" required readonly
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 pt-2"></div>
                            <div class="col-md-2 pt-2"></div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a class="btn bg-theme-accent px-3" 
                                href="./main.php?dir=vendor_pos&page=add_porder&amp;prid=<?php echo $_GET['id']; ?>&amp;vid=<?php echo $vendor_row['vendor_id']; ?>">
                                    Create Order
                                </a>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
                
            <?php }
        } ?>      

    </div>
</div>


<script>
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    // Event Date Picker
    $.datetimepicker.setDateFormatter('moment');
    $('.picker').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'YYYY-MM-DD HH:mm',    // use momentjs format
        value: new Date(),              // default value
    });
    $('#toggle').on('click', function() {
        $('.picker').datetimepicker('toggle');
    });

});

</script>