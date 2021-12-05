<?php  
$vendor = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $vendor = getVendorByIdV2($id);
    foreach($vendor as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/vendors/add_vendor.page.inc.php';
?>