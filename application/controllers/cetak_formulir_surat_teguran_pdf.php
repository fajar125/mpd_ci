<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class cetak_formulir_surat_teguran_pdf extends CI_Controller{

	var $fontSize = 8;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	//var $paperWSize = 241.3;
	var $paperWSize = 200;
	var $paperHSize = 250.4;
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
        $this->startX = $this->paperWSize-40;
        $this->lengthCell = $this->startX+20;
    }

    function newLine($pdf){
		$pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$pdf->Ln();
    }
	
	
	function pageCetak() {
		$t_customer_order_id = getVarClean('t_customer_order_id','int',0);

		if(empty($t_customer_order_id)){
			echo "data tidak ada";
			exit();
		}else{
			$data = $this->getData($t_customer_order_id);
			
        	$pdf = new FPDF('P','mm',array($this->paperWSize, $this->paperHSize));

			for ($i=0; $i < count($data); $i++) { 
				
				$this->kopSurat($pdf, $data[$i]);
				$this->isiSurat($pdf, $data[$i]);
				$this->penutupSurat($pdf, $data[$i]);
			}
			//exit;
			$pdf->Output();

		}
	}

	function penutupSurat($pdf, $data){
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
		$pdf->Cell($lbody4, $this->height, "Lombok Utara, " .$data['letter_date_txt'] 
		//. $data["tanggal"]
		, "", 0, 'C');
		$pdf->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "an. KEPALA BADAN PENGELOLAAN PENDAPATAN DAERAH", "", 0, 'C');
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
		
		$pdf->Image(base_url().'/qrcode/generate-qr.php?param='.str_replace(" ","-",$data['letter_date_txt'])."_".
		$data["npwd"]."_".
		str_replace(" ","-",$data["periode"])
		,28,168,25,25,'PNG');
		
		$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4-5, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4+10, $this->height, "Drs. H. GUN GUN SUMARYANA", "B", 0, 'C');
		//$this->Cell($lbody4+10, $this->height, "H. SONI BAKHTIAR, S.Sos, M.Si.", "B", 0, 'C');
		$pdf->Cell($lbody2-5, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
		$pdf->Cell($lbody4 - 2, $this->height, "NIP. 19700806 199101 1 001", "", 0, 'C'); //isi nip
		//$this->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
		$pdf->Cell(2, $this->height, "", "", 0, 'L');
		$pdf->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->Cell(10, $this->height, "", "BL", 0, 'L');
		//$this->Cell($this->lengthCell - 10, $this->height, "*) Coret yang tidak perlu", "BR", 0, 'L');
		$pdf->Cell($this->lengthCell - 10, $this->height, "", "BR", 0, 'L');
	}

	function isiSurat($pdf, $data){
		/*$pdf->Ln();
		$pdf->Ln();*/
		$this->newLine($pdf);
		//$this->newLine();
		$pdf->SetFont('BKANT', '', 10);
		$pdf->SetWidths(array(10,167,3));
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

		if( $data["sequence_no"] == 3) {
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
		$tahun = explode(" ",$data["periode"]);

		$bulan_periode = explode(",",$data['debt_period_code']);
		$bulan_string='';
		$i=0;
		foreach($bulan_periode as $item ){
			$bulan = explode(" ",$item);
			$bulan_string.= $bulan[0];
			$i++;
			if(!empty($bulan_periode[$i])){
				$bulan_string.="\n";
			}
		}

		if( $data["sequence_no"] == 3) {

			$pdf->RowMultiBorderWithHeight(
				array("",
					$data["vat_code"],
					$tahun[1],
					$bulan_string,
					$data["tap_no"],
					number_format($data["debt_amount"],0,",","."),
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
					$data["vat_code"],
					$tahun[1],
					$bulan_string,
					$data["tap_no"],
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
		$data["terbilang"]=trim($data["terbilang"]);
		$pdf->Cell(20, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lbody1 - 20,"", "", 0, 'L');	
		$pdf->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$pdf->Ln();
		
		/*$this->tulis("Sampai saat ini belum melunasi pembayaran pajak.", "L", $pdf);
		$this->tulis("", "L", $pdf);
		$this->tulis("Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Undang-undang Nomor 28 Tahun", "FJ", $pdf);
		$this->tulis("2009 dan Peraturan Daerah Nomor 20 Tahun 2011 Ps 70, maka diminta kepada Saudara agar melunasi", "FJ", $pdf);
		$this->tulis("jumlah tunggakan dalam waktu 7 (tujuh) hari setelah Surat Teguran ini. Setelah batas waktu tersebut", "FJ", $pdf);
		$this->tulis("tindakan penagihan akan ditindaklanjuti dengan penyerahan Surat Paksa.", "L", $pdf);
		$this->tulis("", "L", $pdf);
		$this->tulis("Apabila saudara telah melaksanakan pembayaran pajak tersebut, kami mohon untuk dapat memperlihatkan", "FJ", $pdf);
		$this->tulis("SSPD yang telah divalidasi dengan melampirkan photo copy dokumen yang dimaksud.", "L", $pdf);
		$this->tulis("", "L", $pdf);
		$this->tulis("Demikian agar menjadi maklum, atas perhatian dan kerjasamanya kami ucapkan terima kasih.", "L", $pdf);*/
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
		
	}

	function kopSurat($pdf, $data){
		$pdf->AliasNbPages();
		$pdf->SetLeftMargin(10);
		$pdf->SetTopMargin(2);
		$pdf->AddPage("P");
		$pdf->AddFont('BKANT');
		
		$pdf->SetFont('BKANT', '', 10);
		
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
		
		//$this->SetFont('BKANT', '', 16);
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
		
		$pdf->SetFont('BKANT', '', 10);
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;

		$pdf->SetWidths(array(20,2,$this->lengthCell-22));
		$pdf->SetAligns(array("L","L","L"));
		$posy = $pdf->getY();
		$data["letter_no"]=trim($data["letter_no"]);
		if(!empty($data["letter_no"])){
			$pdf->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					//$data["letter_no"]."-".$no_urut
					""
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
					//" - "
					""
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
		$pdf->Cell($lkepada2, $this->height, "Lombok Utara, ".$data['letter_date_txt'], "R", 0, 'L');
		$pdf->Ln();

		$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lkepada2, $this->height, "Kepada Yth,", "R", 0, 'L');
		$pdf->Ln();

		$pdf->SetAligns(array("L","L","L","L"));
		//$pdf->SetWidths(array($lkepada3,22,2,63.7));
		$pdf->SetWidths(array($lkepada3,22,2,48));
		$pdf->RowMultiBorderWithHeight(
			array("",
				"Pimpinan",
				":",
				$data['company_brand']
			),
			array("L",
				"",
				"",
				"R"
			),
			$this->height
		);
		
		$pdf->SetAligns(array("L","L","L","L"));
		//$pdf->SetWidths(array($lkepada3,22,2,63.7));
		$pdf->SetWidths(array($lkepada3,22,2,48));
		$pdf->RowMultiBorderWithHeight(
			array("",
				"NPWPD",
				":",
				$data['npwd']
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
				$data["brand_address_name"].' '.$data["brand_address_no"]
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
		
		$pdf->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$pdf->Cell($lkepada2, $this->height, "", "R", 0, 'C');
		$pdf->Ln();
		
		$pdf->SetFont('BKANT', '', 10);
		
		$pdf->Cell($this->lengthCell, $this->height, "SURAT TEGURAN ".$this->numberToRoman($data["sequence_no"]), "LR", 0, 'C');
		$this->newLine($pdf);
	}

	function getData($t_customer_order_id){

		//$t_customer_order_id = getVarClean('t_customer_order_id','int',466191);
		$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin 
				FROM p_global_param 
				WHERE code = 'TTD KADIN'";
		
		$nama_kadin = "";
		$nip_kadin = "";

		$query_ttd = $this->db->query($ttd);
		$data_ttd = $query_ttd->result_array();
		/*print_r($data_ttd);
		exit;*/
		if ($data_ttd != null){
			$nama_kadin = $data_ttd[0]['nama_kadin'];
			$nip_kadin = $data_ttd[0]['nip_kadin'];
		}

        $data = array();

        $sql ="select * from f_debt_letter_print2(".$t_customer_order_id.") AS tbl (ty_debt_letter_list)
					LEFT JOIN t_cust_account as b ON tbl.t_cust_account_id = b.t_cust_account_id
					WHERE b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)
					--limit 3";

        //echo ($sql);exit;

        $output = $this->db->query($sql);
        $items = $output->result_array();

        if ($items != null || $items != ''){
          foreach ($items as $item) {
            $data[] = array (
                    'npwd' => $item['npwd'], 
					'company_name' => $item['company_name'], 
					'company_brand' => $item['company_brand'], 
					'brand_address_name' => $item['brand_address_name'], 
					'brand_address_no' => $item['brand_address_no'], 
					'address' => $item['address'], 
					'letter_no' => $item['letter_no'], 
					'vat_code' => $item['vat_code'], 
					'periode' => $item['periode'], 
					'tap_no' => $item['tap_no'], 
					'tap_date' => $item['tap_date'], 
					'due_date' => $item['due_date'], 
					'debt_amount' => $item['debt_amount'], 
					'terbilang' => $item['terbilang'], 
					'debt_period_code' =>  $item['debt_period_code'], 
					'sequence_no' => $item['sequence_no'], 
					'letter_date_txt' => $item['letter_date_txt'], 
					'nama_kadin' => $nama_kadin,
					'nip_kadin' => $nip_kadin
                    );
          }
        }
            
        return $data;
    }

	function CellFJ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='')
	{
		$k=$this->k;
		if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
		{
			$x=$this->x;
			$ws=$this->ws;
			if($ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->AddPage($this->CurOrientation);
			$this->x=$x;
			if($ws>0)
			{
				$this->ws=$ws;
				$this->_out(sprintf('%.3f Tw', $ws*$k));
			}
		}
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$s='';
		if($fill==1 or $border==1)
		{
			if($fill==1)
				$op=($border==1) ? 'B' : 'f';
			else
				$op='S';
			$s=sprintf('%.2f %.2f %.2f %.2f re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
		}
		if(is_string($border))
		{
			$x=$this->x;
			$y=$this->y;
			if(is_int(strpos($border, 'L')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'T')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);
			if(is_int(strpos($border, 'R')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'B')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
		}
		if($txt!='')
		{
			if($align=='R')
				$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
			elseif($align=='C')
				$dx=($w-$this->GetStringWidth($txt))/2;
			elseif($align=='FJ')
			{
				//Set word spacing
				$wmax=($w-2*$this->cMargin);
				$this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt, ' ');
				$this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
				$dx=$this->cMargin;
			}
			else
				$dx=$this->cMargin;
			$txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
			if($this->ColorFlag)
				$s.='q '.$this->TextColor.' ';
			$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET', ($this->x+$dx)*$k, ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k, $txt);
			if($this->underline)
				$s.=' '.$this->_dounderline($this->x+$dx, $this->y+.5*$h+.3*$this->FontSize, $txt);
			if($this->ColorFlag)
				$s.=' Q';
			if($link)
			{
				if($align=='FJ')
					$wlink=$wmax;
				else
					$wlink=$this->GetStringWidth($txt);
				$this->Link($this->x+$dx, $this->y+.5*$h-.5*$this->FontSize, $wlink, $this->FontSize, $link);
			}
		}
		if($s)
			$this->_out($s);
		if($align=='FJ')
		{
			//Remove word spacing
			$this->_out('0 Tw');
			$this->ws=0;
		}
		$this->lasth=$h;
		if($ln>0)
		{
			$this->y+=$h;
			if($ln==1)
				$this->x=$this->lMargin;
		}
		else
			$this->x+=$w;
	}

	function tulis($text, $align, $pdf){
		$pdf->Cell(10, $this->height, "", "L", 0, 'C');
		//$this->CellFJ(165, $this->height, $text, "", 0, $align);
		$pdf->Cell(165, $this->height, $text, "", 0, $align);
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
	    if($pdf->GetY()+$h>$pdf->PageBreakTrigger)
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
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			$pdf->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
			$pdf->SetXY($x,$y);
			//Print the text
			$pdf->MultiCell($w,$height,$data[$i],0,$a);
			//Put the position to the right of the cell
			$pdf->SetXY($x+$w,$y);
		}
		//Go to the next line
		$pdf->Ln($h);
	}

	function numberToRoman($num)
	 {
	     // Make sure that we only use the integer portion of the value
	     $n = intval($num);
	     $result = '';
	 
	     // Declare a lookup array that we will use to traverse the number:
	     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
	     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
	     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	 
	     foreach ($lookup as $roman => $value)
	     {
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
