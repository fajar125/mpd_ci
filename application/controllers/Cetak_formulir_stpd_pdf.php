<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_formulir_stpd_pdf extends CI_Controller{

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

    function newLine($pdf){
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function pageCetak() {
		$t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
		if(empty($t_vat_setllement_id)) {
			echo "Tidak ada Data"; exit;
		}

		$sql = "select count(*)as ada from t_vat_penalty where t_vat_setllement_id = ".$t_vat_setllement_id;
		$output = $this->db->query($sql);
        $ada = $output->row_array()['ada'];
        /*if ($ada < 1){
        	echo "Tidak ada Denda"; exit;
        }*/

		$sql = "select value from p_global_param where code = 'ALAMAT_1'";
		$output = $this->db->query($sql);
        $ALAMAT_1 = $output->row_array()['value'];
        
        $sql = "select value from p_global_param where code = 'ALAMAT_2'";
		$output = $this->db->query($sql);
        $ALAMAT_2 = $output->row_array()['value'];

        $sql = "select value from p_global_param where code = 'ALAMAT_3'";
		$output = $this->db->query($sql);
        $ALAMAT_3 = $output->row_array()['value'];
        
        $sql = "select value from p_global_param where code = 'LOGO'";
		$output = $this->db->query($sql);
        $LOGO = $output->row_array()['value'];
        
        $sql = "select value from p_global_param where code = 'INSTANSI_1'";
		$output = $this->db->query($sql);
        $INSTANSI_1 = $output->row_array()['value'];
        
        $sql = "select value from p_global_param where code = 'INSTANSI_2'";
		$output = $this->db->query($sql);
        $INSTANSI_2 = $output->row_array()['value'];
		
		$sql1="select b.npwd,
					   to_char(a.start_penalty,'YYYY') as tahun,	
				       to_char(a.start_penalty,'DD-MON-YYYY')as start_penalty,
				       to_char(a.end_penalty,'DD-MON-YYYY')as end_penalty,	
				       a.month_qty,
				       a.penalty_pct,
				       a.penalty_amt,
				       company_brand as company_name,
				       brand_address_name||' '||brand_address_no as address_name,
					   d.vat_code,
					   e.order_no,
					   d.penalty_code as penalty_ayat,
				      --replace(f_terbilang(to_char(round(nvl(a.penalty_amt,0))),'IDR'), '  ', '') ||' '|| f_terbilang_abal_abal(to_char(nvl(a.penalty_amt,0)),'IDR') as dengan_huruf,
					  replace(f_terbilang(to_char(nvl(a.penalty_amt,0)),'IDR'), '   ', ' ') as dengan_huruf,
					  f.code as finance_period_code,
					  to_char(b.settlement_date,'DD MON YYYY')as settlement_date,
					  (select to_char(payment_date,'DD MON YYYY')
						from t_payment_receipt x,t_vat_setllement y
						where y.p_finance_period_id = b.p_finance_period_id 
							and y.t_cust_account_id = b.t_cust_account_id
							and x.t_vat_setllement_id = y.t_vat_setllement_id
							and y.p_settlement_type_id in (1,4)
					  ) as payment_date
				from t_vat_penalty a
				left join t_vat_setllement b on a.t_vat_setllement_id = b.t_vat_setllement_id
				left join t_cust_account c on b.t_cust_account_id = c.t_cust_account_id
				left join p_vat_type d on d.p_vat_type_id = c.p_vat_type_id 	
				left join t_customer_order e on b.t_customer_order_id = e.t_customer_order_id
				left join p_finance_period f on f.p_finance_period_id = b.p_finance_period_id
				left join t_payment_receipt g on g.t_vat_setllement_id = b.t_vat_setllement_id
				where a.t_vat_setllement_id = ".$t_vat_setllement_id;
		
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
		$pdf->AddPage('P',array(215,330));
		//$pdf->AddPage('P',array(210,296));

		$pdf->SetFont('helvetica', '', $_FONTSIZE);
		$pdf->SetRightMargin($_HEIGHT);
		$pdf->SetLeftMargin(12);

		$pdf->SetAutoPageBreak(false,0);

		$pdf->SetFont('Arial', '', 10);
		
		$pdf->Image($LOGO,12,12,20,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$pdf->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$pdf->Cell($lheader2, $this->height, "", "TR", 0, 'C');
		$pdf->Cell($lheader2, $this->height, "", "TR", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lheader3, $this->height, $INSTANSI_1, "R", 0, 'C');
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell($lheader2, $this->height, "STPD", "R", 0, 'C');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lheader1-2, $this->height, "", "L", 0, 'L');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lheader3+2, $this->height, $INSTANSI_2, "R", 0, 'C');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lheader2, $this->height, "(Surat Tagihan Pajak Daerah)", "R", 0, 'C');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader2, $this->height, "No. Urut", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lheader1, $this->height + 2, "", "L", 0, 'L');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lheader3, $this->height + 2, $ALAMAT_1, "R", 0, 'C');
		$pdf->Cell(2, $this->height + 2, "", "", 0, 'L');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lheader1 - 5, $this->height + 2, "Masa Pajak ", "", 0, 'L');
		$pdf->Cell($lheader1 + 3, $this->height + 2, ": " . $data["finance_period_code"], "R", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader2, $this->height + 2, "", "R", 0, 'C');
		$pdf->Ln($this->height-4);
		// No Urut
		$pdf->Cell($lheader2 + $lheader4 + 1.5, $this->height, "", "R", 0, 'C');


		$no_urt = str_split($data["order_no"]);
		$this->kotak(1, 34, 1, $no_urt[0], $pdf);
		$this->kotak(1, 34, 1, $no_urt[1], $pdf);
		$this->kotak(1, 34, 1, $no_urt[2], $pdf);
		$this->kotak(1, 34, 1, $no_urt[3], $pdf);
		$this->kotak(1, 34, 1, $no_urt[4], $pdf);
		$this->kotak(1, 34, 1, $no_urt[5], $pdf);
		$this->kotak(1, 34, 1, $no_urt[6], $pdf);
		$this->kotak(1, 34, 1, $no_urt[7], $pdf);
		$pdf->Ln();
		// =======
		
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lheader3, $this->height, $ALAMAT_2, "R", 0, 'C');
		$pdf->Cell(5, $this->height, "", "", 0, 'L');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lheader1 - 5, $this->height, "Tahun Pajak ", "", 0, 'L');
		$pdf->Cell($lheader1, $this->height, ": " . $data["tahun"], "R", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$pdf->Cell($lheader2, $this->height, "", "BR", 0, 'L');
		$pdf->Cell($lheader2, $this->height, "", "BR", 0, 'L');
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->SetFont('Arial', '', 10);
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Nama", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " . $data["company_name"], "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Alamat", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " . $data["address_name"], "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height + 2, "NPWPD", "", 0, 'L');
		$pdf->Cell($lbody1, $this->height + 2, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height + 2, "", "R", 0, 'L');
		$pdf->Ln($this->height-4);
		
		$pdf->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		$rep_npwd = str_replace(".", "", $data["npwd"]);
		$arr1 = str_split($rep_npwd);
		
		$this->kotak(1, 34, 1,$arr1[0], $pdf);
		$this->kotakKosong(1, 34, 1, $pdf);
		$this->kotak(1, 34, 1,$arr1[1], $pdf);
		$this->kotakKosong(1, 34, 1, $pdf);
		$this->kotak(1, 34, 1,$arr1[2], $pdf);
		$this->kotak(1, 34, 1,$arr1[3], $pdf);
		$this->kotak(1, 34, 1,$arr1[4], $pdf);
		$this->kotak(1, 34, 1,$arr1[5], $pdf);
		$this->kotak(1, 34, 1,$arr1[6], $pdf);
		$this->kotak(1, 34, 1,$arr1[7], $pdf);
		$this->kotak(1, 34, 1,$arr1[8], $pdf);
		$this->kotakKosong(1, 34, 1, $pdf);
		$this->kotak(1, 34, 1,$arr1[9], $pdf);
		$this->kotak(1, 34, 1,$arr1[10], $pdf);
		$this->kotakKosong(1, 34, 1, $pdf);
		$this->kotak(1, 34, 1,$arr1[11], $pdf);
		$this->kotak(1, 34, 1,$arr1[12], $pdf);
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Tanggal jatuh tempo", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " . $data["start_penalty"]." s/d ".$data["end_penalty"], "R", 0, 'L');
		
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "", "LBR", 0, 'L');
		$this->newLine($pdf);
		$this->tulis("I. Berdasarkan Pasal 67 ayat (1) Peraturan Daerah Nomor 20 Tahun 2011, telah dilakukan penelitian dan atau", "L", $pdf);
		$this->tulis("keterangan lain atas pelaksanaan kewajiban:", "L", $pdf);
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height + 2, "Ayat Pajak", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height + 2, "" /*. $data["ayat"]*/, "R", 0, 'L');
		$pdf->Ln($this->height - 4);
		
		// Ayat Pajak
		$pdf->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		$ayat_pajak = str_split($data["penalty_ayat"]);
		$this->kotak(1, 34, 1, $ayat_pajak[0], $pdf);
		$this->kotak(1, 34, 1, $ayat_pajak[1], $pdf);
		$this->kotak(1, 34, 1, $ayat_pajak[2], $pdf);
		$this->kotak(1, 34, 1, $ayat_pajak[3], $pdf);
		$this->kotak(1, 34, 1, $ayat_pajak[4], $pdf);
		$this->kotak(1, 34, 1, $ayat_pajak[5], $pdf);
		$pdf->Ln();
		// ==========
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height, "Nama Pajak", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " . $data["vat_code"], "R", 0, 'L');
		
		$this->newLine($pdf);
		$this->tulis("II. Dari penelitian dan/atau pemeriksaan lain tersebut di atas, penghitungan jumlah yang masih harus dibayar", "L", $pdf);
		$this->tulis("adalah sebagai berikut:", "L", $pdf);
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "1. Pajak yang kurang bayar", "", 0, 'L');
		$pdf->Cell($lbody1, $this->height, "Rp " /*. $data["ayat"]*/, "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "2. Sanksi administrasi bunga (Pasal 67 ayat (2)", "", 0, 'L');
		$pdf->Cell(6, $this->height, "Rp " , "B", 0, 'L');
		$pdf->Cell($lbody1-16, $this->height, $this->getNumberFormat($data["penalty_amt"],2), "B", 0, 'R');
		$pdf->Cell(10, $this->height, "" /*. $data["ayat"]*/, "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(5, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody3 - 5, $this->height, "3. Jumlah yang masih harus dibayar (1 + 2a)", "", 0, 'L');
		$pdf->Cell(6, $this->height, "Rp " , "", 0, 'L');
		$pdf->Cell($lbody1-16, $this->height,$this->getNumberFormat($data["penalty_amt"],2), "", 0, 'R');
		$pdf->Cell(10, $this->height, "" /*. $data["ayat"]*/, "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell($this->lengthCell, $this->height, "", "BLR", 0, 'L');
		$this->newLine($pdf);
		
		/*$pdf->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 5, $this->height + 2, "Dengan huruf", "", 0, 'L');
		$pdf->Cell($lbody3, $this->height + 2, "", "R", 0, 'L');
		$pdf->Ln($this->height - 4);
		
		// Dengan huruf
		$pdf->Cell($lbody1 - 5, $this->height, "", "", 0, 'L');
		$this->kotak(25, 34, 1, $data["dengan_huruf"]);
		$pdf->Ln();*/
		
		$pdf->SetWidths(array(5, $lbody1 - 5, $lbody3-5,5));
		$pdf->SetAligns(array("L",  "L", "C","C"));
		$pdf->RowMultiBorderWithHeight(
			array("",
				"Dengan huruf",
				$data["dengan_huruf"],
				""
			),
			array("L",
				"",
				"TBLR",
				"R"
			),
			$this->height
		);
		// ============
		
		$pdf->Cell($this->lengthCell, $this->height, "", "BLR", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'U', 10);
		$pdf->Cell($lbody1, $this->height, "PERHATIAN:", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 10);
		$this->tulis("1. Harap penyetoran dilakukan melalui Kas Daerah dengan menggunakan Surat Setoran Pajak Daerah (SSPD)", "L", $pdf);
		$this->tulis("2. Apabila STPD ini tidak atau kurang dibayar setelah lewat waktu paling lama 15 hari kalender sejak STPD ini", "L", $pdf);
		$this->tulis("diterbitkan / diterima dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan.", "L", $pdf);
		
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		
		$sql = "select f_encrypt_str('".$data["order_no"]."') AS enc_data";
		$output = $this->db->query($sql);
        $encImageData = $output->row_array()['enc_data'];

		$pdf->Image(base_url().'qrcode/generate-qr.php?param='.$encImageData,30,$pdf->getY(),25,0,'PNG');
	
		$tgl_surat = getVarClean('tgl_surat','str','');
		$tgl = date("d M Y");
		if ($tgl_surat=="tgl_bayar"){
			$tgl = $data["payment_date"];
		}
		if ($tgl_surat=="tgl_tap"){
			$tgl = $data["settlement_date"];
		}
		
		$pdf->Cell($lbody3 - 25, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 25, $this->height, "Bandung, " . $tgl /*. $data["tanggal"]*/, "R", 0, 'C');
		$pdf->Ln();
		
		
		$pdf->Cell($lbody3 - 25, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 25, $this->height, "a.n. KEPALA BADAN PENGELOLAAN PENDAPATAN DAERAH", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 25, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 25, $this->height, "Kepala Bidang Pajak Pendaftaran", "R", 0, 'C');
		$this->newLine($pdf);
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell($lbody3 - 25, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 25, $this->height, "Drs. H. GUN GUN SUMARYANA", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody3 - 22, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 20, $this->height, "NIP. 19700806 199101 1 001", "T", 0, 'C'); //isi nip
		$pdf->Cell(2, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "", "LBR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "Gunting di sini", "B", 0, 'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell($lbody3, $this->height, "", "LT", 0, 'L');
		$pdf->Cell($lbody1, $this->height, "No. STPD", "TR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($this->lengthCell, $this->height, "TANDA TERIMA", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody1, $this->height, "     Nama", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " .$data["company_name"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody1, $this->height, "     Alamat", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": " .$data["address_name"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody1, $this->height, "     NPWPD", "L", 0, 'L');
		$pdf->Cell($lbody3, $this->height, ": ". $data["npwd"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "Bandung, ..............................." . date("Y") /*. $data["tanggal"]*/, "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "Yang menerima, ", "R", 0, 'C');
		$this->newLine($pdf);
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "BL", 0, 'L');
		$pdf->Cell($lbody1 + 10, $this->height, "(....................................)", "BR", 0, 'C');

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



