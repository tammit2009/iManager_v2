
<div class="row">
    <div class="col-md-6">

        <div class="dashboard card my-2">
            <div class="card-body">
                
                <form id="manage_subdom_user_form">

                    <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="hidden" name="edit_userid" id="edit_userid" value="<?php echo isset($user_id) ? $user_id : '' ?>">
                    <input type="hidden" name="edit_subdomid" id="edit_subdomid" value="<?php echo isset($sub_dom_id) ? $sub_dom_id : '' ?>">
                    <input type="hidden" name="domainid" id="domainid">

                    <div class="form-group">
                        <label for="">Select User</label>
                        <select name="userid" id="userid" class="custom-select custom-select-sm" <?php echo isset($id) ? "disabled='disabled'" : "" ?>>
                            <option value="0">------</option>
                        </select>
                    </div>
                            
                    <div class="form-group">
                        <label for="">Available Subdomains</label>
                        <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                            <option value="0">------</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Notes</label>
                        <textarea name="notes" id="notes" class="form-control form-control-sm" rows="3"><?php echo isset($notes) ? $notes : '' ?></textarea>
                    </div>
                            
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-info mr-2 px-4" type="submit">Save</button>
                        <button class="btn btn-secondary px-3" type="button" onclick="location.href = 'main.php?dir=subdom_users&page=list_subdom_users'">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>


<script>

$(document).ready(function() {

    initializeUsersSelect();

    $('#userid').on('change', function() {
        // alert( this.value );
        userChangeUpdateSubDomSelect( this.value );
    });

    // submit form as standard and continue with ajax in 'main_scripts.js'
    $('#manage_subdom_user_form').submit(function(e) {
        e.preventDefault();

        var form_data = $("#manage_subdom_user_form").serializeArray(); 

        manageSubDomUser(form_data);
    });

});

	
</script>