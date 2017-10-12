<?php

/**
 * Icons Model
 *
 */
class T_vat_reg_dtl_ppj extends Abstract_model {

    public $table           = "t_vat_reg_dtl_ppj";
    public $pkey            = "t_vat_reg_dtl_ppj_id";
    public $alias           = "a";

    public $fields          = array(
                                't_vat_reg_dtl_ppj_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Cust Order'),
                                't_vat_registration_id'  => array('type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Cust Order'),
                                'p_license_type_id'           => array('nullable' => true, 'type' => 'int', 'unique' => true, 'display' => 'No Urut'),
                                'license_no'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Nomor Surat'),
                                'valid_from'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Berlaku Dari'),
                                'valid_to'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Berlaku Sampai'),
                                'description'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),
                                 'creation_date'         => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "a.*";
    public $fromClause      = "v_vat_reg_dtl_ppj a";
    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {
        

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

    
    

}

/* End of file Icons.php */