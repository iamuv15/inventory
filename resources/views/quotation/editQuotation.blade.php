@extends('includes.layout')
  @section('title', 'Edit Quotation')

  @section('content')
  
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


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
    
    .note-editor.note-frame{
        width: 99.5% !important;
    }
    
    .show{
        display: block !important;
    }
  </style>

<div class="container" id="add"><br>
  <div class="row">
    <form class="modal-content addQ" action="{{ asset('quotation/add') }}" novalidate method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h4 class="modal-title custom_align" id="Heading">Create new quotation</h4>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="To">To</label>
            <textarea name="to" class="form-control" id="To" placeholder="To" required="required">{!! $items[0]->To !!}</textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="qd">Quotation Date</label>
            <input type="date" name="qd" class="form-control" id="qd" placeholder="Quotation Date" required="required" value="{{ date('Y-m-d', strtotime($items[0]->Quotation_Date)) }}">
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label>Quotation Number</label>
              <input type="text" name="qn" class="form-control" placeholder="Quotation Number" required="required" value="{{ $items[0]->Quotation_Number }}">
            </div>
            <div class="form-group col-md-6">
              <label>Reference Number</label>
              <input type="text" name="rn" class="form-control" placeholder="Reference Number" required="required" value="{{ $items[0]->Ref_no }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label>Quote valid for</label>
              <input type="text" name="qvf" class="form-control" placeholder="Quote valid for" required="required" value="{{ $items[0]->Quote_valid_for }}">
            </div>
            <div class="form-group col-md-6">
              <label>Payment Terms</label>
              <input type="text" name="pt" class="form-control" placeholder="Payment Terms" required="required" value="{{ $items[0]->Payment_terms }}">
            </div>
        </div>
        <?php $i=0 ?>
        @foreach($items as $item)
            <?php $i++ ?>
            <div class="dynamic-element">
              <br>
              <div class="modal-content item">
                <div class="container">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label>Quantity</label>
                      <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" required="required" value="{{ $item->Quantity }}">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="tax">Tax</label>
                      <input type="number" name="tax[]" class="form-control" placeholder="Tax" required="required" value="{{ $item->tax }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="ur">Unit Rate</label>
                      <input type="number" name="ur[]" class="form-control" placeholder="Unit Rate" required="required" value="{{ $item->Unit_Rate }}">
                    </div>
                  </div>
                  <div id="{{ $item->id }}" style="display: none;">{!! $item->Description !!}</div>
                  <div class="form-row">
                        <div class="form-group col-md-12 des">
                          <label for="desc">Description</label>
                          <textarea name="desc[]" class="form-control descrp" id="des{{ $item->Serial_Number }}" placeholder="Description" required="required"></textarea>
                        </div>
                      </div>
                      <script>
                        //   var id = '{{ $item->id }}';
                            var id = '{{ $i }}';    
                            var text = $('#'+'{{ $item->id }}').text();
                            // var text = text.text(text.replace('\n', '')); 
                            // var text = str.replace('\n', '', text);
                        
                        // var id = '{{ $item->Serial_Number }}';
                          $('#des'+id).summernote('code', '{!! $item->Description !!}');
                        //   var r = $('#des'+id).summernote('code', '{!! $item->Description !!}');
                        //   console.log(r);
                        
                      </script>
                  <div class="footer">
                    <button type="button" name="button" class="btn btn-danger delete">Remove item</button>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
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

<script type="text/javascript">
  $('textarea').on('input', function() {
    this.style.height = '';
    this.style.height = this.scrollHeight + 'px';
  });

  $('.modal-content').on('input', '.des', function() {
        console.log('yea');
        var textareaValue = $(this).children().first().next().summernote('code');
        console.log('hello');
        console.log(textareaValue);
        var that = $(this);
        $(that.children().first().next().html(textareaValue));
        $(this).find('.descrp').html(textareaValue);
        var count = 0;
        $(that.children()).each(function(index, value){
            // console.log('1');
            if($(this).attr('class') == 'note-editor note-frame panel panel-default'){
                $(that.children()).each(function(index, value){
                    if($(this).attr('class') == 'note-editor note-frame panel'){
                        // console.log($(this).attr('class'));
                        console.log('okay');
                        $(this).remove();
                    }
                    // else{
                    //     // console.log($(this).attr('class'));
                    //     console.log('else');
                    //     count++;
                    // }
                });
            }
            // if(count > 1){
            //     console.log('removed');
            //     $(this).remove();
            // }
        })
        // if(!$(that.children().first().next().next()).hasClass('panel-default')){
        //     that.children().first().next().next().remove();
        // }
    });
</script>
<script type="text/javascript">
    var i = '{{ $items->last()->Serial_Number }}';
  $('#plus').on('click', function(){
      i++;
    //Clone the hidden element and shows it
    $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
    $('.dynamic-element').last().find(':input').val('');
    $('.dynamic-element').last().find('.note-editor.note-frame.panel').remove();
    $('.dynamic-element').last().find('textarea').attr("id",'des'+i).attr('id');
    $('#des'+i).parent().addClass('show');
    
    $('#des'+i).summernote({
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
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>-->

@endsection
