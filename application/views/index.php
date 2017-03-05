<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $page_title; ?> | Script Manager</title>

        <!-- Bootstrap -->
        <link href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?= base_url('vendors/animate.css/animate.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Custom Theme Style -->
        <link href="<?= base_url('build/css/custom.min.css') ?>" rel="stylesheet">

        <script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <!-- side bar navigation -->
                <?php require 'common/sidebar.php'; ?>
                <!-- /side bar navigation -->

                <!-- top navigation -->
                <?php require 'common/topbar.php'; ?>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="clearfix"></div>
                    <div style="margin: 20px auto">
                        <?php if ($this->session->flashdata('error') != "") { ?>
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error! </strong> <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('success') != "") { ?>
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success! </strong> <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php require $page_name . '.php'; ?>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <!-- Bootstrap -->
        <script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?= base_url('build/js/custom.min.js') ?>"></script>

    </body>
</html>
