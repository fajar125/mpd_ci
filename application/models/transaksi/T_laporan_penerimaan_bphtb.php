<?php

/**
 * T_laporan_penerimaan_bphtb Model
 *
 */
class t_laporan_penerimaan_bphtb extends Abstract_model {

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

    function getExcel($param = array()){

        $whereClause='';
        $criteria = array();

        if ($param['start_date'] != '' && $param['end_date']!='')
            $criteria[] = " (trunc(a.payment_date) BETWEEN '".$param['start_date']."' AND '".$param['end_date']."') ";

        if ($param['no_transaksi'] != '' )
            $criteria[] = " a.receipt_no ILIKE '%".$param['no_transaksi']."%' ";

        if ($param['nop'] != '' )
            $criteria[] = " b.njop_pbb = '".$param['nop']."' ";

        if ($param['nama'] != '' )
            $criteria[] = " b.wp_name ILIKE '%".$param['nama']."%' ";

        if ($param['kec'] != '' )
            $criteria[] = " b.object_p_region_id_kec = ".$param['kec'];

        if ($param['kel'] != '' )
            $criteria[] = " b.object_p_region_id_kel = ".$param['kel'];

        if ($param['jenis_transaksi'] != '' )
            $criteria[] = " b.p_bphtb_legal_doc_type_id = ".$param['jenis_transaksi'];

        if ($param['nama_pemeriksa'] != '' )
            $criteria[] = " b.verificated_by ilike '%".$param['nama_pemeriksa']."%' ";

        $whereClause = join(" AND ", $criteria);

        $sql = "SELECT 
                    a.receipt_no, 
                    b.njop_pbb, 
                    to_char(a.payment_date, 'YYYY-MM-DD') AS payment_date, 
                    to_char(b.creation_date, 'YYYY-MM-DD') AS creation_date, 
                    b.t_ppat_id, 
                    b.wp_name, 
                    b.wp_address_name, 
                    kelurahan.region_name AS kelurahan_name, 
                    kecamatan.region_name AS kecamatan_name, 
                    b.land_area, 
                    b.building_area, 
                    b.land_total_price, 
                    a.payment_amount, 
                    b.verificated_by, 
                    market_price,
                    building_total_price+land_total_price as njop, 
                    c.description, 
                    kelurahan_objek.region_name AS kelurahan_objek_name, 
                    kecamatan_objek.region_name AS kecamatan_objek_name,
                    object_address_name 
                FROM t_payment_receipt_bphtb AS a 
                    LEFT JOIN t_bphtb_registration AS b 
                ON a.t_bphtb_registration_id = b.t_bphtb_registration_id 
                    LEFT JOIN p_region AS kelurahan 
                ON b.wp_p_region_id_kel = kelurahan.p_region_id 
                    LEFT JOIN p_region AS kecamatan 
                ON b.wp_p_region_id_kec = kecamatan.p_region_id 
                    LEFT JOIN p_bphtb_legal_doc_type c 
                on c.p_bphtb_legal_doc_type_id = b.p_bphtb_legal_doc_type_id 
                    LEFT JOIN p_region AS kelurahan_objek 
                ON b.object_p_region_id_kel = kelurahan_objek.p_region_id 
                    LEFT JOIN p_region AS kecamatan_objek 
                ON b.object_p_region_id_kec = kecamatan_objek.p_region_id";

        if(!empty($whereClause))
            $sql.= " WHERE ".$whereClause;

        $sql.= " ORDER BY a.receipt_no ASC";

       // return $sql;

        $output = $this->db->query($sql);
        $items = $output->result_array();

        if ($items == null || $items == '')
            $items = 'no result';
        
        return $items;
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