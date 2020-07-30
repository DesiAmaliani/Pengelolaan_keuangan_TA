<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alat_dibts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Alat_dibts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'alat_dibts/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'alat_dibts/index.html?q=' . urlencode($q);
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
            $config['base_url'] = base_url() . 'alat_dibts/index.html';
            $config['first_url'] = base_url() . 'alat_dibts/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Alat_dibts_model->total_rows($q);
        $alat_dibts = $this->Alat_dibts_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'alat_dibts_data' => $alat_dibts,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/alat_dibts/alat_dibts_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Alat_dibts_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_alat' => $row->id_alat,
            'id_bts' => $row->id_bts,
            'nama_alat' => $row->nama_alat,
            'ip_alat' => $row->ip_alat,
            'ssid' => $row->ssid,
            'frequensi' => $row->frequensi,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/alat_dibts/alat_dibts_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('alat_dibts'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('alat_dibts/create_action'),
            'id_alat' => set_value('id_alat'),
            'id_bts' => set_value('id_bts'),
            'nama_alat' => set_value('nama_alat'),
            'ip_alat' => set_value('ip_alat'),
            'ssid' => set_value('ssid'),
            'frequensi' => set_value('frequensi'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/alat_dibts/alat_dibts_form",
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
            'id_bts' => $this->input->post('id_bts',TRUE),
            'nama_alat' => $this->input->post('nama_alat',TRUE),
            'ip_alat' => $this->input->post('ip_alat',TRUE),
            'ssid' => $this->input->post('ssid',TRUE),
            'frequensi' => $this->input->post('frequensi',TRUE),
            );

            $this->Alat_dibts_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Create Record success</b></center></div>');
            redirect(site_url('alat_dibts'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Alat_dibts_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('alat_dibts/update_action'),
                'id_alat' => set_value('id_alat', $row->id_alat),
                'id_bts' => set_value('id_bts', $row->id_bts),
                'nama_alat' => set_value('nama_alat', $row->nama_alat),
                'ip_alat' => set_value('ip_alat', $row->ip_alat),
                'ssid' => set_value('ssid', $row->ssid),
                'frequensi' => set_value('frequensi', $row->frequensi),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/alat_dibts/alat_dibts_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/alat_dibts'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_alat', TRUE));
        } else {
            $data = array(
            'id_bts' => $this->input->post('id_bts',TRUE),
            'nama_alat' => $this->input->post('nama_alat',TRUE),
            'ip_alat' => $this->input->post('ip_alat',TRUE),
            'ssid' => $this->input->post('ssid',TRUE),
            'frequensi' => $this->input->post('frequensi',TRUE),
            );

            $this->Alat_dibts_model->update($this->input->post('id_alat', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            redirect(site_url('alat_dibts'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Alat_dibts_model->get_by_id($id);

        if ($row) {
            $this->Alat_dibts_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('alat_dibts'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('alat_dibts'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_bts', 'id bts', 'trim|required');
	$this->form_validation->set_rules('nama_alat', 'nama alat', 'trim|required');
	$this->form_validation->set_rules('ip_alat', 'ip alat', 'trim|required');
	$this->form_validation->set_rules('ssid', 'ssid', 'trim|required');
	$this->form_validation->set_rules('frequensi', 'frequensi', 'trim|required');

	$this->form_validation->set_rules('id_alat', 'id_alat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Alat_dibts.php */
/* Location: ./application/controllers/Alat_dibts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-14 20:08:07 */
/* http://harviacode.com */