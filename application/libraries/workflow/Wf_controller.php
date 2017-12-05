<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Groups_controller
* @version 07/05/2015 12:18:00
*/
class Wf_controller {

    function list_inbox() {
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $items = $table->getListInbox($userinfo['app_user_name']);

        $strOutput = '';
        $total = 0;

        $strOutput = '
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <table class="table table-hover table-striped">
                                <tr>
                                    <th class="red">Nama Pekerjaan</th>
                                    <th class="red">Jumlah</th>
                                    <th class="red">Lihat Detail</th>
                                </tr>';

        foreach($items as $item) {

            $url_arr = explode("#", $item['url']);
            $summary = str_replace("/", ".", $url_arr[0]);
            $str_params = $url_arr[1];

            $total += $item['jumlah'];

            $onClickEvent = "loadContentWithParams('".$summary."',".$str_params.")";

            if($item['jumlah'] == 0)
                $btnOpenInbox = '&nbsp;';
            else
                $btnOpenInbox = '<button type="button" onClick="'.$onClickEvent.'" class="btn btn-xs btn-danger"> Lihat Detail </button>';

            $strOutput .= '<tr>';
            $strOutput .= '<td>'.$item['profile_type'].'</td>';
            $strOutput .= '<td align="right"><strong>'.$item['jumlah'].'</strong></td>';
            $strOutput .= '<td>'.$btnOpenInbox.'</td>';
            $strOutput .= '</tr>';
        }

        $strOutput .= '<tr class="red">
                            <td colspan="2" align="right"><strong>Jumlah Pekerjaan Tersedia : '.$total.' </strong></td>
                            <td>&nbsp;</td>
                        </tr>';
        $strOutput .= '</table>
                        </div>
                        </div>';

        echo $strOutput;
        exit;
    }

    public function summary_list() {
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $P_W_DOC_TYPE_ID = $ci->input->post('P_W_DOC_TYPE_ID');
        $user_name = $userinfo['app_user_name'];
        $ELEMENT_ID = $ci->input->post('ELEMENT_ID');

        $items = $table->getSummaryList($P_W_DOC_TYPE_ID, $user_name);
        $strOutput = '<div class="portlet box green-jungle">
                        <div class="portlet-title">
                            <div class="caption">Summary</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">';
        $strOutput .= '
                      <table class="table table-bordered table-hover" id="dynamic-table">
                        <thead>
                            <tr>
                                <th class="center"> Pekerjaan</th>
                                <th class="center" width="15"> Jumlah </th>
                                <th class="center"> Pilih </th>
                                <th style="display:none;"> Hidden Value </th>
                            </tr>
                        </thead>
                        ';

        $strOutput .= '<tbody>';


        $selected = '';
        $not_checked = true;

        foreach ($items as $item) {

            if($item['stype'] == 'PROFILE') {
                $strOutput .= '<tr>
                                    <td colspan="3"><strong class="font-green">'.$item['display_name'].'</strong></td>
                              </tr>';
            }else {

                if(!empty($ELEMENT_ID)) {
                    if( $ELEMENT_ID == $item['element_id']) {
                        $selected = 'checked=""';
                    }else {
                        $selected = '';
                    }
                }else {
                    if( $not_checked ) {
                        $selected = 'checked=""';
                        $not_checked = false;
                    }else {
                        $selected = '';
                    }
                }

                $strOutput .= '<tr>
                                    <td style="padding-left:35px;"><strong>'.$item['display_name'].'</strong></td>
                                    <td style="text-align:right;">'.$item['scount'].'</td>
                                    <td class="center"><input class="pointer radio-bigger" type="radio" '.$selected.' name="pilih_summary" value="'.$item['element_id'].'" onclick="loadUserTaskList(this, event);"></td>
                                    <td style="display:none;">
                                        <input type="hidden" id="'.$item['element_id'].'_p_w_doc_type_id" value="'.$item['p_w_doc_type_id'].'">
                                        <input type="hidden" id="'.$item['element_id'].'_p_w_proc_id" value="'.$item['p_w_proc_id'].'">
                                        <input type="hidden" id="'.$item['element_id'].'_profile_type" value="'.$item['profile_type'].'">
                                    </td>
                              </tr>';

            }
        }
        $strOutput .= '</tbody>';
        $strOutput .= '</table>';
        $strOutput .= '</div>';

        echo $strOutput;
        exit;
    }


