 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_laporan_detil_pembayaran_per_bulan_per_ayat_controller.php
* @version 07/05/2015 12:18:00
*/
class T_laporan_detil_pembayaran_per_bulan_per_ayat_controller {
 
    function read() {
 
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('p_year_period_id', 'int', 0);
        $sord = getVarClean('sord', 'str', 'asc');

        $kode_wilayah = getVarClean('kode_wilayah','str','');
        $npwpd_jabatan = getVarClean('npwpd_jabatan','str','');
        $tanggal_penerimaan = getVarClean('tanggal_penerimaan','str','');
        $tanggal_penerimaan_last = getVarClean('tanggal_penerimaan_last','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        if(($sidx = '' || $sidx == 0) && $kode_wilayah == '' && $npwpd_jabatan == '' && $tanggal_penerimaan == '' && $tanggal_penerimaan_last == ''){
            $ci = & get_instance();
            $ci->load->model('pelaporan/t_laporan_detil_pembayaran_per_bulan_per_ayat');
            $table = $ci->t_laporan_detil_pembayaran_per_bulan_per_ayat;
        }else{
            try {

                $ci = & get_instance();
                $ci->load->model('pelaporan/t_laporan_detil_pembayaran_per_bulan_per_ayat');
                $table = $ci->t_laporan_detil_pembayaran_per_bulan_per_ayat;
                 
                $result = $table->getData($kode_wilayah, $npwpd_jabatan, $tanggal_penerimaan, $tanggal_penerimaan_last);

                //$result[$i]['total']
                
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

        
    }

    function excel(){
        $kode_wilayah = getVarClean('kode_wilayah','str','');
        $npwpd_jabatan = getVarClean('npwpd_jabatan','str','');
        $tanggal_penerimaan = getVarClean('tanggal_penerimaan','str','');
        $tanggal_penerimaan_last = getVarClean('tanggal_penerimaan_last','str','');

        try {

            $ci = &get_instance();
            $ci->load->model('pelaporan/t_laporan_detil_pembayaran_per_bulan_per_ayat');
            $table = $ci->t_laporan_detil_pembayaran_per_bulan_per_ayat;

            $result = $table->getData($kode_wilayah, $npwpd_jabatan, $tanggal_penerimaan, $tanggal_penerimaan_last);

            //startExcel(date("dmy") . '_laporan_pembayaran_berdasarkan_cara_bayar.xls');
            startExcel('laporan_perkembangan_jumlah_wajib_pajak.xls');
            echo '<html>';
            echo '<head><title>PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</title></head>';
            echo '<body>';
            echo '<h2 style="color:black;" align="center">PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</h2>';
            if($npwpd_jabatan == 2) {  
                echo '<h2 style="color:black;" align="center">NPWPD JABATAN</h2>';
            }
            if($kode_wilayah == 'semua') { 
                echo '<h2 style="color:black;" align="center">KOTA BANDUNG</h2>';
            }
            if($kode_wilayah == 'lainnya') {   
                echo '<h2 style="color:black;" align="center">WILAYAH LAINNYA</h2>';
            }
            if($kode_wilayah != 'semua' && $kode_wilayah != 'lainnya' ) { 
                echo '<h2 style="color:black;" align="center">'.$kode_wilayah.'</h2>';
            }
            echo '<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';
            echo '<th align="center">NO</th>';
            echo '<th align="center">JENIS PAJAK</th>';
            echo '<th align="center">URAIAN JENIS PAJAK</th>';
            echo '<th align="center">NPWPD</th>';
            echo '<th align="center">OBJEK PAJAK</th>';
            echo '<th align="center">ALAMAT</th>';
            echo '<th align="center">MASA PAJAK</th>';
            echo '<th align="center">TOTAL BAYAR</th>';
            echo '<th align="center">TANGGAL BAYAR</th>';
            echo '<th align="center">WILAYAH</th>';
            echo '</tr>';
            /*
            $no = 0;
            $jumlahtemp = 0;    
            $total=0;

            $jumlah =0;
            $jumlah_realisasi =0;
            $jumlah_sisa =0;*/

            for ($i = 0; $i < count($result); $i++) {
                echo '</tr>'; 
                echo '<td align="left" >'.($i+1).'</td>';
                echo '<td align="left" >'.$result[$i]['jenis_pajak'].'</td>';
                echo '<td align="left" >'.$result[$i]['ayat_pajak'].'</td>';
                echo '<td align="left" >'.$result[$i]['npwd'].'</td>';
                echo '<td align="left" >'.$result[$i]['company_brand'].'</td>';
                echo '<td align="left" >'.$result[$i]['brand_address_name'].' '.$result[$i]['brand_address_no'].'</td>';
                echo '<td align="left" >'.$result[$i]['masa_pajak'].'</td>';
                echo '<td align="right" >'.number_format($result[$i]['payment_amount'], 2, ',', '.').'</td>';
                echo '<td align="left" >'.$result[$i]['tanggal_bayar'].'</td>';
                echo '<td align="left" >'.$result[$i]['wilayah'].'</td>';
                echo '</tr>';
            }

            echo '</table>';

            echo '</body>';
            echo '</html>';
            exit;

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }


    }
        
}

/* End of file t_laporan_detil_pembayaran_per_bulan_per_ayat_controller.php.php */