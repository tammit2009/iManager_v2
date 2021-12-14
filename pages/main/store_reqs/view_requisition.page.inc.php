<?php 
if(isset($_GET['id'])){
    $store_req = fetch_storereq_by_id($_GET['id']);
    $store_req_lines = fetch_storereq_lines_by_id($_GET['id']);
}
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <?php if ($store_req == -1 || empty($store_req)) {
                echo "No Record Found"; exit;
            }
            else { ?>

            <div class="card-header bg-white">  
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <a href="./main.php?dir=store_reqs&page=list_requisitions" class="btn btn-outline-default">
                            <i class="fa fa-arrow-left">&nbsp;</i>
                        </a>
                        <h3 class="p-2 pt-3"><?= $store_req['brief_description']; ?></h3>
                    </div>
                    <div class="col-md-4">
                        <h3 class="p-2 pt-3 text-right">#<?= $store_req['requisition_no']; ?></h3>
                    </div>
                </div>
            </div>
                
            <div class="card-body">     

                <?php if ($store_req_lines == -1 || empty($store_req_lines)) {
                    echo "No Record Found"; 
                }
                else { ?>

                <table class="table table-bordered table-requisitions" id="listStoreReqs">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;" >#</th>
                            <th class="text-center"  style="width: 7%;">Requisition No.</th>
                            <th class="text-center"  style="width: 7%;">SKU</th>
                            <th class="text-left" style="width: 18%;">Line Descr</th>
                            <th class="text-center"  style="width: 7%;">Stock Avail</th>
                            <th class="text-center"  style="width: 7%;">Requested Qty</th>
                            <th class="text-center"  style="width: 7%;">Issued Qty</th>
                            <!-- <th class="text-center" style="width: 10%;">Actions</th> -->
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($store_req_lines as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><b><?php echo $row['requisition_no']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['sku']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['description']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['stock_avail']; ?></td>
                            <td class="text-center"><b><?php echo $row['requested_qty']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['issued_qty']; ?></b></td>
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

                <?php } ?>

                <div class="requisition_details my-5">
                    <h3>Related Information</h3>

                    <form id="view_approve_complete_requisition_form">

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Requisition ID:</td>
                                    <td>
                                        <input type="hidden" name="requisition_approval_id" id="requisition_approval_id" value="<?= $_GET['id']; ?>">
                                        <input type="hidden" name="requisition_approval_no" id="requisition_approval_no" value="<?= $store_req['requisition_no']; ?>">
                                        <input type="hidden" name="requisition_domain_id"   id="requisition_domain_id" value="<?= $store_req['domain_id']; ?>">
                                        <input type="hidden" name="requisition_subdom_id"   id="requisition_subdom_id" value="<?= $store_req['sub_dom_id']; ?>">
                                        <?= $store_req['requisition_no']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Creation Date:</td>
                                    <td><?= $store_req['request_date']; ?></td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td><?= $store_req['brief_description']; ?></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        <input type="hidden" name="requisition_status" id="requisition_status" value="<?= $store_req['status']; ?>">
                                        <div id="status_indicator"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Originator:</td>
                                    <td>
                                        <input type="hidden" name="requisition_requester" value="<?= $store_req['requester']; ?>">
                                        <?= $store_req['requester']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approver:</td>
                                    <td>    
                                        <input type="hidden" name="requisition_approver_id" value="<?= $store_req['approver_id']; ?>">
                                        <input type="hidden" name="requisition_approver" value="<?= $store_req['approver']; ?>">
                                        <?= $store_req['approver']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approver Notes:</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="requistion_approver_notes">Insert notes</label>
                                            <textarea class="form-control text-left" name="requistion_approver_notes" id="requistion_approver_notes" 
                                                rows="5"><?= $store_req['approver_notes']; ?></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end"">
                                            <button type="button" id="requisition_approve_btn" class="btn btn-info mr-2">Approve</button>
                                            <button type="button" id="requisition_reject_btn" class="btn btn-danger">Reject</button>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Store Keeper:</td>
                                    <td>
                                        <input type="hidden" name="requisition_storekeeper_id" value="<?= $store_req['storekeeper_id']; ?>">
                                        <input type="hidden" name="requisition_storekeeper" value="<?= $store_req['storekeeper']; ?>">
                                        <?= $store_req['storekeeper']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Store Keeping Notes:</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="requistion_store_notes">Insert notes</label>
                                            <textarea class="form-control" name="requistion_store_notes" id="requistion_store_notes" 
                                                rows="5"><?= $store_req['storekeeper_notes']; ?></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end"">
                                            <!-- <button type="button" id="requisition_modify_btn" class="btn btn-warning mr-2 launch_modal_here">Modify</button> -->
                                            <!-- <button type="button" id="requisition_hold_btn" class="btn btn-secondary mr-2">Hold</button> -->
                                            <button type="button" id="requisition_complete_btn" class="btn btn-info mr-2">Complete</button>
                                            <button type="button" id="requisition_store_reject_btn" class="btn btn-danger">Reject</button>
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

    //$('#listStoreReqs').DataTable();     // initialize the datatable

    $('.page-title').addClass('d-none');

    // initial display of the requisition status
    var requistion_status = $("input[name*='requisition_status']").val();  // name of the attribute: $("#requisition_status").attr("name");
    displayStatus(requistion_status);

    // Approve Requisition - Accepting Data
    $("#requisition_approve_btn").click(function() {
        var form_data = $("#view_approve_complete_requisition_form").serializeArray(); 
        approveStoreRequisition(form_data);
    });    

    // Reject Requisition
    $("#requisition_reject_btn").click(function() {
        var form_data = $("#view_approve_complete_requisition_form").serializeArray(); 
        rejectStoreRequisition(form_data);
    });

    // Hold Requisition
    $("#requisition_hold_btn").click(function() {
        var form_data = $("#view_approve_complete_requisition_form").serializeArray();
        storekeeperHoldStoreRequisition(form_data);
    });
    
    // Complete Requisition
    $("#requisition_complete_btn").click(function() {
        var form_data = $("#view_approve_complete_requisition_form").serializeArray();
        storekeeperCompleteStoreRequisition(form_data);
    });

    // Store Reject Requisition
    $("#requisition_store_reject_btn").click(function() {
        var form_data = $("#view_approve_complete_requisition_form").serializeArray();
        storekeeperRejectStoreRequisition(form_data);
    }); 

});

</script>
