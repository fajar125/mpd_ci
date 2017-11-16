<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Groups_controller
* @version 07/05/2015 12:18:00
*/
class Data_potensi_ro_otobuk_controller {

	function read_pegawai() {
		$page = getVarClean('page','int',1);
	    $limit = getVarClean('rows','int',5);
	    $t_cust_account_id = getVarClean('t_cust_account_id','int',0);
	    
	    $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

	    try {

	        $ci = & get_instance();
	        $ci->load->model('transaksi_wf/data_potensi_ro_otobuk');
	        $table = $ci->data_potensi_ro_otobuk;

	        $result = $table->potensi_pegawai($t_cust_account_id);
	       
	        $count = count($result);

	        if ($count > 0) $total_pages = ceil($count / $limit);
	        else $total_pages = 1;

	        if ($page > $total_pages) $page = $total_pages;
	        $start = $limit * $page - ($limit); // do not put $limit*($page - 1)


	        $data['items'] = $result;
	        $data['success'] = true;

	    }catch (Exception $e) {
	        $data['message'] = $e->getMessage();
	    }

	    return $data;
	}

	function read_data_pajak() {
		$page = getVarClean('page','int',1);
	    $limit = getVarClean('rows','int',5);
	    $t_cust_account_id = getVarClean('t_cust_account_id','int',0);
	    $jenis_pajak = getVarClean('jenis_pajak','str','');

	    $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

	    try {

	        $ci = & get_instance();
	        $ci->load->model('transaksi_wf/data_potensi_ro_otobuk');
	        $table = $ci->data_potensi_ro_otobuk;

	        $result = $table->data_pajak($jenis_pajak, $t_cust_account_id);
	       
	        $count = count($result);

	        if ($count > 0) $total_pages = ceil($count / $limit);
	        else $total_pages = 1;

	        if ($page > $total_pages) $page = $total_pages;
	        $start = $limit * $page - ($limit); // do not put $limit*($page - 1)


	        $data['items'] = $result;
	        $data['success'] = true;

	    }catch (Exception $e) {
	        $data['message'] = $e->getMessage();
	    }

	    return $data;
	}

	function read_log(){
		
	}
    
}