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

      // Run an animation which pushes the bill away and adds a nice success tick.

      
    });

});
