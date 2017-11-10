<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_rep_lap_harian__per_ketetapan_controller
* @version 07/05/2015 12:18:00
*/
class t_rep_lap_harian_per_ketetapan_controller {
 
    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sord = getVarClean('sord', 'str', 'asc');
        $tgl_penerimaan = getVarClean('tgl_penerimaan','str','');
        $kode_bank = getVarClean('kode_bank','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_rep_lap_harian_per_ketetapan');
            $table = $ci->t_rep_lap_harian_per_ketetapan;
             
            $result = $table->getLapHarianPerKetetapan($tgl_penerimaan, $kode_bank);
            
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

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function excel(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $tgl_penerimaan = getVarClean('tgl_penerimaan','str','');
        $kode_bank = getVarClean('kode_bank','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = &get_instance();
            $ci->load->model('pelaporan/t_rep_lap_harian_per_ketetapan');
            $table = $ci->t_rep_lap_harian_per_ketetapan;

            $items = $table->getLapHarianPerKetetapan($tgl_penerimaan, $kode_bank);

            startExcel(date("dmy") . '_LAPORAN_HARIAN_PER_KETETAPAN.xls');
            echo '<html>';
            echo '<head><title>REP LAP HARIAN PER KETERAPAN</title></head>';
            echo '<body>';
            echo '<table border="1">';
            echo '<tr>';
            echo '<th style="text-align:center;" rowspan=2>NO</th>';
            echo '<th style="text-align:center;" rowspan=2>AYAT</th>';
            echo '<th style="text-align:center;" rowspan=2>PAJAK/RETRIBUSI</th>';
            echo '<th style="text-align:center;" colspan=5>JUMLAH HARI INI</th>';
            echo '<th style="text-align:center;" colspan=5>JUMLAH S/D HARI YANG LALU</th>';
            echo '<th style="text-align:center;" colspan=5>JUMLAH S/D HARI INI</th>';
            echo '</tr>';
            echo '<tr class="Caption">';
            echo '<th style="text-align:center;">SPTPD</th>';
            echo '<th style="text-align:center;">SKPDKB Jabatan</th>';
            echo '<th style="text-align:center;">SKPDKB Pemeriksaan</th>';
            echo '<th style="text-align:center;">Piutang</th>';
            echo '<th style="text-align:center;">JUMLAH</th>';
            echo '<th style="text-align:center;">SPTPD</th>';
            echo '<th style="text-align:center;">SKPDKB Jabatan</th>';
            echo '<th style="text-align:center;">SKPDKB Pemeriksaan</th>';
            echo '<th style="text-align:center;">Piutang</th>';
            echo '<th style="text-align:center;">JUMLAH</th>';
            echo '<th style="text-align:center;">SPTPD</th>';
            echo '<th style="text-align:center;">SKPDKB Jabatan</th>';
            echo '<th style="text-align:center;">SKPDKB Pemeriksaan</th>';
            echo '<th style="text-align:center;">Piutang</th>';
            echo '<th style="text-align:center;">JUMLAH</th>';
            echo '</tr>';

            $no = 0;

            $jumlahperjenis = array();
            $jumlahtotal = 0;
            $jumlahtemp = 0;
            $jumlahperjenis_harilalu = array();
            $jumlahtotal_harilalu = 0;
            $jumlahtemp_harilalu = 0;
            $jumlahperjenis_hariini = array();
            $jumlahtotal_hariini = 0;
            $jumlahtemp_hariini = 0;
            $jml_transaksi_per_jenis_pajak = 0;
            $jml_transaksi_semua_jenis_pajak = 0;
            $jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
            $jml_transaksi_sampai_kemarin_semua_jenis_pajak = 0;
            $jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
            $jml_transaksi_sampai_hari_ini_semua_jenis_pajak = 0;
            if($items != 'no result'){
                for ($i = 0; $i < count($items); $i++) {
                    //print data
                    echo '<tr>';
                    echo '<td>  
                                '.$no.' 
                             </td>
                             <td>
                                '.$items[$i]["nomor_ayat"].' 
                             </td>
                             <td>
                                    P. ' . strtoupper($items[$i]["nama_ayat"]).' 
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_sptpd_hari_ini"], 0, ',', '.').' 
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_jabatan_hari_ini"], 0, ',', '.').'   
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_pemeriksaan_hari_ini"], 0, ',', '.').'   
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_piutang_hari_ini"], 0, ',', '.').'   
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_hari_ini"], 0, ',', '.').'   
                             </td>
                             

                             <td align="right">
                                    '.number_format($items[$i]["jml_sptpd_sd_hari_lalu"], 0, ',', '.').'                                               
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_jabatan_sd_hari_lalu"], 0, ',', '.').'                                                 
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_pemeriksaan_sd_hari_lalu"], 0, ',', '.').'                                                 
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_piutang_sd_hari_lalu"], 0, ',', '.').'                                                 
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_sd_hari_lalu"], 0, ',', '.').'                                                 
                             </td>
                             

                             <td align="right">
                                    '.number_format($items[$i]["jml_sptpd_sd_hari_ini"], 0, ',', '.').'
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_jabatan_sd_hari_ini"], 0, ',', '.').'
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_pemeriksaan_sd_hari_ini"], 0, ',', '.').'
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_piutang_sd_hari_ini"], 0, ',', '.').'
                             </td>
                             <td align="right">
                                    '.number_format($items[$i]["jml_sd_hari_ini"], 0, ',', '.').'
                             </td>';
                    echo '</tr>';
                    $no++;

                    //hitung jml_hari_ini sampai baris ini
                    $jumlahtemp += $items[$i]["jml_hari_ini"];
                    $jumlahtotal += $items[$i]["jml_hari_ini"];
                    $jumlahtemp_harilalu += $items[$i]["jml_sd_hari_lalu"];
                    $jumlahtotal_harilalu += $items[$i]["jml_sd_hari_lalu"];
                    $jumlahtemp_hariini += $items[$i]["jml_sd_hari_ini"];
                    $jumlahtotal_hariini += $items[$i]["jml_sd_hari_ini"];
                    
                    $jenis = $items[$i]["nama_jns_pajak"];
                    if((count($items)-1) != $i){
                        $jenissesudah = $items[$i + 1]["nama_jns_pajak"];
                    }else{
                        $jenissesudah = "";
                    }
                    
                    if($jenis != $jenissesudah || $jenissesudah = ""){
                        $jumlahperjenis[] = $jumlahtemp;
                        $jumlahperjenis_harilalu[] = $jumlahtemp_harilalu;
                        $jumlahperjenis_hariini[] = $jumlahtemp_hariini;
                        
                        echo '<tr>';
                        echo '<td style="font-weight:bold;" align="center" colspan=3>'.strtoupper($items[$i]["nama_jns_pajak"]).'</td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp, 0, ',', '.').'</td>';
                        
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp_harilalu, 0, ',', '.').'</td>';
                        
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp_hariini, 0, ',', '.').'</td>';
                        echo '</tr>';               

                        $jumlahtemp = 0;
                        $jumlahtemp_harilalu = 0;
                        $jumlahtemp_hariini = 0;
                        $jml_transaksi_per_jenis_pajak = 0;
                        $jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
                        $jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
                    }
                    
                    if($i == count($items) - 1){
                        echo '<tr>';
                        echo '<td style="font-weight:bold;" align="center" colspan=3>JUMLAH TOTAL</td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal, 0, ',', '.').'</td>';

                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal_harilalu, 0, ',', '.').'</td>';

                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right"></td>';
                        echo '<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal_hariini, 0, ',', '.').'</td>';
                        echo '</tr>';
                        $jumlahtotal = 0;
                        $jumlahtotal_harilalu = 0;
                        $jumlahtotal_hariini = 0;
                        $jml_transaksi_per_jenis_pajak = 0;
                        $jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
                        $jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
                    }
                }
            }
            echo '</table>';
            echo '</html>';
            echo '</body>';
            
            exit;
            
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    
}

/* End of file t_rep_lap_harian_per_ketetapan_controller.php */