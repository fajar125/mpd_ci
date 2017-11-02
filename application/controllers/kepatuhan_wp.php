<?php defined('BASEPATH') OR exit('No direct script access allowed');

class kepatuhan_wp extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    function getTotalPerJenis($jenis_pajak, $p_finance_period_id, $tipe_patuh) {
        check_login();

        $sql = "SELECT COUNT(*) AS jumlah FROM f_rep_bpps_patuh(".$jenis_pajak.",".$p_finance_period_id.",".$tipe_patuh.")";
        $query = $this->db->query($sql);
        $jumlah_total = $query->row_array();
        return $jumlah_total;
    }

    function getGrandTotal($p_finance_period_id) {
        check_login();

        $sql = "SELECT SUM( JML) AS jumlah FROM (
                    SELECT count(*) AS JML from f_rep_bpps_patuh(null,".$p_finance_period_id.",1)
                    UNION ALL
                    SELECT count(*) AS JML from f_rep_bpps_patuh(null,".$p_finance_period_id.",2)
                    UNION ALL
                    SELECT count(*) AS JML from f_rep_bpps_patuh(null,".$p_finance_period_id.",3)
                 )";
        $query = $this->db->query($sql);
        $jumlah_total = $query->row_array();
        return $jumlah_total;
    }


    function getGrandTotalPerJenisPajak($jenis_pajak, $p_finance_period_id) {
        check_login();

        $sql = "SELECT SUM( JML) AS jumlah FROM (
                    SELECT count(*) AS JML from f_rep_bpps_patuh(".$jenis_pajak.",".$p_finance_period_id.",1)
                    UNION ALL
                    SELECT count(*) AS JML from f_rep_bpps_patuh(".$jenis_pajak.",".$p_finance_period_id.",2)
                    UNION ALL
                    SELECT count(*) AS JML from f_rep_bpps_patuh(".$jenis_pajak.",".$p_finance_period_id.",3)
                 )";
        $query = $this->db->query($sql);
        $jumlah_total = $query->row_array();
        return $jumlah_total;
    }

    function tampilDataGeneral(){
        check_login();

        $p_finance_period_id = getVarClean('p_finance_period_id','int',0);
        // echo $p_finance_period_id;
        // exit();

        $jumlah_total = $this->getGrandTotal($p_finance_period_id);  
        $total_patuh = $this->getTotalPerJenis('NULL',$p_finance_period_id,1);
        $total_kurang_patuh = $this->getTotalPerJenis('NULL',$p_finance_period_id,2);
        $total_tidak_patuh = $this->getTotalPerJenis('NULL',$p_finance_period_id,3);

        $prosentase_patuh = (int)$total_patuh['jumlah'] / (int)$jumlah_total['jumlah'] * 100;
        $prosentase_kurang_patuh = (int)$total_kurang_patuh['jumlah'] / (int)$jumlah_total['jumlah'] * 100;
        $prosentase_tidak_patuh = (int)$total_tidak_patuh['jumlah'] / (int)$jumlah_total['jumlah'] * 100;

        $kriteria = array('WP PATUH', 'WP KURANG PATUH', 'WP TIDAK PATUH');
        $total = array($total_patuh['jumlah'], $total_kurang_patuh['jumlah'], $total_tidak_patuh['jumlah']);
        $prosentase = array(round($prosentase_patuh,2), round($prosentase_kurang_patuh,2), round($prosentase_tidak_patuh,2));
        
        $s_result ="[";
        for ($i=0;$i<count($kriteria);$i++){
            $s_result = $s_result . '["'.$kriteria[$i].'",'.$total[$i].','.$prosentase[$i].'],';
        }
        $s_result = substr($s_result, 0, -1)  ;      

        $s_result = $s_result . "]";
        echo $s_result;
        exit;
    }

    function tampilDataDetail(){
        check_login();

        $p_finance_period_id = getVarClean('p_finance_period_id','int',0);

        $grand_total_hotel = $this->getGrandTotalPerJenisPajak(1, $p_finance_period_id);
        $grand_total_restoran = $this->getGrandTotalPerJenisPajak(2, $p_finance_period_id);
        $grand_total_hiburan = $this->getGrandTotalPerJenisPajak(3, $p_finance_period_id);
        $grand_total_parkir = $this->getGrandTotalPerJenisPajak(4, $p_finance_period_id);

        
        // ---- start hotel ---
        $hotel_patuh = $this->getTotalPerJenis(1,$p_finance_period_id,1);
        $hotel_kurang_patuh = $this->getTotalPerJenis(1,$p_finance_period_id,2);
        $hotel_tidak_patuh = $this->getTotalPerJenis(1,$p_finance_period_id,3);


        
        $hotel_persen_patuh = $hotel_patuh['jumlah'] / $grand_total_hotel['jumlah'] * 100;
        $hotel_persen_kurang_patuh = $hotel_kurang_patuh['jumlah'] / $grand_total_hotel['jumlah'] * 100;
        $hotel_persen_tidak_patuh = $hotel_tidak_patuh['jumlah'] / $grand_total_hotel['jumlah'] * 100;

        // print_r($hotel_persen_patuh);
        //  exit();
        // ---- end hotel ---
        

        // -- start restoran --
        $restoran_patuh = $this->getTotalPerJenis(2,$p_finance_period_id,1);
        $restoran_kurang_patuh = $this->getTotalPerJenis(2,$p_finance_period_id,2);
        $restoran_tidak_patuh = $this->getTotalPerJenis(2,$p_finance_period_id,3);
        
        $restoran_persen_patuh = $restoran_patuh['jumlah'] / $grand_total_restoran['jumlah'] * 100;
        $restoran_persen_kurang_patuh = $restoran_kurang_patuh['jumlah'] / $grand_total_restoran['jumlah'] * 100;
        $restoran_persen_tidak_patuh = $restoran_tidak_patuh['jumlah'] / $grand_total_restoran['jumlah'] * 100;

        // -- end restoran -- 
        

        //-- start hiburan  --
        $hiburan_patuh = $this->getTotalPerJenis(3,$p_finance_period_id,1);
        $hiburan_kurang_patuh = $this->getTotalPerJenis(3,$p_finance_period_id,2);
        $hiburan_tidak_patuh = $this->getTotalPerJenis(3,$p_finance_period_id,3);
        
        $hiburan_persen_patuh = $hiburan_patuh['jumlah'] / $grand_total_hiburan['jumlah'] * 100;
        $hiburan_persen_kurang_patuh = $hiburan_kurang_patuh['jumlah'] / $grand_total_hiburan['jumlah'] * 100;
        $hiburan_persen_tidak_patuh = $hiburan_tidak_patuh['jumlah'] / $grand_total_hiburan['jumlah'] * 100;

        // -- end hiburan -- 
        
        //-- start parkir --
        $parkir_patuh = $this->getTotalPerJenis(4,$p_finance_period_id,1);
        $parkir_kurang_patuh = $this->getTotalPerJenis(4,$p_finance_period_id,2);
        $parkir_tidak_patuh = $this->getTotalPerJenis(4,$p_finance_period_id,3);
        
        $parkir_persen_patuh = $parkir_patuh['jumlah'] / $grand_total_parkir['jumlah'] * 100;
        $parkir_persen_kurang_patuh = $parkir_kurang_patuh['jumlah'] / $grand_total_parkir['jumlah'] * 100;
        $parkir_persen_tidak_patuh = $parkir_tidak_patuh['jumlah'] / $grand_total_parkir['jumlah'] * 100;

        $jumlah = array(0 => array($hotel_patuh['jumlah'], $restoran_patuh['jumlah'], $hiburan_patuh['jumlah'], $parkir_patuh['jumlah']),
                  1 => array($hotel_kurang_patuh['jumlah'], $restoran_kurang_patuh['jumlah'], $hiburan_kurang_patuh['jumlah'], $parkir_kurang_patuh['jumlah']),
                  2 => array($hotel_tidak_patuh['jumlah'], $restoran_tidak_patuh['jumlah'], $hiburan_tidak_patuh['jumlah'], $parkir_tidak_patuh['jumlah']) 
                  );
        $persen = array(
                  0 => array($hotel_persen_patuh, $restoran_persen_patuh, $hiburan_persen_patuh, $parkir_persen_patuh),
                  1 => array($hotel_persen_kurang_patuh, $restoran_persen_kurang_patuh, $hiburan_persen_kurang_patuh, $parkir_persen_kurang_patuh),
                  2 => array($hotel_persen_tidak_patuh, $restoran_persen_tidak_patuh, $hiburan_persen_tidak_patuh, $parkir_persen_tidak_patuh) 
                  );

        $kriteria = array('WP PATUH', 'WP KURANG PATUH', 'WP TIDAK PATUH');
        $s_result ="[";
        for ($i=0;$i<count($kriteria);$i++){
            $s_result = $s_result . '["'.$kriteria[$i].'",';
            $k = count($jumlah[$i]) + count($persen[$i]);
            for ($j=0; $j < count($jumlah[$i]) ; $j++) { 
                $s_result .= $jumlah[$i][$j].','.$persen[$i][$j]. ',';
                

            }
            $s_result .= '],';
        }
        $s_result = substr($s_result, 0, -1)  ;      
        $s_result = str_replace(',]', ']', $s_result)  ;  

        $s_result = $s_result . "]";
        echo $s_result;
        exit;

       // print_r($jumlah[$i][$j]);
       
    }
    

}