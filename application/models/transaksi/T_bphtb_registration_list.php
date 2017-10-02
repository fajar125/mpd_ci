<?php

/**
 * Pembuatan schema Model
 *
 */
class T_bphtb_registration_list extends Abstract_model {

    public $table           = "t_bphtb_registration";
    public $pkey            = "t_bphtb_registration_id";
    public $alias           = "regis";

    public $fields          = array();

    public $selectClause    = " cust_order.*,
                                regis.*
                              ";

    public $fromClause      = "t_bphtb_registration regis 
                                LEFT JOIN t_customer_order cust_order 
                                    on regis.t_customer_order_id = cust_order.t_customer_order_id 
                                 where (cust_order.order_no ILIKE '%%' OR regis.wp_name ILIKE '%%') 
                                 AND cust_order.p_order_status_id = 1 
                                 AND (
                                        regis.p_bphtb_type_id is null 
                                        or regis.p_bphtb_type_id = 1
                                      )";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {
        $ci =& get_instance();

        if($this->actionType == 'CREATE') {

        }else {

        }
        return true;
    }

    function insert(
                        $wp_name                    ,
                        $npwp                       ,
                        $wp_address_name            ,
                        $wp_rt                      ,
                        $wp_rw                      ,
                        $wp_p_region_id             ,
                        $wp_p_region_id_kec         ,
                        $wp_p_region_id_kel         ,
                        $phone_no                   ,
                        $mobile_phone_no            ,
                        $njop_pbb                   ,
                        $object_address_name        ,
                        $object_rt                  ,
                        $object_rw                  ,   
                        $object_p_region_id         ,
                        $object_p_region_id_kec     ,
                        $object_p_region_id_kel     ,
                        $p_bphtb_legal_doc_type_id  ,
                        $land_area                  ,
                        $land_price_per_m           ,
                        $land_total_price           ,
                        $building_area              ,
                        $building_price_per_m       ,
                        $building_total_price       ,
                        $market_price               ,
                        $npop                       ,
                        $npop_tkp                   ,
                        $npop_kp                    ,
                        $bphtb_amt                  ,
                        $bphtb_discount             ,
                        $bphtb_amt_final            ,
                        $description                ,
                        $jenis_harga_bphtb          ,
                        $bphtb_legal_doc_description,
                        $add_disc_percent           ,
                        $check_potongan             ,
                        $land_area_real             ,
                        $land_price_real            ,
                        $building_area_real         ,
                        $building_price_real            
                    ){


        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $o_t_bphtb_registration_id      = 0; 
        $o_mess                         = 'Message'; 

        $sql = "SELECT * FROM sikp.f_bphtb_registration (?,?,?,?,?,?,?,?,?,?,
                                                        ?,?,?,?,?,?,?,?,?,?,
                                                        ?,?,?,?,?,?,?,?,?,?,
                                                        ?,?,?,?,?,?,?,?,?,?,
                                                        ?,?,?)";

        $data = array(
                        $wp_name                    ,
                        $npwp                       ,
                        $wp_address_name            ,
                        $wp_rt                      ,
                        $wp_rw                      ,
                        $wp_p_region_id             ,
                        $wp_p_region_id_kec         ,
                        $wp_p_region_id_kel         ,
                        $phone_no                   ,
                        $mobile_phone_no            ,
                        $njop_pbb                   ,
                        $object_address_name        ,
                        $object_rt                  ,
                        $object_rw                  ,   
                        $object_p_region_id         ,
                        $object_p_region_id_kec     ,
                        $object_p_region_id_kel     ,
                        $p_bphtb_legal_doc_type_id  ,
                        $land_area                  ,
                        $land_price_per_m           ,
                        $land_total_price           ,
                        $building_area              ,
                        $building_price_per_m       ,
                        $building_total_price       ,
                        $market_price               ,
                        $npop                       ,
                        $npop_tkp                   ,
                        $npop_kp                    ,
                        $bphtb_amt                  ,
                        $bphtb_discount             ,
                        $bphtb_amt_final            ,
                        $description                ,
                        $userdata                   ,
                        $jenis_harga_bphtb          ,
                        $bphtb_legal_doc_description,
                        $add_disc_percent           ,
                        $check_potongan             ,
                        $land_area_real             ,
                        $land_price_real            ,
                        $building_area_real         ,
                        $building_price_real        ,
                        $o_t_bphtb_registration_id  ,
                        $o_mess                     
                    );

        $query = $this->db->query($sql, $data);
        $item = $query->row_array();
        
            
        return $item;
    }

}

