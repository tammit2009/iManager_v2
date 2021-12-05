<?php 
    $brands = fetch_all_brands();
?>
<div class="row my-2">
    <div class="col-md-9">
        <div class="dashboard card">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h3 class="my-0">Brands</h3>
                    <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createBrandModal">
                        <i class="fa fa-plus"></i> Add New Brand
                    </a>
                </div>
            </div>
            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($brands == -1 || empty($brands)) {
                    echo "No Record Found"; exit;
                } ?>
                
                <table class="table table-bordered table-users" id="listBrands">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 35%;">Brand Name</th>
                            <th class="text-center" style="width: 25%;">Catalog Symbol</th>
                            <th class="text-center" style="width: 25%;">Created On</th>
                            <!-- <th class="text-left" style="width: 15%;">Created By</th> -->
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($brands as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left"><b><?php echo $row['name']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['catalog_symbol']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['created_on']; ?></b></td>
                            <!-- <td class="text-left"><b></?php echo ucwords($row['created_by']); ?></b></td> -->
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item view_brand" href="javascript:void(0)" data-id="<?php echo $row['brand_id']; ?>">View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editBrandModal" data-brandid="<?php echo $row['brand_id']; ?>">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_brand" href="javascript:void(0)" data-id="<?php echo $row['brand_id']; ?>">Delete</a>
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
<?php include('./pages/main/brands/modals/create_brand_modal.php'); ?>
<?php include('./pages/main/brands/modals/edit_brand_modal.php'); ?>
<?php include('./pages/modals/confirm.php'); ?>
<?php include('./pages/modals/uni_modal.php'); ?>

<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    $('#listBrands').DataTable();     // initialize the datatable

    // View Brand
    $('#listBrands').delegate('.view_brand', 'click', function(e) {
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> Brand Details", "main/brands/inc/view_brand.php?id=" + $(this).attr('data-id'));
    })

    // Delete Brand
    $('#listBrands').delegate('.delete_brand', 'click', function(e) {
        doConfirm("Are you sure to delete this brand?", "deleteBrand", [ $(this).attr('data-id') ])
    })
});

</script>