<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
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
        $config['total_rows'] = $this->Pembayaran_model->total_rows($q);
        $pembayaran = $this->Pembayaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('pembayaran/pembayaran_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pem' => $row->id_pem,
		'tgl_pem' => $row->tgl_pem,
		'id_client' => $row->id_client,
		'total_bayar' => $row->total_bayar,
		'bukti_pem' => $row->bukti_pem,
		'id_paket' => $row->id_paket,
		'bulan' => $row->bulan,
		'status' => $row->status,
		'status_notif' => $row->status_notif,
	    );
            $this->load->view('pembayaran/pembayaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembayaran/create_action'),
	    'id_pem' => set_value('id_pem'),
	    'tgl_pem' => set_value('tgl_pem'),
	    'id_client' => set_value('id_client'),
	    'total_bayar' => set_value('total_bayar'),
	    'bukti_pem' => set_value('bukti_pem'),
	    'id_paket' => set_value('id_paket'),
	    'bulan' => set_value('bulan'),
	    'status' => set_value('status'),
	    'status_notif' => set_value('status_notif'),
	);
        $this->load->view('pembayaran/pembayaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tgl_pem' => $this->input->post('tgl_pem',TRUE),
		'id_client' => $this->input->post('id_client',TRUE),
		'total_bayar' => $this->input->post('total_bayar',TRUE),
		'bukti_pem' => $this->input->post('bukti_pem',TRUE),
		'id_paket' => $this->input->post('id_paket',TRUE),
		'bulan' => $this->input->post('bulan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'status_notif' => $this->input->post('status_notif',TRUE),
	    );

            $this->Pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembayaran/update_action'),
		'id_pem' => set_value('id_pem', $row->id_pem),
		'tgl_pem' => set_value('tgl_pem', $row->tgl_pem),
		'id_client' => set_value('id_client', $row->id_client),
		'total_bayar' => set_value('total_bayar', $row->total_bayar),
		'bukti_pem' => set_value('bukti_pem', $row->bukti_pem),
		'id_paket' => set_value('id_paket', $row->id_paket),
		'bulan' => set_value('bulan', $row->bulan),
		'status' => set_value('status', $row->status),
		'status_notif' => set_value('status_notif', $row->status_notif),
	    );
            $this->load->view('pembayaran/pembayaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pem', TRUE));
        } else {
            $data = array(
		'tgl_pem' => $this->input->post('tgl_pem',TRUE),
		'id_client' => $this->input->post('id_client',TRUE),
		'total_bayar' => $this->input->post('total_bayar',TRUE),
		'bukti_pem' => $this->input->post('bukti_pem',TRUE),
		'id_paket' => $this->input->post('id_paket',TRUE),
		'bulan' => $this->input->post('bulan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'status_notif' => $this->input->post('status_notif',TRUE),
	    );

            $this->Pembayaran_model->update($this->input->post('id_pem', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_pem', 'tgl pem', 'trim|required');
	$this->form_validation->set_rules('id_client', 'id client', 'trim|required');
	$this->form_validation->set_rules('total_bayar', 'total bayar', 'trim|required');
	$this->form_validation->set_rules('bukti_pem', 'bukti pem', 'trim|required');
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