<?php 

// include_once(CORE_PATH.DS.'security.php');

/*******************************************/
/***                                     ***/
/*** Business Logic for the transactions ***/
/***                                     ***/
/*******************************************/

/*
 * STORE REQUISITIONS
 */

function generateStoreRequisition($domain_id, $subdom_id, $requester_id, $approver_id, $storekeeper_id, 
                    $requisition_date, $requisition_description,  $arr_item, $arr_id, $arr_sku, $arr_qty) {
    
    // echo "Session ID: ". $_SESSION['userid'] . "\n";
    // echo "Domain ID: ".  $domain_id . "\n";
    // echo "Subdomain ID: ".  $subdom_id . "\n";

    // Generate a requisition id
    $requisition_no = strtoupper(generateRandomString(4)) . rand(1000, 9999);

    // Insert a new requisition into 'requisitions'
    $opr = new DBOperation();

    if ($opr->dbConnected()) {
        $requisition_query = "INSERT INTO store_reqs VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0)";
        $id = $opr->sqlInsert($requisition_query, 'siisiisiss', 
                $requisition_no,            // requisition_no
                $domain_id,                 // domain_id
                $subdom_id,                 // sub_dom_id
                $requisition_description,   // brief_description
                $requester_id,              // requester_id
                $approver_id,               // approver_id
                '',                         // approver_notes   
                $storekeeper_id,            // storekeeper_id
                '',                         // storekeeper_notes
                $requisition_date           // request_date
            );

        if ($id > 0) {  // A new requisition has been created with this id     
            
            $inserted = false;  // to detect if any line item insertion fails

            // Insert the new line items into requisition_line_items
            $line_item_query = "INSERT INTO store_req_line_items VALUES (NULL, ?, ?, ?, ?, ?)";

            for ($j = 0; $j < count($arr_sku); $j++) {

                // TODO: match with the current level of this particular item in stock/warehouse

                $iid = $opr->sqlInsert($line_item_query, 'sssii', 
                        $id,                        // requisition_id
                        $arr_item[$j],              // description
                        $arr_sku[$j],               // sku
                        $arr_qty[$j],               // requested_qty
                        0,                          // issued_qty (0 at origin of the request)
                );
    
                if ($iid > 0) {
                    //echo "New Requisition Line Item inserted with id: " . $iid ."<br/>";
                    $inserted = true;

                    // Add items to the stock transactions as well
                    addStockTxn($_SESSION['userid'], 
                                date('Y-m-d H:i:s'), 
                                $domain_id,                 
                                $subdom_id,                 
                                "store_reqs",
                                $id, 
                                $arr_sku[$j], 
                                $arr_qty[$j],
                                11,                 // actionType: requisition created, awaiting approval
                                0);                 // status: stock item state: pending approval

                    // Change the stock line item's quantity as well.
                    updateStockItem($domain_id, $subdom_id, $arr_sku[$j], $arr_qty[$j], 0); // status created and pending=0
                }
                else {
                    $inserted = false;
                    break;              // no need to continue if one insert fails
                }
            }
            if ($inserted) {

                // Assemble data
                $creator = $_SESSION['userid'];
                $target_to = 0;         // for now
                $timestamp = date('Y-m-d H:i:s', time());
                $type = "info";
                $category = "db_activity";
                $table_str = "store_reqs";
                $action = "create_requisition";
                $status = "processing";
                $route = "Request approval for requisition";
                $xinfo = "";

                // Create a request for approval
                $rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "approve_requisition", $id, $route, 0);

                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("store_reqs", $id, $rrid, 2); // set old ims_request to closed(2) if existing

                // Fire New Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success

                return  $id;      // "New Requisition inserted with id: " . $id ."<br/>";
                // exit;
            }
            else {

                // TODO: Rollback

                return -2;    // "Failed to insert all requisition items. Rolling Back.<br/>";
            }
        }
        else {
            
            return -1;        // "Unable to create new requisition.<br/>";
        }

        $opr->close();
    }
    else {
        //echo json_encode(array("msg" => "Unable to connect to db")); 
        return -3;            // "Unable to connect to db";
        // exit;
    }
}

function approveStoreRequisition($requisition_id, $approver_id, $approval_note, $approval_status) {

    // echo "Session ID: ". $_SESSION['userid'] . "\n";
    // echo "requisition_id: " . $requisition_id . "\n";
    // echo "approver_id: "    . $approver_id . "\n";
    // echo "approval_notes: " . $approval_note . "\n";
    // echo "status: "         . $approval_status . "\n";

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // Update the given requisition by inserting approval_note and status
        $update_requisition_query = "UPDATE store_reqs SET approver_id=?, approver_notes=?, status=? 
                                     WHERE id=?";

        $success = $opr->sqlUpdate( $update_requisition_query, 'isii', 
                                    $approver_id,               // approver_id
                                    $approval_note,             // approver_note
                                    $approval_status,           // status 
                                    $requisition_id             // requisition_no
        );

        if ($success) {

            // *No action required on stock transactions - still to be hold until storekeeper releases

            // Assemble data
            $creator = $_SESSION['userid'];
            $target_to = 0;                             // for now
            $timestamp = date('Y-m-d H:i:s', time());
            $type = "info";
            $category = "db_activity";
            $table_str = "store_reqs";
            $xinfo = "";

            if ($approval_status === '2') {            // approved
                $action = "approve_requisition";
                $status = "processing";
                $route = "Allow release of stock";

                // Create a request for release of stock
                $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "release_items", $requisition_id, $route, 0);
                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("store_reqs", $requisition_id, $new_rrid, 2); // set old ims_request to closed(2) if existing
                // Fire Update Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
                return 0;                                 // success
            }
            else if ($approval_status == '4') {         // reject
                $action = "reject_requisition";
                $status = "processing";
                $route = "Release pending stock";

                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("store_reqs", $requisition_id, 0, 2); // no new related request, set old to completed(2)
                // Fire Update Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
                return 1;                                 // rejected
            }
            else {
                return -1;                                // incorrect status;
            }
        }
        else {
            return -2;                                    // Unable to update requisitions
        }

        $opr->close();
    }
    else {
        return -3;                                        // "Unable to connect to db";
    }
}

function completeStoreRequisition($requisition_id, $domain_id, $subdom_id, $storekeeper_id, $storekeeper_note, $storekeeper_status) {

    // echo "requisition_id: "    . $requisition_id . "\n";
    // echo "domain_id: "         . $domain_id . "\n";
    // echo "subdom_id: "         . $subdom_id . "\n";
    // echo "storekeeper_id: "    . $storekeeper_id . "\n";
    // echo "storekeeper_note: "  . $storekeeper_note . "\n";
    // echo "status: "            . $storekeeper_status . "\n";

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // First check to ensure the requisition has been approved
        $query1 = "SELECT status FROM store_reqs WHERE id=? LIMIT 1";
        $aresult = $opr->sqlSelect($query1, "i", $requisition_id);
        if ($aresult && $aresult->num_rows === 1) {
            $row = $aresult->fetch_assoc();
            $curr_status = $row['status'];

            if ($curr_status === 0) {
                return -7;                                    // the requisition has not been approved
            }
            else if ($curr_status === 2) {                  // only continue if the requisition has been approved

                if ($storekeeper_status === '3') {          // complete the requisition

                    // Next get all the pending line items for this requisition
                    $query2 = "SELECT * FROM store_req_line_items WHERE requisition_id=?";
                    $results = $opr->sqlSelect($query2, "i", $requisition_id);
                    if ($results && $results->num_rows > 0) {   
                        
                        $stock_available = false;

                        while ($data = $results->fetch_assoc()) {   // iterate over the line items
                            $sku = $data['sku'];
                            $requested_qty = $data['requested_qty'];

                            // Confirm if there is sufficient quantity for each item in stock
                            $query3 = "SELECT * FROM stock WHERE sku=?";
                            $result = $opr->sqlSelect($query3, "s", $sku);
                            if ($result && $result->num_rows === 1) {
                                $row = $result->fetch_assoc();
                                // $curr_stock_level = $row['curr_stock_level'];
                                $pending_reserved = $row['pending_reserved'];

                                // echo "SKU: "                . $sku . "  ";
                                // echo "Req_Qty: "            . $requested_qty . "  ";
                                // //echo "Curr_Stock_Level: " . $curr_stock_level . "  ";
                                // echo "Pending_Rsvd: "       . $pending_reserved . "\n";

                                // Confirm if this iteration is ok and update to true if 
                                // stock is ok on this iteration, else false
                                if ($requested_qty <= $pending_reserved) {
                                    $stock_available = true;
                                }
                                else {
                                    $stock_available = false;
                                }
                            }
                            else {
                                return -5;            // Unable to find sku in stock
                            }
                        }

                        if ($stock_available) {

                            // Clear the items for removal by updating stock transactions & stock quantities
                            // $query4 = "SELECT * FROM stock_txns WHERE requisition_id=? AND status=0"; // only if status is 0
                            // $results = $opr->sqlSelect($query4, "i", $requisition_id);
                            $query4 = "SELECT * FROM store_req_line_items WHERE requisition_id=?"; 
                            $results = $opr->sqlSelect($query4, "i", $requisition_id);
                            if ($results && $results->num_rows > 0) {        
                                while ($data = $results->fetch_assoc()) {

                                    // Add item changes to the stock transactions 
                                    addStockTxn($_SESSION['userid'], 
                                                date('Y-m-d H:i:s'), 
                                                $domain_id,                 
                                                $subdom_id, 
                                                "store_reqs",
                                                $requisition_id, 
                                                $data['sku'], 
                                                $data['requested_qty'],
                                                13,                 // actionType: requisition item cleared for removal
                                                2);                 // status: stock item state: completed

                                    // Change the stock line item's quantity as well, releasing the stock to the requester
                                    updateStockItem($domain_id, $subdom_id, $data['sku'], $data['requested_qty'], 2);   // status completed=2

                                    // Update store requisition line item issued quantity
                                    $query5 = "UPDATE store_req_line_items SET issued_qty=? WHERE requisition_id=? AND sku=?";
                                    $opr->sqlUpdate( $query5, 'iis', 
                                                                $data['requested_qty'],         // issued qty
                                                                $requisition_id,                // requisition id
                                                                $data['sku']                    // sku
                                    );
                                }

                                // Now update the given requisition by inserting storekeeper_note and status
                                $query6 = "UPDATE store_reqs SET storekeeper_id=?, storekeeper_notes=?, status=? WHERE id=?";
                                $success = $opr->sqlUpdate( $query6, 'isii', 
                                                            $storekeeper_id,            // storekeeper_id
                                                            $storekeeper_note,          // storekeeper_note
                                                            $storekeeper_status,        // status 
                                                            $requisition_id             // requisition_no
                                );

                                if ($success) {     // Storekeeper notes updated
                                    // Assemble data
                                    $creator = $_SESSION['userid'];
                                    $timestamp = date('Y-m-d H:i:s', time());
                                    $type = "info";
                                    $category = "db_activity";
                                    $table_str = "store_reqs";
                                    $xinfo = "";
                                    $action = "complete_requisition";
                                    $status = "completed";
                                    $route = "Close the requisition";

                                    // Update related request field in the parent to keep track of the request
                                    updateRelatedRequest("store_reqs", $requisition_id, 0, 2); // no new related request, set old to completed(2)
                                    
                                    // Fire Close Requisition Event!
                                    addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
                                    return 0;                                     // success
                                }
                                else {
                                    return -2;              // Unable to update requisitions
                                }
                            }
                            else {
                                return -4;                  // "Unable to find any related stock transactions";
                            }
                        }
                        else {
                            return -6;                      // Reject entire operation as there is insufficient 
                                                            // stock to meet the requisition demands
                        }
                    }
                    else {
                        return -4;                          // Unable to find any related requisition line items;
                    }
                }
                else if ($storekeeper_status === '5') {     // storekeeper reject the requisition


                    // TODO: Release reserved stock!!


                    // Assemble data
                    $creator = $_SESSION['userid'];
                    $timestamp = date('Y-m-d H:i:s', time());
                    $type = "info";
                    $category = "db_activity";
                    $table_str = "store_reqs";
                    $xinfo = "";
                    $action = "reject_requisition";
                    $status = "rejected";
                    $route = "Close the requisition";
                    
                    // For now, no new related request, set old to completed(2) and just update 
                    // related request field in the parent to keep track of the request
                    updateRelatedRequest("store_reqs", $requisition_id, 0, 2);            

                    // In situation a new request required for reject to reinitiate a new procedure
                    // 1. Set the request target
                    // $target_to = 0;                           // for now
                    // 2. Create a request for rejection of stock (if needed!)
                    // $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, "requisitions", "release_items", $requisition_id, $route, 0);                                    
                    // 3. Then set the old ims_request to closed(2) if existing
                    // updateRelatedRequest("store_reqs", $requisition_id, $new_rrid, 2); 

                    // Fire Close or Update Requisition Event!
                    addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
                    return 1;                          // rejected
                }
                else {
                    return -1;                            // incorrect status;
                }
            }
            else if ($curr_status === 3) {
                return -8;                                // The requisition has already been completed
            }
            else {
                return -9;                                // Not approved (other problem with the requisition)
            }
        }
        else {
            return -10;                                   // Invalid requisition
        }

        $opr->close();
    }
    else {
        return -3;                                        // "Unable to connect to db";
    }
}


/*
 * CUSTOMER PURCHASE REQUISITIONS
 */

function generateCustomerPurchaseRequisition( $preq_date, $originator_id, $approver_id, $customer_id, $domain_id, $subdom_id,  
                                                $preq_descr, $arr_product_id, $arr_product_name, $arr_product_descr, 
                                                $arr_product_unit, $arr_product_qty, $arr_product_rate, $arr_product_total,
                                                $preq_subtotal, $preq_notes) {

    // echo "Session ID: ". $_SESSION['userid'];  
    
    // Generate a purchase order no
    $preqNo = strtoupper(generateRandomString(8));

    // Insert a new purchase requisition into 'customer_preqs'
    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // $test_str = $preqNo.",'".$preq_date."','".$preq_descr."',".$originator_id.",".$approver_id.",'',";
        // $test_str .= $customer_id.",".$domain_id.",". $subdom_id.",".$preq_subtotal.", 0, 0,'".$preq_notes."'";
        // echo $test_str;
       
        $preq_query = "INSERT INTO customer_preqs VALUES (NULL, ?, ?, ?, ?, ?, '', ?, ?, ?, ?, ?, ?, ?)";
        $id = $opr->sqlInsert($preq_query, 'sssiiiiidiis', 
            $preqNo,            // preq_no
            $preq_date,         // preq_date
            $preq_descr,        // description
            $originator_id,     // originator_id
            $approver_id,       // approver_id
            $customer_id,       // customer_id
            $domain_id,         // domain_id
            $subdom_id,         // sub_dom_id
            0.00,               // base_cost // $preq_subtotal
            0,                  // status
            0,                  // related request id
            $preq_notes,        // notes
        );

        if ($id > 0) {          // New Purchase Requisition inserted with id: $id

            // Create purchase order list items with the target products for the vendor
            $line_item_query = "INSERT INTO customer_preq_line_items VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";

            $subtotal = 0;

            $inserted = false;  // to detect if any order line item insertion fails (to be used later)

            for ($j = 0; $j < count($arr_product_id); $j++) {

                // echo "Product=". $arr_product_descr[$j] . ", price=". $arr_product_rate[$j] ."<br/>";
            
                $quantity       = $arr_product_qty[$j];    
                $offer_price    = $arr_product_rate[$j];
                $total_cost     = $quantity * $offer_price;
                $subtotal       += $total_cost;
            
                $iid = $opr->sqlInsert($line_item_query, 'iiiidds', 
                    $id,                        // preq_id
                    $arr_product_id[$j],        // catalog_product id
                    $quantity,                  // quantity
                    0,                          // received quantity
                    round($offer_price, 2),     // unit price
                    round($total_cost, 2),      // total cost
                    ''                          // additional info
                );

                if ($iid > 0) {
                    // echo "New Customer PR Line Item inserted with id: " . $iid ."<br/>";
                    $inserted = true;
                }
                else {
                    $inserted = false;
                }
            }    

            if ($inserted) {

                // Update the purchase order with sub-totals
                $update_preq_query = " UPDATE customer_preqs SET base_cost=? WHERE id=?";

                // echo " UPDATE customer_preqs SET base_cost=". $preq_subtotal ." WHERE id=". $id;
                $opr->sqlUpdate($update_preq_query, 'di', $preq_subtotal, $id);

                // Assemble data
                $creator = $_SESSION['userid'];
                $target_to = 0;         // for now
                $timestamp = date('Y-m-d H:i:s', time());
                $type = "info";
                $category = "db_activity";
                $table_str = "customer_preqs";
                $action = "create_preq";
                $status = "processing";
                $route = "Procure listed products";
                $xinfo = "";

                // Create a request to buy products
                $rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "procure_products", $id, $route, 0);

                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("customer_preqs", $id, $rrid, 2); // set old ims_request to closed(2) if existing

                // Fire New Purchase Order Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success

                return  $id;      // "New Purchase Requisition inserted with id: " . $id ."<br/>";
                // exit;
            }
            else {
                // TODO: Rollback

                return -2;    // "Failed to insert all order items. Rolling Back.<br/>";
            }
        }
        else {
            return -1;        // "Unable to create new order.<br/>";
        }

        $opr->close();
    }
    else {
        return -3;                       // "Unable to connect to db";
        // exit;
    }
}

function approveCustomerPurchaseRequisition($customer_preq_id, $approver_id, $approver_note, $approval_status) {

    // echo "customer preqid: "    . $customer_preq_id . "\n";
    // echo "approver_id: "        . $approver_id . "\n";
    // echo "approval_notes: "     . $approver_note . "\n";

    // Approve (2) or Reject (4) the customer purchase requisition
    // echo "status: "             . $approval_status . "\n";

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // Update the given requisition by inserting approval_note and status
        $update_customer_preq_query = "UPDATE customer_preqs SET approver_id=?, approver_notes=?, status=? 
                                        WHERE id=?";

        $success = $opr->sqlUpdate( $update_customer_preq_query, 'isii', 
                                    $approver_id,               // approver_id
                                    $approver_note,             // approver_note
                                    $approval_status,           // status 
                                    $customer_preq_id           // requisition_no
        );

        if ($success) {

            // Assemble data
            $creator = $_SESSION['userid'];
            $target_to = 0;                             // for now
            $timestamp = date('Y-m-d H:i:s', time());
            $type = "info";
            $category = "db_activity";
            $table_str = "customer_preqs";
            $xinfo = "";

            if ($approval_status === '2') {            // approved

                $action = "approve_customer_preq";
                $status = "approved";
                $route = "Allow issuance of PO";

                // Create a request for issuance of PO
                $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "issue_po", $customer_preq_id, $route, 0);
                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("customer_preqs", $customer_preq_id, $new_rrid, 2); // set old ims_request to closed(2) if existing
                // Fire Update Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $customer_preq_id, $action, $status, $route, $xinfo); // true on success
                return 0;                                 // success
            }
            else if ($approval_status == '4') {         // reject

                $action = "reject_customer_preq";
                $status = "rejected";
                $route = "Cancel the purchase requisition";

                // TODO: cancel the PR here or just set status to rejected?

                // Create a request to cancel the order requisition
                $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "cancel_order_requisition", $customer_preq_id, $route, 0);
                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("customer_preqs", $customer_preq_id, $new_rrid, 2); // set old ims_request to closed(2) if existing
                // Fire Update Order Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $customer_preq_id, $action, $status, $route, $xinfo); // true on success
                return 1;                                 // rejected
            }
            else {
                return -1;                                // incorrect status;
            }
        }
        else {
            return -2;                                    // Unable to update requisitions
        }

        $opr->close();
    }
    else {
        return -3;                                        // "Unable to connect to db";
    }
}


/*
 * CUSTOMER PURCHASE ORDERS
 */

function generateCustomerPurchaseOrder( $porder_date, $preq_id, $preq_no, $porder_descr, $originator_id, $customer_id, $issuer_id, 
                                $domain_id, $subdom_id, $sub_total, $vat, $discount, $net_total, $paid_amt, $due,
                                $payment_method, $shipping_method, $shipping, $payment_status, $notes) {

    // echo "Session ID: ". $_SESSION['userid'];  
    
    // Generate a purchase order no
    $porderNo = strtoupper(generateRandomString(8));

    // Insert a new purchase order into 'customer_porders'

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // First check to ensure the source purchase requisition has been approved
        $approval_check_query = "SELECT status FROM customer_preqs WHERE id=? LIMIT 1";
        $result = $opr->sqlSelect($approval_check_query, "i", $preq_id);
        if ($result && $result->num_rows === 1) {
            $approvalchk_row = $result->fetch_assoc();
            $status = $approvalchk_row['status'];

            if ($status !== 2) {
                return -1;                                // the purchase requisition has not been approved
                // exit;
            }

            // only continue if the customer purchase requisition has been approved

            $porder_query = "INSERT INTO customer_porders VALUES 
                            (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0.00, 0, 0, '')";
            $id = $opr->sqlInsert($porder_query, 'ssisiiiii', 
                $porderNo,          // porder_no
                $porder_date,       // porder date
                $preq_id,           // preq_id
                $porder_descr,      // porder description
                $originator_id,     // originator id
                $customer_id,       // customer id
                $issuer_id,         // issuer id
                $domain_id,         // domain_id
                $subdom_id,         // sub_dom_id
                // 0.00,            // subtotal
                // 0.00,            // vat
                // 0.00,            // discount
                // 0.00,            // net_total
                // 0.00,            // paid
                // 0.00,            // due
                // 0,               // payment method
                // 0,               // shipping method
                // 0.00,            // shipping cost
                // 0,               // status
                // 0,               // related request id
                // '',              // notes
            );

            if ($id > 0) {              // New Purchase Order inserted with $id

                // Next get all the line items for this purchase requisition
                $li_query = "SELECT * FROM customer_preq_line_items WHERE preq_id=?";
                $results = $opr->sqlSelect($li_query, "i", $preq_id);
                if ($results && $results->num_rows > 0) {  

                    // Create customer porder list items with the target products for the vendor
                    $line_item_query = "INSERT INTO customer_porder_line_items VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
                    $subtotal = 0;
                    $inserted = false;  // to detect if any order line item insertion fails (to be used later)

                    while ($li_row = $results->fetch_assoc()) {   // iterate over the line items
                        
                        $subtotal += $li_row['total_cost'];

                        // insert item in customer_porder_list_items
                        $iid = $opr->sqlInsert($line_item_query, 'iiiidds', 
                            $id,                                // porder_id
                            $li_row['catalog_product_id'],      // catalog_product id
                            $li_row['quantity'],                // quantity
                            0,                                  // received quantity
                            round($li_row['unit_price'], 2),    // unit price
                            round($li_row['total_cost'], 2),    // total cost
                            ''                                  // additional info
                        );

                        // set the line item status to issued(2) to mark it as handled in the customer preq line item
                        $update_prli_query =   "UPDATE customer_preq_line_items SET status=? WHERE preq_id=? 
                                                AND catalog_product_id=?";

                        // $sqll = "UPDATE customer_preq_line_items SET status=2 WHERE preq_id=". $preq_id ." 
                        //         AND catalog_product_id=". $li_row['catalog_product_id'];
                        // echo $sqll;

                        $opr->sqlUpdate( $update_prli_query, 'iii', 
                                                    2,                              // status (3)
                                                    $preq_id,                       // customer preq id
                                                    $li_row['catalog_product_id']   // catalog_product_id
                        );

                        if ($iid > 0) {
                            $inserted = true;
                        }
                        else {
                            $inserted = false;
                        }
                    }

                    if ($inserted) {
                        // Update the purchase order with sub-totals
                        $update_preq_query = "  UPDATE customer_porders SET sub_total=?, vat=?, discount=?, net_total=?, paid=?, due=?,
                                                payment_method=?, shipping_method=?, shipping_cost=?, status=?, notes=?
                                                WHERE id=?";

                        $opr->sqlUpdate($update_preq_query, 'ddddddiidisi', 
                            $sub_total,                 // subtotal
                            $vat,                       // vat
                            $discount,                  // discount
                            $net_total,                 // net_total
                            $paid_amt,                  // paid
                            $due,                       // due
                            0,                          // payment method ($payment_method but leave for now)
                            0,                          // shipping method ($shipping_method but leave for now)
                            $shipping,                  // shipping cost
                            0,                          // status ($payment_status but leave for now)
                            $notes,                     // purchase order notes
                            $id
                        );

                        // Assemble data
                        $creator = $_SESSION['userid'];
                        $target_to = 0;         // for now
                        $timestamp = date('Y-m-d H:i:s', time());
                        $type = "info";
                        $category = "db_activity";
                        $table_str = "customer_porders";
                        $action = "create_porder";
                        $status = "processing";
                        $route = "Purchase listed products";
                        $xinfo = "";

                        // Create a request to buy products
                        $rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "purchase_products", $id, $route, 0);

                        // Update related request field in the parent to keep track of the request
                        updateRelatedRequest("customer_porders", $id, $rrid, 2); // set old ims_request to closed(2) if existing

                        // Fire New Purchase Order Event!
                        addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success

                        return  $id;          // "New Customer Purchase Order inserted with id: " . $id ."<br/>";
                        // exit;
                    }
                    else {
                        // TODO: Rollback

                        return -2;            // "Failed to insert all order items. Rolling Back.<br/>";
                    }
                }
                else {
                    return -3;                // Unable to find any related order requisition line item;
                }
            }
            else {
                return -4;                    // "Unable to create new order.<br/>";
            }
        }
        else {
            return -5;                        // Unable to find the specified customer requisition;
            // exit;
        }

        $opr->close();
    }
    else {
        return -6;                            // "Unable to connect to db";
        // exit;
    }
}

