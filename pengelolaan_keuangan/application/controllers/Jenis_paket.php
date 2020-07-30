<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_paket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_paket_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis_paket/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis_paket/index.html?q=' . urlencode($q);
        } else {
            $config['query_string_segment'] = 'start';
            $config['full_tag_open'] = '<div class="card-footer text-right"><nav class="d-inline-block"> <ul class="pagination mb-0"><div class="row">';
            // $config['next_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['next_link'] = '<div class="col-3"><i class="fas fa-chevron-right"></i></div>';
            // $config['next_tag_close'] = '</a></li>';
            $config['prev_link'] = '<div class="col-3"><i class="fas fa-chevron-left"></i></div>';
            // $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" href="#">';
            // $config['prev_tag_close'] = '</a></li>';
            $config['cur_tag_open'] = '<li class="page-item active "><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';
            // $config['num_tag_open'] = '<li class="page-item "><a class="page-link" href="#"></a>';
            // $config['num_tag_close'] = '</li>';
            $config['base_url'] = base_url() . 'jenis_paket/index.html';
            $config['first_url'] = base_url() . 'jenis_paket/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_paket_model->total_rows($q);
        $jenis_paket = $this->Jenis_paket_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_paket_data' => $jenis_paket,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/jenis_paket/jenis_paket_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Jenis_paket_model->get_by_id($id);
        if ($row) {
            $data = array(
		    'id_jp' => $row->id_jp,
            'nama_jp' => $row->nama_jp,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/jenis_paket/jenis_paket_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_paket'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_paket/create_action'),
	        'id_jp' => set_value('id_jp'),
            'nama_jp' => set_value('nama_jp'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/jenis_paket/jenis_paket_form",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jp' => $this->input->post('nama_jp',TRUE),
	    );

            $this->Jenis_paket_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
                    Create Record success</b></center></div>');
            redirect(site_url('admin/jenis_paket'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_paket_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_paket/update_action'),
                'id_jp' => set_value('id_jp', $row->id_jp),
                'nama_jp' => set_value('nama_jp', $row->nama_jp),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/jenis_paket/jenis_paket_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/jenis_paket'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jp', TRUE));
        } else {
            $data = array(
		'nama_jp' => $this->input->post('nama_jp',TRUE),
	    );

            $this->Jenis_paket_model->update($this->input->post('id_jp', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            redirect(site_url('jenis_paket'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_paket_model->get_by_id($id);

        if ($row) {
            $this->Jenis_paket_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('jenis_paket'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('jenis_paket'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jp', 'nama jp', 'trim|required');

	$this->form_validation->set_rules('id_jp', 'id_jp', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_paket.php */
/* Location: ./application/controllers/Jenis_paket.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-10 17:52:07 */
/* http://harviacode.com */