<?php  
$subdom_user = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $subdom_user = getSubDomUserById($id);
    foreach($subdom_user as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/subdom_users/add_subdom_user.page.inc.php';
?>