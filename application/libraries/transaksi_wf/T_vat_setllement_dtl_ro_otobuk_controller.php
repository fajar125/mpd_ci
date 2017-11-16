<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Groups_controller
* @version 07/05/2015 12:18:00
*/
class T_vat_setllement_dtl_ro_otobuk_controller {

    function read() {

        $page                = getVarClean('page','int',1);
        $limit               = getVarClean('rows','int',5);
        $sidx                = getVarClean('sidx','str','t_vat_setllement_dtl_id ');
        $sord                = getVarClean('sord','str','asc');
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi_wf/t_vat_setllement_dtl_ro_otobuk');
            $table = $ci->t_vat_setllement_dtl_ro_otobuk;

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

            $table->setCriteria("t_vat_setllement_id=".$t_vat_setllement_id);

            $table->setJQGridParam($req_param);
            $count = $table->countAll();
            $total_pages = 1;
            $page =0;
            /*if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            $req_param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );*/

            $table->setJQGridParam($req_param);

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $table->getAll();
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }
}

/* End of file Groups_controller.php */