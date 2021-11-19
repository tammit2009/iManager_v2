<?php 

$pagr_roles = array();
$pagr = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $pagr_roles = fetch_roles_by_pagr($id);
    $pagr = fetch_pagr_by_id($id);
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
                    <h3 class="pt-3">PAGR Details</h3>
                </div>
            </div> -->
            <div class="card-body">
                <h3>PAGR: "<?= $pagr['label']; ?>"</h3>
                <!-- <h5 class="my-2"></?= $pagr['description']; ?></h5> -->
                <input type="hidden" name="_pagrid" id="_pagrid" value="<?php echo (isset($_GET['id'])) ? $id : ''; ?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <h4 class="my-1">Add Role to PAGR</h4>
                </div>
            </div>
            <div class="card-body" id="add_role_to_pagr">

                <form id="add_role_to_pagr_form">
                    <div class="row">
                        <input type="hidden" name="pagrId" id="pagrId" value="<?php echo (isset($_GET['id'])) ? $id : ''; ?>">
                        <div class="col-md-12 mb-2">
                            <p style="color:sienna;font-size:14px">Select a role to add to the pagr's collection using the 'Select Role' button below</p>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="input-group my-0">
                                <input type="hidden" name="targetPagrRoleId" id="targetPagrRoleId">
                                <input type="text" class="form-control" name="targetPagrRole" id="targetPagrRole" placeholder="Select Role" required required>
                                <div class="input-group-append">
                                <a class="btn btn-info px-3 my-0 float-right" href="#" 
                                    data-toggle="modal" data-target="#roleSelectModal"
                                    data-xdata="targetPagrRole"
                                ><i class="fas fa-cog fa-sm text-gray-400"></i></a>   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="form-group my-0">
                                <input type="text" class="form-control" name="targetPagrRoleLabel" id="targetPagrRoleLabel" placeholder="Label" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group my-0">
                                <textarea class="form-control" name="targetPagrRoleDescr" id="targetPagrRoleDescr" placeholder="Description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button name="submitRole" id="submitRole" class="btn btn-outline-info btn-block my-0" type="button">Add to PAGR</button>
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
                    <h4 class="my-1">PAGR Roles</h4>
                </div>
            </div>
            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <?php if ($pagr_roles == -1 || empty($pagr_roles)) {
                    echo "No Record Found"; exit;
                } ?>
                
                <table class="table table-bordered table-users" id="listPagrRoles" 
                    style="word-break: break-word;">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 25%;">PAGr Role Label</th>
                            <th class="text-center" style="width: 15%;">RoleID</th>
                            <th class="text-left" style="width: 25%;">Role Description</th>
                            <th class="text-center" style="width: 15%;">PAL</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($pagr_roles as $role) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-left"><b><?php echo $role['label']; ?></b></td>
                            <td class="text-center"><b><?php echo $role['role_id']; ?></b></td>
                            <td class="text-left"><b><?php echo $role['description']; ?></b></td>
                            <td class="text-center"><b><?php echo $role['page_access_level']; ?></b></td>
                            <td class="text-center">
                                <a class="btn btn-sm edit_pagr_role" href="#"
                                    data-toggle="modal" data-target="#editPagrRoleModal" 
                                    data-roleid="<?php echo $role['role_id']; ?>" 
                                    data-pagrid="<?php echo (isset($_GET['id'])) ? $id : ''; ?>">
                                    <i class="fa fa-pen" style="color:royalblue"></i>
                                </a>
                                <a class="btn btn-sm delete_pagr_role" id="delete_pagr_role" href="javascript:void(0)" did="<?php echo $role['role_id']; ?>">
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
<?php include('./pages/modals/role_selector.php'); ?>
<?php include('./pages/main/pagrs/modals/edit_pagr_role_modal.php'); ?>

<script> 
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listPagrRoles').DataTable();     // initialize the datatable

    // Status Messages
    <?php if (isset($_SESSION['status'])): ?>
        // swal
        createAutoClosingAlert("#alert-msg", "<?php echo flash('msg'); ?>", "<?php echo flash('status'); ?>", 4000);
        // toastr (if required instead)
        // toastr.success("</?php echo flash('status'); ?>");
    <?php endif; ?>

    // Submit Role to continue 'main_scripts.js' with ajax
    $('#add_role_to_pagr').delegate('#submitRole', 'click', function(e) {        
        var form_data = $("#add_role_to_pagr_form").serializeArray(); // convert form to array            
        addRoleToPagr(form_data);
    })

    // Delete Role
    $('#listPagrRoles').delegate('.delete_pagr_role', 'click', function(e) {
        var roleId = $(this).attr("did");
        var pagrId = $("#_pagrid").val();
        deletePagrRole(pagrId, roleId);
    })

});
</script>