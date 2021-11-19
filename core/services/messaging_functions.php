<?php 

function get_conversation_by_id($id) {
    $conversation = array();

    $sql = "SELECT * FROM `conversations` WHERE `id` = {$id}";

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $result = $opr->sqlSelect($sql);
        if ($result && $result->num_rows == 1) {
            $conversation = $result->fetch_assoc();
        }
        $opr->close();
    }
    return $conversation;
}

// Fetches a summary of the conversations 
function fetch_conversation_summary() {
    $conversations = array();

    $sql = "SELECT `conversations`.`id`, `conversations`.`subject`,
                    MAX(`conversations_messages`.`message_date`) AS `conversations_last_reply`,
                    MAX(`conversations_messages`.`message_date`) > `conversations_members`.`conversation_last_view` AS `conversations_unread`
            FROM `conversations`
            LEFT JOIN `conversations_messages` ON `conversations`.`id` = `conversations_messages`.`conversation_id`
            LEFT JOIN `conversations_members` ON `conversations`.`id` = `conversations_members`.`conversation_id`
            WHERE `conversations_members`.`user_id` = {$_SESSION['userid']}
            AND `conversations_members`.`conversation_deleted` = 0
            GROUP BY `conversations`.`id`
            ORDER BY `conversations_last_reply` DESC
            ";

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $results = $opr->sqlSelect($sql);
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $conversations[] = array(
                    'id'                => $row['id'],
                    'subject'           => $row['subject'],
                    'last_reply'        => $row['conversations_last_reply'],
                    'unread_messages'   => ($row['conversations_unread'] == 1)
                );
            }
            $results->free_result();
        }
        $opr->close();
    }
    return $conversations;
}

// Fetches all the messages in the given conversation
function fetch_conversation_messages($conversation_id) {
    $messages = array();

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $conversation_id = (int)$conversation_id;
    
        $sql = "SELECT
                    `conversations_messages`.`message_date`,
                    `conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` AS `message_unread`,
                    `conversations_messages`.`message_text`,
                    `users`.`name`, `users`.`id`
                FROM `conversations_messages`
                INNER JOIN `users` ON `conversations_messages`.`user_id` = `users`.`id`
                INNER JOIN `conversations_members` ON `conversations_messages`.`conversation_id` = `conversations_members`.`conversation_id`
                WHERE `conversations_messages`.`conversation_id` = {$conversation_id}
                AND `conversations_members`.`user_id` = {$_SESSION['userid']}
                ORDER BY `conversations_messages`.`message_date` DESC";

        $results = $opr->sqlSelect($sql);
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $messages[] = array(
                    'date' => $row['message_date'],
                    'unread' => $row['message_unread'],
                    'text' => $row['message_text'],
                    'user_name' => $row['name'],
                    'user_id' => $row['id'],
                );
            }
            $results->free_result();
        }
        $opr->close();
    }
    return $messages;
}

// Sets the last view time to the current time for the given conversation
function update_conversation_last_view($conversation_id) {
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $conversation_id = (int)$conversation_id;

        $sql = "UPDATE `conversations_members`
                SET `conversation_last_view` = UNIX_TIMESTAMP()
                WHERE `conversation_id` = {$conversation_id}
                AND `user_id` = {$_SESSION['userid']}";

        $opr->sqlUpdate($sql);
        $opr->close();
    }
}

// Creates a new conversation, making the given users are members
function create_conversation($user_ids, $subject, $body) {
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $subject = mysqli_real_escape_string($opr->getConnection(), htmlentities($subject));
        $body = mysqli_real_escape_string($opr->getConnection(), htmlentities($body));

        // insert into conversations table
        $query = "INSERT INTO `conversations` (`subject`) VALUES ('{$subject}')";
        $conversation_id = $opr->sqlInsert($query);

        // insert into conversation_messages table
        $sql = "INSERT INTO `conversations_messages` (`conversation_id`, `user_id`, `message_date`, `message_text`)
                VALUES ({$conversation_id}, {$_SESSION['userid']}, UNIX_TIMESTAMP(), '{$body}')"; 
        $opr->sqlInsert($sql);

        // Add current sender's user id
        $values = array("({$conversation_id}, {$_SESSION['userid']}, UNIX_TIMESTAMP(), 0)");

        // to insert conversation for each user
        foreach ($user_ids as $user_id) {
            $user_id = (int) $user_id;
            $values[] = "({$conversation_id}, {$user_id}, 0, 0)";
        }

        // insert into conversation_members table
        $sql = "INSERT INTO `conversations_members` (`conversation_id`, `user_id`, `conversation_last_view`, `conversation_deleted`)
                VALUES " . implode(", ", $values);
        
        $opr->sqlInsert($sql);

        $opr->close();
    }    
}

// Check to see if the given user is a member of the given conversation
function validate_conversation_id( $conversation_id ) {
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $conversation_id = (int)$conversation_id;

        $sql = "SELECT COUNT(1) as conversation_count FROM `conversations_members`
                WHERE `conversation_id` = {$conversation_id}
                AND `user_id` = {$_SESSION['userid']}
                AND `conversation_deleted` = 0";
        $result = $opr->sqlSelect($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return ($row['conversation_count'] == 1);    
        }
        $opr->close();
    }
    return false;
}

// Adds a message to the given conversation.
function add_conversation_message($conversation_id, $text) {
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $conversation_id = (int)$conversation_id;
        $text = mysqli_real_escape_string($opr->getConnection(), htmlentities($text));
    
        $sql = "INSERT INTO `conversations_messages` (`conversation_id`, `user_id`, `message_date`, `message_text`)
                VALUES ({$conversation_id}, {$_SESSION['userid']}, UNIX_TIMESTAMP(), '{$text}')";
        $opr->sqlInsert($sql);
    
        // make the conversation reappear for members that already deleted the conversation because of new message - can be annoying though
        // $opr->sqlUpdate("UPDATE `conversations_members` SET `conversation_deleted` = 0 WHERE `conversation_id` = {$conversation_id}");

        $opr->close();
    }
}

// Deletes or marks as deleted a given conversation
function delete_conversation($conversation_id) {
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $conversation_id = (int)$conversation_id;

        $sql = "SELECT DISTINCT `conversation_deleted`
                FROM `conversations_members`
                WHERE `user_id` != {$_SESSION['userid']}
                AND `conversation_id` = {$conversation_id}";
    
        $result = $opr->sqlSelect($sql);
        if ($result && $result->num_rows === 1 && $result->fetch_assoc()['conversation_deleted'] == 1) {
            $opr->sqlDelete("DELETE FROM `conversations` WHERE `id` = {$conversation_id}");
            $opr->sqlDelete("DELETE FROM `conversations_members` WHERE `conversation_id` = {$conversation_id}");
            $opr->sqlDelete("conversations_messages` WHERE `conversation_id` = {$conversation_id}");
        }
        else {
            $sql = "UPDATE `conversations_members`
                    SET `conversation_deleted` = 1 
                    WHERE `conversation_id` = {$conversation_id}
                    AND `user_id` = {$_SESSION['userid']}";
            $opr->sqlUpdate($sql);
        }
        $opr->close();
    }  
}

function fetch_user_ids($user_names) {
    $names = array();

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        foreach($user_names as &$name) {
            $name = mysqli_real_escape_string($opr->getConnection(), $name);
        }
    
        $query = "SELECT `id`, `name` FROM `users` WHERE `name` IN ('" . implode("', '", $user_names) . "')";
        $result = $opr->sqlSelect($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $names[$row['name']] = $row['id'];
            }
        }
    }
    return $names;
}

function getUnreadMessagesCountForThisUser() {
    $messages = array();

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
    
        $sql = "SELECT
                    `conversations_messages`.`message_date`,
                    `conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` AS `message_unread`,
                    `conversations_messages`.`message_text`,
                    `users`.`name`, `users`.`id`
                FROM `conversations_messages`
                INNER JOIN `users` ON `conversations_messages`.`user_id` = `users`.`id`
                INNER JOIN `conversations_members` 
                ON `conversations_messages`.`conversation_id` = `conversations_members`.`conversation_id`
                WHERE `conversations_members`.`user_id` = {$_SESSION['userid']}
                AND `conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` 
                ORDER BY `conversations_messages`.`message_date` DESC";

        $results = $opr->sqlSelect($sql);
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $messages[] = array(
                    'date' => $row['message_date'],
                    'unread' => $row['message_unread'],
                    'text' => $row['message_text'],
                    'user_name' => $row['name'],
                    'user_id' => $row['id'],
                );
            }
            $results->free_result();
        }
        $opr->close();
    }
    return count($messages);
}

function getUnreadMessagesForThisUser() {
    $messages = array();

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
    
        $sql = "SELECT
                    `conversations_messages`.`message_date`,
                    `conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` AS `message_unread`,
                    `conversations_messages`.`message_text`,
                    `users`.`name`, `users`.`id`
                FROM `conversations_messages`
                INNER JOIN `users` ON `conversations_messages`.`user_id` = `users`.`id`
                INNER JOIN `conversations_members` 
                ON `conversations_messages`.`conversation_id` = `conversations_members`.`conversation_id`
                WHERE `conversations_members`.`user_id` = {$_SESSION['userid']}
                AND `conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` 
                ORDER BY `conversations_messages`.`message_date` DESC";

        $results = $opr->sqlSelect($sql);
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $messages[] = array(
                    'date' => $row['message_date'],
                    'unread' => $row['message_unread'],
                    'text' => $row['message_text'],
                    'user_name' => $row['name'],
                    'user_id' => $row['id'],
                );
            }
            $results->free_result();
        }
        $opr->close();
    }
    return $messages;
}

function getAllMessagesForThisUser() {

    $messages = array();

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
    
        $sql = "SELECT
                    `conversations_messages`.`message_date`,
                    `conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` AS `message_unread`,
                    UNIX_TIMESTAMP() - `conversations_messages`.`message_date` AS `message_since`,
                    `conversations_messages`.`message_text`,
                    `users`.`name`, `users`.`id`
                FROM `conversations_messages`
                INNER JOIN `users` ON `conversations_messages`.`user_id` = `users`.`id`
                INNER JOIN `conversations_members` 
                ON `conversations_messages`.`conversation_id` = `conversations_members`.`conversation_id`
                WHERE `conversations_members`.`user_id` = {$_SESSION['userid']}
                ORDER BY `conversations_messages`.`message_date` DESC";

        $results = $opr->sqlSelect($sql);
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $messages[] = array(
                    'date' => $row['message_date'],
                    'unread' => $row['message_unread'],
                    'text' => $row['message_text'],
                    'user_name' => $row['name'],
                    'user_id' => $row['id'],
                    'message_since' => getMessageSince( $row['message_since'] )
                );
            }
            $results->free_result();
        }
        $opr->close();
    }
    return $messages;
}


function getMessageSince($since) {

    $message_since = 0;

    if ($since > 60 * 60) { // an hour
        $hrs = floor($since/3600);
        $mins = ($since % 3600) % 60;
        $message_since = strval($hrs) . 'h ' . strval($mins) . 'm';
    }
    else if ($since > 60 * 60 * 24) { // a day
        $days = floor($since/(3600*24));
        $message_since = strval($days);
    }
    else {
        $mins = $since % 60;
        $message_since = strval($mins) . 'm';
    }

    return $message_since;
}

?>