function receiveCustomerPorderItems($porder_id, $domain_id, $subdom_id, $receiver_id, $receiver_note, $porder_status, 
                                $arr_product_id, $arr_product_sku, $arr_product_rx_qty) {

    // echo "Session ID: ". $_SESSION['userid']; 

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        $creator = $_SESSION['userid'];
        $timestamp = date('Y-m-d H:i:s', time());

        $errors = array();
        $updates = 0;
        $completely_fulfilled = false;

        // Iterate over the product arrays
        for ($i = 0; $i < count($arr_product_id); $i++) {

            // Get the product line item for this product related to the target PO
            $query1 = "SELECT * FROM customer_porder_line_items WHERE porder_id=? AND catalog_product_id=? LIMIT 1";

            $result = $opr->sqlSelect($query1, "ii", $porder_id, $arr_product_id[$i]);
            if ($result && $result->num_rows === 1) {
                $row = $result->fetch_assoc();

                // echo "product id: ". $row['catalog_product_id'] . ", quantity: ". $row['quantity'] . "\n";
                $quantity = $row['quantity'];
                $rx_quantity = $row['rx_quantity'];

                // Perform any validation logic on the quantities
                if ($arr_product_rx_qty[$i] <= 0) {                     // reject and go to next iteration
                    $errors[] = array("pid" => $arr_product_id[$i], "error" => "Incorrect quantity");
                    continue;
                }

                if ($arr_product_rx_qty[$i] + $rx_quantity > $quantity) { // reject and go to next iteration
                    $errors[] = array("pid" => $arr_product_id[$i], "error" => "Quantity exceeds order");
                    continue;
                }

                // Is this line item completely fulfilled
                if ($arr_product_rx_qty[$i] + $rx_quantity === $quantity) {
                    $completely_fulfilled = true;
                }
                else {
                    $completely_fulfilled = false;
                }

                // update the rx_quantity with required quantity $arr_product_rx_qty
                $query2 = " UPDATE customer_porder_line_items SET rx_quantity=? 
                            WHERE porder_id=? AND catalog_product_id=?";
                $opr->sqlUpdate($query2, 'iii', 
                                $arr_product_rx_qty[$i] + $rx_quantity,     // receive qty
                                $porder_id,                                 // purchase order id
                                $arr_product_id[$i]                         // product id
                ); // TODO: handle failure

                // insert a new customer_porder_receive_txn with date, userid, action type, received qty
                $receive_txn_query = "INSERT INTO customer_porder_receive_txns VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
                $opr->sqlInsert(  $receive_txn_query, 'siiiiis', 
                                        $timestamp,                 // txn date
                                        $porder_id,                 // purchase order id
                                        21,                         // action type
                                        $arr_product_id[$i],        // catalogue product id
                                        $arr_product_rx_qty[$i],    // receive qty
                                        $receiver_id,               // user_id
                                        ''                          // notes 
                ); // TODO: handle failure

                // Add item changes to the stock transactions 
                addStockTxn($_SESSION['userid'], 
                            $timestamp, 
                            $domain_id,
                            $subdom_id,
                            "customer_porders",
                            $porder_id, 
                            $arr_product_sku[$i], 
                            $arr_product_rx_qty[$i],
                            21,                 // actionType: requisition item cleared for removal
                            2);                 // status: stock item state: completed

                // ADD to Stock Items
                updateStockItem($domain_id, $subdom_id, $arr_product_sku[$i], $arr_product_rx_qty[$i], 3);

                $updates++; // shows that at least one line item has been updated
            }
            else {

                return -1;               // Unable to find any related po line item
            }
        } 

        $num_errors = count($errors);   // TODO: will handle this later.

        // clear the purchase_order related request. For now, no new related request, set old request to completed(2) 
        // and just update related request field in the parent to keep track of the request
        updateRelatedRequest("customer_porders", $porder_id, 0, 2); 

        // Update the purchase order: 
        // - change the purchase order status to partially fulfilled (1), or fully fulfilled (2). 
        // - Closed is (3) => this has to be manually closed for assurance.
        // - Also append receiver note.

        // echo "porder_status: " . $porder_status . "\n";
        
        $new_status = $porder_status;

        if ($updates > 0) {
            $new_status = 1;
        }

        if ($completely_fulfilled) {
            $new_status = 2;
        }

        // echo "updates: " . $updates . "\n";
        // echo "completely fulfilled: " . $completely_fulfilled . "\n";
        // echo "new_status: " . $new_status . "\n";
        
        $update_customer_porder_query = "UPDATE customer_porders SET notes=?, status=? WHERE id=?";
        $opr->sqlUpdate($update_customer_porder_query, 'sii', 
                        $receiver_note,             // update receiver notes
                        $new_status,                // purchase order status
                        $porder_id                  // purchase order id
        );

        // Fire New Receive Event!
        $type = "info";
        $category = "db_activity";
        $table_str = "purchase_orders";
        $xinfo = "";
        $action = "receive_purchase_order";
        $status = "";
        $route = "";

        if ($new_status === 1) {
            $status = "partially fulfilled";
            $route = "Receive purchase order items";
        }
        else if ($new_status === 2) {
            $status = "fully fulfilled";
            $route = "Close the purchase order";
        }

        // Fire Close or Update Requisition Event!
        addEvent($creator, $timestamp, $type, $category, $table_str, $porder_id, $action, $status, $route, $xinfo); // true on success

        $opr->close();

        return 0;                       // "Successfully received items"
    }
    else {
        return -2;                       // "Unable to connect to db";
        // exit;
    }
}



/*
 * VENDOR PURCHASE REQUISITIONS
 */

function generateVendorPurchaseRequisition( $requester_id, $approver_id, $domain_id, $subdom_id, $vendor_preq_date, 
                                            $vendor_preq_descr, 
                                            $arr_vproduct_id, $arr_vproduct_name, $arr_vproduct_supplier_id, 
                                            $arr_vproduct_supplier, $arr_vproduct_descr, $arr_vproduct_rate, 
                                            $arr_vproduct_qty, $arr_vproduct_total) {

    // echo "Session ID: ". $_SESSION['userid'];  

    // echo "vendor_preq_date: " . $vendor_preq_date . "\n";
    // echo "requester_id: "    . $requester_id . "\n";
    // echo "approver_id: "    . $approver_id . "\n";
    // echo "vendor_preq_descr: " . $vendor_preq_descr . "\n";

    // Generate vendor purchase requisition #
    $vendor_preq_no = strtoupper(generateRandomString(4)) . rand(1000, 9999);

    // Insert a new vendor preq into 'vendor_preqs'

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // $test_str = "'".$vendor_preq_date."',".$vendor_preq_no.",".$domain_id.",".$subdom_id.",".$vendor_preq_descr.",";
        // $test_str .= $requester_id.",".$approver_id.",'',0.00,0";
        // echo $test_str;

        $vendor_preq_query = "INSERT INTO vendor_preqs VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        $id = $opr->sqlInsert($vendor_preq_query, 'ssiisiisdi', 
                                $vendor_preq_date,        // order date
                                $vendor_preq_no,          // order requisition number
                                $domain_id,               // domain_id
                                $subdom_id,               // sub_dom_id
                                $vendor_preq_descr,       // requisition description
                                $requester_id,            // requester id
                                $approver_id,             // approver id
                                '',                       // approver notes
                                0.00,                     // base cost
                                0,                        // status
                            );

        if ($id > 0) {      // echo "New Order Requisition inserted with $id 

            // Create order list items with the target products for the vendor
            $line_item_query = "INSERT INTO vendor_preq_line_items VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 0)";

            $base_cost = 0;

            $inserted = false;  // to detect if any order line item insertion fails (to be used later)

            for ($j = 0; $j < count($arr_vproduct_id); $j++) {
                //echo "VProduct=". $arr_vproduct_descr[$j] . ", price=". $arr_vproduct_rate[$j] ."<br/>";
                $quantity       = $arr_vproduct_qty[$j];    
                $rate           = $arr_vproduct_rate[$j];
                $total_cost     = $quantity * $rate;
                $base_cost       += $total_cost;

                // echo $arr_vproduct_supplier_id[$j];
            
                $iid = $opr->sqlInsert($line_item_query, 'iiidids', 
                    $id,                            // order_requisition_id
                    $arr_vproduct_supplier_id[$j],  // vendor id
                    $arr_vproduct_id[$j],           // vendor_product id
                    round($rate, 2),                // rate
                    $quantity,                      // quantity
                    round($total_cost, 2),          // total cost
                    ''                              // additional info
                );

                if ($iid > 0) {
                    //echo "New Order Line Item inserted with id: " . $iid ."<br/>";
                    $inserted = true;
                }
                else {
                    $inserted = false;
                }
            }    

            if ($inserted) {
                // Update the order with sub-totals
                $update_order_requisition_query = "UPDATE vendor_preqs SET base_cost=?, status=? WHERE id=?";
                $opr->sqlUpdate($update_order_requisition_query, 'dii', 
                                $base_cost,                 // subtotal
                                0,                          // status ($payment_status but leave for now)
                                $id
                );

                // Assemble data
                $creator = $_SESSION['userid'];
                $target_to = 0;         // for now
                $timestamp = date('Y-m-d H:i:s', time());
                $type = "info";
                $category = "db_activity";
                $table_str = "vendor_preqs";
                $action = "create_vendor_preq";
                $status = "processing";
                $route = "Request approval for requisition";
                $xinfo = "";

                // Create a request for approval
                $rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "approve_vendor_preq", $id, $route, 0);

                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("vendor_preqs", $id, $rrid, 2); // set old ims_request to closed(2) if existing

                // Fire New Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success

                return  $id;              // "New vendor preq inserted with id: " . $id ."<br/>";
                // exit;

            }
            else {
                // TODO: Rollback

                return -2;            // "Failed to insert all order items. Rolling Back.<br/>";
            }
        }
        else {
            return -1;                    // "Unable to create new order.<br/>";
        }

        $opr->close();
    }
    else {
        return -3;                       // "Unable to connect to db";
        // exit;
    }
}

function approveVendorPurchaseRequisition($vendor_preq_id, $approver_id, $approver_note, $approval_status) {

    // echo "vendor requisitionid: " . $vendor_preq_id . "\n";
    // echo "approver_id: "    . $approver_id . "\n";
    // echo "approval_notes: " . $approver_note . "\n";

    // Approve (2) or Reject (4) the vendor purchase requisition
    // echo "status: "         . $approval_status . "\n";

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // Update the given requisition by inserting approval_note and status
        $update_vendor_preq_query = "UPDATE vendor_preqs SET approver_id=?, approver_notes=?, status=? 
                                     WHERE id=?";

        $success = $opr->sqlUpdate( $update_vendor_preq_query, 'isii', 
                                    $approver_id,               // approver_id
                                    $approver_note,             // approver_note
                                    $approval_status,           // status 
                                    $vendor_preq_id       // requisition_no
                                );

        if ($success) {

            // Assemble data
            $creator = $_SESSION['userid'];
            $target_to = 0;                             // for now
            $timestamp = date('Y-m-d H:i:s', time());
            $type = "info";
            $category = "db_activity";
            $table_str = "vendor_preqs";
            $xinfo = "";

            if ($approval_status === '2') {            // approved

                $action = "approve_vendor_preq";
                $status = "approved";
                $route = "Allow issuance of PO";

                // Create a request for issuance of PO
                $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "issue_po", $vendor_preq_id, $route, 0);
                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("vendor_preqs", $vendor_preq_id, $new_rrid, 2); // set old ims_request to closed(2) if existing
                // Fire Update Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $vendor_preq_id, $action, $status, $route, $xinfo); // true on success
                return 0;                                 // success
            }
            else if ($approval_status == '4') {         // reject

                $action = "reject_vendor_preq";
                $status = "rejected";
                $route = "Cancel the purchase requisition";

                // Create a request to cancel the order requisition
                $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "cancel_purchase_requisition", $vendor_preq_id, $route, 0);
                // Update related request field in the parent to keep track of the request
                updateRelatedRequest("vendor_preqs", $vendor_preq_id, $new_rrid, 2); // set old ims_request to closed(2) if existing
                // Fire Update Order Requisition Event!
                addEvent($creator, $timestamp, $type, $category, $table_str, $vendor_preq_id, $action, $status, $route, $xinfo); // true on success
                return 1;                                 // rejected
            }
            else {
                return -1;                                // incorrect status;
            }
        }
        else {
            return -2;                                    // Unable to update requisitions
        }

        $opr->close();
    }
    else {
        return -3;                                        // "Unable to connect to db";
    }
}



/*
 * VENDOR PURCHASE ORDERS
 */

function generateVendorPurchaseOrder($requester_id, $issuer_id, $vendor_id, $porder_date, $preq_id, $preq_no, 
                                    $domain_id, $subdom_id,
                                    $porder_descr, $sub_total, $vat, $discount, $total_amt, $grand_total, $paid_amt, 
                                    $due, $shipping, $shipping_method, $payment_method, $payment_status, $issuer_notes) {
    // echo "Session ID: ". $_SESSION['userid'];  

    // echo "order date: "             . $porder_date . "\n";
    // echo "requester id: "           . $requester_id . "\n";
    // echo "issuer id: "              . $issuer_id . "\n";
    // echo "domain id: "              . $domain_id . "\n";
    // echo "subdomain id: "           . $subdom_id . "\n";
    // echo "order requisition id: "   . $preq_id . "\n";
    // echo "order requisition no: "   . $preq_no . "\n";
    // echo "vendor id: "              . $vendor_id . "\n";
    // echo "order description: "      . $porder_descr . "\n";
    // echo "sub_total: "              . $sub_total . "\n";
    // echo "vat: "                    . $vat . "\n";
    // echo "discount: "               . $discount . "\n";
    // echo "total amt: "              . $total_amt . "\n";
    // echo "grand total: "            . $grand_total . "\n";
    // echo "paid amount: "            . $paid_amt . "\n";
    // echo "due: " . $due             . "\n";
    // echo "shipping: "               . $shipping . "\n";
    // echo "shipping method: "        . $shipping_method . "\n";
    // echo "payment method: "         . $payment_method . "\n";
    // echo "payment status: "         . $payment_status . "\n";
    // echo "issuer notes: "           . $issuer_notes . "\n";

    // Generate a vendor order no
    $porder_no = strtoupper(generateRandomString(8));

    // Insert a new vendor order into 'orders'
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // First check to ensure the source vendor preq has been approved
        $approve_check_query = "SELECT status FROM vendor_preqs WHERE id=? LIMIT 1";
        $result = $opr->sqlSelect($approve_check_query, "i", $preq_id);
        if ($result && $result->num_rows === 1) {
            $approve_check_row = $result->fetch_assoc();
            $status = $approve_check_row['status'];

            if ($status !== 2) {
                return -1;                         // the requisition is not in approved state
                // exit;
            }

            // Proceed with PO Creation
            $porder_query = "INSERT INTO vendor_porders VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0.00, 0, 0)";
            $id = $opr->sqlInsert($porder_query, 'ssiiiiiiss', 
                                    $porder_no,             // porder_no
                                    $porder_date,           // porder_date
                                    $preq_id,               // src_requisition_id
                                    $domain_id,             // domain_id
                                    $subdom_id,             // sub_dom_id
                                    $vendor_id,             // vendor_id
                                    $requester_id,          // requester_id
                                    $issuer_id,             // issuer_id
                                    $issuer_notes,          // issuer_notes
                                    $porder_descr,          // order_descr
                                    // 0.00,                // sub_total
                                    // 0.00,                // vat
                                    // 0.00,                // discount
                                    // 0.00,                // net_total
                                    // 0.00,                // paid
                                    // 0.00,                // due
                                    // 0,                   // payment method
                                    // 0,                   // shipping method
                                    // 0.00,                // shipping cost
                                    // 0,                   // status
                                    // 0                    // related request id
                                );
    
            if ($id > 0) {     // New Order inserted with $id
    
                // Next get all the line items for this order requisition and vendor
                $li_query = "SELECT * FROM vendor_preq_line_items WHERE preq_id=? AND vendor_id=?";
                $results = $opr->sqlSelect($li_query, "ii", $preq_id, $vendor_id);

                if ($results && $results->num_rows > 0) {  
                    // Create vendor porder list items with the target products for the vendor
                    $line_item_query = "INSERT INTO vendor_porder_line_items VALUES (NULL, ?, ?, ?, ?, ?, ?)"; 
    
                    $subtotal = 0;
    
                    $inserted = false;  // to detect if any order line item insertion fails (to be used later)
    
                    while ($li_row = $results->fetch_assoc()) {   // iterate over the line items
                        $subtotal += $li_row['total'];
    
                        // insert item in vendor_porder_list_items
                        $iid = $opr->sqlInsert($line_item_query, 'iiidds', 
                                                $id,                                // order_id
                                                $li_row['vendor_product_id'],       // vendor_product id
                                                $li_row['quantity'],                // quantity
                                                round($li_row['rate'], 2),          // unit price
                                                round($li_row['total'], 2),         // total cost
                                                ''                                  // additional info
                                            );
    
                        // set the line item status to issued(2) to mark it as handled in the order requisition line item
                        $update_prli_query =   "UPDATE vendor_preq_line_items SET status=? WHERE preq_id=? 
                                                AND vendor_id=? AND vendor_product_id=?";
                        $opr->sqlUpdate( $update_prli_query, 'iiii', 
                                                    2,                              // status (2)
                                                    $preq_id,                       // preq_id
                                                    $vendor_id,                     // vendor id 
                                                    $li_row['vendor_product_id']    // vendor product id
                        );
    
                        if ($iid > 0) {
                            $inserted = true;
                        }
                        else {
                            $inserted = false;
                        }
                    }
    
                    if ($inserted) {
                        // Update the vendor_porder with sub-totals
                        $update_porder_query = " UPDATE vendor_porders SET sub_total=?, vat=?, discount=?, net_total=?, paid=?, due=?,
                                                payment_method=?, shipping_method=?, shipping_cost=?, status=?
                                                WHERE id=?";
        
                        $opr->sqlUpdate($update_porder_query, 'ddddddiidii', 
                            $sub_total,                 // subtotal
                            $vat,                       // vat
                            $discount,                  // discount
                            $total_amt,                 // net_total
                            $paid_amt,                  // paid
                            $due,                       // due
                            0,                          // payment method ($payment_method but leave for now)
                            0,                          // shipping method ($shipping_method but leave for now)
                            $shipping,                  // shipping cost
                            0,                          // status ($payment_status but leave for now)
                            $id
                        );
        
                        // Assemble data
                        $creator = $_SESSION['userid'];
                        $target_to = 0;         // for now
                        $timestamp = date('Y-m-d H:i:s', time());
                        $type = "info";
                        $category = "db_activity";
                        $table_str = "vendor_porders";
                        $action = "create_vendor_order";
                        $status = "processing";
                        $route = "Purchase listed products";
                        $xinfo = "";
        
                        // Create a request to buy products
                        $rrid = addRequest($creator, $target_to, $timestamp, 1, $category, $table_str, "purchase_products", $id, $route, 0);
        
                        // Update related request field in the parent to keep track of the request
                        updateRelatedRequest("vendor_porders", $id, $rrid, 2); // set old ims_request to closed(2) if existing
        
                        // Fire New Vendor Order Event!
                        addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success
        
                        return  $id;      // "New Purchase Order inserted with id: " . $id ."<br/>";
                        // exit;
                    }
                    else {
                        // TODO: Rollback
                        return -2;        // "Failed to insert all order items. Rolling Back.<br/>";
                    }
                }
                else {
                    return -3;            // Unable to find any related order requisition line item;
                }
            }
            else {
                return -4;                // "Unable to create new order.<br/>";
            }        
        }
        else {
            return -5;                   // Unable to find the specified order requisition;
        }

        $opr->close();
    }
    else {
        return -6;                        // "Unable to connect to db";
        // exit;
    }  
}


