<?php  
$customer = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $customer = getCustomerById($id);
    foreach($customer as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/customers/add_customer.page.inc.php';
?>