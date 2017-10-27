<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_laporan_harian_denda extends CI_Controller{

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
		$start_date = getVarClean('start_date','str','');
		$end_date = getVarClean('end_date','str','');

		$_BORDER = 0;
		$_FONT = 'Times';
		$_FONTSIZE = 10;
	    $pdf = new FPDF('L','mm',array(216 ,356));
		$pdf->AliasNbPages();
	    $pdf->AddPage('Landscape', 'Legal');
	    $pdf->SetFont('helvetica', '', $_FONTSIZE);
		$pdf->SetRightMargin(5);
		$pdf->SetLeftMargin(9);
		$pdf->SetAutoPageBreak(false,0);

		$pdf->SetFont('helvetica', '',12);
		$pdf->SetWidths(array(200));
		$pdf->ln(1);
	    $pdf->RowMultiBorderWithHeight(array("Laporan penerimaan"),array('',''),6);
		//$pdf->ln(8);
		$pdf->SetWidths(array(40,200));
		$pdf->ln(4);
		$pdf->RowMultiBorderWithHeight(array("DAFTAR SPTPD",": "),array('',''),6);
		//$pdf->RowMultiBorderWithHeight(array("TAHUN",": ".$param_arr['year_code']),array('',''),6);
		//$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
		
		
		//$query="select * from sikp.f_laporan_harian_denda(1,".$param_arr['year_code'].",'".$param_arr['date_start']."', '".$param_arr['date_end']."')";
		$sql="
				SELECT
					skpdkb_no_kohir,
					denda_no_kohir,
					nama,
					alamat,
					npwpd,
					to_char(
						trunc(start_period),
						'DD-MM-YYYY'
					) AS start_period_formated,
					to_char(
						trunc(end_period),
						'DD-MM-YYYY'
					) AS end_period_formated,
					no_kohir,
					to_char(
						trunc(tgl_masuk),
						'DD-MM-YYYY'
					) AS tgl_masuk_formated,
					to_char(
						trunc(jatuh_tempo),
						'DD-MM-YYYY'
					) AS jatuh_tempo_formated,
					to_char(
						trunc(tgl_bayar),
						'DD-MM-YYYY'
					) AS tgl_bayar_formated,
					skpdkb_amount,
					to_char(
						trunc(skpdkb_tgl_tap),
						'DD-MM-YYYY'
					) AS skpdkb_tgl_tap_formated,
					to_char(
						trunc(skpdkb_tgl_bayar),
						'DD-MM-YYYY'
					) AS skpdkb_tgl_bayar_formated,
					denda_amount,
					to_char(
						trunc(denda_tgl_tap),
						'DD-MM-YYYY'
					) AS denda_tgl_tap_formated,
					to_char(
						trunc(denda_tgl_bayar),
						'DD-MM-YYYY'
					) AS denda_tgl_bayar_formated,
					sptpd_amount,
					payment_amount
				from sikp.f_laporan_harian_denda_v2(".$p_vat_type_id.",2014,'".$start_date."','".$end_date."')
				ORDER BY
					nama,
					trunc(start_period) ASC";	
	/*"select *, 
	to_char(start_period, 'DD-MM-YYYY') AS start_period_formated,
	to_char(end_period, 'DD-MM-YYYY') AS end_period_formated,
	to_char(tgl_masuk, 'DD-MM-YYYY') AS tgl_masuk_formated,
	to_char(jatuh_tempo, 'DD-MM-YYYY') AS jatuh_tempo_formated,
	to_char(tgl_bayar, 'DD-MM-YYYY') AS tgl_bayar_formated,
	to_char(skpdkb_tgl_tap, 'DD-MM-YYYY') AS skpdkb_tgl_tap_formated,
	to_char(skpdkb_tgl_bayar, 'DD-MM-YYYY') AS skpdkb_tgl_bayar_formated,
	to_char(denda_tgl_tap, 'DD-MM-YYYY') AS denda_tgl_tap_formated,
	to_char(denda_tgl_bayar, 'DD-MM-YYYY') AS denda_tgl_bayar_formated from sikp.f_laporan_harian_denda(1,2014,'1-1-2014','30-12-2014')";
	*/
	//echo $query;
	//exit;
		$query = $this->db->query($sql);
		$items=$query->result_array();

		$pdf->SetFont('arial', '',8);
		$pdf->ln(2);
		$pdf->SetWidths(array(10,24,20,15,37,18,18,19,22,19,61,61,17));
		$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
		$pdf->RowMultiBorderWithHeight(array("","","","","","","","","","","","",""),array('LT','LT','LT','LT','LT','LT','LT','LT','LT','LT','LT','LT','LTR'),6);
		$pdf->RowMultiBorderWithHeight(array("","","","","","","","","","","SKPDKB","DENDA","SELISIH"),array('L','L','L','L','L','L','L','L','L','L','L','L','LR'),4);
		$pdf->RowMultiBorderWithHeight(array("NO","NAMA","ALAMAT","NPWPD","MASA PAJAK","NO KOHIR","BESARNYA","TGL MASUK","JATUH TEMPO","TGL BAYAR","","",""),array('L','L','L','L','L','L','L','L','L','L','L','L','LR'),4);
		$pdf->SetWidths(array(10,24,20,15,37,18,18,19,22,19,16,15,14,16,16,15,14,16,17));
		$pdf->SetFont('arial', '',7);
		$pdf->RowMultiBorderWithHeight(array("","","","","","","","","","","BESARNYA","NO KOHIR","TGL TAP","TGL BAYAR","BESARNYA","NO KOHIR","TGL TAP","TGL BAYAR",""),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','TLB','TLB','TLB','TLB','TLB','TLB','TLB','TLBR'),9);
		$pdf->SetFont('arial', '',8);
		$no =1;
		$pdf->SetAligns(Array('C','L','L','L','L','L','L','L','L','L','L'));

		$jumlah =0;
		$jumlah=0;
		$jumlah_selisih=0;
		$total_skpdkb=0;
		$total_sptpd=0;
		$total_denda=0;
		for($i=0; $i<count($items); $i++){
		
			//$pdf->RowMultiBorderWithHeight(array($no,$item['tanggal'],$item['no_order'],$item['nama'],$item['alamat'],$item['npwpd'],'Rp. '.number_format($item['omzet'], 2, ',', '.'),'Rp. '.number_format($item['ketetapan'], 2, ',', '.'),$item['kohir'],$item['start_period'].' - '.$item['end_period'],$item['jenis_pajak']),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);			
			if($items[$i]['skpdkb_amount']==0){
				$items[$i]['skpdkb_no_kohir'] = "";
				$items[$i]['skpdkb_tgl_tap_formated'] = "";
				$items[$i]['skpdkb_tgl_bayar_formated'] = "";
			}
			if($items[$i]['denda_amount']==0){
				$items[$i]['denda_no_kohir'] = "";
				$items[$i]['denda_tgl_tap_formated'] = "";
				$items[$i]['denda_tgl_bayar_formated'] = "";
			}
			$jumlah = $items[$i]['skpdkb_amount']+$items[$i]['sptpd_amount']+$items[$i]['denda_amount']-$items[$i]['payment_amount'];
			$jumlah_selisih += $jumlah;
			$pdf->RowMultiBorderWithHeight(array($no,$items[$i]['nama'],$items[$i]['alamat'],
													$items[$i]['npwpd'],$items[$i]['start_period_formated']." s/d ".$items[$i]['end_period_formated'],
													$items[$i]['no_kohir'],'Rp. '.number_format($items[$i]['sptpd_amount'], 2, ',', '.'),$items[$i]['tgl_masuk_formated'],$items[$i]['jatuh_tempo_formated'],$items[$i]['tgl_bayar_formated'],'Rp. '.number_format($items[$i]['skpdkb_amount'], 2, ',', '.'),$items[$i]['skpdkb_no_kohir'],$items[$i]['skpdkb_tgl_tap_formated'],$items[$i]['skpdkb_tgl_bayar_formated'],'Rp. '.number_format($items[$i]['denda_amount'], 2, ',', '.'),$items[$i]['denda_no_kohir'],$items[$i]['denda_tgl_tap_formated'],$items[$i]['denda_tgl_bayar_formated'],'Rp. '.number_format($jumlah, 2, ',', '.')),
											array('LB','LB','LB','LB','LB','LB','LB','LB','LB','TLB','TLB','TLB','TLB','TLB','TLB','TLB','TLBR'),6);
			
			$total_skpdkb+=$items[$i]['skpdkb_amount'];
			$total_sptpd+=$items[$i]['sptpd_amount'];
			$total_denda+=$items[$i]['denda_amount'];
		//	$jumlah_wp+=$dbConn->f("jumlah_wp");
			$no++;
		}

		$pdf->SetWidths(array(10+24+20+15+37+18,18,19+22+19,16,15+14+16,16,15+14+16,17));
		$pdf->RowMultiBorderWithHeight(array("",'Rp. '.number_format($total_sptpd, 2, ',', '.'),"",'Rp. '.number_format($total_skpdkb, 2, ',', '.'),"",'Rp. '.number_format($total_denda, 2, ',', '.'),"",'Rp. '.number_format($jumlah_selisih, 2, ',', '.')),array('LRTBR','LTBR','LTBR','LTBR','LTBR','LTBR','LTBR','LTBR'),6);
		$pdf->SetWidths(array(250,70));
		$pdf->ln(8);
		$pdf->SetWidtHs(array(239,90));
		$pdf->SetAligns(array("C", "C","C","C","C"));
		$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. UGAS RAHMANSYAH, SAP, MAP)\n(NIP 19640127 199703 1001)"),array("",""),5);
		//$pdf->RowMultiBorderWithHeight(array("","KASIE VOP"),array('','','','','','',''),6);
		$pdf->Output("","I");
	}

	

	

}