// // function createVendorOrders($order_requisition_id, $issuer_id, $issuer_note, $order_requisition_createorder) {

// //     // echo "order_requisition_id: " . $order_requisition_id . "\n";
// //     // echo "issuer_id: "    . $issuer_id . "\n";
// //     // echo "issuer_note: "  . $issuer_note . "\n";
// //     // echo "status: "       . $order_requisition_createorder . "\n";

// //     $opr = new DBOperation();

// //     if ($opr->dbConnected()) {

// //         // First check to ensure the requisition has been approved
// //         $query1 = "SELECT status FROM order_requisitions WHERE id=? LIMIT 1";
// //         $result = $opr->sqlSelect($query1, "i", $order_requisition_id);
// //         if ($result && $result->num_rows === 1) {
// //             $row = $result->fetch_assoc();
// //             $status = $row['status'];

// //             if ($status === 0) {
// //                 echo -7;                                // the requisition has not been approved
// //             }
// //             else if ($status === 2) {                   // only continue if the order requisition has been approved

// //                 // TODO: group the order requisition items by vendor and create an order for each vendor

// //                 // Now update the given order requisition by inserting issuer_note and status
// //                 $query2 = "UPDATE order_requisitions SET issuer_id=?, issuer_notes=?, status=? WHERE id=?";
// //                 $success = $opr->sqlUpdate( $query2, 'isii', 
// //                                             $issuer_id,                         // issuer_id
// //                                             $issuer_note,                       // issuer_note
// //                                             $order_requisition_createorder,     // status 
// //                                             $order_requisition_id               // requisition_no
// //                 );

// //                 if ($success) {
// //                     echo "Issuer notes updated!";

// //                     // // Assemble data
// //                     // $creator = $_SESSION['userid'];
// //                     // $timestamp = date('Y-m-d H:i:s', time());
// //                     // $type = "info";
// //                     // $category = "db_activity";
// //                     // $table_str = "requisitions";
// //                     // $xinfo = "";

// //                     // if ($storekeeper_status === '3') {            // completed
// //                     //     $action = "complete_requisition";
// //                     //     $status = "completed";
// //                     //     $route = "Close the requisition";
// //                     //     // Update related request field in the parent to keep track of the request
// //                     //     updateRelatedRequest("requisitions", $requisition_id, 0, 2); // no new related request, set old to completed(2)
// //                     //     // Fire Close Requisition Event!
// //                     //     addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
// //                     //     echo 0;                                     // success
// //                     // }
// //                     // else if ($storekeeper_status == '4') {          // storekeeper reject
                        
// //                     //     $action = "reject_requisition";
// //                     //     $status = "rejected";
// //                     //     $route = "Close the requisition";
                        
// //                     //     // For now, no new related request, set old to completed(2) and just update 
// //                     //     // related request field in the parent to keep track of the request
// //                     //     updateRelatedRequest("requisitions", $requisition_id, 0, 2);            

// //                     //     // In situation a new request required for reject to reinitiate a new procedure
// //                     //     // 1. Set the request target
// //                     //     // $target_to = 0;                           // for now
// //                     //     // 2. Create a request for rejection of stock (if needed!)
// //                     //     // $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, "requisitions", "release_items", $requisition_id, $route, 0);                                    
// //                     //     // 3. Then set the old ims_request to closed(2) if existing
// //                     //     // updateRelatedRequest("requisitions", $requisition_id, $new_rrid, 2); 

// //                     //     // Fire Close or Update Requisition Event!
// //                     //     addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
// //                     //     echo 1;             // rejected
// //                     // }
// //                     // else {
// //                     //     echo -1;            // incorrect status;
// //                     // }
// //                 }
// //                 else {
// //                     echo -2;                // Unable to update requisitions
// //                 }

// //             }
// //             else {
// //                 echo -9;                                // Other problem with the requisition
// //             }
                
// //     //             // Next get all the pending line items for this requisition
// //     //             $query2 = "SELECT * FROM requisition_line_items WHERE requisition_id=?";
// //     //             $results = $opr->sqlSelect($query2, "i", $requisition_id);
// //     //             if ($results && $results->num_rows > 0) {   
                    
// //     //                 $stock_available = false;

// //     //                 while ($data = $results->fetch_assoc()) {   // iterate over the line items
// //     //                     $sku = $data['sku'];
// //     //                     $requested_qty = $data['requested_qty'];

// //     //                     // Confirm if there is sufficient quantity for each item in stock
// //     //                     $query3 = "SELECT * FROM stock WHERE sku=?";
// //     //                     $result = $opr->sqlSelect($query3, "s", $sku);
// //     //                     if ($result && $result->num_rows === 1) {
// //     //                         $row = $result->fetch_assoc();
// //     //                         // $curr_stock_level = $row['curr_stock_level'];
// //     //                         $pending_reserved = $row['pending_reserved'];

// //     //                         // echo "SKU: "                . $sku . "  ";
// //     //                         // echo "Req_Qty: "            . $requested_qty . "  ";
// //     //                         // //echo "Curr_Stock_Level: " . $curr_stock_level . "  ";
// //     //                         // echo "Pending_Rsvd: "       . $pending_reserved . "\n";

// //     //                         // Confirm if this iteration is ok and update to true if 
// //     //                         // stock is ok on this iteration, else false
// //     //                         if ($requested_qty <= $pending_reserved) {
// //     //                             $stock_available = true;
// //     //                         }
// //     //                         else {
// //     //                             $stock_available = false;
// //     //                         }
// //     //                     }
// //     //                     else {
// //     //                         echo -5;            // Unable to find sku in stock
// //     //                     }
// //     //                 }

// //     //                 if ($stock_available) {

// //     //                     // Clear the items for removal by updating stock transactions & stock quantities
// //     //                     // $query4 = "SELECT * FROM stock_txns WHERE requisition_id=? AND status=0"; // only if status is 0
// //     //                     // $results = $opr->sqlSelect($query4, "i", $requisition_id);
// //     //                     $query4 = "SELECT * FROM requisition_line_items WHERE requisition_id=?"; 
// //     //                     $results = $opr->sqlSelect($query4, "i", $requisition_id);
// //     //                     if ($results && $results->num_rows > 0) {        
// //     //                         while ($data = $results->fetch_assoc()) {

