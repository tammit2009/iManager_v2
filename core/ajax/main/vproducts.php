<?php 
include_once('../../security.php');
include_once('db_functions.php');

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
    if (isset($_POST["productname"])) {
        $result = isProductNameValid($_POST["productname"]); 
        echo $result; exit;
    }
    echo 0; exit;
}


// Is the brand name valid
if (isset($_POST["isBrandNameValid"])) {
    if (isset($_POST["brandname"])) {
        $result = isBrandNameValid($_POST["brandname"]); 
        echo $result; exit;
    }
    echo 0; exit;
}

// Is the category name valid
if (isset($_POST["isCategoryNameValid"])) {
    if (isset($_POST["categoryname"])) {
        $result = isCategoryNameValid($_POST["categoryname"]); 
        echo $result; exit;
    }
    echo 0; exit;
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
    if (isset($_POST["pkgunit"])) {
        $result = isPackageUnitValid($_POST["pkgunit"]); 
        echo $result; exit;
    }
    echo 0; exit;
}

// Is the package lot valid
if (isset($_POST["isPkgLotValid"])) {
    if (isset($_POST["pkglot"])) {
        $result = isPackageLotValid($_POST["pkglot"]); 
        echo $result; exit;
    }
    echo 0; exit;
}

// Is the sku valid
if (isset($_POST["isSkuFormatValid"])) {
    if (isset($_POST["sku"])) {
        $result = isSkuFormatValid($_POST["sku"]); 
        echo $result; exit;
    }
    echo 0; exit;
}

// Is the sku exist
if (isset($_POST["isSkuValid"])) {
    if (isset($_POST["sku"])) {
        $result = isSkuValid($_POST["sku"]); 
        echo $result; exit;
    }
    echo 0; exit;
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
        
        $result = isVendorProductValid($productName, $brandName, $categoryName, $pkgunitName, $pkglotName /*, $sku*/ ); 

        echo $result; exit;
    }
    echo 0; exit;
}


?>
