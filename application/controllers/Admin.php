<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 1))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m'); 
    $this->load->model('register_m');   
    $this->load->model('Bobot_m');   
    $this->load->model('Customer_m');   
    $this->load->model('DetailSpec_m');     
    $this->load->model('Kriteria_m');   
    $this->load->model('Laptop_m');   
    $this->load->model('Penilaian_m');    
    $this->load->model('Spec_m');    
    $this->load->model('SpecLaptop_m');    
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 
    
      $saw = $this->Laptop_m->saw();

      $this->data['list_laptop'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 0;
      $this->data['content'] = 'admin/dashboard';
      $this->template($this->data,'admin');
}

// KELOLA SPK
    public function spk(){
      
      $saw = $this->Laptop_m->saw();

      $this->data['list_laptop'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'admin/spk';
      $this->template($this->data,'admin');
    }

    public function detailspk(){
      
      $saw = $this->Laptop_m->saw();

      $this->data['list_kriteria'] = $this->Kriteria_m->get();  
      $this->data['nilai_awal'] = $saw['nilai_awal'];  
      $this->data['matrik_r'] = $saw['matrik_r']; 
      $this->data['list_laptop'] = $saw['hasil'];
      $this->data['list_laptop2'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Detail Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'admin/detailspk';
      $this->template($this->data,'admin');
    }
// KELOLA SPK

// KELOLA KRITERA ----------------------------------------------------------------------------

    public function kriteria(){
      if ($this->POST('tambah')) {   
        $data = [   
          'nama_kriteria' => $this->POST('nama') ,
          'bobot_vektor' => $this->POST('bobot') ,
          'keterangan' => $this->POST('kat')  
        ];
        $this->Kriteria_m->insert($data);

        $id = $this->Kriteria_m->get_row(['nama_kriteria' => $this->POST('nama')])->id_kriteria;


        $this->flashmsg('KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'.$id);
        exit();    
      }  

      if ($this->POST('edit')) { 
        $data = [    
          'bobot_vektor' => $this->POST('bobot') 
        ];

        $this->Kriteria_m->update($this->POST('id_kriteria'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

       

      if ($this->uri->segment(3)) {
        if ($this->Kriteria_m->get_num_row(['id_kriteria' => $this->uri->segment(3)]) == 1) {
          $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->uri->segment(3)]);   
          $this->data['list_sub'] = $this->Bobot_m->get(['id_kriteria' => $this->uri->segment(3) ]);     
 
           
          $this->data['title']  = 'Kelola Kriteria - '.$this->data['kriteria']->nama_kriteria .'';
          $this->data['index'] = 4;
          $this->data['content'] = 'admin/detailkriteria';
          $this->template($this->data,'admin'); 
        }else {
          redirect('sekretariat/kriteria');
          exit();
        }
      }

     
      else {
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  


        $this->data['title']  = 'Kelola Data Kriteria';
        $this->data['index'] = 4;
        $this->data['content'] = 'admin/kriteria';
        $this->template($this->data,'admin');
      }
    } 

    public function bobot(){
      if ($this->POST('tambah')) {   

        if ($this->POST('jenis') == 2) {
           $data = [   
            'keterangan' => $this->POST('ket'), 
            'nilai' => $this->POST('nilai'),
            'id_kriteria' => $this->POST('id_kriteria'),
            'min' => $this->POST('min'),
            'max' => $this->POST('max') 
          ];
        }else{
          $data = [   
            'keterangan' => $this->POST('ket'), 
            'nilai' => $this->POST('nilai'),
            'id_kriteria' => $this->POST('id_kriteria') 
          ];
        }

        
        $this->Bobot_m->insert($data);
 
        $this->flashmsg('BOBOT KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'. $this->POST('id_kriteria'));
        exit();    
      }  

      if ($this->POST('edit')) { 
        if ($this->POST('jenis') == 2) {
           $data = [   
            'keterangan' => $this->POST('ket'), 
            'nilai' => $this->POST('nilai'), 
            'min' => $this->POST('min'),
            'max' => $this->POST('max') 
          ];
        }else{
          $data = [   
            'keterangan' => $this->POST('ket'), 
            'nilai' => $this->POST('nilai') 
          ];
        }
         

        $this->Bobot_m->update($this->POST('id_bobot'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) {   
        $this->Bobot_m->delete($this->POST('id_bobot'));
        $this->flashmsg('DATA BOBOT KRITERA BERHASIL DIHAPUS!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      }  
    } 
     
// KELOLA KRITERIA ---------------------------------------------------------------------
 

// KELOLA LAPTOP 

    public function laptop(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['laptop'] = $this->Laptop_m->get_row(['kd_laptop' => $kd]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = $this->data['laptop']->kd_laptop .' - Kelola Data Laptop';
        $this->data['index'] = 2;
        $this->data['content'] = 'admin/detaillaptop';
        $this->template($this->data,'admin');
      }else{
        $this->data['list_laptop'] = $this->Laptop_m->get();  
        $this->data['title']  = 'Kelola Data Laptop';
        $this->data['index'] = 2;
        $this->data['content'] = 'admin/laptop';
        $this->template($this->data,'admin');
      }
      
      
    } 

    public function proseslaptop(){


      if ($this->POST('tambah')) {
        $kd_laptop = $this->POST('kd_laptop'); 
        if ($this->Laptop_m->get_num_row(['kd_laptop' => $kd_laptop]) != 0) { 
          $this->flashmsg('Kode Laptop telah digunakan!', 'warning');
          redirect('admin/proseslaptop/');
          exit();    
        } 


        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 11 ; $j++) {
            $id_foto .= rand(0,9);
          } 
          $this->upload($id_foto, 'laptop/','foto');   
        }else{
          $id_foto = 'default';
        }
 

        $c1 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k1')])->keterangan;
        $c2 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k2')])->keterangan;
        $c3 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k3')])->keterangan;

        $data = [ 
          'kd_laptop' => $this->POST('kd_laptop'), 
          'merk' => $this->POST('merk'), 
          'tipe_laptop' => $this->POST('tipe_laptop'), 
          'keterangan' => $this->POST('keterangan'),   
          'prosessor' => $c1,   
          'ram' => $c2,   
          'vga' => $c3,   
          'hardisk' => $this->POST('k4'),   
          'screen' => $this->POST('k5'),   
          'battery' => $this->POST('k6'),   
          'harga' => $this->POST('k7'),   
          'post_by' => $this->data['profil']->email,    
          'foto' => 'laptop/'.$id_foto.'.jpg'
        ];

        $this->Laptop_m->insert($data);

        $c1 = $this->POST('k1'); 
        $c2 = $this->POST('k2'); 
        $c3 = $this->POST('k3'); 

        $list = $this->Bobot_m->get(['id_kriteria' => 4]); 
        foreach ($list as $k) {
          if ($this->POST('k4') >= $k->min && $this->POST('k4') <= $k->max) {
            $c4 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 5]); 
        foreach ($list as $k) {
          if ($this->POST('k5') >= $k->min && $this->POST('k5') <= $k->max) {
            $c5 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 6]); 
        foreach ($list as $k) {
          if ($this->POST('k6') >= $k->min && $this->POST('k6') <= $k->max) {
            $c6 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 7]); 
        foreach ($list as $k) {
          if ($this->POST('k7') >= $k->min && $this->POST('k7') <= $k->max) {
            $c7 = $k->id_bobot;
          }
        }

        $this->Penilaian_m->insert(['id_kriteria' => 1,'kd_laptop' => $kd_laptop,'id_bobot' => $c1]);
        $this->Penilaian_m->insert(['id_kriteria' => 2,'kd_laptop' => $kd_laptop,'id_bobot' => $c2]);
        $this->Penilaian_m->insert(['id_kriteria' => 3,'kd_laptop' => $kd_laptop,'id_bobot' => $c3]);
        $this->Penilaian_m->insert(['id_kriteria' => 4,'kd_laptop' => $kd_laptop,'id_bobot' => $c4]);
        $this->Penilaian_m->insert(['id_kriteria' => 5,'kd_laptop' => $kd_laptop,'id_bobot' => $c5]);
        $this->Penilaian_m->insert(['id_kriteria' => 6,'kd_laptop' => $kd_laptop,'id_bobot' => $c6]);
        $this->Penilaian_m->insert(['id_kriteria' => 7,'kd_laptop' => $kd_laptop,'id_bobot' => $c7]);
        
        $nilais = [$c1, $c2, $c3, $c4, $c5, $c6, $c7];

         
        $list_spec = $this->Spec_m->get();
        $list_kriteria = $this->Kriteria_m->get();
        foreach ($list_spec as $l) { 

          $z = 0;
         foreach ($list_kriteria as $k) {
            $min = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->min_bobot;
            $max = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->max_bobot;

            $nilai = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria,'kd_laptop' => $kd_laptop])->id_bobot;

              if ($nilai >= $min && $nilai <= $max) {
                $z++;
              }
          }

          if ($z == 6) {
            $this->SpecLaptop_m->insert(['kd_laptop' => $kd_laptop,'id_spesifikasi' => $l->id_spesifikasi]);
          }
        } 



        $this->flashmsg('Data Laptop berhasil ditambah!', 'success');
        redirect('admin/laptop/'.$kd_laptop);
        exit();

      }

      if ($this->POST('edit')) {
        $kd_laptop = $this->POST('kd_laptop'); 
        $kd_laptop_x = $this->POST('kd_laptop_x'); 
        if ($this->Laptop_m->get_num_row(['kd_laptop' => $kd_laptop]) != 0 && $kd_laptop != $kd_laptop_x) { 
          $this->flashmsg('Kode Laptop telah digunakan!', 'warning');
          redirect('admin/proseslaptop/');
          exit();    
        } 
 
        $fotolama = $this->Laptop_m->get_row(['kd_laptop' => $kd_laptop_x])->foto;
        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 11 ; $j++) {
            $id_foto .= rand(0,9);
          } 
          @unlink(realpath(APPPATH . '../assets/' . $fotolama));
          $this->upload($id_foto, 'laptop/','foto');    
          $this->Laptop_m->update($kd_laptop_x,['foto' => 'laptop/'.$id_foto.'.jpg']);

        }
 
        $c1 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k1')])->keterangan;
        $c2 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k2')])->keterangan;
        $c3 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k3')])->keterangan;

        $data = [ 
          'kd_laptop' => $this->POST('kd_laptop'), 
          'merk' => $this->POST('merk'), 
          'tipe_laptop' => $this->POST('tipe_laptop'), 
          'keterangan' => $this->POST('keterangan'),
          'prosessor' => $c1,   
          'ram' => $c2,   
          'vga' => $c3,   
          'hardisk' => $this->POST('k4'),   
          'screen' => $this->POST('k5'),   
          'battery' => $this->POST('k6'),   
          'harga' => $this->POST('k7')
        ];

        $this->Laptop_m->update($kd_laptop_x,$data);

        $this->Penilaian_m->delete_by(['kd_laptop' => $kd_laptop]);
        $c1 = $this->POST('k1'); 
        $c2 = $this->POST('k2'); 
        $c3 = $this->POST('k3'); 

        $list = $this->Bobot_m->get(['id_kriteria' => 4]); 
        foreach ($list as $k) {
          if ($this->POST('k4') >= $k->min && $this->POST('k4') <= $k->max) {
            $c4 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 5]); 
        foreach ($list as $k) {
          if ($this->POST('k5') >= $k->min && $this->POST('k5') <= $k->max) {
            $c5 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 6]); 
        foreach ($list as $k) {
          if ($this->POST('k6') >= $k->min && $this->POST('k6') <= $k->max) {
            $c6 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 7]); 
        foreach ($list as $k) {
          if ($this->POST('k7') >= $k->min && $this->POST('k7') <= $k->max) {
            $c7 = $k->id_bobot;
          }
        }

        $this->Penilaian_m->insert(['id_kriteria' => 1,'kd_laptop' => $kd_laptop,'id_bobot' => $c1]);
        $this->Penilaian_m->insert(['id_kriteria' => 2,'kd_laptop' => $kd_laptop,'id_bobot' => $c2]);
        $this->Penilaian_m->insert(['id_kriteria' => 3,'kd_laptop' => $kd_laptop,'id_bobot' => $c3]);
        $this->Penilaian_m->insert(['id_kriteria' => 4,'kd_laptop' => $kd_laptop,'id_bobot' => $c4]);
        $this->Penilaian_m->insert(['id_kriteria' => 5,'kd_laptop' => $kd_laptop,'id_bobot' => $c5]);
        $this->Penilaian_m->insert(['id_kriteria' => 6,'kd_laptop' => $kd_laptop,'id_bobot' => $c6]);
        $this->Penilaian_m->insert(['id_kriteria' => 7,'kd_laptop' => $kd_laptop,'id_bobot' => $c7]);
        
        $nilais = [$c1, $c2, $c3, $c4, $c5, $c6, $c7];

        $list_spec = $this->Spec_m->get();
        $list_kriteria = $this->Kriteria_m->get();
        $this->SpecLaptop_m->delete_by(['kd_laptop' => $kd_laptop]);
        foreach ($list_spec as $l) { 
          $z = 0;

          foreach ($list_kriteria as $k) {
            $min = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->min_bobot;
            $max = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->max_bobot;

            $nilai = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria,'kd_laptop' => $kd_laptop])->id_bobot;

              if ($nilai >= $min && $nilai <= $max) {
                $z++;
              }
          }

          if ($z == 6) {
            $this->SpecLaptop_m->insert(['kd_laptop' => $kd_laptop,'id_spesifikasi' => $l->id_spesifikasi]);
          }
        } 


        $this->flashmsg('Data laptop berhasil disimpan!', 'success');
        redirect('admin/laptop/'.$kd_laptop);
        exit();

      }

      if ($this->POST('hapus')) {
        $this->Laptop_m->delete($this->POST('kd_laptop'));
        $this->flashmsg('Data Laptop berhasil dihapus!', 'success');
        redirect('admin/laptop');
        exit();

      } 


      $this->data['list_kriteria'] = $this->Kriteria_m->get();  
      $this->data['title']  = 'Tambah Data Laptop';
      $this->data['index'] = 2;
      $this->data['content'] = 'admin/form-tambahlaptop';
      $this->template($this->data,'admin');
      
    } 
