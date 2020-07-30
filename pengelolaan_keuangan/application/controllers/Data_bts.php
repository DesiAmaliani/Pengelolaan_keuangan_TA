<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_bts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_bts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_bts/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_bts/index.html?q=' . urlencode($q);
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
            $config['base_url'] = base_url() . 'data_bts/index.html';
            $config['first_url'] = base_url() . 'data_bts/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_bts_model->total_rows($q);
        $data_bts = $this->Data_bts_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_bts_data' => $data_bts,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/data_bts/data_bts_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Data_bts_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_bts' => $row->id_bts,
            'nama_bts' => $row->nama_bts,
            'alamat_bts' => $row->alamat_bts,
            'longitude' => $row->longitude,
            'latitude' => $row->latitude,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/data_bts/data_bts_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_bts'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_bts/create_action'),
            'id_bts' => set_value('id_bts'),
            'nama_bts' => set_value('nama_bts'),
            'alamat_bts' => set_value('alamat_bts'),
            'longitude' => set_value('longitude'),
            'latitude' => set_value('latitude'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/data_bts/data_bts_form",
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
		'nama_bts' => $this->input->post('nama_bts',TRUE),
		'alamat_bts' => $this->input->post('alamat_bts',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
	    );

            $this->Data_bts_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
                    Create Record success</b></center></div>');
            redirect(site_url('admin/data_bts'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_bts_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_bts/update_action'),
                'id_bts' => set_value('id_bts', $row->id_bts),
                'nama_bts' => set_value('nama_bts', $row->nama_bts),
                'alamat_bts' => set_value('alamat_bts', $row->alamat_bts),
                'longitude' => set_value('longitude', $row->longitude),
                'latitude' => set_value('latitude', $row->latitude),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/data_bts/data_bts_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/data_bts'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bts', TRUE));
        } else {
            $data = array(
                'nama_bts' => $this->input->post('nama_bts',TRUE),
                'alamat_bts' => $this->input->post('alamat_bts',TRUE),
                'longitude' => $this->input->post('longitude',TRUE),
                'latitude' => $this->input->post('latitude',TRUE),
	    );

            $this->Data_bts_model->update($this->input->post('id_bts', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            redirect(site_url('data_bts'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_bts_model->get_by_id($id);

        if ($row) {
            $this->Data_bts_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('data_bts'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('data_bts'));
        }
    }
    public function lokasi($id) 
    {
        $row = $this->Data_bts_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_bts' => $row->id_bts,
                'latitude' => $row->latitude,
                'longitude' => $row->longitude,
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
             );
                $this->load->view("admin/data_bts/lokasi", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_bts'));
        }
    }
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_bts', 'nama bts', 'trim|required');
	$this->form_validation->set_rules('alamat_bts', 'alamat bts', 'trim|required');
	$this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
	$this->form_validation->set_rules('latitude', 'latitude', 'trim|required');

	$this->form_validation->set_rules('id_bts', 'id_bts', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data_bts.php */
/* Location: ./application/controllers/Data_bts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-13 15:10:54 */
/* http://harviacode.com */