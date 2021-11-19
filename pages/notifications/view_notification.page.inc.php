
<div class="row">
    <div class="col-md-12">
        <div class="dashboard card my-4">
            <div class="card-body">

            <?php 
            if (isset($_GET['id'])) { 
                
                $id = $_GET['id'];   

                // Get the notification
                $selected_notification = getNotificationById($id);

                // Set the notification to read
                setNotificationToRead($id);

                echo "<h1>Notifications</h1>";
            
                if (count($selected_notification) > 0) {
                    foreach($selected_notification as $i) {
                        if ($i['type'] == 'like') {
                            echo ucfirst($i['name']) . " liked your post. <br/>". $i['notified_at'];
                        }
                        else {
                            echo "Someone commented on your post. <br/>" . $i['message'];
                        }
                    }
                }

            ?>
            <br/><br/>

            <a href="notifications.php?page=notification_list">Back</a>

            <?php } else { echo "No Record Found"; } ?>
                         
            </div>
        </div>
    </div>

</div>
