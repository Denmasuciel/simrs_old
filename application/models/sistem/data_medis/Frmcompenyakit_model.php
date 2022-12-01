<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frmcompenyakit_model extends CI_Model {

	var $table = 'trx_icd';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('icd_cd',$id);
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
		$this->db->where('icd_cd', $id);
		$this->db->delete($this->table);
	}



	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function ajax_list()//ok
	{
		$result = array();
		// $result['total'] = $this->db->query("SELECT top 1000  A.icd_cd,A.icd_nm,B.code_nm FROM trx_icd A, com_code B WHERE A.icd_tp=B.com_cd AND B.code_group='ICD_TP' ORDER BY A.icd_cd ")->num_rows();
		$row = array();	
		$criteria = $this->db->query(" SELECT top 1000 A.icd_cd,A.icd_nm,B.code_nm FROM trx_icd A, com_code B WHERE A.icd_tp=B.com_cd AND B.code_group='ICD_TP' ORDER BY A.icd_cd ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'icd_cd'=>$data['icd_cd'],
							'icd_nm'=>$data['icd_nm'],
							'code_nm'=>$data['code_nm'],						
                            'aksi'=>'<div align="center">
                            <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_penyakit('."'".$data['icd_cd']."'".')">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                            <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_penyakit('."'".$data['icd_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                            </div>'         
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	

	

	public function caristandar(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("SELECT com_cd,code_nm FROM com_code WHERE code_group='ICD_TP' and code_nm like '%$q%' ORDER BY com_cd ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	public function ajax_list2()
	{	

		$rows = isset($_POST['start']) ? intval($_POST['start']) : 1;
		$page = isset($_POST['length']) ? intval($_POST['length']) : 10;
		$offset = ($page-1) * $rows;
		
		$this->db->select('A.icd_cd,A.icd_nm,B.code_nm');
	    $this->db->from('trx_icd A, com_code B');
	    $this->db->where('A.icd_tp=B.com_cd ');
	    $this->db->limit($rows,$offset);
	    $query = $this->db->get();

		// SELECT top 1000 A.icd_cd,A.icd_nm,B.code_nm FROM trx_icd A, com_code B WHERE A.icd_tp=B.com_cd AND B.code_group='ICD_TP' ORDER BY A.icd_cd

		
		$result = array();
		$result['total'] = $query;
		$row = array();	
		$criteria = $query;
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'icd_cd'=>$data['icd_cd'],
							'icd_nm'=>$data['icd_nm'],
							'code_nm'=>$data['code_nm'],						
                            'aksi'=>'<div align="center">
                            <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_penyakit('."'".$data['icd_cd']."'".')">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                            <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_penyakit('."'".$data['icd_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                            </div>'         
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}


	

	 

}

