<?php 
    $subdom_users = fetch_all_subdom_users();
?>

<div class="row">
    <div class="col-md-9">

        <div class="dashboard card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h3 class="my-0">Subdomain Users</h3>
                    <a href="./main.php?dir=subdom_users&page=add_subdom_user" class="btn btn-block btn-sm btn-default btn-flat border-info">
                        <i class="fa fa-plus"></i> Add Subdomain User
                    </a>
                </div>
            </div>
            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($subdom_users == -1 || empty($subdom_users)) {
                    echo "No Record Found"; exit;
                } ?>
                
                <table class="table tabe-hover table-bordered table-users" id="listSubDomUsers">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 20%;">Username</th>
                            <th class="text-left" style="width: 20%;">Domain</th>
                            <th class="text-left" style="width: 15%;">SubDom</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($subdom_users as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left"><b><?php echo $row['username']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['domain_name']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['subdom_name']; ?></b></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <!-- <a class="dropdown-item view_subdom_user" href="javascript:void(0)" data-id="</?php echo $row['sub_dom_user_id']; ?>">View</a> -->
                                    <!-- <div class="dropdown-divider"></div> -->
                                    <a class="dropdown-item" href="./main.php?dir=subdom_users&page=edit_subdom_user&amp;id=<?php echo $row['sub_dom_user_id']; ?>">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_subdom_user" href="javascript:void(0)" data-id="<?php echo $row['sub_dom_user_id']; ?>">Delete</a>
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



<?php include('./pages/modals/confirm.php'); ?>
<?php include('./pages/modals/uni_modal.php'); ?>

<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    $('#listSubDomUsers').DataTable();     // initialize the datatable

    // View Subdomain User
    $('.view_user').click(function(){
        // pull in the html view page with uni_modal
		// uni_modal("<i class='fa fa-id-card'></i> User Details", "main/subdom_users/inc/view_subdom_user.php?id=" + $(this).attr('data-id'));
	});

    // Delete Subdomain User
    $('#listSubDomUsers').delegate('.delete_subdom_user', 'click', function(e) {
        doConfirm("Are you sure to delete this subdomain user?", "deleteSubDomUser", [ $(this).attr('data-id') ])
    })
});

</script>
