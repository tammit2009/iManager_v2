
<?php 
    $storeunits = fetch_all_storeunits();
?>

<div class="row">
    <div class="col-md-12">
        <div class="dashboard card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h4 class="my-1">List of Store Units</h4>
                    <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createDomainModal">
                        <i class="fa fa-plus"></i> Add New Unit
                    </a>
                </div>
            </div>
            <div class="card-body">

            <!-- Status Messages -->
            <div id="alert-msg"></div>

            <?php if ($storeunits == -1 || empty($storeunits)) {
                echo "No Record Found"; exit;
            } ?>

            <table class="table table-bordered table-users" id="listStoreUnits">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-left" style="width: 20%;">Org. Name</th>
                        <th class="text-left" style="width: 20%;">Domain</th>
                        <th class="text-left" style="width: 15%;">SubDom</th>
                        <th class="text-left" style="width: 25%;">Description</th>
                        <th class="text-center" style="width: 12%;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1;
                    foreach ($storeunits as $row) { ?>

                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-left"><b><?php echo $row['org_name']; ?></b></td>
                        <td class="text-left"><b><?php echo $row['domain_name']; ?></b></td>
                        <td class="text-left"><b><?php echo $row['sub_dom']; ?></b></td>
                        <td class="text-left"><b><?php echo $row['sub_dom_descr']; ?></b></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./main.php?dir=orgs&amp;page=view_store_unit&amp;id=<?php echo $row['id']; ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editStoreUnitModal" data-subdomid="<?php echo $row['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_store_unit" id="delete_store_unit" href="javascript:void(0)" did="<?php echo $row['id']; ?>">Delete</a>
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

<!-- Modals -->
<?php include('./pages/main/orgs/modals/create_domain_modal.php'); ?>
<?php include('./pages/main/orgs/modals/edit_domain_modal.php'); ?>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listStoreUnits').DataTable();     // initialize the datatable

    // Delete StoreUnit
    $('#listStoreUnits').delegate('.delete_domain', 'click', function(e) {
        var domainId = $(this).attr("did");
        deleteDomain(domainId);
    })

});
</script>