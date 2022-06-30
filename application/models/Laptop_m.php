<?php 
class Laptop_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'kd_laptop';
    $this->data['table_name'] = 'laptop';
  }


  public function get_star($kd){

    $this->db->select('(rate1+rate2+rate3+rate4+rate5+rate6+rate7)/7 as star');
    $this->db->where('kd_laptop' , $kd);
    return $this->db->get('laptop')->row()->star;
    
  }

  public function get_rekomendasi(){

    $query = $this->db->query('select kd_laptop, (rate1+rate2+rate3+rate4+rate5+rate6+rate7)/7 as star from laptop order by star desc'); 
    return $query->result();
    
  }


  public function get_extra(){

		$this->db->select('MAX(kualitas_bahan) AS c1,MAX(harga) AS c2,MAX(waktu_pengerjaan) AS c3,MAX(komunikasi) AS c4   ');
		return $this->db->get('penilaian')->row();
 		
	}

  public function get_sum($id){

    $this->db->select('id_vendor, avg(kualitas_bahan) AS c1,avg(harga) AS c2,avg(waktu_pengerjaan) AS c3,avg(komunikasi) AS c4   ');
    $this->db->where('id_vendor' , $id);
    return $this->db->get('penilaian')->row();
    
  }

  public function saw(){
    $nilai_awal = array(); 
      $list_laptop = $this->Laptop_m->get();
      $list_kriteria = $this->Kriteria_m->get();


    $c1_temp = array(); 
    $c2_temp = array(); 
    $c3_temp = array(); 
    $c4_temp = array(); 
    $c5_temp = array(); 
    $c6_temp = array(); 
    $c7_temp = array(); 
      foreach ($list_laptop as $l) {

    	$nilai = array(); 
      	foreach ($list_kriteria as $k) {

      		$id_bobot = $this->Penilaian_m->get_row(['kd_laptop' => $l->kd_laptop, 'id_kriteria' => $k->id_kriteria])->id_bobot;
      		array_push($nilai, $this->Bobot_m->get_row(['id_bobot' => $id_bobot])->nilai);
      	}
      	$data = [
      		'kd_laptop' => $l->kd_laptop,
      		'nilai' => $nilai
      	];
      	array_push($nilai_awal, $data);
      }

      foreach ($nilai_awal as $v) {
      	array_push($c1_temp,  $v['nilai'][0]);
      	array_push($c2_temp,  $v['nilai'][1]);
      	array_push($c3_temp,  $v['nilai'][2]);
      	array_push($c4_temp,  $v['nilai'][3]);
      	array_push($c5_temp,  $v['nilai'][4]);
      	array_push($c6_temp,  $v['nilai'][5]);
      	array_push($c7_temp,  $v['nilai'][6]);
      }

      $R = array();
      foreach ($nilai_awal as $v) { 
      	$data = [
      		'kd_laptop' => $v['kd_laptop'],
      		'C1' => number_format($v['nilai'][0]/max($c1_temp),2),
      		'C2' => number_format($v['nilai'][1]/max($c2_temp),2),
      		'C3' => number_format($v['nilai'][2]/max($c3_temp),2),
      		'C4' => number_format($v['nilai'][3]/max($c4_temp),2),
      		'C5' => number_format($v['nilai'][4]/max($c5_temp),1),
      		'C6' => number_format($v['nilai'][5]/max($c6_temp),1),
      		'C7' => min($c7_temp)/$v['nilai'][6]
      	];

      	array_push($R, $data);
      }

      $bobot = array();

      foreach ($list_kriteria as $k) {
      	array_push($bobot, ($k->bobot_vektor/100));
      }


      $V = array();
      foreach ($R as $v) { 

      	$data = [
      		'nilai_akhir' => number_format(($bobot[0]*$v['C1']) + ($bobot[1]*$v['C2']) + ($bobot[2]*$v['C3']) + ($bobot[3]*$v['C4']) + ($bobot[4]*$v['C5']) + ($bobot[5]*$v['C6']) + ($bobot[6]*$v['C7']), 4) , 
      		'kd_laptop' => $v['kd_laptop'] 
      	];

      	array_push($V, $data);
      }
      $this->data['hasil'] = $V; 
      rsort($V); 
      $this->data['nilai_awal'] = $nilai_awal; 
      $this->data['matrik_r'] = $R;
      $this->data['hasil_akhir'] = $V; 
      return $this->data;
  }
}

 ?>
