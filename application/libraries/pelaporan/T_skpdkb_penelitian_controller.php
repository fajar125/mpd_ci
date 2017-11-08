<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_skpdkb_penelitian_controller
* @version 07/05/2015 12:18:00
*/
class t_skpdkb_penelitian_controller {

	function read()
    {
        $status     = getVarClean('status', 'str', '');
        $year_code  = getVarClean('year_code', 'str', '');
        $year_id    = getVarClean('year_id','str','');
        $sidx 	    = getVarClean('sidx','str','wp_name');
        $sord 	    = getVarClean('sord','str','asc');
        $page	    = getVarClean('page','int',1);
        $limit 	    = getVarClean('rows','int',5);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {
            if ((!empty($year_id)&&!empty($year_code))||!empty($status)){
            	$ci = & get_instance();
                $ci->load->model('pelaporan/t_skpdkb_penelitian');
                $table = $ci->t_skpdkb_penelitian;

                

                $table->setCriteria(" p_settlement_type_id = 2 ");   
                $table->setCriteria(" a.p_vat_type_dtl_id != 14 ");   
                if (!empty($status)){
                	if($status==1){
                		$table->setCriteria(" x.receipt_no is not null "); 
                	}else if($status==2) {
                		$table->setCriteria(" x.receipt_no is null ");
                	}
                }

		        if (!empty($year_code))
		            $table->setCriteria(" extract(year from a.settlement_date) = ".$year_code);


		                          

                $count = $table->countAll();

                if ($count > 0) $total_pages = ceil($count / $limit);
                else $total_pages = 1;

                if ($page > $total_pages) $page = $total_pages;
                $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

                

                if ($page == 0) $data['page'] = 1;
                else $data['page'] = $page;

                $data['total'] = $total_pages;
                $data['records'] = $count;

                $data['rows'] = $table->getAll(0, 0, 'wp_name', 'asc');
                
            }
            $data['success'] = true;
            return $data;
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }
}

/* End of file Groups_controller.php */