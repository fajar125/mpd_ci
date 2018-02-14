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

    public $selectClause    = " a.*, a.start_period||'-'||a.end_period as masa_pajak, b.receipt_no";
    public $fromClause      = " v_vat_setllement_skpd_kb_jabatan a
								left join t_payment_receipt b on a.t_vat_setllement_id = b.t_vat_setllement_id";

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
   

    function submit($t_customer_order_id, $payment_key, $p_vat_type_id, $t_vat_setllement_id){
        $ci =& get_instance();
        $userdata = $ci->session->userdata;

        
        $qq = '';
        if ($payment_key == '' || $payment_key == null || $payment_key == false || $payment_key == 'undefined' || $payment_key == 'null'){
            $q = "SELECT  substr(code, 3, 2) as vat_code from p_vat_type where p_vat_type_id = $p_vat_type_id";
            $query = $this->db->query($q);
            $data1 = $query->row_array();
            $ls_vat_type_code = $data1['vat_code'];

            $sql = "SELECT * FROM f_get_payment_key_pjdl('".$userdata['app_user_name']."', '".$ls_vat_type_code."')";
            $query = $this->db->query($sql);
            $data2 = $query->row_array();

            $qq = "UPDATE sikp.t_vat_setllement
                       SET 
                           payment_key=?
                     WHERE t_vat_setllement_id=?;";
            $query = $this->db->query($qq, array($data2['f_get_payment_key_pjdl'], $t_vat_setllement_id));

            //$data = $query->row_array();

        }


        $sql = "SELECT o_result_code, o_result_msg from f_first_submit_engine(501,$t_customer_order_id,'".$userdata['app_user_name']."')";
        //echo $sql; exit();
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data;
    }

    

}

/* End of file t_piutang_skpd.php */