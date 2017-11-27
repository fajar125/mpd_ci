<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_rep_sisa_piutang_controller
* @version 07/05/2015 12:18:00
*/
class T_rep_sisa_piutang_controller {
 
    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sord = getVarClean('sord', 'str', 'asc');
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $p_finance_period_id = getVarClean('p_finance_period_id','int',0);
        $status = getVarClean('status', 'str', '');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_rep_sisa_piutang');
            $table = $ci->t_rep_sisa_piutang;
             
            $result = $table->getDataRepPiutang($p_vat_type_id, $p_finance_period_id, $status);
            
            //$table->setJQGridParam($req_param);
            $count = count($result);
            //count($result)

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - 1; // do not put $limit*($page - 1)

           
            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;
            if ($result== 'no result')
                $result = "";

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function excel() {
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $p_finance_period_id = getVarClean('p_finance_period_id','int',0);
        $status = getVarClean('status', 'str', '');
        $jenis_pajak = getVarClean('jenis_pajak','str','');
        $periode_pajak = getVarClean('periode_pajak','str','');

        //echo $periode_pajak;exit;
        try {

            $ci = &get_instance();
            $ci->load->model('pelaporan/t_rep_sisa_piutang');
            $table = $ci->t_rep_sisa_piutang;

            
            $items = $table->getDataRepPiutang($p_vat_type_id, $p_finance_period_id, $status);  
            //$p_finance_period_id =42;
            $tgl_jatuh_tempo = $table->getJatuhTempo($p_finance_period_id);

            startExcel(date("dmy") . '_LAPORAN SURAT TEGURAN.xls');
            
            
            echo '<html>';
            echo '<head><title>LAPORAN STATUS SURAT TEGURAN</title></head>';
            echo '<body>';
            if($items != 'no result'){
                echo '<h3>JENIS PAJAK : '.$jenis_pajak.'<br/>';
                echo 'PERIODE PAJAK : '.$periode_pajak.'<br/>';
                echo 'JATUH TEMPO : '.strtoupper($this->dateToString($tgl_jatuh_tempo)).'</h3>';
                echo '<table border="1">';
                echo '<tr>';
                echo '<th align="center" rowspan="2">NO</th>';
                echo '<th align="center" rowspan="2" width="200">MERK DAGANG</th>';
                echo '<th align="center" rowspan="2" width="200">ALAMAT MERK DAGANG</th>';
                echo '<th align="center" rowspan="2" width="90">NPWPD</th>';
                echo '<th align="center" rowspan="2">SPTPD</th>';
                echo '<th align="center" rowspan="2">STPD</th>';
                echo '<th align="center" colspan="2">TEGURAN I <br/> '.$items[0]['f_teg1_sts'].'</th>';
                echo '<th align="center" colspan="2">TEGURAN II <br/> '.$items[0]['f_teg2_sts'].'</th>';
                echo '<th align="center" colspan="2">TEGURAN III <br/> '.$items[0]['f_teg3_sts'].'</th>';
                echo '<th align="center" rowspan="2">AKSI <br/>'.$items[0]['f_action_date'].'</th>';
                if($status == '2') /* SUDAH BAYAR */ {
                    echo '<th align="center" rowspan="2" width="150">PEMBAYARAN <br/> SETELAH <br/>'.$items[0]['f_action_date'].'</th>';
                }
                echo '</tr>';
            
                echo '<tr >';
                echo '<th align="center">SPTPD</th>';
                echo '<th align="center">STPD</th>';
                echo '<th align="center">SPTPD</th>';
                echo '<th align="center">STPD</th>';
                echo '<th align="center">SPTPD</th>';
                echo '<th align="center">STPD</th>';
                echo '</tr>';

                $no = 0;            
            
                foreach ($items as $item) {
                    echo  '<tr>';
                    echo  '<td align="center">'.($no++).'</td>';
                    echo  '<td align="left">'.$item['company_brand'].'</td>';
                    echo  '<td align="left">'.$item['alamat_merk_dagang'].'</td>';
                    echo  '<td align="left">'.$item['alamat'].'</td>';
                    echo  '<td align="center">'.$item['npwpd'].'</td>';
                    echo  '<td align="right">'.number_format($item['f_amount'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_penalty'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_teg1_amount'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_teg1_penalty'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_teg2_amount'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_teg2_penalty'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_teg3_amount'],0,",",".").'</td>';
                    echo  '<td align="right">'.number_format($item['f_teg3_penalty'],0,",",".").'</td>';
                    
                    if($status == '') {
                        $kolom_aksi = is_numeric($item['f_action_sts']) ? number_format($item['f_action_sts'],0,",",".") : $item['f_action_sts'];
                        echo  '<td align="right">'.$kolom_aksi.'</td>';
                    }else if($status == '1') /* BELUM BAYAR */ {
                        echo  '<td align="right">'.$item['f_action_sts'].'</td>';
                    }else if($status == '2') /* SUDAH BAYAR */ {
                        if($item['bayar_setelah'] == 't') {
                            echo  '<td align="right"> </td>';
                            echo  '<td align="right">'. number_format($item['f_action_sts'],0,",",".").'</td>';
                        }else {
                            echo  '<td align="right"></td>';
                            echo  '<td align="right"></td>';
                        }               
                    
         
                        echo  '</tr>';
                        
                        $no++;
                    }
                
                }          
           
                echo '</table>';
            }
            echo '</body>';
            echo '</html>';
            exit;

            

            
        } catch (Exception $e) {
            
        }
        
        
    }

    function dateToString($date){
        if(empty($date)) return "";
        
        $monthname = array(0  => '-',
                           1  => 'Januari',
                           2  => 'Februari',
                           3  => 'Maret',
                           4  => 'April',
                           5  => 'Mei',
                           6  => 'Juni',
                           7  => 'Juli',
                           8  => 'Agustus',
                           9  => 'September',
                           10 => 'Oktober',
                           11 => 'November',
                           12 => 'Desember');    
        
        $pieces = explode('-', $date);
        
        return $pieces[2].'-'.$monthname[(int)$pieces[1]].'-'.$pieces[0];
    }
    
}

/* End of file t_rep_sisa_piutang_controller.php */