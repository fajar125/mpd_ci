<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_rep_pengurangan_bphtb_gono_gini extends CI_Controller{
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	// var $paperWSize = 330;
	// var $paperHSize = 215;
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
		
		
		//$this->DefPageSize = $size;
		//$this->CurPageSize = $size;
		$this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
	}



	function pageCetak_perhitungan() {
		$t_bphtb_registration_id = getVarClean('t_bphtb_registration_id','int',0);

		$sql="begin;";
		if ($t_bphtb_registration_id != 0) {
			$sql .= "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
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
		}

		$query = $this->db->query($sql);
		$data = $query->row_array();

		//print_r($data);exit();
		//echo $data['bphtb_amt_final'];exit();

		$data['terbilang'] = '';

		$sql2 = "SELECT * FROM f_terbilang('".ceil($data['bphtb_amt_final'])."','') as terbilang";        
        $output = $this->db->query($sql2);
        $items = $output->row_array();

        $data['terbilang'] = $items['terbilang'];

        //print_r($data);exit();
		
		$pdf = new FPDF();		

		$pdf->AliasNbPages();
		$pdf->AddPage("P");
		$pdf->SetFont("Arial", "B", 12);
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "LEMBAR PERHITUNGAN", "", 0, "C");
		$pdf->Ln();
		$pdf->SetFont("Arial", "B", 13);
		$pdf->Cell($this->lengthCell, $this->height, "PENGURANGAN ATAU KERINGANAN", "", 0, "C");
		$pdf->Ln();
		$pdf->SetFont("Arial", "B", 14);
		$pdf->Cell($this->lengthCell, $this->height, "BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN", "B", 0, "C");
		$pdf->Ln();
		
		
		$pdf->Ln();
		$pdf->Ln();
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;

		$pdf->SetFont("Arial", "B", 12);
		$this->barisBaru("A", "1 Nama Wajib Pajak", ": " . $data["wp_name"]);
		$this->barisBaru("", "2 ".$data['opsi_a2'], ": ".$data['opsi_a2_keterangan']);
		$this->barisBaru("", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
		$this->barisBaru("", "4 RT/RW", ": RT. " . $data["wp_rt"] . "/RW. " .  $data["wp_rw"]);
		$this->barisBaru("", "5 Kelurahan/Desa", ": " . $data["wp_kelurahan"]);
		$this->barisBaru("", "6 Kecamatan", ": " . $data["wp_kecamatan"]);
		$this->barisBaru("", "7 Kabupaten/Kota", ": " . $data["wp_kota"]);
		$pdf->Ln();



		

		$pdf->output();

		
		
	}

	function getData_gono_gini(){

	}

	function beautyDate($tgl) {
	    
	    $arrtgl = explode("-", $tgl);
	    $dd = $arrtgl[0];
	    $mm = $arrtgl[1];
	    $yyyy = $arrtgl[2];
	    
	    $arrmonth = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	    return $dd." ".$arrmonth[$mm-1]." ".$yyyy;
	}

	function barisBaru3($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;

		$pdf = new FPDF();	
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$pdf->SetFont("Arial", "B", 8);
		$pdf->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$pdf->SetFont("Arial", "", 8);
		$pdf->Ln();
	}

	function barisBaru2($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;

		$pdf = new FPDF();	
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$pdf->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$pdf->Ln();
	}

	function barisBaruStr($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;

		$pdf = new FPDF();	
		
		$pdf->Cell($subtractor, $this->height, "", "", 0, "L");
		$pdf->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$pdf->Cell($lbodyx1, $this->height, " ", "", 0, "L");
		$pdf->Cell($lbodyx2, $this->height, $data, "", 0, "R");
		$pdf->Ln();
	}
	
	function barisBaru($section, $field, $data){
		$pdf = new FPDF();	
		$pdf->AliasNbPages();
		$pdf->AddPage("P");
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
		$pdf->output();
	}
	function barisBaru_long($section, $field, $data){
		$pdf = new FPDF();	
		$pdf->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$pdf->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$pdf->Cell($lbody4+$lbody1, $this->height, "$field", "", 0, "L");
		
		$pdf->SetWidths(array($lbody15-$lbody1));
		$pdf->SetAligns(array("L"));
		$pdf->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}
}