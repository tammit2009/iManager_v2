<?php 
    $products = fetch_all_vendor_products();
?>

<div class="dashboard card my-2">
    <div class="card-header bg-white">
        <div class="card-header-panel d-flex align-items-center justify-content-between">
            <h3 class="my-0">Vendor Products</h3>
            <div>
                <a href="./main.php?dir=vproducts&page=import_vproducts" class="btn btn-sm btn-default btn-flat border-info p-2 mr-2">
                    <i class="fa fa-folder"></i> Import Products
                </a>
                <a href="./main.php?dir=vproducts&page=add_product" class="btn btn-sm btn-default btn-flat border-info p-2">
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
        
        <table class="table tabe-hover table-bordered table-users" id="listVProducts" 
                style="table-layout:fixed;word-wrap:breakword;font-size:13px;">

            <thead>
                <tr>
                    <th class="text-center" style="width: 4%;">#</th>
                    <!-- <th class="text-center" style="width: 5%;">domain_id</th> -->
                    <!-- <th class="text-center" style="width: 5%;">sub_dom_id</th> -->
                    <th class="text-center" style="width: 15%;">Vendor</th>
                    <!-- <th class="text-center" style="width: 5%;">Brand</th> -->
                    <!-- <th class="text-center" style="width: 5%;">Category</th> -->
                    <th class="text-center" style="width: 15%;">Prov. SKU</th>
                    <th class="text-left" style="width: 20%;">Product Item</th>
                    <th class="text-left" style="width: 10%;">Feature</th>
                    <th class="text-center" style="width: 6%;">Unit</th>
                    <th class="text-center" style="width: 6%;">Lot</th>
                    <th class="text-center" style="width: 6%;">Qty</th>
                    <th class="text-center" style="width: 10%;">Offer Price</th>
                    <!-- <th class="text-center" style="width: 5%;">Created On</th> -->
                    <!-- <th class="text-center" style="width: 7%;">Created By</th> -->
                    <th class="text-center" style="width: 10%;">Action</th>
                </tr>
			</thead>

            <tbody>

                <?php $i = 1;
                foreach ($products as $row) { ?>

                <tr role="row" class="odd">
                    <td class="text-center"><?php echo $i; ?></td>
                    <!-- <td class="text-left"><b></?php echo $row['domain_id']; ?></b></td>
                    <td class="text-left"><b></?php echo $row['sub_dom_id']; ?></b></td> -->
                    <td class="text-left"><b><?php echo $row['vendor']; ?></b></td>
                    <!-- <td class="text-left"><b></?php echo $row['brand']; ?></b></td> -->
                    <!-- <td class="text-left"><b></?php echo $row['category']; ?></b></td> -->
                    <td class="text-center"><b><?php echo $row['provisional_sku']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['product_name_descr']; ?></b></td>
                    <td class="text-left"><b><?php echo $row['feature']; ?></b></td>
                    <td class="text-center"><b><?php echo $row['unit']; ?></b></td>
                    <td class="text-center"><b><?php echo $row['lot']; ?></b></td>
                    <td class="text-center"><b><?php echo $row['qty_per_offer']; ?></b></td>
                    <td class="text-right"><b><?= stdNumFormat($row['offer_price']); ?></b></td>
                    <!-- <td class="text-center"><b></?php echo $row['created_on']; ?></b></td> -->
                    <!-- <td class="text-center"><b></?php echo $row['created_by']; ?></b></td> -->
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view_vproduct" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./main.php?dir=vproducts&page=edit_vproduct&amp;id=<?php echo $row['id']; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_vproduct" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
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

    $('#listVProducts').DataTable();     // initialize the datatable

    // View Vendor Product
    $('.view_vproduct').click(function(){
        // pull in the html view page with uni_modal
		// uni_modal("<i class='fa fa-id-card'></i> User Details", "main/users/inc/view_user.php?id=" + $(this).attr('data-id'));
	});

    // Delete Product
    $('#listVProducts').delegate('.delete_vproduct', 'click', function(e) {
        doConfirm("Are you sure to delete this product?", "deleteVProduct", [ $(this).attr('data-id') ])
    })
});

</script>