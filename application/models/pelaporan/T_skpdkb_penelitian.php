<?php

/**
 * t_skpdkb_penelitian Model
 *
 */
class T_skpdkb_penelitian extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";

    public $selectClause    = " to_char(a.settlement_date,'dd-mm-yyyy') as settlement_date,
                                x.receipt_no,
                                wp_name,
                                a.npwd,
                                z.code,
                                a.total_vat_amount";
    public $fromClause      = "t_vat_setllement a
                                    left join t_payment_receipt x 
                                on a.t_vat_setllement_id=x.t_vat_setllement_id 
                                    left join t_cust_account y 
                                on y.t_cust_account_id = a.t_cust_account_id
                                    left JOIN p_finance_period z 
                                on z.p_finance_period_id = a.p_finance_period_id";

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
            
            $this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $userdata['app_user_name'];

            $this->record[$this->pkey] = $this->generate_id($this->table, $this->pkey);

        }else {
            //do something
            //example:
            $this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $userdata['app_user_name'];
            //if false please throw new Exception
        }
        return true;
    }

}

/* End of file p_bank.php */