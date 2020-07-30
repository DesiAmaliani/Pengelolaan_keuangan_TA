<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tagihan_model');
        $this->load->model('Pembayaran_model');
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
            "container" => "admin/transaksi/transaksi_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array(),
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }
    public function konfirmasi($id) 
    {
        $this->db->query('UPDATE pembayaran SET status = 2 where id_pem="'.$id.'"');
        redirect(site_url('transaksi'));
    }
    public function tolak($id) 
    {
        $this->db->query('UPDATE pembayaran SET status = 3 where id_pem="'.$id.'"');
        redirect(site_url('transaksi'));
    }
    public function re(){
		$this->load->view("reload");
	}
    public function notif($id) 
    {
         $this->db->query('UPDATE pembayaran SET status_notif = 0 where id_pem="'.$id.'"');
		 redirect(site_url('transaksi'));
    }
    public function invoice($id)
	{
		if(isset($_SESSION['username'])){
        // "header" => "admin/header","nav" => "admin/nav",
        $row = $this->Pembayaran_model->get_by_id($id);
        if ($row) {
		$data = array(
                'button' => 'INTERNET SERVICE PROVIDER PERBULAN',
                'id_pem' => set_value('id_pem', $row->id_pem),
                'tgl_pem' => set_value('tgl_pem', $row->tgl_pem),
                'id_client' => set_value('id_client', $row->id_client),
                'total_bayar' => set_value('total_bayar', $row->total_bayar),
                'bukti_pem' => set_value('bukti_pem', $row->bukti_pem),
                'id_paket' => set_value('id_paket', $row->id_paket),
                'bulan' => set_value('bulan', $row->bulan),
                'jatuh_temp' => set_value('jatuh_temp', $row->jatuh_temp),
                'status' => set_value('status', $row->status),
					"container" => "admin/transaksi/invoice",
					'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array());
		
        $this->load->view("template_invoice", $data);
        }
		} else {
			redirect(site_url("transaksi"));
		}
    }
    
    public function invoice_print($id)
	{
		if(isset($_SESSION['username'])){
        // "header" => "kasir/header","nav" => "kasir/nav",
        $row = $this->Pembayaran_model->get_by_id($id);
        if ($row) {
		$data = array(
                'button' => 'INTERNET SERVICE PROVIDER PERBULAN',
                'id_pem' => set_value('id_pem', $row->id_pem),
                'tgl_pem' => set_value('tgl_pem', $row->tgl_pem),
                'id_client' => set_value('id_client', $row->id_client),
                'total_bayar' => set_value('total_bayar', $row->total_bayar),
                'bukti_pem' => set_value('bukti_pem', $row->bukti_pem),
                'id_paket' => set_value('id_paket', $row->id_paket),
                'bulan' => set_value('bulan', $row->bulan),
                'jatuh_temp' => set_value('jatuh_temp', $row->jatuh_temp),
                'status' => set_value('status', $row->status),
					"container" => "admin/transaksi/invoice_print",
					'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array());
		
        $this->load->view("template_invoice", $data);
        }
		} else {
			redirect(site_url("transaksi"));
		}
	}
    
}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-05 14:31:03 */
/* http://harviacode.com */