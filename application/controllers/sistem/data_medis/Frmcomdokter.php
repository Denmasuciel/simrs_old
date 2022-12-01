<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomdokter extends CI_Controller { 


	function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/frmcomdokter_model');

    }

    public function index(){
    	 // $hari_ini = date("Y-m-d H:i:s");
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Data Dokter',
            'role'=>'admin'
             // 'maxjadwal'=> $this->frmcomdokter_model->maxjadwal()
		);
        $this->template->load('template','sistem/data_medis/frmcomdokter',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->frmcomdokter_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'dr_cd' => strtoupper($this->input->post('dr_cd')),
				'dr_nm' => $this->input->post('dr_nm'),
				'spesialis_cd' => strtoupper($this->input->post('spesialis_cd')),
				'paramedis_tp' => $this->input->post('paramedis_tp'),
				'data_mapcd' => $this->input->post('data_mapcd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$insert = $this->frmcomdokter_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				// 'dr_cd' => strtoupper($this->input->post('dr_cd')),
				'dr_nm' => $this->input->post('dr_nm'),
				'spesialis_cd' => strtoupper($this->input->post('spesialis_cd')),
				'paramedis_tp' => $this->input->post('paramedis_tp'),
				'data_mapcd' => $this->input->post('data_mapcd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$this->frmcomdokter_model->update(array('dr_cd' => $this->input->post('dr_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->frmcomdokter_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



	public function ajax_list()//ok
 	{
 		echo $this->frmcomdokter_model->ajax_list();
 	}

 	public function carispesialis()
		{
		 echo $this->frmcomdokter_model->carispesialis();
		}

	public function cariparamedis()
		{
		 echo $this->frmcomdokter_model->cariparamedis();
		}

}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */