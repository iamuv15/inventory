@extends('includes.layout')
  @section('title', 'Add | Quotation')
  @section('content')
      <div id="content-wrapper">

            <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active">Add Quotation</li>
                    </ol>

                      @if(Session::has('message'))
                        @foreach(Session::get( 'message' ) as $message)
                          <div class="alert alert-danger">
                            {{ $message }}
                          </div>
                        @endforeach
                      @endif

                    <!-- Page Content -->
                    <form class="addEmployee" action="{{ asset('add/employees') }}" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="To">To</label>
                                <input type="text" name="to" class="form-control" id="To" placeholder="To" required="required" value="{{ old('employee_id') }}">
                              </div>

                              <div class="form-group col-md-6">
                                <label for="qn">Quotation Number</label>
                                <input type="text" name="qn" value="{{ old('fname') }}" class="form-control" id="qn" placeholder="Quotation Number" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="qd">Quotation Date</label>
                                <input type="text" name="qd" value="{{ old('lname') }}" class="form-control" id="qd" placeholder="Quotation Date" required="required">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="sn">Serial Number</label>
                                <input type="text" name="sn" value="{{ old('email') }}" class="form-control" id="sn" placeholder="Serial Number" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="desc">Description</label>
                                <input type="text" name="desc" class="form-control" id="desc" placeholder="Description" required="required">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity" class="form-control" value="{{ old('addr1') }}" id="quantity" placeholder="Quantity" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="ur">Unit Rate</label>
                                <input type="text" name="ur" class="form-control" value="{{ old('addr2') }}" id="ur" placeholder="Unit Rate" required="required">
                              </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <button type="submit" class="submit btn btn-primary">Add Employee</button>
                          </form>

                  </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->

        @include('footer')

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    <script type="text/javascript">
      var token = '{{ Session::token() }}';
    </script>
    <script src="{{ asset('js/ajax.js') }}"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        console.log('here');
        if(!$('div').hasClass('alert')){
          console.log('if1');
          if($('#employee_id').val() !== null){
            console.log($('#employee_id').val());
            $('form')[0].reset();
          }
        }
      })
    </script>

    @endsection
