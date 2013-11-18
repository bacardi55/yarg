$(document).ready(function() {
  if ($('#yargAddModal').length) {
    $('[data-toggle="modal"]').on('click', function (a,b,c) {
      if ($(this).attr('data-title')) {
        $('#yargAddModal .modal-header h3').html($(this).attr('data-title'));
      }
    });

    $('#yargAddModal button.save').on('click', function() {
      $('#yargAddModal').find('form').submit();
    });

    $('#yargAddModal').on('hidden', function() {
      $(this).data('modal', null);
    });

    $('#yargAddModal').on('shown', function(a,b,c) {
        $("#yargAddModal :input:text").first().focus();
    });
  }

  if ($('#Cv_title').length) {
    $('#Cv_title').tooltip({
      placement: 'right',
      title: translations.title,
      trigger: 'hover focus',
    });
  }

  if ($('#Cv_description').length) {
    $('#Cv_description').tooltip({
      placement: 'right',
      title: translations.description,
      trigger: 'hover focus',
    });
  }

  if ($('#Cv_catch').length) {
    $('#Cv_catch').tooltip({
      placement: 'right',
      title: translations.catch,
      trigger: 'hover focus',
    });
  }
});
