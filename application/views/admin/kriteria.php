 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kriteria</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Kriteria</li>
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
                            <th>No</th> 
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>   
                            <th>Tipe</th>   
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                          <tr>   
                              <td><?=$i++?> </td>  
                              <td><?=$row->nama_kriteria?>  </td> 
                              <td> <?=$row->bobot_vektor?>%</td>   
                              <td><?=$row->tipe?>  </td>  
                               <td>
                                  <a href="<?=base_url('admin/kriteria/'.$row->id_kriteria)?>"> 
                                    <button class="btn bg-blue ">
                                      Lihat
                                    </button>
                                  </a>
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
