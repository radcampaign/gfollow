function gpbutton(id) {
  var url = 'http://radcampaign.com/dev/gfollow/button.php';
  url += '?id=' + id;
  var button = '<iframe width="200" height="46" scrolling="no" frameborder="0" src="' + url + '" />';
  return button;
}
//  
$(document).ready( function() {
  $('div.modal').hide();
  $('div.codewrapper').hide();
  $('#get').click( function() {
    var id = $('#id').attr('value');
    var button = gpbutton(id);
    $('div.button').html(button);
    $('textarea.code').html(button);
    $('div.formwrapper').fadeOut(300);
    $('div.codewrapper').delay(350).fadeIn(300);
    return false;
  });
});

$(document).ready( function() {
$('a.showmodal').click(function() {
  $('div.modal').fadeIn(300);
});
$('a.modalcloselink').click(function() {
  $('div.modal').fadeOut(300);
});
});
