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

    function getData(){
        check_login();

        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);

        $tgl_penerimaan = "'01-01-2010'";
        $i_flag_setoran = 1;
        $p_year_period_id = 4;

       

        $sql="select *,trunc(payment_date) , (kode_jns_pajak||' '||kode_ayat) as no_ayat
                    from f_rep_bpps_piutang2new_rm_masuk_resto($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, to_char(sysdate,'dd-mm-yyyy'), $i_flag_setoran) 
                    order by p_vat_type_dtl_id, wp_name,npwpd, payment_date";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        //print_r($result);exit;
        $s_result ="[";
        for ($i=0;$i<count($result);$i++){
            $s_result = $s_result . '["'.$result[$i]['no_ayat'].'","'.$result[$i]['no_kohir'].'","'.$result[$i]['wp_name'].'","'.$result[$i]['address'].'","'.$result[$i]['npwpd'].'","'.$result[$i]['jumlah_terima'].'","'.$result[$i]['payment_date'].'","'.$result[$i]['masa_pajak'].'"],';
        }
        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";
        echo $s_result;
        exit;
        // print_r($items);
        // exit();
    


    }

    function payment_type_combo(){
        try {
            $sql = "SELECT * 
                        FROM p_payment_type
                        ORDER BY p_payment_type_id ASC";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="payment_type" name="payment_type" class="FormElement form-control"> <option value="0" selected>--Pilih Jenis Pembayaran--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['p_payment_type_id'].'">'.$item['code'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function private_question_combo(){
        try {
            $sql = "SELECT * 
                        FROM p_private_question
                        ORDER BY p_private_question_id ASC";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="p_private_question_id" name="p_private_question_id" class="FormElement form-control"> <option value="0">--Pilih Pertanyaan--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['p_private_question_id'].'">'.$item['question_pwd'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function business_area_combo(){
        try {
            $sql = "SELECT *
                        FROM p_business_area ";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="kode_wilayah" name="kode_wilayah" class="FormElement form-control"> <option value="0" selected>--Pilih Wilayah WP--</option>';
            echo '<option value="semua">Semua</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['business_area_name'].'">'.$item['business_area_name'].'</option>';
            }
            echo '<option value="lainnya">Lainnya</option>';
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function nama_ayat_combo(){
        $p_rqst_type_id = getVarClean('p_rqst_type_id', 'int',0);
        try {
            $sql = "select * from v_p_vat_type_dtl_rqst_type
                    where p_rqst_type_id = ".$p_rqst_type_id;
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="p_vat_type_dtl" name="p_vat_type_dtl" class="FormElement form-control"> <option value="0">--Pilih Ayat--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['p_vat_type_dtl_id'].'">'.$item['nama_ayat'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function petugas_administrator_combo(){
        try {
            $sql = "SELECT * FROM t_bphtb_exemption_pemeriksa
                    WHERE pemeriksa_status = 'administrator'";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="administrator_id" name="administrator_id" class="FormElement form-control"> <option value="0">--Pilih Petugas Administrator--</option>';
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
            echo '<select id="administrator_id" name="administrator_id" class="FormElement form-control"> <option value="0">--Pilih Petugas Penerima--</option>';
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

    function jenis_ketetapan_combo(){
        try {
            $sql = "select * from p_settlement_type";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="p_settlement_type_id" name="p_settlement_type_id" class="FormElement form-control"> <option value="0">--Pilih Jenis Ketetapan--</option>';
            foreach($items  as $item ){
                echo '<option value="'.$item['p_settlement_type_id'].'">'.$item['code'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function hotel_grade_combo(){
        try {
            $sql = "SELECT * 
                        FROM p_hotel_grade
                        ORDER BY p_hotel_grade_id ASC";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="p_hotel_grade_id" name="p_hotel_grade_id" class="FormElement form-control" disabled>';
            foreach($items  as $item ){
                echo '<option value="'.$item['p_hotel_grade_id'].'">'.$item['grade_name'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }

    function enter_type_combo(){
        try {
            $sql = "SELECT * 
                        FROM p_entertaintment_type
                        ORDER BY p_entertaintment_type_id ASC";
            $query = $this->db->query($sql);

            $items = $query->result_array();
            echo '<select id="p_entertaintment_type_id" name="p_entertaintment_type_id" class="FormElement form-control" disabled>';
            foreach($items  as $item ){
                echo '<option value="'.$item['p_entertaintment_type_id'].'">'.$item['entertaintment_name'].'</option>';
            }
            echo '</select>';
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }
    

    public function getMonitoring($id, $search, $tmp){
        $result = array();
        $sql = $this->db->query("SELECT * FROM TABLE(F_MONITOR_TIPRO(".$id.", '".$search."')) WHERE WF_MONITOR LIKE '".$tmp."%' ");
        if($sql->num_rows() > 0)
            $result = $sql->result();
        return $result;
    }

    public function processMonitoring(){

        $p_workflow_id = $this->input->post('p_workflow_id');
        $skeyword = $this->input->post('skeyword');

        $result = $this->getMonitoring($p_workflow_id, $skeyword,'H');
        foreach ($result as $rowH) {
            $exp = explode('|', $rowH->wf_monitor);
            if($exp[0] == 'H'){
                $data['header'] = $exp;
            }

        }

        $data['p_workflow_id'] = $p_workflow_id;
        $data['skeyword'] = $skeyword;

        $this->load->view('workflow/monitoring_grid',$data);

    }

     public function getMonProcess(){
        $page = intval($this->input->post('current')) ;
        $limit = $this->input->post('rowCount');
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $p_workflow_id = $this->input->post('p_workflow_id');
        $skeyword = $this->input->post('skeyword');

        $result = $this->getMonitoring($p_workflow_id, $skeyword,'D');

        $data = array();
        $hasil = array();
        $no = 1;
        foreach ($result as $row) {
            $exp = explode('|', $row->wf_monitor);
            if($exp[0] == 'D'){
                $tmp = array();

                for($i=0; $i<count($exp); $i++){
                    if($i==0){
                        $tmp = array("urutan" => $no);
                    }
                    $tmp = array_merge($tmp, array("data".$i => $exp[$i]));
                }

                if ($page == 0) {
                    $hasil['current'] = 1;
                } else {
                    $hasil['current'] = $page;
                }

                $jmlCount[] = $tmp;

                if($hasil['current'] == 1){
                    $start = $hasil['current'];
                    $end = $limit;
                }else{
                    $end = ($limit * $hasil['current']);
                    $start = $end - ($limit - 1);
                }
                // print_r($start);
                // exit;
                if(($tmp['urutan'] >= $start) && ($tmp['urutan'] <= $end)){
                    $data[] = $tmp;
                }

                $hasil['total'] = count($jmlCount);
                $hasil['rowCount'] = $limit;
                $hasil['success'] = true;
                $hasil['message'] = 'Berhasil';
                $hasil['rows'] = $data;

            }

            $no++;
        }

        if(count($hasil) == 0) {
            $hasil['current'] = 1;
            $hasil['total'] = 1;
            $hasil['rowCount'] = 1;
            $hasil['success'] = true;
            $hasil['message'] = 'Berhasil';
            $hasil['rows'] = array();
        }

        echo(json_encode($hasil));
        exit;
    }

}