@extends('includes.layout')
  @section('title', 'Quotation')

  @section('content')

  <style media="screen">
    .item{
      padding: 10px;
      border-color: #808080;
    }

    .plus{
      margin-left: 16px;
      padding-bottom: 8px;
    }

    .delete{
      color:white;
      background-color:rgb(231, 76, 60);
      text-align:center;
      margin-top:6px;
      font-weight:700;
      border-radius:5px;
      min-width:20px;
      cursor:pointer;
    }
  </style>

<div class="container" id="add"><br>
  <div class="row">
    <form class="modal-content addQ" action="{{ asset('invoice/add') }}" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h4 class="modal-title custom_align" id="Heading">Create Proforma Invoice</h4>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Proforma Invoice</label>
            <input type="text" name="pi" class="form-control" placeholder="Proforma Invoice" required="required">
          </div>
          <div class="form-group col-md-6">
            <label>Date</label>
            <input type="date" name="date" class="form-control" placeholder="Date" required="required">
          </div>
        </div>  
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="desc">Indenter</label>
            <textarea name="ind" class="form-control" placeholder="Indenter" required="required"></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="desc">Consignee</label>
            <textarea name="cons" class="form-control" placeholder="Consignee" required="required"></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <b>Billing Details</b><br>
            <label>Reference ID</label>
            <input type="text" name="rn" class="form-control" placeholder="Reference Number" required="required">
            <label>Reference Date</label>
            <input type="date" name="rd" class="form-control" placeholder="Reference Date" required="required">
            <label>Bills to</label>
            <input type="text" name="bt" class="form-control" placeholder="Bills to" required="required">
            <label>Bill in name</label>
            <input type="text" name="bn" class="form-control" placeholder="Bill in Name" required="required">
            <label>Payment Terms</label>
            <input type="text" name="pt" class="form-control" placeholder="Payment terms" required="required">
          </div>
          <div class="form-group col-md-6">
            <b>Dispatch Details</b><br>
            <label>Delivery to</label>
            <input type="text" name="dt" class="form-control" placeholder="Delivery to" required="required">
            <label>Delivery Period</label>
            <input type="text" name="dp" class="form-control" placeholder="Delivery Period" required="required">
            <label>Road Permit</label>
            <input type="text" name="rp" class="form-control" placeholder="Road Permit" required="required">
            <label>Freight Charges</label>
            <input type="text" name="fc" class="form-control" placeholder="Freight Charges" required="required">
            <label>Mode of Transport</label>
            <input type="text" name="mt" class="form-control" placeholder="Mode of Transport" required="required">
          </div>
        </div>
        <div class="dynamic-element">
          <br>
          <div class="modal-content item">
            <div class="container">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="quantity">Quantity</label>
                  <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" required="required">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tax">Tax</label>
                  <input type="number" name="tax[]" class="form-control" placeholder="Tax" required="required">
                </div>
                <div class="form-group col-md-6">
                  <label for="ur">Unit Rate</label>
                  <input type="number" name="ur[]" class="form-control" placeholder="Unit Rate" required="required">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="desc">Description</label>
                  <textarea name="desc[]" class="form-control" id="1" placeholder="Description" required="required"></textarea>
                </div>
              </div>
              <div class="footer">
                <button type="button" name="button" class="btn btn-danger delete">Remove item</button>
              </div>
            </div>
          </div>
        </div>
        <div class="dynamic-stuff">

        </div>
      </div>

      <div class="plus">
        <button type="button" name="button" class="btn btn-primary" id="plus">Add new item</button>
      </div>
      <div class="modal-footer ">
        <input required type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" name="add_new" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-check"></span>Create</button>
      </div>
    </form>
  </div>
      <!-- /.modal-dialog -->
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

<script type="text/javascript">
  $('textarea').on('input', function() {
    this.style.height = '';
    this.style.height = this.scrollHeight + 'px';
  });
  $(document).ready(function() {
    $('#1').summernote({
        height: 200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    });
  });
  
  $('.container').on('input', '.desc textarea', function() {
        console.log('hello');
        var textareaValue = $('.desc').summernote('code');
        // console.log(textareaValue);
        $(this).html(textareaValue);
    });
  $(document).ready(function() {
    $('#summernote').summernote({
        toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline']],
              ['Paragraph style', ['style']],
              ['misc', ['fullscreen']]
            ],
            height: 200,
            placeholder: 'Write something here!'
    });
  });
</script>
<script type="text/javascript">
    var i = 1;
  $('#plus').on('click', function(){
      i++;
    //Clone the hidden element and shows it
    $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
    $('.dynamic-element').last().find(':input').val('');
    $('.dynamic-element').last().find('.note-editor.note-frame.panel').remove();
    $('.dynamic-element').last().find('textarea').attr("id",i).attr('id');
    
    $('#'+i).summernote({
        height: 200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    });
    
    attach_delete();
  });


    //Attach functionality to delete buttons
    function attach_delete(){
      $('.delete').off();
      $('.delete').click(function(){
        console.log("click");
        $(this).parent().parent().parent().remove();
      });
    }
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>-->

@endsection
