<?php

namespace App\Http\Controllers;

use App\DSR;
use DB;
use Illuminate\Http\Request;
use Auth;

class DSRController extends Controller
{
    public function addDSR(Request $request){
      if(($request['doj'] !== null) && ($request['report'] !== null) && ($request['cname'] !== null) && ($request['location'] !== null) && ($request['contact_person'] !== null) && ($request['purpose'] !== null)){
        if(($request['swo'] !== null) && ($request['dow'] !== null) && ($request['wst'] !== null) && ($request['wet'] !== null) && ($request['tsacl'] !== null) && ($request['rto'] !== null)){
          if(($request['ar'] !== null) && ($request['crr'] !== null) && ($request['texp'] !== null) && ($request['from'] !== null) && ($request['to'] !== null) && ($request['media'] !== null)){
            if(($request['trexp'] !== null) && ($request['pext'] !== null) && ($request['exp'] !== null) && ($request['exp'] !== null) && ($request['with'] !== null) && (Auth::user()->id !== null)){
              if(($request['role'] !== null)){
                $check1 = DB::table('employees')->where('id', '=', Auth::user()->id)->first();
                // print_r($check);
                if($check1 !== null){
                  $check2 = DB::table('dsr')->where([
                    ['date', '=', $request['doj']],
                    ['employee_id', '=', Auth::user()->id]
                  ])->get();

                  if(count($check2) < 1){

                    $dsr = new DSR();

                    $dsr->employee_id = Auth::user()->id;
                    $dsr->date = $request['doj'];
                    $dsr->Report_to_office_at = $request['report'];
                    $dsr->Customer_Name = $request['cname'];
                    $dsr->location = $request['location'];
                    $dsr->Contact_Person = $request['contact_person'];
                    $dsr->Purpose_of_visit = $request['purpose'];
                    $dsr->SWO_or_Call_reference_ID = $request['swo'];
                    $dsr->Date_of_Work = $request['dow'];
                    $dsr->Work_start_time = $request['wst'];
                    $dsr->Work_end_time = $request['wet'];
                    $dsr->Time_Spent_at_Customer_location = $request['tsacl'];
                    $dsr->Report_to_office = $request['rto'];
                    $dsr->Additional_Remark = $request['ar'];
                    $dsr->Customer_response_remarks = $request['crr'];
                    $dsr->Total_Expense = $request['texp'];
                    $dsr->From = $request['from'];
                    $dsr->To = $request['to'];
                    $dsr->Media = $request['media'];
                    $dsr->Travelling_Expense = $request['trexp'];
                    $dsr->Particle_Extra = $request['pext'];
                    $dsr->Expense = $request['exp'];
                    $dsr->With = $request['with'];
                    $dsr->role = $request['role'];

                    if($dsr->save()){
                      return redirect()->route('dashboard')->with('alert', 'DSR Successfully Added!');
                    }

                  }
                  else{
                    echo redirect()->route('dashboard')->with('alert', 'Entry for employee id '. $request['employee_id'] .' and date '. $request['doj'] .' already exists!');
                  }

                }
                else {
                  echo redirect()->route('dashboard')->with('alert', "Employee id doesn't exists!");
                }
              }
            }
          }
        }
      }
    }
}
