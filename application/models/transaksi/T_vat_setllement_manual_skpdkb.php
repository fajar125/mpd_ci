<?php

/**
 * Icons Model
 *
 */
class T_vat_setllement_manual_skpdkb extends Abstract_model {

    public $table           = "p_rqst_type";
    public $pkey            = "p_rqst_type_id";
    public $alias           = "pp";

    public $fields          = array(
                                'p_rqst_type_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Room'),
                                'p_vat_type_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Pajak'),
                                'code'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Kode Request'),
                                'description'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),
                                'creation_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "pp.*";
    public $fromClause      = "p_rqst_type pp ";

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
            $this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $userdata['app_user_name'];
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

    function insertUpdate($cust_acc_id,$period,$npwd,$ms_start,$ms_end,$kamar,$tot,$p_vat_type_dtl_id,$p_vat_type_dtl_cls_id){


        $ci =& get_instance();
        $userdata = $ci->session->userdata;

        $sql = "SELECT * FROM f_vat_settlement_manual_skpdkb(?,?,?,?,?,?,?,?,?,?)";

        $query = $this->db->query($sql, array($cust_acc_id,$period,$npwd,$ms_start,$ms_end,$kamar,$tot,$p_vat_type_dtl_id,$p_vat_type_dtl_cls_id,$userdata['app_user_name']));
        $item = $query->row_array();
        if(!$item['o_cust_order_id'] == 0 && !$item['o_cust_order_id'] == ""){
            $sql2 = "select * from f_first_submit_engine_2step( 501, ".$item['o_cust_order_id'].", '".$userdata['app_user_name']."')";
            $query2 = $this->db->query($sql2);
            $item2 = $query->row_array();

        }
        
            
        return $item;
    }

    

    

}

/* End of file Icons.php */