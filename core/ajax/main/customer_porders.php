<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Create Vendor Purchase Order
if (isset($_POST["createPurchaseOrder"]) AND isset($_POST["customer_porder_issuer_id"])) {

    // print_r($_POST);

    $preq_id                = $_POST["customer_porder_prid"];
    $preq_no                = $_POST["customer_porder_prno"];
    $order_date             = $_POST["customer_porder_date"];
    $domain_id              = $_POST["customer_porder_domainid"];
    $subdom_id              = $_POST["customer_porder_subdomid"];
    //$customer               = $_POST["customer_porder_customer"];
    $customer_id            = $_POST["customer_porder_customer_id"];
    $originator_id          = $_POST["customer_porder_originator_id"];
    $issuer_id              = $_POST["customer_porder_issuer_id"]; 
    //$issuer                 = $_POST["issuer"];   
    $order_descr            = $_POST["customer_porder_descr"];
    $sub_total              = $_POST["customer_porder_subtotal"];
    $vat                    = $_POST["customer_porder_vat"];
    $discount               = $_POST["customer_porder_discount"];
    $total_amt              = $_POST["customer_porder_total_amt"];
    //$grand_total            = $_POST["customer_porder_grand_total"];
    $paid_amt               = $_POST["customer_porder_paid_amount"];
    $due                    = $_POST["customer_porder_due_amount"];
    $shipping               = $_POST["customer_porder_shipping"];
    $shipping_method        = $_POST["customer_porder_shipping_method"];
    $payment_method         = $_POST["customer_porder_payment_method"];
    $payment_status         = $_POST["customer_porder_payment_status"];
    $notes                  = $_POST["customer_porder_issuer_notes"];

    // Generate an order
    $res = generateCustomerPurchaseOrder( $order_date, $preq_id, $preq_no, $order_descr, $originator_id, $customer_id, $issuer_id, 
                                        $domain_id, $subdom_id, $sub_total, $vat, $discount, $total_amt, $paid_amt, $due,
                                        $payment_method, $shipping_method, $shipping, $payment_status, $notes);

    if ($res > 0) {
        $result = array( 'code' => 0, 'message' => 'New Customer Purchase Order Successfully Created.', 'id' => $res );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'The purchase requisition has not been approved.' );
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
                $result = array( 'code' => 5, 'message' => 'Unable to find the specified customer requisition.' );
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

// Receive Customer Purchase Order Items
if (isset($_POST["receive_customer_porder_items"])) {
    
    // print_r($_POST);

    $porder_status = $_POST["porder_rx_status"];
    $porder_id = $_POST["porder_rx_porder_id"];
    $domain_id = $_POST["porder_rx_domain_id"];
    $subdom_id = $_POST["porder_rx_subdom_id"];
    $originator_id = $_POST["porder_rx_originator_id"];
    $customer_id = $_POST["porder_rx_customer_id"];
    $receiver_id = $_POST["porder_rx_receiver_id"];
    $receiver_note = $_POST["porder_rx_notes"];

    // Now getting arrays from receive_porder_items form
    $arr_product_id            = $_POST["product_id"];
    $arr_product_sku            = $_POST["product_sku"];
    $arr_product_rx_qty          = $_POST["product_rx_qty"];

    // Receive the purchase order
    $res = receiveCustomerPorderItems($porder_id, $domain_id, $subdom_id, $receiver_id, $receiver_note, $porder_status, 
                                $arr_product_id, $arr_product_sku, $arr_product_rx_qty); 

    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Successfully received items.' );
    }
    else {
        switch ($res) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Unable to find any related po line item.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Unable to connect to db.' );
                break; 
            default:
                $result = array( 'code' => 7, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}
