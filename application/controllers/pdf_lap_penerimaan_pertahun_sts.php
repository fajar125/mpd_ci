<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class pdf_lap_penerimaan_pertahun_sts extends CI_Controller{
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


    function save_pdf_t_rep_penerimaan_pertahun_sts() {

        $p_year_period_id     = getVarClean('p_year_period_id', 'int', 0);
        $p_vat_type_id        = getVarClean('p_vat_type_id', 'int', 0);
        $start_piutang        = getVarClean('start_piutang', 'str', '');
        $end_piutang          = getVarClean('end_piutang', 'str', '');
        $tgl_status           = getVarClean('tgl_status', 'str', '');
        $p_account_status_id  = getVarClean('p_account_status_id', 'int', 0);       

        $sql = "select * from sikp.f_rep_penerimaan_pertahun_sts_piutang(?,?,?,?,?,?)";       
        $output = $this->db->query($sql, array($p_year_period_id, $p_vat_type_id, $start_piutang, $end_piutang, $tgl_status, $p_account_status_id));
        $data = $output->result_array();

        //print_r($data);exit();
        


        $pdf = new FPDF();
        //$pdf->AddPage();
        //$pdf->SetFont('Arial','B',16);
        //$pdf->Cell(40,10,'Hello World! '.$angka1.' -> '.$angka2);
        $pdf->AliasNbPages();
        $pdf->AddPage("L");
        $pdf->SetFont('Arial', '', 10);
        $pdf->Image('images/logo_lombok.png',15,13,25,25);

        $pdf->startY = $pdf->GetY();
        $pdf->startX = $this->paperWSize-72;
        $pdf->lengthCell = $this->startX+20;

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
        $pdf->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "LAPORAN POSISI WP BELUM BAYAR", "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "", "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "Periode Belum Bayar : " . str_replace("'","",$start_piutang).' s/d '.str_replace("'","",$end_piutang), "R", 0, 'C');   
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "Posisi Laporan Tanggal : ".str_replace("'","",$tgl_status), "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "", "BR", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "", "B", 0, 'L');
        $pdf->Cell($lheader1, $this->height, "", "BR", 0, 'L');
        $pdf->Ln();
        
        $ltable = $this->lengthCell / 46;
        $ltable1 = $ltable * 1;
        $ltable2 = $ltable * 2;
        $ltable3 = $ltable * 3;
        $ltable4 = $ltable * 4;
        $ltable9 = $ltable * 9;
        $ltable36 = $ltable * 36;

        $pdf->SetFont('Arial', '', 6);
        
        $pdf->Cell($ltable2, $this->height + 5, "NO.", "TLR", 0, 'C');
        $pdf->Cell($ltable4, $this->height, "NAMA", "TLR", 0, 'C');
        $pdf->Cell($ltable4, $this->height + 5, "ALAMAT", "TLR", 0, 'C');
        $pdf->Cell($ltable36, $this->height, "REALISASI DAN TANGGAL BAYAR", "TBLR", 0, 'C');
        $pdf->Ln();
        
        $pdf->Cell($ltable2, $this->height, "", "LR", 0, 'C');
        $pdf->Cell($ltable4, $this->height, "PERUSAHAAN", "LR", 0, 'C');
        $pdf->Cell($ltable4, $this->height, "", "LR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "DESEMBER", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "JANUARI", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "FEBRUARI", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "MARET", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "APRIL", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "MEI", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "JUNI", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "JULI", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "AGUSTUS", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "SEPTEMBER", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "OKTOBER", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "NOVEMBER", "TLR", 0, 'C');
        $pdf->Ln();
        
        $pdf->Cell($ltable2, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable4, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable4, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, $data[0]["tahun"], "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Ln();
        if($data != 'no result'){
          //isi kolom
          $no = 1;
          //echo count($data)." ->nama = ".count($data[0]['nama']);
          //exit();
          for ($i = 0; $i < count($data); $i++) {
            $pdf->SetWidths(array($ltable2, $ltable4, $ltable4, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3));
            $pdf->SetAligns(array("C", "L", "L", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
            
            // print data piutang
            $data2 = array();
            for($j = 1; $j <= 12; $j++){
              $sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
              $amt = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_amt";
              
              if(is_null($data[$i] [$sts])){
                $data2[$j] = number_format($data[$i][$amt], 0, ',', '.');
              }
              else{
                $data2[$j] = $data[$sts][$i];
              }
            }
            
            $pdf->RowMultiBorderWithHeight(
              array(
                $no,
                $data[$i]["nama"],
                $data[$i]["alamat"],
                $data2[12],
                $data2[1],
                $data2[2],
                $data2[3],
                $data2[4],
                $data2[5],
                $data2[6],
                $data2[7],
                $data2[8],
                $data2[9],
                $data2[10],
                $data2[11]
              ),
              array(
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR",
                "TLR"
              ),
              $this->height
            );
            
            // print data tanggal bayar
            $data2 = array();
            for($j = 1; $j <= 12; $j++){
              $sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
              $paydate = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_paydate";
              
              if(is_null($data[$i][$sts])){
                $data2[$j] = $data[$i][$paydate];
              }
              else{
                $data2[$j] = $data[$i][$sts];
              }
            }
            
            $pdf->RowMultiBorderWithHeight(
              array(
                "",
                "",
                $data[$i]["npwpd"],
                $data2[12],
                $data2[1],
                $data2[2],
                $data2[3],
                $data2[4],
                $data2[5],
                $data2[6],
                $data2[7],
                $data2[8],
                $data2[9],
                $data2[10],
                $data2[11]
              ),
              array(
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR",
                "BLR"
              ),
              $this->height
            );
            
            $no++;
          }
        }
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        
        $lbody = $this->lengthCell / 4;
        $lbody1 = $lbody * 1;
        $lbody2 = $lbody * 2;
        $lbody3 = $lbody * 3;
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $nama_pajak = strtoupper(substr($data[0]["jenis_pajak"], 5));
        $pdf->Cell($lbody1 + 10, $this->height, "KOORDINATOR " . $nama_pajak, "", 0, 'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "", "", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "NIP. ", "", 0, 'L');
        $pdf->Ln();

        $pdf->Output();
    }
     

}