<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_target_vs_realisasi extends CI_Controller
{

    function __construct() {
        parent::__construct();

        // check_login();
        
    }

    public function index(){
        $mode = getVarClean('mode', 'str', 'target');

        if($mode=='bidang'){
            $this->load->view('pelaporan/dashboard_t_target_realisasi_bidang');
        }else if($mode=='jenis'){
            $this->load->view('pelaporan/dashboard_t_target_realisasi_jenis');
        }else if($mode=='jenis_bulan'){
            $this->load->view('pelaporan/dashboard_t_target_realisasi_jenis_bulan');
        }else if($mode=='target'){
            $this->load->view('pelaporan/dashboard_t_target_realisasi');
        }
        
    }

    public function target_realisasi(){
        $this->load->view('pelaporan/dashboard_t_target_realisasi');
    }

    public function target_realisasi_perjenis_pajak(){
        $this->load->view('pelaporan/dashboard_t_target_realisasi_jenis');
    }

    public function target_realisasi_perjenis_pajak_perbulan(){
        $this->load->view('pelaporan/dashboard_t_target_realisasi_jenis_bulan');
    }


}
