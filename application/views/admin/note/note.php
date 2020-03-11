<div class="content-wrapper">
    <?php 
      if($this->session->flashdata('create_note')){ 
        $message = $this->session->flashdata('create_note');
        $heading = '#Create Note';
      }else if($this->session->flashdata('delete_note')){ 
        $message = $this->session->flashdata('delete_note');
        $heading = '#Delete Note';
      }else if($this->session->flashdata('finish_note')){ 
        $message = $this->session->flashdata('finish_note');
        $heading = '#Finished Note';
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
        <h1>
          Sistem <?php echo strtoupper($this->session->userdata('user_name'))?>
          <small>IT UHO</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
          <li><a href="#">My note</a></li>
        </ol>
      </section>

      <section class="content">
        
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><b>#Data Catatan Pribadi</b></h3>
            <div class="pull-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
              <a href="<?php echo site_url('note')?>" class="btn btn-success"><i class="fa fa-refresh"></i></a>

              <!-- Modal Insert-->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>#Tambah Catatan Pribadi</b></h4>
                    </div>
                    <div class="modal-body">
                      <?php echo form_open("note/input");?>
                      <div class="box-body">
                        <color class="text-red"><b>#Info Catatan Pribadi</b></color>
                        <div class="form-group">
                          <label>Catatan</label>
                          <color class="text-red"> *</color>
                          <input name="note_description" type="text" class="form-control" id="password" placeholder="Catatan : bisa berupa kegiatan, jadwal atau pengingat dalam bentuk to do list" name="note_surename" required="required">
                        </div>
                        <div class="form-group">
                          <label>Deadline Note:</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input name="note_date" type="text" placeholder="Pilih Tanggal Deadline" class="form-control pull-right" id="datepicker">
                          </div>
                          <!-- /.input group -->
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
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#list" data-toggle="tab">List</a></li>
                <li><a href="#finish" data-toggle="tab">Finish</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="list">
                  <div class="post">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- The time line -->
                        <ul class="timeline">
                          <!-- timeline time label -->
                          <li class="time-label">
                            <span class="bg-red">
                              My Notes(To do list)
                            </span>
                          </li>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <?php
                            $nox=1;
                            foreach($note as $key){
                          ?>
                          <li>
                            <i class="fa fa-comments bg-yellow"></i>

                            <div class="timeline-item">
                              <span class="time">Deadline To do List <b><i class="fa fa-clock-o"></i> <?php echo $key->note_date?></b></span>

                              <h3 class="timeline-header"><a href="#"></a> Timeline</h3>

                              <div class="timeline-body">
                                <?php echo $key->note_description;?>
                              </div>
                              <div class="timeline-footer">
                                
                                <a href="<?php echo site_url('note/delete/'.$key->note_id)?>" class="btn btn-xs btn-danger btn-flat" data-toggle="modal" title="Hapus Note"><i class="fa fa-trash"></i> Hapus</a>
                                <?php if($key->note_status=="N"){ ?>
                                 | <a href="<?php echo site_url('note/finished/'.$key->note_id)?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-check"></i> Selesai</a>
                                <?php } ?> 
                              </div>
                            </div>



                          </li>

                          
                          <?php $nox++; } ?>
                          <!-- END timeline item -->
                        </ul>
                      </div>
                    </div>
                    
                  </div>
                </div>

                <div class="tab-pane" id="finish">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>Note</th>
                      <th>Deadline</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no=1;
                      foreach ($note_finish as $nf) {
                        # code...
                        $id= $nf->note_id;
                    ?>

                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $nf->note_description;?></td>
                        <td><?php echo $nf->note_date;?></td>
                        <td>
                            <?php 
                              if($nf->note_status=="Y"){
                                echo '<small class="label bg-green">Selesai</small>';
                              }else{
                                echo '<small class="label bg-red">Tidak</small>';
                              }
                            ?>
                        </td>
                      </tr>
                    

                    <?php
                        $no++;
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- /.content-wrapper -->