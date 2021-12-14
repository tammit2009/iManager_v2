<div class="modal fade" id="productSelectModal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select a Product</h4>
            </div>

            <div class="modal-body">

                <?php
                $opr = new DBOperation();
                if (!$opr->dbConnected()) {
                    echo "No Record Found"; exit;
                }
                
                $res = $opr->sqlSelect("SELECT products.id, products.product_name, products.sku, products.unit,
                                        products.features, products.attributes,
                                        products.short_descr, products.unit_price, products.keep_stock,
                                        products.created_on, users.name as created_by 
                                        FROM products INNER JOIN users 
                                        ON products.created_by = users.id");

                if (mysqli_num_rows($res) > 0) { ?>
                
                <table class="table table-hover table-bordered table-select-product" id="product_list">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 2%;">#</th>
                            <th class="text-left" style="width: 10%;">Product Name</th>
                            <th class="text-center" style="width: 5%;">Unit</th>
                            <th class="text-left" style="width: 15%;">Description</th>
                            <th class="text-center" style="width: 5%;">Unit Price</th>
                            <th class="text-center" style="width: 5%;">Select</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) { ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left" id="<?= 'pname_'.$row['id'] ?>"><b><?php echo $row['product_name']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['unit']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['short_descr']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['unit_price']; ?></b></td>
                                <td class="text-center">
                                    <button 
                                        type="button" 
                                        data-dismiss="modal"
                                        class="select_product btn btn-secondary btn-sm btn-flat px-2" 
                                        data-id="<?php echo $row['id']; ?>"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            $i++;
                        } 
                        ?>

                    </tbody>
                </table>

                <?php 
                    $res->free_result();
                    $opr->close();
                }
                else {
                    echo "No Record Found";
                }
                ?>

            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $('#product_list').DataTable();     // initialize the datatable

    var xdata;

    // triggered when modal is about to be shown
    $('#productSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
    });

    $("#product_list").on("click", ".select_product", function() {
        var prodID = $(this).attr('data-id');
        // Set the hidden input field with the vproduct id
        $('#product_'+xdata).val(prodID);
        // Trigger a change on the hidden input field
        $('#product_'+xdata).trigger("change");
    });

});


</script>