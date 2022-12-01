<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frmcomjadwal_model extends CI_Model {

	var $table = 'trx_jadwal';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('seq_no',$id);
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
		$this->db->where('seq_no', $id);
		$this->db->delete($this->table);
	}



	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function Maxjadwal(){
		$text = "SELECT max(seq_no) as no FROM trx_jadwal";
		$data = $this->db->query($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$hasil = $no + 1;
			}
		}else{
			$hasil = 1;
		}
		return $hasil;
	}

	public function caridokter(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("select dr_cd,dr_nm from trx_dokter where dr_nm like '%$q%' ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	public function cariklinik(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("select medunit_cd, medunit_nm from trx_unit_medis where medunit_nm like '%$q%' ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	public function carihari(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    // $rs = $this->db->query("select medunit_cd, medunit_nm from trx_unit_medis where medunit_nm like '%$q%' ");
    $rs = $this->db->query("SELECT com_cd,code_nm FROM com_code WHERE code_group='DAY_TP' and code_nm like '%$q%' ORDER BY com_cd ");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	 
    
}
