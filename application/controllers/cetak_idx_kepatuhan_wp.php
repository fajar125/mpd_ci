<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_idx_kepatuhan_wp extends CI_Controller{

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
        //$this->formCetak();
        $pdf = new FPDF();
        $this->startY = $pdf->GetY();
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
    }

    function newLine(){
        $pdf = new FPDF();
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }
	
	
	function PageCetak() {
		$p_vat_type_id			= getVarClean('p_vat_type_id','int',0);
		$p_finance_period_id	= getVarClean('p_finance_period_id','int',0);
		$p_year_period_id		= getVarClean('p_year_period_id','int',0);
		$status				    = getVarClean('status','int',0);


		$sql = "select max(rata_rata_pembayaran), max(rata_rata_pembayaran) / 3 , max(rata_rata_pembayaran) - (max(rata_rata_pembayaran) / 3) as batas_atas, max(rata_rata_pembayaran) - (max(rata_rata_pembayaran) / 3) - (max(rata_rata_pembayaran) / 3) batas_tengah from f_rep_index_kepatuhan(".$p_year_period_id.", ".$p_vat_type_id.", ".$status.")";
		$query = $this->db->query($sql);
		$arrBatas = $query->row_array();
		// print_r( $sql);
		// exit;		

		$pdf = new FPDF();

		$pdf->AliasNbPages();
		$pdf->AddPage("L");
		$pdf->SetFont('Arial', '', 10);
		
		$pdf->Image(getValByCode('LOGO'),15,13,25,25);

		$tahun 					= getVarClean('tahun','str','');
		$pajak 					= getVarClean('pajak','str','');
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$pdf->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "T", 0, 'L');
		$pdf->Cell($lheader1, $this->height, "", "TR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, getValByCode('INSTANSI_1'), "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, "INDEX KEPATUHAN WAJIB PAJAK", "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, getValByCode('INSTANSI_2'), "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, "TAHUN " . $tahun, "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, getValByCode('ALAMAT_1'), "R", 0, 'C');
		$pdf->Cell($lheader4, $this->height, strtoupper($pajak), "R", 0, 'C');
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lheader3, $this->height, getValByCode('ALAMAT_2'), "R", 0, 'C');
		$code = "";
		if ($status == 1){
			$code = "PATUH";
		}else{
			if ($status == 2){
				$code = " KURANG PATUH";
			}else{
				$code = " TIDAK PATUH";
			}
		}
		$pdf->Cell($lheader4, $this->height, "", "R", 0, 'C');
		//$pdf->Cell($lheader4, $this->height, "STATUS ".$code, "R", 0, 'C');
		
		$pdf->Ln();
		$pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$pdf->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$pdf->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		$pdf->Ln();
		
		$ltable = $this->lengthCell / 26;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable22 = $ltable * 22;
		
		//besar
		$pdf->Ln();
		$this->newLine();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lheader1, $this->height, "I. RANKING BESAR", "", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Ln();
		$this->newLine();
		$pdf->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$pdf->Cell($ltable5+$ltable2, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "RATA-RATA TANGGAL BAYAR", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "RATA-RATA PEMBAYARAN", "TBLR", 0, 'C');
		$pdf->Ln();

		//isi kolom

		$sql = "select * from f_rep_index_kepatuhan(".$p_year_period_id.", ".$p_vat_type_id.", ".$status.") where rata_rata_pembayaran > ".$arrBatas['batas_atas']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
		$query = $this->db->query($sql);
		$item = $query->result_array();
		

		$no = 1;
		$pdf->SetWidths(array($ltable1, $ltable5+$ltable2, $ltable5, $ltable3, $ltable5, $ltable5));
		$pdf->SetAligns(array("C", "L", "L", "L", "R", "R"));
		
		
		for($i=0; $i<count($item); $i++){
			//print data
			$pdf->RowMultiBorderWithHeight(array($no,
												  $item[$i]['nama'],
												  $item[$i]['alamat'],
												  $item[$i]['npwpd'],
												  $item[$i]['rata_rata_tgl_byr'],
												  $item[$i]['rata_rata_pembayaran']),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
		}
		
		//menengah
		$pdf->Ln();
		$pdf->Ln();
		$this->newLine();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lheader1, $this->height, "II. RANKING MENENGAH", "", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Ln();
		$this->newLine();
		$pdf->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$pdf->Cell($ltable5+$ltable2, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "RATA-RATA TANGGAL BAYAR", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "RATA-RATA PEMBAYARAN", "TBLR", 0, 'C');
		$pdf->Ln();

		//isi kolom

		$sql = "select * from f_rep_index_kepatuhan(".$p_year_period_id.", ".$p_vat_type_id.", ".$status.") where rata_rata_pembayaran <= ".$arrBatas['batas_atas']." and rata_rata_pembayaran >= ".$arrBatas['batas_tengah']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
		$query = $this->db->query($sql);
		$item = $query->result_array();
		// print_r($sql);
		// exit;

		$no = 1;
		$pdf->SetWidths(array($ltable1, $ltable5+$ltable2, $ltable5, $ltable3, $ltable5, $ltable5));
		$pdf->SetAligns(array("C", "L", "L", "L", "R", "R"));
		
		
		for($i=0; $i<count($item); $i++){
			//print data
			$pdf->RowMultiBorderWithHeight(array($no,
												  $item[$i]['nama'],
												  $item[$i]['alamat'],
												  $item[$i]['npwpd'],
												  $item[$i]['rata_rata_tgl_byr'],
												  $item[$i]['rata_rata_pembayaran']),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
		}
		
		//kecil
		$pdf->Ln();
		$pdf->Ln();
		$this->newLine();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($lheader1, $this->height, "III. RANKING KECIL", "", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Ln();
		$this->newLine();
		$pdf->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$pdf->Cell($ltable5+$ltable2, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$pdf->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "RATA-RATA TANGGAL BAYAR", "TBLR", 0, 'C');
		$pdf->Cell($ltable5, $this->height + 2, "RATA-RATA PEMBAYARAN", "TBLR", 0, 'C');
		$pdf->Ln();

		//isi kolom

		$sql = "select * from f_rep_index_kepatuhan(".$p_year_period_id.", ".$p_vat_type_id.", ".$status.") where rata_rata_pembayaran < ".$arrBatas['batas_tengah']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
		$query = $this->db->query($sql);
		$item = $query->result_array();
		//echo $query;
		//exit;

		$no = 1;
		$pdf->SetWidths(array($ltable1, $ltable5+$ltable2, $ltable5, $ltable3, $ltable5, $ltable5));
		$pdf->SetAligns(array("C", "L", "L", "L", "R", "R"));
		
		
		for($i=0; $i<count($item); $i++){
			//print data
			$pdf->RowMultiBorderWithHeight(array($no,
												  $item[$i]['nama'],
												  $item[$i]['alamat'],
												  $item[$i]['npwpd'],
												  $item[$i]['rata_rata_tgl_byr'],
												  $item[$i]['rata_rata_pembayaran']),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
		}
		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$pdf->SetAligns(array("C", "C"));
		$pdf->SetWidths(array(180, 120));
		$pdf->RowMultiBorderWithHeight( array("","Lombok Utara, " . date("d F Y")."\n\n\n\n\n\n\n\n(....................................)"), array("",""), 5 );
	
	    
		/*$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$pdf->Ln();
		$pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');*/
		//$pdf->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y")."\n\n\n\n\n(....................................)" /*. $data["tanggal"]*/, "", 0, 'C');
		$pdf->Output();
    }
	


	

	

}



