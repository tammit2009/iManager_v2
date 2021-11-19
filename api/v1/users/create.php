<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initializing our api
include_once('../../../core/initialize.php');

$opr = new DBOperation();
if ($opr->dbConnected()) {

    // instantiate user
    $user = new User($opr);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // TODO: validate the jwt
    // $userId = validateJWToken();

    // TODO: validate the inputs

    // Clean and assign the inputs
    $user->name = htmlspecialchars(strip_tags($data->name));
    $user->email = htmlspecialchars(strip_tags($data->email));
    $user->password = htmlspecialchars(strip_tags($data->password));
    if (isset($data->avatar) && !empty($data->avatar)) {
        $user->avatar = htmlspecialchars(strip_tags($data->avatar));
    }

    // create user
    $id = $user->create($user->name, $user->email, $user->password);
    if ($id > 0) {
        http_response_code(201);    // Set HTTP response status code to: 201 (as a test)

        echo json_encode(
            array('message' => 'User created with id: '. $id .'.' )
        );
    }
    else if ($id == -2) {
        http_response_code(409);    // conflict
        echo json_encode(
            array('message' => 'User Not Created, email already exists.')
        ); 
    }
    if ($id == -1) {
        http_response_code(401);
        echo json_encode(
            array('message' => 'User Not Created.')
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