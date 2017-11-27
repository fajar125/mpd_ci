<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_kartu_npwpd extends CI_Controller{

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

		$t_customer_order_id = getVarClean('t_customer_order_id','int',0);


		$sql="";
		if ($t_customer_order_id != 0) {
			$sql .= "select b.vat_code,to_char(a.registration_date,'dd Mon yyyy') as registration_date_2,company_owner,a.* from t_vat_registration a
		left join p_vat_type_dtl b on a.p_vat_type_dtl_id = b.p_vat_type_dtl_id
		where t_customer_order_id = ".$t_customer_order_id;

		}
		//echo ($sql);exit;
		$query = $this->db->query($sql);
		$data = $query->row_array();
        // exit();

		$pdf = new FPDF();



		$_HEIGHT = 4;
		$_BORDER = 0;
		$_FONT = 'Times';
		$_FONTSIZE = 10;
		//$size = $pdf->_getpagesize('Legal');
		$size[1]=6;
		$pdf->PageSize = $size;
		$pdf->PageSize = $size;
		$pdf->AddPage('L',array(200,150));
		//$pdf->AddPage('P',array(210,296));

		$pdf->SetFont('helvetica', '', $_FONTSIZE);
		$pdf->SetRightMargin($_HEIGHT);
		$pdf->SetLeftMargin($_HEIGHT);

		$pdf->SetAutoPageBreak(false,0);
		$pdf->Ln(0);
		$pdf->Image(getValByCode('LOGO'),12,11,13,13);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(10, 5, "", "TL", 0, 'L');
		$pdf->Cell(80, 5, getValByCode('INSTANSI_1'), "TR", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(90, 5, "", "TLR", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 5, "", "L", 0, 'L');
		$pdf->Cell(80, 5, getValByCode('INSTANSI_2'), "R", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(90, 5, "PERHATIAN", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "L", 0, 'L');
		$pdf->Cell(80, 5, getValByCode('ALAMAT_5'), "R", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(90, 5, "", "LR", 0, 'C');
		$pdf->Ln(1);
		$pdf->Cell(5, 5, "", "L", 0, 'L');
		$pdf->Cell(15, 5, "", "B", 0, 'L');
		$pdf->Cell(65, 5, "", "B", 0, 'C');
		$pdf->Cell(5, 5, "", "R", 0, 'L');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(90, 5, "", "LR", 0, 'C');
		$pdf->Ln();

		$pdf->SetWidths(array(90, 10,10, 75,5));
		$pdf->SetAligns(array("L", "L","C", "L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"",
				"",
				"*",
				"NPWPD ini merupakan tanda pengenal diri atau identitas wajib Pajak dalam melakukan hak dan kewajiban perpajakan daerah di Kabupaten Lombok Utara.",
				""
			),
			array
			(
				"LR",
				"",
				"L",
				"",
				"R"
			),
			3
		);
		/*
		$pdf->SetWidths(array(90, 10,10, 75,5));
		$pdf->SetAligns(array("L", "L","C", "L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"",
				"",
				"*",
				"Kartu ini harap di simpan baik-baik dan apabila hilang atau terjadi perubahan data kepemilikan, agar segera melapor ke kantor Dinas Pelayanan Pajak Kota LOMBOK UTARA.",
				""
			),
			array
			(
				"LR",
				"",
				"L",
				"",
				"R"
			),
			$_HEIGHT
		);

		$pdf->SetWidths(array(90, 10,10, 75,5));
		$pdf->SetAligns(array("L", "L","C", "L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"",
				"",
				"*",
				"Jatuh Tempo pembayaran Pajak Daerah tanggal 15 setiap bulannya",
				""
			),
			array
			(
				"LR",
				"",
				"L",
				"",
				"R"
			),
			$_HEIGHT
		);
		*/
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(90, 5, "NPWPD : ".$data['npwpd'], "LR", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(10, 3, "*", "L", 0, 'C');
		$pdf->Cell(75, 3, "Kartu ini harap di simpan baik-baik dan apabila hilang atau terjadi perubahan", "", 0, 'J');
		$pdf->Cell(5, 5, "", "R", 0, 'C');
		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(90, 9, $data['company_brand'], "LR", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(10, 3, "", "L", 0, 'C');
		$pdf->Cell(75, 3, "data kepemilikan, agar segera melapor ke kantor Badan Pendapatan Daerah", "", 0, 'J');
		$pdf->Cell(5, 5, "", "R", 0, 'C');
		$pdf->Ln(3);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(90, 12, $data['brand_address_name'], "LR", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(10, 3, "", "L", 0, 'C');
		$pdf->Cell(75, 3, "Kabupaten Lombok Utara.", "", 0, 'J');
		$pdf->Cell(5, 5, "", "R", 0, 'C');
		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(90, 15, $data['company_name'], "LR", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(10, 5, "*", "L", 0, 'C');
		$pdf->Cell(75, 3, "Jatuh Tempo pembayaran Pajak Daerah tanggal 15 setiap bulannya.", "", 0, 'J');
		$pdf->Cell(5, 5, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell(90, 5, "", "LR", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(90, 5, "", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell(90, 5, "", "LR", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(90, 5, "www.bapendalombokutara.go.id", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(45, 5, 'TERDAFTAR : '. $data['registration_date'], "L", 0, 'L');
		$pdf->Cell(45, 5, $data['vat_code'], "R", 0, 'R');
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(90, 3, "BAYAR PAJAK MUDAH! LOMBOK UTARA JUARA!", "LR", 0, 'C');
		$pdf->Ln(1);
		$pdf->Cell(90, 5, "", "BLR", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Cell(90, 5, "", "BLR", 0, 'C');

		$pdf->Ln(7);
		$pdf->SetWidths(array(190));
		$pdf->SetAligns(array("C"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"
			),
			array
			(
				""
			),
			$_HEIGHT
		);
		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 14);
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"\nTANDA TERIMA KARTU NPWPD\n"
			),
			array
			(
				"TLR"
			),
			$_HEIGHT
		);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetWidths(array(10,40,130,10));
		$pdf->SetAligns(array("L","L","L","L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"",
				"\nNPWPD
				\nMerk Dagang
				\nAlamat
				",

				"\n: ".$data['npwpd']."
				\n: ".$data['company_brand']."
				\n: ".$data['brand_address_name']."
				\n",
				""
			),
			array
			(
				"L",
				"",
				"",
				"R"
			),
			$_HEIGHT
		);

		$pdf->SetWidths(array(70,120));
		$pdf->SetAligns(array("L","C"));
		$pdf->RowMultiBorderWithHeight(
			array
			(
				"",
				"LOMBOK UTARA, ".date('d-m-Y')."
				\nYang menerima
				\n
				\n
				".$data['company_name']."
				\n"
			),
			array
			(
				"BL",
				"BR"
			),
			$_HEIGHT
		);

		//$pdf->Output("","I");
		if(!empty($_GET['save'])){
			$name_of_file = "print_kartu_pdf_".time().".pdf";
			try{
				$dbConn->query("INSERT INTO t_print_queue(t_customer_order_id, file_name, status) VALUES (".$t_customer_order_id.",'".$name_of_file."', 'SAVED');");
				$dbConn->next_record();

				$pdf->Output('D:\work\list_pdf\\'.$name_of_file,'F');
			}catch(Exception $e){
				@unlink('D:\work\list_pdf\\'.$name_of_file);
			}
		}else{
			$pdf->Output("","I");
		}
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



}



