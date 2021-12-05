<?php  
$member = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $member = getMemberById($id);
    foreach($member as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/members/add_member.page.inc.php';
?>