<div class="content-wrapper">
    <div class="container">
      <section class="content-header">

        <h1>
          #Open <?php echo strtoupper($this->session->userdata('user_name'))?>
          <small>IT UHO</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
          <li><a href="#">Shared To Me</a></li>
          <li class="active">Open</li>
        </ol>
      </section>
      <section class="content">
        
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>#Shared To Me </b></h3>
            
          </div>
          <div class="box-body table-responsive">
            <small class="label bg-green">Folder/File Shared To Me</small><hr>

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
                if($this->uri->segment(3) != ""){
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
              ?>
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <?php
                    if($af->file_type=="folder"){
                      echo "<a href='".site_url('/shared/open/'.base64_encode($folder.$af->file_name.'/'))."'><i class='fa fa-folder'></i> ".$af->file_name."</a>";
                    }else{
                      echo "<i class='fa fa-file-text-o'></i> ".$af->file_name;
                    }
                  ?>

                </td>
                <td><?php echo $af->file_size?></td>
                <td><?php echo $af->file_date_modified?></td>
                <td>
                    
                    <?php if ($af->file_type=="file"){
                      $new_url=explode("/opt/lampp/htdocs/it-cloudstorage/",base64_decode($af->file_root));
                      $real_url= base_url().$new_url[1].$af->file_name;
                    ?>
                    <a href="<?php echo $real_url?>" class="btn btn-xs btn-default" title="Download"><i class="fa fa-download"></i></a>
                    <?php } ?>
                </td>

              </tr>  
              <?php }?>

            </table>
            <br>
          </div>
        </div>
      </section>
    </div>
  </div>
