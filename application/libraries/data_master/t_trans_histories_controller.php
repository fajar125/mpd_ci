<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class t_cust_customer_controller
* @version 07/05/2015 12:18:00
*/
class t_trans_histories_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','settlement_date');
        $sord = getVarClean('sord','str','desc');
        $t_cust_account_id = getVarClean('t_cust_account_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('data_master/t_trans_histories');
            $table = new t_trans_histories($t_cust_account_id);

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

    function excel(){
        $t_cust_account_id = getVarClean('t_cust_account_id','int',0);
        try {

            $ci = &get_instance();
            $ci->load->model('data_master/t_trans_histories');
            $table = $ci->t_trans_histories;

            $result = $table->get_t_trans_histories($t_cust_account_id);  
            
            $items = $result;

            startExcel("HISTORY_TRANSAKSI_WAJIB_PAJAK_".date('Y-m-d'));
            echo '<div align="center"><h3> DAFTAR WAJIB PAJAK</h3></div>';  
                
            echo '<table border="1">';
            echo '<tr>
                <th>NO</th>
                <th>NPWPD</th>
                <th>Nama Badan</th>
                <th>Jenis Ketetapan</th>
                <th>Ayat Pajak</th>
                <th>Periode Pelaporan</th>
                <th>Periode Transaksi</th>
                <th>Tgl. Pelaporan</th>
                <th>Total Transaksi</th>
                <th>Total Pajak</th>
                <th>Pajak Terhutang</th>
                <th>Kenaikan Pajak Terhutang</th>
                <th>Denda</th>
                <th>Total Harus Bayar</th>
                <th>No. Kwitansi</th>
                <th>Tgl. Pembayaran</th>
                <th>Nilai Pembayaran</th>
            </tr>';
            $no = 0;
            foreach ($items as $item) {
                echo '<tr>';
                echo '<td>' . ($no+1) . '</td>';
                echo '<td>' . $item['npwd'] . '</td>';
                echo '<td>' . $item['company_name'] . '</td>';
                echo '<td>' . $item['type_code'] . '</td>';
                echo '<td>' . $item['vat_code'] . '</td>';
                echo '<td>' . $item['periode_pelaporan'] . '</td>';
                echo '<td>' . $item['periode_transaksi'] . '</td>';
                echo '<td>' . $item['tgl_pelaporan'] . '</td>';
                echo '<td>' . $item['total_transaksi'] . '</td>';
                echo '<td>' . $item['total_pajak'] . '</td>';
                echo '<td>' . $item['debt_vat_amt'] . '</td>';
                echo '<td>' . $item['kenaikan'] . '</td>';
                echo '<td>' . $item['total_denda'] . '</td>';
                echo '<td>' . $item['total_hrs_bayar'] . '</td>';
                echo '<td>' . $item['kuitansi_pembayaran'] . '</td>';
                echo '<td>' . $item['tgl_pembayaran'] . '</td>';
                echo '<td>' . $item['payment_amount'] . '</td>';
                $no++;
            }

            echo '</table>';
            exit;
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    

    function destroy() {
        $ci = & get_instance();
        $ci->load->model('data_master/t_trans_histories');
        $table = $ci->t_trans_histories;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

        try{
            $table->db->trans_begin(); //Begin Trans

            $total = 0;
            if (is_array($items)){
                foreach ($items as $key => $value){
                    if (empty($value)) throw new Exception('Empty parameter');
                    $table->remove($value);
                    $data['rows'][] = array($table->pkey => $value);
                    $total++;
                }
            }else{
                $items = (int) $items;
                if (empty($items)){
                    throw new Exception('Empty parameter');
                }
                $table->remove($items);
                $data['rows'][] = array($table->pkey => $items);
                $data['total'] = $total = 1;
            }

            $data['success'] = true;
            $data['message'] = $total.' Data deleted successfully';
            logging('delete data bank branch');
            $table->db->trans_commit(); //Commit Trans

        }catch (Exception $e) {
            $table->db->trans_rollback(); //Rollback Trans
            $data['message'] = $e->getMessage();
            $data['rows'] = array();
            $data['total'] = 0;
        }
        return $data;
    }
}

/* End of file t_trans_histories_controller.php */