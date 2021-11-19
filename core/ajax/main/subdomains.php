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

// Update Subdomain
if (isset($_POST["updateSubDomain"]) && isset($_POST["domain_id"]) && isset($_POST["subdom_id"])) {

    // capture the variables  // print_r($_POST);
    $domain_id = $_POST['domain_id'];
    $subdom_id = $_POST['subdom_id'];
    $subdom_name = $_POST['subdom_name'];
    $subdom_descr = $_POST['subdom_descr'];
    
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
if (isset($_POST["deleteSubDomain"]) && isset($_POST["domainid"]) && isset($_POST["subdomid"])) {

    // capture the variables  // print_r($_POST);
    $domain_id = $_POST['domainid'];
    $subdom_id = $_POST['subdomid'];

    $success = deleteSubdomain($domain_id, $subdom_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Subdomain successfully deleted.', 'domainid' => $domain_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'domainid' => $domain_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete subdomain.', 'domainid' => $domain_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'domainid' => $domain_id );
        }
    }

    echo json_encode($result);
}

?>