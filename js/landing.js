$(document).ready(function(){


  // Add a listener so that when form is clicked
  // by the user, it focuses.
  $('form').click(function(){
    softFadeOut($('div.title-headings'), function(){
      $('div.title-headings').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
        $('form').css({'transform': 'translateY(-40px) scale(1.2)'});
        $('form').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
          // Fade in the 'already have an account?'
          softFadeIn($('div.newuserbox-container form a'));
        });
      });

    });

  });
});

function softFadeOut($element, callback){
  $element.css('opacity', '0');
  if (callback) callback();
}

function softFadeIn($element, callback){
  $element.css('opacity', '100');
  if (callback) callback();
}
