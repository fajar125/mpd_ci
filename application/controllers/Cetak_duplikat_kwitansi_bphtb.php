<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_duplikat_kwitansi_bphtb extends CI_Controller{
    var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 241.3;
    var $paperHSize = 139.7;
    var $height = 5;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function __construct() {
        parent::__construct();
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

    function save_pdf() {
        $registration_no = getVarClean('registration_no', 'str', '');
       

        $data = $this->getDataPDF($registration_no);

        $pecah =  explode(":", $data[0]);
        $kuitansi = $pecah[1];

        $encImageData = $this->getDataEncript($kuitansi);

        $pdf = new FPDF("L", "mm", array(241.3, 139.7));

        $this->kopSurat($pdf,$encImageData);

        $this->isiSurat($pdf,$data);

        
        $pdf->Output();
    } 


    function kopSurat($pdf,$encImageData){
      $pdf->AddPage();
      $pdf->Image(getValByCode('LOGO'),37,13,25,25);
      //$pdf->Image(base_url().'/qrcode/generate-qr.php?param='.$encImageData,179,13,25,25,'PNG');
      
      $pdf->SetFont('Arial', '', 11);

      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Cell(101, $this->height, getValByCode('INSTANSI_1'), "", 0, 'C');
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Cell(101, $this->height, getValByCode('INSTANSI_2'), "", 0, 'C');
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Cell(101, $this->height, getValByCode('ALAMAT_6'), "", 0, 'C');
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Cell(101, $this->height, "Telp.".getValByCode('ALAMAT_2')." ".getValByCode('ALAMAT_3'), "", 0, 'C');
      $pdf->Cell(60, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(60, $this->height + 7, "", "B", 0, 'L');
      $pdf->Cell(101, $this->height + 7, "Bukti Pembayaran Pajak BPHTB", "B", 0, 'C');
      $pdf->Cell(60, $this->height + 7, "", "B", 0, 'L');

      $pdf->Ln(5);
      $pdf->Ln();

    }

    function isiSurat($pdf,$data){
      $pdf->SetFont('Courier', '', 10);
      foreach($data as $datum){
        $pdf->Cell(241.3, $this->height, $datum, 0, 0, "L");
        $pdf->Ln();
      }

      $pdf->Cell(220, $this->height, "", "B", 0, "C");
    }

    


    function getDataPDF($registration_no){

        $sql = "select f_bphtb_receipt_duplicate('$registration_no')";
        
        $output = $this->db->query($sql);
        $items = $output->row_array();

        $items = explode("\n", $items["f_bphtb_receipt_duplicate"]); 
        
        return $items;
    }

    function getDataEncript($kuitansi){
        $sql = "select f_encrypt_str('".trim($kuitansi)."') AS enc_data";
        
        $output = $this->db->query($sql);
        $items = $output->row_array();
        //print_r($items);exit;
        return $items['enc_data'];
    }
}


