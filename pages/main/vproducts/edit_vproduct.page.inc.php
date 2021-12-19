<?php  
$vproduct = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $vproduct = fetchVendorProductById($id);
    foreach($vproduct as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/vproducts/add_vproduct.page.inc.php';
?>