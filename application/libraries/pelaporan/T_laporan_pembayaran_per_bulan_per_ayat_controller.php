 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_laporan_pembayaran_per_bulan_per_ayat_controller
* @version 07/05/2015 12:18:00
*/
class T_laporan_pembayaran_per_bulan_per_ayat_controller {

    function readData(){

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $kode_wilayah = getVarClean('kode_wilayah', 'str', '');
        $tgl_penerimaan  = getVarClean('tgl_penerimaan','str','');
        $tgl_penerimaan_last = getVarClean('tgl_penerimaan_last', 'str', '');

        $npwpd_jabatan = getVarClean('npwpd_jabatan','str','');
        $year_code = getVarClean('year_code','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_laporan_pembayaran_per_bulan_per_ayat');
            $table = $ci->t_laporan_pembayaran_per_bulan_per_ayat;

            $result = $table->getAyat();
            $total = array();
            $j = 0;
            for ($i = 0; $i < count($result); $i++) {
                
                $result1 = $result[$i]['jenis_pajak'];
                $result2 = array();
                if (($i-1)>-1){  
                    $result2 = $result[$i-1]['jenis_pajak'];
                }
                if( $result1 != $result2){
                    for($bulan=1;$bulan<=12;$bulan++){ 
                        $aktif = 0;
                        $bayar = 0;
                        $nilai = 0;
                        $data_per_bulan = $table->getDataPerJenis($result[$i]['p_vat_type_id'],
                                '01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$year_code, $kode_wilayah, $npwpd_jabatan,  $tgl_penerimaan, $tgl_penerimaan_last);
                        if (isset($data_per_bulan['aktif'])){
                            $aktif = $data_per_bulan['aktif'];
                        }
                        if (isset($data_per_bulan['bayar'])){
                            $bayar = $data_per_bulan['bayar'];
                        }
                        if (isset($data_per_bulan['nilai'])){
                            $nilai = $data_per_bulan['nilai'];
                        } 
                        $result[$i]['aktif'.$bulan] = $aktif;
                        $result[$i]['bayar'.$bulan] = $bayar;
                        $result[$i]['nilai'.$bulan] = $nilai;
                    }
                    $j++;
                }

                if($result[$i]['jenis_pajak'] != 'PAJAK PARKIR' && $result[$i]['jenis_pajak'] != 'PAJAK PPJ'){
                    //get data perbulan
                    for($bulan=1;$bulan<=12;$bulan++){
                        $aktif = 0;
                        $bayar = 0;
                        $nilai = 0;
                        $data_per_bulan = $table->getData($result[$i]['p_vat_type_dtl_id'],
                            '01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$year_code, $kode_wilayah, $npwpd_jabatan, $tgl_penerimaan, $tgl_penerimaan_last); 
                        if (isset($data_per_bulan['aktif'])){
                            $aktif = $data_per_bulan['aktif'];
                        }
                        if (isset($data_per_bulan['bayar'])){
                            $bayar = $data_per_bulan['bayar'];
                        }
                        if (isset($data_per_bulan['nilai'])){
                            $nilai = $data_per_bulan['nilai'];
                        }
             
                        $result[$i]['aktif'.$bulan] = $aktif;
                        $result[$i]['bayar'.$bulan] = $bayar;
                        $result[$i]['nilai'.$bulan] = $nilai;
                        
                    }
                }
            }

            

            $count = count($result);

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;


            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;         
            // print_r($result);
            // exit();     

            
            
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
        

    }

    function excel(){

        $kode_wilayah = getVarClean('kode_wilayah', 'str', '');
        $tgl_penerimaan  = getVarClean('tgl_penerimaan','str','');
        $tgl_penerimaan_last = getVarClean('tgl_penerimaan_last', 'str', '');

        $npwpd_jabatan = getVarClean('npwpd_jabatan','str','');
        $year_code = getVarClean('year_code','str','');

        try {

            $ci = &get_instance();
            $ci->load->model('pelaporan/t_laporan_pembayaran_per_bulan_per_ayat');
            $table = $ci->t_laporan_pembayaran_per_bulan_per_ayat;


            startExcel(date("dmy") . '_laporan_pembayaran_per_bulan_per_ayat.xls');
            echo '<html>';
            echo '<head><title>LAPORAN DENDA</title></head>';
            echo '<body>';
            echo '<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">';
            echo '<h2 style="color:black;" align="center">REKAPITULASI PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</h2>';

            if($npwpd_jabatan == 2) {  
                echo  '<h2 style="color:black;" align="center">NPWPD JABATAN</h2>';
            }
            if($kode_wilayah == 'semua') { 
                echo  '<h2 style="color:black;" align="center">KOTA BANDUNG</h2>';
            }
            if($kode_wilayah == 'lainnya') {   
                echo  '<h2 style="color:black;" align="center">WILAYAH LAINNYA</h2>';
            }
            if($kode_wilayah != 'semua' && $kode_wilayah != 'lainnya' ) { 
                echo  '<h2 style="color:black;" align="center">'.$kode_wilayah.'</h2>';
            }
            echo  '<br>';
            $tanggal ='31-12-2014';
            echo '<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                        <tr >';

            
            echo '<th align="center" rowspan=2 >NO</th>';
            echo '<th align="center" rowspan=2 >URAIAN JENIS PAJAK</th>';
            echo '<th align="center" colspan=3 >JANUARI</th>';
            echo '<th align="center" colspan=3 >FEBRUARI</th>';
            echo '<th align="center" colspan=3 >MARET</th>';
            echo '<th align="center" colspan=3 >APRIL</th>';
            echo '<th align="center" colspan=3 >MEI</th>';
            echo '<th align="center" colspan=3 >JUNI</th>';
            echo '<th align="center" colspan=3 >JULI</th>';
            echo '<th align="center" colspan=3 >AGUSTUS</th>';
            echo '<th align="center" colspan=3 >SEPTEMBER</th>';
            echo '<th align="center" colspan=3 >OKTOBER</th>';
            echo '<th align="center" colspan=3 >NOVEMBER</th>';
            echo '<th align="center" colspan=3 >DESEMBER</th>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '<th align="center">AKTIF</th>';
            echo '<th align="center">BAYAR</th>';
            echo '<th align="center">NILAI</th>';
            echo '</tr>';

            $data = $table->getAyat();
            $total = array();
            $j = 0;
            for($bulan=1;$bulan<=12;$bulan++){
                $total[$bulan]['aktif'] = 0;
                $total[$bulan]['bayar'] = 0;
                $total[$bulan]['nilai'] = 0;
            }

            for ($i = 0; $i < count($data); $i++) {
                $data1 = $data[$i]['jenis_pajak'];
                $data2 = array();
                if (($i-1)>-1){  
                    $data2 = $data[$i-1]['jenis_pajak'];
                }
                if( $data1 != $data2){
                    echo '<tr><td align="center"><b>'.($j+1).'</b></td>';
                    echo '<td align="left"><b>'.$data[$i]['jenis_pajak'].'</b></td>';
                    for($bulan=1;$bulan<=12;$bulan++){
                        $aktif = 0;
                        $bayar = 0;
                        $nilai = 0;
                        $data_per_bulan = $table->getDataPerJenis($data[$i]['p_vat_type_id'],
                                '01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$year_code, $kode_wilayah, $npwpd_jabatan,  $tgl_penerimaan, $tgl_penerimaan_last);
                        if (isset($data_per_bulan['aktif'])){
                            $aktif = $data_per_bulan['aktif'];
                        }
                        if (isset($data_per_bulan['bayar'])){
                            $bayar = $data_per_bulan['bayar'];
                        }
                        if (isset($data_per_bulan['nilai'])){
                            $nilai = $data_per_bulan['nilai'];
                        } 
                        echo '<td align="right">'.$aktif.'</td>';
                        echo '<td align="right">'.$bayar.'</td>';
                        echo '<td align="right">'.number_format($nilai, 2, ',', '.').'</td>';

                        $total[$bulan]['aktif'] += $aktif;
                        $total[$bulan]['bayar'] += $bayar;
                        $total[$bulan]['nilai'] += $nilai;
                    }
                    echo '</tr>';
                    $j++;
                }

                if($data[$i]['jenis_pajak'] != 'PAJAK PARKIR' && $data[$i]['jenis_pajak'] != 'PAJAK PPJ'){
                    echo '<tr><td align="center"></td>';
                    echo '<td align="left">- '.$data[$i]['ayat_pajak_2'].'</td>';
                    //get data perbulan
                    for($bulan=1;$bulan<=12;$bulan++){
                        $aktif = 0;
                        $bayar = 0;
                        $nilai = 0;
                        $data_per_bulan = $table->getData($data[$i]['p_vat_type_dtl_id'],
                            '01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$year_code, $kode_wilayah, $npwpd_jabatan, $tgl_penerimaan, $tgl_penerimaan_last); 
                        if (isset($data_per_bulan['aktif'])){
                            $aktif = $data_per_bulan['aktif'];
                        }
                        if (isset($data_per_bulan['bayar'])){
                            $bayar = $data_per_bulan['bayar'];
                        }
                        if (isset($data_per_bulan['nilai'])){
                            $nilai = $data_per_bulan['nilai'];
                        }
             
                        echo '<td align="right">'.$aktif.'</td>';
                        echo '<td align="right">'.$bayar.'</td>';
                        echo '<td align="right">'.number_format($nilai, 2, ',', '.').'</td>';
                        
                    }
                    echo '</tr>';
                }
            }
            echo '<tr><td align="center"></td>';
            echo '<td align="left"><b>JUMLAH</b></td>';
            for($bulan=1;$bulan<=12;$bulan++){
                echo '<td align="right">'.$total[$bulan]['aktif'].'</td>';
                echo '<td align="right">'.$total[$bulan]['bayar'].'</td>';
                echo '<td align="right">'.number_format($total[$bulan]['nilai'], 2, ',', '.').'</td>';
            }
            
            echo '</tr>';

            echo '</table>';
            echo '</body>';
            echo '</html>';
            exit;

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

    }

    function readHTML (){

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $result = array('rows' => "", 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $kode_wilayah = getVarClean('kode_wilayah', 'str', '');
        $tgl_penerimaan  = getVarClean('tgl_penerimaan','str','');
        $tgl_penerimaan_last = getVarClean('tgl_penerimaan_last', 'str', '');

        $npwpd_jabatan = getVarClean('npwpd_jabatan','str','');
        $year_code = getVarClean('year_code','str','');
        $output = '';

        try {
            $ci = &get_instance();
            $ci->load->model('pelaporan/t_laporan_pembayaran_per_bulan_per_ayat');
            $table = $ci->t_laporan_pembayaran_per_bulan_per_ayat;

            $output .= '<html>';
            $output .= '<head><title>LAPORAN DENDA</title></head>';
            $output .= '<body>';
            $output .= '<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                    <tr>
                        <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                        <td class="th"><strong>LAPORAN PEMBAYARAN PER JENIS DAN MASA PAJAK</strong></td> 
                        <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                    </tr>
                    </table>';
            $output .= '<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">';
            $output .= '<h2 style="color:black;" align="center">REKAPITULASI PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</h2>';

            if($npwpd_jabatan == 2) {  
                $output .=  '<h2 style="color:black;" align="center">NPWPD JABATAN</h2>';
            }
            if($kode_wilayah == 'semua') { 
                $output .=  '<h2 style="color:black;" align="center">KOTA BANDUNG</h2>';
            }
            if($kode_wilayah == 'lainnya') {   
                $output .=  '<h2 style="color:black;" align="center">WILAYAH LAINNYA</h2>';
            }
            if($kode_wilayah != 'semua' && $kode_wilayah != 'lainnya' ) { 
                $output .=  '<h2 style="color:black;" align="center">'.$kode_wilayah.'</h2>';
            }
            $output .=  '<br>';
            $tanggal ='31-12-2014';
            $output .= '<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                        <tr >';

            
            $output .= '<th align="center" rowspan=2 >NO</th>';
            $output .= '<th align="center" rowspan=2 >URAIAN JENIS PAJAK</th>';
            $output .= '<th align="center" colspan=3 >JANUARI</th>';
            $output .= '<th align="center" colspan=3 >FEBRUARI</th>';
            $output .= '<th align="center" colspan=3 >MARET</th>';
            $output .= '<th align="center" colspan=3 >APRIL</th>';
            $output .= '<th align="center" colspan=3 >MEI</th>';
            $output .= '<th align="center" colspan=3 >JUNI</th>';
            $output .= '<th align="center" colspan=3 >JULI</th>';
            $output .= '<th align="center" colspan=3 >AGUSTUS</th>';
            $output .= '<th align="center" colspan=3 >SEPTEMBER</th>';
            $output .= '<th align="center" colspan=3 >OKTOBER</th>';
            $output .= '<th align="center" colspan=3 >NOVEMBER</th>';
            $output .= '<th align="center" colspan=3 >DESEMBER</th>';
            $output .= '</tr>';
            
            $output .= '<tr>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '<th align="center">AKTIF</th>';
            $output .= '<th align="center">BAYAR</th>';
            $output .= '<th align="center">NILAI</th>';
            $output .= '</tr>';

            $data = $table->getAyat();
            $total = array();
            $j = 0;
            for($bulan=1;$bulan<=12;$bulan++){
                $total[$bulan]['aktif'] = 0;
                $total[$bulan]['bayar'] = 0;
                $total[$bulan]['nilai'] = 0;
            }

            for ($i = 0; $i < count($data); $i++) {
                $data1 = $data[$i]['jenis_pajak'];
                $data2 = array();
                if (($i-1)>-1){  
                    $data2 = $data[$i-1]['jenis_pajak'];
                }
                if( $data1 != $data2){
                    $output .= '<tr><td align="center"><b>'.($j+1).'</b></td>';
                    $output .= '<td align="left"><b>'.$data[$i]['jenis_pajak'].'</b></td>';
                    for($bulan=1;$bulan<=12;$bulan++){
                        $aktif = 0;
                        $bayar = 0;
                        $nilai = 0;
                        $data_per_bulan = $table->getDataPerJenis($data[$i]['p_vat_type_id'],
                                '01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$year_code, $kode_wilayah, $npwpd_jabatan,  $tgl_penerimaan, $tgl_penerimaan_last);
                        if (isset($data_per_bulan['aktif'])){
                            $aktif = $data_per_bulan['aktif'];
                        }
                        if (isset($data_per_bulan['bayar'])){
                            $bayar = $data_per_bulan['bayar'];
                        }
                        if (isset($data_per_bulan['nilai'])){
                            $nilai = $data_per_bulan['nilai'];
                        } 
                        $output .= '<td align="right">'.$aktif.'</td>';
                        $output .= '<td align="right">'.$bayar.'</td>';
                        $output .= '<td align="right">'.number_format($nilai, 2, ',', '.').'</td>';

                        $total[$bulan]['aktif'] += $aktif;
                        $total[$bulan]['bayar'] += $bayar;
                        $total[$bulan]['nilai'] += $nilai;
                    }
                    $output .= '</tr>';
                    $j++;
                }

                if($data[$i]['jenis_pajak'] != 'PAJAK PARKIR' && $data[$i]['jenis_pajak'] != 'PAJAK PPJ'){
                    $output .= '<tr><td align="center"></td>';
                    $output .= '<td align="left">- '.$data[$i]['ayat_pajak_2'].'</td>';
                    //get data perbulan
                    for($bulan=1;$bulan<=12;$bulan++){
                        $aktif = 0;
                        $bayar = 0;
                        $nilai = 0;
                        $data_per_bulan = $table->getData($data[$i]['p_vat_type_dtl_id'],
                            '01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$year_code, $kode_wilayah, $npwpd_jabatan, $tgl_penerimaan, $tgl_penerimaan_last); 
                        if (isset($data_per_bulan['aktif'])){
                            $aktif = $data_per_bulan['aktif'];
                        }
                        if (isset($data_per_bulan['bayar'])){
                            $bayar = $data_per_bulan['bayar'];
                        }
                        if (isset($data_per_bulan['nilai'])){
                            $nilai = $data_per_bulan['nilai'];
                        }
             
                        $output .= '<td align="right">'.$aktif.'</td>';
                        $output .= '<td align="right">'.$bayar.'</td>';
                        $output .= '<td align="right">'.number_format($nilai, 2, ',', '.').'</td>';
                        
                    }
                    $output .= '</tr>';
                }
            }
            $output .= '<tr><td align="center"></td>';
            $output .= '<td align="left"><b>JUMLAH</b></td>';
            for($bulan=1;$bulan<=12;$bulan++){
                $output .= '<td align="right">'.$total[$bulan]['aktif'].'</td>';
                $output .= '<td align="right">'.$total[$bulan]['bayar'].'</td>';
                $output .= '<td align="right">'.number_format($total[$bulan]['nilai'], 2, ',', '.').'</td>';
            }
            
            $output .= '</tr>';

            $output .= '</table>';
            $output .= '</body>';
            $output .= '</html>';

            $result['rows'] = $output;
        } catch (Exception $e) {
            $result['message']= $e->getMessage();
        }

        return $result;
    }

}

/* End of file Groups_controller.php */