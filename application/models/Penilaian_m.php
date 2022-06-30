<?php 
class Penilaian_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id';
    $this->data['table_name'] = 'penilaian_laptop';
  }


  public function get_extra($kd){

		$this->db->select('MAX(C1) AS max_c1,MAX(C2) AS max_c2,MAX(C3) AS max_c3,MAX(C4) AS max_c4,MAX(C5) AS max_c5  ');
		$this->db->where('kd_blt' , $kd); 
		return $this->db->get($this->data['table_name'])->row();
 		
	}
}

 ?>
