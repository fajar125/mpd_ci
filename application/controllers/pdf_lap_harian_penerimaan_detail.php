<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class pdf_lap_harian_penerimaan_detail extends CI_Controller{
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


    function save_pdf_t_rep_harian_penerimaan_detail($start_date, $end_date) {
        //echo $start_date." ".$end_date;exit();
        $data = array();
        $sql = "select * from f_rep_harian_murni(?, ?) order by nomor_ayat";  

        $output = $this->db->query($sql, array($start_date, $end_date));
        $items = $output->result_array();

        if($items == null || $items == '')
            $items = 'no result';
        //print_r($items);exit();
        

        /*print_r($tgl_penerimaan); 
        print_r($kode_bank);*/
        //print_r($flag_bdhr);       exit;

        //print_r($items); exit;

        $pdf = new FPDF();
        //$pdf->AddPage();
        //$pdf->SetFont('Arial','B',16);
        //$pdf->Cell(40,10,'Hello World! '.$angka1.' -> '.$angka2);
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
        $pdf->Cell($lheader4, $this->height, "LAPORAN HARIAN PENERIMAAN", "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, getValByCode('INSTANSI_2'), "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "", "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, getValByCode('ALAMAT_6'), "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, "Tanggal Penerimaan", "R", 0, 'C');   
        $pdf->Ln();
        $start_date = str_replace("'", "", $start_date);
        $end_date = str_replace("'", "", $end_date);
        $pdf->Cell($lheader1, $this->height, "", "L", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "Telp. ".getValByCode('ALAMAT_4')." - ".getValByCode('ALAMAT_3'), "R", 0, 'C');
        $pdf->Cell($lheader4, $this->height, $start_date . " s.d. " . $end_date, "R", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lheader1, $this->height, "", "LB", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "", "BR", 0, 'L');
        $pdf->Cell($lheader3, $this->height, "", "B", 0, 'L');
        $pdf->Cell($lheader1, $this->height, "", "BR", 0, 'L');
        $pdf->Ln();
        
        $ltable = $this->lengthCell / 44;
        $ltable1 = $ltable * 1;
        $ltable2 = $ltable * 2;
        $ltable3 = $ltable * 3;
        $ltable5 = $ltable * 5;
        $ltable16 = $ltable * 16;
        
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetAligns(array("C", "C","C","C","C"));
        $pdf->SetWidths(array($ltable1,$ltable5,$ltable3,$ltable1+$ltable3+$ltable1+$ltable3+$ltable1+$ltable3+$ltable1,$ltable1 + $ltable3 + $ltable1 + $ltable3 + $ltable1 + $ltable3,$ltable1+$ltable3+$ltable3+$ltable3));
        $pdf->RowMultiBorderWithHeight(array("","","","PENERIMAAN SSPD","PELAPORAN SPTPD",""),array("LTR","LTR","LTR","BT","LTBR","LTBR"),$this->height);
        $pdf->Cell($ltable1, $this->height, "NO.", "LR", 0, 'C');
        $pdf->Cell($ltable5, $this->height, "JENIS PAJAK", "LR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "TARGET", "LR", 0, 'C');
        $pdf->Cell($ltable1 + $ltable3, $this->height, "HARI INI", "TBLR", 0, 'C');
        $pdf->Cell($ltable1 + $ltable3, $this->height, "SD HARI LALU", "TBLR", 0, 'C');
        $pdf->Cell($ltable1 + $ltable3 + $ltable1, $this->height, "SD HARI INI", "TBLR", 0, 'C');
        //$this->Cell($ltable1 + $ltable3 + $ltable1 + $ltable3 + $ltable1 + $ltable3, $this->height, "REALISASI PENERIMAAN MURNI", "TBLR", 0, 'C');
        $pdf->Cell($ltable1 + $ltable3, $this->height, "HARI INI", "TBLR", 0, 'C');
        $pdf->Cell($ltable1 + $ltable3, $this->height, "SD HARI LALU", "TBLR", 0, 'C');
        $pdf->Cell($ltable1 + $ltable3, $this->height, "SD HARI INI", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SPTPD", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "SISA LEBIH/KRG", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "REALISASI THD", "TLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "JML REALISASI", "TLR", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($ltable1, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable5, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SSPD", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SSPD", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SSPD", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "%", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SPTPD", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SPTPD", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "SPTPD", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "THD KETETAPAN", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "PIUTANG", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
        $pdf->Ln();    
        $pdf->Cell($ltable1, $this->height, "A", "BLR", 0, 'C');
        $pdf->Cell($ltable5, $this->height, "B", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "C", "BLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "D", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "E", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "F", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "G", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "H", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "I", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "J", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "K", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "L", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "M", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "N", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "O", "TBLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "P", "TBLR", 0, 'C');
        $pdf->Cell($ltable1, $this->height, "K - D", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "|P - I|", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "Q", "BLR", 0, 'C');
        $pdf->Cell($ltable3, $this->height, "I + Q", "BLR", 0, 'C');
        $pdf->Ln(); 

        $j_target = array();
        $j_count_jml_hari_ini = array();
        $j_jml_hari_ini = array();
        $j_count_jml_sd_hari_lalu = array();
        $j_jml_sd_hari_lalu = array();
        $j_count_jml_sd_hari_ini = array();
        $j_jml_sd_hari_ini = array();
        $j_count_sptpd_jml_hari_ini = array();
        $j_sptpd_jml_hari_ini = array();
        $j_count_sptpd_jml_sd_hari_lalu = array();
        $j_sptpd_jml_sd_hari_lalu = array();
        $j_count_sptpd_jml_sd_hari_ini = array();
        $j_sptpd_jml_sd_hari_ini = array();
        $j_sptpd = array();
        $j_slktk = array();
        $j_slk4bln = array();
        $j_slk1thn= array();


        
        $no = 1;
        $tot_sptpd_thn_lalu=0;
        $tot_sptpd_thn_lalu_all=0;
        $no_jumlah=1;

        $j_t_target=0;
        $j_t_count_jml_hari_ini=0;
        $j_t_jml_hari_ini=0;
        $j_t_count_jml_sd_hari_lalu=0;
        $j_t_jml_sd_hari_lalu=0;
        $j_t_count_jml_sd_hari_ini=0;
        $j_t_jml_sd_hari_ini=0;
        $j_t_count_sptpd_jml_hari_ini=0;
        $j_t_sptpd_jml_hari_ini=0;
        $j_t_count_sptpd_jml_sd_hari_lalu=0;
        $j_t_sptpd_jml_sd_hari_lalu=0;
        $j_t_count_sptpd_jml_sd_hari_ini=0;
        $j_t_sptpd_jml_sd_hari_ini=0;
        $j_t_slktk=0;
        $j_t_slk1thn=0;
        if($items != 'no result'){
          for ($i = 0; $i < count($items); $i++) {
            //isi kolom
            $pdf->SetWidths(array($ltable1, $ltable2, $ltable3, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable3, $ltable3));
            $pdf->SetAligns(array("C", "C", "L", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
            //print data
            $pdf->SetFont('Arial', '', 6);
            $pdf->RowMultiBorderWithHeight(
            array($no,
                $items[$i]["kode_jns_pjk"] . "." . $items[$i]["type_ayat"],
                $items[$i]["nama_ayat"],
                number_format($items[$i]["target"], 0, ',', '.'),
                number_format($items[$i]["count_jml_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["jml_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["count_jml_sd_hari_lalu"], 0, ',', '.'),
                number_format($items[$i]["jml_sd_hari_lalu"], 0, ',', '.'),
                number_format($items[$i]["count_jml_sd_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["jml_sd_hari_ini"], 0, ',', '.'),
                0,
                number_format($items[$i]["count_sptpd_jml_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["sptpd_jml_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["count_sptpd_jml_sd_hari_lalu"], 0, ',', '.'),
                number_format($items[$i]["sptpd_jml_sd_hari_lalu"], 0, ',', '.'),
                number_format($items[$i]["count_sptpd_jml_sd_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["sptpd_jml_sd_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["count_sptpd_jml_hari_ini"] - $items[$i]["count_jml_hari_ini"], 0, ',', '.'),
                //buka dibawah ini untuk kembalikan ke semula
                //number_format($items[$i]["sptpd_jml_sd_hari_ini"][$i]-$items[$i]["jml_sd_hari_ini"][$i], 0, ',', '.'),
                number_format($items[$i]["jml_sd_hari_ini"], 0, ',', '.'),
                number_format($items[$i]["sptpd_thn_lalu"], 0, ',', '.'),
                //abs(number_format($items[$i]["sptpd_jml_sd_hari_ini"][$i]-$items[$i]["target"][$i], 0, ',', '.'))
                number_format($items[$i]["sptpd_thn_lalu"]+$items[$i]["jml_sd_hari_ini"], 0, ',', '.')
                ),
            array("TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR",
                "TBLR"
                ),
            $this->height);
            
            $no++;

            //hitung jml_hari_ini sampai baris ini
            $j_target[] = $items[$i]["target"];
            $j_count_jml_hari_ini[] = $items[$i]["count_jml_hari_ini"];
            $j_jml_hari_ini[] = $items[$i]["jml_hari_ini"];
            $j_count_jml_sd_hari_lalu[] = $items[$i]["count_jml_sd_hari_lalu"];
            $j_jml_sd_hari_lalu[] = $items[$i]["jml_sd_hari_lalu"];
            $j_count_jml_sd_hari_ini[] = $items[$i]["count_jml_sd_hari_ini"];
            $j_jml_sd_hari_ini[] = $items[$i]["jml_sd_hari_ini"];
            $j_count_sptpd_jml_hari_ini[] = $items[$i]["count_sptpd_jml_hari_ini"];
            $j_sptpd_jml_hari_ini[] = $items[$i]["sptpd_jml_hari_ini"];
            $j_count_sptpd_jml_sd_hari_lalu[] = $items[$i]["count_sptpd_jml_sd_hari_lalu"];
            $j_sptpd_jml_sd_hari_lalu[] = $items[$i]["sptpd_jml_sd_hari_lalu"];
            $j_count_sptpd_jml_sd_hari_ini[] = $items[$i]["count_sptpd_jml_sd_hari_ini"];
            $j_sptpd_jml_sd_hari_ini[] = $items[$i]["sptpd_jml_sd_hari_ini"];
            $j_sptpd[] = 0;
            //buka dibawah ini untuk kembalikan ke semula
            //$j_slktk[] = $items[$i]["sptpd_jml_sd_hari_ini"][$i]-$items[$i]["jml_sd_hari_ini"][$i];
            $j_slktk[] = $items[$i]["jml_sd_hari_ini"];
            $j_slk4bln[] = 0;
            $j_slk1thn[] = $items[$i]["sptpd_jml_sd_hari_ini"]-$items[$i]["target"];
            
            $pdf->SetWidths(array($ltable1 + $ltable2 + $ltable3, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable3, $ltable3));
            $pdf->SetAligns(array("C", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
            //cek apakah perlu bikin baris jumlah
            //jika iya, simpan jumlahtemp ke jumlahperjenis, print jumlahtemp, reset jumlahtemp
            $jenis = $items[$i]["nama_jns_pajak"];
            if((count($items)-1) != $i){                
                  $jenissesudah = $items[$i+1]["nama_jns_pajak"];
              }else{
                $jenissesudah = "";
              }
            //$jenissesudah = $items[$i+1]["nama_jns_pajak"];
            $tot_sptpd_thn_lalu = $tot_sptpd_thn_lalu + $items[$i]['sptpd_thn_lalu'];
            $tot_sptpd_thn_lalu_all = $tot_sptpd_thn_lalu_all + $items[$i]['sptpd_thn_lalu'];
            $pdf->SetFont('Arial', 'B', 6);
            if($jenis != $jenissesudah || $jenissesudah == ""){
              
                  $pdf->RowMultiBorderWithHeight(
                array("JUMLAH " . strtoupper($items[$i]["nama_jns_pajak"]),
                    number_format(array_sum($j_target), 0, ',', '.'),
                    number_format(array_sum($j_count_jml_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_jml_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_count_jml_sd_hari_lalu), 0, ',', '.'),
                    number_format(array_sum($j_jml_sd_hari_lalu), 0, ',', '.'),
                    number_format(array_sum($j_count_jml_sd_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_jml_sd_hari_ini), 0, ',', '.'),
                    0,
                    number_format(array_sum($j_count_sptpd_jml_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_sptpd_jml_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_count_sptpd_jml_sd_hari_lalu), 0, ',', '.'),
                    number_format(array_sum($j_sptpd_jml_sd_hari_lalu), 0, ',', '.'),
                    number_format(array_sum($j_count_sptpd_jml_sd_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_sptpd_jml_sd_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_count_sptpd_jml_hari_ini)-array_sum($j_count_jml_hari_ini), 0, ',', '.'),
                    number_format(array_sum($j_slktk), 0, ',', '.'),
                    number_format($tot_sptpd_thn_lalu, 0, ',', '.'),
                    number_format(array_sum($j_jml_sd_hari_ini)+$tot_sptpd_thn_lalu, 0, ',', '.')
                    ),
                array("TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR",
                    "TBLR"
                    ),
                  $this->height);
                  $no_jumlah++;

                  $j_t_target += array_sum($j_target);
                  $j_t_count_jml_hari_ini += array_sum($j_count_jml_hari_ini);
                  $j_t_jml_hari_ini += array_sum($j_jml_hari_ini);
                  $j_t_count_jml_sd_hari_lalu += array_sum($j_count_jml_sd_hari_lalu);
                  $j_t_jml_sd_hari_lalu += array_sum($j_jml_sd_hari_lalu);
                  $j_t_count_jml_sd_hari_ini  += array_sum($j_count_jml_sd_hari_ini);
                  $j_t_jml_sd_hari_ini  += array_sum($j_jml_sd_hari_ini);
                  $j_t_count_sptpd_jml_hari_ini += array_sum($j_count_sptpd_jml_hari_ini);
                  $j_t_sptpd_jml_hari_ini += array_sum($j_sptpd_jml_hari_ini);
                  $j_t_count_sptpd_jml_sd_hari_lalu += array_sum($j_count_sptpd_jml_sd_hari_lalu);
                  $j_t_sptpd_jml_sd_hari_lalu += array_sum($j_sptpd_jml_sd_hari_lalu);
                  $j_t_count_sptpd_jml_sd_hari_ini  += array_sum($j_count_sptpd_jml_sd_hari_ini);
                  $j_t_sptpd_jml_sd_hari_ini  += array_sum($j_sptpd_jml_sd_hari_ini);
                  $j_t_sptpd = 0;
                  $j_t_slktk += array_sum($j_slktk);
                  $j_t_slk4bln = 0;
                  $j_t_slk1thn +=array_sum($j_slk1thn);

                  //Re-initialize
                  $j_target = array();
                  $j_count_jml_hari_ini = array();
                  $j_jml_hari_ini = array();
                  $j_count_jml_sd_hari_lalu = array();
                  $j_jml_sd_hari_lalu = array();
                  $j_count_jml_sd_hari_ini = array();
                  $j_jml_sd_hari_ini = array();
                  $j_count_sptpd_jml_hari_ini = array();
                  $j_sptpd_jml_hari_ini = array();
                  $j_count_sptpd_jml_sd_hari_lalu = array();
                  $j_sptpd_jml_sd_hari_lalu = array();
                  $j_count_sptpd_jml_sd_hari_ini = array();
                  $j_sptpd_jml_sd_hari_ini = array();
                  $j_sptpd = array();
                  $j_slktk = array();
                  $j_slk4bln = array();
                  $j_slk1thn= array();
                  $tot_sptpd_thn_lalu=0;
            }
            
            

            //Total
            if($i == count($items) - 1 ){
              $pdf->RowMultiBorderWithHeight(
              array("JUMLAH TOTAL",
                  number_format($j_t_target, 0, ',', '.'),
                  number_format($j_t_count_jml_hari_ini, 0, ',', '.'),
                  number_format($j_t_jml_hari_ini, 0, ',', '.'),
                  number_format($j_t_count_jml_sd_hari_lalu, 0, ',', '.'),
                  number_format($j_t_jml_sd_hari_lalu, 0, ',', '.'),
                  number_format($j_t_count_jml_sd_hari_ini, 0, ',', '.'),
                  number_format($j_t_jml_sd_hari_ini, 0, ',', '.'),
                  0,
                  number_format($j_t_count_sptpd_jml_hari_ini, 0, ',', '.'),
                  number_format($j_t_sptpd_jml_hari_ini, 0, ',', '.'),
                  number_format($j_t_count_sptpd_jml_sd_hari_lalu, 0, ',', '.'),
                  number_format($j_t_sptpd_jml_sd_hari_lalu, 0, ',', '.'),
                  number_format($j_t_count_sptpd_jml_sd_hari_ini, 0, ',', '.'),
                  number_format($j_t_sptpd_jml_sd_hari_ini, 0, ',', '.'),
                  number_format($j_t_count_sptpd_jml_hari_ini-$j_t_count_jml_hari_ini, 0, ',', '.'),
                  number_format($j_t_slktk, 0, ',', '.'),
                  number_format($tot_sptpd_thn_lalu_all, 0, ',', '.'),
                  number_format($j_t_jml_sd_hari_ini+$tot_sptpd_thn_lalu_all, 0, ',', '.')
                  ),
              array("TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR",
                  "TBLR"
                  ),
                $this->height);
            }
            $pdf->SetFont('Arial', '', 8);


          }
        }       
        
        $pdf->Ln();
        
        
        $pdf->Ln();
        $this->newLine();
        $this->newLine();
        
        $lbody = $this->lengthCell / 4;
        $lbody1 = $lbody * 1;
        $lbody2 = $lbody * 2;
        $lbody3 = $lbody * 3;
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "Lombok, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
        $pdf->Ln();
        //$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        //$this->Cell($lbody1 + 10, $this->height, "BENDAHARA PENERIMAAN, ", "", 0, 'C');
        $pdf->SetWidtHs(array($lbody3 - 10,$lbody1 + 10));
        $pdf->SetAligns(array("C", "C","C","C","C"));
        $pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN"),array("",""),$this->height);
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        //$this->Cell($lbody1 + 10, $this->height, "KOTA BANDUNG", "", 0, 'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        //$this->newLine();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "(Drs. H. UGAS RAHMANSYAH, SAP, MAP)", "", 0, 'C');
        $pdf->Ln();
        $pdf->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
        $pdf->Cell($lbody1 + 10, $this->height, "(NIP 19640127 199703 1001)", "", 0, 'C');

        $pdf->Output();
    }   

}