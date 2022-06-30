<?php
/**
 *
 */
class Daftar extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['email'], $this->data['id_role']))
    {
      switch ($this->data['id_role'])
      {
        case 1:
          redirect('admin');
          break;
        case 2:
          redirect('customer');
          break;   
      }
      exit;
    }
    $this->load->model('Login_m');
    $this->load->model('Customer_m');
  }

  public function cek(){
      $email = $this->POST('email');
      $password = $this->POST('password');
      if($this->Login_m->cek_login($email,$password) == 0){
        $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> email tidak terdaftar!', 'danger');
        redirect('login');
        exit;
      }else if($this->Login_m->cek_login($email,$password) == 1){
        setcookie('email_temp', $email, time() + 5, "/");
        $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Password Salah!', 'danger');
        redirect('login');
        exit;
      }
    redirect('login');
  }

  public function index() { 

    if ($this->POST('daftar')) {


      if ($this->POST('jk') == "Perempuan") {
        $foto = 'foto/default-p.jpg';
      }else{
        $foto = 'foto/default-l.jpg'; 
      }
      $data = [
        'email' => $this->POST('email'),
        'password' => md5($this->POST('password2')),
        'role' => 2,
        'foto' => $foto
      ];

      if ($this->Login_m->insert($data)) {
          $id_customer = rand(1,9);
          for ($j=1; $j <= 7 ; $j++) {
            $id_customer .= rand(0,9);
          } 
          $data = [
            'id_customer' => $id_customer,
            'email' => $this->POST('email'), 
            'nama_customer' => $this->POST('nama'),
            'jk' => $this->POST('jk'),
            'tl' => $this->POST('tl'),
            'no_hp' => $this->POST('no_hp') 
          ];


          if ($this->Customer_m->insert($data)) { 

            $user_session = [
                'email' => $this->POST('email'), 
                'id_role' => 2 
              ];
              $this->session->set_userdata($user_session);
            $this->flashmsg('Selamat datang, proses pendaftaran anda berhasil.', 'success');
            redirect('customer');
            exit();
          }else{
            $this->Login_m->delete($this->POST('email')); 
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Gagal, Coba lagi!', 'warning');
            redirect('daftar');
            exit();
          }
          
      }else{
        $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Gagal, Coba lagi!', 'warning');
        redirect('daftar');
        exit();
      }
      

     
    } 
    $this->load->view('daftar');
  }


    public function cekemail(){ echo $this->Login_m->cekemail($this->input->post('email')); } 
    public function cekpasslama(){ echo $this->Login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->Login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->Login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }
}

?>
