<?php

/**
 * Icons Model
 *
 */
class T_vat_setllement_ro_modifikasi extends Abstract_model {

    public $table           = "t_vat_setllement";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = array();

    public $selectClause    = "d.company_brand,a.no_kohir,sett_type.code as sett_code,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, a.total_penalty_amount, a.settlement_date, a.p_finance_period_id, a.t_cust_account_id, a.npwd, a.total_trans_amount, a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code, d.p_vat_type_id,a.payment_key,a.created_by";
    public $fromClause      = "t_vat_setllement a
        left join p_finance_period b on  a.p_finance_period_id = b.p_finance_period_id
        left join t_customer_order c on a.t_customer_order_id = c.t_customer_order_id
        left join t_cust_account d on a.t_cust_account_id = d.t_cust_account_id
        left join p_rqst_type e on c.p_rqst_type_id = e.p_rqst_type_id 
        left join p_settlement_type sett_type on sett_type.p_settlement_type_id = a.p_settlement_type_id";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {

        $ci =& get_instance();
        $userdata = $ci->session->userdata;

        if($this->actionType == 'CREATE') {
            //do something
            

        }else {
            //do something
            
        }
        return true;
    }
}