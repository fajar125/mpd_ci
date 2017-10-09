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
            /*$this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];*/
        }
        return true;
    }

    function getDetailBphtb($id = 0){
        $sql = "select a.add_disc_percent*100 as add_disc_percent_2,a.*,
                b.region_name as wp_kota,
                c.region_name as wp_kecamatan,
                d.region_name as wp_kelurahan,
                e.region_name as object_region,
                f.region_name as object_kecamatan,
                g.region_name as object_kelurahan,
                h.description as doc_name,
                (a.bphtb_amt - a.bphtb_discount) AS bphtb_amt_final_old,
                j.payment_vat_amount AS prev_payment_amount

                from t_bphtb_registration as a 
                left join p_region as b
                    on a.wp_p_region_id = b.p_region_id
                left join p_region as c
                    on a.wp_p_region_id_kec = c.p_region_id
                left join p_region as d
                    on a.wp_p_region_id_kel = d.p_region_id
                left join p_region as e
                    on a.object_p_region_id = e.p_region_id
                left join p_region as f
                    on a.object_p_region_id_kec = f.p_region_id
                left join p_region as g
                    on a.object_p_region_id_kel = g.p_region_id
                left join p_bphtb_legal_doc_type as h
                    on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
                left join t_bphtb_registration as i
                    on a.registration_no_ref = i.registration_no
                left join t_payment_receipt_bphtb as j
                    on i.t_bphtb_registration_id = j.t_bphtb_registration_id
                where a.t_bphtb_registration_id = ".$id;
        $query = $this->db->query($sql);
        //exit;
        return $query->row_array();
    }

    function insert($param = array()){

        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $userdata = '\''.$userdata['app_user_name'].'\'';
        $o_t_bphtb_registration_id      = 0; 
        $o_mess                         = '\'Message\'';

        foreach ($param as $key => $value) {
            if ($key == 'wp_name'||
                $key == 'npwp'||
                $key == 'wp_address_name'||
                $key == 'wp_rt'||
                $key == 'wp_rw'||
                $key == 'phone_no'||
                $key == 'mobile_phone_no'||
                $key == 'njop_pbb'||
                $key == 'object_letak_tanah'||
                $key == 'object_rt'||
                $key == 'object_rw'||
                $key == 'object_p_region_id'||
                $key == 'object_p_region_id_kec'||
                $key == 'object_p_region_id_kel'||
                $key == 'description'||
                $key == 'bphtb_legal_doc_description'||
                $key == 'check_potongan')
            {
                ${"$key"} = ($value == ''|| $value == null) ? 'null' : '\''.$value.'\'';
            }
            else{
                ${"$key"} = (($value == ''|| $value == null)&& $value != 0) ? 'null' : $value;
            }
            
        }

        $sql = "SELECT * FROM sikp.f_bphtb_registration (   $wp_name,
                                                            $npwp,
                                                            $wp_address_name,
                                                            $wp_rt,
                                                            $wp_rw,
                                                            $wp_p_region_id,
                                                            $wp_p_region_id_kec,
                                                            $wp_p_region_id_kel,
                                                            $phone_no,
                                                            $mobile_phone_no,
                                                            $njop_pbb,
                                                            $object_letak_tanah,
                                                            $object_rt,
                                                            $object_rw,   
                                                            $object_p_region_id,
                                                            $object_p_region_id_kec,
                                                            $object_p_region_id_kel,
                                                            $p_bphtb_legal_doc_type_id,
                                                            $land_area,
                                                            $land_price_per_m,
                                                            $land_total_price,
                                                            $building_area,
                                                            $building_price_per_m,
                                                            $building_total_price,
                                                            $market_price,
                                                            $npop,
                                                            $npop_tkp,
                                                            $npop_kp,
                                                            $bphtb_amt,
                                                            $bphtb_discount,
                                                            $bphtb_amt_final,
                                                            $description,
                                                            $userdata,
                                                            $jenis_harga_bphtb,
                                                            $bphtb_legal_doc_description,
                                                            $add_disc_percent,
                                                            $check_potongan,
                                                            $land_area_real,
                                                            $land_price_real,
                                                            $building_area_real,
                                                            $building_price_real,
                                                            $o_t_bphtb_registration_id,
                                                            $o_mess
                                                    )";
        //return $sql;                                            
        $query = $this->db->query($sql);
        $item = $query->row_array();
        
            
        return $item;      
    }

    function update(){
        $wp_name                        = getVarClean('wp_name','str',''); 
        $npwp                           = getVarClean('npwp','str',''); 
        $wp_address_name                = getVarClean('wp_address_name','str',''); 
        $wp_rt                          = getVarClean('wp_rt','str',''); 
        $wp_rw                          = getVarClean('wp_rw','str',''); 
        $wp_p_region_id                 = getVarClean('wp_p_region_id','int',0); 
        $wp_p_region_id_kec             = getVarClean('wp_p_region_id_kec','int',0); 
        $wp_p_region_id_kel             = getVarClean('wp_p_region_id_kel','int',0); 
        $mobile_phone_no                = getVarClean('mobile_phone_no','str',''); 
        $njop_pbb                       = getVarClean('njop_pbb','str',''); 
        $object_address_name            = getVarClean('object_address_name','str',''); 
        $object_rt                      = getVarClean('object_rt','str',''); 
        $object_rw                      = getVarClean('object_rw','str',''); 
        $object_p_region_id             = getVarClean('object_p_region_id','str',''); 
        $object_p_region_id_kec         = getVarClean('object_p_region_id_kec','str',''); 
        $object_p_region_id_kel         = getVarClean('object_p_region_id_kel','str',''); 
        $p_bphtb_legal_doc_type_id      = getVarClean('p_bphtb_legal_doc_type_id','str',''); 
        $land_area                      = getVarClean('land_area','int',0); 
        $land_price_per_m               = getVarClean('land_price_per_m','int',0); 
        $land_total_price               = getVarClean('land_total_price','int',0); 
        $building_area                  = getVarClean('building_area','int',0); 
        $building_price_per_m           = getVarClean('building_price_per_m','int',0); 
        $building_total_price           = getVarClean('building_total_price','int',0); 
        $market_price                   = getVarClean('market_price','int',0); 
        $npop                           = getVarClean('npop','int',0); 
        $npop_tkp                       = getVarClean('npop_tkp','int',0); 
        $npop_kp                        = getVarClean('npop_kp','int',0); 
        $bphtb_amt                      = getVarClean('bphtb_amt','int',0); 
        $bphtb_discount                 = getVarClean('bphtb_discount','int',0); 
        $bphtb_amt_final                = getVarClean('bphtb_amt_final','int',0); 
        $description                    = getVarClean('description','str',''); 
        $jenis_harga_bphtb              = getVarClean('jenis_harga_bphtb','int',0); 
        $bphtb_legal_doc_description    = getVarClean('bphtb_legal_doc_description','str',''); 
        $add_disc_percent               = getVarClean('add_disc_percent','str',''); 
        $land_area_real                 = getVarClean('land_area_real','int',0); 
        $land_price_real                = getVarClean('land_price_real','int',0); 
        $building_area_real             = getVarClean('building_area_real','int',0); 
        $building_price_real            = getVarClean('building_price_real','int',0); 
        $t_bphtb_registration_id        = getVarClean('t_bphtb_registration_id','int',0); 

        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $updated_date = date('Y-m-d');
        //$this->db->set('updated_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);

        $sql = "UPDATE t_bphtb_registration SET 
                        wp_name=?,
                        npwp=?,
                        wp_address_name=?,
                        wp_rt=?,
                        wp_rw=?,
                        wp_p_region_id=?,
                        wp_p_region_id_kec=?,
                        wp_p_region_id_kel=?,
                        mobile_phone_no=?,
                        njop_pbb=?,
                        object_address_name=?,
                        object_rt=?,
                        object_rw=?,
                        object_p_region_id=?,
                        object_p_region_id_kec=?,
                        object_p_region_id_kel=?,
                        p_bphtb_legal_doc_type_id=?,
                        land_area=?,
                        land_price_per_m=?,
                        land_total_price=?,
                        building_area=?,
                        building_price_per_m=?,
                        building_total_price=?,
                        market_price=?,
                        npop=?,  
                        npop_tkp=?, 
                        npop_kp=?, 
                        bphtb_amt=?, 
                        bphtb_discount=?, 
                        bphtb_amt_final=?, 
                        description=?, 
                        jenis_harga_bphtb=?, 
                        bphtb_legal_doc_description=?, 
                        add_disc_percent=?, 
                        land_area_real=?, 
                        land_price_real=?, 
                        building_area_real=?, 
                        building_price_real=?,
                        updated_by=?, 
                        updated_date=?
                    WHERE t_bphtb_registration_id = ?";

        $data = array(
                        $wp_name                    ,
                        $npwp                       ,
                        $wp_address_name            ,
                        $wp_rt                      ,
                        $wp_rw                      ,
                        $wp_p_region_id             ,
                        $wp_p_region_id_kec         ,
                        $wp_p_region_id_kel         ,
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
                        $add_disc_percent/100       ,
                        $land_area_real             ,
                        $land_price_real            ,
                        $building_area_real         ,
                        $building_price_real        ,
                        $userdata['app_user_name']                  ,
                        $updated_date               ,
                        $t_bphtb_registration_id                         
                    );

        $query = $this->db->query($sql, $data);
        $item = $query->row_array();
            
        return $item;
        return 'masuk';
    }

    function delete($id ){

        $ci =& get_instance();

        $userdata = $ci->session->userdata;
        $sql = "select t_customer_order_id from sikp.t_bphtb_registration where t_bphtb_registration_id = ".$id;
        $query = $this->db->query($sql);
        $item = $query->row_array();

        //return $item['t_customer_order_id'];

        $this->db->delete('sikp.t_bphtb_registration', array('t_bphtb_registration_id' => $id));
        $this->db->delete('sikp.t_customer_order', array('t_customer_order_id' => $item['t_customer_order_id']));
        
            
        return $item;      
    }

    
}

