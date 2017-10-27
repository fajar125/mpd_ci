<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_rep_bulanan_target_vs_realisasi_v2_controller
* @version 07/05/2015 12:18:00
*/
class t_rep_bulanan_target_vs_realisasi_v2_controller {
 
    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $p_finance_period_id_start = getVarClean('p_finance_period_id_start','int',0);
        $p_finance_period_id_end = getVarClean('p_finance_period_id_end','int',0);

        $tahun_periode = getVarClean('tahun_periode','str','');
        $date_awal = getVarClean('date_awal','str','');
        $date_akhir = getVarClean('date_akhir','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_rep_bulanan_target_vs_realisasi_v2');
            $table = $ci->t_rep_bulanan_target_vs_realisasi_v2;
             
            $tanggal_awal  = $table->getDateAwal($p_finance_period_id_start);
            //print_r($tanggal_awal);exit();
            $tanggal_akhir = $table->getDateAkhir($p_finance_period_id_end);
            $result        = $table->getVat_type();

            $data_pajak = array();
            foreach ($result as $item) {
                $data_pajak['p_vat_type_id'][] = $item['p_vat_type_id'];
                $data_pajak['jenis_pajak'][]   = $item['jenis_pajak'];
                $data_pajak['pajak_text'][]    = $item['pajak_text'];
                $data_pajak['date_awal']    = $tanggal_awal[0];
                $data_pajak['date_akhir']   = $tanggal_akhir[0];
            }
            


            $pajak_text     = '';
            $pajak_text     = $data_pajak['pajak_text'][0];
            $items          = array();

            $total_target   = 0;
            $total_realisasi= 0;
            $total_piutang  = 0;
            $total_selisih  = 0;
            $total_denda    = 0;

            $grand_total_target     = 0;
            $grand_total_realisasi  = 0;
            $grand_total_selisih    = 0;
            $grand_total_denda      = 0;

            $isi_data = array();
            $results = array();

            
            for($i = 0; $i<count($data_pajak['jenis_pajak']); $i++){

                $results = $table->getDataRow($p_year_period_id, $data_pajak['p_vat_type_id'][$i], $data_pajak['date_awal']['start_date'], $data_pajak['date_akhir']['end_date']);

                $items['realisasiDanPiutang'] = 0;
                $items['denda']               = 0;
                $items['target']              = 0;
                
                for($counter = 0; $counter<count($results); $counter++){
                    if( $data_pajak['p_vat_type_id'][$i] == 1 || 
                        $data_pajak['p_vat_type_id'][$i] == 2 || 
                        $data_pajak['p_vat_type_id'][$i] == 3 || 
                        $data_pajak['p_vat_type_id'][$i] == 4){

                        $items['target'] = $results[$counter]['target_amount'];
                        $items['realisasiDanPiutang'] = $results[$counter]['realisasi_amt']+$results[$counter]['debt_amt'];
                        $items['denda']  = $results[$counter]['denda_pokok']+$results[$counter]['denda_piutang'];


                        $isi_data['ayat'] []    = $results[$counter]['ayat'];
                        $isi_data['target'][] = $items['target'];
                        $isi_data['realisasiDanPiutang'][]= $items['realisasiDanPiutang'];

                       

                        $selisih = $items['realisasiDanPiutang'] + $items['denda'] - $items['target'];
                        $isi_data['selisih'][]= $selisih;
                        $isi_data['jenis_pajak'][]= $data_pajak['jenis_pajak'][$i];

                    }else{
                        $items['target'] = $results[$counter]['target_amount'];
                        $items['realisasiDanPiutang'] = $results[$counter]['realisasi_amt']+$results[$counter]['debt_amt'];
                        $items['denda']  = $results[$counter]['denda_pokok']+$results[$counter]['denda_piutang'];

                        $isi_data['ayat'] []    = $results[$counter]['ayat'];
                            $isi_data['target'][] = $items['target'];
                            $isi_data['realisasiDanPiutang'][]= $items['realisasiDanPiutang'];

                       

                        $selisih = $items['realisasiDanPiutang'] + $items['denda'] - $items['target'];
                        $isi_data['selisih'][]= $selisih;
                        $isi_data['jenis_pajak'][]= $data_pajak['jenis_pajak'][$i];
                    }
                        

                }
                
            } 

            $data_arr = array();
            for ($i=0;$i<count($isi_data['ayat']);$i++){
                $data_arr[$i]['ayat'] = $isi_data['ayat'][$i];
                $data_arr[$i]['target'] = $isi_data['target'][$i];
                $data_arr[$i]['realisasiDanPiutang'] = $isi_data['realisasiDanPiutang'][$i];
                $data_arr[$i]['selisih'] = $isi_data['selisih'][$i];
                $data_arr[$i]['jenis_pajak'] = $isi_data['jenis_pajak'][$i];
            }

            
            //print_r($data_arr);exit;         
            $data['rows'] = $data_arr;
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }
}

/* End of file t_rep_bulanan_target_vs_realisasi_v2_controller.php */