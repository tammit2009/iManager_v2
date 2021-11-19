
<?php 
    $roles = fetch_all_roles();
?>

<div class="row">
    <div class="col-md-8">
        <div class="dashboard card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h4 class="my-1">List of Roles</h4>
                    <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createRoleModal">
                        <i class="fa fa-plus"></i> Add New Role
                    </a>
                </div>
            </div>
            <div class="card-body">

            <!-- Status Messages -->
            <div id="alert-msg"></div>

            <?php if ($roles == -1 || empty($roles)) {
                echo "No Record Found"; exit;
            } ?>

            <table class="table table-hover table-bordered table-users" id="listRoles">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-left" style="width: 15%;">Name</th>
                        <th class="text-left" style="width: 35%;">Description</th>
                        <th class="text-center" style="width: 10%;">PAL</th>
                        <th class="text-center" style="width: 10%;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1;
                    foreach ($roles as $role) { ?>

                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-left"><b><?php echo $role['name']; ?></b></td>
                        <td class="text-left"><b><?php echo $role['description']; ?></b></td>
                        <td class="text-center"><b><?php echo $role['page_access_level']; ?></b></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <!-- <a class="dropdown-item" href="./main.php?dir=roles&page=edit_role&amp;id=</?php echo $role['id']; ?>">Edit</a> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editRoleModal" data-roleid="<?php echo $role['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_role" id="delete_role" href="javascript:void(0)" did="<?php echo $role['id']; ?>">Delete</a>
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
<?php include('./pages/main/roles/modals/create_role_modal.php'); ?>
<?php include('./pages/main/roles/modals/edit_role_modal.php'); ?>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listRoles').DataTable();     // initialize the datatable

    // Status Messages
    <?php if (isset($_SESSION['status'])): ?>
        // swal
        createAutoClosingAlert("#alert-msg", "<?php echo flash('msg'); ?>", "<?php echo flash('status'); ?>", 4000);
        // toastr (if required instead)
        // toastr.success("</?php echo flash('status'); ?>");
    <?php endif; ?>

    // Delete Role
    $('#listRoles').delegate('.delete_role', 'click', function(e) {
        var roleId = $(this).attr("did");
        deleteRole(roleId);
    })

});
</script>
