<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Purchase;
use App\Sale;
use App\Quotation;
use App\Invoice;
use DB;
use Auth;

class InventoryController extends Controller
{
  public function addInventory(Request $request){
    $inventory = new Inventory();

    $inventory->item_code = $request['ic'];
    $inventory->item_name = $request['in'];
    $inventory->sub_type_1 = $request['st1'];
    $inventory->sub_type_2 = $request['st2'];
    $inventory->HSN_SAC = $request['st3'];
    $inventory->company = $request['company'];
    $inventory->quantity = $request['quantity'];

    $ic = $request['ic'];

    $check = DB::table('inventory')->where('item_code', '=', $ic)->get();
    if($check->count() !== 0){
      return redirect()->back()->with('message', 'Item with item code '.$ic.' already added into the inventory!');
    }
    else{
      $inventory->save();
      return redirect()->back()->with('message', 'Item successfully added into the inventory!');
    }
  }

  public function editInventory(Request $request){

    $item_code = $request['id'];
    // $request = $request['data'];

    if(DB::table('inventory')->where('item_code', '=', $item_code)->update([
      'item_name' => $request['data']['in_edit'],
      'sub_type_1' => $request['data']['st1_edit'],
      'sub_type_2' => $request['data']['st2_edit'],
      'HSN_SAC' => $request['data']['st3_edit'],
      'company' => $request['data']['company_edit'],
      'quantity' => $request['data']['quantity_edit']
    ])){
      return redirect()->back()->with('message', 'Successfully updated the entry!');
    }
    else{
      return redirect()->back()->with('message', 'Nothing has been edited!');
    }
  }

  public function deleteInventory(Request $request){
    $id = $request['id'];
    if(DB::table('inventory')->where('item_code', '=', $id)->delete()){
      return redirect()->back()->with('message', 'Item successfully deleted from the inventory!');
    }
    else{
      return redirect()->back()->with('message', 'Something went wrong while deleting item from the inventory!');
    }
  }

  public function purchaseInventory(Request $request){

    $purchase = new Purchase();

    $purchase->date_purchase = $request['dp'];
    $purchase->item_code = $request['ic'];
    $purchase->purchase_order_number = $request['pon'];
    $purchase->item_name = $request['in'];
    $purchase->subject = $request['sub'];
    $purchase->HSN_SAC = $request['st3'];
    $purchase->company = $request['company'];
    $purchase->quantity = $request['quantity'];
    $purchase->price = $request['price'];
    $purchase->tax = $request['tax'];

    $ic = $request['ic'];

    $check = DB::table('purchases')->where('item_code', '=', $ic)->get();
    if($check->count() !== 0){
      return redirect()->back()->with('message', 'Item already added into the purchase orders!');
    }
    else{
      if($purchase->save()){
        return redirect()->back()->with('message', 'Item successfully added into the purchase orders!');
      } else {
        return redirect()->back()->with('message', 'Something went wrong while saving the data!');
      }
    }
  }
  
  public function editPurchaseInventory(Request $request){

    $id = $request['id'];
    // $request = $request['data'];

    if(DB::table('purchases')->where('id', '=', $id)->update([
      'date_purchase' => $request['dp'],
      'item_code' => $request['ic'],
      'purchase_order_number' => $request['pon'],
      'item_name' => $request['in'],
      'subject' => $request['sub'],
      'HSN_SAC' => $request['st3'],
      'company' => $request['company'],
      'quantity' => $request['quantity'],
      'price' => $request['price'],
      'tax' => $request['tax'],
    ])){
      return redirect()->route('purchase')->with('message', 'Successfully updated the entry!');
    }
    else{
      return redirect()->route('purchase')->with('message', 'Nothing has been edited!');
    }
  }

