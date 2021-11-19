
<!-- Edit Pagr Role Modal-->
<div class="modal fade" id="editPagrRoleModal" tabindex="-1" role="dialog" aria-labelledby="editPagrRoleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPagrRoleModalLabel">Edit Group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_pagr_role_form">
                        <input type="hidden" name="pagr_id" id="pagr_id">
                        <input type="hidden" name="role_id" id="role_id">
                        <div class="form-group">
                            <label for="">PAGR Role Label</label>
                            <input type="text" name="pagr_role_label" id="pagr_role_label" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="pagr_role_descr" id="pagr_role_descr" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_pagr_role_btn btn btn-info" onclick="return false;">Update PAGR Role</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editPagrRoleModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var pagrid = $(e.relatedTarget).data('pagrid');
        var roleid = $(e.relatedTarget).data('roleid');

        // alert("pagrid: " + pagrid + ", roleid: " + roleid);

        // Set the UI element values
        getPagrRoleById(pagrid, roleid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editPagrRoleModal').delegate('.update_pagr_role_btn', 'click', function(e) {
        var form_data = $("#edit_pagr_role_form").serializeArray(); // convert form to array
        updatePagrRole(form_data);
    });

});   
</script>