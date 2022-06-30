<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customer extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 2))
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
    
    $this->data['akun'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
    $this->data['profil'] = $this->Customer_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 
      $saw = $this->Laptop_m->saw();
      if ($this->POST('cari')) {
        $c1 = $this->POST('c1'); 
        $c2 = $this->POST('c2');
        $c3 = $this->POST('c3');
        $c4 = $this->POST('c4');
        $c5 = $this->POST('c5');
        $c6 = $this->POST('c6');
        $c7 = $this->POST('c7');
 
        $this->data['index_spek'] = 0;
        $temp = array();
        foreach ($saw['hasil_akhir'] as $a) {
          $nilai = array();
          for ($i=1; $i <=7 ; $i++) { 
             $penilaian = $this->Penilaian_m->get_row(['kd_laptop' => $a['kd_laptop'], 'id_kriteria' => $i]);
              
              array_push($nilai, $penilaian->id_bobot);

          }

          $data = [
            'kd_laptop' => $a['kd_laptop'],
            'nilai' => $nilai
          ];

          array_push($temp, $data);
        }


        $temp_1 = array();
        if ($c1 == NULL) {
          $temp_1 = $temp;
        }else{
          foreach ($temp as $a) {
            if ($a['nilai'][0] == $c1) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_1, $data);
            }
          }
        }

        $temp_2 = array();
        if ($c2 == NULL) {
          $temp_2 = $temp_1;
        }else{
          foreach ($temp_1 as $a) {
            if ($a['nilai'][1] == $c2) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_2, $data);
            }
          }
        }

        $temp_3 = array();
        if ($c3 == NULL) {
          $temp_3 = $temp_2;
        }else{
          foreach ($temp_2 as $a) {
            if ($a['nilai'][2] == $c3) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_3, $data);
            }
          }
        }

        $temp_4 = array();
        if ($c4 == NULL) {
          $temp_4 = $temp_3;
        }else{
          foreach ($temp_3 as $a) {
            if ($a['nilai'][3] == $c4) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_4, $data);
            }
          }
        }
        $temp_5 = array();
        if ($c5 == NULL) {
          $temp_5 = $temp_4;
        }else{
          foreach ($temp_4 as $a) {
            if ($a['nilai'][4] == $c5) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_5, $data);
            }
          }
        } 
        $temp_6 = array();
        if ($c6 == NULL) {
          $temp_6 = $temp_5;
        }else{
          foreach ($temp_5 as $a) {
            if ($a['nilai'][5] == $c6) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_6, $data);
            }
          }
        } 
        $temp_7 = array();
        if ($c7 == NULL) {
          $temp_7 = $temp_6;
        }else{
          foreach ($temp_6 as $a) {
            if ($a['nilai'][6] == $c7) {
              $data = [
                'kd_laptop' => $a['kd_laptop'],
                'nilai' => $a['nilai']
              ];
            array_push($temp_7, $data);
            }
          }
        } 

        $this->data['list_laptop'] = $temp_7;  
      }



      elseif (isset($_GET['id_spek'])) {
        $this->data['index_spek'] = $_GET['id_spek'];
        $temp = array();
        foreach ($saw['hasil_akhir'] as $v) {
          $x = $this->SpecLaptop_m->get_num_row(['kd_laptop' => $v['kd_laptop'] , 'id_spesifikasi' => $_GET['id_spek']]);
          if ($x == 1) {
            array_push($temp, $v);
          }
        }

         $this->data['list_laptop'] = $temp;
      }else{
         $this->data['index_spek'] = 0;
         $this->data['list_laptop'] = $saw['hasil_akhir'];
      }


      $this->data['list_spesifikasi'] = $this->Spec_m->get();
      $this->data['list_kriteria'] = $this->Kriteria_m->get();
      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 0;
      $this->data['content'] = 'customer/dashboard';
      $this->template($this->data,'customer');
}

public function rekomendasi()
{ 
      
      $this->data['index_spek'] = -1;

      $this->data['list_spesifikasi'] = $this->Spec_m->get();
      $this->data['list_kriteria'] = $this->Kriteria_m->get();
      $this->data['list_rekomendasi'] = $this->Laptop_m->get_rekomendasi(); 
      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 0;
      $this->data['content'] = 'customer/rekomendasi';
      $this->template($this->data,'customer');
}

