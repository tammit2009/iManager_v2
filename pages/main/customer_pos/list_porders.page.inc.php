<?php 
    $customerpos = fetch_all_customer_purchase_orders();
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h3 class="my-0">Customer Purchase Orders</h3>
                </div>
            </div>

            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($customerpos == -1 || empty($customerpos)) {
                    echo "No Record Found"; exit;
                } ?>

                <table class="table table-bordered table-orders" id="listCustomerPO">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;">#</th>
                            <th class="text-left"  style="width: 7%;">PO #</th>
                            <th class="text-center" style="width: 12%;">PO Date</th>
                            <th class="text-center" style="width: 9%;">PR #</th>
                            <th class="text-left" style="width: 15%;">Description</th>
                            <th class="text-left" style="width: 15%;">Customer</th>
                            <th class="text-right" style="width: 7%;">Net Total</th>
                            <th class="text-center" style="width: 7%;">Status</th>
                            <th class="text-center" style="width: 8%;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($customerpos as $row) { ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left"><b><?php echo $row['porder_no']; ?></b></td>
                                <td class="text-center"><b><?php echo substr($row['porder_date'], 0, 10); ?></b></td>
                                <td class="text-center"><b><?php echo $row['preq_no']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['description']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['customer']; ?></b></td>
                                <td class="text-right"><b><?= stdNumFormat($row['net_total']); ?></b></td>
                                <td class="text-center">
                                    <b>
                                        <?php 
                                        if ($row['status'] === 0) { 
                                            echo "<span class='badge badge-secondary p-2'>PROCESSING</span>";
                                        } else if ($row['status'] === 1) { 
                                            echo "<span class='badge badge-primary p-2'>PARTIALLY</span>";
                                        } else if ($row['status'] === 2) { 
                                            echo "<span class='badge badge-success p-2'>FULFILLED</span>";
                                        } else { 
                                            echo "<span class='badge badge-warning p-2'>UNKNOWN</span>";
                                        } 
                                        ?>
                                    </b>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="./main.php?dir=customer_pos&page=view_porder&amp;id=<?php echo $row['id']; ?>">View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item receive_porder" href="./main.php?dir=customer_pos&page=receive_porder&amp;id=<?php echo $row['id']; ?>">Receive</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_porder" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                                    </div>
                                </td>
                            </tr>

                        <?php  $i++; } ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>


<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    $('#listCustomerPO').DataTable();     // initialize the datatable

});
</script>