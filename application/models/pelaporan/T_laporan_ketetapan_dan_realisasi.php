<?php

/**
 * T_laporan_ketetapan_dan_realisasi Model
 *
 */
class T_laporan_ketetapan_dan_realisasi extends Abstract_model {

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
    

    function getData($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $kode_wilayah){
        try {
            $sql = "select to_char(x.active_date,'dd-mm-yyyy') as active_date2,*,
                    case 
                        when payment_date is not null then to_char(payment_date,'dd-mm-yyyy')
                        else ''
                    end as payment_date , '' as rek_code, '' as address_name, 0 as before_des, 0 as des_past, 0 as jan, 0 as feb, 0 as mar, 0 as apr, 0 as mei, 0 as jun, 0 as jul, 0 as ags, 0 as sep, 0 as okt, 0 as nov, 0 as after_nov, 0 as jumlah_per_wp, 0 as jumlah_bulan_bayar, 0 as avg_tap
                from f_rep_bpps_piutang2new_mod_2_per_wilayah($p_vat_type_id, $p_year_period_id, '$tgl_penerimaan', '$tgl_penerimaan_last', 1,'$kode_wilayah') a
                left join t_cust_account x on a.npwpd = x.npwd 
                order by kode_ayat, npwpd, masa_pajak";
            $query = $this->db->query($sql);

            //echo $sql ; exit();

            $items = $query->result_array();
            // print_r($sql);
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

/* End of file p_bank.php */