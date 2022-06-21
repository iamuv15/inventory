@extends('includes.layout')
	@section('title', 'Inventory | Purchase')
	@section('content')

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

	<style media="screen">
		.hide{
			display: none !important;
		}

		@media (min-width: 576px){
			.modal-dialog {
			    max-width: 80% !important;
			    margin: 1.75rem auto;
			}
		}
	</style>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->


	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
	<!-- <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->

	<div class="container">
		<div class="row">


	        <div class="col-md-12"><br>
						<br>
					<ol class="breadcrumb">
	            <li class="breadcrumb-item">
	              <a href="{{ asset('inventory') }}">Inventory</a>
	            </li>
	            <li class="breadcrumb-item active">Purchase Orders</li>
	          </ol>

						@if(Session::has('message'))
							<div class="alert alert-danger">
								{{ Session::get( 'message' ) }}
							</div>
						@endif

	        <div class="table-responsive">
						<a href="{{ route('newPurchase') }}" name="add_new" class="btn btn-primary">Purchase New item</a>
	          <button type="button" name="club" class="btn btn-primary club-bill-btn" data-title="Add" data-toggle="modal" data-target="#club">Club Bill</button><br><br>
	          <table id="mytable" class="table table-bordred table-striped">
	            <thead>
	             <tr>
								 <th>Date</th>
	               <th>Item Code</th>
	               <th>Purchase Order Number</th>
	               <th>Item Name</th>
	               <th>Subject</th>
	               <th>HSN/SAC</th>
	               <th>Company</th>
								 <th>Quantity</th>
								 <th>Price</th>
								 <th>Tax</th>
	               <th>Total</th>
								 <th></th>
								 <th></th>
								 <th></th>
								 <th></th>
								 <th></th>
	             </tr>
	            </thead>
	            <tbody>
								@foreach($items as $item)
		              <tr>
										<td data-name="date_purchase">{{ date('d-m-Y', strtotime($item->date_purchase)) }}</td>
										<td data-name="item_code">{{ $item->item_code }}</td>
		                <td data-name="purchase_order_number">{{ $item->purchase_order_number }}</td>
		                <td data-name="item_name">{{ $item->item_name }}</td>
		                <td data-name="subject">{{ $item->subject }}</td>
		                <td data-name="HSN_SAC">{{ $item->HSN_SAC }}</td>
		                <td data-name="company">{{ $item->company }}</td>
										<td data-name="quantity">{{ $item->quantity }}</td>
										<td data-name="price">{{ $item->price }}</td>
										<td data-name="tax">{{ $item->tax }}%</td>
										<td data-name="total">{{ $item->price * $item->quantity + ($item->price * $item->quantity * ($item->tax/100)) }}</td>
		                <td><p data-placement="top" data-toggle="tooltip" title="Pending"><button class="btn btn-danger btn-xs edit-btn pending" data-title="Edit" data-toggle="modal" data-target="#edit" data-id="{{ $item->item_code }}"><span>Pending</span></button></p></td>
		                		        <td><p data-placement="top" data-toggle="tooltip" title="Edit"><a href="{{ asset('inventory/purchase/edit') }}/{{ $item->item_code }}" class="btn btn-primary btn-xs edit-btn" data-title="Edit"><span>Edit</span></a></p></td>
										<td><p data-placement="top" data-toggle="tooltip" title="Recieved"><button class="btn btn-primary btn-xs recieved-btn" id="recieved-btn-{{ $item->item_code }}" data-title="Recieved" data-quantity="{{ $item->quantity }}" data-toggle="modal" data-target="#recieved" data-id="{{ $item->item_code }}"><span>Recieved</span></button></p></td>
										<td><p data-placement="top" data-toggle="tooltip" title="Print"><a href="purchase_order/{{ $item->item_code }}" class="btn btn-primary btn-xs recieved-btn" id="print-btn-{{ $item->item_code }}" data-title="Print" data-target="#print" data-id="{{ $item->item_code }}"><span>Print</span></button></p></td>
		                <td><p data-placement="top" data-toggle="tooltip" title="CancelOrder"><a href="purchase_order/{{ $item->item_code }}/cancel" class="btn btn-primary btn-xs recieved-btn" id="print-btn-{{ $item->item_code }}" data-title="Cancel" data-target="#print" data-id="{{ $item->item_code }}"><span>Cancel</span></button></p></td>
		              </tr>
								@endforeach
	            </tbody>
	          </table>

	          <script type="text/javascript">
	            $(document).ready(function() {
	              $('#mytable').DataTable();
	            });
	          </script>

	          <div class="clearfix"></div>
	        </div>
					<br>
					<a href="{{ URL::to("downloadExcel/purchase/purchase_".date('d-m-Y')."/xlsx/") }}"><button class="btn btn-success">Download Excel xlsx</button></a>

	      </div>
			</div>
	</div>


	    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	      <div class="modal-dialog" style="width: 150% !important">
	        <form class="modal-content" action="{{ route('purchaseInventory') }}" method="post">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	            <h4 class="modal-title custom_align" id="Heading">Purchase new item</h4>
	          </div>
	          <div class="modal-body">
							<div class="form-row">
                <div class="form-group col-md-6">
									<label for="date_purchase">Date</label>
		              <input required class="form-control" id="date_purchase" name="dp" type="date" placeholder="">
                </div>
                <div class="col-md-6">
                  <div class="form-group">
										<label for="ic_purchase">Item code</label>
			              <input required class="form-control" id="ic_purchase" name="ic" type="text" placeholder="">
                  </div>
                </div>
							</div>
	            <div class="form-row">
								<div class="form-group col-md-6">
		              <label for="pon_purchase">Purchase order number</label>
		              <input required class="form-control" id="pon_purchase" name="pon" type="text" placeholder="">
		            </div>
								<div class="form-group col-md-6">
		              <label for="in_purchase">Item Name</label>
		              <input required class="form-control" id="in_purchase" name="in" type="text" placeholder="">
		            </div>
	            </div>
	            <div class="form-row">
								<div class="form-group col-md-6">
		              <label for="st1_purchase">Sub Type 1</label>
		              <input class="form-control" id="st1_purchase" name="st1" type="text" placeholder="">
		            </div>
		            <div class="form-group col-md-6">
		              <label for="st2_purchase">Sub Type 2</label>
		              <input class="form-control" id="st2_purchase" name="st2" type="text" placeholder="">
		            </div>
	            </div>
	            <div class="form-row">
								<div class="form-group col-md-6">
		              <label for="st3_purchase">HSN/SAC</label>
		              <input required class="form-control" id="st3_purchase" name="st3" type="text" placeholder="">
		            </div>
		            <div class="form-group col-md-6">
		              <label for="company_purchase">Company</label>
		              <input required class="form-control" id="company_purchase" name="company" type="text" placeholder="">
		            </div>
	            </div>
	            <div class="form-row">
								<div class="form-group col-md-6">
		              <label for="quantity_purchase">Quantity</label>
		              <input required class="form-control" id="quantity_purchase" name="quantity" type="number" placeholder="">
		            </div>
								<div class="form-group col-md-6">
		              <label for="price">Price</label>
		              <input required class="form-control" id="price" name="price" type="number" placeholder="">
		            </div>
		            <div class="form-group col-md-12">
		              <label for="tax">Tax</label>
		              <input required class="form-control" id="tax" name="tax" type="number" placeholder="">
		            </div>
	            </div>
	          </div>
	          <div class="modal-footer ">
							<input required type="hidden" name="_token" value="{{ Session::token() }}">
	            <button type="submit" name="add_new" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Purchase</button>
	          </div>
	        </form>
	        <!-- /.modal-content -->
	      </div>
	          <!-- /.modal-dialog -->
	    </div>

			<div class="modal fade" id="club" tabindex="-1" role="dialog" aria-labelledby="club" aria-hidden="true">
	      <div class="modal-dialog">
	        <form class="modal-content club-form" action="" method="post">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	            <h4 class="modal-title custom_align" id="Heading">Club bill</h4>
	          </div>
	          <div class="modal-body">
							<div class="form-row">
								<label for="date_purchase">Select the company</label><br>
								<select class="company" name="company" style="width: 100%">
									<option value="">Select</option>
									@foreach($items->unique('company') as $item)
										<option value="{{ $item->company }}">{{ $item->company }}</option>
									@endforeach
								</select>
							</div>
							<table id="club-bill" class="table table-bordred table-striped hide">
								<thead>
								 <tr>
									 <th>Id</th>
									 <th>Date</th>
									 <th>Item Code</th>
									 <th>Item Name</th>
									 <th>Quantity</th>
									 <th>Price</th>
									 <th>Total</th>
								 </tr>
								</thead>
								<tbody>

								</tbody>
							</table>
	          </div>
						<script type="text/javascript">
							$('.company').on('change', function(){
								var company = $(this).val();
								if(company){
									$(document).ready(function() {
										$('#club-bill').DataTable();
									});
								}
								$.ajax({
									url: '../purchase/club-bill/company',
									method: 'GET',
									data: {'company': company},
									dataType: 'json',
									success: function(r){
										$('.input').remove();
										$('#club-bill tbody tr').remove();
										// console.log(r);
										$.each(r, function(key, value){
											$('<tr>', {
												'html': $('<td>', {
													'class': 'id',
													'html': $('<input>', {
														'type': 'checkbox',
														'class': 'input',
														'id': r[key].item_code,
														'data-id': r[key].item_code
													})
												}).add($('<td>', {
													'class': 'date-purchase',
													'html': r[key].date_purchase
												})).add($('<td>', {
													'class': 'item_code',
													'html': r[key].item_code
												})).add($('<td>', {
													'class': 'item_name',
													'html': r[key].item_name
												})).add($('<td>', {
													'class': 'quantity',
													'html': r[key].quantity
												})).add($('<td>', {
													'class': 'price-one',
													'html': r[key].price
												})).add($('<td>', {
													'class': 'total',
													'html': r[key].quantity*r[key].price
												}))
											}).appendTo('#club-bill tbody');
											$('#club-bill').removeClass('hide');
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
	            <span class="glyphicon glyphicon-ok-sign"></span><input type="submit" name="add_new" class="btn btn-warning btn-lg club-btn" disabled style="width: 100%;" value="Club bill">
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
							// alert('hello'+$(this).attr('data-id'));
							ic.push($(this).attr('data-id'));

						}



					})
					ic = JSON.stringify(ic);
					// console.log(ic);
					if(ic){
						var token = '{{ Session::token() }}';
						$.ajax({
							url: '../inventory/purchase_order',
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



	    <div class="modal fade" id="recieved" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	      <div class="modal-dialog">
		    <div class="modal-content">
		          <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove cancel_btn" aria-hidden="true"></span></button>
		        <h4 class="modal-title custom_align" id="Heading">Item recieved</h4>
		      </div>
		          <div class="modal-body">

		           <div class=""><span class="glyphicon glyphicon-warning-sign"></span> Number of items recieved</div>
		           <input type="number" name="number" class="form-control"><br>
		           <div class=""><span class="glyphicon glyphicon-warning-sign"></span> Invoice Number of the order</div>
		           <input type="text" name="invoice" class="form-control">

		      </div>
		        <div class="modal-footer ">

		        <button type="button" class="btn btn-success" id="recieved_btn" ><span class="glyphicon glyphicon-ok-sign"></span>Submit</button>
		        <button type="button" class="btn btn-default cancel_btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
		      </div>
		        </div>
		    <!-- /.modal-content -->
	  	</div>
	      <!-- /.modal-dialog -->
	    </div>
	  </div>

		<script type="text/javascript">
			var token = '{{ Session::token() }}';
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
								console.log(res);

							}
						});
						return false;
					});
				});
			</script>

			<!-- Recieved script -->
			<script type="text/javascript">
				$('.recieved-btn').on('click', function(){
					var data = {};
					$(this).parent().parent().parent().addClass('active');
					$(this).parent().parent().parent().children().each(function(key, value){
						if($(this).attr('data-name')){
							data[""+$(this).attr('data-name')+""] = ""+$(this).html()+"";
						}
					});
					console.log(data);

					var btn = $(this).attr('data-id');
					$('#recieved_btn').on('click', function(){
					    var quantity = $(this).parent().prev().children().next().val();
					    var invoice = $(this).parent().prev().children().next().next().next().next().val();
					   // console.log(invoice);
						$.ajax({
							url: 'purchase/'+btn,
							method: 'post',
							data: {'id': btn, 'data': data, 'quantity': quantity, 'invoice': invoice, '_token': token},
							success: function(res){
								// $('.active').remove();
								// $('.modal-backdrop').removeClass('modal-backdrop');
								// $('#recieved').modal('toggle');
								location.reload();
							}
						});
					});
					$('.cancel_btn, .modal-backdrop').on('click', function(){
						btn = 0;
					});
				});
			</script>

			<!-- <script type="text/javascript">
				$(document).ready(function() {
					$('#club-bill').DataTable();
				});
			</script> -->
			<!-- Recieved script ends -->

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

			<!-- Pending button blinking -->
			<script type="text/javascript">
				setInterval(function(){
					var color = $('.pending').css('background-color');
					if(color == 'rgb(255, 0, 0)'){
						setTimeout(function(){
							$('.pending').css('background-color', 'green');
						}, 200);
					}
					else{
						setTimeout(function(){
							$('.pending').css('background-color', 'red');
						}, 200);
					}
				}, 200)
			</script>
			<!-- Pending button blinking ends -->


	@endsection
