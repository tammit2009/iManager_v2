
<!-- Edit Group Role Modal-->
<div class="modal fade" id="editSubDomModal" tabindex="-1" role="dialog" aria-labelledby="editSubDomModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubDomModalLabel">Edit Subdomain</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="my-3">
                    <form id="edit_subdom_form">
                        <input type="hidden" name="domain_id" id="domain_id">
                        <input type="hidden" name="subdom_id" id="subdom_id">
                        <div class="form-group">
                            <label for="">Subdomain Name</label>
                            <input type="text" name="subdom_name" id="subdom_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="subdom_descr" id="subdom_descr" class="form-control form-control-sm">
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="update_subdom_btn btn btn-info" onclick="return false;">Update Subdomain</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editSubDomModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var domainid = $(e.relatedTarget).data('domainid');
        var subdomid = $(e.relatedTarget).data('subdomid');

        // alert("domainid: " + domainid + ", subdomid: " + subdomid);

        // Set the UI element values
        getSubDomainById(domainid, subdomid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editSubDomModal').delegate('.update_subdom_btn', 'click', function(e) {
        var form_data = $("#edit_subdom_form").serializeArray(); // convert form to array
        updateSubDomain(form_data);
    });

});   
</script>