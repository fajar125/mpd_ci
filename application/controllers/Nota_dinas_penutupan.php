<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Nota_dinas_penutupan extends CI_Controller{
	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode = "";
    var $paperWSize = 210;
    var $paperHSize = 297;
    var $height = 6;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

	function __construct() {
        parent::__construct();
        //$this->formCetak();
        $pdf = new FPDF();
        $this->startY = $pdf->GetY();
        $this->startX = $this->paperWSize-50;
        $this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF('P', 'mm', array(203.2,330.2));
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }


	function pageCetak() {

        /**
         * Get Data
         */
        $t_customer_order_id = getVarClean('CURR_DOC_ID','int',0);

        $sql = "select to_char(status_request_date,'dd-mm-yyyy')as status_request_date_2,* from t_cust_acc_status_modif a
            left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
            left join p_vat_type_dtl c on c.p_vat_type_dtl_id=b.p_vat_type_dtl_id
            left join t_customer d on d.t_customer_id = b.t_customer_id
            where a.t_customer_order_id = ? ";

        $output = $this->db->query($sql, array($t_customer_order_id));
        $data = $output->row_array();


        $pdf = new FPDF('P', 'mm', array(210,330));
        $startY = $pdf->GetY();
        $startX = $this->paperWSize-50;
        $lengthCell = $this->startX+20;
        $pdf->AliasNbPages();
        $pdf->AddPage("P");

        $lengthJudul1 = ($lengthCell * 1) / 6;
        $lengthJudul2 = ($lengthCell * 5) / 6;

        $pdf->Image(getValByCode('LOGO'), 15, 14, 25, 25);

        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $pdf->Cell($lengthJudul2, $this->height, getValByCode('INSTANSI_1'), "", 0, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Times', 'B', 18);
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $pdf->Cell($lengthJudul2, $this->height, getValByCode('INSTANSI_2'), "", 0, 'C');
        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell($lengthJudul1, $this->height, "", "B", 0, 'C');
        $pdf->Cell($lengthJudul2, $this->height, getValByCode('ALAMAT_5'), "B", 0, 'C');

        $pdf->Ln(10);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell($lengthCell, $this->height, "NOTA DINAS", "", 0, 'C');
        $pdf->Ln(10);

        //header nota
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell($lengthJudul1, $this->height, "Kepada         :", "", 0, 'L');
        $pdf->Cell($lengthJudul2, $this->height, "Yth. Bapak Kepala Badan Pendapatan Daerah Kabupaten Lombok Utara", "", 0, 'L');
        $pdf->Ln(6);

        $pdf->Cell($lengthJudul1, $this->height, "Dari              :", "", 0, 'L');
        $pdf->Cell($lengthJudul2, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'L');
        $pdf->Ln(6);

		$tgl = getVarClean('tgl', 'str','');
        $pdf->Cell($lengthJudul1, $this->height, "Tanggal        :", "", 0, 'L');
        if ($tgl == ''){
			$pdf->Cell($lengthJudul2, $this->height, date('d F Y'), "", 0, 'L');
		}else{
			$pdf->Cell($lengthJudul2, $this->height, $tgl, "", 0, 'L');
		}
        $pdf->Ln(6);

        $pdf->Cell($lengthJudul1, $this->height, "Nomor          :", "", 0, 'L');
        $pdf->Cell($lengthJudul2, $this->height, "973/               -Dafda/" . $this->romanNumerals(date("m")) . "/" . date("Y"), "", 0, 'L');
        $pdf->Ln(6);

        $pdf->Cell($lengthJudul1, $this->height, "Lampiran      :", "", 0, 'L');
        $pdf->Cell($lengthJudul2, $this->height, "1 (satu) berkas", "", 0, 'L');
        $pdf->Ln(6);

        $pdf->Cell($lengthJudul1, $this->height, "Perihal          :", "B", 0, 'L');
        $pdf->SetFont('Times', 'I', 12);
        $pdf->Cell($lengthJudul2, $this->height, "Permohonan Pencabutan dan Penutupan Nomor Pokok Wajib Pajak Daerah", "B", 0, 'L');
        $pdf->Ln(10);

        //Isi
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->MultiCell($lengthJudul2, $this->height, "Dipermaklumkan dengan hormat, berdasarkan Peraturan Bupati Lombok Utara Nomor 016 Tahun 2014 tentang Standar Operasional Prosedur Tata Cara Pemungutan Pajak Daerah, atas permohonan dari Wajib Pajak / Berita Acara dapat diusulkan pencabutan dan penutupan NPWPD dengan persyaratan sesuai ketentuan yang berlaku.", "", 'J');
        $pdf->Ln(6);

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        
		$pdf->MultiCell($lengthJudul2, $this->height, "Pada tanggal " .$data["status_request_date_2"]. ", telah diterima surat permohonan penutupan wajib pajak daerah / Berita Acara dengan data sebagai berikut : ", "", 'J');
		
		$pdf->Ln(6);

        //data wajib pajak
        $lengWP1 = $lengthJudul2 * 1/3;
        $lengWP2 = $lengthJudul2 * 2/3;
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "Nama Merk Dagang", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, ": ".$data["company_brand"], "", "", 'L');
        $pdf->Ln(5);

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "Alamat Usaha", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, ": ".$data["brand_address_name"]. " " . $data["brand_address_no"], "", "", 'L');
        $pdf->Ln(5);

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "NPWPD", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, ": ".$data["npwd"], "", "", 'L');
        $pdf->Ln(5);

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "Jenis Usaha", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, ": ".$data["vat_code"], "", "", 'L');
        $pdf->Ln(5);
        $pdf->Ln();

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->MultiCell($lengthJudul2, $this->height, "Sehubungan dengan permohonan tersebut diatas mohon kiranya Bapak berkenan untuk menandatangani Surat Pencabutan dan Penutupan NPWPD.", "", 'J');
        $pdf->Ln();

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->MultiCell($lengthJudul2, $this->height, "Demikian permohonan ini kami sampaikan, atas perhatian Bapak kami mengucapkan terima kasih.", "", 'J');
        $pdf->Ln();

        //TTD
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, "KEPALA BIDANG", "", "", 'C');
        $pdf->Ln();

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, "PAJAK PENDAFTARAN", "", "", 'C');
        $pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();

        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, "Drs. H. GUN GUN SUMARYANA", "", "", 'C');
        $pdf->Ln(6);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, "Pembina IV/a", "", "", 'C');
        $pdf->Ln(6);
        $pdf->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $pdf->Cell($lengWP1, $this->height, "", "", "", 'L');
        $pdf->Cell($lengWP2, $this->height, "NIP. 19700806 199101 1 001", "", "", 'C');
        $pdf->Ln(6);

        $pdf->Output();

	}

    function romanNumerals($num){
		$n = intval($num);
		$res = '';

		/*** roman_numerals array  ***/
		$roman_numerals = array(
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1);

		foreach ($roman_numerals as $roman => $number){
			/*** divide to get  matches ***/
			$matches = intval($n / $number);

			/*** assign the roman char * $matches ***/
			$res .= str_repeat($roman, $matches);

			/*** substract from the number ***/
			$n = $n % $number;
		}

		/*** return the res ***/
		return $res;
	}

}



