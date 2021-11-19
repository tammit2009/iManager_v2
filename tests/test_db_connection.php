<?php 
require_once '../core/security.php';

$opr = new DBOperation();
if ($opr->dbConnected()) {
    echo "DB Connected Successfully";
    $opr->close();
}
else {
    // Diagnostic
    $opr->die_error(); 
}

?>
