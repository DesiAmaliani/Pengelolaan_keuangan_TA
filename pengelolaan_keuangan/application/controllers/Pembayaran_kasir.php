<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran_kasir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_kasir_model');
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
        $config['total_rows'] = $this->Pembayaran_kasir_model->total_rows($q);
        $pembayaran = $this->Pembayaran_kasir_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "kasir/header","nav" => "kasir/nav",
            "container" => "kasir/pembayaran/pembayaran_list",
            'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array(),
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_kasir"));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembayaran_kasir/create_action'),
            'id_pem' => set_value('id_pem'),
            'id_client' => set_value('id_client'),
            'total_bayar' => set_value('total_bayar'),
            'id_paket' => set_value('id_paket'),
            'bulan' => set_value('bulan'),
            'status' => set_value('status'),
            'bukti_pem' => set_value('bukti_pem'),
            'status_notif' => set_value('status_notif'),
            "header" => "kasir/header","nav" => "kasir/nav",
            "container" => "kasir/pembayaran/pembayaran_form_create",
            'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            //     $data = array(
            //     'id_client' => $this->input->post('id_client',TRUE),
            //     'total_bayar' => $this->input->post('total_bayar',TRUE),
            //     'id_paket' => $this->input->post('id_paket',TRUE),
            //     'bulan' => $this->input->post('bulan',TRUE),
            //     'status' => $this->input->post('status',TRUE),
            // );
            $config = array(
                'upload_path'=>'./tampilan/pembayaran/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );
            $tgl_pem = $this->input->post('tgl_pem');
            $id_client = $this->input->post('id_client');
            $id_paket = $this->input->post('id_paket');
            $bulan = $this->input->post('bulan');
            $status = $this->input->post('status');
            $status_notif = $this->input->post('status_notif');
            $total_bayar = $this->input->post('total_bayar');
            $bukti_pem = $this->db->get('pembayaran');
            if($bukti_pem->num_rows()>0){
            $pros=$bukti_pem->row();
            $name=$pros->bukti_pem;

            if(file_exists($lok=FCPATH.'/tampilan/pembayaran/'.$name)){
            unlink($lok);
            }
            if(file_exists($lok=FCPATH.'/tampilan/pembayaran/'.$name)){
            unlink($lok);
            }}

            $this->load->library('upload',$config);

            if($this->upload->do_upload('bukti_pem')){

            $finfo = $this->upload->data();
            $nama_foto = $finfo['file_name'];

            $data= array(
                                'tgl_pem'=>$tgl_pem,
                                'id_client'=>$id_client,
                                'id_paket'=>$id_paket,
                                'bulan'=>$bulan,
                                'status'=>$status,
                                'status_notif'=>$status_notif,
                                'total_bayar'=>$total_bayar,
                                'bukti_pem'=>$nama_foto
                                );

            $config2 = array(
                    'source_image'=>'tampilan/pembayaran/'.$nama_foto,
                    'image_library'=>'gd2',
                    'new_image'=>'tampilan/pembayaran/',
                    'maintain_ratio'=>true,
                    'width'=>150,
                    'height'=>200
                );

            $this->load->library('image_lib',$config2);
            $this->image_lib->resize();    

            }else{
            $data= array(
                                'tgl_pem'=>$tgl_pem,
                                'id_client'=>$id_client,
                                'id_paket'=>$id_paket,
                                'bulan'=>$bulan,
                                'status'=>$status,
                                'status_notif'=>$status_notif,
                                'total_bayar'=>$total_bayar,
                                );

            }
            $id = $this->db->where('id_pem', $id_pem);
            $this->Pembayaran_kasir_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Create Record success</b></center></div>');
            redirect(site_url('pembayaran_kasir/index'));
        }
    }
    
    public function bayar($id) 
    {
        $row = $this->Pembayaran_kasir_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Bayar',
                'action' => site_url('pembayaran_kasir/update_action/'.$row->id_pem),
                'id_pem' => set_value('id_pem', $row->id_pem),
                'tgl_pem' => set_value('tgl_pem', $row->tgl_pem),
                'id_client' => set_value('id_client', $row->id_client),
                'total_bayar' => set_value('total_bayar', $row->total_bayar),
                'bukti_pem' => set_value('bukti_pem', $row->bukti_pem),
                'id_paket' => set_value('id_paket', $row->id_paket),
                'bulan' => set_value('bulan', $row->bulan),
                'status' => set_value('status', $row->status),
                'status_notif' => set_value('status_notif', $row->status_notif),
                "header" => "kasir/header","nav" => "kasir/nav",
                "container" => "kasir/pembayaran/pembayaran_form",
                'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('kasir/pembayaran'));
        }
    }
    public function update_action($id) 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->bayar($this->input->post('id_pem', TRUE));
        } else {
            $config = array(
                'upload_path'=>'./tampilan/pembayaran/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );

            $tgl_pem = $this->input->post('tgl_pem');
            $id_client = $this->input->post('id_client');
            $id_paket = $this->input->post('id_paket');
            $bulan = $this->input->post('bulan');
            $status = $this->input->post('status');
            $status_notif = $this->input->post('status_notif');
            $total_bayar = $this->input->post('total_bayar');
            $bukti_pem = $this->db->get_where('pembayaran','id_pem');

            if($bukti_pem->num_rows()>0){
            $pros=$bukti_pem->row();
            $name=$pros->bukti_pem;

            if(file_exists($lok=FCPATH.'/tampilan/pembayaran/'.$name)){
            unlink($lok);
            }
            if(file_exists($lok=FCPATH.'/tampilan/pembayaran/'.$name)){
            unlink($lok);
            }}

            $this->load->library('upload',$config);

            if($this->upload->do_upload('bukti_pem')){

            $finfo = $this->upload->data();
            $nama_foto = $finfo['file_name'];

            $data= array(
                                'tgl_pem'=>$tgl_pem,
                                'id_client'=>$id_client,
                                'id_paket'=>$id_paket,
                                'bulan'=>$bulan,
                                'status'=>$status,
                                'status_notif'=>$status_notif,
                                'total_bayar'=>$total_bayar,
                                'bukti_pem'=>$nama_foto
                                );

            $config2 = array(
                    'source_image'=>'tampilan/pembayaran/'.$nama_foto,
                    'image_library'=>'gd2',
                    'new_image'=>'tampilan/pembayaran/',
                    'maintain_ratio'=>true,
                    'width'=>150,
                    'height'=>200
                );

            $this->load->library('image_lib',$config2);
            $this->image_lib->resize();    

            }else{
            $data= array(
                                'tgl_pem'=>$tgl_pem,
                                'id_client'=>$id_client,
                                'id_paket'=>$id_paket,
                                'bulan'=>$bulan,
                                'status'=>$status,
                                'status_notif'=>$status_notif,
                                'total_bayar'=>$total_bayar,
                                );

            }

            $this->Pembayaran_kasir_model->update($this->input->post('id_pem', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Pembayaran Berhasil</b></center></div>');
            redirect(site_url('pembayaran_kasir/invoice/'.$id));
        }
    }
    public function invoice($id)
	{
		if(isset($_SESSION['username'])){
        // "header" => "admin/header","nav" => "admin/nav",
        $row = $this->Pembayaran_kasir_model->get_by_id($id);
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
                'status' => set_value('status', $row->status),
					"container" => "kasir/pembayaran/invoice",
					'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array());
		
        $this->load->view("template_invoice", $data);
        }
		} else {
			redirect(site_url("login_kasir"));
		}
    }
    
    public function invoice_print($id)
	{
		if(isset($_SESSION['username'])){
        // "header" => "kasir/header","nav" => "kasir/nav",
        $row = $this->Pembayaran_kasir_model->get_by_id($id);
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
                'status' => set_value('status', $row->status),
					"container" => "kasir/pembayaran/invoice_print",
					'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array());
		
        $this->load->view("template_invoice", $data);
        }
		} else {
			redirect(site_url("login_kasir"));
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