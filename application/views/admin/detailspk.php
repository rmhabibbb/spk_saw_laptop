 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Perhitungan SAW</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li> 
              <li class="breadcrumb-item active">Detail Perhitungan SAW</li>
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
                <h3>1. Nilai Awal</h3>
                              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>    
                                                  <th>Nama Laptop </th>

                                            <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                                                  <th><?=$row->nama_kriteria?></th>  
                                            <?php endforeach; ?>
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($nilai_awal as $row): ?>  
                                            <?php $laptop = $this->Laptop_m->get_row(['kd_laptop' => $row['kd_laptop']]); ?>
                                                <tr>    
                                                    <td><?=$laptop->merk?> - <?=$laptop->tipe_laptop?>  </td>  
                                                    <td><?=$row['nilai'][0]?>  </td>  
                                                    <td><?=$row['nilai'][1]?>  </td>  
                                                    <td><?=$row['nilai'][2]?>  </td>  
                                                    <td><?=$row['nilai'][3]?>  </td>  
                                                    <td><?=$row['nilai'][4]?>  </td>  
                                                    <td><?=$row['nilai'][5]?>  </td>  
                                                    <td><?=$row['nilai'][6]?>  </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>

                              <h3>2. Normalisasi Matrik R</h3>
                              <div class="table-responsive">
                <table id="example3" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>    
                                                  <th>Nama Laptop </th>
                                                  <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                                                  <th><?=$row->nama_kriteria?></th>  
                                            <?php endforeach; ?> 
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($matrik_r as $row): ?>  
                                            <?php $laptop = $this->Laptop_m->get_row(['kd_laptop' => $row['kd_laptop']]); ?>
                                                <tr>    
                                                    <td><?=$laptop->merk?> - <?=$laptop->tipe_laptop?>  </td>  
                                                    <td><?=$row['C1']?>  </td> 
                                                    <td><?=$row['C2']?>  </td> 
                                                    <td><?=$row['C3']?>  </td> 
                                                    <td><?=$row['C4']?>  </td> 
                                                    <td><?=$row['C5']?>  </td> 
                                                    <td><?=$row['C6']?>  </td> 
                                                    <td><?= number_format($row['C7'],2) ?>  </td> 
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
                              <h3>3. Hasil Akhir  </h3>
                                <div class="table-responsive">
                <table id="example4" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>    
                                                  <th>Kode Laptop </th>
                                                  <th>Nama Laptop </th> 
                                                  <th>Nilai Akhir</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_laptop as $row): ?> 
                                            <?php $laptop = $this->Laptop_m->get_row(['kd_laptop' => $row['kd_laptop']]); ?>
                                                <tr>    
                                                    
                                                    <td><?=$laptop->kd_laptop?>   </td>
                                                    <td><?=$laptop->merk?> - <?=$laptop->tipe_laptop?>  </td>   
                                                    <td><?= $row['nilai_akhir'] ?>  </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                  <h3>4. Perangkingan</h3>
                                <div class="table-responsive">
                                  <table id="example4" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>      
                                                  <th>Peringkat</th>  
                                                  <th>Kode Laptop </th>
                                                  <th>Nama Laptop </th>  
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_laptop2 as $row): ?> 
                                            <?php $laptop = $this->Laptop_m->get_row(['kd_laptop' => $row['kd_laptop']]); ?>
                                                <tr>    
                                                    <td><?=$i++?></td>
                                                    <td><?=$laptop->kd_laptop?>   </td>
                                                    <td><?=$laptop->merk?> - <?=$laptop->tipe_laptop?>  </td>   
                                                     
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
</div>
 