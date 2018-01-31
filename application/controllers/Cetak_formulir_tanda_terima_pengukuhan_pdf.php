<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Cetak_formulir_tanda_terima_pengukuhan_pdf extends CI_Controller{
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

        $t_customer_order_id = getVarClean('t_customer_order_id', 'str', '');
        $tgl = getVarClean('tgl', 'str', '');

        $pdf = new FPDF();
        

        $data = $this->getData($t_customer_order_id);
        $this->kopSurat($pdf,$data);
        $this->body($pdf,$data,$tgl);
        //print_r($data);exit;

        $pdf->Output();
        
    } 

    function kopSurat($pdf,$data){
      $pdf->AliasNbPages();
      $pdf->AddPage("P");
      $pdf->SetFont('Arial', '', 10);

      $lengthJudul1 = ($this->lengthCell * 3) / 9;
      $lengthJudul2 = ($this->lengthCell * 3) / 9;
      $lengthJudul3 = ($this->lengthCell * 3) / 9;
      $batas1 = ($lengthJudul3 * 2) / 5;
      $batas2 = ($lengthJudul3 * 3) / 5;

      $pdf->Image('images/logo_lombok.png',15,20,25,25);

      $length1 = ($this->lengthCell * 2) / 9;
      $length2 = ($this->lengthCell * 4) / 9;
      $length3 = ($this->lengthCell * 3) / 9;
      $kolom1 = ($length3 * 1) / 10;
      $kolom2 = ($length3 * 1) / 10;
      $kolom3 = ($length3 * 1) / 10;
      $kolom4 = ($length3 * 1) / 10;
      $kolom5 = ($length3 * 1) / 10;
      $kolom6 = ($length3 * 1) / 10;
      $kolom7 = ($length3 * 1) / 10;
      $kolom8 = ($length3 * 1) / 10;
      $penutup  = ($length3 * 2) / 10;

      $pdf->SetFont('Arial', '', 8);
      $pdf->Cell($length1, $this->height-4, "", "TL", 0, 'C');
      $pdf->Cell($length2, $this->height-4, "", "T", 0, 'C');
      $pdf->Cell($length3, $this->height-4, "", "TR", 0, 'L');
      $pdf->Ln();
      $this->seEnter($pdf);
      $pdf->Cell($length1, $this->height, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height, getValByCode('INSTANSI_1'), 0, 0, 'C');
      $pdf->Cell($length3, $this->height, "  Nomor Formulir", "R", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($length1, $this->height, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height, getValByCode('INSTANSI_2'), 0, 0, 'C');

      //nomor formulir
      $arr1 = str_split($data["order_no"]);
      $pdf->Cell($kolom1, $this->height, $arr1[0], 1, 0, 'C');
      $pdf->Cell($kolom2, $this->height, $arr1[1], 1, 0, 'C');
      $pdf->Cell($kolom3, $this->height, $arr1[2], 1, 0, 'C');
      $pdf->Cell($kolom4, $this->height, $arr1[3], 1, 0, 'C');
      $pdf->Cell($kolom5, $this->height, $arr1[4], 1, 0, 'C');
      $pdf->Cell($kolom6, $this->height, $arr1[5], 1, 0, 'C');
      $pdf->Cell($kolom7, $this->height, $arr1[6], 1, 0, 'C');
      $pdf->Cell($kolom8, $this->height, $arr1[7], 1, 0, 'C');
      $pdf->Cell($penutup, $this->height, "", "R", 0, 'C');
      //================
      $pdf->Ln();
      $pdf->Cell($length1, $this->height, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height, "Jl. Tioq Tata Tunaq", 0, 0, 'C');
      $pdf->Cell($length3, $this->height, "", "R", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($length1, $this->height, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height, "Telp. ".getValByCode('ALAMAT_4'), 0, 0, 'C');
      $pdf->Cell($length3, $this->height, "", "R", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($length1, $this->height, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height, "Fax. ".getValByCode('ALAMAT_4'), 0, 0, 'C');
      $pdf->Cell($length3, $this->height, "", "R", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($length1, $this->height, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height, getValByCode(' ALAMAT_3'), 0, 0, 'C');
      $pdf->Cell($length3, $this->height, "", "R", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($length1, $this->height-4, "", "L", 0, 'C');
      $pdf->Cell($length2, $this->height-4, "", "", 0, 'C');
      $pdf->Cell($length3, $this->height-4, "", "R", 0, 'L');
      $pdf->Ln();
    }

    function body($pdf,$data,$tgl){
      //--------------- ISI
          $this->printIsi($pdf,'Nama', 2);
          $this->printIsi($pdf,'Alamat', 3);
      /*
          $this->printIsi('Telah Menerima', 4, $data["isi"]);
      
      
      $this->Cell($kolom1, $this->height, "       Telah Menerima", "L", 0, 'L');
      $this->Cell($kolom2, $this->height, ":  ".$data["isi"], "R", 0, 'L');
      */
      $kolom1 = ($this->lengthCell * 3) / 8;
      $kolom2 = ($this->lengthCell * 5) / 8;
      $pdf->SetWidths(array($kolom1, $kolom2));
      $pdf->SetAligns(array("L", "L"));
      for ($i=0; $i<count($data['isi']); $i++) {
      $pdf->RowMultiBorderWithHeight(array("       Telah Menerima",
                          ":  ".$data["isi"])
                          ,
                      array('L',
                            'R')
                          ,$this->height);
      }
      
          $this->seEnter($pdf);
          $this->seEnter($pdf);

          //---------------- TTD
          $ttdKolom1 = ($this->lengthCell * 5) / 8;
          $ttdKolom2 = ($this->lengthCell * 3) / 8;
      
          $pdf->cell($ttdKolom1, $this->height, '', 'L', 0,'L');
          if ($tgl == ''){
        //$this->cell($ttdKolom2, $this->height, 'Lombok Utara, '. date('d F Y'), 'R', 0,'C');
        $pdf->cell($ttdKolom2, $this->height, 'Lombok Utara, ....................................................', 'R', 0,'C');
      }else{
        //$this->cell($ttdKolom2, $this->height, 'Lombok Utara, '. $tgl, 'R', 0,'C');
        $pdf->cell($ttdKolom2, $this->height, 'Lombok Utara, ....................................................', 'R', 0,'C');
      }
          $pdf->Ln();
          $pdf->cell($ttdKolom1, $this->height, '', 'L', 0,'C');
          $pdf->cell($ttdKolom2, $this->height, 'Yang Menerima', 'R', 0,'C');
          $pdf->Ln();
          $this->seEnter($pdf);
          $this->seEnter($pdf);
          $this->seEnter($pdf);
          $this->seEnter($pdf);
          $pdf->cell($ttdKolom1, $this->height, '', 'L', 0,'C');
          $pdf->cell($ttdKolom2, $this->height, '(...................................................)', 'R', 0,'C');
          $pdf->Ln();
          $this->seEnter($pdf);
          $pdf->cell($this->lengthCell, $this->height, '', 'LBR', 0,'C');
    }

    function printIsi($pdf,$jenis, $isi = "", $data = null) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFont('Arial', '', 10);
        $kolom1 = ($this->lengthCell * 3) / 8;
        $kolom2 = ($this->lengthCell * 5) / 8;
        $pdf->Cell($kolom1, $this->height, "       ".$jenis, "L", 0, 'L');

      if (is_numeric($isi)) {
        if ($data === null) {
          $pdf->Cell($kolom2, $this->height, ":  .......................................................................................................", "R", 0, 'L');
          $pdf->Ln();
          if ($isi > 1) {
            for ($index = 0; $index < $isi-1; $index++)
            {
              $pdf->Cell($kolom1, $this->height, "", "L", 0, 'L');
              $pdf->Cell($kolom2, $this->height, "   .......................................................................................................", "R", 0, 'L');
              $pdf->Ln();
            }
            $pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
          }
        } else{
          for($i = 0; $i < count($data); $i++){
            if($i == 0){
              $pdf->Cell($kolom2, $this->height, ":  " . $data[$i], "R", 0, "L");
            } else {
              $pdf->Cell($kolom1, $this->height, "", "L", 0, 'L');
              $pdf->Cell($kolom2, $this->height, "   " . $data[$i], "R", 0, "L");
            }
            
            $pdf->Ln();
          }
          $pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
        }
      } else {
        $pdf->Cell($kolom2, $this->height, ":  ".$isi, "R", 0, 'L');
      }
        $pdf->Ln();
    }

    function seEnter($pdf) {
        $pdf->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
        $pdf->Ln();
    }

   




    function getData($t_customer_order_id){


      $sql = "select a.order_no, 'Surat pengukuhan nomor :'|| b.reg_letter_no||' dengan NPWPD : '||b.npwpd as isi
                from t_customer_order a, t_vat_registration b
              where a.t_customer_order_id = b.t_customer_order_id
              and a.t_customer_order_id = ".$t_customer_order_id;

      $output = $this->db->query($sql);
      $items = $output->result_array();



      return $items[0];
    }

}

