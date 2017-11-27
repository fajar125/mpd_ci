<?php

/**
 * T_laporan_rekap_bphtb Model
 *
 */
class T_laporan_rekap_bphtb extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = "";

    public $selectClause    = "";
    public $fromClause      = "";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function getExcel($param = array()){

        $whereClause='cust_order.p_order_status_id <> 1';

        if(!empty($param['start_date']) && !empty($param['end_date'])){
          $whereClause.=" AND (trunc(reg_bphtb.creation_date) BETWEEN '".$param['start_date']."'";
          $whereClause.=" AND '".$param['end_date']."')";
        }else if(!empty($param['start_date'])&&empty($param['end_date'])){
          $whereClause.=" AND trunc(reg_bphtb.creation_date) >= '".$param['start_date']."'";
        }else if(empty($param['start_date'])&&!empty($param['end_date'])){
          $whereClause.=" AND trunc(reg_bphtb.creation_date) <= '".$param['end_date']."'";
        }

        if(!empty($param['filter_lap'])) {
          
          if($param['filter_lap'] == 1) { //sudah bayar 
            $whereClause.= " AND (payment.receipt_no is not null or payment.receipt_no <> '') ";
            $whereClause.= " AND ( bphtb_amt_final > 0 ) ";
          }
          if($param['filter_lap'] == 2) { //belum bayar
            $whereClause.= " AND ( payment.receipt_no is null or payment.receipt_no = '') ";
            $whereClause.= " AND ( bphtb_amt_final > 0 ) ";
          }
          if($param['filter_lap'] == 3) //nihil
            $whereClause.= " AND ( bphtb_amt_final < 1 ) ";
        }

        $sql = "SELECT
                    to_char(reg_bphtb.creation_date, 'YYYY-MM-DD') as creation_date,
                    registration_no,
                    wp_name,
                    reg_bphtb.p_bphtb_legal_doc_type_id,
                    bphtb_doc.description,
                    njop_pbb,
                    land_area,
                    land_total_price,
                    building_area,
                    building_total_price,
                    market_price,
                    bphtb_amt_final,
                    land_price_per_m,
                    reg_bphtb.verificated_by,
                    building_price_per_m
                  FROM
                    sikp.t_bphtb_registration reg_bphtb
                  LEFT JOIN p_bphtb_legal_doc_type bphtb_doc 
                    on bphtb_doc.p_bphtb_legal_doc_type_id = reg_bphtb.p_bphtb_legal_doc_type_id
                  LEFT JOIN t_customer_order cust_order 
                    ON cust_order.t_customer_order_id = reg_bphtb.t_customer_order_id 
                  LEFT JOIN t_payment_receipt_bphtb payment 
                    ON reg_bphtb.t_bphtb_registration_id = payment.t_bphtb_registration_id 
                  ";

        if(!empty($whereClause))
            $sql.= " WHERE ".$whereClause;

        $sql.= " order by trunc(reg_bphtb.creation_date) ASC,upper(wp_name) ASC ";

        //echo $sql;exit;
        $output = $this->db->query($sql);
        $items = $output->result_array();
        
        return $items;
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