// //     //                             // Add item changes to the stock transactions 
// //     //                             addStockTxn($_SESSION['userid'], 
// //     //                                         date('Y-m-d H:i:s'), 
// //     //                                         "requisitions",
// //     //                                         $requisition_id, 
// //     //                                         $data['sku'], 
// //     //                                         $data['requested_qty'],
// //     //                                         13,                 // actionType: requisition item cleared for removal
// //     //                                         2);                 // status: stock item state: completed

// //     //                             // Change the stock line item's quantity as well, releasing the stock to the requester
// //     //                             updateStockItem($data['sku'], $data['requested_qty'], 2);   // status completed=2

// //     //                             // Update requisition line item issued quantity
// //     //                             $query5 = "UPDATE requisition_line_items SET issued_qty=? WHERE requisition_id=? AND sku=?";
// //     //                             $opr->sqlUpdate( $query5, 'iis', 
// //     //                                                         $data['requested_qty'],         // issued qty
// //     //                                                         $requisition_id,                // requisition id
// //     //                                                         $data['sku']                    // sku
// //     //                             );
// //     //                         }

// //     //                         // Now update the given requisition by inserting storekeeper_note and status
// //     //                         $query6 = "UPDATE requisitions SET storekeeper_id=?, storekeeper_notes=?, status=? WHERE id=?";
// //     //                         $success = $opr->sqlUpdate( $query6, 'isii', 
// //     //                                                     $storekeeper_id,            // storekeeper_id
// //     //                                                     $storekeeper_note,          // storekeeper_note
// //     //                                                     $storekeeper_status,        // status 
// //     //                                                     $requisition_id             // requisition_no
// //     //                         );

// //     //                         if ($success) {
// //     //                             //echo "Storekeeper notes updated!";

// //     //                             // Assemble data
// //     //                             $creator = $_SESSION['userid'];
// //     //                             $timestamp = date('Y-m-d H:i:s', time());
// //     //                             $type = "info";
// //     //                             $category = "db_activity";
// //     //                             $table_str = "requisitions";
// //     //                             $xinfo = "";

// //     //                             if ($storekeeper_status === '3') {            // completed
// //     //                                 $action = "complete_requisition";
// //     //                                 $status = "completed";
// //     //                                 $route = "Close the requisition";
// //     //                                 // Update related request field in the parent to keep track of the request
// //     //                                 updateRelatedRequest("requisitions", $requisition_id, 0, 2); // no new related request, set old to completed(2)
// //     //                                 // Fire Close Requisition Event!
// //     //                                 addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
// //     //                                 echo 0;                                     // success
// //     //                             }
// //     //                             else if ($storekeeper_status == '4') {          // storekeeper reject
                                    
// //     //                                 $action = "reject_requisition";
// //     //                                 $status = "rejected";
// //     //                                 $route = "Close the requisition";
                                    
// //     //                                 // For now, no new related request, set old to completed(2) and just update 
// //     //                                 // related request field in the parent to keep track of the request
// //     //                                 updateRelatedRequest("requisitions", $requisition_id, 0, 2);            
 
// //     //                                 // In situation a new request required for reject to reinitiate a new procedure
// //     //                                 // 1. Set the request target
// //     //                                 // $target_to = 0;                           // for now
// //     //                                 // 2. Create a request for rejection of stock (if needed!)
// //     //                                 // $new_rrid = addRequest($creator, $target_to, $timestamp, 1, $category, "requisitions", "release_items", $requisition_id, $route, 0);                                    
// //     //                                 // 3. Then set the old ims_request to closed(2) if existing
// //     //                                 // updateRelatedRequest("requisitions", $requisition_id, $new_rrid, 2); 

// //     //                                 // Fire Close or Update Requisition Event!
// //     //                                 addEvent($creator, $timestamp, $type, $category, $table_str, $requisition_id, $action, $status, $route, $xinfo); // true on success
// //     //                                 echo 1;             // rejected
// //     //                             }
// //     //                             else {
// //     //                                 echo -1;            // incorrect status;
// //     //                             }
// //     //                         }
// //     //                         else {
// //     //                             echo -2;                // Unable to update requisitions
// //     //                         }
// //     //                     }
// //     //                     else {
// //     //                         echo -4;                    // "Unable to find any related stock transactions";
// //     //                     }
// //     //                 }
// //     //                 else {
                        
// //     //                     echo -6;                        // Reject entire operation as there is insufficient 
// //     //                                                     // stock to meet the requisition demands

// //     //                 }
// //     //             }
// //     //             else {
// //     //                 echo -4;                            // Unable to find any related requisition line items;
// //     //             }
// //     //         }
// //     //         else if ($status === 3) {
// //     //             echo -8;                                // The requisition has already been completed
// //     //         }
// //     //         else {
// //     //             echo -9;                                // Other problem with the requisition
// //     //         }



// //         }
// //         else {
// //             echo -10;                                        // Unable to find the specified order requisition;
// //         }

// //         $opr->close();
// //     }
// //     else {
// //         echo -3;                                // "Unable to connect to db";
// //     }
// // }

// function receivePurchaseOrder($porder_id, $receiver_id, $receiver_note, $porder_status, 
//                                 $arr_product_id, $arr_product_sku, $arr_product_rx_qty) {

//     // echo "receivePurchaseOrder\n";
//     // echo "Session ID: ". $_SESSION['userid']; 

//     $opr = new DBOperation();

//     if ($opr->dbConnected()) {

//         $creator = $_SESSION['userid'];
//         $timestamp = date('Y-m-d H:i:s', time());

//         $errors = array();
//         $updates = 0;
//         $completely_fulfilled = false;

//         // Iterate over the product arrays
//         for ($i = 0; $i < count($arr_product_id); $i++) {

//             // Get the product line item for this product related to the target PO
//             $query1 = "SELECT * FROM purchase_order_line_items WHERE porder_id=? AND catalog_product_id=? LIMIT 1";
//             $result = $opr->sqlSelect($query1, "ii", $porder_id, $arr_product_id[$i]);
//             if ($result && $result->num_rows === 1) {
//                 $row = $result->fetch_assoc();

//                 // echo "product id: ". $row['catalog_product_id'] . ", quantity: ". $row['quantity'] . "\n";
//                 $quantity = $row['quantity'];
//                 $rx_quantity = $row['rx_quantity'];

//                 // Perform any validation logic on the quantities
//                 if ($arr_product_rx_qty[$i] <= 0) { // reject and go to next iteration
//                     $errors[] = array("pid" => $arr_product_id[$i], "error" => "Incorrect quantity");
//                     continue;
//                 }

//                 if ($arr_product_rx_qty[$i] + $rx_quantity > $quantity) { // reject and go to next iteration
//                     $errors[] = array("pid" => $arr_product_id[$i], "error" => "Quantity exceeds order");
//                     continue;
//                 }

//                 // Is this line item completely fulfilled
//                 if ($arr_product_rx_qty[$i] + $rx_quantity === $quantity) {
//                     $completely_fulfilled = true;
//                 }
//                 else {
//                     $completely_fulfilled = false;
//                 }

//                 // update the rx_quantity with required quantity $arr_product_rx_qty
//                 $query2 = " UPDATE purchase_order_line_items SET rx_quantity=? 
//                             WHERE porder_id=? AND catalog_product_id=?";
//                 $opr->sqlUpdate($query2, 'iii', 
//                                 $arr_product_rx_qty[$i] + $rx_quantity,     // receive qty
//                                 $porder_id,                                 // purchase order id
//                                 $arr_product_id[$i]                         // product id
//                 ); // TODO: handle failure

//                 // insert a new purchase_order_receive_txn with date, userid, action type, received qty
//                 $receive_txn_query = "INSERT INTO purchase_order_receive_txns VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
//                 $opr->sqlInsert(  $receive_txn_query, 'siiiiis', 
//                                         $timestamp,                 // txn date
//                                         $porder_id,                 // purchase order id
//                                         21,                         // action type
//                                         $arr_product_id[$i],        // catalogue product id
//                                         $arr_product_rx_qty[$i],    // receive qty
//                                         $receiver_id,               // user_id
//                                         ''                          // notes 
//                 ); // TODO: handle failure

//                 // Add item changes to the stock transactions 
//                 addStockTxn($_SESSION['userid'], 
//                             $timestamp, 
//                             "Default",
//                             "purchase_orders",
//                             $porder_id, 
//                             $arr_product_sku[$i], 
//                             $arr_product_rx_qty[$i],
//                             21,                 // actionType: requisition item cleared for removal
//                             2);                 // status: stock item state: completed

//                 // ADD to Stock Items
//                 updateStockItem("Default", $arr_product_sku[$i], $arr_product_rx_qty[$i], 3);

