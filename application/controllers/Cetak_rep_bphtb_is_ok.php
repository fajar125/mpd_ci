<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_rep_bphtb_is_ok extends CI_Controller{

	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 210;
    var $paperHSize = 297;
    var $height = 5;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function __construct() {
        parent::__construct();
        //$this->formCetak();
        $pdf = new FPDF();
		
		$size = $pdf->_getpagesize("Legal");
		$pdf->DefPageSize = $size;
		$pdf->CurPageSize = $size;
		
        $this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
    }

    function newLine($pdf){
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	function barisBaru($section, $field, $data, $pdf){
		$pdf->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$pdf->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$pdf->Cell($lbody4, $this->height, "$field", "", 0, "L");
		
		$pdf->SetWidths(array($lbody15));
		$pdf->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height, $pdf);
	}
	
	function RowMultiBorderWithHeight($data, $border = array(),$height, $pdf)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$pdf->NbLines($this->widths[$i],$data[$i], $pdf));
		$h=$height*$nb;
		//Issue a page break first if needed
		$pdf->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$pdf->widths[$i];
			$a=isset($pdf->aligns[$i]) ? $pdf->aligns[$i] : 'L';
			//Save the current position
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			$pdf->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
			$pdf->SetXY($x,$y);
			//Print the text
			$pdf->MultiCell($w,$height,$data[$i],0,$a);
			//Put the position to the right of the cell
			$pdf->SetXY($x+$w,$y);
		}
		//Go to the next line
		$pdf->Ln($h);
	}
	
	function barisBaru2($subtractor, $field, $middle, $currency, $data, $pdf){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$pdf->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$pdf->Ln();
	}

	function barisBaruStr($subtractor, $field, $middle, $currency, $data, $pdf){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, " ", "", 0, "L");
		$pdf->Cell($lbodyx2, $this->height, $data, "", 0, "R");
		$pdf->Ln();
	}
	
	
		
	function pageCetak() {
		
		$t_bphtb_registration_id = getVarClean('t_bphtb_registration_id','int',0);
		
		$data = array();
        $sql = "select a.*,
				b.region_name as wp_region,
				c.region_name as wp_region_kec,
				d.region_name as wp_region_kel,
				e.region_name as object_region,
				f.region_name as object_region_kec,
				g.region_name as object_region_kel,
				h.description as doc_name

				from t_bphtb_registration as a 
				left join p_region as b
					on a.wp_p_region_id = b.p_region_id
				left join p_region as c
					on a.wp_p_region_id_kec = c.p_region_id
				left join p_region as d
					on a.wp_p_region_id_kel = d.p_region_id
				left join p_region as e
					on a.object_p_region_id = e.p_region_id
				left join p_region as f
					on a.object_p_region_id_kec = f.p_region_id
				left join p_region as g
					on a.object_p_region_id_kel = g.p_region_id
				left join p_bphtb_legal_doc_type as h
					on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
				where a.t_bphtb_registration_id = ?";
        $output = $this->db->query($sql, array($t_bphtb_registration_id));
        $data = $output->row_array();
		
		
		$pdf = new FPDF();
		
		$size = $pdf->_getpagesize("Legal");
		//$pdf->DefPageSize = $size;
		//$pdf->CurPageSize = $size;
		
        $this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
		
		$pdf->AliasNbPages();
		$pdf->AddPage("P");
		$pdf->SetFont('Arial', '', 7);
				
		
		$encImageData = '';
		$sql = "select f_encrypt_str('".$data['registration_no']."') AS enc_data";
		$output_image = $this->db->query($sql);
		$data_image = $output_image->row_array();
		$encImageData = $data_image['enc_data'];
		
		$pdf->Image(getValByCode('LOGO'),20,10,25,25);
		$pdf->Image(base_url().'qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		
		$query1 = "select f_encrypt_str('ZAENAL MANSUR - 19630817.1989.01.1.006 - ".$data['registration_no']."') AS enc_data";
        $output_image = $this->db->query($sql);
		$data_image = $output_image->row_array();
		$encImageDataKiri = $data_image['enc_data'];
		
		$query2 = "select f_encrypt_str('".$data['verificated_by']." - ".$data['verificated_nip']." - ".$data['registration_no']."') AS enc_data";
        $output_image = $this->db->query($sql);
		$data_image = $output_image->row_array();
		$encImageDataKanan = $data_image['enc_data'];
		
		
		//bawah kiri
		$pdf->Image(base_url().'qrcode/generate-qr.php?param='.$encImageDataKiri,30,250,15,15,'PNG');
		//bawah kanan
		$pdf->Image(base_url().'qrcode/generate-qr.php?param='.$encImageDataKanan,160,250,15,15,'PNG');
		
		$pdf->SetFont("Arial", "B", 12);
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "NOTA VERIFIKASI", "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN", "", 0, "C");
		$pdf->Ln();
		$this->newLine($pdf);
		$pdf->Cell($this->lengthCell, $this->height, "JENIS TRANSAKSI: ".strtoupper($data['doc_name']), "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "NO REGISTRASI: ".strtoupper($data['registration_no']), "", 0, "C");
		
		$this->newLine($pdf);
		$this->newLine($pdf);
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;

		$this->barisBaru("A", "1 Nama Wajib Pajak", ": " . $data["wp_name"], $pdf);
		$this->barisBaru("", "2 NPWP", ": " . $data["npwp"], $pdf);
		$this->barisBaru("", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"], $pdf);
		$this->barisBaru("", "4 RT/RW", ": " . $data["wp_rt"] . "/" .  $data["wp_rw"], $pdf);
		$this->barisBaru("", "5 Kelurahan/Desa", ": " . $data["wp_region_kel"], $pdf);
		$this->barisBaru("", "6 Kecamatan", ": " . $data["wp_region_kec"], $pdf);
		$this->barisBaru("", "7 Kabupaten/Kota", ": " . $data["wp_region"], $pdf);
		$pdf->Ln();
		
		$this->barisBaru("B", "1 Nomor Objek Pajak PBB ", ": " . $data["njop_pbb"], $pdf);
		$this->barisBaru("", "2 Letak tanah atau bangunan", ": " . $data["object_address_name"], $pdf);
		$this->barisBaru("", "3 RT/RW", ": " . $data["object_rt"] . "/" . $data["object_rw"], $pdf);
		$this->barisBaru("", "4 Kelurahan/Desa", ": " . $data["object_region_kel"], $pdf);
		$this->barisBaru("", "5 Kecamatan", ": " . $data["object_region_kec"], $pdf);
		$this->barisBaru("", "6 Kabupaten/Kota", ": " . $data["object_region"], $pdf);
		$this->barisBaru("", "7 Dokumen Pendukung", ": " . $data["doc_name"], $pdf);
		$pdf->Ln();
		
		$this->barisBaru("C", "Penghitungan NJOP PBB", "", $pdf);
		$lbodyx = ($this->lengthCell - $lbody1) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->SetWidths(array($lbodyx1, $lbodyx2, $lbodyx3, $lbodyx3));
		$pdf->SetAligns(array("C", "C", "C", "C"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"\nUraian",
				"Luas\n(Diisi luas tanah dan atau bangunan yang haknya diperoleh)",
				"NJOP PBB / m2\n(Diisi berdasarkan SPPT PBB tahun terjadinya perolehan hak / Tahun",
				"\nLuas x NJOP PBB / m2"
			),
			array
			(
				"TBL",
				"TBR",
				"TBLR",
				"TBLR"
			),
			$this->height);
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Tanah (bumi)", "L", 0, "");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_area"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "m2", "R", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_price_per_m"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_total_price"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Ln();
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Bangunan", "L", 0, "");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["building_area"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "m2", "R", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["building_price_per_m"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["building_total_price"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Ln();
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "", "L", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "", "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "", "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "NJOP PBB", "R", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_total_price"] + $data["building_total_price"], 0, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Ln();
		$jenis_harga_bphtb = $data["jenis_harga_bphtb"];
		if(empty($jenis_harga_bphtb)) $jenis_harga_bphtb = 99;
		$jenis_harga = array(1 => 'Harga Transaksi',2 =>  'Harga Pasar',3 => 'Harga Lelang', 99 => 'Harga Pasar');

		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "", "BL", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "", "B", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "BR", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "", "B", 0, "L");
		$pdf->Cell($lbodyx1-20, $this->height, "", "B", 0, "R");
		$pdf->Cell($lbodyx1+20, $this->height, $jenis_harga[$jenis_harga_bphtb], "RB", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "B", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["market_price"], 0, ",", "."), "B", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "BR", 0, "");
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($this->lengthCell - $lbody1, $this->height, "Jenis perolehan hak atas tanah dan atau bangunan", "", 0, "");
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($this->lengthCell - $lbody1, $this->height, "PENGHITUNGAN BPHTB", "", 0, "");
		$pdf->Ln();
		
		$this->barisBaru2($lbody1, "Nilai Perolehan Objek Pajak (NPOP)", "", "Rp", $data["npop"], $pdf);
		$this->barisBaru2($lbody1, "Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)", "", "Rp", $data["npop_tkp"], $pdf);
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1, "Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp","NIHIL", $pdf);
		}else{
			$this->barisBaru2($lbody1, "Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp", $data["npop_kp"], $pdf);
		}
		
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", "NIHIL", $pdf);
		}else{
			$this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", $data["bphtb_amt"], $pdf);
		}
		
		$this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan potongan", "", "Rp", $data["bphtb_discount"], $pdf);
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", "NIHIL", $pdf);
		}else{
			$this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"], $pdf);
		}
		
		
		$this->newLine($pdf);
				
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
			
		$pdf->SetFont("Arial", "i", 8);
		
		if($data['check_potongan'] == 'Y') {
		    $pdf->Cell($lbody1 + 10 , $this->height, "            Keterangan: Nota ini bukan bukti pembayaran", "", 0, 'L');
		}else {
		    $pdf->Cell($lbody1 + 10 , $this->height, "            Keterangan: Nota ini bukan bukti pembayaran. Nota akan menjadi expired jika dalam 10 hari tidak dibayarkan.", "", 0, 'L');
	    }
	    
		$pdf->Ln();
		//$this->Cell($lbody1 + 10, $this->height, "            Catatan: ".$data["description"], "", 0, 'L');
		$pdf->SetWidths(array(9, 150, $lbodyx2));
		$pdf->SetAligns(array("L", "L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	
				"",
				"Catatan : ".$data["description"]
			),
			array
			(
				"",
				""
			),
			$this->height-2);		

		$pdf->SetFont("Arial", "B", 10);
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody1 - 103, $this->height, getValByCode('ALAMAT_3').", ".date("d-m-Y"), "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody1 + 10, $this->height, "KOORDINATOR PEMERIKSA", "", 0, 'C');
		$pdf->Cell($lbody3 - $lbody1 - 20, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "PETUGAS PEMERIKSA", "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody1 + 10, $this->height, "BPHTB", "", 0, 'C');
		$pdf->Cell($lbody3 - $lbody1 - 20, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "BPHTB", "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		
		$pdf->Ln();
		$this->newLine($pdf);
		$this->newLine($pdf);				
		//$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		//$this->Cell($lbody1 + 10, $this->height, "(....................................)", "", 0, 'C');
		$pdf->Cell($lbody1 + 10, $this->height - 4, "(ZAENAL MANSUR)", "", 0, 'C');
		$pdf->Cell(202, $this->height - 4, "( ".$data['verificated_by']." )", "", 0, 'C');
		$this->newLine($pdf);
		$pdf->Cell($lbody1 + 10, $this->height - 4, "NIP : 19630817.1989.01.1.006 ", "", 0, 'C');
		$pdf->Cell(202, $this->height - 4, "NIP : ".$data['verificated_nip']." ", "", 0, 'C');
		
		
		$pdf->Output("","I");	
	}

	function tulis($text, $align, $pdf){
		$pdf->Cell(5, $this->height, "", "L", 0, 'C');
		$pdf->Cell($this->lengthCell - 10, $this->height, $text, "", 0, $align);
		$pdf->Cell(5, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
	}
	
	function kotakKosong($pembilang, $penyebut, $jumlahKotak, $pdf){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$pdf->Cell($lkotak, $this->height, "", "LR", 0, 'L');
		}
	}
	
	function kotak($pembilang, $penyebut, $jumlahKotak, $isi, $pdf){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$pdf->Cell($lkotak, $this->height, $isi, "TBLR", 0, 'C');
		}
	}

	function getNumberFormat($number, $dec) {
			if (!empty($number)) {
				return number_format($number, $dec);
			} else {
				return "";
			}
	}	

}



