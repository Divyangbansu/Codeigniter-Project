<?php
class Admin extends MY_controller
{
    public function welcome()
    {
      $this->load->view('admin/sidebar');
      $this->load->view('admin/header');
      $this->load->view('admin/dashboard');
    }
    
    

    public function logout()
    {
      $this->session->unset_userdata('id');
      return redirect('login');
    }

    public function nameplatelist()
    {
		$this->load->view('admin/header');
      $this->load->view('admin/sidebar');
      $this->load->view('admin/nameplatelist_page');
    }
    public function addnameplatelist()
    {
		$this->load->view('admin/header');
      $this->load->view('admin/sidebar');
      $this->load->view('admin/addnameplatelist_page');
	  $this->load->view('admin/footer');
    }

   public function __construct()
  {
    parent::__construct();
    $this->load->model('loginmodel');
    if( ! $this->session->userdata('id') )
    return redirect('login');
    $uid=0;
  }

  public function fetchdata()
  {
      $list=$this->loginmodel->nlist();
	  $nested_data=array();
	  $data=array();
      foreach ($list as $l) {
        $nested_data['name']=trim($l->name);
		$nested_data['price']=trim($l->price);
		$nested_data['image']='<img src="'.base_url().'/upload/'.$l->image.'" width="150" height="100" />';
		$nested_data['descr']=trim($l->descr);
		$checked="";if($l->status==1)$checked="checked";
		$nested_data['status']=' <label class="switch"> 
		<input id="status" type="checkbox" '.$checked.'
		onchange="javascript:statchange('.$l->id.',this.checked);">
		<span class="slider"></span> </label>';
		$nested_data['action']='<a href="#" id="edit" class="btn btn-sm btn-outline-info" value="'.$l->id.'"><i class="fas fa-edit"></i></a>
		<a href="#" id="delete" class="btn btn-sm btn-outline-danger" value="'.$l->id.'"><i class="fas fa-trash-alt"></i></a>';
		$data[]=$nested_data;
      }
      echo json_encode($data);
  }

  public function adddata()
  {
    if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('descr', 'descr', 'required');

      $data=array();
      if ($this->form_validation->run() == FALSE) 
      {
				$data = array('res' => "error", 'message' => validation_errors());
			} 
      else 
	  {
				$config['upload_path'] = './upload/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '10000';
				// $config['max_width'] = '1024';
				// $config['max_height'] = '768';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload("image")) 
       			 {
					$data = array('res' => "error", 'message' => $this->upload->display_errors());
				}
        		else
       			 {
					$ajax_data = $this->input->post();
					$ajax_data['image'] = $this->upload->data('file_name');
          			$ajax_data['status'] = 1;
				}
				if (!$this->upload->do_upload("image2")) 
       			 {
					$data = array('res' => "error", 'message' => $this->upload->display_errors());
				}
        		else
       			{
					$ajax_data['image2'] = $this->upload->data('file_name');
				}
				if (!$this->upload->do_upload("image3")) 
				{
				$data = array('res' => "error", 'message' => $this->upload->display_errors());
				}
				else
			   {
				$ajax_data['image3'] = $this->upload->data('file_name');
				}
				if ($this->loginmodel->add($ajax_data)) 
        		{
						$data = array('res' => "success", 'message' => "Data added successfully");
				} else 
         		{
						$data = array('res' => "error", 'message' => "Failed to add data");
				}
				
		}
		echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
  }

