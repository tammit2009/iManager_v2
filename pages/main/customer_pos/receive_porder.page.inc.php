<?php 
if(isset($_GET['id'])){
    $porder = fetch_customer_porder_by_id2($_GET['id']);
    $porder_lines = fetch_customer_porder_line_items2($_GET['id']);
}
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <form id="porder_receive_form">

                <?php if ($porder == -1 || empty($porder)) {
                    echo "No Record Found"; exit;
                } ?>

                <div class="card-header bg-white">  
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <a href="./main.php?dir=customer_pos&page=list_porders" class="btn btn-outline-default">
                                <i class="fa fa-arrow-left">&nbsp;</i>
                            </a>
                            <h3 class="p-2 pt-3">Receiving: <?= $porder['description']; ?></h3>
                        </div>
                        <div class="col-md-4">
                            <h3 class="p-2 pt-3 text-right">#<?= $porder['porder_no']; ?></h3>
                        </div>
                        <input type="hidden" name="porder_rx_domain_id" class="porder_rx_domain_id" value="<?= $porder['domain_id']; ?>">
                        <input type="hidden" name="porder_rx_subdom_id" class="porder_rx_subdom_id" value="<?= $porder['sub_dom_id']; ?>">
                    </div>
                </div>
            
                <div class="card-body">

                    <?php if ($porder_lines == -1 || empty($porder_lines)) {
                        echo "No Record Found"; exit;
                    } ?>

                    <table class="table tabe-hover table-bordered table-requisitions" id="list">

                        <thead>
                            <tr>
                                <th class="text-center"  style="width: 4%;" >#</th>
                                <th class="text-left"    style="width: 15%;">Product Name</th>
                                <th class="text-left"    style="width: 25%;">Product Descr</th>
                                <th class="text-center"  style="width: 10%;">Unit</th>
                                <th class="text-center"  style="width: 10%;">Ordered Qty</th>
                                <th class="text-center"  style="width: 10%;">Fulfilled</th>
                                <th class="text-center"  style="width: 10%;">Receive Qty</th>
                                <th class="text-center"  style="width: 10%;">Pending</th>
                                <!-- <th class="text-center" style="width: 10%;">Actions</th> -->
                            </tr>
                        </thead>

                        <tbody id="receive_purchase_order_item">

                            <?php $i = 1;
                            foreach ($porder_lines as $row) { ?>

                                <tr role="row" class="odd">
                                    <td class="text-center">
                                        <?php echo $i; ?>
                                        <input type="hidden" name="product_id[]" class="product_id" value="<?= $row['catalog_product_id']; ?>"> 
                                        <input type="hidden" name="product_sku[]" class="product_sku" value="<?= $row['product_sku']; ?>">
                                    </td>
                                    <td class="text-left"><b><?php echo $row['product_name']; ?></b></td>
                                    <td class="text-left"><b><?php echo $row['product_descr']; ?></b></td>
                                    <td class="text-center"><b><?php echo $row['unit']; ?></b></td>
                                    <td class="text-center">
                                        <!-- <input type="hidden" class="product_ordered_qty" name="product_ordered_qty[]" val="</?= $row['quantity']; ?>">
                                        <span class="product_ordered_qty"><b></?php echo $row['quantity']; ?></b></span> -->
                                        <b class="product_ordered_qty"><?php echo $row['quantity']; ?></b>
                                    </td>
                                    <td class="text-center">
                                        <b class="product_fulfilled_qty">
                                            <?php echo $row['rx_quantity']; ?>
                                        </b>
                                    </td>
                                    <td class="text-center">
                                        <input 
                                            type="text" 
                                            class="form-control form-control-sm product_rx_qty text-right" 
                                            name="product_rx_qty[]" 
                                            value="0"
                                            required
                                            style="border: none; background-color:ivory;"
                                        >
                                    </td>
                                    <td class="text-center">
                                        <b class="product_pending_qty">
                                            <?php echo intval($row['quantity']) - intval($row['rx_quantity']); ?>
                                        </b>
                                    </td>
                                    <!-- <td class="text-center">
                                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            Action
                                        </button>
                                        </!-- <div class="dropdown-menu">
                                            <a class="dropdown-item" href="./dashboard.php?page=edit_requisition&amp;id=<?php echo $row['id']; ?>">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_requisition" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                                        </div> --/>
                                    </td> -->
                                </tr>

                            <?php $i++; } ?>

                        </tbody>

                    </table>

                    <br>

                    <div>
                        <h3>Details</h3>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:20%;">Purchase Order #:</td>
                                    <td>
                                        <input type="hidden" name="porder_rx_porder_id" value="<?= $_GET['id']; ?>">
                                        <?= $porder['porder_no']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        <input type="hidden" name="porder_rx_status" id="porder_rx_status" value="<?= $porder['status']; ?>">
                                        <div id="status_indicator"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Originator:</td>
                                    <td>
                                        <input type="hidden" name="porder_rx_originator_id" value="<?= $porder['originator_id']; ?>">
                                        <?= $porder['originator']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Customer:</td>
                                    <td>
                                        <input type="hidden" name="porder_rx_customer_id" value="<?= $porder['customer_id']; ?>">
                                        <?= $porder['customer']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Receiver:</td>
                                    <td>
                                        <input type="hidden" name="porder_rx_receiver_id" value="<?= $user['id']; ?>">
                                        <?= $user['name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Receiver Notes:</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="porder_rx_notes">Add to notes</label>
                                            <textarea class="form-control" name="porder_rx_notes" id="porder_rx_notes" 
                                                rows="5"><?= $porder['notes']; ?></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end"">
                                            <button type="button" id="product_rx_update_btn" class="btn btn-warning mr-2">Receive Items</button>
                                            <button type="button" id="product_rx_close_btn" class="btn btn-info mr-2">Close PO</button>
                                            <button type="button" id="product_rx_cancel_btn" class="btn btn-secondary">Cancel</button>
                                        </div> 
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    
                </div>

            </form>

        </div>
    </div>
</div>


<script>
$(document).ready(function(){

    //$('#list').DataTable();     // initialize the datatable

    $('.page-title').addClass('d-none');

    $("#receive_purchase_order_item").delegate(".product_rx_qty", "keyup", function() {
        updateCustomerPorderQty(this);
    });

    // Receive PO Items
    $("#product_rx_update_btn").click(function() {
        var form_data = $("#porder_receive_form").serializeArray(); // convert form to array
        receiveCustomerPorderItems(form_data);
    });

    
    // initial display of the requisition status
    var porder_status = $("input[name*='porder_rx_status']").val();  // name of the attribute: $("#porder_rx_status").attr("name");
    displayStatus(porder_status);

    function displayStatus(status) {
        status_str = "";
        if (status === "0") { 
            status_str = "<span class='badge badge-secondary p-2'>PROCESSING</span>";
        } else if (status === "1") { 
            status_str =  "<span class='badge badge-warning p-2'>PENDING</span>";
        } else if (status === "2") { 
            status_str =  "<span class='badge badge-primary p-2'>APPROVED</span>";
        } else if (status === "3") { 
            status_str =  "<span class='badge badge-success p-2'>COMPLETED</span>";
        } else if (status === "4") { 
            status_str =  "<span class='badge badge-danger p-2'>REJECTED</span>";
        } else { 
            status_str =  "<span class='badge badge-warning p-2'>UNKNOWN</span>";
        } 
        $("#status_indicator").html(status_str);
    }

});

</script>