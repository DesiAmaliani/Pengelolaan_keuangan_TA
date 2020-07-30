<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Paket_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'paket/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'paket/index.html?q=' . urlencode($q);
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
            $config['full_tag_close'] = '</div></ul></nav></div>';
            $config['base_url'] = base_url() . 'paket/index.html';
            $config['first_url'] = base_url() . 'paket/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Paket_model->total_rows($q);
        $paket = $this->Paket_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'paket_data' => $paket,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/paket/paket_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Paket_model->get_by_id($id);
        if ($row) {
            $paket= $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp");
            foreach ($paket->result() as $jp) {
                $id_jp=$jp->nama_jp;
            }
            $data = array(
            'id_paket' => $row->id_paket,
            'id_jp' => $id_jp,
            'bandwith' => $row->bandwith,
            'harga' => $row->harga,
            'kap_peng' => $row->kap_peng,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/paket/paket_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('paket'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('paket/create_action'),
            'id_paket' => set_value('id_paket'),
            'id_jp' => set_value('id_jp'),
            'bandwith' => set_value('bandwith'),
            'harga' => set_value('harga'),
            'kap_peng' => set_value('kap_peng'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/paket/paket_form",
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
                'id_jp' => $this->input->post('id_jp',TRUE),
                'bandwith' => $this->input->post('bandwith',TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'kap_peng' => $this->input->post('kap_peng',TRUE),
	    );

            $this->Paket_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
                    Create Record success</b></center></div>');
                    redirect(site_url('admin/paket'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Paket_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('paket/update_action'),
                'id_paket' => set_value('id_paket', $row->id_paket),
                'id_jp' => set_value('id_jp', $row->id_jp),
                'bandwith' => set_value('bandwith', $row->bandwith),
                'harga' => set_value('harga', $row->harga),
                'kap_peng' => set_value('kap_peng', $row->kap_peng),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/paket/paket_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/paket'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_paket', TRUE));
        } else {
            $data = array(
                'id_jp' => $this->input->post('id_jp',TRUE),
                'bandwith' => $this->input->post('bandwith',TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'kap_peng' => $this->input->post('kap_peng',TRUE),
	    );

            $this->Paket_model->update($this->input->post('id_paket', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            // $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/paket'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Paket_model->get_by_id($id);

        if ($row) {
            $this->Paket_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('admin/paket'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/paket'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_jp', 'id_jp', 'trim|required');
	$this->form_validation->set_rules('bandwith', 'bandwith', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('kap_peng', 'kap_peng', 'trim|required');

	$this->form_validation->set_rules('id_paket', 'id_paket', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Paket.php */
/* Location: ./application/controllers/Paket.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-31 17:20:30 */
/* http://harviacode.com */