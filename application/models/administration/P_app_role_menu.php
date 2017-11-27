<?php

/**
 * Role Menu Model
 *
 */
class P_app_role_menu extends Abstract_model {

    public $table           = "p_app_role_menu";
    public $pkey            = "p_app_role_menu_id";
    public $alias           = "rm";

    public $fields          = array(
								'p_app_role_menu_id'     => array('pkey' => true,'nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Role Menu ID'),
                                'p_app_menu_id'     => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Menu ID'),
                                'p_app_role_id'    => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Role ID'),

								'valid_from'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Valid From'),
								'valid_to'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Valid To'),
								
                                'creation_date'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Created Date'),
                                'created_by'        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'updated_date'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'updated_by'        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),
                            );

    public $selectClause    = "p_app_role_menu_id AS id,
                                rm.p_app_menu_id, rm.p_app_role_id, m.code, m.file_name, m.listing_no";
    public $fromClause      = "p_app_role_menu rm
                               left join p_app_menu m on rm.p_app_menu_id = m.p_app_menu_id";

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

    public function getItem($p_app_role_id, $p_app_menu_id) {
        $sql = "select * from p_app_role_menu where p_app_role_id = ? and p_app_menu_id = ?";
        $query = $this->db->query($sql, array($p_app_role_id, $p_app_menu_id));

        $result = $query->row();
        return $result;
    }

    public function deleteItem($p_app_role_id, $p_app_menu_id) {
        $sql = "delete from p_app_role_menu where p_app_role_id = ? and p_app_menu_id = ?";
        $this->db->query($sql, array($p_app_role_id, $p_app_menu_id));

    }

}

/* End of file p_app_role_menu.php */