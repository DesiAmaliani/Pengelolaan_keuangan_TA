<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tagihan_model');
        $this->load->model('Paket_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembayaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembayaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembayaran/index.html';
            $config['first_url'] = base_url() . 'pembayaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tagihan_model->total_rows($q);
        $pembayaran = $this->Tagihan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/tagihan/tagihan_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array(),
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }
    
    public function create($id) 
    {
        $row = $this->Paket_model->get_by_id($id);
        $data = array(
            'id'=> $id,
            'button' => 'Create',
            'action' => site_url('tagihan/create_action/'.$id),
            'id_pem' => set_value('id_pem'),
            'id_client' => set_value('id_client'),
            'total_bayar' => set_value('total_bayar'),
            'id_paket' => set_value('id_paket'),
            'bulan' => set_value('bulan'),
            'status' => set_value('status'),
            'status_notif' => set_value('status_notif'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/tagihan/tagihan_form",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
    }
    
    public function create_action($id) 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create($id);
        } else {
        //     $data = array(
        //     'id_client' => $this->input->post('id_client',TRUE),
        //     'total_bayar' => $this->input->post('total_bayar',TRUE),
        //     'id_paket' => $this->input->post('id_paket',TRUE),
        //     'bulan' => $this->input->post('bulan',TRUE),
        //     'status' => $this->input->post('status',TRUE),
        // );
            $id_client = $this->input->post('id_client');
            $total_bayar = $this->input->post('total_bayar');
            $bulan = $this->input->post('bulan');
            $status = $this->input->post('status');
            $status_notif = $this->input->post('status_notif');
            $id_paket = $this->input->post('id_paket');
            foreach($id_client as $row){
                $data = array(
                      'id_paket' => $id_paket,
                      'total_bayar' => $total_bayar,
                      'bulan' => $bulan,
                      'status' => $status,
                      'status_notif' => $status_notif,
                      'id_client' => $row
                    );
                $this->db->insert('pembayaran',$data);
            }
            // $this->Tagihan_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Create Record success</b></center></div>');
            redirect(site_url('admin/tagihan'));
        }
    }
    
    

    public function _rules() 
    {
	// $this->form_validation->set_rules('id_client', 'id client', 'trim|required');
	$this->form_validation->set_rules('total_bayar', 'total bayar', 'trim|required');
	$this->form_validation->set_rules('id_paket', 'id paket', 'trim|required');
	$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('status_notif', 'status_notif', 'trim|required');

	$this->form_validation->set_rules('id_pem', 'id_pem', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-05 14:31:03 */
/* http://harviacode.com */