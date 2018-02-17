 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class T_laporan_ketetapan_dan_realisasi_controller.php
* @version 07/05/2015 12:18:00
*/
class T_laporan_ketetapan_dan_realisasi_controller {
 
    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('p_vat_type_id', 'int', 0);
        $sord = getVarClean('sord', 'str', 'asc');

        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $tgl_penerimaan = getVarClean('tgl_penerimaan','str', '');
        $tgl_penerimaan_last = getVarClean('tgl_penerimaan_last','str', '');
        $kode_wilayah = getVarClean('kode_wilayah','str', '');
        $tgl_bayar = getVarClean('tgl_bayar','int',0);

        $year_date = getVarClean('year_code','str', '');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_laporan_ketetapan_dan_realisasi');
            $table = $ci->t_laporan_ketetapan_dan_realisasi;
             
            $result = $table->getData($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last,$kode_wilayah);

            


            $jumlahtemp=0;
            $jumlahperayat=0;
            $i2=0;
            $before=0;
            $new=0;
            $tgl_bayar_jan= '';
            $tgl_bayar_feb= '';
            $tgl_bayar_mar= '';
            $tgl_bayar_apr= '';
            $tgl_bayar_mei= '';
            $tgl_bayar_jun= '';
            $tgl_bayar_jul= '';
            $tgl_bayar_agu= '';
            $tgl_bayar_sep= '';
            $tgl_bayar_okt= '';
            $tgl_bayar_nov= '';
            $tgl_bayar_des= '';
            $tgl_bayar_xdes='';
            $tgl_bayar_xnov='';
            $jumlah_jan= 0;
            $jumlah_feb= 0;
            $jumlah_mar= 0;
            $jumlah_apr= 0;
            $jumlah_mei= 0;
            $jumlah_jun= 0;
            $jumlah_jul= 0;
            $jumlah_agu= 0;
            $jumlah_sep= 0;
            $jumlah_okt= 0;
            $jumlah_nov= 0;
            $jumlah_des= 0;
            $jumlah_xdes=0;
            $jumlah_xnov=0;
            $jumlah_jan_per_ayat= 0;
            $jumlah_feb_per_ayat= 0;
            $jumlah_mar_per_ayat= 0;
            $jumlah_apr_per_ayat= 0;
            $jumlah_mei_per_ayat= 0;
            $jumlah_jun_per_ayat= 0;
            $jumlah_jul_per_ayat= 0;
            $jumlah_agu_per_ayat= 0;
            $jumlah_sep_per_ayat= 0;
            $jumlah_okt_per_ayat= 0;
            $jumlah_nov_per_ayat= 0;
            $jumlah_des_per_ayat= 0;
            $jumlah_xdes_per_ayat=0;
            $jumlah_xnov_per_ayat=0;
            $ketetapan_realisasi = 0; 

						
            for ($i=0; $i < count($result) ; $i++) {        
                $bln = substr($result[$i]["masa_pajak"],-7,2);
                $thn = substr($result[$i]["masa_pajak"],-4,4);

                $result[$i]['rek_code'] = $result[$i]["kode_jns_pajak"]." ".$result[$i]["kode_ayat"];
                $result[$i]['address_name'] = $result[$i]['wp_address_name'].' '.$result[$i]['wp_address_no'];
                if($thn == $year_date && $bln != 12){
                    switch ($bln) {
                        case "01":
                            $result[$i]['jan']=$result[$i]['jan']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_jan=$jumlah_jan+$result[$i]["jumlah_terima"];
                            $jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_jan=$result[$i]["payment_date"];
                            break;
                        case "02":
                            $result[$i]['feb']=$result[$i]['feb']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_feb=$jumlah_feb+$result[$i]["jumlah_terima"];
                            $jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_feb=$result[$i]["payment_date"];
                            break;
                        case "03":
                            $result[$i]['mar']=$result[$i]['mar']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_mar=$jumlah_mar+$result[$i]["jumlah_terima"];
                            $jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_mar=$result[$i]["payment_date"];
                            break;
                        case "04":
                            $result[$i]['apr']=$result[$i]['apr']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_apr=$jumlah_apr+$result[$i]["jumlah_terima"];
                            $jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_apr=$result[$i]["payment_date"];
                            break;
                        case "05":
                            $result[$i]['mei']=$result[$i]['mei']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_mei=$jumlah_mei+$result[$i]["jumlah_terima"];
                            $jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_mei=$result[$i]["payment_date"];
                            break;
                        case "06":
                            $result[$i]['jun']=$result[$i]['jun']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_jun=$jumlah_jun+$result[$i]["jumlah_terima"];
                            $jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_jun=$result[$i]["payment_date"];
                            break;
                        case "07":
                            $result[$i]['jul']=$result[$i]['jul']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_jul=$jumlah_jul+$result[$i]["jumlah_terima"];
                            $jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_jul=$result[$i]["payment_date"];
                            break;
                        case "08":
                            $result[$i]['ags']=$result[$i]['ags']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_agu=$jumlah_agu+$result[$i]["jumlah_terima"];
                            $jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_agu=$result[$i]["payment_date"];
                            break;
                        case "09":
                            $result[$i]['sep']=$result[$i]['sep']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_sep=$jumlah_sep+$result[$i]["jumlah_terima"];
                            $jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_sep=$result[$i]["payment_date"];
                            break;
                        case "10":
                            $result[$i]['okt']=$result[$i]['okt']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_okt=$jumlah_okt+$result[$i]["jumlah_terima"];
                            $jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_okt=$result[$i]["payment_date"];
                            break;
                        case "11":
                            $result[$i]['nov']=$result[$i]['nov']+$result[$i]["jumlah_terima"];
                            $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                            if ($result[$i]["jumlah_terima"] > 0){
                                $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                            }
                            $jumlah_nov=$jumlah_nov+$result[$i]["jumlah_terima"];
                            $jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_nov=$result[$i]["payment_date"];
                            break;
                    }
                }else{
                    if ($thn == ($year_date - 1) && $bln == 12){
                        $result[$i]['des_past']=$result[$i]['des_past']+$result[$i]["jumlah_terima"];
                        $result[$i]['jumlah_per_wp'] = $result[$i]['jumlah_per_wp'] + $result[$i]["jumlah_terima"];
                        if ($result[$i]["jumlah_terima"] > 0){
                            $result[$i]["jumlah_bulan_bayar"] = $result[$i]["jumlah_bulan_bayar"] + 1;
                        }
                        $jumlah_des=$jumlah_des+$result[$i]["jumlah_terima"];
                        $jumlah_des_per_ayat=$jumlah_des_per_ayat+$result[$i]["jumlah_terima"];
                        $tgl_bayar_des=$result[$i]["payment_date"];
                    }
                    else{
                        if ($thn < $year_date){
                            $result[$i]['before_des']=$result[$i]['before_des']+$result[$i]["jumlah_terima"];
                            $jumlah_xdes=$jumlah_xdes+$result[$i]["jumlah_terima"];
                            $jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$result[$i]["jumlah_terima"];
                            $tgl_bayar_xdes=$result[$i]["payment_date"];
                        }
                        else{
                            if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
                                    $result[$i]['after_nov']=$result[$i]['after_nov']+$result[$i]["jumlah_terima"];
                                    $jumlah_xnov=$jumlah_xnov+$result[$i]["jumlah_terima"];
                                    $jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$result[$i]["jumlah_terima"];
                                    $tgl_bayar_xnov=$result[$i]["payment_date"];
                            }
                        }
                    }
                }
                if ($result[$i]['jumlah_bulan_bayar']<1){
                    $result[$i]['avg_tap'] = 0;
                }else{
                    $result[$i]['avg_tap'] = $result[$i]['jumlah_per_wp']/$result[$i]['jumlah_bulan_bayar'];
                }
            }

            

            
              // print_r($result); exit();
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

    function excel() {
    
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $tgl_penerimaan = getVarClean('tgl_penerimaan','str', '');
        $tgl_penerimaan_last = getVarClean('tgl_penerimaan_last','str', '');
        $kode_wilayah = getVarClean('kode_wilayah','str', '');
        $tgl_bayar = getVarClean('tgl_bayar','int',0);

        $year_date = getVarClean('year_code','str', '');
            
        try{
            
            $ci = &get_instance();
            $ci->load->model('pelaporan/t_laporan_ketetapan_dan_realisasi');
            $table = $ci->t_laporan_ketetapan_dan_realisasi;

            $result = $table->getData($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $kode_wilayah);

            //print_r($result); exit();

            startExcel("laporan_ketetapan_dan_realisasi.xls");
        
            $output = '';
    
            $output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td valign="top">';

            $output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                                <td class="th"><strong>LAPORAN KETETAPAN DAN REALISASI</strong></td> 
                                <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                            </tr>
                            </table>';
            
            $output .= '<h2>LAPORAN KETETAPAN DAN REALISASI</h2>';
            //$output .= '<h2>TANGGAL : '.dateToString($date_start, "-")." s/d ".dateToString($date_end, "-").'</h2> <br/>';

            $output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                        <tr class="Caption">';


            $output.='<th rowspan = 2>NO</th>';
            $output.='<th rowspan = 2>KODE REKENING PENDAPATAN</th>';
            $output.='<th rowspan = 2>URAIAN</th>';
            //$output.='<th>NO KOHIR</th>';
            $output.='<th rowspan = 2>OBJEK PAJAK</th>';
            $output.='<th rowspan = 2>ALAMAT</th>';
            $output.='<th rowspan = 2>TANGGAL PENGUKUHAN</th>';
            $output.='<th rowspan = 2>NPWPD</th>';

            $output.='<th colspan = 14 align=center>REALISASI MASA PAJAK BULAN<br>TANGGAL PEMBAYARAN</th>';
            $output.='<th rowspan = 2>KETETAPAN REALISASI</th>';
            $output.='<th rowspan = 2>JUMLAH <BR>BULAN BAYAR</th>';
            $output.='<th rowspan = 2>RATA-RATA KETETAPAN</th>';
            $output.='</tr>';
                $output.='<tr class="Caption">';
                    $output.='<th align="center">SEBELUM DESEMBER '.($year_date-1).'</th>';
                    $output.='<th align="center">DESEMBER '.($year_date-1).'</th>';
                    $output.='<th align="center">JANUARI '.$year_date.'</th>';
                    $output.='<th align="center">FEBRUARI '.$year_date.'</th>';
                    $output.='<th align="center">MARET '.$year_date.'</th>';
                    $output.='<th align="center">APRIL '.$year_date.'</th>';
                    $output.='<th align="center">MEI '.$year_date.'</th>';
                    $output.='<th align="center">JUNI '.$year_date.'</th>';
                    $output.='<th align="center">JULI '.$year_date.'</th>';
                    $output.='<th align="center">AGUSTUS '.$year_date.'</th>';
                    $output.='<th align="center">SEPTEMBER '.$year_date.'</th>';
                    $output.='<th align="center">OKTOBER '.$year_date.'</th>';
                    $output.='<th align="center">NOVEMBER '.$year_date.'</th>';
                    $output.='<th align="center">SETELAH NOVEMBER '.$year_date.'</th>';
                $output.='</tr>';
            $output.='</tr>';

            $jumlahtemp=0;
            $jumlahperayat=0;
            $i=0;
            $i2=0;
            $before=0;
            $new=0;
            $jan=0;
            $feb=0;
            $mar=0;
            $apr=0;
            $mei=0;
            $jun=0;
            $jul=0;
            $agu=0;
            $sep=0;
            $okt=0;
            $nov=0;
            $des=0;
            $xdes=0;
            $xnov=0;
            $tgl_bayar_jan= '';
            $tgl_bayar_feb= '';
            $tgl_bayar_mar= '';
            $tgl_bayar_apr= '';
            $tgl_bayar_mei= '';
            $tgl_bayar_jun= '';
            $tgl_bayar_jul= '';
            $tgl_bayar_agu= '';
            $tgl_bayar_sep= '';
            $tgl_bayar_okt= '';
            $tgl_bayar_nov= '';
            $tgl_bayar_des= '';
            $tgl_bayar_xdes='';
            $tgl_bayar_xnov='';
            $jumlah_jan= 0;
            $jumlah_feb= 0;
            $jumlah_mar= 0;
            $jumlah_apr= 0;
            $jumlah_mei= 0;
            $jumlah_jun= 0;
            $jumlah_jul= 0;
            $jumlah_agu= 0;
            $jumlah_sep= 0;
            $jumlah_okt= 0;
            $jumlah_nov= 0;
            $jumlah_des= 0;
            $jumlah_xdes=0;
            $jumlah_xnov=0;
            $jumlah_jan_per_ayat= 0;
            $jumlah_feb_per_ayat= 0;
            $jumlah_mar_per_ayat= 0;
            $jumlah_apr_per_ayat= 0;
            $jumlah_mei_per_ayat= 0;
            $jumlah_jun_per_ayat= 0;
            $jumlah_jul_per_ayat= 0;
            $jumlah_agu_per_ayat= 0;
            $jumlah_sep_per_ayat= 0;
            $jumlah_okt_per_ayat= 0;
            $jumlah_nov_per_ayat= 0;
            $jumlah_des_per_ayat= 0;
            $jumlah_xdes_per_ayat=0;
            $jumlah_xnov_per_ayat=0;
            $jumlah_per_wp = 0;
            $jumlah_bulan_bayar = 0;
            $ketetapan_realisasi = 0; //jumlah pembayaran
            foreach($result as $item) {
                $bln = substr($item["masa_pajak"],-7,2);
                $thn = substr($item["masa_pajak"],-4,4);
                if ($new == 0){
                    $output .= '<tr>';
                    $output .= '<td align="center">'.($i+1).'</td>';
                    $output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
                    $output .= '<td align="center">'.$item["nama_ayat"].'</td>';
                    //$output .= '<td align="left">'.$item['no_kohir'].'</td>';
                    $output .= '<td align="left">'.$item['wp_name'].'</td>';
                    $output .= '<td align="left">'.$item['wp_address_name'].' '.$item['wp_address_no'].'</td>';
                    $output .= '<td align="left">'.$item['active_date2'].'</td>';
                    $output .= '<td align="left">'.$item['npwpd'].'</td>';
                    //$before = $item;
                    if ($thn == $year_date && $bln != 12){
                        switch ($bln) {
                            case "01":
                                $jan=$jan+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_jan=$jumlah_jan+$item["jumlah_terima"];
                                $jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_jan=$item["payment_date"];
                                break;
                            case "02":
                                $feb=$feb+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_feb=$jumlah_feb+$item["jumlah_terima"];
                                $jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_feb=$item["payment_date"];
                                break;
                            case "03":
                                $mar=$mar+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_mar=$jumlah_mar+$item["jumlah_terima"];
                                $jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_mar=$item["payment_date"];
                                break;
                            case "04":
                                $apr=$apr+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_apr=$jumlah_apr+$item["jumlah_terima"];
                                $jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_apr=$item["payment_date"];
                                break;
                            case "05":
                                $mei=$mei+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_mei=$jumlah_mei+$item["jumlah_terima"];
                                $jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_mei=$item["payment_date"];
                                break;
                            case "06":
                                $jun=$jun+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_jun=$jumlah_jun+$item["jumlah_terima"];
                                $jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_jun=$item["payment_date"];
                                break;
                            case "07":
                                $jul=$jul+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_jul=$jumlah_jul+$item["jumlah_terima"];
                                $jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_jul=$item["payment_date"];
                                break;
                            case "08":
                                $agu=$agu+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_agu=$jumlah_agu+$item["jumlah_terima"];
                                $jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_agu=$item["payment_date"];
                                break;
                            case "09":
                                $sep=$sep+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_sep=$jumlah_sep+$item["jumlah_terima"];
                                $jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_sep=$item["payment_date"];
                                break;
                            case "10":
                                $okt=$okt+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_okt=$jumlah_okt+$item["jumlah_terima"];
                                $jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_okt=$item["payment_date"];
                                break;
                            case "11":
                                $nov=$nov+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_nov=$jumlah_nov+$item["jumlah_terima"];
                                $jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_nov=$item["payment_date"];
                                break;
                        }
                    }else{
                        if ($thn == ($year_date - 1) && $bln == 12){
                            $des=$des+$item["jumlah_terima"];
                            $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                            if ($item["jumlah_terima"] > 0){
                                $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                            }
                            $jumlah_des=$jumlah_des+$item["jumlah_terima"];
                            $jumlah_des_per_ayat=$jumlah_des_per_ayat+$item["jumlah_terima"];
                            $tgl_bayar_des=$item["payment_date"];
                        }
                        else{
                            if ($thn < $year_date){
                                $xdes=$xdes+$item["jumlah_terima"];
                                $jumlah_xdes=$jumlah_xdes+$item["jumlah_terima"];
                                $jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_xdes=$item["payment_date"];
                            }
                            else{
                                if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
                                        $xnov=$xnov+$item["jumlah_terima"];
                                        $jumlah_xnov=$jumlah_xnov+$item["jumlah_terima"];
                                        $jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$item["jumlah_terima"];
                                        $tgl_bayar_xnov=$item["payment_date"];
                                }
                            }
                        }
                    }
                    //$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
                    //$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
                    //$output .= '<td align="left">'.$item['kd_tap'].'</td>';
                    //$output .= '<td align="left">'.$item['no_kohir'].'</td>';
                    //$output .= '</tr>';
                    $jumlahtemp += $item["jumlah_terima"];
                    $new =1;
                    $i = $i+1;
                    //$i2 = $i2 + 1;
                }else{
                    if ($before['npwpd']==$item['npwpd']){              
                        if ($thn == $year_date && $bln != 12){
                            switch ($bln) {
                                case "01":
                                    $jan=$jan+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_jan=$jumlah_jan+$item["jumlah_terima"];
                                    $jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_jan=$item["payment_date"];
                                    break;
                                case "02":
                                    $feb=$feb+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_feb=$jumlah_feb+$item["jumlah_terima"];
                                    $jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_feb=$item["payment_date"];
                                    break;
                                case "03":
                                    $mar=$mar+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_mar=$jumlah_mar+$item["jumlah_terima"];
                                    $jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_mar=$item["payment_date"];
                                    break;
                                case "04":
                                    $apr=$apr+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_apr=$jumlah_apr+$item["jumlah_terima"];
                                    $jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_apr=$item["payment_date"];
                                    break;
                                case "05":
                                    $mei=$mei+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_mei=$jumlah_mei+$item["jumlah_terima"];
                                    $jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_mei=$item["payment_date"];
                                    break;
                                case "06":
                                    $jun=$jun+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_jun=$jumlah_jun+$item["jumlah_terima"];
                                    $jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_jun=$item["payment_date"];
                                    break;
                                case "07":
                                    $jul=$jul+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_jul=$jumlah_jul+$item["jumlah_terima"];
                                    $jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_jul=$item["payment_date"];
                                    break;
                                case "08":
                                    $agu=$agu+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_agu=$jumlah_agu+$item["jumlah_terima"];
                                    $jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_agu=$item["payment_date"];
                                    break;
                                case "09":
                                    $sep=$sep+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_sep=$jumlah_sep+$item["jumlah_terima"];
                                    $jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_sep=$item["payment_date"];
                                    break;
                                case "10":
                                    $okt=$okt+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_okt=$jumlah_okt+$item["jumlah_terima"];
                                    $jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_okt=$item["payment_date"];
                                    break;
                                case "11":
                                    $nov=$nov+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_nov=$jumlah_nov+$item["jumlah_terima"];
                                    $jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_nov=$item["payment_date"];
                                    break;
                            }
                        }else{
                            if ($thn == ($year_date - 1) && $bln == 12){
                                $des=$des+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_des=$jumlah_des+$item["jumlah_terima"];
                                $jumlah_des_per_ayat=$jumlah_des_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_des=$item["payment_date"];
                            }
                            else{
                                if ($thn < $year_date){
                                    $xdes=$xdes+$item["jumlah_terima"];
                                    $jumlah_xdes=$jumlah_xdes+$item["jumlah_terima"];
                                    $jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_xdes=$item["payment_date"];
                                }
                                else{
                                    if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
                                            $xnov=$xnov+$item["jumlah_terima"];
                                            $jumlah_xnov=$jumlah_xnov+$item["jumlah_terima"];
                                            $jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$item["jumlah_terima"];
                                            $tgl_bayar_xnov=$item["payment_date"];
                                    }
                                }
                            }
                        }
                        $jumlahtemp += $item["jumlah_terima"];
                        $ayat = $item["kode_ayat"];
                    }else{
                        if($tgl_bayar==1){
                            $output .= '<td align="right">'.number_format($xdes, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_xdes.'</td>';
                            $output .= '<td align="right">'.number_format($des, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_des.'</td>';
                            $output .= '<td align="right">'.number_format($jan, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_jan.'</td>';
                            $output .= '<td align="right">'.number_format($feb, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_feb.'</td>';
                            $output .= '<td align="right">'.number_format($mar, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_mar.'</td>';
                            $output .= '<td align="right">'.number_format($apr, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_apr.'</td>';
                            $output .= '<td align="right">'.number_format($mei, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_mei.'</td>';
                            $output .= '<td align="right">'.number_format($jun, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_jun.'</td>';
                            $output .= '<td align="right">'.number_format($jul, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_jul.'</td>';
                            $output .= '<td align="right">'.number_format($agu, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_agu.'</td>';
                            $output .= '<td align="right">'.number_format($sep, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_sep.'</td>';
                            $output .= '<td align="right">'.number_format($okt, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_okt.'</td>';
                            $output .= '<td align="right">'.number_format($nov, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_nov.'</td>';
                            $output .= '<td align="right">'.number_format($xnov, 2, ',', '.');
                            $output .= '<br>'.$tgl_bayar_xnov.'</td>';
                        }else{
                            $output .= '<td align="right">'.number_format($xdes, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($des, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($jan, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($feb, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($mar, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($apr, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($mei, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($jun, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($jul, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($agu, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($sep, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($okt, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($nov, 2, ',', '.').'</td>';
                            $output .= '<td align="right">'.number_format($xnov, 2, ',', '.').'</td>';
                        }
                        //$new=0;
                        //$output .= '<tr>';
                        $jumlahperayat += $jumlahtemp;
                
                        //$output .= '<tr>';
                            //$output .= '<td align="CENTER" colspan=5>JUMLAH PAJAK '.$before["wp_name"].'</td>';
                            //$output .= '<td align="right">'.number_format($jumlah_per_wp, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_per_wp, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.$jumlah_bulan_bayar.'</td>';
                        if ($jumlah_bulan_bayar<1){
                            $output .= '<td align="right">'.number_format(0, 2, ',', '.').'</td>';
                        }else{
                            $output .= '<td align="right">'.number_format($jumlah_per_wp/$jumlah_bulan_bayar, 2, ',', '.').'</td>';
                        }
                        $output .= '</tr>';
                        $jumlahtemp=0;
                        $jan=0;
                        $feb=0;
                        $mar=0;
                        $apr=0;
                        $mei=0;
                        $jun=0;
                        $jul=0;
                        $agu=0;
                        $sep=0;
                        $okt=0;
                        $nov=0;
                        $des=0;
                        $xdes=0;
                        $xnov=0;
                        $tgl_bayar_jan= '';
                        $tgl_bayar_feb= '';
                        $tgl_bayar_mar= '';
                        $tgl_bayar_apr= '';
                        $tgl_bayar_mei= '';
                        $tgl_bayar_jun= '';
                        $tgl_bayar_jul= '';
                        $tgl_bayar_agu= '';
                        $tgl_bayar_sep= '';
                        $tgl_bayar_okt= '';
                        $tgl_bayar_nov= '';
                        $tgl_bayar_des= '';
                        $tgl_bayar_xdes='';
                        $tgl_bayar_xnov='';
                        $ayat = $item["kode_ayat"];
                        $ayatsesudah = $before["kode_ayat"];
                        if(($ayat != $ayatsesudah&&count($result)>1)){
                            $output .= '<tr>';
                                $output .= '<td align="CENTER" colspan=7>JUMLAH PER AYAT</td>';
                                $output .= '<td align="right">'.number_format($jumlah_xdes_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_des_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_jan_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_feb_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_mar_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_apr_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_mei_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_jun_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_jul_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_agu_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_sep_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_okt_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_nov_per_ayat, 2, ',', '.').'</td>';
                                $output .= '<td align="right">'.number_format($jumlah_xnov_per_ayat, 2, ',', '.').'</td>';
                            $output .= '</tr>';
                            $jumlah_jan_per_ayat= 0;
                            $jumlah_feb_per_ayat= 0;
                            $jumlah_mar_per_ayat= 0;
                            $jumlah_apr_per_ayat= 0;
                            $jumlah_mei_per_ayat= 0;
                            $jumlah_jun_per_ayat= 0;
                            $jumlah_jul_per_ayat= 0;
                            $jumlah_agu_per_ayat= 0;
                            $jumlah_sep_per_ayat= 0;
                            $jumlah_okt_per_ayat= 0;
                            $jumlah_nov_per_ayat= 0;
                            $jumlah_des_per_ayat= 0;
                            $jumlah_xdes_per_ayat=0;
                            $jumlah_xnov_per_ayat=0;
                        }
                        $jumlah_per_wp = 0;
                        $jumlah_bulan_bayar = 0;
                        $ketetapan_realisasi = 0; //jumlah pembayaran
                        $output .= '<tr><td align="center">'.($i+1).'</td>';
                        $output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
                        $output .= '<td align="center">'.$item["nama_ayat"].'</td>';
                        //$output .= '<td align="left">'.$item['no_kohir'].'</td>';
                        $output .= '<td align="left">'.$item['wp_name'].'</td>';
                        $output .= '<td align="left">'.$item['wp_address_name'].' '.$item['wp_address_no'].'</td>';
                        $output .= '<td align="left">'.$item['active_date2'].'</td>';
                        $output .= '<td align="left">'.$item['npwpd'].'</td>';
                        //$before = $item;
                        //$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
                        if ($thn == $year_date && $bln != 12){
                            switch ($bln) {
                                case "01":
                                    $jan=$jan+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_jan=$jumlah_jan+$item["jumlah_terima"];
                                    $jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_jan=$item["payment_date"];
                                    break;
                                case "02":
                                    $feb=$feb+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_feb=$jumlah_feb+$item["jumlah_terima"];
                                    $jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_feb=$item["payment_date"];
                                    break;
                                case "03":
                                    $mar=$mar+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_mar=$jumlah_mar+$item["jumlah_terima"];
                                    $jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_mar=$item["payment_date"];
                                    break;
                                case "04":
                                    $apr=$apr+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_apr=$jumlah_apr+$item["jumlah_terima"];
                                    $jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_apr=$item["payment_date"];
                                    break;
                                case "05":
                                    $mei=$mei+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_mei=$jumlah_mei+$item["jumlah_terima"];
                                    $jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_mei=$item["payment_date"];
                                    break;
                                case "06":
                                    $jun=$jun+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_jun=$jumlah_jun+$item["jumlah_terima"];
                                    $jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_jun=$item["payment_date"];
                                    break;
                                case "07":
                                    $jul=$jul+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_jul=$jumlah_jul+$item["jumlah_terima"];
                                    $jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_jul=$item["payment_date"];
                                    break;
                                case "08":
                                    $agu=$agu+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_agu=$jumlah_agu+$item["jumlah_terima"];
                                    $jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_agu=$item["payment_date"];
                                    break;
                                case "09":
                                    $sep=$sep+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_sep=$jumlah_sep+$item["jumlah_terima"];
                                    $jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_sep=$item["payment_date"];
                                    break;
                                case "10":
                                    $okt=$okt+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_okt=$jumlah_okt+$item["jumlah_terima"];
                                    $jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_okt=$item["payment_date"];
                                    break;
                                case "11":
                                    $nov=$nov+$item["jumlah_terima"];
                                    $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                    if ($item["jumlah_terima"] > 0){
                                        $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                    }
                                    $jumlah_nov=$jumlah_nov+$item["jumlah_terima"];
                                    $jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_nov=$item["payment_date"];
                                    break;
                            }
                        }else{
                            if ($thn == ($year_date - 1) && $bln == 12){
                                $des=$des+$item["jumlah_terima"];
                                $jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
                                if ($item["jumlah_terima"] > 0){
                                    $jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
                                }
                                $jumlah_des=$jumlah_des+$item["jumlah_terima"];
                                $jumlah_des_per_ayat=$jumlah_des_per_ayat+$item["jumlah_terima"];
                                $tgl_bayar_des=$item["payment_date"];
                            }
                            else{
                                if ($thn < $year_date){
                                    $xdes=$xdes+$item["jumlah_terima"];
                                    $jumlah_xdes=$jumlah_xdes+$item["jumlah_terima"];
                                    $jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$item["jumlah_terima"];
                                    $tgl_bayar_xdes=$item["payment_date"];
                                }
                                else{
                                    if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
                                            $xnov=$xnov+$item["jumlah_terima"];
                                            $jumlah_xnov=$jumlah_xnov+$item["jumlah_terima"];
                                            $jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$item["jumlah_terima"];
                                            $tgl_bayar_xnov=$item["payment_date"];
                                    }
                                }
                            }
                        }
                        $jumlahtemp += $item["jumlah_terima"];
                        $i=$i+1;
                
                    }
                }
                
                $before = $item;
                $i2=$i2+1;
                if(empty($result[$i2]))
                {
                    $jumlahperayat += $jumlahtemp;
                    if($tgl_bayar==1){
                        $output .= '<td align="right">'.number_format($xdes, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_xdes.'</td>';
                        $output .= '<td align="right">'.number_format($des, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_des.'</td>';
                        $output .= '<td align="right">'.number_format($jan, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_jan.'</td>';
                        $output .= '<td align="right">'.number_format($feb, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_feb.'</td>';
                        $output .= '<td align="right">'.number_format($mar, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_mar.'</td>';
                        $output .= '<td align="right">'.number_format($apr, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_apr.'</td>';
                        $output .= '<td align="right">'.number_format($mei, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_mei.'</td>';
                        $output .= '<td align="right">'.number_format($jun, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_jun.'</td>';
                        $output .= '<td align="right">'.number_format($jul, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_jul.'</td>';
                        $output .= '<td align="right">'.number_format($agu, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_agu.'</td>';
                        $output .= '<td align="right">'.number_format($sep, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_sep.'</td>';
                        $output .= '<td align="right">'.number_format($okt, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_okt.'</td>';
                        $output .= '<td align="right">'.number_format($nov, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_nov.'</td>';
                        $output .= '<td align="right">'.number_format($xnov, 2, ',', '.');
                        $output .= '<br>'.$tgl_bayar_xnov.'</td>';
                    }else{
                        $output .= '<td align="right">'.number_format($xdes, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($des, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jan, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($feb, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($mar, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($apr, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($mei, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jun, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jul, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($agu, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($sep, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($okt, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($nov, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($xnov, 2, ',', '.').'</td>';
                    }
                    
                    $output .= '<td align="right">'.number_format($jumlah_per_wp, 2, ',', '.').'</td>';
                    $output .= '<td align="right">'.$jumlah_bulan_bayar.'</td>';
                    $avg_tap = 0;
                    if ($jumlah_bulan_bayar==0) {
                        $avg_tap = 0;
                    }else{
                        $avg_tap = $jumlah_per_wp/$jumlah_bulan_bayar;
                    }

                    $output .= '<td align="right">'.number_format($avg_tap, 2, ',', '.').'</td>';
                    
                    $output .= '</tr>';
                    $output .= '<tr>';
                        $output .= '<td align="CENTER" colspan=7>JUMLAH PER AYAT</td>';
                        $output .= '<td align="right">'.number_format($jumlah_xdes_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_des_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_jan_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_feb_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_mar_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_apr_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_mei_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_jun_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_jul_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_agu_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_sep_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_okt_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_nov_per_ayat, 2, ',', '.').'</td>';
                        $output .= '<td align="right">'.number_format($jumlah_xnov_per_ayat, 2, ',', '.').'</td>';
                    $output .= '</tr>';
                }
            }
            $output .= '<tr>';
                $output .= '<td align="CENTER" colspan=7>TOTAL PAJAK</td>';
                $output .= '<td align="right">'.number_format($jumlah_xdes, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_des, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_jan, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_feb, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_mar, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_apr, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_mei, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_jun, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_jul, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_agu, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_sep, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_okt, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_nov, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlah_xnov, 2, ',', '.').'</td>';
                $output .= '<td align="right">'.number_format($jumlahperayat, 2, ',', '.').'</td>';
            $output .= '</tr>';

            $output.='</td></tr></table>';
            $output.='</table>';

            //print_r($item['avg_tap']); exit();
            
            echo $output;
                exit;
        } catch(Exception $e){
            echo $e->getMessage();
                exit;
        }


    }

        
}

/* End of file T_laporan_ketetapan_dan_realisasi_controller.php.php */
