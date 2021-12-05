<?php 
    $orgs = fetch_all_organizations();
?>

<div class="row">
    <div class="col-md-6">

        <div class="dashboard card my-2 px-3">
            <div class="card-body">
                
                <form id="manage_member_form"> 
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                    <div class="form-group">
                        <label for="">Member</label>
                        <div class="input-group my-0">
                            <input type="hidden" name="member_user_id" id="member_user_id" 
                                        value="<?php echo isset($user_id) ? $user_id : '' ?>">
                            <input type="text" class="form-control" name="member_user" id="member_user" 
                                        value="<?php echo isset($username) ? $username : '' ?>" placeholder="Select" required>
                            <div class="input-group-append">
                            <a class="btn btn-info px-3 my-0 float-right" href="#" 
                                data-toggle="modal" 
                                data-target="#userSelectModal"
                                data-xdata="addMemberUser"
                                data-xuid="1"
                            ><i class="fas fa-cog fa-sm text-gray-400"></i></a>   
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Organisation</label>
                        <select name="member_org_id" id="member_org_id" class="custom-select custom-select-sm" required>
                            <?php foreach ($orgs as $org) { ?>
                                <option 
                                    value="<?= $org['id']; ?>"
                                    <?php 
                                    if (isset($org_id)) { 
                                        if ($org_id == $org['id']) echo 'selected'; 
                                    }
                                    else {
                                        // select default
                                        if ($org['name'] == 'Default') { echo 'selected'; }
                                    } 
                                    ?>
                                >
                                    <?= ucwords($org['name']); ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
					</div>

                    <div class="form-group">
                        <label for="">Department</label>
                        <input type="text" name="member_department" id="member_department" class="form-control form-control-sm" 
                                    value="<?php echo isset($department) ? $department : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Functional Role</label>
                        <input type="text" name="member_role" id="member_role" class="form-control form-control-sm" 
                                    value="<?php echo isset($functional_role) ? $functional_role : '' ?>">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info mr-2" type="submit">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=members&page=list_members'">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
        
    </div>
</div>

<!-- Modals -->
<?php include('./pages/modals/user_selector.php'); ?> 

<script>
$(document).ready(function(){

    // $('.page-title').addClass('d-none');

    // submit form as standard and continue with ajax in 'main_scripts.js'
    $('#manage_member_form').submit(function(e) {
        e.preventDefault();

        var form_data = $("#manage_member_form").serializeArray(); // convert form to array

        manageMember(form_data);
    });

});
	
</script>