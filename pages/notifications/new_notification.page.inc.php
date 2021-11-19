<?php 
    // Comment notification
    if (isset($_POST['submitComment'])) {
        $commentNotification = $_POST['commentNotification'];
        $commentTargetUserIDs = $_POST['commentTargetUserIDs'];
        // $commentTargetUsers = $_POST['commentTargetUsers'];

        if (createCommentNotification(0, $commentTargetUserIDs, $commentNotification)) {
            // Refresh the page
            header("location: notifications.php?page=new_notification");
        }
    }

    // Like notification
    if (isset($_POST['submitLike'])) {
        $likeNotification = $_POST['likeNotification'];
        $likeTargetUserIDs = $_POST['likeTargetUserIDs'];
        // $likeTargetUsers = $_POST['likeTargetUsers'];
        
        if (createLikeNotification(0, $likeTargetUserIDs, $likeNotification)) {
            // Refresh the page
            header("location:notifications.php?page=new_notification");
        }
    }
?>

<div class="row">
    <div class="col-md-6">
        <div class="dashboard card my-4">
            <div class="card-body">
            <form method="post">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h3>Make a Comment Notification</h3>
                    </div>
                    <div class="col-md-12 d-flex align-items-center mb-3">
                        <div class="form-group my-0 mr-2" style="width:70%;">
                            <input type="hidden" name="commentTargetUserIDs" id="commentTargetUserIDs">
                            <input type="text" class="form-control form-control-sm" name="commentTargetUsers" id="commentTargetUsers" placeholder="Select Target Users" required>
                        </div>
                        <a 
                            class="btn btn-sm btn-info" 
                            style="width:30%;" 
                            href="#" 
                            data-toggle="modal" 
                            data-xdata="commentTargetUsers"
                            data-target="#userSelectModal"
                        >
                            <i class="fas fa-user fa-sm text-gray-400"></i>
                            Select Targets
                        </a>                        
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="commentNotification">Enter a Comment</label>
                            <textarea class="form-control form-control-sm" name="commentNotification" id="commentNotification" rows="3"></textarea>
                        </div>
                        <button name="submitComment" class="btn btn-outline-success float-right" type="submit">Submit</button>
                    </div>       
                </div>        
            </form> 
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="dashboard card my-4">
            <div class="card-body">
                <form method="post">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h3>Make a Like Notification</h3>
                    </div>
                    <div class="col-md-12 d-flex align-items-center mb-3">
                        <div class="form-group my-0 mr-2" style="width:70%;">
                            <input type="hidden" name="likeTargetUserIDs" id="likeTargetUserIDs">
                            <input type="text" class="form-control form-control-sm" name="likeTargetUsers" id="likeTargetUsers" placeholder="Select Target Users" required>
                        </div>
                        <a 
                            class="btn btn-sm btn-info" 
                            style="width:30%;" 
                            href="#" 
                            data-toggle="modal" 
                            data-xdata="likeTargetUsers"
                            data-target="#userSelectModal"
                        >
                            <i class="fas fa-user fa-sm text-gray-400"></i>
                            Select Targets
                        </a>   
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="likeNotification">Message</label>
                            <textarea class="form-control form-control-sm" name="likeNotification" id="likeNotification" rows="3"></textarea>
                        </div>
                        <button name="submitLike" class="btn btn-outline-success float-right" type="submit">Like</button>
                    </div>
                </div>
                </form>                   
            </div>
        </div>
    </div>

</div>

<!-- Modals -->
<?php include('./pages/modals/user_selector.php'); ?>

<script>

$(document).ready(function(){

    $('.page-title').addClass('d-none');

});

</script>
