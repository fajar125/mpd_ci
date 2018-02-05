<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_piutang_skpd_controller
* @version 07/05/2015 12:18:00
*/
class T_piutang_skpd_controller {

	function read()
    {
        $s_keyword  = getVarClean('s_keyword', 'str', '');
        $sidx 	    = getVarClean('sidx','str','a.wp_name');
        $sord 	    = getVarClean('sord','str','asc');
        $page	    = getVarClean('page','int',1);
        $limit 	    = getVarClean('rows','int',10);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {
            if (!empty($s_keyword)){
            	$ci = & get_instance();
                $ci->load->model('transaksi/t_piutang_skpd');
                $table = $ci->t_piutang_skpd;

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
                

                $table->setCriteria(" p_settlement_type_id = 7 AND (upper(a.wp_name) LIKE upper('%".$s_keyword."%') OR 
                                        upper(a.npwd) LIKE upper('%".$s_keyword."%')OR 
                                        upper(a.no_kohir) LIKE upper('%".$s_keyword."%'))");            

                $count = $table->countAll();

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
                
            }
            $data['success'] = true;
            return $data;
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function updateDenda() {

        $t_vat_setllement_id = getVarClean('t_vat_setllement_id', 'int', 0);
        //exit;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_piutang_skpd');
            $table = $ci->t_piutang_skpd;

            $result = $table->updateDenda($t_vat_setllement_id);

            // print_r($result);
            // exit();

            $data['rows'] = $result;
            $data['message'] = 'success';
            $data['success'] = true;
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
        exit;

    }

    function submit() {

        $t_customer_order_id = getVarClean('t_customer_order_id', 'int', 0);
        //exit;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_piutang_skpd');
            $table = $ci->t_piutang_skpd;

            $result = $table->submit($t_customer_order_id);

            // print_r($result);
            // exit();

            $data['rows'] = $result;
            $data['message'] = 'success';
            $data['success'] = true;
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
        exit;

    }


}

/* End of file Groups_controller.php */