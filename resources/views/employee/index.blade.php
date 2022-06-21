@extends('includes.layout')
  @section('title', 'Employees')

  @section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!-- <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->

<div class="container">
    @if(Session::has('message'))
            <p class="alert alert-danger">{{ Session::get( 'message' ) }}</p>
        @endif
	<div class="row">


        <div class="col-md-12"><br>
          <br>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employees</li>
        </ol>
        <div class="table-responsive">
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
             <tr>
               <th>Employee ID</th>
               <th>Employee Name</th>
               <th>Employee Email</th>
               <th>Contact Number</th>
               <th>Action</th>
               <th>Action</th>
             </tr>
            </thead>
            <tbody>
							@foreach($items as $item)
	              <tr>
	                <td>{{ $item->id }}</td>
	                <td>{{ $item->fname }} {{ $item->lname }}</td>
	                <td>{{ $item->email }}</td>
	                <td>{{ $item->contact_no }}</td>
	                <td><p data-placement="top" data-toggle="tooltip" title="Details"><a href="details/employee/{{ $item->id }}" class="btn btn-primary btn-xs delete-btn" style="color: white">Details</a></p></td>
	                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><a href="delete/employee/{{ $item->id }}" class="btn btn-danger btn-xs delete-btn" style="color: white">Delete</a></p></td>
	              </tr>
							@endforeach
            </tbody>
          </table>
          <br>

          <a href="{{ URL::to("downloadExcel/employee/employees_".date('d-m-Y')."/xlsx/") }}"><button class="btn btn-success">Download Excel xlsx</button></a>

          <br><br>

          <script type="text/javascript">
            $(document).ready(function() {
              $('#mytable').DataTable();
            });
          </script>

          <div class="clearfix"></div>
        </div>
      </div>
	</div>
  @include('footer')
</div>

	<script type="text/javascript">
		var token = '{{ Session::token() }}';
	</script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#mytable #checkall").click(function () {
              if ($("#mytable #checkall").is(':checked')) {
                  $("#mytable input required[type=checkbox]").each(function () {
                      $(this).prop("checked", true);
                  });

              } else {
                  $("#mytable input required[type=checkbox]").each(function () {
                      $(this).prop("checked", false);
                  });
              }
          });

          $("[data-toggle=tooltip]").tooltip();
        });
    </script>

	@endsection
