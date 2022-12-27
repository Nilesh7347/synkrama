<?php
class User_Model extends CI_Model{
    function validate($email,$password){
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $result = $this->db->get('users',1);
        return $result;
    }


    function set_user($data)
    {
       $result = $this->db->insert('users', $data);        
       if($result){
            return true;
       } else {
        return false;
       }
       
    }

    function getDatafun($id){
        $this->db->where('id',$id);
        $result = $this->db->get('users');
        return $result->result();
         
    }

    function update_dealer_data($id,$data){
            $this->db->where('id', $id);
            $result = $this->db->update('users', $data);
            if($result){
                return true;
           } else {
            return false;
           }
    }

    function dealerList(){
        $this->db->where('user_type', 2);
        $list=$this->db->get('users');
		return $list->result();
    }

    function update_dealer(){
        $id=$this->input->post('id');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $zip_code=$this->input->post('zip_code');
 
        $this->db->set('city', $city);
        $this->db->set('state', $state);
        $this->db->set('zip_code', $zip_code);
        $this->db->where('id', $id);
        $result=$this->db->update('users');
        return $result;
    }

    function filter_Dealer_zipcode(){
        $zip_code = $this->input->post('zip_code');
        // print_r($zip_code);
        // die;
        // return $this->db->select('*')->from('users')->where("zip_code LIKE '%$zip_code%'")->where('user_type', 2)->get()->result_array();

        $this->db->like('zip_code', $zip_code, 'both');
        $this->db->where('user_type', 2);
        $list=$this->db->get('users');
		return $list->result_array(); 
    }
}