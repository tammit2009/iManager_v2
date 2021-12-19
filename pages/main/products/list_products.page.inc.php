<?php 
    $products = fetch_all_products();
?>

<div class="dashboard card my-2">
    <div class="card-header bg-white">
        <div class="card-header-panel d-flex align-items-center justify-content-between">
            <h3 class="my-0">Products</h3>
            <div>
                <a href="./main.php?dir=products&page=import_products" class="btn btn-sm btn-default btn-flat border-info p-2 mr-2">
                    <i class="fa fa-folder"></i> Import Products
                </a>
                <a href="./main.php?dir=products&page=add_product" class="btn btn-sm btn-default btn-flat border-info p-2">
                    <i class="fa fa-plus"></i> Add Product
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">

        <!-- Status Messages -->
        <div id="alert-msg"></div>

        <?php if ($products == -1 || empty($products)) {
            echo "No Record Found"; exit;
        } ?>
        
        <table class="table tabe-hover table-bordered table-users" id="listProducts">

            <thead>
                <tr>
                    <th class="text-center" style="width: 3%;">#</th>
                    <th class="text-center" style="width: 10%;">Product Name</th>
                    <th class="text-center" style="width: 7%;">SKU</th>
                    <th class="text-center" style="width: 5%;">Unit</th>
                    <th class="text-center" style="width: 15%;">Description</th>
                    <th class="text-center" style="width: 5%;">Unit Price</th>
                    <th class="text-center" style="width: 3%;">Active?</th>
                    <th class="text-center" style="width: 10%;">Created On</th>
                    <!-- <th class="text-center" style="width: 7%;">Created By</th> -->
                    <th class="text-center" style="width: 7%;">Action</th>
                </tr>
			</thead>

            <tbody>

                <?php $i = 1;
                foreach ($products as $row) { ?>

                <tr role="row" class="odd">
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-left"><b><?php echo $row['product_name']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['sku']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['unit']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['short_descr']; ?></b></td>
                    <td class="text-right"><b><?= stdNumFormat($row['unit_price']); ?></b></td>
                    <td class="text-center"><b><?php echo $row['keep_stock']; ?></b></td>
                    <td class="text-center"><b><?php echo $row['created_on']; ?></b></td>
                    <!-- <td class="text-center"><b></?php echo $row['created_by']; ?></b></td> -->
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view_product" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./main.php?dir=products&page=edit_product&amp;id=<?php echo $row['id']; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_product" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
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

    $('#listProducts').DataTable();     // initialize the datatable

    // View Product
    $('.view_product').click(function(){
        // pull in the html view page with uni_modal
		uni_modal("<i class='fa fa-id-card'></i> Product Details", "main/products/inc/view_product.php?id=" + $(this).attr('data-id'));
	});

    // Delete Product
    $('#listProducts').delegate('.delete_product', 'click', function(e) {
        doConfirm("Are you sure to delete this product?", "deleteProduct", [ $(this).attr('data-id') ])
    })
});

</script>