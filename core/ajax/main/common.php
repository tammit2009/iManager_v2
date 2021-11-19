<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Get This Company Details
if (isset($_POST['get_platform_company_details'])) {
    
    $response = [];

    $system_name = "";
    $system_shortname = "";
    $company_name = "";
    $company_email = "";
    $company_address = "";
    $system_logo = "";

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        $res = $opr->sqlSelect("SELECT * FROM sys_settings");
        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) { 
                if ($row['sys_key'] === "system_name") {
                    $system_name = $row['sys_value'];
                }
                if ($row['sys_key'] === "system_shortname") {
                    $system_shortname = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_name") {
                    $company_name = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_email") {
                    $company_email = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_address") {
                    $company_address = $row['sys_value'];
                }
                if ($row['sys_key'] === "system_logo") {
                    $system_logo = $row['sys_value'];
                }
            }

            $res->free_result();
            $opr->close();
        }
        else {
            echo "No Record Found";
        }
    }

    $response = array(
        "system_name" => $system_name, 
        "system_shortname" => $system_shortname,
        "company_name" => $company_name,
        "company_email" => $company_email,
        "company_address" => $company_address,
        "system_logo" => $system_logo
    );

    exit(json_encode($response));
}

?>