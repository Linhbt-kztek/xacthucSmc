$(function() {
  $(document).on('click', '#close-popup-btn, #close-popup', function() {
    $('#bg-popup').fadeOut('normal');
        $('#block-add-product').fadeOut('normal');
  });
});
function copyProduct(id) {
  $('#block-popup-title').text('Thêm sản phẩm');
  $.ajax({
    type: 'GET',
    url: $('#copyUrl').val() + '/'+id,
    dataType: 'json',
    success: function(resp) {
      if (resp.msg != undefined) {
        jAlert(resp.msg, 'Thông báo');
        return false;
      } else {
    		$('#block-add-product .popup-body').html(resp.html);
        $('#block-add-product .popup-body').css({'max-height': $('#main-content').css('min-height'),'overflow-y': 'auto'});
        if ($('#company_id option').length > 0) {
          $('#company_id option[value="'+resp.product.company_id+'"]').prop('selected', true);
        } else {
          $('#company_id').val(resp.product.company_id);
        }
        $('#name').val(resp.product.name);
        $('#code').val(resp.product.code);
        $('#date_output').val(resp.product.date_output);
        if ($('#protected_time option').length > 0) {
          $('#protected_time option[value="'+resp.product.protected_time+'"]').prop('selected', true);
        } else {
          $('#protected_time').val(resp.product.protected_time);
        }
        $('#introimage_copy').val(resp.product.introimage);
        $('#blah').attr('src',resp.introimage);
        $('#description').summernote('code', resp.product.description);
        $('#bg-popup').fadeIn();
        $('#block-add-product').fadeIn();
      }
    }
  });
}