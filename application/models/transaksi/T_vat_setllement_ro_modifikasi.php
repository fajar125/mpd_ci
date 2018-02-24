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

    public $selectClause    = "d.company_brand,a.no_kohir,sett_type.code as sett_code,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, a.total_penalty_amount, a.settlement_date, a.p_finance_period_id, a.t_cust_account_id, a.npwd, a.total_trans_amount, a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code,
                                d.p_vat_type_id,a.payment_key,a.created_by, f.receipt_no, f.payment_date,
                                g.vat_code";
    public $fromClause      = "t_vat_setllement a
        left join p_finance_period b on  a.p_finance_period_id = b.p_finance_period_id
        left join t_customer_order c on a.t_customer_order_id = c.t_customer_order_id
        left join t_cust_account d on a.t_cust_account_id = d.t_cust_account_id
        left join p_rqst_type e on c.p_rqst_type_id = e.p_rqst_type_id
        left join p_settlement_type sett_type on sett_type.p_settlement_type_id = a.p_settlement_type_id
        left join t_payment_receipt f on a.t_vat_setllement_id = f.t_vat_setllement_id
        left join p_vat_type_dtl g on d.p_vat_type_dtl_id = g.p_vat_type_dtl_id";

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

    function getData($t_vat_setllement_id, $i_mode){
        $sql = "";
        if ($i_mode == 1){  //Data Ayat
            $sql = "SELECT a.*, b.p_vat_type_id, b.nomor_ayat, b.nama_ayat, b.nama_jns_pajak
                FROM  t_vat_setllement AS a
                LEFT JOIN v_p_vat_type_dtl_rep AS b ON a.p_vat_type_dtl_id = b.p_vat_type_dtl_id
                WHERE a.t_vat_setllement_id = ".$t_vat_setllement_id;
        } else if($i_mode == 2){  //Data Tanggal
            $sql = "SELECT t_vat_setllement_id, t_customer_order_id,
                    to_char(settlement_date,'YYYY-MM-DD') AS settlement_date, p_finance_period_id, t_cust_account_id,
                    npwd, total_trans_amount, total_vat_amount, creation_date,
                    created_by, updated_date, updated_by, is_anomali,
                    is_authorized, no_kohir, p_settlement_type_id,
                    debt_vat_amt, cr_adjustment, cr_payment, cr_others,
                    cr_stp, db_interest_charge, db_increasing_charge,
                    db_admin_penalty, due_date, is_settled, start_period,
                    end_period, qty_room_sold, total_penalty_amount, doc_no,
                    p_vat_type_dtl_id, old_id
                    FROM t_vat_setllement
                    WHERE t_vat_setllement_id = ".$t_vat_setllement_id;
        } else if($i_mode == 3){ // Data Total
            $sql = "SELECT * FROM  t_vat_setllement WHERE t_vat_setllement_id = ".$t_vat_setllement_id;

        } else if($i_mode == 4){ // Data Ketetapan
            $sql = "SELECT * FROM t_vat_setllement where t_vat_setllement_id = ".$t_vat_setllement_id;

        } else if($i_mode == 5){   // Data Denda
            $sql = "SELECT * FROM t_vat_setllement where t_vat_setllement_id = ".$t_vat_setllement_id;
        } else if($i_mode == 6){   // Data Denda
            $sql = "SELECT * FROM t_vat_setllement where t_vat_setllement_id = ".$t_vat_setllement_id;
        }

        $query = $this->db->query($sql);
        $item =$query->row_array();
        return $item;
    }

    function ubahData($t_vat_setllement_id, $keyword, $alasan, $flag_piutang, $i_mode){
        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $uname = $userdata['app_user_name'];
        $sql = "";

        if ($i_mode == 1){  //Ubah Data Ayat
            $sql = "SELECT f_update_type_ayat($t_vat_setllement_id,$keyword,'$alasan','$uname') AS msg";
        } else if($i_mode == 2){    //Ubah Data Tanggal
            $sql = "SELECT f_update_tgl_trans($t_vat_setllement_id,'$keyword','$alasan','$uname') AS msg";
        } else if($i_mode == 3){//Ubah Data Total
            $sql = "SELECT f_update_nilai_total_transaksi($t_vat_setllement_id,$keyword,'$alasan','$uname') AS msg";
        } else if($i_mode == 4){  //Ubah Data Ketetapan
            $sql = "SELECT f_update_ketetapan($t_vat_setllement_id,$keyword,'$alasan','$uname') AS msg";
        } else if($i_mode == 5){  //Ubah Data Denda
            $sql = "SELECT f_update_penalty_new2($t_vat_setllement_id,$flag_piutang,$keyword,'$alasan','$uname') AS msg";
        } else if($i_mode == 6){ // Hapus Data Transaksi
            $sql = "SELECT f_del_payment_trans($t_vat_setllement_id,'$uname','$alasan', 0, '') AS msg";

        }

        $query = $this->db->query($sql);

        $item =$query->row_array();
        return $item;
    }

    // function getDataTgl($t_vat_setllement_id){
    //     $sql = "SELECT t_vat_setllement_id, t_customer_order_id,
    //                 to_char(settlement_date,'YYYY-MM-DD') AS settlement_date, p_finance_period_id, t_cust_account_id,
    //                 npwd, total_trans_amount, total_vat_amount, creation_date,
    //                 created_by, updated_date, updated_by, is_anomali,
    //                 is_authorized, no_kohir, p_settlement_type_id,
    //                 debt_vat_amt, cr_adjustment, cr_payment, cr_others,
    //                 cr_stp, db_interest_charge, db_increasing_charge,
    //                 db_admin_penalty, due_date, is_settled, start_period,
    //                 end_period, qty_room_sold, total_penalty_amount, doc_no,
    //                 p_vat_type_dtl_id, old_id
    //                 FROM t_vat_setllement
    //                 WHERE t_vat_setllement_id = ".$t_vat_setllement_id;
    //     $query = $this->db->query($sql);
    //     $item =$query->row_array();
    //     return $item;
    // }

    //function ubahTgl($t_vat_setllement_id, $settlement_date_new, $alasan){
    //    $ci =& get_instance();
    //    $userdata = $ci->session->userdata;
    //    $uname = $userdata['app_user_name'];

    //    $sql = "SELECT f_update_tgl_trans($t_vat_setllement_id,'$settlement_date_new','$alasan','$uname') AS msg";
    //    $query = $this->db->query($sql);

    //    $item =$query->row_array();
    //    return $item;
    //}

}