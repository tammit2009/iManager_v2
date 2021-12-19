<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Get all Domains
if (isset($_POST["get_all_domains"])) {
    echo json_encode(getAllDomains());
}

// Get all Vendor Domains
if (isset($_POST["get_all_vendor_domains"])) {
    echo json_encode(getAllVendorDomains());
}

// Get Domain By Id
if (isset($_POST["get_domain_by_id"]) && isset($_POST["domainid"])) {
    echo json_encode(getDomainById($_POST["domainid"]));
}

// Fetch Domain By Id
if (isset($_GET["getDomainById"])) {
    if (isset($_GET["domainid"])) {
        $result = getDomainById($_GET['domainid']); // returns domain as an associative array
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Create New Domain
if (isset($_POST["createNewDomain"])) {
    
    // capture the variables // print_r($_POST);
    $domain_name = $_POST['domain_name'];
    $domain_description = $_POST['domain_description'];
    
    $id = createNewDomain($domain_name, $domain_description);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New Domain successfully created.', 'id' => $id );
    }
    else {
        switch($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Unable to create default subdomain.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Domain name already used.' );
                break; 
            default: 
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Update Domain
if (isset($_POST["updateDomain"]) && isset($_POST["domain_id"])) {

    // capture the variables  // print_r($_POST);
    $domain_id = $_POST['domain_id'];
    $domain_name = $_POST['domain_name'];
    $domain_description = $_POST['domain_description'];
    
    $success = updateDomain($domain_id, $domain_name, $domain_description);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Domain successfully updated.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update domain.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Delete Domain
if (isset($_POST["deleteDomain"]) && isset($_POST["domainid"])) {

    // capture the variables  print_r($_POST);
    $domain_id = $_POST['domainid'];

    $success = deleteDomain($domain_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Domain successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete group.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

?>