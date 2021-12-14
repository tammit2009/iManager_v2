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

// Get Next Valid SKU
if (isset($_POST["getNextSKU"])) {
    // print_r($_POST);

    $productName = $_POST['productname'];
    $brandName = $_POST['brandname'];
    $categoryName = $_POST['categoryname'];
    $pkgunitName = $_POST['pkgunitname'];
    $pkglotName = $_POST['pkglotname'];

    $sku = getNextSKU($productName, $brandName, $categoryName, $pkgunitName, $pkglotName);

    if ($sku !== 'NULL') {
        $result = array( 'code' => 0, 'message' => 'SKU successfully created.', 'sku' => $sku );
    }
    else {
        $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    }

    echo json_encode($result);
}