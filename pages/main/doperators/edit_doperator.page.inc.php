<?php  
$doperator = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $doperator = getDoperatorById($id);
    foreach($doperator as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/doperators/add_doperator.page.inc.php';
?>