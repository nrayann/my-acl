var url = window.location.href;
url = url.split('permissions');
url = url[0];

$('.grantOrDeny').on('click', function () {
  var that = $(this),
      aro_id = $(this).attr('data-aro'),
      aco_id = $(this).attr('data-aco');

  $.ajax(
  {
    url: url + "permissions/grantOrDeny",
    dataType: 'JSON',
    type: 'POST',
    data: {
      aro_id: aro_id,
      aco_id: aco_id
    },
    success: function(data,text,xhr)
    {
      if(data.status === false){alert("Erro!");}
      else {
        if (that.hasClass('label-success')) {
          that.removeClass('label-success');
          that.addClass('label-danger');
          that.text('Denied');
        } else if (that.hasClass('label-info')) {
          that.removeClass('label-info');
          that.addClass('label-success');
          that.text('Allowed');
        } else if (that.hasClass('label-danger')) {
          that.removeClass('label-danger');
          that.addClass('label-success');
          that.text('Allowed');
        };
      }
    },
    error: function()
    {
      alert("Error!");
    }
  });
});


$('.showOrHide').on('click', function () {
  var that = $(this),
      aco_id = $(this).attr('data-aco');

  $.ajax(
  {
    url: url + "permissions/config",
    dataType: 'JSON',
    type: 'POST',
    data: {
      aco_id: aco_id
    },
    success: function(data,text,xhr)
    {
      if(data.status === false){alert("Erro!");}
      else {
        if (that.hasClass('reload')) {
          location.reload();
        } else {
          if (that.hasClass('label-success')) {
            that.removeClass('label-success');
            that.addClass('label-danger');
            that.text('Invisible');
          } else{
            that.removeClass('label-danger');
            that.addClass('label-success');
            that.text('Visible');
          };
        }
      }
    },
    error: function()
    {
      alert("Error!");
    }
  });
});
