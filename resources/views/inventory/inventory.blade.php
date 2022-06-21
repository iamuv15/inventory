@extends('includes.layout')
  @section('title', 'Inventory')

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
          <li class="breadcrumb-item active">Inventory</li>
        </ol>

        @if(Session::has('message'))
          <div class="alert alert-danger">
            {{ Session::get( 'message' ) }}
          </div>
        @endif

				<!-- <p id="flash" style="color: red; font-size: 18px">Refresh the page after edit or delete to see the changes. AJAX will be applied soon and you won't have to refresh again!</p> -->
        <div class="table-responsive">
          <button type="button" name="add_new" class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#add">Add New item</button><br><br>
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
             <tr>
               <th>Item Code</th>
               <th>Item Name</th>
               <th>Sub Type 1</th>
               <th>Sub Type 2</th>
               <th>HSN/SAC</th>
               <th>Company</th>
               <th>Quantity</th>
               <th>Edit</th>
               <th>Delete</th>
             </tr>
            </thead>
            <tbody>
							@foreach($items as $item)
	              <tr>
	                <td>{{ $item->item_code }}</td>
	                <td>{{ $item->item_name }}</td>
	                <td>{{ $item->sub_type_1 }}</td>
	                <td>{{ $item->sub_type_2 }}</td>
	                <td>{{ $item->HSN_SAC }}</td>
	                <td>{{ $item->company }}</td>
	                <td>{{ $item->quantity }}</td>
	                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs edit-btn" data-title="Edit" data-toggle="modal" data-target="#edit" data-id="{{ $item->item_code }}"><span class="fa fa-edit"></span></button></p></td>
	                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs delete-btn" id="delete-btn-{{ $item->item_code }}" data-title="Delete" data-toggle="modal" data-target="#delete" data-id="{{ $item->item_code }}"><span class="fa fa-trash"></span></button></p></td>
	              </tr>
							@endforeach
            </tbody>
          </table>

					<a type="button" href="inventory/purchase" class="btn btn-primary" name="button">Purchase Item</a>
					<a type="button" href="inventory/sale" class="btn btn-primary" name="button">Sell Item</a>
          <a href="{{ URL::to("downloadExcel/inventory/inventory_".date('d-m-Y')."/xlsx/") }}"><button class="btn btn-success">Download Excel xlsx</button></a>

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


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
        <form class="modal-content" id="edit_btn" method="post" action="inventory/edit">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="ic">Item code</label>
              <input required class="form-control ajax-edit" id="ic" name="ic_edit" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="in">Item Name</label>
              <input required class="form-control ajax-edit" id="in" name="in_edit" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="st1">Sub Type 1</label>
              <input class="form-control ajax-edit" id="st1" name="st1_edit" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="st2">Sub Type 2</label>
              <input class="form-control ajax-edit" id="st2" name="st2_edit" type="text" placeholder="">
            </div><div class="form-group">
              <label for="st3">HSN/SAC</label>
              <input class="form-control ajax-edit" id="st3" name="st3_edit" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="company">Company</label>
              <input required class="form-control ajax-edit" id="company" name="company_edit" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="Quantity ajax-edit">Quantity</label>
              <input required class="form-control" id="Quantity" type="text" name="quantity_edit" placeholder="">
            </div>
          </div>
          <div class="modal-footer ">
            <input required type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" class="btn btn-warning btn-lg" id="edit_button" style="width: 100%;"><span class="fa fa-check pull-left"></span> Update</button>
          </div>
        </form>
    <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
        <form class="modal-content" action="{{ route('inventoryAdd') }}" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class=" pull left" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Add new item in inventory</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="ic_add">Item code</label>
              <input required class="form-control" id="ic_add" name="ic" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="in_add">Item Name</label>
              <input required class="form-control" id="in_add" name="in" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="st1_add">Sub Type 1</label>
              <input class="form-control" id="st1_add" name="st1" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="st2_add">Sub Type 2</label>
              <input class="form-control" id="st2_add" name="st2" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="st3_add">HSN/SAC</label>
              <input class="form-control" id="st3_add" name="st3" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="company_add">Company</label>
              <input required class="form-control" id="company_add" name="company" type="text" placeholder="">
            </div>
            <div class="form-group">
              <label for="quantity_add">Quantity</label>
              <input required class="form-control" id="quantity_add" name="quantity" type="text" placeholder="">
            </div>
          </div>
          <div class="modal-footer ">
						<input required type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" name="add_new" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-check"></span>Add</button>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
          <!-- /.modal-dialog -->
    </div>



    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class=" pull-left" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">

       <div class="alert alert-danger"><span class="fa fa-warning-sign"></span> Are you sure you want to delete this Record?</div>

      </div>
        <div class="modal-footer ">

        <button type="button" class="btn btn-success" id="delete_btn" ><span class="fa fa-check"></span> Yes</button>
        <button type="button" class="btn btn-default" id="cancel_btn" data-dismiss="modal"><span class=""></span> No</button>
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
