<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomnation extends CI_Controller {

	 function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_umum/nation_model');
    }

    public function index(){
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Data Negara',
            'role'=>'admin',
            'maxnonation'=> $this->nation_model->maxnonation()
		);
        $this->template->load('template','sistem/data_umum/nation',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->nation_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'nation_cd' => $this->input->post('nation_cd'),
				'nation_nm' => $this->input->post('nation_nm'),
				'capital' => $this->input->post('capital')
				);
		$insert = $this->nation_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
			'nation_nm'=>$this->input->post('nation_nm'),
			'capital'=>$this->input->post('capital')
				);
		$this->nation_model->update(array('nation_cd' => $this->input->post('nation_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->nation_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM com_nation ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM com_nation  ORDER BY nation_cd ASC");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'nation_cd'=>$data['nation_cd'],
							'nation_nm'=>$data['nation_nm'],
							'capital'=>$data['capital']	,
							'aksi'=>'<div align="center">
							<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_nation('."'".$data['nation_cd']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						</a>							  
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_nation('."'".$data['nation_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
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