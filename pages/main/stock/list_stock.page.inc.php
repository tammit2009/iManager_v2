<?php 
    $stock = fetch_all_stock();
?>

<div class="dashboard card my-2">
    <div class="card-header bg-white">
        <div class="card-header-panel d-flex align-items-center justify-content-between">
            <h3 class="my-0">Stock</h3>
            <a href="./main.php?dir=stock&page=add_stock" class="btn btn-block btn-sm btn-default btn-flat border-info">
                <i class="fa fa-plus"></i> Add Stock
            </a>
        </div>
    </div>
    <div class="card-body">

        <!-- Status Messages -->
        <div id="alert-msg"></div>

        <?php if ($stock == -1 || empty($stock)) {
            echo "No Record Found"; exit;
        } ?>
        
        <table class="table tabe-hover table-bordered table-users" id="listStock">

            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">#</th>
                    <th class="text-left" style="width: 10%;">Item</th>
                    <th class="text-left" style="width: 10%;">Domain</th>
                    <th class="text-left" style="width: 10%;">Sub_Dom</th>
                    <th class="text-center" style="width: 10%;">SKU</th>
                    <!-- <th class="text-left" style="width: 10%;">Product</th> -->
                    <th class="text-center" style="width: 10%;">Unit</th>
                    <th class="text-center" style="width: 5%;">Lot</th>
                    <th class="text-center" style="width: 5%;">P/Lot</th>
                    <th class="text-right" style="width: 5%;">Stock Level</th>
                    <th class="text-center" style="width: 10%;">Action</th>
                </tr>
			</thead>

            <tbody>

                <?php $i = 1;
                foreach ($stock as $row) { ?>

                <tr role="row" class="odd">
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-left"><b><?php echo $row['item']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['domain']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['sub_dom']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['sku']; ?></b></td>
                    <!-- <td class="text-left"><b></?php echo $row['product_name']; ?></b></td> -->
                    <td class="text-center"><b><?php echo $row['unit']; ?></b></td>
                    <td class="text-center"><b><?php echo $row['lot']; ?></b></td>
                    <td class="text-center"><b><?php echo $row['per_lot']; ?></b></td>
                    <td class="text-right"><b><?php echo $row['curr_stock_level']; ?></b></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view_stock" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./main.php?dir=stock&page=edit_stock&amp;id=<?php echo $row['id']; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_stock" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
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

    $('#listStock').DataTable();     // initialize the datatable

    // View Org
    $('.view_stock').click(function(){
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> Stock Details", "main/users/inc/view_org.php?id=" + $(this).attr('data-id'));
	});

    // Delete Org
    $('#listStock').delegate('.delete_stock', 'click', function(e) {
        doConfirm("Are you sure to delete this stock?", "deleteStock", [ $(this).attr('data-id') ])
    })
});

</script>