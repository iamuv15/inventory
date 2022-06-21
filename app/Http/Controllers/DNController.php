<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DNForm;

class DNController extends Controller
{
  public function newEntry(Request $request){
    $dn = new DNForm();

    $dn->Entitlement = $request['entitlement'];
    $dn->Reason_For_Claim = $request['rfc'];
    $dn->Service_Order_No = $request['son'];
    $dn->Equipment_Serial_No = $request['esn'];
    $dn->Equipment_Description = $request['ed'];
    $dn->Equipment = $request['equipment'];
    $dn->Customer_Name = $request['cn'];
    $dn->Customer_Location = $request['cl'];
    $dn->Modality = $request['modality'];
    $dn->Machine = $request['machine'];
    $dn->Local_Or_Outstation = $request['loo'];
    $dn->Invoice_Value = $request['iv'];
    $dn->Claim = $request['claim'];
    $dn->Invoice_No_Sales_No_Contract_No = $request['in'];
    $dn->Cheque_RTGS = $request['crtgs'];
    $dn->Remarks = $request['remarks'];

    if($dn->save()){
      return redirect()->route('dn')->with('message', 'Entry successfully added!');
    } else {
      return redirect()->route('dn')->with('message', 'Something went wrong while entering data!');
    }

  }
}