  public function editdata()
	{
		if ($this->input->is_ajax_request()) {

			$edit_id = $this->input->get('edit_id');

			if ($post = $this->loginmodel->edit($edit_id)) {
				$data = array('res' => "success", 'post' => $post);
			} else {
				$data = array('res' => "error", 'message' => "Failed to fetch data");
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

  public function updatedata()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('descr', 'descr', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('res' => "error", 'message' => validation_errors());
			} else {
				if (isset($_FILES["edit_img"]["name"])) {
					$config['upload_path'] = './upload/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '10000';
					// $config['max_width'] = '1024';
					// $config['max_height'] = '768';
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload("edit_img")) {
						$data = array('res' => "error", 'message' => $this->upload->display_errors());
					} else {
						$edit_id = $this->input->post('edit_id');
						if ($post = $this->loginmodel->edit($edit_id)) {
							unlink('./upload/' . $post->image);
							$ajax_data['image'] = $this->upload->data('file_name');
						}
					}
				}
				if (isset($_FILES["edit_img2"]["name"])) {
					$config['upload_path'] = './upload/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '10000';
					// $config['max_width'] = '1024';
					// $config['max_height'] = '768';
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload("edit_img2")) {
						$data = array('res' => "error", 'message' => $this->upload->display_errors());
					} else {
						$edit_id = $this->input->post('edit_id');
						if ($post = $this->loginmodel->edit($edit_id)) {
							unlink('./upload/' . $post->image2);
							$ajax_data['image2'] = $this->upload->data('file_name');
						}
					}
				}
				if (isset($_FILES["edit_img3"]["name"])) {
					$config['upload_path'] = './upload/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '10000';
					// $config['max_width'] = '1024';
					// $config['max_height'] = '768';
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload("edit_img3")) {
						$data = array('res' => "error", 'message' => $this->upload->display_errors());
					} else {
						$edit_id = $this->input->post('edit_id');
						if ($post = $this->loginmodel->edit($edit_id)) {
							unlink('./upload/' . $post->image3);
							$ajax_data['image3'] = $this->upload->data('file_name');
						}
					}
				}
				$id = $this->input->post('edit_id');
				$ajax_data['name'] = $this->input->post('name');
				$ajax_data['price'] = $this->input->post('price');
				$ajax_data['descr'] = $this->input->post('descr');
				if ($this->loginmodel->update($id, $ajax_data)) {
					$data = array('res' => "success", 'message' => "Data update successfully");
				} else {
					$data = array('res' => "error", 'message' => "Failed to update data");
				}
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

  public function deletedata()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			$post = $this->loginmodel->edit($del_id);

			unlink('./upload/' . $post->image);
			unlink('./upload/' . $post->image2);
			unlink('./upload/' . $post->image3);

			if ($this->loginmodel->delete($del_id)) {
				$data = array('res' => "success", 'message' => "Data delete successfully");
			} else {
				$data = array('res' => "error", 'message' => "Delete query errors");
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

  public function updatestatus()
  {
    if ($this->input->is_ajax_request()) {
      
      $id = $this->input->post('id');
      $stat = json_decode($_POST['stat']);
      if ($this->loginmodel->updatestat($stat,$id)) {
				$data = array('res' => "success", 'post' => $stat,$id);
			} else {
				$data = array('res' => "error", 'message' => "Failed to fetch data");
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
  }

  // banner data
  public function banners()
    {
		$this->load->view('admin/header');
      $this->load->view('admin/sidebar');
      $this->load->view('admin/banners_page');
    }
    public function addbanner()
    {
		$this->load->view('admin/header');
      $this->load->view('admin/sidebar');
      $this->load->view('admin/addbanner_page');
	  $this->load->view('admin/footer');
    }

  public function addbannerdata()
  {
	if ($this->input->is_ajax_request()) {
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('descr', 'descr', 'required');

 	 $data=array();
 	 if ($this->form_validation->run() == FALSE) 
  		{
			$data = array('res' => "error", 'message' => validation_errors());
		} 
  		else 
 		{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '10000';
			// $config['max_width'] = '1024';
			// $config['max_height'] = '768';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload("image")) 
				{
				$data = array('res' => "error", 'message' => $this->upload->display_errors());
			}
			else
				{
				$ajax_data = $this->input->post();
				$ajax_data['image'] = $this->upload->data('file_name');
				$ajax_data['status'] = 1;
			}
			if ($this->loginmodel->addbanner($ajax_data)) 
			{
					$data = array('res' => "success", 'message' => "Data added successfully");
			} else 
			 {
					$data = array('res' => "error", 'message' => "Failed to add data");
			}
			
		}
		echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
  }

  public function fetchbannerdata()
  {
      $list=$this->loginmodel->blist();
	  $nested_data=array();
	  $data=array();
      foreach ($list as $l) {
        $nested_data['name']=trim($l->name);
		$nested_data['image']='<img src="'.base_url().'/upload/'.$l->image.'" width="150" height="100" />';
		$nested_data['descr']=trim($l->descr);
		$checked="";if($l->status==1)$checked="checked";
		$nested_data['status']=' <label class="switch"> 
		<input id="status" type="checkbox" '.$checked.'
		onchange="javascript:statchange('.$l->id.',this.checked);">
		<span class="slider"></span> </label>';
		$nested_data['action']='<a href="#" id="edit" class="btn btn-sm btn-outline-info" value="'.$l->id.'"><i class="fas fa-edit"></i></a>
		<a href="#" id="delete" class="btn btn-sm btn-outline-danger" value="'.$l->id.'"><i class="fas fa-trash-alt"></i></a>';
		$data[]=$nested_data;
      }
      echo json_encode($data);
  }

  public function editbannerdata()
  {
	  if ($this->input->is_ajax_request()) {

		  $edit_id = $this->input->get('edit_id');

		  if ($post = $this->loginmodel->editbanner($edit_id)) {
			  $data = array('res' => "success", 'post' => $post);
		  } else {
			  $data = array('res' => "error", 'message' => "Failed to fetch data");
		  }

		  echo json_encode($data);
	  } else {
		  echo "No direct script access allowed";
	  }
  }

  public function updatebannerdata()
  {
	  if ($this->input->is_ajax_request()) {
		  $this->form_validation->set_rules('name', 'name', 'required');
		  $this->form_validation->set_rules('descr', 'descr', 'required');

		  if ($this->form_validation->run() == FALSE) {
			  $data = array('res' => "error", 'message' => validation_errors());
		  } else {
			  if (isset($_FILES["edit_img"]["name"])) {
				  $config['upload_path'] = './upload/';
				  $config['allowed_types'] = 'gif|jpg|png';
				  $config['max_size']     = '10000';
				  // $config['max_width'] = '1024';
				  // $config['max_height'] = '768';
				  $this->load->library('upload', $config);

				  if (!$this->upload->do_upload("edit_img")) {
					  $data = array('res' => "error", 'message' => $this->upload->display_errors());
				  } else {
					  $edit_id = $this->input->post('edit_id');
					  if ($post = $this->loginmodel->editbanner($edit_id)) {
						  unlink('./upload/' . $post->image);
						  $ajax_data['image'] = $this->upload->data('file_name');
					  }
				  }
			  }
			  $id = $this->input->post('edit_id');
			  $ajax_data['name'] = $this->input->post('name');
			  $ajax_data['descr'] = $this->input->post('descr');
			  if ($this->loginmodel->updatebanner($id, $ajax_data)) {
				  $data = array('res' => "success", 'message' => "Data update successfully");
			  } else {
				  $data = array('res' => "error", 'message' => "Failed to update data");
			  }
		  }
		  echo json_encode($data);
	  } else {
		  echo "No direct script access allowed";
	  }
  }

  public function deletebannerdata()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			$post = $this->loginmodel->editbanner($del_id);

			unlink('./upload/' . $post->image);

			if ($this->loginmodel->deletebanner($del_id)) {
				$data = array('res' => "success", 'message' => "Data delete successfully");
			} else {
				$data = array('res' => "error", 'message' => "Delete query errors");
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function updatebannerstatus()
	{
	  if ($this->input->is_ajax_request()) {
		
		$id = $this->input->post('id');
		$stat = json_decode($_POST['stat']);
		if ($this->loginmodel->updatebannerstat($stat,$id)) {
				  $data = array('res' => "success", 'post' => $stat,$id);
			  } else {
				  $data = array('res' => "error", 'message' => "Failed to fetch data");
			  }
  
			  echo json_encode($data);
		  } else {
			  echo "No direct script access allowed";
		  }
	}

}
?>