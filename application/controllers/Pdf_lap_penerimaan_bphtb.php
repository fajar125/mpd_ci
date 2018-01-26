<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf/fpdf.php');
require('fpdf/invClassExtend.php');

class Pdf_lap_penerimaan_bphtb extends CI_Controller{
    var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode="";
    var $paperWSize = 216;
    var $paperHSize = 356;
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

    


    function save_pdf_t_lap_penerimaan_bphtb() {

        $date_start_laporan        = getVarClean('date_start_laporan', 'str', '');
        $date_end_laporan          = getVarClean('date_end_laporan', 'str', '');
        $receipt_no                = getVarClean('receipt_no','str','');
        $njop_pbb                  = getVarClean('njop_pbb', 'str', '');
        $wp_name                   = getVarClean('wp_name', 'str', '');
        $p_region_id_kecamatan     = getVarClean('p_region_id_kecamatan','str','');
        $p_region_id_kelurahan     = getVarClean('p_region_id_kelurahan', 'str', '');
        $p_bphtb_legal_doc_type_id = getVarClean('p_bphtb_legal_doc_type_id', 'str', '');
        $verificated_by            = getVarClean('verificated_by','str','');

        $param =  array('start_date' =>$date_start_laporan,
                        'end_date'=>$date_end_laporan,
                        'no_transaksi'=>$receipt_no,
                        'nop'=>$njop_pbb,
                        'nama'=>$wp_name,
                        'kec'=>$p_region_id_kecamatan,
                        'kel'=>$p_region_id_kelurahan,
                        'jenis_transaksi'=>$p_bphtb_legal_doc_type_id,
                        'nama_pemeriksa'=>$verificated_by);

        $items = $this->getPDF($param);

        $_BORDER = 0;
        $_FONT = 'Times';
        $_FONTSIZE = 10;

        $pdf = new FPDF('L','mm',array(216 ,356));
        $pdf->AliasNbPages();
        $pdf->AddPage("Landscape",'Legal');
        $pdf->SetFont('helvetica', '', $_FONTSIZE);
        $pdf->SetRightMargin(5);
        $pdf->SetLeftMargin(9);
        $pdf->SetAutoPageBreak(false,0);

        $pdf->SetFont('helvetica', '',12);
        $pdf->SetWidths(array(200));
        $pdf->ln(1);
        $pdf->RowMultiBorderWithHeight(array("LAPORAN PENERIMAAN BPHTB "),array('',''),6);

        $pdf->SetWidths(array(40,200));
        $pdf->ln(4);
        $pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".$this->dateToString($date_start_laporan, true)." s/d ".$this->dateToString($date_end_laporan, true)),array('',''),6);



        /* HEADER */
        $pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetWidths(array(10,28,35,19,19,41,51,28,28,15,15,25,28));
        $pdf->SetFont('arial', 'B',7);
        $pdf->RowMultiBorderWithHeight(
                                        array("NO",
                                              "NO TRANSAKSI",
                                              "NOP",
                                              "TGL BAYAR",
                                              "TGL DAFTAR",
                                              "NAMA",
                                              "ALAMAT",
                                              "KELURAHAN",
                                              "KECAMATAN",
                                              "LUAS TNH",
                                              "LUAS BGN",
                                              "NJOP (Rp)",
                                              "TOTAL BAYAR (Rp)"
                                          ),
                                        array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','TLBR'),
                                        $this->height);
        /* END HEADER */

        /* CONTENTS */
        $pdf->SetFont('arial', '',8);
        $no =1;
        $pdf->SetAligns(Array('C','L','L','C','C','L','L','L','L','R','R','R','R'));
        $total_nilai_penerimaan = 0;
        if ($items != 'no result'){
          foreach ($items as $item){
            $pdf->RowMultiBorderWithHeight(array($no,
                              $item['receipt_no'],
                              $item['njop_pbb'],
                              $this->dateToString($item['payment_date']),
                              $this->dateToString($item['creation_date']),
                              trim(strtoupper($item['wp_name'])),
                              $item['wp_address_name'],
                              $item['kelurahan_name'],
                              $item['kecamatan_name'],
                              number_format($item['land_area'],0),
                              number_format($item['building_area'],0),
                              number_format($item['land_total_price'],0,",","."),
                              number_format($item['payment_amount'],0,",",".")
                              ),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
            
            $total_nilai_penerimaan += $item['payment_amount'];
            $no++;
          }
          /* END CONTENTS */
        }

        /* BOTTOM */
        $pdf->SetWidths(array(314,28));
        $pdf->SetAligns(Array('C','R'));
        $pdf->SetFont('arial', 'B',8);
        $pdf->RowMultiBorderWithHeight(array("TOTAL", number_format($total_nilai_penerimaan,0,",",".")), array('LB','LBR'), 6);
        /* END BOTTOM */

        $pdf->ln(12);
  
        $pdf->SetAligns(array("C", "C"));
        $pdf->SetWidths(array(169, 163));
        if ($date_start_laporan==''){
          //$pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Kepala Seksi Penyelesaian Piutang \n\n\n\n\n\n\n\n DIN KAMADIANTINI S.IP, MM ","\n Admin Penerimaan BPHTB"."\n\n\n\n\n\n\n\n INDRA WISNU, SE. "), array("",""), 4 );
          //$pdf->RowMultiBorderWithHeight( array("(NIP : 19710320.199803.2.006)","(NIP : 19731031.2009.1.1001)"), array("",""), 1 );
			$pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Bendahara Penerimaan BPHTB \n\n\n\n\n\n\n\n ".getValByCode('BENDAHARA_PENERIMAAN')." ",""), array("",""), 4 );
			$pdf->RowMultiBorderWithHeight( array("(NIP : ".getValByCode('NIP_BENDAHARA_PENERIMAAN').")",""), array("",""), 1 );
		}else{
          /*if (date (strtotime($date_start_laporan)) < date (strtotime('01-06-2015'))){
            $pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Kepala Seksi Penyelesaian Piutang \n\n\n\n\n\n\n\n RACHMAT SATIADI, S.IP, M.Si  ","\n Admin Penerimaan BPHTB"."\n\n\n\n\n\n\n\n INDRA WISNU, SE.  "), array("",""), 4 );
            $pdf->RowMultiBorderWithHeight( array("(NIP : 19691104.199803.1.007)","(NIP : 19731031.2009.1.1001)"), array("",""), 1 );
          }else{
            $pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Kepala Seksi Penyelesaian Piutang \n\n\n\n\n\n\n\n DIN KAMADIANTINI S.IP, MM  ","\n Admin Penerimaan BPHTB"."\n\n\n\n\n\n\n\n INDRA WISNU, SE. "), array("",""), 4 );
            $pdf->RowMultiBorderWithHeight( array("(NIP : 19710320.199803.2.006)","(NIP : 19731031.2009.1.1001)"), array("",""), 1 );
          }*/
		  $pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Bendahara Penerimaan BPHTB \n\n\n\n\n\n\n\n ".getValByCode('BENDAHARA_PENERIMAAN')." ",""), array("",""), 4 );
		  $pdf->RowMultiBorderWithHeight( array("(NIP : ".getValByCode('NIP_BENDAHARA_PENERIMAAN').")",""), array("",""), 1 );
        }

        $pdf->Output("","I");
    } 



    /*
    
    Function untuk mengambil data pdf dari database
    Start
    */

    function getPDF($param = array()){

        $whereClause='';
        $criteria = array();

        if ($param['start_date'] != '' && $param['end_date']!='')
            $criteria[] = " (trunc(a.payment_date) BETWEEN '".$param['start_date']."' AND '".$param['end_date']."') ";

        if ($param['no_transaksi'] != '' )
            $criteria[] = " a.receipt_no ILIKE '%".$param['no_transaksi']."%' ";

        if ($param['nop'] != '' )
            $criteria[] = " b.njop_pbb = '".$param['nop']."' ";

        if ($param['nama'] != '' )
            $criteria[] = " b.wp_name ILIKE '%".$param['nama']."%' ";

        if ($param['kec'] != '' )
            $criteria[] = " b.object_p_region_id_kec = ".$param['kec'];

        if ($param['kel'] != '' )
            $criteria[] = " b.object_p_region_id_kel = ".$param['kel'];

        if ($param['jenis_transaksi'] != '' )
            $criteria[] = " b.p_bphtb_legal_doc_type_id = ".$param['jenis_transaksi'];

        if ($param['nama_pemeriksa'] != '' )
            $criteria[] = " b.verificated_by ilike '%".$param['nama_pemeriksa']."%' ";

        $whereClause = join(" AND ", $criteria);

        $sql = "SELECT 
                    a.receipt_no, 
                    b.njop_pbb, 
                    to_char(a.payment_date, 'YYYY-MM-DD') AS payment_date, 
                    to_char(b.creation_date, 'YYYY-MM-DD') AS creation_date, 
                    b.wp_name, 
                    b.wp_address_name, 
                    kelurahan.region_name AS kelurahan_name, 
                    kecamatan.region_name AS kecamatan_name, 
                    b.land_area, 
                    b.building_area, 
                    b.land_total_price, 
                    a.payment_amount
                FROM t_payment_receipt_bphtb AS a 
                    LEFT JOIN t_bphtb_registration AS b 
                ON a.t_bphtb_registration_id = b.t_bphtb_registration_id 
                    LEFT JOIN p_region AS kelurahan 
                ON b.wp_p_region_id_kel = kelurahan.p_region_id 
                    LEFT JOIN p_region AS kecamatan 
                ON b.wp_p_region_id_kec = kecamatan.p_region_id ";

        if(!empty($whereClause))
            $sql.= " WHERE ".$whereClause;

        $sql.= " order by trunc(b.creation_date) ASC, upper(b.wp_name) ASC";

        $output = $this->db->query($sql);
        $items = $output->result_array();

        if ($items == null || $items == '')
            $items = 'no result';
        
        return $items;
  } 

    // end get data

  function dateToString($date){
    if(empty($date)) return "";
    
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
    
    $pieces = explode('-', $date);
    
    return $pieces[2].'-'.$monthname[(int)$pieces[1]].'-'.$pieces[0];
  }

}