//                 $updates++; // shows that at least one line item has been updated
//             }
//             else {
//                 $errors[] = array("pid" => $arr_product_id[$i], "error" => "Unable to find any related po line item");
//                 echo -4;                                                    // Unable to find any related po line item
//             }
//         } 

//         $num_errors = count($errors);   // TODO: will handle this later.

//         // clear the purchase_order related request. For now, no new related request, set old request to completed(2) 
//         // and just update related request field in the parent to keep track of the request
//         updateRelatedRequest("purchase_orders", $porder_id, 0, 2); 

//         // Update the purchase order: 
//         // - change the purchase order status to partially fulfilled (1), or fully fulfilled (2). 
//         // - Closed is (3) => this has to be manually closed for assurance.
//         // - Also append receiver note.

//         echo "porder_status: " . $porder_status . "\n";
        
//         $new_status = $porder_status;

//         if ($updates > 0) {
//             $new_status = 1;
//         }

//         if ($completely_fulfilled) {
//             $new_status = 2;
//         }

//         echo "updates: " . $updates . "\n";
//         echo "completely fulfilled: " . $completely_fulfilled . "\n";
//         echo "new_status: " . $new_status . "\n";
        
//         $update_purchase_order_query = "UPDATE purchase_orders SET notes=?, status=? WHERE id=?";
//         $opr->sqlUpdate($update_purchase_order_query, 'sii', 
//                         $receiver_note,             // update receiver notes
//                         $new_status,                // purchase order status
//                         $porder_id                  // purchase order id
//         );

//         // Fire New Receive Event!
//         $type = "info";
//         $category = "db_activity";
//         $table_str = "purchase_orders";
//         $xinfo = "";
//         $action = "receive_purchase_order";
//         $status = "";
//         $route = "";

//         if ($new_status === 1) {
//             $status = "partially fulfilled";
//             $route = "Receive purchase order items";
//         }
//         else if ($new_status === 2) {
//             $status = "fully fulfilled";
//             $route = "Close the purchase order";
//         }

//         // Fire Close or Update Requisition Event!
//         addEvent($creator, $timestamp, $type, $category, $table_str, $porder_id, $action, $status, $route, $xinfo); // true on success

//         $opr->close();
//     }
//     else {
//         echo -3;                       // "Unable to connect to db";
//         exit;
//     }
// }


/*
 * CUSTOMER INLINE ORDERS
 */

function generateInlineOrder() {
    
    // echo "Session ID: ". $_SESSION['userid']; 

    echo "PAYMENT PROCESSING...\n";
}

/*
 * UTILITIES
 */

function addEvent($generatedBy, $timestamp, $type, $category, $table_str='', $table_id=0, $action, $status, $route='', $xinfo='') {

    // echo "Adding event for creator id: " . $creator;

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        $query = "INSERT INTO ims_events VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $id = $opr->sqlInsert($query, 'ssssisssis', 
            $timestamp,                 // created_on (timestamp)
            $type,                      // type e.g. 'info', 'error'
            $category,                  // category e.g. 'user_access', 'db_activity'
            $table_str,                 // related table if exists
            $table_id,                  // related table id if table exists
            $action,                    // action_verb e.g. 'login_user', 'create_requisition', 'register_user', 'approve_requisition'
            $status,                    // current status e.g. 'processing', 'completed'
            $route,                     // next action
            $generatedBy,               // user account of the event triggering operation
            $xinfo                      // extra information
        );

        if ($id > 0) {                  // A new event has been created with this id     
            return $id;
        }
        else {
            return -1;                  // Unable to insert this event
        }
    }
    else {
        return -3;                      // "Unable to connect to db";
        exit;
    }
}

function addRequest($generatedBy, $targetTo, $timestamp, $request_type, $request_category, $tableStr, $op_code, $recordId=0, $xinfo="", $request_status=0) {

    // echo "Adding record for creator id: " . $generatedBy;

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        $query = "INSERT INTO ims_requests VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $id = $opr->sqlInsert($query, 'siiisssisi', 
            $timestamp,                 // created_on (timestamp)
            $generatedBy,    
            $targetTo,           
            $request_type,                     
            $request_category,                  
            $tableStr,
            $op_code,                    
            $recordId,                 
            $xinfo,
            $request_status                      
        );

        if ($id > 0) {                  // A new request has been created with this id     
            return $id;
        }
        else {
            return -1;                  // Unable to insert this event
        }
    }
    else {
        return -3;                      // "Unable to connect to db";
        exit;
    }
}

function addStockTxn($userId, $txn_date, $domainId, $subdomId, $tableStr, $recordId, $sku, $qty, $actionType=0, $status=0) {

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        $query = "INSERT INTO stock_txns VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $id = $opr->sqlInsert($query, 'siisisiiii', 
            $txn_date,                 // created_on (timestamp)
            $domainId,
            $subdomId,
            $tableStr,
            $recordId,               
            $sku,  
            $qty,                   
            $actionType,                  
            $status, 
            $userId                    
        );

        if ($id > 0) {                  // A new event has been created with this id     
            return $id;
        }
        else {
            return -1;                  // Unable to insert this event
        }
    }
    else {
        return -3;                      // "Unable to connect to db";
        exit;
    }
}


// ims_request status: 0=open/pending, 1=onhold, 2=closed
function updateRelatedRequest($table, $id, $new_rrid, $status_of_old) { // set $rrid to 0 if no new request is associated

    // echo $id;
    // echo $new_rrid;
    // echo $status_of_old;

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        $rel_request_id = 0;

        // Get the existing related request id
        $query = "SELECT rel_request_id FROM ". $table ." WHERE id=? LIMIT 1";
        $result = $opr->sqlSelect($query, "i", $id);
        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $rel_request_id = $row['rel_request_id'];
            if ($rel_request_id > 0) {
                // Set the related request to given status in parameter
                $query2 = "UPDATE ims_requests SET status=? WHERE id=?";
                $opr->sqlUpdate($query2, 'ii', $status_of_old, $rel_request_id);
            }
        }

        // Now update the parent table with the new related request id
        $query3 = "UPDATE ". $table ." SET rel_request_id=? WHERE id=?";
        $success = $opr->sqlUpdate($query3, 'ii', $new_rrid, $id);
        if ($success) {
            return 0;
        }
        else {
            return -2;  // unable to update the db
        }
    }
    else {
        return -1;                      // "Unable to connect to db";
        exit;
    }
}

function updateStockItem($domain_id, $subdom_id, $sku, $qty_required, $status) {

    $opr = new DBOperation();

    if ($opr->dbConnected()) {

        // First get the line item
        $query = "SELECT * FROM stock WHERE sku=? AND domain_id=? AND sub_dom_id=? LIMIT 1";
        $result = $opr->sqlSelect($query, "sii", $sku, $domain_id, $subdom_id);
        if ($result && $result->num_rows === 1) {
            $stock_item = $result->fetch_assoc();
            $curr_stock_level = $stock_item['curr_stock_level'];
            $pending_reserved = $stock_item['pending_reserved'];
            $success = false;

            switch($status) {
                case 0: // status pending approval, only change the pending_reserved
                    $pending_reserved = $pending_reserved + $qty_required;
                    $success = $opr->sqlUpdate('UPDATE stock SET pending_reserved=? 
                                                WHERE sku=? AND domain_id=? AND sub_dom_id=?', 
                                                'isii', $pending_reserved, $sku, $domain_id, $subdom_id); // returns bool
                    break;
                case 2: // status approved and completed
                    $pending_reserved = $pending_reserved - $qty_required;
                    $curr_stock_level = $curr_stock_level - $qty_required;
                    $success = $opr->sqlUpdate('UPDATE stock SET pending_reserved=?, curr_stock_level=? 
                                                WHERE sku=? AND domain_id=? AND sub_dom_id=?', 
                                                'iisii', $pending_reserved, $curr_stock_level, $sku, $domain_id, $subdom_id); // returns bool
                    break;
                case 3: // add new stock items (resolution of a purchase order)
                    $curr_stock_level = $curr_stock_level + $qty_required;
                    $success = $opr->sqlUpdate('UPDATE stock SET curr_stock_level=? 
                                                WHERE sku=? AND domain_id=? AND sub_dom_id=?', 
                                                'isii', $curr_stock_level, $sku, $domain_id, $subdom_id); // returns bool
                    break;
                default: 
                    $success = false;
                    break;
            }
    
            if ($success) {                     
                return 0;
            }
            else {
                return -1;                  // Unable to update this event
            }
        } 
    }
    else {
        return -3;                      // "Unable to connect to db";
        exit;
    }
}


// Get the catalog price based on set of criteria e.g. least cost, quality, etc

function runPriceDiscovery() {

}


?>