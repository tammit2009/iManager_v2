<?php 
require_once './pages/exceptions/init_exceptions.inc.php';
?>

<?php include('./pages/partials/header.php'); ?>
<?php include('./pages/partials/header_global_links.php'); ?>
<?php include('./pages/partials/header_custom_links_1.php'); ?>
<?php include('./pages/partials/header_terminate.php'); ?>

<body class="bg-front2">

    <?php include('./pages/partials/landing_nav.php'); ?>

    <?php include($include_file); ?>

    <script src="./core/ajax/js/auth_scripts.js"></script>

</body>

</html>          