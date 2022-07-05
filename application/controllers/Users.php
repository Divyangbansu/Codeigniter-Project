<?php
class Users extends MY_controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('loginmodel');
    }

    public function index()
    {
        $nl["product"]=$this->loginmodel->nlist();
        $nl["banners"]=$this->loginmodel->blist();
        $this->load->view('users/datashow',$nl);
    }

    public function carddata()
    {
            $id = intval($this->input->get('id'));
            // $id = $_POST['id'];
            $nl["product"]=$this->loginmodel->edit($id);
            $this->load->view('users/p_details',$nl);
        
    }

    public function services()
    {
      $this->load->view('users/services');
    }
}
?>