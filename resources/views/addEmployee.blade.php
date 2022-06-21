@extends('includes.layout')
  @section('title', 'Add | Employee')
  @section('content')
      <div id="content-wrapper">

            <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active">Add Employee</li>
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
                              <div class="form-group col-md-6">
                                <label for="employee_id">Employee ID</label>
                                <input type="number" name="employee_id" class="form-control" id="employee_id" placeholder="Employee ID" required="required" value="{{ old('employee_id') }}">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="datepicker1">Date of Joining</label>
                                    <div class='input-group date' id='datepicker1'>
                                        <input type='date' name="doj" class="form-control" required="required" value="{{ old('doj') }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                              </div>
                              <script>
                                var date = new Date();
                                date.setDate(date.getDate());

                                $("#datepicker1").datepicker({
                                  autoclose: true,
                                  dateFormat: 'dd/mm/yy',
                                  changeMonth: true,
                                  changeYear: true
                                }).datepicker('update', new Date());
                              </script>
                              <div class="form-group col-md-6">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" value="{{ old('fname') }}" class="form-control" id="fname" placeholder="First Name" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" value="{{ old('lname') }}" class="form-control" id="lname" placeholder="Last Name" required="required">
                              </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="email">Email</label>
                                      <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email" required="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="password">Password</label>
                                      <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required">
                                    </div>
                                  </div>
                            <div class="form-group">
                              <label for="inputAddress">Address</label>
                              <input type="text" name="addr1" class="form-control" value="{{ old('addr1') }}" id="inputAddress" placeholder="1234 Main St" required="required">
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Address 2</label>
                              <input type="text" name="addr2" class="form-control" value="{{ old('addr2') }}" id="inputAddress2" placeholder="Apartment, studio, or floor" required="required">
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city') }}" id="inputCity" required="required">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" name="state" value="{{ old('state') }}" class="form-control" required="required">
                                  <option value="">Choose...</option>
                                  <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                  <option value="Andhra Pradesh">Andhra Pradesh</option>
                                  <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                  <option value="Assam">Assam</option>
                                  <option value="Bihar">Bihar</option>
                                  <option value="Chandigarh">Chandigarh</option>
                                  <option value="Chhattisgarh">Chhattisgarh</option>
                                  <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                  <option value="Daman and Diu">Daman and Diu</option>
                                  <option value="Delhi">Delhi</option>
                                  <option value="Goa">Goa</option>
                                  <option value="Gujarat">Gujarat</option>
                                  <option value="Haryana">Haryana</option>
                                  <option value="Himachal Pradesh">Himachal Pradesh</option>
                                  <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                  <option value="Jharkhand">Jharkhand</option>
                                  <option value="Karnataka">Karnataka</option>
                                  <option value="Kerala">Kerala</option>
                                  <option value="Lakshadweep">Lakshadweep</option>
                                  <option value="Madhya Pradesh">Madhya Pradesh</option>
                                  <option value="Maharashtra">Maharashtra</option>
                                  <option value="Manipur">Manipur</option>
                                  <option value="Meghalaya">Meghalaya</option>
                                  <option value="Mizoram">Mizoram</option>
                                  <option value="Nagaland">Nagaland</option>
                                  <option value="Orissa">Orissa</option>
                                  <option value="Pondicherry">Pondicherry</option>
                                  <option value="Punjab">Punjab</option>
                                  <option value="Rajasthan">Rajasthan</option>
                                  <option value="Sikkim">Sikkim</option>
                                  <option value="Tamil Nadu">Tamil Nadu</option>
                                  <option value="Telangana">Telangana</option>
                                  <option value="Tripura">Tripura</option>
                                  <option value="Uttaranchal">Uttaranchal</option>
                                  <option value="Uttar Pradesh">Uttar Pradesh</option>
                                  <option value="West Bengal">West Bengal</option>
                                </select>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" name="zip" value="{{ old('zip') }}" class="form-control" id="inputZip" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputMob">Mobile Number</label>
                                <input type="number" name="contact" value="{{ old('contact') }}" class="form-control" id="inputMob" required="required">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="datepicker">Date of Birth</label>
                                    <div class='input-group date' id='datepicker'>
                                        <input type='date' name="apply_by" value="{{ old('apply_by') }}" class="form-control" required="required" />
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

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Document 1</label>
                                <select id="inputDoc1" name="state" class="form-control" required="required">
                                  <option value="">Choose...</option>
                                  <option value="Aadhaar">Aadhaar</option>
                                  <option value="PAN">PAN</option>
                                  <option value="Voter ID">Voter ID</option>
                                  <option value="Driving Licence">Driving Licence</option>
                                </select>
                              </div>

                              <div class="doc1 row">
                                <div class="col-md-6">
                                  <div class="file-upload one upload">
                                    <h3></h3>
                                    <input type='file' name="file1" id="imgInp1" required="required" value="{{ old('file1') }}" />
                                    <img class="hide" id="file1" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="file-upload two upload">
                                    <h3></h3>
                                    <input type='file' name="file2" id="imgInp2" value="{{ old('file2') }}"/>
                                    <img class="hide" id="file2" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc2">Document 2</label>
                                <select id="inputDoc2" name="state" class="form-control" required="required">
                                  <option value="">Choose...</option>
                                  <option value="Aadhaar">Aadhaar</option>
                                  <option value="PAN">PAN</option>
                                  <option value="Voter ID">Voter ID</option>
                                  <option value="Driving Licence">Driving Licence</option>
                                </select>
                              </div>

                              <div class="doc2 row">
                                <div class="col-md-6">
                                  <div class="file-upload one upload">
                                    <h3></h3>
                                    <input type='file' name="file3" value="{{ old('file3') }}" id="imgInp3" required="required" />
                                    <img class="hide" id="file3" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="file-upload two upload">
                                    <h3></h3>
                                    <input type='file' name="file4" value="{{ old('file4') }}" id="imgInp4"/>
                                    <img class="hide" id="file4" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
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
