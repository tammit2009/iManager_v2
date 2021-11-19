<?php 
include_once('../../security.php');
include_once('db_functions.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';    

// Create New User
if (isset($_POST["manageUser"])) {
    
    if ($action === 'manage_user') {
        // Not used.
    }
    
    // View the variables // print_r($_POST); // print_r($_FILES);

    $id = saveUser($_POST, $_FILES);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'User successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Email already exists.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to insert user into the db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }
    
    echo json_encode($result);
}

// Delete a User
if ($action === 'delete_user') {
    // View the variables // print_r($_POST);

    $id = isset($_POST['id']) ? $_POST['id'] : false;
    if ($id) {
        $res = deleteUser($id);
        if ($res === 0) {
            $result = array( 'code' => 0, 'message' => 'User successfully deleted.' );
        }
        else {
            if ($res === -1) {
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
            }
            else if ($res === -2) {
                $result = array( 'code' => 2, 'message' => 'Unable to delete user.' );
            }
            else {
                $result = array( 'code' => 3, 'message' => 'Unknown error.' );
            }
        }
    }
    else {
        $result = array( 'code' => 4, 'message' => 'Invalid ID' );
    }

    echo json_encode($result);
}

?>