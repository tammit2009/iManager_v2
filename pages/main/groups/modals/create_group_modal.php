<!-- Create Group Modal-->
<div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="create_group_form">
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
                <button type="submit" class="create_group_btn btn btn-info" onclick="return false;">Create Group</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // initiate ajax and continue in 'main_scripts.js'

    $('#createGroupModal').delegate('.create_group_btn', 'click', function(e) {

        var form_data = $("#create_group_form").serializeArray(); // convert form to array
        
        createNewGroup(form_data);

    });
});   
</script>