<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frmcomjadwal extends CI_Controller {

	 function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('sistem/data_medis/frmcomjadwal_model');
    }

    public function index(){
        $data=array(
//			'menu_1'=>$this->M_menu->menu()->result(),
			'data_table'=>'Jadwal Dokter',
            'role'=>'admin',
             'maxjadwal'=> $this->frmcomjadwal_model->maxjadwal()
		);
        $this->template->load('template','sistem/data_medis/frmcomjadwal',$data);
    }

	
	
		
	public function ajax_edit($id)
	{
		$data = $this->frmcomjadwal_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				// 'seq_no' => '990',
				'dr_cd' => $this->input->post('dr_cd'),
				'medunit_cd' => $this->input->post('medunit_cd'),
				'day_tp' => $this->input->post('day_tp'),
				'time_start' =>date('Y-m-d') .' '.  $this->input->post('time_start'),
				'time_end' => date('Y-m-d') .' '.$this->input->post('time_end'),
				'note' => $this->input->post('note')
				);
		$insert = $this->frmcomjadwal_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				// 'seq_no' => $this->input->post('seq_no'),
				'dr_cd' => $this->input->post('dr_cd'),
				'medunit_cd' => $this->input->post('medunit_cd'),
				'day_tp' => $this->input->post('day_tp'),
				'time_start' =>date('Y-m-d') .' '.  $this->input->post('time_start'),
				'time_end' => date('Y-m-d') .' '. $this->input->post('time_end'),
				'note' => $this->input->post('note')
				);
		$this->frmcomjadwal_model->update(array('seq_no' => $this->input->post('seq_no')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->frmcomjadwal_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query("SELECT A.seq_no,C.medunit_nm,D.code_nm AS day_nm,CONVERT(VARCHAR(10), A.time_start, 108) + ' - ' + CONVERT(VARCHAR(10), A.time_end, 108) AS waktu,B.dr_nm, a.note FROM trx_jadwal A JOIN trx_dokter B ON A.dr_cd=B.dr_cd LEFT JOIN trx_unit_medis C ON A.medunit_cd=C.medunit_cd LEFT JOIN com_code D ON A.day_tp=D.com_cd ORDER BY C.medunit_nm,D.com_cd,A.time_start,B.dr_nm ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT A.seq_no,C.medunit_nm,D.code_nm AS day_nm,CONVERT(VARCHAR(10), A.time_start, 108) + ' - ' + CONVERT(VARCHAR(10), A.time_end, 108) AS waktu,B.dr_nm ,a.note FROM trx_jadwal A JOIN trx_dokter B ON A.dr_cd=B.dr_cd LEFT JOIN trx_unit_medis C ON A.medunit_cd=C.medunit_cd LEFT JOIN com_code D ON A.day_tp=D.com_cd ORDER BY C.medunit_nm,D.com_cd,A.time_start,B.dr_nm");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'seq_no'=>$data['seq_no'],
							'medunit_nm'=>$data['medunit_nm'],
							'day_nm'=>$data['day_nm'],
							'dr_nm'=>$data['dr_nm'],
							'waktu'=>$data['waktu'],
							'note'=>$data['note']   ,
                            'aksi'=>'<div align="center">
                            <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_jadwal('."'".$data['seq_no']."'".')">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                            <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_jadwal('."'".$data['seq_no']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                            </div>'         
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	
	public function caridokter()
		{
		 echo $this->frmcomjadwal_model->caridokter();
		}

	public function cariklinik()
		{
		 echo $this->frmcomjadwal_model->cariklinik();
		}
	
	public function carihari()
		{
		 echo $this->frmcomjadwal_model->carihari();
		}


 


}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */