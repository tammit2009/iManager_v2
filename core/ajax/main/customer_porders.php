<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Receive Customer Purchase Order Items
if (isset($_POST["receive_customer_porder_items"])) {
    // echo "Receive PO Items";        
    // View all form data // print_r($_POST);

    $porder_status = $_POST["porder_rx_status"];
    $porder_id = $_POST["porder_rx_porder_id"];
    $originator_id = $_POST["porder_rx_originator_id"];
    $customer_id = $_POST["porder_rx_customer_id"];
    $receiver_id = $_POST["porder_rx_receiver_id"];
    $receiver_note = $_POST["porder_rx_notes"];

    // Now getting arrays from receive_porder_items form
    $arr_product_id            = $_POST["product_id"];
    $arr_product_sku            = $_POST["product_sku"];
    $arr_product_rx_qty          = $_POST["product_rx_qty"];

    // Receive the purchase order
    echo receiveCustomerPorderItems($porder_id, $receiver_id, $receiver_note, $porder_status, 
                                $arr_product_id, $arr_product_sku, $arr_product_rx_qty); 
}
