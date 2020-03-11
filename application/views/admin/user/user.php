<div class="content-wrapper">
    <?php 
      if($this->session->flashdata('create_user')){ 
        $message = $this->session->flashdata('create_user');
        $heading = '#Create User';
      }else if($this->session->flashdata('delete_user')){ 
        $message = $this->session->flashdata('delete_user');
        $heading = '#Delete User';
      }else if($this->session->flashdata('edit_user')){ 
        $message = $this->session->flashdata('edit_user');
        $heading = '#Edit user';
      }else if($this->session->flashdata('activated_user')){ 
        $message = $this->session->flashdata('activated_user');
        $heading = '#Aktivasi user';
      }else if($this->session->flashdata('profil_user')){ 
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
          <li><a href="#">My User</a></li>
        </ol>
      </section>

      <section class="content">
        
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>#Data Pengguna</b></h3>
            <div class="pull-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
              <a href="<?php echo site_url('user')?>" class="btn btn-success"><i class="fa fa-refresh"></i></a>

              <!-- Modal Insert-->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>#Tambah Pengguna</b></h4>
                    </div>
                    <div class="modal-body">
                      <?php echo form_open("user/input");?>
                      <div class="box-body">
                        <color class="text-red"><b>#Info Pengguna</b></color>
                        <div class="form-group">
                          <label>Nama Lengkap Pengguna</label>
                          <color class="text-red"> *</color>
                          <input type="text" class="form-control" id="password" placeholder="Nama Lengkap Pengguna" name="user_surename" required="required">
                        </div>
                        <div class="form-group">
                          <label>Nama Akun (Username)</label>
                          <color class="text-red"> *</color>
                          <input type="text" class="form-control" id="password" placeholder="Nama Akun (Username)" name="user_name" required="required">
                        </div>
                        <div class="form-group">
                          <label>Kata Sandi (Password)</label>
                          <color class="text-red"> *</color>
                          <input type="text" class="form-control" id="password" placeholder="Kata Sandi (Password)" name="user_password" required="required">
                        </div>
                        <div class="form-group">
                          <label>NIDN</label>
                          <input type="text" class="form-control" id="password" placeholder="NIDN Pengguna" name="user_nidn" >
                        </div>
                        <div class="form-group">
                          <label>Email Pengguna</label>
                          <input type="email" class="form-control" id="password" placeholder="Email Pengguna" name="user_email">
                        </div>
                        <div class="form-group">
                          <label>Posisi Pengguna</label>
                          <color class="text-red"> *</color>
                          <select name="user_position" class="form-control" required="required">
                            <option value="">-Pilih Posisi-</option>
                          <?php for($i=1;$i<=count($pst);$i++){?>
                            <option value="<?php echo $i?>"><?php echo $pst[$i]?></option>
                          <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Status Pengguna</label>
                          <color class="text-red"> *</color>
                          <select name="user_status" class="form-control" required="required">
                            <option value="">- Pilih Status Pengguna -</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak</option>
                          </select>
                        </div>
                        
                        
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                      </div>
                      <!-- /.box-footer -->
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Insert -->

            </div>
          </div>
          <div class="box-body table-responsive">
            <?php
              if($this->session->flashdata('user')){
                echo"
                <div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-ban'></i> Alert!</h4>".
                  $this->session->flashdata('user').
                  "</div>
                ";
              }
            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Nama Pengguna</th>
                  <th>Username</th>
                  <th>Posisi</th>
                  <th>Status</th>
                  <th>#Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach ($user as $key) {
                    # code...
                    $id= $key->user_id;
                    $position = $key->user_position;
                ?>

                  <tr>
                    <td><?php echo $no?></td>
                    <td><?php echo $key->user_surename;?></td>
                    <td><?php echo $key->user_name;?></td>
                    <td><?php echo $pst[$position]?></td>
                    <td>
                        <?php 
                          if($key->user_status=="Y"){
                            echo '<small class="label bg-blue">Aktif</small>';
                          }else{
                            echo '<small class="label bg-red">Tidak</small>';
                          }
                        ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-xs btn-fucek btn-flat" data-toggle="modal" title="Edit User" data-target="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-xs btn-danger btn-flat" data-toggle="modal" title="Hapus User" data-target="#delete<?php echo $id;?>"><i class="fa fa-trash"></i></button>
                      <?php if($key->user_status=="N"){ ?>
                       | <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" title="Aktifkan User" data-target="#active<?php echo $id;?>"><i class="fa fa-check"></i></button>
                      <?php } ?> 

                      
                    </td>

                  </tr>

                  <!-- Modal Update-->
                <div class="modal fade" id="edit<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Ubah Data Pengguna</b></h4>
                      </div>
                      <div class="modal-body">
                        <div class="box-body">
                          <?php echo form_open("user/edit");?>
                          <color class="text-red"><b>#Info Pengguna</b></color>
                          <div class="form-group">
                            <label>Nama Lengkap Pengguna</label>
                            <color class="text-red"> *</color>
                            <input type="text" class="form-control" id="password" placeholder="Nama Lengkap Pengguna" name="user_surename" value="<?php echo $key->user_surename?>" required="required">
                            <input type="hidden" class="form-control" id="password" name="user_id" value="<?php echo $key->user_id?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>Nama Akun (Username)</label>
                            <color class="text-red"> *</color>
                            <input type="text" class="form-control" id="password" placeholder="Nama Akun (Username)" name="user_name" value="<?php echo $key->user_name?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>NIDN</label>
                            <input type="text" class="form-control" id="password" placeholder="NIDN Pengguna" name="user_nidn" value="<?php echo $key->user_nidn?>">
                          </div>
                          <div class="form-group">
                            <label>Email Pengguna</label>
                            <input type="email" class="form-control" id="password" placeholder="Email Pengguna" name="user_email" value="<?php echo $key->user_email?>">
                          </div>
                          <div class="form-group">
                            <label>Posisi Pengguna</label>
                            <color class="text-red"> *</color>
                            <select name="user_position" class="form-control" required="required">
                              <option value="">-Pilih Posisi-</option>
                            <?php for($i=1;$i<=count($pst);$i++){
                                    if($i==$key->user_position){
                            ?>
                              <option value="<?php echo $i?>" selected="selected"><?php echo $pst[$i]?></option>
                            <?php   }else{ ?>
                              <option value="<?php echo $i?>"><?php echo $pst[$i]?></option>
                            <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Status Pengguna</label>
                            <color class="text-red"> *</color>
                            <select name="user_status" class="form-control" required="required">
                              <?php if($key->user_status=="Y"){?>
                              <option value="">- Pilih Status Pengguna -</option>
                              <option value="Y" selected="selcted">Aktif</option>
                              <option value="N">Tidak</option>
                              <?php }elseif($key->user_status=="Y"){?>
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
                          <hr>
                          <div class="form-group">
                            <label>Ubah Kata Sandi (Password) - Kosongkan jika Tidak</label>
                            <input type="text" class="form-control" id="password" placeholder="Kata Sandi (Password)" name="user_password">
                          </div>
                        
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Delete-->
                <div class="modal fade" id="delete<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("user/delete");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Hapus user : <?php echo "<b>".$key->user_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-danger">Apakah anda yakin ingin menghapus user ini? Jika anda menghapus user ini, maka <b>storage dan file</b> pengguna ini akan ikut terhapus dari server Private Cloud ! Apakah anda Yakin ?</div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $key->user_id?>" name="user_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $key->user_name?>" name="user_name" required="required">
                        <button type="submit" class="btn btn-danger">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <!-- Modal Aktive-->
                <div class="modal fade" id="active<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("user/activated");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Aktifkan user : <?php echo "<b>".$key->user_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-danger">Apakah anda yakin ingin mengaktifkan user ini?</div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $key->user_id?>" name="user_id" required="required">
			<input type="hidden" class="form-control" value="<?php echo $key->user_number?>" name="user_number" required="required">
                        <button type="submit" class="btn btn-danger">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <?php
                    $no++;
                  }
                ?>
                </tbody>
              </table>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- /.content-wrapper -->
