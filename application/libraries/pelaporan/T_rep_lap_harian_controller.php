<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_rep_lap_harian_controller
* @version 07/05/2015 12:18:00
*/
class T_rep_lap_harian_controller {
 
    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sord = getVarClean('sord', 'str', 'asc');
        $tgl_penerimaan = getVarClean('tgl_penerimaan','str','');
        $kode_bank = getVarClean('kode_bank','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_rep_lap_harian');
            $table = $ci->t_rep_lap_harian;
             
            $result = $table->getLapHarian($tgl_penerimaan, $kode_bank);
            
            //$table->setJQGridParam($req_param);
            $count = count($result);
            //count($result)

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - 1; // do not put $limit*($page - 1)

           
            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    
}

/* End of file t_rep_lap_harian_controller.php */