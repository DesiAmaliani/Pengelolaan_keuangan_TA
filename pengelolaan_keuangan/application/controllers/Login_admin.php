<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("Model_register");
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
					$this->load->helper(array('form','url'));
					$this->load->library('session');
					$nama_lengkap = $this->input->post('nama_lengkap');
					$captcha = $this->input->post('captcha');
				if(md5($captcha)==$this->session->userdata('keycode')){
					$data = array(
						'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
						'username' => $this->input->post('username',TRUE),
						'password' => $this->input->post('password',TRUE),
						'alamat' => $this->input->post('alamat',TRUE),
						'no_hp' => $this->input->post('no_hp',TRUE),
						'email' => $this->input->post('email',TRUE),
						'active' => 0
					);	
					$id = $this->Model_register->insert($data);
					//enkripsi id
					$encrypted_id = md5($id);
					
					//enkripsi id
					$encrypted_id = md5($id);
					$this->load->library('email');
					$config = array();
					$config['charset'] = 'utf-8';
					$config['useragent'] = 'Codeigniter';
					$config['protocol']= "smtp";
					$config['mailtype']= "html";
					$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
					$config['smtp_port']= "465";
					$config['smtp_timeout']= "400";
					$config['smtp_user']= "desi.amaliani@gmail.com"; // isi dengan email kamu
					$config['smtp_pass']= "Liaseeamaliani112"; // isi dengan password kamu
					$config['crlf']="\r\n";
					$config['newline']="\r\n";
					$config['wordwrap'] = TRUE;
					
					//memanggil library email dan set konfigurasi untuk pengiriman email
					$this->email->initialize($config);
					
					//konfigurasi pengiriman
					$this->email->from($config['smtp_user']);
					$this->email->to($email);
					$this->email->subject("Verifikasi Akun");
					$this->email->message(
					"Hai $nama_lengkap, silahkan verifikasi akun anda <br><br>".
					site_url("login_admin/verification/$encrypted_id")
					);
					$data['nama_lengkap'] = $nama_lengkap;
					$data['captcha']= $captcha;
					$this->session->unset_userdata('keycode');
					//notifikasi registrasi berhasil
					
						if($this->email->send()){
							$this->session->set_flashdata('message', '<div class="alert alert-warning"><center><b>
							Berhasil melakukan registrasi, silahkan cek email kamu</b></center></div>');
							redirect(site_url('login_admin/register'));
						}else{
							//notifikasi jika email sudah terkirim atau belum terkirim
							$this->session->set_flashdata('message', '<div class="alert alert-danger"><center><b>
							Berhasil melakukan registrasi, namu gagal mengirim verifikasi email</b></center></div>');
							redirect(site_url('login_admin/register'));
						}
					}else{
						redirect('register?cap_error=1','refresh');
					}
					// $this->session->set_flashdata('message', '<div class="alert alert-success"><center><b>
					// Register Berhasil</b></center></div>');
					// redirect(site_url('login_admin/register'));
		}
      
	}
	public function home()
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
		$data = array("header" => "admin/header","nav" => "admin/nav","container" => "admin/home",'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array());
		
		$this->load->view("template", $data);
		} else {
			redirect(site_url("login_admin"));
		}
	}
	public function admin()
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
		$data = array("header" => "admin/header","nav" => "admin/nav","container" => "admin/admin_list",'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array());
		
		$this->load->view("template", $data);
		} else {
			redirect(site_url("login_admin"));
		}
	}
	public function client()
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
		$data = array("header" => "admin/header","nav" => "admin/nav","container" => "admin/client_list",'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array());
		
		$this->load->view("template", $data);
		} else {
			redirect(site_url("login_admin"));
		}
	}
	public function logout(){
        $this->session->unset_userdata(array('username','password'));
        $this->session->set_flashdata('pesan','<div align="center" class="alert alert-success" role="alert"><b>Anda Telah Logout. </b></div>');
        redirect('login_admin');
    }
}