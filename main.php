<?php 
require_once './pages/main/init_main.inc.php'; 
require_once './core/services/page_functions.php';
?>

<?php ob_start(); ?>

<?php include('./pages/partials/header.php'); ?>
<?php include('./pages/partials/header_global_links.php'); ?>
<?php include('./pages/partials/header_terminate.php'); ?> 

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('./pages/partials/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <?php include('./pages/partials/topbar.php'); ?>

                <!-- Page Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h2 class="page-title m-0"><?php echo $title ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php include($include_file); ?>

                </div>

            </div>
            <!-- End of Main Content -->

            <!-- <div class="hidden" id="data"></?php echo htmlspecialchars(json_encode($user), ENT_QUOTES); ?></div>
            <script>
                var user = JSON.parse(document.getElementById('data').textContent);
            </script> -->

    <?php include('./pages/partials/footer.php'); ?>

    <?php include('./pages/modals/logout.php'); ?>
    <?php include('./pages/modals/confirm.php'); ?>
    <?php include('./pages/modals/uni_modal.php'); ?>

    <!-- Scripts in the footer (add as needed) -->
    <?php include('./pages/partials/js.php'); ?>
    <?php include('./pages/partials/js2.php'); ?>

    <script src="./core/ajax/js/auth_scripts.js"></script>
    <script src="./core/ajax/js/main_scripts.js"></script>
    
</body>

</html>            

<?php ob_end_flush(); ?>