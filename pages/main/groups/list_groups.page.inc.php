
<?php 
    $groups = fetch_all_groups();
?>

<div class="row">
    <div class="col-md-8">
        <div class="dashboard card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h4 class="my-1">List of Groups</h4>
                    <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createGroupModal">
                        <i class="fa fa-plus"></i> Add New Group
                    </a>
                </div>
            </div>
            <div class="card-body">

            <!-- Status Messages -->
            <div id="alert-msg"></div>

            <?php if ($groups == -1 || empty($groups)) {
                echo "No Record Found"; exit;
            } ?>

            <table class="table table-bordered table-users" id="listGroups">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-left" style="width: 15%;">Name</th>
                        <th class="text-left" style="width: 35%;">Description</th>
                        <th class="text-center" style="width: 10%;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1;
                    foreach ($groups as $group) { ?>

                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-left"><b><?php echo $group['name']; ?></b></td>
                        <td class="text-left"><b><?php echo $group['description']; ?></b></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./main.php?dir=groups&amp;page=view_group&amp;id=<?php echo $group['id']; ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editGroupModal" data-groupid="<?php echo $group['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_group" id="delete_group" href="javascript:void(0)" did="<?php echo $group['id']; ?>">Delete</a>
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
<?php include('./pages/main/groups/modals/create_group_modal.php'); ?>
<?php include('./pages/main/groups/modals/edit_group_modal.php'); ?>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listGroups').DataTable();     // initialize the datatable

    // Status Messages
    <?php if (isset($_SESSION['status'])): ?>
        // swal
        createAutoClosingAlert("#alert-msg", "<?php echo flash('msg'); ?>", "<?php echo flash('status'); ?>", 4000);
        // toastr (if required instead)
        // toastr.success("</?php echo flash('status'); ?>");
    <?php endif; ?>

    // Delete Group
    $('#listGroups').delegate('.delete_group', 'click', function(e) {
        var groupId = $(this).attr("did");
        deleteGroup(groupId);
    })

});
</script>
