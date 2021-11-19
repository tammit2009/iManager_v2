<?php 
require_once './pages/auth/init_auth.inc.php';
?>

<?php include('./pages/partials/header.php'); ?>
<?php include('./pages/partials/header_global_links.php'); ?>
<?php include('./pages/partials/header_custom_links_1.php'); ?>
<?php include('./pages/partials/header_terminate.php'); ?>

<body class="bg-front2">

    <?php include('./pages/partials/landing_nav.php'); ?>

    <?php include($include_file); ?>

    <?php
    // if (isset($_COOKIE['email']) and isset($_COOKIE['pass'])) {
    //     echo "<script>
    //         document.getElementById('remember_me').checked = true;
    //     </script>";
    // } ?>

    <script src="./core/ajax/js/auth_scripts.js"></script>

</body>

</html>          