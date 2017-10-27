<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_cust_customer_controller
* @version 07/05/2015 12:18:00
*/
class t_cust_account_update_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_cust_account_id');
        $sord = getVarClean('sord','str','desc');
        
        $t_customer_id = getVarClean('t_customer_id','int',0);
        $t_cust_account_id = getVarClean('t_cust_account_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        

        try {

            $ci = & get_instance();
            $ci->load->model('data_master/t_cust_account_update');
            $table = $ci->t_cust_account_update;

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

            if(!empty($t_customer_id)) {
                $req_param['where'][] = 'cust.t_customer_id = '.$t_customer_id;
                $req_param['where'][] = 'cust.t_cust_account_id = '.$t_cust_account_id;
            }

            
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
        return $data;
    }

    function update(){
        $page = getVarClean('page', 'int', 1);
        $limit = getVarClean('rows', 'int', 5);

        $t_cust_account_id          = getVarClean('t_cust_account_id','int',0);
        $t_customer_id              = getVarClean('t_customer_id','int',0);
        $npwd                       = getVarClean('npwd','str','');
        $p_vat_type_id              = getVarClean('p_vat_type_id','int',0);
        $p_vat_type_dtl_id          = getVarClean('p_vat_type_dtl_id','int',0);
        $activation_no              = getVarClean('activation_no','str','');
        $company_name               = getVarClean('company_name','str','');
        $address_name               = getVarClean('address_name','str','');
        $address_no                 = getVarClean('address_no','str','');
        $address_rt                 = getVarClean('address_rt','str','');
        $address_rw                 = getVarClean('address_rw','str','');
        $p_region_id                = getVarClean('p_region_id','int',0);
        $p_region_id_kecamatan      = getVarClean('p_region_id_kecamatan','int',0);
        $p_region_id_kelurahan      = getVarClean('p_region_id_kelurahan','int',0);
        $phone_no                   = getVarClean('phone_no','str','');
        $mobile_no                  = getVarClean('mobile_no','str','');
        $fax_no                     = getVarClean('fax_no','str','');
        $zip_code                   = getVarClean('zip_code','str','');
        $company_brand              = getVarClean('company_brand','str','');
        $brand_address_name         = getVarClean('brand_address_name','str','');
        $brand_address_no           = getVarClean('brand_address_no','str','');
        $brand_address_rt           = getVarClean('brand_address_rt','str','');
        $brand_address_rw           = getVarClean('brand_address_rw','str','');
        $brand_p_region_id          = getVarClean('brand_p_region_id','int',0);
        $brand_p_region_id_kec      = getVarClean('brand_p_region_id_kec','int',0);
        $brand_p_region_id_kel      = getVarClean('brand_p_region_id_kel','int',0);
        $brand_phone_no             = getVarClean('brand_phone_no','str','');
        $brand_mobile_no            = getVarClean('brand_mobile_no','str','');
        $brand_fax_no               = getVarClean('brand_fax_no','str','');
        $brand_zip_code             = getVarClean('brand_zip_code','str','');
        $wp_name                    = getVarClean('wp_name','str','');
        $wp_address_name            = getVarClean('wp_address_name','str','');
        $wp_address_no              = getVarClean('wp_address_no','str','');
        $wp_address_rt              = getVarClean('wp_address_rt','str','');   
        $wp_address_rw              = getVarClean('wp_address_rw','str','');
        $wp_p_region_id             = getVarClean('wp_p_region_id','int',0);
        $wp_p_region_id_kecamatan   = getVarClean('wp_p_region_id_kecamatan','int',0);
        $wp_p_region_id_kelurahan   = getVarClean('wp_p_region_id_kelurahan','int',0);
        $wp_phone_no                = getVarClean('wp_phone_no','str','');
        $wp_mobile_no               = getVarClean('wp_mobile_no','str','');
        $wp_email                   = getVarClean('wp_email','str','');
        $wp_fax_no                  = getVarClean('wp_fax_no','str','');
        $wp_zip_code                = getVarClean('wp_zip_code','str','');
        $company_owner              = getVarClean('company_owner','str','');
        $p_job_position_id          = getVarClean('p_job_position_id','int',0);
        $address_name_owner         = getVarClean('address_name_owner','str','');
        $address_no_owner           = getVarClean('address_no_owner','str','');
        $address_rt_owner           = getVarClean('address_rt_owner','str','');
        $address_rw_owner           = getVarClean('address_rw_owner','str','');
        $p_region_id_owner          = getVarClean('p_region_id_owner','int',0);
        $p_region_id_kec_owner      = getVarClean('p_region_id_kec_owner','int',0);
        $p_region_id_kel_owner      = getVarClean('p_region_id_kel_owner','int',0);
        $phone_no_owner             = getVarClean('phone_no_owner','str','');
        $fax_no_owner               = getVarClean('fax_no_owner','str','');
        $mobile_no_owner            = getVarClean('mobile_no_owner','str','');
        $email_address              = getVarClean('email_address','str','');
        $zip_code_owner             = getVarClean('zip_code_owner','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try{

            $ci = & get_instance();
            $ci->load->model('data_master/t_cust_account_update');
            $table = $ci->t_cust_account_update;

            $param = array( 't_cust_account_id'=>$t_cust_account_id,
                            't_customer_id'=>$t_customer_id,
                            'npwd'=>$npwd,
                            'p_vat_type_id'=>$p_vat_type_id,
                            'p_vat_type_dtl_id'=>$p_vat_type_dtl_id,
                            'activation_no'=>$activation_no,
                            'company_name'=>$company_name,
                            'address_name'=>$address_name,
                            'address_no'=>$address_no,
                            'address_rt'=>$address_rt,
                            'address_rw'=>$address_rw,
                            'p_region_id'=>$p_region_id,
                            'p_region_id_kecamatan'=>$p_region_id_kecamatan,
                            'p_region_id_kelurahan'=>$p_region_id_kelurahan,
                            'phone_no'=>$phone_no,
                            'mobile_no'=>$mobile_no,
                            'fax_no'=>$fax_no,
                            'zip_code'=>$zip_code,
                            'company_brand'=>$company_brand,
                            'brand_address_name'=>$brand_address_name,
                            'brand_address_no'=>$brand_address_no,
                            'brand_address_rt'=>$brand_address_rt,
                            'brand_address_rw'=>$brand_address_rw,
                            'brand_p_region_id'=>$brand_p_region_id,
                            'brand_p_region_id_kec'=>$brand_p_region_id_kec,
                            'brand_p_region_id_kel'=>$brand_p_region_id_kel,
                            'brand_phone_no'=>$brand_phone_no,
                            'brand_mobile_no'=>$brand_mobile_no,
                            'brand_fax_no'=>$brand_fax_no,
                            'brand_zip_code'=>$brand_zip_code,
                            'wp_name'=>$wp_name,
                            'wp_address_name'=>$wp_address_name,
                            'wp_address_no'=>$wp_address_no,
                            'wp_address_rt'=>$wp_address_rt,
                            'wp_address_rw'=>$wp_address_rw,
                            'wp_p_region_id'=>$wp_p_region_id,
                            'wp_p_region_id_kecamatan'=>$wp_p_region_id_kecamatan,
                            'wp_p_region_id_kelurahan'=>$wp_p_region_id_kelurahan,
                            'wp_phone_no'=>$wp_phone_no,
                            'wp_mobile_no'=>$wp_mobile_no,
                            'wp_email'=>$wp_email,
                            'wp_fax_no'=>$wp_fax_no,
                            'wp_zip_code'=>$wp_zip_code,
                            'company_owner'=>$company_owner,
                            'p_job_position_id'=>$p_job_position_id,
                            'address_name_owner'=>$address_name_owner,
                            'address_no_owner'=>$address_no_owner,
                            'address_rt_owner'=>$address_rt_owner,
                            'address_rw_owner'=>$address_rw_owner,
                            'p_region_id_owner'=>$p_region_id_owner,
                            'p_region_id_kec_owner'=>$p_region_id_kec_owner,
                            'p_region_id_kel_owner'=>$p_region_id_kel_owner,
                            'phone_no_owner'=>$phone_no_owner,
                            'fax_no_owner'=>$fax_no_owner,
                            'mobile_no_owner'=>$mobile_no_owner,
                            'email_address'=>$email_address,
                            'zip_code_owner'=>$zip_code_owner);

            $result = $table->update($param) ;
            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;

        }catch(Exception $e){
            $data['message'] = $e->getMessage();
        }

        return $data;

    }    
}

/* End of file t_cust_account_update_controller.php */