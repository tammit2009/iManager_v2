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

    // // print_r($_POST);

    // $student_name = $_POST["student_name"];
    // $student_phone = $_POST["student_phone"];
    
    // $id = batchAddProducts($student_name, $student_phone);

    // if ($id > 0) {
    //     $result = array( 'code' => 0, 'message' => 'New products successfully created.' );
    // }
    // else {
    //     $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    // }

    // echo json_encode($result);
}


if(!empty($_POST['action_type'])) {
    // print_r($_POST);

	$action_type = $_POST['action_type'];
    // echo $action_type;

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        switch($action_type){
            case "remove":
                if(!empty($_POST['id'])){
                    // $id = $conn->real_escape_string($_POST['id']);
                    // $sql = "DELETE FROM product WHERE id = '$id'";
                    // if($conn->query($sql)){
                    //     echo "Product Has Been Deleted Successfully !";
                    // }else{
                    //     echo "Something Went Wrong !";
                    // }
                }
                break;
            
            case "get_product_by_barcode":
                if(!empty($_POST['bar_code'])){
                    $bar_code = $_POST['bar_code'];

                    $res = $opr->sqlSelect('SELECT * FROM products WHERE barcode=?', 's', $bar_code);
                    if ($res && $res->num_rows > 0) {
                        $row = $res->fetch_assoc();
                        $res->free_result();
                        $detail = array(
                            'type'=>'Success',
                            'bar_code'=>$row['barcode'],
                            'product_id'=>$row['id'],
                            'sku'=>$row['sku'],
                            'product_name'=>$row['product_name'],
                            'brand'=>$row['brand_id'],
                            'category'=>$row['category_id'],
                            'description'=>$row['short_descr'],
                            'unit'=>$row['unit'],
                            'unit_price'=>$row['unit_price'],
                        );
                        echo json_encode($detail);
                    }
                    else {
                        $detail = array(
                            'type'=>'Error'
                        );
                        echo json_encode($detail);
                    }
                }
                break;

            case "get_product_by_id":
                if(!empty($_POST['productid'])){
                    $productid = $_POST['productid'];

                    $res = $opr->sqlSelect('SELECT * FROM products WHERE id=?', 'i', $productid);
                    if ($res && $res->num_rows > 0) {
                        $row = $res->fetch_assoc();
                        $res->free_result();
                        $detail = array(
                            'type'=>'Success',
                            'bar_code'=>$row['barcode'],
                            'product_id'=>$row['id'],
                            'sku'=>$row['sku'],
                            'product_name'=>$row['product_name'],
                            'brand'=>$row['brand_id'],
                            'category'=>$row['category_id'],
                            'description'=>$row['short_descr'],
                            'unit'=>$row['unit'],
                            'unit_price'=>$row['unit_price'],
                        );
                        echo json_encode($detail);
                    }
                    else {
                        $detail = array(
                            'type'=>'Error'
                        );
                        echo json_encode($detail);
                    }
                }
                break;

            case "get_product_by_sku":
                if(!empty($_POST['sku'])) {
                    $sku = $_POST['sku'];
                    $res = $opr->sqlSelect('SELECT * FROM products WHERE sku=?', 's', $sku);
                    if ($res && $res->num_rows > 0) {
                        $row = $res->fetch_assoc();
                        $res->free_result();
                        $detail = array(
                            'type'=>'Success',
                            'bar_code'=>$row['barcode'],
                            'product_id'=>$row['id'],
                            'sku'=>$row['sku'],
                            'product_name'=>$row['product_name'],
                            'brand'=>$row['brand_id'],
                            'category'=>$row['category_id'],
                            'description'=>$row['short_descr'],
                            'unit'=>$row['unit'],
                            'unit_price'=>$row['unit_price'],
                        );
                        echo json_encode($detail);
                    }
                    else {
                        $detail = array(
                            'type'=>'Error'
                        );
                        echo json_encode($detail);
                    }
                }
                break;	
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


?>