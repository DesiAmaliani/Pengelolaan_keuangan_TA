<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_ip_client extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Info_ip_client_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'info_ip_client/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'info_ip_client/index.html?q=' . urlencode($q);
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
            $config['base_url'] = base_url() . 'info_ip_client/index.html';
            $config['first_url'] = base_url() . 'info_ip_client/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Info_ip_client_model->total_rows($q);
        $info_ip_client = $this->Info_ip_client_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'info_ip_client_data' => $info_ip_client,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/info_ip_client/info_ip_client_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Info_ip_client_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_infoip' => $row->id_infoip,
            'id_client' => $row->id_client,
            'user_pppoe' => $row->user_pppoe,
            'pass_ppoe' => $row->pass_ppoe,
            'ip_radio' => $row->ip_radio,
            'nama_radio' => $row->nama_radio,
            'ip_router' => $row->ip_router,
            'user_paas_router' => $row->user_paas_router,
            'merk_router' => $row->merk_router,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/info_ip_client/info_ip_client_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('info_ip_client'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('info_ip_client/create_action'),
            'id_infoip' => set_value('id_infoip'),
            'id_client' => set_value('id_client'),
            'user_pppoe' => set_value('user_pppoe'),
            'pass_ppoe' => set_value('pass_ppoe'),
            'ip_radio' => set_value('ip_radio'),
            'nama_radio' => set_value('nama_radio'),
            'ip_router' => set_value('ip_router'),
            'user_paas_router' => set_value('user_paas_router'),
            'merk_router' => set_value('merk_router'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/info_ip_client/info_ip_client_form",
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
            'id_client' => $this->input->post('id_client',TRUE),
            'user_pppoe' => $this->input->post('user_pppoe',TRUE),
            'pass_ppoe' => $this->input->post('pass_ppoe',TRUE),
            'ip_radio' => $this->input->post('ip_radio',TRUE),
            'nama_radio' => $this->input->post('nama_radio',TRUE),
            'ip_router' => $this->input->post('ip_router',TRUE),
            'user_paas_router' => $this->input->post('user_paas_router',TRUE),
            'merk_router' => $this->input->post('merk_router',TRUE),
            );

            $this->Info_ip_client_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
                    Create Record success</b></center></div>');
            redirect(site_url('admin/info_ip_client'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Info_ip_client_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('info_ip_client/update_action'),
                'id_infoip' => set_value('id_infoip', $row->id_infoip),
                'id_client' => set_value('id_client', $row->id_client),
                'user_pppoe' => set_value('user_pppoe', $row->user_pppoe),
                'pass_ppoe' => set_value('pass_ppoe', $row->pass_ppoe),
                'ip_radio' => set_value('ip_radio', $row->ip_radio),
                'nama_radio' => set_value('nama_radio', $row->nama_radio),
                'ip_router' => set_value('ip_router', $row->ip_router),
                'user_paas_router' => set_value('user_paas_router', $row->user_paas_router),
                'merk_router' => set_value('merk_router', $row->merk_router),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/info_ip_client/info_ip_client_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/info_ip_client'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_infoip', TRUE));
        } else {
            $data = array(
                'id_client' => $this->input->post('id_client',TRUE),
                'user_pppoe' => $this->input->post('user_pppoe',TRUE),
                'pass_ppoe' => $this->input->post('pass_ppoe',TRUE),
                'ip_radio' => $this->input->post('ip_radio',TRUE),
                'nama_radio' => $this->input->post('nama_radio',TRUE),
                'ip_router' => $this->input->post('ip_router',TRUE),
                'user_paas_router' => $this->input->post('user_paas_router',TRUE),
                'merk_router' => $this->input->post('merk_router',TRUE),
                );

            $this->Info_ip_client_model->update($this->input->post('id_infoip', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            redirect(site_url('info_ip_client'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Info_ip_client_model->get_by_id($id);

        if ($row) {
            $this->Info_ip_client_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('info_ip_client'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('info_ip_client'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_client', 'id client', 'trim|required');
	$this->form_validation->set_rules('user_pppoe', 'user pppoe', 'trim|required');
	$this->form_validation->set_rules('pass_ppoe', 'pass ppoe', 'trim|required');
	$this->form_validation->set_rules('ip_radio', 'ip radio', 'trim|required');
	$this->form_validation->set_rules('nama_radio', 'nama radio', 'trim|required');
	$this->form_validation->set_rules('ip_router', 'ip router', 'trim|required');
	$this->form_validation->set_rules('user_paas_router', 'user paas router', 'trim|required');
	$this->form_validation->set_rules('merk_router', 'merk router', 'trim|required');

	$this->form_validation->set_rules('id_infoip', 'id_infoip', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "info_ip_client.xls";
        $judul = "info_ip_client";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Client");
        xlsWriteLabel($tablehead, $kolomhead++, "Username Pppoe");
        xlsWriteLabel($tablehead, $kolomhead++, "Password Ppoe");
        xlsWriteLabel($tablehead, $kolomhead++, "IP Radio");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Radio");
        xlsWriteLabel($tablehead, $kolomhead++, "IP Router");
        xlsWriteLabel($tablehead, $kolomhead++, "Username / Password Router");
        xlsWriteLabel($tablehead, $kolomhead++, "Merk Router");

	foreach ($this->Info_ip_client_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
            xlsWriteLabel($tablebody, $kolombody++, $data->user_pppoe);
            xlsWriteLabel($tablebody, $kolombody++, $data->pass_ppoe);
            xlsWriteLabel($tablebody, $kolombody++, $data->ip_radio);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_radio);
            xlsWriteLabel($tablebody, $kolombody++, $data->ip_router);
            xlsWriteLabel($tablebody, $kolombody++, $data->user_paas_router);
            xlsWriteLabel($tablebody, $kolombody++, $data->merk_router);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Info_ip_client.php */
/* Location: ./application/controllers/Info_ip_client.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-17 06:19:01 */
/* http://harviacode.com */