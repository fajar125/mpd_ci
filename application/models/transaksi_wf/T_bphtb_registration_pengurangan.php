<?php

/**
 * T_bphtb_registration_pengurangan Model
 *
 */
class T_bphtb_registration_pengurangan extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";

    public $selectClause    = "j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
        j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,
        to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,
        j.nomor_berita_acara, j.nomor_notaris,
        k.pemeriksa_nama as nama_pemeriksa, k.pemeriksa_nip as nip_pemeriksa, k.pemeriksa_jabatan as jabatan_pemeriksa,
        l.pemeriksa_nama as nama_operator, l.pemeriksa_nip as nip_operator, l.pemeriksa_jabatan as jabatan_operator,
        a.*,
        cust_order.p_rqst_type_id,
        b.region_name as wp_kota,
        c.region_name as wp_kecamatan,
        d.region_name as wp_kelurahan,
        e.region_name as object_region,
        f.region_name as object_kecamatan,
        g.region_name as object_kelurahan,
        h.description as doc_name ";
    public $fromClause      = "t_bphtb_exemption as j
                                left join t_bphtb_registration as a  on j.t_bphtb_registration_id = a.t_bphtb_registration_id
                                left join p_region as b
                                    on a.wp_p_region_id = b.p_region_id
                                left join p_region as c
                                    on a.wp_p_region_id_kec = c.p_region_id
                                left join p_region as d
                                    on a.wp_p_region_id_kel = d.p_region_id
                                left join p_region as e
                                    on a.object_p_region_id = e.p_region_id
                                left join p_region as f
                                    on a.object_p_region_id_kec = f.p_region_id
                                left join p_region as g
                                    on a.object_p_region_id_kel = g.p_region_id
                                left join p_bphtb_legal_doc_type as h
                                    on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
                                left join t_customer_order as cust_order
                                    on cust_order.t_customer_order_id = a.t_customer_order_id
                                left join t_bphtb_exemption_pemeriksa as k
                                   on j.pemeriksa_id = k.t_bphtb_exemption_pemeriksa_id
                                left join t_bphtb_exemption_pemeriksa as l
                                    on j.administrator_id = l.t_bphtb_exemption_pemeriksa_id";

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
            
            /*$this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $userdata['app_user_name'];

            $this->record[$this->pkey] = $this->generate_id($this->table, $this->pkey);*/

        }else {
            //do something
            //example:
            /*$this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $userdata['app_user_name'];*/
            //if false please throw new Exception
        }
        return true;
    }

}

/* End of file T_bphtb_registration_pengurangan.php */