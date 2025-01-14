<?php

namespace App\Lib;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Exception\ServerErrorResponseException;
use Illuminate\Support\Facades\URL;
use Image;
use File;

class MyHelper
{
    public static function encodeImage($image, $ext = null)
    {
        $size   = $image->getSize();
        $encoded;

//        $convert = $size / 1000;
//        if ($convert < 1000) {
            $encoded = base64_encode(fread(fopen($image, "r"), filesize($image)));
//        } else {
//            $img = Image::make($image);
//            $imgwidth = $img->width();
//            $imgheight = $img->height();
//
//            $path = 'images/' . time() . '.' . $ext;
//
//            if ($imgwidth > $imgheight && $imgwidth > 1000) {
//                $img->resize(1000, null, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//            } elseif ($imgheight > $imgwidth && $imgheight > 1000) {
//                $img->resize(null, 1000, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//            } elseif ($imgheight == $imgwidth) {
//                $img->resize(1000, 1000, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//            }
//
//            $img->save($path);
//
//            $image = File::get(public_path($path));
//            $encoded = base64_encode($image);
//            if (file_exists($path)) {
//                unlink($path);
//            }
//        }

        return $encoded;
    }

    public static function convertDate($date)
    {
        $date = explode('/', $date);
        $date = $date[2] . '-' . $date[1] . '-' . $date[0];
        $date = date('Y-m-d', strtotime($date));
        return $date;
    }

    public static function convertDate2($date)
    {
        $date = explode('-', $date);
        $date = $date[2] . '-' . $date[1] . '-' . $date[0];
        $date = date('Y-m-d', strtotime($date));
        return $date;
    }

    public static function convertDateTime($date)
    {
        $date    = explode(' ', $date);
        $tanggal = explode("-", $date[0]);
        $tanggal = $tanggal[2] . '-' . $tanggal[1] . '-' . $tanggal[0];
        $tanggal = $tanggal . ' ' . $date[1];
        $date    = date('Y-m-d H:i:s', strtotime($tanggal));
        return $date;
    }

  // Example = 03 October 2019 - 10:35
    public static function convertDateTime2($date, $decode = null)
    {
        $tanggal    = str_replace(' - ', ' ', $date);
        $date    = date('Y-m-d H:i:s', strtotime($tanggal));
        return $date;
    }

