<?php 
if(isset($_GET['id'])){
    $vendor_porder = getVendorPorderById($_GET['id']);      // foreach($vendor_preq as $k => $v) { $$k = $v; // echo "$$k : $v <br/>"; }
    $vendor_porder_line_items = getVendorPorderLinesById($_GET['id']);
} 
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <?php
            if ($vendor_porder == -1 || empty($vendor_porder)) {
                echo "No Record Found"; 
            } 
            else { 
            ?>

            <div class="card-header bg-white p-2">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <a href="./main.php?dir=vendor_pos&page=list_porders" class="btn btn-outline-default">
                            <i class="fa fa-arrow-left">&nbsp;</i>
                        </a>
                        <h3 class="pt-3">ORDER #<?= $vendor_porder['porder_no']; ?></h3>
                    </div>
                    
                    <div class="col-md-4 d-flex align-items-center justify-content-end">
                        <!-- <a href="./dashboard.php?page=receive_order&amp;id=</?php echo $_GET['id']; ?>"
                            class="btn btn-default btn-flat border-info mr-2" style="border-radius:2px;">
                            <i class="fa fa-dolly"</i> Receive Items
                        </a> -->
                        <button type="button" id="btn_invoice_print" class="btn btn-default btn-flat border-info mr-2" 
                            style="border-radius:2px;" data-xinfo="<?= $_GET['id'] ?>">
                            <i class="fa fa-print"></i> Print Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- <div class="card-header bg-white">  
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="p-2">Order #</?= $order['order_no']; ?></h3>
                    </div>
                    <div class="col-md-4">
                        <h4 class="p-2 text-right"></?= $order['vendor']; ?></h3>
                    </div>
                    <div class="col-md-4">
                        <button 
                            type="button" 
                            id="btn_invoice_print" 
                            class="btn btn-default btn-flat border-primary float-right"
                            data-xinfo="</?= $_GET['id'] ?>"
                        >
                            <i class="fa fa-plus"></i> Print Invoice
                        </button>
                    </div>
                    <div class="col-md-4">
                        <h5 class="p-2"></?= $order['order_date']; ?></h5>
                    </div>
                    <div class="col-md-4">
                        <h5 class="p-2">
                            </?php 
                            if ($order['status'] === 0) {
                                echo "Order Status: <span class='badge badge-secondary p-2'>INITIATED</span>";
                            }
                            else if ($order['status' === 1]) {
                                echo "Order Status: <span class='badge badge-primary p-2'>PENDING</span>";
                            }
                            else {
                                echo "Order Status: <span class='badge badge-success p-2'>COMPLETE</span>"; 
                            }
                            ?>                  
                        </h5>
                    </div>
                    <div class="col-md-4">
                        <h5 class="p-2 text-right">Requester: </?= $order['requester']; ?></h5>
                    </div>
                </div>
            </div> -->
            
                
            <div class="card-body">     

                <div class="row">

                    <div class="col-md-4 p-3">
                        <h6 style="font-style:italic; text-decoration: underline;">Purchase from:</h6>
                        <h4><b><span id="vporder_supplier_company_name"><?= $vendor_porder['vendor'] ?><span></b></h4>
                        <h5 id="vporder_supplier_email"><?= $vendor_porder['vendor_email'] ?></h5>
                        <h6 id="vporder_supplier_address" style="max-width: 250px" >
                        <?= $vendor_porder['vendor_address'] ?>
                        </h6>
                    </div>

                    <div class="col-md-4 p-3">
                        <h6 style="font-style:italic; text-decoration: underline;">Supply to:</h6>
                        <h4><b><span id="porder_customer_name">Reilppus Limited<span></b></h4>
                        <h5 id="vporder_customer_email">sales@reilppus.com</h5>
                        <h6 id="vporder_customer_address" style="max-width: 250px" >
                            210/212 Herbert Macaulay Way, Yaba, Lagos
                        </h6>
                    </div>

                    <div class="col-md-4 p-3">
                        <!-- <h4><b>PURCHASE ORDER</b></h4> -->
                        <table>
                            <tbody>
                                <tr class="py-0">
                                    <td style="width: 53%">
                                        <h6>Order #:</h6>
                                    </td>
                                    <td style="width: 37%">
                                        <h6><b><?= $vendor_porder['porder_no']; ?></b></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6>Date Created:</b></h6></td>
                                    <td><h6><b><?= substr($vendor_porder['porder_date'], 0, 10); ?></b></h6></td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <div>
                            <h6>
                                <?php 
                                if ($vendor_porder['status'] === 0) {
                                    echo "<b>Order Status: <span class='badge badge-secondary p-2 mx-3'>PROCESSING</span></b>";
                                }
                                else {
                                    echo "<b>PO Status: <span class='badge badge-success p-2 mx-3'>COMPLETE</span></b>";
                                }
                                ?>     
                            </h6>
                        </div>

                    </div>
                </div>
                <br>
            
                <?php                
                if ($vendor_porder_line_items == -1 || empty($vendor_porder_line_items)) {
                    echo "No Record Found"; 
                } 
                else {      
                ?>

                <table class="table table-bordered table-orders" id="list">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;" >#</th>
                            <!-- <th class="text-center"  style="width: 7%;">Order No.</th> -->
                            <th class="text-center"  style="width: 7%;">SKU</th>
                            <th class="text-left" style="width: 20%;">Line Descr</th>
                            <th class="text-center"  style="width: 7%;">Quantity</th>
                            <th class="text-center"  style="width: 7%;">Unit Price</th>
                            <th class="text-center"  style="width: 7%;">Total Cost</th>
                            <!-- <th class="text-center" style="width: 10%;">Actions</th> -->
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($vendor_porder_line_items as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <!-- <td class="text-center"><b><?php echo $row['porder_no']; ?></b></td> -->
                            <td class="text-center"><b><?php echo $row['sku']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['product_descr']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['quantity']; ?></b></td>
                            <td class="text-right"><b><?= stdNumFormat($row['unit_price']); ?></b></td>
                            <td class="text-right"><b><?= stdNumFormat($row['total_cost']); ?></b></td>
                            <!-- <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./dashboard.php?page=edit_order&amp;id=</?php echo $row['id']; ?>">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_otfrt" href="javascript:void(0)" data-id="</?php echo $row['id']; ?>">Delete</a>
                                </div>
                            </td> -->
                        </tr>

                        <?php $i++; } ?>

                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Sub-total</b></td>
                            <td class="text-right"><b><?= stdNumFormat($vendor_porder['sub_total']); ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Discount (if any)</b></td>
                            <td class="text-right"><b><?= stdNumFormat($vendor_porder['discount']); ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>VAT (7.5%)</b></td>
                            <td class="text-right"><b><?= stdNumFormat($vendor_porder['vat']); ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Net-total</b></td>
                            <td class="text-right"><b><?= stdNumFormat($vendor_porder['net_total']); ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Shipping</b></td>
                            <td class="text-right"><b><?= stdNumFormat($vendor_porder['shipping_cost']); ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Total (with shipping)</b></td>
                            <td class="text-right"><b><?= stdNumFormat($vendor_porder['net_total'] + $vendor_porder['shipping_cost']); ?></b></td>
                        </tr>

                    </tbody>

                </table>

                <?php } ?>

                <br>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:25%">Shipping Method:</td>
                            <td style="width:75%">
                                <?php 
                                if ($vendor_porder['shipping_method'] === 0) { 
                                    echo "<span>VARIABLE RATE</span>";
                                } else if ($vendor_porder['shipping_method'] === 1) { 
                                    echo "<span>FLAT RATE</span>";
                                } else if ($vendor_porder['shipping_method'] === 2) { 
                                    echo "<span>FREE</span>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Payment Method:</td>
                            <td>
                                <?php 
                                if ($vendor_porder['payment_method'] === 0) { 
                                    echo "<span>CASH PAYMENT</span>";
                                } else if ($vendor_porder['payment_method'] === 1) { 
                                    echo "<span>CARD PAYMENT</span>";
                                } else if ($vendor_porder['payment_method'] === 2) { 
                                    echo "<span>BANK DRAFT</span>";
                                } else if ($vendor_porder['payment_method'] === 3) { 
                                    echo "<span>CHEQUE</span>";
                                } 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Amount Paid:</td>
                            <td><?= stdNumFormat($vendor_porder['paid']); ?></td>
                        </tr>
                        <tr>
                            <td>Amount Due:</td>
                            <td><?= stdNumFormat($vendor_porder['due']); ?></td>
                        </tr>
                        <tr>
                            <td>Src Order Requisition #:</td>
                            <td><?= $vendor_porder['preq_no']; ?></td>
                        </tr>
                        <tr>
                            <td>Requisition Requester:</td>
                            <td><?= $vendor_porder['requester']; ?></td>
                        </tr>
                        <tr>
                            <td>Order Issuer:</td>
                            <td><?= $vendor_porder['issuer']; ?></td>
                        </tr>
                        <tr>
                            <td>Order Issuer Notes:</td>
                            <td>
                                <div class="form-group">
                                    <textarea class="form-control" name="vporder_issuer_notes" id="vporder_issuer_notes" 
                                        rows="5" readonly style="background:ghostwhite;border:none;"><?= $vendor_porder['issuer_notes']; ?>
                                    </textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <?php } ?>

        </div>


    </div>
</div>


<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    //$('#list').DataTable();     // initialize the datatable

    // Print invoice
    $("#btn_invoice_print").click(function() {
        var porderId = $(this).data('xinfo');
        printVendorPorderInvoice(porderId);
    });

});
</script>