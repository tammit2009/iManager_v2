<?php 
    // $groups = fetch_all_groups();
    // $domains = fetch_all_domains();
    $orgs = fetch_all_organizations();
?>

<div class="row">
    <div class="col-md-6">

        <div class="dashboard card my-2 px-3">
            <div class="card-body">
                
                <form id="manage_staff_form" enctype="multipart/form-data"> 
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                    <div class="form-group">
                        <label for="">User</label>
                        <div class="input-group my-0">
                            <input type="hidden" name="addStaffUserId" id="addStaffUserId">
                            <input type="text" class="form-control" name="addStaffUser" id="addStaffUser" value="<?php echo isset($name) ? $name : '' ?>" placeholder="Select" required>
                            <div class="input-group-append">
                            <a class="btn btn-info px-3 my-0 float-right" href="#" 
                                data-toggle="modal" 
                                data-target="#userSelectModal"
                                data-xdata="addStaffUser"
                                data-xuid="1"
                            ><i class="fas fa-cog fa-sm text-gray-400"></i></a>   
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Organisation</label>
                        <select name="addUserOrg" id="addUserOrg" class="custom-select custom-select-sm">
                            <?php foreach ($orgs as $org) { ?>
                                <option 
                                    value="<?= $org['id']; ?>"
                                    <?php 
                                    if (isset($addUserOrg)) { 
                                        if ($addUserOrg == $org['id']) echo 'selected'; 
                                    }
                                    else {
                                        if ($org['id'] == 10) { echo 'selected'; }
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
                        <input type="text" name="name" id="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Functional Role</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info mr-2" type="submit">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=staff&page=list_staff'">Cancel</button>
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

    $('.page-title').addClass('d-none');

    // submit form as standard and continue with ajax in 'main_scripts.js'
    $('#manage_staff_form').submit(function(e) {
        e.preventDefault();

        var form_data = new FormData($(this)[0]);	// This method has to be used in order to submit file(s)

        // Print the FormData
        for (var pair of form_data.entries()) { console.log(pair[0]+ ', ' + pair[1]); }

        // manageStaff(form_data);
    });

});
	
</script>