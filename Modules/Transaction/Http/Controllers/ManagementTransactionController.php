<?php

namespace Modules\Transaction\Http\Controllers;

use App\Exports\MultisheetExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Lib\MyHelper;
use Session;
use Excel;
use App\Imports\FirstSheetOnlyImport;

class ManagementTransactionController extends Controller
{
    
    public function updateDate(Request $request)
    {
        $post = $request->except('_token');
        $post['transaction_date'] = date('Y-m-d H:i:s', strtotime($post['transaction_date']));
        $check = MyHelper::post('transaction/be/update/date',$post);

        if (isset($check['status']) && $check['status'] == "success") {
            return back()->withSuccess(['Berhasil update tanggal pengiriman']);
        } else {
            return back()->withErrors($check['messages']??['Gagal update tanggal pengiriman']);
        }
    }
    public function updateSumber(Request $request)
    {
        $post = $request->except('_token');
        $check = MyHelper::post('transaction/be/update/sumber-dana',$post);

        if (isset($check['status']) && $check['status'] == "success") {
            return back()->withSuccess(['Berhasil update']);
        } else {
            return back()->withErrors(['Gagal update']);
        }
    }
    public function updateQty(Request $request)
    {
        $post = $request->except('_token');
        $data = array();
        foreach ($post['id_transaction_product'] as $key => $value){
            $data[] = array(
                'id_transaction_product'=>$value,
                'qty'=>$post['qty'][$key],
            );
        }
        $post['item'] = $data;
        $check = MyHelper::post('transaction/be/update/qty',$post);

        if (isset($check['status']) && $check['status'] == "success") {
            return back()->withSuccess(['Berhasil update qty']);
        } else {
            return back()->withErrors(['Gagal update qty']);
        }
    }
    public function updateOngkir(Request $request)
    {
        $post = $request->except('_token');
        $check = MyHelper::post('transaction/be/update/ongkir',$post);

        if (isset($check['status']) && $check['status'] == "success") {
            return back()->withSuccess(['Berhasil update Ongkos Kirim']);
        } else {
            return back()->withErrors(['Gagal update Ongkos Kirim']);
        }
    }
    public function itemDelete($id)
    {
        $post['id_transaction_product'] = $id;
        $check = MyHelper::post('transaction/be/item/delete',$post);

        if (isset($check['status']) && $check['status'] == "success") {
            return back()->withSuccess(['Berhasil update qty']);
        } else {
            return back()->withErrors(['Gagal update qty']);
        }
    }
    public function addItem(Request $request)
    {
        $post = $request->except('_token');
        $item = array();
        foreach($post['item'] as $value){
            if(isset($value['id_product'])){
                $item[] = $value;
            }
        }
        $data = array(
           'items'=>$item,
            'id_transaction'=>$post['id_transaction'],
            'id_transaction_group'=>$post['id_transaction_group'],
        );
       $check = MyHelper::post('transaction/be/item/add',$data);
        if (isset($check['status']) && $check['status'] == "success") {
            return back()->withSuccess(['Berhasil update qty']);
        } else {
            return back()->withErrors(['Gagal update qty']);
        }
    }
}
