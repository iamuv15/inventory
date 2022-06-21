// $('form').on('submit', function(){
//   var that = $(this),
//       url = that.attr('action'),
//       type = that.attr('method'),
//       data = {};
//
//   that.find('[name]').each(function(index, value){
//     var that = $(this),
//         name = that.attr('name'),
//         value = that.val();
//     data[name] = value;
//   });
//   // console.log(url);
//   $.ajax({
//     url: url,
//     type: 'POST',
//     // dataType: 'json',
//     data: {'data': data, '_token': token},
//     success: function(res){
//       console.log(res);
//     },
//     onfail: function(){
//       console.log('error');
//     }
//   });
//   // remove the popup after setting value of textbox to null
//   return false;
// });
//
// $('.submit').on('click', function(){
//   var that = $(this),
//       url = that.attr('action'),
//       type = that.attr('method'),
//       data = {};
//
//   that.find('[name]').each(function(index, value){
//     var that = $(this),
//         name = that.attr('name'),
//         value = that.val();
//     data[name] = value;
//   });
//   var formData = new FormData($(this)[0]);
//   $.ajax({
//     url: '../uploadfile',
//     method: 'post',
//     data: {'data': formData, '_token': token},
//     success: function(r){
//       console.log(r);
//     }
//   });
// });
//
// // $('#inputCity').on('keyup', function(){
// //   var q = $(this).val();
// //   $.ajax({
// //     url: '../search/city',
// //     method: 'get',
// //     data: {'q': q},
// //     dataType: 'json',
// //     success: function(res){
// //       console.log(res);
// //     }
// //   });
// // })
//
// $('.file-upload-input').on('change', function(input) {
//   if (input.files && input.files[0]) {
//     alert('yo');
//     var reader = new FileReader();
//
//     reader.onload = function(e) {
//       $(this).parent().hide();
//
//       $(this).parent().next().children().first().attr('src', e.target.result);
//       $(this).parent().next().show();
//
//       $(this).parent().next().children().next().children().children().html(input.files[0].name);
//     };
//
//     reader.readAsDataURL(input.files[0]);
//
//   }
//   // else {
//   //   removeUpload();
//   // }
// });

// $('.file-upload-input').on('change', function(input){
//   if (input.files && input.files[0]) {
//
//     alert('input');
//
//     var reader = new FileReader();
//
//     reader.onload = function(e) {
//       $(this).parent().hide();
//
//       $(this).parent().next().children().first().attr('src', e.target.result);
//       $(this).parent().next().show();
//
//       $(this).parent().next().children().next().children().children().html(input.files[0].name);
//     };
//
//     reader.readAsDataURL(input.files[0]);
//
//   } else {
//     $('.remove-image').on('click', function(){
//       $(this).parent().parent().parent().children().children().first().replaceWith($('.file-upload-input').clone());
//       $(this).parent().parent().parent().children().next().hide();
//       $(this).parent().parent().parent().children().first().show();
//     });
//     $(this).parent().parent().parent().children().first().bind('dragover', function () {
//     		$(this).parent().parent().parent().children().first().addClass('image-dropping');
//     	});
//     	$(this).parent().parent().parent().children().first().bind('dragleave', function () {
//     		$(this).parent().parent().parent().children().first().removeClass('image-dropping');
//     });
//   }
// });

// function removeUpload() {
//   $('.file-upload-input').replaceWith($('.file-upload-input').clone());
//   $('.file-upload-content').hide();
//   $('.image-upload-wrap').show();
// }

function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#file1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#file2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#file3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#file4').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp1").change(function(){
    readURL1(this);
});

$("#imgInp2").change(function(){
    readURL2(this);
});

$("#imgInp3").change(function(){
    readURL3(this);
});

$("#imgInp4").change(function(){
    readURL4(this);
});

$('.remove-image').on('click', function(){
  $(this).parent().parent().parent().children().children().first().replaceWith($('.file-upload-input').clone());
  $(this).parent().parent().parent().children().next().hide();
  $(this).parent().parent().parent().children().first().show();
});
$(this).parent().parent().parent().children().first().bind('dragover', function () {
		$(this).parent().parent().parent().children().first().addClass('image-dropping');
	});
	$(this).parent().parent().parent().children().first().bind('dragleave', function () {
		$(this).parent().parent().parent().children().first().removeClass('image-dropping');
});

$(document).ready(function(){
  $('.one, .two').hide();
})

$('#inputDoc1').on('change', function(){
  var val = $(this).val();
  if((val == 'Aadhaar') || (val == 'Driving Licence')){
    $('.doc1 .two, .doc1 .one').show();
    $('.doc1 .one h3').html('Add Front Side of '+ val);
    $('.doc1 .two h3').html('Add Back Side of '+ val);
  }
  else{
    $('.doc1 .one').show();
    $('.doc1 .one h3').html('Add Front Side of '+ val);
    $('.doc1 .two').hide();
  }
  $.each($('#inputDoc2 option'), function(key, value){
    if($(this).html() == val){
      $('#inputDoc2 option').show();
      $(this).hide();
    }
  })
})

$('#inputDoc2').on('change', function(){
  var val = $(this).val();
  if((val == 'Aadhaar') || (val == 'Driving Licence')){
    $('.doc2 .two, .doc2 .one').show();
    $('.doc2 .one h3').html('Add Front Side of '+ val);
    $('.doc2 .two h3').html('Add Back Side of '+ val);
  }
  else{
    $('.doc2 .one').show();
    $('.doc2 .one h3').html('Add Front Side of '+ val);
    $('.doc2 .two').hide();
  }
  $.each($('#inputDoc1 option'), function(key, value){
    if($(this).html() == val){
      $('#inputDoc1 option').show();
      $(this).hide();
    }
  })
})

$('.upload input').on('change', function(){
  $(this).next().show();
})

// $('form.privileges').on('submit', function(){
//   $('.custom-checkbox input').each(function(key, value){
//     if($(this).prop('checked')){
//       console.log(key);
//       console.log(value);
//     }
//   });
//   return false;
// });
