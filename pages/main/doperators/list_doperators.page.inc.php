<?php 
    $operators = fetch_all_dom_operators();
?>

<div class="dashboard card my-2">
    <div class="card-header bg-white">
        <div class="card-header-panel d-flex align-items-center justify-content-between">
            <h3 class="my-0">Domain Operators</h3>
            <a href="./main.php?dir=doperators&page=add_doperator" class="btn btn-block btn-sm btn-default btn-flat border-info">
                <i class="fa fa-plus"></i> Add Domain Operators
            </a>
        </div>
    </div>
    <div class="card-body">

        <!-- Status Messages -->
        <div id="alert-msg"></div>

        <?php if ($operators == -1 || empty($operators)) {
            echo "No Record Found"; exit;
        } ?>
        
        <table class="table table-bordered table-users" id="listDoperators">

            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">#</th>
                    <th class="text-left" style="width: 15%;">Username</th>
                    <th class="text-left" style="width: 15%;">Domain</th>
                    <th class="text-left" style="width: 10%;">Sub_Dom</th>
                    <th class="text-left" style="width: 20%;">Function Key</th>
                    <th class="text-left" style="width: 10%;">Role</th>
                    <th class="text-center" style="width: 10%;">Action</th>
                </tr>
			</thead>

            <tbody>

                <?php $i = 1;
                foreach ($operators as $row) { ?>

                <tr role="row" class="odd">
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-left"><b><?php echo $row['username']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['domain']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['sub_dom']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['dom_function']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['assoc_rolename']; ?></b></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view_doperator" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./main.php?dir=doperators&page=edit_doperator&amp;id=<?php echo $row['id']; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_doperator" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
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

    $('#listDoperators').DataTable();     // initialize the datatable

    // View User
    $('.view_doperator').click(function(){
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> Operator Details", "main/doperators/inc/view_doperator.php?id=" + $(this).attr('data-id'));
	});

    // Delete User
    $('#listDoperators').delegate('.delete_doperator', 'click', function(e) {
        doConfirm("Are you sure to delete this domain operator?", "deleteDoperator", [ $(this).attr('data-id') ])
    })
});

</script>
