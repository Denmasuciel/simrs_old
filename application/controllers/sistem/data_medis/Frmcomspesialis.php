<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomspesialis extends CI_Controller {
	
	 


	function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/frmcomspesialis_model');

    }

    public function index(){
    	 // $hari_ini = date("Y-m-d H:i:s");
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Spesialis',
            'role'=>'admin'
             // 'maxjadwal'=> $this->frmcomspesialis_model->maxjadwal()
		);
        $this->template->load('template','sistem/data_medis/frmcomspesialis',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->frmcomspesialis_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'spesialis_cd' => strtoupper($this->input->post('spesialis_cd')),
				'spesialis_nm' => strtoupper($this->input->post('spesialis_nm')),
				'data_mapcd' => $this->input->post('data_mapcd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$insert = $this->frmcomspesialis_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				// 'spesialis_cd' => $this->input->post('spesialis_cd'),
				'spesialis_nm' => strtoupper($this->input->post('spesialis_nm')),
				'data_mapcd' => $this->input->post('data_mapcd'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$this->frmcomspesialis_model->update(array('spesialis_cd' => $this->input->post('spesialis_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->frmcomspesialis_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query("SELECT A.spesialis_cd,A.spesialis_nm,a.data_mapcd FROM trx_spesialis A ORDER BY A.spesialis_nm ")->num_rows();
		$row = array();	
		$criteria = $this->db->query(" SELECT A.spesialis_cd,A.spesialis_nm,a.data_mapcd FROM trx_spesialis A ORDER BY A.spesialis_nm");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
				$row[] = array(
				'no'=>$no++,
				'spesialis_cd'=>$data['spesialis_cd'],
				'spesialis_nm'=>$data['spesialis_nm'],
				'data_mapcd'=>$data['data_mapcd']   ,
                'aksi'=>'<div align="center">
                <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_spesialis('."'".$data['spesialis_cd']."'".')">
                <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_spesialis('."'".$data['spesialis_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                </div>'         
				);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	
}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */