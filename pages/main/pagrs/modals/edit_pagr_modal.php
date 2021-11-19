
<!-- Edit Pagr Modal-->
<div class="modal fade" id="editPagrModal" tabindex="-1" role="dialog" aria-labelledby="editPagrModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPagrModalLabel">Edit Page Access Group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_pagr_form">
                        <input type="hidden" name="pagr_id" id="pagr_id">
                        <div class="form-group">
                            <label for="">Page Access Group Label</label>
                            <input type="text" name="pagr_label" id="pagr_label" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Page Access Group Description</label>
                            <input type="text" name="pagr_description" id="pagr_description" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_pagr_btn btn btn-info" onclick="return false;">Update PA Group</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editPagrModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var pagrid = $(e.relatedTarget).data('pagrid');
        // Set the UI element values
        getPagrById(pagrid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editPagrModal').delegate('.update_pagr_btn', 'click', function(e) {
        var form_data = $("#edit_pagr_form").serializeArray(); // convert form to array
        updatePagr(form_data);
    });

});   
</script>
