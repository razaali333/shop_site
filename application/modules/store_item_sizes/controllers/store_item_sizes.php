<?php
class Store_item_sizes extends MX_Controller 
{

function __construct() {
    parent::__construct();

}

function submit($update_id)
{


  if(!is_numeric($update_id))
        {
            redirect('site_security/not_allowed');
        }
    $submit=$this->input->post('submit',TRUE);
    $sizes=trim($this->input->post('sizes',TRUE));
    if($submit=="Finished")
    {

         redirect('store_items/create/'.$update_id);
    }
    elseif ($submit=="Submit") {
        if($sizes!="")
        {
            $data['item_id']=$update_id;
            $data['size']=$sizes;
            $this->_insert($data);
       $flash_msg="New sizes option was successfully added";
    $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
    redirect('store_item_sizes/update/'.$update_id);     
        }
    }
}

function update($update_id)
            {
           
        if(!is_numeric($update_id))
        {
            redirect('site_security/not_allowed');
        }
        $this->load->library('session');
        $update_id=$this->uri->segment(3);
        $data['headline']="Update Item sizes";   
        $data['update_id']=$update_id;  
        $data['flash']=$this->session->flashdata('item');   
        //$data['view_module']="store_items";
        $data['view_file'] = "update";
        $this->load->module('templates');
        $this->templates->admin($data);
            }

function get($order_by){
    $this->load->model('Mdl_item_sizes');
    $query = $this->Mdl_item_sizes->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('Mdl_item_sizes');
    $query = $this->Mdl_item_sizes->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('Mdl_item_sizes');
    $query = $this->Mdl_item_sizes->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('Mdl_item_sizes');
    $query = $this->Mdl_item_sizes->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('Mdl_item_sizes');
    $this->Mdl_item_sizes->_insert($data);
}

function _update($id, $data){
    $this->load->model('Mdl_item_sizes');
    $this->Mdl_item_sizes->_update($id, $data);
}

function _delete($id){
    $this->load->model('Mdl_item_sizes');
    $this->Mdl_item_sizes->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('Mdl_item_sizes');
    $count = $this->Mdl_item_sizes->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('Mdl_item_sizes');
    $max_id = $this->Mdl_item_sizes->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('Mdl_item_sizes');
    $query = $this->Mdl_item_sizes->_custom_query($mysql_query);
    return $query;
}

}