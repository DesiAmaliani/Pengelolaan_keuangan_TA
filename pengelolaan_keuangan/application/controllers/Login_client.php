<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_client extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
        // $this->load->model("Model_register");
        $this->load->library('form_validation');
	}
	public function index()
	{
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()==false){
			$data = array("container" => "client/login");
			$this->load->view("template_login", $data);
			// $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
			// Username atau Password harus diisi</b></center></div>');
		} else {
			$username = $this->input->POST('username');
			$password = $this->input->POST('password');
			$user = $this->db->GET_WHERE('client',['username'=> $username, 'password'=> $password ])->row_array();
					if($user['username']==$username){
						if(md5($password, $user['password'])){
							$data =[
								'username' =>$user['username'],
							];
							$this->session->set_userdata($data);
							redirect(site_url('login_client/home'));
						}else{
							redirect(site_url('login_client'));
						}
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
						Username atau Password salah</b></center></div>');
						redirect(site_url('login_client'));
					}
		}
     
	}
	public function home()
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
        $data = array("header" => "client/header","nav" => "client/nav","container" => "client/home",'user'=>$this->db->GET_WHERE('client',['username' => $this->session->userdata('username')])->row_array());
		$this->load->view("template", $data);
		} else {
			redirect(site_url("login_admin"));
		}
	}
}