<?php 
if(isset($_GET['id'])){
    $vendor_preq = getVendorPreqById($_GET['id']);      // foreach($vendor_preq as $k => $v) { $$k = $v; // echo "$$k : $v <br/>"; }
    $vendor_preq_line_items = getVendorPreqLinesById($_GET['id']);
} 
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <?php
            if ($vendor_preq == -1 || empty($vendor_preq)) {
                echo "No Record Found"; 
            } 
            else { 
            ?>

            <div class="card-header bg-white">  
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <a href="./main.php?dir=vendor_reqs&page=list_preqs" class="btn btn-outline-default">
                            <i class="fa fa-arrow-left">&nbsp;</i>
                        </a>
                        <h3 class="p-2 pt-3"><?= $vendor_preq['description']; ?></h3>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <h3 class="p-2 pt-3">#<?= $vendor_preq['preq_no']; ?></h3>
                        <a  class="btn btn-secondary ml-2" 
                            href="./main.php?dir=vendor_pos&page=add_porders&amp;id=<?php echo $_GET['id']; ?>&amp;prno=<?php echo $vendor_preq['preq_no']; ?>">
                            Create Orders
                        </a>
                    </div>
                </div>
            </div>
                
            <div class="card-body">     
                <!-- <input type="hidden" id="order_requisition_id" name="order_requisition_id" value="</?= $_GET['id'] ?>"> -->

                <?php                
                if ($vendor_preq_line_items == -1 || empty($vendor_preq_line_items)) {
                    echo "No Record Found"; 
                } 
                else {      
                ?>

                <table class="table table-bordered table-orders" id="list">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;" >#</th>
                            <th class="text-left"  style="width: 15%;">Vendor</th>
                            <th class="text-center"  style="width: 10%;">SKU</th>
                            <th class="text-left" style="width: 25%;">Product Descr</th>
                            <th class="text-center" style="width: 10%;">Rate</th>
                            <th class="text-center"  style="width: 10%;">Quantity</th>
                            <th class="text-center"  style="width: 10%;">Total</th>
                            <!-- <th class="text-center" style="width: 10%;">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        foreach ($vendor_preq_line_items as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left"><b><?php echo $row['vendor']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['sku']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['product_descr']; ?></b></td>
                            <td class="text-right"><b><?= stdNumFormat($row['rate']); ?></b></td>
                            <td class="text-center"><b><?php echo $row['quantity']; ?></b></td>
                            <td class="text-right"><b><?= stdNumFormat($row['total']); ?></b></td>
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

                    </tbody>
                </table>

                <?php } ?>

                <div class="vendor_preq_details my-5">
                    <h3>Related Information</h3>

                    <form id="vendor_preq_view_create_order_form">

                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <td>Order Requisition ID:</td>
                                    <td>
                                        <input type="hidden" name="vendor_preq_id" id="vendor_preq_id" value="<?= $_GET['id']; ?>">
                                        <input type="hidden" name="vendor_preq_no" id="vendor_preq_no" value="<?= $vendor_preq['preq_no']; ?>">
                                        <?= $vendor_preq['preq_no']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Creation Date:</td>
                                    <td><?= substr($vendor_preq['preq_date'], 0, 16); ?></td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td><?= $vendor_preq['description']; ?></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        <input type="hidden" name="vendor_preq_status" id="vendor_preq_status" value="<?= $vendor_preq['status']; ?>">
                                        <div id="status_indicator"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Originator:</td>
                                    <td>
                                        <input type="hidden" name="vendor_preq_requester" value="<?= $vendor_preq['requester']; ?>">
                                        <?= $vendor_preq['requester']; ?>
                                    </td>
                                </tr>
                                <tr>
                                <td>Approver:</td>
                                    <td>    
                                        <input type="hidden" name="vendor_preq_approver_id" value="<?= $vendor_preq['approver_id']; ?>">
                                        <input type="hidden" name="vendor_preq_approver" value="<?= $vendor_preq['approver']; ?>">
                                        <?= $vendor_preq['approver']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approver Notes:</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="vendor_preq_approver_notes">Insert notes</label>
                                            <textarea class="form-control text-left" name="vendor_preq_approver_notes" id="vendor_preq_approver_notes" 
                                                rows="5"><?= $vendor_preq['approver_notes']; ?></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end"">
                                            <button type="button" id="vendor_preq_approve_btn" class="btn btn-info mr-2">Approve</button>
                                            <button type="button" id="vendor_preq_reject_btn" class="btn btn-danger">Reject</button>
                                        </div> 
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>Issuer:</td>
                                    <td>    
                                        <input type="hidden" name="order_requisition_issuer_id" value="</?= $user['id']; ?>">
                                        <input type="hidden" name="order_requisition_issuer_name" value="</?= $user['name']; ?>">
                                        </?= $user['name']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Issuer Notes:</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="order_requisition_issuer_notes">Insert notes</label>
                                            <textarea class="form-control text-left" name="order_requisition_issuer_notes" id="order_requisition_issuer_notes" 
                                                rows="5"></?= $order_req['issuer_notes']; ?></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end"">
                                            <button id="order_requisition_create_orders_btn" type="button" class="btn bg-theme-accent px-4 mr-2">Create Orders</button>
                                            <button class="btn btn-secondary" type="button"  onclick="location.href = 'dashboard.php?page=list_order_requisitions'">Back</button>
                                        </div> 
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>

                    </form>

                </div>

                <div class="logs my-5">
                    <h3>Logs</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>User</th>
                                <th>Changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2021-09-21 11:33</td>
                                <td>Tammi Takaya</td>
                                <td>
                                    <ul>
                                        <li>Action: Initiate Requisition</li>
                                        <li>Status: Initial state is Processing</li>
                                        <li>Route: Set Administrator as Approver</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>2021-09-21 11:33</td>
                                <td>Administrator</td>
                                <td>
                                    <ul>
                                        <li>Action: Approve Requisition</li>
                                        <li>Status: From Processing to Approved</li>
                                        <li>Route: Send to Store for Release</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>2021-09-21 11:33</td>
                                <td>StoreKeeper</td>
                                <td>
                                    <ul>
                                        <li>Action: Release stock to requester</li>
                                        <li>Status: From Approved to Completed</li>
                                        <li>Route: End</li>
                                    </ul>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>

            <?php } ?>
            
        </div>

    </div>
</div>


<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    // //$('#list').DataTable();     // initialize the datatable

    // initial display of the order status
    var vendor_preq_status = $("input[name*='vendor_preq_status']").val();  // name of the attribute: $("#order_requisition_status").attr("name");
    displayStatus(vendor_preq_status);

    // Approve Vendor Purchase Requisition - Accepting Data
    $("#vendor_preq_approve_btn").click(function() {
        // convert form to array
        var form_data = $("#vendor_preq_view_create_order_form").serializeArray(); 
        approveVendorPurchaseRequisition(form_data);
    });    
    
    // Reject Order Requisition
    $("#vendor_preq_reject_btn").click(function() {
        // convert form to array
        var form_data = $("#vendor_preq_view_create_order_form").serializeArray(); 
        rejectVendorPurchaseRequisition(form_data);
    });

});
</script>