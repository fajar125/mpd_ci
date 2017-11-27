<?php

/**
 * t_cust_account.php Model
 *
 */
class T_cust_account extends Abstract_model {

    public $table           = "v_cust_account_update";
    public $pkey            = "t_cust_account_id";
    public $alias           = "cust";

    public $fields          = array(
                                't_cust_account_id'  => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Cust Account'),
                                't_customer_id'    => array('type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Customer'),
                                'npwpd'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'NPWPD'),
                                'p_vat_type_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Jenis Pajak'),
                                'p_vat_registration_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Registration'),
                                't_customer_order_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Order Customer'),                                
                                'registration_date'    => array('nullable' => false, 'type' => 'date', 'unique' => false, 'display' => 'Date Registrasi'),
                                'company_name'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Company'),
                                'company_brand'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Merk'),
                                'address_name'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Alamat'),
                                'address_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'No'),
                                'address_rt'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'RT'),
                                'address_rw'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'RW'),
                                'p_region_id_kelurahan'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Kelurahan'),
                                'p_region_id_kecamatan'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Kecamatan'),
                                'p_region_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Kecamatan'),
                                'phone_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'No Telepon'),
                                'mobile_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'No Hp'),
                                'fax_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Fax'),
                                'zip_code'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Kode Pos'),
                                'creation_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Creation Date'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
                                'update_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
                                'update_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By'),
                                'vat_code'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Jenis Pajak'),
                                'vat_registration_date'           => array('nullable' => false, 'type' => 'date', 'unique' => false, 'display' => 'Tanggal Pajak Registrasi'),
                                'order_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nomor Order'),
                                'order_date'           => array('nullable' => false, 'type' => 'date', 'unique' => false, 'display' => 'Tanggal Order'),
                                'nama_kota'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Kota'),
                                'nama_kecamatan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Kecamatan'),
                                'nama_kelurahan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Kelurahan'),
                                'wp_name'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama WP'),
                                'wp_address_name'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Alamat WP'),
                                'wp_address_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'No WP'),
                                'wp_address_rt'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'RT WP'),
                                'wp_address_rw'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'RW WP'),
                                'wp_p_region_id_kecamatan'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID WP Kecamatan'),
                                'wp_p_region_id_kelurahan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'ID WP Kelurahan'),
                                'wp_kota'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'WP Kota'),
                                'wp_kelurahan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'WP Kelurahan'),
                                'wp_kecamatan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'WP Kecamatan'),
                                'brand_kota'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Brand Kota'),
                                'brand_kelurahan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Brand Kelurahan'),
                                'brand_kecamatan'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Brand Kecamatan'),
                                'wp_p_region_id'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'ID WP Region'),
                                'wp_phone_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Telepon WP'),
                                'wp_mobile_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'No Hp WP'),
                                'wp_fax_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Fax WP'),
                                'wp_zip_code'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Kode Pos WP'),
                                'wp_email'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'WP Email'),
                                'brand_address_name'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Alamat Brand'),
                                'brand_address_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'No Alamat Brand'),
                                'brand_address_rt'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'RT Brand'),
                                'brand_address_rw'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'RW Brand'),
                                'brand_p_region_id_kel'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Brand Kelurahan'),
                                'brand_p_region_id_kec'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Brand Kecamatan'),
                                'brand_p_region_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Brand Region'),
                                'brand_phone_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Brand Telepon'),
                                'brand_mobile_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'HP Brand'),
                                'brand_fax_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Brand Fax'),
                                'brand_zip_code'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Brand Kode Pos'),
                                'p_account_status_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Status Account'),
                                'active_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tanggal Aktif'),
                                'last_satatus_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tanggal Status Terakhir'),
                                'activation_no'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nomor AKtifasi'),
                                'p_vat_type_dtl_id'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Detail Jenis Pajak'),
                                'nama_ayat'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Ayat'),
                                'status_code'           => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Status Kode'),
                            );

    public $selectClause    = "cust.*";
    public $fromClause      = "v_cust_account_update cust";

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
            //$this->record['p_vat_type_id'] = $_POST['p_vat_type_id'];
            //$this->db->set('p_vat_type_id',$_GET['p_vat_type_id'],false);
            //$this->record['valid_from'] = date('Y-m-d', $time);

            $this->record[$this->pkey] = $this->generate_id($this->table, $this->pkey);

        }else {
            //do something
            //example:
            $this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $userdata['app_user_name'];
           // $this->record['valid_from'] = date('Y-m-d', $time);
            //if false please throw new Exception
        }
        return true;
    }

}

/* End of file t_cust_account.php */