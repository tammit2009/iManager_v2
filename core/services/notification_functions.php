<?php 

// SQL API Primitive
function fetchAll($query) {
    $rows = array();
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $results = $opr->sqlSelect($query);
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $rows[] = $row;
            }
            $results->free_result();
        }
        $opr->close();
    }
    return $rows;
}

// SQL API Primitive
function performQuery($query) {
    $success = false;
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $success = $opr->sqlExecute($query);
        $opr->close();
    }
    return $success;
}

function getUnreadNotificationCount() {
    $query = "SELECT * FROM notifications WHERE status = 'unread' ORDER BY notified_at DESC";
    return count(fetchAll($query));
}

function getUnreadNotifications() {
    $query = "SELECT * FROM notifications WHERE status = 'unread' ORDER BY notified_at DESC";
    return fetchAll($query);
}

function getAllNotifications() {
    $query = "SELECT * FROM notifications ORDER BY notified_at DESC";
    return fetchAll($query);
}

function getLatestNotifications($limit) {
    $query = "SELECT * FROM notifications ORDER BY notified_at DESC LIMIT $limit";
    return fetchAll($query);
}

function getNotificationById($id) {
    $query = "SELECT * FROM `notifications` WHERE `id` = '$id'";
    return fetchAll($query);
}

function setNotificationToRead($id) {
    $query = "UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id";
    return performQuery($query);
}

function createCommentNotification($src, $targets, $message) {
    $values = array();
    $targetArr = explode(',', $targets);

    // insert notification for each target user
    foreach ($targetArr as &$target) { // '&' pass by reference
        // $target = trim($target);
        $target = (int)($target);
        $values[] = "(NULL, {$_SESSION['userid']}, {$target}, '', 'comment', '{$message}', 'unread', CURRENT_TIMESTAMP())";
    }

    $query =   "INSERT INTO `notifications` (`id`, `user_id`, `target_id`, `name`, `type`, `message`, `status`, `notified_at`) 
                VALUES " . implode(", ", $values);

    return performQuery($query);
}

function createLikeNotification($src, $targets, $message) {
    $values = array();
    $targetArr = explode(',', $targets);

    // insert notification for each target user
    foreach ($targetArr as &$target) { // '&' pass by reference
        // $target = trim($target);
        $target = (int)($target);
        $values[] = "(NULL, {$_SESSION['userid']}, {$target}, '', 'like', '{$message}', 'unread', CURRENT_TIMESTAMP())";
    }

    $query =   "INSERT INTO `notifications` (`id`, `user_id`, `target_id`, `name`, `type`, `message`, `status`, `notified_at`) 
                VALUES " . implode(", ", $values);

    return performQuery($query);
}


?>