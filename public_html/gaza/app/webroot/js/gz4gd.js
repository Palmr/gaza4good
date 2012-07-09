$(document).ready( function() {
  $('.dropdown-toggle').dropdown();
});    

$('html').off('click.dropdown.data-api');
$('html').on('click.dropdown.data-api', function(e) {
  if(!$(e.target).parents().is('.dropdown-menu form')) {
    $('.dropdown').removeClass('open');
  }
});

function submitExistingResponse(anchor,type,inResponseTo) {
  submitResponse(anchor.text, anchor.title,type, inResponseTo);
}

function submitResponse(title,details,type,inResponseTo) {

  //Validate
  if(title == '') {
    $('#response-form').addClass('error');
    return false;
  } else {
    $('#response-form').removeClass('error');
  }

  if(details == null) details = '';

  var li = '<li class="message">'
           +'  <img src="https://api.twitter.com/1/users/profile_image?screen_name=palmer&amp;size=bigger" alt="" />'
           +'  <div class="message-text">'
           +'    <h3><a href="https://twitter.com/palmer">@palmer</a></span> '+((type=="Request") ? ' has ' : ' needs ')+' "'+title+'"</h3>'
           +'    <p>'+details.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")+'</p>'
           +'  </div>'
           +'  <div class="clear"></div>'
           +'</li> ';
  $('.responses').append(li);

  //TODO XHR post
  /*
  var xhr = $.ajax(
    {
      url: '/'+type+'s/createFromAjax/'+inResponseTo,
      data: 'data[Requests][user_id]='+1,
      method: 'POST'
    }
  ).done(function( msg ) {
    alert( "Data Saved: " + msg );
  });*/

  //Show in list
  $('.responses li:last-child').hide().slideDown(300);
  $('.dropdown').removeClass('open');

  //Update response count
  var responseCount = parseInt($('#response-count').text()) + 1;
  $('#response-count').text(responseCount)

  //Hide button
  $('#submit-response-button').fadeOut(250);
}