<?php

/**
 * Bank Model
 *
 */
class P_bank extends Abstract_model {

    public $table           = "p_bank";
    public $pkey            = "p_bank_id";
    public $alias           = "bnk";

    public $fields          = array(
                                'p_bank_id'       => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'License Type ID'),
                                'code'    => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Kode'),
                                'bank_name'     => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Nama Bank'),
                                'description'     => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Deskripsi'),

                                
                                'updated_date'  => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "bnk.*";
    public $fromClause      = "p_bank bnk";

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