<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        //date_default_timezone_set("Africa/Lagos");
        ob_start();
        $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "iManager";
    ?>

    <title>iManager | <?php echo $title ?></title>
    <?php ob_end_flush() ?>

    <base href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/" />
    <meta charset="utf-8"/>
    <meta name="csrf_token" content="<?php echo createCsrfToken(); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/jpg" href="./assets/imgs/favicon.ico"/>


