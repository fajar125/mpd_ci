<?php

/**
 * p_app_role Model
 *
 */
class P_app_role extends Abstract_model {

    public $table           = "p_app_role";
    public $pkey            = "p_app_role_id";
    public $alias           = "role";

    public $fields          = array(
                                'p_app_role_id'             => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Role'),
                                'code'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Role Name'),
                                'description'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Description'),
                                //'is_active'           => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Status'),

								'valid_from'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Valid From'),
								'valid_to'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Valid To'),
								
                                'creation_date'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'created_by'        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'updated_date'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),

                            );

    public $selectClause    = "role.* ";
    public $fromClause      = "p_app_role role";

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
            //$this->record['creation_date'] = date('Y-m-d');
            //$this->record['updated_date'] = date('Y-m-d');

            $this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $userdata['app_user_name'];
            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];
			
			$this->db->set('valid_from',"sysdate",false);
			$this->db->set('valid_to',"null",false);

            $this->record[$this->pkey] = $this->generate_id($this->table, $this->pkey);

        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception

            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $userdata['app_user_name'];

        }
        return true;
    }

}

/* End of file Groups.php */