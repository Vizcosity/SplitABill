$(document).ready(function(){

  // Initialize the modal for use later.
  $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '50%', // Starting top style attribute
      endingTop: '30%'
    });

    // Bind an onclick event to payment confirmation button.
    $('#confirmPayment').click(function(){


      // Run the post request and on success animate with success.
      $.post("../modules/userCompleteBill.php", {
        billID: $('div.main-container').data('id'),
        userID: $('div.main-container').data('userid'),
        amtPaid: $('div.main-container').data('amtpaid')
      }, function(response){
        console.log(response);
        if (response) {

          // Bill should
          Materialize.toast('Bill Paid.', 4000);

          // Run an animation which pushes the bill away and adds a nice success tick.
            // Fadeout the header.
            $('div.header-wrap').fadeOut();

            // Bounce out the bill box.
            $('div.main-content-wrap').addClass('bounceOutAnimation');

            $('div.main-content-wrap').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(e) {

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



        }
      })

    });

});
