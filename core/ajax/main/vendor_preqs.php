<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Add an vendor purchase requisition line item
if (isset($_POST["get_new_vendor_preq_item"])) {

    ?>
    <tr>
        <td class="text-center pt-3"><b class="number">1</b></td>
        <td class="text-left">
            <input type="hidden" name="vproduct_id[]" class="vproduct_id">                                
            <div class="input-group m-0">
                <div class="input-group-prepend">
                    <button 
                        class="select_vproduct btn btn-sm btn-outline-secondary" 
                        type="button"
                        data-xdata="vproduct_id"
                        data-toggle="modal" 
                        data-target="#vproductSelectModal"
                    ><i class="fa fa-search"></i>
                    </button>
                </div>
                <input type="text" class="form-control form-control-sm vproduct_name" name="vproduct_name[]" placeholder="Choose a product">
            </div>
        </td>
        <td class="text-left">
            <input type="hidden" class="vproduct_supplier_id" name="vproduct_supplier_id[]" >
            <!-- <input type="text" class="form-control form-control-sm vproduct_supplier" name="vproduct_supplier[]" > -->
            <input type="hidden" class="vproduct_supplier" name="vproduct_supplier[]" >
            <span class="vproduct_supplier">Vendor/Supplier</span>
        </td>
        <td class="text-left">
            <!-- <input type="text" class="form-control form-control-sm vproduct_descr" name="vproduct_descr[]" readonly> -->
            <input type="hidden" class="vproduct_descr" name="vproduct_descr[]" readonly>
            <span class="vproduct_descr">Product Description</span>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm vproduct_rate text-center" name="vproduct_rate[]" readonly>
        </td>
        <td class="px-4">
            <input type="text" class="form-control form-control-sm vproduct_qty text-center" name="vproduct_qty[]" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm vproduct_total text-right" name="vproduct_total[]" readonly>
        </td>
        <!-- <td class="text-center">
            <button class="vproduct_remove btn btn-sm btn-danger" type="button">
                <i class="fa fa-trash"></i>
            </button>
        </td>  -->
    </tr>
    <?php 

    exit();
}


// Get details of one line item
if (isset($_POST["get_vendor_preq_item_details"])) {

    // TODO: relocate the db aspects to 'db_functions.php'

    $opr = new DBOperation();

    if (!$opr->dbConnected()) {
        echo json_encode(array("msg" => "No Record Found")); 
        exit;
    }

    $query =   "SELECT vp.id, products.product_name, vp.product_name_descr, products.unit, 
                vp.qty_per_offer, vp.offer_price, vp.vendor_id,
                (SELECT name FROM organizations WHERE organizations.id = vp.vendor_id) as vendor            
                FROM `vendors_products` as vp INNER JOIN products 
                ON vp.provisional_sku = products.sku
                WHERE vp.id=?";

    $result = $opr->sqlSelect($query, "i", $_POST["id"]);
    if ($result && $result->num_rows === 1) {
        $arr = mysqli_fetch_array($result);
        echo json_encode($arr);
    }
    else {
        echo json_encode(array("msg" => "No Record Found")); 
    }
}

// Capture and store vendor purchase requisition data
if (isset($_POST["createVendorPurchaseRequisition"]) AND isset($_POST["requester_id"])) {
    
    // print_r($_POST);

    $vendor_preq_date = $_POST["vendor_preq_date"];
    $domain_id = $_POST["domainid"];
    $subdom_id = $_POST["subdomid"];
    $requester_id = $_POST["requester_id"];
    $approver_id = $_POST["approver_id"];
    $vendor_preq_descr = $_POST['vendor_preq_descr'];

    // Now getting array from order_form
    $arr_vproduct_id            = $_POST["vproduct_id"];
    $arr_vproduct_name          = $_POST["vproduct_name"];
    $arr_vproduct_supplier_id   = $_POST["vproduct_supplier_id"];
    $arr_vproduct_supplier      = $_POST["vproduct_supplier"];
    $arr_vproduct_descr         = $_POST["vproduct_descr"];
    $arr_vproduct_rate          = $_POST["vproduct_rate"];
    $arr_vproduct_qty           = $_POST["vproduct_qty"];
    $arr_vproduct_total         = $_POST["vproduct_total"];

    // Generate vendor purchase requisition
    $res = generateVendorPurchaseRequisition( $requester_id, $approver_id, $domain_id, $subdom_id, $vendor_preq_date, $vendor_preq_descr, 
                                    $arr_vproduct_id, $arr_vproduct_name, $arr_vproduct_supplier_id, $arr_vproduct_supplier, 
                                    $arr_vproduct_descr, $arr_vproduct_rate, $arr_vproduct_qty, $arr_vproduct_total);

    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'Vendor Purchase Requisition Successfully created.' );
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


// Approve Vendor Purchase requisition
if (isset($_POST["vendor_preq_approval"])) {
    // print_r($_POST);

    $vendor_preq_approval = $_POST["vendor_preq_approval"];   // 0 = processing, 2 = approve, 4 = rejected   
    $vendor_preq_id = $_POST["vendor_preq_id"];
    $approver_id = $_POST["vendor_preq_approver_id"];
    $approver_note = $_POST["vendor_preq_approver_notes"];

    // Approve or Reject the vendor purchase requisition
    $res = approveVendorPurchaseRequisition($vendor_preq_id, $approver_id, $approver_note, $vendor_preq_approval); 

    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Vendor Purchase Requisition Successfully Approved.' );
    }
    else if ($res === 1) {
        $result = array( 'code' => 0, 'message' => 'Vendor Purchase Requisition Successfully Rejected.' );
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
            default:
                $result = array( 'code' => 4, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);        
}

?>