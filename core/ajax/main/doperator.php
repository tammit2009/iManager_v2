<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Create/Edit Doperator
if (isset($_POST["manageDoperator"])) {
    // print_r($_POST); 

    $id = saveDoperator($_POST);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'Domain Operator successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Domain Operator paramaters already exist.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to insert domain operator into the db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }
    
    echo json_encode($result);
}

$action = isset($_GET['action']) ? $_GET['action'] : '';  

// Delete Domain Operator
if (($action === 'delete_doperator') && isset($_POST["doperatorid"])) {
    // print_r($_POST);

    $doperator_id = $_POST['doperatorid'];

    $success = deleteDoperator($doperator_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Domain operator successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update domain operator.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


?>