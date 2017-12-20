<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_registrasi_payment_large_arial extends CI_Controller{

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
		$payment_key = getVarClean('payment_key','str','');
		
		$sql = "SELECT t_customer_order_id FROM t_vat_setllement WHERE payment_key='".$payment_key."'";
        $query = $this->db->query($sql);
        $item = $query->row_array();
		// $mode = getVarClean('mode','int',0);
		// $p_finance_period_id = getVarClean('p_finance_period_id','int',0);
		// $p_finance_period_id1 = getVarClean('p_finance_period_id1','int',0);
		// $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
		// //$status_bayar = getVarClean('ListBox1');
		// $npwpd = getVarClean('npwpd','int',0);

	 

		
		$sql1="SELECT a.t_vat_setllement_id, b.p_cg_terminal_id, upper(d.vat_code) as jenis_pajak, to_char(b.payment_date,'dd/mm/yyyy') as tgl_transaksi, 
			to_char(b.payment_date,'HH24:MI:SS') as jam_transaksi, b.receipt_no, a.payment_key, a.npwd, a.no_kohir,
			e.wp_name, (e.wp_address_name || '/' || e.wp_address_no) AS alamat_wp,
			b.payment_vat_amount as total_pokok, a.total_penalty_amount as total_denda, b.payment_vat_amount + nvl(A .total_penalty_amount,0) as total_tagihan,
			upper(trim(replace(f_terbilang(to_char(round(nvl(b.payment_vat_amount,0) + nvl(a.total_penalty_amount,0))),'rp.'), '  ', ' '))) || ' RUPIAH' as dengan_huruf,
			'4'||(d.code || c.code) AS kode_rekening, upper(c.vat_code) as nama_rekening,
			to_char(a.start_period,'yyyymmdd') as start_period, to_char(a.end_period,'yyyymmdd') as end_period,
			company_brand,brand_address_name,brand_address_no
			FROM t_vat_setllement AS a
			LEFT JOIN t_payment_receipt AS b ON a.t_vat_setllement_id = b.t_vat_setllement_id
			LEFT JOIN p_vat_type_dtl AS c ON a.p_vat_type_dtl_id = c.p_vat_type_dtl_id
			LEFT JOIN p_vat_type AS d ON c.p_vat_type_id = d.p_vat_type_id
			LEFT JOIN t_cust_account AS e ON a.t_cust_account_id = e.t_cust_account_id
			WHERE a.t_customer_order_id = ".$item['t_customer_order_id'];
		
		$data = array();  
        $output = $this->db->query($sql1);
        $data = $output->row_array();
        
        // print_r($sql);
        // exit();

		$pdf = new FPDF();


		$_HEIGHT = 4;
		$_BORDER = 0;
		$_FONT = 'Times';
		$_FONTSIZE = 10;
		
		$size[1]=6;
		$pdf->PageSize = $size;
		$pdf->PageSize = $size;
		$pdf->AddPage('P',array(210,296));
		//$pdf->AddPage('P',array(210,296));

		$pdf->SetFont('helvetica', '', $_FONTSIZE);
		$pdf->SetRightMargin($_HEIGHT);
		$pdf->SetLeftMargin($_HEIGHT);

		$pdf->SetAutoPageBreak(false,0);

		$pdf->SetFont('Arial', '',9);

		//$pdf->Image('../images/logo_pemda.png',10,5,20,20);
		$pdf->ln(10);
		$pdf->SetWidths(array(5,130, 60));
		$pdf->SetAligns(array("L","L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"USER ID : ".$data["p_cg_terminal_id"],
						"TGL CETAK : ".date('d/m/Y')
					),
					array
					(
					    "",
						"",
						""
					),
					$_HEIGHT);
					
		$pdf->SetWidths(array(5,130, 60));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						strtoupper(getValByCode('INSTANSI_4')),
						"JAM CETAK : ".date('H:i:s')
					),
					array
					(
					    "",
						"",
						""
					),
					$_HEIGHT);
					
		$pdf->ln();
		$pdf->SetWidths(array(5,130, 60));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"BUKTI PEMBAYARAN / SETORAN ".$data['jenis_pajak'],
						" "
					),
					array
					(
					    "",
						"",
						""
					),
					3);
		$pdf->SetWidths(array(5,130, 60));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						getValByCode('INSTANSI_1'),
						" "
					),
					array
					(
					    "",
						"",
						""
					),
					3);

		$pdf->SetWidths(array(5,190));
		$pdf->SetAligns(array("L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",
						
					),
					array
					(
					    "",
						""
					),
					3);


		$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"TANGGAL TRANSAKSI", ": ".$data['tgl_transaksi']." (DD/MM/YYYY)",
						"JAM TRANSAKSI  : ".$data['jam_transaksi']
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);


		/*$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"NTP", ": ".$data['receipt_no'],
						"NOMOR KOHIR    : ".$data['no_kohir']
						
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);*/

		$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
		$pdf->Cell(45, $_HEIGHT, "NTP", "", 0, "");
		$pdf->Cell(75, $_HEIGHT, ": ".$data['receipt_no'], "", 0, "");

		$pdf->Cell(29, $_HEIGHT, "NOMOR KOHIR    :", "", 0, "");
		$pdf->SetFont('Arial', '',11);
		$pdf->Cell(41, $_HEIGHT, $data['no_kohir'], "", 0, "");
		$pdf->ln();


		$pdf->SetFont('Arial', '',9);
		/*$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"NPWPD/NOPD", ": ".$data['npwd'],
						"NOMOR BAYAR   : ".$data['payment_key']
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);*/

		$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
		$pdf->Cell(45, $_HEIGHT, "NPWPD/NOPD", "", 0, "");
		$pdf->Cell(75, $_HEIGHT, ": ".$data['npwd'], "", 0, "");

		$pdf->Cell(29, $_HEIGHT, "NOMOR BAYAR   :", "", 0, "");
		$pdf->SetFont('Arial', '',11);
		$pdf->Cell(41, $_HEIGHT, $data['payment_key'], "", 0, "");


		$pdf->ln();
		$pdf->SetFont('Arial', '',9);
		$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"NAMA WP/OP", ": ".$data['wp_name'],
						""
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);
		$pdf->SetFont('Arial', '',9);
		$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"NAMA MERK DAGANG", ": ".$data['company_brand'],
						""
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);
					
		$pdf->SetWidths(array(5,45, 145));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"ALAMAT MERK DAGANG", ": ".$data['brand_address_name']." ".$data['brand_address_no']
					),
					array
					(
					    "",
						"",""
					),
					$_HEIGHT);

		$pdf->ln();
		$pdf->SetWidths(array(5,45, 15, 60, 70));
		$pdf->SetAligns(array("L", "L", "L", "R", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"TAGIHAN POKOK",": RP.", number_format($data['total_pokok'], 0, ",", "."),
						""
					),
					array
					(
					    "",
						"","",
						"",""
					),
					$_HEIGHT);
		$pdf->SetWidths(array(5,45, 15, 60, 70));
		$pdf->SetAligns(array("L", "L", "L", "R", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"TAGIHAN DENDA",": RP.", number_format($data['total_denda'], 0, ",", "."),
						""
					),
					array
					(
					    "",
						"","",
						"",""
					),
					$_HEIGHT);


		$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"", "---------------------------------------------------------------------",
						""
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);


		$pdf->SetWidths(array(5,45, 15, 60, 70));
		$pdf->SetAligns(array("L", "L", "L", "R", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"TOTAL TAGIHAN",": RP.", number_format($data['total_tagihan'], 0, ",", "."),
						""
					),
					array
					(
					    "",
						"","",
						"",""
					),
					$_HEIGHT);	
		$pdf->SetWidths(array(5,45, 15, 60, 70));
		$pdf->SetAligns(array("L", "L", "L", "R", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"BIAYA ADMIN BANK",": RP.", "0",
						""
					),
					array
					(
					    "",
						"","",
						"",""
					),
					$_HEIGHT);																		
		$pdf->SetWidths(array(5,45, 75, 70));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"", "---------------------------------------------------------------------",
						""
					),
					array
					(
					    "",
						"","",
						""
					),
					$_HEIGHT);
					
		/*$pdf->SetWidths(array(5,45, 15, 60, 70));
		$pdf->SetAligns(array("L", "L", "L", "R", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"TOTAL BAYAR",": RP.", number_format($data['total_tagihan'], 0, ",", "."),
						""
					),
					array
					(
					    "",
						"","",
						"",""
					),
					$_HEIGHT);	*/
		$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
		$pdf->Cell(45, $_HEIGHT, "TOTAL BAYAR", "", 0, "");
		$pdf->Cell(15, $_HEIGHT, ": RP.", "", 0, "");
		$pdf->SetFont('Arial', '',11);
		$pdf->Cell(60, $_HEIGHT, number_format($data['total_tagihan'], 0, ",", "."), "", 0, "R");
		$pdf->SetFont('Arial', '',9);
		$pdf->Cell(70, $_HEIGHT, "", "", 0, "");
		$pdf->ln();

		$pdf->SetWidths(array(5,45, 145));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"TERBILANG", ": ".$data['dengan_huruf']
					),
					array
					(
					    "",
						"",""
					),
					$_HEIGHT);

		$pdf->ln();
		$pdf->SetWidths(array(5,45, 145));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"KODE/NAMA REKENING", ": ".$data['kode_rekening']." / ".$data['nama_rekening']
					),
					array
					(
					    "",
						"",""
					),
					$_HEIGHT);

		/*$pdf->SetWidths(array(5,45, 145));
		$pdf->SetAligns(array("L", "L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"MASA AWAL/AKHIR PJK", ": ".$data['start_period']." / ".$data['end_period']
					),
					array
					(
					    "",
						"",""
					),
					$_HEIGHT);*/

		$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
		$pdf->Cell(45, $_HEIGHT, "MASA AWAL/AKHIR PJK", "", 0, "");
		$pdf->SetFont('Arial', '',11);
		$pdf->Cell(145, $_HEIGHT, ": ".$data['start_period']." / ".$data['end_period'], "", 0, "");
		$pdf->SetFont('Arial', '',9);
		$pdf->ln();

		$pdf->SetWidths(array(5,190));
		$pdf->SetAligns(array("L", "L"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",
						
					),
					array
					(
					    "",
						""
					),
					3);

		$pdf->SetWidths(array(5,190));
		$pdf->SetAligns(array("L", "C"));
		$pdf->RowMultiBorderWithHeight(
					array
					(	
					    "",
						"*BUKTI PEMBAYARAN/SETORAN INI HARAP DISIMPAN SEBAGAI BUKTI PEMBAYARAN YANG SAH*",
						
					),
					array
					(
					    "",
						""
					),
					3);						
//$pdf->Output("","I");

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

	

}



