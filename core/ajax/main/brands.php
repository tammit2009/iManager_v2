<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Fetch Brand By Id
if (isset($_GET["getBrandById"])) {
    if (isset($_GET["brandid"])) {
        $result = getBrandById($_GET['brandid']); // returns array of brands
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Create New Brand
if (isset($_POST["createNewBrand"])) {
    // print_r($_POST);

    $brand_name = $_POST['brand_name'];
    $catalog_symbol = $_POST['brand_catalog_symbol'];
    
    $id = createNewBrand($brand_name, $catalog_symbol);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New role successfully created.', 'id' => $id );
    }
    else {
        switch($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Brand name already exists..' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Catalog symbol already exists.' );
                break; 
            default: 
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Update Brand
if (isset($_POST["updateBrand"]) && isset($_POST["edit_brand_id"])) {
    // print_r($_POST);

    $brand_id = $_POST['edit_brand_id'];
    $brand_name = $_POST['edit_brand_name'];
    $brand_catalog_symbol = $_POST['edit_brand_catalog_symbol'];

    $success = updateBrand($brand_id, $brand_name, $brand_catalog_symbol);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Brand successfully updated.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Brand name already exists.' );
        }
        else if ($success === -3) {
            $result = array( 'code' => 3, 'message' => 'Catalog symbol already exists.' );
        }
        else if ($success === -4) {
            $result = array( 'code' => 4, 'message' => 'Unable to update brand.' );
        }
        else {
            $result = array( 'code' => 5, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Delete Brand
if (isset($_POST["deleteBrand"]) && isset($_POST["brandid"])) {
    // print_r($_POST);

    $brand_id = $_POST['brandid'];

    $success = deleteBrand($brand_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Brand successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update brand.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


?>