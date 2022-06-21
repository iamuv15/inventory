@extends('includes.layout')

@section('link')
  <link rel="stylesheet" href="{{ asset('css/sb-admin.css') }}">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
@endsection

@section('content')
  <main class="container pt-5">

        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Registration Date</th>
                    <th>E-mail address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->fname }} {{ $user->lname }}</td>
                    <td>{{ date('M d, Y', strtotime($user->doj)) }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </tbody>
        </table>

        <form class="privileges" method="post">
          <table class="table table-bordered table-definition mb-5">
              <thead class="table-warning ">
                  <tr>
                      <th></th>
                      <th>Module</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($modules as $module)
                    <tr>
                        <td>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" id="opt-{{ $module->id }}" class="custom-control-input">
                                <span class="custom-control-indicator check-a"></span>
                            </label>
                        </td>
                        <td class="col-md-3">
                          <label for="opt-{{ $module->id }}" style="cursor: pointer">{{ $module->Module_Name }}</label>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                      <th></th>
                      <th colspan="4">
                          <!-- <button class="btn btn-primary float-right">Add User</button> -->
                          <input type="hidden" name="_token" value="{{ Session::token() }}">
                          <input type="submit" class="btn btn-default" value="Approve">
                      </th>
                  </tr>
              </tfoot>
          </table>
        </form>
        <div class="success" role="alert"></div>
        <script>
          $('form.privileges').on('submit', function(){
            $('.custom-checkbox input').each(function(key, value){
              var url = $(this).attr('action'),
                  id = '{{ $id }}',
                  token = '{{ Session::token() }}';
              if($(this).prop('checked')){
                console.log(key);
                $.ajax({
                  url: url,
                  method: 'POST',
                  data: {'id': id, 'module_id': key + 1, '_token': token},
                  success: function(r){
                    // console.log(r);
                    $('.success').addClass('alert alert-success');
                    $('.success').html(r);
                  }
                });
              }
            });
            return false;
          });
        </script>
    </main>
@endsection
