<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Lib\MyHelper;
use Session;
use GoogleReCaptchaV3;

class HomeController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

     public function cogs(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/cogs', $post)['result']??[];
        return $data;
    }
     public function omset(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/omset', $post)['result']??[];
        return $data;
    }
     public function categori(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/categori', $post)['result']??[];
        return $data;
    }
     public function departTertinggi(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/department/pemesanan', $post)['result']??[];
        return $data;
    }
     public function departPiutang(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/department/piutang', $post)['result']??[];
        return $data;
    }
     public function omsetOutlet(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/omset/outlet', $post)['result']??[];
        return $data;
    }
     public function vendor(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/vendor', $post)['result']??[];
        return $data;
    }
    public function home(Request $request)
    {
        $post['dari'] = session('dari')??date('Y-m-01');
        $post['sampai'] = session('sampai')??date('Y-m-t');
        $post['date_start'] = $post['dari'];
        $post['date_end'] = $post['sampai'];
        $data = MyHelper::post('report/dashboard/home', $post)['result']??[];
        return $data;
    }

}
