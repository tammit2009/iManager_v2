<?php 
    $customers = fetch_all_customers();
?>

<div class="dashboard card my-2">
    <div class="card-header bg-white">
        <div class="card-header-panel d-flex align-items-center justify-content-between">
            <h3 class="my-0">Customers</h3>
            <a href="./main.php?dir=customers&page=add_customer" class="btn btn-block btn-sm btn-default btn-flat border-info">
                <i class="fa fa-plus"></i> Add Customer
            </a>
        </div>
    </div>
    <div class="card-body">

        <!-- Status Messages -->
        <div id="alert-msg"></div>

        <?php if ($customers == -1 || empty($customers)) {
            echo "No Record Found"; exit;
        } ?>
        
        <table class="table tabe-hover table-bordered table-users" id="listCustomers">

            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">#</th>
                    <th class="text-left" style="width: 15%;">Name</th>
                    <th class="text-left" style="width: 15%;">Domain</th>
                    <!-- <th class="text-left" style="width: 12%;">Type</th> -->
                    <th class="text-left" style="width: 20%;">Address</th>
                    <th class="text-center" style="width: 10%;">Action</th>
                </tr>
			</thead>

            <tbody>

                <?php $i = 1;
                foreach ($customers as $row) { ?>

                <tr role="row" class="odd">
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-left"><b><?php echo $row['name']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['domain']; ?></b></td>
                    <!-- <td class="text-left"><b></?php echo $row['type']; ?></b></td> -->
                    <td class="text-left"><b><?php echo $row['address']; ?></b></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view_customer" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./main.php?dir=customers&page=edit_customer&amp;id=<?php echo $row['id']; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_customer" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
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

    $('#listCustomers').DataTable();     // initialize the datatable

    // View Customer
    $('.view_customer').click(function(){
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> Customer Details", "main/customers/inc/view_customer.php?id=" + $(this).attr('data-id'));
	});

    // Delete Customer
    $('#listCustomers').delegate('.delete_customer', 'click', function(e) {
        doConfirm("Are you sure to delete this customer?", "deleteCustomer", [ $(this).attr('data-id') ])
    })
});

</script>
