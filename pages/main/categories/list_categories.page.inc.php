<?php 
    $categories = fetch_all_categories();
?>
<div class="row my-2">
    <div class="col-md-9">
        <div class="dashboard card">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h3 class="my-0">Categories</h3>
                    <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createCategoryModal">
                        <i class="fa fa-plus"></i> Add New Category
                    </a>
                </div>
            </div>
            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($categories == -1 || empty($categories)) {
                    echo "No Record Found"; exit;
                } ?>
                
                <table class="table table-bordered table-users" id="listCategories">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 25%;">Category Name</th>
                            <!-- <th class="text-left" style="width: 15%;">Description</th> -->
                            <th class="text-center" style="width: 15%;">Created On</th>
                            <!-- <th class="text-left" style="width: 15%;">Created By</th> -->
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($categories as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left"><b><?php echo $row['name']; ?></b></td>
                            <!-- <td class="text-left"><b></?php echo $row['description']; ?></b></td> -->
                            <td class="text-center"><b><?php echo ucwords($row['created_on']); ?></b></td>
                            <!-- <td class="text-left"><b></?php echo $row['created_by']; ?></b></td> -->
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item view_category" href="javascript:void(0)" data-id="<?php echo $row['category_id']; ?>">View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editCategoryModal" data-categoryid="<?php echo $row['category_id']; ?>">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_category" href="javascript:void(0)" data-id="<?php echo $row['category_id']; ?>">Delete</a>
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
<?php include('./pages/main/categories/modals/create_category_modal.php'); ?>
<?php include('./pages/main/categories/modals/edit_category_modal.php'); ?>
<?php include('./pages/modals/confirm.php'); ?>
<?php include('./pages/modals/uni_modal.php'); ?>

<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    $('#listCategories').DataTable();     // initialize the datatable

    $('#listCategories').delegate('.view_category', 'click', function(e) {
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> Category Details", "main/categories/inc/view_category.php?id=" + $(this).attr('data-id'));
    })

    // Delete Category
    $('#listCategories').delegate('.delete_category', 'click', function(e) {
        doConfirm("Are you sure to delete this category?", "deleteCategory", [ $(this).attr('data-id') ])
    })

});

</script>