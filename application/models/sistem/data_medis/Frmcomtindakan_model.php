<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frmcomtindakan_model extends CI_Model {

	var $table = 'trx_tindakan';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('treatment_cd',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('treatment_cd', $id);
		$this->db->delete($this->table);
	}



	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query("SELECT A.treatment_cd,A.treatment_nm,B.code_nm as treatment_tp,C.code_nm as standar_tp,D.medunit_nm  as default_cd FROM trx_tindakan A LEFT JOIN com_code B ON A.treatment_tp=B.com_cd LEFT JOIN com_code C ON A.standar_tp=C.com_cd  LEFT JOIN trx_unit_medis D ON A.default_cd=D.medunit_cd  where a.active_st='1'")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT A.treatment_cd,A.treatment_nm,B.code_nm as treatment_tp,C.code_nm as standar_tp,D.medunit_nm  as default_cd FROM trx_tindakan A LEFT JOIN com_code B ON A.treatment_tp=B.com_cd LEFT JOIN com_code C ON A.standar_tp=C.com_cd LEFT JOIN trx_unit_medis D ON A.default_cd=D.medunit_cd 
			where a.active_st='1' ORDER BY A.treatment_cd ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'treatment_cd'=>$data['treatment_cd'],
							'treatment_nm'=>$data['treatment_nm'],
							'treatment_tp'=>$data['treatment_tp']   ,
							'standar_tp'=>$data['standar_tp']   ,
							'default_cd'=>$data['default_cd'],						
                            'aksi'=>'<div align="center">
                            <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_tindakan('."'".$data['treatment_cd']."'".')">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                            <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_tindakan('."'".$data['treatment_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                            </div>'         
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	

	public function carijenis(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("SELECT com_cd,code_nm FROM com_code WHERE code_group='TREATMENT_TP' and code_nm like '%$q%' ORDER BY com_cd ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	public function cariklinik(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("SELECT A.medunit_cd,A.medunit_nm,B.com_cd FROM trx_unit_medis A, com_code B WHERE A.medicalunit_tp=B.com_cd AND A.medicalunit_tp='MEDICALUNIT_TP_1' and medunit_nm like '%$q%' ORDER BY A.medunit_nm ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}


	public function caristandar(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    // $rs = $this->db->query("select medunit_cd, medunit_nm from trx_unit_medis where medunit_nm like '%$q%' ");
    $rs = $this->db->query("SELECT com_cd,code_nm FROM com_code WHERE code_group='TREATMENTSTD_TP' and code_nm like '%$q%' ORDER BY com_cd ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	 

}
