<?php 

$errors = array();

$valid_conversation = (isset($_GET['conversation_id']) && validate_conversation_id($_GET['conversation_id']));

if ($valid_conversation === false ) {
    $errors[] = 'Invalid conversation ID';
}

if (isset($_POST['message'])) {
    if (empty($_POST['message'])) {
        $errors[] = 'You must enter a message';
    }

    if (empty($errors)) {
        add_conversation_message($_GET['conversation_id'], $_POST['message']);
    }
}

if ($valid_conversation) {

    $conversation = get_conversation_by_id($_GET['conversation_id']);

    if (isset($_POST['message'])) {
        update_conversation_last_view($_GET['conversation_id']);
        $messages = fetch_conversation_messages($_GET['conversation_id']);
    }
    else {
        $messages = fetch_conversation_messages($_GET['conversation_id']);
        update_conversation_last_view($_GET['conversation_id']);
    } ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header bg-white" style="font-weight: bold; font-size: 18px;">
                    <a href="./messages.php?page=inbox" class="btn  btn-outline-info">Back</a>
                </div>

                <div class="card-body">

                    <!-- Errors -->
                    <?php
                    if (empty($errors) === false) {
                        foreach($errors as $error) {
                            echo '<div class="msg error">', $error, '</div>';
                        }
                    } ?>

                    <div class="row">

                        <div class="col-md-9 border-right px-3">

                            <h4 class="conversation mb-3">Subject: <?php echo $conversation['subject']; ?></h4>

                            <?php foreach ($messages as $message) { ?>
                                
                                <?php if ($message['user_id'] == $_SESSION['userid']) { ?>

                                <div class="conversation-message-o d-flex justify-content-between mb-3">
                                    <div class="message-details">
                                        <div class="message-text<?php if ($message['unread']) echo ' unread'; ?>">
                                            <?php echo $message['text'] ?>
                                        </div>
                                        <span class="message-date">
                                            <!-- TODO: change date format to "October 12, 2015 at 9:00 pm" -->
                                            <i class="far fa-clock"></i> <?php echo date('F d, Y \a\t h:i:s a', $message['date']) ?>
                                        </span>
                                    </div>
                                    <div class="message-from">
                                        <img src="./assets/imgs/avatar2.png" alt="avatar">
                                        <span class="message-uid"><?php echo $message['user_name'] ?></span>
                                    </div>
                                </div>

                                <?php } else { ?>

                                <div class="conversation-message d-flex justify-content-between mb-3">
                                    <div class="message-from">
                                        <img src="./assets/imgs/avatar1.png" alt="avatar">
                                        <span class="message-uid"><?php echo $message['user_name'] ?></span>
                                    </div>
                                    <div class="message-details">
                                        <div class="message-text<?php if ($message['unread']) echo ' unread'; ?>">
                                            <?php echo $message['text'] ?>
                                        </div>
                                        <!-- TODO: change date format to "October 12, 2015 at 9:00 pm" -->
                                        <span class="message-date">
                                            <i class="far fa-clock"></i> <?php echo date('F d, Y \a\t h:i:s a', $message['date']) ?>
                                        </span>
                                    </div>
                                </div>

                                <?php } ?>

                            <?php } echo "<hr/>"; ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-outline-info float-right" value="Add Message">
                                </div>                           
                            </form>

                        </div>

                        <div class="col-md-3">
                            <!-- List the message trail here -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php } ?>


