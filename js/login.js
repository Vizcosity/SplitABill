$(document).ready(function(){


  // Handle login with JS.
  $('form').submit(function(event){
    event.preventDefault(); // Prevent default submission.

    var formData = $(this).serializeArray();

    var username = formData[0].value;
    var password = formData[1].value;

    // Send off details to server and await authentication.
    $.post('../modules/authenticate.php', {username: username, password: password}, function(result){

      if (!response.success) return incorrectDetailsHandler(response.reason);

      // Response must be successful at this point.
      // Redirect to dashboard.
      window.location = "./dashboard.php";

    });
  });
});


function incorrectDetailsHandler(message){
  $('p.error').text(message);
}
