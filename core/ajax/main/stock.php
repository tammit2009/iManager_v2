<?php 
include_once('../../security.php');
include_once('db_functions.php');

// create SKU
if (isset($_POST["createSKU"])) {
    
    // print_r($_POST);

    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $package = $_POST['package'];
    $number = $_POST['number'];

    $sku = createSKU($brand, $category, $package, $number);

    // if ($id > 0) {
    //     $result = array( 'code' => 0, 'message' => 'SKU successfully created.', 'sku' => $sku );
    // }
    // else {
    //     $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    // }

    $result = array( 'code' => 0, 'message' => 'SKU successfully created.', 'sku' => $sku );

    echo json_encode($result);
}