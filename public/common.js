$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('form.FromSubmit').submit(function (event) {

    event.preventDefault();
    var formId = $(this).attr('id');
    // if ($('#'+formId).valid()) {
        
        var formAction = $(this).attr('action');
        var buttonText = $('#'+formId+' button[type="submit"]').text();
        var $btn = $('#'+formId+' button[type="submit"]').attr('disabled','disabled').html("Loading...");
        // var redirectURL = $(this).data("redirect_url");
        $.ajax({
            type: "POST",
            url: formAction,
            data: new FormData(this),
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.status == true && response.msg !="") {
                   $('#'+formId+' button[type="submit"]').text(buttonText);
                    $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
                    window.location=response.url;
                }
            },
            error: function (jqXhr) {
                var errors = $.parseJSON(jqXhr.responseText);
                    showErrorMessages(formId, errors);
                 $('#'+formId+' button[type="submit"]').text(buttonText);
                    $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
            }
        });
        return false;
    // };
});
  function showErrorMessages(formId, errorResponse) {
      var msgs = "";
      $.each(errorResponse.errors, function(key, value) {
          msgs += value + " <br>";
      });
      flashMessage('danger', msgs);
  }
  function flashMessage($type, message) {
     $.notify(message, {
          type: $type,
          allow_dismiss: false,
          delay: 2000,
          showProgressbar: false,
          timer: 300
      });
  }
  $(document).on("click", ".delete_record", function(){
    var op=$(this);
    swal({
      title: "Are you sure want to delete this record ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var formAction = $(this).data("route");
        $.ajax({
            type: "DELETE",
            url: formAction,
            success: function (response) {
                if(response.success == 1){
                  if (response.type=='panel_activity') {
                      op.parent('div').parent('div').fadeOut('slow');
                   }
                    swal(response.msg, {
                    icon: "success",
                    });
                   op.closest('tr').remove();
                   
                 
                }else{
                    flashMessage('danger', response.msg);
                    swal(response.msg, {
                    icon: "warning",
                    });
                }
            },
            error: function (jqXhr) {
          }
        });
        
      } 
    });
});

 $(document).on("click", ".set_main", function(){
    var op=$(this);
    swal({
      title: "Are you sure want to set as main",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var formAction = $(this).data("route");
        $.ajax({
            type: "DELETE",
            url: formAction,
            success: function (response) {
                if(response.success == 1){
                  if (response.type=='panel_activity') {
                      op.parent('div').parent('div').fadeOut('slow');
                   }
                    swal(response.msg, {
                    icon: "success",
                    });
                   $('.table').DataTable().draw(false);
                   
                 
                }else{
                    flashMessage('danger', response.msg);
                    swal(response.msg, {
                    icon: "warning",
                    });
                }
            },
            error: function (jqXhr) {
          }
        });
        
      } 
    });
});

function deleteAll(className,url){
    var id = [];
    var checked = $("." + className + ":checked").length;
        if (checked > 0)
        {
          $("." + className + ":checked").each(function(){
               if($(this).val()!=1){
                    id.push($(this).val());
                 }
          });
          swal({
                  title: "do you really want to delete the record?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {

                  var formAction = url;
                  $.ajax({
                      type: "DELETE",
                      url: formAction,
                      data:{checkbox:id},
                      success: function (response) {
                        if(response.success == 1){
                          $('.table').DataTable().draw(false);
                        }else{
                            flashMessage('danger', response.msg);
                        }
                      },
                      error: function (jqXhr) {
                    }
                });
              }
          });
        }
        else
        {
            swal("Select at list one record.");
        }
}

function statusAll(formName,url){
     var id = [];
    var checked = $("#" + formName + "input:checked").length;
        if (checked > 0)
        {
          $("#" + formName + " input:checked").each(function(){
              if($(this).val()!=1){
                  id.push($(this).val());
              }
          });
          swal({
                title: "Are you sure want to change status?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    var formAction = url;
                    $.ajax({
                        type: "DELETE",
                        url: formAction,
                        data:{checkbox:id},
                        success: function (response) {
                            if(response.success == 1){
                                $('.table').DataTable().draw(false);
                            }else{
                                flashMessage('danger', response.msg);
                            }
                        },
                        error: function (jqXhr) {
                      }
                    });
                  swal("Success! status has been successfully changed!", {
                  icon: "success",
                });
              }
          });
        }
        else
        {
            swal("Select at list one record.");
        }
}



