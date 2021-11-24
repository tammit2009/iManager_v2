<div class="modal fade" id="stockSelectModal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select Product From Stock</h4>
            </div>

            <div class="modal-body">

                <?php
                $opr = new DBOperation();
                if (!$opr->dbConnected()) {
                    echo "No Record Found"; exit;
                }
                
                $res = $opr->sqlSelect("SELECT stock.id, stock.item, products.product_name, products.unit, 
                                        stock.curr_stock_level
                                        FROM stock INNER JOIN products ON stock.sku = products.sku");

                if (mysqli_num_rows($res) > 0) { ?>
                
                <table class="table table-bordered table-stock" id="listStockSelection">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 3%;">#</th>
                            <th class="text-left" style="width: 10%;">Items</th>
                            <th class="text-left" style="width: 10%;">Product</th>
                            <th class="text-center" style="width: 5%;">Unit</th>
                            <th class="text-right" style="width: 5%;">Stock Level</th>
                            <th class="text-center" style="width: 5%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) { ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left" id="<?= 'stockname_'.$row['id']; ?>"><b><?php echo $row['item']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['product_name']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['unit']; ?></b></td>
                                <td class="text-right"><b><?php echo $row['curr_stock_level']; ?></b></td>
                                <td class="text-center">
                                    <button 
                                        type="button" 
                                        data-dismiss="modal"
                                        class="select_stock btn btn-secondary btn-sm btn-flat px-2" 
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
$(document).ready(function() {

    $('#listStockSelection').DataTable();     // initialize the datatable

    var xdata;

    // triggered when modal is about to be shown
    $('#stockSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
        //alert(xdata);
    });

    $("#listStockSelection").on("click", ".select_stock", function() {
        var stockID = $(this).attr('data-id');  // actual selected stock ID in db
        // Set the hidden input field with the stock id
        $('#stock_product_'+xdata).val(stockID);
        // Trigger a change on the hidden input field
        $('#stock_product_'+xdata).trigger("change");
    });

});


</script>