    public function user_task_list() {

        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $p_w_doc_type_id = $ci->input->post('p_w_doc_type_id');
        $p_w_proc_id     = $ci->input->post('p_w_proc_id');
        $profile_type    = $ci->input->post('profile_type');
        $element_id      = $ci->input->post('element_id');
        $user_name       = $userinfo['app_user_name'];

        $page = intval($ci->input->post('page')) ;
        $limit = $ci->input->post('limit');
        $sort = 'donor_date';
        $dir = 'desc';

        /* search parameter */
        $searchPhrase      = $ci->input->post('searchPhrase');
        $tgl_terima        = $ci->input->post('tgl_terima');

        if(empty($p_w_doc_type_id) || empty($p_w_proc_id) || empty($profile_type)) {
            $data = array();
            $data['total'] = 0;
            $data['contents'] = self::emptyTaskList();

            echo json_encode($data);
            exit;
        }

        //$sql = "SELECT * FROM TABLE (PACK_TASK_PROFILE.USER_TASK_LIST (".$p_w_doc_type_id.",".$p_w_proc_id.",'".$profile_type."','".$user_name."',''))";
        $sql = "SELECT * FROM sikp.pack_task_profile.user_task_list(".$p_w_doc_type_id.",".$p_w_proc_id.",'".$profile_type."','".$user_name."','') AS tbl (ty_workflow_ctl)";
        // print_r($sql);
        $req_param = array (
            "table" => $sql,
            "sort_by" => $sort,
            "sord" => $dir,
            "limit" => null,
            "search" => ''
        );
        $req_param['where'] = array();
        if(!empty($searchPhrase)) {
             $req_param['where'][] = "(upper(keyword) LIKE upper('%".$searchPhrase."%'))";
        }

        if(!empty($tgl_terima)) {
            $req_param['where'][] = "trunc(donor_date) = nvl(to_date('".$tgl_terima."','YYYY-MM-DD'),trunc(donor_date))";
        }

        $count = $table->bootgrid_countAll($req_param);
        if( $count > 0 && !empty($limit) ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 1;
        }

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit*$page - ($limit); // do not put $limit*($page - 1)

        $req_param['limit'] = array(
            'start' => $start,
            'end' => $limit
        );

        $items = $table->bootgrid_getData($req_param);
        $data = array();

        $data['total'] = $count;
        $data['contents'] = self::getTaskListHTML($items);

        echo json_encode($data);
        exit;
    }

    public function emptyTaskList() {
        return '<tr>
                    <td colspan="4" align="center"> Tidak ada data untuk ditampilkan </td>
                </tr>';
    }

    public function getTaskListHTML($items) {

        if(count($items) == 0) {
            return self::emptyTaskList();
        }
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;

        $user_id_login = $userinfo['p_app_user_id'];

        $result  = '';
        foreach($items as $item) {
            $result .= '<tr>
                            <td colspan="4"> <span class="font-green"><strong>'.$item['cust_info'].'</strong></span></td>
                        </tr>';

            $result .= '<tr>';

            $params = array();
            $file_name = str_replace("/","-",$item['filename']);
            $params['CURR_DOC_ID'] = intval($item['doc_id']);
            $params['CURR_DOC_TYPE_ID'] = intval($item['p_w_doc_type_id']);
            $params['CURR_PROC_ID'] = intval($item['p_w_proc_id']);
            $params['CURR_CTL_ID'] = intval($item['t_ctl_id']);
            $params['USER_ID_DOC'] = intval($item['p_app_user_id_donor']);
            $params['USER_ID_DONOR'] = intval($item['p_app_user_id_donor']);
            $params['USER_ID_LOGIN'] = intval($user_id_login);
            $params['USER_ID_TAKEN'] = intval($item['p_app_user_id_takeover']);
            $params['IS_CREATE_DOC'] = "N";
            $params['IS_MANUAL'] = "N";
            $params['CURR_PROC_STATUS'] = $item['proc_sts'];
            $params['CURR_DOC_STATUS'] = $item['doc_sts'];
            $params['PREV_DOC_ID'] = intval($item['prev_doc_id']);
            $params['PREV_DOC_TYPE_ID'] = intval($item['prev_doc_type_id']);
            $params['PREV_PROC_ID'] = intval($item['prev_proc_id']);
            $params['PREV_CTL_ID'] = intval($item['prev_ctl_id']);
            $params['SLOT_1'] = $item['slot_1'];
            $params['SLOT_2'] = $item['slot_2'];
            $params['SLOT_3'] = $item['slot_3'];
            $params['SLOT_4'] = $item['slot_4'];
            $params['SLOT_5'] = $item['slot_5'];
            $params['MESSAGE'] = $item['message'];

            if($item['profile_type'] != 'INBOX') {
                $params['ACTION_STATUS'] = "VIEW";
                $json_param = str_replace('"', "'", json_encode($params));
                $result .= '<td><button type="button" class="btn btn-sm btn-danger" onClick="loadWFForm(\''.$file_name.'\','.$json_param.')">View</button></td>';
            }else {
                if($item['is_read'] == 'N') {
                    $params['ACTION_STATUS'] = "TERIMA";
                    $json_param = str_replace('"', "'", json_encode($params));
                    $result .= '<td><button type="button" class="btn btn-sm btn-danger" onClick="loadWFForm(\''.$file_name.'\','.$json_param.')">Terima</button></td>';
                }else {
                    $params['ACTION_STATUS'] = "BUKA";
                    $json_param = str_replace('"', "'", json_encode($params));
                    $result .= '<td><button type="button" class="btn btn-sm btn-danger" onClick="loadWFForm(\''.$file_name.'\','.$json_param.')">Buka</button></td>';
                }
            }

            $result .= '<td>
                            <table class="table">
                                <tr>
                                    <td>Nama Pekerjaan</td>
                                    <td>:</td>
                                    <td colspan="2"><span class="red"><strong>'.$item['ltask'].'</strong></span></td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>'.$item['sender'].'</td>
                                    <td>'.$item['donor_date'].'</td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>'.$item['recipient'].'</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pengambil</td>
                                    <td>:</td>
                                    <td>'.$item['takeover'].'</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Submitter</td>
                                    <td>:</td>
                                    <td>'.$item['closer'].'</td>
                                    <td>'.$item['submit_date'].'</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>'.$item['proc_sts'].'</td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>'; /* pekerjaan */
            $result .= '<td>
                            <table class="table">
                                <tr>
                                    <td>Nomor Permohonan</td>
                                    <td>:</td>
                                    <td>'.$item['doc_no'].'</td>
                                </tr>
                                <tr>
                                    <td>Periode</td>
                                    <td>:</td>
                                    <td>'.$item['period'].'</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dibaca</td>
                                    <td>:</td>
                                    <td>'.$item['read_date'].'</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>'.$item['doc_sts'].'</td>
                                </tr>
                            </table>
                        </td>'; /* dokumen */
            $result .= '<td>'.$item['message'].'</td>'; /* pesan */
            $result .= '</tr>';
        }

        return $result;
    }


