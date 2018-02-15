<?php

/**
 * T_laporan_global_per_wp_per_wilayah Model
 *
 */
class T_laporan_global_per_wp_per_wilayah extends Abstract_model {

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

        /*$sql = "SELECT a.*, 
                        f_get_wilayah(b.npwd) as kode_wilayah , 
                        to_char(b.active_date,'dd-mm-yyyy') as active_date,
                        b.brand_address_name ||' '|| nvl(b.brand_address_no,'') as alamat_new
                FROM    sikp.f_laporan_global_wp2(".
                                                    $param['p_rqst_type_id'].",'".
                                                    $param['date_start']."', '".
                                                    $param['date_end']."') a
                LEFT JOIN t_cust_account b on a.npwpd = b.npwd
                WHERE f_get_wilayah_id(b.npwd) = ".$param['kode_wilayah']. " 
                ORDER BY jenis_pajak,TRIM(company_brand)
                  ";*/

        $sql = "SELECT a.*, 
                        f_get_wilayah(b.npwd) as kode_wilayah , 
                        to_char(b.active_date,'dd-mm-yyyy') as active_date,
                        b.brand_address_name ||' '|| nvl(b.brand_address_no,'') as alamat_new
                FROM    sikp.f_laporan_global_wp2(".
                                                    $param['p_rqst_type_id'].",'".
                                                    $param['date_start']."', '".
                                                    $param['date_end']."') a
                LEFT JOIN t_cust_account b on a.npwpd = b.npwd
                WHERE b.kode_wilayah = '".$param['kode_wilayah']."'
                ORDER BY jenis_pajak,TRIM(company_brand)
                  ";

        //echo $sql;exit;
        $output = $this->db->query($sql);
        $items = $output->result_array();
        
        return $items;
    }

    function dataCombo(){
        $sql = "SELECT code, business_area_name
                FROM p_business_area ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
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

/* End of file T_laporan_global_per_wp_per_wilayah.php */