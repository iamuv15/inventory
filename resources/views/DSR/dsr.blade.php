@extends('includes.layout')
  @section('title', 'DSR | Add')
  @section('content')

      <div id="content-wrapper">

            <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active">Add DSR</li>
                    </ol>

                    <!-- Page Content -->
                    <form class="addDSR" action="{{ asset('add/dsr') }}" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                              <!-- <div class="form-group col-md-6">
                                <label for="employee_id">Employee ID</label>
                                <input type="number" name="employee_id" class="form-control" id="employee_id" placeholder="Employee ID" required="required">
                              </div> -->
                              <div class="form-group col-md-6">
                                <label for="employee_id">Employee ID</label>
                                <input type="number" name="employee_id" class="form-control" id="employee_id" placeholder="Employee ID" required="required" value="{{ Auth::user()->id }}" disabled>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="datepicker1">Date</label>
                                    <div class='input-group date' id='datepicker1'>
                                        <input type='date' name="doj" class="form-control" required="required" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                              </div>
                              <!-- <script>
                                var date = new Date();
                                date.setDate(date.getDate());

                                $("#datepicker1").datepicker({
                                  autoclose: true,
                                  dateFormat: 'dd/mm/yy',
                                  changeMonth: true,
                                  changeYear: true
                                }).datepicker('update', new Date());
                              </script> -->
                              <div class="form-group col-md-6">
                                <label for="report">Report to office at</label>
                                <input type="text" name="report" class="form-control" id="report" placeholder="Report to office at" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="cname">Customer Name</label>
                                <input type="text" name="cname" class="form-control" id="cname" placeholder="Customer Name" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="location">location</label>
                                <input type="text" name="location" class="form-control" id="location" placeholder="location" required="required">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="contact_person">Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Contact Person" required="required">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-4">
                                <label for="purpose">Purpose of visit</label>
                                <input type="text" name="purpose" class="form-control" id="purpose" placeholder="Purpose of visit" required="required">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="swo">SWO or Call reference ID</label>
                                <input type="text" name="swo" class="form-control" id="swo" placeholder="SWO or Call reference ID" required="required">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="role">Role</label>
                                <input type="text" name="role" class="form-control" id="role" placeholder="Role" required="required">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="datepicker">Date of Work</label>
                                    <div class='input-group date' id='datepicker'>
                                        <input type='date' name="dow" class="form-control" required="required" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                              </div>
                              <!-- <script>
                                var date = new Date();
                                date.setDate(date.getDate());

                                $("#datepicker").datepicker({
                                  autoclose: true,
                                  dateFormat: 'dd/mm/yy',
                                  changeMonth: true,
                                  changeYear: true
                                }).datepicker('update', new Date());
                              </script> -->
                              <!-- <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->

                              <div class='col-md-4'>
                                <div class="form-group">
                                  <label for="wst">Work start time</label>
                                  <div class='input-group date' id='datetimepicker6'>
                                    <input type='time' id="wst" class="form-control" name="wst"/>
                                    <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class='col-md-4'>
                                <div class="form-group">
                                  <label for="wet">Work end time</label>
                                  <div class='input-group date' id='datetimepicker7'>
                                    <input type='time' id="wet" class="form-control" name="wet" />
                                    <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>
                                </div>
                              </div>

                              <!-- <script type="text/javascript">
                                $(document).ready(function() {
                                  $(function() {
                                    $('#datetimepicker6').datetimepicker();
                                    $('#datetimepicker7').datetimepicker({
                                      useCurrent: false //Important! See issue #1075
                                    });
                                    $("#datetimepicker6").on("dp.change", function(e) {
                                      $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                                    });
                                    $("#datetimepicker7").on("dp.change", function(e) {
                                      $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                                    });
                                  });
                                });
                              </script> -->
                              <div class="form-group col-md-4">
                                <label for="tsacl">Time Spent  at Customer location</label>
                                <input type="time" name="tsacl" class="form-control" id="tsacl" required="required">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Report to office</label>
                                <input type="text" class="form-control" name="rto" value="" placeholder="Report to office">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Additional Remark</label>
                                <input type="text" class="form-control" name="ar" value="" placeholder="Additional Remark">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Customer response/remarks</label>
                                <input type="text" class="form-control" name="crr" value="" placeholder="Customer response/remarks">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Total Expense</label>
                                <input type="number" class="form-control" name="texp" value="" placeholder="Total Expense">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">From</label>
                                <input type="text" class="form-control" name="from" value="" placeholder="From">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">To</label>
                                <input type="text" class="form-control" name="to" value="" placeholder="To">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Media</label>
                                <input type="text" class="form-control" name="media" value="" placeholder="Media">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Travelling Expense</label>
                                <input type="number" class="form-control" name="trexp" value="" placeholder="Travelling expense">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Particle Extra</label>
                                <input type="text" class="form-control" name="pext" value="" placeholder="Particle Extra">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">Expense</label>
                                <input type="number" class="form-control" name="exp" value="" placeholder="Expense">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputDoc1">With</label>
                                <input type="text" class="form-control" name="with" value="" placeholder="With">
                              </div>

                              <!-- <div class="doc1 row">
                                <div class="col-md-6">
                                  <div class="file-upload one upload">
                                    <h3></h3>
                                    <input type='file' name="file1" id="imgInp1" required="required" />
                                    <img class="hide" id="file1" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="file-upload two upload">
                                    <h3></h3>
                                    <input type='file' name="file2" id="imgInp2"/>
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
                                    <input type='file' name="file3" id="imgInp3" required="required" />
                                    <img class="hide" id="file3" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="file-upload two upload">
                                    <h3></h3>
                                    <input type='file' name="file4" id="imgInp4"/>
                                    <img class="hide" id="file4" src="" style="height: 300px; width: 300px;"/>
                                  </div>
                                </div>
                              </div> -->
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <button type="submit" class="submit btn btn-primary">Add DSR</button>
                          </form>

                  </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->

        @include('footer')

      </div>
      <!-- /.content-wrapper -->

  @endsection
