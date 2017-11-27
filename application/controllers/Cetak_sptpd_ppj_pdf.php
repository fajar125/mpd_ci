<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_sptpd_ppj_pdf extends CI_Controller{
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 203.2;
	var $paperHSize = 330.2;
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
        $pdf = new FPDF('P', 'mm', array(203.2,330.2));
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function pageCetak() {

		$t_vat_setllement_id = getVarClean('t_vat_setllement_id','str',"");
		if (empty($t_vat_setllement_id)){
			echo "Data Tidak Ditemukan";
			exit;
		}

		$data = array();

		//get global param
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
        
		
        $sql = "SELECT a.*, wp_kota FROM v_vat_setllement a 
				LEFT JOIN v_cust_account_update b on a.t_cust_account_id=b.t_cust_account_id
				WHERE t_vat_setllement_id = ?";      
        $output = $this->db->query($sql, array($t_vat_setllement_id));
        $data = $output->row_array();

		$items = $data;

		$pdf = new FPDF('P', 'mm', array(203.2,330.2));

		$pdf->AliasNbPages();
		$pdf->AddPage("P");
		$startY = $pdf->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;				
		$pdf->SetFont('Arial', '', 10);
		
		$lengthJudul1 = ($lengthCell * 2) / 10 - 10;
		$lengthJudul2 = ($lengthCell * 4) / 10 + 10;
		$lengthJudul3 = ($lengthCell * 4) / 10;
		$leng1 = ($lengthJudul3 * 3) / 10;
		$leng2 = ($lengthJudul3 * 7) / 10;
		
		$pdf->Image($LOGO,12,13,25,25);
		// $pdf->Cell($lengthCell, $this->height, "2.	BENTUK SURAT PEMBERITAHUAN PAJAK DAERAH UNTUK PAJAK HIBURAN", 0, 0, 'L');
		// $this->Ln(6);
		$pdf->Cell($lengthJudul1, $this->height, "", "LT", 0, 'C');
		$pdf->Cell($lengthJudul2, $this->height, "", "TR", 0, 'R');
		$pdf->Cell($lengthJudul3, $this->height, "", "TR", 0, 'R');
		$pdf->Ln();
		$pdf->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lengthJudul2, $this->height, $INSTANSI_1, "R", 0, 'C');
		$pdf->Cell($leng1, $this->height, " No. SPTPD", 0, 0, 'L');
		$pdf->Cell($leng2, $this->height, ": ".$data["doc_no"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lengthJudul2, $this->height, $INSTANSI_2, "R", 0, 'C');
		$pdf->Cell($leng1, $this->height, " Masa Pajak", 0, 0, 'L');
		$pdf->Cell($leng2, $this->height, ": ".$data["finance_period_code"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lengthJudul2, $this->height, $ALAMAT_1, "R", 0, 'C');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($leng1, $this->height, " Tahun Pajak", 0, 0, 'L');
		$pdf->Cell($leng2, $this->height, ": ".$data["tahun"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lengthJudul2, $this->height, $ALAMAT_2, "R", 0, 'C');
		$pdf->Cell($lengthJudul3, $this->height, "", "R", 0, 'R');
		$pdf->Ln();
		$pdf->Cell($lengthJudul1, $this->height, "", "LB", 0, 'C');
		$pdf->Cell($lengthJudul2, $this->height, "", "RB", 0, 'R');
		$pdf->Cell($lengthJudul3, $this->height, "", "RB", 0, 'R');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "SPTPD", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "(SURAT PEMBERITAHUAN PAJAK DAERAH)", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "PAJAK PENERANGAN JALAN", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'C');
		$pdf->Ln();
		
		$kepada1 = ($lengthCell * 10) / 15;
		$kepada2 = ($lengthCell * 5) / 15;
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($kepada1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kepada2, $this->height, "Kepada Yth :", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kepada1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kepada2, $this->height, $data["wp_name"], "R", 0, 'L');
		$pdf->Ln();
		$spasi = ($kepada1 * 1) / 51;
		$npwd1 = ($kepada1 * 3) / 51;
		$npwd2 = ($kepada1 * 2) / 51;
		$npwd3 = ($kepada1 * 3) / 51;
		$npwd4 = ($kepada1 * 2) / 51;
		$npwd5 = ($kepada1 * 3) / 51;
		$npwd6 = ($kepada1 * 3) / 51;
		$npwd7 = ($kepada1 * 3) / 51;
		$npwd8 = ($kepada1 * 3) / 51;
		$npwd9 = ($kepada1 * 3) / 51;
		$npwd10 = ($kepada1 * 3) / 51;
		$npwd11 = ($kepada1 * 3) / 51;
		$npwd12 = ($kepada1 * 2) / 51;
		$npwd13 = ($kepada1 * 3) / 51;
		$npwd14 = ($kepada1 * 3) / 51;
		$npwd15 = ($kepada1 * 2) / 51;
		$npwd16 = ($kepada1 * 3) / 51;
		$npwd17 = ($kepada1 * 3) / 51;
		$npwd18 = ($kepada1 * 3) / 51;
		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($kepada1, $this->height, " NPWPD.", "L", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell($kepada2, $this->height, $data["wp_address_name"], "R", 0, 'L');
		$pdf->Ln();
		//npwd
		//$pdf->Cell($kepada1, $this->height, "", "L", 0, 'C');
		$rep_npwd = str_replace(".","",$data["npwd"]);
		$arr1 = str_split($rep_npwd);
		
		$pdf->Cell($spasi, $this->height, "", "L", 0, 'C');
		$pdf->Cell($npwd1, $this->height, $arr1[0], 1, 0, 'C');
		$pdf->Cell($npwd2, $this->height, "", 0, 0, 'C');
		$pdf->Cell($npwd3, $this->height, $arr1[1], 1, 0, 'C');
		$pdf->Cell($npwd4, $this->height, "", 0, 0, 'C');
		$pdf->Cell($npwd5, $this->height, $arr1[2], 1, 0, 'C');
		$pdf->Cell($npwd6, $this->height, $arr1[3], 1, 0, 'C');
		$pdf->Cell($npwd7, $this->height, $arr1[4], 1, 0, 'C');
		$pdf->Cell($npwd8, $this->height, $arr1[5], 1, 0, 'C');
		$pdf->Cell($npwd9, $this->height, $arr1[6], 1, 0, 'C');
		$pdf->Cell($npwd10, $this->height, $arr1[7], 1, 0, 'C');
		$pdf->Cell($npwd11, $this->height, $arr1[8], 1, 0, 'C');
		$pdf->Cell($npwd12, $this->height, "", 0, 0, 'C');
		$pdf->Cell($npwd13, $this->height, $arr1[9], 1, 0, 'C');
		$pdf->Cell($npwd14, $this->height, $arr1[10], 1, 0, 'C');
		$pdf->Cell($npwd15, $this->height, "", 0, 0, 'C');
		$pdf->Cell($npwd16, $this->height, $arr1[11], 1, 0, 'C');
		$pdf->Cell($npwd17, $this->height, $arr1[12], 1, 0, 'C');
		$pdf->Cell($npwd18, $this->height, "", 0, 0, 'C');
		$pdf->Cell($kepada2, $this->height, "di ".$data["wp_kota"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LRB", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lengthCell, $this->height, "PERHATIAN  :", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "1.	Harap diisi dalam rangkap (5) ditulis dengan huruf CETAK.", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "2.	Beri nomor pada kotak yang tersedia untuk jawaban yang diberikan", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "3.	Setelah diisi dan ditandatangani harap diserahkan kembali kepada Dinas Pelayanan Pajak paling lambat 15 hari Kalender", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "4.	Keterlambatan Penyerahan dari tanggal tersebut di atas akan dilakukan Penerbitan Surat Teguran.", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LRB", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lengthCell, $this->height, "A. DIISI OLEH WAJIB PAJAK / PENANGGUNG PAJAK", 1, 0, 'C');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'C');
		$pdf->Ln();
		//kelas Hotel
		$kelas1 = ($lengthCell * 3) / 16;
		$kelas2 = ($lengthCell * 3) / 16;
		$kelas3 = ($lengthCell * 10) / 16;
		
		
		$kolkel1 = ($kelas2 * 2)/10;
		$kolkel2 = ($kelas2 * 2)/10;
		$kolkel3 = ($kelas2 * 2)/10;
		$spc = ($kelas2 * 4)/10;						
		
		$kel1 = ($lengthCell * 5) / 16;
		$kel2 = ($lengthCell * 3) / 16;
		$kel3 = ($lengthCell * 3) / 16;
		$kel4 = ($lengthCell * 5) / 16;
		
		$spcs = ($kel2 * 6)/10;
		$kela1 = ($kel2 * 2)/10;
		$kela2 = ($kel2 * 2)/10;		
		$pdf->Cell($kel1, $this->height, " 1. Menggunakan Kas Register", "L", 0, 'L');
		$pdf->Cell($spcs, $this->height, "", 0, 0, 'L');
		$pdf->Cell($kela1, $this->height, "", 1, 0, 'C');//isi
		$pdf->Cell($kela2, $this->height, "", 0, 0, 'C');		
		$pdf->Cell($kel3, $this->height, "1.  Ya", 0, 0, 'L');
		$pdf->Cell($kel4, $this->height, "2.  Tidak", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kel1, $this->height, " 2. Mengadakan pembukuan/pencetakan", "L", 0, 'L');
		$pdf->Cell($spcs, $this->height, "", 0, 0, 'L');
		$pdf->Cell($kela1, $this->height, "", 1, 0, 'C');//isi
		$pdf->Cell($kela2, $this->height, "", 0, 0, 'C');	
		$pdf->Cell($kel3, $this->height, "1.  Ya", 0, 0, 'L');
		$pdf->Cell($kel4, $this->height, "2.  Tidak", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kel1, $this->height, " 3. Mengadakan Bon", "L", 0, 'L');
		$pdf->Cell($spcs, $this->height, "", 0, 0, 'L');
		$pdf->Cell($kela1, $this->height, "", 1, 0, 'C');//isi
		$pdf->Cell($kela2, $this->height, "", 0, 0, 'C');	
		$pdf->Cell($kel3, $this->height, "1.  Ya", 0, 0, 'L');
		$pdf->Cell($kel4, $this->height, "2.  Tidak", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lengthCell, $this->height, "B. DIISI OLEH WAJIB PAJAK / PENANGGUNG PAJAK SELF ASSESMENT", 1, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 9);
		$kol1 = ($lengthCell * 1) / 20;
		$kol2 = ($lengthCell * 9) / 20;
		$kol3 = ($lengthCell * 10) / 20;
		
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "1.", "L", 0, 'C');
		$pdf->Cell($kol2+$kol3, $this->height, "Jumlah Pembayaran dan Pajak Terutang untuk Masa Pajak sebelumnya (akumulasi dari awal Masa Pajak dalam", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2+$kol3, $this->height, "Tahun Pajak Tertentu)", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "a. Masa Pajak", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": Tgl..........................s/d Tgl..........................", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "b. Dasar Pengenaan (Jumlah pembayaran yang", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": Rp............................................................", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "    diterima)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "c. Tarif Pajak (sesuai Perda)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": ...............%", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "d. Pajak terutang  (b x c)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": Rp............................................................", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "2.", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "Jumlah Pembayaran dan Pajak Terutang untuk Masa Pajak sekarang (lampiran foto copy dokumen)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "a. Masa Pajak", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": Tgl. ".$data["start_date_txt"]." s/d Tgl. ".$data["end_date_txt"], "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "b. Dasar Pengenaan (Jumlah pembayaran yang", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": Rp. ".number_format($data["total_trans_amount"],2,",","."), "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "    diterima)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "c. Tarif Pajak (sesuai Perda)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": 10%", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kol1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kol2, $this->height, "d. Pajak terutang  (b x c)", 0, 0, 'L');
		$pdf->Cell($kol3, $this->height, ": Rp. ".number_format($data["total_vat_amount"],2,",","."), "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LRB", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lengthCell, $this->height, "C. PERNYATAAN", 1, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
		
		$kolm1 = ($lengthCell * 1) / 40;
		$kolm2 = ($lengthCell * 18) / 40;
		$kolm3 = ($lengthCell * 20) / 40;
		$kolm4 = ($lengthCell * 1) / 40;
		$pdf->Cell($kolm1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm2+$kolm3+$kolm4, $this->height, "Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kolm1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm2+$kolm3+$kolm4, $this->height, "yang berlaku, saya atau yang saya beri kuasa menyalakan bahwa apa yang telah kami beritahukan tersebut di atas beserta", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kolm1, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm2+$kolm3+$kolm4, $this->height, "lampiran-lampiran adalah benar, lengkap dan jelas", "R", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm3+$kolm4, $this->height, "................................................................, tahun ...........", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm3+$kolm4, $this->height, "Wajib Pajak/Penanggung Pajak", "R", 0, 'C');
		$pdf->Ln();
		//barcode
		//$pdf->Image(base_url().'qrcode/generate-qr.php?param='.$data["barcode"],135,$pdf->getY(),25,0,'PNG');
		$barcode = $data['npwd'].'_'.$data['finance_period_code'].'_'.$data['total_vat_amount'];
		$barcode = preg_replace('/\s+/', '', $barcode);
		$pdf->Image(base_url().'qrcode/generate-qr.php?param='.$barcode,135,$pdf->getY(),25,0,'PNG');
		$pdf->Cell($kolm1+$kolm2, $this->height*4, "", "L", 0, 'C');
		$pdf->Cell($kolm3+$kolm4, $this->height*4, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm3, $this->height, "", "B", 0, 'C');
		$pdf->Cell($kolm4, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($kolm3+$kolm4, $this->height, "Nama Jelas", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "", "LR", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lengthCell, $this->height, "D. DIISI OLEH PETUGAS PENERIMA", 1, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 9);
		
		$SpcCell = ($lengthCell * 1) / 41;
		$Cell1 = ($lengthCell * 12) / 41;
		$Cell2 = ($lengthCell * 16) / 41;
		$Cell3 = ($lengthCell * 12) / 41;
		
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell2, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell3, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "Diterima tanggal", 0, 0, 'L');
		$pdf->Cell($Cell2, $this->height, ": ", 0, 0, 'L');
		$pdf->Cell($Cell3, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "Nama Petugas", 0, 0, 'L');
		$pdf->Cell($Cell2, $this->height, ": ", 0, 0, 'L');
		$pdf->Cell($Cell3, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "NIP", 0, 0, 'L');
		$pdf->Cell($Cell2, $this->height, ": ", 0, 0, 'L');
		$pdf->Cell($Cell3, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell2, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell3, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell2, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell3, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell2, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell3, $this->height, "Ttd", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "L", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell2, $this->height, "", 0, 0, 'C');
		$pdf->Cell($Cell3, $this->height, "(..........................................................)", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($SpcCell, $this->height, "", "LB", 0, 'C');
		$pdf->Cell($Cell1, $this->height, "", "B", 0, 'C');
		$pdf->Cell($Cell2, $this->height, "", "B", 0, 'C');
		$pdf->Cell($Cell3, $this->height, "NIP.", "RB", 0, 'L');
		$pdf->Ln();
		$pdf->Output();	
	}
	

}



