<?php 
// Refactor to customer preq
if(isset($_GET['id'])){
    $customer_preq = getCustomerPreqById($_GET['id']);      // foreach($vendor_preq as $k => $v) { $$k = $v; // echo "$$k : $v <br/>"; }
    $customer_preq_line_items = getCustomerPreqLinesById($_GET['id']);
} 
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <?php
            if ($customer_preq == -1 || empty($customer_preq)) {
                echo "No Record Found"; 
            } 
            else { 
            ?>

            <div class="card-header bg-white">  
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <a href="./main.php?dir=customer_reqs&page=list_preqs" class="btn btn-outline-default">
                            <i class="fa fa-arrow-left">&nbsp;</i>
                        </a>
                        <h3 class="p-2 pt-3"><?= $customer_preq['description']; ?></h3>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <h3 class="p-2 pt-3">#<?= $customer_preq['preq_no']; ?></h3>
                        <?php if ($customer_preq['status'] == '2') { ?> 
                        <a  class="btn btn-secondary ml-2" 
                            href="./main.php?dir=customer_pos&page=add_porder&amp;prid=<?php echo $_GET['id']; ?>&amp;prno=<?php echo $customer_preq['preq_no']; ?>">                            
                            Create Order
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
                
            <div class="card-body">     

                <?php                
                if ($customer_preq_line_items == -1 || empty($customer_preq_line_items)) {
                    echo "No Record Found"; 
                } 
                else {      
                ?>

                <table class="table table-bordered table-orders" id="list">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;" >#</th>
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
                        foreach ($customer_preq_line_items as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><b><?php echo $row['sku']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['product_descr']; ?></b></td>
                            <td class="text-right"><b><?= stdNumFormat($row['unit_price']); ?></b></td>
                            <td class="text-center"><b><?php echo $row['quantity']; ?></b></td>
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

                    </tbody>
                </table>

                <?php } ?>

                <div class="customer_preq_details my-5">
                    <h3>Related Information</h3>

                    <form id="customer_preq_view_create_order_form">

                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <td>Purchase Requisition ID:</td>
                                    <td>
                                        <input type="hidden" name="customer_preq_id" id="customer_preq_id" value="<?= $_GET['id']; ?>">
                                        <input type="hidden" name="customer_preq_no" id="customer_preq_no" value="<?= $customer_preq['preq_no']; ?>">
                                        <?= $customer_preq['preq_no']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Creation Date:</td>
                                    <td><?= substr($customer_preq['preq_date'], 0, 16); ?></td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td><?= $customer_preq['description']; ?></td>
                                </tr>
                                <tr>
                                    <td>Customer:</td>
                                    <td><?= $customer_preq['customer']; ?></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        <input type="hidden" name="customer_preq_status" id="customer_preq_status" value="<?= $customer_preq['status']; ?>">
                                        <div id="status_indicator"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Originator:</td>
                                    <td>
                                        <input type="hidden" name="customer_preq_requester" value="<?= $customer_preq['originator']; ?>">
                                        <?= $customer_preq['originator']; ?>
                                    </td>
                                </tr>
                                <tr>
                                <td>Approver:</td>
                                    <td>    
                                        <input type="hidden" name="customer_preq_approver_id" value="<?= $customer_preq['approver_id']; ?>">
                                        <input type="hidden" name="customer_preq_approver" value="<?= $customer_preq['approver']; ?>">
                                        <?= $customer_preq['approver']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approver Notes:</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="customer_preq_approver_notes">Insert notes</label>
                                            <textarea class="form-control text-left" name="customer_preq_approver_notes" id="customer_preq_approver_notes" 
                                                rows="5"><?= $customer_preq['approver_notes']; ?></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end"">
                                            <button type="button" id="customer_preq_approve_btn" class="btn btn-info mr-2">Approve</button>
                                            <button type="button" id="customer_preq_reject_btn" class="btn btn-danger">Reject</button>
                                        </div> 
                                    </td>
                                </tr>

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
    var customer_preq_status = $("input[name*='customer_preq_status']").val();  // name of the attribute: $("#order_requisition_status").attr("name");
    displayStatus(customer_preq_status);

    // Approve Customer Purchase Requisition - Accepting Data
    $("#customer_preq_approve_btn").click(function() {
        // convert form to array
        var form_data = $("#customer_preq_view_create_order_form").serializeArray(); 
        approveCustomerPurchaseRequisition(form_data);
    });    
    
    // Reject Order Requisition
    $("#customer_preq_reject_btn").click(function() {
        // convert form to array
        var form_data = $("#customer_preq_view_create_order_form").serializeArray(); 
        rejectCustomerPurchaseRequisition(form_data);
    });

});
</script>