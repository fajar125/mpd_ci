<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_target_vs_realisasi extends CI_Controller
{

    function __construct() {
        parent::__construct();

        check_login();
        
    }

    public function index(){
        $this->load->view('template/styles');
        $this->load->view('template/scripts');
        $this->load->view('pelaporan/t_target_realisasi');
        $this->load->view('template/footer');

        
    }


}
