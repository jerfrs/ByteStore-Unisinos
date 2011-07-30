<?php
class Produto_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_products() {
        $res = $this->db->get('produtos'); // equivalente ao mysql_query()
        //return $res->result(); // equivalente ao mysql_fetch_object()
        return $res->result_array(); // equivalente ao mysql_fetch_array()
    }
    
    public function get_products($qtde,$offset) {
        $res = $this->db->get('produtos',$qtde,$offset);
        return $res->result_array();
    }

    public function get_fields() {
        return $this->db->list_fields('produtos');
    }
}

?>
