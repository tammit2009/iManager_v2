<?php 
include_once('../../security.php');
include_once('db_functions.php');


// Add a purchase requisition line item
if (isset($_POST["get_new_preq_item"])) {

    ?>
    <tr>
        <td class="text-center pt-3"><b class="number">1</b></td>
        <td class="text-left">
            <input type="hidden" name="product_id[]" class="product_id">                                
            <div class="input-group m-0">
                <div class="input-group-prepend">
                    <button 
                        class="select_product btn btn-sm btn-outline-secondary" 
                        type="button"
                        data-xdata="product_id"
                        data-toggle="modal" 
                        data-target="#productSelectModal"
                    ><i class="fa fa-search"></i>
                    </button>
                </div>
                <input type="text" class="form-control form-control-sm product_name" name="product_name[]" placeholder="Choose a product" required>
            </div>
        </td>
        <td class="text-left">
            <input type="hidden" class="product_brand_id" name="product_brand_id[]" >
            <input type="hidden" class="product_brand" name="product_brand[]" >
            <span class="product_brand">Brand</span>
        </td>
        <td class="text-left">
            <input type="hidden" class="product_category_id" name="product_category_id[]" >
            <input type="hidden" class="product_category" name="product_category[]" >
            <span class="product_category">Category</span>
        </td>
        <td class="text-left">
            <input type="hidden" class="product_descr" name="product_descr[]" readonly>
            <span class="product_descr">Product Description</span>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm product_unit text-center" name="product_unit[]" readonly>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm product_qty text-center" name="product_qty[]" required>
        </td>
        <td class="px-4">
            <input type="text" class="form-control form-control-sm product_rate text-center" name="product_rate[]" readonly>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm product_total text-right" name="product_total[]" readonly>
        </td>
        <!-- <td class="text-center">
            <button class="product_remove btn btn-sm btn-danger" type="button">
                <i class="fa fa-trash"></i>
            </button>
        </td>  -->
    </tr>
    <?php 

    exit();
}

// Get details of one line item
if (isset($_POST["get_preq_item_details"])) {

    // TODO: relocate the db aspects to 'db_functions.php'

    $opr = new DBOperation();

    if (!$opr->dbConnected()) {
        echo json_encode(array("msg" => "No Record Found")); 
        exit;
    }

    $query = "SELECT products.id, products.sku, products.product_name, products.unit, products.brand_id, 
            (SELECT name FROM brands WHERE products.brand_id = brands.id) as brand, products.category_id,
            (SELECT name FROM categories WHERE products.category_id = categories.id) as category, 
            products.short_descr, products.unit_price FROM `products` WHERE products.id=?";

    // TODO: provide a more unified return

    $result = $opr->sqlSelect($query, "i", $_POST["id"]);
    if ($result && $result->num_rows === 1) {
        $arr = mysqli_fetch_array($result);
        echo json_encode($arr);
    }
    else {
        echo json_encode(array("msg" => "No Record Found")); 
    }
}


// Capture and store purchase requisition data
if (isset($_POST["createPurchaseRequisition"]) AND isset($_POST["preq_originator_id"])) {

    // print_r($_POST);

    $preq_supplier = $_POST['preq_supplier'];
    $preq_date = $_POST["preq_date"];
    $domainid = $_POST["domainid"];
    $subdomid = $_POST["subdomid"];
    $preq_descr = $_POST["preq_descr"];
    $preq_notes = $_POST["preq_notes"];
    $preq_subtotal = $_POST["preq_subtotal"];
    $originator = $_POST["preq_originator"];
    $originator_id = $_POST["preq_originator_id"];
    $approver = $_POST["preq_approver"];
    $approver_id = $_POST["preq_approver_id"];
    $customer = $_POST["preq_customer"];
    $customer_id = $_POST["preq_customer_id"];

    // Now getting arrays from order_form
    $arr_product_id            = $_POST["product_id"];
    $arr_product_name          = $_POST["product_name"];
    $arr_product_brand_id      = $_POST["product_brand_id"];
    $arr_product_brand         = $_POST["product_brand"];
    $arr_product_category      = $_POST["product_category"];
    $arr_product_descr         = $_POST["product_descr"];
    $arr_product_unit          = $_POST["product_unit"];
    $arr_product_qty           = $_POST["product_qty"];
    $arr_product_rate          = $_POST["product_rate"];
    $arr_product_total         = $_POST["product_total"];

    // print_r($arr_product_descr);

    // $vat                = $_POST["preq_vat"];
    // $discount           = $_POST["preq_discount"];
    // $total_amt          = $_POST["preq_total_amt"];
    // $grand_total        = $_POST["preq_grand_total"];
    // $paid_amt           = $_POST["preq_paid_amount"];
    // $due                = $_POST["preq_due_amount"];
    // $shipping           = $_POST["preq_shipping"];
    // $shipping_method    = $_POST["preq_shipping_method"];
    // $payment_method     = $_POST["preq_payment_method"];
    // $payment_status     = $_POST["preq_payment_status"];

    // Generate a requisition
    $res = generateCustomerPurchaseRequisition( $preq_date, $originator_id, $approver_id, $customer_id, $domainid, $subdomid,  
                                $preq_descr, $arr_product_id, $arr_product_name, $arr_product_descr, 
                                $arr_product_unit, $arr_product_qty, $arr_product_rate, $arr_product_total,
                                $preq_subtotal, $preq_notes);

    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'New Customer Purchase Requisition inserted.', 'id' => $res );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Unable to create new order.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Failed to insert all order items. Rolling Back.' );
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


// Approve Customer Purchase requisition
if (isset($_POST["customer_preq_approval"])) {
    // print_r($_POST);

    $customer_preq_approval = $_POST["customer_preq_approval"];   // 0 = processing, 2 = approve, 4 = rejected   
    $customer_preq_id = $_POST["customer_preq_id"];
    $approver_id = $_POST["customer_preq_approver_id"];
    $approver_note = $_POST["customer_preq_approver_notes"];

    // Approve or Reject the vendor purchase requisition
    $res = approveCustomerPurchaseRequisition($customer_preq_id, $approver_id, $approver_note, $customer_preq_approval); 

    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Customer Purchase Requisition Approved' );
    }
    else if ($res === 1) {
        $result = array( 'code' => 0, 'message' => 'Customer Purchase Requisition Rejected' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Incorrect status received.' );
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


?>