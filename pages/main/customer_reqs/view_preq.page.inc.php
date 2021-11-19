

<!-- REFACTOR FOR PREQ -->

<?php 
if(isset($_GET['id'])){
    $porder = fetch_customer_porder_by_id($_GET['id']);
    $porder_lines = fetch_customer_porder_line_items($_GET['id']);
}
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <?php if ($porder == -1 || empty($porder)) {
                echo "No Record Found"; exit;
            } ?>

            <div class="card-header bg-white p-2">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <a href="./main.php?dir=customer_pos&page=list_porders" class="btn btn-outline-default">
                            <i class="fa fa-arrow-left">&nbsp;</i>
                        </a>
                        <h3 class="pt-3">PURCHASE ORDER #<?= $porder['porder_no']; ?></h3>
                    </div>
                    
                    <div class="col-md-4 d-flex align-items-center justify-content-end">
                        <a href="./main.php?dir=customer_pos&page=receive_porder&amp;id=<?php echo $_GET['id']; ?>"
                            class="btn btn-default btn-flat border-info mr-2" style="border-radius:2px;">
                            <i class="fa fa-dolly"></i> Receive Items
                        </a>
                        <button type="button" id="btn_invoice_print" class="btn btn-default btn-flat border-info mr-2" 
                            style="border-radius:2px;" data-xinfo="<?= $_GET['id'] ?>">
                            <i class="fa fa-print"></i> Print Invoice
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">  

                <div class="row">

                    <div class="col-md-4 p-3">
                        <h6 style="font-style:italic; text-decoration: underline;">Purchase from:</h6>
                        <h4><b><span id="porder_supplier_company_name">PO Supplier Company Name<span></b></h4>
                        <h5 id="porder_supplier_email">supplier@mail.com</h5>
                        <h6 id="porder_supplier_address" style="max-width: 250px" >
                            Sample Address, 23 Ladipo Street, Lekki
                        </h6>
                    </div>

                    <div class="col-md-4 p-3">
                        <h6 style="font-style:italic; text-decoration: underline;">Supply to:</h6>
                        <h4><b><span id="porder_customer_name"><?= $porder['customer_name']; ?><span></b></h4>
                        <h5 id="porder_customer_email"><?= $porder['contact_email']; ?></h5>
                        <h6 id="porder_customer_address" style="max-width: 250px" >
                        <?= $porder['address']; ?>
                        </h6>
                    </div>

                    <div class="col-md-4 p-3">
                        <!-- <h4><b>PURCHASE ORDER</b></h4> -->
                        <table>
                            <tbody>
                                <tr class="py-0">
                                    <td style="width: 53%">
                                        <h6>Purchase Order #:</h6>
                                    </td>
                                    <td style="width: 37%">
                                        <h6><b><?= $porder['porder_no']; ?></b></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6>Date Created:</b></h6></td>
                                    <td><h6><b><?= substr($porder['porder_date'], 0, 10); ?></b></h6></td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <div>
                            <h6>
                                <?php 
                                if ($porder['status'] === 0) {
                                    echo "<b>PO Status: <span class='badge badge-secondary p-2 mx-3'>PROCESSING</span></b>";
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

                <?php if ($porder_lines == -1 || empty($porder_lines)) {
                    echo "No Record Found"; exit;
                } ?>

                <table class="table table-bordered table-orders" id="listPorderLines">

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
                        foreach ($porder_lines as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <!-- <td class="text-center"><b></?php echo $row['order_no']; ?></b></td> -->
                            <td class="text-center"><b><?php echo $row['sku']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['short_descr']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['quantity']; ?></b></td>
                            <td class="text-right"><b><?php echo $row['unit_price']; ?></b></td>
                            <td class="text-right"><b><?php echo $row['total_cost']; ?></b></td>
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
                            <td class="text-right"><b><?= $porder['sub_total']; ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Discount (if any)</b></td>
                            <td class="text-right"><b><?= $porder['discount']; ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>VAT (7.5%)</b></td>
                            <td class="text-right"><b><?= $porder['vat']; ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Net-total</b></td>
                            <td class="text-right"><b><?= $porder['net_total'] ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Shipping</b></td>
                            <td class="text-right"><b><?= $porder['shipping_cost']; ?></b></td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td colspan="5" class="text-right"><b>Total (with shipping)</b></td>
                            <td class="text-right"><b><?= $porder['net_total'] + $porder['shipping_cost']; ?></b></td>
                        </tr>

                    </tbody>

                </table>

                <br>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:25%">Shipping Method:</td>
                            <td style="width:75%">
                                <?php 
                                if ($porder['shipping_method'] === 0) { 
                                    echo "<span>VARIABLE RATE</span>";
                                } else if ($porder['shipping_method'] === 1) { 
                                    echo "<span>FLAT RATE</span>";
                                } else if ($porder['shipping_method'] === 2) { 
                                    echo "<span>FREE</span>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Payment Method:</td>
                            <td>
                                <?php 
                                if ($porder['payment_method'] === 0) { 
                                    echo "<span>CASH PAYMENT</span>";
                                } else if ($porder['payment_method'] === 1) { 
                                    echo "<span>CARD PAYMENT</span>";
                                } else if ($porder['payment_method'] === 2) { 
                                    echo "<span>BANK DRAFT</span>";
                                } else if ($porder['payment_method'] === 3) { 
                                    echo "<span>CHEQUE</span>";
                                } 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Amount Paid:</td>
                            <td><?= $porder['paid']; ?></td>
                        </tr>
                        <tr>
                            <td>Amount Due:</td>
                            <td><?= $porder['due']; ?></td>
                        </tr>
                        <tr>
                            <td>Purchase Order Notes:</td>
                            <td>
                                <div class="form-group">
                                    <!-- <label for="purchase_order_notes">Insert notes</label> -->
                                    <textarea class="form-control" name="purchase_order_notes" id="purchase_order_notes" 
                                        rows="5" readonly style="background:ghostwhite;border:none;"><?= $porder['notes']; ?></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    //getPlatformCompanyDetails();

    // Approve Requisition - Accepting Data
    $("#requisition_approve_btn").click(function() {
        alert("Approve button clicked");

        var form_data = $("#porder_receive_form").serializeArray(); // convert form to array
        approveCustomerPreq(form_data);

        // if ($("#requistion_approver_notes").val() === "") {
        //     alert("Please enter approver notes");
        // }
        // else {
        //     var form_data = $("#view_approve_complete_requisition_form").serializeArray(); // convert form to array
        //     form_data.push({name: "requisition_approve", value: 2});
        //     $.ajax({
        //         url: `${baseUrl}/imanager/core/services/process.php`,
        //         method: "POST",
        //         data: form_data,                // data: $("#view_approve_complete_requisition_form").serialize()
        //         success: function(rsp) {
        //             //alert(rsp);
        //             var retCode = parseInt(rsp);
        //             if (retCode < 0) {
        //                 // Notification using sweetalert lib
        //                 swalert_notify("Approval Failed", 'Failed to approve the requisition', 'error');
        //             }
        //             else {
        //                 $("#view_approve_complete_requisition_form").trigger("reset");
        //                 var status, msg;
        //                 if (retCode === 0) {    // approved
        //                     status = "success";
        //                     msg = "Requisition successfully approved";
        //                 }
        //                 else {                  // unknown error
        //                     status = "warning";
        //                     msg = "Unknown";
        //                 }

        //                 // Notification using helper function 'flash' in utilities (redirect)
        //                 $.ajax({
        //                     // Send notification
        //                     url: `${baseUrl}/imanager/core/services/process.php`,
        //                     method: "POST",
        //                     data: { "send_notification": 1, "status": status, "msg": msg},                
        //                     success: function(resp) {
        //                         //alert(resp);
        //                     }
        //                 });

        //                 // Do a redirect to list requisitions
        //                 window.location = `${baseUrl}/imanager/admin/dashboard.php?page=list_requisitions`;
        //             }
        //         }
        //     });
        // }       
    });    

    // Reject Requisition
    $("#requisition_reject_btn").click(function() {
        alert("Reject PReq clicked");

        // var form_data = $("#view_approve_complete_requisition_form").serializeArray(); // convert form to array
        // form_data.push({name: "requisition_approve", value: 4});
        // $.ajax({
        //     url: `${baseUrl}/imanager/core/services/process.php`,
        //     method: "POST",
        //     data: form_data,                // data: $("#view_approve_complete_requisition_form").serialize()
        //     success: function(rsp) {
        //         //alert(rsp);
        //         var retCode = parseInt(rsp);
        //         if (retCode < 0) {
        //             swalert_notify("Approval Failed", 'Failed to approve the requisition', 'error');
        //         }
        //         else {
        //             $("#view_approve_complete_requisition_form").trigger("reset");
        //             var status, msg;
        //             if (retCode === 1) {    // rejected
        //                 status = "error";
        //                 msg = "Requisition rejected";
        //             }
        //             else {                  // unknown error
        //                 status = "error";
        //                 msg = "Unknown error";
        //             }
        //             $.ajax({
        //                 // Send notification
        //                 url: `${baseUrl}/imanager/core/services/process.php`,
        //                 method: "POST",
        //                 data: { "send_notification": 1, "status": status, "msg": msg},                
        //                 success: function(resp) {
        //                     //alert(resp);
        //                 }
        //             });
        //         }
                
        //         // Do a redirect to lis requisitions
        //         window.location = `${baseUrl}/imanager/admin/dashboard.php?page=list_requisitions`;
        //     }
        // });

    });

    // Hold Requisition
    $("#requisition_hold_btn").click(function() {

        alert("Hold button clicked");

    });

    // Reject from Store
    $("#requisition_store_reject_btn").click(function() {

        alert("Store reject button clicked");

    }); 

});
</script>
