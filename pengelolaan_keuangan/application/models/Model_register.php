<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Model_register extends CI_Model{
    //put your code here
    public $table = 'admin';
    function __construct()
    {
        parent::__construct();
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        // return mysql_insert_id();
    }
    function changeActiveState($key)
    {
        $this->load->database();
        $data = array(
            'active' => 1
        );
        $this->db->where('md5(id_admin)', $key);
        $this->db->update($this->table, $data);
        
        return true;
    }
	
}