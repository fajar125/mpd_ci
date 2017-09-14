<?php

/**
 * Icons Model
 *
 */
class T_cust_account extends Abstract_model {

    public $table           = "t_cust_account";
    public $pkey            = "t_cust_account_id";
    public $alias           = "pp";

    public $fields          = array(
                                't_cust_account_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Room'),
                                'p_vat_type_id'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Klasifikasi tempat parkir'),
                                'company_brand'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),

                                'brand_address_name'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),
                                'creation_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "pp.*, pv.vat_code, pt.vat_code as vat_dtl ,(brand_address_name||' '||replace(brand_address_no, '-', '')) as brand_address";
    public $fromClause      = "t_cust_account pp 
                                left join p_vat_type pv on pp.p_vat_type_id = pv.p_vat_type_id
                                left join p_vat_type_dtl pt 
                                on pp.p_vat_type_dtl_id=pt.p_vat_type_dtl_id";

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
            $this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $userdata['app_user_name'];
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

    function getLOV($s_keyword){
        $sql = "SELECT a.t_cust_account_id, a.npwd, wp_name,a.wp_address_name, a.p_vat_type_id, vat_code, tbl.p_vat_type_dtl_id, vat_code_dtl,a.company_brand,a.brand_address_name||' '||a.brand_address_no AS brand_address_name
                FROM f_get_npwd_by_username('ADMIN') AS tbl
                LEFT JOIN t_cust_account A ON A.t_cust_account_id= tbl.t_cust_account_id
                where upper(a.npwd) like '%$s_keyword%' OR
                upper(a.wp_name) like '%$s_keyword%' OR
                upper(a.company_brand) like '%$s_keyword%'";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        return $items;
    }

}

/* End of file Icons.php */