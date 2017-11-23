<?php

/**
 * T_customer_create_uname Model
 *
 */
class T_customer_create_uname extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = array();

    public $selectClause    = "a.*, 
                                c.vat_code, 
                                b.company_brand, 
                                b.brand_address_name, 
                                b.npwd,a.address_name_owner||' No.'||a.address_no_owner||' RT.'||a.address_rt_owner||' RW.'||a.address_rw_owner as alamat";
    public $fromClause      = "t_cust_account b 
                                LEFT JOIN t_customer a 
                                    ON b.t_customer_id = a.t_customer_id
                                LEFT JOIN p_vat_type c
                                     ON b.p_vat_type_id = c.p_vat_type_id";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {

        $ci =& get_instance();
        $userdata = $ci->session->userdata;

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            /*$this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $userdata['app_user_name'];*/
            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];
            
            $this->record[$this->pkey] = $this->generate_id($this->table, $this->pkey);

        }else {
            //do something
            //example:
            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];
            //if false please throw new Exception
        }
        return true;
    }

    function generate_uname($t_customer_id = 0){
        $sql = "SELECT * FROM f_create_uname_password_wp(".$t_customer_id.") as hasil";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data['hasil'];
    }

    function getDataDetail($t_customer_id = 0){
        $sql = "SELECT  a.t_customer_id, 
                        a.company_owner, 
                        a.p_job_position_id, 
                        a.address_name_owner, 
                        a.address_no_owner, 
                        a.address_rt_owner, 
                        a.address_rw_owner,
                        a.p_region_id_kel_owner, 
                        a.p_region_id_kec_owner, 
                        a.p_region_id_owner, 
                        a.phone_no_owner, 
                        a.mobile_no_owner,
                        a.fax_no_owner, 
                        a.zip_code_owner, 
                        a.email_address, 
                        a.creation_date, 
                        a.created_by, 
                        a.updated_date, 
                        a.updated_by,
                        b.code AS nama_jabatan,
                        c.region_name AS nama_kota,
                        d.region_name AS nama_kecamatan,
                        e.region_name AS nama_kelurahan,
                        (a.address_name_owner || '. NO ' || a.address_no_owner || '. ' || c.region_name || '. ' || d.region_name || '. ' || e.region_name || '. ' || 'RT ' || a.address_rt_owner || '/ RW ' || a.address_rw_owner ) AS alamat_lengkap

                FROM t_customer a
                LEFT JOIN  p_job_position b ON a.p_job_position_id = b.p_job_position_id
                LEFT JOIN p_region c ON a.p_region_id_owner = c.p_region_id
                LEFT JOIN p_region d ON a.p_region_id_kec_owner = d.p_region_id
                LEFT JOIN p_region e ON a.p_region_id_kel_owner = e.p_region_id
                WHERE a.t_customer_id =".$t_customer_id;
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data;
    }

}

/* End of file T_customer_create_uname.php */