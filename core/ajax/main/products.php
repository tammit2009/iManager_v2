<?php 
include_once('../../security.php');
include_once('db_functions.php');

// upload products csv
if (isset($_POST["uploadProductsCsv"])) {

    // print_r($_POST);
    // print_r($_FILES);
    
    $file_data = fopen($_FILES['product_csv']['tmp_name'], 'r');
    $column = fgetcsv($file_data);  // First row is the header (Note: fgetcsv converts csv to php array)

    $row_data = [];

    while ($row = fgetcsv($file_data)) {
        $row_data[] = array(
            'student_name'  => $row[0],
            'student_phone' => $row[1]
        );
    }

    // Validate the data is in the correct format
    $valid = validateProductCsv($column, $row_data);

    if ($valid) {
        $output = array(
            'code' => 0,
            'column'  => $column,
            'row_data' => $row_data
        );
    }
    else {
        $output = array(
            'code' => 1,
            'message'  => 'Invalid CSV Fields'
        );
    }

    // print_r($output);

    echo json_encode($output);
}

// Ensure the csv data is valid
function validateProductCsv($column, $row_data) {
    // TODO: perform the validation on finalization of the product csv format.
    return true;
}

// import products csv
if (isset($_POST["importProductCsv"])) {

    // print_r($_POST);

    $student_name = $_POST["student_name"];
    $student_phone = $_POST["student_phone"];
    
    $id = batchAddProducts($student_name, $student_phone);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New products successfully created.' );
    }
    else {
        $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    }

    echo json_encode($result);
}



?>