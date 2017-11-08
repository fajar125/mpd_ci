<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_vat_setllement_ppat_controller
* @version 07/05/2015 12:18:00
*/
class t_vat_setllement_ppat_controller {

    function submit(){
        $t_ppat_id               = getVarClean('t_ppat_id','str',''); 
        $ppat_name               = getVarClean('ppat_name','str',''); 
        $address_name            = getVarClean('address_name','str',''); 
        $no_sk                   = getVarClean('no_sk','str',''); 
        $p_finance_period_id     = getVarClean('p_finance_period_id','str',''); 
        $sanksi_ajb              = getVarClean('sanksi_ajb','str',''); 
        //$created_by              = getVarClean('created_by','str',''); 
        $p_finance_period_id_ajb = getVarClean('p_finance_period_id_ajb','str',''); 
        
               

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_vat_setllement_ppat');
            $table = $ci->t_vat_setllement_ppat;

            $param =  array('t_ppat_id' =>$t_ppat_id,
                            'ppat_name' =>$ppat_name,
                            'address_name' =>$address_name,
                            'no_sk' =>$no_sk,
                            'p_finance_period_id' =>$p_finance_period_id,
                            'sanksi_ajb' =>$sanksi_ajb,
                            //'created_by' =>$created_by,
                            'p_finance_period_id_ajb' =>$p_finance_period_id_ajb);

            $result = $table->submit($param) ;
            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }
}
