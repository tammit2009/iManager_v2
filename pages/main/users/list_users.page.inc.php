<?php 
    $users = fetch_all_users();
?>

<div class="dashboard card my-2">
    <div class="card-header bg-white">
        <div class="card-header-panel d-flex align-items-center justify-content-between">
            <h3 class="my-0">Users</h3>
            <a href="./main.php?dir=users&page=add_user" class="btn btn-block btn-sm btn-default btn-flat border-info">
                <i class="fa fa-plus"></i> Add New User
            </a>
        </div>
    </div>
    <div class="card-body">

        <!-- Status Messages -->
        <div id="alert-msg"></div>

        <?php if ($users == -1 || empty($users)) {
            echo "No Record Found"; exit;
        } ?>
        
        <table class="table tabe-hover table-bordered table-users" id="listUsers">

            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">#</th>
                    <th class="text-left" style="width: 15%;">Name</th>
                    <th class="text-left" style="width: 15%;">Email</th>
                    <th class="text-left" style="width: 15%;">Group Name</th>
                    <th class="text-left" style="width: 15%;">Domain</th>
                    <th class="text-center" style="width: 10%;">Action</th>
                </tr>
			</thead>

            <tbody>

                <?php $i = 1;
                foreach ($users as $row) { ?>

                <tr role="row" class="odd">
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-left"><b><?php echo $row['name']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['email']; ?></b></td>
                    <td class="text-left"><b><?php echo ucwords($row['usergroup']); ?></b></td>
                    <td class="text-left"><b><?php echo $row['domain']; ?></b></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./main.php?dir=users&page=edit_user&amp;id=<?php echo $row['id']; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                        </div>
                    </td>
                </tr>

                <?php $i++; } ?>

            </tbody>
        </table>

    </div>
</div>

<?php include('./pages/modals/confirm.php'); ?>
<?php include('./pages/modals/uni_modal.php'); ?>

<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    $('#listUsers').DataTable();     // initialize the datatable

    // View User
    $('.view_user').click(function(){
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> User Details", "main/users/inc/view_user.php?id=" + $(this).attr('data-id'));
	});

    // Delete User
    $('#listUsers').delegate('.delete_user', 'click', function(e) {
        doConfirm("Are you sure to delete this user?", "deleteUser", [ $(this).attr('data-id') ])
    })
});

</script>
