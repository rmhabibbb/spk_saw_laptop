 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">SPK. Metode SAW</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">SPK. Metode SAW</li>
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
                 <a    href="<?=base_url('admin/detailspk')?>"><button class="btn bg-blue">Lihat Detail Hasil SPK</button></a>
                          <br>
                          <br>
                              <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>   
                                                  <th>Peringkat</th> 
                                                  <th>Foto </th>
                                                  <th>Laptop </th> 
                                                  <th>Nilai</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_laptop as $row): ?> 
                                            <?php $laptop = $this->Laptop_m->get_row(['kd_laptop' => $row['kd_laptop']]); ?>
                                                <tr>   
                                                    <td><?=$i++?> </td>  
                                                    <td><img src="<?=base_url()?>/assets/<?=$laptop->foto?>" width="100px">  </td> 
                                                    <td><a href="<?=base_url('admin/laptop/'.$laptop->kd_laptop)?>"><?=$laptop->merk?> - <?=$laptop->tipe_laptop?> </a> </td>  
                                                    <td><?= $row['nilai_akhir'] ?>  </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
          </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 