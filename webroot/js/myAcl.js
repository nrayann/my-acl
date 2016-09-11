$('.grantOrDeny').on('click', function () {
  var that = $(this),
      aro_id = $(this).attr('data-aro'),
      aco_id = $(this).attr('data-aco');
  $.ajax(
  {
    url: base_url + "my-acl/permissions/grantOrDeny",
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
          that.text('Negado');
        } else if (that.hasClass('label-info')) {
          that.removeClass('label-info');
          that.addClass('label-success');
          that.text('Permitido');
        } else if (that.hasClass('label-danger')) {
          that.removeClass('label-danger');
          that.addClass('label-success');
          that.text('Permitido');
        };
      }
    },
    error: function()
    {
      alert("Erro!");
    }
  });
});


$('.showOrHide').on('click', function () {
  var that = $(this),
      aco_id = $(this).attr('data-aco');

  $.ajax(
  {
    url: base_url + "my-acl/permissions/config",
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
            that.text('Invisível');
          } else{
            that.removeClass('label-danger');
            that.addClass('label-success');
            that.text('Visível');
          };
        }
      }
    },
    error: function()
    {
      alert("Erro!");
    }
  });
});
