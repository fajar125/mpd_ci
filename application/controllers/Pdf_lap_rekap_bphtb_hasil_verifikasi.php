<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Pdf_lap_rekap_bphtb_hasil_verifikasi extends CI_Controller{
    var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 241.3;
    var $paperHSize = 150;
    var $height = 5;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function __construct() {
        parent::__construct();
        $pdf = new FPDF();
    }

    function newLine(){
        $pdf = new FPDF();
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
    }

    function save_pdf_t_lap_rekap_bphtb_hasil_verifikasi() {

        $date_start_laporan        = getVarClean('date_start_laporan', 'str', '');
        $date_end_laporan          = getVarClean('date_end_laporan', 'str', '');
        $registration_no   = getVarClean('registration_no', 'str', '');

        $param =  array('start_date' =>$date_start_laporan,
                        'end_date'=>$date_end_laporan,
                        'registration_no'=>$registration_no);



        $pdf = new FPDF("L", "mm", array(241.3, 150));
        

        $this->dataPDF($param,$pdf);

        $pdf->Output();
        
    } 

    function kopSurat($pdf,$encImageData){
      $pdf->AddPage();
      $pdf->Image(getValByCode('LOGO'),37,13,25,25);
      $pdf->Image(base_url().'/qrcode/generate-qr.php?param='.$encImageData,179,13,25,25,'PNG');
      
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
      $pdf->Cell(101, $this->height + 7, "Bukti SSPD Telah Divalidasi", "B", 0, 'C');
      $pdf->Cell(60, $this->height + 7, "", "B", 0, 'L');

      $pdf->Ln(5);
      $pdf->Ln();
    }

    function ttd($pdf){
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(151, $this->height, "", "", 0, 'C');
      $pdf->Cell(60, $this->height, "Koordinator BPHTB", "", 0, 'C');
      $pdf->Ln();

      $pdf->Cell(150, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(150, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(150, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(150, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(151, $this->height, "", "", 0, 'C');
      $pdf->Cell(60,  $this->height, "ZAENAL MANSUR", "", 0, 'C');
      $pdf->Ln();


      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(151, $this->height, "", "", 0, 'C');
      $pdf->Cell(60, $this->height, "NIP. 19630817.1989.01.1.006", "T", 0, 'C'); //isi nip
      $pdf->Ln();
    }




    function getDataEncrypt($f_bphtb_receipt_duplicate){

      $exp_data = explode("\n", $f_bphtb_receipt_duplicate); 
      $exp_data1 = explode(":", $exp_data[0]);

      $enc_data = "EmptyData";

      $sql = "select f_encrypt_str('".trim($exp_data1[1])."') AS enc_data";
      $output = $this->db->query($sql);
      $items = $output->result_array();

      if (!empty($items))
        $enc_data = $items[0]['enc_data'];


      return $enc_data;
    }

    function getDataReceiptDuplicate($registration_no){
      $sql = "select f_bphtb_receipt_duplicate('$registration_no')";
      $output = $this->db->query($sql);
      $items = $output->result_array();

      //$f_bphtb_receipt_duplicate = $items[0]['f_bphtb_receipt_duplicate'];

      return $items;
    }

    function getDataReceiptDuplicateAll($start_date,$end_date){
      $sql = "SELECT registration_no 
            FROM t_bphtb_registration
            WHERE trunc(creation_date) 
            BETWEEN '".$start_date."' AND '".$end_date."'
            AND status_verifikasi = 'Y'";

      $output = $this->db->query($sql);
      $items = $output->result_array();

      return $items;
    }
//234437
    function dataPDF($param,$pdf){
      $data = array();

      if (!empty($param['registration_no'])){
        $data = $this->getDataReceiptDuplicate($param['registration_no']);
        $this->show($data[0],$pdf);
      }else{

        $items = $this->getDataReceiptDuplicateAll($param['start_date'],$param['end_date']);
        foreach ($items as $item) {
          $data = $this->getDataReceiptDuplicate($item['registration_no']);
          $this->show($data[0],$pdf);

        }
      }
    }

    function show ($data,$pdf){

      $encImageData = $this->getDataEncrypt($data["f_bphtb_receipt_duplicate"]);

      

      $this->kopSurat($pdf,$encImageData);
      $pdf->SetFont('Courier', '', 10);
      $data = explode("\n", $data["f_bphtb_receipt_duplicate"]);
      foreach($data as $datum){
        $pdf->Cell(241.3, $this->height, $datum, 0, 0, "L");
        $pdf->Ln();
      }
      $this->ttd($pdf);
      
      
      
    }



    
    function dateToString($tanggal){
      if(empty($tanggal)) return "";
  
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
      
      $pieces = explode('-', $tanggal);
      
      return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
    }

    function dateToday(){
      $tanggal=date("m Y");
      if(empty($tanggal)) return "";
      
      $monthname = array(0  => '-',
                         01  => 'Januari',
                         02  => 'Februari',
                         03  => 'Maret',
                         04  => 'April',
                         05  => 'Mei',
                         06  => 'Juni',
                         07  => 'Juli',
                         08  => 'Agustus',
                         09  => 'September',
                         10 => 'Oktober',
                         11 => 'November',
                         12 => 'Desember');    
      
      $pieces = explode(' ', $tanggal);
      
      return $monthname[(int)$pieces[0]].' '.$pieces[1];
    }

}

