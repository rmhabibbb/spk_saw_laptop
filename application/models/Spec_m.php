<?php 
class Spec_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_spesifikasi';
    $this->data['table_name'] = 'spesifikasi';
  }
}

 ?>
