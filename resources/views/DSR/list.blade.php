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
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">DSR List</li>
        </ol>
        <div class="table-responsive">
          <button type="button" name="add_new" class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#add">Add New item</button><br><br>
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
             <tr>
               <th>Employee ID</th>
               <th>Employee Name</th>
               <th>Email</th>
               <th>Action</th>
             </tr>
            </thead>
            <tbody>
              {{ $to }}
							@foreach($ids as $item)
	              <tr>
	                <td>{{ $item->id }}</td>
	                <td>{{ $item->fname }} {{ $item->lname }}</td>
                  <td>{{ $item->email }}</td>
	                <td><a href="{{ asset('search/DSR/') }}/{{ $item->id }}/{{ $from }}/{{ $to }}" class="btn btn-primary search">Search</a></td>
	              </tr>
							@endforeach
            </tbody>
          </table>
          <script type="text/javascript">
            $(document).ready(function() {
              $('#mytable').DataTable();
            });

            // $('.search').on('click', function(){
            //   $.ajax({
            //     url: $(this).attr('href'),
            //     method: 'post',
            //     data: {'_token': token},
            //     success: function()
            //   })
            // })
          </script>

          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  @endsection
