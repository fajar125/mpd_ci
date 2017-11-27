<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Target_realisasi extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    function target_realisasi_tahun() {
        check_login();

        $p_year_period_id = getVarClean('p_year_period_id','int',0);

        $sql = "select * from v_target_vs_real_anual
                where p_year_period_id = ?";

        $query = $this->db->query($sql, array($p_year_period_id));
        $result = $query->row_array();
        //echo base_url();exit;
        echo '[['.$result['target_amt'].','.$result['realisasi_amt'].',"'.$result['year_code'].'"]]';
        exit;
    }

    function t_target_realisasi_bulan_all() {
        check_login();

        $p_year_period_id = getVarClean('p_year_period_id','int',0);

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
					f_target_vs_real_monthly_new(?,null)
				GROUP BY p_finance_period_id

				ORDER BY MAX(start_date) ASC";

        $query = $this->db->query($sql, array($p_year_period_id));
        $result = $query->result_array();
        //print_r($result);exit;
        $s_result ="[";
        for ($i=0;$i<count($result);$i++){
        	$s_result = $s_result . '["'.$result[$i]['bulan'].'","'.$result[$i]['target_amount'].'","'.$result[$i]['realisasi_amt'].'","'.$result[$i]['penalty_amt'].'","'.$result[$i]['debt_amt'].'"],';
        }
        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";
        echo $s_result;
        exit;
    }

    function target_realisasi_tahun_per_jenis() {
        check_login();

        $p_year_period_id = getVarClean('p_year_period_id','int',0);

        $sql = "SELECT t_revenue_target_id,
                    p_year_period_id,
                    p_vat_type_id,
                    vat_code,
                    year_code,
                    target_amount,
                    realisasi_amt
                FROM v_revenue_target_vs_realisasi
                WHERE p_year_period_id = ?
                ORDER BY p_vat_type_id";

        $query = $this->db->query($sql, array($p_year_period_id));
        $result = $query->result_array();
        //print_r($result);exit;
        $s_result ="[";
        for ($i=0;$i<count($result);$i++){
            $s_result = $s_result . '['.$result[$i]['target_amount'].','.$result[$i]['realisasi_amt'].',"'.$result[$i]['vat_code'].'"],';
        }
        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";
        echo $s_result;
        exit;
    }

    function target_realisasi_per_tahun() {
        check_login();

        $t_revenue_target_id = getVarClean('t_revenue_target_id','int',0);

        $sql = "SELECT target_amount, realisasi_amt, vat_code, year_code
                FROM v_revenue_target_vs_realisasi
                WHERE t_revenue_target_id = ?";

        $query = $this->db->query($sql, array($t_revenue_target_id));
        $result = $query->row_array();
        //echo base_url();exit;
        echo '[['.$result['target_amount'].','.$result['realisasi_amt'].',"'.$result['vat_code'].'","'.$result['year_code'].'"]]';
        exit;
    }

    function target_realisasi_bidang_per_tahun() {
        check_login();

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