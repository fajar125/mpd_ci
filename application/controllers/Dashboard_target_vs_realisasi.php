<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_target_vs_realisasi extends CI_Controller
{

    function __construct() {
        parent::__construct();

        check_login();
        
    }

    public function index(){
        $this->load->view('template/header');
        $this->load->view('template/scripts');
        $this->load->view('pelaporan/t_target_realisasi');
        $this->load->view('template/footer');

        

        
    }

    public function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        $p_year_period_id = $this->input->get('p_year_period_id');

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->t_target_realisasi;

            $req_param = array(
                "sort_by" => $sidx,
                "sord" => $sord,
                "limit" => null,
                "field" => null,
                "where" => null,
                "where_in" => null,
                "where_not_in" => null,
                "search" => isset($_REQUEST['_search']) ? $_REQUEST['_search'] : null,
                "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
            );

            // Filter Table
            $req_param['where'] = array();

            
            $req_param['where'][] = 'target_amt > 0 AND realisasi_amt > 0';
            

            
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
            logging('view data vat');
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
         
    }

    public function readLov() {

        $start = getVarClean('current','int',0);
        $limit = getVarClean('rowCount','int',5);

        $sort = getVarClean('sort','str','p_vat_type_id');
        $dir  = getVarClean('dir','str','asc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->v_target_realisasi_updated;

            if(!empty($searchPhrase)) {
                $table->setCriteria("upper(year_code) like upper('%".$searchPhrase."%')");
            }

            $start = ($start-1) * $limit;
            $items = $table->getAll($start, $limit, $sort, $dir);
            $totalcount = $table->countAll();

            $data['rows'] = $items;
            $data['success'] = true;
            $data['total'] = $totalcount;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        $this->load->view('pelaporan/t_target_realisasi', $data);
    }


    public function readPerJenis(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $p_vat_group_id = getVarClean('p_vat_group_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->t_target_realisasi;

            $result = $table->getItemPerJenis($p_year_period_id, $p_vat_group_id) ;
            $count = count($result);

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;


            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }


    }

    public function readPerBidang(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','t_revenue_target_id');
        $sord = getVarClean('sord','str','desc');

        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $p_vat_group_id = getVarClean('p_vat_group_id','int',0);


        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->t_target_realisasi;

            $result = $table->getItemPerBidang($p_year_period_id) ;
            $count = count($result);

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;


            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    }

    public function readPerBulan(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $p_vat_group_id = getVarClean('p_vat_group_id','int',0);
        $p_finance_period_id = getVarClean('p_finance_period_id','int',0);


        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->t_target_realisasi;

            $result = $table->getItemPerBulan($p_year_period_id, $p_vat_type_id) ;
            $count = count($result);

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;


            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    }

    public function readPerBulanDetail(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $p_year_period_id = getVarClean('p_year_period_id','int',0);
        $p_vat_type_id = getVarClean('p_vat_type_id','int',0);
        $p_finance_period_id = getVarClean('p_finance_period_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->t_target_realisasi;

            $finance_id = 0;

            if($p_finance_period_id == 1){
                $finance_id = "null";
            } else {
                 $finance_id = $p_finance_period_id;
            }


            $result = $table->getItemPerBulanDetail($p_year_period_id, $p_vat_type_id, $finance_id) ;
            $count = count($result);

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;


            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    }

    public function readPerBulanTmp(){
        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','p_year_period_id');
        $sord = getVarClean('sord','str','desc');

        $t_revenue_target_id = getVarClean('t_revenue_target_id','int',0);

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        
        try {

            $ci = & get_instance();
            $ci->load->model('pelaporan/t_target_realisasi');
            $table = $ci->t_target_realisasi;

            $result = $table->getItemPerBulanTmp($t_revenue_target_id) ;
            $count = count($result);

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;


            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $result;
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    }


}
