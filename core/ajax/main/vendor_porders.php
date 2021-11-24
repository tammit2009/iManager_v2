<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Create Vendor Purchase Order
if (isset($_POST["createPurchaseOrder"]) AND isset($_POST["vendor_porder_issuer_id"])) {

    // print_r($_POST);

    $order_date             = $_POST["vendor_porder_date"];
    $domain_id              = $_POST["vendor_porder_domainid"];
    $subdom_id               = $_POST["vendor_porder_subdomid"];
    $requester_id           = $_POST["vendor_porder_requester_id"];
    $issuer_id              = $_POST["vendor_porder_issuer_id"];
    $preq_id                = $_POST["vendor_porder_prid"];
    $preq_no                = $_POST["vendor_porder_prno"];
    $vendor_id              = $_POST["vendor_porder_vid"];
    $order_descr            = $_POST["vendor_porder_descr"];
    $sub_total              = $_POST["vendor_porder_subtotal"];
    $vat                    = $_POST["vendor_porder_vat"];
    $discount               = $_POST["vendor_porder_discount"];
    $total_amt              = $_POST["vendor_porder_total_amt"];
    $grand_total            = $_POST["vendor_porder_grand_total"];
    $paid_amt               = $_POST["vendor_porder_paid_amount"];
    $due                    = $_POST["vendor_porder_due_amount"];
    $shipping               = $_POST["vendor_porder_shipping"];
    $shipping_method        = $_POST["vendor_porder_shipping_method"];
    $payment_method         = $_POST["vendor_porder_payment_method"];
    $payment_status         = $_POST["vendor_porder_payment_status"];
    $notes                  = $_POST["vendor_porder_issuer_notes"];

    // Generate an order
    $res = generateVendorPurchaseOrder( $requester_id, $issuer_id, $vendor_id, $order_date, 
                                $preq_id, $preq_no, $domain_id, $subdom_id, 
                                $order_descr, $sub_total, $vat, $discount, $total_amt, 
                                $grand_total, $paid_amt, $due,
                                $shipping, $shipping_method, $payment_method, $payment_status, $notes);

    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'Successfully created vendor purchase order.' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'The requisition is not in approved state.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Failed to insert all order items. Rolling Back.' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Unable to find any related order requisition line item.' );
                break;
            case -4: 
                $result = array( 'code' => 4, 'message' => 'Unable to create new order.' );
                break; 
            case -5: 
                $result = array( 'code' => 5, 'message' => 'TUnable to find the specified order requisition.' );
                break;
            case -6: 
                $result = array( 'code' => 6, 'message' => 'Unable to connect to db.' );
                break; 
            default:
                $result = array( 'code' => 7, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

?>