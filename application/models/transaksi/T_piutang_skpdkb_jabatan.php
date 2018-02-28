<?php

/**
 * Icons Model
 *
 */
class T_piutang_skpdkb_jabatan extends Abstract_model {

    public $table           = "t_vat_setllement";
    public $pkey            = "t_vat_setllement_id";
    public $alias           = "x";

    public $fields          = array(
                                't_vat_setllement_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Room'),
                                'npwd'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Pajak'),
                                'code'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Kode Request'),
                                'no_kohir'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),
                                'payment_key'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'total_trans_amount'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'total_vat_amount'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'company_brand_name'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "x.t_customer_order_id, x.t_vat_setllement_id, x.npwd, a.code, x.no_kohir, x.payment_key, x.total_trans_amount, x.total_vat_amount, trim(b.company_brand) as company_brand_name, c.receipt_no";
    public $fromClause      = "t_vat_setllement x 
									left join p_finance_period a on a.p_finance_period_id = x.p_finance_period_id
									left join t_cust_account b on b.t_cust_account_id = x.t_cust_account_id 
									left join t_payment_receipt c on c.t_vat_setllement_id = x.t_vat_setllement_id";

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

    function getData($s_keyword){
        $sql = "SELECT x.npwd, a.code as finance_period_code, x.no_kohir, x.payment_key, x.total_trans_amount, x.total_vat_amount, trim(b.company_brand) as company_brand_name
                FROM t_vat_setllement x
                left join p_finance_period a on a.p_finance_period_id = x.p_finance_period_id
                left join t_cust_account b on b.t_cust_account_id = x.t_cust_account_id
                WHERE x.p_settlement_type_id = 3
                AND ( upper(x.npwd) LIKE '%".$s_keyword."%'
                OR upper(a.code) LIKE '%".$s_keyword."%' )
                ORDER BY company_brand_name, x.npwd , a.start_date desc";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        return $items;
    }
}