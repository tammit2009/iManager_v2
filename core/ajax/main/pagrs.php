<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Fetch Pagr By Id
if (isset($_GET["getPagrById"])) {
    if (isset($_GET["pagrid"])) {
        $result = getPagrById($_GET['pagrid']); // returns array of pagr
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Fetch Pagr Role By Id
if (isset($_GET["getPagrRoleById"])) {
    if (isset($_GET["pagrid"]) && isset($_GET["roleid"])) {
        $result = getPagrRoleById($_GET['pagrid'], $_GET['roleid']); // returns array of pagr roles items
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Create New Role
if (isset($_POST["createNewPagr"])) {
    
    // capture the variables            // print_r($_POST);
    $pagr_label = $_POST['pagr_label'];
    $pagr_description = $_POST['pagr_description'];
    
    $id = createNewPagr($pagr_label, $pagr_description);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New pagr successfully created.', 'id' => $id );
    }
    else {
        $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    }

    echo json_encode($result);
}

// Add a Role to a Pagr
if (isset($_POST["addRoleToPagr"])) {
    
    // capture the variables //print_r($_POST);
    $pagrId = $_POST['pagrId'];
    $roleId = $_POST['targetPagrRoleId'];
    $pagrRoleLabel = $_POST['targetPagrRoleLabel'];
    $pagrRoleDescr = $_POST['targetPagrRoleDescr'];
    
    $res = addRoleToPagr($groupId, $roleId, $pagrRoleLabel, $pagrRoleDescr);
    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Role successfully added.', 'pagrid' => $pagrId );
    }
    else {
        if ($res == -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to insert new role.', 'pagrid' => $pagrId );
        }
        else {
            $result = array( 'code' => 2, 'message' => 'Failed to connect to database.', 'pagrid' => $pagrId );
        }
    }

    echo json_encode($result);
}

// Update Pagr
if (isset($_POST["updatePagr"]) && isset($_POST["pagr_id"])) {

    // capture the variables  // print_r($_POST);
    $pagr_id = $_POST['pagr_id'];
    $pagr_label = $_POST['pagr_label'];
    $pagr_description = $_POST['pagr_description'];
    
    $success = updatePagr($pagr_id, $pagr_label, $pagr_description);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Pagr successfully updated.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update pagr.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Update Pagr Role
if (isset($_POST["updatePagrRole"]) && isset($_POST["pagr_id"]) && isset($_POST["role_id"])) {

    // capture the variables  //print_r($_POST);
    $pagr_id = $_POST['pagr_id'];
    $role_id = $_POST['role_id'];
    $pagr_role_label = $_POST['pagr_role_label'];
    $pagr_role_descr = $_POST['pagr_role_descr'];
    
    $success = updatePagrRole($pagr_id, $role_id, $pagr_role_label, $pagr_role_descr);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'PAGR successfully updated.', 'pagrid' => $pagr_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'pagrid' => $pagr_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update group.', 'pagrid' => $pagr_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'pagrid' => $pagr_id );
        }
    }

    echo json_encode($result);
}

// Delete Role
if (isset($_POST["deletePagr"]) && isset($_POST["pagrid"])) {

    // capture the variables  print_r($_POST);
    $pagr_id = $_POST['pagrid'];

    $success = deletePagr($pagr_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Pagr successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update pagr.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Delete Pagr Role
if (isset($_POST["deletePagrRole"]) && isset($_POST["pagrid"]) && isset($_POST["roleid"])) {

    // capture the variables  print_r($_POST);
    $pagr_id = $_POST['pagrid'];
    $role_id = $_POST['roleid'];

    $success = deletePagrRole($pagr_id, $role_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Role successfully deleted from PAGR.', 'pagrid' => $pagr_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'pagrid' => $pagr_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete role from PAGR.', 'pagrid' => $pagr_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'pagrid' => $pagr_id );
        }
    }

    echo json_encode($result);
}

?>