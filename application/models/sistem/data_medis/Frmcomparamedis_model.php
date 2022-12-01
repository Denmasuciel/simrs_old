<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frmcomparamedis_model extends CI_Model {

	var $table = 'trx_paramedis';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('paramedis_cd',$id);
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
		$this->db->where('paramedis_cd', $id);
		$this->db->delete($this->table);
	}



	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query("SELECT A.paramedis_cd,A.paramedis_nm FROM trx_paramedis A ORDER BY A.paramedis_nm ")->num_rows();
		$row = array();	
		$criteria = $this->db->query(" SELECT A.paramedis_cd,A.paramedis_nm FROM trx_paramedis A ORDER BY A.paramedis_nm");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
				$row[] = array(
				'no'=>$no++,
				'paramedis_cd'=>$data['paramedis_cd'],
				'paramedis_nm'=>$data['paramedis_nm'],
				'aksi'=>'<div align="center">
                <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_paramedis('."'".$data['paramedis_cd']."'".')">
                <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_paramedis('."'".$data['paramedis_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                </div>'         
				);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	
	

	public function MaxNoparamedis(){
		
		$kode = 'P';
		$text = "SELECT max(paramedis_cd) as no FROM trx_paramedis";
		$data = $this->Frmcomparamedis_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,1,4))+1;
				// $hasil = $kode.sprintf("%05s", $tmp);
				$hasil = $kode. $tmp;
			}
		}else{
			$hasil = $kode.'001';
		}
		return $hasil;
	}

}
