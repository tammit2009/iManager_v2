<?php 
    $domains = fetch_all_domains();
?>

<div class="dashboard card my-4">
    <div class="card-body">
        
        <form id="manage_customer_form"> 
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6"> 
                    
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <input type="text" name="customer_address" id="customer_address" class="form-control form-control-sm" required value="<?php echo isset($address) ? $address : '' ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Contact Person</label>
                        <input type="text" name="customer_contact_person" id="customer_contact_person" class="form-control form-control-sm" required value="<?php echo isset($contact_person) ? $contact_person : '' ?>" >
                    </div>

                    <div class="form-group">
                        <label class="label control-label">Contact Email</label>
                        <input type="email" name="customer_contact_email" id="customer_contact_email" class="form-control form-control-sm" required value="<?php echo isset($contact_email) ? $contact_email : '' ?>" >
                        <small id="customer_contact_email_msg"></small>
                    </div>

                    <div class="form-group">
                        <label class="label control-label">Contact Phone</label>
                        <input type="text" name="customer_contact_phone" id="customer_contact_phone" class="form-control form-control-sm" required value="<?php echo isset($contact_phone) ? $contact_phone : '' ?>">
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
                        <label class="label control-label">Description</label>
                        <textarea name="customer_description" id="customer_description" 
                            class="form-control form-control-sm" 
                            rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
                    </div>

                </div>
            </div>
            <hr>
            <div class="col-lg-12 text-right justify-content-center d-flex">
                <button class="btn btn-info mr-2" type="submit">Save</button>
                <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=customers&page=list_customers'">Cancel</button>
            </div>
        </form>

    </div>
</div>

<script>

// submit form as standard and continue with ajax in 'main_scripts.js'
$('#manage_customer_form').submit(function(e) {
	e.preventDefault();

	var form_data = $("#manage_customer_form").serializeArray(); 
	manageCustomer(form_data);
});
	
</script>