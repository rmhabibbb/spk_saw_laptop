 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
                <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>   
                            <th>ID Customer</th> 
                            <th>Nama </th>  
                            <th>Jenis Kelamin </th>  
                            <th>Tanggal Lahir (Umur) </th>  
                            <th>Email</th>
                            <th>No HP </th>   
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_customer as $row): ?> 
                          <tr>    
                              <td><?=$row->id_customer?>  </td>  
                              <td><?=$row->nama_customer?></td>   
                              <td><?=$row->jk?></td>   
                              <?php 
                                $birthDate = new DateTime($row->tl);
                                $today = new DateTime("today");
                                if ($birthDate > $today) { 
                                  exit("0 tahun 0 bulan 0 hari");
                                }
                                $y = $today->diff($birthDate)->y; 
                              ?>
                              <td><?= date('d-m-Y',strtotime($row->tl)) ?> (<?=$y?> Tahun)</td>   
                              <td><?=$row->email?></td>   
                              <td><?=$row->no_hp?></td>   
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

