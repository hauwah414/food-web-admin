<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Lib\MyHelper;

class SumberDanaController extends Controller
{
    public function index(Request $request)
    {
        $post = $request->except('_token');
        $data = [
            'title'             => 'Setting Sumber Dana',
            'menu_active'       => 'setting-sumber-dana',
            'submenu_active'    => 'setting-sumber-dana'
        ];
        if (!empty($post)) {
            $save = MyHelper::post('sumber-dana/update', $post);
            if (isset($save['status']) && $save['status'] == "success") {
                return redirect('sumber-dana')->withSuccess(['Version Setting has been updated.']);
            } else {
                if (isset($save['errors'])) {
                    return back()->withErrors($save['errors'])->withInput();
                }
                if (isset($save['status']) && $save['status'] == "fail") {
                    return back()->withErrors($save['messages'])->withInput();
                }
                return back()->withErrors(['Something when wrong. Please try again.'])->withInput();
            }
        }
        $version = MyHelper::get('sumber-dana/list');
        if (isset($version['status']) && $version['status'] == "success") {
            $data['version'] = $version['result'];
        } else {
            $data['version'] = [];
        }
        return view('setting::sumber-dana.sumber-dana', $data);
    }
}
