<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_rep_pengurangan_bphtb_berita_acara extends CI_Controller{
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;

	function __construct() {
	    parent::__construct();
		$pdf = new FPDF();		
		$pdf->AddPage("P");

		$size = array(216 ,356);
	    $this->DefPageSize = $size;
		$this->CurPageSize = $size;
		$this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
	}
	

	function pageCetak(){
		$t_bphtb_registration_id = getVarClean('t_bphtb_registration_id','int',0);

		if($t_bphtb_registration_id != 0){
			$data = $this->getDataBeritaACara($t_bphtb_registration_id);

			$pdf = new FPDF();		

			$pdf->AliasNbPages();
			$pdf->AddPage("P");
			$pdf->Image(getValByCode('LOGO'),10,10,20,20);
			$pdf->SetFont("Arial", "B", 10);
			$pdf->Cell($this->lengthCell, $this->height, "", "", 0, "C");
			$pdf->Ln();
			$pdf->Cell($this->lengthCell, $this->height, getValByCode('INSTANSI_1'), "", 0, "C");
			$pdf->Ln();
			$pdf->SetFont("Arial", "B", 14);
			$pdf->Cell($this->lengthCell, $this->height, getValByCode('INSTANSI_2'), "", 0, "C");
			$pdf->Ln();
			$pdf->SetFont("Arial", "B", 8);
			$pdf->Cell($this->lengthCell, $this->height, getValByCode('ALAMAT_6')." Telp : ".getValByCode('ALAMAT_4')." ".getValByCode('ALAMAT_3'), "B", 0, "C");
			$pdf->Ln();
			$pdf->Ln(2);

			$lbody = $this->lengthCell / 20;
			$lbody1 = $lbody * 1;
			$lbody4 = $lbody * 4;
			$lbody10 = $lbody * 15;

			$pdf->SetFont("Arial", "B", 8);
			$pdf->SetWidths(array($this->lengthCell));
			$pdf->SetAligns(array("C"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"BERITA ACARA"
				),
				array
				(
					""
				),
				$this->height-1);
			$pdf->RowMultiBorderWithHeight(
				array
				(	"NOMOR : ".$data['nomor_berita_acara']
				),
				array
				(
					""
				),
				$this->height-1);
			$pdf->Ln();

			$pdf->SetFont("Arial", "", 8);
			$pdf->SetWidths(array($this->lengthCell));
			$pdf->SetAligns(array("J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"Pada hari ini ".$this->penyebutHari($data['tanggal_berita_acara'])." Tanggal ".$this->penyebutTanggal($data['tanggal_berita_acara']).
					". Berdasarkan hasil pengkajian baik dari sisi administratif maupun normatif, yang telah kami lakukan,".
					" kami selaku Tim Pengkaji Keringanan Dan Pengurangan BPHTB telah mengkaji permohonan BPHTB Waris yang diajukan oleh pemohon dengan data teknis sebagai berikut :"
				),
				array
				(
					""
				),
				$this->height-1);
			$pdf->Ln();

			$this->barisBaru($pdf,"", "1 Nama Wajib Pajak", ": " . $data["wp_name"]);
			$this->barisBaru($pdf,"", "2 ".$data['opsi_a2'], ": ".$data['opsi_a2_keterangan']);
			$this->barisBaru($pdf,"", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
			$this->barisBaru($pdf,"", "4 RT/RW", ": RT. " . $data["wp_rt"] . "/RW. " .  $data["wp_rw"]);
			$this->barisBaru($pdf,"", "5 Kelurahan", ": " . $data["wp_kelurahan"]);
			$this->barisBaru($pdf,"", "6 Kecamatan", ": " . $data["wp_kecamatan"]);
			$this->barisBaru($pdf,"", "7 Kabupaten/Kota", ": " . $data["wp_kota"]);
			$pdf->Ln();
			$pdf->SetFont("Arial", "B", 8);
			$pdf->Cell($lbody1, $this->height, "", "", 0, "");
			$pdf->Cell($this->lengthCell - $lbody1, $this->height, "Objek Pajak", "", 0, "");
			$pdf->Ln();
			$this->barisBaru($pdf,"", "1 NOP PBB ", ": " . $data["njop_pbb"]);
			$this->barisBaru($pdf,"", "2 Alamat", ": " . $data["object_address_name"]);
			$this->barisBaru($pdf,"", "3 Luas Tanah", ": " . number_format($data["land_area"], 0, ",", ".")." m2");
			$this->barisBaru($pdf,"", "4 Luas Bangunan", ": " . number_format($data["building_area"], 0, ",", ".")." m2");
			$this->barisBaru($pdf,"", "5 RT/RW", ": RT. " . trim($data["object_rt"]) . "/RW. " . $data["object_rw"]);
			$this->barisBaru($pdf,"", "6 Kelurahan", ": " . $data["object_kelurahan"]);
			$this->barisBaru($pdf,"", "7 Kecamatan", ": " . $data["object_kecamatan"]);
			$this->barisBaru($pdf,"", "8 Kabupaten/Kota", ": " . $data["object_region"]);
			$this->barisBaru_special($pdf,"", "Akta/ Risalah Lelang/ Keputusan Pemberian Hak/ Putusan Hakim/ Dokumen", ": SK Kepala Kantor Pertanahan Kota Bandung");
			$this->barisBaru($pdf,"", "- Nomor", ": " . $data['opsi_b7_keterangan']);
			$this->barisBaru($pdf,"", "- Tanggal", ": " . $this->beautyDate($data['tanggal_sk']));
			$this->barisBaru($pdf,"", "NJOP", ": Rp." . number_format($data['npop'], 0, ",", "."));
			$this->barisBaru_special($pdf,"", "NJOP (Harta Bersama dimana setengah bagian Alm. suami diberikan kepada istri yang", ": Rp." . number_format($data['npop'], 0, ",", "."));
			$pdf->Cell($lbody1, $this->height, "", "", 0, "");
			$pdf->Cell($lbody1, $this->height, "1", "", 0, "");
			$pdf->SetWidths(array($this->lengthCell-$lbody1-$lbody1));
			$pdf->SetAligns(array("J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"Bahwa pemohon merupakan ahli waris dari : ".$data['opsi_a2_keterangan']."\n".
					"Berdasarkan ".$data['keterangan_opsi_c']."\n".
					"No ".$data['opsi_b7_keterangan']." Tanggal ".$this->beautyDate($data['tanggal_sk'])
				),
				array
				(
					""
				),
				$this->height-1);
			$pdf->Cell($lbody1, $this->height, "", "", 0, "");
			$pdf->Cell($lbody1, $this->height, "2", "", 0, "");
			$pdf->SetWidths(array($this->lengthCell-$lbody1-$lbody1));
			$pdf->SetAligns(array("J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	$data['dasar_pengurang']
				),
				array
				(
					""
				),
				$this->height-1);

			$pdf->AddPage("P");
			$pdf->Cell($lbody1, $this->height, "", "", 0, "");
			$pdf->Cell($lbody1, $this->height, "3", "", 0, "");
			$pdf->SetWidths(array($this->lengthCell-$lbody1-$lbody1));
			$pdf->SetAligns(array("J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"Hasil Perhitungan sebagai berikut :"
				),
				array
				(
					""
				),
				$this->height);
			$this->barisBaru2($pdf,$lbody1+$lbody1, "- Nilai Perolehan Objek Pajak (NPOP)", "", "Rp", $data["npop"]);
			$this->barisBaru2($pdf,$lbody1+$lbody1, "- Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)", "", "Rp", $data["npop_tkp"]);
			if($data["npop_kp"]==0){
				$this->barisBaruStr($pdf,$lbody1+$lbody1, "- Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp","NIHIL");
			}else{
				$this->barisBaru2($pdf,$lbody1+$lbody1, "- Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp", $data["npop_kp"]);
			}

			if($data["npop_kp"]==0){
				$this->barisBaruStr($pdf,$lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", "NIHIL");
			}else{
				$this->barisBaru2($pdf,$lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", $data["bphtb_amt"]);
			}

			$pdf->Cell($lbody1+$lbody1, $this->height, "", "", 0, "");
			$pdf->Cell($this->lengthCell - $lbody1 - $lbody1, $this->height, "- Pengenaan Pengurangan Karena "."Waris", "", 0, "");
			$pdf->Ln();
			$this->barisBaru2($pdf,$lbody1+$lbody1, "- Besaran Pengenaan Pengurangan ", $data['persen_pengurangan']."%", "Rp", $data["bphtb_discount"]);

			if($data["npop_kp"]==0){
				$this->barisBaruStr($pdf,$lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", "NIHIL");
			}else{
				$this->barisBaru3($pdf,$lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"]);
			}

			$pdf->Cell($lbody1+$lbody1, $this->height, "", "", 0, "");
			$pdf->Cell($lbody1+ $lbody1+$lbody1, $this->height, "Terbilang :", "", 0, "");
			$pdf->SetFont("Arial", "iB", 8);
			$pdf->Cell($this->lengthCell - $lbody1- $lbody1- $lbody1 -$lbody1, $this->height, $data['terbilang'], "", 0, "");
			$pdf->Ln();

			$this->signaturePage($pdf,$data);

			$pdf->output();



		}

	}

	function signaturePage($pdf,$data) {
		$pdf->AliasNbPages();
		//$this->AddPage("P");
		

		//$this->Image('../images/logo_pemda.png',10,10,20,20);
		//$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		$lbody = $this->lengthCell / 10;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody6 = $lbody * 6;
		
		$pdf->SetFont("Arial", "", 8);
		$pdf->SetWidths(array($this->lengthCell));
		$pdf->SetAligns(array("J"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	"Demikian Berita Acara ini dibuat dengan sebenarnya. Apabila dikemudian hari ternyata terdapat kekeliruan dalam Berita Acara Pengkajian akan dibetulkan sebagaimana mestinya."
			),
			array
			(
				""
			),
			$this->height-1);
		$pdf->Ln();
		/*$this->Cell($lbody1, $this->height, "1", "BLTR", 0, "R");
		$this->Cell($lbody4, $this->height, "KASI PENYELESAIAN PIUTANG", "BLTR", 0, "l");
		$this->Cell($this->lengthCell-$lbody1-$lbody4, $this->height, "", "BLTR", 0, "l");*/
		$pdf->SetWidths(array($lbody1,$lbody4,$this->lengthCell-$lbody1-$lbody4));
		$pdf->SetAligns(array("R","L","L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	1,
				"KASI PENYELESAIAN PIUTANG \nDIN KAMADIANTINI S.IP, MM \nPembina \nNIP. 19710320 199803 2 006",
				"1)\n\n\n_________________________________________"
			),
			array
			(
				"","",""
			),
			$this->height);
		$pdf->Ln();

		$pdf->SetWidths(array($lbody1,$lbody4,$this->lengthCell-$lbody1-$lbody4));
		$pdf->SetAligns(array("R","L","L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	2,
				"PETUGAS PEMERIKSA \n".$data['nama_pemeriksa']." \n".$data['jabatan_pemeriksa']." \nNIP. ".$data['nip_pemeriksa']."",
				"2)\n\n\n_________________________________________"
			),
			array
			(
				"","",""
			),
			$this->height);

		$pdf->Ln();
		$pdf->SetWidths(array($lbody1,$lbody4,$this->lengthCell-$lbody1-$lbody4));
		$pdf->SetAligns(array("R","L","L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	3,
				"PETUGAS ADMINISTRASI\n".$data['nama_operator']." \n".$data['jabatan_operator']." \nNIP. ".$data['nip_operator']."",
				"3)\n\n\n_________________________________________"
			),
			array
			(
				"","",""
			),
			$this->height);
	}

	function beautyDate($tgl) {
	    
	    $arrtgl = explode("-", $tgl);
	    $dd = $arrtgl[0];
	    $mm = $arrtgl[1];
	    $yyyy = $arrtgl[2];
	    
	    $arrmonth = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	    return $dd." ".$arrmonth[$mm-1]." ".$yyyy;
	}
	
	function penyebutTanggal($tgl) {
	    $arrtgl = explode("-", $tgl);
	    $dd = (int)$arrtgl[0];
	    $mm = $arrtgl[1];
	    $yyyy = $arrtgl[2];
	    
	    $arrmonth = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	    return $this->numbertell($dd)." Bulan ".$arrmonth[$mm-1].$this->numbertell($yyyy);
	}
	
	function penyebutHari($tgl) {
	    $arrtgl = explode("-", $tgl);
	    $dd = $arrtgl[0];
	    $mm = $arrtgl[1];
	    $yyyy = $arrtgl[2];
	    
        $date = $yyyy."-".$mm."-".$dd;
        $hari = date('N', strtotime($date));
        
        $arrHari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        return $arrHari[$hari-1];
	}
	
	function numbertell($x){
        $abil = array(
        "",
        "Satu", "Dua", "Tiga",
        "Empat", "Lima", "Enam",
        "Tujuh", "Delapan", "Sembilan",
        "Sepuluh", "Sebelas"
        );
        if ($x < 12)
        return " ".$abil[$x];
        elseif ($x<20)
        return $this->numbertell($x-10)." Belas";
        elseif ($x<100)
        return $this->numbertell($x/10)." Puluh".$this->numbertell($x%10);
        elseif ($x<200)
        return " Seratus".$this->numbertell($x-100);
        elseif ($x<1000)
        return $this->numbertell($x/100)." Ratus".$this->numbertell($x % 100);
        elseif ($x<2000)
        return " Seribu".$this->numbertell($x-1000);
        elseif ($x<1000000)
        return $this->numbertell($x/1000)." Ribu".$this->numbertell($x%1000);
        elseif ($x<1000000000)
        return $this->numbertell($x/1000000)." Juta".$this->numbertell($x%1000000);
        elseif ($x<1000000000000)
        return $this->numbertell($x/1000000000)." Milyar".$this->numbertell($x%1000000000);
        elseif ($x<1000000000000000)
        return $this->numbertell($x/1000000000000)." Trilyun".$this->numbertell($x%1000000000000);
    }

	function barisBaru3($pdf,$subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$pdf->SetFont("Arial", "B", 8);
		$pdf->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$pdf->SetFont("Arial", "", 8);
		$pdf->Ln();
	}

	function barisBaru2($pdf,$subtractor, $field, $middle, $currency, $data){
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

	function barisBaruStr($pdf,$subtractor, $field, $middle, $currency, $data){
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
	
	function barisBaru($pdf,$section, $field, $data){
		$pdf->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$pdf->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$pdf->Cell($lbody4+10, $this->height, "$field", "", 0, "L");
		
		$pdf->SetWidths(array($lbody15-10));
		$pdf->SetAligns(array("L"));
		$pdf->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}

	function barisBaru_special($pdf,$section, $field, $data){
		$pdf->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$pdf->Cell($lbody1, $this->height, "$section", "", 0, "L");
		//$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		$pdf->SetWidths(array($lbody4+10,$lbody15-10));
		$pdf->SetAligns(array("J","L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	"$field",$data
			),
			array
			(
				"",""
			),
			$this->height);
		
		/*$this->SetWidths(array($lbody15));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);*/
	}

	function getDataBeritaACara($t_bphtb_registration_id){
		$whereClause='';
		$data = array();

		$sql = "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
			j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,
			to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,
			j.nomor_berita_acara, j.nomor_notaris,
			k.pemeriksa_nama as nama_pemeriksa, k.pemeriksa_nip as nip_pemeriksa, k.pemeriksa_jabatan as jabatan_pemeriksa,
			l.pemeriksa_nama as nama_operator, l.pemeriksa_nip as nip_operator, l.pemeriksa_jabatan as jabatan_operator,
			a.*,
			cust_order.p_rqst_type_id,
			b.region_name as wp_kota,
			c.region_name as wp_kecamatan,
			d.region_name as wp_kelurahan,
			e.region_name as object_region,
			f.region_name as object_kecamatan,
			g.region_name as object_kelurahan,
			h.description as doc_name

			from t_bphtb_exemption as j
			left join t_bphtb_registration as a  on j.t_bphtb_registration_id = a.t_bphtb_registration_id
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
			left join t_customer_order as cust_order
				on cust_order.t_customer_order_id = a.t_customer_order_id
			left join t_bphtb_exemption_pemeriksa as k
			   on j.pemeriksa_id = k.t_bphtb_exemption_pemeriksa_id
			left join t_bphtb_exemption_pemeriksa as l
				on j.administrator_id = l.t_bphtb_exemption_pemeriksa_id
			where j.t_bphtb_registration_id = ".$t_bphtb_registration_id;

		$output = $this->db->query($sql);
		$data = $output->row_array();

		$data["persen_pengurangan"] = ceil($data["bphtb_discount"]/$data["bphtb_amt"] * 100);

		$data['terbilang'] = '';

		$sql2 = "SELECT * FROM f_terbilang('".ceil($data['bphtb_amt_final'])."','') as terbilang";        
        $output = $this->db->query($sql2);
        $items = $output->row_array();

        $data['terbilang'] = ucwords($items['terbilang'])." Rupiah";

		return $data;
	}
}