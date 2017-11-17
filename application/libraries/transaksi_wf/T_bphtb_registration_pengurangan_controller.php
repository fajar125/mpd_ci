<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class T_bphtb_registration_pengurangan_controller
* @version 07/05/2015 12:18:00
*/
class T_bphtb_registration_pengurangan_controller {
	function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_customer_order_id');
        $sord = getVarClean('sord','str','desc');
        $t_customer_order_id = getVarClean('t_customer_order_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi_wf/t_bphtb_registration_pengurangan');
            $table = $ci->t_bphtb_registration_pengurangan;

            $req_param = array(
                "sort_by" => $sidx,
                "sord" => $sord,
                "limit" => null,
                "field" => null,
                "where" => null,
                "where_in" => null,
                "where_not_in" => null,
                "search" => null,
                "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
            );

            // Filter Table
            $req_param['where'] = array();

            $table->setCriteria("j.t_customer_order_id = ".$t_customer_order_id);

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

    function update(){


        $t_bphtb_registration_id        = getVarClean('t_bphtb_registration_id','int',0);
        $wp_p_region_id                 = getVarClean('wp_p_region_id','int',0);
        $wp_p_region_id_kel             = getVarClean('wp_p_region_id_kel','int',0);
        $wp_name                        = getVarClean('wp_name','str','');
        $wp_address_name                = getVarClean('wp_address_name','str','');
        $npwp                           = getVarClean('npwp','str','');
        $object_p_region_id_kec         = getVarClean('object_p_region_id_kec','int',0);
        $object_p_region_id             = getVarClean('object_p_region_id','int',0);
        /*$land_area                      = getVarClean('land_area','str','');
        $land_price_per_m               = getVarClean('land_price_per_m','int',0);
        $land_total_price               = getVarClean('land_total_price','int',0);
        $building_area                  = getVarClean('building_area','int',0);
        $building_price_per_m           = getVarClean('building_price_per_m','int',0);
        $building_total_price           = getVarClean('building_total_price','int',0);*/
        $wp_rt                          = getVarClean('wp_rt','str','');
        $wp_rw                          = getVarClean('wp_rw','str','');
        $object_rt                      = getVarClean('object_rt','str','');
        $object_rw                      = getVarClean('object_rw','str','');
        $njop_pbb                       = getVarClean('njop_pbb','str','');
        $object_address_name            = getVarClean('object_address_name','str','');
        $p_bphtb_legal_doc_type_id      = getVarClean('p_bphtb_legal_doc_type_id','int',0);
        /*$npop                           = getVarClean('npop','str','');
        $npop_tkp                       = getVarClean('npop_tkp','str','');
        $npop_kp                        = getVarClean('npop_kp','str','');*/
        $bphtb_amt                      = getVarClean('bphtb_amt','int',0);
        $bphtb_amt_final                = getVarClean('bphtb_amt_final','int',0);
        $bphtb_discount                 = getVarClean('bphtb_discount','int',0);
        $description                    = getVarClean('description','str','');
        $market_price                   = getVarClean('market_price','int',0);
        $mobile_phone_no                = getVarClean('mobile_phone_no','str','');
        $wp_p_region_id_kec             = getVarClean('wp_p_region_id_kec','int',0);
        $object_p_region_id_kel         = getVarClean('object_p_region_id_kel','int',0);
        $bphtb_legal_doc_description    = getVarClean('bphtb_legal_doc_description','str','');
        $add_disc_percent               = getVarClean('add_disc_percent','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi_wf/t_bphtb_registration_pengurangan');
            $table = $ci->t_bphtb_registration_pengurangan;

            $result = $table->updateDataPengurangan($wp_p_region_id,$wp_p_region_id_kel,$wp_name,$wp_address_name,$npwp,$object_p_region_id_kec,$object_p_region_id,$wp_rt,$wp_rw,$object_rt,$object_rw,$njop_pbb,$object_address_name,$p_bphtb_legal_doc_type_id,$bphtb_amt,$bphtb_amt_final,$bphtb_discount,$description,$market_price,$mobile_phone_no,$wp_p_region_id_kec,$object_p_region_id_kel,$bphtb_legal_doc_description,$add_disc_percent,$t_bphtb_registration_id);

            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }
}