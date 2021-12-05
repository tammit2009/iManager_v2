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

// Create/Edit Customer
if (isset($_POST["manageCustomer"])) {
    // print_r($_POST); 

    $id = saveCustomer($_POST);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'Customer successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Customer name has already been used.' );
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

$action = isset($_GET['action']) ? $_GET['action'] : '';  

// Delete Customer
if (($action === 'delete_customer') && isset($_POST["customerid"])) {

    // print_r($_POST);
    $customer_id = $_POST['customerid'];

    $success = deleteCustomer($customer_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Customer successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update customer.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


?>