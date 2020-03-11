<div class="content-wrapper">
    <div class="container">
    
      <!-- Content Header (Page header) -->
      <section class="content-header">

        <h1>
          Storage <?php echo strtoupper($this->session->userdata('user_name'))?>
          <small>IT UHO</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
          <li><a href="#">Recycle Bin</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Recycle Bin </b></h3>
            
          </div>
          <div class="box-body table-responsive">
            <small class="label bg-blue">Folder/File Recycle Bin</small><hr>

            <!-- Table Directory -->
            <table class="table table-condensed table-hover">
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Size</th>
                <th>Last Modified</th>
                <th></th>
              </tr>
              
              
              <?php 
                if($mybin){
                  foreach ($mybin as $af) {
                    $id=$af->file_id;
                    $rootxx=$af->file_root;
              ?>
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <?php
                    if($af->file_type=="folder"){
                      $decode = base64_decode($af->file_root).$af->file_name.'/';
                      $encode = base64_encode($decode);
                      echo "<a href='".site_url('/bin/open/'.$encode)."'><i class='fa fa-folder'></i> ".$af->file_name."</a>";
                    }else{
                      echo "<i class='fa fa-file-text-o'></i> ".$af->file_name;
                    }
                  ?>

                </td>
                <td><?php echo $af->file_size?></td>
                <td><?php echo $af->file_date_modified?></td>
                <td>
                  <button type="button" class="btn btn-xs btn-default" title="Delete Folder/File" data-toggle="modal" data-target="#myModalDelete<?php echo $id?>"><i class="fa fa fa-close text-red"></i></button>
                  <button type="button" class="btn btn-xs btn-default" title="Move to Storage" data-toggle="modal" data-target="#myModalStorage<?php echo $id?>"><i class="fa fa fa-refresh"></i></button>
                </td>

              </tr>
              <!-- Modal Delete-->
                <div class="modal fade" id="myModalDelete<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("bin/delete");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete File/Folder : <?php echo "<b>".$af->file_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-danger">Apakah anda yakin ingin menghapus File/Folder ini? Sekedar pengingat bahwa File/Folder yang akan dihapus akan dihapus permanent sehingga status yang telah di share juga akan hilang dan File/Folder yang ada dalam Folder yang di hapus juga akan ikut terhapus. Jika Anda  Setuju, Pilih tombol Ya. </div>
                        <hr>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('user_id')?>" name="user_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_id?>" name="file_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_type?>" name="file_type" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_name?>" name="file_name" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $rootxx?>" name="file_root" required="required">

                        <button type="submit" class="btn btn-danger">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <!-- Modal Bin-->
                <div class="modal fade" id="myModalStorage<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("bin/storage");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Move to Storage File/Folder : <?php echo "<b>".$af->file_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-danger">Apakah anda yakin ingin Memindahkan File/Folder ini Ke Storage Anda Kembali? Jika Anda  Setuju, Pilih tombol Ya. </div>
                        <hr>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('user_id')?>" name="user_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_id?>" name="file_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_type?>" name="file_type" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_name?>" name="file_name" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $rootxx?>" name="file_root" required="required">

                        <button type="submit" class="btn btn-danger">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
              
                

                  
              <?php 
                  }
                }?>

            </table>
            <br>
          </div>
          <!-- /.box-body -->
        </div>

        
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
