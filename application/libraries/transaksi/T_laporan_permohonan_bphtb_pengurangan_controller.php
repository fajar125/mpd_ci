<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_laporan_permohonan_bphtb_pengurangan_controller
* @version 07/05/2015 12:18:00
*/
class T_laporan_permohonan_bphtb_pengurangan_controller {

	function read()
    {
        $start_date      = getVarClean('date_start_laporan', 'str', '');
        $end_date        = getVarClean('date_end_laporan', 'str', '');
        $no_transaksi    = getVarClean('receipt_no','str','');
        $nop             = getVarClean('njop_pbb', 'str', '');
        $nama            = getVarClean('wp_name', 'str', '');
        $kec             = getVarClean('p_region_id_kecamatan','str','');
        $kel 			 = getVarClean('p_region_id_kelurahan', 'str', '');
        $jenis_transaksi = getVarClean('p_bphtb_legal_doc_type_id', 'str', '');
        $sidx 			 = getVarClean('sidx','str','wp_name');
        $sord 			 = getVarClean('sord','str','asc');
        $page			 = getVarClean('page','int',1);
        $limit 			 = getVarClean('rows','int',5);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {
            if ((!empty($start_date)&&!empty($end_date))||!empty($no_transaksi)||!empty($nop)||!empty($nama)||!empty($kec)||!empty($kel)||!empty($jenis_transaksi)){
            	$ci = & get_instance();
                $ci->load->model('transaksi/t_laporan_permohonan_bphtb_pengurangan');
                $table = $ci->t_laporan_permohonan_bphtb_pengurangan;

                


                if (!empty($start_date)  && !empty($end_date))
	            	$table->setCriteria(" (trunc(b.creation_date) BETWEEN '".$start_date."' AND '".$end_date."') ");

		        if (!empty($no_transaksi))
		            $table->setCriteria(" a.receipt_no ILIKE '%".$no_transaksi."%' ");

		        if (!empty($nop))
		            $table->setCriteria(" b.njop_pbb = '".$nop."' ");

		        if (!empty($nama))
		            $table->setCriteria(" b.wp_name ILIKE '%".$nama."%' ");

		        if (!empty($kec))
		            $table->setCriteria(" b.object_p_region_id_kec = ".$kec);

		        if (!empty($kel))
		            $table->setCriteria(" b.object_p_region_id_kel = ".$kel);

		        if (!empty($jenis_transaksi))
		            $table->setCriteria(" b.p_bphtb_legal_doc_type_id = ".$jenis_transaksi);

		        $table->setCriteria(" pengurangan.t_bphtb_exemption_id is not null ");                     

                $count = $table->countAll();

                if ($count > 0) $total_pages = ceil($count / $limit);
                else $total_pages = 1;

                if ($page > $total_pages) $page = $total_pages;
                $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

                

                if ($page == 0) $data['page'] = 1;
                else $data['page'] = $page;

                $data['total'] = $total_pages;
                $data['records'] = $count;

                $data['rows'] = $table->getAll(0, 0, 'b.creation_date', 'asc');
            }
            $data['success'] = true;
            return $data;
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }
    function excel()
    {
        $start_date      = getVarClean('date_start_laporan', 'str', '');
        $end_date        = getVarClean('date_end_laporan', 'str', '');
        $no_transaksi    = getVarClean('receipt_no','str','');
        $nop             = getVarClean('njop_pbb', 'str', '');
        $nama            = getVarClean('wp_name', 'str', '');
        $kec             = getVarClean('p_region_id_kecamatan','str','');
        $kel 			 = getVarClean('p_region_id_kelurahan', 'str', '');
        $jenis_transaksi = getVarClean('p_bphtb_legal_doc_type_id', 'str', '');

        try {

            $ci = &get_instance();
            $ci->load->model('transaksi/t_laporan_permohonan_bphtb_pengurangan');
            $table = $ci->t_laporan_permohonan_bphtb_pengurangan;

            if (!empty($start_date)  && !empty($end_date))
            	$table->setCriteria(" (trunc(b.creation_date) BETWEEN '".$start_date."' AND '".$end_date."') ");

	        if (!empty($no_transaksi))
	            $table->setCriteria(" a.receipt_no ILIKE '%".$no_transaksi."%' ");

	        if (!empty($nop))
	            $table->setCriteria(" b.njop_pbb = '".$nop."' ");

	        if (!empty($nama))
	            $table->setCriteria(" b.wp_name ILIKE '%".$nama."%' ");

	        if (!empty($kec))
	            $table->setCriteria(" b.object_p_region_id_kec = ".$kec);

	        if (!empty($kel))
	            $table->setCriteria(" b.object_p_region_id_kel = ".$kel);

	        if (!empty($jenis_transaksi))
	            $table->setCriteria(" b.p_bphtb_legal_doc_type_id = ".$jenis_transaksi);

	        $table->setCriteria(" pengurangan.t_bphtb_exemption_id is not null ");


            $items = $table->getAll(0, 0, 'b.creation_date', 'asc');

            //print_r($items);



            //print_r($items);

            //exit;
            
            startExcel('PERMOHONAN_BPTHB_PENGURANGAN_'.date("dmy").'.xls');
            echo '<html>';
            echo '<head><title>DAFTAR REKAPITULASI PERMOHONAN PENGURANGAN PEMBAYARAN BPHTB</title></head>';
            echo '<body>';
            	echo '<div><h3> LAPORAN PENERIMAAN BPHTB PENGURANGAN</h3></div>';
            	echo '<div><b> Tanggal : '.$this->dateToString($start_date) .' s/d '. $this->dateToString($end_date) .'</b></div>';
                echo '<table border="1">';
	                echo '<tr>
								<th>No</th>
								<th>Nama Pemohon</th>
								<th>Alamat</th> 
								<th>NOP PBB</th>
								<th>Letak Tanah dan Bangunan</th>
								<th>Akta/Risalah Lelang/Kep. Pemberian Hak/Dokumen lainnya</th>
								<th>NJOP (Rp)</th>
								<th>BPHTB TERHUTANG (Rp)</th>
								<th>PENGURANGAN (Rp)</th>
								<th>TANGGAL MENGAJUKAN PERMOHONAN</th> 
						  </tr>';

	                $no = 1;
	                $total_njop = 0 ;
	                $total_bphtb_amt_final = 0 ;
	                $total_bphtb_discount = 0 ;
	                if (!empty($items)){
		                foreach ($items as $item) {
		                	echo '<tr>';
								echo '<td align="center">'.$no++.'</td>';
								echo '<td align="left">'.trim(strtoupper($item['wp_name'])).'</td>';
								echo '<td align="left">'.$item['wp_address_name'].'<br>
														Kel. '.$item['kelurahan_name'].'<br>
														Kec. '.$item['kecamatan_name'].'<br>
														'.$item['kota_name'].'</td>';
								echo '<td align="left">&nbsp;'.$item['njop_pbb'].'</td>';
								echo '<td align="left">'.$item['object_address_name'].'<br>
														Kel. '.$item['object_kelurahan_name'].'<br>
														Kec. '.$item['object_kecamatan_name'].'<br>
														'.$item['object_kota_name'].'</td>';
								echo '<td align="left">'.$item['keterangan_opsi_c'].'</td>';
								echo '<td align="right">'.number_format($item['njop'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['bphtb_amt'],0,",",".").'</td>';
								echo '<td align="right">'.number_format($item['bphtb_discount'],0,",",".").'</td>';
								echo '<td align="center">'.$this->dateToString($item['creation_date']).'</td>';
							echo '</tr>';
							
							$total_njop += $item['njop'];
							$total_bphtb_amt_final += $item['bphtb_amt'];
							$total_bphtb_discount += $item['bphtb_discount'];
		                }
	                }
	                echo '<tr>
							<td colspan="6" align="center"> <b>TOTAL</b> </td>
							<td align="right"><b>'.number_format($total_njop,0,",",".").'</b></td>
							<td align="right"><b>'.number_format($total_bphtb_amt_final,0,",",".").'</b></td>
							<td align="right"><b>'.number_format($total_bphtb_discount,0,",",".").'</b></td>
							<td align="center"> &nbsp; </td>
						 </tr>';
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