<div class="modal fade" id="stockSelectModal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select Product From Stock</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered table-stock" id="listStockSelection" style="width:100%">

                    <thead>
                        <tr>
                            <th align="center">#</th>
                            <th align="left">Items</th>
                            <th align="left">Product</th>
                            <th align="center">Unit</th>
                            <th align="center">Stock Level</th>
                            <th align="center">Action</th>
                        </tr>
                    </thead>
        
                </table>

            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    var xdata, domainId, subdomId;

    // triggered when modal is about to be shown
    $('#stockSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
        //alert(xdata);

        domainId = $('#domainid').val();
        subdomId = $('#subdomid').val();
        // alert("domainId: " + domainId + ", subdomId: " + subdomId);

        $('#stock_domain_id').val(domainId);
        $('#stock_subdom_id').val(subdomId);

        // destroy the datatable if it already exists: "dataTable.fnDestroy()"
        if ($.fn.DataTable.isDataTable("#listStockSelection")) {
            $('#listStockSelection').DataTable().clear().destroy();
        }

        // initialize the datatable
        $('#listStockSelection').dataTable({    
            "paging": true,
            "processing": true,
            "serverSide": true,
            "bPaginate" : true,
            "order": [],
            "info": true,
            "ajax": {
                url: baseUrlMain+'/core/ajax/modal/stock_select_fetch.php',
                type: "POST",
                // Send along optional static data
                "data": { 
                    "domainid": domainId,
                    "subdomid": subdomId 
                }
            },
            // Format the columns
            "columnDefs": [     
                // { "target": [0, 3, 4], "orderable": false, },
                // { targets: [1, 2], className: 'text-left' },
                // { targets: [0, 3, 4, 5], className: 'text-center' },
                { "targets": 0, "className": "text-center", "width": "5%"  },   
                { "targets": 1, "className": "text-left",   "width": "35%" },
                { "targets": 2, "className": "text-left",   "width": "20%" },
                { "targets": 3, "className": "text-center", "width": "15%" },
                { "targets": 4, "className": "text-center", "width": "10%" },
                { "targets": 5, "className": "text-center", "width": "15%" },
            ],
            // columns: [
            //     {
            //         data: 'Status', render: function (data, type, row) {
            //             switch (data) {
            //                 case 1:
            //                     return '<div id="circleRed"></div>'
            //                     break;
            //                 case 2:
            //                     return '<div id="circleGreen"></div>'
            //                     break;
            //                 case 3:
            //                     return '<div id="circleOrange"></div>'
            //                     break;
            //             }
            //         }
            //     },
            //     { data: 'TransactionId' },
            //     { data: 'CreditCardNumber' },
            //     { data: 'Supplier' },
            //     { data: 'CreatedAt' },
            //     { data: 'Amount' }
            // ]
        });    
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