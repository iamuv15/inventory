@extends('includes.layout')
@section('title', 'Inventory | Sale')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>


<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->


<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!-- <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->

<div class="container">
	<div class="row">


        <div class="col-md-12">
					<br>
				<ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ asset('inventory') }}">Inventory</a>
            </li>
            <li class="breadcrumb-item active">Sell Orders</li>
          </ol>

					@if(Session::has('message'))
						<div class="alert alert-danger">
							{{ Session::get( 'message' ) }}
						</div>
					@endif

        <div class="table-responsive">
          <button type="button" name="add_new" class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#add">Sell item</button><br><br>
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
             <tr>
							 <th>Date</th>
               <th>Item Code</th>
               <th>PI Number</th>
               <th>Customer</th>
							 <th>Quantity</th>
							 <th>Price</th>
							 <th>Tax</th>
               <th>Total</th>
							 <th></th>
							 <th></th>
             </tr>
            </thead>
            <tbody>
							@foreach($items as $item)
	              <tr>
									<td data-name="date_sale">{{ date('d-m-Y', strtotime($item->date_sale)) }}</td>
									<td data-name="item_code">{{ $item->item_code }}</td>
	                <td data-name="pi_number">{{ $item->pi_number }}</td>
									<td data-name="customer">{{ $item->customer }}</td>
									<td data-name="quantity">{{ $item->quantity }}</td>
									<td data-name="price">{{ $item->price }}</td>
									<td data-name="tax">{{ $item->tax }}%</td>
									<td data-name="total">{{ ($item->price + ($item->price * $item->tax/100)) * $item->quantity }}</td>
									<td><p data-placement="top" data-toggle="tooltip" title="Print"><a href="performa-invoice/{{ $item->id }}" class="btn btn-primary btn-xs recieved-btn" id="print-btn-{{ $item->item_code }}" data-title="Print" data-target="#print" data-id="{{ $item->item_code }}"><span>Print</span></button></p></td>
									<td><p data-placement="top" data-toggle="tooltip" title="Cancel Order"><a href="sale_order/{{ $item->id }}/cancel" class="btn btn-primary btn-xs recieved-btn" id="print-btn-{{ $item->item_code }}" data-title="Cancel" data-target="#print" data-id="{{ $item->item_code }}"><span>Cancel order</span></button></p></td>
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
				<a href="{{ URL::to("downloadExcel/sale/sale_".date('d-m-Y')."/xlsx/") }}"><button class="btn btn-success">Download Excel xlsx</button></a>

      </div>
	</div>
</div>


    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
        <form class="modal-content" action="{{ route('saleInventory') }}" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Sell item</h4>
          </div>
          <div class="modal-body">
						<div class="form-group">
              <label for="date_purchase">Date</label>
              <input required class="form-control" id="date_purchase" name="dp" type="date" placeholder="">
            </div>
            <div class="form-group">
              <label for="ic_purchase">Item code</label>
              <input required class="form-control" id="ic_purchase" name="ic" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="pon_purchase">PI number</label>
              <input required class="form-control" id="pon_purchase" name="pon" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="company_purchase">Customer</label>
              <input required class="form-control" id="company_purchase" name="company" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="quantity_purchase">Quantity</label>
              <input required class="form-control" id="quantity_purchase" name="quantity" type="number" placeholder="">
            </div>
						<div class="form-group">
              <label for="price">Price of one item</label>
              <input required class="form-control" id="price" name="price" type="number" placeholder="">
            </div>
            <div class="form-group">
              <label for="tax">Tax</label>
              <input required class="form-control" id="tax" name="tax" type="number" placeholder="">
            </div>
          </div>
          <div class="modal-footer ">
						<input required type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" name="add_new" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Sell</button>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
          <!-- /.modal-dialog -->
    </div>



    <div class="modal fade" id="recieved" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
	    <div class="modal-content">
	          <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove cancel_btn" aria-hidden="true"></span></button>
	        <h4 class="modal-title custom_align" id="Heading">Item recieved</h4>
	      </div>
	          <div class="modal-body">

	       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you have recieved this item?</div>

	      </div>
	        <div class="modal-footer ">

	        <button type="button" class="btn btn-success" id="recieved_btn" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
	        <button type="button" class="btn btn-default cancel_btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
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
							$('#st3').val(res[0].sub_type_3);
							$('#company').val(res[0].company);
							$('#Quantity').val(res[0].quantity);
							$('#tax').val(res[0].tax);
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
					$.ajax({
						url: 'purchase/'+btn,
						method: 'post',
						data: {'id': btn, 'data': data, '_token': token},
						success: function(res){
							alert(res);
							$('.active').remove();
						}
					});
				});
				$('.cancel_btn').on('click', function(){
					btn = 0;
				});
			});
		</script>
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
