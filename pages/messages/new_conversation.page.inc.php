<?php 
if (isset($_POST['conversationTargetUsers'], $_POST['subject'], $_POST['body'])) {
    $errors = array();

    if (empty($_POST['conversationTargetUsers'])) {
        $errors[] = 'You must enter at least one name.';
    }
    else if (preg_match('#^[a-z, ]+$#i', $_POST['conversationTargetUsers']) === 0) {
        $errors[] = 'The list of names you gave does not look valid.';
    }
    else {
        $user_names = explode(',', $_POST['conversationTargetUsers']);

        foreach ($user_names as &$name) { // '&' pass by reference
            $name = trim($name);
        }

        $user_ids = fetch_user_ids($user_names);

        if (count($user_ids) !== count($user_names)) {
            $errors[] = 'The following users could not be found: ' . implode(', ', array_diff($user_names, array_keys($user_ids)));
        }
    }

    if (empty($_POST['subject'])) {
        $errors[] = 'The subject cannot be empty.';
    }

    if (empty($_POST['body'])) {
        $errors[] = 'The body cannot be empty.';
    }

    if (empty($errors)) {
        create_conversation(array_unique($user_ids), $_POST['subject'], $_POST['body']);
    }
}

?>

<div class="row">
    <div class="col-md-9">
        <div class="card my-4">

            <div class="card-header bg-white" style="font-weight: bold; font-size: 18px;">
                <a href="./messages.php?page=inbox" class="btn  btn-outline-info">Back</a>
            </div>

            <div class="card-body">

                <!-- Errors -->
                <?php // has form already been submitted
                if (isset($errors)) {
                    if (empty($errors)) {
                        echo '<div class="msg success">Your message has been sent !</div>';
                    }
                    else {
                        foreach ($errors as $error) {
                            echo '<div class="msg error">' . $error . '</div>';
                        }
                    }
                } ?>

                <form method="post">

                    <div class="form-group row">
                        <div class="col-md-9">
                            <input type="hidden" name="conversationTargetUserIDs" id="conversationTargetUserIDs">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="conversationTargetUsers" 
                                id="conversationTargetUsers" 
                                value="<?php if (isset($_POST['to'])) echo htmlentities($_POST['to']); ?>"
                                aria-describedby="to" 
                                placeholder="Target user(s)..."
                            >
                        </div>
                        <div class="col-md-3">
                            <a 
                                class="btn btn-outline-info float-right" 
                                href="#" 
                                data-toggle="modal" 
                                data-xdata="conversationTargetUsers"
                                data-xuid="<?php echo $_SESSION['userid']; ?>"
                                data-target="#userSelectModal"
                            >
                                Select Target Users
                            </a>   
                        </div>
                    </div>
                    <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="subject" 
                            id="subject" 
                            value="<?php if (isset($_POST['subject'])) echo htmlentities($_POST['subject']); ?>"
                            aria-describedby="to" 
                            placeholder="Enter New Conversation Subject"
                        >
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" rows="5"><?php if (isset($_POST['body'])) echo htmlentities($_POST['body']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-info mb-2 float-right px-3">Send</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modals -->
<?php include('./pages/modals/user_selector.php'); ?>

<script>

$(document).ready(function(){

    // $('.page-title').addClass('d-none');

});

</script>