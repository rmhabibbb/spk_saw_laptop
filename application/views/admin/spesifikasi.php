 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Spesifikasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Spesifikasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         <div class="card"> 
              <!-- /.card-header -->
              <div class="card-body">

                <a data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-blue">Tambah Spesifikasi</button></a>
                  <br><br>

                <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>   
                            <th>No</th> 
                            <th>Nama Spesifikasi</th>  

                            <?php $i = 1; foreach ($list_kriteria as $row): ?>
                            <?php if ($row->id_kriteria != 7) { ?> 
                                  <th><?=$row->nama_kriteria?></th>  
                            <?php } endforeach; ?>
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_spek as $row): ?> 
                          <tr>    
                              <td><?=$i++?>  </td>  
                              <td><?=$row->nama_spesifikasi?></td>  
                              <?php 
                               foreach ($list_kriteria as $row2): ?> 
                            <?php if ($row2->id_kriteria != 7) { ?> 
                                <?php 
                               $bobot = $this->DetailSpec_m->get_row(['id_spesifikasi' => $row->id_spesifikasi,'id_kriteria' => $row2->id_kriteria])->min_bobot; 
                               $bobot2 = $this->DetailSpec_m->get_row(['id_spesifikasi' => $row->id_spesifikasi,'id_kriteria' => $row2->id_kriteria])->max_bobot; ?>

                                  <td>
                                    MIN : <?=$this->Bobot_m->get_row(['id_bobot' => $bobot])->keterangan?>
                                  <BR>
                                    MAX : <?=$this->Bobot_m->get_row(['id_bobot' => $bobot2])->keterangan?>
                                  </td>  
                            <?php } endforeach; ?>
                               <td>
                                  
                                  <a data-toggle="modal" data-target="#edit-<?=$row->id_spesifikasi?>"  href=""><button class="btn btn-block bg-blue">Edit</button></a>
                                  <br>
                                  <a data-toggle="modal" data-target="#delete-<?=$row->id_spesifikasi?>"  href=""><button class="btn btn-block bg-red">Hapus</button></a>
                               </td>        
                          </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>



<div class="modal fade" id="tambah">
        <div class="modal-dialog tambah">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Tambah Spesifikasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('admin/prosesspek')?>" method="Post"  >   

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Nama Spesifikasi
                                         </th>
                                         <td> 
                                          
                                            
                                            <input type="text" class="form-control" name="nama_spesifikasi"  required autofocus  >

                                         </td>
                                     </tr> 
                                    <?php $i= 1; foreach ($list_kriteria as $row): ?>  

                            <?php if ($row->id_kriteria != 7) { ?> 
                                <tr>
                                    <th colspan="2"><?=$row->nama_kriteria?> :</th>
                                  </tr>
                                <tr>
                                    <td>Minimal</td>
                                    <td>
                                        <select class="form-control"  required name="kriteria_<?=$row->id_kriteria?>">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>

                                <tr>
                                    <td>Maksimal</td>
                                    <td>
                                        <select class="form-control"  required name="kriteria2_<?=$row->id_kriteria?>">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php } endforeach; ?>
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue btn-block "  name="tambah" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<?php $i = 1; foreach ($list_spek as $row): ?>

<div class="modal fade" id="edit-<?=$row->id_spesifikasi?>">
        <div class="modal-dialog edit-<?=$row->id_spesifikasi?>">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Edit Spesifikasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('admin/prosesspek')?>" method="Post"  >   
              <input type="hidden" name="id_spesifikasi" value="<?=$row->id_spesifikasi?>">
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Nama Spesifikasi
                                         </th>
                                         <td> 
                                          
                                            
                                            <input type="text" class="form-control" name="nama_spesifikasi"  required autofocus value="<?=$row->nama_spesifikasi?>"  >

                                         </td>
                                     </tr> 
                                    <?php $i= 1; foreach ($list_kriteria as $row2): ?>  

                            <?php if ($row2->id_kriteria != 7) { ?> 
                                <tr>
                                    <th colspan="2"><?=$row2->nama_kriteria?> :</th>
                                  </tr>
                                <tr>
                                    <td>Minimal</td>
                                    <td>
                                        <select class="form-control"  required name="kriteria_<?=$row2->id_kriteria?>">
                                             <?php $nilaix = $this->DetailSpec_m->get_row(['id_kriteria' => $row2->id_kriteria, 'id_spesifikasi' => $row->id_spesifikasi])->min_bobot; ?>


                                            <option value="<?=$nilaix?>"><?=$this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan?></option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row2->id_kriteria]);?>
                                              <?php foreach ($list_param as $row3): ?>
                                              <?php if ($row3->id_bobot != $nilaix) { ?>  
                                                <option value="<?=$row3->id_bobot?>"><?=$row3->keterangan?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>

                                <tr>
                                    <td>Maksimal</td>
                                    <td>
                                        <select class="form-control"  required name="kriteria2_<?=$row2->id_kriteria?>">
                                              <?php $nilaix = $this->DetailSpec_m->get_row(['id_kriteria' => $row2->id_kriteria, 'id_spesifikasi' => $row->id_spesifikasi])->max_bobot; ?> 
                                               <option value="<?=$nilaix?>"><?=$this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan?></option> 
                                              <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row2->id_kriteria]);?>
                                              <?php foreach ($list_param as $row3): ?>  
                                              <?php if ($row3->id_bobot != $nilaix) { ?>
                                                <option value="<?=$row3->id_bobot?>"><?=$row3->keterangan?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php } endforeach; ?>
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue btn-block "  name="edit" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<?php endforeach; ?>
<?php $i = 1; foreach ($list_spek as $row): ?>

<div class="modal fade" id="delete-<?=$row->id_spesifikasi?>">
        <div class="modal-dialog delete-<?=$row->id_spesifikasi?>">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Spesifikasi <?=$row->nama_spesifikasi?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/prosesspek')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_spesifikasi?>" name="id_spesifikasi">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 
<?php endforeach; ?>


