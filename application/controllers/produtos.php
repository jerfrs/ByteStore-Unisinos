<?php
class Produtos extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('produto_model');
        $this->load->library(array('table','pagination'));
        $this->load->helper('url');
    }
    
    public function index() {
        $this->lista();
    }
    
    public function lista() {
        // configuração do pagination
        $config['base_url'] = base_url().'index.php/produtos/lista/';
        $config['total_rows'] = $this->produto_model->count_categories();
        $config['per_page'] = '5';
        $config['full_tag_open'] = '<p class="pagination">';
        $config['full_tag_close'] = '</p>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        
        $produtos = $this->produto_model->get_products($config['per_page'],$this->uri->segment(3,0));
        
        $this->pagination->initialize($config);
        
        $data['produtos'] = $produtos;
        $data['titulo'] = "Produtos";
        
        $this->load->view('produtos/index',$data);
    }
    
    public function view() {
        $produto = $this->produto_model->get_by_id($this->uri->segment(3));
        $data['produto']  = $produto;
        $data['categoria'] = $this->produto_model->get_category($produto['categoria_id']);
        $this->load->view('produtos/produto',$data);
    }
    
    public function edit() {
        // editar um produto
    }
    
    public function kill() {
        // excluir um produto
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
