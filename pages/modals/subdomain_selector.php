<?php 

$subdomains = fetch_all_subdomains();

?>

<div class="modal fade" id="subdomSelectModal" role='dialog'>
    <div class="modal-dialog" style="max-width: 700px!important;" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select a Subdomain</h4>
            </div>

            <div class="modal-body">

                <?php
                if (count($subdomains) == 0) {
                    echo "No Record Found"; exit;
                }
                ?>
                
                <table class="table table-hover table-bordered table-select-user" id="subdoms_list">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 20%;">Domain</th>
                            <th class="text-left" style="width: 20%;">SubDom Name</th>
                            <th class="text-left" style="width: 35%;">Description</th>
                            <th class="text-center" style="width: 10%;">Select</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($subdomains as $row) {  ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left"><b><?php echo $row['domain_name']; ?></b></td>
                                <td class="text-left" id="<?= 'subdom_'.$row['id'] ?>"><b><?php echo $row['name']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['description']; ?></b></td>
                                <td class="text-center">
                                    <button 
                                        type="button" 
                                        data-dismiss="modal"
                                        class="select_subdom btn btn-secondary btn-sm btn-flat px-2" 
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

    $('#subdoms_list').DataTable();     // initialize the datatable

    var xdata, xuid;

    // triggered when modal is about to be shown
    $('#subdomSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
        // xuid = $(e.relatedTarget).data('xuid');
    });

    $("#subdoms_list").on("click", ".select_subdom", function() {
        var subdomId = $(this).attr('data-id');
        var subdomName = $(this).attr('data-name');

        // alert('subdomId: ' + subdomId + ', XData: ' + xdata);
        if (xdata == 'targetSubDom') {
            // Set the target subdom input field with the role id
            $('#targetSubDom').val(roleName);
            $('#targetSubDomId').val(roleId);
        }
        // else if (xdata == 'targetPagrRole') {
        //     $('#targetPagrRole').val(roleName);
        //     $('#targetPagrRoleId').val(roleId);
        // }
    });

});


</script>