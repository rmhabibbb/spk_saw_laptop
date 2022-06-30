<?php
$data =[
  'title' => $title,
  'index' => $index
];
$this->load->view('customer/template/header',$data);
$this->load->view('customer/template/navbar');
$this->load->view('customer/template/sidebar',$data);
$this->load->view($content);
$this->load->view('customer/template/footer');
 ?>
