<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bphtb_registration extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    function load_combo_dok_pendukung (){
        check_login();
        $sql = "select p_bphtb_legal_doc_type_id,code
                    from p_bphtb_legal_doc_type bphtb_legal
                 left join p_legal_doc_type legal 
                  on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id
                  order by p_bphtb_legal_doc_type_id
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        $html.="<select name='p_bphtb_legal_doc_type_id' id='p_bphtb_legal_doc_type_id' onchange='getdok(this);' class='form-control '>";
        $html.="<option value='' >Select Value</option>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['p_bphtb_legal_doc_type_id'] . "'>" . $data['code'] . "</option>";
        }
        $html .= "</select>";

        echo $html;
        exit;
    }

    function load_combo_dok_pendukung_readonly (){
        check_login();
        $sql = "select p_bphtb_legal_doc_type_id,code
                    from p_bphtb_legal_doc_type bphtb_legal
                 left join p_legal_doc_type legal 
                  on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id
                  order by p_bphtb_legal_doc_type_id
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        $html.="<select name='p_bphtb_legal_doc_type_id' id='p_bphtb_legal_doc_type_id' disabled='disabled' readonly onchange='getdok(this);' class='form-control '>";
        $html.="<option value='' >Select Value</option>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['p_bphtb_legal_doc_type_id'] . "'>" . $data['code'] . "</option>";
        }
        $html .= "</select>";

        echo $html;
        exit;
    }

    function call_service_doc (){
        check_login();
        $id = $this->input->post('id');
        $output = 'Pilih Dokument Pendukung';
        if ($id != null || $id != '' ){
            $sql = "SELECT * 
                        FROM p_bphtb_legal_doc_type 
                      INNER JOIN p_legal_doc_type 
                       ON p_bphtb_legal_doc_type.p_legal_doc_type_id = p_legal_doc_type.p_legal_doc_type_id
                        WHERE ( p_bphtb_legal_doc_type.p_legal_doc_type_id =p_legal_doc_type.p_legal_doc_type_id )
                        AND p_bphtb_legal_doc_type.p_bphtb_legal_doc_type_id = ".$id.
                        " AND p_bphtb_legal_doc_type_id = ".$id;
            $query = $this->db->query($sql);
            $items = $query->result_array();
            $output=json_encode($items);
        }
        

        echo $output;
        exit;
        
    }

    function load_combo_jenis_transaksi (){
        check_login();
        $sql = "select p_bphtb_legal_doc_type_id,description 
                    from p_bphtb_legal_doc_type
                ";
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $html = "";
        //$html.="<select name='p_bphtb_legal_doc_type_id' id='p_bphtb_legal_doc_type_id' onchange='getdok(this);' class='form-control '>";
        $html.="<select name='p_bphtb_legal_doc_type_id' id='p_bphtb_legal_doc_type_id'  class='form-control '>";
        $html.="<option value='' >Semua</option>";
        foreach ($items as $data) {
          $html .=" <option value='" . $data['p_bphtb_legal_doc_type_id'] . "'>" . $data['description'] . "</option>";
        }
        $html .= "</select>";

        echo $html;
        exit;
    }

    function petugas_administrator_combo(){
        try {
            $sql = "SELECT * FROM t_bphtb_exemption_pemeriksa
                    WHERE pemeriksa_status = 'administrator'";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="administrator_id" name="administrator_id" class="FormElement form-control"> <option value="">--Pilih Petugas Administrator--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['t_bphtb_exemption_pemeriksa_id'].'">'.$item['pemeriksa_nama'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function petugas_pemeriksa_combo(){
        try {
            $sql = "SELECT * FROM t_bphtb_exemption_pemeriksa
                    WHERE pemeriksa_status = 'pemeriksa'";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="pemeriksa_id" name="pemeriksa_id"  class="FormElement form-control"> <option value="">--Pilih Petugas Penerima--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['t_bphtb_exemption_pemeriksa_id'].'">'.$item['pemeriksa_nama'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function tahun_period_combo(){
        try {
            $sql = "SELECT * FROM p_year_period 
                    order by year_code DESC";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="year_code" name="year_code" class="FormElement form-control"> <option value="">--Pilih Tahun--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['year_code'].'">'.$item['year_code'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

}