<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class FrmTrxPasien_model extends CI_Model {

    var $table = 'trx_pasien';
    var $id = 'pasie_cd';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where($this->id,$id);
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
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function manualQuery($q)
    {
        return $this->db->query($q);
    }
    
    public function get_data(){
        $this->db->limit(100);
        $this->db->order_by('pasien_cd','DESC');
        return $this->db->get($this->table);
    }

}