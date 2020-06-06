<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class M_grafik extends CI_Model{
    function get_data_stok(){
        $query = $this->db->query("SELECT SUM(total_peng) as total , MONTH(tgl_peng) as bulan FROM pengeluaran group by MONTH(tgl_peng)");

        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

}