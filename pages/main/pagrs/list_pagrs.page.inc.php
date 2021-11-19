
<?php 
    $pagrs = fetch_all_pagrs();
?>

<div class="row">
    <div class="col-md-8">
        <div class="dashboard card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h4 class="my-1">Page Access Groups</h4>
                    <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createPagrModal">
                        <i class="fa fa-plus"></i> Add PAGroup
                    </a>
                </div>
            </div>
            <div class="card-body">

            <!-- Status Messages -->
            <div id="alert-msg"></div>

            <?php if ($pagrs == -1 || empty($pagrs)) {
                echo "No Record Found"; exit;
            } ?>

            <table class="table table-bordered table-users" id="listPagrs">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-left" style="width: 15%;">Label</th>
                        <th class="text-left" style="width: 35%;">Description</th>
                        <th class="text-center" style="width: 10%;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1;
                    foreach ($pagrs as $pagr) { ?>

                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-left"><b><?php echo $pagr['label']; ?></b></td>
                        <td class="text-left"><b><?php echo $pagr['description']; ?></b></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./main.php?dir=pagrs&amp;page=view_pagr&amp;id=<?php echo $pagr['id']; ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editPagrModal" data-pagrid="<?php echo $pagr['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_pagr" id="delete_pagr" href="javascript:void(0)" did="<?php echo $pagr['id']; ?>">Delete</a>
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
<?php include('./pages/main/pagrs/modals/create_pagr_modal.php'); ?>
<?php include('./pages/main/pagrs/modals/edit_pagr_modal.php'); ?>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listPagrs').DataTable();     // initialize the datatable

    // Status Messages
    <?php if (isset($_SESSION['status'])): ?>
        // swal
        createAutoClosingAlert("#alert-msg", "<?php echo flash('msg'); ?>", "<?php echo flash('status'); ?>", 4000);
        // toastr (if required instead)
        // toastr.success("</?php echo flash('status'); ?>");
    <?php endif; ?>

    // Delete pagr
    $('#listPagrs').delegate('.delete_pagr', 'click', function(e) {
        var pagrId = $(this).attr("did");
        deletePagr(pagrId);
    })

});
</script>
