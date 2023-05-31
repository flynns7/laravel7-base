<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

//sudah otomatis dengan token login
if (!function_exists('getRequest')) {
    function getRequest($url, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)->withHeaders($headers)->get($url);
        createLog(null, $url, 'GET', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}

//sudah otomatis dengan token login
if (!function_exists('postRequest')) {
    function postRequest($url, $data, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)->withHeaders($headers)->post($url, $data);
        createLog(json_encode($data), $url, 'POST', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}

//sudah otomatis dengan token login
if (!function_exists('patchRequest')) {
    function patchRequest($url, $data, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)->withHeaders($headers)->patch($url, $data);
        createLog(json_encode($data), $url, 'PATCH', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}

// tanpa login
if (!function_exists('getRequestPublic')) {
    function postRequestPublic($url, $headers = [])
    {
        return Http::withHeaders($headers)->get($url);
    }
}

if (!function_exists('postRequestWithFile')) {
    //@ khusus dengan file atau attachment cuma 1 file saja
    function postRequestWithFile($url, $data, array $attachment, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)
            ->attach($attachment['key'], $attachment['file'], $attachment['filename'])
            ->withHeaders($headers)
            ->post($url, $data);

        createLog(json_encode($data), $url, 'POST', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}

if (!function_exists('postRequestWithFileMultiple')) {
    function postRequestWithFileMultiple($url, $data, array $attachment, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $response     = Http::withToken($sessionToken);
        foreach ($attachment as $key => $file) {
            $response->attach($file['key'], $file['file'], $file['filename']);
        }
        $req = $response->withHeaders($headers)->post($url, $data);
        createLog(json_encode($data), $url, 'POST', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}

if (!function_exists('postLogin')) {
    function postLogin($url, $data, $headers = [])
    {
        $req = Http::withHeaders($headers)->post($url, $data);
        createLog(json_encode($data), $url, 'POST', json_encode($req->json()));
        return $req;
    }
}

if (!function_exists('postAsFormRequest')) {
    function postAsFormRequest($url, $data, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)->withHeaders($headers)->asForm()->post($url, $data);
        createLog(json_encode($data), $url, 'POST', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}
if (!function_exists('deleteRequest')) {
    function deleteRequest($url, $data = [], $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)->withHeaders($headers)->delete($url, $data);
        createLog(json_encode($data), $url, 'DELETE', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}
if (!function_exists('putRequest')) {
    function putRequest($url, $data, $headers = [])
    {
        $sessionToken = Session::get(API_CREDENTIAL)['data']['token'];
        $req = Http::withToken($sessionToken)->withHeaders($headers)->put($url, $data);
        createLog(json_encode($data), $url, 'PUT', json_encode($req->json()));
        validateTokenAPI($req);
        return $req;
    }
}

if (!function_exists('createLog')) {
    function createLog($params, $url, $method, $response)
    {
        DB::table('log_api')
            ->insert([
                'ip_address' => Request::ip(),
                'params' => $params,
                'url' => $url,
                'method' => $method,
                'response' => $response
            ]);
        return true;
    }
}

function isAJAX()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

function validateTokenAPI($response)
{
    $request = new Request;
    if (isAJAX()) {
        if ($response->status() == 401) {
            Session::flush();
            Session::regenerate();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array("code" => "401", "Unauthorize"));
            die;
        }
    }

    if ($response->status() == 401) {
        Session::flush();
        Session::regenerate();
        echo "<script>
                alert('Session habis silahkan login kembali');
                location.href='" . route('/login') . "'
              </script>";
        die;
    }
}

if (!function_exists('firstDate')) {
    function firstDate($stringData)
    {
        return empty(!$stringData) ? str_replace("/", "-", substr($stringData, 0, 10))  : '';
    }
}

if (!function_exists('secondDate')) {
    function secondDate($stringData)
    {
        return !empty($stringData) ? str_replace("/", "-", substr($stringData, 13, 10)) : '';
    }
}
if (!function_exists('datatableResponse')) {
    function datatableResponse($request, $data, $total)
    {
        return [
            "draw" => $request->get('draw'),
            "recordsTotal" => $total ? $total : 0,
            "recordsFiltered" => $total ? $total : 0,
            "data" => $data ? $data : []
        ];
    }
}

if (!function_exists('indonesiaMonths')) {
    function indonesiaMonths()
    {
        return array(
            ['value' => 1, 'label' => 'Januari'],
            ['value' => 2, 'label' => 'Februari'],
            ['value' => 3, 'label' => 'Maret'],
            ['value' => 4, 'label' => 'April'],
            ['value' => 5, 'label' => 'Mei'],
            ['value' => 6, 'label' => 'Juni'],
            ['value' => 7, 'label' => 'Juli'],
            ['value' => 8, 'label' => 'Agustus'],
            ['value' => 9, 'label' => 'September'],
            ['value' => 10, 'label' => 'Oktober'],
            ['value' => 11, 'label' => 'November'],
            ['value' => 12, 'label' => 'Desember'],
        );
    }
}

//date formate must be yyyy-mm-dd
if (!function_exists('createIndonesiaDateText')) {
    function createIndonesiaDateText(String $date)
    {
        if (!$date)
            return date('m') . ' ' . getindonesiaMonthText(date('m')) . ' ' . date('Y');
        return substr($date, 8, 2) . ' ' . getindonesiaMonthText(substr($date, 5, 2)) . ' ' . substr($date, 0, 4);
    }
}

if (!function_exists('getInitials')) {
    function getInitials($str)
    {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }
}
if (!function_exists('angkaRomawiBulan')) {
    function angkaRomawiBulan($month)
    {
        $list = array(
            "1" => "I",
            "2" => "II",
            "3" => "III",
            "4" => "IV",
            "5" => "V",
            "6" => "VI",
            "7" => "VII",
            "8" => "VIII",
            "9" => "IX",
            "10" => "X",
            "11" => "XI",
            "12" => "XII",
        );

        return $list[$month];
    }
}

if (!function_exists('getHariIndonesia')) {
    function getHariIndonesia($day)
    {
        $list = array(
            "Sun" => "Minggu",
            "Mon" => "Senin",
            "Tue" => "Selasa",
            "Wed" => "Rabu",
            "Thu" => "Kamis",
            "Fri" => "Jumat",
            "Sat" => "Sabtu"
        );

        if (!isset($list[$day]))
            return 'Hari Tidak Diketahui';

        return $list[$day];
    }
}

if (!function_exists('getindonesiaMonthText')) {
    function getindonesiaMonthText($monthNumber)
    {
        $listMonth     = indonesiaMonths();
        $filteredMonth = array_reduce($listMonth, function ($carry, $item) use ($monthNumber) {
            if ($item['value'] == $monthNumber)
                $carry = $item;
            return $carry;
        }, []);
        return $filteredMonth['label'];
    }
}

if (!function_exists('refreshToken')) {
    function refreshToken()
    {
        $url = API_URL . "auth/v1/refresh";
        $dataSession = Session::get(API_CREDENTIAL);
        $refreshToken = $dataSession['data']['refreshToken'];
        $req = Http::post($url, ['grantType' => 'RefreshToken', 'refreshToken' => $refreshToken]);
        Session::put(API_CREDENTIAL, $req->json());
        Session::save();
    }
}

function getUsernameById($id)
{
    if (empty($id) || is_null($id))
        return '-';
    $userData = DB::table('users')->where("id", "=", $id)->first();
    if ($userData)
        return $userData->name;
    return '-';
}

function getNumberValueOnly($string)
{
    if (empty($string) || is_null($string))
        return "0";
    return preg_replace('/[^0-9]/', '', $string);
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

function createDropDownTahun($selectedValue = 0, $tahunAwal = 1993, $tahunAkhir = '', $sort = "DESC")
{
    if ($tahunAkhir == '') $tahunAkhir = (int)date('Y');
    for (($sort == "DESC") ? $i = $tahunAkhir : $i = $tahunAwal; ($sort == "DESC") ? $i > $tahunAwal : $i < $tahunAkhir; ($sort == "DESC") ? $i-- : $i++) {
        echo "<option value='$i' " . ($i == $selectedValue ? 'selected' : '') . ">$i</option>";
    }
}

function createDropDownBulan($selectedValue = 0, $withZeroFirst = true)
{
    $listMonth  = indonesiaMonths();
    $mappedList = $listMonth;
    if ($withZeroFirst) {
        $mappedList = array_map(function ($item) {
            $item['value'] < 10 ? ($item['value'] = '0' . $item['value']) : $item['value'];
            return $item;
        }, $listMonth);
    }
    foreach ($mappedList as $item) {
        echo "<option value=" . $item['value'] . " " . ($item['value'] == $selectedValue ? 'selected' : '') . ">" . $item['label'] . "</option>";
    }
}

if (!function_exists('randomPassword')) {
    function randomPassword()
    {
        $alfanumerik = '0123456789abcdefghijklmnopqrstuvwxyz';
        $new_password = '';
        $get_pass = false;
        while ($get_pass == false) {
            $new_password = substr(str_shuffle($alfanumerik), 0, 10);
            $user = User::where('password', $new_password)->count();
            if ($user < 1) {
                $get_pass = true;
            }
        }

        return $new_password;
    }
}

function encodeURIComponent($str)
{
    $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
    return strtr(rawurlencode($str), $revert);
}

function renderExternalImage($url, $mime = "image/jpeg")
{
    $mimeType = [
        "jpeg" => "image",
        "jpg" => "image",
        "png" => "image",
        "pdf" => "application",
        "JPEG" => "image",
        "JPG" => "image",
        "PNG" => "image",
        "PDF" => "application",
        "octet-stream" => "application"
    ];
    if (empty($url) || is_null($url) || !isset($url))
        return '';

    $type = explode(".", $url)[(count(explode(".", $url)) - 1)];
    try {
        $response = Http::get($url);
        $body = $response->body();
        $base64 = base64_encode($body);
        $mime = $mimeType[$type] . "/$type";
        $img = ('data:' . $mime . ';base64,' . $base64);
        return $img;
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        return '';
    }
}

function getNameByUserName($username)
{
    $dataUser = DB::table('users')->where("username", "=", $username)->first();
    if (!$dataUser)
        return $username;
    return $dataUser->name;
}

function getNextMonth(int $dateNow = 0)
{
    $dateNow = ($dateNow == 0 ? (int)date('m') : $dateNow);

    if ($dateNow < 12)
        return ($dateNow + 1) > 9 ? ($dateNow + 1) : '0' . (string)($dateNow + 1);

    return '01';
}

function getClientIP()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function nullToEmptyString($data)
{
    $keys = array_keys($data);
    foreach ($keys as $item) {
        (is_null($data[$item]) || empty($data[$item])) ? $data[$item] = '' : $data[$item] = $data[$item];
    }
    return $data;
}
