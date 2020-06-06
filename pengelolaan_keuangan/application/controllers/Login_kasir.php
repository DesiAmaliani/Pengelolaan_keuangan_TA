<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_kasir extends CI_Controller {

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
        $this->load->model('Kasir_model');
        $this->load->library('form_validation');
	}
	public function index()
	{
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()==false){
			$data = array("container" => "kasir/login");
		$this->load->view("template_login", $data);
			// $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
			// Username atau Password harus diisi</b></center></div>');
		} else {
			$username = $this->input->POST('username');
			$password = $this->input->POST('password');
			$user = $this->db->GET_WHERE('kasir',['username'=> $username, 'password'=> $password ])->row_array();
					if($user['username']==$username){
						if(md5($password, $user['password'])){
							$data =[
								'username' =>$user['username'],
							];
							$this->session->set_userdata($data);
							redirect(site_url('login_kasir/home'));
						}else{
							redirect(site_url('login_kasir'));
						}
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger"><center><b>
						Username atau Password salah</b></center></div>');
						redirect(site_url('login_kasir'));
					}
		}
	}
	public function home()
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
        $data = array("header" => "kasir/header","nav" => "kasir/nav","container" => "kasir/home",'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array());
		$this->load->view("template", $data);
		} else {
			redirect(site_url("login_kasir"));
		}
	}
	public function profil($id)
	{
		if(isset($_SESSION['username'])){
		// "header" => "admin/header","nav" => "admin/nav",
		$row = $this->Kasir_model->get_by_id($id);

        if ($row) {
		$data = array(
			     'button' => 'Ganti',
                'action' => site_url('login_kasir/update_action'),
                'id_kasir' => set_value('id_kasir', $row->id_kasir),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'alamat' => set_value('alamat', $row->alamat),
                'foto' => set_value('foto', $row->foto),
			"header" => "kasir/header","nav" => "kasir/nav",
			"container" => "kasir/profil",
			'user'=>$this->db->GET_WHERE('kasir',['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view("template", $data);
		}
		} else {
			redirect(site_url("login_kasir"));
		}
	}
	public function update_action() 
    {
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
            redirect(site_url('login_kasir/home'));
    }
	public function logout(){
        $this->session->unset_userdata(array('username','password'));
        $this->session->set_flashdata('pesan','<div align="center" class="alert alert-success" role="alert"><b>Anda Telah Logout. </b></div>');
        redirect('login_kasir');
    }
}