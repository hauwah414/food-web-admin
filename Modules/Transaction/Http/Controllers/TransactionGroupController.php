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

class TransactionGroupController extends Controller
{
    public function transactionList(Request $request)
    {
        $post = $request->except('_token');
        $data = [
            'title'          => 'Transaction Group',
            'menu_active'    => 'transaction-group',
            'sub_title'      => 'List Transaction Group',
            'submenu_active' => 'transaction-group',
        ];

        if (Session::has('filter-transaction-group-list') && !empty($post) && !isset($post['filter'])) {
            $post = Session::get('filter-transaction-group-list');
        } else {
            Session::forget('filter-transaction-group-list');
        }
        $post['filter_status_code'] = [1];
       $list = MyHelper::post('transaction/group/list', $post);

       
            $data['data']          = $list['result']??[];
        if ($post) {
            Session::put('filter-transaction-group-list', $post);
        }
        return view('transaction::transactionGroupList', $data);
    }
    public function transactionDetail($id)
    {
       $data = [
            'title'          => 'Transaction Group',
            'menu_active'    => 'transaction-group',
            'sub_title'      => 'Detail Transaction Group',
            'submenu_active' => 'transaction-group',
        ];

         $check = MyHelper::post('transaction/group/be/detail', ['id' => $id, 'admin' => 1]);

        if (isset($check['status']) && $check['status'] == "success") {
            $data['detail'] = $check['result'];
            $data['list'] = MyHelper::post('transaction/be/list-all', ['id_transaction_group'=>$data['detail']['group']['id_transaction_group']])['result']??[];
            
            return view('transaction::group.transactionDetail3', $data); 
           
        } else {
            return redirect('transaction')->withErrors(['Failed get detail transaction']);
        }
    }
    public function transactionListUnpaid(Request $request)
    {
        $post = $request->except('_token');
        $data = [
            'title'          => 'Transaction Group Menunggu Pembayaran',
            'menu_active'    => 'transaction-group-unpaid',
            'sub_title'      => 'List Transaction Group Menunggu Pembayaran',
            'submenu_active' => 'transaction-group-unpaid',
        ];

        if (Session::has('filter-transaction-group-list') && !empty($post) && !isset($post['filter'])) {
            
            $post = Session::get('filter-transaction-group-unpaid');
        } else {
            Session::forget('filter-transaction-group-unpaid');
        }
        $post['filter_status_code'] = [2];
        $list = MyHelper::post('transaction/group/list', $post);
        $data['data']          = $list['result']??[];
        if ($post) {
            Session::put('filter-transaction-group-unpaid', $post);
        }
        return view('transaction::transactionGroupList', $data);
    }
    public function transactionListPaid(Request $request)
    {
        $post = $request->except('_token');
        $data = [
             'title'          => 'Transaction Group Dibayarkan',
            'menu_active'    => 'transaction-group-paid',
            'sub_title'      => 'List Transaction Group Dibayarkan',
            'submenu_active' => 'transaction-group-paid',
        ];

        if (Session::has('filter-transaction-group-list') && !empty($post) && !isset($post['filter'])) {
            $page = 1;
            if (isset($post['page'])) {
                $page = $post['page'];
            }
            $post = Session::get('filter-transaction-group-paid');
        } else {
            Session::forget('filter-transaction-group-paid');
        }
         $post['filter_status_code'] = [3];
       $list = MyHelper::post('transaction/group/list', $post);
            $data['data']          = $list['result']??[];
        if ($post) {
            Session::put('filter-transaction-group-paid', $post);
        }
        return view('transaction::transactionGroupList', $data);
    }
    public function transactionListCompleted(Request $request)
    {
        $post = $request->except('_token');
        $data = [
             'title'          => 'Transaction Group Completed',
            'menu_active'    => 'transaction-group-completed',
            'sub_title'      => 'List Transaction Group Completed',
            'submenu_active' => 'transaction-group-completed',
        ];

        if (Session::has('filter-transaction-group-list') && !empty($post) && !isset($post['filter'])) {
            $page = 1;
            if (isset($post['page'])) {
                $page = $post['page'];
            }
            $post = Session::get('filter-transaction-group-completed');
            $post['page'] = $page;
        } else {
            Session::forget('filter-transaction-group-completed');
        }
        $post['row'] = 25;
        $post['filter_status_code'] = [4];
        $list = MyHelper::post('transaction/group/list', $post);
        if (isset($list['result']['data']) && !empty($list['result']['data'])) {
            $data['data']          = $list['result']['data'];
            $data['dataTotal']     = $list['result']['total'];
            $data['dataPerPage']   = $list['result']['from'];
            $data['dataUpTo']      = $list['result']['from'] + count($list['result']['data']) - 1;
            $data['dataPaginator'] = new LengthAwarePaginator($list['result']['data'], $list['result']['total'], $list['result']['per_page'], $list['result']['current_page'], ['path' => url()->current()]);
        } else {
            $data['data']          = [];
            $data['dataTotal']     = 0;
            $data['dataPerPage']   = 0;
            $data['dataUpTo']      = 0;
            $data['dataPaginator'] = false;
        }
        if ($post) {
            Session::put('filter-transaction-group-completed', $post);
        }
        return view('transaction::transactionGroupCompleted', $data);
    }
    public function transactionListRejected(Request $request)
    {
        $post = $request->except('_token');
        $data = [
             'title'          => 'Transaction Group Rejected',
            'menu_active'    => 'transaction-group-rejected',
            'sub_title'      => 'List Transaction Group Rejected',
            'submenu_active' => 'transaction-group-rejected',
        ];

        if (Session::has('filter-transaction-group-list') && !empty($post) && !isset($post['filter'])) {
            $page = 1;
            if (isset($post['page'])) {
                $page = $post['page'];
            }
            $post = Session::get('filter-transaction-group-rejected');
            $post['page'] = $page;
        } else {
            Session::forget('filter-transaction-group-rejected');
        }
        
         $post['filter_status_code'] = [5];
         
        $post['row'] = 25;
        $list = MyHelper::post('transaction/group/list', $post);
        if (isset($list['result']['data']) && !empty($list['result']['data'])) {
            $data['data']          = $list['result']['data'];
            $data['dataTotal']     = $list['result']['total'];
            $data['dataPerPage']   = $list['result']['from'];
            $data['dataUpTo']      = $list['result']['from'] + count($list['result']['data']) - 1;
            $data['dataPaginator'] = new LengthAwarePaginator($list['result']['data'], $list['result']['total'], $list['result']['per_page'], $list['result']['current_page'], ['path' => url()->current()]);
        } else {
            $data['data']          = [];
            $data['dataTotal']     = 0;
            $data['dataPerPage']   = 0;
            $data['dataUpTo']      = 0;
            $data['dataPaginator'] = false;
        }
        if ($post) {
            Session::put('filter-transaction-group-rejected', $post);
        }
        return view('transaction::transactionGroupCompleted', $data);
    }
}
