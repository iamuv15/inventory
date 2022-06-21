<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Document;
use DB;

class UploadFileController extends Controller
{
    function upload(Request $request){
      // $this->validate($request, [
      //   'upload'  => 'required|image|mimes:jpg,jpeg|max:2048'
      //  ]);

      $data = $request;
      $error = [];

      if($data['employee_id'] !== null){
        $check = DB::table('employees')->where('id', '=', $data['employee_id'])->first();
        if($check !== null){
          array_push($error, 'Employee ID already exists!');
        }
      }

      if(($data['fname'] !== null) && ($data['lname'] !== null)){
        // check name format
      }
      else{
        array_push($error, 'Name is required!');
      }
      if(($data['email'] !== null)){
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          array_push($error, 'Email format is not correct!');
        }
      }
      else {
        array_push($error, "Email is required!");
      }
      if(($data['password'] !== null)){
        if (strlen($data['password']) < 8) {
          array_push($error, 'Password should be 8 or more than 8 characters long!');
        }
      }
      else {
        array_push($error, "Password is required!");
      }
      if(($data['addr1'] !== null) && ($data['addr2'] !== null)){
        // check address
      }
      else {
        array_push($error, 'Address is required!');
      }
      if($data['zip'] !== null){
        if(!preg_match('/^[1-9][0-9]{5}$/', $data['zip'])){
          array_push($error, 'Zip code is not in correct format!');
        }
      }
      else {
        array_push($error, "Zip Code is required!");
      }
      if($data['contact'] !== null){
        if(!preg_match('/^[1-9][0-9]{9}$/', $data['contact'])){
          array_push($error, 'Contact Number is not in correct format!');
        }
      }
      else{
        array_push($error, 'Contact Number is required!');
      }

      if($error){
        return redirect()->back()->withInput()->with('message', $error)->with('redirect', 'true');
      }
      else{

        if(($data['fname'] !== null) && ($data['lname'] !== null) && ($data['email'] !== null) && ($data['password'] !== null) && ($data['addr1'] !== null) && ($data['addr2'] !== null)){
          if(($data['city'] !== null) && ($data['state'] !== null) && ($data['zip'] !== null) && ($data['contact'] !== null) && ($data['apply_by'] !== null)){

            $employee = new Employee();

            $employee->id = $data['employee_id'];
            $employee->fname = $data['fname'];
            $employee->lname = $data['lname'];
            $employee->email = $data['email'];
            $employee->password = bcrypt($data['password']);
            $employee->addr1 = $data['addr1'];
            $employee->addr2 = $data['addr2'];
            $employee->city = $data['city'];
            $employee->state = $data['state'];
            $employee->zip = $data['zip'];
            $employee->contact_no = $data['contact'];
            $employee->dob = $data['apply_by'];
            $employee->doj = $data['doj'];
            $employee->remember_token = $data['_token'];



            if(!$employee->save()){
              $error = 'Something Went Wrong, try again!';
            }
            else{
              if($data['file1'] !== null){
                $this->validate($request, [
                  'file1'  => 'required|image|mimes:jpg,png,gif|max:2048'
                ]);

               $image = $request->file('file1');

               $new_name = rand() . '.' . $image->getClientOriginalExtension();

               $image->move(public_path('images'), $new_name);

                $result = DB::table('employees')->where('email', '=', $data['email'])->first();

                $document = new Document();

                $document->employee_id = $result->id;
                $document->file = $new_name;



                if(!$document->save()){
                  return redirect()->back()->withInput()->with('message', "No file upload")->with('redirect', 'true');
                }
                // else {
                //   echo "Done 1 ";
                // }
              }

              if($data['file2'] !== null){
                $this->validate($request, [
                  'file2'  => 'required|image|mimes:jpg,png,gif|max:2048'
                ]);

               $image = $request->file('file2');

               $new_name = rand() . '.' . $image->getClientOriginalExtension();

               $image->move(public_path('images'), $new_name);

                $result = DB::table('employees')->where('email', '=', $data['email'])->first();

                $document = new Document();

                $document->employee_id = $result->id;
                $document->file = $new_name;



                if(!$document->save()){
                  return redirect()->back()->withInput()->with('message', "File uploading failed! Try again")->with('redirect', 'true');
                }
                // else {
                //   echo "Done2";
                // }
              }

              if($data['file3'] !== null){
                $this->validate($request, [
                  'file3'  => 'required|image|mimes:jpg,png,gif|max:2048'
                ]);

               $image = $request->file('file3');

               $new_name = rand() . '.' . $image->getClientOriginalExtension();

               $image->move(public_path('images'), $new_name);

                $result = DB::table('employees')->where('email', '=', $data['email'])->first();

                $document = new Document();

                $document->employee_id = $result->id;
                $document->file = $new_name;



                if(!$document->save()){
                  return redirect()->back()->withInput()->with('message', "File uploading failed! Try again")->with('redirect', 'true');
                }
                else {
                  if($data['file4'] == null){
                    return redirect()->route('index')->with('message', "Employee successfully added")->with('redirect', 'success');
                  }
                }
              }

              if($data['file4'] !== null){
                $this->validate($request, [
                  'file4'  => 'required|image|mimes:jpg,png,gif|max:2048'
                ]);

               $image = $request->file('file4');

               $new_name = rand() . '.' . $image->getClientOriginalExtension();

               $image->move(public_path('images'), $new_name);

                $result = DB::table('employees')->where('email', '=', $data['email'])->first();

                $document = new Document();

                $document->employee_id = $result->id;
                $document->file = $new_name;



                if(!$document->save()){
                  return redirect()->back()->withInput()->with('message', "File uploading failed! Try again")->with('redirect', 'true');
                }
                else {
                  return redirect()->route('index')->with('message', "File uploading failed! Try again")->with('redirect', 'success');
                }
              }
              return redirect()->route('index')->with('message', "Employee successfully added!")->with('redirect', 'true');


            }

          }
        }
      }
        return redirect()->route('index')->with('message', "Employee successfully added!")->with('redirect', 'true');
    }
}
