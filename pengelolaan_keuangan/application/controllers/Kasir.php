<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kasir_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kasir/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kasir/index.html?q=' . urlencode($q);
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
            $config['base_url'] = base_url() . 'kasir/index.html';
            $config['first_url'] = base_url() . 'kasir/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kasir_model->total_rows($q);
        $kasir = $this->Kasir_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kasir_data' => $kasir,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/kasir/kasir_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Kasir_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_kasir' => $row->id_kasir,
            'nama_lengkap' => $row->nama_lengkap,
            'username' => $row->username,
            'password' => $row->password,
            'no_hp' => $row->no_hp,
            'alamat' => $row->alamat,
            'foto' => $row->foto,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/kasir/kasir_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kasir'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kasir/create_action'),
            'id_kasir' => set_value('id_kasir'),
            'nama_lengkap' => set_value('nama_lengkap'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'no_hp' => set_value('no_hp'),
            'alamat' => set_value('alamat'),
            // 'foto' => set_value('foto'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/kasir/kasir_form",
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
            $sql= $this->db->query("SELECT username FROM kasir WHERE username='$username'");
            $cek= $sql->num_rows();
            if($cek > 0){
                $this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
                            Username Sudah digunakan sebelumnya</b></center></div>');
                redirect(site_url('kasir/create'));
		    }else{
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                'username' => $this->input->post('username',TRUE),
                'password' => $this->input->post('password',TRUE),
                'no_hp' => $this->input->post('no_hp',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                // 'foto' => $this->input->post('foto',TRUE),
                );

                    $this->Kasir_model->insert($data);
                    // $this->session->set_flashdata('message', 'Create Record Success');
                    $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
                    Create Record success</b></center></div>');
                    redirect(site_url('admin/kasir'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kasir_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kasir/update_action'),
                'id_kasir' => set_value('id_kasir', $row->id_kasir),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'alamat' => set_value('alamat', $row->alamat),
                'foto' => set_value('foto', $row->foto),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/kasir/kasir_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/kasir'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kasir', TRUE));
        } else {
            $config = array(
                'upload_path'=>'./tampilan/profil/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );

            $nama_lengkap = $this->input->post('nama_lengkap');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $no_hp = $this->input->post('no_hp');
            $alamat = $this->input->post('alamat');
            $foto = $this->db->get_where('kasir','id_kasir');

            if($foto->num_rows()>0){
            $pros=$foto->row();
            $name=$pros->foto;

            if(file_exists($lok=FCPATH.'/tampilan/profil/'.$name)){
            unlink($lok);
            }
            if(file_exists($lok=FCPATH.'/tampilan/profil/'.$name)){
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
                                'foto'=>$nama_foto
                                );

            $config2 = array(
                    'source_image'=>'tampilan/profil/'.$nama_foto,
                    'image_library'=>'gd2',
                    'new_image'=>'tampilan/profil/',
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
                                'alamat'=>$alamat);

            }

            
            $this->Kasir_model->update($this->input->post('id_kasir', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            // $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/kasir'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kasir_model->get_by_id($id);

        if ($row) {
            $this->Kasir_model->delete($id);
            // $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('admin/kasir'));
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/kasir'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	// $this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id_kasir', 'id_kasir', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-16 18:54:57 */
/* http://harviacode.com */