<?php 
class Bobot_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_bobot';
    $this->data['table_name'] = 'bobot_kriteria';
  }
}

 ?>
