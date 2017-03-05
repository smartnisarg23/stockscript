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

        <!-- Custom Theme Style -->
        <link href="<?= base_url('build/css/custom.min.css') ?>" rel="stylesheet">
    </head>

    <body class="login">
        <div style="width: 50%;margin: 20px auto">
            <?php if ($this->session->flashdata('error') != "") { ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error! </strong> <?= $this->session->flashdata('error') ?>
                </div>
            <?php } ?>
            <?php if (validation_errors() != "") { ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
        </div>
        <div class="login_wrapper">

            <div class="animate form login_form">
                <section class="login_content">
                    <?php echo form_open(base_url('auth/login'), array("id" => "login_form")); ?>
                    <h1>Login</h1>
                    <div>
                        <input name="username" type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input name="password" type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit">Log In</button>
                    </div>
                    <br/>
                    <div class="clearfix"></div>

                    <div class="separator">

                        <div>
                            <h1><i class="fa fa-globe"></i> Script Manager</h1>
                            <p>&COPY;<?= date('Y') ?> All Rights Reserved.</p>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </section>
            </div>
        </div>
        <script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
        <!-- Bootstrap -->
        <script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <!-- Custom Theme Scripts -->
        <script src="<?= base_url('build/js/custom.min.js') ?>"></script>
    </body>
</html>
