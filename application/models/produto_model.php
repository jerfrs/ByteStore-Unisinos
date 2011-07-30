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
    
    public function get_by_id($id) {
        $res = $this->db->get_where('produtos',array('id'=>$id));
        return $res->row_array();
    }
    
    public function get_categories() {
        $this->db->order_by('descricao','asc');
        $res = $this->db->get('categorias');
        return $res->result_array();
    }
    
    public function get_category($id) {
        $res = $this->db->get_where('categorias',array('id'=>$id));
        return $res->row_array();
    }
}

?>
