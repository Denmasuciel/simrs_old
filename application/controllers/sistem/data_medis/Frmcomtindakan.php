<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomtindakan extends CI_Controller {

	 function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/Frmcomtindakan_model');
    }

    public function index(){
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Tindakan Medis',
            'role'=>'admin'
             // 'maxjadwal'=> $this->Frmcomtindakan_model->maxjadwal()
		);
        $this->template->load('template','sistem/data_medis/Frmcomtindakan',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->Frmcomtindakan_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				// 'treatment_cd' => '990',
				'treatment_cd' => $this->input->post('treatment_cd'),
				'treatment_nm' => $this->input->post('treatment_nm'),
				'treatment_tp' => $this->input->post('treatment_tp'),
				'standar_tp' => $this->input->post('standar_tp'),			
				'default_cd' => $this->input->post('default_cd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$insert = $this->Frmcomtindakan_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				// 'treatment_cd' => $this->input->post('treatment_cd'),
				'treatment_nm' => $this->input->post('treatment_nm'),
				'treatment_tp' => $this->input->post('treatment_tp'),
				'standar_tp' => $this->input->post('standar_tp'),
				'default_cd' => $this->input->post('default_cd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$this->Frmcomtindakan_model->update(array('treatment_cd' => $this->input->post('treatment_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Frmcomtindakan_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_list()//ok
	{
		echo $this->Frmcomtindakan_model->ajax_list();
	}
	
	public function carijenis()
		{
		 echo $this->Frmcomtindakan_model->carijenis();
		}

	public function cariklinik()
		{
		 echo $this->Frmcomtindakan_model->cariklinik();
		}
	
	public function caristandar()
		{
		 echo $this->Frmcomtindakan_model->caristandar();
		}


}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */