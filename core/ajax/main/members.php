<?php 
include_once('../../security.php');
include_once('db_functions.php');

// // Fetch Role By Id
// if (isset($_GET["getRoleById"])) {
//     if (isset($_GET["roleid"])) {
//         $result = getRoleById($_GET['roleid']); // returns array of roles
//         echo json_encode($result);
//     }
//     else {
//         echo json_encode(array());  // return empty
//     }
// }

// Create/Edit Member
if (isset($_POST["manageMember"])) {
    // print_r($_POST); 

    $id = saveMember($_POST);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'Member successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Member name has already been used.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to insert member into the db.' );
                break;
            case -3: 
                $result = array( 'code' => 4, 'message' => 'Organization has no associated domain.' );
                break;
            case -3: 
                $result = array( 'code' => 5, 'message' => 'Domain has no default subdomain.' );
                break;
            default:
                $result = array( 'code' => 6, 'message' => 'Unknown error.' );
        }
    }
    
    echo json_encode($result);
}

$action = isset($_GET['action']) ? $_GET['action'] : '';  

// Delete Member
if (($action === 'delete_member') && isset($_POST["memberid"])) {

    // print_r($_POST);
    $member_id = $_POST['memberid'];

    $success = deleteMember($member_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Member successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update member.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


?>