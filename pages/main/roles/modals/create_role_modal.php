<!-- Create Role Modal-->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoleModalLabel">Create New Role</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="create_role_form">
                        <input type="hidden" name="role_id" id="role_id">
                        <div class="form-group">
                            <label for="">Role Name</label>
                            <input type="text" name="role_name" id="role_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Role Description</label>
                            <input type="text" name="role_description" id="role_description" class="form-control form-control-sm">
                        </div>

                        <h6 class="pt-3">Page Access Level Settings:</h6>

                        <div class="d-flex justify-content-between">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="check_read" id="check_read" value="read" checked>
                                <label class="form-check-label" for="check_read">Read</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="check_create" id="check_create" value="create" checked>
                                <label class="form-check-label" for="check_create">Create</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="check_edit" id="check_edit" value="edit" checked>
                                <label class="form-check-label" for="check_edit">Edit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="check_delete" id="check_delete" value="delete" checked>
                                <label class="form-check-label" for="check_delete">Delete</label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="create_role_btn btn btn-info" onclick="return false;">Create Role</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // initiate ajax and continue in 'main_scripts.js'

    $('#createRoleModal').delegate('.create_role_btn', 'click', function(e) {

        var form_data = $("#create_role_form").serializeArray(); // convert form to array
        
        createNewRole(form_data);

    });
});   
</script>