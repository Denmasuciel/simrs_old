<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomparamedis extends CI_Controller {
	
	 


	function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/Frmcomparamedis_model');

    }

    public function index(){
    	 // $hari_ini = date("Y-m-d H:i:s");
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Data Perawat',
            'role'=>'admin',
             'maxnoparamedis'=> $this->Frmcomparamedis_model->MaxNoparamedis()
		);
        $this->template->load('template','sistem/data_medis/Frmcomparamedis',$data);
    }


		
	public function ajax_edit($id)
	{
		$data = $this->Frmcomparamedis_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'paramedis_cd' => strtoupper($this->input->post('paramedis_cd')),
				'paramedis_nm' => $this->input->post('paramedis_nm'),
				'paramedis_tp' => 'PARAMEDIS_TP_04',
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$insert = $this->Frmcomparamedis_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'paramedis_nm' => strtoupper($this->input->post('paramedis_nm')),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$this->Frmcomparamedis_model->update(array('paramedis_cd' => $this->input->post('paramedis_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Frmcomparamedis_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_list()//ok
	{
		echo $this->Frmcomparamedis_model->ajax_list();
	}
	
}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */