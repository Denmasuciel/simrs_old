<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frmcomunitmedis_model extends CI_Model {

	var $table = 'trx_unit_medis';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('medunit_cd',$id);
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
		$this->db->where('medunit_cd', $id);
		$this->db->delete($this->table);
	}



	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query(" SELECT A.medunit_cd,A.medunit_nm,B.com_cd,A.data_mapcd FROM trx_unit_medis A, com_code B WHERE A.medicalunit_tp=B.com_cd AND A.medicalunit_tp='MEDICALUNIT_TP_1'")->num_rows();
		$row = array();	
		$criteria = $this->db->query(" SELECT A.medunit_cd,A.medunit_nm,B.com_cd,A.data_mapcd FROM trx_unit_medis A, com_code B WHERE A.medicalunit_tp=B.com_cd AND A.medicalunit_tp='MEDICALUNIT_TP_1' ORDER BY A.medunit_nm");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
				$row[] = array(
				'no'=>$no++,
				'medunit_cd'=>$data['medunit_cd'],
				'medunit_nm'=>$data['medunit_nm'],
				'data_mapcd'=>$data['data_mapcd']   ,
                'aksi'=>'<div align="center">
                <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_poliklinik('."'".$data['medunit_cd']."'".')">
                <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_poliklinik('."'".$data['medunit_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                </div>'         
				);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
}
