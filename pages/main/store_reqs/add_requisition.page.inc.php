<div class="row">
    <div class="col-md-12">

        <div class="card my-2">
            <div class="card-header bg-theme-accent" style="font-weight: bold; font-size: 18px;">
                Create a Store Requisition
            </div>

            <form id="store_requisition_form"> <!-- manage_requisition -->
                <div class="card-body">
                
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Domains</label>
                                <select name="domainid" id="domainid" class="custom-select custom-select-sm">
                                    <option value="0">Company Domain</option>
                                </select>
                            </div>                                
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Subdomains</label>
                                <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                                    <option value="0">Unit Subdomain</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Requisition Description</label>
                                <input type="text" name="requisition_descr" id="requisition_descr" class="form-control form-control-sm" required value="<?php echo isset($requisition_descr) ? $requisition_descr : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Requisition Date</label>
                                <div class='input-group' id='datetimepicker1'>
                                    <div class="input-group-prepend">
                                        <button type="button" id="toggle" class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                    <input type='text' id="picker" name="new_requisition_date" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-requisitions" id="list">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 4%;">#</th>
                                <th class="text-left"  style="width: 20%;">Product</th>
                                <!-- <th class="text-left" style="width: 12%;">Brand</th> -->
                                <th class="text-left" style="width: 10%;">Unit</th>
                                <th class="text-left" style="width: 30%;">Description</th>
                                <th class="text-left" style="width: 10%;">Available</th>
                                <th class="text-left" style="width: 10%;">Quantity</th>
                                <!-- <th class="text-center" style="width: 5%;">Action</th> -->
                            </tr>
                        </thead>
                        <tbody id="store_requisition_item">

                            <!-- Placeholder -->

                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <button id="add" type="button" class="btn btn-default text-default">
                            <i class="fa fa-plus p-1"></i>
                            <span style="font-size: 13px; font-weight: bold;">Add Line Item</span>
                        </button>
                        <button id="remove" type="button" class="btn btn-default text-danger">
                            <i class="fa fa-minus p-1"></i>
                            <span style="font-size: 13px; font-weight: bold;">Remove Line Item</span>
                        </button>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="requester" class="col-md-4 col-form-label-sm text-right"><b>Requester:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="requester" 
                                        id="requester"
                                        value="<?= $user['name'] ?>"
                                        readonly
                                    >
                                    <input type="hidden" name="requester_id" value="<?= $user['id'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="approver" class="col-md-4 col-form-label-sm text-right"><b>Approver:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="approver" 
                                        id="approver"
                                        value="Administrator"
                                        readonly
                                    >
                                    <input type="hidden" name="approver_id" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pt-2">
                            <div class="form-group row my-0">
                                <label for="shopkeeper" class="col-md-4 col-form-label-sm text-right"><b>ShopKeeper:</b></label>
                                <div class="col-md-8 pr-4">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        name="shopkeeper" 
                                        id="shopkeeper"
                                        value="Administrator"
                                        readonly
                                    >
                                    <input type="hidden" name="shopkeeper_id" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button id="store_requisition_create_btn" type="button" class="btn bg-theme-accent px-4 mr-2">Create Requisition</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=store_reqs&page=list_requisitions'">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include('./pages/modals/stock_selector.php'); ?>


<script>

$(document).ready(function() {

    $('.page-title').addClass('d-none');
    
    // Event Date Picker
    $.datetimepicker.setDateFormatter('moment');
    $('#picker').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'YYYY-MM-DD HH:mm',    // use momentjs format
        value: new Date(),              // default value
    });
    $('#toggle').on('click', function() {
        $('#picker').datetimepicker('toggle');
    });    

    initializeStoreReqDomainsSelect();

    $('#domainid').on('change', function() {
        // alert( this.value );
        domainsChangeStoreReqUpdateSubDomSelect( this.value );
    });

    // add the first row
    addStoreRequisitionRow();

    $("#add").click(function() {
        addStoreRequisitionRow();
    });

    $("#remove").click(function() {
        $("#requisition_item").children("tr:last").remove();
    });

    $("#store_requisition_item").delegate('.stock_product_id', "change", function() {
        storeRequisitionItemChangeUpdate(this);
    });

    $("#store_requisition_item").delegate(".stock_product_qty", "keyup", function() {
        validateStockProductQty(this);
    });

    // Requisition Creation - Accepting Data
    $("#store_requisition_create_btn").click(function() {
        var form_data = $("#store_requisition_form").serializeArray(); 
        createStoreRequisition(form_data);
    });    

});

</script>