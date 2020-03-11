<div class="content-wrapper">
    <?php 
      if($this->session->flashdata('profil_user')){ 
        $message = $this->session->flashdata('profil_user');
        $heading = '#Profil Anda';
      }
    ?>
    <?php if(isset($message)){ ?>
    <script>
      $(document).ready(function(){
        $.toast({
          text : '<?php echo $message;?>',
          heading : '<?php echo $heading;?>',
          position : 'top-right',
          width : 'auto',
          showHideTransition : 'slide'
        })
      });
    </script>
    <?php } ?>
    <div class="container">
      <section class="content-header">
      <?php $pst=array(1=>"Administrator","Lektor","Asisten Ahli","Tenaga Pengajar"); ?>
        <h1>
          Sistem <?php echo strtoupper($this->session->userdata('user_name'))?>
          <small>IT UHO</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
          <li><a href="#">My Profile</a></li>
        </ol>
      </section>

      <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-warning">
            <div class="box-body box-profile">
              <?php if($this->session->userdata('user_photo')==""){?>
              <img src="<?php echo base_url();?>assets/images/4.png" class="profile-user-img img-responsive img-circle" alt="User Image">
              <?php }else{?>
              <img src="<?php echo base_url();?>upload/<?php echo $this->session->userdata('user_photo')?>" class="profile-user-img img-responsive img-circle" alt="User Image">
              <?php } ?>

              <h3 class="profile-username text-center"><?php echo $this->session->userdata('user_surename')?></h3>

              <p class="text-muted text-center"><?php echo "@".$this->session->userdata('user_name')?></p>
              <hr>
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted">
                <?php echo $user[0]->user_email?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Kampus</strong>

              <p class="text-muted">Fakultas Teknik, Universitas HaluOleo , Sulawesi Tenggara</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Detail</strong>

              <p>
                NIDN :<br> 
                <span class="label label-danger"><?php echo $user[0]->user_nidn?></span><br>
                <?php $p=$user[0]->user_position;?>
                Posisi : <br>
                <span class="label label-success"><?php echo $pst[$p]?></span>
              </p>

              <br>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li ><a href="#activity" data-toggle="tab">Activity</a></li>
              <li class="active"><a href="#settings" data-toggle="tab">Setting Profil</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  
                  <!-- /.user-block -->
                  Aktifitas Belum Di Tambahkan
                  
                </div>
                <!-- /.post -->

                <!-- Post -->
                
              </div>
              <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->

              <div class=" active tab-pane" id="settings">
                <?php echo form_open_multipart("user/profil_edit");?>
                  <color class="text-red"><b>#Info Pengguna</b></color>
                  <div class="form-group">
                    <label>Nama Lengkap Pengguna</label>
                    <color class="text-red"> *</color>
                    <input type="text" class="form-control" id="password" placeholder="Nama Lengkap Pengguna" name="user_surename" value="<?php echo $user[0]->user_surename?>" required="required">
                    <input type="hidden" class="form-control" id="password" name="user_id" value="<?php echo $user[0]->user_id?>" required="required">
                  </div>
                  <div class="form-group">
                    <label>NIDN</label>
                    <input type="text" class="form-control" id="password" placeholder="NIDN Pengguna" name="user_nidn" value="<?php echo $user[0]->user_nidn?>">
                  </div>
                  <div class="form-group">
                    <label>Email Pengguna</label>
                    <input type="email" class="form-control" id="password" placeholder="Email Pengguna" name="user_email" value="<?php echo $user[0]->user_email?>">
                  </div>
                  <?php if($user[0]->user_id!=1){?>
                  <div class="form-group">
                    <label>Posisi Pengguna</label>
                    <color class="text-red"> *</color>
                    <select name="user_position" class="form-control" required="required">
                      <option value="">-Pilih Posisi-</option>
                    <?php for($i=2;$i<=4;$i++){
                            if($i==$user[0]->user_position){
                    ?>
                      <option value="<?php echo $i?>" selected="selected"><?php echo $pst[$i]?></option>
                    <?php   }else{ ?>
                      <option value="<?php echo $i?>"><?php echo $pst[$i]?></option>
                    <?php } } ?>
                    </select>
                  </div>
                  <?php }else{?>
                  <input type="hidden" class="form-control" id="password" name="user_position" value="1">
                  <?php } ?>
                  <div class="form-group">
                    <label>Status Pengguna</label>
                    <color class="text-red"> *</color>
                    <select name="user_status" class="form-control" required="required">
                      <?php if($user[0]->user_status=="Y"){?>
                      <option value="">- Pilih Status Pengguna -</option>
                      <option value="Y" selected="selcted">Aktif</option>
                      <option value="N">Tidak</option>
                      <?php }elseif($user[0]->user_status=="Y"){?>
                      <option value="">- Pilih Status Pengguna -</option>
                      <option value="Y">Aktif</option>
                      <option value="N" selected="selected">Tidak</option>
                      <?php }else{?>
                      <option value="" selected="selected">- Pilih Status Pengguna -</option>
                      <option value="Y">Aktif</option>
                      <option value="N">Tidak</option>
                      <?php }?>
                    </select>
                  </div>
		  <div class="form-group">
                    <label>Nomor Pengguna</label>
                    <input type="text" class="form-control" id="password" placeholder="Nomor Pengguna" name="user_number" value="<?php echo $user[0]->user_number?>">
                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" class="form-control" id="password" placeholder="Foto Pengguna" name="userfile">
                  </div>
                  <hr>
                  <div class="form-group">
                    <label>Ubah Kata Sandi (Password) - Kosongkan jika Tidak</label>
                    <input type="text" class="form-control" id="password" placeholder="Kata Sandi (Password)" name="user_password">
                  </div>
                
                
                  <button type="submit" class="btn btn-primary">Ubah</button>
                
                <?php echo form_close(); ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
