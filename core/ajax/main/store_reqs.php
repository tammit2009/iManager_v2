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
    $domain_id = $_POST["domainid"];
    $subdom_id = $_POST["subdomid"];
    $requester_id = $_POST["requester_id"];
    $approver_id = $_POST["approver_id"];
    $shopkeeper_id = $_POST["shopkeeper_id"];

    // Now getting array from requisition_form
    $arr_stock_product_item = $_POST["stock_product_item"];
    $arr_stock_product_id = $_POST["stock_product_id"];
    $arr_stock_product_sku = $_POST["stock_product_sku"];
    $arr_stock_product_qty = $_POST["stock_product_qty"];

    // Generate a requisition
    $res = generateStoreRequisition($domain_id, $subdom_id, $requester_id, $approver_id, $shopkeeper_id, $requisition_date, $requisition_descr,
                $arr_stock_product_item, $arr_stock_product_id, $arr_stock_product_sku, $arr_stock_product_qty);

    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'New Requisition inserted.', 'id' => $res );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Unable to create new requisition.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Failed to insert all requisition items. Rolling Back.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to connect to db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Approve requisition
if (isset($_POST["requisition_approve"])) {
    // print_r($_POST);

    $requisition_approve = $_POST["requisition_approve"];   // 0 = processing, 2 = approve, 3 = completed, 4 = rejected   
    $requisition_id = $_POST["requisition_approval_id"];
    $approver_id = $_POST["requisition_approver_id"];
    $approver_note = $_POST["requistion_approver_notes"];
    
    // Approve a requisition
    $res = approveStoreRequisition($requisition_id, $approver_id, $approver_note, $requisition_approve); 

    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Requisition approved.' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Incorrect status.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Unable to update requisition.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to connect to db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Reject requisition
if (isset($_POST["requisition_reject"])) {
    // print_r($_POST);

    $requisition_reject = $_POST["requisition_reject"];   // 4 = rejected   
    $requisition_id = $_POST["requisition_approval_id"];
    $approver_id = $_POST["requisition_approver_id"];
    $approver_note = $_POST["requistion_approver_notes"];
    
    // Reject a requisition
    $res = approveStoreRequisition($requisition_id, $approver_id, $approver_note, $requisition_reject); 

    if ($res === 1) {
        $result = array( 'code' => 0, 'message' => 'Requisition successfully rejected.' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Incorrect status.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Unable to update requisition.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to connect to db.' );
                break;
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// StoreKeeper Complete requisition
if (isset($_POST["requisition_complete"])) {
    // print_r($_POST);

    $requisition_complete = $_POST["requisition_complete"];   // 3 = complete
    $requisition_id = $_POST["requisition_approval_id"];
    $domain_id = $_POST["requisition_domain_id"];
    $subdom_id = $_POST["requisition_subdom_id"];
    $storekeeper_id = $_POST["requisition_storekeeper_id"];
    $storekeeper_note = $_POST["requistion_store_notes"];

    // Complete the requisition
    $res = completeStoreRequisition($requisition_id, $domain_id, $subdom_id, $storekeeper_id, $storekeeper_note, $requisition_complete);

    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Store requisition completed (items released).' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Incorrect status received.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Unable to update requisitions.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to connect to db.' );
                break;
            case -4: 
                $result = array( 'code' => 4, 'message' => 'Unable to find any related requisition line items.' );
                break;
            case -5: 
                $result = array( 'code' => 5, 'message' => 'Unable to find sku in stock.' );
                break;
            case -6: 
                $result = array( 'code' => 6, 'message' => 'Insufficient stock to meet the requisition demands.' );
                break;
            case -7: 
                $result = array( 'code' => 7, 'message' => 'The requisition has not been approved.' );
                break;
            case -8: 
                $result = array( 'code' => 8, 'message' => 'The requisition has already been completed.' );
                break;
            case -9: 
                $result = array( 'code' => 9, 'message' => 'Not approved (other problem with the requisition).' );
                break;
            case -10: 
                $result = array( 'code' => 10, 'message' => 'Invalid requisition.' );
                break;
            default:
                $result = array( 'code' => 11, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// StoreKeeper Reject requisition
if (isset($_POST["requisition_store_reject"])) {
    // print_r($_POST);

    $requisition_store_reject = $_POST["requisition_store_reject"];   // 5 = storekeeper reject
    $requisition_id = $_POST["requisition_approval_id"];
    $domain_id = $_POST["requisition_domain_id"];
    $subdom_id = $_POST["requisition_subdom_id"];
    $storekeeper_id = $_POST["requisition_storekeeper_id"];
    $storekeeper_note = $_POST["requistion_store_notes"];

    // Storekeeper Reject the requisition
    $res = completeStoreRequisition($requisition_id, $domain_id, $subdom_id, $storekeeper_id, $storekeeper_note, $requisition_store_reject);

    if ($res === 1) {
        $result = array( 'code' => 0, 'message' => 'Store requisition rejected successfully.' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Incorrect status received.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Unable to update requisitions.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to connect to db.' );
                break;
            case -4: 
                $result = array( 'code' => 4, 'message' => 'Unable to find any related requisition line items.' );
                break;
            case -5: 
                $result = array( 'code' => 5, 'message' => 'Unable to find sku in stock.' );
                break;
            case -6: 
                $result = array( 'code' => 6, 'message' => 'Insufficient stock to meet the requisition demands.' );
                break;
            case -7: 
                $result = array( 'code' => 7, 'message' => 'The requisition has not been approved.' );
                break;
            case -8: 
                $result = array( 'code' => 8, 'message' => 'The requisition has already been completed.' );
                break;
            case -9: 
                $result = array( 'code' => 9, 'message' => 'Not approved (other problem with the requisition).' );
                break;
            case -10: 
                $result = array( 'code' => 10, 'message' => 'Invalid requisition.' );
                break;
            default:
                $result = array( 'code' => 11, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

?>