<div class="modal fade" id="vproductSelectModal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select a Product By Vendor</h4>
            </div>

            <div class="modal-body">

                <?php 

                $vendor_products = fetch_all_vendor_products_join_products();

                if ($vendor_products == -1 || empty($vendor_products)) {
                    echo "No Record Found"; 
                } else { 

                ?>
                
                <table class="table table-hover table-bordered table-select-product" id="vproduct_list"
                    style="table-layout:fixed;word-wrap:breakword;font-size:13px;">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">#</th>
                            <th class="text-left" style="width: 15%;">Product Name</th>
                            <th class="text-center" style="width: 10%;">Unit</th>
                            <th class="text-left" style="width: 20%;">Description</th>
                            <th class="text-center" style="width: 10%;">Offer Price</th>
                            <th class="text-center" style="width: 10%;">Qty per Offer</th>
                            <th class="text-center" style="width: 15%;">Vendor</th>
                            <th class="text-center" style="width: 10%;">Select</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($vendor_products as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left" id="<?= 'pname_'.$row['id'] ?>"><b><?php echo $row['product_name']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['product_unit']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['product_name_descr']; ?></b></td>
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
                            
                        <?php $i++; } ?>

                    </tbody>
                </table>

                <?php } ?>

            </div> 

        </div> 
    </div>
</div> 

<script>
$(document).ready(function(){

    $('#vproduct_list').DataTable({     // initialize the datatable
        responsive : true
    });     

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