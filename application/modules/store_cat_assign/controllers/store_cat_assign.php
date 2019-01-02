<?php
class Store_cat_assign extends MX_Controller 
{

    function __construct() {
    parent::__construct();
}


function update($item_id)
{
         // get an array of sub categories on the size
         $this->load->module('store_categories');
           $sub_categories=$this->store_categories->_get_all_sub_cats_for_dropdown(); 
         // get an array of all asigened categories
         $query=$this->get_where_custom('item_id',$item_id);
         $data['query']=$query;
         $data['num_rows']=$query->num_rows();
         foreach($query->result() as $row)
         {
            $cat_title=$this->store_categories->_get_cat_title($row->cat_id);
            $parent_cat_title=$this->store_categories->_get_parent_cat_title($row->cat_id);
             $assigned_categories[$row->cat_id]=$parent_cat_title." > ".$cat_title;
         }
         if(!isset($assigned_categories))
         {
            $assigned_categories="";
         }
         else{
            //item was assigned to be atleast one category
           $sub_categories= array_diff($sub_categories, $assigned_categories);
         }
         $data['options']=$sub_categories;
         $data['cat_id']=$this->input->post('cat_id',TRUE); 
        $data['headline']="Category Assign";   
        $data['item_id']=$item_id;  
        $data['flash']=$this->session->flashdata('item');   
        //$data['view_module']="store_items";
        $data['view_file'] = "update";
        $this->load->module('templates');
        $this->templates->admin($data);
}


function delete($update_id)
   {
            if(!is_numeric($update_id))
        {
            redirect('site_security/not_allowed');
        }

         $query=$this->get_where($update_id);
        foreach($query->result() as $row)
        {
            $item_id=$row->item_id;
        }
          
           
                $this->_delete($update_id);
             $flash_msg=" Options Was successfully deleted";
        $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);
        redirect('store_cat_assign/update/'.$item_id); 
            
  }

function submit($item_id)
{


  if(!is_numeric($item_id))
        {
            redirect('site_security/not_allowed');
        }
    $submit=$this->input->post('submit',TRUE);
    $cat_id=trim($this->input->post('cat_id',TRUE));
    if($submit=="Finished")
    {

         redirect('store_items/create/'.$item_id);
    }
    elseif ($submit=="Submit") {
        if($cat_id!="")
        {
            $data['item_id']=$item_id;
            $data['cat_id']=$cat_id;
            $this->_insert($data);
            $this->load->module('store_categories');
           $cat_title= $this->store_categories->_get_cat_title($cat_id);
       $flash_msg="The item was successfuly assign to the ".$cat_title." category";
    $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
    redirect('store_cat_assign/update/'.$item_id);     
        }
    }
} 




function get($order_by)
{
    $this->load->model('mdl_storecat_assign');
    $query = $this->mdl_storecat_assign->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_storecat_assign');
    $query = $this->mdl_storecat_assign->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('mdl_storecat_assign');
    $query = $this->mdl_storecat_assign->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_storecat_assign');
    $query = $this->mdl_storecat_assign->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('mdl_storecat_assign');
    $this->mdl_storecat_assign->_insert($data);
}

function _update($id, $data){
    $this->load->model('mdl_storecat_assign');
    $this->mdl_storecat_assign->_update($id, $data);
}

function _delete($id){
    $this->load->model('mdl_storecat_assign');
    $this->mdl_storecat_assign->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('mdl_storecat_assign');
    $count = $this->mdl_storecat_assign->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('mdl_storecat_assign');
    $max_id = $this->mdl_storecat_assign->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('mdl_storecat_assign');
    $query = $this->mdl_storecat_assign->_custom_query($mysql_query);
    return $query;
}

}