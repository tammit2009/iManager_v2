<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initializing our api
include_once('../../../core/initialize.php');


$opr = new DBOperation();
if ($opr->dbConnected()) {

    // Validate the jwt
    $userId = validateJWToken();
    if ($userId === -1) {
        http_response_code(403);
        die ( json_encode(array('message' => 'Access Token is not valid..')) );
    }

    if ($userId === -2) {
        http_response_code(403);
        die ( json_encode(array('message' => 'This user may be deactived.')) );
    }

    if ($userId === -3) {
        http_response_code(403);
        die ( json_encode(array('message' => 'User not found.')) );
    }

    if ($userId === -4) {
        http_response_code(500);
        die ( json_encode(array('message' => 'Server Error.')) );
    }

    // instantiate user
    $user = new User($opr);

    // get raw posted data (for id sent in body)
    // $data = json_decode(file_get_contents("php://input"));
    // $user->id = $data->id;

    // for id sent as part of the url
    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    // delete user
    $deletedId = $user->delete( $user->id );
    echo $deletedId;

    if ($deletedId > 0) {
        echo json_encode(
            array('message' => 'User Deleted.')
        );
    }
    else if ($deletedId == -2) {
        http_response_code(401);
        echo json_encode(
            array('message' => 'User does Not exist.')
        ); 
    }
    else { // generalize for -1
        http_response_code(401);
        echo json_encode(
            array('message' => 'User Not Deleted.')
        ); 
    }
}
else {
    // Could not connect to db
    echo json_encode(array(
        'message' => 'Server error.'
    ));    
}

?>