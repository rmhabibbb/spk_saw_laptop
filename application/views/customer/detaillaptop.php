 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$laptop->merk?> - <?=$laptop->tipe_laptop?> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('customer')?>">Beranda</a></li> 
              <li class="breadcrumb-item active"><?=$laptop->merk?> - <?=$laptop->tipe_laptop?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style type="text/css">
      .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}
    </style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         <div class="card"> 
              <!-- /.card-header -->
              <div class="card-body">
 
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row"> 

                                             <div class="col-md-4"> 
                                                 <img src="<?=base_url()?>/assets/<?=$laptop->foto?>" width="100%">  
                                                 
                                             </div> 
                                             <div class="col-md-8">
                                              <table class="table table-bordered ">
                              <tr>
                                    <th  style="width: 20%">Merek</th>
                                    <td>
                                       <?=$laptop->merk?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tipe Laptop</th>
                                    <td>
                                       <?=$laptop->tipe_laptop?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rating</th>
                                    <td>
                                         <?php 

                                                      $n = $this->Laptop_m->get_star($laptop->kd_laptop);
                                                     
                                                      for ($x=0; $x < $n ; $x++) { 
                                                        echo '<i class="nav-icon fas fa-star"></i>';
                                                      } echo ' ('.number_format($n,2).') ';
                                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>
                                       <?=$laptop->keterangan?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Spesifikasi</th>
                                    <td>
                                        <?php 
                                                          $list_spek = $this->SpecLaptop_m->get(['kd_laptop' => $laptop->kd_laptop]);
                                                          $n = sizeof($list_spek);

                                                          if ($n == 0) {
                                                            echo "-";
                                                          }else{
                                                            foreach ($list_spek as $s) {
                                                              echo '- ' . $this->Spec_m->get_row(['id_spesifikasi' => $s->id_spesifikasi])->nama_spesifikasi ;
                                                              if (next($s) == null) {
                                                                echo ", ";
                                                              }
                                                            }
                                                          }
                                                        ?> 
                                    </td>
                                </tr> 

                                <tr>
                                    <th>RAM (GB)</th>
                                    <td>
                                       <?=$laptop->ram?> GB
                                    </td>
                                </tr>
                                <tr>
                                    <th>VGA</th>
                                    <td>
                                       <?=$laptop->vga?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Hardisk (GB)</th>
                                    <td>
                                        <?=$laptop->hardisk?> GB
                                    </td>
                                </tr>
                                <tr>
                                    <th>Screen (inch)</th>
                                    <td>
                                        <?=$laptop->screen?> inch
                                    </td>
                                </tr>
                                <tr>
                                    <th>Battery (cell)</th>
                                    <td>
                                        <?=$laptop->battery?> cell
                                    </td>
                                </tr>
                                <tr>
                                    <th>Harga (Rupiah)</th>
                                    <td>
                                      <?= number_format($laptop->harga,2,',','.')  ?>
                                    </td>
                                </tr>
                           
                            </table>
                                                 
                                                 
                                             </div>  
                                         </div> 

                                   </div>
                                 </div>
  
                            </fieldset> 
                            
                                        
                                       
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 