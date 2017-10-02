<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class T_bphtb_registration_list_controller
* @version 07/05/2015 12:18:00
*/
class T_bphtb_registration_list_controller {
 
    function read() {
        //exit;
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_bphtb_registration_id');
        $sord = getVarClean('sord','str','desc');
        $periode = getVarClean('periode','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance(); 
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;
             //$periode='201712';;

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

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function insert_tes(){
        $page = getVarClean('page','int','');
        /*$data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');*/
        print_r( $this->db); exit;

        $sql = "SELECT * 
                    FROM p_bphtb_legal_doc_type 
                  ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $output=json_encode($items);
        return $output;
    }

    function insert(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        
        $wp_name                        = getVarClean('wp_name','str',''); 
        $npwp                           = getVarClean('npwp','str',''); 
        $wp_address_name                = getVarClean('wp_address_name','str',''); 
        $wp_rt                          = getVarClean('wp_rt','str',''); 
        $wp_rw                          = getVarClean('wp_rw','str',''); 
        $wp_p_region_id                 = getVarClean('wp_p_region_id','str',''); 
        $wp_p_region_id_kec             = getVarClean('wp_p_region_id_kec','str',''); 
        $wp_p_region_id_kel             = getVarClean('wp_p_region_id_kel','str',''); 
        $phone_no                       = getVarClean('phone_no','str',''); 
        $mobile_phone_no                = getVarClean('mobile_phone_no','str',''); 
        $njop_pbb                       = getVarClean('njop_pbb','str',''); 
        $object_address_name            = getVarClean('object_address_name','str',''); 
        $object_rt                      = getVarClean('object_rt','str',''); 
        $object_rw                      = getVarClean('object_rw','str',''); 
        $object_p_region_id             = getVarClean('object_p_region_id','str',''); 
        $object_p_region_id_kec         = getVarClean('object_p_region_id_kec','str',''); 
        $object_p_region_id_kel         = getVarClean('object_p_region_id_kel','str',''); 
        $p_bphtb_legal_doc_type_id      = getVarClean('p_bphtb_legal_doc_type_id','str',''); 
        $land_area                      = getVarClean('land_area','str',''); 
        $land_price_per_m               = getVarClean('land_price_per_m','str',''); 
        $land_total_price               = getVarClean('land_total_price','str',''); 
        $building_area                  = getVarClean('building_area','str',''); 
        $building_price_per_m           = getVarClean('land_total_price','str',''); 
        $building_total_price           = getVarClean('land_total_price','str',''); 
        $market_price                   = getVarClean('land_total_price','str',''); 
        $npop                           = getVarClean('land_total_price','str',''); 
        $npop_tkp                       = getVarClean('land_total_price','str',''); 
        $npop_kp                        = getVarClean('land_total_price','str',''); 
        $bphtb_amt                      = getVarClean('land_total_price','str',''); 
        $bphtb_discount                 = getVarClean('land_total_price','str',''); 
        $bphtb_amt_final                = getVarClean('land_total_price','str',''); 
        $description                    = getVarClean('land_total_price','str',''); 
        $i_user                         = getVarClean('land_total_price','str',''); 
        $jenis_harga_bphtb              = getVarClean('land_total_price','str',''); 
        $bphtb_legal_doc_description    = getVarClean('land_total_price','str',''); 
        $add_disc_percent               = getVarClean('land_total_price','str',''); 
        $check_potongan                 = getVarClean('land_total_price','str',''); 
        $i_land_area_real               = getVarClean('land_total_price','str',''); 
        $i_land_price_real              = getVarClean('land_total_price','str',''); 
        $i_building_area_real           = getVarClean('land_total_price','str',''); 
        $i_building_price_real          = getVarClean('land_total_price','str',''); 
        $o_t_bphtb_registration_id      = getVarClean('land_total_price','str',''); 
        $o_mess                         = getVarClean('land_total_price','str',''); 
        
               

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;
            /*$item = $table->getCustOrder($payment_key);
            $cust_order_id = $item['t_customer_order_id'];*/

            $result = $table->insertUpdate($cust_order_id, $p_payment_type_id) ;
            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }



    
}
