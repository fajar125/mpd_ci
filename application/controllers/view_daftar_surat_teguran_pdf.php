<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class view_daftar_surat_teguran_pdf extends CI_Controller{

	var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
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
	
	
	function pageCetak() {
		$t_customer_order_id = getVarClean('t_customer_order_id','int',0);
		$p_vat_type_id = getVarClean('p_vat_type_id','int',4);
		//$p_vat_type_id = CCGetFromGet("p_vat_type_id", "");
		$sql="begin;";

		if(empty($t_customer_order_id)){
			echo "data tidak ada";
			exit();
		}else{
			if($p_vat_type_id != 0){
				$sql .= "select * from f_debt_letter_list(".$t_customer_order_id.") as a 
					  LEFT JOIN t_cust_account as b ON a.t_cust_account_id = b.t_cust_account_id
					  WHERE a.p_vat_type_id = ".$p_vat_type_id." AND b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)
					  order by b.wp_name";
			}else{
				$sql .= "select * from f_debt_letter_list(".$t_customer_order_id.") as a 
					  LEFT JOIN t_cust_account as b ON a.t_cust_account_id = b.t_cust_account_id
					  WHERE b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)
					  order by b.wp_name";
			}

			$query = $this->db->query($sql);
			/*echo($sql);
			exit;*/
			$data = $query->result_array();
			/*print_r(count($data['npwd']));
			exit;*/

			$pdf = new FPDF();

			$pdf->AliasNbPages();
			$pdf->AddPage("L");		
			$startY = $pdf->GetY();
			$startX = $this->paperWSize-42;
			$lengthCell = $startX+20;		
			
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
			$pdf->ln(8);
			$pdf->SetAligns(array("C","C"));
			$pdf->SetWidths(array(($kol1+$kol2+$kol3+$kol3+$kol2+$kol2+$kol2+$kol3)/2,($kol1+$kol2+$kol3+$kol3+$kol2+$kol2+$kol2+$kol3)/2));
			//$this->RowMultiBorderWithHeight(array("\n\n\n\n\n\n\nMengetahui,\nan. KEPALA DINAS PELAYANAN PAJAK\nKepala Bidang Pajak Pendaftaran\n\n\n\n\n\nH. SONI BAKHTIYAR, S.Sos, M.Si\nNIP. 19750625 199403 1 001","Kepala Seksi Piutang\n\n\n\n\n\nRACHMAT SATIADI, S.Ip., M.Si\nNIP.19691104 199803 1 007"),array('',''),$this->height);
			$pdf->RowMultiBorderWithHeight(array("\n\nKepala Seksi Penyelesaian Piutang\n\n\n\n\n\nDIN KAMADIANTINI S.IP, MM\nNIP. 19710320 1998032 006","Mengetahui,\nan. KEPALA DINAS PELAYANAN PAJAK\nKepala Bidang Pajak Pendaftaran\n\n\n\n\n\nDrs. H. GUN GUN SUMARYANA\nNIP. 19700806 199101 1 001"),array('',''),$this->height);
			/*$this->ln(16);
			$this->RowMultiBorderWithHeight(array('','RACHMAT SATIADI, S.Ip., M.Si'),array('',''),$this->height);
			$this->RowMultiBorderWithHeight(array('','NIP.19691104 199803 1 007'),array('',''),$this->height);	*/	

			$pdf->Ln(10);
			$pdf->SetFont('Arial', '', 8);
        	$ci =& get_instance();
	        $userdata = $ci->session->userdata;
	        $userdata = $userdata['app_user_name'];
			$pdf->Cell($lengthCell, $this->height, "Pencetak : " . $userdata, 0, 0, 'L');

			$pdf->Output();

		}
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
	
	function getNumberFormat($number, $dec) {
			if (!empty($number)) {
				return number_format($number, $dec);
			} else {
				return "";
			}
	}
	
	function SetWidths($w, $pdf)
	{
	    //Set the array of column widths
	    $pdf->widths=$w;
	}

	function SetAligns($a, $pdf)
	{
	    //Set the array of column alignments
	    $pdf->aligns=$a;
	}

	function Row($data)
	{
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
	    $h=5*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row
	    for($i=0;$i<count($data);$i++)
	    {
	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x, $y, $w, $h);
	        //Print the text
	        $this->MultiCell($w, 5, $data[$i], 0, $a);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w, $y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	}

	function CheckPageBreak($h, $pdf)
	{
	    //If the height h would cause an overflow, add a new page immediately
	    if($pdf->GetY()+$h>$this->PageBreakTrigger)
	        $pdf->AddPage($this->CurOrientation);
	}
	
	function RowMultiBorderWithHeight($data, $border = array(),$height, $pdf)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$height*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			$pdf->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
			$this->SetXY($x,$y);
			//Print the text
			$this->MultiCell($w,$height,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function NbLines($w, $txt)
	{
	    //Computes the number of lines a MultiCell of width w will take
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r", '', $txt);
	    $nb=strlen($s);
	    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
	    $sep=-1;
	    $i=0;
	    $j=0;
	    $l=0;
	    $nl=1;
	    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
	            $i++;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	            continue;
	        }
	        if($c==' ')
	            $sep=$i;
	        $l+=$cw[$c];
	        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}
	
	function Footer() {
		
	}
	
	function __destruct() {
		return null;
	}
}

/*$formulir = new FormCetak();
$formulir->PageCetak($data);
$formulir->Output();*/
