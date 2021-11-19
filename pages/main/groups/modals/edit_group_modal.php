
<!-- Edit Group Modal-->
<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGroupModalLabel">Edit Group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_group_form">
                        <input type="hidden" name="group_id" id="group_id">
                        <div class="form-group">
                            <label for="">Group Name</label>
                            <input type="text" name="group_name" id="group_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Group Description</label>
                            <input type="text" name="group_description" id="group_description" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_group_btn btn btn-info" onclick="return false;">Update Group</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editGroupModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var groupid = $(e.relatedTarget).data('groupid');
        // Set the UI element values
        getGroupById(groupid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editGroupModal').delegate('.update_group_btn', 'click', function(e) {
        var form_data = $("#edit_group_form").serializeArray(); // convert form to array
        updateGroup(form_data);
    });

});   
</script>
