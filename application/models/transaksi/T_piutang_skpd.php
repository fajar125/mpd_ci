<?php

/**
 * t_piutang_skpd Model
 *
 */
class T_piutang_skpd extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = array();

    public $selectClause    = " a.*";
    public $fromClause      = " v_vat_setllement_skpd_kb_jabatan a";

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
            /*$this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $userdata['app_user_name'];*/
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

    function updateDenda($t_vat_setllement_id){
        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $sql = "SELECT f_hitung_ulang_denda_v2 as hasil FROM 
                f_hitung_ulang_denda_v2(".$t_vat_setllement_id.",'".$userdata['app_user_name']."')";
        //echo $sql; exit();
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data['hasil'];
    }

    function submit($t_customer_order_id){
        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $sql = "SELECT o_result_code, o_result_msg from f_first_submit_engine(501,$t_customer_order_id,'".$userdata['app_user_name']."')";
        //echo $sql; exit();
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data;
    }

    

}

/* End of file t_piutang_skpd.php */