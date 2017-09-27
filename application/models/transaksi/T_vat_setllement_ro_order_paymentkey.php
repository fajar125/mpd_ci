<?php

/**
 * Icons Model
 *
 */
class T_vat_setllement_ro_order_paymentkey extends Abstract_model {

    public $table           = "t_vat_setllement";
    public $pkey            = "t_vat_setllement_id";
    public $alias           = "sett";
    public $selectClause    = " sett.*, vat_type.code||' '||dtl.code as no_ayat, settlement_type.code as settlement_type_code, payment_receipt.p_payment_type_id, payment_receipt.receipt_no";
    public $fromClause      = "v_vat_setllement_ro_paymentkey sett
                            left join p_vat_type_dtl dtl on sett.p_vat_type_dtl_id = dtl.p_vat_type_dtl_id
                            left join p_vat_type vat_type on vat_type.p_vat_type_id = dtl.p_vat_type_id
                            left join p_settlement_type settlement_type on sett.p_settlement_type_id = settlement_type.p_settlement_type_id
                            left join t_payment_receipt payment_receipt ON sett.t_vat_setllement_id = payment_receipt.t_vat_setllement_id";

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

    function getCustOrder($payment_key){
        $sql = "SELECT t_customer_order_id FROM t_vat_setllement WHERE payment_key='".$payment_key."'";
        $query = $this->db->query($sql);
        $item = $query->row_array();
        return $item;
    }

    function insertUpdate($cust_order_id,$p_payment_type_id){


        $ci =& get_instance();
        $userdata = $ci->session->userdata;

        $sql = "SELECT * FROM f_payment_manual_paymentkey_v3(?,?,?)";

        $query = $this->db->query($sql, array($cust_order_id,$userdata['app_user_name'],$p_payment_type_id));
        $item = $query->row_array();
        
            
        return $item;
    }
}