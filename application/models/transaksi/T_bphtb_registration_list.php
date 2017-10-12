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
                                 ";

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

    function update($param = array()){
        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $userdata = $userdata['app_user_name'];
        $updated_date = date('Y-m-d');

        $data =  array('wp_name' =>$param['wp_name'],
                            'npwp'=>$param['npwp'],
                            'wp_address_name'=>$param['wp_address_name'],
                            'wp_rt'=>$param['wp_rt'],
                            'wp_rw'=>$param['wp_rw'],
                            'wp_p_region_id'=>$param['wp_p_region_id'],
                            'wp_p_region_id_kec'=>$param['wp_p_region_id_kec'],
                            'wp_p_region_id_kel'=>$param['wp_p_region_id_kel'],
                            'mobile_phone_no'=>$param['mobile_phone_no'],
                            'njop_pbb'=>$param['njop_pbb'],
                            'object_address_name'=>$param['object_address_name'],
                            'object_rt'=>$param['object_rt'],
                            'object_rw'=>$param['object_rw'],   
                            'object_p_region_id'=>$param['object_p_region_id'],
                            'object_p_region_id_kec'=>$param['object_p_region_id_kec'],
                            'object_p_region_id_kel'=>$param['object_p_region_id_kel'],
                            'p_bphtb_legal_doc_type_id'=>$param['p_bphtb_legal_doc_type_id'],
                            'land_area'=>$param['land_area'],
                            'land_price_per_m'=>$param['land_price_per_m'],
                            'land_total_price'=>$param['land_total_price'],
                            'building_area'=>$param['building_area'],
                            'building_price_per_m'=>$param['building_price_per_m'],
                            'building_total_price'=>$param['building_total_price'],
                            'market_price'=>$param['market_price'],
                            'npop'=>$param['npop'],
                            'npop_tkp'=>$param['npop_tkp'],
                            'npop_kp'=>$param['npop_kp'],
                            'bphtb_amt'=>$param['bphtb_amt'],
                            'bphtb_discount'=>$param['bphtb_discount'],
                            'bphtb_amt_final'=>$param['bphtb_amt_final'],
                            'description'=>$param['description'],
                            'jenis_harga_bphtb'=>$param['jenis_harga_bphtb'],
                            'bphtb_legal_doc_description'=>$param['bphtb_legal_doc_description'],
                            'add_disc_percent'=>$param['add_disc_percent'],
                            'land_area_real'=>$param['land_area_real'],
                            'land_price_real'=>$param['land_price_real'],
                            'building_area_real'=>$param['building_area_real'],
                            'building_price_real'=>$param['building_price_real'],
                            'updated_by'=>$userdata,
                            'updated_date'=>$updated_date);
        
        $this->db->where('t_bphtb_registration_id', $param['t_bphtb_registration_id']);
        $this->db->update('sikp.t_bphtb_registration', $data);
        $item = 'Sukses Update Data';
            
        return $item;
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

