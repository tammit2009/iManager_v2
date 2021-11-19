<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // TODO: validate the inputs

    // Clean and assign the inputs
    $user->id = htmlspecialchars(strip_tags($data->id));
    $user->name = htmlspecialchars(strip_tags($data->name));
    $user->email = htmlspecialchars(strip_tags($data->email));
    $user->password = htmlspecialchars(strip_tags($data->password));
    $user->groupid = htmlspecialchars(strip_tags($data->groupid));
    $user->verified = htmlspecialchars(strip_tags($data->verified));
    $user->avatar = htmlspecialchars(strip_tags($data->avatar));

    $props = [ 
        'name' => $user->name, 
        'email' => $user->email, 
        'password' => $user->password,
        'groupid' => $user->groupid,
        'verified' => $user->verified,
        'avatar' => $user->avatar
    ];

    // update the user
    if ($user->update($user->id, $props)) {
        echo json_encode(
            array('message' => 'User updated.')
        );
    }
    else {
        http_response_code(401);
        echo json_encode(
            array('message' => 'User Not Updated.')
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