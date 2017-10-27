<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_rep_lap_kepatuhan_wp extends CI_Controller{

	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 330;
    var $paperHSize = 215;
    var $height = 5;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function __construct() {
        parent::__construct();
        //$this->formCetak();
        $pdf = new FPDF();
        $this->startY = $pdf->GetY();
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF();
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function pageCetak() {
		$pdf = new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage("L");
		$pdf->SetFont('Arial', '', 10);
		
		$pdf->Image('images/logo_pemda.png',15,13,25,25);

		$p_vat_type_id			= getVarClean('p_vat_type_id','int',0);
		$p_finance_period_id	= getVarClean('p_finance_period_id','int',0);
		$p_year_period_id		= getVarClean('p_year_period_id','int',0);
		$status				    = getVarClean('status','int',0);
		$cetak					= getVarClean('cetak','str','');
		$sql = "";
		if ($cetak == 'group'){	 //DATA GRUP
			$sql	= "select * from sikp.f_rep_bpps_patuh2 ($p_vat_type_id, $p_finance_period_id,$status)
			order by nama_ayat, payment_date";	
		}else{		//DATA UMUM 
			$sql	= "select * from sikp.f_rep_bpps_patuh2 ($p_vat_type_id, $p_finance_period_id,$status)
			order by payment_date";	
		}
		$query = $this->db->query($sql);
		$data = $query->result_array();


		$sql = "select vat_code from p_vat_type where p_vat_type_id=$p_vat_type_id";
		$query = $this->db->query($sql);
		$item = $query->row_array();

		$pajak = $item['vat_code'];

		$sql = "select code from p_finance_period where p_finance_period_id=$p_finance_period_id";
		$query = $this->db->query($sql);
		$item = $query->row_array();

		$period = $item['code'];
		

		//$period 				= CCGetFromGet("period", "");
		//$pajak 					= strtoupper(CCGetFromGet("pajak", ""));

		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$pdf->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "T", 0, 'L');
		$pdf->Cell($lheader1, $this->height, "", "TR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, "LAPORAN REALISASI HARIAN", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, strtoupper($pajak), "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, "PERIODE " . $period, "R", 0, 'C');		
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, "", "R", 0, 'L');
		//if($tgl_penerimaan == $tgl_penerimaan_last)
		//	$pdf->Cell($lheader4, $this->height, "Tanggal Penerimaan " . $tgl_penerimaan, "R", 0, 'C');
		//else 
		//	$pdf->Cell($lheader4, $this->height, "Tanggal Penerimaan : " . $tgl_penerimaan. " s/d ".$tgl_penerimaan_last, "R", 0, 'C');
			
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$pdf->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		$pdf->Ln();
		
		$ltable = $this->lengthCell / 26;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable22 = $ltable * 22;
		
		/*$pdf->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$pdf->Cell($ltable2, $this->height + 2, "NO. AYAT", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "NAMA AYAT", "TBLR", 0, 'C');
		$pdf->Cell($ltable2, $this->height + 2, "NO. KOHIR", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "JUMLAH", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "MASA PAJAK", "TBLR", 0, 'C');
		$pdf->Cell($ltable2, $this->height + 2, "TGL TAP", "TBLR", 0, 'C');
		$pdf->Cell($ltable2, $this->height + 2, "TGL BAYAR.", "TBLR", 0, 'C');
		$pdf->Ln();*/

		//isi kolom
		
		$no = 1;
		$jumlahperayat = array();
		$jumlahperwaktu = array();
		$jumlahtemp = 0;
		$i=0;
		$total=0;
			
		if ($cetak == 'group'){
			$pdf->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
			$pdf->Cell($ltable2, $this->height + 2, "NO. AYAT", "TBLR", 0, 'C');
			$pdf->Cell($ltable3, $this->height + 2, "NAMA AYAT", "TBLR", 0, 'C');
			$pdf->Cell($ltable2, $this->height + 2, "NO. KOHIR", "TBLR", 0, 'C');
			$pdf->Cell($ltable5, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
			$pdf->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
			$pdf->Cell($ltable3, $this->height + 2, "JUMLAH", "TBLR", 0, 'C');
			$pdf->Cell($ltable3, $this->height + 2, "MASA PAJAK", "TBLR", 0, 'C');
			$pdf->Cell($ltable2, $this->height + 2, "TGL TAP", "TBLR", 0, 'C');
			$pdf->Cell($ltable2, $this->height + 2, "TGL BAYAR.", "TBLR", 0, 'C');
			$pdf->Ln();
			
			$pdf->SetWidths(array($ltable1, $ltable2, $ltable3, $ltable2, $ltable5, $ltable3, $ltable3, $ltable3, $ltable2, $ltable2));
			$pdf->SetAligns(array("C", "L", "L", "L", "L", "L", "R", "L", "L", "L"));

			for($i=0; $i<count($data); $i++){	
				// print_r(count($data));
				// exit();
				$s_date='';
				//if ($item["settlement_date"] == date("d-m-Y", strtotime("now")) ){
				if ( $data[$i]['settlement_date'] == '' ){
					$s_date="-";
				}else{	
					$s_date=$data[$i]['settlement_date'];
				}

				$p_date="";
				//if ($data["payment_date"] == date("d-m-Y", strtotime("now")) ){
				if ($data[$i]['payment_date'] == "" ){
					$p_date="-";
				}else{	
					$p_date=$data[$i]['payment_date'];
				}

				//echo $s_date;
				//echo exit;

				$pdf->RowMultiBorderWithHeight(array($no,
													  $data[$i]["kode_jns_pajak"]." ".$data[$i]["kode_ayat"],
													  $data[$i]["nama_ayat"],
													  $data[$i]["no_kohir"],
													  $data[$i]["wp_name"],
													  $data[$i]["npwpd"],
													  number_format($data[$i]["jumlah_terima"], 0, ',', '.'),
													  $data[$i]["masa_pajak"],
													  $s_date,
													  $p_date
													  ),
												array('TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR')
													  ,$this->height);
				$no++;

				//hitung jumlahperayat sampai baris ini
				$jumlahtemp += $data[$i]["jumlah_terima"];
				$total+= $data[$i]["jumlah_terima"];
				//cek apakah perlu bikin baris jumlah
				//jika iya, simpan jumlahtemp ke jumlahperayat, print jumlahtemp, reset jumlahtemp
				// print_r($data);
				// exit();
				

				$ayat = $data[$i]["kode_ayat"];
				if(($i+1) < count($data)){
		          	$ayatsesudah = $data[$i+1]["kode_ayat"];
		        } else {
		        	$ayatsesudah = $data[$i]["kode_ayat"];
		        }
				if(($ayat != $ayatsesudah&&count($data)>1)||empty($data[$i+1])){
					$jumlahperayat[] = $jumlahtemp;
					$pdf->Cell($ltable22, $this->height + 2, "JUMLAH PAJAK " . strtoupper($data[$i]["nama_ayat"]), "TBLR", 0, 'C');
					$pdf->Cell($ltable4, $this->height + 2, "Rp. ".number_format($jumlahtemp, 0, ',', '.'), "TBLR", 0, 'R');
					$pdf->Ln();
					$jumlahtemp = 0;
				
				}
				//cek apakah sudah pindah waktu (pagi ke titipan)
				//jika ya, totalkan jumlahperayat jadi tempperayat, copy ke jumlahperwaktu, print tempperayat, reset jumlahperayat
				/*$waktuayat = $data["jns_trans"];
				$waktuayatsesudah = $data[$i+1]["jns_trans"];
				if($waktuayat != $waktuayatsesudah&&count($data)>1){
					$tempperayat = 0;
					for($j = 0; $j < count($jumlahperayat); $j++){
						$tempperayat += $jumlahperayat[$j];
					}

					$jumlahperwaktu[] = $tempperayat;
					$pdf->Cell($ltable22, $this->height + 2, "JUMLAH " . $data["jns_trans"], "TBLR", 0, 'C');
					$pdf->Cell($ltable4, $this->height + 2, number_format($tempperayat, 0, ',', '.'), "TBLR", 0, 'R');
					$pdf->Ln();
					$jumlahperayat = array();
				}*/

			}
			$pdf->Cell($ltable22, $this->height + 2, "TOTAL " . strtoupper($pajak), "TBLR", 0, 'C');
			$pdf->Cell($ltable4, $this->height + 2, "Rp. ".number_format($total, 0, ',', '.'), "TBLR", 0, 'R');
	
		}else{

			$pdf->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
			//$pdf->Cell($ltable2, $this->height + 2, "NO. AYAT", "TBLR", 0, 'C');
			//$pdf->Cell($ltable3, $this->height + 2, "NAMA AYAT", "TBLR", 0, 'C');
			//$pdf->Cell($ltable2, $this->height + 2, "NO. KOHIR", "TBLR", 0, 'C');
			$pdf->Cell($ltable5, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
			$pdf->Cell($ltable3+$ltable2+$ltable2+$ltable2, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
			$pdf->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
			//$pdf->Cell($ltable3, $this->height + 2, "MASA PAJAK", "TBLR", 0, 'C');
			//$pdf->Cell($ltable2, $this->height + 2, "TGL TAP", "TBLR", 0, 'C');
			$pdf->Cell($ltable2+$ltable2, $this->height + 2, "TGL BAYAR", "TBLR", 0, 'C');
			$pdf->Cell($ltable2+$ltable2, $this->height + 2, "JUMLAH PEMBAYARAN", "TBLR", 0, 'C');
			$pdf->Ln();

			$pdf->SetWidths(array($ltable1, 
				//$ltable2, 
				//$ltable3, 
				//$ltable2, 
				$ltable5, 
				$ltable3+$ltable2+$ltable2+$ltable2, 
				$ltable3, 
				//$ltable3, 
				//$ltable2, 
				$ltable2+$ltable2,
				$ltable2+$ltable2));
			$pdf->SetAligns(array("C",
				//"L", 
				//"L", 
				//"L", 
				"L", 
				"L", 
				"L", 
				//"L", 
				//"L", 
				"C",
				"R"));			
			foreach($data as $item) {
				//print data

				$p_date="";
				//if ($item["payment_date"] == date("d-m-Y", strtotime("now")) ){
				if ($item["payment_date"] == "" ){
					$p_date="-";
				}else{	
					$p_date=$item["payment_date"];
				}
				// print_r($item);
				// exit();

				$pdf->RowMultiBorderWithHeight(array($no,
													  //$item["kode_jns_pajak"]." ".$item["kode_ayat"],
													  //$item["nama_ayat"],
													  //$item["no_kohir"],
													  $item["wp_name"],
													  $item["wp_address"],
													  $item["npwpd"],
													  //$item["masa_pajak"],
													  //$item["kd_tap"],
													  $p_date,
													  number_format($item["jumlah_terima"], 0, ',', '.')
													  ),
												array('TBLR',
													  //'TBLR',
													  //'TBLR',
													  //'TBLR',
													  'TBLR',
													  'TBLR',
													  'TBLR',
													  //'TBLR',
													  //'TBLR'
													  'TBLR',
													  'TBLR')
													  ,$this->height);
				$no++;
				
				//hitung jumlahperayat sampai baris ini
				$jumlahtemp += $item["jumlah_terima"];
				//$total+= $item["jumlah_terima"];
				//cek apakah perlu bikin baris jumlah
				//jika iya, simpan jumlahtemp ke jumlahperayat, print jumlahtemp, reset jumlahtemp
				//$ayat = $item["kode_ayat"];
				//$ayatsesudah = $data[$i+1]["kode_ayat"];
				//if(($ayat != $ayatsesudah&&count($data)>1)||empty($data[$i+1])){
				//	$jumlahperayat[] = $jumlahtemp;
				//	$pdf->Cell($ltable22, $this->height + 2, "JUMLAH PAJAK " . strtoupper($item["nama_ayat"]), "TBLR", 0, 'C');
				//	$pdf->Cell($ltable4, $this->height + 2, "Rp. ".number_format($jumlahtemp, 0, ',', '.'), "TBLR", 0, 'R');
				//	$pdf->Ln();
				//	$jumlahtemp = 0;
				
				//}
				//cek apakah sudah pindah waktu (pagi ke titipan)
				//jika ya, totalkan jumlahperayat jadi tempperayat, copy ke jumlahperwaktu, print tempperayat, reset jumlahperayat
				/*$waktuayat = $item["jns_trans"];
				$waktuayatsesudah = $data[$i+1]["jns_trans"];
				if($waktuayat != $waktuayatsesudah&&count($data)>1){
					$tempperayat = 0;
					for($j = 0; $j < count($jumlahperayat); $j++){
						$tempperayat += $jumlahperayat[$j];
					}

					$jumlahperwaktu[] = $tempperayat;
					$pdf->Cell($ltable22, $this->height + 2, "JUMLAH " . $item["jns_trans"], "TBLR", 0, 'C');
					$pdf->Cell($ltable4, $this->height + 2, number_format($tempperayat, 0, ',', '.'), "TBLR", 0, 'R');
					$pdf->Ln();
					$jumlahperayat = array();
				}*/
				$i++;
			}
			$pdf->Cell($ltable22, $this->height + 2, "TOTAL " . strtoupper($pajak), "TBLR", 0, 'C');
			$pdf->Cell($ltable4, $this->height + 2, "Rp. ".number_format($jumlahtemp, 0, ',', '.'), "TBLR", 0, 'R');
	
		}

		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$pdf->SetAligns(array("C", "C"));
		$pdf->SetWidths(array(180, 120));
		$pdf->RowMultiBorderWithHeight( array("","Bandung, " . date("d F Y")."\n\n\n\n\n\n\n\n(....................................)"), array("",""), 5 );
	
	    
		/*$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');*/
		//$pdf->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y")."\n\n\n\n\n(....................................)" /*. $data["tanggal"]*/, "", 0, 'C');
		$pdf->Output();
    }
	


	

	

}



