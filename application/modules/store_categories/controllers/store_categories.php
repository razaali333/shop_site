<?php
class Store_categories extends MX_Controller 
{

function __construct() {
    parent::__construct();
}


function _get_parent_cat_title($update_id)
{
    $data=$this->get_data_from_db($update_id);
    $parent_cat_id=$data['parent_cat_id'];
    $parent_cat_title=$this->_get_cat_title($parent_cat_id);
    return $parent_cat_title;
}


function _get_all_sub_cats_for_dropdown()
{
    //NOTE: this get used on store_cat_assign
    $mysql_query="select * from store_categories where parent_cat_id !=0 order by parent_cat_id, cat_title";
    $query=$this->_custom_query($mysql_query);
    foreach($query->result() as $row)
    {
        $parent_cat_title=$this->_get_cat_title($row->parent_cat_id);
        $sub_categories[$row->id]=$parent_cat_title." > ".$row->cat_title;
    }
     if(!isset($sub_categories))
    {
        $sub_categories="";
    }

    return $sub_categories;

}


function sort()
{
    $number=$this->input->post('number',TRUE);
    for($i=1;$i<=$number;$i++)
    {
        $update_id=$_POST['order'.$i];
        $data['priority']=$i;
        $this->_update($update_id,$data);
    }
}

function _count_sub_cats($update_id)
{
    // return the number of sub categories beloning to this category
    $query=$this->get_where_custom('parent_cat_id',$update_id);
    $num_rows=$query->num_rows();
    return $num_rows;
}

function _get_cat_title($update_id)
{
    $data=$this->get_data_from_db($update_id);

    $cat_title=$data['cat_title'];
    return $cat_title;
}

function _draw_sortable_list($parent_cat_id)
{

   $mysql_query="select * from store_categories where parent_cat_id=$parent_cat_id order by priority";
    $data['query']=$this->_custom_query($mysql_query);
   $this->load->view('sortable_list',$data);
}

function manage()
            {
       
        $parent_cat_id=$this->uri->segment(3);
        if(!is_numeric($parent_cat_id))
        {
            $parent_cat_id=0;
        }
        $data['sort_this']=TRUE;
         $data['query']=$this->get_where_custom('parent_cat_id',$parent_cat_id);
        $data['flash']=$this->session->flashdata('item');   
        $data['parent_cat_id']=$parent_cat_id;
        //$data['view_module']="store_categories";
        $data['view_file'] = "manage";
        $this->load->module('templates');
        $this->templates->admin($data);
            }

        function _get_dropdown_options($update_id)
        {
            if(!is_numeric($update_id))
            {
                $update_id=0;
            }
            $options['']="Please Select...";
            // build an array of all the parent category
            $mysql_query="select * from store_categories where parent_cat_id=0 and id !=$update_id";
            $query=$this->_custom_query($mysql_query);
            foreach($query->result() as $row)
            {
                $options[$row->id]=$row->cat_title;
            }
            return $options;
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
                        $this->form_validation->set_rules('cat_title', 'Category Title','required');
                        

                        if($this->form_validation->run($this)==TRUE)
                        {
                            $data=$this->fetch_data_from_post();


                            if(is_numeric($update_id))
                            {
                            $this->_update($update_id,$data);
                            $flash_msg=" Category Details are Successfuly Updated";
                            $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                            $this->session->set_flashdata('item', $value);
                            redirect('store_categories/create/'.$update_id);     
                            }
                            else{
                                $this->_insert($data);
                                $update_id=$this->get_max();// get the ID of New Category mean fetch a maximum id from a table
                                $flash_msg="Category  Successfuly Added";
                            $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                            $this->session->set_flashdata('item', $value);
                            redirect('store_categories/create/'.$update_id);
                            }
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
                        $data['headline']="Add New Category";
                    }
                    else{
                        $data['headline']="Update Category Details";
                    }
                // $data['big_pic']=""; 
                 $data['options']=$this->_get_dropdown_options($update_id); 
                 $data['num_dropdown_options']=count($data['options']);  
                $data['update_id']=$update_id;  
                $data['flash']=$this->session->flashdata('item');   
                //$data['view_module']="store_categories";
                $data['view_file'] = "create";
                $this->load->module('templates');
                $this->templates->admin($data);
            }

                function fetch_data_from_post()
            {
                $data['cat_title']=$this->input->post('cat_title',TRUE);
                $data['parent_cat_id']=$this->input->post('parent_cat_id',TRUE);
              
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
                    $data['cat_title']=$row->cat_title;
                    $data['parent_cat_id']=$row->parent_cat_id;
                   
                }
                if(!isset($data))
                {
                    $data="";
                }
                return $data;
            }




function get($order_by){
    $this->load->model('Mdl_store_categories');
    $query = $this->Mdl_store_categories->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('Mdl_store_categories');
    $query = $this->Mdl_store_categories->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('Mdl_store_categories');
    $query = $this->Mdl_store_categories->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('Mdl_store_categories');
    $query = $this->Mdl_store_categories->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('Mdl_store_categories');
    $this->Mdl_store_categories->_insert($data);
}

function _update($id, $data){
    $this->load->model('Mdl_store_categories');
    $this->Mdl_store_categories->_update($id, $data);
}

function _delete($id){
    $this->load->model('Mdl_store_categories');
    $this->Mdl_store_categories->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('Mdl_store_categories');
    $count = $this->Mdl_store_categories->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('Mdl_store_categories');
    $max_id = $this->Mdl_store_categories->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('Mdl_store_categories');
    $query = $this->Mdl_store_categories->_custom_query($mysql_query);
    return $query;
}

}