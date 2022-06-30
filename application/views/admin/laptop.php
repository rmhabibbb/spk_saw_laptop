 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laptop</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Laptop</li>
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

                  <a    href="<?=base_url('admin/proseslaptop')?>"><button class="btn bg-blue">Tambah Laptop</button></a>
                  <br><br>

                <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>   
                            <th>Kode Laptop</th> 
                            <th>Foto</th> 
                            <th>Merk</th>
                            <th>Tipe</th>   
                            <th>Keterangan</th> 
                            <th>Spesifikasi</th>   
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_laptop as $row): ?> 
                          <tr>    
                              <td><?=$row->kd_laptop?>  </td> 
                              <td><img src="<?=base_url()?>/assets/<?=$row->foto?>" width="100px">  </td> 
                              <td><?=$row->merk?>  </td> 
                              <td> <?=$row->tipe_laptop?></td>   
                              <td><?=$row->keterangan?>  </td>  
                              <td> 
                              <?php 
                                $list_spek = $this->SpecLaptop_m->get(['kd_laptop' => $row->kd_laptop]);
                                $n = sizeof($list_spek);

                                if ($n == 0) {
                                  echo "-";
                                }else{
                                  foreach ($list_spek as $s) {
                                    echo '- ' , $this->Spec_m->get_row(['id_spesifikasi' => $s->id_spesifikasi])->nama_spesifikasi . '<br>';
                                  }
                                }
                              ?>

                              </td>  
                               <td>
                                  <a href="<?=base_url('admin/laptop/'.$row->kd_laptop)?>"> 
                                    <button class="btn bg-blue ">
                                      Lihat Detail
                                    </button>
                                  </a>

                                  <a data-toggle="modal" data-target="#delete-<?=$row->kd_laptop?>"  href=""><button class="btn bg-red">Hapus</button></a>
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


<?php $i = 1; foreach ($list_laptop as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->kd_laptop?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data laptop?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan [<?=$row->kd_laptop?>]  akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/proseslaptop')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->kd_laptop?>" name="kd_laptop">  
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