<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_laporan_penerimaan_pajak extends CI_Controller{

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
	
	

	function pageCetak(){
		$p_vat_type_id = getVarClean('p_vat_type_id','int',0);
		$p_year_period_id = getVarClean('p_year_period_id','int',0);
		$start_date = getVarClean('start_date','str','');
		$end_date = getVarClean('end_date','str','');
		$jenis_tahun = getVarClean('jenis_tahun','str','');
		$vat_code = getVarClean('vat_code','str','');

		$_BORDER = 0;
		$_FONT = 'Times';
		$_FONTSIZE = 8;
	    $pdf = new FPDF();
	    $pdf->AliasNbPages();
	    $pdf->AddPage('Portrait', 'Letter');
	    $pdf->SetFont('helvetica', '', $_FONTSIZE);
		$pdf->SetRightMargin(5);
		$pdf->SetLeftMargin(5);
		$pdf->SetAutoPageBreak(false,0);

		$pdf->SetFont('helvetica', '',9);
		$pdf->SetWidths(array(200));
		$pdf->ln(1);
	    	if($jenis_tahun=='pajak'){
			$pdf->RowMultiBorderWithHeight(array("Laporan Penerimaan Global per Masa Pajak"),array('',''),6);
		}else if($jenis_tahun=='bayar'){
			$pdf->RowMultiBorderWithHeight(array("Laporan Penerimaan Global per Tanggal / Penerimaan"),array('',''),6);
		}
		//$pdf->ln(8);
		$pdf->SetWidths(array(30,200));
		$pdf->ln(4);
		$pdf->RowMultiBorderWithHeight(array("Jenis Pajak",": ".$vat_code),array('',''),6);
		//$pdf->RowMultiBorderWithHeight(array("Tahun",": ".$year_code),array('',''),6);
		$pdf->RowMultiBorderWithHeight(array("Tanggal",": ".$this->dateToString($start_date)." s/d ".$this->dateToString($end_date)),array('',''),6);

		$sql="";

		if($jenis_tahun=='pajak'){
			$sql="select * from sikp.f_laporan_per_thn_pajak(".$p_vat_type_id.",0,'".$start_date."', '".$end_date."')";
		}else if($jenis_tahun=='bayar'){
			$sql = "select * from sikp.f_laporan_per_thn_bayar(".$p_vat_type_id.",2013,'".$start_date."', '".$end_date."')";
		}

		$query = $this->db->query($sql);
		$items=$query->result_array();

		$pdf->SetFont('helvetica', '',8);
		$pdf->ln(2);
		$pdf->SetWidths(array(10,40,40,33,37,40));
		$pdf->RowMultiBorderWithHeight(array("NO","BULAN","BESARNYA","JUMLAH WP","JUMLAH SSPD","KETERANGAN"),array('LTB','LTB','LTB','LTB','LTB','LTBR'),6);
		$pdf->SetFont('helvetica', '',8);
		$no =1;
		$pdf->SetAligns(Array('C','L','R','R','R','L'));
		$jumlah =0;
		$jumlah_wp=0;
		for($i=0; $i<count($items); $i++){	
			$pdf->RowMultiBorderWithHeight(array(($i+1),$items[$i]['bulan_wp'],'Rp. '.number_format($items[$i]['total_amount'], 2, ',', '.'),$items[$i]['jumlah_wp'],'',''),array('LB','LB','LB','LB','LB','LBR'),6);			
			$jumlah+=$items[$i]['total_amount'];
			$jumlah_wp+=$items[$i]['jumlah_wp'];
		}

		$pdf->SetAligns(Array('C','R','R','R','R','L'));
		$pdf->SetWidths(array(50,40,33,37,40));
		$pdf->RowMultiBorderWithHeight(array('Jumlah','Rp. '.number_format($jumlah, 2, ',', '.'),$jumlah_wp,'',''),array('LB','LB','LB','LB','LBR'),6);
		$pdf->SetWidths(array(123,50));
		$pdf->SetAligns('L');
			$pdf->ln(5);
		$pdf->SetWidtHs(array(130,70));
		$pdf->SetAligns(array("C", "C","C","C","C"));
		//$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. UGAS RAHMANSYAH, SAP, MAP)\n(NIP 19640127 199703 1001)"),array("",""),5);
		$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. Deden Saepulloh, MM.)\n(NIP 19681210 199010 001)"),array("",""),5);
		//$pdf->RowMultiBorderWithHeight(array("","KASIE VOP"),array('','','','','','',''),6);
		$pdf->Output("","I");
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
	

	

}



