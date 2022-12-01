<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frmcomdokter_model extends CI_Model {

	var $table = 'trx_dokter';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('dr_cd',$id);
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
		$this->db->where('dr_cd', $id);
		$this->db->delete($this->table);
	}



	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function ajax_list()//ok
	{
		$result = array();
		$result['total'] = $this->db->query("SELECT A.dr_cd,A.dr_nm,B.spesialis_nm,a.data_mapcd FROM trx_dokter A LEFT JOIN trx_spesialis B ON A.spesialis_cd=B.spesialis_cd ORDER BY A.dr_nm,B.spesialis_nm  ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT A.dr_cd,A.dr_nm,B.spesialis_nm,a.data_mapcd FROM trx_dokter A LEFT JOIN trx_spesialis B ON A.spesialis_cd=B.spesialis_cd ORDER BY A.dr_nm,B.spesialis_nm ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
				$row[] = array(
				'no'=>$no++,
				'dr_cd'=>$data['dr_cd'],
				'dr_nm'=>$data['dr_nm'],
				'spesialis_nm'=>$data['spesialis_nm'],
				'data_mapcd'=>$data['data_mapcd']   ,
                'aksi'=>'<div align="center">
                <a class="green" href="javascript:void(0)" title="Edit" onclick="edit_dokter('."'".$data['dr_cd']."'".')">
                <i class="ace-icon fa fa-pencil bigger-130"></i>                        </a>                              
                <a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_dokter('."'".$data['dr_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                </div>'         
				);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}

	public function carispesialis(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("select spesialis_cd,spesialis_nm from trx_spesialis where spesialis_nm like '%$q%' ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	public function cariparamedis(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    // $rs = $this->db->query("select medunit_cd, medunit_nm from trx_unit_medis where medunit_nm like '%$q%' ");
    $rs = $this->db->query("SELECT com_cd,code_nm FROM com_code WHERE code_group='PARAMEDIS_TP' and code_nm like '%$q%' ORDER BY com_cd ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

}
