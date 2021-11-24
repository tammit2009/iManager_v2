
<?php 
    $subdomains = fetch_all_subdomains();
?>

<div class="row">
    <div class="col-md-8">
        <div class="dashboard card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h4 class="my-1">List of Subdomains</h4>
                    <!-- <a href="#" class="btn btn-block btn-sm btn-default btn-flat border-info" 
                                data-toggle="modal" data-target="#createDomainModal">
                        <i class="fa fa-plus"></i> Add New Domain
                    </a> -->
                </div>
            </div>
            <div class="card-body">

            <!-- Status Messages -->
            <div id="alert-msg"></div>

            <?php if ($subdomains == -1 || empty($subdomains)) {
                echo "No Record Found"; exit;
            } ?>

            <table class="table table-bordered table-users" id="listSubdomains">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-left" style="width: 15%;">SubDom Name</th>
                        <th class="text-left" style="width: 15%;">Parent Domain</th>
                        <th class="text-left" style="width: 35%;">Description</th>
                        <!-- <th class="text-center" style="width: 10%;">Action</th> -->
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1;
                    foreach ($subdomains as $subdomain) { ?>

                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-left"><b><?php echo $subdomain['name']; ?></b></td>
                        <td class="text-left"><b><?php echo $subdomain['domain_name']; ?></b></td>
                        <td class="text-left"><b><?php echo $subdomain['description']; ?></b></td>
                        <!-- <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./main.php?dir=orgs&amp;page=view_domain&amp;id=<?php echo $subdomain['id']; ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editDomainModal" data-domainid="<?php echo $subdomain['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_domain" id="delete_domain" href="javascript:void(0)" did="<?php echo $subdomain['id']; ?>">Delete</a>
                            </div>
                        </td> -->
                    </tr>

                    <?php $i++; } ?>

                </tbody>
                
            </table>

            </div>
        </div>
    </div>
</div>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listSubdomains').DataTable();     // initialize the datatable

    // // Delete Domain
    // $('#listSubdomains').delegate('.delete_domain', 'click', function(e) {
    //     var domainId = $(this).attr("did");
    //     deleteDomain(domainId);
    // })

});
</script>