// KELOLA SPK
    public function spk(){
      
      $saw = $this->Laptop_m->saw();

      $this->data['list_laptop'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'customer/spk';
      $this->template($this->data,'customer');
    }

    
// KELOLA SPK
  
 
public function laptop(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['laptop'] = $this->Laptop_m->get_row(['kd_laptop' => $kd]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = $this->data['laptop']->kd_laptop .' - Kelola Data Laptop';
        $this->data['index'] = 0;
        $this->data['content'] = 'customer/detaillaptop';
        $this->template($this->data,'customer');
      }else{
        redirect('customer');
        exit();
      }
      
      
    } 



public function laptopanda(){
      
      if ($this->Laptop_m->get_num_row(['kd_laptop' => $this->data['profil']->id_customer]) == 0) {
        $this->data['title']  = 'Laptop Anda';
        $this->data['index'] = 1;
        $this->data['content'] = 'customer/laptop';
        $this->template($this->data,'customer');
      }else{
        $this->data['laptop'] = $this->Laptop_m->get_row(['kd_laptop' => $this->data['profil']->id_customer]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = 'Laptop Anda';
        $this->data['index'] = 1;
        $this->data['content'] = 'customer/laptop2';
        $this->template($this->data,'customer');
      }
  
        
 
      
      
    } 


public function proseslaptop(){


      if ($this->POST('tambah')) {
        $kd_laptop = $this->data['profil']->id_customer; 
        if ($this->Laptop_m->get_num_row(['kd_laptop' => $kd_laptop]) != 0) { 
          $this->flashmsg('Kode Laptop telah digunakan!', 'warning');
          redirect('customer/proseslaptop/');
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
          'kd_laptop' => $this->data['profil']->id_customer, 
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
          'rate1' => $this->POST('rate1'),   
          'rate2' => $this->POST('rate2'),   
          'rate3' => $this->POST('rate3'),   
          'rate4' => $this->POST('rate4'),   
          'rate5' => $this->POST('rate5'),   
          'rate6' => $this->POST('rate6'),   
          'rate7' => $this->POST('rate7'),    
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



        $this->flashmsg('Terima kasih, Data Laptop anda berhasil ditambah!', 'success');
        redirect('customer/laptopanda/');
        exit();

      }

      if ($this->POST('edit')) {
        $kd_laptop = $this->POST('kd_laptop'); 
        $kd_laptop_x = $this->POST('kd_laptop'); 
        if ($this->Laptop_m->get_num_row(['kd_laptop' => $kd_laptop]) != 0 && $kd_laptop != $kd_laptop_x) { 
          $this->flashmsg('Kode Laptop telah digunakan!', 'warning');
          redirect('customer/proseslaptop/');
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
          'harga' => $this->POST('k7'),
          'rate1' => $this->POST('rate1'),   
          'rate2' => $this->POST('rate2'),   
          'rate3' => $this->POST('rate3'),   
          'rate4' => $this->POST('rate4'),   
          'rate5' => $this->POST('rate5'),   
          'rate6' => $this->POST('rate6'),   
          'rate7' => $this->POST('rate7'),    
          'post_by' => $this->data['profil']->email
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


        $this->flashmsg('Data laptop anda berhasil disimpan!', 'success');
        redirect('customer/laptopanda/');
        exit();

      }

    
 
    } 

  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 7;
        $this->data['content'] = 'customer/profil';
        $this->template($this->data,'customer');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) { 
            $this->flashmsg('Email telah digunakan!', 'warning');
            redirect('customer/profil');
            exit();
          }

          if ($this->data['akun']->foto == 'foto/default-l.jpg' || $this->data['akun']->foto == 'foto/default-p.jpg') {
            if ($this->POST('jk') == "Perempuan") {
              $this->login_m->update($this->POST('email'),['foto' => 'foto/default-p.jpg']); 
            }else{ 
              $this->login_m->update($this->POST('email'),['foto' => 'foto/default-l.jpg']); 
            } 
          }

          
          $this->login_m->update($this->POST('email_x'),['email' => $this->POST('email')]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
           
           $data = [ 
            'nama_customer' => $this->POST('nama_customer'),
            'jk' => $this->POST('jk'),
            'tl' => $this->POST('tl'),
            'no_hp' => $this->POST('no_hp') 
          ];

          $this->Customer_m->update($this->POST('id_customer') , $data);

  
         $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('customer/profil');
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

              if ($this->data['akun']->foto != 'foto/default.jpg' && $this->data['akun']->foto != 'foto/default-l.jpg' && $this->data['akun']->foto != 'foto/default-p.jpg') {
                @unlink(realpath(APPPATH . '../assets/' . $this->data['akun']->foto));
              }
              $this->upload($id_foto, 'foto/','foto');    
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/'.$id_foto.'.jpg']);
              $this->flashmsg('Foto Profil berhasil diupload!', 'success');
              redirect('customer/profil');
              exit();
            }else{
              redirect('customer/profil');
              exit(); 
            }
         } 
        elseif ($this->POST('hapusfoto')) { 
 
              @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto)); 
              if ($this->data['profil']->jk == "Perempuan") {
                $foto = 'foto/default-p.jpg';
              }else{ 
                $foto = 'foto/default-l.jpg';
              }
              $this->login_m->update($this->data['profil']->email,['foto' => $foto]);
              $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
              redirect('customer/profil');
              exit();
            
         } 
          elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('pass1')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('customer/profil');
            exit();    
          }  

          else{

          redirect('customer/profil');
          exit();
          }

    }
 

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>
