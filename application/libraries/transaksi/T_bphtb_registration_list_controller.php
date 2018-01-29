<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class T_bphtb_registration_list_controller
* @version 07/05/2015 12:18:00
*/
class T_bphtb_registration_list_controller {

    function read() {
        //exit;
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_bphtb_registration_id');
        $sord = getVarClean('sord','str','desc');
        $periode = getVarClean('periode','str','');
        $p_app_menu_id = getVarClean('p_app_menu_id','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;
             //$periode='201712';;

            $req_param = array(
                "sort_by" => $sidx,
                "sord" => $sord,
                "limit" => null,
                "field" => null,
                "where" => null,
                "where_in" => null,
                "where_not_in" => null,
                "search" => $_REQUEST['_search'],
                "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
            );

            // Filter Table
            $req_param['where'] = array();

            $table->setCriteria("cust_order.p_order_status_id =1");
            $table->setCriteria("(regis.p_bphtb_type_id is null or regis.p_bphtb_type_id = 1)");

            $table->setJQGridParam($req_param);
            $count = $table->countAll();

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            $req_param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );

            $table->setJQGridParam($req_param);

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $table->getAll();
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function read_update() {
        //exit;
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_bphtb_registration_id');
        $sord = getVarClean('sord','str','desc');
        $periode = getVarClean('periode','str','');
        $p_app_menu_id = getVarClean('p_app_menu_id','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;
             //$periode='201712';;

            $req_param = array(
                "sort_by" => $sidx,
                "sord" => $sord,
                "limit" => null,
                "field" => null,
                "where" => null,
                "where_in" => null,
                "where_not_in" => null,
                "search" => $_REQUEST['_search'],
                "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
            );

            // Filter Table
            $req_param['where'] = array();

            $table->setCriteria("(cust_order.p_order_status_id = 2 OR cust_order.p_order_status_id = 3)");
            $table->setCriteria("NOT EXISTS (SELECT 1 FROM t_payment_receipt_bphtb as x WHERE x.t_bphtb_registration_id = regis.t_bphtb_registration_id)");

            $table->setJQGridParam($req_param);
            $count = $table->countAll();

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            $req_param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );

            $table->setJQGridParam($req_param);

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $table->getAll();
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function read_detail_bphtb() {

        $id = getVarClean('id', 'int', 0);

        //exit;

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'records' => 0, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;

            $items = $table->getDetailBphtb($id);

            $data['items'] = $items;
            $data['success'] = true;
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;

    }

    function insert(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);

        $wp_name                        = getVarClean('wp_name','str','');
        $npwp                           = getVarClean('npwp','str','');
        $wp_address_name                = getVarClean('wp_address_name','str','');
        $wp_rt                          = getVarClean('wp_rt','str','');
        $wp_rw                          = getVarClean('wp_rw','str','');
        $wp_p_region_id                 = getVarClean('wp_p_region_id','int',0);
        $wp_p_region_id_kec             = getVarClean('wp_p_region_id_kec','int',0);
        $wp_p_region_id_kel             = getVarClean('wp_p_region_id_kel','int',0);
        $phone_no                       = getVarClean('phone_no','str','');
        $mobile_phone_no                = getVarClean('mobile_phone_no','str','');
        $njop_pbb                       = getVarClean('njop_pbb','str','');
        $object_letak_tanah             = getVarClean('object_letak_tanah','str','');
        $object_rt                      = getVarClean('object_rt','str','');
        $object_rw                      = getVarClean('object_rw','str','');
        $object_p_region_id             = getVarClean('object_p_region_id','str','');
        $object_p_region_id_kec         = getVarClean('object_p_region_id_kec','str','');
        $object_p_region_id_kel         = getVarClean('object_p_region_id_kel','str','');
        $p_bphtb_legal_doc_type_id      = getVarClean('p_bphtb_legal_doc_type_id','str','');
        $land_area                      = getVarClean('land_area','int',0);
        $land_price_per_m               = getVarClean('land_price_per_m','int',0);
        $land_total_price               = getVarClean('land_total_price','int',0);
        $building_area                  = getVarClean('building_area','int',0);
        $building_price_per_m           = getVarClean('building_price_per_m','int',0);
        $building_total_price           = getVarClean('building_total_price','int',0);
        $market_price                   = getVarClean('market_price','int',0);
        $npop                           = getVarClean('npop','int',0);
        $npop_tkp                       = getVarClean('npop_tkp','int',0);
        $npop_kp                        = getVarClean('npop_kp','int',0);
        $bphtb_amt                      = getVarClean('bphtb_amt','int',0);
        $bphtb_discount                 = getVarClean('bphtb_discount','int',0);
        $bphtb_amt_final                = getVarClean('bphtb_amt_final','int',0);
        $description                    = getVarClean('description','str','');
        $jenis_harga_bphtb              = getVarClean('jenis_harga_bphtb','int',0);
        $bphtb_legal_doc_description    = getVarClean('bphtb_legal_doc_description','str','');
        $check_potongan                 = getVarClean('check_potongan','str','');
        $add_disc_percent               = getVarClean('add_disc_percent','str','');
        $land_area_real                 = getVarClean('land_area_real','int',0);
        $land_price_real                = getVarClean('land_price_real','int',0);
        $building_area_real             = getVarClean('building_area_real','int',0);
        $building_price_real            = getVarClean('building_price_real','int',0);




        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;

            $param =  array('wp_name' =>$wp_name,
                            'npwp'=>$npwp,
                            'wp_address_name'=>$wp_address_name,
                            'wp_rt'=>$wp_rt,
                            'wp_rw'=>$wp_rw,
                            'wp_p_region_id'=>$wp_p_region_id,
                            'wp_p_region_id_kec'=>$wp_p_region_id_kec,
                            'wp_p_region_id_kel'=>$wp_p_region_id_kel,
                            'phone_no'=>$phone_no,
                            'mobile_phone_no'=>$mobile_phone_no,
                            'njop_pbb'=>$njop_pbb,
                            'object_letak_tanah'=>$object_letak_tanah,
                            'object_rt'=>$object_rt,
                            'object_rw'=>$object_rw,
                            'object_p_region_id'=>$object_p_region_id,
                            'object_p_region_id_kec'=>$object_p_region_id_kec,
                            'object_p_region_id_kel'=>$object_p_region_id_kel,
                            'p_bphtb_legal_doc_type_id'=>$p_bphtb_legal_doc_type_id,
                            'land_area'=>$land_area,
                            'land_price_per_m'=>$land_price_per_m,
                            'land_total_price'=>$land_total_price,
                            'building_area'=>$building_area,
                            'building_price_per_m'=>$building_price_per_m,
                            'building_total_price'=>$building_total_price,
                            'market_price'=>$market_price,
                            'npop'=>$npop,
                            'npop_tkp'=>$npop_tkp,
                            'npop_kp'=>$npop_kp,
                            'bphtb_amt'=>$bphtb_amt,
                            'bphtb_discount'=>$bphtb_discount,
                            'bphtb_amt_final'=>$bphtb_amt_final,
                            'description'=>$description,
                            'jenis_harga_bphtb'=>$jenis_harga_bphtb,
                            'bphtb_legal_doc_description'=>$bphtb_legal_doc_description,
                            'add_disc_percent'=>$add_disc_percent,
                            'check_potongan'=>$check_potongan,
                            'land_area_real'=>$land_area_real,
                            'land_price_real'=>$land_price_real,
                            'building_area_real'=>$building_area_real,
                            'building_price_real'=>$building_price_real);
            //print_r($param);exit;
            $result = $table->insert($param) ;

            //print_r($result);exit;
            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

    function update(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);

        $wp_name                        = getVarClean('wp_name','str','');
        $npwp                           = getVarClean('npwp','str','');
        $wp_address_name                = getVarClean('wp_address_name','str','');
        $wp_rt                          = getVarClean('wp_rt','str','');
        $wp_rw                          = getVarClean('wp_rw','str','');
        $wp_p_region_id                 = getVarClean('wp_p_region_id','int',0);
        $wp_p_region_id_kec             = getVarClean('wp_p_region_id_kec','int',0);
        $wp_p_region_id_kel             = getVarClean('wp_p_region_id_kel','int',0);
        $mobile_phone_no                = getVarClean('mobile_phone_no','str','');
        $njop_pbb                       = getVarClean('njop_pbb','str','');
        $object_address_name            = getVarClean('object_address_name','str','');
        $object_rt                      = getVarClean('object_rt','str','');
        $object_rw                      = getVarClean('object_rw','str','');
        $object_p_region_id             = getVarClean('object_p_region_id','str','');
        $object_p_region_id_kec         = getVarClean('object_p_region_id_kec','str','');
        $object_p_region_id_kel         = getVarClean('object_p_region_id_kel','str','');
        $p_bphtb_legal_doc_type_id      = getVarClean('p_bphtb_legal_doc_type_id','str','');
        $land_area                      = getVarClean('land_area','int',0);
        $land_price_per_m               = getVarClean('land_price_per_m','int',0);
        $land_total_price               = getVarClean('land_total_price','int',0);
        $building_area                  = getVarClean('building_area','int',0);
        $building_price_per_m           = getVarClean('building_price_per_m','int',0);
        $building_total_price           = getVarClean('building_total_price','int',0);
        $market_price                   = getVarClean('market_price','int',0);
        $npop                           = getVarClean('npop','int',0);
        $npop_tkp                       = getVarClean('npop_tkp','int',0);
        $npop_kp                        = getVarClean('npop_kp','int',0);
        $bphtb_amt                      = getVarClean('bphtb_amt','int',0);
        $bphtb_discount                 = getVarClean('bphtb_discount','int',0);
        $bphtb_amt_final                = getVarClean('bphtb_amt_final','int',0);
        $description                    = getVarClean('description','str','');
        $jenis_harga_bphtb              = getVarClean('jenis_harga_bphtb','int',0);
        $bphtb_legal_doc_description    = getVarClean('bphtb_legal_doc_description','str','');
        $add_disc_percent               = getVarClean('add_disc_percent','int',0);
        $land_area_real                 = getVarClean('land_area_real','int',0);
        $land_price_real                = getVarClean('land_price_real','int',0);
        $building_area_real             = getVarClean('building_area_real','int',0);
        $building_price_real            = getVarClean('building_price_real','int',0);
        $t_bphtb_registration_id        = getVarClean('t_bphtb_registration_id','int',0);




        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;

            $param =  array('wp_name' =>$wp_name,
                            'npwp'=>$npwp,
                            'wp_address_name'=>$wp_address_name,
                            'wp_rt'=>$wp_rt,
                            'wp_rw'=>$wp_rw,
                            'wp_p_region_id'=>$wp_p_region_id,
                            'wp_p_region_id_kec'=>$wp_p_region_id_kec,
                            'wp_p_region_id_kel'=>$wp_p_region_id_kel,
                            'mobile_phone_no'=>$mobile_phone_no,
                            'njop_pbb'=>$njop_pbb,
                            'object_address_name'=>$object_address_name,
                            'object_rt'=>$object_rt,
                            'object_rw'=>$object_rw,
                            'object_p_region_id'=>$object_p_region_id,
                            'object_p_region_id_kec'=>$object_p_region_id_kec,
                            'object_p_region_id_kel'=>$object_p_region_id_kel,
                            'p_bphtb_legal_doc_type_id'=>$p_bphtb_legal_doc_type_id,
                            'land_area'=>$land_area,
                            'land_price_per_m'=>$land_price_per_m,
                            'land_total_price'=>$land_total_price,
                            'building_area'=>$building_area,
                            'building_price_per_m'=>$building_price_per_m,
                            'building_total_price'=>$building_total_price,
                            'market_price'=>$market_price,
                            'npop'=>$npop,
                            'npop_tkp'=>$npop_tkp,
                            'npop_kp'=>$npop_kp,
                            'bphtb_amt'=>$bphtb_amt,
                            'bphtb_discount'=>$bphtb_discount,
                            'bphtb_amt_final'=>$bphtb_amt_final,
                            'description'=>$description,
                            'jenis_harga_bphtb'=>$jenis_harga_bphtb,
                            'bphtb_legal_doc_description'=>$bphtb_legal_doc_description,
                            'add_disc_percent'=>$add_disc_percent,
                            'land_area_real'=>$land_area_real,
                            'land_price_real'=>$land_price_real,
                            'building_area_real'=>$building_area_real,
                            'building_price_real'=>$building_price_real,
                            't_bphtb_registration_id'=>$t_bphtb_registration_id);


            $result = $table->update($param) ;
            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }

    function delete(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);

        $id= getVarClean('id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;
            $result = $table->delete($id) ;
            $count = count($result);

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;

    }


    function SubmitTable() {
        $t_bphtb_registration_id = getVarClean('t_bphtb_registration_id', 'int', 0);
        $t_customer_order_id = getVarClean('t_customer_order_id', 'int', 0);
        $check_potongan = getVarClean('check_potongan', 'str', '');

        //exit;

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'records' => 0, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;

            $sukses = true;

            if($check_potongan=='Y'){
                $items = $table->getOrderStatus($t_bphtb_registration_id);
                $p_order_status_id = $items['p_order_status_id'];
                if ($p_order_status_id!=3){
                    $data['message'] = "Proses Permohonan Pengurangan BPHTB Belum Selesai. Data tidak dapat disubmit";
                    $sukses = false;
                }
            }

            if ($sukses){
                $items = $table->getJumlahProductOrder($t_customer_order_id);
                $jumlah_data = $items['jml'];
                if($jumlah_data!=0){
                    $data['message'] = "Data BPHTB Sudah Tersubmit";
                    $sukses = false;
                }
            }

            if ($sukses){
                $items = $table->SubmitTable($t_customer_order_id);
                $f_first_submit_engine = $items['f_first_submit_engine'];

                $data['message'] = $f_first_submit_engine;
                $sukses = true;
            }

            //$data['result'] = $items;
            $data['success'] = $sukses;
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;

    }

    function read_ws() {

        $nop_search = getVarClean('nop_search','str','');
        $year_code = getVarClean('year_code','str','');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('transaksi/t_bphtb_registration_list');
            $table = $ci->t_bphtb_registration_list;

            $ws_data = $table->getDataWS($nop_search,$year_code);
            $arr_status = array(0 => 'Belum Dibayar', 1 => 'Sudah Dibayar');
            $new_data = array();

            if($ws_data['success']){
                $items = $ws_data['result'];

                $new_data['NOP']  = $items['nop'];
                $new_data['kota'] = $items['kota_wp_sppt'];
                $new_data['kecamatan'] = $items['nm_kecamatan'];
                $new_data['kelurahan'] = $items['kelurahan_wp_sppt'];

                $kota = $table->getDataKotaKabupaten($items['kota_wp_sppt']);
                $new_data['nama_kota'] = $kota['region_name'];
                $new_data['id_kota'] = $kota['p_region_id'];

                $kecamatan = $table->getDataKecamatan($items['nm_kecamatan'], $kota['p_region_id']);
                $new_data['nama_kecamatan'] = $kecamatan['region_name'];
                $new_data['id_kecamatan'] = $kecamatan['p_region_id'];

                $kelurahan = $table->getDataKelurahan($items['kelurahan_wp_sppt'], $kecamatan['p_region_id']);
                $new_data['nama_kelurahan'] = $kelurahan['region_name'];
                $new_data['id_kelurahan'] = $kelurahan['p_region_id'];

                $new_data['jalan'] = $items['jln_wp_sppt'];
                $new_data['rt'] = $items['rt_wp_sppt'];
                $new_data['rw'] = $items['rw_wp_sppt'];
                $new_data['luas_bumi'] = $items['luas_bumi_sppt'];
                $new_data['luas_bangunan'] = $items['luas_bng_sppt'];
                $new_data['njop_bangunan'] = $items['njop_bng_sppt'];
                $new_data['njop_bumi'] = $items['njop_bumi_sppt'];
                $new_data['njop_pbb'] = $items['njop_sppt'];
                $new_data['pbb_terhutang'] = $items['pbb_terhutang_sppt'];
                $new_data['pbb_yg_harus_dibayar'] = $items['pbb_yg_harus_dibayar_sppt'];
                $new_data['status_bayar'] = $arr_status[$items['status_pembayaran_sppt']];
            }

            $data['items'] = $new_data;
            $data['success'] = $ws_data['success'];
            $data['message'] = $ws_data['message'];
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }



}
