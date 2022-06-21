<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use App\Employee;
use App\Inventory;
use App\Purchase;
use App\Sale;
use App\DNForm;
use App\Quotation;
use App\Invoice;
use Bluora\PhpNumberConverter\NumberConverter;
use GuzzleHttp\Client;


// Route::group(['middleware' => 'auth'], function () {

  Route::post('is-ticket-valid', 'TokenController@isValid');

  Route::post('user/auth', function(Request $request){
    $check = DB::table('kerberos_auth')->where([
      ['email', '=', $request['email']],
      ['encrypted', '=', $request['encrypted']]
    ])->first();

    if($check){
      $user = DB::table('employees')->where('email', '=', $request['email'])->first();

      // Auth::attempt(['email' => $request['email'], 'password' => $user->password]);

      if(Auth::loginUsingId($user->id)){
        return 'http://localhost/xampp/inventory/public/';
      }
      else{
        return 'fail';
      }
    }
    else{
      return $request['encrypted'];
    }

  });


  Route::get('fetchsecret', function(){
    $client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://localhost/xampp/kerberos/public/'
    ]);

    $response = $client->request('GET', 'resource/secret');

    $data = $response->getBody();

    $data = json_decode($data);

    return $data[0]->private_key;
  });

  Route::get('/inc', function (Request $request) {
    $data = $_GET['data'];
    $email = $_GET['email'];
    return view('header')->with(compact('data', 'email'));
  });

  Route::get('/', function(){
    return view('index');
  })->name('dashboard');

  Route::get('/add/employee', function(){
    $get = DB::table('modules')->where('Module_Name', '=', 'Add Employee')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('addEmployee');
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('add.employee');

  Route::post('/add/employees', 'UploadFileController@upload');

  Route::get('/employee', function(){
    $items = Employee::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Employee')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('employee.index')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::get('details/employee/{id}', function($id){
    $results = DB::table('employees')->where('id', '=', $id)->first();
    $documents = DB::table('documents')->where('employee_id', '=', $results->id)->get();
    $get = DB::table('modules')->where('Module_Name', '=', 'Employee Details')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('employee.details')->with(compact('results', 'documents'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::get('delete/employee/{id}', function($id){
    $get = DB::table('modules')->where('Module_Name', '=', 'Employee Details')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      if(DB::table('employees')->where('id', '=', $id)->delete()){
        return redirect()->back()->with('message', 'Employee Successfully deleted!');
      }
      else{
        return redirect()->route('dashboard')->with('alert', 'Something went wrong while deleting the employee!');
      }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::get('add/dsr/', function(){
    $get = DB::table('modules')->where('Module_Name', '=', 'Add DSR')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('DSR.dsr');
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('add/dsr', 'DSRController@addDSR');

  Route::get('search/dsr/', function(){
    $get = DB::table('modules')->where('Module_Name', '=', 'Search DSR')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('DSR.search');
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('search/dsr', function(Request $request){
    if($request['id']){
      if(is_numeric($request['id'])){
        $results = DB::table('dsr')->where([
          ['employee_id', '=', $request['id']]
        ])->whereBetween(
          'date', [$request['from1'], $request['to1']]
         )->get();

        if($results !== null){
          return view('DSR.details')->with(compact('results'));
        }
        else{
         return 'No data is stored from date '.$request['from1'].' to date '.$request['to1'];
        }
      }
      else {
        // $from = $request['from'];
        // $to = $request['to'];
        $names = explode(' ', $request['id']);
        if(!isset($names[1])){
          $ids = DB::table('employees')->where('fname', 'like', '%'.$names[0].'%')->get();
        }
        else{
          $ids = DB::table('employees')->where('fname', 'like', '%'.$names[0].'%')->orWhere('lname', 'like', '%'.$names[1].'%')->get();
        }
        return view('DSR.list')->with(['ids' => $ids, 'from' => $request['from1'], 'to' => $request['to1']]);
      }
    }
    else {
      $results = DB::table('dsr')->whereBetween(
          'date', [$request['from2'], $request['to2']]
        )->get();

      if($results !== null){
        return view('DSR.details')->with(compact('results'));
      }
      else{
        return 'No data is stored from date '.$request['from2'].' to date '.$request['to2'];
      }
    }
  });

  Route::get('search/DSR/{id}/{from}/{to}', function($id, $from, $to){
    $results = DB::table('dsr')->where([
      ['employee_id', '=', $id]
    ])->whereBetween(
      'date', [$from, $to]
     )->get();

    if($results !== null){
      return view('DSR.details')->with(compact('results'));
    }
    else{
     return 'No data is stored from date '.$from.' to date '.$to;
    }
  });

  Route::get('downloadExcel/{filename}/{type}/', 'MaatwebsiteDemoController@downloadExcel');
  Route::get('downloadExcel/inventory/{filename}/{type}/', 'InventoryExcel@downloadExcel');
  Route::get('downloadExcel/purchase/{filename}/{type}/', 'PurchaseExcel@downloadExcel');
  Route::get('downloadExcel/sale/{filename}/{type}/', 'SaleExcel@downloadExcel');
  Route::get('downloadExcel/dn/{filename}/{type}/', 'DNExcel@downloadExcel');
  Route::get('downloadExcel/employee/{filename}/{type}/', 'EmployeeExcel@downloadExcel');
  Route::get('downloadExcel/quotation/{filename}/{type}/', 'QuotationExcel@downloadExcel');

  Route::get('inventory/', function(){
    $items = Inventory::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Inventory')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('inventory.inventory')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('inventory/add', 'InventoryController@addInventory')->name('inventoryAdd');

  Route::get('inventory/edit/{id}', function($id){
    $data = DB::table('inventory')->where('item_code', '=', $id)->get();
    $get = DB::table('modules')->where('Module_Name', '=', 'Inventory Edit')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return $data;
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('inventory/edit', 'InventoryController@editInventory');

  Route::post('inventory/delete/{id}', 'InventoryController@deleteInventory');

  Route::get('inventory/purchase', function(){
    $items = Purchase::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Purchases')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('inventory.purchase')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('purchase');

  Route::get('inventory/purchase/new', function(){
    $items = Purchase::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Purchases')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('inventory.newPurchase');
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('newPurchase');

  Route::get('inventory/purchase/edit/{item}', function($item){
    $item = DB::table('purchases')->where('item_code', '=', $item)->first();
    $get = DB::table('modules')->where('Module_Name', '=', 'Purchases')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('inventory.editPurchase')->with(compact('item'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('editPurchase');

  Route::post('inventory/purchase', 'InventoryController@purchaseInventory')->name('purchaseInventory');

  Route::post('inventory/purchase/edit', 'InventoryController@editPurchaseInventory')->name('editPurchaseInventory');

  Route::post('inventory/purchase/{id}', 'InventoryController@recievedInventory');

  Route::get('inventory/purchase_order/{id}/cancel', function($id){
    $get = DB::table('modules')->where('Module_Name', '=', 'Purchase Cancel')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      if(DB::table('purchases')->where('item_code', '=', $id)->delete()){
        return redirect()->back();
      } else {
        return redirect()->back()->with('message', 'Something went wrong while cancelling order!');
      }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

//   Route::get('inventory/sale_order/{id}/cancel', function($id){
//     $get = DB::table('modules')->where('Module_Name', '=', 'Sale Cancel')->first();
//     if(DB::table('employee_module')->where([
//       ['employee_id', '=', Auth::user()->id],
//       ['module_id', '=', $get->id]
//     ])->first()){
//       if(DB::table('purchases')->where('item_code', '=', $id)->delete()){
//         return redirect()->back();
//       } else {
//         $item = DB::table('sales')->where('id', '=', $id)->first();
//         $quantity = $item->quantity;
//         $check = DB::table('inventory')->where('item_code', '=', $item->item_code)->first();
//         if($check){
//           $old = $check->quantity;
//           $new = $old + $quantity;
//           if(DB::table('inventory')->where('item_code', '=', $item->item_code)->update([
//             'quantity' => $new
//           ])){
//             if(!DB::table('sales')->where('id', '=', $id)->delete()){
//               return redirect()->back()->with('message', 'Something went wrong!');
//             }
//             else {
//               return redirect()->back()->with('message', 'Successfully cancelled the sales order!');
//             }
//           }
//         }
//       }
//     }
//     else{
//       return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
//     }
//   });

  Route::get('inventory/sale_order/{id}/cancel', function($id){
    $get = DB::table('modules')->where('Module_Name', '=', 'Sale Cancel')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
        $item = DB::table('sales')->where('id', '=', $id)->first();
        $quantity = $item->quantity;
        $check = DB::table('inventory')->where('item_code', '=', $item->item_code)->first();
        if($check){
          $old = $check->quantity;
          $new = $old + $quantity;
          if(DB::table('inventory')->where('item_code', '=', $item->item_code)->update([
            'quantity' => $new
          ])){
            if(!DB::table('sales')->where('id', '=', $id)->delete()){
              return redirect()->back()->with('message', 'Something went wrong!');
            }
            else {
              return redirect()->back()->with('message', 'Successfully cancelled the sales order!');
            }
          }
        }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  // Route::get('inventory/performa-invoice/{id}', function($id){
  //   $items = DB::table('sales')->where('id', '=', $id)->first();
  //   $get = DB::table('modules')->where('Module_Name', '=', 'Performa Invoice')->first();
  //   if(DB::table('employee_module')->where([
  //     ['employee_id', '=', Auth::user()->id],
  //     ['module_id', '=', $get->id]
  //   ])->first()){
  //     return view('inventory.performa_invoice')->with(compact('items'));
  //   }
  //   else{
  //     return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
  //   }
  // });

  Route::get('inventory/performa-invoice/{id}','ConverterController@invoice');

  Route::get('inventory/sale/', function(){
    $items = Sale::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Sales')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('inventory.sale')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('inventory/sale', 'InventoryController@saleInventory')->name('saleInventory');

  Route::get('inventory/purchase_order/{item_code}', function($ic){
    $items = DB::table('purchases')->where('item_code', '=', $ic)->first();
    $get = DB::table('modules')->where('Module_Name', '=', 'Purchase Details')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('inventory.purchase_order')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('inventory/purchase_order', function(Request $request){
    $ic = $request['ic'];
    $icx = explode('"', $ic);
    // return $icx;
    $items = DB::table('purchases')->whereIn('item_code', $icx)->get();
    $get = DB::table('modules')->where('Module_Name', '=', 'Purchase Details')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      // return view('inventory.purchase_order_club')->with(compact('items'));
      if($items !== null){
        return view('inventory.purchase_order_club')->with(compact('items'));
      }
      else{
        return 'Kindly check an entry to club bill!';
      }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::get('/quotation', function(){
    $items = Quotation::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('quotation.index')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('quote');

  Route::get('/quotation/add', function(){
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('quotation.add');
    }
    else{
    //   dd($get);
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('addQuotation');

  Route::get('/quotation/club', function(){
    $items = Quotation::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return $items;
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  // Route::get('quotation/club/{batch}', function(Request $request, $batch){
  //   //$ic = $request['ic'];
  //   //$icx = explode('"', $ic);
  //   // return $icx;
  //   $items = DB::table('quotations')->where('batch', '=', $batch)->get();
  //   $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
  //   if(DB::table('employee_module')->where([
  //     ['employee_id', '=', Auth::user()->id],
  //     ['module_id', '=', $get->id]
  //   ])->first()){
  //     // return view('inventory.purchase_order_club')->with(compact('items'));
  //     if($items !== null){
  //       return view('quotation.quotation_club')->with(compact('items'));
  //     }
  //     else{
  //       return 'Something went wrong!';
  //     }
  //   }
  //   else{
  //     return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
  //   }
  // });

  Route::get('inventory/performa-invoice/{batch}','ConverterController@invoice');

  Route::get('quotation/desc', function(Request $request) {
    $quotation = DB::table('quotations')->where('Quotation_Number', '=', $request['id'])->first();
    return $quotation->Description;
  });

  // Route::get('convert/{num}', 'ConverterController@numberToWord');

  Route::get('/quotation/delete/{ref}', function($ic){
      $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
      if(DB::table('employee_module')->where([
        ['employee_id', '=', Auth::user()->id],
        ['module_id', '=', $get->id]
      ])->first()){
        if(DB::table('quotations')->where('batch', '=', $ic)->delete()){
            return redirect()->back()->with('message', 'Quotation deleted successfully!');
        }
        else{
            return redirect()->back()->with('message', 'Quotation deletion failed!');
        }
      }
      else{
        return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
      }
  });

  Route::get('/quotation/{ref}', function($ic){
      $items = DB::table('quotations')->where('Quotation_Number', '=', $ic)->first();
      $get = DB::table('modules')->where('Module_Name', '=', 'Add Employee')->first();
      if(DB::table('employee_module')->where([
        ['employee_id', '=', Auth::user()->id],
        ['module_id', '=', $get->id]
      ])->first()){
        return view('quotation.quotation')->with(compact('items'));
      }
      else{
        return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
      }
  });

  Route::post('quotation/add', 'InventoryController@addQuotation');

  Route::get('quotation/edit/{batch}', function($batch){
    //$ic = $request['ic'];
    //$icx = explode('"', $ic);
    // return $icx;
    $items = DB::table('quotations')->where('batch', '=', $batch)->get();
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      // return view('inventory.purchase_order_club')->with(compact('items'));
      if($items !== null){
        return view('quotation.editQuotation')->with(compact('items'));
      }
      else{
        return 'Something went wrong!';
      }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('quotation/edit/{batch}', 'InventoryController@editQuotation')->name('editInvoice');

  Route::get('/invoice', function(){
    $items = Invoice::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('quotation.indexInvoice')->with(compact('items'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('invoice');

  Route::get('/invoice/add', function(){
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('quotation.addInvoice');
    }
    else{
      dd($get);
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('addInvoice');

  Route::post('invoice/add', 'InventoryController@addInvoice');

  Route::get('/invoice/delete/{ref}', function($ic){
      $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
      if(DB::table('employee_module')->where([
        ['employee_id', '=', Auth::user()->id],
        ['module_id', '=', $get->id]
      ])->first()){
        if(DB::table('invoices')->where('batch', '=', $ic)->delete()){
            return redirect()->back()->with('message', 'Invoice deleted successfully!');
        }
        else{
            return redirect()->back()->with('message', 'Invoice deletion failed!');
        }
      }
      else{
        return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
      }
  });

  Route::get('invoice/club/{batch}', function(Request $request, $batch){
    //$ic = $request['ic'];
    //$icx = explode('"', $ic);
    // return $icx;
    $items = DB::table('invoices')->where('batch', '=', $batch)->get();
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      // return view('inventory.purchase_order_club')->with(compact('items'));
      if($items !== null){
        return view('quotation.performa_invoice')->with(compact('items'));
      }
      else{
        return 'Something went wrong!';
      }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::get('invoice/edit/{batch}', function($batch){
    //$ic = $request['ic'];
    //$icx = explode('"', $ic);
    // return $icx;
    $items = DB::table('invoices')->where('batch', '=', $batch)->get();
    $get = DB::table('modules')->where('Module_Name', '=', 'Quotations')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      // return view('inventory.purchase_order_club')->with(compact('items'));
      if($items !== null){
        return view('quotation.editInvoice')->with(compact('items'));
      }
      else{
        return 'Something went wrong!';
      }
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('invoice/edit/{batch}', 'InventoryController@editInvoice')->name('editInvoice');

  Route::get('/dn-form', function(){
    $dnforms = DNForm::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'DN Form')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('dnForm.dn')->with(compact('dnforms'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  })->name('dn');

  Route::get('/dn-form/add', function(){
    $get = DB::table('modules')->where('Module_Name', '=', 'New DN Form')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('dnForm.dnform');
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('/dn-form/add', 'DNController@newEntry');

  Route::get('privileges/{id}', function($id){
    $modules = DB::table('modules')->get();
    $user = DB::table('employees')->where('id', '=', $id)->first();
    $get = DB::table('modules')->where('Module_Name', '=', 'Setting Privileges')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('auth.privileges')->with(compact('modules', 'user', 'id'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::get('privileges/', function(){
    $modules = DB::table('modules')->get();
    $users = Employee::all();
    $get = DB::table('modules')->where('Module_Name', '=', 'Setting Privileges')->first();
    if(DB::table('employee_module')->where([
      ['employee_id', '=', Auth::user()->id],
      ['module_id', '=', $get->id]
    ])->first()){
      return view('employee.privileges')->with(compact('users'));
    }
    else{
      return redirect()->route('dashboard')->with('alert', 'You are not allowed to access this module!');
    }
  });

  Route::post('privileges/{id}', function(Request $request, $id){
    if($request->ajax()){
      if(DB::table('employee_module')->insert([
        'employee_id'=> $request['id'],
        'module_id'=> $request['module_id'],
        'created_at'=> now(),
        'updated_at'=> now()
      ])){
        return 'Privileges setup successfully!';
      }
      else{
        return 'Something went wrong on our servers, try again!';
      }
    }
  });

  Route::get('purchase/club-bill/company', function(Request $request) {
    $company = DB::table('purchases')->where('company', '=', $request['company'])->get();
    return $company;
  });
// });

Route::get('/login', function(){
  return view('auth.login');
});

// Route::get('pdf', function(){
//   $pdf = PDF::loadView('index');
//   return $pdf->stream();
// });

Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


// Route::get('/{module}/{id}', function($module, $id){
//   $get = DB::table('modules')->where('Module_Name', '=', $module)->first();
//   if(DB::table('employee_module')->where([
//     ['employee_id', '=', $id],
//     ['module_id', '=', $get->id]
//   ])->first()){
//     return 'Success';
//   }
//   else{
//     return 'Error';
//   }
// });
