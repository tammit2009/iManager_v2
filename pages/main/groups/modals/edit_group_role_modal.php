
<!-- Edit Group Role Modal-->
<div class="modal fade" id="editGroupRoleModal" tabindex="-1" role="dialog" aria-labelledby="editGroupRoleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGroupRoleModalLabel">Edit Group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_group_role_form">
                        <input type="hidden" name="group_id" id="group_id">
                        <input type="hidden" name="role_id" id="role_id">
                        <div class="form-group">
                            <label for="">Group Role Label</label>
                            <input type="text" name="group_role_label" id="group_role_label" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="group_role_descr" id="group_role_descr" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_group_role_btn btn btn-info" onclick="return false;">Update Group Role</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editGroupRoleModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var groupid = $(e.relatedTarget).data('groupid');
        var roleid = $(e.relatedTarget).data('roleid');

        // alert("groupid: " + groupid + ", roleid: " + roleid);

        // Set the UI element values
        getGroupRoleById(groupid, roleid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editGroupRoleModal').delegate('.update_group_role_btn', 'click', function(e) {
        var form_data = $("#edit_group_role_form").serializeArray(); // convert form to array
        updateGroupRole(form_data);
    });

});   
</script>