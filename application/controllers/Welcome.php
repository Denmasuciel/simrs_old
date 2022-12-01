<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct(){
		parent::__construct();
        if ($this->session->userdata('isLog') == '0') {
            redirect('login', 'refresh');
        }
		$this->load->model('M_menu');
	}

	public function guzzle_get($url,$uri){
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('GET',$uri);
		return $response->getBody()->getContents();
	}

	public function index()
	{
		$data=array(
			'data_table'=>'',
            'role'=>'admin'
		);

//		 $data=$this->M_menu->menu('1','','admin')->result();
//		 foreach ($data as $key) {
//		 	echo $key->menu_nm."<br/>";
//		 	$data1=$this->M_menu->menu('2',$key->menu_cd,'admin')->result();
//		 	foreach ($data1 as $key1) {
//		 		echo " - ".$key1->menu_nm."<br/>";
//		 	}
//		 }
//		 $cek=$this->M_menu->check_root('apo')->num_rows();
//		 echo $cek;
$data['data2'] = json_decode($this->guzzle_get('http://httpbin.org','json'));
$data['data3'] = json_decode($this->guzzle_get('http://httpbin.org','json'),true);
// $data['data3']=$datax['slideshow'];
		$this->template->load('template','table',$data);
	}
}
