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

    // TODO: validate the inputs

    // Clean and assign the inputs
    $email = htmlspecialchars(strip_tags($data->email));
    $password = htmlspecialchars(strip_tags($data->password));

    // lookup the user by email and verify the password
    $result = $user->read_single_by_email( $email );

    if($result && $result->num_rows === 1) {
        $row = mysqli_fetch_assoc($result);
        $user_arr = array (
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $row['password'],
            'groupid' => $row['groupid'],
            'verified' => $row['verified'],
            'avatar' => $row['avatar'],
            'createdOn' => $row['created_on']
        );

        // Ensure the user is activated - else exit
        if ($user_arr['verified'] === 0) {
            http_response_code(403);
            die ( json_encode(array('message' => 'This user may be deactivated. Please contact the admin..')) );
        }

        // Decode and check that passwords match - else exit
        if (!password_verify($password, $user_arr['password'])) {
            http_response_code(403);
            die ( json_encode(array('message' => 'Invalid username or password.')) );
        } 

        // Generate a JWT and send this as a response with user information 
        // for the client to add to its header
        $token = generateJWToken( $user_arr['id'] );
        $data = [ 'user' => $user_arr, 'token' => $token ];     // print_r($data); 
        http_response_code(201);
        echo json_encode($data);
    }
    else {
        // user not found
        http_response_code(404);
        echo json_encode(array(
            'message' => 'User not found.'
        ));
    }
}
else {
    // Could not connect to db
    http_response_code(500);
    echo json_encode(array(
        'message' => 'Server error.'
    ));
}

?>