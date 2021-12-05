<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Get all Vendors
if (isset($_POST["get_all_vendors"])) {
    echo json_encode(getAllVendors());
}

// Get Vendor by Id
if (isset($_POST["get_vendor_by_id"]) && isset($_POST['vendorid'])) {
    echo json_encode(getVendorById($_POST['vendorid']));
}

// Create/Edit Vendor
if (isset($_POST["manageVendor"])) {
    // print_r($_POST); 

    $id = saveVendor($_POST);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'Vendor successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Vendor name has already been used.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to insert vendor into the db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }
    
    echo json_encode($result);
}


$action = isset($_GET['action']) ? $_GET['action'] : '';  


// Delete Vendor
if (($action === 'delete_vendor') && isset($_POST["vendorid"])) {

    // print_r($_POST);
    $vendor_id = $_POST['vendorid'];

    $success = deleteVendor($vendor_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Vendor successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update vendor.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}
