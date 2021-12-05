<?php 

$subdomains = array();
$domain = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $subdomains = fetch_subdoms_by_domain($id);
    $domain = fetch_domain_by_id($id);
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="dashboard card my-2">
            <!-- <div class="card-header bg-white">
                <div class="col-md-6 d-flex align-items-center">
                    <a href="./dashboard.php?page=list_order_requisitions" class="btn btn-outline-default">
                        <i class="fa fa-arrow-left">&nbsp;</i>
                    </a>
                    <h3 class="pt-3">Group Details</h3>
                </div>
            </div> -->
            <div class="card-body">
                <h3>Domain: <?= $domain['name']; ?></h3> 
                <!-- <h5 class="my-2"></?= $domain['description']; ?></h5> -->
                <input type="hidden" name="_domainid" id="_domainid" value="<?php echo (isset($_GET['id'])) ? $id : ''; ?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <h4 class="my-1">Add Subdomain</h4>
                </div>
            </div>
            <div class="card-body" id="add_subdom_to_domain">

                <form id="add_subdom_to_domain_form">
                    <div class="row">
                        <input type="hidden" name="domainId" id="domainId" value="<?php echo (isset($_GET['id'])) ? $id : ''; ?>">
                        <div class="col-md-12 mb-2">
                            <p style="color:sienna;font-size:14px">Create a sub-domain and add to the domain's collection fields and button below</p>
                        </div>

                        <!-- <div class="col-md-12 mb-2">
                            <div class="input-group my-0">
                                <input type="hidden" name="targetSubDomId" id="targetSubDomId">
                                <input type="text" class="form-control" name="targetSubDom" id="targetSubDom" placeholder="Select Subdomain" required>
                                <div class="input-group-append">
                                <a class="btn btn-info px-3 my-0 float-right" href="#" 
                                    data-toggle="modal" data-target="#subdomSelectModal"
                                    data-xdata="targetSubDom"
                                ><i class="fas fa-cog fa-sm text-gray-400"></i></a>   
                                </div>
                            </div>
                        </div> -->

                        <div class="col-md-12 mb-2">
                            <div class="form-group my-0">
                                <input type="text" class="form-control" name="targetSubDomName" id="targetSubDomName" placeholder="Subdomain Name" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group my-0">
                                <textarea class="form-control" name="targetSubDomDescr" id="targetSubDomDescr" placeholder="Description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button name="submitSubDom" id="submitSubDom" class="btn btn-outline-info btn-block my-0" type="button">Create and add to Domain</button>
                        </div>       
                    </div>        
                </form> 
                
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <h4 class="my-1">Subdomains</h4>
                </div>
            </div>
            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($subdomains == -1 || empty($subdomains)) {
                    echo "No Record Found"; //exit;
                } ?>
                
                <table class="table table-bordered table-users" id="listSubDomains" 
                    style="word-break: break-word;">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 25%;">Subdomain</th>
                            <th class="text-left" style="width: 40%;">Description</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($subdomains as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left"><b><?php echo $row['name']; ?></b></td>
                            <td class="text-left"><b><?php echo $row['description']; ?></b></td>
                            <td class="text-center">
                                <a class="btn btn-sm edit_subdom" href="#"
                                    data-toggle="modal" 
                                    data-target="#editSubdomainModal" 
                                    data-xsrc="view_domain"
                                    data-subdomid="<?php echo $row['id']; ?>" 
                                    data-domainid="<?php echo (isset($_GET['id'])) ? $id : ''; ?>">
                                    <i class="fa fa-pen" style="color:royalblue"></i>
                                </a>
                                <a class="btn btn-sm delete_subdom" id="delete_subdom" href="javascript:void(0)" did="<?php echo $row['id']; ?>">
                                    <i class="fa fa-trash" style="color:palevioletred"></i>
                                </a>
                            </td>
                        </tr>

                        <?php $i++; } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include('./pages/modals/subdomain_selector.php'); ?>
<?php include('./pages/main/subdoms/modals/edit_subdom_modal.php'); ?>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listSubDomains').DataTable();     // initialize the datatable

    // Submit SubDom to 'main_scripts.js' and continue with ajax
    $('#add_subdom_to_domain').delegate('#submitSubDom', 'click', function(e) {    
        var form_data = $("#add_subdom_to_domain_form").serializeArray(); // convert form to array            
        addSubDomToDomain(form_data);
    })

    // Delete Subdomain
    $('#listSubDomains').delegate('.delete_subdom', 'click', function(e) {
        var subdomId = $(this).attr("did");
        var domainId = $("#_domainid").val();
        deleteSubDomain(domainId, subdomId);
    })

});
</script>