  public function recievedInventory(Request $request){

    $item_code = $request['id'];
    
    // $request = $request['data'];
    $recQuant = $request['quantity'];
    $countPurchase = DB::table('purchases')->where('item_code', '=', $item_code)->first();
    $count = DB::table('inventory')->where('item_code', '=', $item_code)->first();
    if(isset($count) && ($countPurchase->quantity == $recQuant)){
          
      $old = $count->quantity;
      $new = $old + $recQuant;
      $left = $countPurchase->quantity - $recQuant;

      if(DB::table('inventory')->where('item_code', '=', $item_code)->update([
        'quantity' => $new
      ])){
        if(DB::table('purchases')->where('item_code', '=', $item_code)->update([
            'quantity' => $left
        ])){
            DB::table('invoice_purchase')->insert([
                'item_code' => $item_code,
                'invoice_number' => $request['invoice']
            ]);
        }
      }
    }
    else if(isset($count) && ($countPurchase->quantity > $recQuant)){
        $old = $count->quantity;
        $new = $old + $recQuant;

        if(DB::table('inventory')->where('item_code', '=', $item_code)->update([
            'quantity' => $new
        ])){
            $left = $countPurchase->quantity - $recQuant;
            if(DB::table('purchases')->where('item_code', '=', $item_code)->update([
                'quantity' => $left
            ])){
                DB::table('invoice_purchase')->insert([
                    'item_code' => $item_code,
                    'invoice_number' => $request['invoice']
                ]);
            }
        }
    }
    else if(isset($count) && ($countPurchase->quantity < $recQuant)){
        return redirect()->route('dashboard')->with('message', 'Entered quantity is more than what has been ordered!');
    }
    else if(!isset($count)){
      $inventory = new Inventory();

      $inventory->item_code = $request['data']['item_code'];
      $inventory->item_name = $request['data']['item_name'];
    //   $inventory->sub_type_1 = $request['data']['sub_type_1'];
    //   $inventory->subject = $request['data']['subject'];
      $inventory->HSN_SAC = $request['data']['HSN_SAC'];
      $inventory->company = $request['data']['company'];
      $inventory->quantity = $request['data']['quantity'];

      if($inventory->save()){
          $left = $countPurchase->quantity - $recQuant;
        if(!DB::table('purchases')->where('item_code', '=', $item_code)->update([
            'quantity' => $left
        ])){
           return 'Something went wrong!'; 
        }
        else{
            DB::table('invoice_purchase')->insert([
                'item_code' => $item_code,
                'invoice_number' => $request['invoice']
            ]);
        }
        $data = Inventory::all();
        return collect($data)->last();
      }
    }
  }

  public function saleInventory(Request $request){

    $check = DB::table('inventory')->where('item_code', '=', $request['ic'])->first();

    $ic = $request['ic'];

    if($check){
      if($check->quantity >= $request['quantity']){
        $sale = new Sale();

        $sale->date_sale = $request['dp'];
        $sale->item_code = $request['ic'];
        $sale->pi_number = $request['pon'];
        $sale->customer = $request['company'];
        $sale->quantity = $request['quantity'];
        $sale->price = $request['price'];
        $sale->tax = $request['tax'];

        if($sale->save()){
          $old = $check->quantity;
          $new = $old - $request['quantity'];

          if($new >= 0){
            if($new > 0){
              if(DB::table('inventory')->where('item_code', '=', $ic)->update([
                'quantity' => $new
              ])){
                return redirect()->back()->with('message', "Item sold Successfully!");
              }
            }
            if($new == 0){
            //   if(DB::table('inventory')->where('item_code', '=', $ic)->delete()){
            //     return "Successfully sold! No more ".$check->item_name." items left in the inventory.";
            //   }
              if(DB::table('inventory')->where('item_code', '=', $ic)->update([
                'quantity' => $new
              ])){
                return redirect()->back()->with('message', "Item sold successfully! No more ".$check->item_name." items left in the inventory.");
              }
            }
          }
        }
        else{
          return redirect()->back()->with('message', "An error occured while saving the item in the database. try again!");
        }
      }
      else{
        return redirect()->back()->with('message', "Cannot complete the sales order. We have only ".$check->quantity." items in the inventory!");
      }
    }
    else{
      return redirect()->back()->with('message', "There is no such item in the inventory with a item code of ".$request['ic']);
    }
  }

  public function addQuotation(Request $request){

    $count = count($request['tax']);
    $batch = Quotation::max('batch');

    for($i=0;$i<$count;$i++) {
      $quotation = new Quotation();

      $quotation->To = $request['to'];
      $quotation->Quotation_Number = $request['qn'];
      $quotation->Quote_valid_for = $request['qvf'];
      $quotation->Payment_terms = $request['pt'];
      $quotation->Quotation_Date = $request['qd'];
      $quotation->Serial_Number = $request['sn'][$i];
      $quotation->Description = $request['desc'][$i];
      $quotation->Quantity = $request['quantity'][$i];
      $quotation->Unit_Rate = $request['ur'][$i];
      $quotation->batch = ($batch+1);
      $quotation->Ref_no = $request['rn'];
      $quotation->Serial_Number = $i+1;
      $quotation->tax = $request['tax'][$i];
      $quotation->created_by = Auth::user()->id;

      if(!$quotation->save()){
        return redirect()->route('quote')->with('message', 'Something went wrong while creating quotation!');
      }
    }
    return redirect()->route('quote')->with('message', 'Quotation created successfully!');

  }
  
  public function addInvoice(Request $request){

    $count = count($request['quantity']);
    $quote = DB::table('invoices')->orderBy('created_at', 'desc')->first();
    if(!isset($quote->batch)){
      $batch = 1;
    }
    else{
      $batch = $quote->batch+1;
    }

    for($i=0;$i<$count;$i++) {
      $invoice = new Invoice();

      $invoice->performa_invoice = $request['pi'];
      $invoice->dated = $request['date'];
      $invoice->indenter = $request['ind'];
      $invoice->consignee = $request['cons'];
      $invoice->reference_number = $request['rn'];
      $invoice->reference_date = $request['rd'];
      $invoice->bills_to = $request['bt'];
      $invoice->bill_in_name = $request['bn'];
      $invoice->payment_terms = $request['pt'];
      $invoice->delivery_to = $request['dt'];
      $invoice->delivery_period = $request['dp'];
      $invoice->road_permit = $request['rp'];
      $invoice->freight_charges = $request['fc'];
      $invoice->mode_of_transport = $request['mt'];
      $invoice->quantity = $request['quantity'][$i];
      $invoice->tax = $request['tax'][$i];
      $invoice->unit_rate = $request['ur'][$i];
      $invoice->description = $request['desc'][$i];
      $invoice->batch = $batch;
      $invoice->Serial_Number = $i+1;


      if(!$invoice->save()){
        return redirect()->route('invoice')->with('message', 'Something went wrong while creating quotation!');
      }
    }
    return redirect()->route('invoice')->with('message', 'Invoice created successfully!');
  }
  
