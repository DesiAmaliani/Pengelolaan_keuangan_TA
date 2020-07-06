<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengeluaran_model');
        $this->load->model('M_grafik');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengeluaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengeluaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengeluaran/index.html';
            $config['first_url'] = base_url() . 'pengeluaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengeluaran_model->total_rows($q);
        $pengeluaran = $this->Pengeluaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengeluaran_data' => $pengeluaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/pengeluaran/pengeluaran_list",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array(),
            'grafik'=>$this->Pengeluaran_model->get_data_stok(),
        );
        $this->load->view("template", $data);
        } else {
            redirect(site_url("login_admin"));
        }
    }

    public function read($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_peng' => $row->id_peng,
            'tgl_peng' => $row->tgl_peng,
            'bukti_peng' => $row->bukti_peng,
            'ket' => $row->ket,
            'total_peng' => $row->total_peng,
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/pengeluaran/pengeluaran_read",
            'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            // $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengeluaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengeluaran/create_action'),
            'id_peng' => set_value('id_peng'),
            'tgl_peng' => set_value('tgl_peng'),
            'bukti_peng' => set_value('bukti_peng'),
            'ket' => set_value('ket'),
            'total_peng' => set_value('total_peng'),
            "header" => "admin/header","nav" => "admin/nav",
            "container" => "admin/pengeluaran/pengeluaran_form",
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
            // $data = array(
            // 'tgl_peng' => $this->input->post('tgl_peng',TRUE),
            // 'bukti_peng' => $this->input->post('bukti_peng',TRUE),
            // 'ket' => $this->input->post('ket',TRUE),
            // 'total_peng' => $this->input->post('total_peng',TRUE),
            // );
            $config = array(
                'upload_path'=>'./tampilan/pengeluaran/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );

            $tgl_peng = $this->input->post('tgl_peng');
            $ket = $this->input->post('ket');
            $total_peng = $this->input->post('total_peng');
            $bukti_peng = $this->db->get('pengeluaran');

            if($bukti_peng->num_rows()>0){
            $pros=$bukti_peng->row();
            $name=$pros->bukti_peng;

            if(file_exists($lok=FCPATH.'/tampilan/pengeluaran/'.$name)){
            unlink($lok);
            }
            if(file_exists($lok=FCPATH.'/tampilan/pengeluaran/'.$name)){
            unlink($lok);
            }}

            $this->load->library('upload',$config);

            if($this->upload->do_upload('bukti_peng')){

            $finfo = $this->upload->data();
            $nama_foto = $finfo['file_name'];

            $data= array(
                                'tgl_peng'=>$tgl_peng,
                                'ket'=>$ket,
                                'total_peng'=>$total_peng,
                                'bukti_peng'=>$nama_foto
                                );

            $config2 = array(
                    'source_image'=>'tampilan/pengeluaran/'.$nama_foto,
                    'image_library'=>'gd2',
                    'new_image'=>'tampilan/pengeluaran/',
                    'maintain_ratio'=>true,
                    'width'=>150,
                    'height'=>200
                );

            $this->load->library('image_lib',$config2);
            $this->image_lib->resize();    

            }else{
            $data= array(
                                'tgl_peng'=>$tgl_peng,
                                'ket'=>$ket,
                                'total_peng'=>$total_peng,
                                );

            }

            $this->Pengeluaran_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Create Record success</b></center></div>');
            redirect(site_url('admin/pengeluaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengeluaran/update_action'),
                'id_peng' => set_value('id_peng', $row->id_peng),
                'tgl_peng' => set_value('tgl_peng', $row->tgl_peng),
                'bukti_peng' => set_value('bukti_peng', $row->bukti_peng),
                'ket' => set_value('ket', $row->ket),
                'total_peng' => set_value('total_peng', $row->total_peng),
                "header" => "admin/header","nav" => "admin/nav",
                "container" => "admin/pengeluaran/pengeluaran_form",
                'user'=>$this->db->GET_WHERE('admin',['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view("template", $data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/pengeluaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_peng', TRUE));
        } else {
            $config = array(
                'upload_path'=>'./tampilan/pengeluaran/',
                'allowed_types'=>'jpg|png|jpeg',
                'max_size'=>2086
                );

            $tgl_peng = $this->input->post('tgl_peng');
            $ket = $this->input->post('ket');
            $total_peng = $this->input->post('total_peng');
            $bukti_peng = $this->db->get_where('pengeluaran','id_peng');

            if($bukti_peng->num_rows()>0){
            $pros=$bukti_peng->row();
            $name=$pros->bukti_peng;

            if(file_exists($lok=FCPATH.'/tampilan/pengeluaran/'.$name)){
            unlink($lok);
            }
            if(file_exists($lok=FCPATH.'/tampilan/pengeluaran/'.$name)){
            unlink($lok);
            }}

            $this->load->library('upload',$config);

            if($this->upload->do_upload('bukti_peng')){

            $finfo = $this->upload->data();
            $nama_foto = $finfo['file_name'];

            $data= array(
                                'tgl_peng'=>$tgl_peng,
                                'ket'=>$ket,
                                'total_peng'=>$total_peng,
                                'bukti_peng'=>$nama_foto
                                );

            $config2 = array(
                    'source_image'=>'tampilan/pengeluaran/'.$nama_foto,
                    'image_library'=>'gd2',
                    'new_image'=>'tampilan/pengeluaran/',
                    'maintain_ratio'=>true,
                    'width'=>150,
                    'height'=>200
                );

            $this->load->library('image_lib',$config2);
            $this->image_lib->resize();    

            }else{
            $data= array(
                                'tgl_peng'=>$tgl_peng,
                                'ket'=>$ket,
                                'total_peng'=>$total_peng,
                                );

            }

            $this->Pengeluaran_model->update($this->input->post('id_peng', TRUE), $data);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Update Record Success</b></center></div>');
            // $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/pengeluaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);

        if ($row) {
            $this->Pengeluaran_model->delete($id);
            $this->session->set_flashdata('message','<div class="alert alert-success"><center><b>
            Delete Record Success</b></center></div>');
            redirect(site_url('admin/kasir'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning"><center><b>
            Record Not Found</b></center></div>');
            redirect(site_url('admin/kasir'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_peng', 'tgl peng', 'trim|required');
	// $this->form_validation->set_rules('bukti_peng', 'bukti peng', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');
	$this->form_validation->set_rules('total_peng', 'total peng', 'trim|required');

	$this->form_validation->set_rules('id_peng', 'id_peng', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rekap_semua_pengeluaran.doc");

        $data = array(
            'pengeluaran_data' => $this->Pengeluaran_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pengeluaran/pengeluaran_doc',$data);
    }

    public function word_tahun($id)
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rekap_pengeluaran_'$id'.doc");

        $data = array(
            // 'pengeluaran_data' => $this->Pengeluaran_model->get_all(),
            'id' =>$id,
            'start' => 0
        );
        
        $this->load->view('admin/pengeluaran/pengeluaran_doc_tahun',$data);
    }


}

/* End of file Pengeluaran.php */
/* Location: ./application/controllers/Pengeluaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-29 15:40:11 */
/* http://harviacode.com */