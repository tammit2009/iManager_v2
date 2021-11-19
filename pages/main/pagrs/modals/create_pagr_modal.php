<!-- Create Pagr Modal-->
<div class="modal fade" id="createPagrModal" tabindex="-1" role="dialog" aria-labelledby="createPagrModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPagrModalLabel">Create PA Group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="create_pagr_form">
                        <input type="hidden" name="pagr_id" id="pagr_id">
                        <div class="form-group">
                            <label for="">Page Access Group Name</label>
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
                <button type="submit" class="create_pagr_btn btn btn-info" onclick="return false;">Create PA Group</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // initiate ajax and continue in 'main_scripts.js'

    $('#createPagrModal').delegate('.create_pagr_btn', 'click', function(e) {

        var form_data = $("#create_pagr_form").serializeArray(); // convert form to array
        
        createNewPagr(form_data);

    });
});   
</script>