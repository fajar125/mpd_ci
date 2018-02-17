<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pembayaran_berdasarkan_cara_bayar_dan_ketetapan extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    function comboBoxPeriode(){
        //check_login();
        $sql = "select * 
                from p_year_period 
                where start_date > '2014-12-31'
                    order by start_date DESC
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        $html.="<select name='p_year_period_id' id='p_year_period_id' class='form-control'>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['p_year_period_id'] . "'>" . $data['year_code'] . "</option>";
        }
        foreach ($items as $data) {
          $html .=" <input type='hidden' name='year_code' id='year_code' value='" . $data['year_code'] . "'>";
        }
        $html .= "</select>";

        echo $html;
        exit;
    }

    function comboBoxWilayah(){
        check_login();
        $sql = "select 
                code, 
                business_area_name
                from p_business_area 
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        $html.="<select name='business_area_name' id='business_area_name' class='form-control required'>";
        $html.="<option value='0' >Semua</option>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['code'] . "'>" . $data['business_area_name'] . "</option>";
        }
        $html .= "<option value='lainnya'>Lainnya</option>";
        $html .= "</select>";

        echo $html;
        exit;
    }

    function comboBoxJenisKetetapan(){
        check_login();
        $sql = "select p_settlement_type_id, code
                    from p_settlement_type
                    order by p_settlement_type_id
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        $html.="<select name='p_settlement_type_id' id='p_settlement_type_id' class='form-control required'>";
        //$html.="<option value='' >Semua</option>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['p_settlement_type_id'] . "'>" . $data['code'] . "</option>";
        }
        $html .= "</select>";

        echo $html;
        exit;
    }

    function comboBoxCaraBayar(){
        check_login();
        $sql = "select p_payment_type_id, code
                    from p_payment_type
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        $html.="<select name='p_payment_type_id' id='p_payment_type_id' class='form-control required'>";
        $html.="<option value=0 >Semua</option>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['p_payment_type_id'] . "'>" . $data['code'] . "</option>";
        }
        $html .= "</select>";

        echo $html;
        exit;
    }


}