<?php 

    $unread_message_count = getUnreadMessagesCountForThisUser();
    $messages = getAllMessagesForThisUser();

?>

<!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>

        <!-- Counter - Messages -->
        <!-- <span class="badge badge-danger badge-counter">7</span> -->
        <?php if ($unread_message_count > 0) { ?>
            <span class="badge badge-danger badge-counter"><?php echo $unread_message_count; ?></span>        
        <?php } ?>   
    </a>
    <!/-- Dropdown - Messages --/>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">

        <!-- <h6 class="dropdown-header">
            Message Center
        </h6> -->

        <?php  
        if ($unread_message_count > 0) { 

            foreach($messages as $i) { ?>

            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="../assets/imgs/undraw_profile_1.svg" alt="...">
                    <!-- <div class="status-indicator bg-success"></div>
                    <div class="status-indicator bg-warning"></div> -->
                    <div class="status-indicator"></div>
                </div>
                <div <?php if ($i['unread']) { echo "class=\"font-weight-bold\""; } ?>>
                    <div class="text-truncate"><?php echo $i['text'] ?></div>
                    <div class="small text-gray-500"><?php echo $i['user_name'] ?> . <?php echo $i['message_since'] ?></div>
                </div>
            </a>

            <?php }
        } ?>

        <a class="dropdown-item text-center small text-gray-500" href="messages.php?page=inbox">Read More Messages</a>
    </div>
</li>

<div class="topbar-divider d-none d-sm-block"></div>