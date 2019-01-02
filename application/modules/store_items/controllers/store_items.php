<?php 

		class Store_items extends MX_Controller
		{
			function __construct()
			{
				parent::__construct();
			$this->load->library('form_validation');
			  $this->form_validation->CI =& $this;          
			}

			function view($update_id)
			{
				if(!is_numeric($update_id))
				{
					redirect('site_security/not_allowed');
				}

				//fetch data from database
				$data=$this->get_data_from_db($update_id);
                $data['flash']=$this->session->flashdata('item');	
				//$data['view_module']="store_items";
				$data['update_id']=$update_id;
				$data['view_file'] = "view";
				$this->load->module('templates');
				$this->templates->public_view($data);
			}

			function manage()
			{
				$data['query']=$this->get('item_title');
				$data['flash']=$this->session->flashdata('item');	
				//$data['view_module']="store_items";
				// $data['sort_this']=TRUE;
				$data['view_file'] = "manage";
				$this->load->module('templates');
				$this->templates->admin($data);
			}

			function _generate_thumbnail($file_name)
			{
			$config['image_library'] = 'gd2';
			$config['source_image'] = './big_pics/'.$file_name;
			$config['new_image'] = './small_pics/'.$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 200;
			$config['height']       = 200;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			}

			// delete item 
			function deleteconf($update_id)
			{
				if(!is_numeric($update_id))
				{
					redirect('site_security/not_allowed');
				}

				$data['headline']="Delete Item";
                $data['flash']=$this->session->flashdata('item');	
				//$data['view_module']="store_items";
				$data['update_id']=$update_id;
				$data['view_file'] = "deleteconf";
				$this->load->module('templates');
				$this->templates->admin($data);
			}

				function _process_delete($update_id)
				{
					//attempt to delete item color
						$this->load->module('store_item_color');
						$this->store_item_color->_delete_for_item($update_id);
					//attempt to delete item sizes
						$this->load->module('store_item_sizes');
						$this->store_item_sizes->_delete_for_item($update_id);		
					
					$data=$this->get_data_from_db($update_id);
				$big_pic=$data['big_pic'];
				$small_pic=$data['small_pic'];
                $big_pic_path  = './big_pics/'.$big_pic;
                $small_pic_path  = './small_pics/'.$small_pic;

                // removing the file from the folder
                if(file_exists($big_pic_path))
                {
                	unlink($big_pic_path);
                }
                if(file_exists($small_pic_path))
                {
                	unlink($small_pic_path);
                }

					//delete the item record from the store items

					$this->_delete($update_id);					
				}

				function delete($update_id)
				{
					if(!is_numeric($update_id))
				{
					redirect('site_security/not_allowed');
				}
					$submit=$this->input->post('submit',TRUE);
					if($submit=="Cancel")
					{
						redirect('store_items/create'.$update_id);
					}
					elseif ($submit=="Yes- Delete Item") {
						$this->_process_delete($update_id);
					 $flash_msg=" Item Was successfully deleted";
				$value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
				$this->session->set_flashdata('item', $value);
                redirect('store_items/manage');	
					}
				}
				// delete image function
			function delete_image($update_id)
			{
				if(!is_numeric($update_id))
				{
					redirect('site_security/not_allowed');
				}

				$data=$this->get_data_from_db($update_id);
				$big_pic=$data['big_pic'];
				$small_pic=$data['small_pic'];
                $big_pic_path  = './big_pics/'.$big_pic;
                $small_pic_path  = './small_pics/'.$small_pic;

                // removing the file from the folder
                if(file_exists($big_pic_path))
                {
                	unlink($big_pic_path);
                }
                if(file_exists($small_pic_path))
                {
                	unlink($small_pic_path);
                }

                // update the database
                unset($data);
                $data['big_pic']="";
                $data['small_pic']="";
                $this->_update($update_id,$data);
                $flash_msg="Image Item Was successfully deleted";
				$value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
				$this->session->set_flashdata('item', $value);
                redirect('store_items/create/'.$update_id);
			}

			 function do_upload($update_id)
        	{
        		if(!is_numeric($update_id))
				{
					redirect('site_security/not_allowed');
				}
				$submit=$this->input->post('submit',TRUE);
				if($submit=="Cancel")
				{
					redirect('store_items/create/'.$update_id);
				}	
                $config['upload_path']          = './big_pics/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1080;

                $this->load->library('upload', $config);
                $this->load->library('session');	
                if ( ! $this->upload->do_upload('userfile'))
                {
                		$data['update_id']=$update_id;
                        $data['error'] = array('error' => $this->upload->display_errors("<p style='color:red;font-weight:bold'>","</p>"));
                        $data['headline']="Upload Error";
                        $data['flash']=$this->session->flashdata('item');	
						//$data['view_module']="store_items";
						$data['view_file'] = "upload_image";
						$this->load->module('templates');
						$this->templates->admin($data);	
                        	
                }
                else
                {

                        $data = array('upload_data' => $this->upload->data());
                        $upload_data=$data['upload_data'];
                        $file_name=$upload_data['file_name'];
                        $this->_generate_thumbnail($file_name);

                        	// update the database
                        $update_data['big_pic']=$file_name;
                        $update_data['small_pic']=$file_name;
                        $this->_update($update_id,$update_data);
                		$data['headline']="Upload Success";
                        $data['flash']=$this->session->flashdata('item');	
						//$data['view_module']="store_items";
						$data['update_id']=$update_id;
						$data['view_file'] = "upload_success";
						$this->load->module('templates');
						$this->templates->admin($data);
                        // $this->load->view('upload_success', $data);
                }
        	}

			// image work here
			function upload_image($update_id)
			{
				if(!is_numeric($update_id))
				{
					redirect('site_security/not_allowed');
				}
					$this->load->library('session');
					$update_id=$this->uri->segment(3);
				$data['headline']="Upload Image";	
				$data['update_id']=$update_id;	
				$data['flash']=$this->session->flashdata('item');	
				//$data['view_module']="store_items";
				$data['view_file'] = "upload_image";
				$this->load->module('templates');
				$this->templates->admin($data);
			}

			function create()
			{
					$this->load->library('session');
					$update_id=$this->uri->segment(3);
					$submit=$this->input->post('submit',TRUE);
					if($submit=="Submit")
					{
						// process the form
						$this->load->library('form_validation');
						$this->form_validation->set_rules('item_title', 'Item Title','required|max_length[240]|callback_item_check');
						$this->form_validation->set_rules('item_price', 'Item Price','required|numeric');
						$this->form_validation->set_rules('was_price', 'Was Price','numeric');
						$this->form_validation->set_rules('status', 'Status','required|numeric');
						$this->form_validation->set_rules('item_description', 'Item Description','required');

						if($this->form_validation->run($this)==TRUE)
						{
							$data=$this->fetch_data_from_post();

							$data['item_url']=url_title($data['item_title']);

							if(is_numeric($update_id))
							{
							$this->_update($update_id,$data);
							$flash_msg="All Item Details are Successfuly Updated";
							$value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
							$this->session->set_flashdata('item', $value);
							redirect('store_items/create/'.$update_id);		
							}
							else{
								$this->_insert($data);
								$update_id=$this->get_max();// get the ID of New Item mean fetch a maximum id from a table
								$flash_msg="Item  Successfuly Added";
							$value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
							$this->session->set_flashdata('item', $value);
							redirect('store_items/create/'.$update_id);
							}
						}
						else
						{

						}
					}
					
					if(is_numeric($update_id) && ($submit!="Submit"))
					{
						$data=$this->get_data_from_db($update_id);
					}
					else{
						$data=$this->fetch_data_from_post();
						// $data['big_pics']="";
					}


					if(!is_numeric($update_id))
					{
						$data['headline']="Add New Item";
					}
					else{
						$data['headline']="Update Item Details";
					}
				// $data['big_pic']="";	
				$data['update_id']=$update_id;	
				$data['flash']=$this->session->flashdata('item');	
				//$data['view_module']="store_items";
				$data['view_file'] = "create";
				$this->load->module('templates');
				$this->templates->admin($data);
			}

			function fetch_data_from_post()
			{
				$data['item_title']=$this->input->post('item_title',TRUE);
				$data['item_price']=$this->input->post('item_price',TRUE);
				$data['was_price']=$this->input->post('was_price',TRUE);
				$data['item_description']=$this->input->post('item_description',TRUE);
				$data['status']=$this->input->post('status',TRUE);

				return $data;
			}
			function get_data_from_db($update_id)
			{
					if(!is_numeric($update_id))
					{
						redirect('site_security/not_allowed');
					}

				$query=$this->get_where($update_id);
				foreach($query->result() as $row)
				{
					$data['item_title']=$row->item_title;
					$data['item_url']=$row->item_url;
					$data['item_price']=$row->item_price;
					$data['item_description']=$row->item_description;
					$data['big_pic']=$row->big_pic;
					$data['small_pic']=$row->small_pic;
					$data['was_price']=$row->was_price;
					$data['status']=$row->status;
				}
				if(!isset($data))
				{
					$data="";
				}
				return $data;
			}
// all db function stuff

	function get($order_by){
    $this->load->model('item_model');
    $query = $this->item_model->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('item_model');
    $query = $this->item_model->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('item_model');
    $query = $this->item_model->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('item_model');
    $query = $this->item_model->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('item_model');
    $this->item_model->_insert($data);
}

function _update($id, $data){
    $this->load->model('item_model');
    $this->item_model->_update($id, $data);
}

function _delete($id){
    $this->load->model('item_model');
    $this->item_model->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('item_model');
    $count = $this->item_model->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('item_model');
    $max_id = $this->item_model->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('item_model');
    $query = $this->item_model->_custom_query($mysql_query);
    return $query;
}


 function item_check($str)
        {
        	$item_url=url_title($str);	
        	$sql_query="SELECT * FROM store_items WHERE item_title='$str' AND item_url='$item_url'";
        	$update_id=$this->uri->segment(3);
        	if(is_numeric($update_id))
        	{
        		// this is update
        		$sql_query.=" AND id!=$update_id";
        	}
        	$query=$this->_custom_query($sql_query);
        	$num_rows=$query->num_rows();
            if ($num_rows>0)
            {
                    $this->form_validation->set_message('item_check', 'The Item Title that you submit is not availible');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
        }


		}

 ?>