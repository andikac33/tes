<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IT UHO Private Cloud | Register Page</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo base_url()?>/assets/images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition login-page" style="background-image: url('<?php echo base_url()?>/assets/images/1.jpg')">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url()?>"><img src="<?php echo base_url();?>assets/images/Nabule.png"></a>
      </div>

      <div class="login-box-body">
        <?php
          if($this->session->flashdata('register')){
            echo"
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-ban'></i> Alert!</h4>".
              $this->session->flashdata('register').
              "</div>
            ";
          }else if($this->session->flashdata('register_success')){
            echo"
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-info'></i> Info!</h4>".
              $this->session->flashdata('register_success').
              "</div>
            ";
          }else{
            echo"<p class='login-box-msg'>Register to Start Your session</p>";
          }
        ?>
        <?php echo form_open("register/register", "id='login'");?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Masukkan Nama Anda" name="user_surename">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Masukkan Username Yang diinginkan" name="user_name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Masukkan Nomor HP Untuk Aktivasi Akun" name="user_number">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="myInput" placeholder="Masukkan Kata Sandi" name="user_password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="myInputs" placeholder="Validasi Kata Sandi" name="password_again">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="">
                <label>
                <input type="checkbox" onclick="myFunction()"> Show Password
                </label>
              </div>
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-lock"></i> Register</button>
            </div>
          </div>
        <?php echo form_close(); ?>
        <div class="social-auth-links text-center">
          <hr>
          <a href="<?php echo site_url('home')?>" class="btn btn-block btn-social btn-facebook"><i class="fa fa-lock"></i> Login jika akun sudah ada</a>
          <hr>
          IT-UHO, Kendari<br>
          <i class="fa fa-copyright"></i> Private Cloud. All Rights Reserved<br>
          <i class="fa fa-user"></i> Novrian Syah E1E1 14 028
        </div>
      
        
      </div>
    </div>
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }

        var y = document.getElementById("myInputs");
        if (y.type === "password") {
          y.type = "text";
        } else {
          y.type = "password";
        }
      }

      $('#myInput').on('blur', function () {
        if (this.value.length < 8) {
          alert('Password Harus Lebih dari 8 Karakter !');
          $(this).focus();
          return false;
        }
      });
    </script>
  </body>
</html>
