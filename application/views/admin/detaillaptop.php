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
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/laptop')?>">Laptop</a></li>
              <li class="breadcrumb-item active"><?=$laptop->merk?> - <?=$laptop->tipe_laptop?></li>
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

                   <?= form_open_multipart('admin/proseslaptop/') ?>
                    <input type="hidden" name="kd_laptop_x"  required value="<?=$laptop->kd_laptop?>" >
                                                 
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row">
                                             <div class="col-md-4">
                                                 <label class="control-label">Kode Laptop</label>
                                                 <input type="text" name="kd_laptop" class="form-control" placeholder="Masukkan Kode Laptop"  required value="<?=$laptop->kd_laptop?>" >
                                                 
                                             </div> 
                                             <div class="col-md-4">
                                                 <label class="control-label">Merek</label>
                                                 <input type="text" name="merk" class="form-control" placeholder="Masukkan Merek"  required value="<?=$laptop->merk?>"  >
                                                 
                                             </div> 
                                             <div class="col-md-4">
                                                 <label class="control-label">Tipe Laptop</label>
                                                 <input type="text" name="tipe_laptop" class="form-control" placeholder="Masukkan Tipe Laptop"  required value="<?=$laptop->tipe_laptop?>"  >
                                                 
                                             </div> 
                                         </div> 

                                   </div>
                                 </div>
 
                                <div class="form-group">

                                    <div class="form-line">
                                        <div class="row">
                                             <div class="col-md-4">
                                                 <label class="control-label">Foto</label><br>
                                                 <img src="<?=base_url()?>/assets/<?=$laptop->foto?>" width="100%"> 
                                                 <input type="file" name="foto" class="form-control"  >
                                                 
                                             </div> 
                                             <div class="col-md-8">
                                                 <label class="control-label">Keterangan</label>
                                                 <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan" ><?=$laptop->keterangan?></textarea>
                                                 
                                             </div> 
                                         </div> 
                                   </div>
                                 </div>
                            </fieldset> 
                            <table class="table table-bordered "> 
                              <tr>
                                    <th>Prosessor</th>
                                    <td>
                                        <select class="form-control"  required name="k1">  
                                          <?php $nilaix = $this->Penilaian_m->get_row(['id_kriteria' => 1, 'kd_laptop' => $laptop->kd_laptop])->id_bobot; ?>

                                            <option value="<?=$nilaix?>"><?=$this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan?></option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                              <?php foreach ($list_param as $row2): ?> 
                                              <?php if ($row2->id_bobot != $nilaix) { ?>
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>

                                <tr>
                                    <th>RAM (GB)</th>
                                    <td>
                                        <select class="form-control"  required name="k2">
                                           <?php $nilaix = $this->Penilaian_m->get_row(['id_kriteria' => 2, 'kd_laptop' => $laptop->kd_laptop])->id_bobot; ?>

                                            <option value="<?=$nilaix?>"><?=$this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan?></option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 2]);?>
                                              <?php foreach ($list_param as $row2): ?> 
                                              <?php if ($row2->id_bobot != $nilaix) { ?>
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>VGA</th>
                                    <td>
                                        <select class="form-control"  required name="k3">
                                           <?php $nilaix = $this->Penilaian_m->get_row(['id_kriteria' => 3, 'kd_laptop' => $laptop->kd_laptop])->id_bobot; ?>

                                            <option value="<?=$nilaix?>"><?=$this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan?></option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 3]);?>
                                              <?php foreach ($list_param as $row2): ?> 
                                              <?php if ($row2->id_bobot != $nilaix) { ?>
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>

                                <tr>
                                    <th>Hardisk (GB)</th>
                                    <td>
                                        <input type="number" name="k4" required class="form-control" min="100" value="<?=$laptop->hardisk?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <th>Screen (inch)</th>
                                    <td>
                                        <input type="number" name="k5" required class="form-control" min="1" step="any"  value="<?=$laptop->screen?>"   >
                                    </td>
                                </tr>
                                <tr>
                                    <th>Battery (cell)</th>
                                    <td>
                                        <input type="number" name="k6" required class="form-control" min="1"  step="any"  value="<?=$laptop->battery?>"  >
                                    </td>
                                </tr>
                                <tr>
                                    <th>Harga (Rupiah)</th>
                                    <td>
                                        <input type="number" name="k7" required class="form-control" min="1"  value="<?=$laptop->harga?>"  >
                                    </td>
                                </tr>
                            </table>
                           
                                      
                              
                            <input  type="submit" class="btn bg-blue btn-block "  name="edit" value="Edit">  <br><br>
                             <?php echo form_close() ?> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 