    public function taken_task() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->session->userdata;

        $curr_ctl_id = $ci->input->post('curr_ctl_id');
        $curr_doc_type_id = $ci->input->post('curr_doc_type_id');
        // $user_name = strtoupper($userinfo['app_user_name']);
        $user_name = $userinfo['app_user_name'];
        $curr_doc_type_id = empty($curr_doc_type_id) ? NULL : $curr_doc_type_id;

        try {

            $sql = " CALL pack_task_profile.taken_task(?, ?, ?) ";
            $result = $table->db->query($sql, array($curr_ctl_id, $user_name, $curr_doc_type_id));

            $data['success'] = true;
            $data['message'] = 'Taken Task Berhasil';
        }catch(Exception $e){
            $data['success'] = false;
            $data['message'] = 'Taken Task Gagal';
        }

        echo json_encode($data);
        exit;
    }


    public function submitter_submit() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->session->userdata;

        $o_submitter_id = null;
        $o_error_message = "";
        $o_result_msg = "";
        $o_warning = "";
        $user_id_login = $userinfo['p_app_user_id'];

        /* posting from submit lov */
        $interactive_message = $ci->input->post('interactive_message');
        $submitter_params = json_decode($ci->input->post('params') , true);

        try {

            $sql = "select seq_submitter_id.nextval as seq from dual";
            $query = $table->db->query($sql);
            $row = $query->row_array();
            $o_submitter_id = $row['seq'];

            $submitter_params['USER_ID_DOC'] = empty($submitter_params['USER_ID_DOC']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_DONOR'] = empty($submitter_params['USER_ID_DONOR']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_TAKEN'] = empty($submitter_params['USER_ID_TAKEN']) ? $user_id_login : $submitter_params['USER_ID_TAKEN'];

            $submitter_params['CURR_CTL_ID'] = empty($submitter_params['CURR_CTL_ID']) ? NULL : $submitter_params['CURR_CTL_ID'];
            $submitter_params['CURR_DOC_TYPE_ID'] = empty($submitter_params['CURR_DOC_TYPE_ID']) ? NULL : $submitter_params['CURR_DOC_TYPE_ID'];
            $submitter_params['CURR_PROC_ID'] = empty($submitter_params['CURR_PROC_ID']) ? NULL : $submitter_params['CURR_PROC_ID'];
            $submitter_params['CURR_DOC_ID'] = empty($submitter_params['CURR_DOC_ID']) ? NULL : $submitter_params['CURR_DOC_ID'];

            $submitter_params['PREV_CTL_ID'] = empty($submitter_params['PREV_CTL_ID']) ? NULL : $submitter_params['PREV_CTL_ID'];
            $submitter_params['PREV_DOC_TYPE_ID'] = empty($submitter_params['PREV_DOC_TYPE_ID']) ? NULL : $submitter_params['PREV_DOC_TYPE_ID'];
            $submitter_params['PREV_PROC_ID'] = empty($submitter_params['PREV_PROC_ID']) ? NULL : $submitter_params['PREV_PROC_ID'];
            $submitter_params['PREV_DOC_ID'] = empty($submitter_params['PREV_DOC_ID']) ? NULL : $submitter_params['PREV_DOC_ID'];

            $str_params = "";
            define("TOTAL_PARAMS", 23);
            for($i = 1; $i <= TOTAL_PARAMS; $i++) {
                if($i == 1) $str_params .= "?";
                else $str_params .= ",?";
            }

            $sql = " CALL pack_workflow_mpd.submit_engine(".$str_params.");";
            $result = $table->db->query($sql, array($o_submitter_id,
                                        $submitter_params['IS_CREATE_DOC'],
                                        $submitter_params['IS_MANUAL'],
                                        $submitter_params['USER_ID_DOC'],
                                        $submitter_params['USER_ID_DONOR'],
                                        $user_id_login,
                                        $submitter_params['USER_ID_TAKEN'],
                                        $submitter_params['CURR_CTL_ID'],
                                        $submitter_params['CURR_DOC_TYPE_ID'],
                                         $submitter_params['CURR_PROC_ID'],
                                         $submitter_params['CURR_DOC_ID'],
                                         $submitter_params['CURR_DOC_STATUS'],
                                         $submitter_params['CURR_PROC_STATUS'],
                                         $submitter_params['PREV_CTL_ID'],
                                         $submitter_params['PREV_DOC_TYPE_ID'],
                                         $submitter_params['PREV_PROC_ID'],
                                         $submitter_params['PREV_DOC_ID'],
                                         $interactive_message,
                                         $submitter_params['SLOT_1'],
                                         $submitter_params['SLOT_2'],
                                         $submitter_params['SLOT_3'],
                                         $submitter_params['SLOT_4'],
                                         $submitter_params['SLOT_5']));


            $sql_message = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
            $query_message = $table->db->query($sql_message);
            $row_message = $query_message->row_array();

            $data = array();

            if($row_message['return_message'] != "0") {
                $data['submit_success'] = true;
                $row_message['return_message'] = "BERHASIL";
            }else {
                $data['submit_success'] = false;
                $row_message['return_message'] = "";
            }

            $data['success'] = true;
            $data['return_message'] = $row_message['return_message'];
            $data['error_message'] = $row_message['error_message'];
            $data['warning'] = $row_message['warning'];

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    public function submitter_reject() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->session->userdata;

        $o_submitter_id = null;
        $o_error_message = "";
        $o_result_msg = "";
        $o_warning = "";
        $user_id_login = $userinfo['p_app_user_id'];

        /* posting from submit lov */
        $interactive_message = $ci->input->post('interactive_message');
        $submitter_params = json_decode($ci->input->post('params') , true);

        try {

            $sql = "select seq_submitter_id.nextval as seq from dual";
            $query = $table->db->query($sql);
            $row = $query->row_array();
            $o_submitter_id = $row['seq'];

            $submitter_params['USER_ID_DOC'] = empty($submitter_params['USER_ID_DOC']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_DONOR'] = empty($submitter_params['USER_ID_DONOR']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_TAKEN'] = empty($submitter_params['USER_ID_TAKEN']) ? $user_id_login : $submitter_params['USER_ID_TAKEN'];

            $submitter_params['CURR_CTL_ID'] = empty($submitter_params['CURR_CTL_ID']) ? NULL : $submitter_params['CURR_CTL_ID'];
            $submitter_params['CURR_DOC_TYPE_ID'] = empty($submitter_params['CURR_DOC_TYPE_ID']) ? NULL : $submitter_params['CURR_DOC_TYPE_ID'];
            $submitter_params['CURR_PROC_ID'] = empty($submitter_params['CURR_PROC_ID']) ? NULL : $submitter_params['CURR_PROC_ID'];
            $submitter_params['CURR_DOC_ID'] = empty($submitter_params['CURR_DOC_ID']) ? NULL : $submitter_params['CURR_DOC_ID'];

            $submitter_params['PREV_CTL_ID'] = empty($submitter_params['PREV_CTL_ID']) ? NULL : $submitter_params['PREV_CTL_ID'];
            $submitter_params['PREV_DOC_TYPE_ID'] = empty($submitter_params['PREV_DOC_TYPE_ID']) ? NULL : $submitter_params['PREV_DOC_TYPE_ID'];
            $submitter_params['PREV_PROC_ID'] = empty($submitter_params['PREV_PROC_ID']) ? NULL : $submitter_params['PREV_PROC_ID'];
            $submitter_params['PREV_DOC_ID'] = empty($submitter_params['PREV_DOC_ID']) ? NULL : $submitter_params['PREV_DOC_ID'];

            $str_params = "";
            define("TOTAL_PARAMS", 23);
            for($i = 1; $i <= TOTAL_PARAMS; $i++) {
                if($i == 1) $str_params .= "?";
                else $str_params .= ",?";
            }

            $sql = " CALL pack_workflow_mpd.reject_engine(".$str_params.");";
            $result = $table->db->query($sql, array($o_submitter_id,
                                        $submitter_params['IS_CREATE_DOC'],
                                        $submitter_params['IS_MANUAL'],
                                        $submitter_params['USER_ID_DOC'],
                                        $submitter_params['USER_ID_DONOR'],
                                        $user_id_login,
                                        $submitter_params['USER_ID_TAKEN'],
                                        $submitter_params['CURR_CTL_ID'],
                                        $submitter_params['CURR_DOC_TYPE_ID'],
                                         $submitter_params['CURR_PROC_ID'],
                                         $submitter_params['CURR_DOC_ID'],
                                         $submitter_params['CURR_DOC_STATUS'],
                                         $submitter_params['CURR_PROC_STATUS'],
                                         $submitter_params['PREV_CTL_ID'],
                                         $submitter_params['PREV_DOC_TYPE_ID'],
                                         $submitter_params['PREV_PROC_ID'],
                                         $submitter_params['PREV_DOC_ID'],
                                         $interactive_message,
                                         $submitter_params['SLOT_1'],
                                         $submitter_params['SLOT_2'],
                                         $submitter_params['SLOT_3'],
                                         $submitter_params['SLOT_4'],
                                         $submitter_params['SLOT_5']));

            $sql_message = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
            $query_message = $table->db->query($sql_message);
            $row_message = $query_message->row_array();

            $data = array();

            if($row_message['return_message'] != "0") {
                $data['submit_success'] = true;
                $row_message['return_message'] = "BERHASIL";
            }else {
                $data['submit_success'] = false;
                $row_message['return_message'] = "";
            }

            $data['success'] = true;
            $data['return_message'] = $row_message['return_message'];
            $data['error_message'] = $row_message['error_message'];
            $data['warning'] = $row_message['warning'];

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    public function submitter_back() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->session->userdata;

        $o_submitter_id = null;
        $o_error_message = "";
        $o_result_msg = "";
        $o_warning = "";
        $user_id_login = $userinfo['p_app_user_id'];

        /* posting from submit lov */
        $interactive_message = $ci->input->post('interactive_message');
        $submitter_params = json_decode($ci->input->post('params') , true);

        try {

            $sql = "select seq_submitter_id.nextval as seq from dual";
            $query = $table->db->query($sql);
            $row = $query->row_array();
            $o_submitter_id = $row['seq'];

            $submitter_params['USER_ID_DOC'] = empty($submitter_params['USER_ID_DOC']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_DONOR'] = empty($submitter_params['USER_ID_DONOR']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_TAKEN'] = empty($submitter_params['USER_ID_TAKEN']) ? $user_id_login : $submitter_params['USER_ID_TAKEN'];

            $submitter_params['CURR_CTL_ID'] = empty($submitter_params['CURR_CTL_ID']) ? NULL : $submitter_params['CURR_CTL_ID'];
            $submitter_params['CURR_DOC_TYPE_ID'] = empty($submitter_params['CURR_DOC_TYPE_ID']) ? NULL : $submitter_params['CURR_DOC_TYPE_ID'];
            $submitter_params['CURR_PROC_ID'] = empty($submitter_params['CURR_PROC_ID']) ? NULL : $submitter_params['CURR_PROC_ID'];
            $submitter_params['CURR_DOC_ID'] = empty($submitter_params['CURR_DOC_ID']) ? NULL : $submitter_params['CURR_DOC_ID'];

            $submitter_params['PREV_CTL_ID'] = empty($submitter_params['PREV_CTL_ID']) ? NULL : $submitter_params['PREV_CTL_ID'];
            $submitter_params['PREV_DOC_TYPE_ID'] = empty($submitter_params['PREV_DOC_TYPE_ID']) ? NULL : $submitter_params['PREV_DOC_TYPE_ID'];
            $submitter_params['PREV_PROC_ID'] = empty($submitter_params['PREV_PROC_ID']) ? NULL : $submitter_params['PREV_PROC_ID'];
            $submitter_params['PREV_DOC_ID'] = empty($submitter_params['PREV_DOC_ID']) ? NULL : $submitter_params['PREV_DOC_ID'];

            $str_params = "";
            define("TOTAL_PARAMS", 23);
            for($i = 1; $i <= TOTAL_PARAMS; $i++) {
                if($i == 1) $str_params .= "?";
                else $str_params .= ",?";
            }

            $sql = " CALL pack_workflow_mpd.back_engine(".$str_params.");";
            $result = $table->db->query($sql, array($o_submitter_id,
                                        $submitter_params['IS_CREATE_DOC'],
                                        $submitter_params['IS_MANUAL'],
                                        $submitter_params['USER_ID_DOC'],
                                        $submitter_params['USER_ID_DONOR'],
                                        $user_id_login,
                                        $submitter_params['USER_ID_TAKEN'],
                                        $submitter_params['CURR_CTL_ID'],
                                        $submitter_params['CURR_DOC_TYPE_ID'],
                                         $submitter_params['CURR_PROC_ID'],
                                         $submitter_params['CURR_DOC_ID'],
                                         $submitter_params['CURR_DOC_STATUS'],
                                         $submitter_params['CURR_PROC_STATUS'],
                                         $submitter_params['PREV_CTL_ID'],
                                         $submitter_params['PREV_DOC_TYPE_ID'],
                                         $submitter_params['PREV_PROC_ID'],
                                         $submitter_params['PREV_DOC_ID'],
                                         $interactive_message,
                                         $submitter_params['SLOT_1'],
                                         $submitter_params['SLOT_2'],
                                         $submitter_params['SLOT_3'],
                                         $submitter_params['SLOT_4'],
                                         $submitter_params['SLOT_5']));

            $sql_message = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
            $query_message = $table->db->query($sql_message);
            $row_message = $query_message->row_array();

            $data = array();

            if($row_message['return_message'] != "0") {
                $data['submit_success'] = true;
                $row_message['return_message'] = "BERHASIL";
            }else {
                $data['submit_success'] = false;
                $row_message['return_message'] = "";
            }

            $data['success'] = true;
            $data['return_message'] = $row_message['return_message'];
            $data['error_message'] = $row_message['error_message'];
            $data['warning'] = $row_message['warning'];

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    public function pekerjaan_tersedia() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;


        $curr_proc_id = $ci->input->post('curr_proc_id');
        $curr_doc_type_id = $ci->input->post('curr_doc_type_id');

        $sql = "select f_get_next_info(".$curr_proc_id.",".$curr_doc_type_id.")as task from dual";
        $query = $table->db->query($sql);
        $row = $query->row_array();

        $data = array();
        $data['task'] = $row['task'];

        echo json_encode($data);
        exit;
    }


    public function status_dokumen_workflow() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select * from v_document_workflow_status";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_status_list_id'].'"> '.$item['code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function grid_customer_order() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $t_customer_order_id = $ci->input->post('t_customer_order_id');
        $p_w_proc_id = $ci->input->post('p_w_proc_id');

        $sql = "SELECT a.*, to_char(a.start_dat,'yyyy-mm-dd') as start_date, to_char(a.end_dat,'yyyy-mm-dd') as end_date FROM v_wf_create_schema a WHERE t_customer_order_id = ".$t_customer_order_id." AND p_w_proc_id = ".$p_w_proc_id;
        $query = $table->db->query($sql);

        $items = $query->result_array();

        echo json_encode( $items );
        exit;
    }

    public function doc_type() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select * from p_legal_doc_type";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_legal_doc_type_id'].'"> '.$item['code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function getLogKronologi(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $page = intval($ci->input->post('current')) ;
        $limit = $ci->input->post('rowCount');
        $sort = $ci->input->post('sort');
        $dir = $ci->input->post('dir');

        $result = array();
        $query = $table->db->query("SELECT * FROM v_t_nwo_log_kronologis WHERE T_CUSTOMER_ORDER_ID = ".$ci->input->post('t_customer_order_id')." ");

        if($query->num_rows() > 0)
            $result = $query->result_array();


        if ($page == 0) {
            $hasil['current'] = 1;
        } else {
            $hasil['current'] = $page;
        }

        $hasil['total'] = count($result);
        $hasil['rowCount'] = $limit;
        $hasil['success'] = true;
        $hasil['message'] = 'Berhasil';
        $hasil['rows'] = $result;

        echo(json_encode($hasil));
        exit;
    }

    public function save_log(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $log_params = json_decode($ci->input->post('params') , true);
        $CREATED_BY = $userinfo['app_user_name'];
        $UPDATED_BY = $userinfo['app_user_name'];
        $log_params['CURR_DOC_ID'] = empty($log_params['CURR_DOC_ID']) ? NULL : $log_params['CURR_DOC_ID'];
        $log_params['USER_ID_LOGIN'] = empty($log_params['USER_ID_LOGIN']) ? NULL : $log_params['USER_ID_LOGIN'];

        try {

            $sql = "INSERT INTO T_ORDER_LOG_KRONOLOGIS(  DESCRIPTION,
                                                         CREATE_DATE,
                                                         UPDATE_DATE,
                                                         ACTIVITY,
                                                         CREATE_BY,
                                                         UPDATE_BY,
                                                         COUNTER_NO,
                                                         T_CUSTOMER_ORDER_ID,
                                                         P_APP_USER_ID,
                                                         EMPLOYEE_NO,
                                                         LOG_DATE,
                                                         P_PROCEDURE_ID,
                                                         INPUT_TYPE )
                                                VALUES(  '".$ci->input->post('desc_log')."',
                                                         SYSDATE,
                                                         SYSDATE,
                                                         '".$ci->input->post('activity')."',
                                                         '".$CREATED_BY."',
                                                         '".$UPDATED_BY."',
                                                         (SELECT NVL(MAX(COUNTER_NO),0)+1 FROM T_ORDER_LOG_KRONOLOGIS WHERE T_CUSTOMER_ORDER_ID=".$log_params['CURR_DOC_ID']."),
                                                         ".$log_params['CURR_DOC_ID'].",
                                                         ".$log_params['USER_ID_LOGIN'].",
                                                         NULL,
                                                         SYSDATE,
                                                         ".$log_params['CURR_PROC_ID'].",
                                                         'M'
                                                )";

            $table->db->query($sql);

            $result['success'] = true;
            $result['message'] = 'Log Kronologis Berhasil Ditambah';

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

         echo json_encode($result);
         exit;
    }

    public function getLegalDoc(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $page = intval($ci->input->post('current')) ;
        $limit = $ci->input->post('rowCount');
        $sort = $ci->input->post('sort');
        $dir = $ci->input->post('dir');

        $result = array();
        $query = $table->db->query("SELECT a.*, b.CODE as LEGAL_DOC_DESC FROM t_cust_order_legal_doc a
                                 LEFT JOIN p_legal_doc_type b ON a.P_LEGAL_DOC_TYPE_ID = b.P_LEGAL_DOC_TYPE_ID
                                 WHERE a.T_CUSTOMER_ORDER_ID = ".$ci->input->post('t_customer_order_id')." ");
        if($query->num_rows() > 0)
            $result = $query->result_array();


        if ($page == 0) {
            $hasil['current'] = 1;
        } else {
            $hasil['current'] = $page;
        }

        $hasil['total'] = count($result);
        $hasil['rowCount'] = $limit;
        $hasil['success'] = true;
        $hasil['message'] = 'Berhasil';
        $hasil['rows'] = $result;

        echo(json_encode($hasil));
        exit;
    }

    public function save_legaldoc(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $params = json_decode($ci->input->post('legaldoc_params') , true);
        $CREATED_BY = $userinfo['app_user_name'];
        $UPDATED_BY = $userinfo['app_user_name'];
        $log_params['CURR_DOC_ID'] = empty($log_params['CURR_DOC_ID']) ? NULL : $log_params['CURR_DOC_ID'];

        try {

            $config['upload_path'] = './upload';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000000';
            $config['overwrite'] = TRUE;
            $file_id = date("YmdHis");
            $config['file_name'] = "wf_" . $file_id;

            $ci->load->library('upload');
            $ci->upload->initialize($config);

            if (!$ci->upload->do_upload("filename")) {

                $error = $ci->upload->display_errors();
                $result['success'] = false;
                $result['message'] = $error;

                echo json_encode($result);
                exit;
            }else{

                //chmod

                // Do Upload
                $data = $ci->upload->data();

                $idd = $table->generate_id('t_cust_order_legal_doc', 't_cust_order_legal_doc_id');

                $sql = "insert into t_cust_order_legal_doc(t_cust_order_legal_doc_id,
                                                           description,
                                                           created_by,
                                                           updated_by,
                                                           creation_date,
                                                           updated_date,
                                                           p_legal_doc_type_id,
                                                           t_customer_order_id,
                                                           origin_file_name,
                                                           file_folder,
                                                           file_name)
                            values (".$idd.",
                                    '".$ci->input->post('desc')."',
                                    '".$CREATED_BY."',
                                    '".$UPDATED_BY."',
                                    SYSDATE,
                                    SYSDATE,
                                    ".$ci->input->post('p_legal_doc_type_id').",
                                    ".$params['CURR_DOC_ID'].",
                                    '".$data['client_name']."',
                                    'upload',
                                    '".$data['file_name']."'
                                    )";

                $table->db->query($sql);


                $result['success'] = true;
                $result['message'] = 'Dokumen Pendukung Berhasil Ditambah';

            }

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
        exit;
    }

    public function delete_legaldoc(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        try {

            $id_ = $ci->input->post('t_cust_order_legal_doc_id');
            $table->db->where('T_CUST_ORDER_LEGAL_DOC_ID', $id_);
            $table->db->delete('T_CUST_ORDER_LEGAL_DOC');

            $result['success'] = true;
            $result['message'] = 'Dokumen Pendukung Berhasil Dihapus';

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
        exit;
    }

    public function workflow_list() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select * from p_workflow order by p_workflow_id asc";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_workflow_id'].'"> '.$item['display_name'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function order_list() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "SELECT * FROM p_order_status where p_order_status_id in (2,3) ORDER BY p_order_status_id";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_order_status_id'].'"> '.$item['code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function p_vat_type_list() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select p_vat_type_id, vat_code, description 
                from p_vat_type
                order by p_vat_type_id asc";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_vat_type_id'].'"> '.$item['vat_code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }


    public function p_year_period_list() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select *
                from p_year_period
                order by start_date desc";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_year_period_id'].'"> '.$item['year_code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function p_finance_period_list() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $p_year_period_id = $ci->input->post('p_year_period_id');

        $sql = "select p_finance_period_id, code
                from p_finance_period
                where p_year_period_id = ".$p_year_period_id."
                order by p_finance_period_id asc";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_finance_period_id'].'"> '.$item['code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

     public function save_petugas_bap(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $bap_employee_no_1 = $ci->input->post('bap_employee_no_1', '');
        $bap_employee_no_2 = $ci->input->post('bap_employee_no_2', '');
        $bap_employee_name_1 = $ci->input->post('bap_employee_name_1', '');
        $bap_employee_name_2 = $ci->input->post('bap_employee_name_2', '');
        $bap_employee_job_pos_1 = $ci->input->post('bap_employee_job_pos_1', '');
        $bap_employee_job_pos_2 = $ci->input->post('bap_employee_job_pos_2', '');
        $t_customer_order_id = $ci->input->post('t_customer_order_id', '');
        $t_vat_registration_id = $ci->input->post('t_vat_registration_id', '');


        try {

            $sql = "UPDATE t_vat_registration SET 
                    bap_employee_no_1 = '".$bap_employee_no_1."',
                    bap_employee_no_2 = '".$bap_employee_no_2."',
                    bap_employee_name_1 = '".$bap_employee_name_1."',
                    bap_employee_name_2 = '".$bap_employee_name_2."',
                    bap_employee_job_pos_1 = '".$bap_employee_job_pos_1."',
                    bap_employee_job_pos_2 = '".$bap_employee_job_pos_2."'
                    WHERE  t_customer_order_id = ".$t_customer_order_id."
                    AND t_vat_registration_id = ".$t_vat_registration_id;

            $table->db->query($sql);

            $result['success'] = true;
            $result['message'] = 'Data Berhasil Disimpan';

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

         echo json_encode($result);
         exit;
    }

    public function gen_npwpd(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $t_customer_order_id = $ci->input->post('t_customer_order_id', '');

        try {

            $sql = "select f_gen_npwpd(".$t_customer_order_id.")as npwpd from dual";

            $query = $table->db->query($sql);

            $result['success'] = true;
            $result['message'] = 'Data Berhasil';
            $result['data'] =  $query->result_array();

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
            $result['data'] = array();
        }

         echo json_encode($result);
         exit;
    }

    public function save_kasi_npwpd(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $npwpd = $ci->input->post('npwpd', '');
        $reg_letter_no = $ci->input->post('reg_letter_no', '');
        $t_customer_order_id = $ci->input->post('t_customer_order_id', '');
        $t_vat_registration_id = $ci->input->post('t_vat_registration_id', '');


        try {

            $sql = "UPDATE t_vat_registration SET 
                    npwpd = '".$npwpd."',
                    reg_letter_no = '".$reg_letter_no."'
                    WHERE  t_customer_order_id = ".$t_customer_order_id."
                    AND t_vat_registration_id = ".$t_vat_registration_id;

            $table->db->query($sql);

            $result['success'] = true;
            $result['message'] = 'Data Berhasil Disimpan';

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

         echo json_encode($result);
         exit;
    }

    public function reject_transaksi(){
        $ci =& get_instance();
        $userinfo = $ci->session->userdata;
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $t_vat_setllement_id = getVarClean('t_vat_setllement_id','int',0);
        $alasan = getVarClean('alasan','str','');


        try {

            $sql = "SELECT f_reject_trans(".$t_vat_setllement_id.",'".$userinfo['app_user_name']."','".$alasan."', 0, '') AS msg";

            $query =$table->db->query($sql);
            $msg = $query->result_array();


            $result['success'] = true;
            $result['message'] = $msg[0]['msg'];

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
        exit;
    }
}

/* End of file Groups_controller.php */