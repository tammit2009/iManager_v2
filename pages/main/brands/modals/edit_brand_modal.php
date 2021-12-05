
<!-- Edit Brand Modal-->
<div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_brand_form">
                        <input type="hidden" name="edit_brand_id" id="edit_brand_id">
                        <div class="form-group">
                            <label for="">Brand Name</label>
                            <input type="text" name="edit_brand_name" id="edit_brand_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Brand Catalog Symbol</label>
                            <input type="text" name="edit_brand_catalog_symbol" id="edit_brand_catalog_symbol" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_brand_btn btn btn-info" onclick="return false;">Update Brand</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editBrandModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var brandid = $(e.relatedTarget).data('brandid');
        // Set the UI element values
        getBrandById(brandid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editBrandModal').delegate('.update_brand_btn', 'click', function(e) {
        var form_data = $("#edit_brand_form").serializeArray(); // convert form to array
        updateBrand(form_data);
    });

});   
</script>
