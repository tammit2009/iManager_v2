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

    // Experiment with path_info: Sending "localhost/imanager/api/users/read_single.php/1/22/hello"
    // $path = $_SERVER['PATH_INFO']; //echo "PATH_INFO:" . $path;
    // if ($path != null) {
    //     $path_params = explode("/", $path);
    //     print_r($path_params);
    // }
    // Check all query strings
    // echo $_SERVER['QUERY_STRING'];
    // Note: these are all not quite needed in our case, as we will be using re-write rules 
    //       into '.../read_single.php?id=1&topic=22&msg=hello' for example

    // Check for id query parameter
    $user->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(array('message' => 'User not found.')));

    $result = $user->read_single( $user->id );

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
        // make a json
        print_r(json_encode($user_arr));
    }
    else {
        // user not found
        echo json_encode(array(
            'message' => 'User not found.'
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