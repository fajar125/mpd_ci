<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class view_daftar_surat_teguran_pdf extends CI_Controller{
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
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $cusId = getVarClean('t_customer_order_id','int',0);

        $ci =& get_instance();
        $userdata = $ci->session->userdata;
        $user_login = $userdata['app_user_name'];

       // echo($cusId); exit();

        //$sql = "";
        if ($cusId == 0 || $p_vat_type_id == 0){
            echo "DATA TIDAK ADA";
            exit();
        }

        $sql = "select * from f_debt_letter_list($cusId) as a 
              LEFT JOIN t_cust_account as b ON a.t_cust_account_id = b.t_cust_account_id
              WHERE a.p_vat_type_id = $p_vat_type_id AND b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)
              order by b.wp_name";

        $output = $this->db->query($sql);
        
        $data = $output->result_array();

        $npwd = array();
        $company_name = array();
        $address_name = array();
        $vat_code = array();
        $due_date = array();
        $start_date = array();
        $end_date = array();
        $debt_amount = array();
        $description = array();
        $wp_address_no = array();

        for ($i=0; $i <count($data) ; $i++) { 
            $npwd = $data[$i]["npwd"];
            $company_name = $data[$i]["company_brand"];
            $address_name = $data[$i]["brand_address_name"];
            $vat_code = $data[$i]["vat_code"];
            $due_date = $data[$i]["due_date"];
            $start_date = $data[$i]["start_date"];
            $end_date = $data[$i]["end_date"];
            $debt_amount = $data[$i]["debt_amount"];
            $description = $data[$i]["description"];
            $wp_address_no = $data[$i]["brand_address_no"];
        }


        $pdf = new FPDF();
        $startY = $pdf->GetY();
        $startX = $this->paperWSize-42;
        $lengthCell = $this->startX+20;
        $pdf->AliasNbPages();
        $pdf->AddPage("L");
     
        
        $kol = $lengthCell / 18;
        $kol1 = $kol * 1;
        $kol2 = $kol * 2;
        $kol3 = $kol * 3;
        $kol4 = $kol * 4;
        $kol5 = $kol * 5;

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($lengthCell, $this->height, "DAFTAR SURAT TEGURAN " . strtoupper($data[0]["vat_code"]), 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell($lengthCell, $this->height, "Tanggal Cetak : " . date("d-M-Y"), 0, 0, 'R');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell($kol1, $this->height, "NO", 1, 0, 'C');
        $pdf->Cell($kol2, $this->height, "NPWPD", 1, 0, 'C');
        $pdf->Cell($kol3, $this->height, "NAMA", 1, 0, 'C');
        $pdf->Cell($kol3, $this->height, "ALAMAT", 1, 0, 'C');
        $pdf->Cell($kol2, $this->height, "JATUH TEMPO", 1, 0, 'C');
        $pdf->Cell($kol2, $this->height, "MASA PAJAK", 1, 0, 'C');
        $pdf->Cell($kol2, $this->height, "BESARNYA", 1, 0, 'C');
        $pdf->Cell($kol3, $this->height, "KETERANGAN", 1, 0, 'C');
        $pdf->Ln();
        
        $pdf->SetWidths(array($kol1, $kol2, $kol3, $kol3, $kol2, $kol2, $kol2, $kol3));
        $pdf->SetAligns(array("C", "L", "L", "L", "C", "C", "R", "L"));
        for ($i=0; $i<count($data); $i++) {
            $pdf->RowMultiBorderWithHeight(
                array(
                    $i + 1,
                    $data[$i]["npwd"],
                    $data[$i]["company_name"],
                    $data[$i]["address_name"].' '.$data[$i]["wp_address_no"],
                    $data[$i]["due_date"],
                    $data[$i]["start_date"]." - ".$data[$i]["end_date"],
                    $data[$i]["debt_amount"],
                    $data[$i]["description"]
                ),
                array(
                    'TBLR',
                    'TBLR',
                    'TBLR',
                    'TBLR',
                    'TBLR',
                    'TBLR',
                    'TBLR',
                    'TBLR'
                ),
                $this->height
            );
        }
        $pdf->Ln(8);
        $pdf->SetAligns(array("C","C"));
        $pdf->SetWidths(array(($kol1+$kol2+$kol3+$kol3+$kol2+$kol2+$kol2+$kol3)/2,($kol1+$kol2+$kol3+$kol3+$kol2+$kol2+$kol2+$kol3)/2));
        //$pdf->RowMultiBorderWithHeight(array("\n\n\n\n\n\n\nMengetahui,\nan. KEPALA DINAS PELAYANAN PAJAK\nKepala Bidang Pajak Pendaftaran\n\n\n\n\n\nH. SONI BAKHTIYAR, S.Sos, M.Si\nNIP. 19750625 199403 1 001","Kepala Seksi Piutang\n\n\n\n\n\nRACHMAT SATIADI, S.Ip., M.Si\nNIP.19691104 199803 1 007"),array('',''),$this->height);
        $pdf->RowMultiBorderWithHeight(array("\n\nKepala Seksi Penyelesaian Piutang\n\n\n\n\n\nDIN KAMADIANTINI S.IP, MM\nNIP. 19710320 1998032 006","Mengetahui,\nan. KEPALA BADAN PENGELOLA PENDAPATAN DAERAH\nKepala Bidang Pajak Pendaftaran\n\n\n\n\n\nDrs. H. GUN GUN SUMARYANA\nNIP. 19700806 199101 1 001"),array('',''),$this->height);
        /*$pdf->Ln(16);
        $pdf->RowMultiBorderWithHeight(array('','RACHMAT SATIADI, S.Ip., M.Si'),array('',''),$this->height);
        $pdf->RowMultiBorderWithHeight(array('','NIP.19691104 199803 1 007'),array('',''),$this->height);  */  

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell($lengthCell, $this->height, "Pencetak : " . $user_login, 0, 0, 'L');
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



