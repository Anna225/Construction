<!--
 * GenesisUI - Bootstrap 4 Admin Template
 * @version v1.8.10
 * @link https://genesisui.com
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license https://genesisui.com/license.html
 -->
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Clever Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="Clever Bootstrap 4 Admin Template">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>Clever Bootstrap 4 Admin Template</title>

  <!-- Icons -->
  <link href="<?php echo base_url() ;?>vendors/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ;?>vendors/css/simple-line-icons.min.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="<?php echo base_url() ;?>css/style.css" rel="stylesheet">

  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">

    <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
          <form class="form-signin" action="<?php echo site_url('login/auth');?>" method="post">
        <div class="card-group mb-4">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Sign In to your account</p>
              <?php echo $this->session->flashdata('msg');?>
              <div class="col-md-8 input-group mb-3">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
              </div>
              <div class="col-md-8 input-group mb-4">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Login</button>
                </div>
                
              </div>
            </div>
          </div>
          
        </div>
              </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="<?php echo base_url() ;?>vendors/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/popper.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/bootstrap.min.js"></script>

</body>
</html>