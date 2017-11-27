<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_form_pemutakhiran_data_npwpd_jabatan extends CI_Controller{

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
		$tgl = getVarClean('tgl','str','');

		$sql="";
		if ($t_customer_order_id != 0) {
			$sql .= "select d.p_rqst_type_id, a.p_vat_type_dtl_id,a.t_vat_registration_id,c.vat_code,
			a.company_brand, a.brand_address_name, a.brand_address_no, 
			case when length(nvl(a.brand_address_rt,''))<1 then '-' else a.brand_address_rt end as brand_address_rt,
			case when length(nvl(a.brand_address_rw,''))<1 then '-' else a.brand_address_rw end as brand_address_rw,
			e.region_name as kota,f.region_name as kec,g.region_name as kel,
			case when length(nvl(a.brand_zip_code,''))<1 then '-' else a.brand_zip_code end as brand_zip_code,
			case when length(nvl(a.brand_phone_no,''))<1 then '-' else a.brand_phone_no end as brand_phone_no,
			case when length(nvl(a.brand_fax_no,''))<1 then '-' else a.brand_fax_no end as brand_fax_no,
			a.wp_name, a.wp_address_name, a.company_name, a.address_name, b.code as job_name, a.bap_employee_no_1, a.bap_employee_name_1, a.bap_employee_no_2, a.bap_employee_name_2, a.bap_employee_job_pos_1, a.bap_employee_job_pos_2 " .
			"from t_vat_registration a " .
			"left join p_job_position b " .
			"on a.p_job_position_id = b.p_job_position_id " .
			"left join p_vat_type_dtl c on c.p_vat_type_dtl_id=a.p_vat_type_dtl_id ".
			"left join t_customer_order d on d.t_customer_order_id = a.t_customer_order_id ".
			"left join p_region e on e.p_region_id = a.brand_p_region_id ".
			"left join p_region f on f.p_region_id = a.brand_p_region_id_kec ".
			"left join p_region g on g.p_region_id = a.brand_p_region_id_kel ".
			"where a.t_customer_order_id = $t_customer_order_id";
			
		}
		//echo ($sql);exit;
		$query = $this->db->query($sql);
		$data = $query->row_array();
        // exit();

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
		$pdf->Cell($this->lengthCell, $this->height, "PEMUTAKHIRAN DATA WAJIB PAJAK (NPWPD JABATAN)", "", 0, 'C');
		$this->newLine();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');

		// Body
		$this->newLine();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Cell(5, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2 * 2 - 25, $this->height, "Wajib Pajak diharapkan mengisi data secara lengkap pada kolom 'PEMUTAHIRAN DATA'.", "", 0, 'L');
		$pdf->Cell(10, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetWidths(array(10,($lbody1 + $lbody3 - 20)/3,($lbody1 + $lbody3 - 20)/3,($lbody1 + $lbody3 - 20)/3, 10));
		$pdf->SetAligns(array("L", "C", "C", "C", "L"));
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"KATEGORI",
			"DATA TERCATAT",
			"PEMUTAKHIRAN DATA",
			""
			)
			,
			array(
			"",
			"BLTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->SetFont('Arial', '', 8);
		$pdf->SetWidths(array(10,4,($lbody1 + $lbody3 - 20)/3-4,($lbody1 + $lbody3 - 20)/3,($lbody1 + $lbody3 - 20)/3, 10));
		$pdf->SetAligns(array("L", "L","L", "L", "L", "L"));
		//keterangan wajib pajak
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"1",
			"Keterangan Wajib Pajak",
			"",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
			
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Nama Wajib Pajak",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Alamat Wajib Pajak",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Rt/Rw",
			"-/-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kota/Kabupaten",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kecamatan",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kelurahan",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kode Pos",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No. Telephon",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No. Fax",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Email",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
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
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		
		//keterangan Penanggung pajak (Jika berbentuk badan)
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"2",
			"Keterangan Penanggung Pajak\n(Diisi jika WP berbentuk Badan Usaha)",
			"",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Nama Penanggung Pajak",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Jabatan",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Alamat Tempat Tinggal",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Rt/Rw",
			"-/-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kota/Kabupaten",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kecamatan",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kelurahan",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kode Pos",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No. Telephon",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No. Selular",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No. Fax",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Email",
			"-",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
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
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		
		
		//keterangan objek pajak
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"3",
			"Keterangan Objek Pajak",
			"",
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Nama Objek Pajak",
			$data["company_brand"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Alamat Lokasi Usaha",
			$data["brand_address_name"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No",
			$data["brand_address_no"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Rt/Rw",
			$data["brand_address_rt"]."/".$data["brand_address_rw"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kota/Kabupaten",
			$data["kota"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kecamatan",
			$data["kec"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"Kelurahan",
			$data["kel"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			
			"Kode Pos",
			$data["brand_zip_code"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",
			"No. Telephon",
			$data["brand_phone_no"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		$pdf->RowMultiBorderWithHeight(array(
			"",
			"",			
			"No. Fax",
			$data["brand_fax_no"],
			"",
			""
			)
			,
			array(
			"",
			"BL",
			"BTR",
			"BLTR",
			"BLTR",
			""
			)
			,
			$this->height);
		
		
		$pdf->AddPage("P");
		//$this->newLine();
		$pdf->SetFont('Arial', '', 10);
		$this->isi_full("Selanjutnya Wajib Pajak diharapkan mengisi DATA POTENSI pada tabel di bawah ini.", $pdf);
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 8);
		$query = "select * from p_rqst_type where p_rqst_type_id =  " . $data["p_rqst_type_id"];
		$exec = $this->db->query($query);
		$data_pajak = $exec->row_array();
		
		if ($data_pajak["p_vat_type_id"]==1){
			$sePerLima = ($this->lengthCell -20) /5;
			
			$pdf->SetWidths(array(10,$sePerLima, $sePerLima, $sePerLima, $sePerLima, $sePerLima));
			$pdf->SetAligns(array("C", "C", "C", "C", "C","C"));
			//$this->SetvAligns(array("M", "M", "M", "M", "M","M"));
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
			
			/*$data_detail = array();
			$dbConn = new clsDBConnSIKP();
			$query = 	"select code,room_qty,service_qty,service_charge_wd,service_charge_we from t_vat_reg_dtl_hotel a
					left join p_room_type x on a.p_room_type_id=x.p_room_type_id
					where t_vat_registration_id = ".$data["t_vat_registration_id"];

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data_detail["code"]		= $dbConn->f("code");
				$data_detail["room_qty"]		= $dbConn->f("room_qty");
				$data_detail["service_qty"]		= $dbConn->f("service_qty");
				$data_detail["service_charge_wd"]		= $dbConn->f("service_charge_wd");
				$data_detail["service_charge_we"]		= $dbConn->f("service_charge_we");
				
				$pdf->RowMultiBorderWithHeight(array(
					"",
					ucwords(strtolower($data["vat_code"])),
					ucwords(strtolower($data_detail["code"])),
					$data_detail["room_qty"],
					$data_detail["service_qty"],
					number_format($data_detail["service_charge_wd"],2,",",".")." (weekday), ".number_format($data_detail["service_charge_we"],2,",",".")." (weekend)"
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
					$this->height);
			}*/
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
			
			/*$data_detail = array();
			$dbConn = new clsDBConnSIKP();
			$query = 	"select * from t_vat_reg_dtl_restaurant
					where t_vat_registration_id = ".$data["t_vat_registration_id"];

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data_detail["seat_qty"]		= $dbConn->f("seat_qty");
				$data_detail["table_qty"]		= $dbConn->f("table_qty");
				$data_detail["max_service_qty"]		= $dbConn->f("max_service_qty");
				$data_detail["avg_subscription"]		= $dbConn->f("avg_subscription");
				$data_detail["service_type_desc"]		= $dbConn->f("service_type_desc");
				
				$pdf->RowMultiBorderWithHeight(array(
					"",
					ucwords(strtolower($data_detail["service_type_desc"])),
					$data_detail["table_qty"]	." meja dan ".$data_detail["seat_qty"]." kursi",
					"",
					"",
					$data_detail["max_service_qty"],
					number_format($data_detail["avg_subscription"],0,",",".")
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
					$this->height);
			}*/
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
			$dbConn->close();
		}
		
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 10);		
		$this->isi_full("Demikian data ini diisi dengan sebenar-benarnya.", $pdf);
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Lombok Utara, ................................" /*. $data["tanggal"]*/, "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "Wajib Pajak", "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Ln(4);
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "Nama Jelas:", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "Jabatan:", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "", "T", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Ln(4);
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "(Tanda Tangan dan Cap Perusahaan)", "T", 0, 'C');
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
		$pdf->Ln();
		
		
		$pdf->Output("","I");
		
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
		$pdf->Cell(10, $this->height, "", "", 0, 'C');
		$pdf->Cell($this->lengthCell - 20, $this->height, $text, "", 0, $align);
		$pdf->Cell(10, $this->height, "", "", 0, 'C');
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

	

}



