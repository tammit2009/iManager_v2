<?php
require_once '../../security.php'; 

if(isset($_POST['csrf_token']) && validateCsrfToken($_POST['csrf_token'])) {
    session_destroy();
    echo 0;
}
else {
    echo 1;
}