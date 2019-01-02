<?php
class Cart extends MX_Controller 
{

function __construct() {
    parent::__construct();
}

function _draw_add_to_cart($item_id)
{
    // fetch the color option for this item
    $submitted_color=$this->input->post('submitted_color');
    if($submitted_color=="")
    {
        $color_options['']="select...";
    }
    $this->load->module('store_item_color');
    $query=$this->store_item_color->get_where_custom('item_id',$item_id);
    $data['num_colors']=$query->num_rows();
    foreach($query->result()  as $row)
    {
        $color_options[$row->id]=$row->color;
    }
 
    $submitted_size=$this->input->post('submitted_size');
    if($submitted_size=="")
    {
        $size_options['']="select...";
    }
    $this->load->module('store_item_sizes');
    $query=$this->store_item_sizes->get_where_custom('item_id',$item_id);
    $data['num_sizes']=$query->num_rows();
    foreach($query->result()  as $row)
    {
        $size_options[$row->id]=$row->size;
    }
    $data['submitted_color']=$submitted_color;
    $data['submitted_size']=$submitted_size;
    $data['item_id']=$item_id;
    $data['color_options']=$color_options;
    $data['size_options']=$size_options;
    $this->load->view('add_to_cart',$data);
}

}