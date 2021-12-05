
<!-- Create StoreUnit Modal-->
<div class="modal fade" id="createStoreUnitModal" tabindex="-1" role="dialog" aria-labelledby="createStoreUnitModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="create_storeunit_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStoreUnitModalLabel">Create New Store Unit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="my-3">
                        
                        <!-- <input type="hidden" name="domain_id" id="domain_id"> -->

                        <div class="form-group">
                            <label for="">Store Unit Name</label>
                            <input type="text" name="storeunit_name" id="storeunit_name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Organization</label>
                            <select name="organization_id" id="organization_id" class="custom-select custom-select-sm" required>
                                <option>----</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Domain</label>
                            <select name="domain_id" id="domain_id" class="custom-select custom-select-sm" required>
                                <option>----</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Subdomain Name</label>
                            <input type="text" name="subdom_name" id="subdom_name" class="form-control form-control-sm" value="<?php echo isset($subdom_name) ? $subdom_name : '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">Subdomain Type</label>
                            <select name="subdom_type" id="subdom_type" class="custom-select custom-select-sm" required>
                                <option value="<?php echo isset($type) ? $type : 'extension' ?>">
                                    <?php echo isset($type) ? ucwords($type) : 'Extension' ?>
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Subdomain Description</label>
                            <textarea name="subdom_description" id="subdom_description" 
                                class="form-control form-control-sm" 
                                rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="create_storeunit_btn btn btn-info" onclick="return false;">Create StoreUnit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    initializeOrganizationStoreUnitSelect();

    $('#organization_id').on('change', function() {
        // alert( this.value );
        organizationChangeUpdateStoreUnitSelect( this.value );
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#createStoreUnitModal').delegate('.create_storeunit_btn', 'click', function(e) {
        var form_data = $("#create_storeunit_form").serializeArray(); // convert form to array
        createStoreUnit(form_data);
    });
});   
</script>