<?php 

// require(SVC_PATH.DS.'functions.php');

$users = fetch_all_users();

?>

<div class="modal fade" id="userSelectModal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Select Target User</h4>
            </div>

            <div class="modal-body">

                <?php
                if (count($users) == 0) {
                    echo "No Record Found"; exit;
                }
                ?>
                
                <table class="table table-hover table-bordered table-select-user" id="user_list">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 20%;">User Name</th>
                            <th class="text-center" style="width: 25%;">Email</th>
                            <th class="text-left" style="width: 15%;">Domain</th>
                            <th class="text-center" style="width: 10%;">Select</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($users as $row) {  ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left" id="<?= 'uname_'.$row['id'] ?>"><b><?php echo $row['name']; ?></b></td>
                                <td class="text-center"><b><?php echo $row['email']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['domain']; ?></b></td>
                                <td class="text-center">
                                    <button 
                                        type="button" 
                                        data-dismiss="modal"
                                        class="select_user btn btn-secondary btn-sm btn-flat px-2" 
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
    $('#userSelectModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        xdata = $(e.relatedTarget).data('xdata');
        xuid = $(e.relatedTarget).data('xuid');
    });

    $("#user_list").on("click", ".select_user", function() {
        var userID = $(this).attr('data-id');
        var userName = $(this).attr('data-name');

        // alert('UserID: ' + userID + ', XData: ' + xdata, Xuid: ' + xuid);

        if (xdata == 'commentTargetUsers') {

            // Get the existing value
            var inputData = $('#commentTargetUserIDs').val();
            var inputName = $('#commentTargetUsers').val();
            if (!inputData) {
                inputData = userID;
                inputName = userName;
            }
            else {
                // Append the new value if not empty
                inputData += ',' + userID;
                inputName += ',' + userName;
            }
        
            // Set the notification target users input field with the user id
            $('#commentTargetUsers').val(inputName);
            $('#commentTargetUserIDs').val(inputData);
        }
        else if (xdata == 'likeTargetUsers') {

            // Get the existing value
            var inputData = $('#likeTargetUserIDs').val();
            var inputName = $('#likeTargetUsers').val();
            if (!inputData) {
                inputData = userID;
                inputName = userName;
            }
            else {
                // Append the new value if not empty
                inputData += ',' + userID;
                inputName += ',' + userName;
            }

            // Set the notification target users input field with the user id
            $('#likeTargetUsers').val(inputName);
            $('#likeTargetUserIDs').val(inputData);
        }
        else if (xdata == 'conversationTargetUsers') {

            if (xuid == userID) {
                alert("You can not enter your own address");
            }
            else {
                // Get the existing value
                var inputData = $('#conversationTargetUserIDs').val();
                var inputName = $('#conversationTargetUsers').val();
                if (!inputData) {
                    inputData = userID;
                    inputName = userName;
                }
                else {
                    // Append the new value if not empty
                    inputData += ',' + userID;
                    inputName += ',' + userName;
                }

                // Set the notification target users input field with the user id
                $('#conversationTargetUsers').val(inputName);
                $('#conversationTargetUserIDs').val(inputData);
            }            
        }
        else if (xdata == 'addMemberUser') {
            // Set the selected users into the input field
            $('#member_user').val(userName);
            $('#member_user_id').val(userID);
        }
    });

});


</script>