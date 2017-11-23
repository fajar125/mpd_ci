<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_berita_acara_pemeriksaan_pdf extends CI_Controller{

	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 206;
    var $paperHSize = 330.2;
    var $height = 5;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function __construct() {
        parent::__construct();
        //$this->formCetak();
        $pdf = new FPDF('P', 'mm', array(203.2,330.2));
        $this->startY = $pdf->GetY();
        $this->startX = $this->paperWSize-42;
        $this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF('P', 'mm', array(203.2,330.2));
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
    }
	
	
	function pageCetak() {
		
		$t_customer_order_id = getVarClean('t_customer_order_id','int',0);

		$sql="";
		if ($t_customer_order_id != 0) {
			$sql .= "SELECT a.p_vat_type_dtl_id,a.t_vat_registration_id,c.vat_code,
			a.company_brand, a.brand_address_name, a.brand_address_no, a.wp_name, a.wp_address_name, a.company_name, a.address_name, b.code as job_name, a.bap_employee_no_1, a.bap_employee_name_1, a.bap_employee_no_2, a.bap_employee_name_2, a.bap_employee_job_pos_1, a.bap_employee_job_pos_2 " .
			"FROM t_vat_registration a " .
			"join p_job_position b " .
			"on a.p_job_position_id = b.p_job_position_id " .
			"left join p_vat_type_dtl c on c.p_vat_type_dtl_id=a.p_vat_type_dtl_id ".
			"where t_customer_order_id = $t_customer_order_id";
			
		}
		//echo ($sql);exit;
		$query = $this->db->query($sql);
		$data = $query->row_array();

		if (empty($data)){
			echo "Data BAP Tidak Ada";
			exit();
		}
		



		

		$pdf = new FPDF('P', 'mm', array(203.2,330.2));


		
		$pdf->AliasNbPages();
		$pdf->AddPage("P");
		$pdf->SetFont('Arial', '', 10);
		
		$pdf->Image(getValByCode('LOGO'),25,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$pdf->Cell($lheader1, $this->height, "", "", 0, 'L');
		$pdf->Cell($lheader7, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell($lheader1, $this->height, "", "", 0, 'L');
		$pdf->Cell($lheader7, $this->height, getValByCode('INSTANSI_1'), "", 0, 'C');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', 'B', 15);
		$pdf->Cell($lheader1, $this->height, "", "", 0, 'L');
		$pdf->Cell($lheader7, $this->height, getValByCode('INSTANSI_2'), "", 0, 'C');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader1, $this->height + 3, "", "", 0, 'L');
		$pdf->Cell($lheader7, $this->height + 3, getValByCode('ALAMAT_5'), "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lheader1, $this->height, "", "B", 0, 'L');
		$pdf->Cell($lheader7, $this->height, "", "B", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', 'UB', 12);
		$pdf->Cell($this->lengthCell, $this->height, "BERITA ACARA PENELITIAN LAPANGAN", "", 0, 'C');
		$this->newLine();
		$this->newLine();
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 10);
		$this->tulis("Pada hari ini ............ Tanggal ...... Bulan ....................... Tahun ..........., kami yang bertanda tangan di bawah ini:", "L", $pdf);
		$pdf->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		
		// Nama Petugas
		$titik = "........................................................................................................";
		$nama_1 = ($data["bap_employee_name_1"] == "") ? $titik : $data["bap_employee_name_1"];
		$nama_2 = ($data["bap_employee_name_2"] == "") ? $titik : $data["bap_employee_name_2"];
		$no_1 = ($data["bap_employee_no_1"] == "") ? $titik : $data["bap_employee_no_1"];
		$no_2 = ($data["bap_employee_no_2"] == "") ? $titik : $data["bap_employee_no_2"];
		$job_1 = ($data["bap_employee_job_pos_1"] == "") ? $titik : $data["bap_employee_job_pos_1"];
		$job_2 = ($data["bap_employee_job_pos_2"] == "") ? $titik : $data["bap_employee_job_pos_2"];
		
		$this->isi("1.", "Nama", ": " . $nama_1, $pdf);
		$this->isi("", "NIP", ": " . $no_1, $pdf);
		$this->isi("", "Jabatan", ": " . $job_1, $pdf);
		$this->isi("2.", "Nama", ": " . $nama_2, $pdf);
		$this->isi("", "NIP", ": " . $no_2, $pdf);
		$this->isi("", "Jabatan", ": " . $job_2, $pdf);

		// Body
		$this->newLine();
		$pdf->Ln();
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Cell(5, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2 * 2 - 25, $this->height, "Telah melakukan penelitian lapangan atas:", "", 0, 'L');
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		
		$this->isi("1", "Nama Pemohon NPWPD", ": " . $data["wp_name"], $pdf);
		//alamat wp
		$pdf->SetWidths(array(10, 5, $lbody1, $lbody3 - 25, 10));
		$pdf->SetAligns(array("L", "L", "L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"2.",
			"Alamat Pemohon NPWPD",
			": " . $data["wp_address_name"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
			
		$this->isi("3.", "Nama Perusahaan", ": " . $data["company_name"], $pdf);
		
		//alamat perusahaan
		$pdf->SetWidths(array(10, 5, $lbody1, $lbody3 - 25, 10));
		$pdf->SetAligns(array("L", "L", "L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"4.",
			"Alamat Perusahaan",
			": " . $data["address_name"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);

		$pdf->RowMultiBorderWithHeight(array(
			"",
			"5.",
			"Nama Merek Dagang",
			": " . $data["company_brand"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"6.",
			"Alamat Lokasi Usaha",
			": " . $data["brand_address_name"] . " " . $data["brand_address_no"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
		

		$this->newLine();
		$pdf->Ln();
		$this->isi_full("Dalam penelitian lapangan tersebut di atas telah ditemukan hal-hal sebagai berikut:", $pdf);
		
		$query = 	"select * from p_vat_type_dtl where p_vat_type_dtl_id =  " . $data["p_vat_type_dtl_id"];

		$exec = $this->db->query($query);

		$data_pajak = $exec->row_array();
		
		if ($data_pajak["p_vat_type_id"]==1){
			$sePerLima = ($this->lengthCell -20) /5;
			
			$pdf->SetWidths(array(10,$sePerLima, $sePerLima, $sePerLima, $sePerLima, $sePerLima));
			$pdf->SetAligns(array("C", "C", "C", "C", "C","C"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Kelas Hotel",
				"Golongan Kamar",
				"Jumlah Kamar",
				"Frekuensi Pengguna Layanan",
				"Tarif kamar"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			$pdf->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			$dbConn->close();
			
			
			$pdf->SetWidths(array(10,40, ($this->lengthCell-60)));
			$pdf->SetAligns(array("L", "L", "L"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		
		if ($data_pajak["p_vat_type_id"]==2){
			$sePerEnam = ($this->lengthCell -20) /6;
			
			$pdf->SetWidths(array(10,$sePerEnam, $sePerEnam, $sePerEnam, $sePerEnam, $sePerEnam,$sePerEnam));
			$pdf->SetAligns(array("C", "C", "C", "C", "C","C","C"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Jenis Pelayanan Restoran",
				"Jumlah Meja dan Kursi",
				"Harga Makanan Terendah & Tertinggi",
				"Harga Minuman Terendah & Tertinggi",
				"Daya Tampung",
				"Jumlah Pengunjung Rata-rata Perbulan"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			$pdf->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			
			
			$pdf->SetWidths(array(10,40, ($this->lengthCell-60)));
			$pdf->SetAligns(array("L", "L", "L"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		if ($data_pajak["p_vat_type_id"]==3){
			$sePerDelapan = ($this->lengthCell -20) /8;
			
			$pdf->SetWidths(array(10,$sePerDelapan, $sePerDelapan, $sePerDelapan+5, $sePerDelapan-5, $sePerDelapan,$sePerDelapan,$sePerDelapan,$sePerDelapan));
			$pdf->SetAligns(array("C", "C", "C", "C", "C","C","C","C","C"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Jenis Hiburan",
				"Cover Charge / HTM / Tarif",
				"Jumlah Lembar Meja / Kursi",
				"Jumlah Room",
				"Jumlah PL Pramuria / Pemijat",
				"Booking / Jam",
				"F / B",
				"Porsi / Orang"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			$pdf->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			
			$dbConn->close();
			
			
			$pdf->SetWidths(array(10,40, ($this->lengthCell-60)));
			$pdf->SetAligns(array("L", "L", "L"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		if ($data_pajak["p_vat_type_id"]==4){
			$sePerEmpat = ($this->lengthCell -20) /4;
			
			$pdf->SetWidths(array(10,$sePerEmpat, $sePerEmpat, $sePerEmpat, $sePerEmpat));
			$pdf->SetAligns(array("C", "C", "C", "C", "C"));
			//$this->SetvAligns(array("M", "M", "M", "M", "M","M"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Klasifikasi Tempat Parkir",
				"Luas Lahan Parkir",
				"Daya Tampung Kendaraan Bermotor",
				"Frekuensi Kendaraan Bermotor"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			$pdf->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			
			
			$pdf->SetWidths(array(10,40, ($this->lengthCell-60)));
			$pdf->SetAligns(array("L", "L", "L"));
			$pdf->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		$pdf->Ln();			
		$this->isi_full("Demikian Berita Acara Penelitian Lapangan ini dibuat dengan sebenar-benarnya.", $pdf);
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		//$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Lombok Utara, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Menyetujui,", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Pemohon NPWPD", "", 0, 'C');

		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Petugas Pendata 1,", "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell($lbody2, $this->height, "Nama Jelas:", "", 0, 'L');
		$pdf->Ln(4);
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, $data["wp_name"], "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, $data["bap_employee_name_1"], "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "", "T", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "NIP. " . $data["bap_employee_no_1"], "T", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "Jabatan:", "", 0, 'L');
		$pdf->Ln(4);
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, $data["job_name"], "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "(Tanda Tangan dan Cap Perusahaan)", "T", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Petugas Pendata 2,", "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, $data["bap_employee_name_2"], "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();

		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "NIP. " . $data["bap_employee_no_2"], "T", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Output();
	}

	function isi($no, $field, $content, $pdf){
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Cell(5, $this->height, "$no", "", 0, 'L');
		$pdf->Cell($lbody1, $this->height, "$field", "", 0, 'L');
		$pdf->Cell($lbody3 - 25, $this->height, "$content", "", 0, 'L');
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Ln();
	}
	
	function isi_full($content, $pdf){
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Cell(5, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2 * 2 - 25, $this->height, "$content", "", 0, 'L');
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Ln();
	}
	
	function tulis($text, $align, $pdf){
		$pdf->Ln();
		$pdf->Cell(10, $this->height, "", "", 0, 'C');
		$pdf->Cell($this->lengthCell - 20, $this->height, $text, "", 0, $align, "", "");
		$pdf->Cell(10, $this->height, "", "", 0, 'C');
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

	

}



