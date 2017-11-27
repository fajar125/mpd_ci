<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_laporan_daftar_bphtb_controller
* @version 07/05/2015 12:18:00
*/
class T_laporan_daftar_bphtb_controller {

    function excel()
    {
        $start_date = getVarClean('date_start_laporan', 'str', '');
        $end_date   = getVarClean('date_end_laporan', 'str', '');
        $kec        = getVarClean('object_p_region_id_kec','str','');

        try {

            $ci = &get_instance();
            $ci->load->model('transaksi/t_laporan_daftar_bphtb');
            $table = $ci->t_laporan_daftar_bphtb;

            $items = $table->getExcel($start_date, $end_date);  
            
            startExcel('DAFTAR_BPHTB_'.date("dmy").'.xls');
            echo '<html>';
            echo '<head><title>LAPORAN DAFTAR BPHTB</title></head>';
            echo '<body>';
            	echo '<div><h3> LAPORAN DAFTAR BPHTB</h3></div>';
            	echo '<div><b> Tanggal : '.$this->dateToString($start_date) .' s/d '. $this->dateToString($end_date) .'</b></div>';
                echo '<table border="1">';
	                echo '<tr>
							<th rowspan="2">NO</th>
							<th rowspan="2">TANGGAL</th>
							<th rowspan="2">NO ORDER</th>
							<th rowspan="2">NO REGISTRASI</th>
							<th rowspan="2">NAMA WAJIB PAJAK</th>
							<th rowspan="2">NPWP</th>
							<th rowspan="2">JENIS DOKUMEN</th>
							<th colspan="4">ALAMAT WAJIB PAJAK</th>
							<th rowspan="2">NO TELP</th>
							<th rowspan="2">NO HP</th>
							<th rowspan="2">NJOP PBB</th>
							<th colspan="4">ALAMAT OBJEK PAJAK</th>
							<th colspan="3">TANAH</th>
							<th colspan="3">BANGUNAN</th>
							<th rowspan="2">HARGA TRANSAKSI / <br> PASAR / <br> LELANG (Rp)</th>
							<th rowspan="2">NPOP (Rp)</th>
							<th rowspan="2">NPOP TKP (Rp)</th>
							<th rowspan="2">NPOP KP (Rp)</th>
							<th rowspan="2">BPTHTB AMOUNT (Rp)</th>
							<th rowspan="2">BPTHTB DISKON (Rp)</th>
							<th rowspan="2">BPTHTB TOTAL (Rp)</th>
							<th rowspan="2">KETERANGAN</th>
							<th rowspan="2">PEMERIKSA</th>
							<th rowspan="2">NIP PEMERIKSA</th>
						</tr>';

					echo '
						<tr>
							<th>ALAMAT</th>
							<th>RT/RW</th>
							<th>KECAMATAN</th>
							<th>KELURAHAN</th>			

							<th>ALAMAT</th>
							<th>RT/RW</th>
							<th>KECAMATAN</th>
							<th>KELURAHAN</th>
							
							<th>LUAS TANAH (m2)</th>
							<th>HARGA PER METER (Rp)</th>
							<th>HARGA TANAH (Rp)</th>

							<th>LUAS BANGUNAN (m2)</th>
							<th>HARGA PER METER (Rp)</th>
							<th>HARGA BANGUNAN (Rp)</th>
						</tr>';

	                $no = 1;
	                if ($items != 'no result'){
		                foreach ($items as $item) {
		                	echo '<tr>';
								echo '<td align="center">'.$no++.'</td>';
								echo '<td align="left">&nbsp;'.$this->dateToString($item['tgl_bphtb']).'</td>';
								echo '<td align="left">&nbsp;'.$item['order_no'].'</td>';
								echo '<td align="left">&nbsp;'.$item['registration_no'].'</td>';
								echo '<td align="left">'.strtoupper($item['wp_name']).'</td>';
								echo '<td align="left">&nbsp;'.$item['npwp'].'</td>';
								echo '<td align="left">'.$item['nama_dokumen'].'</td>';
								echo '<td align="left">'.strtoupper($item['wp_address_name']).'</td>';
								echo '<td align="left">'.$item['wp_rt'].' / '.$item['wp_rw'].'</td>';
								echo '<td align="left">'.$item['kecamatan_wp_name'].'</td>';
								echo '<td align="left">'.$item['kelurahan_wp_name'].'</td>';
								echo '<td align="left">&nbsp;'.$item['phone_no'].'</td>';
								echo '<td align="left">&nbsp;'.$item['mobile_phone_no'].'</td>';
								echo '<td align="left">&nbsp;'.$item['njop_pbb'].'</td>';		
								echo '<td align="left">'.strtoupper($item['object_address_name']).'</td>';
								echo '<td align="left">'.$item['object_rt'].' / '.$item['object_rw'].'</td>';
								echo '<td align="left">'.$item['kecamatan_op_name'].'</td>';
								echo '<td align="left">'.$item['kelurahan_op_name'].'</td>';
								echo '<td align="right">'.number_format($item['land_area'],0,",",".").'</td>';		
								echo '<td align="right">'.number_format($item['land_price_per_m'],0,",",".").'</td>';		
								echo '<td align="right">'.number_format($item['land_total_price'],0,",",".").'</td>';	
								echo '<td align="right">'.number_format($item['building_area'],0,",",".").'</td>';		
								echo '<td align="right">'.number_format($item['building_price_per_m'],0,",",".").'</td>';		
								echo '<td align="right">'.number_format($item['building_total_price'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['market_price'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['npop'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['npop_tkp'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['npop_kp'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['bphtb_amt'],0,",",".").'</td>';		
								echo '<td align="right">'.number_format($item['bphtb_discount'],0,",",".").'</td>';	
								echo '<td align="right">'.number_format($item['bphtb_amt_final'],0,",",".").'</td>';	
								echo '<td align="left">'.$item['description'].'</td>';
								echo '<td align="left">'.$item['verificated_by'].'</td>';
								echo '<td align="left">&nbsp;'.$item['verificated_nip'].'</td>';
							echo '</tr>';
		                }
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

/* End of file Groups_controller.php */