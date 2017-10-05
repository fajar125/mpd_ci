<?php

/**
 * t_cust_account.php Model
 *
 */
class t_cust_account extends Abstract_model {

    public $table           = "t_cust_account";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";
    /* Display fields */
    public $displayFields = array();
    /* Details table */
    public $details = array();

    public $selectClause    = "a.t_cust_account_id, a.t_customer_id, a.npwd, a.p_vat_type_id,   a.t_vat_registration_id, a.t_customer_order_id,
        a.registration_date, a.company_name, a.company_brand, a.address_name, a.address_no, a.address_rt, a.address_rw, a.p_region_id_kelurahan, a.p_region_id_kecamatan, a.p_region_id, a.phone_no, a.mobile_no, a.fax_no, a.zip_code, a.creation_date, a.created_by, a.updated_date, a.updated_by,
            b.vat_code,
            c.registration_date AS vat_registration_date,
            d.order_no, d. order_date,
            e.region_name AS nama_kota,
            f.region_name AS nama_kecamatan,
            g.region_name AS nama_kelurahan";
    public $fromClause      = " t_cust_account a
                                LEFT JOIN p_vat_type b ON a.p_vat_type_id = b.p_vat_type_id
                                LEFT JOIN t_vat_registration c ON a.t_vat_registration_id = c.t_vat_registration_id
                                LEFT JOIN t_customer_order d ON a.t_customer_order_id = d.t_customer_order_id
                                LEFT JOIN p_region e ON a.p_region_id = e.p_region_id
                                LEFT JOIN p_region f ON a.p_region_id_kecamatan = f.p_region_id
                                LEFT JOIN p_region g ON a.p_region_id_kelurahan = g.p_region_id";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    /*function get_v_cust_acc_dtl_trans($t_vat_setllement_id,$t_cust_account_id){
        $sql = "select  c.trans_date, c.bill_no, c.service_desc, c.service_charge, c.vat_charge 
from t_vat_setllement a, 
t_vat_setllement_dtl b, 
t_cust_acc_dtl_trans c
where a.t_vat_setllement_id = b.t_vat_setllement_id and
      a.t_vat_setllement_id = ? and
      b.t_cust_acc_dtl_trans_id = c.t_cust_acc_dtl_trans_id and
      b.t_cust_account_id = ?";
        
        $output = $this->db->query($sql, array($t_vat_setllement_id,$t_cust_account_id));
        //echo "vat_type->".$p_vat_type_id." tgl ->".$tgl_penerimaan." setoran->".$i_flag_setoran."kode bank -> ".$kode_bank." status->".$status;exit;
        $items = $output->result_array();
        
        return $items;
    }*/

    /**
     * validate
     * input record validator
     */
    public function validate(){
        
        if ($this->actionType == 'CREATE'){
            // TODO : Write your validation for CREATE here
            
        }else if ($this->actionType == 'UPDATE'){
            // TODO : Write your validation for UPDATE here
        }
        
        return true;
    }

}

/* End of file t_cust_account.php */