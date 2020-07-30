<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model("Model_register");
        $this->load->library('session');
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()==false){
			$data = array("container" => "admin/login",'login');
			$this->load->view("template_login", $data);
			// $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
			// Username atau Password harus diisi</b></center></div>');
		} else {
			$username = $this->input->POST('username');
			$password = $this->input->POST('password');
			$user = $this->db->GET_WHERE('admin',['username'=> $username, 'password'=> $password ])->row_array();
					if($user['username']==$username){
						if(md5($password, $user['password'])){
							$data =[
								'username' =>$user['username'],
							];
							$this->session->set_userdata($data);
							redirect(site_url('login_admin/home'));
						}else{
							redirect(site_url('login_admin'));
						}
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
						Username atau Password salah</b></center></div>');
						redirect(site_url('login_admin'));
					}
		}
	}
	public function register()
	{
		$this->load->helper(array('captcha'));
		$this->load->library('session');
		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'img_width' => 170,
			'img_height' => 45
		);
		$cap = create_captcha($vals);
		$this->session->set_userdata('keycode',md5($cap['word']));
		$data = array("container" => "admin/register",'captcha'=>  $cap['image']);
		$this->load->view("template_login", $data);
	}
	public function verification($key)
	{
		$this->load->helper('url');
		$this->Model_register->changeActiveState($key);
		$this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
		Selamat kamu telah memverifikasi akun kamu</b></center></div>');
		redirect(site_url('login_admin/register'));
		
	}
	public function register_add()
	{
		$username= $this->input->post('username');
		$email= $this->input->post('email');
		$sql= $this->db->query("SELECT username FROM admin WHERE username='$username'");
		$cek= $sql->num_rows();
		if($cek > 0){
			$this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
						Username Sudah digunakan sebelumnya</b></center></div>');
			redirect(site_url('login_admin/register'));
		}else{	
					
					$data = array(
						'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
						'username' => $this->input->post('username',TRUE),
						'password' => $this->input->post('password',TRUE),
						'alamat' => $this->input->post('alamat',TRUE),
						'no_hp' => $this->input->post('no_hp',TRUE),
						'email' => $this->input->post('email',TRUE)
					);	
					$this->session->set_flashdata('message', '<div class="alert alert-success"><center><b>
					Register Berhasil</b></center></div>');
					redirect(site_url('login_admin/register'));
		}
      
	}
	public function home()
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
		$data = array("header" => "admin/header","nav" => "admin/nav",
					"container" => "admin/home",
					'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array());
		
		$this->load->view("template", $data);
		} else {
			redirect(site_url("login_admin"));
		}
	}
	public function profil($id)
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
		$row = $this->Admin_model->get_by_id($id);

        if ($row) {
		$data = array(
			     'button' => 'Ganti',
                'action' => site_url('login_admin/update_action'),
                'id_admin' => set_value('id_admin', $row->id_admin),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'alamat' => set_value('alamat', $row->alamat),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'foto' => set_value('foto', $row->foto),
                'email' => set_value('email', $row->email),
                'active' => set_value('active', $row->active),
			"header" => "admin/header","nav" => "admin/nav",
			"container" => "admin/profil",
			'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view("template", $data);
		}
		} else {
			redirect(site_url("login_admin"));
		}
	}
	public function update_action() 
    {
            $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
            'username' => $this->input->post('username',TRUE),
            'password' => $this->input->post('password',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'foto' => $this->input->post('foto',TRUE),
            'email' => $this->input->post('email',TRUE),
            'active' => $this->input->post('active',TRUE),
            );
            $config = array(
                'upload_path'=>'./tampilan/profil/admin/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );

            $nama_lengkap = $this->input->post('nama_lengkap');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $no_hp = $this->input->post('no_hp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $active = $this->input->post('active');
            $foto = $this->db->get_where('kasir','id_kasir');

            if($foto->num_rows()>0){
            $pros=$foto->row();
            $name=$pros->foto;

            if(file_exists($lok=FCPATH.'/tampilan/profil/admin/'.$name)){
            unlink($lok);
            }
            if(file_exists($lok=FCPATH.'/tampilan/profil/admin/'.$name)){
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
                                'email'=>$email,
                                'active'=>$active,
                                'foto'=>$nama_foto
                                );

            $config2 = array(
                    'source_image'=>'tampilan/profil/admin/'.$nama_foto,
                    'image_library'=>'gd2',
                    'new_image'=>'tampilan/profil/admin/',
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
                                'email'=>$email,
                                'active'=>$active);

            }

            $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            // $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('login_admin/home'));
    }
	public function logout(){
        $this->session->unset_userdata(array('username','password'));
        $this->session->set_flashdata('pesan','<div align="center" class="alert alert-success" role="alert"><b>Anda Telah Logout. </b></div>');
        redirect('login_admin');
    }
}