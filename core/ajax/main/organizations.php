<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Get all Organizations
if (isset($_POST["get_all_organizations"])) {
    echo json_encode(getAllOrganizations());
}

// Get Vendor Domain
if (isset($_POST["get_domain_by_organization"]) && isset($_POST["organizationid"])) {
    echo json_encode(getDomainByOrganizationId($_POST["organizationid"]));
}

// Fetch Organization By Id
if (isset($_POST["get_organization_by_id"])) {
    // print_r($_POST);
    if (isset($_POST["organizationid"])) {
        $result = getOrganizationByIdV2($_POST['organizationid']); // returns organization as an associative array
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Get all Vendors from Organization
if (isset($_POST["get_all_vendors"])) {
    echo json_encode(getAllVendors());
}

// Get Vendor Domain
if (isset($_POST["get_vendor_domain"]) && isset($_POST["vendorid"])) {
    echo json_encode(getVendorDomain($_POST["vendorid"]));
}

// Create/Edit Organization
if (isset($_POST["manageOrganization"])) {
    // print_r($_POST); 

    $id = saveOrganization($_POST);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'Organization successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Organization name has already been used.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to insert organization into the db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }
    
    echo json_encode($result);
}

$action = isset($_GET['action']) ? $_GET['action'] : '';  

// Delete Customer
if (($action === 'delete_organization') && isset($_POST["orgid"])) {

    // print_r($_POST);
    $organization_id = $_POST['orgid'];

    $success = deleteOrganization($organization_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Organization successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete organization.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

?>