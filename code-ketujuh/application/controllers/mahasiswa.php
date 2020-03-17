<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class mahasiswa extends CI_Controller {

        //fungsi yang akan dijalankan saat classnya diinstansiasi
        public function __construct(){
            //digunakan untuk menjalankan fungsi construct pada class parrent(ci_controller)
            parent::__construct();
            $this->load->model('mahasiswa_model');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
        }

        public function index()
        {   
            $this->load->model('mahasiswa_model');
            $data['title']='List Mahahiswa';
            $data['mahasiswa']=$this->mahasiswa_model->getAllMahasiswa();
            $this->load->view('template/header',$data);
            $this->load->view('mahasiswa/index',$data);   
            $this->load->view('template/footer');   
        }
        
        public function tambah()
        {   
            $data['title']='Form Menambahkan Data Mahahiswa';

            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('nim', 'Nim', 'required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if($this->form_validation->run()==FALSE){
            $this->load->view('template/header',$data);
            $this->load->view('mahasiswa/tambah',$data);   
            $this->load->view('template/footer');
            }else{
                $this->mahasiswa_model->tambahdatamhs();
                echo "Data berhasil ditambah";
                //untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flashdatanya)
                $this->session->set_flashdata('flash-data', 'ditambahkan');
                redirect('mahasiswa','refresh');
                
            }   
        }
    
    }
    
    /* End of file Controllername.php */
    
?>