<?php
class login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
       
    } 

    public function index()
    {
        $this->form_validation->set_rules('username','User Name','required|alpha');
        $this->form_validation->set_rules('password','Password','required|max_length[12]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if($this->form_validation->run())
        {
            $uname=$this->input->post('username');
            $pass=$this->input->post('password');
            $this->load->model('loginmodel');
            $id=$this->loginmodel->isvalidate($uname,$pass);
            if($id)
            {
                $this->session->set_userdata('id',$id);
                return redirect('Admin/welcome');
            }
            else
            {
                $this->session->set_flashdata('Login_failed','Invalid Username/Password');
                return redirect('login');
            }
        }
        else
        {
            $this->load->view('admin/login');
        }
    }
}
?>