
<!-- Edit Domain Modal-->
<div class="modal fade" id="editDomainModal" tabindex="-1" role="dialog" aria-labelledby="editDomainModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDomainModalLabel">Edit Domain</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_domain_form">
                        <input type="hidden" name="domain_id" id="domain_id">
                        <div class="form-group">
                            <label for="">Domain Name</label>
                            <input type="text" name="domain_name" id="domain_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Domain Description</label>
                            <input type="text" name="domain_description" id="domain_description" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_domain_btn btn btn-info" onclick="return false;">Update Domain</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editDomainModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var domainid = $(e.relatedTarget).data('domainid');
        // Set the UI element values
        getDomainById(domainid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editDomainModal').delegate('.update_domain_btn', 'click', function(e) {
        var form_data = $("#edit_domain_form").serializeArray(); // convert form to array
        updateDomain(form_data);
    });

});   
</script>
