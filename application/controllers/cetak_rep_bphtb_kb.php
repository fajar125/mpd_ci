<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_rep_bphtb_kb extends CI_Controller{

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
        $this->startY = $pdf->GetY();
        $this->startX = $this->paperWSize-42;
        $this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF();
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function pageCetak() {
		
		$t_bphtb_registration_id = getVarClean('t_bphtb_registration_id','int',0);
		$pejabat = getVarClean('pejabat','int',1);
		$tgl = getVarClean('tgl','int',1);

		$sql="begin;";
		if ($t_bphtb_registration_id != 0) {
			$sql .= "select a.*,
					b.region_name as wp_region,
					c.region_name as wp_region_kec,
					d.region_name as wp_region_kel,
					e.region_name as object_region,
					f.region_name as object_region_kec,
					g.region_name as object_region_kel,
					h.description as doc_name,
					(a.bphtb_amt - a.bphtb_discount) AS bphtb_amt_final_old,
					j.payment_vat_amount AS prev_payment_amount


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
					left join t_bphtb_registration as i
						on a.registration_no_ref = i.registration_no
					left join t_payment_receipt_bphtb as j
						on i.t_bphtb_registration_id = j.t_bphtb_registration_id
					where a.t_bphtb_registration_id = ".$t_bphtb_registration_id;
			
		} 
		//echo ($sql);exit;
		$query = $this->db->query($sql);
		$data = $query->row_array();

		$encImageData = '';
				
		if($data["npop_kp"]==0){
			$nilai="NIHIL";
		}else{
			$nilai=$data["bphtb_amt_final"];
		}
		
		$sql2 = "select f_encrypt_str('".$data['registration_no']."-".$nilai."') AS enc_data";

		$query2 = $this->db->query($sql2);
		$data2 = $query2->row_array();

		$encImageData = $data2['enc_data'];

		$pdf = new FPDF();

		$pdf->AliasNbPages();
		$pdf->AddPage("P");		
		$startY = $pdf->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;		
		$pdf->SetFont('Arial', '', 10);
		
		$lengthJudul1 = ($lengthCell * 3) / 9;
		$lengthJudul2 = ($lengthCell * 3) / 9;
		$lengthJudul3 = ($lengthCell * 3) / 9;
		$batas1 = ($lengthJudul3 * 2) / 5;
		$batas2 = ($lengthJudul3 * 3) / 5;
		
		$pdf->Image('images/logo_lombok.png',20,10,25,25);
		//$pdf->Image('images/logo_pemda.png',165,10,25,25);
		$pdf->Image(base_url().'/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');

		
		$length1 = ($lengthCell * 2) / 9;
		$length2 = ($lengthCell * 5) / 9;
		$length3 = ($lengthCell * 2) / 9;
		
		
		$pdf->SetFont("Arial", "B", 12);
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "NOTA VERIFIKASI KURANG BAYAR", "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN", "", 0, "C");
		$pdf->Ln();
		$pdf->Ln();
		$this->newLine();
		$pdf->SetFont("Arial", "B", 12);
		$pdf->Cell($this->lengthCell, $this->height, "JENIS TRANSAKSI: ".strtoupper($data['doc_name']), "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "NO REGISTRASI: ".strtoupper($data['registration_no']), "", 0, "C");
		
		$this->newLine();
		$this->newLine();
		$pdf->Ln();
		$pdf->Ln();
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;

		$this->barisBaru("A", "1 Nama Wajib Pajak", ": " . $data["wp_name"],$pdf);
		$this->barisBaru("", "2 NPWP", ": " . $data["npwp"],$pdf);
		$this->barisBaru("", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"],$pdf);
		$this->barisBaru("", "4 RT/RW", ": " . $data["wp_rt"] . "/" .  $data["wp_rw"],$pdf);
		$this->barisBaru("", "5 Kelurahan/Desa", ": " . $data["wp_region_kel"],$pdf);
		$this->barisBaru("", "6 Kecamatan", ": " . $data["wp_region_kec"],$pdf);
		$this->barisBaru("", "7 Kabupaten/Kota", ": " . $data["wp_region"],$pdf);
		$pdf->Ln();
		
		$this->barisBaru12("B", "1 Nomor Objek Pajak PBB ", ": " . $data["njop_pbb"],$pdf);
		$this->barisBaru("", "2 Letak tanah atau bangunan", ": " . $data["object_address_name"],$pdf);
		$this->barisBaru("", "3 RT/RW", ": " . $data["object_rt"] . "/" . $data["object_rw"],$pdf);
		$this->barisBaru("", "4 Kelurahan/Desa", ": " . $data["object_region_kel"],$pdf);
		$this->barisBaru("", "5 Kecamatan", ": " . $data["object_region_kec"],$pdf);
		$this->barisBaru("", "6 Kabupaten/Kota", ": " . $data["object_region"],$pdf);
		$this->barisBaru("", "7 Dokumen Pendukung", ": " . $data["doc_name"],$pdf);
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
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_area"], 2, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "m2", "R", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_price_per_m"], 2, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_total_price"], 2, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Ln();
		
		$pdf->Cell($lbody1, $this->height, "", "", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Bangunan", "L", 0, "");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["building_area"], 2, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "m2", "R", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["building_price_per_m"], 2, ",", "."), "", 0, "R");
		$pdf->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$pdf->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, number_format($data["building_total_price"], 2, ",", "."), "", 0, "R");
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
		$pdf->Cell($lbodyx1, $this->height, number_format($data["land_total_price"] + $data["building_total_price"], 2, ",", "."), "", 0, "R");
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
		$pdf->SetFont("Arial", "", 10);
		$pdf->Cell($lbodyx1, $this->height, number_format($data["market_price"], 2, ",", "."), "B", 0, "R");
		$pdf->SetFont("Arial", "", 8);
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
			$this->barisBaruStr($lbody1, "Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp","NIHIL");
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
			$this->barisBaru2_10($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"], $pdf);
		}

		$this->barisBaru2($lbody1, "Nilai Pajak Yang Sudah Dibayar", "", "Rp", $data["prev_payment_amount"], $pdf);
		$this->barisBaru2($lbody1, "Total Kekurangan Pembayaran", "", "Rp", $data["bphtb_amt_final"], $pdf);
		
		
		$pdf->Ln();
				
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
		
		$tgl = getVarClean('tgl','str','');
		if ($tgl == ''){
			$pdf->Cell($lbody1 - 103, $this->height, "Lombok Utara, ".date("d-m-Y"), "", 0, 'C');
		}else{
			$pdf->Cell($lbody1 - 103, $this->height, "Lombok Utara, ".$tgl, "", 0, 'C');
		}
		
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
		$pdf->Ln();		
		//$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		//$this->Cell($lbody1 + 10, $this->height, "(....................................)", "", 0, 'C');
		$pejabat = getVarClean('pejabat','int',0);
		if ($pejabat==2){
			$pdf->Cell($lbody1 + 10, $this->height - 4, "(INDRA WISNU, SE)", "", 0, 'C');
			$pdf->Cell(202, $this->height - 4, "( ".$data['verificated_by']." )", "", 0, 'C');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell($lbody1 + 10, $this->height - 4, "NIP : 19731031 200901 1001 ", "", 0, 'C');
			$pdf->Cell(202, $this->height - 4, "NIP : ".$data['verificated_nip']." ", "", 0, 'C');
		}else{
			//$pdf->Cell($lbody1 + 10, $this->height - 4, "(ZAENAL MANSUR)", "", 0, 'C');
			$pdf->Cell($lbody1 + 10, $this->height - 4, "( )", "", 0, 'C');
			$pdf->Cell(202, $this->height - 4, "( ".$data['verificated_by']." )", "", 0, 'C');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			//$pdf->Cell($lbody1 + 10, $this->height - 4, "NIP : 19630817.1989.01.1.006 ", "", 0, 'C');
			$pdf->Cell($lbody1 + 10, $this->height - 4, "NIP : ", "", 0, 'C');
			$pdf->Cell(202, $this->height - 4, "NIP : ".$data['verificated_nip']." ", "", 0, 'C');
		}

		$pdf->Output();
	}

	function barisBaru2($subtractor, $field, $middle, $currency, $data, $pdf){
		//$pdf = new FPDF();
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$pdf->Cell($lbodyx2, $this->height, number_format($data, 2, ",", "."), "", 0, "R");
		$pdf->Ln();
	}
	
	function barisBaru2_10($subtractor, $field, $middle, $currency, $data, $pdf){
		//$pdf = new FPDF();
		$pdf->SetFont("Arial", "", 8);
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$pdf->SetFont("Arial", "", 10);
		$pdf->Cell($lbodyx2, $this->height, number_format($data, 2, ",", "."), "", 0, "R");
		$pdf->SetFont("Arial", "", 8);
		$pdf->Ln();
	}

	function barisBaruStr($subtractor, $field, $middle, $currency, $data, $pdf){
		//$pdf = new FPDF();
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
	
	function barisBaru($section, $field, $data, $pdf){
		//$pdf = new FPDF();
		$pdf->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$pdf->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$pdf->Cell($lbody4, $this->height, "$field", "", 0, "L");
		
		$pdf->SetWidths(array($lbody15));
		$pdf->SetAligns(array("L"));
		$pdf->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}
	function barisBaru12($section, $field, $data, $pdf){
		//$pdf = new FPDF();
		$pdf->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$pdf->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$pdf->Cell($lbody4, $this->height, "$field", "", 0, "L");
		$pdf->SetFont("Arial", "", 11);
		$pdf->SetWidths(array($lbody15));
		$pdf->SetAligns(array("L"));
		$pdf->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}

	/*function newLine(){
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
	}*/
	

	

}



