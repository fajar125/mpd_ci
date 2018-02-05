<?php

/**
 * Icons Model
 *
 */
class T_customer_order extends Abstract_model {

    public $table           = "t_customer_order";
    public $pkey            = "t_customer_order_id";
    public $alias           = "a";

    public $fields          = array(
                                't_customer_order_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Cust Order'),
                                'order_no'           => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'No Urut'),
                                'rqst_type_code'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),

                                'p_rqst_type_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Deskripsi'),
                                'order_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                't_vat_registration_id'            => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Created By'),
                                'p_order_status_id'            => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Created By'),
                                'company_brand'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'npwpd'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                                'description'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),
                                'order_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Order Date'),
                                 'creation_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "a.* ";
    public $fromClause      = "v_customer_order a ";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {

        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $sql = "SELECT * FROM f_order_no(".$this->record['p_rqst_type_id'].")";
        $query = $this->db->query($sql);
        $item = $query->row_array();

        

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            $this->record['p_order_status_id'] = 1;
            $this->record['order_no'] = $item['f_order_no'];
            $this->record['order_date'] = date('Y-m-d');
            $this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $userdata['app_user_name'];
            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];

            $this->record[$this->pkey] = $this->genid();
            // $this->record[$this->pkey] = $this->generate_id($this->table, $this->pkey);


        }else {
            //do something
            //example:
            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];
            //if false please throw new Exception
        }
        return true;
    }

    function submit($t_customer_order_id){
        $ci =& get_instance();
        $userdata = $ci->session->userdata;
/*
        $sql = "select npwpd from t_vat_registration where t_customer_order_id =".$t_customer_order_id;

        $query = $this->db->query($sql);
        $item1 = $query->row_array();
        $npwpd = $item1['npwpd'];

        if ($npwpd == "" || empty($npwpd) || $npwpd == null){
            $sql = "select f_gen_npwpd(".$t_customer_order_id.")as npwpd from dual";
            $query = $this->db->query($sql);
            $item = $query->row_array();
            $tmp = $item['npwpd'];

            if($tmp != "" || empty($tmp) || $tmp == null ){
                $sql = "update t_vat_registration
                        set npwpd = '".$tmp."'
                        where t_customer_order_id =".$t_customer_order_id;
                $query = $this->db->query($sql);
            }
        }
        */
        $sql = "select o_result_code, o_result_msg from f_first_submit_engine(500,".$t_customer_order_id.",'".$userdata['app_user_name']."')";
        $query = $this->db->query($sql);
        $item = $query->row_array();

        return $item;

    }

    function delete($t_customer_order_id){
        try {
            $sql = "DELETE FROM t_customer_order WHERE t_customer_order_id = $t_customer_order_id";
            $query = $this->db->query($sql);
            
            return $query;
        } catch (Exception $e) {
            
        }
    }

    function genid(){
        $sql = "SELECT generate_id('sikp','t_customer_order','t_customer_order_id') as nilai from dual";

        $query = $this->db->query($sql);
        $item = $query->row();

        return $item->nilai;
    }

}

/* End of file Icons.php */