// KELOLA LAPTOP 



// KELOLA Spesifikasi 

    public function spesifikasi(){
      
 
        $this->data['list_spek'] = $this->Spec_m->get();  
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = 'Kelola Data Spesifikasi';
        $this->data['index'] = 3;
        $this->data['content'] = 'admin/spesifikasi';
        $this->template($this->data,'admin');
   
    } 

    public function prosesspek(){


      if ($this->POST('tambah')) {

        $data = [ 
          'nama_spesifikasi' => $this->POST('nama_spesifikasi') 
        ];

        $this->Spec_m->insert($data);
        $id = $this->db->insert_id();


        $list_kriteria = $this->Kriteria_m->get();

        foreach ($list_kriteria as $v) {
          if ($v->id_kriteria != 7) {
            $data = [
              'id_kriteria' => $v->id_kriteria,
              'id_spesifikasi' => $id,
              'min_bobot' => $this->POST('kriteria_'.$v->id_kriteria),
              'max_bobot' => $this->POST('kriteria2_'.$v->id_kriteria)
            ];
            $this->DetailSpec_m->insert($data);
          }
        }

        $list_laptop = $this->Laptop_m->get();

        foreach ($list_laptop as $l) {
          $z = 0;
          foreach ($list_kriteria as $k) {
            if ($k->id_kriteria != 7) { 
              $nilai = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria,'kd_laptop' => $l->kd_laptop])->id_bobot;

              if ($nilai >= $this->POST('kriteria_'.$k->id_kriteria) && $nilai <= $this->POST('kriteria2_'.$k->id_kriteria)) {
                $z++;
              }
            }
          } 

          if ($z == 6) {
            $this->SpecLaptop_m->insert(['kd_laptop' => $l->kd_laptop,'id_spesifikasi' => $id]);
          }
        }

      

        $this->flashmsg('Data Spesifikasi berhasil ditambah!', 'success');
        redirect('admin/spesifikasi/');
        exit();

      }

      if ($this->POST('edit')) {
        $id = $this->POST('id_spesifikasi');
        $data = [ 
          'nama_spesifikasi' => $this->POST('nama_spesifikasi') 
        ];

        $this->Spec_m->update($id,$data); 


        $list_kriteria = $this->Kriteria_m->get();
        $this->DetailSpec_m->delete_by(['id_spesifikasi' => $id]);
        foreach ($list_kriteria as $v) {
          if ($v->id_kriteria != 7) {
            $data = [
              'id_kriteria' => $v->id_kriteria,
              'id_spesifikasi' => $id,
              'min_bobot' => $this->POST('kriteria_'.$v->id_kriteria),
              'max_bobot' => $this->POST('kriteria2_'.$v->id_kriteria)
            ];
            $this->DetailSpec_m->insert($data);
          }
        }

        $list_laptop = $this->Laptop_m->get();

        $this->SpecLaptop_m->delete_by(['id_spesifikasi' => $id]);
        foreach ($list_laptop as $l) {
          $z = 0;
          foreach ($list_kriteria as $k) {
            if ($k->id_kriteria != 7) { 
              $nilai = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria,'kd_laptop' => $l->kd_laptop])->id_bobot;

              if ($nilai >= $this->POST('kriteria_'.$k->id_kriteria) && $nilai <= $this->POST('kriteria2_'.$k->id_kriteria)) {
                $z++;
              }
            }
          } 

          if ($z == 6) {
            $this->SpecLaptop_m->insert(['kd_laptop' => $l->kd_laptop,'id_spesifikasi' => $id]);
          }
        }

        $this->flashmsg('Data Spesifikasi berhasil disimpan!', 'success');
        redirect('admin/spesifikasi/');
        exit();

      }
  
      if ($this->POST('hapus')) {
        $this->Spec_m->delete($this->POST('id_spesifikasi'));
        $this->flashmsg('Data Spesifikasi berhasil dihapus!', 'success');
        redirect('admin/spesifikasi');
        exit();

      } 
      $this->data['title']  = 'Tambah Data Spesifikasi';
      $this->data['index'] = 3;
      $this->data['content'] = 'admin/form-tambahspek';
      $this->template($this->data,'admin');
      
    } 
