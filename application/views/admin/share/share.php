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
          <li><a href="#">Shared To Me</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Shared To Me </b></h3>
            
          </div>
          <div class="box-body table-responsive">
            <small class="label bg-blue">Folder/File Shared To Me</small><hr>

            <!-- Table Directory -->
            <table class="table table-condensed table-hover">
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Size</th>
                <th>Last Modified</th>
                <th>From</th>
                <th></th>
              </tr>
              
              
              <?php 
                if($share_to_me){
                  foreach ($share_to_me as $af) {
                    $id=$af->file_id;
              ?>
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <?php
                    if($af->file_type=="folder"){
                      $decode = base64_decode($af->file_root).$af->file_name.'/';
                      $encode = base64_encode($decode);
                      echo "<a href='".site_url('/shared/open/'.$encode)."'><i class='fa fa-folder'></i> ".$af->file_name."</a>";
                    }else{
                      echo "<i class='fa fa-file-text-o'></i> ".$af->file_name;
                    }
                  ?>

                </td>
                <td><?php echo $af->file_size?></td>
                <td><?php echo $af->file_date_modified?></td>
                <td><?php echo $af->user_surename?></td>
                <td>
                    <?php if ($af->file_type=="file"){
                      $new_url=explode("/opt/lampp/htdocs/it-cloudstorage/",base64_decode($af->file_root)); //Linux Version
                      //$new_url=explode("C:/xampp/htdocs/it-cloudstorage/",base64_decode($af->file_root)); //Windows Version
                      $real_url= base_url().$new_url[1].$af->file_name;
                    ?>
                    <a href="<?php echo $real_url?>" class="btn btn-xs btn-default" title="Download"><i class="fa fa-download"></i></a>
                    <?php } ?>
                </td>

              </tr>

              
                

                  
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
