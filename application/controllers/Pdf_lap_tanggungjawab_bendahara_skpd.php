<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Pdf_lap_tanggungjawab_bendahara_skpd extends CI_Controller{
	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode = "";
    var $paperWSize = 297;
    var $paperHSize = 210;
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

    function setCourier($pdf){
        $pdf->SetFont('Courier', 'B', 11);
    }

    function setTimes($pdf){
        $pdf->SetFont('Times', 'B', 11);
    }


	function pageCetak() {
        /**
         * Get Data
         */
        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $p_finance_period_code = getVarClean('p_finance_period_code','str','');
        $form_finance_period_id = getVarClean('form_finance_period_id','int',0);
        $form_year_code = getVarClean('form_year_code','str','');

        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $user_login = $userdata['app_user_name'];

       // echo($cusId); exit();

        $pdf = new FPDF('L','mm',array(215 ,330));
        $pdf->AliasNbPages();
        $pdf->AddPage("L");

        $period = $form_year_code."".$this->DateToString($p_finance_period_code);
        /*print_r($period) ;
        exit;
*/

        $sql = "SELECT * FROM f_laporan_pad_jenis_v2($p_year_period_id,'$period') as tbl (rc_pad_jenis_pajak)";
        $query = $this->db->query($sql);
        $items=$query->result_array();

        /*print_r($items);
        exit;
        */
        //$pdf->Image(getValByCode('LOGO'),25,12,25,25);
        
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->Cell(30, $this->height, "", "", 0, 'L');
        $pdf->Cell(80, $this->height, getValByCode('INSTANSI_1'), "", 0, 'C');
        $pdf->Cell(60, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        $pdf->Cell(30, $this->height, "", "", 0, 'L');
        $pdf->Cell(80, $this->height, strtoupper(getValByCode('INSTANSI_3')), "", 0, 'C');
        $pdf->Cell(60, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        $pdf->Cell(30, $this->height, "", "", 0, 'L');
        $pdf->Cell(80, $this->height, getValByCode('ALAMAT_6')." Telp.".getValByCode('ALAMAT_2')." Fax.".getValByCode('ALAMAT_4'), "", 0, 'C');
        $pdf->Cell(60, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        $pdf->Cell(30, $this->height, "", "", 0, 'L');
        $pdf->Cell(80, $this->height, "TANJUNG - KODE POS : 83352", "", 0, 'C');
        $pdf->Cell(60, $this->height, "", "", 0, 'L');
        $pdf->Ln();

        $pdf->Cell(30, $this->height, "", "B", 0, 'L');
        $pdf->Cell(100, $this->height, "", "B", 0, 'C');
        $pdf->Ln();
        
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell($this->lengthCell+30, $this->height, "LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENERIMAAN SKPD", "", 0, 'C');
        $this->newLine();
        $this->newLine();
        $pdf->Ln();


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($this->lengthCell, $this->height, "(SPJ PENDAFTARAN - ADMINISTRATIF)", "", 0, 'C');
        $this->newLine();
        $this->newLine();
        $pdf->Ln();

        $pdf->Cell($this->lengthCell-100, $this->height, "", "B", 0, 'L');
        $pdf->Cell(130, $this->height, "", "B", 0, 'C');
        $pdf->Ln();
        
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();

        $pdf->Cell(75, $this->height + 1, "SKPD", "", 0, 'L');  
        $pdf->Cell(30, $this->height + 1, ":", "", 0, 'C');
        $pdf->Cell(70, $this->height + 1, getValByCode('INSTANSI_1'), "", 0, 'L');
        $pdf->Cell(40, $this->height + 1, "", "", 0, 'C');
        $pdf->Ln();

        $pdf->Cell(75, $this->height + 1, "Pengguna Anggaran/Kuasa Pengguna Anggaran", "", 0, 'L');  
        $pdf->Cell(30, $this->height + 1, ":", "", 0, 'C');
        $pdf->Cell(70, $this->height + 1, "H. Zulfadli,S.E", "", 0, 'L');
        $pdf->Cell(40, $this->height + 1, "", "", 0, 'C');
        $pdf->Ln();

        $pdf->Cell(75, $this->height + 1, "Bendahara Penerimaan", "", 0, 'L');  
        $pdf->Cell(30, $this->height + 1, ":", "", 0, 'C');
        $pdf->Cell(150, $this->height + 1, "Dewi Cahyaning Candra", "", 0, 'L');
        $pdf->Cell(40, $this->height + 1, "Bulan : ".$p_finance_period_code, 0, 'L');
        $pdf->Ln();
        $pdf->Ln();

        $ltable = $this->lengthCell / 30;
        $ltable1 = $ltable * 1;
        $ltable3 = $ltable * 3;
        $ltable4 = $ltable * 2.6;
        $ltable16 = $ltable * 16;

        //isi kolom
        $pdf->SetFont('Arial', 'B', 8);
        $sepertiga = ($this->lengthCell - (($ltable1 * 2)+ ($ltable1 * 5.2) + ($ltable1 * 2.5)))/3;
        $pdf->SetWidths(array($ltable1 * 2, $ltable1 * 5.2, $ltable1 * 2.5, $sepertiga,$sepertiga, $sepertiga+30));
        $pdf->SetAligns(array("C", "C", "C", "C", "C", "C"));
        
        $pdf->RowMultiBorderWithHeight(array("Kode\nRekening",
                                              "Uraian",
                                              "Jumlah\nAnggaran",
                                              "Sampai dengan\nBulan Lalu",
                                              "Bulan Ini",
                                              "Sampai dengan\nBulan Ini",
                                              ),
                                        array('TLR',
                                              'TLR',
                                              'TLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR'
                                              )
                                              ,$this->height);
                                              
        $pdf->SetWidths(array(
            $ltable1 * 2, $ltable1 * 5.2, $ltable1 * 2.5, 
            $sepertiga/3*1,
            $sepertiga/3*1,
            $sepertiga/3*1,
            $sepertiga/3*1,
            $sepertiga/3*1,
            $sepertiga/3*1,
            $sepertiga/4*1.27,
            $sepertiga/4*1.27, 
            $sepertiga/4*1.27,
            $sepertiga/4*2.13
            ));
        $pdf->SetAligns(array("C", "C", "C", "C", "C", "C", "C", "C", "C", "C", "C", "C", "C"));
        
        $pdf->RowMultiBorderWithHeight(array("",
                                              "",
                                              "",
                                              "Penerimaan",
                                              "Penyetoran",
                                              "Sisa",
                                              "Penerimaan",
                                              "Penyetoran",
                                              "Sisa",
                                              "Jumlah\nAnggaran\nyang Ter-Realisasi",
                                              "Jumlah\nAnggaran\nyang Disetor",
                                              "Sisa yang\nBelum Disetor",
                                              "Sisa\nAnggaran yang\nBelum Ter-Realisasi\nPelampauan\nAnggaran",
                                              ),
                                        array('BLR',
                                              'BLR',
                                              'BLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR'
                                              )
                                              ,$this->height);
        
        $pdf->RowMultiBorderWithHeight(array("1",
                                              "2",
                                              "3",
                                              "4",
                                              "5",
                                              "6",
                                              "7",
                                              "8",
                                              "9",
                                              "10",
                                              "11",
                                              "12",
                                              "13",
                                              ),
                                        array('TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR'
                                              )
                                              ,$this->height);


        for ($i=0; $i <count($items) ; $i++) { 
            $pdf->SetWidths(array(
                $ltable1 * 2, $ltable1 * 5.2, $ltable1 * 2.5, 
                $sepertiga/3*1,
                $sepertiga/3*1,
                $sepertiga/3*1,
                $sepertiga/3*1,
                $sepertiga/3*1,
                $sepertiga/3*1,
                $sepertiga/4*1.27,
                $sepertiga/4*1.27, 
                $sepertiga/4*1.27,
                $sepertiga/4*2.13
                ));
            $pdf->SetAligns(array("R", "L", 'R','R','R','R','R','R','R','R','R','R','R'));
            $first_char = substr($items[$i]['rc_pad_jenis_pajak'], 0,1);
            $rc_pad_jenis_pajak = [];
            if ($first_char == '#') {
                $pdf->SetFont('arial', 'B',8);
                $rc_pad_jenis_pajak = substr($items[$i]['rc_pad_jenis_pajak'], 1);
            } else {
                $pdf->SetFont('arial', '',8);
                $rc_pad_jenis_pajak = $items[$i]['rc_pad_jenis_pajak'];
            }
            $pdf->RowMultiBorderWithHeight(array($rc_pad_jenis_pajak,$items[$i]['jenis_penerimaan'],number_format($items[$i]['jml_anggaran'], 2, ',', '.'),number_format($items[$i]['penerimaan_bln_lalu'], 2, ',', '.'),number_format($items[$i]['setoran_bln_lalu'], 2, ',', '.'),number_format($items[$i]['sisa_bln_lalu'], 2, ',', '.'),number_format($items[$i]['penerimaan_bln_ini'], 2, ',', '.'),number_format($items[$i]['setoran_bln_ini'], 2, ',', '.'),number_format($items[$i]['sisa_bln_ini'], 2, ',', '.'),number_format($items[$i]['jml_realisai'], 2, ',', '.'),number_format($items[$i]['jml_setor'], 2, ',', '.'),number_format($items[$i]['sisa_blm_setor'], 2, ',', '.'),number_format($items[$i]['sisa_blm_realisasi'], 2, ',', '.')),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),$this->height);
        }

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        //$pdf->Cell($lengthCell, $this->height, "Pencetak : " . $user_login, 0, 0, 'L');
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

    function DateToString($periode){
        $month = strtolower(substr($periode,0,strpos($periode, ' ')));
        $year = substr($periode,strpos($periode, ' '));
        $arrmonth1 = array('januari' => '01', 
                            'februari' => '02',
                            'maret' => '03',
                            'april' => '04',
                            'mei' => '05',
                            'juni' => '06',
                            'juli' => '07',
                            'agustus' => '08',
                            'september' => '09',
                            'oktober' => '10',
                            'november' => '11',
                            'desember' => '12');

        $arrmonth2 = array('january' => '01', 
                            'february' => '02',
                            'march' => '03',
                            'april' => '04',
                            'may' => '05',
                            'june' => '06',
                            'july' => '07',
                            'august' => '08',
                            'september' => '09',
                            'october' => '10',
                            'november' => '11',
                            'december' => '12');
        if((int)$year < 2017){
            return $arrmonth1[$month];
        }else{
            return $arrmonth2[$month];
        }
        
    }

}



