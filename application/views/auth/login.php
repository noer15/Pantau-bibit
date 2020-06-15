<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Pantau Bibit</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="<?=base_url()?>assets/css/connect.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/dark_theme.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet">

      
    </head>
    <body class="auth-page sign-in">
        
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>
        <div class="connect-container align-content-stretch d-flex flex-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="auth-form">
                            <div class="row">
                                <div class="col">
                                    <div class="logo-box"><a href="#" class="logo-text">Pantau Bibit</a></div>
                                    <form action="<?=site_url('login/action') ?>" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control <?= ($this->session->flashdata('error_username') ? 'parsley-error' : '') ?>" id="username" name="username" value="<?=$this->session->flashdata('username')?>" placeholder="Enter NIP">
                                                <?php if($this->session->flashdata('error_username')): ?>
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false"><li class="parsley-required"><?=$this->session->flashdata('error_username')?></li></ul>
                                                <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                             <input type="password" class="form-control <?= ($this->session->flashdata('error_password') ? 'parsley-error' : '') ?>" id="userpassword" name="password" placeholder="Enter Password">
                                                    <?php if($this->session->flashdata('error_password')): ?>
                                                        <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false"><li class="parsley-required"><?=$this->session->flashdata('error_password')?></li></ul>
                                                    <?php endif; ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block btn-submit">Sign In</button>
                                       <!--  <div class="auth-options">
                                            <div class="custom-control custom-checkbox form-group">
                                                <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                                <label class="custom-control-label" for="exampleCheck1">Remember me</label>
                                            </div>
                                            <a href="#" class="forgot-link">Forgot Password?</a>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block d-xl-block">
                        <div class="auth-image"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Javascripts -->
        <script src="<?=base_url()?>assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap/popper.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url()?>assets/js/connect.min.js"></script>
    </body>
</html>