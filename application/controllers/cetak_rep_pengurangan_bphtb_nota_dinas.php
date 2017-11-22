<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_rep_pengurangan_bphtb_nota_dinas extends CI_Controller{
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
		$this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
	}

	function pageCetak(){
		$t_bphtb_registration_id = getVarClean('t_bphtb_registration_id','int',0);
		$pejabat 				 = getVarClean('pejabat','int',0);

		$data = $this->getDataNotaDinas($t_bphtb_registration_id);

		if($t_bphtb_registration_id != 0){
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

			$lbody = $this->lengthCell / 20;
			$lbody1 = $lbody * 1;
			$lbody4 = $lbody * 4;
			$lbody10 = $lbody * 15;

			$pdf->SetFont("Arial", "B", 8);
			$pdf->SetWidths(array($this->lengthCell));
			$pdf->SetAligns(array("C"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"NOTA DINAS"
				),
				array
				(
					""
				),
			$this->height-1);
			$pdf->Ln();
			$pdf->SetFont("Arial", "", 8);
			$pdf->Cell($lbody1+$lbody1, $this->height, "kepada ", "", 0, "");
			$pdf->Cell(2, $this->height, ":", "", 0, "");
			$pdf->SetFont("Arial", "B", 8);
			$pdf->Cell($this->lengthCell-$lbody1-$lbody1-2, $this->height, "Yth. BAPAK KEPALA BADAN PENGELOLAAN PENDAPATAN DAERAH LOMBOK UTARA", "", 0, "");
			$pdf->Ln();
			$pdf->SetFont("Arial", "", 8);
			$pdf->Cell($lbody1+$lbody1, $this->height, "Dari ", "", 0, "");
			$pdf->Cell(2, $this->height, ":", "", 0, "");
			$pdf->Cell($this->lengthCell-$lbody1-$lbody1-2, $this->height, "Kepala Bidang PAD 1", "", 0, "");
			$pdf->Ln();
			$pdf->Cell($lbody1+$lbody1, $this->height, "Tanggal ", "", 0, "");
			$pdf->Cell(2, $this->height, ":", "", 0, "");
			$pdf->Cell($this->lengthCell-$lbody1-$lbody1-2, $this->height, "", "", 0, "");
			$pdf->Ln();
			$pdf->Cell($lbody1+$lbody1, $this->height, "Nomor ", "", 0, "");
			$pdf->Cell(2, $this->height, ":", "", 0, "");
			$pdf->Cell($this->lengthCell-$lbody1-$lbody1-2, $this->height, "", "", 0, "");
			$pdf->Ln();
			$pdf->Cell($lbody1+$lbody1, $this->height, "Lampiran ", "", 0, "");
			$pdf->Cell(2, $this->height, ":", "", 0, "");
			$pdf->Cell($this->lengthCell-$lbody1-$lbody1-2, $this->height, "", "", 0, "");
			$pdf->Ln();
			$pdf->Cell($lbody1+$lbody1, $this->height, "Perihal ", "B", 0, "");
			$pdf->Cell(2, $this->height, ":", "B", 0, "");
			$pdf->SetFont("Arial", "I", 8);
			$pdf->Cell($this->lengthCell-$lbody1-$lbody1-2, $this->height, "Pengurangan BPHTB ".$data['jenis_perolehan_hak']." a.n. ".$data["wp_name"], "B", 0, "");
			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetFont("Arial", "", 8);
			$pdf->SetWidths(array($lbody1,$this->lengthCell-$lbody1));
			$pdf->SetAligns(array("C","J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"",
					"Dipermaklumkan dengan hormat, berkenaan adanya permohonan dari wajib pajak, maka disampaikan data teknis sebagai berikut :"
				),
				array
				(
					"",""
				),
				$this->height);
			
			$pdf->SetFont("Arial", "B", 8);
			$pdf->SetWidths(array($lbody1,$this->lengthCell-$lbody1));
			$pdf->SetAligns(array("C","J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"",
					"Subjek Pajak"
				),
				array
				(
					"",""
				),
				$this->height-1);

			$pdf->SetFont("Arial", "B", 12);
			$this->barisBaru($pdf,"", "1 Nama Wajib Pajak", ": " . $data["wp_name"]);
			$this->barisBaru($pdf,"", "2 ".$data['opsi_a2'], ": ".$data['opsi_a2_keterangan']);
			$this->barisBaru($pdf,"", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
			$this->barisBaru($pdf,"", "4 RT/RW", ": RT. " . $data["wp_rt"] . "/RW. " .  $data["wp_rw"]);
			$this->barisBaru($pdf,"", "5 Kelurahan/Desa", ": " . $data["wp_kelurahan"]);
			$this->barisBaru($pdf,"", "6 Kecamatan", ": " . $data["wp_kecamatan"]);
			$this->barisBaru($pdf,"", "7 Kabupaten/Kota", ": " . $data["wp_kota"]);
			$pdf->Ln();
			
			$pdf->SetFont("Arial", "B", 8);
			$pdf->SetWidths(array($lbody1,$this->lengthCell-$lbody1));
			$pdf->SetAligns(array("C","J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"",
					"Objek Pajak"
				),
				array
				(
					"",""
				),
				$this->height-1);
			$this->barisBaru($pdf,"", "1 NOP PBB ", ": " . $data["njop_pbb"]);
			$this->barisBaru($pdf,"", "2 Alamat", ": " . $data["object_address_name"]);
			$this->barisBaru($pdf,"", "3 Luas Tanah", ": " . $data["land_area"]." m2");
			$this->barisBaru($pdf,"", "4 Luas Bangunan", ": " . $data["building_area"]." m2");
			$this->barisBaru($pdf,"", "5 RT/RW", ": RT. " . $data["object_rt"] . "/RW. " . $data["object_rw"]);
			$this->barisBaru($pdf,"", "6 Kelurahan/Desa", ": " . $data["object_kelurahan"]);
			$this->barisBaru($pdf,"", "7 Kecamatan", ": " . $data["object_kecamatan"]);
			$this->barisBaru($pdf,"", "8 Kabupaten/Kota", ": " . $data["object_region"]);
			$pdf->Ln();

			$pdf->SetWidths(array($lbody1,$this->lengthCell-$lbody1));
			$pdf->SetAligns(array("C","J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"",
					$data['dasar_pengurang']
				),
				array
				(
					"",""
				),
				$this->height-1);
			$pdf->Ln();
			
			$pdf->SetWidths(array($lbody1,$this->lengthCell-$lbody1));
			$pdf->SetAligns(array("C","J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"",
					"Berkenaan hal tersebut di atas, permohonan yang diajukan oleh wajib pajak bersangkutan dapat dipertimbangkan."
				),
				array
				(
					"",""
				),
				$this->height-1);
			
			$pdf->Ln();
			$pdf->SetWidths(array($lbody1,$this->lengthCell-$lbody1));
			$pdf->SetAligns(array("C","J"));
			$pdf->RowMultiBorderWithHeight(
				array
				(	"",
					"Demikian hal-hal yang dapat kami sampaikan, Atas perhatian dan perkenan Bapak diucapkan terima kasih serta mohon petunjuk lebih lanjut."
				),
				array
				(
					"",""
				),
				$this->height-1);
			$pdf->Ln();$pdf->Ln();$pdf->Ln();
			$pdf->SetFont("Arial", "B", 8);
			$pdf->SetWidths(array($this->lengthCell/2,$this->lengthCell/2));
			$pdf->SetAligns(array("C","C"));

			if ($pejabat==""){
				$pejabat=1;
			}
			if ($pejabat==1){
					$pdf->RowMultiBorderWithHeight(
					array
					(	"",
						"a.n. KEPALA BIDANG PAD 1 \nKASI PENYELESAIAN PIUTANG \n\n\n\nDIN KAMADIANTINI S.IP, MM \nPembina \nNIP. 19710320 1998032 006"
					),
					array
					(
						"",""
					),
					$this->height-1);
			}else{
					$pdf->RowMultiBorderWithHeight(
					array
					(	"",
						"KEPALA BIDANG PAD 1 \n\n\n\n\nDrs. H. GUN GUN SUMARYANA\nPembina \nNIP. 19700806 199101 1 001"
					),
					array
					(
						"",""
					),
					$this->height-1);
			}

			$pdf->output();
		}



	}

	function barisBaru($pdf,$section, $field, $data){
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

	function getDataNotaDinas($t_bphtb_registration_id){
		$whereClause='';
		$data = array();

		$sql = "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
			j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,
			to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,
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

		$sql2 = "SELECT * FROM f_terbilang('".ceil($data['bphtb_amt_final'])."','') as terbilang";        
        $output = $this->db->query($sql2);
        $items = $output->row_array();

        $data['terbilang'] = ucwords($items['terbilang'])." Rupiah";

        return $data;
	}
}