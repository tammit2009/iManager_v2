<?php  
$org = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $org = getOrganizationById($id);
    foreach($org as $k => $v) {
        $$k = $v; // echo "$$k : $v <br/>";
    }
}

include './pages/main/orgs/add_organization.page.inc.php';
?>