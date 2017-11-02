<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_rep_penerimaan_pertahun extends CI_Controller{

	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 400;
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
		$this->startX = $this->paperWSize-160;
		$this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF();
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function pageCetak() {
		$pdf = new FPDF();
		
		$pdf->PageSize=array(215,325);
		$pdf->AliasNbPages();
		$pdf->AddPage("L");
		$pdf->SetFont('Arial', '', 10);

		$p_year_period_id	= getVarClean("p_year_period_id", "int", 0);
		$p_vat_type_id		= getVarClean("p_vat_type_id", "int", 0);
		$tgl_status			= getVarClean("tgl_status", "str", "");
		$p_account_status_id= getVarClean("p_account_status_id", "int", 0);
		$status_bayar = getVarClean("status_bayar", "int", 0);

		$sql				= "select * from f_rep_penerimaan_pertahun_sts_new_desc($p_year_period_id, $p_vat_type_id, '$tgl_status', $p_account_status_id, $status_bayar);";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		
		$pdf->Image('images/logo_pemda.png',15,13,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$ltable = $this->lengthCell / 46;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable9 = $ltable * 9;
		$ltable36 = $ltable * 36;		

		$pdf->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "", "TR", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "", "T", 0, 'L');
		$pdf->Cell($lheader1+$ltable2+$ltable1, $this->height, "", "TR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$pdf->Cell($lheader4+$ltable2+$ltable1, $this->height, "LAPORAN PENERIMAAN PER TAHUN", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$pdf->Cell($lheader4+$ltable2+$ltable1, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$pdf->Cell($lheader4+$ltable2+$ltable1, $this->height, "Tahun " . $data[0]['tahun'], "R", 0, 'C');		
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$pdf->Cell($lheader4+$ltable2+$ltable1, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$pdf->Cell($lheader3+$ltable2, $this->height, "", "BR", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$pdf->Cell($lheader1+$ltable3+$ltable1, $this->height, "", "BR", 0, 'L');
		$pdf->Ln();
		
		

		$pdf->SetFont('Arial', '', 6);
		
		$pdf->Cell($ltable2, $this->height + 5, "NO.", "TLR", 0, 'C');
		$pdf->Cell($ltable4, $this->height, "NAMA", "TLR", 0, 'C');
		$pdf->Cell($ltable4, $this->height + 5, "ALAMAT", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "TANGGAL", "TLR", 0, 'C');
		$pdf->Cell($ltable36, $this->height, "REALISASI DAN TANGGAL BAYAR", "TBLR", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($ltable2, $this->height, "", "LR", 0, 'C');
		$pdf->Cell($ltable4, $this->height, "PERUSAHAAN", "LR", 0, 'C');
		$pdf->Cell($ltable4, $this->height, "", "LR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "PENGUKUHAN", "LR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "DESEMBER", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "JANUARI", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "FEBRUARI", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "MARET", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "APRIL", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "MEI", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "JUNI", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "JULI", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "AGUSTUS", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "SEPTEMBER", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "OKTOBER", "TLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "NOVEMBER", "TLR", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($ltable2, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable4, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable4, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "LR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, $data[0]['tahun'] - 1, "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$pdf->Ln();
		//isi kolom
		
		//isi kolom
		$no = 1;
		for ($i = 0; $i < count($data); $i++) {
			$pdf->SetWidths(array($ltable2, $ltable4, $ltable4,$ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3));
			$pdf->SetAligns(array("C", "L", "L","C", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
			
			// print data piutang
			$data2 = array();
			for($j = 1; $j <= 12; $j++){
				$sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
				$amt = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_amt";
				
				if(is_null($data[$i][$sts])){
					$data2[$j] = number_format(round($data[$i][$amt]), 0, ',', '.');
				}
				else{
					$data2[$j] = $data[$i][$sts];
				}
			}
			
			$pdf->RowMultiBorderWithHeight(
				array(
					$no,
					$data[$i]["nama"],
					$data[$i]["alamat"],
					$data[$i]["active_date"],
					$data2[12],
					$data2[1],
					$data2[2],
					$data2[3],
					$data2[4],
					$data2[5],
					$data2[6],
					$data2[7],
					$data2[8],
					$data2[9],
					$data2[10],
					$data2[11]
				),
				array(
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR"
				),
				$this->height
			);
			
			// print data tanggal bayar
			$data2 = array();
			for($j = 1; $j <= 12; $j++){
				$sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
				$paydate = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_paydate";
				
				if(is_null($data[$i][$sts])){
					$data2[$j] = $data[$i][$paydate];
				}
				else{
					$data2[$j] = $data[$i][$sts];
				}
			}
			
			$pdf->RowMultiBorderWithHeight(
				array(
					"",
					"",
					$data[$i]["npwpd"],
					"",
					$data2[12],
					$data2[1],
					$data2[2],
					$data2[3],
					$data2[4],
					$data2[5],
					$data2[6],
					$data2[7],
					$data2[8],
					$data2[9],
					$data2[10],
					$data2[11]
				),
				array(
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR"
				),
				$this->height
			);
			
			$no++;
		}
		$pdf->Ln();
		$this->newLine();
		$this->newLine();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$nama_pajak = strtoupper(substr($data[0]["jenis_pajak"], 5));
		//$pdf->Cell($lbody1 + 10, $this->height, "KOORDINATOR " . $nama_pajak, "", 0, 'C');
		$pdf->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		//$pdf->Cell($lbody1 + 10, $this->height, "NIP. ", "", 0, 'L');
		$pdf->Ln();
		
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"KETERANGAN :",
        				""
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        
        $pdf->SetFont('Arial', 'I', 8);			
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"UNREGISTER",
        				": Belum terdaftar pada saat posisi bulan yang tercantum"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"INSIDENTIL",
        				": WP yang transaksinya insidentil (non reguler)"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"NIHIL1	   ",
        				": WP melaporkan NIHIL dan sudah register(flag bayar) pada saat posisi tgl report"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"NIHIL2",
        				": WP melaporkan NIHIL tapi belum register(flag bayar) pada saat posisi tgl report"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"SKPDKB",
        				": WP belum bayar sampai dengan posisi report dan ditetapkan secara jabatan"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"NOREPORT",
        				": WP sudah aktif tetapi belum pernah melakukan transaksi sampai dengan posisi tgl report"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
        $pdf->SetWidths(array($ltable2,25, 160));
        $pdf->SetAligns(array("L","L", "L"));
        $pdf->RowMultiBorderWithHeight(
        			array
        			(	
        			    "",
        				"SPTPD",
        				": WP melaporkan berdasarkan omset yang mereka laporkan"
        			),
        			array
        			(
        			    "",
        				"",
        				""
        			),
        			5);
		$pdf->Output();
    }
	


	

	

}



