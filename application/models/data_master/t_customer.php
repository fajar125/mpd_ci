<?php

/**
 * t_customer Model
 *
 */
class t_customer extends Abstract_model {

    public $table           = "t_customer";
    public $pkey            = "t_customer_id";
    public $alias           = "tc";

    public $fields          = array(
                                't_customer_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Customer'),
                                'company_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Regional'),
                                'p_job_position_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'ID Job Position'),
                                'address_name_owner'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Alamat WP'),
                                'address_no_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'No'),
                                'address_rt_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'RT'),
                                'address_rw_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'RW'),
                                'p_region_id_kel_owner'           => array('nullable' => true, 'type' => 'int', 'unique' => true, 'display' => 'Kelurahan'),
                                'p_region_id_kec_owner'           => array('nullable' => true, 'type' => 'int', 'unique' => true, 'display' => 'Kecamatan'),
                                'p_region_id_owner'           => array('nullable' => true, 'type' => 'int', 'unique' => true, 'display' => 'ID Region'),
                                'phone_no_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'No Tlp'),
                                'mobile_no_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'No HP'),
                                'fax_no_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'No Fax'),
                                'zipe_code_owner'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Kode Pos'),
                                'email_address'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Email'),
                                'vat_code'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Jenis Pajak'),
                                'company_brand'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Merk Dagang'),
                                'brand_address_name'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Alamat Dagang'),
                                'alamat'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Alamat'),

                                'creation_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Creation Date'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),

                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "tc.*, b.t_cust_account_id, d.code, e.region_name as kota, f.region_name as kecamatan, g.region_name as kelurahan, c.vat_code, b.company_brand, b.brand_address_name, tc.address_name_owner||' No.'||tc.address_no_owner||' RT.'||tc.address_rt_owner||' RW.'||tc.address_rw_owner as alamat";
    public $fromClause      = "t_customer tc LEFT JOIN t_cust_account b ON tc.t_customer_id = b.t_customer_id LEFT JOIN p_vat_type c ON b.p_vat_type_id = c.p_vat_type_id LEFT JOIN p_job_position d ON tc.p_job_position_id = d.p_job_position_id LEFT JOIN p_region e ON tc.p_region_id_owner = e.p_region_id LEFT JOIN p_region f ON tc.p_region_id_kec_owner = f.p_region_id LEFT JOIN p_region g ON tc.p_region_id_kel_owner = g.p_region_id";

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

}

/* End of file t_customer.php */