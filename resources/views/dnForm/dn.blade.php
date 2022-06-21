@extends('includes.layout')
  @section('title', 'DN Form')

  @section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!-- <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->

<div class="container">
	<div class="row">

    @if(Session::has('message'))
      <div class="row">
        <div class="alert alert-danger">
          {{ Session::get( 'message' ) }}
        </div>
      </div>
    @endif


        <div class="col-md-12"><br>
          <br>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">DN Form</li>
        </ol>
        <div class="table-responsive">
          <a href="{{ asset('/dn-form/add') }}" type="button" name="add_new" class="btn btn-primary" data-title="Add">New Entry</a><br><br>
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
             <tr>
               <th>DN Number</th>
               <th>Entitlement</th>
               <th>Reason for claim</th>
               <th>Service Order No</th>
               <th>Equipment serial No</th>
               <th>Equipment description</th>
               <th>Equipment</th>
               <th>Customer Name</th>
               <th>Customer Location</th>
               <th>Modality</th>
               <th>Machine</th>
               <th>Local or Outstation</th>
               <th>Invoice Value</th>
               <th>Claim</th>
               <th>Invoice No/Sales No/Contract No</th>
               <th>Cheque RTGS (with date)</th>
               <th>Remarks</th>
             </tr>
            </thead>
            <tbody>

	           @foreach($dnforms as $dn)
             <tr>
               <td>{{ $dn->id }}</td>
               <td>{{ $dn->Entitlement }}</td>
               <td>{{ $dn->Reason_For_Claim }}</td>
               <td>{{ $dn->Service_Order_No }}</td>
               <td>{{ $dn->Equipment_Serial_No }}</td>
               <td>{{ $dn->Equipment_Description }}</td>
               <td>{{ $dn->Equipment }}</td>
               <td>{{ $dn->Customer_Name }}</td>
               <td>{{ $dn->Customer_Location }}</td>
               <td>{{ $dn->Modality }}</td>
               <td>{{ $dn->Machine }}</td>
               <td>{{ $dn->Local_Or_Outstation }}</td>
               <td>{{ $dn->Invoice_Value }}</td>
               <td>{{ $dn->Claim }}</td>
               <td>{{ $dn->Invoice_No_Sales_No_Contract_No }}</td>
               <td>{{ $dn->Cheque_RTGS }}</td>
               <td>{{ $dn->Remarks }}</td>
             </tr>
             @endforeach

            </tbody>
          </table>

          <script type="text/javascript">
            $(document).ready(function() {
              $('#mytable').DataTable();
            });
          </script>

          <div class="clearfix"></div>
        </div>
        <br>
        <a href="{{ URL::to("downloadExcel/dn/DN_form_".date('d-m-Y')."/xlsx/") }}"><button class="btn btn-success">Download Excel xlsx</button></a>
      </div>
	</div>
</div>

	@endsection
