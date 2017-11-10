<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class pdf_status_pelaporan_wp_detil extends CI_Controller{
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $paperWSize = 330;
	var $paperHSize = 215;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;

	function __construct() {
		parent::__construct();
		$pdf = new FPDF();
		$this->startY = $pdf->GetY();
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
	}

	function save_pdf_t_status_pelporan_wp_detil($p_vat_type_id){
		$sql = "SELECT
					CASE WHEN cust_account.p_account_status_id = 1 THEN '1' ELSE '2' END as status,
					vat_type.vat_code,
					npwd,
					wp_name,
					brand_address_name,
					company_brand
				FROM
					t_cust_account cust_account
				LEFT JOIN
					p_vat_type vat_type on vat_type.p_vat_type_id = cust_account.p_vat_type_id
				WHERE CASE WHEN cust_account.p_account_status_id = 1 THEN '1' ELSE '2' END = 1
				AND cust_account.p_vat_type_id = ?
				ORDER BY company_brand ASC";        
        $output = $this->db->query($sql, array($p_vat_type_id));
        $data = $output->result_array();

        $pdf = new FPDF();

		$pdf->AliasNbPages();
		$pdf->AddPage("L");
		$pdf->SetFont('Arial', 'B', 12);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader-15;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$pdf->Cell($lheader2, $this->height, "DAFTAR WP AKTIF UNTUK JENIS ".strtoupper($data[0]['vat_code']));
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Ln(8);
		
		
		$ltable = $this->lengthCell / 26;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable6 = $ltable * 6;
		$ltable7 = $ltable * 7;
		$ltable8 = $ltable * 8;
		
		$pdf->Cell($ltable1, $this->height + 2, "NO", "TBLR", 0, 'C');
		$pdf->Cell($ltable4, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$pdf->Cell($ltable7, $this->height + 2, "NAMA WAJIB PAJAK", "TBLR", 0, 'C');
		$pdf->Cell($ltable7, $this->height + 2, "MEREK DAGANG", "TBLR", 0, 'C');
		$pdf->Cell($ltable8-10, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 10);
		//isi kolom
		$pdf->SetWidths(array($ltable1,$ltable4, $ltable7, $ltable7, $ltable8-10, $ltable3, $ltable5));
		$pdf->SetAligns(array("C", "L", "L","L", "L", "L"));
		$no = 1;
		$jumlahperayat = array();
		$jumlahperwaktu = array();
		$jumlahtemp = 0;
		$i=0;
		$total=0;
		foreach($data as $item) {
			//print data
			$pdf->RowMultiBorderWithHeight(array(
												  $no,
												  $item["npwd"],
												  $item["wp_name"],
												  $item["company_brand"],
												  $item["brand_address_name"]
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
				
		}
		$pdf->Output();
	}

}