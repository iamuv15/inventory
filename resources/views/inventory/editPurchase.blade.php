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

        <div class="container" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
          <div class="modal-dialog" style="width: 150% !important">
            <form class="modal-content" action="{{ route('editPurchaseInventory', ['id' => $item->id]) }}" method="post">
              <div class="modal-header">
                <h4 class="modal-title custom_align" id="Heading">Purchase new item</h4>
              </div>
              <div class="modal-body">
        					<div class="form-row">
                <div class="form-group col-md-6">
        							<label for="date_purchase">Date</label>
                      <input required class="form-control" id="date_purchase" name="dp" type="date" placeholder="" value="{{ date('Y-m-d', strtotime($item->date_purchase)) }}">
                </div>
                <div class="col-md-6">
                  <div class="form-group">
        								<label for="ic_purchase">Item code</label>
        	              <input required class="form-control" id="ic_purchase" name="ic" type="text" placeholder="" value="{{ $item->item_code }}">
                  </div>
                </div>
        					</div>
                <div class="form-row">
        						<div class="form-group col-md-6">
                      <label for="pon_purchase">Purchase order number</label>
                      <input required class="form-control" id="pon_purchase" name="pon" type="text" placeholder="" value="{{ $item->purchase_order_number }}">
                    </div>
        						<div class="form-group col-md-6">
                      <label for="in_purchase">Item Name</label>
                      <input required class="form-control" id="in_purchase" name="in" type="text" placeholder="" value="{{ $item->item_name }}">
                    </div>
                </div>
                <div class="form-row">
        						<div class="form-group col-md-6">
                      <label for="st1_purchase">Subject</label>
                      <input class="form-control" id="st1_purchase" name="sub" type="text" placeholder="" value="{{ $item->subject }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="st3_purchase">HSN/SAC</label>
                      <input required class="form-control" id="st3_purchase" name="st3" type="text" placeholder="" value="{{ $item->HSN_SAC }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="company_purchase">Company</label>
                      <input required class="form-control" id="company_purchase" name="company" type="text" placeholder="" value="{{ $item->company }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="quantity_purchase">Quantity</label>
                      <input required class="form-control" id="quantity_purchase" name="quantity" type="number" placeholder="" value="{{ $item->quantity }}">
                    </div>
                </div>
                <div class="form-row">
        						
        						<div class="form-group col-md-6">
                      <label for="price">Price</label>
                      <input required class="form-control" id="price" name="price" type="number" placeholder="" value="{{ $item->price }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="tax">Tax</label>
                      <input required class="form-control" id="tax" name="tax" type="number" placeholder="" value="{{ $item->tax }}">
                    </div>
                </div>
              </div>
              <div class="modal-footer ">
        					<input required type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" name="add_new" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Edit Purchase</button>
              </div>
            </form>
            <!-- /.modal-content -->
          </div>
              <!-- /.modal-dialog -->
        </div>
    @endsection    