<?php

/**
 * t_rep_sisa_piutang Model
 *
 */
class t_rep_sisa_piutang extends Abstract_model {
	public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";

    public $selectClause    = "";
    public $fromClause      = "";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function getDataRepPiutang($p_vat_type_id, $p_finance_period_id, $status){
    	if(empty($status)){
    		$sql = "SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.* 
				FROM f_rep_status_piutang (?, ?, 1) a
				left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
				ORDER BY company_brand, npwd";
    	}elseif ($status == "1") {
    		$sql = "SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.*
						FROM f_rep_status_piutang2 (?, ?, 1) a
						left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
						WHERE ((f_teg1_amount is null) OR (f_teg1_amount < 1)) AND
							  ((f_teg2_amount is null) OR (f_teg2_amount < 1)) AND
							  ((f_teg3_amount is null) OR (f_teg3_amount < 1))
							  AND NOT textregexeq(f_action_sts,'^[[:digit:]]+(\.[[:digit:]]+)?$')
						ORDER BY company_brand, npwd";
    	}elseif ($status == "2") {
    		$sql = "SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.*, (f_amount IS NULL AND f_teg1_amount IS NULL AND f_teg2_amount IS NULL AND f_teg3_amount IS NULL AND f_action_sts > 0) AS bayar_setelah
						FROM f_rep_status_piutang (?, ?, 1) a
						left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
						WHERE (f_teg1_amount > 0) OR 
							  (f_teg2_amount > 0) OR 
							  (f_teg3_amount > 0) 
							  OR textregexeq(f_action_sts,'^[[:digit:]]+(\.[[:digit:]]+)?$')
						ORDER BY company_brand, npwd";
    	}

    	$output = $this->db->query($sql, array($p_vat_type_id, $p_finance_period_id));
    	$items = $output->result_array();

    	if ($items == null || $items == '')
            $items = 'no result';

        return $items;
    }


    function getJatuhTempo($p_finance_period_id){
    	$sql = "SELECT to_char((trunc(start_date) + due_in_day-1),'yyyy-mm-dd') AS jatuh_tempo
							FROM p_finance_period WHERE to_char(trunc(start_date),'yyyy-mm-dd') IN 
							( 	SELECT to_char((trunc(end_date) + 1), 'yyyy-mm-dd') 
								FROM p_finance_period 
								WHERE p_finance_period_id = ?)";

		$output = $this->db->query($sql, array($p_finance_period_id));

    	$items = $output->result_array();

    	return $items[0]['jatuh_tempo'];
    }
}

