<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Get all Vendors
if (isset($_POST["get_all_vendors"])) {
    echo json_encode(getAllVendors());
}

// Get Vendor by Id
if (isset($_POST["get_vendor_by_id"]) && isset($_POST['vendorid'])) {
    echo json_encode(getVendorById($_POST['vendorid']));
}