$(document).ready(function(){

  // var slider = $('.people-slider');

  //  noUiSlider.create(slider, {
  //   start: [20, 80],
  //   connect: true,
  //   step: 1,
  //   range: {
  //     'min': 0,
  //     'max': 100
  //   },
  //   format: wNumb({
  //     decimals: 0
  //   })
  // });



  $('.people-slider').on('input change', function(){
    // While the slider is being moved, check to see if it is at it's last value.
    // If so, update the text to show '?' to indicate that the user is not sure.
    var amtVal = parseInt($('span.value').text());


    if (amtVal > 19)
      $('p.unknown-notify').text('Unknown size.');
    else
      $('p.unknown-notify').text('');

    // console.log($('span.value').text());

  });

  // Form handling!
  // With JS, should validate form and redirect to dashboard afterwards.
  $('form').submit(function(event){

    event.preventDefault();

    var formData = $(this).serializeArray();

    formData = getFormData(formData);

    formData.noRedirect = true;

    // console.log(formData);

    $.post("../modules/createGroup.php", formData, function(response){

      console.log(response);

      response = JSON.parse(response);

      if (!response.success) return invalidationHandler(response.reason);

      // If the code reaches this point, the request was successful in which case we can
      // let the user know.

      Materialize.toast('Group: "'+formData.name+'" successfully created!', 4000, 'green');

      // First hide the form.
      $('.main-content-wrap').fadeOut(400, function(){
        // This will run once the form has faded out.

        // Show a tick to show that it has been successful.
        // Show the confirmation div.
        $('div.success-container > svg').fadeIn(400, function(){
          // Use some magic CSS to make it move up slightly. 'DAT ANIMATION DOE'
          $(this).css('transform', 'translateY(-20px)');

          $(this).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(e) {
            // Once the transition has ended, show the 'go to dashboard' text.
            $('div.success-container > p').fadeIn();
          });

        });
      });

    });

  });


});

function invalidationHandler(message){

  $('p.error').text(message);

}

// Takes in form data and outputs a nicely formatted JSON object.
function getFormData(data){


  // Check to see if the array as been serialized by jQuery.
  if (!data[0].name) data = data.serializeArray();

  var output = {};

  for (var i = 0; i < data.length; i++){
    output[data[i].name] = data[i].value;
  }

  return output;
}
