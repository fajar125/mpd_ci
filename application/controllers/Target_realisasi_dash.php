<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Target_realisasi_dash extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    function target_realisasi_tahun() {

        $year_code = getVarClean('year_code','int',0);

        $sql = "select * from v_target_vs_real_anual
                where year_code = ?";

        $query = $this->db->query($sql, array($year_code));
        $result = $query->row_array();
        if(!isset($result['target_amt'])){
            $result['target_amt'] = 0;
        }

        if(!isset($result['realisasi_amt'])){
            $result['realisasi_amt'] = 0;
        }
        
        if(count($result) < 1){
            $s_result ="[[0]]";
            exit;
        }

        echo '[['.$result['target_amt'].','.$result['realisasi_amt'].',"'.$result['year_code'].'"]]';
        exit;
        
    }

    function t_target_realisasi_bulan_all() {

        $year_code = getVarClean('year_code','int',0);

        $sql = "SELECT
					MAX(p_finance_period_id) as p_finance_period_id, 
					MAX(p_year_period_id) as p_year_period_id,
					to_char(MAX(start_date),'dd-mm-yyyy') as start_date,
					to_char(MAX(end_date),'dd-mm-yyyy') as end_date,
					MAX(p_vat_type_id) as p_vat_type_id,
					MAX(bulan) as bulan,
					SUM (target_amount) as target_amount,
					SUM (realisasi_amt) as realisasi_amt,
					MAX (penalty_amt) as penalty_amt,
					SUM (debt_amt) as debt_amt
				FROM
					f_target_vs_real_monthly_v2(?,null)
				GROUP BY p_finance_period_id

				ORDER BY MAX(start_date) ASC";

        $query = $this->db->query($sql, array($year_code));
        $result = $query->result_array();


        $s_result ="[";
        for ($i=0;$i<count($result);$i++){

        	$s_result = $s_result . '["'.$result[$i]['bulan'].'","'.$result[$i]['target_amount'].'","'.$result[$i]['realisasi_amt'].'","'.$result[$i]['penalty_amt'].'","'.$result[$i]['debt_amt'].'"],';
        }
        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";

        if(count($result) < 1){
            $s_result ="[[0]]";
        }
        echo $s_result;
        exit;
    }

    function target_realisasi_tahun_per_jenis() {

        $year_code = getVarClean('year_code','int',0);

        $sql = "SELECT t_revenue_target_id,
                    p_year_period_id,
                    p_vat_type_id,
                    vat_code,
                    year_code,
                    target_amount,
                    realisasi_amt
                FROM v_revenue_target_vs_realisasi
                WHERE year_code = ?
                AND p_vat_type_id IN (1,2,3,4,5)
                ORDER BY p_vat_type_id";

        $query = $this->db->query($sql, array($year_code));
        $result = $query->result_array();
        //print_r($result);exit;
        $s_result ="[";
        for ($i=0;$i<count($result);$i++){
            $s_result = $s_result . '['.$result[$i]['target_amount'].','.$result[$i]['realisasi_amt'].',"'.$result[$i]['vat_code'].'"],';
        }
        $s_result = substr($s_result, 0, -1)  ; 

        

        $s_result = $s_result . "]";

        if(count($result) < 1){
            $s_result ="[[0]]";
        }     
        echo $s_result;
        exit;
    }

    function target_realisasi_per_tahun() {

        $year_code = getVarClean('year_code','int',0);
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);

        $sql = "SELECT target_amount, realisasi_amt, vat_code, year_code
                FROM v_revenue_target_vs_realisasi
                WHERE year_code = ?
                AND p_vat_type_id = ? ";

        $query = $this->db->query($sql, array($year_code, $p_vat_type_id));
        $result = $query->row_array();
        //echo base_url();exit;


        $s_result = '[['.$result['target_amount'].','.$result['realisasi_amt'].',"'.$result['vat_code'].'","'.$result['year_code'].'"]]';
        if(count($result) < 1){
            $s_result ="[[0]]";
        } 

        echo $s_result;

        exit;
    }

    function target_realisasi_perjenis_bulan() {

        $year_code = getVarClean('year_code','int',0);
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);

        $sql = "SELECT SUM(target_amount) as target_amount, SUM(realisasi_amt) as realisasi_amt, vat_code, year_code, bulan
                FROM v_revenue_target_vs_realisasi_month_v2
                WHERE year_code = ?
                AND p_vat_type_id = ?
                GROUP BY vat_code, year_code, bulan,p_finance_period_id
                order by p_finance_period_id";

        $query = $this->db->query($sql, array($year_code, $p_vat_type_id));
        $result = $query->result_array();
        //echo base_url();exit;
        //print_r($query); exit();

        $s_result ="[";
        for ($i=0;$i<count($result);$i++){

            $s_result = $s_result . '["'.$result[$i]['bulan'].'","'.$result[$i]['target_amount'].'",'.$result[$i]['realisasi_amt'].',"'.$result[$i]['vat_code'].'","'.$result[$i]['year_code'].'"],';
        }

        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";

        if(count($result) < 1){
            $s_result ="[[0]]";
        } 

        echo $s_result;

        exit;
    }

    function target_realisasi_bidang_per_tahun() {

        $t_revenue_target_id = getVarClean('t_revenue_target_id','int',0);
        $p_year_period_id = getVarClean('p_year_period_id','int',0);

        $sql = "SELECT t_revenue_target_id, p_year_period_id, p_vat_group_id, group_code,   year_code, target_amount, realisasi_amt
                FROM (SELECT max(t_revenue_target_id) as t_revenue_target_id, 
                        max(p_year_period_id) as p_year_period_id, p_vat_group_id, group_code, max(year_code) as year_code, sum(target_amount) as target_amount, sum(realisasi_amt) as realisasi_amt
                    FROM v_revenue_target_vs_realisasi
                    WHERE p_year_period_id = ?
                    GROUP BY p_vat_group_id,group_code
                    ORDER BY group_code)
                WHERE t_revenue_target_id = ?";

        $query = $this->db->query($sql, array($p_year_period_id, $t_revenue_target_id));
        $result = $query->row_array();
        //echo base_url();exit;
        echo '[['.$result['target_amount'].','.$result['realisasi_amt'].',"'.$result['group_code'].'","'.$result['year_code'].'"]]';
        exit;
    }
    

}