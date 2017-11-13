<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_surat_pengukuhan_pdf extends CI_Controller{
	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode = "";
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

        $sql = "select
                c.wp_name,
                c.wp_address_name || ' ' || nvl(wp_address_no,' ') as wp_address_name,
                c.company_owner ,
                c.company_brand,
                c.npwpd,
                c.company_name,
                c.address_name || ' ' || nvl(address_no,' ') as company_address,
                c.address_name_owner ||nvl(address_no_owner,' ') as alamat_tinggal,
                c.brand_address_name ||nvl(brand_address_no,' ') as alamat_pajak ,
                c.brand_address_name || ' ' || nvl(brand_address_no,' ') as alamat_brand ,
                b.p_vat_type_id,
                type.vat_code,
                c.reg_letter_no,
                decode(c.p_hotel_grade_id,null,null,1,1,2,1,3,1,4,1,5,1,0) as klasifikasi,
                d.vat_code as detail_jenis_pajak,
                a.jenis_usaha
        from t_customer_order a,
                p_rqst_type b,
                t_vat_registration c,
                p_vat_type type,
                p_vat_type_dtl d
        where a.p_rqst_type_id = b.p_rqst_type_id
            and a.t_customer_order_id = c.t_customer_order_id
            and b.p_vat_type_id = type.p_vat_type_id
            and c.p_vat_type_dtl_id = d.p_vat_type_dtl_id
            and a.t_customer_order_id = ?";

        $output = $this->db->query($sql, array($t_customer_order_id));
        $data = $output->row_array();


        $pdf = new FPDF('P', 'mm', array(210,330));
        $startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX + 20;
        $pdf->AliasNbPages();
        $pdf->AddPage("P");

        // Set margins
		$pdf->SetLeftMargin(17);
		$pdf->SetRightMargin(15);

        // Judul
		for($i = 0; $i < 7; $i++){
			$pdf->Cell($lengthCell, $this->height, "", 0, 0, "C");
			$pdf->Ln();
		}
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell($lengthCell, $this->height, "SURAT PENGUKUHAN WAJIB PAJAK DAERAH", 0, 0, 'C');
		$pdf->Ln();

		$pdf->SetFont('Times', '', 11);
		$pdf->Cell($lengthCell, $this->height, "Nomor: 973/" . $data["reg_letter_no"]."/".str_ireplace('Pajak ','',$data['vat_code']) ."/Disyanjak", 0, 0, 'C');
		// Body Atas
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "                Berdasarkan Undang-undang Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah dan", 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "Peraturan Daerah Nomor 20 tahun 2011 tentang Pajak Daerah, dengan ini menyatakan bahwa:", 0, 0, 'L');

		// Form
		$pdf->Ln();
		$pdf->Ln();
		$formLen = $lengthCell / 3;
		$formLen1 = $formLen * 1;
		$formLen2 = $formLen * 2;
		$twelfth = $lengthCell / 12;
		$twelfth1 = $twelfth * 1;

		// Form 1. Wajib Pajak
		$pdf->SetFont('Times', 'B', 11);
		$pdf->Cell($formLen1, $this->height, "1. Wajib Pajak", 0, 0, 'L');
		$pdf->SetFont('Times', '', 11);
		$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
		$pdf->Cell($formLen2 - $twelfth1, $this->height, $data["wp_name"], 0, 0, 'L');


		// Form 2. NPWPD
		$pdf->Ln();
		$pdf->SetFont('Times', 'B', 11);
		$pdf->Cell($formLen1, $this->height, "2. Nomor Pokok Wajib Pajak Daerah", 0, 0, 'L');
		$pdf->SetFont('Times', '', 11);
		$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');

		$newstr = substr_replace($data["npwpd"],'.', 2, 0);
		$newstr = substr_replace($newstr,'.', 10, 0);
		$newstr = substr_replace($newstr,'.', 13, 0);
		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell($formLen2 - $twelfth1, $this->height, $newstr, 0, 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Times', 'B', 11);
		$pdf->Cell($formLen1, $this->height, "    (NPWPD)", 0, 0, 'L');


		if(empty($data['company_name']) or $data['company_name'] == '-' or $data['company_name'] == 'A' or strlen($data['company_name']) < 3 ) {
			//PERORANGAN

			/*// Form 3. Nama Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "3. Nama Merek Dagang", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_brand"], 0, 0, 'L');

			// Form 4. Alamat Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "4. Alamat Lokasi Usaha", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["alamat_brand"], 0, 0, 'L');
			*/

			// Form 5. Alamat Wajib Pajak
			$pdf->Ln();
			$pdf->SetFont('Times', 'B', 11);
			$pdf->Cell($formLen1, $this->height, "5. Alamat Wajib Pajak", 0, 0, 'L');
			$pdf->SetFont('Times', '', 11);
			$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$pdf->Cell($formLen2 - $twelfth1, $this->height, $data["wp_address_name"], 0, 0, 'L');

			// Form 6. Jenis Pajak
			$pdf->Ln();
			$pdf->SetFont('Times', 'B', 11);
			$pdf->Cell($formLen1, $this->height, "6. Jenis Pajak", 0, 0, 'L');
			$pdf->SetFont('Times', '', 11);
			$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');


		} else { //PERUSAHAAN

			/*// Form 3. Nama Badan/Perusahaan
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "3. Nama Badan/Perusahaan", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_name"], 0, 0, 'L');


			// Form 4. Nama Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "4. Nama Merek Dagang", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_brand"], 0, 0, 'L');
			*/
			// Form 5. Alamat Merek Dagang
			$pdf->Ln();
			$pdf->SetFont('Times', 'B', 11);
			$pdf->Cell($formLen1, $this->height, "5. Alamat Lokasi Usaha", 0, 0, 'L');
			$pdf->SetFont('Times', '', 11);
			$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$pdf->Cell($formLen2 - $twelfth1, $this->height, $data["alamat_brand"], 0, 0, 'L');


			// Form 6. Alamat Wajib Pajak
			$pdf->Ln();
			$pdf->SetFont('Times', 'B', 11);
			$pdf->Cell($formLen1, $this->height, "6. Alamat Wajib Pajak", 0, 0, 'L');
			$pdf->SetFont('Times', '', 11);
			$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$pdf->Cell($formLen2 - $twelfth1, $this->height, $data["wp_address_name"], '', 0, 'L');

			// Form 7. Alamat Badan/Perusahaan
			$pdf->Ln();
			$pdf->SetFont('Times', 'B', 11);
			$pdf->Cell($formLen1, $this->height, "7. Alamat Badan/Perusahaan", 0, 0, 'L');
			$pdf->SetFont('Times', '', 11);
			$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$pdf->Cell($formLen2 - $twelfth1, $this->height, $data["company_address"], 0, 0, 'L');


			// Form 8. Jenis Pajak
			$pdf->Ln();
			$pdf->SetFont('Times', 'B', 11);
			$pdf->Cell($formLen1, $this->height, "8. Jenis Pajak", 0, 0, 'L');
			$pdf->SetFont('Times', '', 11);
			$pdf->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
		}

		// Form 8. Jenis Pajak -> Kotak Pilihan
		$kotakLen = ($formLen2 - $twelfth1) / 20;
		$kotakLen1 = $kotakLen * 1;
		$kotakLen3 = $kotakLen * 3;
		$kotakLen9 = $kotakLen * 9;

		$pdf->SetFont('Times', 'B', 11);

		$hotel = " ";
		$restoran = " ";
		$hiburan = " ";
		$parkir = " ";
		$ppj = " ";
		$bphtb = " ";

		switch($data["p_vat_type_id"]){
			case 1: $hotel = "X"; break;
			case 2: $restoran = "X"; break;
			case 3: $hiburan = "X"; break;
			case 4: $parkir = "X"; break;
			case 5: $ppj = "X"; break;
			case 6: $bphtb = "X"; break;
		}

		$bintang = " ";
		$melati = " ";
		$losmen = " ";
		$detail_bintang = array();
		$detail_melati = array();
		$detail_losmen = array();
		if(strpos(strtolower($data["detail_jenis_pajak"]), "bintang") !== false){ //HOTEL BINTANG X
			preg_match("/\d+/", $data["detail_jenis_pajak"], $detail_bintang);
			$bintang = "X";
			//$bintang = $detail_bintang[0];
		}
		else if(strpos(strtolower($data["detail_jenis_pajak"]), "melati") !== false){ //HOTEL MELATI X
			preg_match("/\d+/", $data["detail_jenis_pajak"], $detail_melati);
			//$melati = $detail_melati[0];
			$melati = "X";
		}
		else if(strpos(strtolower($data["detail_jenis_pajak"]), "rumah kos") !== false){ //HOTEL MELATI X
			preg_match("/\d+/", $data["detail_jenis_pajak"], $detail_losmen);
			//$losmen = $detail_losmen[0];
			$losmen = "X";
			$hotel=" ";
		}

		// switch($data["klasifikasi"]){
			// case 1: $bintang = "X"; break;
			// case 0: $melati = "X"; break;
		// }

		// if(is_null($data["klasifikasi"])){
			// $bintang = " ";
			// $melati = " ";
		// }

		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 1
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$parkir]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9, $this->height, " Pajak Parkir", "", 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[ ]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9, $this->height, " Pajak Reklame", "", 0, 'L');

		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 2
		$pdf->Ln();
		$pdf->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$hiburan]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9, $this->height, " Pajak Hiburan", "", 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$ppj]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9, $this->height, " Pajak Penerangan Jalan", "", 0, 'L');

		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 3
		$pdf->Ln();
		$pdf->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$restoran]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9 * 2 + $kotakLen1, $this->height, " Pajak Restoran/Rumah Makan", "", 0, 'L');

		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 4
		$pdf->Ln();
		$pdf->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$hotel]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9 + 8, $this->height, " Pajak Hotel: Klasifikasi: Bintang", "", 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$bintang]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen3 - 3, $this->height, "  Melati", "", 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$melati]", "", 0, 'L');

		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 5
		$pdf->Ln();
		$pdf->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$pdf->SetCourier();
		$pdf->Cell($kotakLen1, $this->height, "[$losmen]", "", 0, 'L');
		$pdf->SetTimes();
		$pdf->Cell($kotakLen9 * 2 + $kotakLen1, $this->height, " Pajak Sewa Menyewa/Kontrak Rumah dan/atau", "", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($formLen1 + $twelfth1, $this->height, "", 0, 0, 'L');
		$pdf->Cell($kotakLen1, $this->height, "", "", 0, 'L');
		$pdf->Cell($kotakLen9 * 2 + $kotakLen1, $this->height, " Bangunan", "", 0, 'L');

		// Body Bawah
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Times', '', 11);
		$pdf->Cell($lengthCell, $this->height, "telah terdaftar dan dikukuhkan dengan NPWPD ".$data["npwpd"].".", 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "                Dengan terbitnya surat ini, maka dalam melaksanakan hak dan kewajiban yang berkenaan dengan", 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "Pajak Daerah wajib mencantumkan NPWPD.", 0, 0, 'L');

		// Signature
		$pdf->Ln();
		$pdf->Ln();
		$sigLen = $lengthCell / 2;
		$sigLen1 = $sigLen * 1;
		$sigLen2 = $sigLen * 2;

		$tgl = getVarClean('tgl', 'str','');
		$pdf->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		if ($tgl == ''){
			$pdf->Cell($sigLen1, $this->height, getValByCode('ALAMAT_3').", " . date("j F Y"), 0, 0, 'C');
		}else{
			$pdf->Cell($sigLen1, $this->height, getValByCode('ALAMAT_3').", ".$tgl , 0, 0, 'C');
		}
		$pdf->Ln();

		$pdf->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$pdf->SetFont('Times', 'B', 11);
		$pdf->Cell($sigLen1, $this->height, "a.n. BUPATI ".strtoupper(getValByCode('ALAMAT_3')), 0, 0, 'C');
		$pdf->Ln();

		$pdf->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($sigLen1, $this->height, "Kepala ".getValByCode('INSTANSI_2'), 0, 0, 'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();

		$pdf->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($sigLen1, $this->height, "Drs. PRIANA WIRASAPUTRA, MM", 0, 0, 'C');
		$pdf->Ln();

		$pdf->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$pdf->SetFont('Times', '', 11);
		$pdf->Cell($sigLen1, $this->height, "Pembina Utama Muda", 0, 0, 'C');
		$pdf->Ln();

		$pdf->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$pdf->Cell($sigLen1, $this->height, "NIP. 19600308 198503 1 007", 0, 0, 'C');

		// Tembusan

		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Times', 'BU', 10);
		$pdf->Cell($lengthCell / 10, $this->height, "Tembusan,", 0, 0, 'L');
		$pdf->SetFont('Times', '', 10);
		$pdf->Cell($lengthCell - ($lengthCell / 10), $this->height, "disampaikan kepada Yth:", 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell($lengthCell, $this->height, "1. Bapak Bupati ".getValByCode('ALAMAT_3')." (sebagai laporan);", 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "2. Bapak Wakil Walikota ".getValByCode('ALAMAT_3')." (sebagai laporan);", 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "3. Bapak Sekretaris Daerah Kabupaten ".getValByCode('ALAMAT_3')." (sebagai laporan);", 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lengthCell, $this->height, "4. Arsip.", 0, 0, 'L');
		$pdf->Ln();

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



