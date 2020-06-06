<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model
{

    public $table = 'pengeluaran';
    public $id = 'id_peng';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_peng', $q);
        $this->db->or_like('tgl_peng', $q);
        $this->db->or_like('bukti_peng', $q);
        $this->db->or_like('ket', $q);
        $this->db->or_like('total_peng', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_data_stok(){
        $query = $this->db->query("SELECT SUM(total_peng) as total , MONTH(tgl_peng) as bulan FROM pengeluaran group by MONTH(tgl_peng), YEAR(tgl_peng)");

        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_peng', $q);
        $this->db->or_like('tgl_peng', $q);
        $this->db->or_like('bukti_peng', $q);
        $this->db->or_like('ket', $q);
        $this->db->or_like('total_peng', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->_deleteImage($id);
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    private function _deleteImage($id){
        $row = $this->get_by_id($id);
        if ($row->bukti_peng != "default.jpg") {
            $filename = explode(".", $row->bukti_peng)[0];
		return array_map('unlink', glob(FCPATH."tampilan/pengeluaran/$filename.*"));
    } }

}

/* End of file Pengeluaran_model.php */
/* Location: ./application/models/Pengeluaran_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-29 15:40:11 */
/* http://harviacode.com */