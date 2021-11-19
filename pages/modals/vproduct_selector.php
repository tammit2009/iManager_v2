<div class="modal fade" id="vproductSelectModal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select a Product By Vendor</h4>
            </div>

            <div class="modal-body">

                <?php
                $opr = new DBOperation();
                if (!$opr->dbConnected()) {
                    echo "No Record Found"; exit;
                }
                
                $res = $opr->sqlSelect("SELECT vp.id, products.product_name, vp.short_descr, products.unit, vp.qty_per_offer, vp.offer_price, 
                                        (SELECT vendors.company_name FROM vendors WHERE vp.vendor_id = vendors.id) as vendor 
                                        FROM `vendors_products` as vp INNER JOIN products ON vp.sku = products.sku");

                if (mysqli_num_rows($res) > 0) { ?>
                
                <table class="table table-hover table-bordered table-select-product" id="vproduct_list">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 2%;">#</th>
                            <th class="text-left" style="width: 10%;">Product Name</th>
                            <th class="text-center" style="width: 5%;">Unit</th>
                            <th class="text-left" style="width: 15%;">Description</th>
                            <th class="text-center" style="width: 7%;">Offer Price</th>
                            <th class="text-center" style="width: 7%;">Qty per Offer</th>
                            <th class="text-center" style="width: 12%;">Vendor</th>
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
                                <td class="text-center"><b><?php echo $row['offer_price']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['qty_per_offer']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['vendor']; ?></b></td>
                                <td class="text-center">
                                    <button 
                                        type="button" 
                                        data-dismiss="modal"
                                        class="select_vproduct btn btn-secondary btn-sm btn-flat px-2" 
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

    $('#vproduct_list').DataTable();     // initialize the datatable

    var xdata;

    // triggered when modal is about to be shown
    $('#vproductSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
    });

    $("#vproduct_list").on("click", ".select_vproduct", function() {     
        var vprodID = $(this).attr('data-id');      
        // Set the hidden input field with the vproduct id
        $('#vproduct_'+xdata).val(vprodID);
        // Trigger a change on the hidden input field
        $('#vproduct_'+xdata).trigger("change");
    });

});


</script>