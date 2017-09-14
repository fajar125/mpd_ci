<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    function getPiutang(){
        check_login();

        $cust_acc_id = getVarClean('t_cust_account_id','int',0);
        $finance_period = getVarClean('p_finance_period_id','int',0);

        $sql = "SELECT to_char(active_date,'dd-mm-yyyy') as active_date FROM t_cust_account WHERE t_cust_account_id = $cust_acc_id";
        $query = $this->db->query($sql);
        $item = $query->row_array();
        
        $activation_date = $item['active_date'];

        $sql = "SELECT x.receipt_no,
                        x.p_finance_period_id,
                        x.description,
                        f_per.*
                        FROM p_finance_period f_per,
                        (select sett.p_finance_period_id,
                        receipt_no,sett_type.description
                                                from
                                                    t_vat_setllement sett,
                                                    p_settlement_type sett_type,
                        t_payment_receipt rec
                            WHERE sett.t_cust_account_id = $cust_acc_id
                            and sett.p_settlement_type_id = sett_type.p_settlement_type_id
                            and sett.t_vat_setllement_id = rec.t_vat_setllement_id (+)
                            and sett.p_settlement_type_id <> 7) as x
                    where f_per.p_finance_period_id = x.p_finance_period_id(+)
                    and f_per.end_date < (select start_date from p_finance_period where p_finance_period_id = $finance_period)
                    and f_per.start_date >= '01-01-2013'
                    and (receipt_no is null or receipt_no ='')
                    and f_per.start_date >= '$activation_date'
                    order by f_per.start_date";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        //print_r($result);exit;
        $s_result ="[";
        for ($i=0;$i<count($result);$i++){
            $s_result = $s_result . '["'.$result[$i]['p_finance_period_id'].'","'.$result[$i]['description'].'","'.$result[$i]['code'].'","'.$activation_date.'"],';
        }
        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";
        echo $s_result;
        exit;
        // print_r($items);
        // exit();
    


    }
    

}