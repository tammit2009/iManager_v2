<?php  
$user = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user = getUserById($id);
    foreach($user as $k => $v) {
        $$k = $v;   // echo "$$k : $v <br/>";
    }
}

include './pages/main/users/add_user.page.inc.php';
?>