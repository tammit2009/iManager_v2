<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Add a requisition line item
if (isset($_POST["get_new_requisition_item"])) { ?>

    <tr>
        <td class="text-center pt-3"><b class="number">1</b></td>
        <td class="text-left">
            <input type="hidden" name="stock_product_id[]" class="stock_product_id">  
            <input type="hidden" name="stock_product_sku[]" class="stock_product_sku">                              
            <div class="input-group m-0">
                <div class="input-group-prepend">
                    <button 
                        class="select_stock_product btn btn-sm btn-outline-secondary" 
                        type="button"
                        data-xdata="stock_product_id"
                        data-toggle="modal" 
                        data-target="#stockSelectModal"
                    ><i class="fa fa-search"></i>
                    </button>
                </div>
                <input type="text" class="form-control form-control-sm stock_product_item" name="stock_product_item[]" placeholder="Choose a product">
            </div>
        </td>
        <td class="text-left">
            <input type="hidden" class="stock_product_unit" name="stock_product_unit[]" >
            <span class="stock_product_unit">Unit of product</span>
        </td>
        <td class="text-left">
            <input type="hidden" class="stock_product_descr" name="stock_product_descr[]" >
            <span class="stock_product_descr">Description of product</span>
        </td>
        <td class="text-left">
            <input type="hidden" class="stock_product_avail" name="stock_product_avail[]" >
            <span class="stock_product_avail">Stock avail.</span>
        </td>
        <td class="text-left">
            <input type="text" class="form-control form-control-sm stock_product_qty text-left" name="stock_product_qty[]" required>
        </td>
        <!-- <td class="text-center">
            <button class="stock_product_remove btn btn-sm btn-danger" type="button">
                <i class="fa fa-trash"></i>
            </button>
        </td> -->
    </tr>

    <?php exit();
}

// Get details of one line item
if (isset($_POST["get_stock_item_details"])) {

    // TODO: move the db functions to 'db_functions.php'
    $opr = new DBOperation();

    if (!$opr->dbConnected()) {
        echo json_encode(array("msg" => "No Record Found")); 
        exit;
    }

    $query =    "SELECT stock.id, stock.item, stock.sku, 
                (SELECT name FROM brands WHERE products.brand_id = brands.id) as brand_name, 
                products.unit, products.short_descr, stock.curr_stock_level, stock.pending_reserved
                FROM stock inner join products 
                on stock.sku = products.sku WHERE stock.id=?";

    // TODO: package the response more consistently

    $result = $opr->sqlSelect($query, "i", $_POST["id"]);
    if ($result && $result->num_rows === 1) {
        $arr = mysqli_fetch_array($result);
        echo json_encode($arr);
    }
    else {
        echo json_encode(array("msg" => "No Record Found")); 
    }
}

// Capture and store requisition data
if (isset($_POST["createStoreRequisition"]) AND isset($_POST["requester_id"])) {

    // print_r($_POST);

    $requisition_date = $_POST["new_requisition_date"];
    $requisition_descr = $_POST["requisition_descr"];
    $requester_id = $_POST["requester_id"];
    $approver_id = $_POST["approver_id"];
    $shopkeeper_id = $_POST["shopkeeper_id"];

    // Now getting array from requisition_form
    $arr_stock_product_item = $_POST["stock_product_item"];
    $arr_stock_product_id = $_POST["stock_product_id"];
    $arr_stock_product_sku = $_POST["stock_product_sku"];
    $arr_stock_product_qty = $_POST["stock_product_qty"];

    // Generate a requisition
    echo generateStoreRequisition($requester_id, $approver_id, $shopkeeper_id, $requisition_date, $requisition_descr,
                $arr_stock_product_item, $arr_stock_product_id, $arr_stock_product_sku, $arr_stock_product_qty);
}


// // Create New User
// if (isset($_POST["manageUser"])) {
    
//     // View the variables // print_r($_POST); // print_r($_FILES);

//     $id = saveUser($_POST, $_FILES);
//     if ($id > 0) {
//         $result = array( 'code' => 0, 'message' => 'User successfully saved.', 'id' => $id );
//     }
//     else {
//         switch ($id) {
//             case -1: 
//                 $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
//                 break;
//             case -2: 
//                 $result = array( 'code' => 2, 'message' => 'Email already exists.' );
//                 break; 
//             case -3: 
//                 $result = array( 'code' => 3, 'message' => 'Unable to insert user into the db.' );
//                 break;
//             default:
//                 $result = array( 'code' => 4, 'message' => 'Unknown error.' );
//         }
//     }
    
//     echo json_encode($result);
// }

// // Delete a User
// if ($action === 'delete_user') {
//     // View the variables // print_r($_POST);

//     $id = isset($_POST['id']) ? $_POST['id'] : false;
//     if ($id) {
//         $res = deleteUser($id);
//         if ($res === 0) {
//             $result = array( 'code' => 0, 'message' => 'User successfully deleted.' );
//         }
//         else {
//             if ($res === -1) {
//                 $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
//             }
//             else if ($res === -2) {
//                 $result = array( 'code' => 2, 'message' => 'Unable to delete user.' );
//             }
//             else {
//                 $result = array( 'code' => 3, 'message' => 'Unknown error.' );
//             }
//         }
//     }
//     else {
//         $result = array( 'code' => 4, 'message' => 'Invalid ID' );
//     }

//     echo json_encode($result);
// }

?>