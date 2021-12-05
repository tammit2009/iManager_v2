<?php 
    $domains = fetch_all_domains();
    $domain_id = 0;
    if (isset($_GET['id'])) {
        $domain_id = $_GET['id'];
    }
?>

<!-- Edit Group Role Modal-->
<div class="modal fade" id="editSubdomainModal" tabindex="-1" role="dialog" aria-labelledby="editSubdomainModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubdomainModalLabel">Edit Subdomain</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_subdomain_form">
                        <input type="hidden" name="domain_id" id="domain_id">
                        <input type="hidden" name="subdom_id" id="subdom_id">
                        <div class="form-group">
                            <label for="">Parent Domain</label>
                            <select name="domain" id="domain" class="custom-select custom-select-sm" required>
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
                            <label for="">Subdomain Name</label>
                            <input type="text" name="subdom_name" id="subdom_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Subdomain Type</label>
                            <select name="subdom_type" id="subdom_type" class="custom-select custom-select-sm" required>
                                <!-- TODO: foreach -->
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
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_subdomain_btn btn btn-info" onclick="return false;">Update Subdomain</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    var xsrc;

    // triggered when modal is about to be shown 
    $('#editSubdomainModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var domainid = $(e.relatedTarget).data('domainid');
        var subdomid = $(e.relatedTarget).data('subdomid');
        xsrc = $(e.relatedTarget).data('xsrc');

        // alert("domainid: " + domainid + ", subdomid: " + subdomid + ", xsrc:" + xsrc);

        // Set the UI element values
        getSubDomainByIdV2(domainid, subdomid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editSubdomainModal').delegate('.update_subdomain_btn', 'click', function(e) {
        var form_data = $("#edit_subdomain_form").serializeArray(); // convert form to array

        // route based on source
        if (xsrc == 'view_domain') {
            updateSubDomain(form_data);
        }
        else if (xsrc == 'list_subdoms') {
            updateSubDomainV2(form_data);
        }
    });

});   
</script>