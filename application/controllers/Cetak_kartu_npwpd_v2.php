<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_kartu_npwpd_v2 extends CI_Controller{

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
		
		$t_customer_order_id = getVarClean('t_customer_order_id','int',0);
		$t_cust_account_id = getVarClean('t_cust_account_id','int',0);


		$sql="";
		if(empty($t_customer_order_id) && empty($t_cust_account_id)){
			echo "data tidak ada";
			exit();
		}

		if (empty($t_cust_account_id)||$t_cust_account_id=='') {
			$sql = "select b.vat_code,to_char(a.registration_date,'dd Mon yyyy') as registration_date_2,company_owner,a.*,
			npwpd as npwd from t_vat_registration a 
			left join p_vat_type_dtl b on a.p_vat_type_dtl_id = b.p_vat_type_dtl_id
			where t_customer_order_id = ".$t_customer_order_id;
			
		}else{
			$sql = "select b.vat_code,to_char(a.active_date,'dd Mon yyyy') as registration_date_2,company_owner,a.*
			from t_cust_account a 
			left join p_vat_type_dtl b on a.p_vat_type_dtl_id = b.p_vat_type_dtl_id
			left join t_customer c on c.t_customer_id = a.t_customer_id
			where t_cust_account_id = ".$t_cust_account_id;
		}
		//echo ($sql);exit;
		$query = $this->db->query($sql);
		$data = $query->row_array();
        // exit();



		$pdf = new FPDF();


		$_HEIGHT = 4;
		$_BORDER = 0;
		$_FONT = 'Times';
		$_FONTSIZE = 10;
		//$size = $pdf->_getpagesize('Legal');
		$size[1]=6;
		$pdf->PageSize = $size;
		$pdf->AddPage('L',array(94,60));
		//$pdf->AddPage('P',array(210,296));

		$pdf->SetFont('helvetica', '', $_FONTSIZE);
		$pdf->SetRightMargin($_HEIGHT);
		$pdf->SetLeftMargin($_HEIGHT);

		$pdf->SetAutoPageBreak(false,0);
		$pdf->Ln(0);
		//$pdf->Image('../images/Logo.png',7,10,15,15);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(74, 5, "", "", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(74, 5, "", "", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 6);


		$pdf->SetWidths(array(84, 10));
		$pdf->SetAligns(array("L", "L","C", "L"));
		$pdf->RowMultiBorderWithHeight(
			array
			(	
				"",
				""
			),
			array
			(
				"",
				""
			),
			3
		);
		$brand_address_name = $data['brand_address_name'].' '.$data['brand_address_no'];
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(84, 5, "NPWPD : ".$data['npwd'], "", 0, 'C');
		//print_r($data); exit();
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(84, 9, $data['company_brand'], "", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Ln(3);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(84, 12, $brand_address_name, "", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Cell(84, 15, $data['company_owner'], "", 0, 'C');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell(84, 5, "", "", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Ln();
		$pdf->Cell(84, 5, "", "", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'C');
		$pdf->Ln();

		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Cell(74, 5, "", "", 0, 'C');
		$pdf->Cell(10, 5, "", "", 0, 'L');
		$pdf->Ln(1);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(84, 5, $data['vat_code'], "", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(84, 5, 'TERDAFTAR : '. $data['registration_date_2'], "", 0, 'C');
		$pdf->Ln(1);
		$pdf->Cell(84, 5, "", "", 0, 'C');	
		$pdf->Cell(10, 5, "", "", 0, 'C');


		
		
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



