<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Fetch Role By Id
if (isset($_GET["getRoleById"])) {
    if (isset($_GET["roleid"])) {
        $result = getRoleById($_GET['roleid']); // returns array of roles
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Create New Role
if (isset($_POST["createNewRole"])) {
    
    // capture the variables            // print_r($_POST);
    $role_name = $_POST['role_name'];
    $role_description = $_POST['role_description'];
    $read = isset($_POST['check_read']) ? 1 : 0;
    $create = isset($_POST['check_create']) ? 1 : 0;
    $edit = isset($_POST['check_edit']) ? 1 : 0;
    $delete = isset($_POST['check_delete']) ? 1 : 0;
    $page_access_level = ($delete << 3) | ($edit << 2) | ($create << 1) | $read;
    
    $id = createNewRole($role_name, $role_description, $page_access_level);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New role successfully created.', 'id' => $id );
    }
    else {
        $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    }

    echo json_encode($result);
}

// Update Role
if (isset($_POST["updateRole"]) && isset($_POST["role_id"])) {

    // capture the variables  // print_r($_POST);
    $role_id = $_POST['role_id'];
    $role_name = $_POST['role_name'];
    $role_description = $_POST['role_description'];
    $read = isset($_POST['check_read']) ? 1 : 0;
    $create = isset($_POST['check_create']) ? 1 : 0;
    $edit = isset($_POST['check_edit']) ? 1 : 0;
    $delete = isset($_POST['check_delete']) ? 1 : 0;
    $page_access_level = ($delete << 3) | ($edit << 2) | ($create << 1) | $read;
    
    $success = updateRole($role_id, $role_name, $role_description, $page_access_level);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Role successfully updated.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update role.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Delete Role
if (isset($_POST["deleteRole"]) && isset($_POST["roleid"])) {

    // capture the variables  print_r($_POST);
    $role_id = $_POST['roleid'];

    $success = deleteRole($role_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Role successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update role.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


?>