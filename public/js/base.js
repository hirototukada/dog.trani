
$('.dropdown').mouseenter(function(){
  if(!$('.navbar-toggle').is(':visible')) {
    if(!$(this).hasClass('open')) {
      $('.dropdown-toggle', this).trigger('click');
    }
  }
});