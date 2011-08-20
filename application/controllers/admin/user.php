<?php
class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('user_model');
        $this->load->library(array('table','pagination'));
        $this->load->helper('url');
    }
    
    public function index() {
        $this->lista();
    }
    
    public function lista() {
        // configuração do pagination
        $config['base_url'] = base_url().'index.php/user/lista/';
        $config['total_rows'] = $this->user_model->count_users();
        $config['per_page'] = '20';
        $config['full_tag_open'] = '<p class="pagination">';
        $config['full_tag_close'] = '</p>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $users = $this->user_model->get_all_users($config['per_page'],$this->uri->segment(3,0));
        
        $this->pagination->initialize($config);
        
        $data['users'] = $users;
        $data['titulo'] = "Usuarios";
        
        $this->load->view('admin/user/index',$data);
    }
    
    public function view() {
        $user = $this->user_model->get_by_id($this->uri->segment(3));
        $data['username']  = $user;
        $this->load->view('users',$data);
    }
    
    public function edit() {
        // editar um usuario
    }
    
    public function kill() {
        // excluir um usuario
    }
    
    public function create() {
        // excluir um usuario
    }
}

/* Location: ./application/controllers/admin/user.php */
