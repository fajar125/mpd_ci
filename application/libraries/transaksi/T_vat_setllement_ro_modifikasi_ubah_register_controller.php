<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class vats_controller
* @version 07/05/2015 12:18:00
*/
class T_vat_setllement_ro_modifikasi_ubah_register_controller {

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
                $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi_ubah_register');
                $table = $ci->t_vat_setllement_ro_modifikasi_ubah_register;

                
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
                $req_param['where'][] = "a.p_finance_period_id = b.p_finance_period_id AND
                                            a.t_customer_order_id = c.t_customer_order_id AND
                                            a.t_cust_account_id = d.t_cust_account_id AND
                                            c.p_rqst_type_id = e.p_rqst_type_id AND
                                            a.t_vat_setllement_id = f.t_vat_setllement_id AND
                                            sett_type.p_settlement_type_id = a.p_settlement_type_id AND
                                            ( upper(d.wp_name) LIKE upper('%".$s_keyword."%') OR 
                                              upper(a.npwd) LIKE upper('%".$s_keyword."%') OR
                                              upper(a.payment_key) LIKE upper('%".$s_keyword."%') OR
                                              upper(a.no_kohir) LIKE upper('%".$s_keyword."%')
                                            ) ";

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

    function readDataRegister(){
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi_ubah_register');
            $table = $ci->t_vat_setllement_ro_modifikasi_ubah_register;

            $result = $table->getRegister($t_vat_setllement_id) ;
            
            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

    function updateDataRegister(){
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        $total_trans_amount = getVarClean('total_trans_amount','int',0);
        $total_vat_amount = getVarClean('total_vat_amount','int',0); 
        $is_settled = getVarClean('is_settled','str',''); 
        $receipt_no = getVarClean('receipt_no','str',''); 
        $payment_amount = getVarClean('payment_amount','int',0); 
        $payment_vat_amount = getVarClean('t_vat_setllement_id','int',0);
        $payment_date = getVarClean('payment_date','str','');
        $is_bjb = getVarClean('is_bjb','int',0);
        $p_cg_terminal_id = getVarClean('p_cg_terminal_id','str','');
        $penalty_amount = getVarClean('penalty_amount','int',0);


        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ro_modifikasi_ubah_register');
            $table = $ci->t_vat_setllement_ro_modifikasi_ubah_register;

            $result = $table->ubahRegister($t_vat_setllement_id, $total_trans_amount, $total_vat_amount, $is_settled, $receipt_no, $payment_amount, $payment_vat_amount,$payment_date,$is_bjb,$p_cg_terminal_id,$penalty_amount);
            
            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

}