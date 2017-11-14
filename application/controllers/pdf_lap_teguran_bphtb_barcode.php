<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class pdf_lap_teguran_bphtb_barcode extends CI_Controller{
    var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 241.3;
    var $paperHSize = 279.4;
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

    function save_pdf_t_lap_teguran_bphtb() {

        $date_start_laporan        = getVarClean('date_start_laporan', 'str', '');
        $date_end_laporan          = getVarClean('date_end_laporan', 'str', '');
        $t_bphtb_registration_id   = getVarClean('t_bphtb_registration_id', 'str', '');
        //$FLAG                      = getVarClean('FLAG','int',0);

        $param =  array('start_date' =>$date_start_laporan,
                        'end_date'=>$date_end_laporan,
                        't_bphtb_registration_id'=>$t_bphtb_registration_id);

        $data = $this->getPDF($param);

        $pdf = new FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
        
        for($i=0;$i<count($data);$i++){
          //$this->showSurat($pdf,$data[$i],$FLAG);
          $this->showSurat($pdf,$data[$i]);
        }
        
        $pdf->Output();
    } 


    function kopSurat($pdf){
        $pdf->AliasNbPages();
        $pdf->SetLeftMargin(10);
        $pdf->AddPage("P");
        $pdf->AddFont('BKANT');
        
        $pdf->SetFont('BKANT', '', 12);
        
        $lheader = $this->lengthCell / 8;
        $lheader1 = $lheader * 1;
        $lheader2 = $lheader * 2;
        $lheader3 = $lheader * 3;
        $lheader4 = $lheader * 4;
        $lheader7 = $lheader * 7;
        
        $pdf->SetFont('BKANT', '', 12);

        $pdf->Image(getValByCode('LOGO'),17,13,25,25);

        $pdf->SetFont('TIMES', 'B', 14);
        $pdf->Cell(40, $this->height, "", "", 0, 'L');
        $pdf->Cell(181, $this->height, getValByCode('INSTANSI_1'), "", 0, 'C');
        
        $pdf->Ln();
        $pdf->SetFont('TIMES', 'B', 20);
        $pdf->Cell(40, $this->height+10, "", "", 0, 'L');
        $pdf->Cell(181, $this->height+10, getValByCode('INSTANSI_2'), "", 0, 'C');
        
        $pdf->Ln();
        $pdf->SetFont('BKANT', '', 12);
        $pdf->Cell(40, $this->height, "", "", 0, 'L');
        $pdf->Cell(181, $this->height, getValByCode('ALAMAT_5'), "", 0, 'C');

        $pdf->Ln(5);
        $pdf->Ln();

        $pdf->SetFont('BKANT', '', 12);
        $pdf->Cell($this->lengthCell, $this->height, "", "T", 100, 'L');
        $pdf->Ln();

    }

    function lampiran($pdf,$data){
        $lbody = $this->lengthCell / 4;
        $lbody1 = $lbody * 1;
        $lbody2 = $lbody * 2;
        $lbody3 = $lbody * 3;

        $pdf->SetWidths(array(21,2,38,49));
        $pdf->SetAligns(array("L","L","L","L"));
        $posy = $pdf->getY();
        $data["letter_no"] = trim($data["letter_no"]);
        if(!empty($data["letter_no"])){
          $pdf->RowMultiBorderWithHeight(
            array("Nomor",
              ":",
              /*$data["letter_no"]."-".$no_urut*/"",
              "-Disyanjak"
            ),
            array("",
              "",
              "",
              ""
            ),
            2
          );
        }else{
          $pdf->RowMultiBorderWithHeight(
            array("Nomor",
              ":",
              "",
              "-Disyanjak"
            ),
            array("",
              "",
              "",
              ""
            ),
            2
          );
        }

        $pdf->SetWidths(array(21,2,$this->lengthCell-22));
        $pdf->SetAligns(array("L","L","L"));
        $posy = $pdf->getY();

        $pdf->RowMultiBorderWithHeight(
          array("Sifat",
            ":",
            "  Biasa"
          ),
          array("",
            "",
            ""
          ),
          2
        );

        $pdf->RowMultiBorderWithHeight(
          array("Lampiran",
            ":",
            "  -"
          ),
          array("",
            "",
            ""
          ),
          2
        );

        $pdf->RowMultiBorderWithHeight(
          array("Perihal",
            ":",
            "  Konfirmasi Pembayaran BPHTB"
          ),
          array("",
            "",
            ""
          ),
          2
        );

        $this->tujuan($pdf,$data,$posy);
        
    }

    function tujuan($pdf,$data,$posy){
      $pdf->setY($posy-12);
      $today = getdate();
      $lkepada = $this->lengthCell / 5;
      $lkepada2 = $lkepada * 2;
      $lkepada3 = $lkepada * 3+20;
      
      $pdf->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
      $pdf->Cell($lkepada2-40, $this->height, getValByCode('ALAMAT_3').',', "", 0, 'L');
      $pdf->Cell(30, $this->height, $this->dateToday(), "", 0, 'R');
      $pdf->Ln();

      $pdf->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
      $pdf->Cell($lkepada2, $this->height, "Kepada Yth.", "", 0, 'L');
      $pdf->Ln();

      $pdf->SetAligns(array("L","L"));
      $pdf->SetWidths(array($lkepada3 - 20,"85"));
      $pdf->RowMultiBorderWithHeight(
        array("",
          substr($data['wp_name'],0, 23)
        ),
        array("",
          ""
        ),
        $this->height
      );
      
      $pdf->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
      $pdf->Cell($lkepada2, $this->height, "Di ", "", 0, 'L');
      $pdf->Ln();

      $pdf->SetAligns(array("L","L"));
      $pdf->SetWidths(array($lkepada3 - 20,"85"));
      $pdf->RowMultiBorderWithHeight(
        array("",
          $data['wp_address_name'].", RT ".$data['wp_rt']."/ RW ".$data['wp_rw']
        ),
        array("",
          ""
        ),
        $this->height
      );

      $pdf->SetAligns(array("L","L"));
      $pdf->SetWidths(array($lkepada3 - 20,"85"));
      $pdf->RowMultiBorderWithHeight(
        array("",
          "KEC. ".$data['kec']
        ),
        array("",
          ""
        ),
        $this->height
      );

      $pdf->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
      $pieces = explode("KABUPATEN ", $data['region_name']);
      $result = join("",$pieces);
      $pieces = explode("KOTA ", $result);
      $result = join("",$pieces);
      $pieces = explode(" KOTA", $result);
      $result = join("",$pieces);
      
          
      $pdf->Cell(85, $this->height, $result, "", 0, 'L');
      $pdf->Ln();$pdf->Ln();
    }

    function isi($pdf,$data){
      $pdf->SetFont('BKANT', '', 12);
      $pdf->SetAligns(array("L","L","L","L"));
      $pdf->SetWidths(array("25",200));
      $pdf->RowMultiBorderWithHeight(
        array("","Disampaikan dengan hormat, berdasarkan data pembukuan ".ucwords(strtolower(getValByCode('INSTANSI_2')))." ". getValByCode('ALAMAT_3') ." hingga saat ini tercatat, bahwa objek pajak :"
        ),
        array("",""
        ),
        5
      );

      $pdf->SetAligns(array("L","L","L","L"));
      $pdf->SetWidths(array("35","55","5",""));
      $pdf->RowMultiBorderWithHeight(
        array("",
          "Alamat\n".
          "NOP",
          ":\n".":",
          $data['object_address_name']."\n".$data['njop_pbb']
        ),
        array("",
          "",
          "",
          ""
        ),
        5
      );
      
      $pdf->SetWidths(array(25,170));
      $pdf->RowMultiBorderWithHeight(
        array("","Belum melakukan pembayaran pajak BPHTB Tahun ".date("Y")." dengan Nilai sebesar"
        ),
        array("",""
        ),
        5
      );

      $pdf->SetWidths(array(25,170));
      $pdf->RowMultiBorderWithHeight(
        array("","Rp. ".number_format($data['bphtb_amt_final'],2,",",".")." sesuai dengan : "
        ),
        array("",""
        ),
        5
      );
      
      $pdf->SetAligns(array("L","L","L","L"));
      $pdf->SetWidths(array("35","55","5",""));
      $pdf->RowMultiBorderWithHeight(
        array("","Nota Verifikasi BPHTB\n".
          "No Registrasi\n".
          "Tanggal",
          "\n:"."\n:",
          "\n".$data['registration_no'] .
          "\n".$this->dateToString($data['creation_date'])
        ),
        array("",
        "","",""
        ),
        5
      );

      $pdf->SetWidths(array(25,180));
      $pdf->RowMultiBorderWithHeight(
        array("","Berkenaan dengan hal tersebut di atas, dimohon untuk hadir memberikan penjelasan tentang realisasi pembayaran pajak BPHTB dimaksud selambat-lambatnya 2 (dua) hari setelah diterimanya surat ini, pada :"
        ),
        array("",""
        ),
        5
      );    
      $pdf->SetAligns(array("L","L","L","L"));
      $pdf->SetWidths(array("35","55","5","163"));
      $pdf->RowMultiBorderWithHeight(
        array("",
          "Tempat",
          ":",
          "Seksi Penyelesaian Piutang Pajak Bidang Pajak Pendaftaran\n".
          getValByCode('INSTANSI_2')." \nKabupaten ".getValByCode('ALAMAT_3') ." ".
          getValByCode('ALAMAT_6')." ".getValByCode('ALAMAT_3')
        ),
        array("",
          "",
          "",
          ""
        ),
        5
      );
      $pdf->RowMultiBorderWithHeight(
        array("",
          "Jam",
          ":",
          "08.00 s.d 16.00 WIB" 
        ),
        array("",
          "",
          "",
          ""
        ),
        5
      );
      
      $pdf->SetWidths(array(25,180));
      $pdf->RowMultiBorderWithHeight(
        array("","Apabila saudara/i tidak menyampaikan konfirmasi dilakukan lebih dari 2 (dua) hari setelah diterimanya surat ini atau tidak dilakukan sama sekali konfirmasi. Maka Nota Verifikasi tersebut dinyatakan tidak berlaku dan harus diperbaharui kembali."
        ),
        array("",""
        ),
        5
      );
      $pdf->RowMultiBorderWithHeight(
        array("","Demikian agar menjadi maklum, atas perhatian dan kerjasamanya diucapkan terima kasih."
        ),
        array("",""
        ),
        5
      );
    }

    //function ttd($pdf,$data,$FLAG){
    function ttd($pdf,$data){
      $ltable = ($this->lengthCell - 15) / 14;
      $ltable1 = $ltable * 1;
      $ltable2 = $ltable * 2;
      $ltable3 = $ltable * 3;
      $ltable6 = $ltable * 6;
      $ltable4 = $ltable * 4;

      
      $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');

      
      $lbody = $this->lengthCell / 16;
      $lbody2 = $lbody * 2;
      $lbody4 = $lbody * 4;

      $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
      $pdf->Ln();

      //$this->Image('../images/ttd_pa_soni.jpg',$lbody2+$lbody4+$lbody4-20,203,$lbody4+48,20);
      /*if ($FLAG==0){
        $pdf->Image(base_url().'/qrcode/generate-qr.php?param='.
        $data['njop_pbb']."_".
        $data['registration_no']."_".
        str_replace(" ","-",$this->dateToString($data['creation_date']))
        ,160,200,25,25,'PNG');
      }*/

      //Barcode

      $pdf->Image(base_url().'/qrcode/generate-qr.php?param='.
      $data['njop_pbb']."_".
      $data['registration_no']."_".
      str_replace(" ","-",$this->dateToString($data['creation_date']))
      ,160,200,25,25,'PNG');
      

      $pdf->SetFont('Times', 'B', 12);
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "an. KEPALA ".getValByCode('INSTANSI_2'), "", 0, 'C');
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Ln();
      
      $pdf->SetFont('Times', 'B', 12);
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Ln();

      $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
      $pdf->Ln();
      $pdf->Ln();
      
      $pdf->SetFont('Times', 'B', 12);
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
      $pdf->Cell($lbody4-5, $this->height, "", "", 0, 'C');
      //$pdf->Cell($lbody4+10, $this->height, "H. SONI BAKHTIYAR, S.Sos, M.Si", "B", 0, 'C');
      $pdf->Cell($lbody4+10, $this->height, "Drs. H. GUN GUN SUMARYANA", "B", 0, 'C');
      $pdf->Cell($lbody2-5, $this->height, "", "", 0, 'C');
      $pdf->Ln();
      
      $pdf->SetFont('Times', 'B', 12);
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'L');
      $pdf->Cell($lbody4, $this->height, "", "", 0, 'C');
      //$pdf->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
      $pdf->Cell($lbody4 - 2, $this->height, "NIP. 19700806 199101 1 001", "", 0, 'C'); //isi nip
      $pdf->Cell(2, $this->height, "", "", 0, 'L');
      $pdf->Cell($lbody2, $this->height, "", "", 0, 'C');
      $pdf->Ln();
    }

    function tembusan($pdf){
      $pdf->SetFont('Times', 'BU', 12);
      $pdf->Ln();
      $pdf->Cell(3, $this->height, "", "", 0, 'L');
      $pdf->Cell("21", $this->height, "Tembusan,", "", 0, 'L');
      $pdf->SetFont('BKANT', '', 12);
      $pdf->Cell("", $this->height, "disampaikan kepada Yth. :", "", 0, 'L');
      $pdf->Ln();
      $pdf->SetFont('BKANT', '', 12);
      $pdf->Cell(3, $this->height, "", "", 0, 'L');
      $pdf->Cell("", $this->height, "1. Bapak Kepala ".ucwords(strtolower(getValByCode('INSTANSI_2')))." (sebagai laporan)", "", 0, 'L');
      $pdf->Ln();
      $pdf->Cell(3, $this->height, "", "", 0, 'L');
      $pdf->Cell("", $this->height, "2. Bapak Kepala Badan Pertanahan Kabupaten ".getValByCode('ALAMAT_3'), "", 0, 'L');
    }

    //function showSurat($pdf,$data,$FLAG){
    function showSurat($pdf,$data){
      $this->kopSurat($pdf);
      $this->lampiran($pdf,$data);
      $this->isi($pdf,$data);
      $this->ttd($pdf,$data);
      $this->tembusan($pdf);
    }


    function getPDF($param = array()){

        $nomor_surat = $this->getNoSurat();


        $whereClause='';
        $data = array();

        if ($param['start_date'] != '' && $param['end_date']!='')
            $whereClause .= " AND (trunc(reg_bphtb.creation_date) BETWEEN '".$param['start_date']."' AND '".$param['end_date']."') ";


        $whereClause.= " AND NOT EXISTS (SELECT 1 FROM t_payment_receipt_bphtb as x WHERE x.t_bphtb_registration_id = reg_bphtb.t_bphtb_registration_id) ";


        $sql = "SELECT
                    reg_bphtb.t_bphtb_registration_id,
                    reg_bphtb.npwp,
                    reg_bphtb.wp_address_name,
                    to_char(reg_bphtb.creation_date, 'YYYY-MM-DD') as creation_date,
                    registration_no,
                    wp_name,
                    reg_bphtb.p_bphtb_legal_doc_type_id,
                    bphtb_doc.description,
                    njop_pbb,
                    land_area,
                    land_total_price,
                    building_area,
                    building_total_price,
                    market_price,
                    bphtb_amt_final,
                    object_address_name,
                    region.region_name,
                    kec.region_name as kec,
                    kel.region_name as kel,
                    reg_bphtb.wp_rt,
                    reg_bphtb.wp_rw
                  FROM
                    sikp.t_bphtb_registration reg_bphtb
                  LEFT JOIN p_bphtb_legal_doc_type bphtb_doc on bphtb_doc.p_bphtb_legal_doc_type_id = reg_bphtb.p_bphtb_legal_doc_type_id
                  LEFT JOIN t_customer_order cust_order ON cust_order.t_customer_order_id = reg_bphtb.t_customer_order_id 
                  LEFT JOIN t_payment_receipt_bphtb payment ON reg_bphtb.t_bphtb_registration_id = payment.t_bphtb_registration_id 
                  LEFT JOIN p_region region ON region.p_region_id = reg_bphtb.wp_p_region_id 
                  LEFT JOIN p_region kec ON kec.p_region_id = reg_bphtb.wp_p_region_id_kec
                  LEFT JOIN p_region kel ON kec.p_region_id = reg_bphtb.wp_p_region_id_kel
                  WHERE cust_order.p_order_status_id <> 1";
          $sql.= $whereClause;

          if(!empty($param['t_bphtb_registration_id'])) 
            $sql.= " AND reg_bphtb.t_bphtb_registration_id = ".$param['t_bphtb_registration_id'];


        $sql.= " order by trunc(reg_bphtb.creation_date) ASC,upper(wp_name) ASC";

        //echo ($sql);exit;

        $output = $this->db->query($sql);
        $items = $output->result_array();

        if ($items != null || $items != ''){
          foreach ($items as $item) {
            $data[] = array (
                      'creation_date'             => $item['creation_date'],   
                      'npwp'                      => $item['npwp'],   
                      'wp_address_name'           => $item['wp_address_name'],   
                      'registration_no'           => $item['registration_no'],
                      'wp_name'                   => $item['wp_name'],
                      'p_bphtb_legal_doc_type_id' => $item['p_bphtb_legal_doc_type_id'],
                      'description'               => $item['description'],
                      'njop_pbb'                  => $item['njop_pbb'],
                      'land_area'                 => $item['land_area'],
                      'land_total_price'          => $item['land_total_price'],
                      'building_area'             => $item['building_area'],
                      'building_total_price'      => $item['building_total_price'],
                      'market_price'              => $item['market_price'],
                      'bphtb_amt_final'           => $item['bphtb_amt_final'],
                      'object_address_name'       => $item['object_address_name'],
                      'region_name'               => $item['region_name'] ,
                      'kec'                       => $item['kec'] ,
                      'kel'                       => $item['kel'],
                      'wp_rt'                     => $item['wp_rt'],
                      'wp_rw'                     => $item['wp_rw'],
                      'nomor_surat'               => $nomor_surat ,
                      'letter_no'                 => ""
                    );
          }
        }
            
        
        return $data;
    }

    function getNoSurat(){
      $sql = "SELECT value from sikp.p_global_param where code ='NOMOR_SURAT_KONFIRMASI'";
      $output = $this->db->query($sql);
      $nomor_surat = "";
      $items = $output->result_array();
      if (!empty($items))
        $nomor_surat = $items[0]['value'];

      return $nomor_surat;
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


