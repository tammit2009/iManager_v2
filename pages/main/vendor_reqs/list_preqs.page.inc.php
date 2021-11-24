<?php 
    $vendorpreqs = fetch_all_vendor_preqs();
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h3 class="my-0">Vendor Purchase Requisitions</h3>
                    <a href="./main.php?dir=vendor_reqs&page=add_preq" class="btn btn-block btn-sm btn-default btn-flat border-info">
                        <i class="fa fa-plus"></i> Add New Requisition
                    </a>
                </div>
            </div>

            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($vendorpreqs == -1 || empty($vendorpreqs)) {
                    echo "No Record Found"; exit;
                } ?>

                <table class="table tabe-hover table-bordered table-orders" id="listVendorPreqs">

                    <thead>
                        <tr>
                            <!-- <th class="text-center" style="width: 4%;">#</th> -->
                            <th class="text-center" style="width: 4%;">ID</th>
                            <th class="text-center" style="width: 13%;">Request Date</th>
                            <th class="text-center" style="width: 12%;">RefID</th>
                            <th class="text-left" style="width: 20%;">Description</th>
                            <th class="text-left" style="width: 15%;">Requester</th>
                            <th class="text-right" style="width: 10%;">Cost</th>
                            <th class="text-center" style="width: 10%;">Status</th>
                            <th class="text-center" style="width: 10%;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($vendorpreqs as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <!-- <td class="text-center"><b></?php echo $row['id']; ?></b></td> -->
                            <td class="text-center"><b><?php echo substr($row['preq_date'], 0, 10); ?></b></td>
                            <td class="text-center"><b><?php echo $row['preq_no']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['description']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['requester']; ?></b></td>
                            <td class="text-right"><b><?= stdNumFormat($row['base_cost']); ?></b></td>
                            <td class="text-center">
                                <b>
                                    <?php 
                                    if ($row['status'] === 0) { 
                                        echo "<span class='badge badge-secondary p-2'>PROCESSING</span>";
                                    } else if ($row['status'] === 1) { 
                                        echo "<span class='badge badge-warning p-2'>PENDING</span>";
                                    } else if ($row['status'] === 2) { 
                                        echo "<span class='badge badge-primary p-2'>APPROVED</span>";
                                    } else if ($row['status'] === 3) { 
                                        echo "<span class='badge badge-success p-2'>COMPLETED</span>";
                                    } else if ($row['status'] === 4) { 
                                        echo "<span class='badge badge-danger p-2'>REJECTED</span>";
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
                                    <a class="dropdown-item" href="./main.php?dir=vendor_reqs&page=view_preq&amp;id=<?php echo $row['id']; ?>">View</a>
                                    <div class="dropdown-divider"></div>
                                    <?php if ($row['status'] === 2) { ?>
                                        <a 
                                            class="dropdown-item create_vendor_porders" 
                                            href="./main.php?dir=vendor_pos&page=add_porders&amp;id=<?php echo $row['id']; ?>&amp;prno=<?php echo $row['preq_no']; ?>">
                                            Create Orders
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    <?php } ?>
                                    <a class="dropdown-item delete_vendor_preq" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                                </div>
                            
                            </td>
                        </tr>

                        <?php $i++; } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    $('#listVendorPreqs').DataTable();     // initialize the datatable

});
</script>