<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_formulir_sptpd extends CI_Controller{

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
		
		$t_cust_order_id = getVarClean('t_cust_order_id','int',0);

		if($t_cust_order_id == null || $t_cust_order_id == 0){
			echo "Data Tidak Ada";
			exit();
		}

		$sqlPayment = "select t_vat_setllement_id from t_vat_setllement where t_customer_order_id = ".$t_cust_order_id;
		$output = $this->db->query($sqlPayment);
        $item = $output->row_array();
        $t_vat_setllement_id = $item['t_vat_setllement_id'];

		$sql = "";

		if($t_vat_setllement_id > 0){
			$sql = "SELECT *, to_char(settlement_date,'DD Month YYYY') AS tgl_setllement,
				to_char(settlement_date+15,'DD Month YYYY') AS tgl_jatuh_tempo 
				FROM v_vat_setllement WHERE t_vat_setllement_id = " . $t_vat_setllement_id;
		}

		$data = array();  
        $output = $this->db->query($sql);
        $data = $output->row_array();
        // print_r($data);
        // exit();

		$pdf = new FPDF();


		$pdf->AliasNbPages();
		$pdf->AddPage("P");
		$pdf->SetFont('Arial', '', 10);
		
		// $pdf->Image('../images/logo_pemda.png',12,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader5 = $lheader * 5;
		$lheader6 = $lheader * 6;
		
		$pdf->Cell($lheader1, $this->height-2, "", "TL", 0, 'C');
		$pdf->Cell($lheader2, $this->height-2, "", "TR", 0, 'C');
		$pdf->Cell($lheader3, $this->height-2, "", "TR", 0, 'C');
		$pdf->Cell($lheader2, $this->height-2, "", "TR", 0, 'C');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Image('images/logo_lombok.png',12,15,20,20);
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'C');			
		$pdf->Cell($lheader2, $this->height, "PEMERINTAH KABUPATEN", "R", 0, 'C');
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell($lheader3, $this->height, "SKPDKB", "R", 0, 'C');
		$pdf->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		
		/*$pdf->Cell($lheader1, $this->height, "", "L", 0, 'C');			
		$pdf->Cell($lheader2, $this->height, "LOMBOK UTARA", "R", 0, 'C');
		$pdf->Cell($lheader3, $this->height, "(Surat Ketetapan Pajak Daerah Kurang Bayar)", "R", 0, 'C');
		$pdf->Cell($lheader2, $this->height, "No. Urut", "R", 0, 'C');
		$pdf->Ln();*/		
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader1, $this->height-2, "", "L", 0, 'C');			
		$pdf->Cell($lheader2, $this->height-2, "LOMBOK UTARA", "R", 0, 'C');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lheader3, $this->height-2, "(Surat Ketetapan Pajak Daerah)", "R", 0, 'C');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader2, $this->height-2, "No. Urut", "R", 0, 'C');
		$pdf->Ln();

		/*
		$pdf->Cell($lheader6, $this->height, "(Surat Ketetapan Pajak Daerah Kurang Bayar)", "LR", 0, 'C');
		$pdf->Cell($lheader2, $this->height, "No. Urut", "R", 0, 'C');
		$pdf->Ln();*/
		
		
		$pdf->Cell($lheader1, $this->height + 1, "", "L", 0, 'C');	
		$pdf->Cell($lheader2, $this->height + 1, getValByCode('INSTANSI_2'), "R", 0, 'C');
		$pdf->Cell($lheader3, $this->height + 1, "     Masa Pajak    : ".$data["finance_period_code"], "R", 0, 'L');
		$pdf->Cell($lheader2, $this->height + 1, "", "R", 0, 'C');
		$pdf->Ln($this->height - 4);
		
		
		// No Urut
		$pdf->Cell($lheader2 + $lheader4 + 1, $this->height, "", "R", 0, 'C');
		$no_urut = str_split($data["order_no"]);
		$this->kotak(1, 34, 1, $no_urut[0],$pdf);
		$this->kotak(1, 34, 1, $no_urut[1],$pdf);
		$this->kotak(1, 34, 1, $no_urut[2],$pdf);
		$this->kotak(1, 34, 1, $no_urut[3],$pdf);
		$this->kotak(1, 34, 1, $no_urut[4],$pdf);
		$this->kotak(1, 34, 1, $no_urut[5],$pdf);
		$this->kotak(1, 34, 1, $no_urut[6],$pdf);
		$this->kotak(1, 34, 1, $no_urut[7],$pdf);
		$pdf->Ln();
		// =======
		
		/*$pdf->Cell($lheader2, $this->height + 2, "", "BL", 0, 'R');
		$pdf->Cell($lheader1, $this->height + 2, "Tahun Pajak ", "B", 0, 'L');
		$pdf->Cell($lheader3, $this->height + 2, ": ".$data["tahun"], "BR", 0, 'L');
		$pdf->Cell($lheader2, $this->height + 2, "", "BR", 0, 'C');
		*/
		$pdf->Cell($lheader1, $this->height-1, "", "L", 0, 'C');	
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lheader2, $this->height-1, getValByCode('ALAMAT_1'), "R", 0, 'C');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader3, $this->height-1, "     Tahun Pajak   : ".$data["tahun"], "R", 0, 'L');
		$pdf->Cell($lheader2, $this->height-1, "No.Bayar", "R", 0, 'C');
		$pdf->Ln();
		
		// $pdf->Cell($lheader3, $this->height + 2, "", "BL", 0, 'R');
		// $pdf->Cell($lheader3, $this->height + 2, "", "BR", 0, 'L');
		// $pdf->Cell($lheader2, $this->height + 2, "", "BR", 0, 'C');
		// $pdf->Ln();
		
		$pdf->Cell($lheader1, $this->height+1, "", "BL", 0, 'C');	
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lheader2, $this->height+1, "Telp. 022-4235052 - LOMBOK UTARA", "BR", 0, 'C');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader3, $this->height+1, "", "BR", 0, 'L');
		$pdf->Cell($lheader2, $this->height+1, $data["payment_key"], "BR", 0, 'C');
		$pdf->Ln();

		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Nama", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " . $data["wp_name"], "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Alamat", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " . $data["wp_address_name"], "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height + 2, "NPWPD", "", 0, 'L');
		$pdf->Cell($lbody1, $this->height + 2, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height + 2, "", "R", 0, 'L');
		$pdf->Ln($this->height-4);
		
		$pdf->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		$rep_npwd = str_replace(".", "", $data["npwd"]);
		$arr1 = str_split($rep_npwd);
		
		$this->kotak(1, 34, 1,$arr1[0],$pdf);
		$this->kotakKosong(1, 34, 1,$pdf);
		$this->kotak(1, 34, 1,$arr1[1],$pdf);
		$this->kotakKosong(1, 34, 1,$pdf);
		$this->kotak(1, 34, 1,$arr1[2],$pdf);
		$this->kotak(1, 34, 1,$arr1[3],$pdf);
		$this->kotak(1, 34, 1,$arr1[4],$pdf);
		$this->kotak(1, 34, 1,$arr1[5],$pdf);
		$this->kotak(1, 34, 1,$arr1[6],$pdf);
		$this->kotak(1, 34, 1,$arr1[7],$pdf);
		$this->kotak(1, 34, 1,$arr1[8],$pdf);
		$this->kotakKosong(1, 34, 1,$pdf);
		$this->kotak(1, 34, 1,$arr1[9],$pdf);
		$this->kotak(1, 34, 1,$arr1[10],$pdf);
		$this->kotakKosong(1, 34, 1,$pdf);
		$this->kotak(1, 34, 1,$arr1[11],$pdf);
		$this->kotak(1, 34, 1,$arr1[12],$pdf);
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "BL", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Tanggal jatuh tempo", "B", 0, 'L');
		//$pdf->Cell($lbody3, $this->height, ": ".Date("d M Y",strtotime("+15 day")), "BR", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": ".$data["tgl_jatuh_tempo"], "BR", 0, 'L');
		
		$pdf->Ln();
		//$this->tulis("I. Berdasarkan Pasal 65 ayat (2) dan (3) Peraturan Daerah Kabupaten Lombok Utara Nomor 20 Tahun 2011 tentang Pajak Daerah, telah dilakukan", "L");
		$pdf->Cell(5, $this->height+2, "", "L", 0, 'C');
		$pdf->Cell($this->lengthCell - 10, $this->height+2, "I. Berdasarkan Pasal 65 ayat (2) dan (3) Peraturan Daerah Kabupaten Lombok Utara Nomor 20 Tahun 2011 tentang Pajak Daerah, telah dilakukan", "", 0, "L");
		$pdf->Cell(5, $this->height+2, "", "R", 0, 'C');
		$pdf->Ln();
		
		$this->tulis("   pemeriksaan atau keterangan lain di atas pelaksanaan kewajiban :","L",$pdf);
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$indent = $this->lengthCell / 30;
		
		$pdf->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height + 2, "   Ayat Pajak", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height + 2, ": " /*. $data["ayat"]*/, "R", 0, 'L');
		$pdf->Ln($this->height - 4);
		
		
		// Ayat Pajak
		$pdf->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		if(!empty($data["nomor_ayat"])) {
			$arr_ayat = str_split($data["nomor_ayat"]);
		} else {
			$arr_ayat = array();
			$this->kotak(1, 45, 1," - ",$pdf);
		}		
		//$this->kotak(1, 34, 6, "");
		for($i = 0; $i < count($arr_ayat); $i++) {
			if($arr_ayat[$i] != " ")
				$this->kotak(1, 45, 1,$arr_ayat[$i],$pdf);
			else
				$this->kotakKosong(1, 34, 1,$pdf);
		}
		$pdf->Ln();
		// ==========
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "   Nama Pajak", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": ".$data["jenis_pajak"], "R", 0, 'L');
		$pdf->Ln();
		
		$this->tulis("II. Dari pemeriksaan atau keterangan lain tersebut di atas, perhitungan jumlah yang masih harus dibayar adalah sebagai berikut:", "L",$pdf);
		
		$lbodyx1 = $lbody1 / 2;
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "    1. Dasar Pengenaan", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["total_trans_amount"],2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "R", 0, 'R');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "    2. Pajak yang Terutang", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["debt_vat_amt"],2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "R", 0, 'R');
		$pdf->Ln();
		
		$this->tulis("    3. Kredit Pajak", "L",$pdf);
		
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    a. Kompensasi kelebihan dari tahun sebelumnya", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["cr_adjustment"],2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "", 0, 'R');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    b. Setoran yang dilakukan", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["cr_payment"],2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "", 0, 'R');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    c. Lain-lain", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "B", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["cr_others"],2,",","."), "B", 0, 'R');
		$pdf->Cell(10, $this->height, "", "", 0, 'R');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		$jumno3 = $data["cr_others"] + $data["cr_payment"] + $data["cr_adjustment"];
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    d. Jumlah yang dapat dikreditkan (a + b + c)", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($jumno3,2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "", 0, 'R');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		
		
		// $this->tulis("4. Jumlah kekurangan pembayaran Pokok Pajak (2-3d)", "L");
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "    4. Jumlah kekurangan pembayaran Pokok Pajak (2-3d)", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["debt_vat_amt"] - $jumno3,2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "R", 0, 'R');
		$pdf->Ln();
		
		$this->tulis("    5. Sanksi Administrasi", "L",$pdf);
		
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    a. Bunga (Pasal 65 ayat(2)", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["total_penalty_amount"],2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "", 0, 'R');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    b. Kenaikan (Pasal 65 ayat (3)", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "B", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($data["db_increasing_charge"],2,",","."), "B", 0, 'R');
		$pdf->Cell(10, $this->height, "", "", 0, 'R');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		$jumno5 = $data["total_penalty_amount"] + $data["db_increasing_charge"];
		$pdf->Cell(10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2 - 10, $this->height, "    c. Jumlah sanksi administrasi (a + b)", "", 0, 'L');
		$pdf->Cell($lbody1, $this->height, "" , "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "B", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($jumno5,2,",","."), "B", 0, 'R');
		$pdf->Cell(10, $this->height, "", "R", 0, 'R');
		$pdf->Ln();
		
		$jumno4 = $data["debt_vat_amt"] - $jumno3;
		$total = $jumno4 + $jumno5;
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "    6. Jumlah yang masih harus dibayar (4 + 5c)", "", 0, 'L');
		$pdf->Cell($lbodyx1, $this->height, "Rp ", "", 0, 'L');
		$pdf->Cell($lbodyx1 - 10, $this->height, number_format($total,2,",","."), "", 0, 'R');
		$pdf->Cell(10, $this->height, "", "R", 0, 'R');
		$pdf->Ln();
		
		$total = (isset($total)) ? abs($total) : 0;
		$hrf = "select replace(f_terbilang('". $total . "','IDR'), '  ', ' ') as dengan_huruf";
		$h=$this->db->query($hrf);
		$o=$h->row_array();	
		$huruf = $o['dengan_huruf'];
		
		$pdf->Cell($this->lengthCell, $this->height, "", "BLR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell(5, $this->height + 2, "", "BL", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height + 2, "Dengan huruf", "B", 0, 'L');
		$pdf->Cell($lbody3, $this->height + 2, "", "BR", 0, 'L');
		$pdf->Ln($this->height - 4);
		
		// Dengan huruf
		$pdf->Cell($lbody1 - 5, $this->height, "", "", 0, 'L');
		$this->kotak(25, 34, 1, $huruf,$pdf);
		$pdf->Ln();
		// ============
		
		$pdf->SetFont('Arial', 'U', 8);
		$pdf->Cell($lbody1, $this->height+1, "PERHATIAN:", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 8);
		$this->tulis("1. Harap penyetoran dilakukan melalui Kas Daerah atau tempat lain yang ditunjuk dengan menggunakan Surat Setoran Pajak Daerah (SSPD)", "L",$pdf);
		$this->tulis("2. Apabila SKPDKB ini tidak atau kurang dibayar setelah lewat waktu paling lama 15 hari kalender sejak SKPDKB ini diterbitkan dikenakan", "L",$pdf);
		$this->tulis("    sanksi administrasi berupa bunga sebesar 2% per bulan.", "L",$pdf);
		
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		//$pdf->Cell($lbody1 + 10, $this->height, "LOMBOK UTARA, " . Date("d M Y") /*. $data["tanggal"]*/, "R", 0, 'C');
		$pdf->Cell($lbody1 + 10, $this->height, "LOMBOK UTARA, " . $data["tgl_setllement"] /*. $data["tanggal"]*/, "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "a.n KEPALA BADAN PENDAPATAN DAERAH", "R", 0, 'C');
		$pdf->Ln();

		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "KEPALA BIDANG PAJAK PENDAFTARAN", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "Kabupaten Lombok Utara", "R", 0, 'C');
		$this->newLine();
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		//$pdf->Cell($lbody1 + 10, $this->height, "H. SONI BAKHTIYAR, S.Sos, M.Si", "R", 0, 'C');
		$pdf->Cell($lbody1+10, $this->height, "Drs. H. GUN GUN SUMARYANA", "R", 0, 'C');
		$pdf->Ln();

		$pdf->Cell($lbody3 - 10, $this->height, "", "BL", 0, 'L');
		//$pdf->Cell($lbody1 + 8, $this->height, "NIP. 19750625 199403 1 001", "BT", 0, 'C'); //isi nip
		$pdf->Cell($lbody1 + 8, $this->height, "NIP. 19700806 199101 1 001", "BT", 0, 'C'); //isi nip
		$pdf->Cell(2, $this->height, "", "BR", 0, 'L');
		$pdf->Ln($this->height + 4);
		
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell($this->lengthCell, $this->height, "覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧 Gunting di sini 覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧覧 ", "", 0, 'C');
		$pdf->SetFont('Arial', '', 8);		
		$pdf->Ln();
		$pdf->Cell($lbody1, $this->height, "", "TL", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "T", 0, 'C');
		$pdf->Cell($lbody1, $this->height, "No. SKPDKB : ".$data["order_no"], "TR", 0, 'L');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 11);
		$pdf->Cell($lbody1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "TANDA TERIMA", "", 0, 'C');
		$pdf->Cell($lbody1, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lbody1, $this->height, "     NPWPD", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": ".$data["npwd"], "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell($lbody1, $this->height, "     Nama", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": ".$data["wp_name"], "R", 0, 'L');
		$pdf->Ln();

		$pdf->Cell($lbody1, $this->height, "     Alamat", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": ".$data["wp_address_name"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "LOMBOK UTARA, " . Date("d M Y"), "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "Yang Menerima, ", "R", 0, 'C');
		$this->newLine();
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "BL", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "(............................................................)", "BR", 0, 'C');

		$pdf->Output();	
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



