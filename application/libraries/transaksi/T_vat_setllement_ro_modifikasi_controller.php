<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class vats_controller
* @version 07/05/2015 12:18:00
*/
class T_vat_setllement_ro_modifikasi_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_vat_setllement_id');
        $sord = getVarClean('sord','str','desc');

        $s_keyword = getVarClean('s_keyword','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => true, 'message' => '');

        if ($s_keyword != "") {
            try {

                $ci = & get_instance();
                $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi');
                $table = $ci->t_vat_setllement_ro_modifikasi;

                
                if( isset($_REQUEST['searchField'])){
                    if($_REQUEST['searchField']=='npwd') {
                        $_REQUEST['searchField']='x.npwd';
                    }
                    if($_REQUEST['searchField']=='company_brand_name') {
                        $_REQUEST['searchField']='b.company_brand';
                    }
                    if($_REQUEST['searchField']=='code') {
                        $_REQUEST['searchField']='a.code';
                    }
                     if($_REQUEST['searchField']=='no_kohir') {
                        $_REQUEST['searchField']='x.no_kohir';
                    }
                     if($_REQUEST['searchField']=='payment_key') {
                        $_REQUEST['searchField']='x.payment_key';
                    }
                }

                

                $req_param = array(
                    "sort_by" => $sidx,
                    "sord" => $sord,
                    "limit" => null,
                    "field" => null,
                    "where" => null,
                    "where_in" => null,
                    "where_not_in" => null,
                    "search" => $_REQUEST['_search'],
                    "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                    "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                    "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
                );

                // Filter Table

                $req_param['where'] = array();
                $req_param['where'][] = "( upper(d.wp_name) LIKE upper('%".$s_keyword."%') OR 
                      upper(a.npwd) LIKE upper('%".$s_keyword."%') OR
                      upper(a.no_kohir) LIKE upper('%".$s_keyword."%') OR
                      upper(a.payment_key) LIKE upper('%".$s_keyword."%')
                    )";

                $table->setJQGridParam($req_param);
                $count = $table->countAll();

                if ($count > 0) $total_pages = ceil($count / $limit);
                else $total_pages = 1;

                if ($page > $total_pages) $page = $total_pages;
                $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

                $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
                );

                $table->setJQGridParam($req_param);

                if ($page == 0) $data['page'] = 1;
                else $data['page'] = $page;

                $data['total'] = $total_pages;
                $data['records'] = $count;

                $data['rows'] = $table->getAll();
                $data['success'] = true;
                logging('view data vat');
            }catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }       

        return $data;
    }

    function readData(){
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        $i_mode = getVarClean('i_mode','int',0);
        

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi');
            $table = $ci->t_vat_setllement_ro_modifikasi;

            $result = $table->getData($t_vat_setllement_id, $i_mode) ;
            
            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

    function updateData(){
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        $keyword = getVarClean('keyword','str','');
        $alasan = getVarClean('alasan','str','');
        $flag_piutang = getVarClean('flag_piutang','int',0);
        $i_mode = getVarClean('i_mode','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi');
            $table = $ci->t_vat_setllement_ro_modifikasi;

            $result = $table->ubahData($t_vat_setllement_id, $keyword, $alasan, $flag_piutang, $i_mode);
            
            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

    function readDataTgl(){
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi');
            $table = $ci->t_vat_setllement_ro_modifikasi;

            $result = $table->getDataTgl($t_vat_setllement_id) ;
            
            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

    function updateTgl(){
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        $settlement_date_new = getVarClean('settlement_date_new','string',0);
        $alasan = getVarClean('alasan','int',0); 

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi');
            $table = $ci->t_vat_setllement_ro_modifikasi;

            $result = $table->ubahTgl($t_vat_setllement_id, $settlement_date_new,$alasan) ;
            
            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }
}