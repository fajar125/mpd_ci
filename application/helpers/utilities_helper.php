<?php

function jsonDecode($data) {

	if (empty($data)) return array();

    $items = json_decode($data, true);

    if ($items == NULL){
        throw new Exception('JSON items could not be decoded');
    }

    return $items;
}

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
}

function html_spaces($number=1) {
    $result = "";
    for($i = 1; $i <= $number; $i++) {
        $result .= "&nbsp;";
    }
    return $result;
}

function breadCrumbs($p_app_menu_id) {

    $ci =& get_instance();
    $sql = "WITH qs(p_app_menu_id, parent_id, code) AS
            (
                SELECT p_app_menu_id, parent_id, code
                FROM p_app_menu m
                WHERE parent_id is null
                UNION ALL
                SELECT child.p_app_menu_id, child.parent_id, (qs.code ||'>'|| child.code) as code
                FROM p_app_menu child
                INNER JOIN qs
                ON qs.p_app_menu_id = child.parent_id
            )
            SELECT *
            FROM qs
            where qs.p_app_menu_id = ?";

    $query = $ci->db->query($sql, array($p_app_menu_id));
    $item = $query->row_array();

    $crumbsstr = $item['code'];
    $crumbs = explode('>', $crumbsstr);

    $output = '
    <ul class="page-breadcrumb">
    <li>
        <a href="'.base_url().'">Home</a>
        <i class="fa fa-circle"></i>
    </li>';

    for($i = 0; $i < count($crumbs); $i++) {

        if($i == count($crumbs) - 1) {
            $output .= '<li>
                <span>'.$crumbs[$i].'</span>
            </li>';
        }else {
            $output .= '<li>
                <a href="javascript:;">'.$crumbs[$i].'</a>
                <i class="fa fa-circle"></i>
            </li>';
        }
    }

    $output .= '</ul>';

    return $output;
}

/**
 * compareDate
 *
 * Melakukan perbandingan dua tanggal
 *
 * @param string $from_date : batas tanggal awal dalam format yyyy-mm-dd
 * @param string $to_date   : batas tanggal akhir dalam format yyyy-mm-dd
 * @return 1 jika from_date < to_date, 2 jika from_date > to_date, 3 jika from_date = to_date
 */
function compareDate($from_date, $to_date) {
    $from_date = trim($from_date);
    $to_date = trim($to_date);

    if ($from_date == $to_date){
        return 3;
    }

    $waktu_awal = explode("-",$from_date);
    $waktu_akhir = explode("-",$to_date);
    if ($waktu_awal[0] > $waktu_akhir[0]){
        return 2;
    }else if ($waktu_awal[0] == $waktu_akhir[0]){
        if ($waktu_awal[1] > $waktu_akhir[1]){
            return 2;
        }else if ($waktu_awal[1] == $waktu_akhir[1]){
            if ($waktu_awal[2] > $waktu_akhir[2]){
                return 2;
            }
        }
    }
    return 1;
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>