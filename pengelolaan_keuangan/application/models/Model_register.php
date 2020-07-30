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
    }
	
}