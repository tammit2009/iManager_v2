<?php 

    $unread_notification_count = getUnreadNotificationCount();
    $notifications = getAllNotifications();

?>

<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <?php if ($unread_notification_count > 0) { ?>
            <span class="badge badge-danger badge-counter"><?php echo $unread_notification_count; ?></span>        
        <?php } ?>               
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">

        <!-- <h6 class="dropdown-header">
            Alerts Center
        </h6> -->

        <?php  
        if ($unread_notification_count > 0) { 

            foreach($notifications as $i) { ?>

                <a  
                    class="dropdown-item d-flex align-items-center" 
                    href="./notifications.php?page=view_notification&amp;id=<?php echo $i['id']; ?>">

                    <?php if ($i['type'] == 'document') { ?>
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>  
                    <?php } else if ($i['type'] == 'income') { ?>
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>                    
                    <?php } else if ($i['type'] == 'alert') { ?>
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>    
                    <?php } else if ($i['type'] == 'like') { ?>
                        <div class="mr-3">
                            <div class="icon-circle bg-info">
                                <i class="fas fa-thumbs-up text-white"></i>
                            </div>
                        </div>    
                    <?php } else if ($i['type'] == 'comment') { ?>
                        <div class="mr-3">
                            <div class="icon-circle bg-secondary">
                                <i class="fas fa-comments text-white"></i>
                            </div>
                        </div>    
                    <?php } else { ?>
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div> 
                    <?php } ?>

                    <div>
                        <div class="small text-gray-500">
                            <?php echo date('F j, Y, g:i a', strtotime($i['notified_at'])); ?>
                        </div>
                        <span <?php if ($i['status'] == 'unread') { echo "class=\"font-weight-bold\""; } ?>>
                            <?php echo $i['message']; ?>
                        </span>
                    </div>
                </a>

            <?php }
        } ?> 

        <a class="dropdown-item text-center small text-gray-500" href="notifications.php?notification_list">Show All Alerts</a>
    </div>
</li>

