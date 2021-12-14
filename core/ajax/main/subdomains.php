<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Fetch Subdomain By Id
if (isset($_GET["getSubDomById"])) {
    if (isset($_GET["domainid"]) && isset($_GET["subdomid"])) {
        $result = getSubDomById($_GET['domainid'], $_GET['subdomid']); 
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Fetch Subdomains By domainId
if (isset($_POST["get_subdoms_by_domain"])) {
    if (isset($_POST["domainid"])) {
        $result = getSubDomsByDomainId2($_POST['domainid']);  
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Add a Subdomain to a Domain
if (isset($_POST["addSubDomToDomain"])) {
    
    // capture the variables // print_r($_POST);
    $domainId = $_POST['domainId'];
    $subDomName = $_POST['targetSubDomName'];
    $subDomDescr = $_POST['targetSubDomDescr'];
    
    $res = addSubDomToDomain($domainId, $subDomName, $subDomDescr);
    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'New subdomain successfully added.', 'domainid' => $domainId );
    }
    else {
        if ($res == -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to insert new role.', 'domainid' => $domainId);
        }
        else if ($res == -2) {
            $result = array( 'code' => 2, 'message' => 'Failed to connect to database.', 'domainid' => $domainId );
        }
        else {
            $result = array( 'code' => 2, 'message' => 'Unknown error.', 'domainid' => $domainId );
        }
    }

    echo json_encode($result);
}

// Create Subdomain (standalone)
if (isset($_POST["createSubdomain"])) {
    // print_r($_POST);

    $domainId = $_POST['domain'];
    $subDomName = $_POST['subdom_name'];
    // $subDomType = $_POST['subdom_type'];
    $subDomDescr = $_POST['subdom_description'];
    
    $res = addSubDomToDomain($domainId, $subDomName, $subDomDescr);
    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'New subdomain successfully added.', 'domainid' => $domainId );
    }
    else {
        if ($res == -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to insert new role.', 'domainid' => $domainId);
        }
        else if ($res == -2) {
            $result = array( 'code' => 2, 'message' => 'Failed to connect to database.', 'domainid' => $domainId );
        }
        else {
            $result = array( 'code' => 2, 'message' => 'Unknown error.', 'domainid' => $domainId );
        }
    }

    echo json_encode($result);
}

// Update Subdomain
if (isset($_POST["updateSubDomain"]) && isset($_POST["domain_id"]) && isset($_POST["subdom_id"])) {

    // capture the variables  // print_r($_POST);
    $domain_id = $_POST['domain_id'];
    $subdom_id = $_POST['subdom_id'];
    $subdom_name = $_POST['subdom_name'];
    $subdom_descr = $_POST['subdom_description'];
    
    $success = updateSubDomain($domain_id, $subdom_id, $subdom_name, $subdom_descr);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Subdomain successfully updated.', 'domainid' => $domain_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'domainid' => $domain_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update subdomain.', 'domainid' => $domain_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'domainid' => $domain_id );
        }
    }

    echo json_encode($result);
}

// Update Subdomain (standalone)
if (isset($_POST["updateSubDomainV2"]) && isset($_POST["domain_id"]) && isset($_POST["subdom_id"])) {
    // print_r($_POST);

    $domain_id = $_POST['domain_id'];
    $subdom_id = $_POST['subdom_id'];
    $subdom_name = $_POST['subdom_name'];
    $subdom_descr = $_POST['subdom_description'];
    
    $success = updateSubDomain($domain_id, $subdom_id, $subdom_name, $subdom_descr);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Subdomain successfully updated.', 'domainid' => $domain_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'domainid' => $domain_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update subdomain.', 'domainid' => $domain_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'domainid' => $domain_id );
        }
    }

    echo json_encode($result);
}

// Delete Subdomain
if (isset($_POST["deleteSubDomain"]) && isset($_POST["subdomid"])) {
    // print_r($_POST);

    // $domain_id = $_POST['domainid'];
    $subdom_id = $_POST['subdomid'];

    $success = deleteSubdomain($subdom_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Subdomain successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete subdomain.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


// Create Store Unit 
if (isset($_POST["createStoreUnit"])) {
    // print_r($_POST);

    $storeunitName = $_POST['storeunit_name'];
    // $organizationId = $_POST['organization_id'];
    $domainId = $_POST['domain_id'];
    $subdomName = $_POST['subdom_name'];
    $subdomType = $_POST['subdom_type'];
    $subdomDescr = $_POST['subdom_description'];
    
    $res = createStoreUnit($storeunitName, $domainId, $subdomName, $subdomType, $subdomDescr);

    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'New subdomain successfully added.', 'domainid' => $domainId );
    }
    else {
        if ($res == -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to insert new role.');
        }
        else if ($res == -2) {
            $result = array( 'code' => 2, 'message' => 'Failed to connect to database.' );
        }
        else if ($res == -3) {
            $result = array( 'code' => 3, 'message' => 'Subdomain name already exists.' );
        }
        else if ($res == -4) {
            $result = array( 'code' => 4, 'message' => 'StoreUnit name already exists.');
        }
        else {
            $result = array( 'code' => 5, 'message' => 'Unknown error.');
        }
    }

    echo json_encode($result);
}

?>