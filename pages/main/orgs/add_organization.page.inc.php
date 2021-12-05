<?php 
    $domains = fetch_all_domains();
    $orgtypes = fetch_all_organization_types();
?>

<div class="dashboard card my-4">
    <div class="card-body">
        
        <form id="manage_organization_form"> 
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6"> 
                    
                    <div class="form-group">
                        <label for="">Organization Name</label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <input type="text" name="organization_address" id="organization_address" class="form-control form-control-sm" required value="<?php echo isset($address) ? $address : '' ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Contact Person</label>
                        <input type="text" name="organization_contact_person" id="organization_contact_person" class="form-control form-control-sm" required value="<?php echo isset($contact_person) ? $contact_person : '' ?>" >
                    </div>

                    <div class="form-group">
                        <label class="label control-label">Contact Email</label>
                        <input type="email" name="organization_contact_email" id="organization_contact_email" class="form-control form-control-sm" required value="<?php echo isset($contact_email) ? $contact_email : '' ?>" >
                        <small id="customer_contact_email_msg"></small>
                    </div>

                    <div class="form-group">
                        <label class="label control-label">Contact Phone</label>
                        <input type="text" name="organization_contact_phone" id="organization_contact_phone" class="form-control form-control-sm" required value="<?php echo isset($contact_phone) ? $contact_phone : '' ?>">
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="">Domain</label>
                        <select name="domain" id="domain" class="custom-select custom-select-sm">
                            <?php foreach ($domains as $domain) { ?>
                                <option 
                                    value="<?= $domain['id']; ?>"
                                    <?php 
                                    if (isset($domain_id)) { 
                                        if ($domain_id == $domain['id']) echo 'selected'; 
                                    }
                                    else {
                                        if ($domain['name'] == 'default') { echo 'selected'; }
                                    } 
                                    ?>
                                >
                                    <?= $domain['name']; ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
					</div>

                    <div class="form-group">
                        <label for="">Organization Type</label>
                        <select name="organization_type" id="organization_type" class="custom-select custom-select-sm">
                            <?php foreach ($orgtypes as $orgtype) { ?>
                                <option 
                                    value="<?= $orgtype['label']; ?>"
                                    <?php 
                                    if (isset($type)) { 
                                        if ($type == $orgtype['label']) echo 'selected'; 
                                    }
                                    else {
                                        if ($orgtype['label'] == 'customer') { echo 'selected'; }
                                    } 
                                    ?>
                                >
                                    <?= $orgtype['catalog_symbol']; ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
					</div>
                    
                    <div class="form-group">
                        <label class="label control-label">Description</label>
                        <textarea name="organization_description" id="organization_description" 
                            class="form-control form-control-sm" 
                            rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
                    </div>

                </div>
            </div>
            <hr>
            <div class="col-lg-12 text-right justify-content-center d-flex">
                <button class="btn btn-info mr-2" type="submit">Save</button>
                <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=orgs&page=list_orgs'">Cancel</button>
            </div>
        </form>

    </div>
</div>

<script>

// submit form as standard and continue with ajax in 'main_scripts.js'
$('#manage_organization_form').submit(function(e) {
	e.preventDefault();

	var form_data = $("#manage_organization_form").serializeArray(); 
	manageOrganization(form_data);
});
	
</script>