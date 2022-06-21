<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

<script type="text/javascript">

  var encrypted = '{!! $data !!}';
  // console.log(encrypted);
  var email = '{{ $email }}';
  var token = '{{ Session::token() }}';

  console.log('hi');

  $(document).ready(function(){
    $.ajax({
      url: 'user/auth',
      type: 'post',
      data: {'encrypted': encrypted, 'email': email, '_token': token},
      success: function(r){
        window.location = r;
      }
    })
  })

  // var a = CryptoJSAesDecrypt(get_value(),encrypted);

  // console.log(a);

</script>
