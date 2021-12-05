<?php 
    $domains = fetch_all_domains();
    $doperator_functions = fetch_all_dom_operator_functions();
    $roles = fetch_all_roles();
?>

<div class="dashboard card my-4">
    <div class="card-body">
        
        <form id="manage_doperator_form"> 

            <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '' ?>">
            <input type="hidden" name="edit_userid" id="edit_userid" value="<?php echo isset($user_id) ? $user_id : '' ?>">
            <input type="hidden" name="edit_subdomid" id="edit_subdomid" value="<?php echo isset($sub_dom_id) ? $sub_dom_id : '' ?>">
            <input type="hidden" name="domainid" id="domainid">

            <div class="row">
                <div class="col-md-6"> 

                    <div class="form-group">
                        <label for="">Select User</label>
                        <select name="userid" id="userid" class="custom-select custom-select-sm" <?php echo isset($id) ? "disabled='disabled'" : "" ?>>
                            <option value="0">------</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">User's Available Subdomains</label>
                        <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                            <option value="0">------</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label class="control-label">Select Dom Operator Function</label>
                        <select name="doperator_function" id="doperator_function" class="custom-select custom-select-sm">
                            <?php foreach ($doperator_functions as $dom_function) { ?>
                                <option 
                                    value="<?= $dom_function['sys_key']; ?>"
                                    <?php 
                                    if (isset($dom_function_key )) { 
                                        if ($dom_function_key  == $dom_function['sys_key']) echo 'selected'; 
                                    }
                                    else {
                                        if ($dom_function['sys_key'] == 'dom_function_2') { echo 'selected'; }
                                    } 
                                    ?>
                                >
                                    <?= $dom_function['sys_value']; ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="doperator_role" id="doperator_role" class="custom-select custom-select-sm">
                            <?php foreach ($roles as $role) { ?>
                                <option 
                                    value="<?= $role['id']; ?>"
                                    <?php 
                                    if (isset($assoc_role )) { 
                                        if ($assoc_role  == $role['id']) echo 'selected'; 
                                    }
                                    ?>
                                >
                                    <?= $role['name']; ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
					</div>

                    <div class="form-group">
                        <label class="label control-label">Description</label>
                        <textarea name="doperator_description" id="doperator_description" 
                            class="form-control form-control-sm" 
                            rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
                    </div>

                </div>
            </div>
            <hr>
            <div class="col-lg-12 text-right justify-content-center d-flex">
                <button class="btn btn-info mr-2" type="submit">Save</button>
                <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=doperators&page=list_doperators'">Cancel</button>
            </div>
        </form>

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
    $('#manage_doperator_form').submit(function(e) {
        e.preventDefault();

        var form_data = $("#manage_doperator_form").serializeArray(); 
        manageDoperator(form_data);
    });
	
});
</script>