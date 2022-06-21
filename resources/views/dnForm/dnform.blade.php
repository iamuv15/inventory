@extends('includes.layout')
  @section('title', 'New Entry | DN form')
  @section('content')
      <div id="content-wrapper">

            <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ asset('dn-form') }}">DN form</a>
                      </li>
                      <li class="breadcrumb-item active">new entry</li>
                    </ol>

                    @if(Session::has('redirect'))
                      @if(Session::has('message'))
                        @foreach(Session::get( 'message' ) as $message)
                          <div class="alert alert-danger">
                            {{ $message }}
                          </div>
                        @endforeach
                      @endif
                    @endif

                    <!-- Page Content -->
                    <form class="addEmployee" action="{{ asset('dn-form/add') }}" method="post">
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="entitlement">Entitlement</label>
                                <input type="text" name="entitlement" class="form-control" id="entitlement" placeholder="Entitlement" required="required">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="rfc">Reason for claim</label>
                                    <div class='input-group' id=''>
                                        <input type='text' id="rfc" name="rfc" class="form-control" required="required" placeholder="Reason for claim">
                                    </div>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="son">Service Order No</label>
                                <input type="text" name="son" class="form-control" id="son" placeholder="Service Order No" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="esn">Equipment serial No</label>
                                <input type="text" name="esn" class="form-control" id="esn" placeholder="Equipment serial No" required="required">
                              </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="ed">Equipment description</label>
                                      <input type="text" name="ed" class="form-control" id="ed" placeholder="Equipment description" required="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="equipment">Equipment</label>
                                      <input type="text" name="equipment" class="form-control" id="equipment" placeholder="Equipment" required="required">
                                    </div>
                                  </div>
                            <div class="form-group">
                              <label for="cn">Customer Name</label>
                              <input type="text" name="cn" class="form-control" id="cn" placeholder="Customer Name" required="required">
                            </div>
                            <div class="form-group">
                              <label for="cl">Customer Location</label>
                              <input type="text" name="cl" class="form-control" id="cl" placeholder="Customer Location" required="required">
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="modality">Modality</label>
                                <input type="text" name="modality" class="form-control" id="modality" required="required" placeholder="Modality">
                              </div>

                              <div class="form-group col-md-6">
                                <label for="machine">Machine</label>
                                <input type="text" name="machine" class="form-control" id="machine" required="required" placeholder="Machine">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="loo">Local or Outstation</label>
                                <input type="text" name="loo" class="form-control" id="loo" required="required" placeholder="Local or Outstation">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="iv">Invoice Value</label>
                                    <div class='input-group date' id='iv'>
                                        <input type='text' name="iv" class="form-control" required="required" placeholder="Invoice Value">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                              </div>
                              <script>
                                var date = new Date();
                                date.setDate(date.getDate());

                                $("#datepicker").datepicker({
                                  autoclose: true,
                                  dateFormat: 'dd/mm/yy',
                                  changeMonth: true,
                                  changeYear: true
                                }).datepicker('update', new Date());
                              </script>
                              <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="claim">Claim</label>
                                <input type="text" name="claim" class="form-control" id="claim" required="required" placeholder="Claim">
                              </div>

                              <div class="form-group col-md-6">
                                <label for="in">Invoice No/Sales No/Contract No</label>
                                <input type="text" name="in" class="form-control" id="in" required="required" placeholder="Invoice No/Sales No/Contract No">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="crtgs">Cheque RTGS (with date)</label>
                                <input type="text" name="crtgs" class="form-control" id="crtgs" required="required" placeholder="Cheque RTGS (with date)">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="remarks">Remarks</label>
                                    <div class='input-group' id='remarks'>
                                        <input type='text' name="remarks" class="form-control" required="required" placeholder="Remarks" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                              </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <button type="submit" class="submit btn btn-primary">Add Entry</button>

                          </div>
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
