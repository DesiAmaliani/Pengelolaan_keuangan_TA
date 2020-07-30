<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'client/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'client/index.html?q=' . urlencode($q);
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
            $config['base_url'] = base_url() . 'client/index.html';
            $config['first_url'] = base_url() . 'client/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Client_model->total_rows($q);
        $client = $this->Client_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'client_data' => $client,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/client/client_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Client_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_client' => $row->id_client,
                'nama_lengkap' => $row->nama_lengkap,
                'username' => $row->username,
                'password' => $row->password,
                'no_hp' => $row->no_hp,
                'alamat' => $row->alamat,
                'tgl_bergabung' => $row->tgl_bergabung,
                'latitude' => $row->latitude,
                'longitude' => $row->longitude,
                'jatuh_tempo' => $row->jatuh_tempo,
                'id_paket' => $row->id_paket,
                'foto' => $row->foto,
                'status_client' => $row->status_client,
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/client/client_read",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
             );
                $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('client'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('client/create_action'),
            'id_client' => set_value('id_client'),
            'nama_lengkap' => set_value('nama_lengkap'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'no_hp' => set_value('no_hp'),
            'alamat' => set_value('alamat'),
            'tgl_bergabung' => set_value('tgl_bergabung'),
            'latitude' => set_value('latitude'),
            'longitude' => set_value('longitude'),
            'jatuh_tempo' => set_value('jatuh_tempo'),
            //'foto' => set_value('foto'),
            'status_client' => set_value('status_client'),
            'id_paket' => set_value('id_paket'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/client/client_form",
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
            $username= $this->input->post('username');
            $sql= $this->db->query("SELECT username FROM client WHERE username='$username'");
            $cek= $sql->num_rows();
            if($cek > 0){
                $this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
                            Username Sudah digunakan sebelumnya</b></center></div>');
                redirect(site_url('client/create'));
		    }else{
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                'username' => $this->input->post('username',TRUE),
                'password' => $this->input->post('password',TRUE),
                'no_hp' => $this->input->post('no_hp',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'tgl_bergabung' => $this->input->post('tgl_bergabung',TRUE),
                'latitude' => $this->input->post('latitude',TRUE),
                'longitude' => $this->input->post('longitude',TRUE),
                'jatuh_tempo' => $this->input->post('jatuh_tempo',TRUE),
                // 'foto' => $this->input->post('foto',TRUE),
                'id_paket' => $this->input->post('id_paket',TRUE),
                'status_client' => $this->input->post('status_client',TRUE),
                );

            $this->Client_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Create Record success</b></center></div>');
            redirect(site_url('admin/client'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Client_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('client/update_action'),
                'id_client' => set_value('id_client', $row->id_client),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'alamat' => set_value('alamat', $row->alamat),
                'tgl_bergabung' => set_value('tgl_bergabung', $row->tgl_bergabung),
                'latitude' => set_value('latitude', $row->latitude),
                'longitude' => set_value('longitude', $row->longitude),
                'jatuh_tempo' => set_value('jatuh_tempo', $row->jatuh_tempo),
                'foto' => set_value('foto', $row->foto),
                'id_paket' => set_value('id_paket', $row->id_paket),
                'status_client' => set_value('status_client', $row->status_client),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/client/client_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/client'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_client', TRUE));
        } else {
            $config = array(
                'upload_path'=>'./tampilan/profil/client/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );
            $nama_lengkap = $this->input->post('nama_lengkap');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $no_hp = $this->input->post('no_hp');
            $alamat = $this->input->post('alamat');
            $tgl_bergabung = $this->input->post('tgl_bergabung');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $jatuh_tempo = $this->input->post('jatuh_tempo');
            $id_paket = $this->input->post('id_paket');
            $status_client = $this->input->post('status_client');
            $foto = $this->db->get_where('client','id_client');

            if($foto->num_rows()>0){
                $pros=$foto->row();
                $name=$pros->foto;
    
                if(file_exists($lok=FCPATH.'/tampilan/profil/client/'.$name)){
                unlink($lok);
                }
                if(file_exists($lok=FCPATH.'/tampilan/profil/client/'.$name)){
                unlink($lok);
                }}
    
                $this->load->library('upload',$config);
    
                if($this->upload->do_upload('foto')){
    
                $finfo = $this->upload->data();
                $nama_foto = $finfo['file_name'];
    
                $data= array(
                                    'nama_lengkap'=>$nama_lengkap,
                                    'username'=>$username,
                                    'password'=>$password,
                                    'no_hp'=>$no_hp,
                                    'alamat'=>$alamat,
                                    'tgl_bergabung'=>$tgl_bergabung,
                                    'latitude'=>$latitude,
                                    'longitude'=>$longitude,
                                    'jatuh_tempo'=>$jatuh_tempo,
                                    'id_paket'=>$id_paket,
                                    'status_client'=>$status_client,
                                    'foto'=>$nama_foto
                                    );
    
                $config2 = array(
                        'source_image'=>'tampilan/profil/client/'.$nama_foto,
                        'image_library'=>'gd2',
                        'new_image'=>'tampilan/profil/client/',
                        'maintain_ratio'=>true,
                        'width'=>150,
                        'height'=>200
                    );
    
                $this->load->library('image_lib',$config2);
                $this->image_lib->resize();    
    
                }else{
                $data= array(
                                    'nama_lengkap'=>$nama_lengkap,
                                    'username'=>$username,
                                    'password'=>$password,
                                    'no_hp'=>$no_hp,
                                    'alamat'=>$alamat,
                                    'tgl_bergabung'=>$tgl_bergabung,
                                    'latitude'=>$latitude,
                                    'longitude'=>$longitude,
                                    'jatuh_tempo'=>$jatuh_tempo,
                                    'id_paket'=>$id_paket,
                                    'status_client'=>$status_client
                                );
    
                }

            $this->Client_model->update($this->input->post('id_client', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            redirect(site_url('admin/client'));
        }
    }
    public function status() 
    {
          $data= array(
                     'status_client'=> $this->input->post('status_client', TRUE),
                    );
    
            $this->Client_model->update($this->input->post('id_client', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Status Client Success</b></center></div>');
            redirect(site_url('admin/client'));
    }
    public function delete($id) 
    {
        $row = $this->Client_model->get_by_id($id);

        if ($row) {
            $this->Client_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('admin/client'));
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/client'));
        }
    }
    public function lokasi($id) 
    {
        $row = $this->Client_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_client' => $row->id_client,
                'latitude' => $row->latitude,
                'longitude' => $row->longitude,
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
             );
                $this->load->view("admin/client/lokasi", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('client'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tgl_bergabung', 'tgl bergabung', 'trim|required');
	$this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
	$this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
	$this->form_validation->set_rules('jatuh_tempo', 'jatuh tempo', 'trim|required');
	// $this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('id_paket', 'id paket', 'trim|required');
	$this->form_validation->set_rules('status_client', 'status client', 'trim|required');

	$this->form_validation->set_rules('id_client', 'id_client', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Client.php */
/* Location: ./application/controllers/Client.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-12 18:26:38 */
/* http://harviacode.com */