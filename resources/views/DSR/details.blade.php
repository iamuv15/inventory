@extends('includes.layout')
@section('title', 'DSR | Employee')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<style media="screen">
  table{
    display: block !important;
  }
</style>
  @section('content')

    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">DSR</li>
        </ol>

        <table id="table_id" class="display">
          <thead>
              <tr>
                  <th>Employee ID</th>
                  <th>Date</th>
                  <th>Report to office at</th>
                  <th>Customer Name</th>
                  <th>Location</th>
                  <th>Contact Person</th>
                  <th>Purpose of visit</th>
                  <th>SWO or Call reference ID</th>
                  <th>Date of Work</th>
                  <th>Work start time</th>
                  <th>Work end time</th>
                  <th>Time Spent at Customer location</th>
                  <th>Report to office</th>
                  <th>Additional Remark</th>
                  <th>Customer response/remarks</th>
                  <th>Total Expense</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Media</th>
                  <th>Travelling Expense</th>
                  <th>Particle Extra</th>
                  <th>Expense</th>
                  <th>With</th>
              </tr>
          </thead>
          <tbody>
            @foreach($results as $result)
              <tr>
                  <td>{{ $result->employee_id }}</td>
                  <td>{{ date('d-m-Y', strtotime($result->date)) }}</td>
                  <td>{{ $result->Report_to_office_at }}</td>
                  <td>{{ $result->Customer_Name }}</td>
                  <td>{{ $result->location }}</td>
                  <td>{{ $result->Contact_Person }}</td>
                  <td>{{ $result->Purpose_of_visit }}</td>
                  <td>{{ $result->SWO_or_Call_reference_ID }}</td>
                  <td>{{ date('d-m-Y', strtotime($result->Date_of_Work)) }}</td>
                  <td>{{ $result->Work_start_time }}</td>
                  <td>{{ $result->Work_end_time }}</td>
                  <td>{{ $result->Time_Spent_at_Customer_location }}</td>
                  <td>{{ $result->Report_to_office }}</td>
                  <td>{{ $result->Additional_Remark }}</td>
                  <td>{{ $result->Customer_response_remarks }}</</td>
                  <td>{{ $result->Total_Expense }}</td>
                  <td>{{ $result->From }}</td>
                  <td>{{ $result->To }}</td>
                  <td>{{ $result->Media }}</td>
                  <td>{{ $result->Travelling_Expense }}</td>
                  <td>{{ $result->Particle_Extra }}</td>
                  <td>{{ $result->Expense }}</td>
                  <td>{{ $result->With }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

<script type="text/javascript">
$(document).ready( function () {
  $('#table_id').DataTable({
    "scrollX": true
  });
} );
</script>
      <div>
        <a href="{{ URL::to('downloadExcel/DSR/xlsx/') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
      </div>
      </div>
    </div>
  @endsection
