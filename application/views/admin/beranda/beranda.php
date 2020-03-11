<div class="content-wrapper">
    <?php 
      if($this->session->flashdata('create_folder')){ 
        $message = $this->session->flashdata('create_folder');
        $heading = 'Create Folder';
      }else if($this->session->flashdata('upload_file')){ 
        $message = $this->session->flashdata('upload_file');
        $heading = 'Upload File';
      }else if($this->session->flashdata('delete_file')){ 
        $message = $this->session->flashdata('delete_file');
        $heading = 'Delete File/Folder';
      }else if($this->session->flashdata('share_file')){ 
        $message = $this->session->flashdata('share_file');
        $heading = 'Share File/Folder';
      }else if($this->session->flashdata('copy_file')){ 
        $message = $this->session->flashdata('copy_file');
        $heading = 'Copy File';
      }else if($this->session->flashdata('rename_file')){ 
        $message = $this->session->flashdata('rename_file');
        $heading = 'Rename File';
      }else if($this->session->flashdata('bin_file')){ 
        $message = $this->session->flashdata('bin_file');
        $heading = 'Move To Bin';
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

    <?php
      function getFolderSizeusingTitle($dir, $digits = 2){
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
          $size += is_file($each) ? filesize($each) : getFolderSize($each);
        }
          
          $sizes = array("TB","GB","MB","KB","B");
          $total = count($sizes);
          while ($total-- && $size > 1024) {
            $size /= 1024;
          }
        
        return round($size, $digits)." ".$sizes[$total];
      }

      function getFolderSize($dir){
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
          $size += is_file($each) ? filesize($each) : getFolderSize($each);
        }
        return $size;;
      }

      //$myfolder = $_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name');
      $myfolder = $_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name');
      $myRealStorageinByte=$MyStorageSize[0]->user_storage_size * 1073741824;
      $myFolderStorageinByte = getFolderSize($myfolder);
      $MyStoragePersen = number_format((($myFolderStorageinByte/$myRealStorageinByte)*100));
      $myStoragewithTitle = getFolderSizeusingTitle($myfolder);
    ?>

    <div class="container">
      <section class="content-header">

        <h1>
          Storage <?php echo strtoupper($this->session->userdata('user_name'))?>
          <small>IT UHO</small><br>
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>MyStorage </b></h3>
            <div class="pull-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalFiles"><i class="fa fa-upload"></i> Upload File</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalFolder"><i class="fa fa-folder"></i> Buat Folder</button>
              <a href="<?php echo base_url();?>" class="btn btn-success"><i class="fa fa-refresh"></i></a>

              <!-- Modal File-->
              <div class="modal fade" id="myModalFiles" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>Upload File</b></h4>
                    </div>
                    <div class="modal-body">
                      <?php echo form_open_multipart("/storage/upload_file");?>
                      <div class="box-body">
                        <color class="text-red"><b>Upload File Baru</b></color>
                        <div class="form-group">
                          <label>Upload File</label>
                          <color class="text-red"> *</color>
                          <input type="file" class="form-control" id="password" name="userfile" required="required">
                          <input type="hidden" class="form-control" id="password" value="<?php echo $this->session->userdata('user_id')?>" name="user_id" required="required">

                          <?php $rootxx=base64_encode($folder);?>
                          <input type="hidden" class="form-control" id="password" value="<?php echo $rootxx?>" name="file_root" required="required">
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                      </div>
                      <!-- /.box-footer -->
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal File -->

              <!-- Modal Folder-->
              <div class="modal fade" id="myModalFolder" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>Buat Folder</b></h4>
                    </div>
                    <div class="modal-body">
                      <?php echo form_open("storage/create_folder");?>
                      <div class="box-body">
                        <color class="text-red"><b>Buat Folder Baru</b></color>
                        <div class="form-group">
                          <label>Nama Folder</label>
                          <color class="text-red"> *</color>
                          <input type="text" class="form-control" id="password" placeholder="Nama Folder" name="file_name" required="required">
                          <input type="hidden" class="form-control" id="password" value="<?php echo $this->session->userdata('user_id')?>" name="user_id" required="required">

                          <?php $rootxx=base64_encode($folder);?>
                          <!-- <?php echo $folder;?> -->
                          <input type="hidden" class="form-control" id="password" value="<?php echo $rootxx?>" name="file_root" required="required">
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-folder"></i> Buat</button>
                      </div>
                      <!-- /.box-footer -->
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Folder -->


            </div>
          </div>
          <div class="box-body table-responsive">

            <small class="label bg-blue">Directory : <?php echo $design_path;?></small><br><br>
            <b><?php echo $myStoragewithTitle.' of '.$MyStorageSize[0]->user_storage_size?> GB</b> Storage
            <div class="progress progress-sm active">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $MyStoragePersen?>%">
                <span class="sr-only">20% Complete</span>
              </div>
            </div>
            <hr>

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
                    if($this->uri->segment(3) != base64_encode($_SERVER['DOCUMENT_ROOT'].'/storage/'.$this->session->userdata('user_name')) and $this->uri->segment(3) != ""){ //Linux Version
                    //if($this->uri->segment(3) != base64_encode($_SERVER['DOCUMENT_ROOT'].'/it-cloudstorage/storage/'.$this->session->userdata('user_name')) and $this->uri->segment(3) != ""){ //Windows Version
              ?>
                    <tr>
                      <td></td>
                      <td colspan="4">
                        <a href="javascript:history.back()"><i class="fa fa-reply-all"></i>...</a>
                      </td>
                    </tr>
              <?php } ?>
              

              <?php foreach ($all_file as $af) {
                      $id=$af->file_id;
                      //$readMyFile=$_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/';
		      $readMyFile=$_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/';
              ?>
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <?php
                    if($af->file_type=="folder"){
                      echo "<a href='".site_url('/home/index/'.base64_encode($folder.$af->file_name.'/'))."'><i class='fa fa-folder'></i> ".$af->file_name."</a>";
                    }else{
                      echo "<i class='fa fa-file-text-o'></i> ".$af->file_name;
                    }
                  ?>

                </td>
                <td><?php echo $af->file_size?></td>
                <td><?php echo $af->file_date_modified ?></td>
                <td>
                    
                    <button type="button" class="btn btn-xs btn-default" title="Delete Folder/File" data-toggle="modal" data-target="#myModalDelete<?php echo $id?>"><i class="fa fa fa-close text-red"></i></button>
                    <button type="button" class="btn btn-xs btn-default" title="Move to Bin" data-toggle="modal" data-target="#myModalBin<?php echo $id?>"><i class="fa fa fa-trash text-red"></i></button>
                    <!-- <button type="button" class="btn btn-xs btn-default" title="Share Folder/File" data-toggle="modal" data-target="#myModalShare<?php echo $id?>"><i class="fa fa-link"></i></button> -->
                    <?php if ($af->file_type=="file"){
                      $new_url=explode("/opt/lampp/htdocs/it-cloudstorage/",base64_decode($af->file_root)); //Linux Version
                      //$new_url=explode("C:/xampp/htdocs/it-cloudstorage/",base64_decode($af->file_root)); //Windows Version
                      $real_url= base_url().$new_url[1].$af->file_name;
		                  $reals = base64_encode(base64_decode($af->file_root).$af->file_name);
                    ?>
                    <button type="button" class="btn btn-xs btn-default" title="Copy File" data-toggle="modal" data-target="#myModalCopy<?php echo $id?>"><i class="fa fa-copy"></i></button>
                    <button type="button" class="btn btn-xs btn-default" title="Rename File" data-toggle="modal" data-target="#myModalRename<?php echo $id?>"><i class="fa fa-indent"></i></button>
                    <a href="<?php echo site_url('storage/download/'.$reals)?>" class="btn btn-xs btn-default" title="Download"><i class="fa fa-download"></i></a>
                    <?php } ?>
                </td>

              </tr>

                <!-- Modal Share-->
                <div class="modal fade" id="myModalShare<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("storage/share");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Share File/Folder : <?php echo "<b>".$af->file_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-success">Apakah anda yakin ingin membagi File/Folder ini?  Jika Iya, Pilih Pengguna yang ingin anda berikan akses ke File/Folder : </div>
                        <hr>
                        <div class="form-group">
                          <label>Share Ke :</label>
                          <select class="form-control select2" name="user_receiver" style="width: 100%;">
                            <?php foreach($shared_to as $sto) {?>
                            <option value="<?php echo $sto->user_id?>"><?php echo $sto->user_surename?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('user_id')?>" name="user_sender" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_id?>" name="file_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $rootxx?>" name="file_root" required="required">

                        <button type="submit" class="btn btn-success">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <!-- Modal Rename-->
                <div class="modal fade" id="myModalRename<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("storage/rename");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Rename File/Folder : <?php echo "<b>".$af->file_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-warning">Apakah anda yakin ingin rename File ini? Jika Iya, Beri nama baru File : </div>
                        <hr>
                        <div class="form-group">
                          <label>Nama Lama :</label>
                          <input type="text" class="form-control" value="<?php echo $af->file_name?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Nama Baru :</label>
                          <input type="text" class="form-control" name="file_name" value="<?php echo $af->file_name?>">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('user_id')?>" name="user_sender" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_id?>" name="file_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $rootxx?>" name="file_root" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_name?>" name="file_name_old" required="required">

                        <button type="submit" class="btn btn-warning">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <!-- Modal Copy-->
                <div class="modal fade" id="myModalCopy<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("storage/copy");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Copy File : <?php echo "<b>".$af->file_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-warning">Apakah anda yakin ingin copy File ini? Jika Iya, Pilih lokasi copy nya : </div>
                        <hr>
                        
                        <div class="form-group">
                          <label>Lokasi :</label>
                          <select name="new_destination" class="form-control select2" style="width: 100%" required="required">
                            <option value="">-Pilih Folder-</option>
                            <?php foreach ($getAllFolder as $gAF) { ?>
                            <option value="<?php echo base64_encode((base64_decode($gAF->file_root).$gAF->file_name.'/')) ?>"><?php echo $gAF->file_name?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('user_id')?>" name="user_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_id?>" name="file_id" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $rootxx?>" name="file_root" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_name?>" name="file_name" required="required">
                        <input type="hidden" class="form-control" value="<?php echo $af->file_size?>" name="file_size" required="required">

                        <button type="submit" class="btn btn-warning">Ya</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Batal</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <!-- Modal Delete-->
                <div class="modal fade" id="myModalDelete<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("storage/delete");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete File : <?php echo "<b>".$af->file_name."</b>"?></h4>
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
                <div class="modal fade" id="myModalBin<?php echo $id;?>" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <?php echo form_open("storage/bin");?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Move to Bin File/Folder : <?php echo "<b>".$af->file_name."</b>"?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-danger">Apakah anda yakin ingin Memindahkan File/Folder ini Ke Recycle Bin? Jika Anda  Setuju, Pilih tombol Ya. </div>
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

                  
              <?php }?>

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
