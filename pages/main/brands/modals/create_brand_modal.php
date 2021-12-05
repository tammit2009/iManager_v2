<!-- Create Brand Modal-->
<div class="modal fade" id="createBrandModal" tabindex="-1" role="dialog" aria-labelledby="createBrandModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBrandModalLabel">Create New Brand</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="create_brand_form">
                        <input type="hidden" name="brand_id" id="brand_id">
                        <div class="form-group">
                            <label for="">Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Brand Catalog Symbol</label>
                            <input type="text" name="brand_catalog_symbol" id="brand_catalog_symbol" class="form-control form-control-sm" required>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="create_brand_btn btn btn-info" onclick="return false;">Create Brand</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // initiate ajax and continue in 'main_scripts.js'

    $('#createBrandModal').delegate('.create_brand_btn', 'click', function(e) {

        var form_data = $("#create_brand_form").serializeArray(); // convert form to array
        
        createNewBrand(form_data);
    });
});   
</script>