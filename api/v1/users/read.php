<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

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

    // user query
    $result = $user->read();

    // get the row count
    $num = $result->num_rows; //echo "user count: ". $num;
    if ($num > 0) {
        $user_arr = array();
        $user_arr['data'] = array();

        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            $user_item = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,          // html_entity_decode($..),
                'password' => $password,
                'groupid' => $groupid,
                'verified' => $verified,
                'avatar' => $avatar,
                'createdOn' => $created_on
            );
            array_push($user_arr['data'], $user_item);
        }
        // convert to json and output
        echo json_encode($user_arr);
    }
    else {
        echo json_encode(array(
            'message' => 'No posts found.'
        ));
    }
}
else {
    // Could not connect to db
    echo json_encode(array(
        'message' => 'Server error.'
    ));
}

?>