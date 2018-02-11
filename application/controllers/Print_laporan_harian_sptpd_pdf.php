<?php defined('BASEPATH') OR exit('No direct script access allowed');
//require('fpdf/fpdf.php');
require('fpdf/fpdf17/mc_table.php');
require('fpdf/invClassExtend.php');

class Print_laporan_harian_sptpd_pdf extends CI_Controller{
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
        $date_start_laporan = getVarClean('date_start_laporan','str','');
        $date_end_laporan  = getVarClean('date_end_laporan','str','');
        $p_vat_type_id = getVarClean('p_vat_type_id', 'int', 0);

        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $user_login = $userdata['app_user_name'];

        $ci->load->model('pelaporan/t_laporan_harian_sptpd');
        $table = $ci->t_laporan_harian_sptpd;

        $param_arr =  array('p_vat_type_id' => $p_vat_type_id,
                            'date_start_laporan' => $date_start_laporan,
                            'date_end_laporan' => $date_end_laporan);

        $data = $table->getData($param_arr);

        //$pdf = new FPDF();
        $pdf = new PDF_MC_Table();
        $_BORDER = 0;
        $_FONT = 'Times';
        $_FONTSIZE = 10;
        $size = $pdf->_getpagesize('Legal');
        $pdf->DefPageSize = $size;
        $pdf->CurPageSize = $size;
        $pdf->AddPage('Landscape', 'Legal');
        $pdf->SetFont('helvetica', '', $_FONTSIZE);
        $pdf->SetRightMargin(5);
        $pdf->SetLeftMargin(9);
        $pdf->SetAutoPageBreak(false,0);
     
        
        $pdf->SetFont('helvetica', '',12);
        $pdf->SetWidths(array(200));
        $pdf->ln(1);
        $pdf->RowMultiBorderWithHeight(array("LAPORAN PENCETAKAN HARIAN PENERIMAAN SPTPD"),array('',''),6);
        
        $pdf->SetWidths(array(40,200));
        $pdf->ln(4);
        
        $pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".$this->dateToString($param_arr['date_start_laporan'])." s/d ".$this->dateToString($param_arr['date_end_laporan'])),array('',''),6);
        
        $items=array();
        $pdf->SetFont('helvetica', '',10);
        $pdf->ln(2);
        $pdf->SetWidths(array(10,22,28,40,40,28,22,42,27,40,40));
        $pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->RowMultiBorderWithHeight(array("NO","TANGGAL","AYAT PAJAK","NAMA","ALAMAT","NPWPD","KOHIR","MASA PAJAK","JENIS","OMZET","KETETAPAN"),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),6);
        $pdf->SetFont('helvetica', '',10);
        $no =1;
        $pdf->SetAligns(Array('C','L','L','L','L','L','L','C','L','R','R'));
        $jumlah_omzet = 0;
        $jumlah_ketetapan = 0;

        for ($i=0; $i < count($data); $i++) { 
            $pdf->RowMultiBorderWithHeight(array($no,$data[$i]['date_settle_formated'],$data[$i]['ayat_code'].'.'.$data[$i]['ayat_code_dtl'],$data[$i]['nama'],$data[$i]['alamat'],$data[$i]['npwpd'],$data[$i]['kohir'],$data[$i]['start_period_formated'].' - '.$data[$i]['end_period_formated'],$data[$i]['jenis'],'Rp '.number_format($data[$i]['omzet'], 2, ',', '.'),'Rp '.number_format($data[$i]['ketetapan'], 2, ',', '.')),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
            $jumlah_omzet += $data[$i]['omzet'];
            $jumlah_ketetapan += $data[$i]['ketetapan'];
            $no++;
        }
        $pdf->SetWidths(array(259,40,40));
        $pdf->SetAligns(Array('C','R','R'));
        $pdf->RowMultiBorderWithHeight(array('JUMLAH', 'Rp ' . number_format($jumlah_omzet, 2, ',', '.'), 'Rp ' . number_format($jumlah_ketetapan, 2, ',', '.')),array('LB','LB','LBR'),6);
        
        $pdf->ln(15);
        $pdf->SetWidtHs(array(239,90));
        $pdf->SetAligns(array("C", "C","C","C","C"));
        //$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. UGAS RAHMANSYAH, SAP, MAP)\n(NIP 19640127 199703 1001)"),array("",""),5);
        $pdf->RowMultiBorderWithHeight(array("","BENDAHARA PENERIMAAN\n\n\n\n\n".getValByCode('BENDAHARA_PENERIMAAN')."\nNIP ".getValByCode('NIP_BENDAHARA_PENERIMAAN')),array("",""),5);
        $pdf->Output("","I");
        //echo 'tes';
        exit;   

	}

    function dateToString($date){
        if(empty($date)) return "";
        
        $monthname = array(0  => '-',
                           1  => 'Januari',
                           2  => 'Februari',
                           3  => 'Maret',
                           4  => 'April',
                           5  => 'Mei',
                           6  => 'Juni',
                           7  => 'Juli',
                           8  => 'Agustus',
                           9  => 'September',
                           10 => 'Oktober',
                           11 => 'November',
                           12 => 'Desember');    
        
        $pieces = explode('-', $date);
        
        return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
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



