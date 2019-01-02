<?php
class Store_accounts extends MX_Controller 
{

function __construct() {
    parent::__construct();
}

function update_pword()
            {
        $this->load->library('session');
        $update_id=$this->uri->segment(3);
        $submit=$this->input->post('submit',TRUE);
       if(!is_numeric($update_id))
       {
        redirect('store_accounts/manage');
       }
       else if($submit=="Cancel")
       {
        redirect('store_accounts/create'.$update_id);
       }
        if($submit=="Submit")
        {
            // process the form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pword', 'Password','required|min_length[7]|max_length[15]');
            $this->form_validation->set_rules('repeat_pword', 'Repeat Password','required|matches[pword]');

            if($this->form_validation->run($this)==TRUE)
            {
                $pword=$this->input->post('pword',TRUE);
                $this->load->module('site_security');
                $data['pword']=$this->site_security->_hash_string($pword);
                               $this->_update($update_id,$data);
                $flash_msg=" Account Password was Successfuly Updated";
                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_accounts/create/'.$update_id);     
                               
            }
            else
            {

            }
        }
        
        
            $data['headline']="Update Account Password";
            // $data['big_pic']=""; 
    $data['update_id']=$update_id;  
    $data['flash']=$this->session->flashdata('item');   
    //$data['view_module']="store_items";
    $data['view_file'] = "update_pword";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function manage()
            {
                $data['query']=$this->get('lastname');
                $data['flash']=$this->session->flashdata('Account');   
                //$data['view_module']="store_Accounts";

                $data['view_file'] = "manage";
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
            $this->form_validation->set_rules('firstname', 'First Name','required');
            $this->form_validation->set_rules('lastname','Lastname','required');
            $this->form_validation->set_rules('company','Company','required');
            $this->form_validation->set_rules('address1','Address1','required');

            if($this->form_validation->run($this)==TRUE)
            {
                $data=$this->fetch_data_from_post();

                if(is_numeric($update_id))
                {
                $this->_update($update_id,$data);
                $flash_msg="All Account Details are Successfuly Updated";
                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_accounts/create/'.$update_id);     
                }
                else{
                    $data['date_made']=time();
                    $this->_insert($data);
                    $update_id=$this->get_max();// get the ID of New Account mean fetch a maximum id from a table
                    $flash_msg="Account  Successfuly Added";
                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_accounts/create/'.$update_id);
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
            $data['headline']="Add New Account";
        }
        else{
            $data['headline']="Update Account Details";
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
            $data['firstname']=$this->input->post('firstname',TRUE);
            $data['lastname']=$this->input->post('lastname',TRUE);
            $data['company']=$this->input->post('company',TRUE);
            $data['address1']=$this->input->post('address1',TRUE);
            $data['address2']=$this->input->post('address2',TRUE);
            $data['town']=$this->input->post('town',TRUE);
            $data['country']=$this->input->post('country',TRUE);
            $data['postcode']=$this->input->post('postcode',TRUE);
            $data['telnum']=$this->input->post('telnum',TRUE);
            $data['email']=$this->input->post('email',TRUE);

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
         $data['firstname']=$row->firstname;
        $data['lastname']=$row->lastname;
        $data['company']=$row->company;
        $data['address1']=$row->address1;
        $data['address2']=$row->address2;
        $data['town']=$row->town;
        $data['country']=$row->country;
        $data['postcode']=$row->postcode;
        $data['telnum']=$row->telnum;
        $data['email']=$row->email;
        $data['date_made']=$row->date_made;

    }
    if(!isset($data))
    {
        $data="";
    }
    return $data;
            }

function autogen()
{
    
    $mysql_query="show COLUMNS FROM store_accounts";
    $query=$this->_custom_query($mysql_query);
    /*foreach($query->result() as $row)
    {
        $column_name=$row->Field;
        if($column_name!="id")
        {

        echo '$data[\''.$column_name.'\']=$row->'.$column_name.';<br>';
        }

    }
    echo "<hr>";
    foreach($query->result() as $row)
    {
        $column_name=$row->Field;
        if($column_name!="id")
        {

        echo '$this->form_validation->set_rules(\''.$column_name.'\',\''.$column_name.'\',required);<br>';
        // $this->form_validation->set_rules('firstname', 'First Name','required');
        }

    }
/*
    foreach($query->result() as $row)
    {
        $column_name=$row->Field;
        if($column_name!="id")
        {
    $var ='<div class="control-group">
         <label class="control-label" for="typeahead">'.ucfirst($column_name).' </label>
          <div class="controls">
            <input type="text" class="span5" id="typeahead" name="'.$column_name.'" value="<?= $'.$column_name.';?>">
          </div>
        </div>';
        echo "<br> <br>";

        echo htmlentities($var);
}
}
*/
}











function get($order_by){
    $this->load->model('Mdl_store_accounts');
    $query = $this->Mdl_store_accounts->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('Mdl_store_accounts');
    $query = $this->Mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id){
    $this->load->model('Mdl_store_accounts');
    $query = $this->Mdl_store_accounts->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('Mdl_store_accounts');
    $query = $this->Mdl_store_accounts->get_where_custom($col, $value);
    return $query;
}

function _insert($data){
    $this->load->model('Mdl_store_accounts');
    $this->Mdl_store_accounts->_insert($data);
}

function _update($id, $data){
    $this->load->model('Mdl_store_accounts');
    $this->Mdl_store_accounts->_update($id, $data);
}

function _delete($id){
    $this->load->model('Mdl_store_accounts');
    $this->Mdl_store_accounts->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('Mdl_store_accounts');
    $count = $this->Mdl_store_accounts->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('Mdl_store_accounts');
    $max_id = $this->Mdl_store_accounts->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('Mdl_store_accounts');
    $query = $this->Mdl_store_accounts->_custom_query($mysql_query);
    return $query;
}

}