    public static function postLogin($request)
    {
        $api = env('APP_API_URL');

        $client = new Client();
        try {
            $response = $client->request('POST', $api . 'oauth/token', [
            'form_params' => [
              'grant_type'    => 'password',
              'client_id'     => env('PASSWORD_CREDENTIAL_ID'),
              'client_secret' => env('PASSWORD_CREDENTIAL_SECRET'),
              'username'      => $request->input('username'),
              'password'      => $request->input('password'),
              'scope'        => 'be'
            ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function postLoginUserFranchise($request)
    {
        $api = env('APP_API_URL');

        $client = new Client();
        try {
            $response = $client->request('POST', $api . 'oauth/token', [
            'form_params' => [
              'grant_type'    => 'password',
              'client_id'     => env('PASSWORD_CREDENTIAL_ID'),
              'client_secret' => env('PASSWORD_CREDENTIAL_SECRET'),
              'username'      => $request->input('username'),
              'password'      => $request->input('password'),
              'scope'        => 'be',
              'user-franchise' => 1
            ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function postLoginClient()
    {
        $api = env('APP_API_URL');
        $client = new Client();

        try {
            $response = $client->request('POST', $api . 'oauth/token', [
            'form_params' => [
              'grant_type'    => 'client_credentials',
              'client_id'     => env('CLIENT_CREDENTIAL_ID'),
              'client_secret' => env('CLIENT_CREDENTIAL_SECRET'),
              'scope'           => 'be'
            ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function getWithBearer($url, $bearer)
    {
        $api = env('APP_API_URL');
        $client = new Client();


        $content = array(
        'headers' => [
        'Authorization'   => $bearer,
        'Accept'          => 'application/json',
        'Content-Type'    => 'application/json',
        'ip-address-view' => \Request::ip(),
        'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
        ]
        );

        try {
            $response =  $client->request('GET', $api . 'api/' . $url, $content);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    $error = json_decode($response, true);

                    if (!$error) {
                        return $e->getResponse()->getBody();
                    } else {
                        return $error;
                    }
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function get($url)
    {
        $api = env('APP_API_URL');
        $client = new Client();

        $ses = session('access_token');

        $content = array(
        'headers' => [
        'Authorization'   => $ses,
        'Accept'          => 'application/json',
        'Content-Type'    => 'application/json',
        'ip-address-view' => \Request::ip(),
        'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
        ]
        );

        try {
            $response =  $client->request('GET', $api . 'api/' . $url, $content);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    $error = json_decode($response, true);

                    if (!$error) {
                        return $e->getResponse()->getBody();
                    } else {
                        return $error;
                    }
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function apiRequest($method, $url, $data = [], $header = [], $timeout = 30)
    {
        $method = strtolower($method);
        $client = new Client();

        if (substr($url, 0, 4) != 'http') {
            $url = env('APP_API_URL') . 'api/' . $url;

            $ses = session('access_token');
            $header['Authorization'] = $ses;
        }

        $content = array(
        'headers' => array_merge($header, [
        'Accept'        => 'application/json',
        'Content-Type'  => 'application/json',
        ])
        );

        if ($method == 'get' && $data) {
            $params = http_build_query($data);
            if (strpos($url, '?')) {
                $url .= '&' . $params;
            } else {
                $url .= '?' . $params;
            }
        } else {
            $content['json'] = $data;
        }

        $content['timeout'] = $timeout;

        try {
            $response = $client->$method($url, $content);
          // return plain response if json_decode fail because response is plain text
            $return = json_decode($response->getBody()->getContents(), true) ?: $response->getBody()->__toString();
            return [
            'status_code' => $response->getStatusCode(),
            'response' => $return,
            'request' => ['url' => $url, 'method' => $method] + $content,
            ];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    $error = json_decode($response, true);

                    if (!$error) {
                        return $e->getResponse()->getBody();
                    } else {
                        if (isset($error['error']) && $error['error'] == 'Unauthenticated.') {
                            Session::forget('phone');
                            Session::forget('username');
                        }
                        return [
                        'status_code' => $e->getResponse()->getStatusCode(),
                        'response' => $error ?: $response,
                        'request' => ['url' => $url, 'method' => $method] + $content,
                        ];
                    }
                } else {
                    return [
                    'status' => 'fail',
                    'status_code' => false,
                    'messages' => [0 => $e->getMessage()],
                    'request' => ['url' => $url, 'method' => $method] + $content,
                    ];
                }
            } catch (Exception $e) {
                return [
                'status' => 'fail',
                'status_code' => false,
                'messages' => [0 => 'Check your internet connection.'],
                'request' => ['url' => $url, 'method' => $method] + $content,
                ];
            }
        }
    }

    public static function post($url, $post)
    {
        $api = env('APP_API_URL');
        $client = new Client();

        $ses = session('access_token');

        $content = array(
        'headers' => [
        // 'Authorization' => session()->get('access_token'),
        'Authorization' => $ses,
        'Accept'        => 'application/json',
        'Content-Type'  => 'application/json',
        'ip-address-view' => \Request::ip(),
        'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
        ],
        'json' => (array) $post
        );

        try {
            $response = $client->post($api . 'api/' . $url, $content);
            if (!is_array(json_decode($response->getBody(), true))) {
            }
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    if (!is_array($response)) {
                    }
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function postFile($url, $name_field, $path, $postData = null)
    {
        $api = env('APP_API_URL');
        $client = new Client();

        $ses = session('access_token');
        if ($path) {
            $content = fopen($path, 'r');
        } else {
            $content = '';
        }
        $content = array(
        'headers' => [
        'Authorization' => $ses,
        // 'Accept'        => 'application/json',
        // 'Content-Type'  => 'application/json'
        ],
        'multipart' => [
          [
              'name'     => $name_field,
              'contents' => $content,
              // 'filename' => $name
          ]
        ]
        );
        if (is_array($postData)) {
            $postData = array_map(function ($val, $key) {
                return array('name' => $key,'contents' => json_encode($val));
            }, $postData, array_keys($postData));
            array_push($content['multipart'], ...$postData);
        }
        try {
            $response = $client->post($api . 'api/' . $url, $content);
            if (!is_array(json_decode($response->getBody(), true))) {
            }
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
              //print_r($e);
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    if (!is_array($response)) {
                    }
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function postWithBearer($url, $post, $bearer)
    {
        $api = env('APP_API_URL');
        $client = new Client();

        $content = array(
        'headers' => [
        'Authorization' => $bearer,
        'Accept'        => 'application/json',
        'Content-Type'  => 'application/json',
        'ip-address-view' => \Request::ip(),
        'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
        ],
        'json' => (array) $post
        );

        try {
            $response = $client->post($api . 'api/' . $url, $content);
          // echo "a"; exit();
            if (!is_array(json_decode($response->getBody(), true))) {
            }
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
              //print_r($e);
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    if (!is_array($response)) {
                    }
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function postBiasa($url, $post)
    {
        $api = env('APP_API_URL');
        $client = new Client();

        $content = array(
        'headers' => [
        'Content-Type'  => 'application/json'
        ],
        'json' => (array) $post
        );

        try {
            $response = $client->post($api . 'api/' . $url, $content);
          // echo "a"; exit();
            if (!is_array(json_decode($response->getBody(), true))) {
            }
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
              //print_r($e);
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    if (!is_array($response)) {
                    }
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function postFileBearer($url, $name_field, $path, $filename, $bearer)
    {
        $api = env('APP_API_URL');
        $client = new Client();

        $content = array(
        'headers' => [
        'Authorization' => $bearer,
        ],
        'multipart' => [
          [
              'name'     => $name_field,
              'contents' => fopen($path, 'r'),
              'filename' => $filename
          ]
        ]
        );

        try {
            $response = $client->post($api . 'api/' . $url, $content);
          // echo "a"; exit();
            if (!is_array(json_decode($response->getBody(), true))) {
            }
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
              //print_r($e);
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();
                    if (!is_array($response)) {
                    }
                    return json_decode($response, true);
                } else {
                    return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
                }
            } catch (Exception $e) {
                return ['status' => 'fail', 'messages' => [0 => 'Check your internet connection.']];
            }
        }
    }

    public static function customNumberFormat($n)
    {

      //return number_format($n);

      // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

      // is this a number?
        if (!is_numeric($n)) {
            return false;
        }

      // now filter it;
        if ($n > 1000000000000) {
            return round(($n / 1000000000000), 1) . ' T';
        } elseif ($n > 1000000000) {
            return round(($n / 1000000000), 1) . ' B';
        } elseif ($n > 1000000) {
            return round(($n / 1000000), 1) . ' M';
        } elseif ($n > 1000) {
            return round(($n / 1000), 1) . ' K';
        }

        return number_format($n);
    }

    public static function thousandNumberFormat($number)
    {
        if ($number != "") {
            return number_format($number, 0, '', '.');
        }
        return 0;
    }

    public static function hasAccess($granted, $features)
    {
        foreach ($granted as $g) {
            if (!is_array($features)) {
                $features = session('granted_features');
            }
            if (in_array($g, $features)) {
                return true;
            }
        }

        return false;
    }

    public static function getNotifications()
    {
        $data = MyHelper::post('notifications/list', ['limit' => 10, 'page' => 1]);

        return ($data['status'] == 'success') ? $data['result'] : null;
    }

    public static function safeB64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='), array('-','_',''), $data);
        return $data;
    }

    public static function safeB64decode($string)
    {
        $data = str_replace(array('-','_'), array('+','/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public static function passwordkey($id_user)
    {
        $key = md5("esemestester" . $id_user . "644", true);
        return $key;
    }

    public static function getkey()
    {
        $depan = MyHelper::createrandom(1);
        $belakang = MyHelper::createrandom(1);
        $skey = $depan . "9gjru84jb86c9l" . $belakang;
        return $skey;
    }

    public static function parsekey($value)
    {
        $depan = substr($value, 0, 1);
        $belakang = substr($value, -1, 1);
        $skey = $depan . "9gjru84jb86c9l" . $belakang;
        return $skey;
    }

    public static function createrandom($digit)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        srand((double)microtime() * 1000000);
        $i = 0;
        $pin = '';

        while ($i < $digit) {
            $num = rand() % strlen($chars);
            $tmp = substr($chars, $num, 1);
            $pin = $pin . $tmp;
            $i++;
          // supaya char yg sudah tergenerate tidak akan dipakai lagi
            $chars = str_replace($tmp, "", $chars);
        }

        return $pin;
    }

    public static function throwError($e)
    {
        $error = $e->getFile() . ' line ' . $e->getLine();
        $error = explode('\\', $error);
        $error = end($error);
        return ['status' => 'failed with exception', 'exception' => get_class($e),'error' => $error ,'message' => $e->getMessage()];
    }
    public static function encryptkhusus($value)
    {
        if (!$value) {
            return false;
        }
        $skey = MyHelper::getkey();
        $depan = substr($skey, 0, 1);
        $belakang = substr($skey, -1, 1);
        $text = serialize($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($depan . MyHelper::safeB64encode($crypttext) . $belakang);
    }

    public static function encryptkhususpassword($value, $skey)
    {
        if (!$value) {
            return false;
        }
        $text = serialize($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim(MyHelper::safeB64encode($crypttext));
    }

    public static function decryptkhusus($value)
    {
        if (!$value) {
            return false;
        }
        $skey = MyHelper::parsekey($value);
        $jumlah = strlen($value);
        $value = substr($value, 1, $jumlah - 2);
        $crypttext = MyHelper::safeB64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return unserialize(trim($decrypttext));
    }

    public static function decryptkhususpassword($value, $skey)
    {
        if (!$value) {
            return false;
        }
        $crypttext = MyHelper::safeB64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return unserialize(trim($decrypttext));
    }

    public static function createRandomPIN($digit, $mode = null)
    {
        if ($mode != null) {
            if ($mode == "angka") {
                $chars = "1234567890";
            } elseif ($mode == "huruf") {
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            } elseif ($mode == "kecil") {
                $chars = "346789abcdefghjkmnpqrstuvwxy";
            }
        } else {
            $chars = "346789ABCDEFGHJKMNPQRSTUVWXY";
        }

        srand((double)microtime() * 1000000);
        $i = 0;
        $pin = '';

        while ($i < $digit) {
            $num = rand() % strlen($chars);
            $tmp = substr($chars, $num, 1);
            $pin = $pin . $tmp;
            $i++;
        }
        return $pin;
    }

  // news custom form webview
  // get value for form
    public static function oldValue($old_value, $autofill, $user, $is_autofill = 0)
    {
        if ($old_value != "") {
            return $old_value;
        }
        if ($is_autofill) {
            return self::autofill($autofill, $user);
        }
    }

    public static function autofill($autofill, $user)
    {
        if (empty($user)) {
            return "";
        } else {
            switch ($autofill) {
                case 'Name':
                    return $user['name'];
                break;
                case 'Email':
                    return $user['email'];
                break;
                case 'Phone':
                    return $user['phone'];
                break;
                case 'Gender':
                    return $user['gender'];
                break;
                case 'City':
                    return $user['city_name'];
                break;
                case 'Birthday':
                    return date('d-M-Y', strtotime($user['birthday']));
                break;

                default:
                    return "";
                break;
            }
        }
    }

    public static function isRequiredMark($is_required = 0)
    {
        if ($is_required == 1) {
            return '<span class="required" aria-required="true"> * </span>';
        }
    }

  // news form data: check if string contain image or file link
    public static function checkFormData($string)
    {
        if (strpos($string, 'img/news-custom-form') !== false) {
            $link = env('APP_API_URL') . $string;
            return '<img src="' . $link . '" height="100px" alt="">';
        } elseif (strpos($string, 'upload/news-custom-form') !== false) {
            $link = env('APP_API_URL') . $string;
            return '<a href="' . $link . '" target="_blank">Download File</a>';
        } else {
            return $string;
        }
    }

  // terbaru, cuma nambah serialize + unserialize sih biar support array
    public static function encrypt2019($value)
    {
        if (!$value) {
            return false;
        }
      // biar support array
        $text = serialize($value);
        $skey = self::getkey();
        $depan = substr($skey, 0, env('ENC_DD'));
        $belakang = substr($skey, -env('ENC_DB'), env('ENC_DB'));
        $ivlen = openssl_cipher_iv_length(env('ENC_CM'));
        $iv = substr(hash('sha256', env('ENC_SI')), 0, $ivlen);
        $crypttext = openssl_encrypt($text, env('ENC_CM'), $skey, 0, $iv);
        return trim($depan . self::safeB64encode($crypttext) . $belakang);
    }

    public static function decrypt2019($value)
    {
        if (!$value) {
            return false;
        }
        $skey = self::parsekey($value);
        $jumlah = strlen($value);
        $value = substr($value, env('ENC_DD'), $jumlah - env('ENC_DD') - env('ENC_DB'));
        $crypttext = self::safeB64decode($value);
        $ivlen = openssl_cipher_iv_length(env('ENC_CM'));
        $iv = substr(hash('sha256', env('ENC_SI')), 0, $ivlen);
        $decrypttext = openssl_decrypt($crypttext, env('ENC_CM'), $skey, 0, $iv);
      // dikembalikan ke format array sewaktu return
        return unserialize(trim($decrypttext));
    }

  /**
   * Create slug for resource based on id and created_at parameter
   * @param  String $id         id of resource
   * @param  String $created_at created_at value of item
   * @return String             slug result
   */
    public static function createSlug($id, $created_at)
    {
        $combined = $id . '.' . $created_at;
        $result = self::encrypt2019($combined);
        return $result;
    }

  /**
   * get id and created at from slug
   * @param  String $slug given slug
   * @return Array       id and created at or empty array if invalid slug
   */
    public static function explodeSlug($slug)
    {
        $decripted = self::decrypt2019($slug);
        $result = explode('.', $decripted);
        if (!$result || (count($result) == 1 && empty($result[0]))) {
            return [];
        }
        return $result;
    }
  /**
   * get Excel coumn name from number
   * @param Integer number of column (ex. 1)
   * @return String Excel column name (ex. A)
   */
    public static function getNameFromNumber($num)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($num);
    }

    public static function renderMenu($allMenu = null, &$hasActive = false, &$hasChildren = false)
    {
        $menuHtml = '';
        $hasActive = false;
        $hasChildren = false;
        if (is_null($allMenu)) {
            $allMenu = config('menu.sidebar');
        }
        foreach ($allMenu as $menu) {
            if ($menu['required_configs'] ?? false) {
                $menu['required_configs_rule'] = $menu['required_configs_rule'] ?? 'or';
                if ($menu['required_configs_rule'] == 'and') {
                    foreach ($menu['required_configs'] as $configId) {
                        if (!MyHelper::hasAccess([$configId], session('configs'))) {
                            continue;
                        }
                    }
                } else {
                    if (!MyHelper::hasAccess($menu['required_configs'], session('configs'))) {
                        continue;
                    }
                }
            }

            if ($menu['required_features'] ?? false) {
                $menu['required_features_rule'] = $menu['required_features_rule'] ?? 'or';
                if ($menu['required_features_rule'] == 'and') {
                    foreach ($menu['required_features'] as $featureId) {
                        if (!MyHelper::hasAccess([$featureId], session('granted_features'))) {
                            continue;
                        }
                    }
                } else {
                    if (!MyHelper::hasAccess($menu['required_features'], session('granted_features'))) {
                        continue;
                    }
                }
            }

            $url = (substr($menu['url'] ?? '', 0, 4) == 'http' ? $menu['url'] : ($menu['url'] ?? '')) ? url($menu['url']) : 'javascript:void(0)';
            $icon = ($menu['icon'] ?? '') ? '<i class="' . $menu['icon'] . '"></i>' : '';

            if (!($menu['type'] ?? false) && ($menu['children'] ?? false)) {
                $menu['type'] = ($menu['label'] ?? false) ? 'tree' : 'group';
            }

            if (($menu['type'] ?? 'single') != 'group' && ($menu['badge'] ?? false)) {
                if (strpos($menu['badge']['value'], 'View::shared')) {
                    $badge = eval('return ' . $menu['badge']['value'] . ';');
                } else {
                    $badge = \View::shared('sidebar_badges')[$menu['badge']['value']] ?? '';
                }
                $marginRight = ($menu['type'] ?? 'single') != 'single' ? 20 : 0;
                $menu['label'] .= '<span class="badge badge-' . ($menu['badge']['type'] ?? 'info') . ' pull-right" style="margin-right:' . $marginRight . 'px">' . $badge . '</span>';
            }

            switch ($menu['type'] ?? 'single') {
                case 'tree':
                    $submenu = '<li class="nav-item %active%"><a href="' . $url . '" class="nav-link nav-toggle">' . $icon . '<span class="title">' . $menu['label'] . '</span><span class="arrow %active%"></span></a><ul class="sub-menu">';

                    $submenu .= static::renderMenu($menu['children'], $subActive, $subAvailable);

                    $submenu = str_replace('%active%', $subActive ? 'active open' : '', $submenu);

                    $submenu .= '</ul></li>';

                    if ($subAvailable) {
                        if ($subActive) {
                            $hasActive = true;
                        }
                        $menuHtml .= $submenu;
                    }
                    break;

                case 'group':
                    $submenu = '';
                    if ($menu['label'] ?? false) {
                        $submenu .= static::renderMenu([['type' => 'heading', 'label' => $menu['label']]], $subActive, $subAvailable);
                    }
                    $submenu .= static::renderMenu($menu['children'] ?? [], $subActive, $subAvailable);
                    if ($subAvailable) {
                        if ($subActive) {
                            $hasActive = true;
                        }
                        $menuHtml .= $submenu;
                    }
                    break;

                case 'heading':
                    $menuHtml .= '<li class="heading" style="height: 50px;padding: 25px 15px 10px;"><h3 class="uppercase" style="color: #000;font-weight: 600;">' . $menu['label'] . '</h3></li>';
                    break;

                default:
                    if (!($menu['active'] ?? false)) {
                        $menu['active'] = 'request()->path() == ($menu["url"]??"")';
                    }
                    $active = ($menu['active'] ?? false) ? (eval('return ' . $menu['active'] . ';') ? 'active open' : '') : '';
                    if ($active) {
                        $hasActive = true;
                    }
                    $menuHtml .= '<li class="nav-item ' . $active . '"><a href=" ' . $url . ' " class="nav-link">' . $icon . '<span class="title">' . ($menu['label'] ?? 'YAYAYA') . '</span></a></li>';
                    break;
            }
        }
        if ($menuHtml) {
            $hasChildren = true;
        }
        return $menuHtml;
    }
}
