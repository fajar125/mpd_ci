<?php

/**
 * Icons Model
 *
 */
class T_target_realisasi extends Abstract_model {

    public $table           = "v_target_realisasi_updated";
    public $pkey            = "p_year_period_id";
    public $alias           = "vt";

    public $fields          = array(
                                'p_year_period_id'             => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Icon'),
                                'year_code'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Icon Code'),
                                'target_amt'    => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Icon Description'),
                                 'realisasi_amt'    => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Icon Description')
                            );

    public $selectClause    = "vt.*, round((realisasi_amt/target_amt*100), 2) as persentase, 
    (realisasi_amt-target_amt) as selisih, 
    round(((realisasi_amt/target_amt*100)-100), 2) as persen_selisih";
    public $fromClause      = "v_target_realisasi_updated vt";

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

}

/* End of file Icons.php */