  public function editInvoice(Request $request){
      
    if(DB::table('invoices')->where('batch', '=', $request['batch'])->delete()){ 

        // $request = $request['data'];
        
        $count = count($request['quantity']);
        $quote = DB::table('invoices')->orderBy('created_at', 'desc')->first();
        if(!isset($quote->batch)){
          $batch = 1;
        }
        else{
          $batch = $quote->batch+1;
        }
    
        for($i=0;$i<$count;$i++) {
          $invoice = new Invoice();
    
          $invoice->performa_invoice = $request['pi'];
          $invoice->dated = $request['date'];
          $invoice->indenter = $request['ind'];
          $invoice->consignee = $request['cons'];
          $invoice->reference_number = $request['rn'];
          $invoice->reference_date = $request['rd'];
          $invoice->bills_to = $request['bt'];
          $invoice->bill_in_name = $request['bn'];
          $invoice->payment_terms = $request['pt'];
          $invoice->delivery_to = $request['dt'];
          $invoice->delivery_period = $request['dp'];
          $invoice->road_permit = $request['rp'];
          $invoice->freight_charges = $request['fc'];
          $invoice->mode_of_transport = $request['mt'];
          $invoice->quantity = $request['quantity'][$i];
          $invoice->tax = $request['tax'][$i];
          $invoice->unit_rate = $request['ur'][$i];
          $invoice->description = $request['desc'][$i];
          $invoice->batch = $batch;
          $invoice->Serial_Number = $i+1;
    
    
          if(!$invoice->save()){
            return redirect()->route('invoice')->with('message', 'Something went wrong while editing invoice!');
          }
        }
        return redirect()->route('invoice')->with('message', 'Invoice edited successfully!');
    }

    // if(DB::table('purchases')->where('id', '=', $id)->update([
    //   'performa_invoice' => $request['pi'],
    //   'dated' => $request['date'],
    //   'indenter' => $request['ind'],
    //   'consignee' => $request['cons'],
    //   'reference_number' => $request['rn'],
    //   'reference_date' => $request['rd'],
    //   'bills_to' => $request['bt'],
    //   'bill_in_name' => $request['bn'],
    //   'payment_terms' => $request['pt'],
    //   'delivery_to' => $request['dt'],
    //   'delivery_period' => $request['dp'],
    //   'road_permit' => $request['rp'],
    //   'freight_charges' => $request['fc'],
    //   'mode_of_transport' => $request['mt'],
    //   'quantity' => $request['quantity'][$i],
    //   'tax' => $request['tax'][$i],
    //   'unit_rate' => $request['ur'][$i],
    //   'description' => $request['desc'][$i],
    //   'batch' => $batch,
    //   'Serial_Number' => $i+1
    // ])){
    //   return redirect()->route('purchase')->with('message', 'Successfully updated the entry!');
    // }
    // else{
    //   return redirect()->route('purchase')->with('message', 'Nothing has been edited!');
    // }
  }
  
  public function editQuotation(Request $request){
      
    if(DB::table('quotations')->where('batch', '=', $request['batch'])->delete()){ 

        // $request = $request['data'];
        
    $count = count($request['tax']);
    $batch = Quotation::max('batch');

    for($i=0;$i<$count;$i++) {
      $quotation = new Quotation();

      $quotation->To = $request['to'];
      $quotation->Quotation_Number = $request['qn'];
      $quotation->Quote_valid_for = $request['qvf'];
      $quotation->Payment_terms = $request['pt'];
      $quotation->Quotation_Date = $request['qd'];
      $quotation->Serial_Number = $request['sn'][$i];
      $quotation->Description = $request['desc'][$i];
      $quotation->Quantity = $request['quantity'][$i];
      $quotation->Unit_Rate = $request['ur'][$i];
      $quotation->batch = ($batch+1);
      $quotation->Ref_no = $request['rn'];
      $quotation->Serial_Number = $i+1;
      $quotation->tax = $request['tax'][$i];
      $quotation->created_by = Auth::user()->id;

      if(!$quotation->save()){
        return redirect()->route('quote')->with('message', 'Something went wrong while editing quotation!');
      }
    }
    return redirect()->route('quote')->with('message', 'Quotation edited successfully!');
    }
  }
  
}
