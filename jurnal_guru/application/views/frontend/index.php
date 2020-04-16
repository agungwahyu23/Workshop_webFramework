<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicon.png">
  <title>Login - <?= APP_NAME ?></title>
  <!-- Bootstrap Core CSS -->
  <script src="<?= base_url('assets/new/js/plugin/webfont/webfont.min.js') ?>"></script>
  <script>
    WebFont.load({
      google: {
        "families": ["Lato:300,400,700,900"]
      },
      custom: {
        "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
        urls: ['<?php echo base_url('assets/new/css/fonts.min.css') ?>']
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>
  <link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?= base_url('assets/new/css/atlantis.min.css'); ?>" rel="stylesheet">
  <!-- You can change the theme colors from here -->
  <!-- <link href="<?= base_url() ?>assets/css/colors/blue.css" id="theme" rel="stylesheet"> -->
</head>

<body class="login">
  <div class="wrapper wrapper-login wrapper-login-full p-0 row">
    <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
      <h1 class="title fw-bold text-white mb-3"><?= APP_NAME ?></h1>
      <p class="subtitle text-white op-7">Selamat datang di aplikasi <?= APP_NAME ?></p>
    </div>
    <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
      <div class="container container-login col-md-6 container-transparent animated fadeIn">

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <?php
            if (isset($_SESSION['message'])) {
              echo "<br/>
                <div class='alert alert-" . $_SESSION['message'][0] . "'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
                <h3 class='text-" . $_SESSION['message'][0] . "'><i class='fa fa-check-circle'></i>" . $_SESSION['message'][2] . "</h3>" . $_SESSION['message'][1] . "
                </div>";
            }
            ?>
          </div>
        </div>
        <h3 class="text-center">Sign In To Admin</h3>
        <div class="login-form">
          <form class="form-horizontal form-material" method="post" id="loginform" action="<?= base_url('auth/proseslogin') ?>">

            <div class="form-group">
              <label for="username" class="placeholder"><b>Username</b></label>
              <input id="username" name="email" type="text" class="form-control" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group">
              <label for="password" class="placeholder"><b>Password</b></label>
              <!-- <a href="#" class="link float-right">Forget Password ?</a> -->
              <div class="position-relative">
                <input id="password" name="password" type="password" class="form-control" placeholder="Masukkan Password" required>
                <div class="show-password">
                  <!-- <i class="icon-eye"></i> -->
                </div>
              </div>
            </div>
            <div class="form-group form-action-d-flex mb-3">
              <div class="custom-control custom-checkbox">
                <!-- <input type="checkbox" class="custom-control-input" id="rememberme"> -->
                <!-- <label class="custom-control-label m-0" for="rememberme">Remember Me</label> -->
              </div>
              <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign In</button>
            </div>
          </form>
            <div class="login-account">
              <!-- <span class="msg">Don't have an account yet ?</span>
            <a href="#" id="show-signup" class="link">Sign Up</a> -->
            </div>
        </div>
      </div>

    </div>
  </div>
  <script src="<?= base_url() ?>assets/new/js/core/jquery.3.2.1.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url() ?>assets/new/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/new/js/core/bootstrap.min.js"></script>

  <script src="<?= base_url() ?>assets/new/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="<?= base_url() ?>/assets/new/js/atlantis.min.js"></script>
</body>

</html>