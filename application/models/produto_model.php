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
        $select = 'p.id as id,';
        $select.= 'p.nome as nome,';
        $select.= 'p.estoque as estoque,';
        $select.= 'p.valor as valor,';
        $select.= 'p.data_cadastro as data,';
        $select.= 'p.foto as foto,';
        $select.= 'p.usuario_id as usuario,';
        $select.= 'c.categoria as categoria';
        $this->db->select($select);
        $this->db->from('produtos p');
        $this->db->join('categorias c','p.categoria_id = c.id');
        $this->db->limit($qtde,$offset);
        $res = $this->db->get();
        return $res->result();
    }

    public function count_categories() {
        $this->db->where("categoria_id != ''");
        return $this->db->count_all_results('produtos');
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
    
    public function delete($id) {
        
    }
    
    public function update($id) {
        
    }
}
/* fim do arquivo models/produto_model.php */