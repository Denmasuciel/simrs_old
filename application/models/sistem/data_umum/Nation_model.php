<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Nation_model extends CI_Model {

	var $table = 'com_nation';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('nation_cd',$id);
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
		$this->db->where('nation_cd', $id);
		$this->db->delete($this->table);
	}

public  function rp($angka){
		$angka = number_format($angka);	
		$angka = str_replace(',', '.', $angka);
		$angka ="Rp "."$angka".",00";	
		return $angka;
		}

		function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function MaxNonation(){
		$text = "SELECT max(nation_cd) as no FROM com_nation";
		$data = $this->nation_model->manualQuery($text);
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
}
