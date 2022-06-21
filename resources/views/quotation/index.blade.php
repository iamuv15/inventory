@extends('includes.layout')
  @section('title', 'Quotation')
  
  <style>
    .show-read-more .more-text{
        display: none;
    }
    
    .lds-dual-ring {
      display: inline-block;
      width: 64px;
      height: 64px;
    }
    .lds-dual-ring:after {
      content: " ";
      display: block;
      width: 46px;
      height: 46px;
      margin: 1px;
      border-radius: 50%;
      border: 5px solid #000;
      border-color: #000 transparent #000 transparent;
      animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    
	.hide{
		display: none !important;
	}
	
	.desc{
	    white-space: pre-wrap;
	}

	@media (min-width: 576px){
		.modal-dialog {
		    max-width: 80% !important;
		    margin: 1.75rem auto;
		}
	}
  </style>

  @section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!-- <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->

<div class="container">
	<div class="row">


        <div class="col-md-12"><br>
          <br>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Quotation</li>
        </ol>

        @if(Session::has('message'))
          <div class="alert alert-danger">
            {{ Session::get( 'message' ) }}
          </div>
        @endif

				<!-- <p id="flash" style="color: red; font-size: 18px">Refresh the page after edit or delete to see the changes. AJAX will be applied soon and you won't have to refresh again!</p> -->
        <div class="table-responsive">
          <a href="{{ route('addQuotation') }}" name="add_new" class="btn btn-primary" data-title="Add" data-target="#add">Create new quotation</a><br><br>
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
             <tr>
               <th>Reference Number</th>
               <th>To</th>
               <th>Quotation Date</th>
               <th>Action</th>
               <th>Action</th>
               <th>Action</th>
             </tr>
            </thead>
            <tbody>
				@foreach($items->unique('batch') as $item)
  	              <tr>
  	                @if($item->id < 10)
                      <td>MED-00{{ $item->id }}</td>
                    @elseif($item->id >= 10 && $item->id < 100)
                      <td>MED-0{{ $item->id }}</td>
                    @else
                      <td>MED-{{ $item->id }}</td>
                    @endif
  	                <td>{{ $item->To }}</td>
  	                <td>{{ $item->Quotation_Date }}</td>
  	                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><a href="{{ asset('quotation') }}/edit/{{ $item->batch }}" class="btn btn-primary btn-xs" data-title="Edit">Edit</a></p></td>
  	                <td><p data-placement="top" data-toggle="tooltip" title="Print"><a href="{{ asset('quotation') }}/club/{{ $item->batch }}" class="btn btn-primary btn-xs" data-title="Print">Print</a></p></td>
  	                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><a href="{{ asset('quotation') }}/delete/{{ $item->batch }}" class="btn btn-danger btn-xs" data-title="Delete">Delete</a></p></td>
  	              </tr>
				@endforeach
            </tbody>
          </table>

          <a href="{{ URL::to("downloadExcel/quotation/quotation_".date('d-m-Y')."/xlsx/") }}"><button class="btn btn-success">Download Excel xlsx</button></a>

          <script type="text/javascript">
            $(document).ready(function() {
              $('#mytable').DataTable();
            });
          </script>

          <div class="clearfix"></div>
        </div>
      </div>
	</div>
</div>


    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
        <form class="modal-content" action="{{ asset('quotation/add') }}" method="post">
          <div class="modal-header">
            <h4 class="modal-title custom_align" id="Heading">Create new quotation</h4>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="To">To*</label>
                <input type="text" name="to" class="form-control" id="To" placeholder="To" required="required" value="">
              </div>

              <div class="form-group col-md-6">
                <label for="sn">Tax*</label>
                <input type="number" name="tax" value="" class="form-control" id="tax" placeholder="tax" required="required">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="qd">Quotation Date*</label>
                <input type="date" name="qd" value="" class="form-control" id="qd" placeholder="Quotation Date" required="required">
              </div>    
              <div class="form-group col-md-6">
                <label for="sn">Serial Number</label>
                <input type="text" name="sn" value="" class="form-control" id="sn" placeholder="Serial Number">
              </div>
            </div>
            <div class="form-group col-md-12">
                <label for="desc">Description*</label><br>
                <textarea placeholder="" id="description_id" name="desc" required style="width: 100% !important; resize: none" required="required"></textarea>

                <script type="text/javascript">
                  $('#description_id').on('input', function() {
                    this.style.height = '';
                    this.style.height = this.scrollHeight + 'px';
                  })
                  .focus();
                </script>
              </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="quantity">Quantity*</label>
                <input type="number" name="quantity" class="form-control" value="" id="quantity" placeholder="Quantity" required="required">
              </div>
              <div class="form-group col-md-6">
                <label for="ur">Unit Rate*</label>
                <input type="number" name="ur" class="form-control" value="" id="ur" placeholder="Unit Rate" required="required">
              </div>
            </div>
          </div>
          <div class="modal-footer ">
            <input required type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" name="add_new" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-check"></span>Create</button>
          </div>
        </form>
      </div>
          <!-- /.modal-dialog -->
    </div>
    
    <div class="modal fade" id="desc" tabindex="-1" role="dialog" aria-labelledby="desc" aria-hidden="true">
      <div class="modal-dialog" style="position: relative; top: 200px;">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Description</h4>
              </div>
              <div class="modal-body">
                <p class="desc"></p>
                <center><div class="lds-dual-ring"></div></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="club" tabindex="-1" role="dialog" aria-labelledby="club" aria-hidden="true">
	      <div class="modal-dialog">
	        <form class="modal-content club-form" action="" method="post">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	            <h4 class="modal-title custom_align" id="Heading">Create Invoice</h4>
	          </div>
	          <div class="modal-body">
	                        <center><div class="lds-dual-ring"></div></center>
							<table id="club-bill" class="table table-bordred table-striped hide">
								<thead>
								 <tr>
								     <th></th>
									 <th>Reference Number</th>
									 <th>To</th>
									 <th>Quotation Number</th>
									 <th>Quotation Date</th>
									 <th>Serial Number</th>
									 <th>Quantity</th>
									 <th>Unit Rate</th>
									 <th>Tax</th>
								 </tr>
								</thead>
								<tbody>

								</tbody>
							</table>
	          </div>
						<script type="text/javascript">
							$('.club-bill-btn').on('click', function(){
								
								
								$.ajax({
									url: '../quotation/club',
									method: 'GET',
									dataType: 'json',
									success: function(r){
									    $(document).ready(function() {
        									$('#club-bill').DataTable();
        								});
								// 		$('.input').remove();
										$('#club-bill tbody tr').remove();
										// console.log(r);
										
										$.each(r, function(key, value){
										    if(r[key].Quotation_Number < 10){
										        var ref = 'MED-00'+r[key].Quotation_Number;
										    }
										    else if((r[key].Quotation_Number >= 10) && (r[key].Quotation_Number < 100)){
										        var ref = 'MED-0'+r[key].Quotation_Number;
										    }
										    else{
										        var ref = 'MED-'+r[key].Quotation_Number;
										    }
											$('<tr>', {
												'html': $('<td>', {
													'class': 'id',
													'html': $('<input>', {
														'type': 'checkbox',
														'class': 'input',
														'id': r[key].Quotation_Number,
														'data-id': r[key].Quotation_Number
													})
												}).add($('<td>', {
													'class': 'reference_number',
													'html': ref
												})).add($('<td>', {
													'class': 'to',
													'html': r[key].To
												})).add($('<td>', {
													'class': 'quotation_number',
													'html': r[key].Quotation_Number
												})).add($('<td>', {
													'class': 'quotation_date',
													'html': r[key].Quotation_Date
												})).add($('<td>', {
													'class': 'serial_number',
													'html': r[key].Serial_Number
												})).add($('<td>', {
													'class': 'quantity',
													'html': r[key].Quantity
												})).add($('<td>', {
													'class': 'unit_rate',
													'html': r[key].Unit_Rate
												})).add($('<td>', {
													'class': 'tax',
													'html': r[key].tax+'%'
												}))
											}).appendTo('#club-bill tbody');
											$('#club-bill').removeClass('hide');
											$('.lds-dual-ring').remove();
											$('.club-btn').removeAttr('disabled');
											// $('.id').append('<input type="checkbox" class="input" id="'+ r[key].item_code +'" data-id="'+ r[key].item_code +'" /> ');
											// $('.date-purchase').html(r[key].date_purchase);
											// $('.item_code').html(r[key].item_code);
											// $('.item_name').html(r[key].item_name);
											// $('.quantity').html(r[key].quantity);
											// $('.price-one').html(r[key].price);
											// $('.total').html(r[key].quantity*r[key].price);
										})
									}
								})
							})
						</script>
	          <div class="modal-footer ">
							<input required type="hidden" name="_token" value="{{ Session::token() }}">
	            <span class="glyphicon glyphicon-ok-sign"></span><input type="submit" name="add_new" class="btn btn-warning btn-lg club-btn" disabled style="width: 100%;" value="Create Invoice">
	          </div>
	        </form>
	        <!-- /.modal-content -->
	      </div>
	          <!-- /.modal-dialog -->
	    </div>

			<script type="text/javascript">
				$('.club-form').on('submit', function(e){
					e.preventDefault();
					var ic = new Array();
					$('#club-bill tbody td input').each(function(key, value){
						// console.log($(this).attr('data-id'));

						if ($(this).is(':checked')) {
				// 			alert('hello'+$(this).attr('data-id'));
							ic.push($(this).attr('data-id'));

						}



					})
					ic = JSON.stringify(ic);
					console.log(ic);
					if(ic){
						var token = '{{ Session::token() }}';
						$.ajax({
							url: '../quotation/club',
							data: {'ic': ic, '_token': token},
							method: 'POST',
							success: function(r){
								// console.log(r);
								$("html").html(r);
							}
						})
					}
					return false;
				})
			</script>

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
    
    <script type="text/javascript">
        $(document).ready(function(){
            var maxLength = 3;
            $(".show-read-more").each(function(){
                var myStr = $(this).text();
                if($.trim(myStr).length > maxLength){
                    var newStr = myStr.substring(0, maxLength);
                    var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                    $(this).empty().html(newStr);
                    $(this).append(' <a href="#desc" class="read-more">read more...</a>');
                    $(this).append('<span class="more-text">' + removedStr + '</span>');
                }
            });
            $(".read-more").click(function(){
                $('#desc').modal('show');
                var id = $(this).parent().attr('id');
                $('.desc').html('');
                $('center > div').addClass('lds-dual-ring');
                $.ajax({
                    url: 'quotation/desc',
                    method: 'get',
                    data: {'id': id},
                    success: function(r){
                        $('.lds-dual-ring').removeClass('lds-dual-ring');
                        $('.desc').html(r);
                    }
                })
            });
        });
    </script>

		<!-- Edit script -->
		<script type="text/javascript">
			$('.edit-btn').on('click', function(){
				var btn = $(this).attr('data-id');

				$.ajax({
					url: 'inventory/edit/'+btn,
					method: 'GET',
					// dataType: 'application/json',
					success: function(res){
            // console.log(res);
            // location.reload();
							$('#ic').val(res[0].item_code);
							$('#in').val(res[0].item_name);
							$('#st1').val(res[0].sub_type_1);
							$('#st2').val(res[0].sub_type_2);
							$('#st3').val(res[0].HSN_SAC);
							$('#company').val(res[0].company);
							$('#Quantity').val(res[0].quantity);
					}
				});

				$('#edit_btn').on('submit', function(){
				  var that = $(this),
							url = $(this).attr('action'),
				      type = that.attr('method'),
				      data = {};

				  that.find('[name]').each(function(index, value){
				    var that = $(this),
				        name = that.attr('name'),
				        value = that.val();
				    data[name] = value;
				  });


					$.ajax({
						url: url,
						method: 'POST',
						data: {'data': data, 'id': btn, '_token': token},
						success: function(res){
							// console.log(res);
              location.reload();

							// $('#mytable tbody tr').each(function(){
							// 	alert($(this).children().first().html());
							// 	if($(this).children().first().html() == res[0].item_code){
							// 		$(this).children(0).html(res[0].item_code);
							// 		$(this).children(1).html(res[0].item_name);
							// 		$(this).children(2).html(res[0].sub_type_1);
							// 		$(this).children(3).html(res[0].sub_type_2);
							// 		$(this).children(4).html(res[0].sub_type_3);
							// 		$(this).children(5).html(res[0].company);
							// 		$(this).children(6).html(res[0].quantity);
							// 	}
							// })

						}
					});
					return false;
				});
			});
		</script>

		<!-- Delete script -->
		<script type="text/javascript">
			$('.delete-btn').on('click', function(){
				var btn = $(this).attr('data-id');
				$('#delete_btn').on('click', function(){
					$.ajax({
						url: 'inventory/delete/'+btn,
						method: 'post',
						data: {'id': btn, '_token': token},
						success: function(res){
							location.reload();
						}
					});
				});
				$('#cancel_btn').on('click', function(){
					btn = 0;
				});
			});
		</script>

		<script type="text/javascript">
			setInterval(function(){
				var color = $('#flash').css('color');
				if(color == 'rgb(255, 0, 0)'){
					setTimeout(function(){
						$('#flash').css('color', 'black');
					}, 500);
				}
				else{
					setTimeout(function(){
						$('#flash').css('color', 'red');
					}, 500);
				}
			}, 500)
		</script>

	@endsection
