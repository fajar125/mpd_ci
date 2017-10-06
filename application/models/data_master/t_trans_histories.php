<?php

/**
 * t_trans_histories Model
 *
 */
class t_trans_histories extends Abstract_model {

    public $table           = "t_vat_setllement";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";

    /* Display fields */
    public $displayFields = array();
    /* Details table */
    public $details = array();

    public $refs            = array();

    public $selectClause    = "nvl(nama,data_transaksi.company_name)as new_company_name, masa_awal, masa_akhir,data_transaksi.*, periode_awal_laporan||' s/d '||periode_akhir_laporan as periode_transaksi, tcust.t_customer_id";
    public $fromClause      = "(select 
                                *
                                from 
                                    (Select c.npwd, 
                                                 a.t_vat_setllement_id, 
                                                     c.company_name, 
                                                     b.code as Periode_pelaporan, 
                                                     to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
                                                     a.total_trans_amount as total_transaksi,
                                                     a.total_vat_amount as total_pajak ,
                                                 nvl(a.total_penalty_amount,0) as total_denda,
                                                     d.receipt_no as kuitansi_pembayaran,
                                                     to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
                                                     d.payment_amount,
                                                     c.t_cust_account_id ,
                                                     b.p_finance_period_id ,
                                                     to_char(a.start_period,'DD-MON-YYYY') as periode_awal_laporan,
                                                     to_char(a.end_period,'DD-MON-YYYY') as periode_akhir_laporan,
                                                     e.code as type_code,
                                                     nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) as debt_vat_amt,
                                                     nvl(a.db_increasing_charge,0) as db_increasing_charge,
                                                     nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) + nvl(a.db_increasing_charge,0) +nvl(a.db_interest_charge,0) + nvl(a.total_penalty_amount,0) as total_hrs_bayar,
                                                     nvl(a.db_increasing_charge,0) as kenaikan,
                                                     nvl(a.db_interest_charge,0) as kenaikan1,
                                                     a.p_vat_type_dtl_id,
                                                     a.no_kohir,
                                                     to_char(a.due_date,'DD-MON-YYYY') as jatuh_tempo,
                                                     settlement_date,
                                                     b.start_date
                                        from t_vat_setllement a,
                                                 p_finance_period b,
                                                 t_cust_account c,
                                                 t_payment_receipt d,
                                                 p_settlement_type e
                                        where a.p_finance_period_id = b.p_finance_period_id
                                                    and a.t_cust_account_id = c.t_cust_account_id
                                                    %s
                                                    and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
                                                and a.p_settlement_type_id = e.p_settlement_type_id) as hasil
                                left join p_vat_type_dtl x on x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id) as data_transaksi

                            left join t_cust_acc_masa_jab masa_jab
                                on masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id
                                and masa_awal <= settlement_date
                                and
                                    case 
                                        when masa_akhir is NULL
                                            then true
                                        when masa_akhir >= settlement_date
                                            then masa_akhir >= settlement_date
                                    end
                            left join t_cust_account tcust
                            on tcust.t_cust_account_id = data_transaksi.t_cust_account_id";

    function __construct($t_cust_account_id = '') {
        if (!empty($t_cust_account_id)){
            $this->fromClause = sprintf($this->fromClause, "and a.t_cust_account_id = ".$t_cust_account_id);
        }else{
            $this->fromClause = sprintf($this->fromClause, 'and a.t_cust_account_id = -999');
        }
        parent::__construct();
    }

    function get_t_trans_histories($t_cust_account_id){
        $sql = "select nvl(nama,data_transaksi.company_name)as new_company_name, masa_awal, masa_akhir,data_transaksi.*, periode_awal_laporan||' s/d '||periode_akhir_laporan as periode_transaksi, tcust.t_customer_id 
            from 
                    (select 
                    *
                    from 
                        (Select c.npwd, 
                                     a.t_vat_setllement_id, 
                                         c.company_name, 
                                         b.code as Periode_pelaporan, 
                                         to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
                                         a.total_trans_amount as total_transaksi,
                                         a.total_vat_amount as total_pajak ,
                                     nvl(a.total_penalty_amount,0) as total_denda,
                                         d.receipt_no as kuitansi_pembayaran,
                                         to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
                                         d.payment_amount,
                                         c.t_cust_account_id ,
                                         b.p_finance_period_id ,
                                         to_char(a.start_period,'DD-MON-YYYY') as periode_awal_laporan,
                                         to_char(a.end_period,'DD-MON-YYYY') as periode_akhir_laporan,
                                         e.code as type_code,
                                         nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) as debt_vat_amt,
                                         nvl(a.db_increasing_charge,0) as db_increasing_charge,
                                         nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) + nvl(a.db_increasing_charge,0) +nvl(a.db_interest_charge,0) + nvl(a.total_penalty_amount,0) as total_hrs_bayar,
                                         nvl(a.db_increasing_charge,0) as kenaikan,
                                         nvl(a.db_interest_charge,0) as kenaikan1,
                                         a.p_vat_type_dtl_id,
                                         a.no_kohir,
                                         to_char(a.due_date,'DD-MON-YYYY') as jatuh_tempo,
                                         settlement_date,
                                         b.start_date
                            from t_vat_setllement a,
                                     p_finance_period b,
                                     t_cust_account c,
                                     t_payment_receipt d,
                                     p_settlement_type e
                            where a.p_finance_period_id = b.p_finance_period_id
                                        and a.t_cust_account_id = c.t_cust_account_id
                                    and a.t_cust_account_id = ?
                                        and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
                                    and a.p_settlement_type_id = e.p_settlement_type_id) as hasil
                    left join p_vat_type_dtl x on x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id) as data_transaksi

                left join t_cust_acc_masa_jab masa_jab
                    on masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id
                    and masa_awal <= settlement_date
                    and
                        case 
                            when masa_akhir is NULL
                                then true
                            when masa_akhir >= settlement_date
                                then masa_akhir >= settlement_date
                        end
                left join t_cust_account tcust
                on tcust.t_cust_account_id = data_transaksi.t_cust_account_id

                ORDER BY npwd, start_date desc, t_vat_setllement_id";
        
        $output = $this->db->query($sql, array($t_cust_account_id));
        //echo "id cust ->".$t_cust_account_id;exit;
        $items = $output->result_array();
        
        return $items;
    }
   
        
       

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

