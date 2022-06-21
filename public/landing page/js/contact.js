$(function () {

    // init the validator
    // validator files are included in the download package
    // otherwise download from http://1000hz.github.io/bootstrap-validator

    $('#contact-form').validator();

    // when the form is submitted
    $('#contact-form, #connect-form').on('submit', function(){
      var that = $(this),
          url = that.attr('action'),
          type = that.attr('method'),
          data = {};

      that.find('[name]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        data[name] = value;
      });

      console.log(url);
      $.ajax({
        url: url,
        type: 'POST',
        // dataType: 'json',
        data: {'data': data, '_token': token},
        success: function(r){
          $( 'form' ).each(function(){
              this.reset();
          });
          alert('Successfully submitted!');
        },
        fail: function(){
          alert('Something went wrong!');
        }
      });
      // remove the popup after setting value of textbox to null
      return false;
    });
    // $('#contact-form').on('submit', function (e) {
    //
    //     // if the validator does not prevent form submit
    //     if (!e.isDefaultPrevented()) {
    //         var url = $(this).attr('action');
    //         alert('here');
    //         // POST values in the background the the script URL
    //         $.ajax({
    //             type: "POST",
    //             url: url,
    //             data: {'data': $(this).serialize(), '_token': token},
    //             success: function (data)
    //             {
    //                 // data = JSON object that contact.php returns
    //
    //                 // we recieve the type of the message: success x danger and apply it to the
    //                 var messageAlert = 'alert-' + data.type;
    //                 var messageText = data.message;
    //
    //                 // let's compose Bootstrap alert box HTML
    //                 var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
    //                 alert(data);
    //                 console.log(data);
    //                 // If we have messageAlert and messageText
    //                 if (messageAlert && messageText) {
    //                     // inject the alert to .messages div in our form
    //                     $('#contact-form').find('.messages').html(alertBox);
    //                     // empty the form
    //                     $('#contact-form')[0].reset();
    //                     alert('here2');
    //                 }
    //             }
    //         });
    //         return false;
    //     }
    // })
});
