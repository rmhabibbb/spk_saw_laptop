  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$kriteria->nama_kriteria?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/kriteria')?>">Kriteria</a></li>
              <li class="breadcrumb-item active"><?=$kriteria->nama_kriteria?></li>
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
                <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             ID Kriteria
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->id_kriteria?>

                                         </td>
                                     </tr>
                                     <tr>
                                         <th style="width: 30%">
                                             Nama Kriteria
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->nama_kriteria?>
 
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Tipe
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->tipe?>
 
                                         </td>
                                     </tr> 
                                     <tr>
                                         <th style="width: 30%">
                                             Bobot
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->bobot_vektor?>%
 
                                         </td>
                                     </tr>   
                                   
                                </tbody>

                </table>  
                            <br>
                            <center>
                            <a data-toggle="modal" data-target="#edit"  href=""><button class="btn bg-blue">Edit Bobot</button></a> 
                             </center>
              </div>
          </div>

           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Bobot Kriteria</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                  <a data-toggle="modal" data-target="#tambahsub"  href=""><button class="btn bg-blue">Tambah Bobot</button></a>
                  <br><br>

                <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                      <tr>   
                          <th>No.</th> 
                          <th>Keterangan</th> 
                          <th>Nilai</th> 
                          <th>Aksi</th>  
                      </tr>
                  </thead> 
                  <tbody>
                    <?php $i = 1; foreach ($list_sub as $row): ?> 
                        <tr>   
                            <td><?=$i++?></a></td>  
                            <td><?=$row->keterangan?></td>  
                            <td><?=$row->nilai?></td>
                             <td>
                                  <a data-toggle="modal" data-target="#edit-<?=$row->id_bobot?>"  href=""><button class="btn bg-blue">Edit</button></a>
                                  <a data-toggle="modal" data-target="#delete-<?=$row->id_bobot?>"  href=""><button class="btn bg-red">Hapus</button></a>
                             </td>             
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table> 
              </div> 
      </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div> 
 
 <div class="modal fade" id="edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>EDIT BOBOT KRITERIA</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/kriteria')?>" method="Post"  >   
                          <table class="table table-bordered table-striped table-hover" style="max-height: 300px">
                            
                          <input type="hidden" name="id_kriteria" value="<?=$kriteria->id_kriteria?>">
                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             Bobot Vektor
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="number" class="form-control" name="bobot" placeholder="Bobot Vektor" required  value="<?=$kriteria->bobot_vektor?>" step="any" >

                                         </td>
                                     </tr> 
                                   
                                </tbody> 
                          </table>   
                        <input  type="submit" class="btn bg-blue btn-block  "  name="edit" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
    </div> 
 
<div class="modal fade" id="tambahsub" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>TAMBAH DATA BOBOT KRITERIA</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/bobot')?>" method="Post"  >  
                            <input type="hidden" class="form-control" name="id_kriteria"   required autofocus  value="<?=$kriteria->id_kriteria?>" >
                            <input type="hidden" class="form-control" name="jenis"   required autofocus  value="<?=$kriteria->jenis_bobot?>" >

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Keterangan
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="text" class="form-control" name="ket" placeholder="Keterangan" required autofocus  >

                                         </td>
                                     </tr> 
                                     <?php if ($kriteria->jenis_bobot == 2) { ?>
                                       <tr>
                                         <th style="width: 30%">
                                              Minimal
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="text" class="form-control" name="min" placeholder="Minimal" required step="any" autofocus  >

                                         </td>
                                     </tr> 
                                      <tr>
                                         <th style="width: 30%">
                                              Maksimal
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="text" class="form-control" name="max" placeholder="Maksimal" required step="any" autofocus  >

                                         </td>
                                     </tr> 
                                     <?php } ?>
                                   
                                </tbody> 
                            </table>       
                                 <table class="table table-bordered">
                                    <thead>
                                        <tr>   
                                            <th>Bobot</th> 
                                            <th>Nilai</th>  
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                          <tr>   
                                              <td>Sangat Rendah</td>  
                                              <td>1</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Rendah</td>  
                                              <td>2</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Cukup</td>  
                                              <td>3</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Tinggi</td>  
                                              <td>4</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Sangat Tinggi</td>  
                                              <td>5</td>   
                                          </tr> 
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Nilai
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="number" class="form-control" name="nilai" placeholder="Nilai" required autofocus  min="1" max="5">
                                         </td>
                                     </tr> 
                                   
                                </tbody> 
                            </table>    
                        <input  type="submit" class="btn bg-blue btn-block "  name="tambah" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div> 
 
 
 

<?php $i = 1; foreach ($list_sub as $row): ?> 
  <div class="modal fade" id="edit-<?=$row->id_bobot?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>EDIT DATA BOBOT KRITERIA</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/bobot')?>" method="Post"  > 

                            <input type="hidden" value="<?=$kriteria->id_kriteria?>" name="id_kriteria">   
                            <input type="hidden" value="<?=$row->id_bobot?>" name="id_bobot">   
                            
                            <input type="hidden" class="form-control" name="jenis"   required autofocus  value="<?=$kriteria->jenis_bobot?>" >
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Keterangan
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="text" class="form-control" name="ket" placeholder="Keterangan" required autofocus value="<?=$row->keterangan?>"  >

                                         </td>
                                     </tr> 
                                     <?php if ($kriteria->jenis_bobot == 2) { ?>
                                       <tr>
                                         <th style="width: 30%">
                                              Minimal
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="text" class="form-control" name="min" placeholder="Minimal" required step="any" autofocus value="<?=$row->min?>" >

                                         </td>
                                     </tr> 
                                      <tr>
                                         <th style="width: 30%">
                                              Maksimal
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="text" class="form-control" name="max" placeholder="Maksimal" required step="any" autofocus value="<?=$row->max?>"  >

                                         </td>
                                     </tr> 
                                     <?php } ?>
                                </tbody> 
                            </table>        
                 <table class="table table-bordered">
                                    <thead>
                                        <tr>   
                                            <th>Bobot</th> 
                                            <th>Nilai</th>  
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                          <tr>   
                                              <td>Sangat Rendah</td>  
                                              <td>1</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Rendah</td>  
                                              <td>2</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Cukup</td>  
                                              <td>3</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Tinggi</td>  
                                              <td>4</td>   
                                          </tr> 
                                          <tr>   
                                              <td>Sangat Tinggi</td>  
                                              <td>5</td>   
                                          </tr> 
                                    </tbody>
                                </table>
                                 <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Nilai
                                         </th>
                                         <td> 
                                          
                                            
                                        <input type="number" class="form-control" name="nilai" placeholder="Nilai" required autofocus min="1" max="5"  step="any" value="<?=$row->nilai?>">
                                         </td>
                                     </tr> 
                                   
                                </tbody> 
                            </table>     

                            <input  type="submit" class="btn bg-blue btn-block  "  name="edit" value="Simpan">  <br><br>
                      
                                <?php echo form_close() ?> 
                            </div> 
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                            </div>
                    </div>
                </div>
    </div> 
<?php endforeach; ?>



<?php $i = 1; foreach ($list_sub as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_bobot?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data subkriteria?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan subkriteria ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/bobot')?>" method="Post" > 
                                        <input type="hidden" value="<?=$kriteria->id_kriteria?>" name="id_kriteria"> 
                                        <input type="hidden" value="<?=$row->id_bobot?>" name="id_bobot">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
<?php endforeach; ?>