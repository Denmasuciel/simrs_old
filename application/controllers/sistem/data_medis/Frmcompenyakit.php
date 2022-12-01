<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcompenyakit extends CI_Controller {

	 function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/frmcompenyakit_model');
    }

    public function index(){
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Data Penyakit',
            'role'=>'admin'
             // 'maxjadwal'=> $this->frmcompenyakit_model->maxjadwal()
		);
        $this->template->load('template','sistem/data_medis/Frmcompenyakit',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->frmcompenyakit_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				// 'icd_cd' => '990',
				'icd_cd' => $this->input->post('icd_cd'),
				'icd_nm' => $this->input->post('icd_nm'),
				'icd_tp' => $this->input->post('icd_tp'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$insert = $this->frmcompenyakit_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				// 'icd_cd' => $this->input->post('icd_cd'),
				'icd_nm' => $this->input->post('icd_nm'),
				'icd_tp' => $this->input->post('icd_tp'),
				'modi_datetime'=> $this->config->item('hari_ini')
				);
		$this->frmcompenyakit_model->update(array('icd_cd' => $this->input->post('icd_cd')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->frmcompenyakit_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list()//ok
	{
		echo $this->frmcompenyakit_model->ajax_list();
	}
	
	public function tes(){
		$draw=$_REQUEST['draw'];
		$length=$_REQUEST['length'];
		$start=$_REQUEST['start'];
		$search=$_REQUEST['search']["value"];
		$total=$this->db->count_all_results("trx_icd");
		$output=array();
		$output['draw']=$draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();
		if($search!=""){
		$this->db->like("icd_nm",$search);
		}$this->db->limit($length,$start);
		$this->db->order_by('icd_cd','DESC');
		$query=$this->db->get('trx_icd');
		if($search!=""){
		$this->db->like("icd",$search);
		$jum=$this->db->get('trx_icd');
		$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}
		$nomor_urut=$start+1;
		foreach ($query->result_array() as $desa) {
			$output['aadata'][]=array($nomor_urut,$desa['icd_cd']);
		$nomor_urut++;
		}
		echo json_encode($output);

	}
	
	public function caristandar()
		{
		 echo $this->frmcompenyakit_model->caristandar();
		}




}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */