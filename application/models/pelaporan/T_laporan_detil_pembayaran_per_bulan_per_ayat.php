<?php

/**
 * T_history Model
 *
 */
class T_laporan_detil_pembayaran_per_bulan_per_ayat extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";

    public $selectClause    = "f_get_wilayah(b.npwd) as wilayah,e.vat_code as jenis_pajak,
                                f.vat_code as ayat_pajak,d.code as masa_pajak,
                                to_char(payment_date,'dd-mm-yyyy') as tanggal_bayar,*";
    public $fromClause      = "from t_vat_setllement a
                                left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
                                left join t_payment_receipt c on c.t_vat_setllement_id=a.t_vat_setllement_id
                                LEFT JOIN p_finance_period d on d.p_finance_period_id=a.p_finance_period_id
                                left join p_vat_type e on e.p_vat_type_id = b.p_vat_type_id
                                left join p_vat_type_dtl f on f.p_vat_type_dtl_id = b.p_vat_type_dtl_id";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function getData($kode_wilayah, $npwpd_jabatan, $tgl_penerimaan, $tgl_penerimaan_last){
        try {
            $sql=" select 
                        f_get_wilayah(b.npwd) as wilayah,e.vat_code as jenis_pajak,
                        f.vat_code as ayat_pajak,d.code as masa_pajak,
                        to_char(payment_date,'dd-mm-yyyy') as tanggal_bayar,*
                    from t_vat_setllement a
                        left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
                        left join t_payment_receipt c on c.t_vat_setllement_id=a.t_vat_setllement_id
                        LEFT JOIN p_finance_period d on d.p_finance_period_id=a.p_finance_period_id
                        left join p_vat_type e on e.p_vat_type_id = b.p_vat_type_id
                        left join p_vat_type_dtl f on f.p_vat_type_dtl_id = b.p_vat_type_dtl_id
                    where p_account_status_id = 1 
                        and c.t_payment_receipt_id is not null
                        and trunc(payment_date) between to_date('".$tgl_penerimaan."','dd-mm-yyyy') and to_date('".$tgl_penerimaan_last."','dd-mm-yyyy')
                        and case when ".$npwpd_jabatan." = 1 then true else npwpd_jabatan='Y' end
                        and case when '".$kode_wilayah."' = 'semua' then true 
                            when '".$kode_wilayah."' = 'lainnya' then f_get_wilayah(b.npwd)='-' 
                            else '".$kode_wilayah."' = f_get_wilayah(b.npwd) end
                    order by wilayah, company_brand, b.npwd, d.start_date";

            $query = $this->db->query($sql);
            /*die($sql);
            exit;*/
            $items = $query->result_array();

            if ($items == null || $items == '')
                $items = 'no result';
            // print_r($items);
            // exit();
            return $items;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

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

/* End of file T_history.php */