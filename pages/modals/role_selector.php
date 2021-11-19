<?php 

$roles = fetch_all_roles();

?>

<div class="modal fade" id="roleSelectModal" role='dialog'>
    <div class="modal-dialog" style="max-width: 700px!important;" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select a Role</h4>
            </div>

            <div class="modal-body">

                <?php
                if (count($roles) == 0) {
                    echo "No Record Found"; exit;
                }
                ?>
                
                <table class="table table-hover table-bordered table-select-user" id="roles_list">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 20%;">Role Name</th>
                            <th class="text-left" style="width: 35%;">Description</th>
                            <th class="text-center" style="width: 15%;">AccessLevel</th>
                            <th class="text-center" style="width: 10%;">Select</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($roles as $row) {  ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left" id="<?= 'rname_'.$row['id'] ?>"><b><?php echo $row['name']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['description']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['page_access_level']; ?></b></td>
                                <td class="text-center">
                                    <button 
                                        type="button" 
                                        data-dismiss="modal"
                                        class="select_role btn btn-secondary btn-sm btn-flat px-2" 
                                        data-id="<?php echo $row['id']; ?>"
                                        data-name="<?php echo $row['name']; ?>"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            $i++;
                        } 
                        ?>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $('#user_list').DataTable();     // initialize the datatable

    var xdata, xuid;

    // triggered when modal is about to be shown
    $('#roleSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
        // xuid = $(e.relatedTarget).data('xuid');
    });

    $("#roles_list").on("click", ".select_role", function() {
        var roleId = $(this).attr('data-id');
        var roleName = $(this).attr('data-name');

        // alert('roleId: ' + roleId + ', XData: ' + xdata);
        if (xdata == 'targetGroupRole') {
            // Set the target roles input field with the role id
            $('#targetGroupRole').val(roleName);
            $('#targetGroupRoleId').val(roleId);
        }
        else if (xdata == 'targetPagrRole') {
            $('#targetPagrRole').val(roleName);
            $('#targetPagrRoleId').val(roleId);
        }
    });

});


</script>