<?php
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('produto_model');
        $this->load->library(array('table','pagination'));
        $this->load->helper('url');
    }
    
    public function index() {
        // configuração do pagination
        $config['base_url'] = base_url().'index.php/home/index/';
        $config['total_rows'] = $this->db->count_all('produtos');
        $config['per_page'] = '5';
        $config['full_tag_open'] = '<p class="pagination">';
        $config['full_tag_close'] = '</p>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        
        $this->pagination->initialize($config);
                
        $produtos = $this->produto_model->get_products($config['per_page'],$this->uri->segment(3,0));
        
        $templ = array('table_open'=>'<table border="1" cellspacing="1">');
        $this->table->set_template($templ);
        $this->table->set_empty('--');
        
        $campos = $this->produto_model->get_fields();
        
        $this->table->set_heading($campos);
        
        $data['table_produtos'] = $this->table->generate($produtos);
        $data['titulo'] = "Produtos";
        
        $this->load->view('home/index',$data);
        
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
