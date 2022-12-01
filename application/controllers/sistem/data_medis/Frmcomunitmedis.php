<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomunitmedis extends CI_Controller {
	
	 


	function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/Frmcomunitmedis_model');

    }

    public function index(){
    	 // $hari_ini = date("Y-m-d H:i:s");
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Poliklinik',
            'role'=>'admin'
             // 'maxjadwal'=> $this->Frmcomunitmedis_model->maxjadwal()
		);
        $this->template->load('template','sistem/data_medis/Frmcomunitmedis',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->Frmcomunitmedis_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'medunit_cd' => strtoupper($this->input->post('medunit_cd')),
				'medunit_nm' => strtoupper($this->input->post('medunit_nm')),
				'medicalunit_tp'=>'MEDICALUNIT_TP_1',
				'data_mapcd' => $this->input->post('data_mapcd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$insert = $this->Frmcomunitmedis_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				// 'medunit_cd' => $this->input->post('medunit_cd'),
				'medunit_nm' => strtoupper($this->input->post('medunit_nm')),
				'data_mapcd' => $this->input->post('data_mapcd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$this->Frmcomunitmedis_model->update(array('medunit_cd' => $this->input->post('medunit_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Frmcomunitmedis_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_list()//ok
	{
		echo $this->Frmcomunitmedis_model->ajax_list();
	}
	
}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */