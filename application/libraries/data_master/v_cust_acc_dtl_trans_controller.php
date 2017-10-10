<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class v_cust_acc_dtl_trans_controller
* @version 07/05/2015 12:18:00
*/
class v_cust_acc_dtl_trans_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','');
        $sord = getVarClean('sord','str','desc');
        $t_cust_account_id = getVarClean('t_cust_account_id','int',0);
        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        

        try {

            $ci = & get_instance();
            $ci->load->model('data_master/v_cust_acc_dtl_trans');
            $table = $ci->v_cust_acc_dtl_trans;
             
            $result = $table->get_v_cust_acc_dtl_trans($t_vat_setllement_id, $t_cust_account_id);
            
            $count = count($result);

            

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

           /* $req_param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );*/

            //$table->setJQGridParam($req_param);

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

    function readLov() {

        $start = getVarClean('current','int',0);
        $limit = getVarClean('rowCount','int',5);

        $sort = getVarClean('sort','str','t_vat_setllement_id');
        $dir  = getVarClean('dir','str','asc');

        $t_vat_setllement_id = getVarClean('t_vat_setllement_id', 'int', 0);
        $t_cust_account_id = getVarClean('t_cust_account_id', 'int', 0);

        $searchPhrase = getVarClean('searchPhrase', 'str', '');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('data_master/v_cust_acc_dtl_trans');
            $table = $ci->v_cust_acc_dtl_trans;

            if(!empty($searchPhrase)) {
                $table->setCriteria("(upper(service_desc) ".$table->likeOperator." upper('%".$searchPhrase."%'))");
            }
            $table->setCriteria("a.t_vat_setllement_id = b.t_vat_setllement_id");
            $table->setCriteria("a.t_vat_setllement_id =".$t_vat_setllement_id);
            $table->setCriteria("b.t_cust_acc_dtl_trans_id = c.t_cust_acc_dtl_trans_id");
            $table->setCriteria("b.t_cust_account_id = ".$t_cust_account_id);

            $start = ($start-1) * $limit;
            $items = $table->getAll($start, $limit, $sort, $dir);
            $totalcount = $table->countAll();

            $data['rows'] = $items;
            $data['success'] = true;
            $data['total'] = $totalcount;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

       

    function destroy() {
        $ci = & get_instance();
        $ci->load->model('data_master/v_cust_acc_dtl_trans');
        $table = $ci->v_cust_acc_dtl_trans;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

        try{
            $table->db->trans_begin(); //Begin Trans

            $total = 0;
            if (is_array($items)){
                foreach ($items as $key => $value){
                    if (empty($value)) throw new Exception('Empty parameter');
                    $table->remove($value);
                    $data['rows'][] = array($table->pkey => $value);
                    $total++;
                }
            }else{
                $items = (int) $items;
                if (empty($items)){
                    throw new Exception('Empty parameter');
                }
                $table->remove($items);
                $data['rows'][] = array($table->pkey => $items);
                $data['total'] = $total = 1;
            }

            $data['success'] = true;
            $data['message'] = $total.' Data deleted successfully';
            logging('delete data bank branch');
            $table->db->trans_commit(); //Commit Trans

        }catch (Exception $e) {
            $table->db->trans_rollback(); //Rollback Trans
            $data['message'] = $e->getMessage();
            $data['rows'] = array();
            $data['total'] = 0;
        }
        return $data;
    }
}

/* End of file v_cust_acc_dtl_trans_controller.php */