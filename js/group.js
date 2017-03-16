$(document).ready(function(){

  var clipboard = new Clipboard('p.joinToken');

  // Copy the token / joinlink on click.
  $('p.joinToken').click(function(){
    // Copy to clipboard and toast to notify of copy.
    Materialize.toast('Copied!', 4000) // 4000 is the duration of the toast
  });

});
