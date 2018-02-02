<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Pdf_lap_bdhr extends CI_Controller{
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


    function save_pdf_t_rep_lap_bdhr($tgl_penerimaan, $kode_bank='') {
        $data = array();
        $sql = "select * from f_rep_lap_harian_bdhr_mod_2(?,?) order by nomor_ayat";        
        $output = $this->db->query($sql, array($tgl_penerimaan, $kode_bank));
        $items = $output->result_array();

        if($items == null || $items == '')
            $items = 'no result';
      

        $pdf = new FPDF();
        
        $pdf->AliasNbPages();
        $pdf->AddPage("L");
        $pdf->SetFont('Arial', '', 10);
        $pdf->Image(getValByCode('LOGO'),15,13,25,25);

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
        $pdf->Cell($lheader3, $this->height, getValByCode('INSTANSI_1'), "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "LAMPIRAN LAPORAN HARIAN", "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, getValByCode('INSTANSI_2'), "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "BENDAHARA PENERIMAAN", "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, getValByCode('ALAMAT_6'), "R", 0, 'C');
        
        $tahun = date("Y", strtotime($tgl_penerimaan));
        $pdf->Cell($lheader4, $this->height, "Tahun Anggaran " . $tahun, "R", 0, 'C');     
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "Telp. ".getValByCode('ALAMAT_4')." - ".getValByCode('ALAMAT_3'), "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "Tanggal Penerimaan " . $tgl_penerimaan, "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "", "BR", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "", "B", 0, 'L');
        $pdf->Cell($lheader1, $this->height, "", "BR", 0, 'L');
        $pdf->Ln();

        $ltable = $this->lengthCell / 20;
        $ltable1 = $ltable * 1;
        $ltable3 = $ltable * 3;
        $ltable4 = $ltable * 2.6;
        $ltable16 = $ltable * 16;

        //isi kolom
        $sepertiga = ($this->lengthCell - ($ltable1 + ($ltable1+1) + ($ltable1 * 5.2)))/3;
        $pdf->SetWidths(array($ltable1, $ltable1+1, $ltable1 * 5.2, $sepertiga,$sepertiga, $sepertiga));
        $pdf->SetAligns(array("C", "C", "C", "C", "C", "C"));
        
        $pdf->RowMultiBorderWithHeight(array("NO.",
                                              "AYAT",
                                              "PAJAK / RETRIBUSI",
                                              "JUMLAH\nHARI INI",
                                              "JUMLAH S/D\nHARI YANG LALU",
                                              "JUMLAH S/D\nHARI INI",
                                              ),
                                        array('TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR'
                                              )
                                              ,$this->height);
                                              
        $pdf->SetWidths(array($ltable1, $ltable1+1, $ltable1 * 5.2, $sepertiga/3*2,$sepertiga/3*1,$sepertiga/3*2,$sepertiga/3*1, $sepertiga/3*2,$sepertiga/3*1));
        $pdf->SetAligns(array("C", "C", "C", "C", "C", "C", "C", "C", "C"));
        
        $pdf->RowMultiBorderWithHeight(array("",
                                              "",
                                              "",
                                              "JUMLAH (Rp.)",
                                              "JUMLAH SSPD",
                                              "JUMLAH (Rp.)",
                                              "JUMLAH SSPD",
                                              "JUMLAH (Rp.)",
                                              "JUMLAH SSPD",
                                              ),
                                        array('TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR',
                                              'TBLR'
                                              )
                                              ,$this->height);                                    
        $no = 1;
        
        $jumlahperjenis = array();
        $jumlahtotal = 0;
        $jumlahtemp = 0;
        $jumlahperjenis_harilalu = array();
        $jumlahtotal_harilalu = 0;
        $jumlahtemp_harilalu = 0;
        $jumlahperjenis_hariini = array();
        $jumlahtotal_hariini = 0;
        $jumlahtemp_hariini = 0;
        $jml_transaksi_per_jenis_pajak = 0;
        $jml_transaksi_semua_jenis_pajak = 0;
        $jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
        $jml_transaksi_sampai_kemarin_semua_jenis_pajak = 0;
        $jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
        $jml_transaksi_sampai_hari_ini_semua_jenis_pajak = 0;
        if($items != 'no result'){
          for ($i = 0; $i < count($items); $i++) {
              $pdf->SetWidths(array($ltable1, $ltable1+1, $ltable1 * 5.2, $sepertiga/3*2,$sepertiga/3*1,$sepertiga/3*2,$sepertiga/3*1, $sepertiga/3*2,$sepertiga/3*1));
              $pdf->SetAligns(array("C", "L", "L", "R", "R", "R", "R", "R", "R"));
              $pdf->RowMultiBorderWithHeight(array($no,
                                                    $items[$i]["nomor_ayat"],
                                                    "P. " . strtoupper($items[$i]["nama_ayat"]),
                                                    number_format($items[$i]["jml_hari_ini"], 0, ',', '.'),
                                                    number_format($items[$i]["jml_transaksi"], 0, ',', '.'),
                                                    number_format($items[$i]["jml_sd_hari_lalu"], 0, ',', '.'),
                                                    number_format($items[$i]["jml_transaksi_sampai_kemarin"], 0, ',', '.'),
                                                    number_format($items[$i]["jml_sd_hari_ini"], 0, ',', '.'),
                                                    number_format($items[$i]["jml_transaksi_sampai_hari_ini"], 0, ',', '.')
                                                    ),
                                              array('TBLR',
                                                    'TBLR',
                                                    'TBLR',
                                                    'TBLR',
                                                    'TBLR',
                                                    'TBLR',
                                                    'TBLR',
                                                    'TBLR',
                                                    'TBLR'
                                                    )
                                                    ,$this->height);
              $no++;

               //hitung jml_hari_ini sampai baris ini
              $jumlahtemp += $items[$i]["jml_hari_ini"];
              $jumlahtotal += $items[$i]["jml_hari_ini"];
              $jumlahtemp_harilalu += $items[$i]["jml_sd_hari_lalu"];
              $jumlahtotal_harilalu += $items[$i]["jml_sd_hari_lalu"];
              $jumlahtemp_hariini += $items[$i]["jml_sd_hari_ini"];
              $jumlahtotal_hariini += $items[$i]["jml_sd_hari_ini"];
              $jml_transaksi_per_jenis_pajak += $items[$i]["jml_transaksi"];
              $jml_transaksi_semua_jenis_pajak += $items[$i]["jml_transaksi"];
              
              $jml_transaksi_sampai_kemarin_per_jenis_pajak += $items[$i]["jml_transaksi_sampai_kemarin"];
              $jml_transaksi_sampai_kemarin_semua_jenis_pajak += $items[$i]["jml_transaksi_sampai_kemarin"];

              $jml_transaksi_sampai_hari_ini_per_jenis_pajak += $items[$i]["jml_transaksi_sampai_hari_ini"];
              $jml_transaksi_sampai_hari_ini_semua_jenis_pajak += $items[$i]["jml_transaksi_sampai_hari_ini"];

              //cek apakah perlu bikin baris jumlah
              //jika iya, simpan jumlahtemp ke jumlahperjenis, print jumlahtemp, reset jumlahtemp
              $jenis = $items[$i]["nama_jns_pajak"];
              if((count($items)-1) != $i){                
                  $jenissesudah = $items[$i+1]["nama_jns_pajak"];
              }else{
                $jenissesudah = "";
              }             
              $pdf->SetFont('Arial', 'B', 10);
              if($jenis != $jenissesudah || $jenissesudah == ""){
                  $jumlahperjenis[] = $jumlahtemp;
                  $jumlahperjenis_harilalu[] = $jumlahtemp_harilalu;
                  $jumlahperjenis_hariini[] = $jumlahtemp_hariini;
                  $pdf->SetWidths(array($ltable1+ $ltable1+1+ $ltable1 * 5.2, $sepertiga/3*2,$sepertiga/3*1,$sepertiga/3*2,$sepertiga/3*1, $sepertiga/3*2,$sepertiga/3*1));
                  $pdf->SetAligns(array("C", "R", "R", "R", "R", "R", "R"));
                  
                  $pdf->RowMultiBorderWithHeight(array("JUMLAH " . strtoupper($items[$i]["nama_jns_pajak"]),
                                                        number_format($jumlahtemp, 0, ',', '.'),
                                                        number_format($jml_transaksi_per_jenis_pajak, 0, ',', '.'),
                                                        number_format($jumlahtemp_harilalu, 0, ',', '.'),
                                                        number_format($jml_transaksi_sampai_kemarin_per_jenis_pajak, 0, ',', '.'),
                                                        number_format($jumlahtemp_hariini, 0, ',', '.'),
                                                        number_format($jml_transaksi_sampai_hari_ini_per_jenis_pajak, 0, ',', '.')
                                                        ),
                                                  array('TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR'
                                                        )
                                                        ,$this->height);
                  
                  $jumlahtemp = 0;
                  $jumlahtemp_harilalu = 0;
                  $jumlahtemp_hariini = 0;
                  $jml_transaksi_per_jenis_pajak = 0;
                  $jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
                  $jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
              }

              if($i == count($items) - 1){
                  $pdf->SetWidths(array($ltable1+ $ltable1+1+ $ltable1 * 5.2, $sepertiga/3*2,$sepertiga/3*1,$sepertiga/3*2,$sepertiga/3*1, $sepertiga/3*2,$sepertiga/3*1));
                  $pdf->SetAligns(array("C", "R", "R", "R", "R", "R", "R"));
                  
                  $pdf->RowMultiBorderWithHeight(array("JUMLAH TOTAL" ,
                                                        number_format($jumlahtotal, 0, ',', '.'),
                                                        number_format($jml_transaksi_semua_jenis_pajak, 0, ',', '.'),
                                                        number_format($jumlahtotal_harilalu, 0, ',', '.'),
                                                        number_format($jml_transaksi_sampai_kemarin_semua_jenis_pajak, 0, ',', '.'),
                                                        number_format($jumlahtotal_hariini, 0, ',', '.'),
                                                        number_format($jml_transaksi_sampai_hari_ini_semua_jenis_pajak, 0, ',', '.')
                                                        ),
                                                  array('TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR',
                                                        'TBLR'
                                                        )
                                                        ,$this->height);
                  
                  $jumlahtotal = 0;
                  $jumlahtotal_harilalu = 0;
                  $jumlahtotal_hariini = 0;
                  $jml_transaksi_per_jenis_pajak = 0;
                  $jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
                  $jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
              }
              $pdf->SetFont('Arial', '', 10);
          }
        }

        
        $pdf->Ln();
        $this->newLine();
        $this->newLine();
        
        $lbody = $this->lengthCell / 4;
        $lbody1 = $lbody * 1;
        $lbody2 = $lbody * 2;
        $lbody3 = $lbody * 3;
        
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, getValByCode('ALAMAT_3').", " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "BENDAHARA PENERIMAAN, ", "", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "(                ".getValByCode('BENDAHARA_PENERIMAAN')."                )", "", 0, 'C');
        $pdf->Ln();

        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "NIP. ".getValByCode('NIP_BENDAHARA_PENERIMAAN'), "", 0, 'C');
        $pdf->Ln();

        $pdf->Output();
    }   

}