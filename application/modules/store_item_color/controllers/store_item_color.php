<?php
class Store_item_color extends MX_Controller 
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
    $color=trim($this->input->post('color',TRUE));
    if($submit=="Finished")
    {

         redirect('store_items/create/'.$update_id);
    }
    elseif ($submit=="Submit") {
        if($color!="")
        {
            $data['item_id']=$update_id;
            $data['color']=$color;
            $this->_insert($data);
       $flash_msg="New color option was successfully added";
    $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
    redirect('store_item_color/update/'.$update_id);     
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
        $data['headline']="Update Item color";   
        $data['update_id']=$update_id;  
        $data['flash']=$this->session->flashdata('item');   
        //$data['view_module']="store_items";
        $data['view_file'] = "update";
        $this->load->module('templates');
        $this->templates->admin($data);
            }

function get($order_by){
    $this->load->model('Mdl_item_color');
    $query = $this->Mdl_item_color->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('Mdl_item_color');
    $query = $this->Mdl_item_color->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('Mdl_item_color');
    $query = $this->Mdl_item_color->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('Mdl_item_color');
    $query = $this->Mdl_item_color->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('Mdl_item_color');
    $this->Mdl_item_color->_insert($data);
}

function _update($id, $data){
    $this->load->model('Mdl_item_color');
    $this->Mdl_item_color->_update($id, $data);
}

function _delete($id){
    $this->load->model('Mdl_item_color');
    $this->Mdl_item_color->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('Mdl_item_color');
    $count = $this->Mdl_item_color->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('Mdl_item_color');
    $max_id = $this->Mdl_item_color->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('Mdl_item_color');
    $query = $this->Mdl_item_color->_custom_query($mysql_query);
    return $query;
}

}