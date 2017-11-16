<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_formulir_surat_teguran_pdf extends CI_Controller{

	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 241.3;
    var $paperHSize = 279.4;
    var $height = 5;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function __construct() {
        parent::__construct();
        //$this->formCetak();
        $pdf = new FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
        $this->startY = $pdf->GetY();
        $this->startX = $this->paperWSize-42;
        $this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function pageCetak() {
		
		$t_customer_order_id = getVarClean('t_customer_order_id','int',0);

		if($t_customer_order_id == 0){
			echo "DATA TIDAK ADA";
            exit();
		}

		$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin FROM p_global_param WHERE code = 'TTD KADIN'";
			
		$query = $this->db->query($ttd);
		$kadin = $query->row_array();

		$sql = "select * from f_debt_letter_print2(".$t_customer_order_id.") AS tbl (ty_debt_letter_list)
		LEFT JOIN t_cust_account as b ON tbl.t_cust_account_id = b.t_cust_account_id
		WHERE b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)";

		$query = $this->db->query($sql);
		$data = $query->result_array();
		
		//print_r($company_brand); exit();
		// echo $sql ;
		// exit();
		$pdf = new FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
		//print_r(count($data)); exit();
		for ($i=0; $i <count($data) ; $i++) { 
			# code...

			$pdf->AliasNbPages();
			$pdf->SetLeftMargin(10);
			$pdf->SetTopMargin(2);
			$pdf->AddPage("P");
			$pdf->AddFont('BKANT');
			
			$pdf->SetFont('BKANT', '', 12);
			
			$lheader = $this->lengthCell / 8;
			$lheader1 = $lheader * 1;
			$lheader2 = $lheader * 2;
			$lheader3 = $lheader * 3;
			$lheader4 = $lheader * 4;
			$lheader7 = $lheader * 7;
			
			$pdf->SetFont('Arial', 'B', 8);

			$pdf->Cell(8, 3, "", "", 0, 'L');
			$pdf->Cell(70, 3, "", "", 0, 'C');
			$pdf->Ln();
			
			//$pdf->SetFont('BKANT', '', 16);
			$pdf->Cell(8, 3, "", "", 0, 'L');
			$pdf->Cell(70, 3, "", "", 0, 'C');
			$pdf->Ln();
			
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(8, 3, "", "", 0, 'L');
			$pdf->Cell(70, 3, "", "", 0, 'C');
			$pdf->Ln();
			$pdf->SetFont('Arial', 'B', 6);
			$pdf->Cell(8, 3, "", "", 0, 'L');
			$pdf->Cell(70, 3, "", "", 0, 'C');
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell($lheader1, $this->height, "", "", 0, 'L');
			$pdf->Cell($lheader7, $this->height, "", "", 0, 'C');
			$pdf->Ln();
			$pdf->Cell($lheader1, $this->height, "", "", 0, 'L');
			$pdf->Cell($lheader7, $this->height, "", "", 0, 'C');
			$pdf->Ln();
			
			$pdf->Cell($this->lengthCell, $this->height, "", "TLR", 0, 'L');
			$pdf->Ln();
			
			$pdf->SetFont('BKANT', '', 12);
			$lbody = $this->lengthCell / 4;
			$lbody1 = $lbody * 1;
			$lbody2 = $lbody * 2;
			$lbody3 = $lbody * 3;

			$pdf->SetWidths(array(20,2,$this->lengthCell-22));
			$pdf->SetAligns(array("L","L","L"));
			$posy = $pdf->getY();
			
			if(!empty($letter_no)){
				$pdf->RowMultiBorderWithHeight(
					array("Nomor",
						":",
						/*$data["letter_no"]."-".$no_urut*/""
					),
					array("",
						"",
						""
					),
					3
				);
			}else{
				$pdf->RowMultiBorderWithHeight(
					array("Nomor",
						":",
						/*" - "*/""
					),
					array("",
						"",
						""
					),
					3
				);
			}
			$pdf->RowMultiBorderWithHeight(
				array("Perihal",
					":",
					"SURAT TEGURAN"
				),
				array("L",
					"",
					"R"
				),
				3
			);

			$pdf->setY($posy-3);
			$today = getdate();
			$lkepada = $this->lengthCell / 5;
			$lkepada2 = $lkepada * 2;
			$lkepada3 = $lkepada * 3;

		
			$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
			$pdf->Cell($lkepada2, $this->height, getValByCode('ALAMAT_3').", ".$data[$i]['letter_date_txt'], "R", 0, 'L');
			$pdf->Ln();

			$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
			$pdf->Cell($lkepada2, $this->height, "Kepada Yth,", "R", 0, 'L');
			$pdf->Ln();

			$pdf->SetAligns(array("L","L","L","L"));
			$pdf->SetWidths(array($lkepada3,22,2,63.7));

			$pdf->RowMultiBorderWithHeight(
				array("",
					"Pimpinan",
					":",
					$data[$i]['company_brand']
				),
				array("L",
					"",
					"",
					"R"
				),
				$this->height
			);
			
			$pdf->SetAligns(array("L","L","L","L"));
			$pdf->SetWidths(array($lkepada3,22,2,63.7));
			$pdf->RowMultiBorderWithHeight(
				array("",
					"NPWPD",
					":",
					$data[$i]['npwd']
				),
				array("L",
					"",
					"",
					"R"
				),
				$this->height/2
			);
			
			$pdf->SetWidths(array($lkepada3,$lkepada2));
			$pdf->SetAligns(array("L","L"));
			$pdf->RowMultiBorderWithHeight(
				array("",
					$data[$i]['brand_address_name'].' '.$data[$i]['brand_address_no']
				),
				array("L",
					"R"
				),
				$this->height
			);
			
			$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
			$pdf->Cell($lkepada2, $this->height, "Di ", "R", 0, 'L');
			$pdf->Ln();

			$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
			$pdf->Cell($lkepada2, $this->height, "          Tempat", "R", 0, 'L');
			$pdf->Ln();
			
			// $pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
			// $pdf->Cell($lkepada2, $this->height, "", "R", 0, 'C');
			// $pdf->Ln();
			$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
			$pdf->Cell($lkepada2, $this->height, "", "R", 0, 'C');
			$pdf->Ln();
			
			$pdf->SetFont('BKANT', '', 12);
			// $pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
			// $this->newLine();
			$pdf->Cell($this->lengthCell, $this->height, "SURAT TEGURAN ".$this->numberToRoman($data[$i]['sequence_no']), "LR", 0, 'C');
			$pdf->Ln();
			$this->newLine();
			
			$pdf->SetFont('BKANT', '', 12);
			/*$pdf->Cell($this->lengthCell, $this->height, "Nomor: ".$data["letter_no"], "LR", 0, 'C');
			$this->newLine();*/
			$pdf->SetWidths(array(10,204.3, 5));
			$pdf->RowMultiBorderWithHeight(array("",
					"Menurut pembukuan kami hingga saat ini Saudara masih mempunyai tunggakan Pajak sebagai berikut:",
					""
				),
				array("L",
					"",
					"R"
				),
				$this->height
			);
			//$this->newLine();
			// Tabel
			$ltable = ($this->lengthCell - 15) / 14;
			$ltable1 = $ltable * 1;
			$ltable2 = $ltable * 2;
			$ltable3 = $ltable * 3;
			$ltable6 = $ltable * 6;
			$ltable4 = $ltable * 4;
			
			$pdf->SetWidths(array(10, $ltable4, $ltable2, $ltable2, $ltable3, $ltable3, 5));
			$pdf->SetAligns(array("L", "C", "C", "C", "C", "C", "L"));
			
			$title_kolom4 = 'SPTPD';
			$title_kolom5 = 'TGL. SETOR';

			if( $data[$i]['sequence_no'] == 3) {
				$title_kolom4 = 'NO SKPDKB';
				$title_kolom5 = 'SKPDKB JABATAN';
			}

			$pdf->RowMultiBorderWithHeight(
				array("",
					"JENIS PAJAK",
					"TAHUN",
					"BULAN",
					$title_kolom4,
					$title_kolom5,
					""
				),
				array("LR",
					"TBLR",
					"TBLR",
					"TBLR",
					"TBLR",
					"TBLR",
					"LR"
				),
				$this->height
			);
			
			
			$pdf->SetWidths(array(10, $ltable4, $ltable2, $ltable2, $ltable3, $ltable3, 5));
			$pdf->SetAligns(array("L", "C", "C", "L", "C", "C", "L"));
			$tahun = explode(" ",$data[$i]['periode']);

			$bulan_periode = explode(",",$data[$i]['debt_period_code']);
			$bulan_string='';
			$j=0;
			foreach($bulan_periode as $item ){
				$bulan = explode(" ",$item);
				$bulan_string.= $bulan[0];
				$j++;
				if(!empty($bulan_periode[$j])){
					$bulan_string.="\n";
				}
			}

			if( $data[$i]['sequence_no'] == 3) {

				$pdf->RowMultiBorderWithHeight(
					array("",
						$data[$i]['vat_code'],
						$tahun[1],
						$bulan_string,
						$data[$i]['tap_no'],
						number_format($data[$i]['debt_amount'],0,",","."),
						""
					),
					array("LR",
						"TBLR",
						"TBLR",
						"TBLR",
						"TBLR",
						"TBLR",
						"LR"
					),
					$this->height
				);

			} else {
				$pdf->RowMultiBorderWithHeight(
					array("",
						$data[$i]['vat_code'],
						$tahun[1],
						$bulan_string,
						$data[$i]['tap_no'],
						"-",
						""
					),
					array("LR",
						"TBLR",
						"TBLR",
						"TBLR",
						"TBLR",
						"TBLR",
						"LR"
					),
					$this->height
				);
			}
			
			$lbody = $this->lengthCell / 4;
			$lbody1 = $lbody * 1;
			$lbody2 = $lbody * 2;
			$lbody3 = $lbody * 3;
			$data[$i]['terbilang']=trim($data[$i]['terbilang']);
			$pdf->Cell(20, $this->height, "", "L", 0, 'L');
			$pdf->Cell($lbody1 - 20,"", "", 0, 'L');	
			$pdf->Cell($lbody3, $this->height, "", "R", 0, 'L');
			$pdf->Ln();
			
			$this->tulis("Sampai saat ini belum melunasi pembayaran pajak.", "L", $pdf);
			$this->tulis("", "L", $pdf);
			$this->tulis("Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Undang-undang Nomor 28 Tahun", "FJ", $pdf);
			$this->tulis("2009 dan Peraturan Daerah Nomor 20 Tahun 2011 Ps 70, maka diminta kepada Saudara agar melunasi", "FJ", $pdf);
			$this->tulis("jumlah tunggakan dalam waktu 7 (tujuh) hari setelah Surat Teguran ini. Setelah batas waktu tersebut", "FJ", $pdf);
			$this->tulis("tindakan penagihan akan ditindaklanjuti dengan penyerahan Surat Paksa.", "L", $pdf);
			$this->tulis("", "L", $pdf);
			$this->tulis("Apabila saudara telah melaksanakan pembayaran pajak tersebut, kami mohon untuk dapat memperlihatkan", "FJ", $pdf);
			$this->tulis("SSPD yang telah divalidasi dengan melampirkan photo copy dokumen yang dimaksud.", "L", $pdf);
			$this->tulis("", "L", $pdf);
			$this->tulis("Demikian agar menjadi maklum, atas perhatian dan kerjasamanya kami ucapkan terima kasih.", "L", $pdf);
			
			// $pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			// $pdf->Ln();
			// $pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			// $pdf->Ln();
			$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			$pdf->Ln();
			
			$lbody = $this->lengthCell / 16;
			$lbody2 = $lbody * 2;
			$lbody4 = $lbody * 4;

			$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			$pdf->Ln();
			
			$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "Lombok Utara, " .$data[$i]['letter_date_txt'] /*. $data["tanggal"]*/, "", 0, 'C');
			$pdf->Cell($lbody2, $this->height, "", "R", 0, 'C');
			$pdf->Ln();
			
			$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "an. KEPALA ".getValByCode('INSTANSI_2'), "", 0, 'C');
			$pdf->Cell($lbody2, $this->height, "", "R", 0, 'C');
			$pdf->Ln();
			
			$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
			$pdf->Cell($lbody2, $this->height, "", "R", 0, 'C');
			$pdf->Ln();

			$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			$pdf->Ln();
			$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			$pdf->Ln();

			//$pdf->Image('../images/ttd_pa_gun_gun.jpg',$lbody2+$lbody4+$lbody4-20,168,$lbody4+48,20);
			//$pdf->Image('../images/ttd_pa_soni.jpg',$lbody2+$lbody4+$lbody4-20,168,$lbody4+48,20);

			$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
			$pdf->Cell($lbody4-5, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4+10, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody2-5, $this->height, "", "R", 0, 'C');
			$pdf->Ln();
			$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			$pdf->Ln();
			$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
			$pdf->Ln();
			
			/*if ($_SERVER['HTTP_HOST']=='172.16.20.1'){
				$pdf->Image('http://'.$_SERVER['HTTP_HOST'].'/include/qrcode/generate-qr.php?param='.
				str_replace(" ","-",$letter_date_txt)."_".
				$data["npwd"]."_".
				str_replace(" ","-",$periode)
				,15,170,25,25,'PNG');
			}else{
				$pdf->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.
				str_replace(" ","-",$letter_date_txt)."_".
				$data["npwd"]."_".
				str_replace(" ","-",$periode)
				,15,170,25,25,'PNG');
			}*/

			$pdf->Image(base_url().'/qrcode/generate-qr.php?param='.
			str_replace(" ","-",$data[$i]['letter_date_txt'])."_".
			$data[$i]['npwd']."_".
			str_replace(" ","-",$data[$i]['periode'])
			,28,168,25,25,'PNG');
			
			$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
			$pdf->Cell($lbody4-5, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4+10, $this->height, "Drs. H. GUN GUN SUMARYANA", "B", 0, 'C');
			//$pdf->Cell($lbody4+10, $this->height, "H. SONI BAKHTIAR, S.Sos, M.Si.", "B", 0, 'C');
			$pdf->Cell($lbody2-5, $this->height, "", "R", 0, 'C');
			$pdf->Ln();
			
			$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
			$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
			$pdf->Cell($lbody4 - 2, $this->height, "NIP. 19700806 199101 1 001", "", 0, 'C'); //isi nip
			//$pdf->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
			$pdf->Cell(2, $this->height, "", "", 0, 'L');
			$pdf->Cell($lbody2, $this->height, "", "R", 0, 'C');
			$pdf->Ln();
			
			$pdf->Cell(10, $this->height, "", "BL", 0, 'L');
			//$pdf->Cell($this->lengthCell - 10, $this->height, "*) Coret yang tidak perlu", "BR", 0, 'L');
			$pdf->Cell($this->lengthCell - 10, $this->height, "", "BR", 0, 'L');
		
		}

		$pdf->Output();
	}

	function tulis($text, $align, $pdf){
		$pdf->Cell(10, $this->height, "", "L", 0, 'C');
		$pdf->Cell(204.3, $this->height, $text, "", 0, $align, "", "");
		$pdf->Cell(5, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
	}

	function numberToRoman($num){
     // Make sure that we only use the integer portion of the value
		$n = intval($num);
		$result = '';

		// Declare a lookup array that we will use to traverse the number:
		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
		'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
		'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

		foreach ($lookup as $roman => $value){
			// Determine the number of matches
			$matches = intval($n / $value);

			// Store that many characters
			$result .= str_repeat($roman, $matches);

			// Substract that from the number
			$n = $n % $value;
		}

	// The Roman numeral should be built, return it
		return $result;
 	}
	

	

}



