<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/Nabule.png" height='40px' style="padding-top: 6px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
              if($this->uri->segment(1)=='' or $this->uri->segment(1)=='home' ){
                $storage='active'; $notes=""; $user=""; $shared=""; $bin="";
              }else if($this->uri->segment(1)=="note"){
                $storage=''; $notes="active"; $user=""; $shared=""; $bin="";
              }else if($this->uri->segment(1)=="user"){
                $storage=''; $notes=""; $user="active"; $shared=""; $bin="";
              }else if($this->uri->segment(1)=="shared"){
                 $storage=''; $notes=""; $user=""; $shared="active"; $bin="";
              }else if($this->uri->segment(1)=="bin"){
                 $storage=''; $notes=""; $user=""; $shared=""; $bin="active";
              }
            ?>
            <li class="<?php echo $storage;?>"><a href="<?php echo site_url();?>"><i class="fa fa-paper-plane-o"></i> My Storage </a></li>
<!--             <li class="<?php echo $notes;?>"><a href="<?php echo site_url('note')?>"><i class="fa fa-file"></i> My Notes</a></li>
            <li class="<?php echo $shared;?>"><a href="<?php echo site_url('shared')?>"><i class="fa fa-file-text-o"></i> Shared To Me</a></li> -->
            <li class="<?php echo $bin;?>"><a href="<?php echo site_url('bin')?>"><i class="fa fa-trash"></i> Recycle Bin</a></li>
            <?php
              if($this->session->userdata('user_position')==1){
            ?>
            <li class="<?php echo $user;?>"><a href="<?php echo site_url('user');?>"><i class="fa fa-user"></i> My User</a></li>
            <?php
              }
            ?>
            
          </ul>
          <!-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form> -->
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          <li>
            <a href="#" data-toggle="modal" data-target="#myModalInfo"><i class="fa fa-info-circle"></i></a>
          </li>
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if($this->session->userdata('user_photo')==""){?>
                <img src="<?php echo base_url();?>assets/images/4.png" class="user-image" alt="User Image">
                <?php }else{?>
                <img src="<?php echo base_url();?>upload/<?php echo $this->session->userdata('user_photo')?>" class="user-image" alt="User Image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $this->session->userdata('user_surename')?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <?php if($this->session->userdata('user_photo')==""){?>
                  <img src="<?php echo base_url();?>assets/images/4.png" class="img-circle" alt="User Image">
                  <?php }else{?>
                  <img src="<?php echo base_url();?>upload/<?php echo $this->session->userdata('user_photo')?>" class="img-circle" alt="User Image">
                  <?php } ?>

                  <p>
                     <?php echo $this->session->userdata('user_surename');?>- IT UHO
                    <small>Member since  @2020</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo site_url('user/profil')?>" class="btn btn-default btn-flat"><i class="fa fa-gears"></i> Setting Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('home/logout');?>" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
    </nav>

  </header>
  <!-- Modal Info-->
  <div class="modal fade" id="myModalInfo" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Tentang Aplikasi</b></h4>
        </div>
        <div class="modal-body">
          <center><img src="<?php echo base_url()?>assets/images/Nabule.png"> </center><br>
          <br><br>
          Aplikasi ini adalah sebuah sistem cloud storage yang digunakan untuk menyimpan data data secara virtual dalam satu server
          <br><br>
          <hr>
          <center>IT-UHO, Kendari<br>
          <i class="fa fa-copyright"></i> Private Cloud. All Rights Reserved<br>
          <i class="fa fa-user"></i> Novrian Syah E1E1 14 028</center>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal File -->
  <!-- Full Width Column -->