// KELOLA Spesifikasi 

// Kelola Customer 
    public function customer(){
      
 
        $this->data['list_customer'] = $this->Customer_m->get();   
        $this->data['title']  = 'Kelola Data Customer_m';
        $this->data['index'] = 5;
        $this->data['content'] = 'admin/customer';
        $this->template($this->data,'admin');
   
    } 

// Kelola Customer 


  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 7;
        $this->data['content'] = 'admin/profil';
        $this->template($this->data,'admin');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) { 
            $this->flashmsg('Email telah digunakan!', 'warning');
            redirect('admin/profil');
            exit();
          }
          $this->login_m->update($this->POST('email_x'),['email' => $this->POST('email')]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('admin/profil');
          exit();

          }

        elseif ($this->POST('uploadfoto')) {
           if ($_FILES['foto']['name'] !== '') { 
              $files = $_FILES['foto'];
              $_FILES['foto']['name'] = $files['name'];
              $_FILES['foto']['type'] = $files['type'];
              $_FILES['foto']['tmp_name'] = $files['tmp_name'];
              $_FILES['foto']['size'] = $files['size'];

              $id_foto = rand(1,9);
              for ($j=1; $j <= 11 ; $j++) {
                $id_foto .= rand(0,9);
              } 

              if ($this->data['profil']->foto != 'foto/default.jpg' && $this->data['profil']->foto != 'foto/default-l.jpg' && $this->data['profil']->foto != 'foto/default-p.jpg') {
                @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
              }
              $this->upload($id_foto, 'foto/','foto');    
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/'.$id_foto.'.jpg']);
              $this->flashmsg('Foto Profil berhasil diupload!', 'success');
              redirect('admin/profil');
              exit();
            }else{
              redirect('admin/profil');
              exit(); 
            }
         } 
        elseif ($this->POST('hapusfoto')) { 
 
              @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto)); 
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/default.jpg']);
              $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
              redirect('admin/profil');
              exit();
            
         } 
          elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('pass1')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('admin/profil');
            exit();    
          }  

          else{

          redirect('admin/profil');
          exit();
          }

    }
 

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>
