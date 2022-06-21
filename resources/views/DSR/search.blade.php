@extends('includes.layout')
  @section('title', 'DSR | Search')
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  @section('content')

    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Search DSR</li>
        </ol>

        <!-- Page Content -->
        <form class="searchDSR" action="{{ asset('search/dsr') }}" method="post">
          <label for="">Search By</label>
          <select id="trigger" name="">
            <option value="Select">Select</option>
            <option value="Employee">Employee</option>
            <option value="All">All</option>
          </select>
          <div class="form-row type_emp">
            <div class="form-group col-md-4">
              <label for="from_date">Employee ID/Name</label>
              <input type="text" name="id" class="form-control" id="from_date" placeholder="Employee ID/Name">
            </div>
            <div class="form-group col-md-4">
              <label for="from_date">From date</label>
              <input type="date" name="from1" class="form-control" id="from_date" placeholder="Employee ID">
            </div>
            <div class="form-group col-md-4">
              <label for="to_date">To date</label>
              <input type="date" name="to1" class="form-control" id="to_date" placeholder="date">
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <div class="form-group col-md-6">
              <input type="submit" name="submit" class="btn btn-primary" value="Search...">
            </div>
          </div>
          <div class="form-row type_all">
            <div class="form-group col-md-4">
              <label for="from_date">From date</label>
              <input type="date" name="from2" class="form-control" id="from_date" placeholder="Employee ID">
            </div>
            <div class="form-group col-md-4">
              <label for="to_date">To date</label>
              <input type="date" name="to2" class="form-control" id="to_date" placeholder="date">
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <div class="form-group col-md-6">
              <input type="submit" name="submit" class="btn btn-primary" value="Search...">
            </div>
          </div>
        </form>
      </div>
      @include('footer')
    </div>

  @endsection
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.type_all, .type_emp').hide();
    });
  </script>
  <script>
    $(document).ready(function(){
      $('#trigger').on('change', function(){
        if($(this).val() == 'Employee'){
          $('.type_emp').show();
          $('.type_all').hide();
        }
        else if($(this).val() == 'All'){
          $('.type_all').show();
          $('.type_emp').hide();
        } else {
          $('.type_all, .type_emp').hide();
        }
      })
    })
  </script>
</body>
