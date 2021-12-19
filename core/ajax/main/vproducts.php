<?php 
include_once('../../security.php');
include_once('db_functions.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';   

// Fetch Vendor Product By Id
if (isset($_GET["getVendorProductById"])) {
    if (isset($_GET["vprodid"])) {
        $result = getVendorProductById($_GET['vprodid']); 
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// upload products csv
if (isset($_POST["uploadVProductsCsv"])) {

    // print_r($_POST);
    // print_r($_FILES);
    
    $file_data = fopen($_FILES['vproduct_csv']['tmp_name'], 'r');
    $column = fgetcsv($file_data);  // First row is the header (Note: fgetcsv converts csv to php array)

    $row_data = [];

    while ($row = fgetcsv($file_data)) {
        $row_data[] = array(
            'brand'                 => $row[0],
            'category'              => $row[1],
            'product_name_descr'    => $row[2],
            'feature'               => $row[3],
            'unit'                  => $row[4],
            'lot'                   => $row[5],
            'qty_per_offer'         => $row[6],
            'offer_price'           => $row[7],
        );
    }

    // Validate the data is in the correct format
    $valid = validateVProductCsv($column, $row_data);

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
function validateVProductCsv($column, $row_data) {
    // TODO: perform the validation on finalization of the product csv format.
    return true;
}

// import products csv
if (isset($_POST["importVProductCsv"])) {

    // print_r($_POST);

    // variables
    $vendor_id          = $_POST['vendor_id'];
    $subdom_id          = $_POST['subdom_id'];
    $domain_id          = $_POST['domain_id'];

    // arrays
    $brand              = $_POST["brand"];
    $category           = $_POST["category"];
    $product_name_descr = $_POST["product_name_descr"];
    $feature            = $_POST["feature"];
    $unit               = $_POST["unit"];
    $lot                = $_POST["lot"];
    $qty_per_offer      = $_POST["qty_per_offer"];
    $offer_price        = $_POST["offer_price"];
    
    $id = batchAddVProducts($vendor_id, $subdom_id, $domain_id, $brand, $category, $product_name_descr, 
                            $feature, $unit, $lot, $qty_per_offer, $offer_price);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New products successfully created.' );
    }
    else {
        $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    }

    echo json_encode($result);
}

// Is the product name valid
if (isset($_POST["isProductNameValid"])) {
    // if (isset($_POST["productname"])) {
    //     $result = isProductNameValid($_POST["productname"]); 
    //     echo $result; exit;
    // }
    // echo 0; exit;

    if (isset($_POST["productname"])) {
        $product = isProductNameValid($_POST["productname"]); 
        if ($product > 0) {
            $result = array( 'code' => 0, 'message' => 'Product is valid.', 'productid' => $product['id'] );
        }
        else {
            switch($product) {
                case -1: 
                    $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                    break; 
                case -2: 
                    $result = array( 'code' => 2, 'message' => 'Product entry not found.' );
                    break; 

                default: 
                    $result = array( 'code' => 4, 'message' => 'Unknown error.' );
            }
        }    
    }
    else {
        $result = array( 'code' => 3, 'message' => 'Product name parameter missing.' );
    }

    echo json_encode($result);
}


// Is the brand name valid
if (isset($_POST["isBrandNameValid"])) {
    if (isset($_POST["brandname"])) {
        $brand = isBrandNameValid($_POST["brandname"]); 
        if ($brand > 0) {
            $result = array( 'code' => 0, 'message' => 'Brand is valid.', 'brandid' => $brand['id'] );
        }
        else {
            switch($brand) {
                case -1: 
                    $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                    break; 
                case -2: 
                    $result = array( 'code' => 2, 'message' => 'Brand entry not found.' );
                    break; 

                default: 
                    $result = array( 'code' => 4, 'message' => 'Unknown error.' );
            }
        }    
    }
    else {
        $result = array( 'code' => 3, 'message' => 'Brand name parameter missing.' );
    }

    echo json_encode($result);
}

// Is the category name valid
if (isset($_POST["isCategoryNameValid"])) {
    // if (isset($_POST["categoryname"])) {
    //     $result = isCategoryNameValid($_POST["categoryname"]); 
    //     echo $result; exit;
    // }
    // echo 0; exit;

    if (isset($_POST["categoryname"])) {
        $category = isCategoryNameValid($_POST["categoryname"]); 
        if ($category > 0) {
            $result = array( 'code' => 0, 'message' => 'Category is valid.', 'categoryid' => $category['id'] );
        }
        else {
            switch($category) {
                case -1: 
                    $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                    break; 
                case -2: 
                    $result = array( 'code' => 2, 'message' => 'Category entry not found.' );
                    break; 

                default: 
                    $result = array( 'code' => 4, 'message' => 'Unknown error.' );
            }
        }    
    }
    else {
        $result = array( 'code' => 3, 'message' => 'Category name parameter missing.' );
    }

    echo json_encode($result);
}

// // Is the product short descr valid
// if (isset($_POST["isProductShortDescrValid"])) {
//     if (isset($_POST["productshortdescr"])) {
//         $result = isProductShortDescrValid($_POST["productshortdescr"]); 
//         echo $result; exit;
//     }
//     echo 0; exit;
// }

// Is the package unit valid
if (isset($_POST["isPkgUnitValid"])) {
    // if (isset($_POST["pkgunit"])) {
    //     $result = isPackageUnitValid($_POST["pkgunit"]); 
    //     echo $result; exit;
    // }
    // echo 0; exit;

    if (isset($_POST["pkgunit"])) {
        $pkgunit = isPackageUnitValid($_POST["pkgunit"]); 
        if ($pkgunit > 0) {
            $result = array( 'code' => 0, 'message' => 'Package unit is valid.', 'pkgunitid' => $pkgunit['id'] );
        }
        else {
            switch($pkgunit) {
                case -1: 
                    $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                    break; 
                case -2: 
                    $result = array( 'code' => 2, 'message' => 'Package unit entry not found.' );
                    break; 

                default: 
                    $result = array( 'code' => 4, 'message' => 'Unknown error.' );
            }
        }    
    }
    else {
        $result = array( 'code' => 3, 'message' => 'Package unit name parameter missing.' );
    }

    echo json_encode($result);
}

// Is the package lot valid
if (isset($_POST["isPkgLotValid"])) {
    // if (isset($_POST["pkglot"])) {
    //     $result = isPackageLotValid($_POST["pkglot"]); 
    //     echo $result; exit;
    // }
    // echo 0; exit;

    if (isset($_POST["pkglot"])) {
        $pkglot = isPackageLotValid($_POST["pkglot"]); 
        if ($pkglot > 0) {
            $result = array( 'code' => 0, 'message' => 'Package lot is valid.', 'pkglotid' => $pkglot['id'] );
        }
        else {
            switch($pkglot) {
                case -1: 
                    $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                    break; 
                case -2: 
                    $result = array( 'code' => 2, 'message' => 'Package lot entry not found.' );
                    break; 

                default: 
                    $result = array( 'code' => 4, 'message' => 'Unknown error.' );
            }
        }    
    }
    else {
        $result = array( 'code' => 3, 'message' => 'Package lot name parameter missing.' );
    }

    echo json_encode($result);
}

// Is the sku exist
if (isset($_POST["isSkuValid"])) {
    if (isset($_POST["sku"])) {
        $sku = isSkuValid($_POST["sku"]); 
        if ($sku > 0) {
            $result = array( 'code' => 0, 'message' => 'SKU is valid.', 'sku' => $sku['sku'] );
        }
        else {
            switch($sku) {
                case -1: 
                    $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                    break; 
                case -2: 
                    $result = array( 'code' => 2, 'message' => 'SKU entry not found.' );
                    break; 

                default: 
                    $result = array( 'code' => 4, 'message' => 'Unknown error.' );
            }
        }    
    }
    else {
        $result = array( 'code' => 3, 'message' => 'SKU parameter missing.' );
    }

    echo json_encode($result);
}

// Is the sku valid
if (isset($_POST["isSkuFormatValid"])) {
    if (isset($_POST["sku"])) {
        $valid = isSkuFormatValid($_POST["sku"]); 
        if ($valid == 1) {
            $result = array( 'code' => 0, 'message' => 'SKU Format is valid.' );
        }
        else {
            $result = array( 'code' => 1, 'message' => 'SKU Format is not valid.' );
        }
    }
    else {
        $result = array( 'code' => 2, 'message' => 'Missing input parameters.' );
    }

    echo json_encode($result);    
}

// Is the vendor product valid
if (isset($_POST["isVendorProductValid"])) {
    if (isset($_POST["productname"]) && isset($_POST["brandname"]) && isset($_POST["categoryname"]) 
            && isset($_POST["pkgunitname"]) && isset($_POST["pkglotname"]) /*&& isset($_POST["sku"])*/) {

        $productName = $_POST["productname"];
        $brandName = $_POST["brandname"];
        $categoryName = $_POST["categoryname"];
        $pkgunitName = $_POST["pkgunitname"];
        $pkglotName = $_POST["pkglotname"];
        // $sku = $_POST["sku"];
        
        $valid = isVendorProductValid($productName, $brandName, $categoryName, $pkgunitName, $pkglotName /*, $sku*/ ); 
        if ($valid) {
            $result = array( 'code' => 0, 'message' => 'Product is valid.' );
        }
        else {
            $result = array( 'code' => 1, 'message' => 'Product is not valid.' );
        }
    }
    else {
        $result = array( 'code' => 2, 'message' => 'Missing input parameters.' );
    }

    echo json_encode($result);
}

// Update Unknown Vendor Product
if (isset($_POST["updateUknVendorProduct"]) && isset($_POST["vproduct_id"])) {

    // print_r($_POST);

    $vproduct_id            = $_POST['vproduct_id'];                    // vproduct_id
    $productname            = $_POST['productname_selection'];          // productname_selection
    $product_id             = $_POST['productname_selection_id'];       // productname_selection_id
    $productdescr           = $_POST['productdescr_selection'];         // productdescr_selection
    $brandname              = $_POST['brand_selection'];                // brand_selection
    $brand_id               = $_POST['brand_selection_id'];             // brand_selection_id
    $categoryname           = $_POST['category_selection'];             // category_selection
    $category_id            = $_POST['category_selection_id'];          // category_selection_id
    $pkgunit                = $_POST['pkgunit_selection'];              // pkgunit_selection
    $pkgunit_id             = $_POST['pkgunit_selection_id'];           // pkgunit_selection_id
    $pkglot                 = $_POST['pkglot_selection'];               // pkglot_selection
    $pkglot_id              = $_POST['pkglot_selection_id'];            // pkglot_selection_id
    $vproduct_prov_sku      = $_POST['vproduct_prov_sku'];              // vproduct_prov_sku
    $vproduct_final_sku     = $_POST['vproduct_final_sku'];             // vproduct_final_sku
    
    $success = updateVendorProductFromUnknown($vproduct_id, $productname, $product_id, $productdescr,
                        $brandname, $brand_id, $categoryname, $category_id, $pkgunit, $pkgunit_id,
                        $pkglot, $pkglot_id, $vproduct_prov_sku, $vproduct_final_sku);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Vendor Product successfully updated.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update Vendor Product.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Create/Edit Vendor Product
if (isset($_POST["manageVendorProduct"])) {
    
    // print_r($_POST); // print_r($_FILES);

    $id = saveVendorProduct($_POST, $_FILES);
    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'Vendor product successfully saved.', 'id' => $id );
    }
    else {
        switch ($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Invalid brand.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Invalid category.' );
                break; 
            case -4: 
                $result = array( 'code' => 4, 'message' => 'Invalid package unit.' );
                break; 
            case -5: 
                $result = array( 'code' => 5, 'message' => 'Invalid package lot.' );
                break; 
            case -6: 
                $result = array( 'code' => 6, 'message' => 'Exception.' );
                break;
            default:
                $result = array( 'code' => 7, 'message' => 'Unknown error.' );
        }
    }
    
    echo json_encode($result);
    exit;
}

// Delete a Vendor Product
if ($action === 'delete_vproduct') {

    // print_r($_POST);

    $id = isset($_POST['id']) ? $_POST['id'] : false;
    if ($id) {
        $res = deleteVendorProduct($id);
        if ($res === 0) {
            $result = array( 'code' => 0, 'message' => 'Vendor product successfully deleted.' );
        }
        else {
            if ($res === -1) {
                $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
            }
            else if ($res === -2) {
                $result = array( 'code' => 2, 'message' => 'Unable to delete vendor product.' );
            }
            else {
                $result = array( 'code' => 3, 'message' => 'Unknown error.' );
            }
        }
    }
    else {
        $result = array( 'code' => 4, 'message' => 'Invalid ID' );
    }

    echo json_encode($result);
}

?>
