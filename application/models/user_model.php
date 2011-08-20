<?php
class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_users() {
        $res = $this->db->get('users'); 
        return $res->result_array(); // equivalente ao mysql_fetch_array()
    }
    
    public function count_users() {
        $this->db->where("id != ''");
        return $this->db->count_all_results('users');
    }
    
    public function get_fields() {
        return $this->db->list_fields('users');
    }
    
    public function get_by_id($id) {
        $res = $this->db->get_where('users',array('id'=>$id));
        return $res->row_array();
    }
      
    public function delete($id) {
        
    }
    
    public function update($id) {
        
    }
    
    public function insert() {
        
    }
}
/* fim do arquivo models/user_model.php */